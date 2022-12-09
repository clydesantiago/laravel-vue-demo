<template>
    <form
        @submit="handleSubmit"
        class="mx-auto w-full border p-5 rounded my-10"
    >
        <p class="font-bold mb-5 text-lg">
            {{ formData.id ? "Update" : "Create" }} subscriber
        </p>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label
                    for="name"
                    class="block font-bold display-1 mb-2 md:mb-0 pr-4"
                    >Name:</label
                >
            </div>
            <div class="md:w-2/3">
                <input
                    v-model="formData.name"
                    type="text"
                    placeholder="John Doe"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                />
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label for="email" class="block font-bold mb-2 md:mb-0 pr-4"
                    >Email:</label
                >
            </div>
            <div class="md:w-2/3">
                <input
                    v-model="formData.email_address"
                    type="email"
                    placeholder="johndoe@example.com"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                />
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label for="state" class="block font-bold mb-2 md:mb-0 pr-4"
                    >State:</label
                >
            </div>
            <div class="md:w-2/3">
                <select
                    v-model="formData.state"
                    class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                >
                    <option value="active">active</option>
                    <option value="unsubscribed">unsubscribed</option>
                    <option value="junk">junk</option>
                    <option value="bounced">bounced</option>
                    <option value="unconfirmed">unconfirmed</option>
                </select>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <button
                    @click="handleAddField"
                    type="button"
                    class="py-2 px-4 border mr-2 mb-2 md:mb-0 border-gray-400 rounded-md inline-flex space-x-1 items-center text-dark hover:text-gray hover:bg-gray-200"
                >
                    <span class="text-sm font-medium md:block">
                        Add field
                    </span>
                </button>
            </div>
            <div class="md:w-2/3">
                <div
                    class="flex mb-2"
                    v-for="(field, fieldIndex) in formData.fields"
                    :key="fieldIndex"
                >
                    <input
                        v-model="field.title"
                        placeholder="Enter field title"
                        class="shadow mr-2 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    />
                    <select
                        v-model="field.type"
                        class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    >
                        <option value="date">date</option>
                        <option value="number">number</option>
                        <option value="string">string</option>
                        <option value="boolean">boolean</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="md:flex md:items-center">
            <div class="md:w-1/3"></div>
            <div class="md:w-2/3">
                <button
                    @click="$emit('cancel')"
                    type="button"
                    class="py-2 px-4 border mr-2 border-gray-400 rounded-md inline-flex space-x-1 items-center text-dark hover:text-gray hover:bg-gray-200"
                >
                    <span class="text-sm font-medium md:block"> Cancel </span>
                </button>
                <button
                    type="submit"
                    class="py-2 px-4 border border-slate-200 rounded-md inline-flex space-x-1 items-center text-indigo-200 hover:text-white bg-indigo-600 hover:bg-indigo-500"
                >
                    <span class="text-sm font-medium md:block"> Submit </span>
                </button>
            </div>
        </div>
    </form>
</template>
<script>
import axios from "axios";
import { ref } from "vue";
import SubscriberListItem from "@/components/SubscriberListItem.vue";

export default {
    setup: (_, { emit }) => {
        const defaultData = {
            id: null,
            name: "",
            email: "",
            state: "active",
            fields: [
                {
                    title: "",
                    type: "date",
                },
            ],
        };

        const formData = ref({});

        const setFormData = (subscriber = defaultData) => {
            formData.value = JSON.parse(JSON.stringify(subscriber));
        };

        const handleAddField = () => {
            const newData = { ...formData.value };
            newData.fields.push({
                title: "",
                type: "date",
            });
            formData.value = newData;
        };

        const handleSubmit = (e) => {
            e.preventDefault();
            const request = formData.value.id
                ? axios.put(
                      `/api/subscribers/${formData.value.id}`,
                      formData.value
                  )
                : axios.post("/api/subscribers", formData.value);
            request
                .then(({ data }) => {
                    emit("success");
                    alert(data.message);
                })
                .catch(({ response }) => alert(response.data.message));
        };

        return { handleAddField, handleSubmit, setFormData, formData };
    },
};
</script>
