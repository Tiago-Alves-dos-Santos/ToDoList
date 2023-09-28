<template>
    <div class="w-100">
        <table class="table table-striped">
            <thead>
                <slot name="thead"></slot>
            </thead>
            <tbody>
                <slot></slot>
            </tbody>
        </table>
    </div>
    <div class="w-100 d-flex justify-content-end">
        <!-- <paginate></paginate> -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
</template>
<script>
export default {

}
</script>
