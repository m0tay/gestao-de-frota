<script setup>
import DateTimeInput from '@/Components/DateTimeInput.vue';
import FormSection from '@/Components/FormSection.vue';
import FormTwoColumn from '@/Components/FormTwoColumn.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/Vehicles/SelectInput.vue';
import Button from '@/Components/ui/button/Button.vue';
import { Label } from '@/Components/ui/label';
import { RadioGroup, RadioGroupItem } from '@/Components/ui/radio-group';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const page = usePage();

const props = defineProps({
    brands: Array,
    categories: Array,
    colors: Array,
    proprietaries: Array,
    fuelTypes: Array,
    statuses: Array,
    tireBooklet: Array,
    tireBrands: Array,
    tireAxles: Array,
});

const form = useForm({
    plate: String,
    brand: String,
    model: String,
    color: String,
    category: String,
    proprietary: String,
    active: Boolean,
    kms: Number,
    fuel_type: String,
    has_adblue: Boolean,
    has_leasing: Boolean,
    chassis: String,
    tank_capacity: Number,
    status: String,
    fleet_card: String,
    registration_date: Date,
    tire_booklet: String,
    tire1_brand: String,
    tire1_axle: String,
    tire2_brand: String,
    tire2_axle: String,
});

const handleSubmit = () => {
    form.post(route("vehicles.store"), {
        onError: () => { },
    });
}

onMounted(() => {
    form.reset();
    form.clearErrors();
    form.has_adblue = false;
    form.has_leasing = false;
    form.is_active = true;
    form.kms = null;
    form.model = '';
    form.plate = '';
    form.category = null;
    form.fuel_type = null;
    form.proprietary = null;
    form.brand = null;
    form.color = null;
    form.chassis = null;
    form.tank_capacity = null;
    form.registration_date = new Date();
    form.tire_booklet = null;
    form.tire1_brand = null;
    form.tire1_axle = null;
    form.tire2_brand = null;
    form.tire2_axle = null;
    form.fleet_card = null;
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

                        <FormSection title="Informações do veículo" />

                        <FormTwoColumn>
                            <template #left>
                                <div>
                                    <InputLabel value="Matrícula" for="vehicle_plate" />
                                    <TextInput class="w-full" id="vehicle_plate" v-model="form.plate" />
                                    <InputError :message="form.errors.plate" />
                                </div>
                                <div>
                                    <InputLabel value="Marca" for="vehicle_brand" />
                                    <SelectInput class="w-full" id="vehicle_brand" :list="page.props.brands"
                                        v-model="form.brand" />
                                    <InputError :message="form.errors.brand" />
                                </div>
                                <div>
                                    <InputLabel value="Modelo" for="vehicle_model" />
                                    <TextInput class="w-full" id="vehicle_model" v-model="form.model" />
                                    <InputError :message="form.errors.model" />
                                </div>
                                <div>
                                    <InputLabel value="Tipo de veículo" for="vehicle_type" />
                                    <SelectInput class="w-full" id="vehicle_type" :list="page.props.categories"
                                        v-model="form.category" />
                                    <InputError :message="form.errors.category" />
                                </div>
                                <div>
                                    <InputLabel value="N&deg; chassi" for="vehicle_chassis" />
                                    <TextInput class="w-full" id="vehicle_chassis" v-model="form.chassis" />
                                    <InputError :message="form.errors.chassis" />
                                </div>
                                <div>
                                    <InputLabel value="Tipo de combustível" for="vehicle_fuel_type" />
                                    <SelectInput class="w-full" id="vehicle_fuel_type" :list="page.props.fuelTypes"
                                        v-model="form.fuel_type" />
                                    <InputError :message="form.errors.fuel_type" />
                                </div>
                                <div>
                                    <InputLabel value="Capacidade de depósito" for="vehicle_tank_capacity" />
                                    <TextInput class="w-full" id="vehicle_tank_capacity" v-model="form.tank_capacity" />
                                    <InputError :message="form.errors.tank_capacity" />
                                </div>
                            </template>

                            <template #right>
                                <div class="flex gap-x-4 my-5">
                                    <InputLabel value="AdBlue" for="vehicle_has_adblue" />
                                    <RadioGroup v-model="form.has_adblue" :default-value="false" class="flex"
                                        id="vehicle_has_adblue">
                                        <div class="flex items-center space-x-2">
                                            <RadioGroupItem id="yes" :value="true" />
                                            <Label for="yes">Sim</Label>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <RadioGroupItem id="option-two" :value="false" />
                                            <Label for="no">N&atilde;o</Label>
                                        </div>
                                    </RadioGroup>
                                    <InputError :message="form.errors.has_adblue" />
                                </div>
                                <div>
                                    <InputLabel value="Propietário" for="vehicle_proprietary" />
                                    <SelectInput class="w-full" id="vehicle_proprietary"
                                        :list="page.props.proprietaries" v-model="form.proprietary" />
                                    <InputError :message="form.errors.proprietary" />
                                </div>
                                <div class="flex gap-x-4 my-5">
                                    <InputLabel value="Leasing" for="vehicle_has_leasing" />
                                    <RadioGroup v-model="form.has_leasing" :default-value="false" class="flex"
                                        id="vehicle_has_leasing">
                                        <div class="flex items-center space-x-2">
                                            <RadioGroupItem id="yes" :value="true" />
                                            <Label for="yes">Sim</Label>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <RadioGroupItem id="option-two" :value="false" />
                                            <Label for="no">N&atilde;o</Label>
                                        </div>
                                    </RadioGroup>
                                    <InputError :message="form.errors.has_leasing" />
                                </div>
                                <div>
                                    <InputLabel value="Cor" for="vehicle_color" />
                                    <SelectInput class="w-full" id="vehicle_color" :list="page.props.colors"
                                        v-model="form.color" />
                                    <InputError :message="form.errors.color" />
                                </div>
                                <div>
                                    <InputLabel value="Quilometrágem" for="vehicle_kms" />
                                    <TextInput class="w-full" id="vehicle_kms" v-model="form.kms" />
                                    <InputError :message="form.errors.kms" />
                                </div>
                                <div>
                                    <InputLabel value="Pertence à frota" for="vehicle_in_fleet" />
                                    <SelectInput disabled class="w-full" id="vehicle_in_fleet" />
                                </div>
                                <div>
                                    <InputLabel value="Status" for="vehicle_status" />
                                    <SelectInput class="w-full" id="vehicle_status" :list="page.props.statuses"
                                        v-model="form.status" />
                                    <InputError :message="form.errors.status" />
                                </div>
                            </template>
                        </FormTwoColumn>

                        <FormSection title="Informações adicionais" />

                        <FormTwoColumn>
                            <template #left>
                                <div>
                                    <InputLabel value="Data de matrícula" for="vehicle_registration_date" />
                                    <DateTimeInput class="w-full" id="vehicle_registration_date" :min-date="false"
                                        :max-date="'today'" :type="'date'" v-model="form.registration_date" />
                                    <InputError :message="form.errors.registration_date" />
                                </div>
                                <div>
                                    <InputLabel value="Cartão frota" for="vehicle_cartao_frota" />
                                    <TextInput disabled class="w-full cursor-not-allowed" id="vehicle_cartao_frota"
                                        v-model="form.fleet_card" />
                                    <InputError :message="form.errors.fleet_card" />
                                </div>
                                <div>
                                    <InputLabel value="Foto do veículo" for="vehicle_photo" />
                                    <TextInput disabled class="w-full cursor-not-allowed" id="vehicle_photo" />
                                </div>
                            </template>

                            <template #right>
                                <div>
                                    <InputLabel value="Pneus ref. livrete" for="vehicle_tire_ref" />
                                    <SelectInput class="w-full" id="vehicle_tire_ref" :list="page.props.tireBooklet"
                                        v-model="form.tire_booklet" />
                                    <InputError :message="form.errors.tire_booklet" />
                                </div>
                                <div>
                                    <InputLabel value="1&deg; eixo" for="vehicle_tire_1st_axis" />
                                    <SelectInput class="w-full" id="vehicle_tire_1st_axis" :list="page.props.tireAxles"
                                        v-model="form.tire1_axle" />
                                    <InputError :message="form.errors.tire1_axle" />
                                </div>
                                <div>
                                    <InputLabel value="1&deg; marca" for="vehicle_tire_1st_axis_brand" />
                                    <SelectInput class="w-full" id="vehicle_tire_1st_axis_brand"
                                        :list="page.props.tireBrands" v-model="form.tire1_brand" />
                                    <InputError :message="form.errors.tire1_brand" />
                                </div>
                                <div>
                                    <InputLabel value="2&deg; eixo" for="vehicle_tire_2nd_axis" />
                                    <SelectInput class="w-full" id="vehicle_tire_2nd_axis" :list="page.props.tireAxles"
                                        v-model="form.tire2_axle" />
                                    <InputError :message="form.errors.tire2_axle" />
                                </div>
                                <div>
                                    <InputLabel value="2&deg; marca" for="vehicle_tire_2nd_axis_brand" />
                                    <SelectInput class="w-full" id="vehicle_tire_2nd_axis_brand"
                                        :list="page.props.tireBrands" v-model="form.tire2_brand" />
                                    <InputError :message="form.errors.tire2_brand" />
                                </div>
                            </template>
                        </FormTwoColumn>

                        <div class="flex flex-col sm:flex-row gap-x-4">
                            <div class="mt-6 sm:w-half gap-y-4 flex flex-col">

                            </div>

                            <div class="mt-6 sm:w-half gap-y-4 flex flex-col">

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
