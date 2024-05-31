<script setup>
import FormSection from '@/Components/FormSection.vue';
import FormTwoColumn from '@/Components/FormTwoColumn.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Button from '@/Components/ui/button/Button.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const form = useForm({
    company: String,
})

onMounted(() => {
    form.company = null
})
</script>

<template>
    <Head title="Cartão Frota" />
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="space-y-6 p-8 w-full" @contextmenu.prevent>
                        <header>
                            <section class="flex flex-col lg:flex-row justify-between gap-y-6">
                                <div class="group">
                                    <h2 class="text-3xl text-center sm:text-left xl:text-4xl font-bold text-gray-900">
                                        Registar Cartão Frota
                                    </h2>
                                    <div
                                        class="flex gap-x-2 text-muted-foreground opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 flex-shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                        </svg>
                                        <small class="lg:my-auto">Preencha os campos com os dados do cartão frota a ser
                                            registado</small>
                                    </div>
                                </div>
                            </section>
                        </header>
                        <FormSection title="Cartão Frota" />
                        <FormTwoColumn>
                            <template #left>
                                <div>
                                    <InputLabel for="company" value="Cliente" />
                                    <TextInput id="company" type="text" class="w-full" v-model="form.company" />
                                    <InputError :message="form.errors.company" />
                                </div>
                            </template>

                            <template #right>
                                <div>
                                    <InputLabel for="company" value="Cliente" />
                                    <TextInput id="company" type="text" class="w-full" v-model="form.company" />
                                    <InputError :message="form.errors.company" />
                                </div>
                            </template>
                        </FormTwoColumn>

                        <div class="mt-6 flex flex-col gap-y-4 justify-end gap-x-4 sm:flex-row">
                            <Button variant="secondary">Mudei de Ideia</Button>

                            <Button @click="handleSubmit">Registar</Button>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>