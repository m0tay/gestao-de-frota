<script setup>
import { Button } from '@/Components/ui/button'
import { Calendar } from '@/Components/ui/calendar'
import { Popover, PopoverContent, PopoverTrigger, } from '@/Components/ui/popover'
import { cn } from '@/lib/utils'
import { ptBR } from 'date-fns/locale'
import { format } from 'date-fns'
import { Calendar as CalendarIcon } from 'lucide-vue-next'

const date = defineModel({
    type: Date,
    required: false,
})

// Function to check if a value is a valid date
const isValidDate = (d) => d instanceof Date && !isNaN(d);

// Use this function to safely format the date
const formatDate = (date) => isValidDate(date) ? format(date, "EEEEEE, dd 'de' MMMM HH:mm", { locale: ptBR }) : "Escolha uma data e hora";
</script>

<template>
    <Popover>
        <PopoverTrigger as-child>
            <Button :variant="'outline'" :class="cn(
                'w-full justify-start text-left font-normal bg-gray-50 border-opacity-10 ring-1 ring-gray-300/50',
                !date && 'text-muted-foreground',
            )">
                <CalendarIcon class="mr-2 h-4 w-4" />
                <span>{{ formatDate(date) }}</span>
            </Button>
        </PopoverTrigger>
        <PopoverContent class="w-auto p-0">
            <Calendar v-model="date" mode="datetime" />
        </PopoverContent>
    </Popover>
</template>
