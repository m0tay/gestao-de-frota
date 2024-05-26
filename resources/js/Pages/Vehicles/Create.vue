<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import SelectInput from '@/Components/Vehicles/SelectInput.vue';
import TextInput from '@/Components/TextInput.vue';
import Button from '@/Components/ui/button/Button.vue';
import { Label } from '@/Components/ui/label';
import { RadioGroup, RadioGroupItem } from '@/Components/ui/radio-group';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { onBeforeUpdate, onMounted } from 'vue';

const page = usePage();

const props = defineProps({
    brands: Array,
    categories: Array,
    colors: Array,
    proprietaries: Array,
    fuelTypes: Array,
});

const form = useForm({})

const handleSubmit = () => { }

onBeforeUpdate(() => {
    form.reset();
    form.clearErrors();
});

onMounted(() => {

})
</script>

<template>

    <Head title="Veículos" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="space-y-6 p-8 w-full" @contextmenu.prevent>
                        <header>
                            <section class="flex flex-col lg:flex-row justify-between gap-y-6">
                                <div class="group">
                                    <h2 class="text-3xl text-center sm:text-left xl:text-4xl font-bold text-gray-900">
                                        Registar Veículo
                                    </h2>
                                    <div
                                        class="flex gap-x-2 text-muted-foreground opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                        </svg>
                                        <small class="lg:my-auto">Preencha os campos com os dados do veículo a ser
                                            registado</small>
                                    </div>
                                </div>
                            </section>
                        </header>
                        <div>
                            <h2 class="text-left font-bold">Informações sobre veículo</h2>
                            <hr class="border-t border-gray-300" />
                        </div>
                        <div class="flex flex-col sm:flex-row gap-x-4">
                            <div class="mt-6 sm:w-half gap-y-4 flex flex-col">
                                <div>
                                    <InputLabel value="Matrícula" for="vehicle_plate" />
                                    <TextInput class="w-full" id="vehicle_plate" />
                                </div>
                                <div>
                                    <InputLabel value="Marca" for="vehicle_brand" />
                                    <SelectInput class="w-full" id="vehicle_brand" :list="page.props.brands" />
                                </div>
                                <div>
                                    <InputLabel value="Modelo" for="vehicle_model" />
                                    <TextInput class="w-full" id="vehicle_model" />
                                </div>
                                <div>
                                    <InputLabel value="Tipo de veículo" for="vehicle_type" />
                                    <SelectInput class="w-full" id="vehicle_type" :list="page.props.categories" />
                                </div>
                                <div>
                                    <InputLabel value="N&deg; chassi" for="vehicle_chassi" />
                                    <TextInput class="w-full" id="vehicle_chassi" />
                                </div>
                                <div>
                                    <InputLabel value="Tipo de combustível" for="vehicle_fuel_type" />
                                    <SelectInput class="w-full" id="vehicle_fuel_type" :list="page.props.fuelTypes" />
                                </div>
                                <div>
                                    <InputLabel value="Capacidade de depósito" for="vehicle_tank_capacity" />
                                    <TextInput class="w-full" id="vehicle_tank_capacity" />
                                </div>
                            </div>

                            <div class="mt-6 sm:w-half gap-y-4 flex flex-col">
                                <div class="flex gap-x-4 my-5">
                                    <InputLabel value="AdBlue" for="vehicle_has_adblue" />
                                    <RadioGroup default-value="no" class="flex" id="vehicle_has_adblue">
                                        <div class="flex items-center space-x-2">
                                            <RadioGroupItem id="yes" value="yes" />
                                            <Label for="yes">Sim</Label>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <RadioGroupItem id="option-two" value="no" />
                                            <Label for="no">N&atilde;o</Label>
                                        </div>
                                    </RadioGroup>
                                </div>
                                <div>
                                    <InputLabel value="Propietário" for="vehicle_proprietary" />
                                    <SelectInput class="w-full" id="vehicle_proprietary"
                                        :list="page.props.proprietaries" />
                                </div>
                                <div class="flex gap-x-4 my-5">
                                    <InputLabel value="Leasing" for="vehicle_has_leasing" />
                                    <RadioGroup default-value="no" class="flex" id="vehicle_has_leasing">
                                        <div class="flex items-center space-x-2">
                                            <RadioGroupItem id="yes" value="yes" />
                                            <Label for="yes">Sim</Label>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <RadioGroupItem id="option-two" value="no" />
                                            <Label for="no">N&atilde;o</Label>
                                        </div>
                                    </RadioGroup>
                                </div>
                                <div>
                                    <InputLabel value="Cor" for="vehicle_color" />
                                    <SelectInput class="w-full" id="vehicle_color" :list="page.props.colors" />
                                </div>
                                <div>
                                    <InputLabel value="Quilometrágem" for="vehicle_kms" />
                                    <TextInput class="w-full" id="vehicle_kms" />
                                </div>
                                <div>
                                    <InputLabel value="Pertence à frota" for="vehicle_in_fleet" />
                                    <SelectInput class="w-full" id="vehicle_in_fleet" />
                                </div>
                                <div>
                                    <InputLabel value="Status" for="vehicle_status" />
                                    <SelectInput class="w-full" id="vehicle_status" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-left font-bold">Informações adicionais</h2>
                            <hr class="border-t border-gray-300" />
                        </div>
                        <div class="flex flex-col sm:flex-row gap-x-4">
                            <div class="mt-6 sm:w-half gap-y-4 flex flex-col">
                                <div>
                                    <InputLabel value="Cartão frota" for="vehicle_cartao_frota" />
                                    <TextInput class="w-full" id="vehicle_cartao_frota" />
                                </div>
                                <div>
                                    <InputLabel value="Data de matrícula" for="vehicle_registration_date" />
                                    <TextInput class="w-full" id="vehicle_registration_date" />
                                </div>
                                <div>
                                    <InputLabel value="Foto do veículo" for="vehicle_photo" />
                                    <TextInput class="w-full" id="vehicle_photo" />
                                </div>
                            </div>

                            <div class="mt-6 sm:w-half gap-y-4 flex flex-col">
                                <div>
                                    <InputLabel value="Pneus ref. livrete" for="vehicle_tire_ref" />
                                    <TextInput class="w-full" id="vehicle_tire_ref" />
                                </div>
                                <div>
                                    <InputLabel value="1&deg; eixo" for="vehicle_tire_1st_axis" />
                                    <TextInput class="w-full" id="vehicle_tire_1st_axis" />
                                </div>
                                <div>
                                    <InputLabel value="2&deg; eixo" for="vehicle_tire_2nd_axis" />
                                    <TextInput class="w-full" id="vehicle_tire_2nd_axis" />
                                </div>
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
