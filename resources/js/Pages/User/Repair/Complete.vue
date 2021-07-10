<template>
    <app-layout-user :user="user">

    </app-layout-user>
</template>

<script>
import AppLayoutUser from "../../../Layouts/AppLayoutUser";
export default {
    name: "Complete",
    props: ['user'],
    components: {
     AppLayoutUser
    }
}
</script>

<style scoped>

</style>
