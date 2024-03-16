<script setup>
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card'
import InputLabel from "@/Components/InputLabel.vue";
import FakeDateTimeInput from "@/Pages/Reservations/Partials/FakeDateTimeInput.vue";
import moment from 'moment';
import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";

const page = usePage()

const props = defineProps({
    previousReservation: {
        type: Number,
        required: true,
    },
    previousReservations: {
        type: Array,
        required: true,
    },
})

console.log('reservas', props.previousReservations)
console.log('reserva prévia', props.previousReservation)
// get current previous reservation of model being viewed

const pr = props.previousReservations.find(reservation => reservation.id === props.previousReservation);

console.log(pr)
</script>

<template>
    <Card v-show="pr">
        <CardHeader>
            <CardTitle>Requisição anterior</CardTitle>
                  <CardDescription>Agendado por {{pr.creator.name}}</CardDescription>
        </CardHeader>
        <CardContent>

            <div class="flex flex-col gap-y-4">
                <section class="flex flex-col gap-y-4 gap-x-8 sm:flex-row sm:justify-between w-full">
                    <div class="w-full">
                        <InputLabel value="De:" for="start"/>
                        <FakeDateTimeInput :date="(moment(pr.start).toDate())" class="w-full" id="start"/>
                    </div>
                    <div class="w-full">
                        <InputLabel value="Até:" for="end"/>
                        <FakeDateTimeInput :date="(moment(pr.end).toDate())" class="w-full" id="end"/>
                    </div>
                </section>
                <section class="flex flex-col gap-y-4 gap-x-8 sm:flex-row sm:justify-between w-full">
                    <div class="flex flex-col gap-y-4 w-full">
                        <div class="flex items-center gap-x-2 bg-gray-50 text-muted-foreground px-3 py-2 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 flex-shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                            </svg>
                            <p class="text-pretty">{{ pr.driver.name }}</p>
                        </div>
                        <div class="flex items-stretch gap-x-2 bg-gray-50 text-muted-foreground px-3 py-2 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 flex-shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/>
                            </svg>
                            <p class="text-pretty">{{ pr.vehicle.plate.toUpperCase() }}<br>{{ pr.vehicle.brand }} {{ pr.vehicle.model }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-4 w-full">
                        <div
                            class="flex items-stretch gap-x-2 bg-gray-50 text-muted-foreground px-3 py-2 rounded h-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 flex-shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                            </svg>
                            <small class="text-pretty">{{
                                    pr.description
                                }}
                            </small>
                        </div>
                    </div>
                </section>
                <div class="flex flex-col gap-y-4 w-full">
                    <div class="flex items-stretch gap-x-2 bg-gray-50 text-muted-foreground px-3 py-2 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6 flex-shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98V19.5Z"/>
                        </svg>
                        <small class="text-pretty">{{
                                pr.reason_for_status_change || 'Sem pretexto.'
                            }}</small>
                    </div>
                </div>
            </div>
        </CardContent>
        <!--    <CardFooter>-->
        <!--      Card Footer-->
        <!--    </CardFooter>-->
    </Card>
</template>

<style scoped>

</style>
