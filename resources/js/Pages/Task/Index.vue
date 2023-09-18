<template>
    <layout-dashboard>
        <div id="task-index">
            <div class="w-100 d-flex justify-content-center">
                <simple-card title="Tarefas">
                    <div class="form">
                        <form>
                            <input type="text" class="form-control me-2" placeholder="Sua tarefa...">
                            <button-load class="btn btn-success me-2" icon="bi bi-plus-circle-fill"></button-load>
                            <button-load class="btn btn-primary me-2" icon="bi bi-search"></button-load>
                            <button-load class="btn btn-danger" icon="bi bi-x"></button-load>
                        </form>
                    </div>
                    <div class="task" v-for="number in numbers">
                        <h3>Tarefa</h3>
                        <div class="actions">
                            <button-load icon="bi bi-check-lg" title="Concluir" class="btn btn-sm btn-success"></button-load>
                            <button-load icon="bi bi-pencil-fill" title="Editar" class="btn btn-sm btn-warning"></button-load>
                            <button-load icon="bi bi-trash3-fill" title="Deletar" class="btn btn-sm btn-danger"></button-load>
                        </div>
                    </div>
                </simple-card>
            </div>
        </div>
    </layout-dashboard>
</template>
<script>
export default{
    data(){
        return{
            numbers: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }
    }
}
</script>
