<script setup>
import { Button } from '@/Components/ui/button'
import { Calendar } from '@/Components/ui/calendar'
import { Popover, PopoverContent, PopoverTrigger, } from '@/Components/ui/popover'
import { cn } from '@/lib/utils'
import { format } from 'date-fns'
import { Calendar as CalendarIcon } from 'lucide-vue-next'
import { ref } from 'vue'

const date = ref(null)
</script>

<template>
    <Popover>
        <PopoverTrigger as-child>
            <Button :variant="'outline'" :class="cn(
                'w-[280px] justify-start text-left font-normal bg-gray-50',
                !date && 'text-muted-foreground',
            )">
                <CalendarIcon class="mr-2 h-4 w-4" />
                <span>{{ date ? format(date, 'dd MMM HH:mm') : "Escolha uma data e hora" }}</span>
            </Button>
        </PopoverTrigger>
        <PopoverContent class="w-auto p-0">
            <Calendar v-model="date" mode="datetime" />
        </PopoverContent>
    </Popover>
</template>

