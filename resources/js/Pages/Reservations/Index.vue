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
import {ref} from "vue";
import UpdateReservationForm from "@/Pages/Reservations/Partials/UpdateReservationForm.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CreateReservationForm from "@/Pages/Reservations/Partials/CreateReservationForm.vue";
import {Button} from "@/Components/ui/button/index.js";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useWindowSize } from '@vueuse/core'

const { width, height } = useWindowSize()


const props = defineProps({
  reservations: Array
})

const showModalEdit = ref(false)
const showModalCreate = ref(false)
const selectedEvent = ref(null)
const selectedDate = ref(null)

const closeModal = () => {
  showModalCreate.value = false
  showModalEdit.value = false
}

const handleAgendar = () => {
  // console.log('agendado!')
  showModalCreate.value = true
}



const calendarApp = createCalendar({
  selectedDate: moment.now(),
  views: [viewMonthAgenda, viewMonthGrid, viewWeek, viewDay],
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
    },

    /**
     * Is called when clicking somewhere in the time grid of a week or day view
     * */
    onClickDateTime(dateTime) {
      console.log('onClickDateTime', dateTime) // e.g. 2024-01-01 12:37
      showModalCreate.value = true
    },

    /**
     * Is called when an event is clicked
     * */
    onEventClick(calendarEvent) {
      console.log('onEventClick', calendarEvent)
      selectedEvent.value = calendarEvent
      selectedDate.value = calendarEvent.start
      showModalEdit.value = true
    },


    /**
     * Is called when an event is updated through drag and drop
     * */
    onEventUpdate(updatedEvent) {
      console.log('onEventUpdate', updatedEvent)
    },

    /**
     * Is called when:
     * 1. Selecting a date in the date picker
     * 2. Selecting a new view
     * */
    onRangeUpdate(range) {
      console.log('new calendar range start date', range.start)
      console.log('new calendar range end date', range.end)
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
        >Agendar</PrimaryButton>
      </div>

      <ScheduleXCalendar class="sm:h-screen" :calendar-app="calendarApp"/>
    </div>
  </AuthenticatedLayout>
  <UpdateReservationForm
    @close="closeModal"
    :show="showModalEdit"
    :selected-event
    :selected-date
  />
  <CreateReservationForm
    @close="closeModal"
    :show="showModalCreate"
  />
</template>
