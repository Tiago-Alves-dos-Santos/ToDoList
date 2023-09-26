<template>
    <layout-dashboard>
        <div class="w-100 d-flex justify-content-center">
            <simple-card title="Cadastrar" sub_title="Novo admin">
                <form @submit.prevent="">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Nome</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Email</label>
                            <input type="email" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Senha</label>
                            <input type="password" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Confirmar Senha</label>
                            <input type="password" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2 d-flex justify-content-end">
                            <button-load text="Cadastrar" class="btn btn-primary"></button-load>
                        </div>
                    </div>
                </form>
            </simple-card>
        </div>
    </layout-dashboard>
</template>
<script>
export default {

}
</script>
