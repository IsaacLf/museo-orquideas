<template>
    <div>
        <div class="row justify-content mb-0">
            <div class="col md-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="background-color: white;">
                        <li class="breadcrumb-item" v-bind:class="[{active: isAllSelected, isDisabled: isAllSelected}]">
                            <a @click="isAllSelected = !isAllSelected" href="#">Todos ( {{ numEntry }} )</a>
                        </li>
                        <li class="breadcrumb-item" v-bind:class="[{active: !isAllSelected, isDisabled: !isAllSelected}]"> 
                            <a @click="isAllSelected = !isAllSelected" href="#">Mios ( {{ numMine }} )</a>
                        </li>
                    </ol>
                </nav>
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
                                <thead class="text-info">
                                    <tr>
                                        <th>ID</th>
                                        <th>Título</th>
                                        <th>Autor</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="entry in data" v-bind:key="entry.id">
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
            myEntries: []
        }
    },
    created: function(){
        this.getUserEntries();
    },
    computed: {
        data: function(){
            if(this.isAllSelected){
                return this.entries;
            }else{
                return this.myEntries;
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
        }
    }
}
</script>

