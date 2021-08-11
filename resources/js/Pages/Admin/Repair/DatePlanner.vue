<template>
    <div class="datepicker relative">
        <button  @click="toggleDate = ! toggleDate">
            <calendar-icon class="w-7 h-7 text-azure-radiance-600" />
        </button>
        <div class=" absolute right-12 -top-1" v-if="toggleDate">
            <div class="mt-1 w-52 flex rounded-md shadow-sm">
                <div class="relative flex items-stretch flex-grow focus-within:z-10">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <CalendarIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                    </div>
                    <datepicker v-if="lowerLimit" :lowerLimit="lowerLimit" placeholder="Reparatie datum" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300" v-model="date" />
                </div>
                <button class="-ml-px relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm font-medium rounded-r-md text-green-900 bg-green-300 hover:bg-green-400 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    <span>Save</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import Datepicker from 'vue3-datepicker'
import { CalendarIcon } from '@heroicons/vue/outline'
import moment from "moment";
import Swal from 'sweetalert2'
import 'sweetalert2/src/sweetalert2.scss'
export default {
    props: ['repair'],
    name: "DatePlanner",
    components: {
        Datepicker,
        CalendarIcon,
        Swal
    },
    data() {
        return {
            date: null,
            toggleDate: false,
            lowerLimit: null,
            
        }
    },
    watch: {
      date(){
          this.postDate();
          this.toggleDate = false;
      }
    },
    mounted() {
        // let lower = moment();
        // lower.subtract(1, 'd');
        // this.lowerLimit = lower;
    },
    methods: {
        postDate() {
            axios.post('/api/repair/' + this.repair.id + '/plan' , {repair_date: this.date})
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
                        title: 'Datum van reparatie staat ingeplanned.'
                    })

                }, (error) => {
                    console.log(error);
                });
        }
    }

}
</script>

<style scoped lang="scss">
.v3dp__popout {
    right: 0 !important;
}
</style>
