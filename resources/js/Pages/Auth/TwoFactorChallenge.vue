<template>
    <layout-auth>
        <simple-card title="Autenticação dois fatores" sub_title="Código celular">
            <form @submit.prevent="twoFactorLogin">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div v-html="svg"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" class="form-control me-2" placeholder="" v-model="code">
                        <input type="text" class="form-control me-2" placeholder="" v-model="recovery_code">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end mt-2">
                        <button-load class="btn btn-primary" text="Enviar" :load="load" type="submit"></button-load>
                    </div>
                </div>
            </form>
        </simple-card>
    </layout-auth>
</template>

<script>
import { router } from '@inertiajs/vue3';
export default {
    data() {
        return {
            svg: '',
            load: false,
            code: '',
            recovery_code:''
        }
    },
    props: {
        routes_fortify: Object,
        errors: Object,
    },
    methods: {
        twoFactorLogin() {
            router.post(this.routes_fortify.two_factor_challenge, {
                code: this.code,
                recovery_code: this.recovery_code
            }, {
                onStart: () => {
                    this.load = true;
                },
                onFinish: () => {
                    this.load = false;
                }
            });
        }
    },
    mounted() {
        // const self = this;
        // axios.get(this.routes_fortify.two_factor_qr_code)
        //     .then(function (response) {
        //         //svg variavel no data do vue
        //         self.svg = response.data.svg;

        //     });
    }
}
</script>
