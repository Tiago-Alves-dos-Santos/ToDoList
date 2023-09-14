<template>
    <div>
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
</template>
<script>
import { router } from '@inertiajs/vue3';
export default {
    props:{
        routes_fortify: Object,
        verified_email:{
            type: Boolean,
            required:true
        },
        email_time_expiration:{
            type: Number,
            required:true
        }
    },
    methods:{
        sendMail() {
            router.post(this.routes_fortify.verificationSend, {}, {
                onError: (errors) => {
                    this.$alert.fire(
                        'Erro!',
                        errors.error,
                        'error'
                    );
                },
                onSuccess: () => {
                    this.$alert.fire(
                        'Sucesso!',
                        'E-mail enviado! Verfique seu e-mail!',
                        'error'
                    );
                },
            });
        }
    }
}
</script>
