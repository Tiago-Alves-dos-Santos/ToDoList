<template>
    <layout-dashboard>
        <simple-card title="Admins" class="w-100">
            <v-table :pagination="filteredAdmins" :itemsPerPage="5" @currentPages="currentPage">
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
                <tr v-for="value in filteredAdmins.slice(this.table.startIndex, this.table.endIndex)" :key="value.id">
                    <td>{{value.name}}</td>
                    <td>{{value.email}}</td>
                    <td>
                        <button-load text="Deletar" :load="loads.delete" class="btn btn-sm btn-danger" @click="exclude(value)"></button-load>
                    </td>
                </tr>
            </v-table>
        </simple-card>
    </layout-dashboard>
</template>
<script>
import { router } from '@inertiajs/vue3';
export default {
    data() {
        return {
            table:{
                name:'',
                email:'',
                startIndex:'',
                endIndex:'',
            },
            loads:{
                delete: false,
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
    methods: {
        currentPage(startIndex, endIndex) {
            this.table.startIndex = startIndex;
            this.table.endIndex = endIndex;
        },
        exclude(admin) {
            let url = this.$route('admin.delete', { id: admin.id });
            this.$alert.fire({
                title: 'Deseja prosseguir com deleção?',
                text: 'Administrador: ' + admin.name,
                showCancelButton: true,
                confirmButtonText: 'Cancelar',
                cancelButtonText: 'Deletar',
            }).then((result) => {
                if (result.isDismissed) { //desativar
                    router.delete(url, {}, {
                        onStart: () => {
                            this.loads.delete = true;
                        },
                        onFinish: () => {
                            this.loads.delete = false;
                        },
                    });
                }
            })
        },
    }
}
</script>
