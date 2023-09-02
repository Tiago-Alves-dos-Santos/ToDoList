<template>
    <layout-auth ref="layout_auth">
        <div class="img-logo">
            <img src="img/list_100.png" alt="">
        </div>
        <simple-card title="Formulário" sub_title="Login" v-if="form_type == 0">
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
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input pointer" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label pointer" for="flexCheckDefault">
                                Lembrar-me
                            </label>
                        </div>
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
        <simple-card title="Formulário" sub_title="Cadastro" v-else-if="form_type == 1">
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
</template>
<script>
export default {
    data() {
        return {
            form_type: 0
        }
    },
    methods: {

        toggleForm() {
            //0 - login
            let middle_time = (1 / 2) * 1000;
            let value = this.form_type == 1 ? 0 : 1;
            this.$refs.layout_auth.loadAnimationToggleDirection(value);
            setTimeout(() => {
                this.form_type = value;
            }, middle_time);
        }
    }
}
</script>
