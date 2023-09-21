<template>
    <layout-center>
        <div id="index">
            <div class="conatiner-title-action">
                <div class="body">
                    <h1>Bem-Vindo ao ToDoList</h1>
                    <h3>Gerencie tarefas de forma eficaz. Comece agora:</h3>
                    <div class="action">
                        <button-load text="Administrador" type="button" class="pink" @click="routeTo('admin')"></button-load>
                        <button-load text="Cliente" type="button" class="purple" @click="routeTo('user')"></button-load>
                    </div>
                </div>
            </div>
            <div class="text">
                <p>
                    Comece a transformar seu dia a dia. Com o ToDoList, você terá o controle total das suas tarefas.
                    Simplifique sua vida e alcance suas metas com apenas alguns cliques.
                </p>
            </div>
        </div>
    </layout-center>
</template>
<script>
import LayoutCenter from '../layouts/Center.vue';
import { router } from '@inertiajs/vue3';
export default {
    components: {
        'layout-center': LayoutCenter,
    },
    data() {
        return {
            message: 'Hola Mundo'
        }
    },
    methods: {
        routeTo(route){
            // let url = this.$route(route);
            // router.get(url);
            router.get('/'+route);
        }
    }
}
</script>
