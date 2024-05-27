<script setup>
import { Button } from '@/Components/ui/button'
import { Calendar } from '@/Components/ui/calendar'
import { Popover, PopoverContent, PopoverTrigger, } from '@/Components/ui/popover'
import { cn } from '@/lib/utils'
import { ptBR } from 'date-fns/locale'
import { format } from 'date-fns'
import { Calendar as CalendarIcon } from 'lucide-vue-next'

const props = defineProps({
    type: { type: String, required: false, default: 'datetime' },
    minDate: { type: String, required: false },
    maxDate: { type: String, required: false },
})

const date = defineModel({
    type: Date,
    required: false,
})

// Function to check if a value is a valid date
const isValidDate = (d) => d instanceof Date && !isNaN(d);

// Use this function to safely format the date
const formatDate = (date) => {
    const formatToUse = props.type === 'datetime' ? "EEEEEE, dd 'de' MMMM HH:mm" : "EEEEEE, dd 'de' MMMM";
    return isValidDate(date) ? format(date, formatToUse, { locale: ptBR }) : props.type === 'datetime' ? "Escolha uma data e hora" : "Escolha uma data";
}
</script>

<template>
    <Popover>
        <PopoverTrigger as-child>
            <Button :variant="'outline'" :class="cn(
                'w-full justify-start text-left font-normal border-opacity-10 ring-1 ring-gray-300/50',
                !date && 'text-muted-foreground',
            )">
                <CalendarIcon class="mr-2 h-4 w-4" />
                <span>{{ formatDate(date) }}</span>
            </Button>
        </PopoverTrigger>
        <PopoverContent class="w-auto p-0">
            <Calendar v-model="date" :mode="type" :min-date="minDate" :max-date="maxDate"/>
        </PopoverContent>
    </Popover>
</template>
