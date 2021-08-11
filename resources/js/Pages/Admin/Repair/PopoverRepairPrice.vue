<template>
    <div class="w-full ">
        <Popover v-slot="{ open }" class="relative">
            <PopoverButton
                :class="open ? '' : 'text-opacity-90'"
                class="inline-flex items-center px-3 py-2 text-base font-medium text-white bg-orange-700 rounded-md group hover:text-opacity-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
            >
                <CurrencyEuroIcon class="w-6 h-6 text-green-400"/>
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
                        <div class="mt-1 w-full">
                            <label for="">Vul hier de prijs van de reparatie in</label>
                        </div>
                        <div class="flex">
                            <currency-input class="flex-col"
                                v-model="repair.price"
                                :options="{ currency: 'EUR', precision: 2, locale:'nl-NL' }"
                            />
                            <!--                                        <input v-model="rep.price" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" type="number">-->
                            <button @click="postRepair(repair)" class="inline-flex flex-col items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">Save</button>
                        </div>
                        </div>
                </PopoverPanel>
            </transition>
        </Popover>
    </div>
</template>

<script>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import { ChevronDownIcon, InformationCircleIcon, CurrencyEuroIcon } from '@heroicons/vue/solid'
import CurrencyInput from "../../../Components/CurrencyInput";
import Swal from "sweetalert2";
export default {
    components: { CurrencyInput,Popover, PopoverButton, PopoverPanel, ChevronDownIcon, CurrencyEuroIcon },
    props: ['repair'],
    setup() {
        return {

        }
    },
    mounted() {
        if(!this.repair.price) {
            this.repair.price = 0
        }
    },
    methods : {
        postRepair(repair, brand, model){
            axios.post('/api/repair/' + repair.id + '/update' , repair)
                .then((response) => {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Prijs van reparaite ingesteld op ' + '€ ' + (this.repair.price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
                    })
                }, (error) => {
                    console.log(error);
                });
        },
    }
}
</script>
