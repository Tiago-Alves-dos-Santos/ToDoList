<template>
    <layout-auth>
        <div>
            <simple-card title="Redifinição de Senha" sub_title="Atualizar">
                <form @submit.prevent="resetPassword">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Email</label>
                            <input type="email" class="form-control readonly" :value="this.email">
                            <div class="text-danger" v-if="errors.email">
                                {{ errors.email }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Nova senha</label>
                            <input type="password" name="" class="form-control" v-model="form.password">
                            <div class="text-danger" v-if="errors.password">
                                {{ errors.password }}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12 d-flex justify-content-end">
                            <button-load text="Atualizar" :load="load" class="btn btn-primary" type="submit"></button-load>
                        </div>
                    </div>
                </form>
            </simple-card>
        </div>
    </layout-auth>
</template>
<script>
import { router } from '@inertiajs/vue3';

export default{
    data() {
        return {
            load:false,
            form: {
                password:'',
            }
        }
    },
    props:{
        routes_fortify: Object,
        errors: Object,
        token: String,
        email: String
    },
    methods: {
        resetPassword(){
            router.post(this.routes_fortify.reset_password, {
                ...this.form,
                email: this.email,
                token: this.token
            }, {
                onStart: () => {
                    this.load = true;
                },
                onSuccess: () => {
                    this.$alert.fire(
                        'Sucesso!',
                        'Senha atualizada!',
                        'success'
                    );
                },
                onFinish: () => {
                    this.load = false;
                }
            });
        }
    }
}
</script>
