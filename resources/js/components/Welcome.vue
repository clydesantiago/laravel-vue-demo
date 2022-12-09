<template>
    <div
        class="max-w-2xl mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300"
    >
        <div class="flex flex-row justify-between items-center">
            <div>
                <h1 class="text-3xl font-medium">Subscribers list</h1>
            </div>
            <div class="inline-flex space-x-2 items-center" v-if="!showForm">
                <button
                    @click="handleSubscriberAdd"
                    class="py-2 px-4 border border-gray-400 rounded-md inline-flex space-x-1 items-center text-dark hover:text-gray hover:bg-gray-200"
                >
                    <span class="text-sm font-medium hidden md:block">
                        Add subscriber
                    </span>
                </button>
            </div>
        </div>

        <div v-show="showForm">
            <SubscriberForm
                @cancel="showForm = false"
                @success="handleFormSubmitSuccess"
                ref="subscriberFormRef"
            />
        </div>

        <div id="subscribers" class="my-5">
            <SubscriberListItem
                v-for="subscriber in subscribers"
                :key="subscriber.id"
                :subscriber="subscriber"
                @delete="handleSubscriberDelete"
                @edit="handleSubscriberEdit"
            />
        </div>
        <p class="text-xs text-slate-500 text-center">
            Demo application using Laravel, Vue JS, and TailwindCSS.
        </p>
    </div>
</template>
<script>
import axios from "axios";
import SubscriberListItem from "@/components/SubscriberListItem.vue";
import SubscriberForm from "@/components/SubscriberForm.vue";
import { ref, onMounted } from "vue";

export default {
    components: {
        SubscriberListItem,
        SubscriberForm,
    },
    setup: () => {
        const subscriberFormRef = ref(null);
        const showForm = ref(false);
        const subscribers = ref([]);

        const fetchSubscribers = () => {
            axios
                .get("/api/subscribers")
                .then(({ data }) => (subscribers.value = data));
        };

        const handleSubscriberDelete = (subscriber) => {
            axios.delete(`/api/subscribers/${subscriber.id}`).then((res) => {
                fetchSubscribers();
                alert(res.data.message);
            });
        };

        const handleSubscriberAdd = () => {
            subscriberFormRef.value.setFormData();
            showForm.value = true;
        };

        const handleFormSubmitSuccess = () => {
            fetchSubscribers();
            showForm.value = false;
        };

        const handleSubscriberEdit = (subscriber) => {
            subscriberFormRef.value.setFormData(subscriber);
            showForm.value = true;
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        };

        onMounted(() => {
            fetchSubscribers();
        });

        return {
            handleFormSubmitSuccess,
            handleSubscriberAdd,
            handleSubscriberDelete,
            handleSubscriberEdit,
            subscriberFormRef,
            subscribers,
            showForm,
        };
    },
};
</script>
