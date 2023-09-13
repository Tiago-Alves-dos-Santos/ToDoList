<template>
    <simple-card :title="title" class="container-task-card w-100">
        <div class="task-card">
            <div class="icon">
                <h1><i :class="icon"></i></h1>
            </div>
            <div class="text">
                <h1>{{text}}</h1>
            </div>
        </div>
    </simple-card>
</template>

<script>
export default {
    data() {
        return {

        }
    },
    props: {
        title: {
            type:String,
            required:true
        },
        icon: {
            type: String,
            default: 'bi bi-database'
        },
        text:{
            type: String,
            default: '0'
        }
    }
}
</script>
