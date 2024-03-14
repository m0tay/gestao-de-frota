<script setup>
import {format} from 'date-fns'
import {Calendar as CalendarIcon} from 'lucide-vue-next'

import {cn} from '@/lib/utils'
import {Button} from '@/Components/ui/button'
import {Calendar} from '@/Components/ui/calendar'
import {Popover, PopoverContent, PopoverTrigger,} from '@/Components/ui/popover'
import moment from "moment";

const date = defineProps({
  type: Date,
  required: true,
})
// const date = ref()

</script>


<template>
  <section>
    <div class="inline-flex items-center
    whitespace-nowrap rounded-md text-sm
    ring-offset-background transition-colors
    focus-visible:outline-none focus-visible:ring-2
    focus-visible:ring-ring focus-visible:ring-offset-2
    disabled:pointer-events-none disabled:opacity-50
    border-input hover:bg-accent hover:text-accent-foreground
    h-10 px-4 py-2 max-w-full min-w-full justify-start text-left font-normal bg-gray-50">
    <CalendarIcon class="mr-2 h-4 w-4"/>
      <span>22 Mar 9:30</span>
    </div>
  </section>
</template>
