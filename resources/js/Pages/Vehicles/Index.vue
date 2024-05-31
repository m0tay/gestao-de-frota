<script setup>
import DataTable from "@/Components/ui/data-table.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { columns } from "@/Pages/Vehicles/columns";
import { onMounted, ref } from 'vue';


const props = defineProps({
    vehicles: Array
})

const data = ref([...props.vehicles])

async function getData() {
    return data.value.map(vehicle => ({
        plate: vehicle.plate,
        brand: vehicle.brand,
        model: vehicle.model,
        color: vehicle.color,
        proprietary: vehicle.proprietary,
        chassis: vehicle.chassis,
        kms: `${vehicle.kms ?? '-'} km`,
        category: vehicle.category,
        active: vehicle.active ? 'Ativo' : 'Desativado',
        private: vehicle.active ? vehicle.private ? 'Particular' : 'Comunitário' : '-',
        fuel_type: vehicle.fuel_type,
        status: vehicle.status,
    }))
}

onMounted(async () => {
    data.value = await getData();
});
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
