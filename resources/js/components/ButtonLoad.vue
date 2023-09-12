
<template>
    <button :disabled="load">
        <div class="spinner-border text-light spinner-border-sm" role="status" v-if="load">
            <span class="visually-hidden">Loading...</span>
        </div>
        <span v-text="text" v-if="!load"></span>
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
            required:true
        },
        load:{
            type:Boolean,
            default: false
        }
    }
}
</script>
page
