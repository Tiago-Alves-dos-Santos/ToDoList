<template>
    <layout-dashboard>
        <div class="w-100 d-flex justify-content-center">
            <simple-card title="Cadastrar" sub_title="Novo admin" style="width: 50%;">
                <form @submit.prevent="register">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Nome</label>
                            <input type="text" class="form-control" v-model="form.name">
                            <div class="text-danger" v-if="errors.name">
                                {{ errors.name }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Email</label>
                            <input type="email" class="form-control" v-model="form.email">
                            <div class="text-danger" v-if="errors.email">
                                {{ errors.email }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Senha</label>
                            <input type="password" class="form-control" v-model="form.password">
                            <div class="text-danger" v-if="errors.password">
                                {{ errors.password }}
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Confirmar Senha</label>
                            <input type="password" class="form-control" v-model="form.password_confirmation">
                            <div class="text-danger" v-if="errors.password_confirmation">
                                {{ errors.password_confirmation }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2 d-flex justify-content-end">
                            <button-load text="Cadastrar" :load="load" class="btn btn-primary"></button-load>
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
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            }
        }
    },
    props: {
        errors: Object,
    },
    methods: {
        register() {
            let url = this.$route('admin.create');
            router.post(url, this.form, {
                onStart: () => {
                    this.load = true;
                },
                onSuccess: (page) => {
                    this.$alert.fire(
                        'Sucesso!',
                        'Administrador: '+page.props.fn_data.name+', cadastrado!',
                        'success'
                    );
                    this.form.name = '';
                    this.form.email = '';
                    this.form.password = '';
                    this.form.password_confirmation = '';
                },
                onFinish: () => {
                    this.load = false;
                }
            });
        }
    }
}
</script>
