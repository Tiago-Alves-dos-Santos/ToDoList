<template>
    <layout-dashboard>
        <div id="auth-home" class="w-100">
            <div class="row">
                <div class="col-md-4">
                    <icon-card title="Tarefas Não Concluidas" icon="bi bi-database" :text="info_card.pending.value"
                        class="hover-yellow"></icon-card>
                </div>
                <div class="col-md-4">
                    <icon-card title="Tarefas Concluidas" icon="bi bi-database-check" :text="info_card.completed.value"
                        class="hover-green"></icon-card>
                </div>
                <div class="col-md-4">
                    <icon-card title="Tarefas Excluidas" icon="bi bi-database-dash" :text="info_card.deleted.value"
                        class="hover-red"></icon-card>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <simple-card :title="`Gráfico mensal: ${monthNowFormat}`" class="bg-white w-100">
                        <apexchart style="width: 100%;" height="300" type="bar" :options="options" :series="series">
                        </apexchart>
                    </simple-card>
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
            options: {
                chart: {
                    type: 'bar',
                },
                fill: {
                    colors: ['#2a2a2a']
                },
                plotOptions: {
                    bar: {
                        horizontal: false
                    }
                },
            },
        }
    },
    computed: {
        monthNowFormat() {
            let date = new Date();
            let month = date.getMonth() + 1;
            const formattedMonth = month < 10 ? `0${month}` : month.toString();
            return formattedMonth + "/" + date.getFullYear();
        },
        series() {
            let array = [];
            Object.values(this.info_card).forEach(value => {
                array.push({
                    x: value.name,
                    y: value.value
                });
            });

            return [
                {
                    data: array
                }
            ];

        },
    },
    props: {
        routes_fortify: Object,
        info_card: Object,
    },
    methods: {

    },
    mounted() {
    }
}
</script>
