<script setup>
import DataTable from "@/Components/ui/data-table.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { columns } from "@/Pages/FleetCards/columns";
import { onMounted, ref } from 'vue';


const props = defineProps({
    fleetCards: Array,
})

const data = ref([...props.fleetCards])

async function getData() {
    return data.value.map(item => ({
        company: item.company,
        code: item.code,
        pin: item.pin,
        type: item.type,
        expire_at: item.expire_at,
        vehicle_id: item.vehicle_id,
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
