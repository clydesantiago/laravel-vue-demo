<template>
    <div
        class="max-w-lg mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300"
    >
        <div class="flex flex-row justify-between items-center">
            <div>
                <h1 class="text-3xl font-medium">Subscribers list</h1>
            </div>
            <div class="inline-flex space-x-2 items-center">
                <a
                    href="#"
                    class="py-2 px-4 border border-slate-200 rounded-md inline-flex space-x-1 items-center text-indigo-200 hover:text-white bg-indigo-600 hover:bg-indigo-500"
                >
                    <span class="text-sm font-medium hidden md:block"
                        >Add subscriber</span
                    >
                </a>
            </div>
        </div>
        <p class="text-slate-500">Hello, here's the list of subscribers</p>

        <div id="subscribers" class="my-5">
            <SubscriberListItem />
            <SubscriberListItem />
        </div>
        <p class="text-xs text-slate-500 text-center">
            Demo application using Laravel, Vue JS, and TailwindCSS.
        </p>
    </div>
</template>
<script>
import SubscriberListItem from "@/components/SubscriberListItem.vue";

export default {
    components: {
        SubscriberListItem,
    },
    setup: () => ({
        title: "How To Install Vue 3 in Laravel 9 From Scratch",
    }),
};
</script>
