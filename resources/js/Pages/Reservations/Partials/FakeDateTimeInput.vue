<script setup>
// import {format} from 'date-fns'
import { Calendar as CalendarIcon } from 'lucide-vue-next'

import { format } from "date-fns"
import { ptBR } from "date-fns/locale"
import { useWindowSize } from '@vueuse/core';

const { width } = useWindowSize();

const props = defineProps({
  date: {
    type: Date,
    required: false,
  }
})

const isValidDate = (d) => d instanceof Date && !isNaN(d);
let formatDate;

if (width.value > 464) {
  formatDate = (date) => isValidDate(date) ? format(date, "dd 'de' MMMM HH:mm", { locale: ptBR }) : "Escolha uma data e hora";
} else {
  formatDate = (date) => isValidDate(date) ? format(date, "dd MMM HH:mm", { locale: ptBR }) : "Escolha uma data e hora";
}


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
      <CalendarIcon class="mr-2 h-4 w-4" />
      <span>{{ formatDate(date) }}</span>
    </div>
  </section>
</template>
