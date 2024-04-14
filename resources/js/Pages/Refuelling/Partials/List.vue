<script setup>
import { ref, onMounted } from 'vue'
import { columns } from '@/Pages/Refuelling/columns'
import DataTable from '@/Components/ui/data-table.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { faker } from "@faker-js/faker";

function generateRandomData() {
    const data = [];
    const statuses = ['failed', 'success', 'pending', 'processing'];

    for (let i = 0; i < 100; i++) {
        const randomStatus = faker.helpers.arrayElement(statuses);
        const randomEmail = faker.internet.email();
        const randomAmount = faker.datatype.number({ min: 1, max: 1000 });
        const randomId = faker.datatype.uuid();

        data.push({
            id: randomId,
            amount: randomAmount,
            status: randomStatus,
            email: randomEmail,
        });
    }

    return data;
}

const data = ref([])

async function getData() {
    // Fetch data from your API here.
    return [...generateRandomData()]
}

onMounted(async () => {
    data.value = await getData();
});
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