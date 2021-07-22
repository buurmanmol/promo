<template>
    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
        <div class="sm:col-span-3">
            <label for="first_name" class="block text-sm font-medium text-gray-700">
                Subscription GUID
            </label>
            <div class="mt-1">
                <input v-model="subscriptionUID" type="text" name="subscriptionUID" id="subscriptionUID" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
            </div>
        </div>
        <div class="sm:col-span-3">
            <label for="first_name" class="block text-sm font-medium text-gray-700">
                Start datum
            </label>
            <div class="mt-1">
                <datepicker v-model="startDate" name="start-date" id="start-date" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
            </div>
        </div>
        <div class="sm:col-span-3">
            <label for="first_name" class="block text-sm font-medium text-gray-700">
                End datum
            </label>
            <div class="mt-1">
                <datepicker v-model="endDate" name="end-date" id="end-date" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";
import Datepicker from 'vue3-datepicker'

export default {
    name: "CreateSubscription",
    props:['user'],
    components: {
        moment,
        Datepicker
    },
    data() {
      return {
          subscriptionUID: null,
          startDate: null,
          lowerLimit: null,
          endDate: null,
      }
    },
    mounted() {
        let lower = moment();
        lower.subtract(1, 'd');
      this.lowerLimit = lower;
    },
    methods: {
        setSubscription() {
            let now = moment.now();
            let output = {
                Services: {
                    ServiceList: [
                        {
                            Name: "Subscriptions",
                            Action: "CreateSubscription",
                            Parameters: [
                                {
                                    Name: "StartDate",
                                    GroupType: "Addrateplan",
                                    GroupID: "",
                                    Value: now
                                },
                                {
                                    Name: "RatePlanCode",
                                    GroupType: "Addrateplan",
                                    GroupID: "",
                                    Value: "xxxxxx"
                                },
                                {
                                    Name: "Code",
                                    GroupType: "Debtor",
                                    GroupID: "",
                                    Value: "xxxxxx"
                                },
                                {
                                    Name: "ConfigurationCode",
                                    Value: "xxxxx"
                                }
                            ]
                        }
                    ]
                }
            }
            return output;
            },

        createSubscription() {
            axios.post('/api/subscription/create', this.company)
                .then((response) => {
                    console.log(response);
                    window.location = '/admin/companies'
                }, (error) => {
                    console.log(error);
                });
        }
    },
}
</script>

<style scoped>

</style>
