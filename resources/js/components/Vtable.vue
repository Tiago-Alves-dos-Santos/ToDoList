<template>
    <div class="w-100">
        <div class="table-responsive-sm">
            <table class="table table-striped">
                <thead>
                    <slot name="thead"></slot>
                </thead>
                <tbody>
                    <slot></slot>
                </tbody>
            </table>
        </div>
    </div>
    <div class="w-100 d-flex justify-content-end">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li :class="{ 'page-item': true, 'disabled': currentPage === 1 }" @click="goToPage('prev')"
                    :disabled="currentPage === 1">
                    <a class="page-link" href="#">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </li>
                <li v-for="page in pages" :key="page" @click="goToPage(page)"
                    :class="{ 'active': currentPage == page, 'page-item': true }">
                    <a class="page-link" href="#">{{ page }}</a>
                </li>
                <li :class="{ 'page-item': true, 'disabled': currentPage === totalPages }" @click="goToPage('next')"
                    :disabled="currentPage === totalPages">
                    <a class="page-link" href="#">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>
<script>
export default {
    emits: ["currentPages"],
    data() {
        return {
            currentPage: 1,
        }
    },
    computed: {
        totalPages() {
            return Math.ceil(this.pagination.length / this.itemsPerPage);
        },
        pages() {
            const pages = [];
            for (let i = 1; i <= this.totalPages; i++) {
                pages.push(i);
            }
            return pages;
        }
    },
    props: {
        pagination: {
            type: Object,
            default: {}
        },
        itemsPerPage: {
            type: Number,
            default: 10
        }
    },
    methods: {
        currentPageData() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            // return this.pagination.slice(startIndex, endIndex);
            this.$emit('currentPages', startIndex, endIndex);
        },
        goToPage(page) {
            if (page === 'prev' && this.currentPage > 1) {
                this.currentPage--;
            } else if (page === 'next' && this.currentPage < this.totalPages) {
                this.currentPage++;
            } else if (typeof page === 'number' && page >= 1 && page <= this.totalPages) {
                this.currentPage = page;
            }
            this.currentPageData();
        }
    },
    mounted() {
        this.currentPageData();
    },
}
</script>
