<template>
    <div>
        <layout-auth>
            <simple-card class="bg-white" title="Recuperar senha" sub-title="Requisitar link">
                <form @submit.prevent="resetPassword">
                    <div class="w-100">
                        <div class="d-flex justify-content-end">
                            <input type="text" class="form-control me-2" placeholder="Email" v-model="email">
                            <button-load class="btn btn-primary" text="Enviar" :load="load" type="submit"></button-load>
                        </div>
                        <div class="text-danger" v-if="errors.email" v-text="errors.email"></div>
                    </div>
                </form>
            </simple-card>
        </layout-auth>
    </div>
</template>
<script>
import {router} from '@inertiajs/vue3';
export default{
    data() {
        return {
            email: '',
            load: false,
        }
    },
    props:{
        routes_fortify: Object,
        errors: Object
    },
    methods: {
        resetPassword(){
            router.post(this.routes_fortify.forgot_password, {
                email: this.email
            },{
                onStart: () => {
                    this.load = true;
                },
                onFinish: () => {
                    this.load = false;
                }
            });
        }
    }
}
</script>
