<script setup>

import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
  show: Boolean,
  eventsList: Array,
})

const emit = defineEmits(['close']);

</script>

<template>
  <Modal v-model:show="props.show" @close="$emit('close')">
    <section class="space-y-6 p-8 w-full" @contextmenu.prevent>
      <header>
        <h2 class="text-xl font-bold text-gray-900">Lista de Requisições</h2>
      </header>
      <div v-for="reservation in eventsList" :key="reservation.id">{{reservation.title}}</div>

      <div class="mt-6 flex justify-end">

        <PrimaryButton
          class="ms-3"
          @click="$emit('close')"
        >
          Sair
        </PrimaryButton>

      </div>
    </section>
  </Modal>
</template>

<style scoped>

</style>
