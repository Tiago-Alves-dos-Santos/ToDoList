<template>
    <layout-dashboard>
        <div id="auth-home" class="w-100">
            <div class="row">
                <div class="col-md-12">
                    <div v-if="!verified_email">
                        <div class="alert alert-warning d-flex justify-content-center align-items-center" role="alert">
                            <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" style="font-size: 30px;"
                                role="img" aria-label="Warning:"></i>
                            <div>
                                <p>
                                    Confirme seu email! Novo login não sera permitido caso email não confirmado! <br>
                                    Você tera apenas {{ email_time_expiration }} minutos para confirmar seu email!<br>
                                    Você tera uma tentativa a cada 3 minutos
                                </p>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <p> Reenviar email: </p>
                                    <a class="btn btn-primary d-inline-block" @click="sendMail">Reenviar email</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <icon-card title="Tarefas Total" icon="bi bi-database" text="35" class="hover-yellow"></icon-card>
                </div>
                <div class="col-md-4">
                    <icon-card title="Tarefas Concluidas" icon="bi bi-database-check" text="35"
                        class="hover-green"></icon-card>
                </div>
                <div class="col-md-4">
                    <icon-card title="Tarefas Excluidas" icon="bi bi-database-dash" text="35" class="hover-red"></icon-card>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <simple-card :title="`Gráfico mensal: ${monthNowFormat}`" class="bg-white w-100"></simple-card>
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

        }
    },
    computed: {
        monthNowFormat() {
            let date = new Date();
            let month = date.getMonth() + 1;
            const formattedMonth = month < 10 ? `0${month}` : month.toString();
            return formattedMonth + "/" + date.getFullYear();
        }
    },
    props: {
        verified_email: Boolean,
        email_time_expiration: Number,
    },
    methods: {
        sendMail() {
            let url = this.$route('teste');
            router.get(url, {}, {
                onError: (errors) => {
                    console.log(errors);
                    this.$alert.fire(
                        'Erro!',
                        errors.error,
                        'error'
                    )
                },

            });
            console.log('envio ' + url)
            // this.$alert.fire(
            //     'Enviar email!',
            //     'You clicked the button!',
            //     'success'
            // )
        }
    }
}
</script>
