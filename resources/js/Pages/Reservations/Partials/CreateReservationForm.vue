<script setup>
import Modal from "@/Components/Modal.vue";
import {onBeforeUpdate, onUpdated, ref} from "vue";
import {useForm, usePage} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {Button} from "@/Components/ui/button/index.js";
import SelectInput from "@/Components/SelectInput.vue";
import {Textarea} from "@/Components/ui/textarea/index.js";
import DateTimeInput from "@/Components/DateTimeInput.vue";
import moment from "moment";

const page = usePage()

const props = defineProps({
    show: Boolean,
    drivers: Array,
    vehicles: Array,
})

const form = useForm({
    start: Date,
    end: Date,
    driver: Number,
    vehicle: Number,
    creator: Number,
    description: String,
})


const emit = defineEmits(['close']);

const handleSubmit = () => {

    form.post(route('reservations.store'), {
        onSuccess: () => {
            console.log(form)
            form.reset()
            emit('close'); // Close the modal
        }
    })
}

onBeforeUpdate(() => {
    const now = moment()
    // if (now.minutes() < 30) {
    //     form.end = now.minutes(30).seconds(0).toDate();
    // } else {
    //     form.end = now.add(1, 'hours').startOf('hour').toDate();
    // }

    const minutes = now.minutes();
    const roundedMinutes = minutes + (10 - (minutes % 10)) % 10;


    form.start = now.minutes(roundedMinutes).seconds(0).toDate();
    form.reset()
    form.clearErrors()
    form.start = moment(now).toDate()
    form.end = now.add(1, 'hours').toDate();
    form.creator = page.props.auth.user
    form.driver = page.props.auth.user
    form.description = ''
})
</script>

<template>
    <Modal v-model:show="props.show" @close="$emit('close')">
        <section class="space-y-6 p-8 w-full" @contextmenu.prevent>
            <header>
                <h2 class="text-xl font-bold text-gray-900">Agendar Requisição</h2>
            </header>
            <!--      <div class="flex gap-x-2 text-muted-foreground">-->
            <!--        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"-->
            <!--             stroke="currentColor" class="w-6 h-6 flex-shrink-0">-->
            <!--          <path stroke-linecap="round" stroke-linejoin="round"-->
            <!--                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>-->
            <!--        </svg>-->
            <!--        <small class="lg:my-auto">Preencha os campos aba</small>-->
            <!--      </div>-->

            <div class="mt-6 max-w-full flex flex-col sm:flex-row gap-x-4 gap-y-4">
                <div class="w-full">
                    <InputLabel value="De:" for="start"/>
                    <DateTimeInput id="start" v-model="form.start"/>
                    <InputError :message="form.errors.start"/>
                </div>
                <div class="w-full">
                    <InputLabel value="Até:" for="end"/>
                    <DateTimeInput id="end" v-model="form.end"/>
                    <InputError :message="form.errors.end"/>
                </div>
            </div>

            <div class="mt-6 max-w-full">
                <InputLabel value="Agendado por" for="driver"/>
                <!-- todo: after remove it as it will be sent without the user needing to see -->
                <SelectInput disabled id="driver" :list="drivers" v-model="form.driver.id"
                             :placeholder="form.driver.name"/>
                <InputError :message="form.errors.driver"/>
            </div>

            <div class="mt-6 max-w-full">
                <InputLabel value="Condutor" for="driver"/>
                <SelectInput id="driver" :list="drivers" v-model="form.driver.id" :placeholder="form.driver.name"/>
                <InputError :message="form.errors.driver"/>
            </div>

            <div class="mt-6 max-w-full">
                <InputLabel value="Veículo" for="vehicle"/>
                <SelectInput id="driver" :list="vehicles" v-model="form.vehicle.id" :placeholder="form.vehicle.plate"/>

                <InputError :message="form.errors.vehicle"/>
            </div>


            <div class="mt-6 max-w-full">
                <InputLabel value="Descrição" for="description"/>
                <Textarea class="w-full" id="description" v-model="form.description" :placeholder="form.description"/>
                <InputError :message="form.errors.description"/>
            </div>
            <div class="mt-6 flex flex-col gap-y-4 justify-end gap-x-4 sm:flex-row">
                <Button variant="secondary" @click="$emit('close')">Mudei de Ideia</Button>

                <Button
                    @click="handleSubmit"
                >
                    Reagendar
                </Button>

            </div>
        </section>
    </Modal>
</template>
