<script setup>
import Modal from "@/Components/Modal.vue";
import {onBeforeUpdate} from "vue";
import {useForm, usePage} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SelectInput from "@/Components/SelectInput.vue";
import DateTimeInput from "@/Components/DateTimeInput.vue";
import moment from "moment";
import {Textarea} from "@/Components/ui/textarea/index.js";
import PreviousReservation from "@/Pages/Reservations/Partials/PreviousReservation.vue";
import ReservationStatus from "@/Pages/Reservations/Partials/ReservationStatus.vue";
import {Button} from "@/Components/ui/button/index.js";
import DeleteButtonDialog from "@/Components/DeleteButtonDialog.vue";
import FakeSelectInput from "@/Pages/Reservations/Partials/FakeSelectInput.vue";

const page = usePage()

const props = defineProps({
    show: Boolean,
    selectedEvent: {
        type: Object,
        required: false,
    },
    previousReservations: Array,
    drivers: Array,
    vehicles: Array,
    calendarApp: Object,
})

const form = useForm({
    start: Date,
    end: Date,
    driver: Number,
    vehicle: Number,
    creator: Number,
    description: String,
    reason_for_status_change: String,
    id: Number,
})

const formCancel = useForm({
    reason_for_status_change: String,
})

const emit = defineEmits(['close']);

const handleSubmit = () => {
    form.put(route('reservations.update', {reservation: props.selectedEvent.id}), {
        onSuccess: () => {
            console.log(form)
            form.reset()
            emit('close')
            reloadPage()
        }
    })
}

const handleCancel = () => {
    formCancel.reason_for_status_change = form.reason_for_status_change

    formCancel.post(route('reservations.cancel', {reservation: props.selectedEvent.id}), {
        onSuccess: () => {
            form.reset()
            emit('close')
            reloadPage()
        }
    })
}

onBeforeUpdate(() => {
    form.reset()
    form.clearErrors()
    form.start = moment(props.selectedEvent.start).toDate()
    form.end = moment(props.selectedEvent.end).toDate()
    form.creator = page.props.auth.user
    form.vehicle = props.selectedEvent.vehicle
    form.driver = props.selectedEvent.driver
    form.description = props.selectedEvent.description
    form.id = props.selectedEvent.id
    form.reason_for_status_change = ''
    formCancel.reason_for_status_change = ''
})

const reloadPage = () => {
    window.location.reload();
}
</script>

<template>
    <Modal :show="props.show" @close="$emit('close')">
        <section class="space-y-6 p-8 w-full" @contextmenu.prevent>
            <header>
                <section class="flex flex-col lg:flex-row justify-between gap-y-6">
                    <div class="group">
                        <h2 class="text-3xl text-center sm:text-left xl:text-4xl font-bold text-gray-900">Reagendar
                            Requisição</h2>
                        <div
                            class="flex gap-x-2 text-muted-foreground opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"/>
                            </svg>
                            <small class="lg:my-auto">Altere as datas, condutor ou veículo para reagendar</small>
                        </div>
                    </div>
                    <ReservationStatus :reservation="props.selectedEvent"/>
                </section>
            </header>

            <div v-if="props.selectedEvent.previous_reservation" class="mt-6 max-w-full">
                <PreviousReservation :previous-reservation="props.selectedEvent.previous_reservation"
                                     :previous-reservations="props.previousReservations"/>
            </div>

            <div class="mt-6 max-w-full flex flex-col sm:flex-row gap-x-4 gap-y-4">
                <div class="w-full">
                    <InputLabel for="start" value="De:"/>
                    <DateTimeInput id="start" v-model="form.start"/>
                    <InputError :message="form.errors.start"/>
                </div>
                <div class="w-full">
                    <InputLabel for="end" value="Até:"/>
                    <DateTimeInput id="end" v-model="form.end"/>
                    <InputError :message="form.errors.end"/>
                </div>
            </div>

            <div class="mt-6 max-w-full">
                <InputLabel for="creator" value="Agendado por"/>
                <FakeSelectInput id="creator" :placeholder="props.selectedEvent.creator.name" disabled/>
            </div>

            <div class="mt-6 max-w-full">
                <InputLabel for="driver" value="Condutor"/>
                <SelectInput id="driver" v-model="form.driver.id" :list="drivers" :placeholder="form.driver.name"/>
                <InputError :message="form.errors.driver"/>
            </div>

            <div class="mt-6 max-w-full">
                <InputLabel for="vehicle" value="Veículo"/>
                <SelectInput id="vehicle" v-model="form.vehicle.id" :list="vehicles" :placeholder="form.vehicle.plate"/>

                <InputError :message="form.errors.vehicle"/>
            </div>


            <div class="mt-6 max-w-full">
                <InputLabel for="description" value="Descrição"/>
                <Textarea id="description" v-model="form.description" :placeholder="form.description"
                          class="w-full"/>
                <InputError :message="form.errors.description"/>
            </div>

            <div class="mt-6 max-w-full">
                <InputLabel for="reason_for_status_change" value="Pretexo do cancelamento ou reagendamento"/>
                <Textarea id="reason_for_status_change" v-model="form.reason_for_status_change"
                          :placeholder="form.reason_for_status_change"
                          class="w-full"/>
                <InputError :message="form.errors.reason_for_status_change"/>
            </div>
            <div class="mt-6 flex flex-col gap-y-4 justify-end gap-x-4 sm:flex-row">
                <Button variant="secondary" @click="$emit('close')">Mudei de Ideia</Button>

                <DeleteButtonDialog @cancel="handleCancel"/>

                <Button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="handleSubmit"
                >
                    Reagendar
                </Button>

            </div>
        </section>
    </Modal>
</template>
