<script setup>
import Modal from "@/Components/Modal.vue";
import {computed, onBeforeUpdate, onMounted, onUpdated, ref, watch} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {useForm, usePage} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SelectInput from "@/Components/SelectInput.vue";
import DateTimeInput from "@/Components/DateTimeInput.vue";
import moment from "moment";
import {Textarea} from "@/Components/ui/textarea/index.js";
import PreviousReservation from "@/Pages/Reservations/Partials/PreviousReservation.vue";
import ReservationStatus from "@/Pages/Reservations/Partials/ReservationStatus.vue";
import {Button} from "@/Components/ui/button/index.js";
import ConfirmDialog from "@/Components/DeleteButtonDialog.vue";
import DeleteButtonDialog from "@/Components/DeleteButtonDialog.vue";
import FakeSelectInput from "@/Pages/Reservations/Partials/FakeSelectInput.vue";

const page = usePage()

const props = defineProps({
    show: Boolean,
    selectedEvent: Object,
    previousReservations: Array,
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
            // reloadPage()
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
    // form.creator = props.selectedEvent.creator
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
                    <div>
                        <h2 class="text-3xl text-center xl:text-4xl font-bold text-gray-900">Reagendar Requisição</h2>
                    </div>
                    <ReservationStatus :reservation="props.selectedEvent"/>

                </section>
            </header>

            <div class="mt-6 max-w-full" v-if="props.selectedEvent.previous_reservation">
                <PreviousReservation :previous-reservations="props.previousReservations"
                                     :previous-reservation="props.selectedEvent.previous_reservation"/>
            </div>
            <div class="flex gap-x-2 text-muted-foreground">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6 flex-shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>
                </svg>
                <small class="lg:my-auto">Altere as datas, condutor ou veículo para reagendar</small>
            </div>

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
                <InputLabel value="Agendado por" for="creator"/>
                <FakeSelectInput disabled id="creator" :placeholder="props.selectedEvent.creator.name"/>
            </div>

            <div class="mt-6 max-w-full">
                <InputLabel value="Condutor" for="driver"/>
                <!--        <TextInput class="w-full bg-gray-50" id="driver" v-model="form.driver.id"/>-->
                <SelectInput id="driver" :list="drivers" v-model="form.driver.id" :placeholder="form.driver.name"/>
                <InputError :message="form.errors.driver"/>
            </div>

            <div class="mt-6 max-w-full">
                <InputLabel value="Veículo" for="vehicle"/>
                <!--        <TextInput class="w-full bg-gray-50" id="vehicle" v-model="form.vehicle.id"/>-->
                <SelectInput id="driver" :list="vehicles" v-model="form.vehicle.id" :placeholder="form.vehicle.plate"/>

                <InputError :message="form.errors.vehicle"/>
            </div>


            <div class="mt-6 max-w-full">
                <InputLabel value="Descrição" for="description"/>
                <Textarea class="w-full" id="description" v-model="form.description"
                          :placeholder="form.description"/>
                <InputError :message="form.errors.description"/>
            </div>

            <div class="mt-6 max-w-full">
                <InputLabel value="Pretexo do cancelamento ou reagendamento" for="reason_for_status_change"/>
                <Textarea class="w-full" id="reason_for_status_change" v-model="form.reason_for_status_change"
                          :placeholder="form.reason_for_status_change"/>
                <InputError :message="form.errors.reason_for_status_change"/>
            </div>
            <div class="mt-6 flex flex-col gap-y-4 justify-end gap-x-4 sm:flex-row">
                <Button variant="secondary" @click="$emit('close')">Mudei de Ideia</Button>

                <!--                Delete button-->
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
