<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    topics: Array,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Topics index
            </h2>
        </template>

        <!-- component -->
        <section class="antialiased bg-gray-100 text-gray-600 h-screen px-4">
            <div class="flex flex-col justify-center h-full">
                <!-- Table -->
                <div
                    class="w-full max-w-7xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200"
                >
                    <header class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Customers</h2>
                    </header>
                    <Link
                        class="m-3 px-4 py-2 bg-indigo-500 outline-none rounded text-white shadow-indigo-200 shadow-lg font-medium active:shadow-none active:scale-95 hover:bg-indigo-600 focus:bg-indigo-600 focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 disabled:bg-gray-400/80 disabled:shadow-none disabled:cursor-not-allowed transition-colors duration-200"
                        href="/topics/create"
                        >Create</Link
                    >
                    <div class="p-3">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead
                                    class="text-xs font-semibold uppercase text-gray-400 bg-gray-50"
                                >
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div
                                                class="font-semibold text-left"
                                            >
                                                Image
                                            </div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div
                                                class="font-semibold text-left"
                                            >
                                                Name
                                            </div>
                                        </th>
                                    </tr>
                                    <tr v-for="topic in topics" :key="topic.id">
                                        <th>
                                            <img
                                                :src="topic.image"
                                                alt="Image"
                                                class="rounded"
                                                style="width: 20%"
                                            />
                                        </th>
                                        <th>{{ topic.name }}</th>
                                        <th>
                                            <Link :href="`/edit/${topic.id}`"
                                                >Edit</Link
                                            >
                                        </th>
                                        <th>
                                            <Link
                                                :href="`/delete/${topic.id}`"
                                                method="delete"
                                                as="button"
                                                >Delete</Link
                                            >
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
