<template>
    <div>
        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title">Vista de Lista</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-shopping">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="media.length === 0" >
                                <td>
                                    No hay elementos
                                </td>
                                <td>Para subir uno nuevo</td>
                                <td>Pulsa el botón "añadir nuevo"</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-round btn-info btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-round btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr v-for="item in media" v-bind:key="item.id">
                                <td>
                                    <div class="img-container">
                                        <img class="img-square" v-bind:src="asset+'/'+item.image" v-bind:alt="item.name">
                                    </div>
                                </td>
                                <td> {{ item.name }} </td>
                                <td> {{ getDate(item.created_at) }} </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-round btn-info btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-round btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
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
</template>
<script>
import moment from 'moment'
export default {
    props: {
        media: {},
        asset: {}
    },
    data() {
        return {

        }
    },
    methods: {
        getDate: function(value){
            return moment(value).locale('es').format('llll');
        }
    }
}
</script>

