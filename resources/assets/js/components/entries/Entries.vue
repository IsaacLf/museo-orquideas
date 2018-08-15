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
                                                <a href="#" class="btn btn-round btn-danger btn-sm">
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
export default {
    props: {
        entry: {},
        mine: {},
        entries: {},
        user: {},
        url: {}
    },
    data (){
        return {
            numEntry: JSON.parse(this.entry),
            numMine: JSON.parse(this.mine),
            isAllSelected: true,
            myEntries: [],
            stext: ''
        }
    },
    created: function(){
        this.getUserEntries();
    },
    computed: {
        aData: function(){
            if(this.isAllSelected){
                return this.getFiltered(this.entries);
            }else{
                return this.getFiltered(this.myEntries);
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
        }
    },
    methods: {
        getUserEntries: function(){
            this.myEntries = _.filter(this.entries,['author', this.user.username]);
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
        }
    }
}
</script>

