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

const props = defineProps({
  previousReservation: Number,
})
</script>

<template>
  <Card>
    <CardHeader>
      <CardTitle>Requisição reagendada de {{ previousReservation }}</CardTitle>
      <CardDescription></CardDescription>
    </CardHeader>
    <CardContent>
      <div class="flex flex-col gap-y-8">
        <section class="flex flex-col gap-y-4 gap-x-8 sm:flex-row sm:justify-between w-full">
          <div class="w-full">
            <InputLabel value="De:" for="start"/>
            <FakeDateTimeInput class="w-full" id="start"/>
          </div>
          <div class="w-full">
            <InputLabel value="Até:" for="end"/>
            <FakeDateTimeInput class="w-full" id="end"/>
          </div>
        </section>
        <section class="flex flex-col gap-y-4 sm:flex-row sm:justify-between">
          <div class="flex items-center gap-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
            </svg>
            <p>Nuno Mineiro</p>
          </div>
          <div class="flex items-center gap-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/>
            </svg>
            <p>23-AW-56</p>
          </div>
        </section>
      </div>
    </CardContent>
<!--    <CardFooter>-->
<!--      Card Footer-->
<!--    </CardFooter>-->
  </Card>
</template>

<style scoped>

</style>
