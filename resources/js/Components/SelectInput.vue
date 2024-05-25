<script setup>
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/Components/ui/select'
import {Badge} from '@/Components/ui/badge'
import {ref} from "vue";

const authorized = ref([
    1,
    2,
])

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
        <SelectTrigger class="">
            <SelectValue :placeholder/>
        </SelectTrigger>
        <SelectContent>
            <SelectGroup v-for="item in list" :key="item.id">
                <SelectItem :value="item.id">
                    <span v-if="item.plate" class="flex gap-x-2 items-center">
                        <img :src="'https://picsum.photos/'+item.id+'/100'" class="w-8 h-8 rounded-full" alt="">
                        {{ item.plate.toUpperCase() }}
                        <Badge :class="{'bg-purple-500 text-white': item.company === 'robowork',
                                        'bg-sky-500 text-white': item.company === 'roboplan',}
                        ">
                            {{ item.company.charAt(0).toUpperCase()+item.company.slice(1) }}</Badge>
                    </span>
                    <span v-if="item.name" class="flex gap-x-2 items-center"><img
                        :src="`https://randomuser.me/api/portraits/thumb/men/${item.id}.jpg`"
                        class="w-8 h-8 rounded-full" alt="">{{ item.name }}
                    <Badge v-if="authorized.includes(item.role_id)" class="bg-orange-500 text-white">
                            Gestor
                    </Badge>
                    </span>
                </SelectItem>
            </SelectGroup>
        </SelectContent>
    </Select>
</template>
