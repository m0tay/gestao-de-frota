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
    list: Object,
})

const selectedItem = defineModel({
    type: Object,
    required: true,
});

const updateSelectedItem = (newValue) => {
    selectedItem.value = newValue;
};
</script>

<template>
    <Select v-model="selectedItem" @update:modelValue="updateSelectedItem">
        <SelectTrigger class="bg-gray-50">
            <SelectValue :placeholder/>
        </SelectTrigger>
        <SelectContent>
            <SelectGroup v-for="item in list" :key="item.id">
                <SelectItem :value="item.id">
                    <span v-if="item.plate">{{ item.plate.toUpperCase() }}</span>
                    <span v-if="item.name">{{ item.name }}</span>
                </SelectItem>
            </SelectGroup>
        </SelectContent>
    </Select>
</template>
