<template>
    <div id="layout-dashboard">
        <!-- Navbar -->
        <div class="myNavbar shadow">
            <div class="container">
                <a href="#sideMenu" data-bs-toggle="offcanvas">
                    <i class="bi bi-list"></i>
                </a>
                <h3 class="text-center">{{$page.props.title}}</h3>
            </div>
        </div>
        <!-- Fim Navbar -->
        <!-- Sidebar -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="sideMenu" aria-labelledby="sideMenuLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="sideMenuLabel">MyList</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul>
                    <li v-for="(value, index) in $page.props.menuLinks" :key="index">
                        <Link :href="value.url" class="active">
                        <i :class="value.icon"></i>
                        {{ value.label }}
                        </Link>
                    </li>

                    <li>
                        <a @click="logout" class="logout">
                            <i class="bi bi-box-arrow-left"></i>
                            Sair
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Fim Sidebar -->
        <div class="container p-2">
            <slot></slot>
        </div>

    </div>
</template>
<script>
import { router } from '@inertiajs/vue3';

export default {
    data() {
        return {

        }
    },
    methods: {
        toProfile() {
            let url = (this.$page.props.guard == 'admin') ? this.$route('admin.viewProfile') : this.$route('user.viewProfile');
            router.get(url);
        },
        logout() {
            router.post('/logout');
            // router.post('/admin/logout');
        }
    }
}
</script>
