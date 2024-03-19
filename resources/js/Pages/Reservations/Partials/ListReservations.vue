<script setup>

import {Button} from "@/Components/ui/button/index.js"
import Modal from "@/Components/Modal.vue"
import moment from "moment"
import {useWindowSize} from "@vueuse/core"
import {Card, CardContent, CardHeader, CardTitle,} from '@/Components/ui/card'
import FakeDateTimeInput from "@/Pages/Reservations/Partials/FakeDateTimeInput.vue"
import InputLabel from "@/Components/InputLabel.vue"
import {computed, ref} from "vue"
import {usePage} from "@inertiajs/vue3"

const {width} = useWindowSize()
const page = usePage()

const authorized = ref([
    1,
    2,
])


const props = defineProps({
    show: Boolean,
    eventsList: Array,
    clickedDate: Date,
})

const sortedEventsList = computed(() => {
    return props.eventsList.sort((a, b) => {
        // Compare start times
        if (a.start < b.start) return -1
        if (a.start > b.start) return 1

        // If start times are equal, compare end times
        if (a.end < b.end) return -1
        if (a.end > b.end) return 1

        // If both start and end times are equal, consider them equal
        return 0
    })
})

const emit = defineEmits(['close', 'schedule', 'view:selectedEventId'])

const isDateValid = (date) => {
    const providedDate = moment(date)

    return providedDate.isSameOrAfter(moment(), 'day')
}


const schedule = () => {
    emit('close')

    setTimeout(() => {
        emit('schedule')
    }, 100)
}

const view = (reservation) => {
    emit('close')
    setTimeout(() => {
        emit('view', reservation.id)
    }, 100)
}


</script>

<template>
    <Modal v-model:show="props.show" @close="$emit('close')">
        <section class="space-y-6 p-8 w-full" @contextmenu.prevent>
            <header class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-3xl text-center sm:text-left xl:text-4xl font-bold text-gray-900">Agendamentos de<br>
                    {{ moment(clickedDate, 'pt').format('DD [de] MM [de] YYYY') }}</h2>
                <Button v-show="isDateValid(clickedDate)" @click="schedule">Agendar</Button>
            </header>
            <div v-for="reservation in sortedEventsList" :key="reservation.id">
                <Card @click="() => view(reservation)">
                    <CardHeader>
                        <section class="flex gap-x-2 justify-between">
                            <CardTitle>{{ reservation.title.toUpperCase() }}</CardTitle>
                            <div class="group transition-all flex flex-col justify-center items-center">
                                <h2 class="text-xl font-bold text-gray-300 group-hover:text-gray-900">Status</h2>
                                <div class="flex items-start gap-x-2 text-gray-300 group-hover:text-gray-900">
                                    <small v-show="reservation.status === 'accepted'">Aceite</small>
                                    <small v-show="reservation.status === 'denied'">Cancelado</small>
                                    <small v-show="reservation.status === 'rescheduled'">Reagendado</small>
                                    <small v-show="reservation.status === 'done'">Concluído</small>
                                </div>
                            </div>
                        </section>
                    </CardHeader>
                    <CardContent>
                        <div class="flex flex-col gap-y-4">
                            <section class="flex flex-col gap-y-4 gap-x-8 sm:flex-row sm:justify-between w-full">
                                <div class="w-full">
                                    <InputLabel for="start" value="De:"/>
                                    <FakeDateTimeInput id="start" :date="(moment(reservation.start).toDate())"
                                                       class="w-full"/>
                                </div>
                                <div class="w-full">
                                    <InputLabel for="end" value="Até:"/>
                                    <FakeDateTimeInput id="end" :date="(moment(reservation.end).toDate())"
                                                       class="w-full"/>
                                </div>
                            </section>
                            <section class="flex flex-col gap-y-4 gap-x-8 sm:flex-row sm:justify-between w-full">
                                <div class="flex flex-col gap-y-4 w-full">
                                    <div
                                        class="flex items-center gap-x-2 bg-gray-50 text-muted-foreground px-3 py-2 rounded">
                                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor"
                                             stroke-width="1.5"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        </svg>
                                        <p class="text-pretty">{{ reservation.driver.name }}</p>
                                    </div>
                                    <div
                                        class="flex items-stretch gap-x-2 bg-gray-50 text-muted-foreground px-3 py-2 rounded">
                                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor"
                                             stroke-width="1.5"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        </svg>
                                        <p class="text-pretty">{{
                                                reservation.vehicle.plate.toUpperCase()
                                            }}<br>{{ reservation.vehicle.brand }} {{ reservation.vehicle.model }}</p>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-y-4 w-full">
                                    <div
                                        class="flex items-stretch gap-x-2 bg-gray-50 text-muted-foreground px-3 py-2 rounded h-full">
                                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor"
                                             stroke-width="1.5"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        </svg>
                                        <small class="text-pretty">{{
                                                reservation.description
                                            }}
                                        </small>
                                    </div>
                                </div>
                            </section>
                            <div v-show="authorized.includes(page.props.auth.user.role_id)"
                                 class="flex flex-col gap-y-4 w-full">
                                <div
                                    class="flex items-stretch gap-x-2 bg-gray-50 text-muted-foreground px-3 py-2 rounded">
                                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor"
                                         stroke-width="1.5"
                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98V19.5Z"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"/>
                                    </svg>
                                    <small class="text-pretty">{{
                                            reservation.reason_for_status_change || 'Sem pretexto.'
                                        }}</small>
                                </div>
                            </div>
                        </div>
                    </CardContent>
                </Card>
            </div>

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
