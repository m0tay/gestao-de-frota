<script setup>

import {Button} from "@/Components/ui/button/index.js";
import Modal from "@/Components/Modal.vue";
import moment from "moment";
import {useWindowSize} from "@vueuse/core";

const {width} = useWindowSize()


const props = defineProps({
    show: Boolean,
    eventsList: Array,
    clickedDate: Date,
})

const emit = defineEmits(['close', 'open']);

const isDateValid = (date) => {
    // Convert the provided date to a Moment.js object
    const providedDate = moment(date);

    // Check if the provided date is the same or after the current date
    return providedDate.isSameOrAfter(moment(), 'day');
};


const handleAgendar = () => {
    emit('close');

    setTimeout(() => {
        emit('open');
    }, 100);
}

</script>

<template>
    <Modal v-model:show="props.show" @close="$emit('close')">
        <section class="space-y-6 p-8 w-full" @contextmenu.prevent>
            <header class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-3xl text-center sm:text-left xl:text-4xl font-bold text-gray-900">Agendamentos de<br>
                    {{ moment(clickedDate, 'pt').format('DD [de] MM [de] YYYY') }}</h2>
                <Button v-show="isDateValid(clickedDate)" @click="handleAgendar">Agendar</Button>
            </header>
            <div v-for="reservation in eventsList" :key="reservation.id">{{ reservation.title }}</div>

            <div class="mt-6 flex justify-end">

                <Button
                    @click="$emit('close')"
                >
                    Sair
                </Button>

            </div>
        </section>
    </Modal>
</template>

<style scoped>

</style>
