<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { columns } from "@/Pages/Refuelling/columns"
import DataTable from "@/Components/ui/data-table.vue"
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
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

interface Payment {
    id: string
    amount: number
    status: 'pending' | 'processing' | 'success' | 'failed'
    email: string
}

const data = ref<Payment[]>([])

async function getData(): Promise<Payment[]> {
    // Fetch data from your API here.
    return [...generateRandomData()]
}

onMounted(async () => {
    data.value = await getData();
});
</script>

<template>
    <AuthenticatedLayout>
        <div class="container py-10 mx-auto">
            <DataTable :columns="columns" :data="data" />
        </div>
    </AuthenticatedLayout>
</template>
    