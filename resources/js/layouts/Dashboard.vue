<template>
    <div id="layout-dashboard">
        <!-- Navbar -->
        <div class="myNavbar shadow">
            <div class="container">
                <a  href="#sideMenu" data-bs-toggle="offcanvas">
                    <i class="bi bi-list"></i>
                </a>
                <h3 class="text-center">Titulo</h3>
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
                    <li>
                        <a href="" class="active">
                            <i class="bi bi-speedometer2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="bi bi-list-task"></i>
                            Tarefas
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="bi bi-filetype-pdf"></i>
                            Relatorio
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="bi bi-person-gear"></i>
                            Perfil
                        </a>
                    </li>
                    <li>
                        <a href="" class="logout">
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
export default {

}
</script>
