<script setup>
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/Components/ui/select'
import { Badge } from '@/Components/ui/badge'
import { ref } from "vue";

const authorized = ref([
    1,
    2,
])

defineProps({
    placeholder: '',
    list: Array,
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
        <SelectTrigger>
            <SelectValue :placeholder />
        </SelectTrigger>
        <SelectContent>
            <SelectGroup v-for="(item, i) in list" :key="i">
                <SelectItem :value="item">
                    <span class="flex gap-x-2 items-center">
                        {{ item }}
                    </span>
                </SelectItem>
            </SelectGroup>
        </SelectContent>
    </Select>
</template>
