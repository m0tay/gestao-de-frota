<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const showingNavigationDropdown = ref(false);

const authorized = ref([
    1,
    2,
])
</script>

<template>
    <div @contextmenu.prevent>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-0 sm:-my-px sm:ms-10 sm:flex">
                                <NavLink v-if="authorized.includes($page.props.auth.user.role_id)"
                                    :href="route('dashboard')" :active="route().current('dashboard')"
                                    :class="route().current('dashboard') ? 'text-indigo-700 bg-indigo-50' : ''">
                                    Dashboard
                                </NavLink>
                                <NavLink :href="route('agenda')" :active="route().current('agenda')"
                                    :class="route().current('agenda') ? 'bg-indigo-50 text-indigo-700 text-indigo' : ''">
                                    Agenda
                                </NavLink>

                                <div
                                    :class="route().current('refuellings.*')
                                        ? 'bg-indigo-50 text-indigo-700 sm:flex sm:items-center sm:ms-6 inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
                                        : 'hidden sm:flex sm:items-center sm:ms-6 items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'">

                                    <Dropdown>
                                        <template #trigger>
                                            <span :class="route().current('refuellings.*') ? 'text-indigo-700' : ''"
                                                class="inline-flex border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                Abastecimentos
                                            </span>
                                        </template>
                                        <template #content>
                                            <DropdownLink :href="route('refuellings.create')">Adicionar</DropdownLink>
                                            <DropdownLink :href="route('refuellings.index')">Ver todos</DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                                <div
                                    :class="route().current('vehicles.*')
                                        ? 'bg-indigo-50 text-indigo-700 sm:flex sm:items-center sm:ms-6 inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5  focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
                                        : 'hidden sm:flex sm:items-center sm:ms-6  items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'">

                                    <Dropdown>
                                        <template #trigger>
                                            <span :class="route().current('vehicles.*') ? 'text-indigo-700' : ''"
                                                class="inline-flex border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                Veículos
                                            </span>
                                        </template>
                                        <template #content>
                                            <DropdownLink :href="route('vehicles.create')">Adicionar</DropdownLink>
                                            <DropdownLink :href="route('vehicles.index')">Ver todos</DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                                <div
                                    :class="route().current('fleet_cards.*')
                                        ? 'bg-indigo-50 text-indigo-700 sm:flex sm:items-center sm:ms-6 inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
                                        : 'hidden sm:flex sm:items-center sm:ms-6 items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'">

                                    <Dropdown>
                                        <template #trigger>
                                            <span :class="route().current('fleet_cards.*') ? 'text-indigo-700' : ''"
                                                class="inline-flex border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                Cartão Frota
                                            </span>
                                        </template>
                                        <template #content>
                                            <DropdownLink :href="route('fleet_cards.create')">Adicionar</DropdownLink>
                                            <DropdownLink :href="route('fleet_cards.index')">Ver todos</DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                                <NavLink v-if="authorized.includes($page.props.auth.user.role_id)"
                                    :href="route('agenda')" :active="route().current('drivers')">
                                    Condutores
                                </NavLink>
                                <!-- <NavLink v-if="authorized.includes($page.props.auth.user.role_id)"
                                    :href="route('agenda')" :active="route().current('reminders')">
                                    Lembretes
                                </NavLink> -->
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Perfil</DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Sair
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex': !showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex': showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink v-if="authorized.includes($page.props.auth.user.role_id)"
                            :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('agenda')" :active="route().current('agenda')">
                            Agenda
                        </ResponsiveNavLink>
                        <div
                            class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                            <p>Abastecimentos</p>
                            <ResponsiveNavLink :href="route('refuellings.create')"
                                :active="route().current('refuellings.create')">
                                Adicionar
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('refuellings.index')"
                                :active="route().current('refuellings.index')">
                                Ver todos
                            </ResponsiveNavLink>
                        </div>
                        <div
                            class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                            <p>Veículos</p>
                            <ResponsiveNavLink :href="route('vehicles.create')"
                                :active="route().current('vehicles.create')">
                                Adicionar
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('vehicles.index')"
                                :active="route().current('vehicles.index')">
                                Ver todos
                            </ResponsiveNavLink>
                        </div>
                        <ResponsiveNavLink v-if="authorized.includes($page.props.auth.user.role_id)"
                            :href="route('agenda')" :active="route().current('drivers')">
                            Condutores
                        </ResponsiveNavLink>
                        <!-- <ResponsiveNavLink v-if="authorized.includes($page.props.auth.user.role_id)"
                            :href="route('agenda')" :active="route().current('reminders')">
                            Lembretes
                        </ResponsiveNavLink> -->
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> Perfil</ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Sair
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
