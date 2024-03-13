<script setup>
import Modal from "@/Components/Modal.vue";
import {onUpdated, ref, watch} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";


const props = defineProps({
  show: Boolean,
  reservation: Object, // Define the type of calendarEvent
})

const form = useForm({
  id: props.reservation.id,
  start: props.reservation.start,
  end: props.reservation.end,
  title: props.reservation.title,
  vehicle: props.reservation.vehicle,
  driver: props.reservation.driver,
  creator: props.reservation.creator,
})


const emit = defineEmits(['close', 'update-reservation']);

const updatedReservation = ref({}); //  To capture changes locally

const handleSubmit = () => {

  form.put(route('reservations.update', {reservation: form.id}), {
    onSuccess: () => {
      console.log(form)
      form.reset()
      emit('update-reservation', updatedReservation.value); // Emit updated info
      emit('close'); // Close the modal
    }
  })
}

onUpdated(() => {
  form.reset()
  form.clearErrors()
})
</script>

<template>
  <Modal v-model:show="props.show" @close="$emit('close')">
    <section class="space-y-6 p-8 w-full">
      <header>
        <h2 class="text-xl font-bold text-gray-900">[{{ props.reservation.vehicle.plate.toUpperCase() }}]
          {{ props.reservation.driver.name }} <span class="text-gray-200">{{ props.reservation.id }}</span> <span
            class="text-gray-200">{{ props.reservation.status }}</span></h2>
      </header>

      <div class="mt-6 max-w-full flex flex-col gap-x-4 gap-y-4">
        <div class="w-full">
          <InputLabel value="De:" for="start"/>
          <TextInput class="w-full" id="start" v-model="form.start"/>
        </div>
        <div class="w-full">
          <InputLabel value="Até:" for="end"/>
          <TextInput class="w-full" id="end" v-model="form.end"/>
        </div>
      </div>

      <div class="mt-6 max-w-full">
        <InputLabel value="Título" for="title"/>
        <TextInput class="w-full" id="title" v-model="form.title"/>
        <InputError :message="form.errors.title"/>
      </div>

      <div class="mt-6 max-w-full">
        <InputLabel value="Condutor" for="driver"/>
        <TextInput class="w-full" id="driver" v-model="form.driver.id"/>
        <InputError :message="form.errors.driver"/>
      </div>

      <div class="mt-6 max-w-full">
        <InputLabel value="Veículo" for="vehicle"/>
        <TextInput class="w-full" id="vehicle" v-model="form.vehicle.id"/>
        <InputError :message="form.errors.vehicle"/>
      </div>

      <div class="mt-6 flex justify-end">
        <SecondaryButton @click="$emit('close')"> Cancel</SecondaryButton>

        <PrimaryButton
          class="ms-3"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          @click="handleSubmit"
        >
          Atualizar
        </PrimaryButton>

      </div>
    </section>
  </Modal>
</template>
