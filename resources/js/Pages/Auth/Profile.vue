<template>
    <layout-dashboard>
        <div id="auth-profile">
            <div class="row">
                <div class="col-12">
                    <simple-card title="Seu perfil" class="w-100 bg-white">
                        <form @submit.prevent="update">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Nome</label>
                                    <input type="text" name="" class="form-control" v-model="user.name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">
                                        Email -
                                        <span :class="['fw-bold', user.email_verified_at ? 'text-success' : 'text-danger']">
                                            {{ user.email_verified_at ? 'Verificado' : 'Não verificado' }}
                                        </span>
                                    </label>
                                    <input type="text" name="" class="form-control" v-model="user.email">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button-load text="Salvar" :load="loads.form_profile" class="btn btn-success"
                                        type="submit"></button-load>
                                </div>
                            </div>
                        </form>
                    </simple-card>
                    <simple-card title="Atualização de senha" class="w-100 mt-3 bg-white">
                        <form @submit.prevent="updatePassword">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Senha atual</label>
                                    <input type="password" class="form-control" name="" v-model="form_update_password.current_password">
                                    <div class="text-danger" v-if="errors.updatePassword && errors.updatePassword.current_password">
                                        {{ errors.updatePassword.current_password }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Nova Senha</label>
                                    <input type="password" class="form-control" name="" v-model="form_update_password.password">
                                    <div class="text-danger" v-if="errors.updatePassword && errors.updatePassword.password">
                                        {{ errors.updatePassword.password }}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button-load text="Atualizar" :load="loads.form_update_password" class="btn btn-primary" type="submit"></button-load>
                                </div>
                            </div>
                        </form>
                    </simple-card>
                    <simple-card title="Ações" class="w-100 mt-3 bg-white">
                        <div class="actions-users">
                            <div class="two-factor-authenticate disable">
                                2FA
                            </div>
                        </div>
                    </simple-card>
                </div>
            </div>
        </div>
    </layout-dashboard>
</template>
<script>
import { router } from '@inertiajs/vue3';
export default {
    data() {
        return {
            loads: {
                form_profile: false,
                form_update_password:false
            },
            form_update_password:{
                current_password:'',
                password:'',
                confirm_password:''
            }
        }
    },
    computed: {
        user() {
            return this.$page.props.auth.user
        },
    },
    props: {
        routes_fortify: Object,
        errors: Object
    },
    methods: {
        update() {
            router.put(this.routes_fortify.profile_information, {
                name: this.user.name,
                email: this.user.email
            }, {
                onStart: () => {
                    this.loads.form_profile = true;
                },
                onSuccess: () => {
                    this.$alert.fire(
                        'Sucesso!',
                        'Senha atualizado!',
                        'success'
                    );
                },
                onFinish: () => {
                    this.loads.form_profile = false;
                }
            });
        },
        updatePassword(){
            router.put(this.routes_fortify.password, this.form_update_password, {
                onStart: () => {
                    this.loads.form_update_password = true;
                },
                onSuccess: () => {
                    this.$alert.fire(
                        'Sucesso!',
                        'Usuario atualizado!',
                        'success'
                    );
                },
                onFinish: () => {
                    this.loads.form_update_password = false;
                }
            });
        }
    }
}
</script>
