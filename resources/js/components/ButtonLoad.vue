
<template>
    <button :disabled="load">
        <div class="spinner-border text-light spinner-border-sm" role="status" v-if="load">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div>
            <span v-if="text && !load" v-text="text"></span>
            <span v-if="icon && !load" class="fs-5">
                <i :class="icon"></i>
            </span>
        </div>
    </button>
</template>
<script>
export default {
    data() {
        return {

        }
    },
    props:{
        text:{
            type:String,
            default:''
        },
        load:{
            type:Boolean,
            default: false
        },
        icon: {
            type: String,
            default: ''
        }
    }
}
</script>
