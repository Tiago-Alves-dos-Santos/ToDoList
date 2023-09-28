<template>
    <layout-dashboard>
        <simple-card title="Usuarios" class="w-100">
            <v-table>
                <template v-slot:thead>
                    <tr>
                        <th>
                            Nome
                            <input type="text" name="" id="" class="form-control">
                        </th>
                        <th>
                            E-mail
                            <input type="text" name="" id="" class="form-control">
                        </th>
                        <th>
                            Ativo
                            <select class="form-select" aria-label="Default select example">
                                <option value="1">Todos</option>
                                <option value="2">Ativos</option>
                                <option value="3">Inativos</option>
                            </select>
                        </th>
                        <th>
                            2FA
                            <select class="form-select" aria-label="Default select example">
                                <option value="1">Todos</option>
                                <option value="2">Ativos</option>
                                <option value="3">Inativos</option>
                            </select>
                        </th>
                    </tr>
                </template>
                <tr>
                    <td>User 1</td>
                    <td>email@email.com</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input custom-danger pointer" type="checkbox" role="switch"
                                id="flexSwitchCheckChecked" checked>
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
                            <input class="form-check-input custom-danger pointer" type="checkbox" role="switch"
                                id="flexSwitchCheckChecked">
                            <label class="form-check-label" for="flexSwitchCheckChecked">Ativo</label>
                        </div>
                    </td>
                    <td>
                        <button-load text="Desativar" class="btn btn-sm btn-dark"></button-load>
                    </td>
                </tr>
            </v-table>
        </simple-card>
    </layout-dashboard>
</template>
<script>
export default {
    data() {
        return {};
    },
}
</script>
