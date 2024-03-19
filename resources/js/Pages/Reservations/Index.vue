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
import {Tooltip, TooltipContent, TooltipProvider, TooltipTrigger} from '@/Components/ui/tooltip'
import {Card, CardContent, CardHeader, CardTitle} from "@/Components/ui/card/index.js";
import FakeDateTimeInput from "@/Pages/Reservations/Partials/FakeDateTimeInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

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

const isDateValid = (date) => {
    const providedDate = moment(date);

    return providedDate.isSameOrAfter(moment(), 'day');
};


const closeModal = () => {
    showModalCreate.value = false
    showModalEdit.value = false
    showModalList.value = false
    showModalViewReservation.value = false
}

const handleSchedule = () => {
    if (!isDateValid(clickedDate.value)) return;

    showModalCreate.value = true;
};

const handleView = (selectedEventId) => {
    const eventToOpen = props.reservations.find(event => event.id === selectedEventId);
    selectedEvent.value = eventToOpen;
    showModalViewReservation.value = true;
};


const handleEnlist = () => {
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

            const onClickedDate = moment(date);

            const reservationsOnClickedDate = props.reservations.filter(r => moment(r.start).isSame(onClickedDate, 'day') || moment(r.end).isSame(onClickedDate, 'day'));


            console.log(reservationsOnClickedDate);

            if (reservationsOnClickedDate.length >= 3) {
                eventsList.value = reservationsOnClickedDate;
                clickedDate.value = onClickedDate;
                showModalList.value = true;
                return;
            }

            if (!isDateValid(date)) return;

            clickedDate.value = onClickedDate;
            showModalCreate.value = true;
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
                    @click="handleSchedule"
                >Agendar
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
                        <TooltipProvider>
                            <Tooltip>
                                <TooltipTrigger>{{ calendarEvent.title }}</TooltipTrigger>
                                <TooltipContent class="w-[400px]">
                                    <Card :class="{
                          'bg-gradient-to-r from-green-600 to-green-500': calendarEvent.status === 'accepted',
                          'bg-gradient-to-r from-red-600 to-red-500': calendarEvent.status === 'denied',
                          'bg-gradient-to-r from-sky-600 to-sky-500': calendarEvent.status === 'done',
                          'bg-gradient-to-r from-amber-600 to-amber-500': calendarEvent.status === 'rescheduled',
                          }">
                                        <CardHeader>
                                            <CardTitle class="text-pretty text-accent">{{
                                                    calendarEvent.title.toUpperCase()
                                                }}
                                            </CardTitle>
                                        </CardHeader>
                                        <CardContent>
                                            <div class="flex flex-col gap-y-4">
                                                <section class="flex gap-y-4 gap-x-2 justify-evenly  w-full">
                                                    <div class="w-full">
                                                        <InputLabel class="text-white" for="start" value="De:"/>
                                                        <FakeDateTimeInput
                                                            id="start"
                                                            :date="(moment(calendarEvent.start).toDate())" class="w-full"/>
                                                    </div>
                                                    <div class="w-full">
                                                        <InputLabel class="text-white" for="end" value="Até:"/>
                                                        <FakeDateTimeInput id="end"
                                                                           :date="(moment(calendarEvent.end).toDate())" class="w-full"/>
                                                    </div>
                                                </section>
                                            </div>
                                        </CardContent>
                                    </Card>
                                </TooltipContent>
                            </Tooltip>
                        </TooltipProvider>

                    </div>
                </template>
                <template #monthAgendaEvent="{ calendarEvent }">
                    <div
                        class="event m-2 cursor-pointer p-2 font-semibold">
                        <Card :class="{
                          'bg-gradient-to-r from-green-600 to-green-500': calendarEvent.status === 'accepted',
                          'bg-gradient-to-r from-red-600 to-red-500': calendarEvent.status === 'denied',
                          'bg-gradient-to-r from-sky-600 to-sky-500': calendarEvent.status === 'done',
                          'bg-gradient-to-r from-amber-600 to-amber-500': calendarEvent.status === 'rescheduled',
                          }">
                            <CardHeader>
                                <CardTitle class="text-pretty text-accent">{{
                                        calendarEvent.title.toUpperCase()
                                    }}
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div class="flex flex-col gap-y-4">
                                    <section class="flex gap-y-4 gap-x-2  w-full">
                                        <div class="w-full">
                                            <InputLabel class="text-accent" for="start" value="De:"/>
                                            <FakeDateTimeInput id="start"
                                                               :date="(moment(calendarEvent.start).toDate())" class="w-full"/>
                                        </div>
                                        <div class="w-full">
                                            <InputLabel class="text-accent" for="end" value="Até:"/>
                                            <FakeDateTimeInput id="end"
                                                               :date="(moment(calendarEvent.end).toDate())" class="w-full"/>
                                        </div>
                                    </section>
                                </div>
                            </CardContent>
                        </Card>
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
        :clicked-date
        :events-list
        :show="showModalList"
        @close="closeModal"
        @schedule="handleSchedule"
        @view="handleView"
    />
    <ViewReservation
        :previous-reservations
        :selected-event
        :show="showModalViewReservation"
        @close="closeModal"
    />
</template>
