<script setup>


const props = defineProps({
    title: { type: String, required: false },
    noBar: { type: Boolean, required: false, default: false },
})
</script>

<template>
    <div>
        <h2 class="text-left font-bold">{{ props.title }}</h2>
        <hr class="border-t border-gray-300" v-if="!props.noBar" />
    </div>
</template>

