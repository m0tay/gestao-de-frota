<script setup>
import {ScheduleXCalendar} from '@schedule-x/vue'
import {createCalendar, viewMonthAgenda, viewMonthGrid,} from '@schedule-x/calendar'
import '@schedule-x/theme-default/dist/index.css'
import moment from "moment"
import {ref} from "vue"
import UpdateReservationForm from "@/Pages/Reservations/Partials/UpdateReservationForm.vue"
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import CreateReservationForm from "@/Pages/Reservations/Partials/CreateReservationForm.vue"
import {useWindowSize} from '@vueuse/core'
import ViewReservation from "@/Pages/Reservations/Partials/ViewReservation.vue"
import {Button} from "@/Components/ui/button/index.js"
import ListReservations from "@/Pages/Reservations/Partials/ListReservations.vue"
import {usePage} from "@inertiajs/vue3"

const authorized = ref([
    1,
    2,
])

const {width} = useWindowSize()
const page = usePage()


const props = defineProps({
    reservations: Array,
    previousReservations: Array,
    drivers: Array,
    vehicles: Array,
})

const showModalEdit = ref(false)
const showModalCreate = ref(false)
const showModalList = ref(false)
const showModalViewReservation = ref(false)
const selectedEvent = ref(null)
const eventsList = ref(false)
const clickedDate = ref(null)

const closeModal = () => {
    showModalCreate.value = false
    showModalEdit.value = false
    showModalList.value = false
    showModalViewReservation.value = false
}

const handleAgendar = () => {
    showModalCreate.value = true
}

const handleListar = () => {
    showModalList.value = true
    eventsList.value = props.reservations
}

const reloadPage = () => {
    window.location.reload()
}

const calendarApp = createCalendar({
    selectedDate: moment.now(),
    // views: [viewMonthAgenda, viewMonthGrid, viewWeek, viewDay],
    views: [viewMonthAgenda, viewMonthGrid],
    defaultView: viewMonthGrid.name,
    events: [...props.reservations],
    locale: 'pt-BR',
    firstDayOfWeek: 0,
    callbacks: {
        /**
         * Is called when clicking a date in the month grid
         * */
        onClickDate(date) {
            console.log('onClickDate', date) // e.g. 2024-01-01

            // Convert the clicked date to a Moment.js object
            const onClickedDate = moment(date)

            const reservationsOnClickedDate = props.reservations.filter(r => moment(r.start).isSame(onClickedDate, 'day'))

            console.log(reservationsOnClickedDate)

            if (reservationsOnClickedDate.length >= 3) {
                eventsList.value = reservationsOnClickedDate
                clickedDate.value = onClickedDate
                showModalList.value = true
                return
            }

            if (onClickedDate.isSameOrAfter(moment(), 'day')) {
                clickedDate.value = onClickedDate
                showModalCreate.value = true
            }
        },

        // /**
        //  * Is called when clicking somewhere in the time grid of a week or day view
        //  * */
        // onClickDateTime(dateTime) {
        //   console.log('onClickDateTime', dateTime) // e.g. 2024-01-01 12:37
        //   // showModalCreate.value = true
        //   // showModalList.value = true
        // },

        /**
         * Is called when an event is clicked
         * */
        onEventClick(calendarEvent) {
            console.log('onEventClick', calendarEvent)

            selectedEvent.value = calendarEvent

            if (!authorized.value.includes(page.props.auth.user.role_id)) {
                showModalViewReservation.value = true
                return
            }


            if (calendarEvent.status === 'rescheduled') {
                console.log('rescheduled')
                showModalViewReservation.value = true
                return
            }

            if (calendarEvent.status === 'denied') {
                console.log('denied')
                showModalViewReservation.value = true
                return
            }

            if (calendarEvent.status === 'done') {
                console.log('done')
                showModalViewReservation.value = true
                return
            }

            console.log('accepted')

            showModalEdit.value = true
        },


        // /**
        //  * Is called when an event is updated through drag and drop
        //  * */
        // onEventUpdate(updatedEvent) {
        //   // console.log('onEventUpdate', updatedEvent)
        // },

        /**
         * Is called when:
         * 1. Selecting a date in the date picker
         * 2. Selecting a new view
         * */
        onRangeUpdate(range) {
            // console.log('new calendar range start date', range.start)
            // console.log('new calendar range end date', range.end)
        }
    },
})


</script>

<template>
    <AuthenticatedLayout>
        <div>
            <div v-show="width < 700" class="flex justify-center my-4 gap-x-4">
                <Button
                    @click="handleAgendar"
                >Agendar
                </Button>
                <Button
                    @click="handleListar"
                >Listar
                </Button>
                <Button
                    @click="reloadPage"
                >Atualizar
                </Button>
            </div>

            <!--      <ScheduleXCalendar class="sm:h-screen" :calendar-app="calendarApp"/>-->
            <ScheduleXCalendar :calendar-app="calendarApp"
                               class="h-screen"
            >
                <template #monthGridEvent="{ calendarEvent }">
                    <div :class="{
                          'bg-green-500 hover:bg-green-400': calendarEvent.status === 'accepted',
                          'bg-red-500 hover:bg-red-400': calendarEvent.status === 'denied',
                          'bg-sky-500 hover:bg-sky-400': calendarEvent.status === 'done',
                          'bg-amber-500 hover:bg-amber-400': calendarEvent.status === 'rescheduled',
                          }"
                         class="event px-2 mx-2 cursor-pointer font-semibold text-nowrap rounded">
                        {{ calendarEvent.title }}

                    </div>
                </template>
                <template #monthAgendaEvent="{ calendarEvent }">
                    <div :class="{
                          'bg-green-500 hover:bg-green-400': calendarEvent.status === 'accepted',
                          'bg-red-500 hover:bg-red-400': calendarEvent.status === 'denied',
                          'bg-sky-500 hover:bg-sky-400': calendarEvent.status === 'done',
                          'bg-amber-500 hover:bg-amber-400': calendarEvent.status === 'rescheduled',
                          }"
                         class="event m-2 cursor-pointer p-2 font-semibold">
                        <div>{{ calendarEvent.title }}</div>
                        <div class="font-normal text-gray-700">{{ moment(calendarEvent.start).format('HH[h]mm') }} até
                            {{ moment(calendarEvent.end).format('HH[h]mm') }}
                        </div>
                    </div>
                </template>
                <template #timeGridEvent="{ calendarEvent }">
                    <div :class="{
                          'bg-green-500 hover:bg-green-400': calendarEvent.status === 'accepted',
                          'bg-red-500 hover:bg-red-400': calendarEvent.status === 'denied',
                          'bg-sky-500 hover:bg-sky-400': calendarEvent.status === 'done',
                          'bg-amber-500 hover:bg-amber-400': calendarEvent.status === 'rescheduled',
                          }"
                         class="event m-2 cursor-pointer p-2 font-semibold">
                        {{ calendarEvent.title }}
                    </div>
                </template>
            </ScheduleXCalendar>
        </div>
    </AuthenticatedLayout>
    <
    <UpdateReservationForm
        :drivers
        :previous-reservations
        :selected-event
        :show="showModalEdit"
        :vehicles
        @close="closeModal"
    />
    <CreateReservationForm
        :clicked-date
        :drivers
        :show="showModalCreate"
        :vehicles
        @close="closeModal"
    />
    <ListReservations
        :events-list
        :clicked-date
        :show="showModalList"
        @close="closeModal"
    />
    <ViewReservation
        :previous-reservations
        :selected-event
        :show="showModalViewReservation"
        @close="closeModal"
    />
</template>
