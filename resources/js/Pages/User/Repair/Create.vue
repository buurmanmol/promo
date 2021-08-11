<template>
    <app-layout-admin :user="currentUser" :company="company" :page="page">
        <div style="min-height:60vh !important;" class="bg-white h-auto rounded-md shadow overflow-visible p-4">
            <div class="mx-4 p-4">
                <div class="flex items-center">
                    <div class="flex items-center text-azure-radiance-600 relative">
                        <div @click="selectedSlide = 0" :class="[selectedSlide >= 0 ? 'bg-azure-radiance-600' : '']" class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 border-teal-600">
                            <svg  xmlns="http://www.w3.org/2000/svg"  class="w-auto w-full h-full" fill="none" viewBox="0 0 24 24" :stroke="[selectedSlide >= 0 ? 'white' : 'gray']">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>

                        <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium uppercase text-azure-radiance-600">Device</div>
                    </div>
                    <div :class="[selectedSlide >= 1 ? 'border-azure-radiance-600' : '']" class="flex-auto border-t-2 transition duration-500 ease-in-out"></div>
                    <div class="flex items-center text-white relative">
                        <div @click="selectedSlide = 1" :class="[selectedSlide >= 1 ? 'bg-azure-radiance-600' : '']" class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 border-teal-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" :stroke="[selectedSlide >= 1 ? 'white' : 'gray']" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus ">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                        </div>
                        <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium uppercase text-azure-radiance-600">Schade</div>
                    </div>
                    <div :class="[selectedSlide >= 2 ? 'border-azure-radiance-600' : '']"  class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-300"></div>
                    <div class="flex items-center text-gray-500 relative">
                        <div @click="selectedSlide = 2" :class="[selectedSlide >= 2 ? 'bg-azure-radiance-600' : '']"  class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 border-gray-300">
                            <svg  xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" :stroke="[selectedSlide >= 2 ? 'white' : 'gray']" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database ">
                                <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                                <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                                <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                            </svg>
                        </div>
                        <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium uppercase text-azure-radiance-600">Overzicht</div>
                    </div>
                </div>
            </div>
            <div class="block pb-12">
                <div class="buttons pl-4 pt-12">
                    <button v-if="selectedSlide > 0" @click="selectedSlide -= 1" type="button" class="mr-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-azure-radiance-600 hover:hover:bg-azure-radiance-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Vorige
                    </button>
                    <button  v-if="selectedSlide === 0" @click="validateSelect(device);" type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-azure-radiance-600 hover:hover:bg-azure-radiance-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Volgende
                    </button>
                    <button  v-if="selectedSlide === 1" @click="validateSelect(productType);" type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-azure-radiance-600 hover:hover:bg-azure-radiance-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Volgende
                    </button>
                </div>
            <div class="relative py-8 w-full">
                <fade-transition>
                    <div v-if="selectedSlide === 0" class="absolute left-4 w-full top-10 bg-white">
                        <div class="grid grid-cols-2">
                            <div class="col-span-2 md:col-span-1">
                                <Disclosure as="div" class="pt-6">
                                    <dt class="text-lg">
                                        <DisclosureButton class="text-left w-full flex justify-between items-start text-gray-400">
                                            <span class="font-medium text-gray-900">
                                              Zoek het merk van uw toestel
                                            </span>
                                        </DisclosureButton>
                                    </dt>
                                    <DisclosurePanel as="dd" class=" pr-12">
                                        <p class="text-base text-gray-500 mt-2">
                                            Hier kunt u het merk van uw toestel zoeken. <br>
                                            Klik op het gewenste merk en klik daarna op de "volgende" knop.
                                        </p>
                                    </DisclosurePanel>
                                </Disclosure>
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <label for="last_name" class="block text-sm font-medium text-gray-700">
                                    Brand
                                </label>
                                <vue-select  @search:change="getDevices" searchable v-model="device" :options="devices" label-by="brands_models.model" :close-on-select="true" class="shadow-sm z-30 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" >
                                    <template #dropdown-item="{ option }">
                                        <div>{{ option.brands_models.brand }} {{ option.brands_models.model }}</div>
                                    </template>
                                </vue-select>
                                <!--                                {{selectedSlide}} {{brand}}-->
                                <errors v-if="errors.length > 0" :errors="errors"></errors>
                            </div>
                        </div>
                    </div>
                </fade-transition>
                <fade-transition>
                    <div v-if="selectedSlide === 1" class="absolute top-10 left-4 bg-white">
                        <div class="grid grid-cols-2">
                            <div class="col-span-2 md:col-span-1">
                                <Disclosure as="div" class="pt-6">
                                    <dt class="text-lg">
                                        <DisclosureButton class="text-left w-full flex justify-between items-start text-gray-400">
                                            <span class="font-medium text-gray-900">
                                              Indicatie reparatie
                                            </span>
                                        </DisclosureButton>
                                    </dt>
                                    <DisclosurePanel as="dd" class=" pr-12">
                                        <p class="text-base text-gray-500 mt-2">
                                            Hier kunt u een indicatie geven van wat kapot is van uw toestel(en). <br>
                                            Geef aan wat u denkt wat er kapot is en klik daarna op de "volgende" knop.
                                        </p>
                                    </DisclosurePanel>
                                </Disclosure>
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <label for="last_name" class="block text-sm font-medium text-gray-700">
                                    Broken
                                </label>
                                <vue-select  searchable v-model="productType" :options="productTypes" label-by="name" :close-on-select="true" class="shadow-sm z-30 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></vue-select>
                                <errors v-if="errors.length > 0" :errors="errors"></errors>
                            </div>
                        </div>
                    </div>
                </fade-transition>
                <fade-transition>
                    <div v-if="selectedSlide === 2" class="px-4 w-full bg-white">
                        <div class="grid grid-cols-2">
                            <div class="col-span-1 xs:col-span-2">
                                <Disclosure as="div" class="pt-6">
                                    <dt class="text-lg">
                                        <DisclosureButton class="text-left w-full flex justify-between items-start text-gray-400">
                                            <span class="font-medium text-gray-900">
                                              Uw reparatie overzicht
                                            </span>
                                        </DisclosureButton>
                                    </dt>
                                    <DisclosurePanel as="dd" class="mt-2 pr-12">
                                        <p class="text-base text-gray-500">
                                            Hier kunt u extra toestelen van het geselecteerde model toevoegen. <br>
                                            Om een nieuw soort toestel of andere soort schade toe te voegen klikt u hier:
                                        </p>
                                    </DisclosurePanel>
                                    <div class="my-4">
                                        <button @click="selectedSlide = 0" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white  bg-azure-radiance-600 hover:hover:bg-azure-radiance-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Ander apparaat</button>
                                        <span class="mx-2"></span>
                                        <button @click="selectedSlide = 1" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white  bg-azure-radiance-600 hover:hover:bg-azure-radiance-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Nieuw soort schade</button>
                                    </div>
                                </Disclosure>
                            </div>
                            <div class="col-span-1 xs:col-span-2">
                            <div class="col mt-4">
                                <label for="comment" class="block text-sm font-medium text-gray-700">
                                    Plan de reparatie in
                                </label>
                                <div class="mt-1">
                                    <datepicker :lower-limit="lowLimit" :disabled-dates="disabledDates" placeholder="Reparatie datum" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300" v-model="repairDate" />
                                </div>
                            </div>
                                <div class="col">
                                    <label for="comment" class="block text-sm font-medium text-gray-700">
                                        Opmerkingen
                                    </label>
                                    <div class="mt-1">
                                        <textarea v-model="comment" id="comment" name="comment" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">Opmerkingen over de reparaties of producten.</p>
                                </div>

                                <div class="col">
                                    <errors v-if="errors.length > 0" :errors="errors"></errors>
                                </div>
                                <div class="col">
                                    <button @click="postRepairs" class="mt-4 float-right inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-azure-radiance-600 hover:bg-azure-radiance-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-azure-radiance-500">Versturen</button>
                                </div>
                            </div>
                            <div class="relative lg:mt-6 col-span-2" aria-hidden="true">
                                <div class="grid grid-cols-2">
                                    <div class="col-span-1">
                                        <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight sm:text-3xl">
                                            Reparaties overzicht
                                        </h3>
                                    </div>
                                </div>
                                <div v-if="repairDate" class="max-w-xs">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Aantal reparaties van ditzelfde toestel</label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                           <button class="relative flex items-stretch flex-grow mr-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-azure-radiance-600 hover:hover:bg-azure-radiance-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" @click="duplicateRepairs(repair)">

                                              +  Dupliceer deze reparatie
                                           </button>
                                    </div>
                                </div>
                                <table class="mt-10 max-h-96 space-y-10 min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Merk
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Model
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Onderdeel
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Reparatie datum
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 overflow-y-scroll">

                                    <template v-if="repairs">
                                        <tr v-for="(repair ,key ) in repairs" :key="key">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ repair.device.brands_models.brand }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">
                                                    {{ repair.device.brands_models.model }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ repair.productType.name }}
                                          </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                          <span v-if="repair.repair_date" class="px-2 inline-flex text-xs leading-5 font-semibold ">
                                            {{ formatDate(repair.repair_date) }}
                                          </span>
                                            </td>
                                            <td>
                                                <button class="p-2" @click="removeRepair(key)">
                                                    <TrashIcon class="w-5 h-5 text-red-600" />
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </fade-transition>
            </div>
            </div>
        </div>
    </app-layout-admin>
</template>

<script>
import { HashtagIcon, DeviceMobileIcon, CalendarIcon, TrashIcon } from '@heroicons/vue/outline'
import 'sweetalert2/dist/sweetalert2.min.css';
import DialogModal from "../../../Jetstream/DialogModal";
import FadeTransition from "../../../Components/FadeTransition";
import AppLayoutAdmin from "../../../Layouts/AppLayoutUser";
import Datepicker from "vue3-datepicker";
import VueNextSelect from 'vue-next-select';
import Errors from "../../../Components/Errors";
import Swal from 'sweetalert2'
import 'sweetalert2/src/sweetalert2.scss'
import moment from "moment";
export default {
    name: "Create",
    props: ['sundays', 'devices','company', 'currentUser', 'productTypes'],
    components: {
        FadeTransition,
        CalendarIcon,
        DialogModal,
        Swal,
        'vue-select': VueNextSelect,
        TrashIcon,
        Datepicker,
        AppLayoutAdmin,
        HashtagIcon,
        DeviceMobileIcon,
        Errors
    },
    data() {
        return {
            page:'reparaties',
            selectedSlide: 0,
            device: '',
            toggleDate: false,
            repairDate: null,
            devices: [],
            repeats: null,
            comment: '',
            user: null,
            productType: null,
            repair: {
                device: null,
                productType: null,
                repair_date: null,
            },
            errors: [],
            repairs: [],
            options: [
                'test1',
                'test2'
            ],
            lowLimit: new Date(),
            disabledDates: {
                dates: [],
            },
        }
    },
    watch: {
        repairDate() {
            this.setRepairData(this.currentUser ,this.device, this.productType)
        },
        user() {
            this.getDevices();
        },
        productType() {
            this.setRepair(this.currentUser ,this.device, this.productType)
        }
    },
    mounted() {
        this.getDevices();
        this.disableDates();
    },
    methods: {
        disableDates(){
            Object.keys(this.sundays).forEach((key) => {
                this.disabledDates.dates.push(new Date(this.sundays[key]));
            });
        },
        formatDate(date) {
            let formatted = moment(date)
            return formatted.format('DD-MM-YYYY')
        },
        postRepairs() {
            if(!this.repairDate) {
                this.errors.push('Geen reparatie datum geselecteerd!')
                return
            }
            if(!this.comment) {
                this.errors.push('Probleem niet beschreven!')
                return
            }
            if(this.repairs.length < 1) {
                this.repair.repair_date = this.repairDate
                this.repair.comment = this.comment;
                this.repairs.push(this.repair)
            } else {
                this.repairs.forEach((item) => {
                    item.comment = this.comment;
                    item.repair_date = this.repairDate
                });
            }

            Swal.fire({
                title: 'Pas op! heeft u alle toestellen toegevoegd?',
                text: "Deze inzending van reparaties is eenmalig.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ja, verzenden!',
                cancelButtonText:'Annuleren'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('/api/repairs/'  + this.currentUser.id + '/create', this.repairs)
                        .then((response) => {
                        }, (error) => {
                            console.log(error);
                        });
                    Swal.fire(
                        'Reparatie aangemaakt!',
                        'Uw reparatie(s) is/zijn aangemaakt.',
                        'success'
                    )
                    window.location = '/user/reparaties'
                }
            })

        },
        validateSelect(value) {
          if(!value) {
              this.errors.push('Value is empty!')
          } else {
              this.selectedSlide += 1;
              this.errors = [];
          }
        },
        getDevices() {
            axios.get('/api/user/'  + this.currentUser.id + '/devices/unique')
                .then((response) => {
                    this.devices = response.data.data;
                }, (error) => {
                    console.log(error);
                });
        },
        setRepair(user, device, productType) {
            this.repair = {
                device: device,
                manager: this.currentUser.manager_id,
                productType: productType,
                company: this.company,
                repair_date: this.repairDate || ''
            }
            this.repairs = [this.repair]
            // this.addRepair(this.repair);
            this.selectedSlide += 1;
        },
        setRepairData(user, device, productType) {
            this.repairs.forEach((repair) => {
                    repair.device =  device
                    repair.manager = this.currentUser.manager_id
                    repair.productType = productType
                    repair.company = this.company
                    repair.repair_date = this.repairDate
            });
            // this.addRepair(this.repair);
        },
        duplicateRepairs(repair, repeats) {
          this.repairs.push(repair);
        },
        removeRepair(index) {
            if (index !== -1) this.repairs.splice(index, 1);
        },
        addRepair(repair) {
          this.repairs.push(repair);
        },
        nextSlide() {
            setTimeout(() => this.selectedSlide += 1, 300);
        },
        previousSlide() {
            setTimeout(() => this.selectedSlide -= 1, 300);
        }
    }
}
</script>

<style scoped lang="scss">
.fade-leave-active {
    transition: opacity .5s;
transition-delay: .2s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
}
.fade-enter-active {
    transition-delay: .2s;
    transition: opacity .5s;
}
</style>
