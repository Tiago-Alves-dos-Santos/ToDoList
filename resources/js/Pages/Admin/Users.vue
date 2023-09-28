<template>
    <layout-dashboard>
        <simple-card title="Usuarios" class="w-100">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ativo</th>
                        <th>2FA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>User 1</td>
                        <td>email@email.com</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input custom-danger pointer" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                                    checked>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Ativo</label>
                            </div>
                        </td>
                        <td>
                            <button-load text="Desativado" class="btn btn-sm btn-outline-danger" :disable="true"></button-load>
                        </td>
                    </tr>
                    <tr>
                        <td>User 1</td>
                        <td>email@email.com</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input custom-danger pointer" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                                    >
                                <label class="form-check-label" for="flexSwitchCheckChecked">Ativo</label>
                            </div>
                        </td>
                        <td>
                            <button-load text="Desativar" class="btn btn-sm btn-dark"></button-load>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="w-100 d-flex justify-content-end">
                <!-- <paginate></paginate> -->

            </div>
        </simple-card>
    </layout-dashboard>
</template>
<script>
import { Paginate } from '../../components';

export default {
    data() {
        return {};
    },
    components: { Paginate }
}
</script>
