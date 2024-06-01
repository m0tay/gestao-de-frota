<script setup>
import FormSection from '@/Components/FormSection.vue';
import FormTwoColumn from '@/Components/FormTwoColumn.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/Vehicles/SelectInput.vue';
import SelectInputVehicle from '@/Components/SelectInput.vue';
import Button from '@/Components/ui/button/Button.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import DateTimeInput from '@/Components/DateTimeInput.vue';

const props = defineProps({
    companies: Array,
    types: Array,
    vehicles: Array,
})

const form = useForm({
    company: String,
    vehicle_id: Number,
    type: String,
    code: String,
    pin: String,
    expire_at: Date
})

const submit = () => {
    form.post(route('fleet_cards.store'))
}

onMounted(() => {
    form.reset()
    form.clearErrors()

    form.company = null
    form.vehicle = null
    form.type = null
    form.code = null
    form.pin = null
    form.expire_at = null
})
</script>

<template>

    <Head title="Cartão Frota" />
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="space-y-6 p-8 w-full" @contextmenu.prevent>
                        <header>
                            <section class="flex flex-col lg:flex-row justify-between gap-y-6">
                                <div class="group">
                                    <h2 class="text-3xl text-center sm:text-left xl:text-4xl font-bold text-gray-900">
                                        Registar Cartão Frota
                                    </h2>
                                    <div
                                        class="flex gap-x-2 text-muted-foreground opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                        </svg>
                                        <small class="lg:my-auto">Preencha os campos com os dados do cartão frota a ser
                                            registado</small>
                                    </div>
                                </div>
                            </section>
                        </header>
                        <FormSection title="Cartão Frota" />
                        <FormTwoColumn>
                            <template #left>
                                <div>
                                    <InputLabel for="company" value="Cliente" />
                                    <SelectInput id="company" type="text" class="w-full" :list="companies" v-model="form.company" />
                                    <InputError :message="form.errors.company" />
                                </div>
                                <div>
                                    <InputLabel for="code" value="Cart&atilde;o frota" />
                                    <TextInput id="code" type="text" class="w-full" v-model="form.code" />
                                    <InputError :message="form.errors.code" />
                                </div>
                                <div>
                                    <InputLabel for="pin" value="PIN" />
                                    <TextInput id="pin" type="text" class="w-full" v-model="form.pin" />
                                    <InputError :message="form.errors.pin" />
                                </div>
                            </template>

                            <template #right>
                                <div>
                                    <InputLabel for="type" value="Tipo" />
                                    <SelectInput id="type" type="text" class="w-full" :list="types" v-model="form.type" />
                                    <InputError :message="form.errors.type" />
                                </div>
                                <div>
                                    <InputLabel for="expire_at" value="Validade do cartão frota" />
                                    <DateTimeInput :min-date="true" :max-date="false" showYear id="expire_at" type="text" class="w-full" v-model="form.expire_at" />
                                    <InputError :message="form.errors.expire_at" />
                                </div>
                                <div>
                                    <InputLabel for="vehicle_id" value="Veículo associado" />
                                    <SelectInputVehicle id="vehicle_id" type="text" class="w-full" :list="vehicles" v-model="form.vehicle_id" />
                                    <InputError :message="form.errors.vehicle_id" />
                                </div>
                            </template>
                        </FormTwoColumn>

                        <div class="mt-6 flex flex-col gap-y-4 justify-end gap-x-4 sm:flex-row">
                            <Button variant="secondary">Mudei de Ideia</Button>

                            <Button @click="submit">Registar</Button>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>