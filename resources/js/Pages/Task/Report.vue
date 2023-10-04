<template>
    <layout-dashboard>
        <simple-card title="Imprimir PDF" sub_title="Selecione a data" class="w-100">
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Data inicio</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="">Data Fim</label>
                        <input type="date" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button-load icon="bi bi-filetype-pdf" class="btn btn-danger" title="Imprimir"></button-load>
                    </div>
                </div>
            </form>
        </simple-card>
    </layout-dashboard>
</template>
<script>
export default {
    data() {
        return {

        }
    },
}
</script>
