<script setup>
import DataTable from '@/Components/ui/data-table.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { columns } from '@/Pages/Refuellings/columns';
import { Head, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage()

const data = ref(page.props.refuellings.map(refueling => ({
    id: refueling.id,
    refuel_date: new Date(refueling.refuel_date),
    vehicle: {
        licensePlate: (refueling.vehicle.plate).toUpperCase(),
    },
    driver: {
        name: refueling.driver.name,
    },
    fuel_type: refueling.fuel_type,
    mileage: refueling.mileage,
    amount: Number.parseFloat(refueling.amount),
    price: Number.parseFloat(refueling.price),
})))
</script>

<template>

    <Head title="Abastecimento" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="container">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <DataTable :columns="columns" :data="data" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
