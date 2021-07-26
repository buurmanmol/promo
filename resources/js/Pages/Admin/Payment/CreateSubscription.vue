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
                <datepicker :lower-limit="lowerLimit" v-model="startDate" name="start-date" id="start-date" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
            </div>
        </div>
        <div class="sm:col-span-3">
            <label for="first_name" class="block text-sm font-medium text-gray-700">
                End datum
            </label>
            <div class="mt-1">
                <datepicker :lower-limit="startDate" v-model="endDate" name="end-date" id="end-date" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
            </div>
        </div>
        <div class="sm:col-span-6">
            <button @click="createSubscription" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-azure-radiance-600 hover:bg-azure-radiance-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">Create subscription</button>
        </div>
    </div>
</template>

<script>
import moment from "moment";
import Datepicker from 'vue3-datepicker'
import CryptoJS from 'crypto-js'

require(["crypto-js/aes", "crypto-js/sha256"], function (AES, SHA256) {
    console.log(SHA256("Message"));
});

export default {
    name: "CreateSubscription",
    props:['user'],
    components: {
        moment,
        Datepicker,
        CryptoJS: {
                name: 'crypto-js',
                location: 'path-to/bower_components/crypto-js',
                main: 'index'
        }
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
            let output =  {
                    ServiceList: [
                        {
                            Name: "Subscriptions",
                            Action: "CreateSubscription",
                            Parameters: [
                                {
                                    Name: "StartDate",
                                    GroupType: "Addrateplan",
                                    GroupID: "",
                                    Value: this.startDate
                                },
                                {
                                    Name: "EndDate",
                                    GroupType: "Addrateplan",
                                    GroupID: "",
                                    Value: this.endDate
                                },
                                {
                                    Name: "RatePlanCode",
                                    GroupType: "Addrateplan",
                                    GroupID: "",
                                    Value: "hpwda37b"
                                },
                                {
                                    Name: "Code",
                                    GroupType: "Debtor",
                                    GroupID: "",
                                    Value: Math.floor(Math.random() * 99999)
                                },
                                {
                                    Name: "ConfigurationCode",
                                    Value: "r4n7sr9f"
                                }
                            ]
                        }
                    ]
            }
            return output;
            },
         getNonce() {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            for (var i = 0; i < 16; i++) {
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            }
            return text;
        },

        createSubscription() {
            let websiteKey = 'mG8nQEY9eA'
            let secretKey = 'JoweErjbvaoK19O'
            let httpMethod = 'POST'
            let timeStamp = this.getTimeStamp()
            let nonce = this.getNonce();
           let  content = this.setSubscription();

            axios.post('/api/buckaroo/create-subscription')
                .then((response) => {
                    console.log(response);
                }, (error) => {
                    console.log(error);
                });
        },
        getEncodedContent(content) {
            if (content) {
                var md5 = CryptoJS.MD5(content);
                var base64 = CryptoJS.enc.Base64.stringify(md5);
                return base64;
            }

            return content;
        },

         getHash(websiteKey, secretKey, httpMethod, nonce, timeStamp, requestUri, content) {
            var encodedContent = this.getEncodedContent(content);

            var rawData = websiteKey + httpMethod + requestUri + timeStamp + nonce + encodedContent;
            var hash = CryptoJS.HmacSHA256(rawData, secretKey);
            var hashInBase64 = CryptoJS.enc.Base64.stringify(hash);

            return hashInBase64;
        },

        getTimeStamp() {
            return Math.floor((new Date).getTime() / 1000);
        }
    },
}

</script>

<style scoped>

</style>
