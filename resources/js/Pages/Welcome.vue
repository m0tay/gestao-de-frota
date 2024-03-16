<script setup>
import {Head, Link} from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome"/>

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            >Dashboard
            </Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Log in
                </Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Register
                </Link
                >
            </template>
        </div>

        <div class="max-w-7xl flex justify-center items-center p-6 lg:p-8">
            <div class="flex justify-center flex-col">

                <svg  xmlns="http://www.w3.org/2000/svg" class="h-48 w-auto"
                     viewBox="0 0 900.000000 900.000000" preserveAspectRatio="xMidYMid meet">
                    <g transform="translate(0.000000,900.000000) scale(0.100000,-0.100000)" fill="#1d7ba8"
                       stroke="none">
                        <path
                            d="M2970 8124 c-35 -11 -124 -14 -417 -14 l-373 0 -1 -962 c0 -530 -3 -1325 -5 -1768 -18 -3349 -18 -3588 -2 -3627 56 -134 77 -175 122 -236 48 -63 149 -147 179 -147 7 0 22 -6 33 -14 11 -8 66 -26 122 -40 l101 -26 719 0 c595 0 722 2 731 14 8 9 10 176 9 602 l-3 589 -410 5 c-225 3 -415 8 -421 12 -7 5 -13 260 -17 845 -4 461 -10 985 -14 1165 l-6 327 27 11 c18 7 414 10 1196 10 1046 0 1170 -2 1184 -16 14 -13 15 -44 11 -227 -2 -117 -5 -632 -6 -1146 0 -514 -5 -945 -10 -958 l-9 -23 -413 0 c-308 0 -416 -3 -425 -12 -9 -9 -12 -155 -12 -595 l0 -583 26 -11 c18 -6 290 -9 773 -7 l746 3 90 38 c49 21 117 55 150 75 62 38 185 156 185 177 0 7 7 18 15 25 8 7 15 21 15 32 0 10 7 33 16 50 15 28 16 124 15 972 -2 1812 -12 2939 -27 2961 -8 11 -14 29 -14 42 0 12 -4 24 -9 27 -5 4 -19 27 -31 52 -31 63 -154 190 -210 215 -25 12 -58 27 -75 35 -76 35 -150 36 -1658 38 -1461 1 -1489 1 -1503 20 -12 17 -14 156 -15 900 0 485 0 939 1 1009 1 185 9 177 -183 176 -102 0 -167 -5 -197 -15z m226 -25 c3 -5 -20 -9 -50 -9 -31 0 -56 4 -56 9 0 12 98 12 106 0z m114 -14 c0 -14 -4 -25 -9 -25 -10 0 -21 36 -13 44 12 13 22 5 22 -19z"/>
                    </g>
                </svg>
                <h1 class="text-4xl sm:text-7xl font-black">Gestão de Frota</h1>
            </div>


        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
