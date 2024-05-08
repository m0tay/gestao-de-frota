<script setup>
import DateTimeInput from "@/Components/DateTimeInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import SelectInput from "@/Components/SelectInput.vue";
import { Button } from "@/Components/ui/button/index.js";
import { Textarea } from "@/Components/ui/textarea/index.js";
import { reloadPage } from "@/lib/reloadPage";
import { useForm, usePage } from "@inertiajs/vue3";
import { useWindowSize } from "@vueuse/core";
import { addHours } from "date-fns";
import moment from "moment";
import { onBeforeUpdate, onUpdated, ref } from "vue";

const authorized = ref([1, 2]);

const page = usePage();

const props = defineProps({
    show: Boolean,
    clickedDate: Date,
    drivers: Array,
    vehicles: Array,
});

const { width } = useWindowSize();

const form = useForm({
    start: Date,
    end: Date,
    driver: Number,
    vehicle: {
        type: Number,
        id: null,
    },
    creator: Number,
    description: String,
});

const emit = defineEmits(["close"]);

const handleSubmit = () => {
    form.driver = props.drivers.find((driver) => driver.id === form.driver.id);
    form.creator = page.props.auth.user;

    form.start = addHours(form.start, 1);
    form.end = addHours(form.end, 1);

    form.post(route("reservation.schedule"), {
        onSuccess: () => {
            console.log(form);
            form.reset();
            emit("close");
            reloadPage();
        },
    });
};

onBeforeUpdate(() => {
    form.reset();
    form.clearErrors();
});

onUpdated(() => {
    const now = moment();
    const dateToUse =
        width.value < 700
            ? now
            : moment(props.clickedDate).hour(now.hour()).minute(now.minute());
    const minutes = dateToUse.minutes();
    const roundedMinutes = minutes + ((10 - (minutes % 10)) % 10);

    form.start = dateToUse.minutes(roundedMinutes).seconds(0).toDate();
    form.end = dateToUse.add(1, "hours").toDate();


    form.creator = page.props.auth.user;
    form.driver = page.props.auth.user;
    form.description = "";
    form.status = "accepted";
})
</script>

<template>
    <Modal v-model:show="props.show" @close="$emit('close')">
        <section class="space-y-6 p-8 w-full" @contextmenu.prevent>
            <header>
                <section class="flex flex-col lg:flex-row justify-between gap-y-6">
                    <div class="group">
                        <h2 class="text-3xl text-center sm:text-left xl:text-4xl font-bold text-gray-900">
                            Agendar Requisição
                        </h2>
                        <div
                            class="flex gap-x-2 text-muted-foreground opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 flex-shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                            </svg>
                            <small class="lg:my-auto">Preencha os campos abaixo para agendar um
                                veículo</small>
                        </div>
                    </div>
                </section>
            </header>

            <div class="mt-6 max-w-full flex flex-col sm:flex-row gap-x-4 gap-y-4">
                <div class="w-full">
                    <InputLabel value="De:" for="start" />
                    <DateTimeInput id="start" v-model="form.start" />
                    <InputError :message="form.errors.start" />
                </div>
                <div class="w-full">
                    <InputLabel value="Até:" for="end" />
                    <DateTimeInput id="end" v-model="form.end" />
                    <InputError :message="form.errors.end" />
                </div>
            </div>

            <div class="mt-6 max-w-full">
                <InputLabel value="Condutor" for="driver" />
                <SelectInput :disabled="!page.props.canSelectDriver" id="driver" :list="drivers"
                    v-model="form.driver.id" :placeholder="form.driver.name" />
                <InputError :message="form.errors.driver" />
            </div>

            <div class="mt-6 max-w-full">
                <InputLabel value="Veículo" for="vehicle" />
                <SelectInput id="vehicle" :list="vehicles" v-model="form.vehicle.id"
                    :placeholder="form.vehicle.plate" />
                <InputError :message="form.errors.vehicle" />
            </div>

            <div class="mt-6 max-w-full">
                <InputLabel value="Descrição" for="description" />
                <Textarea class="w-full" id="description" v-model="form.description" :placeholder="form.description" />
                <InputError :message="form.errors.description" />
            </div>
            <div class="mt-6 flex flex-col gap-y-4 justify-end gap-x-4 sm:flex-row">
                <Button variant="secondary" @click="$emit('close')">Mudei de Ideia</Button>

                <Button @click="handleSubmit"> Agendar </Button>
            </div>
        </section>
    </Modal>
</template>
