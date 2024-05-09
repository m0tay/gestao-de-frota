<script setup>
import DateTimeInput from '@/Components/DateTimeInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextInput from '@/Components/TextInput.vue';
import Button from '@/Components/ui/button/Button.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { useWindowSize } from "@vueuse/core";
import moment from "moment";
import { computed, onBeforeUpdate, onMounted, watch } from 'vue';


const { width } = useWindowSize();

const page = usePage();

const props = defineProps({
    vehicles: Array,
    drivers: Array,
});

const form = useForm({
    vehicle: Number,
    driver: Number,
    liters: Number,
    price: Number,
    mileage: Number,
    refuel_date: Date,
    description: String,
    fuel_type: String,
})

const updatedFuelType = computed(() => {
    return props.vehicles.find(vehicle => vehicle.id === form.vehicle).fuel_type
})

// const handleSubmit = () => {
//     form.post(route('refuellings.store'));
// }

console.log(page.props.auth.user);

onBeforeUpdate(() => {
    form.reset();
    form.clearErrors();
});

onMounted(() => {
    form.driver = page.props.auth.user
    form.description = "";
    form.driver = page.props.auth.user
    form.fuel_type = 'hello'
    form.mileage = null
    form.price = null
    form.liters = null

    const now = moment();
    const dateToUse =
        width.value < 700
            ? now
            : moment(props.clickedDate).hour(now.hour()).minute(now.minute());
    const minutes = dateToUse.minutes();
    const roundedMinutes = minutes + ((10 - (minutes % 10)) % 10);

    form.refuel_date = dateToUse.minutes(roundedMinutes).seconds(0).toDate();
})

</script>

<template>

    <Head title="Abastecimento" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="space-y-6 p-8 w-full" @contextmenu.prevent>
                        <header>
                            <section class="flex flex-col lg:flex-row justify-between gap-y-6">
                                <div class="group">
                                    <h2 class="text-3xl text-center sm:text-left xl:text-4xl font-bold text-gray-900">
                                        Registar Abastecimento
                                    </h2>
                                    <div
                                        class="flex gap-x-2 text-muted-foreground opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                        </svg>
                                        <small class="lg:my-auto">Preencha os campos com os dados do
                                            abastecimento</small>
                                    </div>
                                </div>
                            </section>
                        </header>

                        <div class="mt-6 max-w-full">
                            <InputLabel value="Data e hora" for="refuel_date" />
                            <DateTimeInput id="refuel_date" v-model="form.refuel_date" />
                            <InputError :message="form.errors.refuel_date" />
                        </div>

                        <div class="flex flex-col sm:flex-row gap-x-4">
                            <div class="mt-6 sm:w-third">
                                <InputLabel value="Condutor" for="driver" />
                                <SelectInput :disabled="!page.props.canSelectDriver" id="driver" :list="drivers"
                                    v-model="form.driver.id" :placeholder="form.driver.name" />
                                <InputError :message="form.errors.driver" />
                            </div>

                            <div class="mt-6 sm:w-third">
                                <InputLabel value="Veículo" for="vehicle" />
                                <SelectInput id="vehicle" :list="vehicles" v-model="form.vehicle.id"
                                    :placeholder="form.vehicle.plate" />
                                <InputError :message="form.errors.vehicle" />
                            </div>
                            <div class="mt-6 sm:w-third">
                                <InputLabel value="Tipo de combustível" for="fuel_type" />
                                <div id="fuel_type">{{ form.fuel_type }}</div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-x-4">
                            <div class="mt-6 sm:w-third">
                                <InputLabel value="Quantidade de litros" for="liters" />
                                <TextInput class="w-full bg-gray-50" id="liters" v-model="form.liters" />
                                <InputError :message="form.errors.liters" />
                            </div>

                            <div class="mt-6 sm:w-third">
                                <InputLabel value="Preço por litro" for="price" />
                                <TextInput class="w-full" id="price" v-model="form.price" />
                                <InputError :message="form.errors.price" />
                            </div>
                            <div class="mt-6 sm:w-third">
                                <InputLabel value="Quilómetros" for="mileage" />
                                <TextInput class="w-full" id="mileage" v-model="form.mileage"
                                    :placeholder="form.mileage" />
                            </div>
                        </div>
                        <div class="mt-6 flex flex-col gap-y-4 justify-end gap-x-4 sm:flex-row">
                            <Button variant="secondary">Mudei de Ideia</Button>

                            <Button @click="handleSubmit">Registar</Button>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
