<template>
    <layout-dashboard>
        <div id="auth-profile">
            <div class="row">
                <div class="col-12">
                    <simple-card title="Seu perfil" class="w-100">
                        <form>
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
                                        <span :class="[user.email_verified_at ? 'text-success' : 'text-danger']">
                                            {{ user.email_verified_at ? 'Verificado' : 'Não verificado' }}
                                        </span>
                                    </label>
                                    <input type="text" name="" id="" class="form-control" v-model="user.email">
                                </div>
                            </div>
                            <div class="form-row mt-2">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button-load text="Salvar" class="btn btn-success" type="submit"></button-load>
                                </div>
                            </div>
                        </form>
                    </simple-card>
                </div>
            </div>

        </div>
    </layout-dashboard>
</template>
<script>
export default {
    computed: {
        user(){
            return this.$page.props.auth.user
        },
    }
}
</script>
