<template>
    <layout-dashboard>
        <div id="task-index">
            <div class="w-100 d-flex justify-content-center">
                <simple-card title="Tarefas">
                    <div class="form">
                        <form @submit.prevent="create">
                            <input type="text" ref="task_input" class="form-control me-2" placeholder="Sua tarefa..."
                                v-model="form.task">
                            <button-load class="btn btn-success me-2" icon="bi bi-plus-circle-fill" type="submit"
                                :load="loads.create" title="Cadastrar"></button-load>
                            <button-load class="btn btn-primary me-2" icon="bi bi-search" type="button" @click="search"
                                title="Buscar" :load="loads.search"></button-load>
                            <button-load class="btn btn-danger" type="button" icon="bi bi-x" title="Limpar Filtro"
                                :load="loads.clear" @click="clearSearch"></button-load>
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
                    <div class="task" v-for="task in tasks.data">
                        <h3>{{ task.task }}</h3>
                        <div class="actions">
                            <button-load icon="bi bi-check-lg" title="Concluir"
                                class="btn btn-sm btn-success"></button-load>
                            <button-load icon="bi bi-pencil-fill" title="Editar" class="btn btn-sm btn-warning"
                                @click="updateAlert(task)"></button-load>
                            <button-load icon="bi bi-trash3-fill" title="Deletar"
                                class="btn btn-sm btn-danger" @click="deleteAlert(task)"></button-load>
                        </div>
                    </div>
                    <div class="paginate w-100 mt-2 d-flex justify-content-end">
                        <paginate ref="paginate_task" :pagination="tasks" @paginate="paginate"></paginate>
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
            loads: {
                create: false,
                clear: false,
                search: false,
            },
            form: {
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
            router.post(route, this.form, {
                onStart: () => {
                    this.loads.create = true;
                },
                onSuccess: () => {
                    this.form.task = '';
                    this.$refs.task_input.focus();
                },
                onFinish: () => {
                    this.loads.create = false;
                }
            });
        },
        updateAlert(task) {
            this.$alert.fire({
                title: 'Editar tarefa',
                input: 'text',
                inputValue: task.task,
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Editar',
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = this.$route('task.update', [task.id]);
                    router.put(url, {
                        task: result.value
                    });
                }
            });
        },
        deleteAlert(task) {
            this.$alert.fire({
                title: 'Deseja deletar a tarefa: '+task.task+' ?',
                text: "A deleção não possui restauração!",
                showCancelButton: true,
                confirmButtonText: 'Cancelar',
                cancelButtonText: 'Deletar',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isDismissed) {
                    let url = this.$route('task.delete', [task.id]);
                    router.delete(url);
                }
            })
        },
        search() {
            router.visit(this.$inertia.page.url, {
                data: this.form,
                preserveState: true,
                onStart: () => this.loads.search = true,
                onFinish: () => this.loads.search = false,
            });
        },
        clearSearch() {
            let url = this.$route('task.index');
            router.get(url, {}, {
                onStart: () => {
                    this.loads.clear = true;
                },
                onSuccess: () => {
                    this.form.task = '';
                    this.$refs.task_input.focus();
                },
                onFinish: () => {
                    this.loads.clear = false;
                }
            });
        },
        paginate(page_click) {
            router.visit(this.$inertia.page.url, {
                data: {
                    page: page_click
                },
                preserveState: true,
                onStart: () => this.$refs.paginate_task.setLoad(true),
                onFinish: () => this.$refs.paginate_task.setLoad(false)
            });
        },
    }
}
</script>
