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
                    <span v-if="item.plate" class="flex gap-x-2 items-center"><img :src="'https://picsum.photos/'+item.id+'/256'" class="w-8 h-8 rounded-full" alt="">{{ item.plate.toUpperCase() }}</span>
                    <span v-if="item.name" class="flex gap-x-2 items-center"><img :src="`https://randomuser.me/api/portraits/thumb/men/${item.id}.jpg`" class="w-8 h-8 rounded-full" alt="">{{ item.name }}</span>
                </SelectItem>
            </SelectGroup>
        </SelectContent>
    </Select>
</template>
