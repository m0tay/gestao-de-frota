<script setup>
// import {format} from 'date-fns'
import {Calendar as CalendarIcon} from 'lucide-vue-next'

import {cn} from '@/lib/utils'
import {Button} from '@/Components/ui/button'
import {Calendar} from '@/Components/ui/calendar'
import {Popover, PopoverContent, PopoverTrigger,} from '@/Components/ui/popover'
import moment from "moment";

const props = defineProps({
  date: {
    type: Date,
    required: false,
  }
})

</script>


<template>
  <section>
    <div class="inline-flex items-center cursor-not-allowed text-muted-foreground
    whitespace-nowrap rounded-md text-sm
    ring-offset-background transition-colors
    focus-visible:outline-none focus-visible:ring-2
    focus-visible:ring-ring focus-visible:ring-offset-2
    disabled:pointer-events-none disabled:opacity-50
    border-input
    h-10 px-2  py-2 max-w-full min-w-full justify-start text-left font-normal bg-gray-50">
      <CalendarIcon class="mr-2 h-4 w-4"/>
      <span>{{ props.date ? (moment(date).format('DD MMM HH:mm')) : 'Sem data' }}</span>
    </div>
  </section>
</template>
