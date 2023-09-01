<template>
    <div class="card" style="width: 25rem;">
        <div class="card-body">
            <h5 class="card-title text-center">{{title}}</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary text-center">{{sub_title}}</h6>
            <slot></slot>
        </div>
    </div>
</template>

<script setup>
    defineProps({
        title: {
            type: String,
            required: true
        },
        sub_title: {
            type:String,
            default:''
        }
    });

</script>
