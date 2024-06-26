<script setup xmlns="http://www.w3.org/1999/html">
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import TextInput from "@/Components/TextInput.vue";
import { Button } from "@/Components/ui/button/index.js";
import { Textarea } from "@/Components/ui/textarea/index.js";
import FakeDateTimeInput from "@/Pages/Reservations/Partials/FakeDateTimeInput.vue";
import FakeSelectInput from "@/Pages/Reservations/Partials/FakeSelectInput.vue";
import PreviousReservation from "@/Pages/Reservations/Partials/PreviousReservation.vue";
import ReservationStatus from "@/Pages/Reservations/Partials/ReservationStatus.vue";
import { reloadPage } from "@/lib/reloadPage";
import { useForm, usePage } from "@inertiajs/vue3";
import { useWindowSize } from "@vueuse/core";
import { ArrowBigDownDash, ArrowBigRightDash } from 'lucide-vue-next';
import moment from "moment";
import { onBeforeUpdate, ref } from "vue";

const authorized = ref([
    1,
    2
])

const { width } = useWindowSize()

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
})

const form = useForm({
    start: Date,
    end: Date,
    driver: Number,
    vehicle: Number,
    creator: Number,
    description: String,
    id: Number,
})

const formReturning = useForm({
    id: Number,
    returned_at: Date,
    start: Date,
    start_kms: Number,
    returned_kms: Number,
    returned_ok: Boolean,
    returned_condition: String,
})

const emit = defineEmits(['close']);

/**
 * Updates the returning and start dates, sends a PUT request to the reservation returning route,
 * and handles success by resetting the form, emitting a close event, and reloading the page.
 */
const handleReturning = () => {
    formReturning.returned_at = new Date()
    formReturning.start = moment(props.selectedEvent.start).toDate()

    formReturning.put(route('reservation.returning', { reservation: props.selectedEvent.id }), {
        onSuccess: () => {
            form.reset()
            emit('close')
            reloadPage()
        },
    })
}

const setReturningCondition = () => {
    !formReturning.returned_oks
}

onBeforeUpdate(() => {
    form.reset()
    form.clearErrors()
    formReturning.reset()
    formReturning.clearErrors()
    if (props.selectedEvent) {
        form.start = moment(props.selectedEvent.start).toDate()
        form.end = moment(props.selectedEvent.end).toDate()
        form.creator = props.selectedEvent.creator
        form.vehicle = props.selectedEvent.vehicle
        form.driver = props.selectedEvent.driver
        form.description = props.selectedEvent.description
        form.id = props.selectedEvent.id
        formReturning.id = props.selectedEvent.id
        formReturning.start = form.start
        formReturning.start_kms = props.selectedEvent.vehicle.kms
        formReturning.returned_ok = false
        formReturning.returned_condition = ''
    }
})
</script>

<template>
    <Modal :show="props.show" @close="$emit('close')">
        <section class="space-y-6 p-8 w-full" @contextmenu.prevent>
            <header>
                <section class="flex flex-col lg:flex-row justify-between gap-y-6">
                    <div class="group">
                        <h2 class="text-3xl text-center sm:text-left xl:text-4xl font-bold text-gray-900">Sobre esta
                            Requisição</h2>
                        <div
                            class="flex gap-x-2 text-muted-foreground opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 flex-shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                            </svg>
                            <small class="lg:my-auto">Alguns dados acerca desta requisição</small>
                        </div>
                    </div>
                    <ReservationStatus :reservation="props.selectedEvent" />
                </section>
            </header>

            <div class="mt-6 max-w-full" v-if="props.selectedEvent.previous_reservation">
                <PreviousReservation :previous-reservations="props.previousReservations"
                    :previous-reservation="props.selectedEvent.previous_reservation" />
            </div>
            <div class="mt-6 max-w-full flex flex-col sm:flex-row gap-x-4 gap-y-4">
                <div class="w-full">
                    <InputLabel value="De:" for="start" />
                    <FakeDateTimeInput disabled id="start" :date="(moment(props.selectedEvent.start).toDate())" />
                </div>
                <div class="w-full">
                    <InputLabel value="Até:" for="end" />
                    <FakeDateTimeInput disabled id="end" :date="(moment(props.selectedEvent.end).toDate())" />
                </div>
            </div>

            <div v-show="props.selectedEvent.creator.id !== props.selectedEvent.driver.id" class="mt-6 max-w-full">
                <InputLabel value="Agendado por" for="creator" />
                <FakeSelectInput disabled id="creator" :placeholder="props.selectedEvent.creator.name" />
            </div>

            <div v-show="props.selectedEvent.creator.id !== props.selectedEvent.driver.id" class="mt-6 max-w-full">
                <InputLabel value="Condutor" for="driver" />
                <FakeSelectInput disabled id="driver" :placeholder="props.selectedEvent.driver.name" />
            </div>

            <div v-show="props.selectedEvent.creator.id === props.selectedEvent.driver.id" class="mt-6 max-w-full">
                <InputLabel value="Agendado pelo condutor" for="driver" />
                <FakeSelectInput disabled id="driver" :placeholder="props.selectedEvent.driver.name" />
            </div>

            <div class="mt-6 max-w-full">
                <InputLabel value="Veículo" for="vehicle" />
                <FakeSelectInput disabled id="vehicle" :placeholder="props.selectedEvent.vehicle.plate.toUpperCase()" />
            </div>

            <div class="mt-6 max-w-full">
                <InputLabel value="Descrição" for="description" />
                <textarea disabled
                    class=" flex min-h-20 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                    id="description">{{ props.selectedEvent.description }}
        </textarea>
            </div>

            <div class="mt-6 max-w-full">
                <div
                    v-show="props.selectedEvent.status === 'denied' && authorized.includes(page.props.auth.user.role_id)">
                    <InputLabel value="Pretexto para cancelamento" for="reason_for_status_change" />
                    <textarea disabled
                        class="text-muted-foreground flex min-h-20 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                        id="reason_for_status_change">{{ props.selectedEvent.reason_for_status_change }}</textarea>
                </div>

                <div
                    v-show="props.selectedEvent.status === 'rescheduled' && authorized.includes(page.props.auth.user.role_id)">
                    <InputLabel value="Pretexto para reagendamento" for="reason_for_status_change" />
                    <textarea disabled
                        class="text-muted-foreground flex min-h-20 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                        id="reason_for_status_change">{{ props.selectedEvent.reason_for_status_change }}</textarea>

                </div>
            </div>

            <div class="mt-6 max-w-full"
                v-show="props.selectedEvent.status === 'done' && authorized.includes(page.props.auth.user.role_id)">
                <div>
                    <InputLabel value="Quilómetros entregues" for="returned_kms" />
                    <div class="text-muted-foreground flex w-fit rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                        id="returned_kms">{{ props.selectedEvent.returned_kms }} Km</div>
                </div>
                <div>
                    <InputLabel value="Quilómetros entregues" for="return_time" />
                    <div class="text-muted-foreground flex w-fit rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                        id="return_time">{{ props.selectedEvent.returned_at }}</div>
                </div>
            </div>


            <div v-if="props.selectedEvent.status === 'accepted' && props.selectedEvent.driver.id === page.props.auth.user.id"
                class="mt-6 max-w-full flex flex-col sm:flex-row gap-4">
                <div>
                    <InputLabel for="kms" value="Quilómetros anteriormente" />
                    <div id="kms" class="border-1">{{ props.selectedEvent.vehicle.kms }}Km</div>
                </div>
                <div class="flex items-center">
                    <ArrowBigRightDash v-if="width > 700" />
                    <ArrowBigDownDash v-else />
                </div>
                <div>
                    <InputLabel for="returned_kms" value="Quilómetros à entrega" />
                    <TextInput id="returned_kms" type="number" v-model="formReturning.returned_kms" />
                    <InputError class="flex items-end" :message="formReturning.errors.returned_kms" />
                </div>
            </div>

            <div class="mt-6 max-w-full"
                v-if="props.selectedEvent.status === 'accepted' && props.selectedEvent.driver.id === page.props.auth.user.id">
                <div class="flex gap-2 mb-4">
                    <InputLabel for="returned_ok" value="Houve alguma avaria?" />
                    <input class="size-4" type="checkbox" id="returning" v-model="formReturning.returned_ok" />
                </div>
                <InputLabel value="Descrição" for="description" />
                <Textarea :disabled="!formReturning.returned_ok" class="w-full" id="description"
                    v-model="formReturning.returned_condition"
                    :placeholder="formReturning.returned_condition" />

                <InputError class="flex items-end" :message="formReturning.errors.returned_at" />

            </div>

            <div class="mt-6 flex flex-col gap-y-4 justify-end gap-x-4 sm:flex-row">
                <InputError class="flex items-end" :message="formReturning.errors.returning" />
                <Button variant="secondary" @click="$emit('close')">
                    Mudei de Ideia
                </Button>

                <Button
                    v-if="props.selectedEvent.status === 'accepted' && props.selectedEvent.driver.id === page.props.auth.user.id"
                    @click="handleReturning">
                    Entregar
                </Button>
            </div>

        </section>
    </Modal>
</template>
