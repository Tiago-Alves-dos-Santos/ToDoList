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
                                    <input type="password" class="form-control" name=""
                                        v-model="form_update_password.current_password">
                                    <div class="text-danger"
                                        v-if="errors.updatePassword && errors.updatePassword.current_password">
                                        {{ errors.updatePassword.current_password }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Nova Senha</label>
                                    <input type="password" class="form-control" name=""
                                        v-model="form_update_password.password">
                                    <div class="text-danger" v-if="errors.updatePassword && errors.updatePassword.password">
                                        {{ errors.updatePassword.password }}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button-load text="Atualizar" :load="loads.form_update_password" class="btn btn-primary"
                                        type="submit"></button-load>
                                </div>
                            </div>
                        </form>
                    </simple-card>
                    <simple-card title="Autenticação dois fatores" class="w-100 mt-3 bg-white">
                        <button-load text="Ativar" :load="loads.TFA" class="btn btn-success"
                            @click="enable2FA"></button-load>
                        <button-load text="Desativar" :load="loads.TFAD" class="btn btn-danger"
                            @click="disable2FA"></button-load>
                    </simple-card>
                    <simple-card title="QrCode" class="bg-white w-100 mt-2" v-if="!two_factor_isEnable">
                        <div style="display: flex; justify-content: center; flex-direction: column; align-items: center;">
                            <div v-html="svg"></div>
                            <div class="copy-recoveryCode">
                                <code v-html="codes"></code>
                                <button class="btn btn-light" @click="copy">
                                    <i class="bi bi-clipboard"></i>
                                </button>
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
            svg: '',
            codes: '',
            loads: {
                form_profile: false,
                form_update_password: false,
                TFA: false,
                TFAD: false,
            },
            form_update_password: {
                current_password: '',
                password: '',
                confirm_password: ''
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
        errors: Object,
        two_factor_isEnable: Boolean
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
        updatePassword() {
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
        },
        getSvg(svg) {
            axios.get(this.routes_fortify.two_factor_qr_code)
                .then(function (response) {
                    console.log(response.data.svg);
                    svg = response.data.svg;

                });
        },
        disable2FA() {
            router.delete(this.routes_fortify.two_factor_authentication, {
                onStart: () => {
                    this.loads.TFAD = true;
                },
                onSuccess: () => {
                    this.$alert.fire(
                        'Sucesso!',
                        'Autenticação dois fatores desahabilitada!',
                        'success'
                    );

                },
                onFinish: () => {
                    this.loads.TFAD = false;
                }
            });
        },
        enable2FA() {
            router.post(this.routes_fortify.two_factor_authentication, {}, {
                onStart: () => {
                    this.loads.TFA = true;
                },
                onSuccess: () => {
                    //coloca assim para não confudir this do vue com escopo do axios
                    const self = this;
                    this.$alert.fire(
                        'Sucesso!',
                        'Autenticação dois fatores habilitada!',
                        'success'
                    );
                    axios.get(this.routes_fortify.two_factor_qr_code)
                        .then(function (response) {
                            //svg variavel no data do vue
                            self.svg = response.data.svg;

                        });
                    axios.get(this.routes_fortify.two_factor_recovery_codes)
                        .then(function (response) {
                            console.log(response.data);
                            self.codes = response.data;
                        });
                    axios.get(this.routes_fortify.confirmed_password_status).then(function (response) {
                        console.log(response.data);
                    });

                },
                onFinish: () => {
                    this.loads.TFA = false;
                }
            });
        },
        copy() {
            navigator.clipboard.writeText(this.codes);
            this.$alert.fire(
                'Sucesso!',
                'Código copiado!',
                'success'
            );
        }
    },
    mounted() {
        axios.get(this.routes_fortify.confirmed_password_status).then(function (response) {
            console.log(response.data);
        });
    }
}
</script>
