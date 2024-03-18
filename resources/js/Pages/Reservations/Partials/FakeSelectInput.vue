<script setup>
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/Components/ui/select'

defineProps({
  placeholder: '',
})
</script>

<template>
  <Select>
    <SelectTrigger class="bg-gray-50">
      <SelectValue :placeholder/>
    </SelectTrigger>
  </Select>
</template>
