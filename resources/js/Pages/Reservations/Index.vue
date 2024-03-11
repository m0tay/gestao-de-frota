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

const props = defineProps({
  reservations: Array
})

const calendarApp = createCalendar({
  selectedDate: moment.now(),
  views: [viewMonthAgenda, viewMonthGrid, viewWeek, viewDay],
  defaultView: viewMonthGrid.name,
  events: [...props.reservations],
  locale: 'pt-BR',
  firstDayOfWeek: 0,
  dayBoundaries: {
    start: '08:00',
    end: '20:00',
  },
  callbacks: {
    /**
     * Is called when:
     * 1. Selecting a date in the date picker
     * 2. Selecting a new view
     * */
    onRangeUpdate(range) {
      console.log('new calendar range start date', range.start)
      console.log('new calendar range end date', range.end)
    },

    /**
     * Is called when an event is updated through drag and drop
     * */
    onEventUpdate(updatedEvent) {
      console.log('onEventUpdate', updatedEvent)
    },

    /**
     * Is called when an event is clicked
     * */
    onEventClick(calendarEvent) {
      console.log('onEventClick', calendarEvent)
    },

    /**
     * Is called when clicking a date in the month grid
     * */
    onClickDate(date) {
      console.log('onClickDate', date) // e.g. 2024-01-01
    },

    /**
     * Is called when clicking somewhere in the time grid of a week or day view
     * */
    onClickDateTime(dateTime) {
      console.log('onClickDateTime', dateTime) // e.g. 2024-01-01 12:37
    }
  },
})

</script>

<template>
  <h1 class=" flex items-center justify-center py-2 font-bold text-3xl">Agenda de Requisições</h1>
  <div>
    <ScheduleXCalendar class="sm:h-screen" :calendar-app="calendarApp"/>
  </div>
</template>
