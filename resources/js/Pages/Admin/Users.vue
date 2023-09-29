<template>
    <layout-dashboard>
        <simple-card title="Usuarios" class="w-100">
            <v-table :pagination="filterdUsers" :itemsPerPage="5"  @currentPages="currentPage">
                <template v-slot:thead>
                    <tr>
                        <th>
                            Nome
                            <input type="text" class="form-control" v-model="table.name">
                        </th>
                        <th>
                            E-mail
                            <input type="text" name="" id="" class="form-control" v-model="table.email">
                        </th>
                        <th>
                            Ativo
                            <select class="form-select" v-model="table.active">
                                <option value="1">Todos</option>
                                <option value="2">Ativos</option>
                                <option value="3">Inativos</option>
                            </select>
                        </th>
                        <th>
                            2FA
                            <select class="form-select" v-model="table.twoFA">
                                <option value="1">Todos</option>
                                <option value="2">Ativos</option>
                                <option value="3">Inativos</option>
                            </select>
                        </th>
                    </tr>
                </template>
                <tr v-for="value in filterdUsers.slice(this.table.startIndex, this.table.endIndex)" :key="value.id">
                    <td>{{ value.name }}</td>
                    <td>{{ value.two_factor_is_active }}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input custom-danger pointer" type="checkbox" role="switch"
                                id="flexSwitchCheckChecked">
                            <label class="form-check-label" for="flexSwitchCheckChecked">Ativo</label>
                        </div>
                    </td>
                    <td>
                        <button-load text="Desativado" class="btn btn-sm btn-outline-danger" :disable="true"
                            v-if="value.two_factor_is_active"></button-load>
                        <button-load text="Desativar" class="btn btn-sm btn-dark" v-else></button-load>
                    </td>
                </tr>
            </v-table>
        </simple-card>
    </layout-dashboard>
</template>
<script>
export default {
    data() {
        return {
            table: {
                name: '',
                email: '',
                active: 1,
                twoFA: 1,
                startIndex: 0,
                endIndex: 0,
            },
        };
    },
    props: {
        users: Object,
    },
    computed: {
        filterdUsers() {
            return this.users.filter(user => {
                return (
                    (user.name === '' || user.name.toLowerCase().includes(this.table.name.toLowerCase())) &&
                    (user.email === '' || user.email.toLowerCase().includes(this.table.email.toLowerCase())) &&
                    // (user.active === 1 || user.active == this.table.active) &&
                    (
                        this.table.twoFA == 1 ||
                        (this.table.twoFA == 2 && user.twoFA) ||
                        (this.table.twoFA == 3 && !user.twoFA)
                    )
                );
            });
        }
    },
    methods: {
        currentPage(startIndex, endIndex) {
            this.table.startIndex = startIndex;
            this.table.endIndex = endIndex;
        },
    },
    mounted() {
    }
}

</script>
