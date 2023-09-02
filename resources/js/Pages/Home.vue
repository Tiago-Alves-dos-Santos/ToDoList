<template>
    <layout-auth ref="layout_auth">
        <div class="img-logo">
            <img src="img/favicon/list_100.png" alt="">
        </div>
        <simple-card title="Formulário" sub_title="Login" v-if="form_type_operation == dataTypeOperation.auth.login">
            <form method="POST">
                <div class="form-row">
                    <div class="col-12">
                        <label for="">Email</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="">Senha</label>
                        <input type="password" class="form-control">
                    </div>
                </div>
                <div class="form-row mt-2">
                    <div class="col-12 d-flex justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input pointer" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label pointer" for="flexCheckDefault">
                                Lembrar-me
                            </label>
                        </div>
                        <a href="#" class="link-danger" data-bs-toggle="modal" data-bs-target="#passwordRecovery">Esqueceu a senha?</a>
                    </div>
                </div>

                <div class="form-row mt-2">
                    <div class="col-12" style="display: flex; justify-content: space-between;">
                        <a class="icon-link" href="#" @click="toggleForm">
                            <i class="bi bi-arrow-left"></i>
                            Cadastrar
                        </a>
                        <button class="btn btn-success">Login</button>
                    </div>
                </div>
            </form>
        </simple-card>
        <simple-card title="Formulário" sub_title="Cadastro" v-else-if="form_type_operation == dataTypeOperation.auth.register">
            <form method="POST">
                <div class="form-row">
                    <div class="col-12">
                        <label for="">Email</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="">Nome</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="">Senha</label>
                        <input type="password" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="">Confirmar Senha</label>
                        <input type="password" class="form-control">
                    </div>
                </div>


                <div class="form-row mt-2">
                    <div class="col-12" style="display: flex; justify-content: space-between;">
                        <button class="btn btn-success">Cadastrar</button>
                        <a class="icon-link" href="#" @click="toggleForm">
                            Login
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </form>
        </simple-card>
    </layout-auth>

    <modal title="Recuperar senha" id="passwordRecovery">
        <form action="" method="post">
            <label for="">Digite o email da sua conta</label>
            <input type="email" class="form-control"/>
            <hr>
            <div class="w-100 d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Enviar email</button>
            </div>
        </form>
    </modal>
</template>
<script>
import TypeOperation from '../enums/TypeOperation';

export default {
    data() {
        return {
            dataTypeOperation: TypeOperation,
            form_type_operation: TypeOperation.auth.login
        }
    },
    methods: {
        toggleForm() {
            let middle_time = (0.75 / 2) * 1000;//(time-toggle-direction(animations.scss) / 2)*1000
            let value = this.form_type_operation == this.dataTypeOperation.auth.login ? this.dataTypeOperation.auth.register : this.dataTypeOperation.auth.login;
            this.$refs.layout_auth.loadAnimationToggleDirection(value);
            setTimeout(() => {
                this.form_type_operation = value;
            }, middle_time);
        }
    }
}
</script>
