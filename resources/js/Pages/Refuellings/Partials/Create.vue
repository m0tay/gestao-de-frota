<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Abastecimento" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="container">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Create</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
