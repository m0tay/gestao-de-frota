<script setup>

import {Button} from "@/Components/ui/button/index.js";
import Modal from "@/Components/Modal.vue";
import moment from "moment";

const props = defineProps({
    show: Boolean,
    eventsList: Array,
    clickedDate: Date,
})

const emit = defineEmits(['close']);

</script>

<template>
    <Modal v-model:show="props.show" @close="$emit('close')">
        <section class="space-y-6 p-8 w-full" @contextmenu.prevent>
            <header>
                <h2 class="text-xl font-bold text-gray-900">Agendamentos de {{moment(clickedDate, 'pt').format('DD [de] MMMM [de] YYYY')}}</h2>
                <section>
                    <Button>Agendar</Button>
                </section>
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
