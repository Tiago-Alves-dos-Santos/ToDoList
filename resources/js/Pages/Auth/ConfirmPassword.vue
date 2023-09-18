<template>
    <layout-dashboard>
        <div class="w-100 d-flex justify-content-center">
            <simple-card title="Confirmar Senha">
                <form @submit.prevent="confirm">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="password" class="form-control" v-model="password">
                            <div class="text-danger" v-if="errors.password">
                                {{ errors.password }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-end mt-2">
                            <button-load text="Confirmar" class="btn btn-primary" :load="load" type="submit"></button-load>
                        </div>
                    </div>
                </form>
            </simple-card>
        </div>
    </layout-dashboard>
</template>
<script>
import { router } from '@inertiajs/vue3';
export default {
    data() {
        return {
            load: false,
            password: ''
        }
    },
    props: {
        routes_fortify: Object,
        errors: Object,
    },
    methods: {
        confirm() {
            router.post(this.routes_fortify.confirm_password, {
                password: this.password
            }, {
                onStart: () => this.load = true,
                onFinish: () => this.load = false
            });
        }
    }
}
</script>
