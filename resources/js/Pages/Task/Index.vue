<template>
    <layout-dashboard>
        <div id="task-index">
            <div class="w-100 d-flex justify-content-center">
                <simple-card title="Tarefas">
                    <div class="form">
                        <form @submit.prevent="create">
                            <input type="text" class="form-control me-2" placeholder="Sua tarefa..." v-model="form.task">
                            <button-load class="btn btn-success me-2" icon="bi bi-plus-circle-fill"
                                type="submit"></button-load>
                            <button-load class="btn btn-primary me-2" icon="bi bi-search" type="button"></button-load>
                            <button-load class="btn btn-danger" type="button" icon="bi bi-x"></button-load>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <div class="btn-group w-100" role="group" aria-label="Basic radio toggle button group">
                                <input type="checkbox" class="btn-check" name="" id="btnradio1" autocomplete="off" checked>
                                <label class="btn btn-outline-theme-primary" for="btnradio1">Não concluidas</label>

                                <input type="checkbox" class="btn-check" name="" id="btnradio2" autocomplete="off">
                                <label class="btn btn-outline-success" for="btnradio2">Concluidas</label>

                                <input type="checkbox" class="btn-check" name="" id="btnradio3" autocomplete="off">
                                <label class="btn btn-outline-danger" for="btnradio3">Excluidas</label>
                            </div>
                        </div>
                    </div>
                    <div class="task" v-for="task in tasks">
                        <h3>{{task.task}}</h3>
                        <div class="actions">
                            <button-load icon="bi bi-check-lg" title="Concluir"
                                class="btn btn-sm btn-success"></button-load>
                            <button-load icon="bi bi-pencil-fill" title="Editar"
                                class="btn btn-sm btn-warning"></button-load>
                            <button-load icon="bi bi-trash3-fill" title="Deletar"
                                class="btn btn-sm btn-danger"></button-load>
                        </div>
                    </div>
                    <div class="paginate w-100 mt-2 d-flex justify-content-end">
                        <paginate></paginate>
                    </div>
                </simple-card>
            </div>
        </div>
    </layout-dashboard>
</template>
<script>
import { router } from '@inertiajs/vue3';

export default {
    data() {
        return {
            form:{
                task: ''
            },
            numbers: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
    },
    props: {
        tasks: [Array, Object],
        errors: Object
    },
    methods: {
        create() {
            let route = this.$route('task.create');
            router.post(route, this.form);
        }
    }
}
</script>
