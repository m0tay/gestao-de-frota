<script setup>
import Modal from "@/Components/Modal.vue";
import {ref} from "vue";
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
  id: props.reservation?.id,
  start: props.reservation?.start,
  end: props.reservation?.end,
  title: props.reservation?.title,
})


const emit = defineEmits(['close', 'update-reservation']);

const updatedReservation = ref({}); //  To capture changes locally

const handleSubmit = () => {

  form.put(route(`reservations.update`, {reservation: form.id}), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  })


  emit('update-reservation', updatedReservation.value); // Emit updated info
  emit('close'); // Close the modal
}


</script>

<template>
  <Modal v-model:show="props.show" @close="$emit('close')">
    <section class="space-y-6 p-8">
      <header>
        <h2 class="text-xl font-bold text-gray-900">{{ form.title }}</h2>
      </header>

      <div class="mt-6 max-w-full">
        <InputLabel for="title" value="Título" class="sr-only"/>

        <TextInput
          id="title"
          v-model="form.title"
          class="mt-1 block w-full"
          autofocus

        />

        <InputError :message="form.errors.title" class="mt-2"/>

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
