<template>
    <div>
        <layout-dashboard>

            <div class="row">
                <div class="col-md-12">
                    <div v-if="!verified_email">
                        <div class="alert alert-warning d-flex justify-content-center align-items-center" role="alert">
                            <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" style="font-size: 30px;"
                                role="img" aria-label="Warning:"></i>
                            <div>
                                <p>
                                    Confirme seu email! Novo login não sera permitido caso email não confirmado! <br>
                                    Você tera apenas {{ email_time_expiration }} minutos para confirmar seu email!
                                </p>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <p> Reenviar email: </p>
                                    <a class="btn btn-primary d-inline-block">Reenviar email</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <simple-card title="Tarefas total" class="bg-white w-100">

                    </simple-card>
                </div>
                <div class="col-md-4">
                    <simple-card title="Tarefas concluidas" class="bg-white w-100">

                    </simple-card>
                </div>
                <div class="col-md-4">
                    <simple-card title="Tarefas excluidas" class="bg-white w-100">

                    </simple-card>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <simple-card :title="`Gráfico mensal: ${monthNowFormat}` " class="bg-white w-100">

                    </simple-card>
                </div>
            </div>
        </layout-dashboard>

    </div>
</template>
<script>
export default {
    data() {
        return {

        }
    },
    computed: {
        monthNowFormat() {
            let date = new Date();
            let month = date.getMonth() + 1;
            const formattedMonth = month < 10 ? `0${month}` : month.toString();
            return formattedMonth+"/"+date.getFullYear();
        }
    },
    props: {
        verified_email: Boolean,
        email_time_expiration: Number,
    },
    methods: {

    }
}
</script>
