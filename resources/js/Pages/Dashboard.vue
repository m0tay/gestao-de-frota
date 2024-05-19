<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { mobileFoldingWidth, width } from '@/lib/windowSizing.js';


</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header v-if="width < mobileFoldingWidth">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Gráficos e mais dados ficarão aqui</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
