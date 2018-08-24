<template>
    <div>
        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title">Vista de Cuadrícula</h4>
            </div>
            <div class="card-body">
                <!-- <div class="img-group-8" v-if="media.length > 0">
                    <img v-for="item in media" v-bind:key="item.id" class="img-item" v-bind:src="asset+'/'+item.image + item.imageType" v-bind:alt="item.name">
                </div> -->
                <!-- This is to prove something -->
                <div class="row" v-if="media.length > 0">
                    <div class="my-column" v-for="item in media" v-bind:key="item.id">
                        <img :src="asset+ '/' + item.image + item.imageType" :alt="item.name">
                        <div class="my-overlay">
                            <a @click="deleteMedia(item.id)" href="#" class="icon">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="alert alert-danger" v-else>
                    <strong>Lo siento, no parece haber elementos aquí ... deberías subir algunos nuevos!!</strong>
                </div>
            </div>            
        </div>
    </div>
</template>
<script>
export default {
    props:{
        media: {},
        asset: {}
    },
    data() {
        return {
            
        }
    },
    methods: {
        deleteMedia: function(id){
            let vm = this;
            swal({
                title: "¿Desea eliminar esta imagen?",
                text: "¿Está seguro? Esta imagen puede estar asociada a alguna entrada, si la elimina, las entradas que tengan asignada esta foto no se verán",
                icon: "warning",
                buttons: ["Cancelar","Sí, lo entiendo"],
                closeModal: true,
                dangerMode: true
            }).then((result) => { // <--
                if (result) { // <-- if confirmed
                    fetch('api/media/' + id, {method: 'delete'})
                    .then(res => res.json())
                    .then(data => {
                        swal(
                            "Imagen eliminada correctamente",
                            {icon: 'success',
                             timer: 3000}
                        );
                        vm.$emit('call-api');
                    })
                    .catch(err => console.log(err));
                    
                }
            });
        },
    }
}
</script>
