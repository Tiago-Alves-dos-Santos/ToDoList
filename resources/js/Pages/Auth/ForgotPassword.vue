<template>
    <div>
        <layout-auth>
            <input type="email" v-model="email">
            <button @click="resetPassword">Enviar</button>
        </layout-auth>
    </div>
</template>
<script>
import {router} from '@inertiajs/vue3';
export default{
    data() {
        return {
            email: ''
        }
    },
    props:{
        routes_fortify: Object,
    },
    methods: {
        resetPassword(){
            router.post(this.routes_fortify.forgot_password, {
                email: this.email
            });
        }
    }
}
</script>
