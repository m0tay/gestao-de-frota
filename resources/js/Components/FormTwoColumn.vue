<script setup>

</script>

<template>
    <div class="flex flex-col sm:flex-row gap-x-4">
        <div class="mt-6 sm:w-half gap-y-4 flex flex-col">
            <slot name="left" />
        </div>

        <div class="mt-6 sm:w-half gap-y-4 flex flex-col">
            <slot name="right" />
        </div>
    </div>
</template>
