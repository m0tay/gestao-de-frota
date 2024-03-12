<script setup>
import Modal from "@/Components/Modal.vue";
import {ref, watch} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";


const props = defineProps({
  show: Boolean,// Define the type of calendarEvent
})

const form = useForm({
  start: Date,
  end: Date,
  title: String,
  vehicle: Object,
  driver: Object,
  creator: Object,
  status: 'accepted',
})


const emit = defineEmits(['close']);

const createdReservation = ref({}); //  To capture changes locally

const handleSubmit = () => {

  form.post(route('reservations.store'), {
    onSuccess: () => {
      console.log(form)
      form.reset()
      emit('close'); // Close the modal
    }
  })
}

watch(() => props.show, (newValue) => {
  if (!newValue) {
    form.reset()
  }
});
</script>

<template>
  <Modal v-model:show="props.show" @close="$emit('close')">
    <section class="space-y-6 p-8 w-full">
      <header>
        <h2 class="text-xl font-bold text-gray-900">Agendar nova requisição</h2>
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
        <TextInput class="w-full" id="driver" v-model="form.driver"/>
        <InputError :message="form.errors.driver"/>
      </div>

      <div class="mt-6 max-w-full">
        <InputLabel value="Veículo" for="vehicle"/>
        <TextInput class="w-full" id="vehicle" v-model="form.vehicle"/>
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
