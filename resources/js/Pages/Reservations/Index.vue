<script setup>
import {ScheduleXCalendar} from '@schedule-x/vue'
import {
  createCalendar,
  viewDay,
  viewWeek,
  viewMonthGrid,
  viewMonthAgenda,
} from '@schedule-x/calendar'
import '@schedule-x/theme-default/dist/index.css'
import moment from "moment";
import {computed, ref} from "vue";
import UpdateReservationForm from "@/Pages/Reservations/Partials/UpdateReservationForm.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CreateReservationForm from "@/Pages/Reservations/Partials/CreateReservationForm.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {useWindowSize} from '@vueuse/core'
import ListReservations from "@/Pages/Reservations/Partials/ListReservations.vue";
import ViewReservation from "@/Pages/Reservations/Partials/ViewReservation.vue";

const {width} = useWindowSize()


const props = defineProps({
  reservations: Array,
  drivers: Array,
  vehicles: Array,
})

const showModalEdit = ref(false)
const showModalCreate = ref(false)
const showModalList = ref(false)
const showViewReservation = ref(false)
const selectedEvent = ref(null)
const eventsList = ref(false)

const closeModal = () => {
  showModalCreate.value = false
  showModalEdit.value = false
  showModalList.value = false
  showViewReservation.value = false
}

const handleAgendar = () => {
  showModalCreate.value = true
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
      showModalCreate.value = true

      //
      // const filteredEvents = props.reservations.filter(event => {
      //   const eventDate = moment(event.start).format('YYYY-MM-DD');
      //   return eventDate === date;
      // });
      //
      // if (!filteredEvents.length) return
      //
      // eventsList.value = filteredEvents;
      //
      // showModalList.value = true;
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

      if (calendarEvent.status === 'rescheduled') {
        console.log('rescheduled')
        showViewReservation.value = true
        return
      }

        if (calendarEvent.status === 'denied') {
        console.log('denied')
        showViewReservation.value = true
        return
      }

      if (calendarEvent.status === 'done') {
        console.log('done')
        showViewReservation.value = true
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
      <div v-show="width < 700" class="flex justify-center my-4">
        <PrimaryButton
          @click="handleAgendar"
        >Agendar
        </PrimaryButton>
      </div>

      <!--      <ScheduleXCalendar class="sm:h-screen" :calendar-app="calendarApp"/>-->
      <ScheduleXCalendar class="sm:h-screen"
                         :calendar-app="calendarApp"
      >
        <template #monthGridEvent="{ calendarEvent }">
          <div class="event px-2 mx-2 font-semibold text-nowrap rounded"
               :class="{ 'cursor-not-allowed': calendarEvent.status !== 'accepted',
                         'cursor-pointer': calendarEvent.status === 'accepted',
                          'bg-green-400': calendarEvent.status === 'accepted',
                          'bg-red-400': calendarEvent.status === 'denied',
                          'bg-green-200': calendarEvent.previous_reservation,
                          'bg-sky-400': calendarEvent.status === 'done',
                          'bg-amber-200': calendarEvent.status === 'rescheduled',
                          }">
            {{ calendarEvent.title }}

          </div>
        </template>
        <template #monthAgendaEvent="{ calendarEvent }">
          <div class="event m-2 p-2 font-semibold"
               :class="{ 'cursor-not-allowed': calendarEvent.status !== 'accepted',
                         'cursor-pointer': calendarEvent.status === 'accepted',
                          'bg-green-400': calendarEvent.status === 'accepted',
                          'bg-red-400': calendarEvent.status === 'denied',
                          'bg-green-200': calendarEvent.previous_reservation,
                          'bg-sky-400': calendarEvent.status === 'done',
                          'bg-amber-200': calendarEvent.status === 'rescheduled',
                          }">
            <div>{{ calendarEvent.title }}</div>
            <div class="font-normal text-gray-700">{{ moment(calendarEvent.start).format('HH[h]mm') }} até
              {{ moment(calendarEvent.end).format('HH[h]mm') }}
            </div>
          </div>
        </template>
        <template #timeGridEvent="{ calendarEvent }">
          <div class="event m-2 p-2 font-semibold"
               :class="{ 'cursor-not-allowed': calendarEvent.status !== 'accepted',
                         'cursor-pointer': calendarEvent.status === 'accepted',
                          'bg-green-400': calendarEvent.status === 'accepted',
                          'bg-red-400': calendarEvent.status === 'denied',
                          'bg-sky-400': calendarEvent.status === 'done',
                          'bg-amber-200': calendarEvent.status === 'rescheduled',
                          }">
            {{ calendarEvent.title }}
          </div>
        </template>
      </ScheduleXCalendar>
    </div>
  </AuthenticatedLayout>
  <UpdateReservationForm
    @close="closeModal"
    :show="showModalEdit"
    :selected-event
    :drivers
    :vehicles
  />
  <CreateReservationForm
    @close="closeModal"
    :show="showModalCreate"
  />
  <ListReservations
    @close="closeModal"
    :show="showModalList"
    :events-list
  />
  <ViewReservation
    @close="closeModal"
    :show="showViewReservation"
    :selected-event
  />
</template>
