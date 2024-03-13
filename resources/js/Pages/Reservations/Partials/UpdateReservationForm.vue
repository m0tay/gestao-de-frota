<script setup>
import Modal from "@/Components/Modal.vue";
import {onMounted, onUpdated, ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SelectInput from "@/Components/SelectInput.vue";
import DateTimeInput from "@/Components/DateTimeInput.vue";


const props = defineProps({
  show: Boolean,
  selectedEvent: Object,
})

const form = useForm({})


const emit = defineEmits(['close']);

const updatedReservation = ref({}); //  To capture changes locally

const handleSubmit = () => {

  // form.put(route('reservations.update', {reservation: form.id}), {
  //   onSuccess: () => {
  //     console.log(form)
  //     form.reset()
  //     emit('close'); // Close the modal
  //   }
  // })
}
</script>

<template>
  <Modal v-model:show="props.show" @close="$emit('close')">
    <section class="space-y-6 p-8 w-full">
      <header>
        <h2 class="text-xl font-bold text-gray-900">Reagendar Requisição</h2>
      </header>
      <pre>{{ selectedEvent }}</pre>
      <!--      <div class="mt-6 max-w-full flex flex-col gap-x-4 gap-y-4">-->
      <!--        <div class="w-full">-->
      <!--          <InputLabel value="De:" for="start"/>-->
      <!--          <DateTimeInput id="start" v-model="form.start"/>-->
      <!--          <InputError :message="form.errors.start"/>-->
      <!--        </div>-->
      <!--        <div class="w-full">-->
      <!--          <InputLabel value="Até:" for="end"/>-->
      <!--          <DateTimeInput id="end" v-model="form.end"/>-->
      <!--          <InputError :message="form.errors.end"/>-->
      <!--        </div>-->
      <!--      </div>-->

      <!--      <div class="mt-6 max-w-full">-->
      <!--        <InputLabel value="Título" for="title"/>-->
      <!--        <TextInput class="w-full" id="title" v-model="form.title"/>-->
      <!--        <InputError :message="form.errors.title"/>-->
      <!--      </div>-->

      <!--      <div class="mt-6 max-w-full">-->
      <!--        <InputLabel value="Condutor" for="driver"/>-->
      <!--        <TextInput class="w-full" id="driver" v-model="form.driver.id"/>-->
      <!--        <InputError :message="form.errors.driver"/>-->
      <!--      </div>-->

      <!--      <div class="mt-6 max-w-full">-->
      <!--        <InputLabel value="Veículo" for="vehicle"/>-->
      <!--        <TextInput class="w-full" id="vehicle" v-model="form.vehicle.id"/>-->
      <!--        <InputError :message="form.errors.vehicle"/>-->
      <!--      </div>-->

      <div class="mt-6 flex justify-end">
        <SecondaryButton @click="$emit('close')">Mudei de Ideia</SecondaryButton>

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
