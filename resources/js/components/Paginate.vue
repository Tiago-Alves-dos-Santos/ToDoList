<template>
    <nav aria-label="Page navigation">
        <div class="loader" v-if="load">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <ul class="pagination">
            <li v-if="pagination.prev_page_url" class="page-item">
                <a class="page-link" @click="paginate(pagination.prev_page_url)">Anterior</a>
            </li>
            <li v-for="page in pagination.last_page" :key="page" :class="{ 'active': page == pagination.current_page }"
                class="page-item">
                <a class="page-link" @click="paginate(page)">{{ page }}</a>
            </li>
            <li v-if="pagination.next_page_url" class="page-item">
                <a class="page-link" @click="paginate(pagination.next_page_url)">Próximo</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            load: false,
        }
    },
    props: {
        pagination: Object,
    },
    methods: {
        paginate(page) {
            this.$emit('paginate', page);
        },
        setLoad(load){
            this.load = load;
        }
    },
};
</script>
