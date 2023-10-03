<template>
    <layout-dashboard>
        <div id="auth-home" class="w-100">
            <div class="row">
                <div class="col-md-4">
                    <icon-card title="Tarefas Não Concluidas" icon="bi bi-database" :text="info_card.pending" class="hover-yellow"></icon-card>
                </div>
                <div class="col-md-4">
                    <icon-card title="Tarefas Concluidas" icon="bi bi-database-check" :text="info_card.completed"
                        class="hover-green"></icon-card>
                </div>
                <div class="col-md-4">
                    <icon-card title="Tarefas Excluidas" icon="bi bi-database-dash" :text="info_card.deleted" class="hover-red"></icon-card>
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
        routes_fortify: Object,
        info_card: Object,
    },
    methods: {

    }
}
</script>
