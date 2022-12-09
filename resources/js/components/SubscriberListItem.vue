<template>
    <div
        class="flex justify-between items-center border-b border-slate-200 py-3 px-2 border-l-4 border-l-transparent bg-gradient-to-r from-transparent to-transparent hover:from-slate-100 transition ease-linear duration-150"
    >
        <div class="inline-flex items-center space-x-2">
            <div>
                <div>{{ subscriber.name }}</div>
                <small class="text-gray-500">
                    {{ subscriber.email_address }} ({{ subscriber.state }})
                </small>

                <div class="text-gray-500 my-2">
                    <small
                        v-for="field in subscriber.fields"
                        :key="field.id"
                        class="bg-purple-200 rounded-full py-1 px-2 mr-2 whitespace-nowrap my-2"
                    >
                        {{ field.title }} - {{ field.type }}
                    </small>
                </div>
            </div>
        </div>
        <div>
            <button @click="$emit('edit', subscriber)" class="w-5 h-5 m-1">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                    />
                </svg>
            </button>
            <button @click="$emit('delete', subscriber)" class="w-5 h-5 m-1">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    strokeWidth="{1.5}"
                    stroke="currentColor"
                    className="w-6 h-6"
                >
                    <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                    />
                </svg>
            </button>
        </div>
    </div>
</template>
<script>
import SubscriberListItem from "@/components/SubscriberListItem.vue";

export default {
    props: ["subscriber"],
    setup: (props) => ({
        subscriber: props.subscriber,
    }),
};
</script>
