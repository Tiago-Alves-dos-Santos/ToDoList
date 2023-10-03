<template>
    <layout-dashboard>
        <simple-card title="Admins" class="w-100">
            <v-table>
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
                            Ação
                        </th>
                    </tr>
                </template>
                <tr v-for="value in filteredAdmins" :key="value.id">
                    <td>{{value.name}}</td>
                    <td>{{value.email}}</td>
                    <td>
                        <button-load text="Deletar" class="btn btn-sm btn-danger"></button-load>
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
            table:{
                name:'',
                email:''
            }
        }
    },
    props: {
        admins: Object
    },
    computed: {
        filteredAdmins() {
            return this.admins.filter(admin => {
                return (
                    (admin.name === '' || admin.name.toLowerCase().includes(this.table.name.toLowerCase())) &&
                    (admin.email === '' || admin.email.toLowerCase().includes(this.table.email.toLowerCase()))
                );
            });
        }
    },
}
</script>
