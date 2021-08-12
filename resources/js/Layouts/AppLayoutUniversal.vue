<template>
<div v-if="newUser">
    <app-layout-admin v-if="newUser.role === 'admin'" :user="newUser" :company="company">
        <slot></slot>
    </app-layout-admin>
    <app-layout-manager v-if="newUser.role === 'manager'" :user="newUser" :company="company">
        <slot></slot>
    </app-layout-manager>
    <app-layout-user v-if="newUser.role === 'user'" :user="newUser" :company="company">
        <slot></slot>
    </app-layout-user>
    <app-layout-company v-if="newUser.role === 'company'" :user="newUser" :company="company">
        <slot></slot>
    </app-layout-company>
</div>
</template>

<script>
import AppLayoutUser from "./AppLayoutUser";
import AppLayoutManager from "./AppLayoutManager";
import AppLayoutCompany from "./AppLayoutCompany";
import AppLayoutAdmin from "./AppLayoutAdmin";

export default {
    prop:['user', 'company'],
    name: "AppLayoutUniversal",
    components: {
        AppLayoutAdmin,
        AppLayoutCompany,
        AppLayoutUser,
        AppLayoutManager
    },
    mounted() {
        this.newUser = this.$attrs['user'];
        this.newCompany = this.$attrs['company'];

    },
    data() {
        return {
            newUser: '',
            newCompany: '',
        }
    },
}
</script>

<style scoped>

</style>
