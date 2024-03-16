<script setup>

const props = defineProps({
  reservation: Object
})
</script>

<template>
<!--    <pre>id:{{props.reservation.id}}</pre>-->

  <div class="group transition-all flex flex-col justify-center items-center">
    <h2 class="text-xl font-bold text-gray-300 group-hover:text-gray-900">Status</h2>
    <div class="flex items-start gap-x-2 text-gray-300 group-hover:text-gray-900">
      <small v-show="props.reservation.status === 'accepted'">Aceite</small>
      <small v-show="props.reservation.status === 'denied'">Cancelado</small>
      <small v-show="props.reservation.status === 'rescheduled'">Reagendado</small>
      <small v-show="props.reservation.status === 'done'">Concluído</small>
    </div>
  </div>
</template>

<style scoped>

</style>
