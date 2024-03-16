<script setup xmlns="http://www.w3.org/1999/html">
import Modal from "@/Components/Modal.vue";
import {onBeforeUpdate, onMounted, onUpdated, ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SelectInput from "@/Components/SelectInput.vue";
import DateTimeInput from "@/Components/DateTimeInput.vue";
import moment from "moment";
import {Textarea} from "@/Components/ui/textarea/index.js";
import PreviousReservation from "@/Pages/Reservations/Partials/PreviousReservation.vue";
import FakeDateTimeInput from "@/Pages/Reservations/Partials/FakeDateTimeInput.vue";
import FakeSelectInput from "@/Pages/Reservations/Partials/FakeSelectInput.vue";
import ReservationStatus from "@/Pages/Reservations/Partials/ReservationStatus.vue";


const props = defineProps({
  show: Boolean,
  selectedEvent: Object,
  previousReservations: Array,
  drivers: Array,
  vehicles: Array,
})

const form = useForm({
  start: Date,
  end: Date,
  driver: Number,
  vehicle: Number,
  creator: Number,
  description: String,
  id: Number,
})


const emit = defineEmits(['close']);


const handleSubmit = () => {

  form.put(route('reservations.update', {reservation: props.selectedEvent.id}), {
    onSuccess: () => {
      console.log(form)
      form.reset()
      emit('close'); // Close the modal
    }
  })
}

onBeforeUpdate(() => {
  form.reset()
  form.clearErrors()
  form.start = moment(props.selectedEvent.start).toDate()
  form.end = moment(props.selectedEvent.end).toDate()
  form.creator = props.selectedEvent.creator
  form.vehicle = props.selectedEvent.vehicle
  form.driver = props.selectedEvent.driver
  form.description = props.selectedEvent.description
  form.id = props.selectedEvent.id
})

</script>

<template>
  <Modal :show="props.show" @close="$emit('close')">
    <section class="space-y-6 p-8 w-full" @contextmenu.prevent>
      <header>
        <section class="flex flex-col lg:flex-row justify-between">
          <div>
            <h2 class="text-3xl text-center xl:text-4xl font-bold text-gray-900">Sobre esta Requisição</h2>
<!--            <div class="flex items-start gap-x-2 text-muted-foreground">-->
<!--              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"-->
<!--                   stroke="currentColor" class="w-6 h-6">-->
<!--                <path stroke-linecap="round" stroke-linejoin="round"-->
<!--                      d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>-->
<!--              </svg>-->
<!--              <small v-if="props.selectedEvent.status === 'rescheduled'" class="lg:my-auto">Esta requisição foi-->
<!--                reagendada.</small>-->
<!--              <small v-if="props.selectedEvent.status === 'denied'" class="lg:my-auto">Esta requisição foi-->
<!--                cancelada.</small>-->
<!--              <small v-if="props.selectedEvent.status === 'done'" class="lg:my-auto">Esta requisição está-->
<!--                concluída.</small>-->
<!--            </div>-->
          </div>
          <ReservationStatus :reservation="props.selectedEvent"/>

        </section>
      </header>

      <div class="mt-6 max-w-full">
<!--        <PreviousReservation v-show="props.selectedEvent.previous_reservation"-->
<!--                             :previous-reservations="props.previousReservations"-->
<!--                             :previous-reservation="props.selectedEvent.previous_reservation"/>-->
      </div>
      <div class="mt-6 max-w-full flex flex-col sm:flex-row gap-x-4 gap-y-4">
        <div class="w-full">
          <InputLabel value="De:" for="start"/>
          <FakeDateTimeInput disabled id="start" :date="(moment(props.selectedEvent.start).toDate())"/>
        </div>
        <div class="w-full">
          <InputLabel value="Até:" for="end"/>
          <FakeDateTimeInput disabled id="end" :date="(moment(props.selectedEvent.end).toDate())"/>
        </div>
      </div>

      <div class="mt-6 max-w-full">
        <InputLabel value="Condutor" for="driver"/>
        <FakeSelectInput disabled id="driver" :placeholder="props.selectedEvent.driver.name" />

      </div>

      <div class="mt-6 max-w-full">
        <InputLabel value="Veículo" for="vehicle"/>
        <FakeSelectInput disabled id="vehicle" :placeholder="props.selectedEvent.vehicle.plate.toUpperCase()" />
      </div>


      <div class="mt-6 max-w-full">
        <InputLabel value="Descrição" for="description"/>
        <textarea disabled
                  class=" flex min-h-20 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                  id="description">{{props.selectedEvent.description}}
        </textarea>
      </div>

      <div class="mt-6 flex justify-end">

        <PrimaryButton
          class="ms-3"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          @click="$emit('close')"
        >
          Sair
        </PrimaryButton>

      </div>

    </section>
  </Modal>
</template>
