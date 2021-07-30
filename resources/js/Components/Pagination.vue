

<template>
    <div v-if="links.length > 3">
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex justify-between sm:hidden">
                <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Next
                </a>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing
                        {{ ' ' }}
                        <span class="font-medium">{{data.from}}</span>
                        {{ ' ' }}
                        to
                        {{ ' ' }}
                        <span class="font-medium">{{ data.to }}</span>
                        {{ ' ' }}
                        of
                        {{ ' ' }}
                        <span class="font-medium">{{data.total}}</span>
                        {{ ' ' }}
                        results
                    </p>
                </div>
                <div class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                    <template v-for="(link, p) in links" :key="p">
<!--                        <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"-->
<!--                             v-html="link.label" />-->
                        <a
                                      class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                                      :class="{ 'z-10 bg-azure-radiance-50 border-azure-radiance-500 text-azure-radiance-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium': link.active }" :href="link.url" v-html="link.label" />
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        links: Array,
        data: Object,
    },
    mounted() {
        this.links.forEach((link) => {
            console.log(link);
        })
        console.log(this.links.length)
    }
}

</script>
