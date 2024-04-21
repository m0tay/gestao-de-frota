<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { columns } from "@/Pages/Vehicles/columns"
import DataTable from "@/Components/ui/data-table.vue"
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { faker } from "@faker-js/faker";

interface Vehicle {
    licensePlate: string
    brand: string
    model: string
    vin: string
    lastInspection: Date
}

const data = ref<Vehicle[]>([])

async function getData(): Promise<Vehicle[]> {
    // Fetch data from your API here.
    return [...generateFakeVehicleData()]
}

onMounted(async () => {
    data.value = await getData();
});

function generateFakeVehicleData() {
    const data = [];

    for (let i = 0; i < 50; i++) {
        const randomLicensePlate = `${faker.helpers.replaceSymbols("??")}-${faker.helpers.replaceSymbols("##")}-${faker.helpers.replaceSymbols("??")}`;
        const randomBrand = faker.vehicle.manufacturer();
        const randomModel = faker.vehicle.model();
        const randomVin = faker.vehicle.vin();
        const randomDate = faker.date.past();

        data.push({
            licensePlate: randomLicensePlate,
            brand: randomBrand,
            model: randomModel,
            vin: randomVin,
            lastInspection: randomDate,
        });
    }

    return data;
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-3 text-gray-900">
                        <DataTable :columns="columns" :data="data" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
