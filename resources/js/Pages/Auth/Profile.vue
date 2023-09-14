<template>
    <layout-dashboard>
        <div id="auth-profile">
            <div class="row">
                <div class="col-12">
                    <simple-card title="Seu perfil" class="w-100 bg-white">
                        <form @submit.prevent="update">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="">Nome</label>
                                    <input type="text" name="" id="" class="form-control" v-model="user.name">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="">
                                        Email -
                                        <span :class="['fw-bold', user.email_verified_at ? 'text-success' : 'text-danger']">
                                            {{ user.email_verified_at ? 'Verificado' : 'Não verificado' }}
                                        </span>
                                    </label>
                                    <input type="text" name="" id="" class="form-control" v-model="user.email">
                                </div>
                            </div>
                            <div class="form-row mt-2">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button-load text="Salvar" :load="loads.form_profile" class="btn btn-success"
                                        type="submit"></button-load>
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
import AlertEmailVerify from '../../components_static/AlertEmailVerify.vue';
export default {
    data() {
        return {
            loads: {
                form_profile: false
            }
        }
    },
    components: {
        'alert-email-verify': AlertEmailVerify
    },
    computed: {
        user() {
            return this.$page.props.auth.user
        },
    },
    props: {
        routes_fortify: Object,
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
                        'Usuario atualizado!',
                        'success'
                    );
                },
                onFinish: () => {
                    this.loads.form_profile = false;
                }
            });
        },
        redirectUpdatePassword(){
        }
    }
}
</script>
