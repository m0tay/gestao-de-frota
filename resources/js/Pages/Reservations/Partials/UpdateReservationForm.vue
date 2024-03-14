<script setup>
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


const props = defineProps({
  show: Boolean,
  selectedEvent: Object,
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
            <h2 class="text-xl font-bold text-gray-900">Reagendar Requisição</h2>
            <div class="flex items-start gap-x-2 text-muted-foreground">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                   stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>
              </svg>
              <small class="lg:my-auto">Altere as datas, condutor ou veículo para reagendar</small>
            </div>
          </div>
          <div class="group transition-all">
            <h2 class="text-xl font-bold text-gray-300 group-hover:text-gray-900">Status</h2>
            <div class="flex items-start gap-x-2 text-gray-300 group-hover:text-gray-900">
              <small v-if="props.selectedEvent.status === 'accepted'">Aceite</small>
              <small v-if="props.selectedEvent.status === 'denied'">Cancelado/Reagendado</small>
              <small v-if="props.selectedEvent.status === 'done'">Concluído</small>
            </div>
          </div>

        </section>
      </header>

      <div class="mt-6 max-w-full">
        <PreviousReservation v-show="props.selectedEvent.previous_reservation" :previous-reservation="props.selectedEvent.previous_reservation"/>
      </div>

      <div class="mt-6 max-w-full flex flex-col gap-x-4 gap-y-4">
        <div class="w-full">
          <InputLabel value="De:" for="start"/>
          <DateTimeInput id="start" v-model="form.start"/>
          <InputError :message="form.errors.start"/>
        </div>
        <div class="w-full">
          <InputLabel value="Até:" for="end"/>
          <DateTimeInput id="end" v-model="form.end"/>
          <InputError :message="form.errors.end"/>
        </div>
      </div>

      <div class="mt-6 max-w-full">
        <InputLabel value="Condutor" for="driver"/>
        <!--        <TextInput class="w-full bg-gray-50" id="driver" v-model="form.driver.id"/>-->
        <SelectInput id="driver" :list="drivers" v-model="form.driver.id" :placeholder="form.driver.name"/>
        <InputError :message="form.errors.driver"/>
      </div>

      <div class="mt-6 max-w-full">
        <InputLabel value="Veículo" for="vehicle"/>
        <!--        <TextInput class="w-full bg-gray-50" id="vehicle" v-model="form.vehicle.id"/>-->
        <SelectInput id="driver" :list="vehicles" v-model="form.vehicle.id" :placeholder="form.vehicle.plate"/>

        <InputError :message="form.errors.vehicle"/>
      </div>


      <div class="mt-6 max-w-full">
        <InputLabel value="Descrição" for="description"/>
        <!--        <TextInput class="w-full" id="description" v-model="form.description"/>-->
        <Textarea class="w-full" id="description" v-model="form.description" :placeholder="form.description"/>
        <InputError :message="form.errors.description"/>
      </div>
      <!--      <pre>{{ form.driver }}</pre>-->
      <!--      <pre>{{ form.creator }}</pre>-->
      <!--      <pre>{{ form.vehicle }}</pre>-->
      <div class="mt-6 flex justify-end">
        <SecondaryButton @click="$emit('close')">Mudei de Ideia</SecondaryButton>

        <PrimaryButton
          class="ms-3"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          @click="handleSubmit"
        >
          Reagendar
        </PrimaryButton>

      </div>
    </section>
  </Modal>
</template>
