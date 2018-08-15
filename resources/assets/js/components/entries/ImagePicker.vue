<template>
    <div>
        <div class="card bg-dark">
            <div class="card-header mb-2">
                <h6 class="card-title"><strong>Imagen destacada</strong></h6> 
            </div>
            <div class="card-body mb-4">
                <!-- Modal -->
                <div class="modal fade" id="elegirImagen" tabindex="-1" role="dialog" aria-labelledby="elegirImagenLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-muted">
                                <h5 class="modal-title" id="elegirImagenLabel">Seleccione o suba alguna imagen</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-dark">
                                <div class="img-group fixed-height">
                                    <img v-for="image in images" :key="image.id" :src="asset+'/'+image.image" :alt="image.name" class="img-item">
                                </div>
                                <hr>
                                <div class="text-center">
                                    <div class="upload-btn-wrapper">
                                        <button class="btn btn-info">
                                            <i class="fas fa-file-image"></i>
                                            <strong>Subir una imagen</strong>
                                        </button>
                                        <input type="file" class="btn btn-secondary" id="image">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
                <div class="mt-2">
                    <button class="btn btn-secondary" role="button" data-toggle="modal" data-target="#elegirImagen">
                        <i class="fas fa-image"></i>
                        Establecer imagen
                    </button>
                </div>
            </div>
            <div v-if="entry.image != null" class="card-avatar">
                <img :src="asset + '/' + entry.image + entry.imageType" :alt="entry.title" class="img img-resize">
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:{
        images: Array,
        entry: {},
        asset: String
    },
    dta: function(){
        return {

        }
    },
    methods:{
        
    }
}
</script>
