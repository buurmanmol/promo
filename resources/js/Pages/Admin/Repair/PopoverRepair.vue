<template>
    <div class="w-full ">
        <Popover v-slot="{ open }" class="relative">
            <PopoverButton
                :class="open ? '' : 'text-opacity-90'"
                class="inline-flex items-center px-3 py-2 text-base font-medium text-white bg-orange-700 rounded-md group hover:text-opacity-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
            >
                <InformationCircleIcon class="w-5 h-5 text-red-400"/>
                <ChevronDownIcon
                    :class="open ? '' : 'text-opacity-70'"
                    class="w-5 h-5 ml-2 text-orange-300 transition duration-150 ease-in-out group-hover:text-opacity-80"
                    aria-hidden="true"
                />
            </PopoverButton>

            <transition
                enter-active-class="transition duration-200 ease-out"
                enter-from-class="translate-y-1 opacity-0"
                enter-to-class="translate-y-0 opacity-100"
                leave-active-class="transition duration-150 ease-in"
                leave-from-class="translate-y-0 opacity-100"
                leave-to-class="translate-y-1 opacity-0"
            >
                <PopoverPanel
                    class="absolute z-10 w-screen max-w-xs px-4 mt-3 transform -translate-x-1/2 left-1/2 sm:px-0 lg:max-w-xs"
                >

                    <div class="p-4 bg-white shadow rounded-md">
                        {{data || 'Geen beschrijving gevonden'}}
                    </div>
                </PopoverPanel>
            </transition>
        </Popover>
    </div>
</template>

<script>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import { ChevronDownIcon, InformationCircleIcon } from '@heroicons/vue/solid'

export default {
    components: { Popover, PopoverButton, PopoverPanel, ChevronDownIcon, InformationCircleIcon },
    props: ['data'],
    setup() {
        return {

        }
    },
}
</script>
