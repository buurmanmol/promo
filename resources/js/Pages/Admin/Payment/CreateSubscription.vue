<template>
    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
        <div class="sm:col-span-3">
            <label for="first_name" class="block text-sm font-medium text-gray-700">
                Prijs per maand
            </label>
            <div class="mt-1">
                <currency-input
                    v-model="price"
                    :options="{ currency: 'EUR' }"
                />
            </div>
        </div>
        <div class="sm:col-span-3">
            <label for="first_name" class="block text-sm font-medium text-gray-700">
                Start datum
            </label>
            <div class="mt-1">
                <datepicker :lowerLimit="lowerLimit" v-if="lowerLimit" v-model="startDate" name="start-date" id="start-date" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
            </div>
        </div>
        <div class="sm:col-span-3">
            <label for="first_name" class="block text-sm font-medium text-gray-700">
                End datum <br>
                <sub v-if="!disabled">Selecteer eerst een start datum.</sub>
            </label>
            <div class="mt-1">
                <input class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md disabled:opacity-50" disabled type="text" v-if="!disabled">
                <datepicker v-if="disabled" :lowerLimit="startDate" v-model="endDate" name="end-date" id="end-date" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
            </div>
        </div>
        <div class="sm:col-span-6">
            <errors v-if="errors.length > 0" :errors="errors"></errors>
        </div>
        <div class="sm:col-span-6">
            <button @click="checkForm" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-azure-radiance-600 hover:bg-azure-radiance-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">Create subscription</button>
        </div>
    </div>
</template>

<script>
import moment from "moment";
import Datepicker from 'vue3-datepicker'
import CryptoJS from 'crypto-js'
import Errors from "../../../Components/Errors";
import Swal from "sweetalert2";
import CurrencyInput from "../../../Components/CurrencyInput";

require(["crypto-js/aes", "crypto-js/sha256"], function (AES, SHA256) {
    //console.log(SHA256("Message"));
});

export default {
    name: "CreateSubscription",
    props: ['user'],
    components: {
        moment,
        Errors,
        CurrencyInput,
        Datepicker,
        CryptoJS: {
            name: 'crypto-js',
            location: 'path-to/bower_components/crypto-js',
            main: 'index'
        }
    },
    watch: {
        startDate(val) {
            this.setDisabled(val);
        }
    },
    data() {
        return {
            subscriptionUID: null,
            startDate: null,
            price: null,
            errors: [],
            disabled: false,
            lowerLimit: null,
            endDate: null,
        }
    },
    created() {
        this.lowerLimit = new Date;
    },
    mounted() {
        this.lowerLimit = new Date;
    },
    methods: {
        currency(val) {
            return Number(val).toLocaleString("nl-NL", {minimumFractionDigits: 2});
        },
        checkForm: function (e) {
            this.errors = [];
            if (!this.startDate) this.errors.push("Start datum vereist.");
            if (!this.endDate) this.errors.push("Eind datum vereist.");
            if (!this.price) this.errors.push("Prijs is vereist.");

            if (!this.errors.length) {
                this.createSubscription();
                return true;
            }
            e.preventDefault();
        },
        setDisabled(val ) {
            if(val) {
                this.disabled = ! this.disabled
            }
        },

        createSubscription() {
            let startDate = moment(this.startDate);
            let endDate = moment(this.endDate);
            startDate.add(1, 'd');
            endDate.add(1, 'd');

            Swal.fire({
                title: "Weet u zeker dat u deze subscription wilt aanmaken?",
                text: "Hierdoor zal deze gebruiker in het Buckaroo systeem vastgelegd worden als debiteur!. ",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Subscription starten",
                cancelButtonText: "Annuleren",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('/api/buckaroo/create-subscription', {
                        start_date: startDate,
                        end_date: endDate,
                        price: this.price,
                        user: this.user,
                    })
                        .then((response) => {
                            this.$emit('closeModal', false)
                        }, (error) => {
                            console.log(error);
                        });
                    Swal.fire(
                        "Succes!",
                        "De subscription is aangemaakt.",
                        "success"
                    );
                }
            })
                .catch((response) => {
                    console.log(response);
                    console.log("FAILURE!!");
                });
            },
        },
}

</script>

<style scoped>

</style>
