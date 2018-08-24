<template>
    <div>
        <div class="row justify-content mb-0">
            <div class="col md-auto">
                <ul class="nav nav-pills nav-pills-icons nav-pills-primary nav-justify" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" @click="isAllSelected = true" href="#" v-bind:class="[{active: isAllSelected, isDisabled: isAllSelected}]" role="tab">
                            <i class="fas fa-star"></i>
                            Todos ( {{ numEntry }} )
                        </a>
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" @click="isAllSelected = false" href="#" v-bind:class="[{active: !isAllSelected, isDisabled: !isAllSelected}]" role="tab">
                            <i class="fas fa-user-check"></i>
                            Mios ( {{ numMine }} )
                        </a>
                    </li>
                    <form class="form-inline ml-2">
                        <input class="form-control text-dark" type="search" placeholder="Buscar por título" size="50" aria-label="Search" v-model="stext">
                    </form>
                </ul>

            </div>
        </div>
        <div class="row justify-content">
            <div class="col md-auto">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title">{{ Title }}</h4>
                        <p class="card-category">{{ Category }}</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-shopping">
                                <thead class="text-info text-center">
                                    <tr>
                                        <th>ID</th>
                                        <th>Título</th>
                                        <th :class="{'text-warning': !isAllSelected}">Autor</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr v-for="entry in aData" v-bind:key="entry.id">
                                        <td>{{entry.id}}</td>
                                        <td><a v-bind:href="url+'/'+entry.id">{{ entry.title }}</a></td>
                                        <td>{{ entry.author }}</td>
                                        <td>{{ getDate(entry.created_at) }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a :href="url+'/'+entry.id+'/edit'" class="btn btn-round btn-info btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a @click="deleteEntry(entry.id)" href="#" class="btn btn-round btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <a href="#" class="btn btn-round btn-warning btn-sm">
                                                    <i class="fas fa-qrcode"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="alert alert-danger" role="alert" v-if="aData.length === 0 && stext === '' ">
                            <strong>
                                No hay entradas disponibles, prueba escribiendo nuevas.
                            </strong>
                        </div>
                        <div class="alert alert-danger" role="alert" v-else-if="aData.length === 0 && stext !== '' ">
                            <strong>
                                No se ha encontrado ninguna coincidencia para "{{ stext }}"
                            </strong> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Entries from './Entries.vue'
import moment from 'moment'
import swal from 'sweetalert'
export default {
    props: {
        entry: {},
        mine: {},
        entries: {},
        user: {},
        url: String
    },
    data (){
        return {
            isAllSelected: true,
            Entries: [],
            myEntries: [],
            stext: ''
        }
    },
    created: function(){
        this.Entries = this.entries;
        this.getUserEntries();
    },
    computed: {
        aData:{
            get: function(){
                if(this.isAllSelected){
                    return this.getFiltered(this.Entries);
                }else{
                    return this.getFiltered(this.myEntries);
                }
            },
            set: function(array){
                this.myEntries = _.filter(this.array,['author', this.user.username])
            }
        },
        Title: function(){
            if(this.isAllSelected){
                return 'Todas las entradas';
            }else{
                return 'Mis entradas';
            }
        },
        Category: function(){
            if(this.isAllSelected){
                return 'Todas las entradas escritas por todos los usuarios';
            }else{
                return 'Todas las entradas escritas por mi';
            }
        },
        numEntry: function(){
            return this.Entries.length;
        },
        numMine: function(){
            return this.myEntries.length;
        }
    },
    methods: {
        getUserEntries: function(){
            this.myEntries = _.filter(this.Entries,['author', this.user.username]);
        },
        getDate: function(value){
            return moment(value).locale('es').format("llll");
        },
        getFiltered: function(array){
            var text = this.stext;
            if(text === ''){
                return array;
            }
            return _.filter(array, function(obj){
                return (_.includes(_.toLower(obj.title), _.toLower(text)));
            });
        },
        deleteEntry: function(eID){
            var vm = this;
            swal({
                title: "¿Desea eliminar esta entrada?",
                text: "¿Está seguro? !No será capaz de revertir esto!",
                icon: "warning",
                buttons: ["Cancelar","Sí, ¡Elimínalo!"],
                closeModal: true,
                dangerMode: true
            }).then((result) => { // <--
                if (result) { // <-- if confirmed
                    fetch('api/entries/' + eID, {method: 'delete'})
                    .then(res => res.json())
                    .then(data => {
                        swal(
                            "Entrada eliminada correctamente",
                            {icon: 'success',
                             timer: 3000}
                        );
                        vm.fetchEntries();
                    })
                    .catch(err => console.log(err));
                    
                }
            });
        },
        fetchEntries: function(){
            var vm = this;
            fetch('api/entries')
            .then(res => res.json())
            .then(res => {
                vm.updateEntries(res.data);
            });
        },
        updateEntries: function(array){
            let vm = this;
            vm.Entries = array;
            vm.myEntries = _.filter(array,['author', vm.user.username]);
        }
    }
}
</script>

