<template>
    <layout-auth ref="layout_auth">
        <div class="img-logo">
            <img src="/img/favicon/list_100.png" alt="">
        </div>
        <simple-card title="Formulário" sub_title="Login" v-if="form_type_operation == dataTypeOperation.auth.login">
            <form @submit.prevent="login">
                <div class="form-row">
                    <div class="col-12">
                        <label for="">Email</label>
                        <input type="email" class="form-control" v-model="form_login.email">
                        <div class="text-danger" v-if="errors.email">
                            {{ errors.email }}
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="">Senha</label>
                        <input type="password" class="form-control" v-model="form_login.password">
                        <div class="text-danger" v-if="errors.password">
                            {{ errors.password }}
                        </div>
                    </div>
                </div>
                <div class="form-row mt-2">
                    <div class="col-12 d-flex justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input pointer" type="checkbox" value="" id="flexCheckDefault"
                                v-model="form_login.remember">
                            <label class="form-check-label pointer" for="flexCheckDefault">
                                Lembrar-me
                            </label>
                        </div>
                        <a @click="forgotPassword" v-if="!isRouteAdmin" class="link-danger pointer">Esqueceu a
                            senha?</a>
                    </div>
                </div>

                <div class="form-row mt-2">
                    <div :class="['col-12', 'd-flex', isRouteAdmin ? 'justify-content-end' : 'justify-content-between']">
                        <a class="icon-link" href="#" @click="toggleForm" v-if="!isRouteAdmin">
                            <i class="bi bi-arrow-left"></i>
                            Cadastrar
                        </a>
                        <button-load text="Login" :load="loads.form_login" class="btn btn-success"
                            type="submit"></button-load>
                    </div>
                </div>
            </form>
        </simple-card>
        <simple-card title="Formulário" sub_title="Cadastro"
            v-else-if="form_type_operation == dataTypeOperation.auth.register">
            <form @submit.prevent="create">
                <div class="form-row">
                    <div class="col-12">
                        <label for="">Nome</label>
                        <input type="text" class="form-control" v-model="form.name">
                        <div class="text-danger" v-if="errors.name">
                            {{ errors.name }}
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="">Email</label>
                        <input type="email" class="form-control" v-model="form.email">
                        <div class="text-danger" v-if="errors.email">
                            {{ errors.email }}
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="">Senha</label>
                        <input type="password" class="form-control" v-model="form.password">
                        <div class="text-danger" v-if="errors.password">
                            {{ errors.password }}
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="">Confirmar Senha</label>
                        <input type="password" class="form-control" v-model="form.password_confirmation">
                        <div class="text-danger" v-if="errors.password_confirmation">
                            {{ errors.password_confirmation }}
                        </div>
                    </div>
                </div>


                <div class="form-row mt-2">
                    <div class="col-12" style="display: flex; justify-content: space-between;">
                        <button-load text="Cadastrar" :load="loads.form" class="btn btn-success"
                            type="submit"></button-load>
                        <a class="icon-link" href="#" @click="toggleForm">
                            Login
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </form>
        </simple-card>
    </layout-auth>
</template>
<script>
import { router } from '@inertiajs/vue3';
import TypeOperation from '../enums/TypeOperation';

export default {
    data() {
        return {
            dataTypeOperation: TypeOperation,
            form_type_operation: TypeOperation.auth.login,
            loads: {
                form_login: false,
                form: false, //form_create
                forgot_password: false
            },
            form_login: {
                email: '',
                password: '',
                remember: false
            },
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            forgot_password_email: ''
        }
    },
    props: {
        errors: Object,
        routes_fortify: Object,
        isRouteAdmin: Boolean,
    },
    methods: {
        forgotPassword() {
            router.get(this.routes_fortify.forgot_password_get);
        },
        toggleForm() {
            let middle_time = (0.75 / 2) * 1000;//(time-toggle-direction(animations.scss) / 2)*1000
            let value = null;
            if (this.form_type_operation == this.dataTypeOperation.auth.login) {
                value = this.dataTypeOperation.auth.register;
                router.visit(this.routes_fortify.register, {
                    preserveState: true
                });
            } else {
                value = this.dataTypeOperation.auth.login;
                router.visit(this.routes_fortify.login, {
                    preserveState: true
                });
            }

            if (window.innerWidth <= 839) {
                this.$page.props.errors = {};
                this.form_type_operation = value;
            } else {
                this.$refs.layout_auth.loadAnimationToggleDirection(value);
                setTimeout(() => {
                    this.$page.props.errors = {};
                    this.form_type_operation = value;
                }, middle_time);
            }
        },
        create() {
            let route_url = this.routes_fortify.register;
            router.post(route_url, this.form, {
                onStart: () => {
                    this.loads.form = true;
                },
                onFinish: () => {
                    this.loads.form = false;
                }
            });
        },
        login() {
            let route_url = this.routes_fortify.login;
            router.post(route_url, this.form_login, {
                onStart: () => {
                    this.loads.form_login = true;
                },
                onError: (errors) => {
                    if (errors.email_verify) {
                        this.$alert.fire({
                            title: 'Error!',
                            text: errors.email_verify,
                            icon: 'error',
                            confirmButtonText: 'Cool'
                        })
                    }
                },
                onFinish: () => {
                    this.loads.form_login = false;
                }
            });
        },
    },
    mounted() {
        // console.log(this.errors);
    }
}
</script>
