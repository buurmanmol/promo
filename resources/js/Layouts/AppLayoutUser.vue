<!--
  This example requires Tailwind CSS v2.0+

  This example requires some changes to your config:

  ```
  // tailwind.config.js
  const colors = require('tailwindcss/colors')

  module.exports = {
    // ...
    theme: {
      extend: {
        colors: {
          cyan: colors.cyan,
        }
      }
    },
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ]
  }
  ```
-->
<template>
    <div class="h-screen flex overflow-hidden bg-gray-100">
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog as="div" static class="fixed inset-0 flex z-40 lg:hidden" @close="sidebarOpen = false" :open="sidebarOpen">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
                    <DialogOverlay class="fixed inset-0 bg-gray-600 bg-opacity-75" />
                </TransitionChild>
                <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
                    <div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-azure-radiance-700">
                        <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
                            <div class="absolute top-0 right-0 -mr-12 pt-2">
                                <button class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" @click="sidebarOpen = false">
                                    <span class="sr-only">Close sidebar</span>
                                    <XIcon class="h-6 w-6 text-white" aria-hidden="true" />
                                </button>
                            </div>
                        </TransitionChild>
                        <div class="flex-shrink-0 flex items-center px-4">
                            <img class="h-8 w-auto" src="/images/logo.png" alt="Promofix logo" />
                        </div>
                        <nav class="mt-5 flex-shrink-0 h-full divide-y divide-cyan-800 overflow-y-auto" aria-label="Sidebar">
                            <div class="px-2 space-y-1">
                                <a v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-azure-radiance-800 text-white' : 'text-cyan-100 hover:text-white hover:bg-azure-radiance-600', 'group flex items-center px-2 py-2 text-base font-medium rounded-md']" :aria-current="item.current ? 'page' : undefined">
                                    <component :is="item.icon" class="mr-4 h-6 w-6 text-cyan-200" aria-hidden="true" />
                                    {{ item.name }}
                                </a>
                            </div>
                            <div class="mt-6 pt-6">
                                <div class="px-2 space-y-1">
                                    <a v-for="item in secondaryNavigation" :key="item.name" :href="item.href" class="group flex items-center px-2 py-2 text-base font-medium rounded-md text-cyan-100 hover:text-white hover:bg-azure-radiance-600">
                                        <component :is="item.icon" class="mr-4 h-6 w-6 text-cyan-200" aria-hidden="true" />
                                        {{ item.name }}
                                    </a>
                                </div>
                            </div>
                        </nav>
                    </div>
                </TransitionChild>
                <div class="flex-shrink-0 w-14" aria-hidden="true">
                    <!-- Dummy element to force sidebar to shrink to fit close icon -->
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:flex lg:flex-shrink-0">
            <div class="flex flex-col w-64">
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div class="flex flex-col flex-grow bg-azure-radiance-700 pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-4">
                        <img class="h-8 w-auto" src="/images/logo.png" alt="Easywire logo" />
                    </div>
                    <nav class="mt-5 flex-1 flex flex-col divide-y divide-cyan-800 overflow-y-auto" aria-label="Sidebar">
                        <div class="px-2 space-y-1">
                            <a v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-azure-radiance-800 text-white' : 'text-cyan-100 hover:text-white hover:bg-azure-radiance-600', 'group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md']" :aria-current="item.current ? 'page' : undefined">
                                <component :is="item.icon" class="mr-4 h-6 w-6 text-cyan-200" aria-hidden="true" />
                                {{ item.name }}
                            </a>
                        </div>
                        <div class="mt-6 pt-6">
                            <div class="px-2 space-y-1">
                                <a v-for="item in secondaryNavigation" :key="item.name" :href="item.href" class="group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md text-cyan-100 hover:text-white hover:bg-azure-radiance-600">
                                    <component :is="item.icon" class="mr-4 h-6 w-6 text-cyan-200" aria-hidden="true" />
                                    {{ item.name }}
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-auto focus:outline-none">
            <div class="relative z-10 flex-shrink-0 flex h-16 bg-white border-b border-gray-200 lg:border-none">
                <button class="px-4 border-r border-gray-200 text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500 lg:hidden" @click="sidebarOpen = true">
                    <span class="sr-only">Open sidebar</span>
                    <MenuAlt1Icon class="h-6 w-6" aria-hidden="true" />
                </button>
                <!-- Search bar -->
                <div class="flex-1 px-4 flex justify-between sm:px-6 lg:max-w-6xl lg:mx-auto lg:px-8">
                    <div class="flex-1 flex">
                       <button class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-azure-radiance-600 hover:bg-azure-radiance-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500" v-if="user.is_admin">Admin dashboard</button>
                    </div>
                    <div class="ml-4 flex items-center md:ml-6">
                        <button class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                            <span class="sr-only">View notifications</span>
                            <BellIcon class="h-6 w-6" aria-hidden="true" />
                        </button>

                        <!-- Profile dropdown -->
                        <Menu as="div" class="ml-3 relative">
                            <div>
                                <MenuButton class="max-w-xs bg-white rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 lg:p-2 lg:rounded-md lg:hover:bg-gray-50">
                                    <img class="h-8 w-8 rounded-full" :src="user.profile_photo_path" alt="" />
                                    <span class="hidden ml-3 text-gray-700 text-sm font-medium lg:block"><span class="sr-only">Open user menu for </span>{{ user.first_name }} {{user.last_name}}</span>
                                    <ChevronDownIcon class="hidden flex-shrink-0 ml-1 h-5 w-5 text-gray-400 lg:block" aria-hidden="true" />
                                </MenuButton>
                            </div>
                            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                <MenuItems class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <MenuItem v-slot="{ active }">
                                        <a href="/user/profile" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Your Profile</a>
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                        <Link  :class="[active ? 'bg-gray-100' : '', 'block px-4 w-full text-left py-2 text-sm text-gray-700']" href="/logout" method="post" as="button" type="button">Logout</Link>
                                    </MenuItem>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>
            <main class="flex-1 relative pb-8 z-0 overflow-y-auto">
                <!-- Page header -->
                <div class="bg-white shadow">
                    <div class="px-4 sm:px-6 lg:max-w-6xl lg:mx-auto lg:px-8">
                        <div class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
                            <div class="flex-1 min-w-0">
                                <!-- Profile -->
                                <div class="flex items-center">
                                    <img class="hidden h-16 w-16 rounded-full sm:block" :src="user.profile_photo_path" alt="" />
                                    <div>
                                        <div class="flex items-center">
                                            <img class="h-16 w-16 rounded-full sm:hidden" :src="user.profile_photo_path" alt="" />
                                            <h1 class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate">
                                                Hallo, {{ user.first_name }} {{user.last_name}}
                                            </h1>
                                        </div>
                                        <dl class="mt-6 flex flex-col sm:ml-3 sm:mt-1 sm:flex-row sm:flex-wrap">
                                            <dt class="sr-only">Company</dt>
                                            <dd class="flex items-center text-sm text-gray-500 font-medium capitalize sm:mr-6">
                                                <OfficeBuildingIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                                                Duke street studio
                                            </dd>
                                            <dt class="sr-only">Account status</dt>
                                            <dd class="mt-3 flex items-center text-sm text-gray-500 font-medium sm:mr-6 sm:mt-0 capitalize">
                                                <CheckCircleIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400" aria-hidden="true" />
                                                Verified account
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
                                <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                                    Add money
                                </button>
                                <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-azure-radiance-600 hover:bg-azure-radiance-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                                    Send money
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8">

                    <!-- Activity list (smallest breakpoint only) -->
<!--                    mobile-->
                    <div class="shadow sm:hidden">
                        <div class="align-middle min-w-full sm:rounded-lg">
                                <slot></slot>
                        </div>
                    </div>

<!--                    desktop-->
                    <!-- Activity table (small breakpoint and up) -->
                    <div class="hidden sm:block">
                        <div class="px-4 sm:px-6 lg:px-8">
                            <div class="flex flex-col mt-2">
                                <div class="align-middle min-w-full sm:rounded-lg">
                                    <slot></slot>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
import {
    Dialog,
    DialogOverlay,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import {
    BellIcon,
    ClockIcon,
    CogIcon,
    CreditCardIcon,
    DocumentReportIcon,
    HomeIcon,
    MenuAlt1Icon,
    QuestionMarkCircleIcon,
    ScaleIcon,
    ShieldCheckIcon,
    UserGroupIcon,
    XIcon,
    TicketIcon,
    DocumentSearchIcon,
    DocumentTextIcon,
    DeviceMobileIcon,

} from '@heroicons/vue/outline'
import {
    CashIcon,
    CheckCircleIcon,
    ChevronDownIcon,
    ChevronRightIcon,
    OfficeBuildingIcon,
    SearchIcon,

} from '@heroicons/vue/solid'

const navigation = [
    { name: 'Home', href: '/dashboard', icon: HomeIcon, current: true },
    { name: 'Mijn facturen', href: '/user/facturen', icon: DocumentTextIcon, current: false },
    { name: 'Mijn apparaten', href: '/user/apparaten', icon: DeviceMobileIcon, current: false },
    { name: 'Mijn reparaties', href: '/user/reparaties', icon: TicketIcon, current: false },

]
const secondaryNavigation = [

]
const cards = [
    { name: 'Account balance', href: '#', icon: ScaleIcon, amount: '$30,659.45' },
    // More items...
]
const transactions = [
    {
        id: 1,
        name: 'Payment to Molly Sanders',
        href: '#',
        amount: '$20,000',
        currency: 'USD',
        status: 'success',
        date: 'July 11, 2020',
        datetime: '2020-07-11',
    },
    // More transactions...
]
const statusStyles = {
    success: 'bg-green-100 text-green-800',
    processing: 'bg-yellow-100 text-yellow-800',
    failed: 'bg-gray-100 text-gray-800',
}

export default {
    props:['user'],
    components: {
        Dialog,
        DialogOverlay,
        Menu,
        MenuButton,
        Link,
        MenuItem,
        MenuItems,
        TransitionChild,
        TransitionRoot,
        BellIcon,
        CashIcon,
        CheckCircleIcon,
        ChevronDownIcon,
        ChevronRightIcon,
        MenuAlt1Icon,
        SearchIcon,
        XIcon,
        OfficeBuildingIcon
    },
    setup() {
        const sidebarOpen = ref(false)

        return {
            navigation,
            secondaryNavigation,
            cards,
            transactions,
            statusStyles,
            sidebarOpen,
        }
    },
}
</script>
