<template>
    <layout-dashboard>
        <div id="auth-home" class="w-100">
            <div class="row">
                <div class="col-md-12">
                    <alert-email-verify :verified_email="verified_email" :email_time_expiration="email_time_expiration"
                        :routes_fortify="routes_fortify"></alert-email-verify>
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
import AlertEmailVerify from '../../components_static/AlertEmailVerify.vue';
export default {
    data() {
        return {

        }
    },
    components: {
        'alert-email-verify': AlertEmailVerify
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
        routes_fortify: Object
    },
    methods: {

    }
}
</script>
