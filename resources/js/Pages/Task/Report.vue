<template>
    <layout-dashboard>
        <simple-card title="Imprimir PDF" sub_title="Selecione a data" class="w-100 bg-white">
            <form @submit.prevent="printPDF" method="post" :action="routePrintPDF" ref="formPDF" target="_blank">
                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" name="allData" :value="allData">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Data inicio</label>
                        <VueDatePicker v-model="date" locale="pt-BR" :format="formatDate(date)" :minDate="min_date"
                            :maxDate="new Date()"></VueDatePicker>
                    </div>
                    <div class="col-md-6">
                        <label for="">Data Fim</label>
                        <VueDatePicker v-model="dateEnd" locale="pt-BR" :format="formatDate(dateEnd)" :minDate="min_date"
                            :maxDate="new Date()"></VueDatePicker>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button-load icon="bi bi-filetype-pdf" class="btn btn-danger" title="Imprimir"
                            type="submit"></button-load>
                    </div>
                </div>
            </form>
        </simple-card>
    </layout-dashboard>
</template>
<script>
import { router } from '@inertiajs/vue3';

export default {
    data() {
        return {
            date: new Date(this.min_date),
            dateEnd: new Date(),
            allData: []
        }
    },
    computed: {
        csrf() {
            return this.$page.props.csrf_token;
        },
    },
    props: {
        routePrintPDF: String,
        min_date: String,
    },
    methods: {
        formatDate(date) {
            // let date = new Date();
            const day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();

            return `${day}/${month}/${year}`;
        },

        printPDF() {
            const json = JSON.stringify({
                dateStart: this.date,
                dateEnd: this.dateEnd,
            });

            this.allData.push(json);
            //para esperar setar dados no 'allData'
            setTimeout(() => {
                this.$refs.formPDF.submit();
                this.allData = [];
            }, 500);
        },

    },
    mounted() {
    }
}
</script>
