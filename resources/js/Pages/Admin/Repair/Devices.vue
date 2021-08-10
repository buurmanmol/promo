<template>
    <table class="min-w-full rounded-md divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Merk
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Model
            </th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="device in devices.data">
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-500">
                    {{ device.brands_models.brand }}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-500">
                    {{ device.brands_models.model }}
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <pagination v-if="devices.links" :data="devices" :links="devices.links"></pagination>
</template>

<script>
import Pagination from "../../../Components/Pagination";
export default {
    name: "Devices",
    props: ['devices'],
    components: {
      Pagination
    },
}
</script>

<style scoped>

</style>
