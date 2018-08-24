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
                                    <img v-for="image in images" :key="image.id" :src="asset+'/'+image.image+image.imageType" :alt="image.name" class="img-item" @click="changeInputValue(image)">
                                    <input type="hidden" name="pickedImage" id="pickedImage" form="createForm" v-model="inputValue">
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col align-self-center text-center">
                                        <div class="upload-btn-wrapper">
                                            <button class="btn btn-info" style="margin: 0 auto; display: block;">
                                                <i class="fas fa-file-image"></i>
                                                <strong>Subir una imagen</strong>
                                            </button>
                                            <input type="file" class="btn btn-secondary" name="image" id="image" form="createForm" @change="showUploadedImage" accept="image/*">
                                        </div>
                                    </div>
                                    <hr>
                                    <div v-show="inputValue && selected" class="col text-center">
                                        <img :src="getSelectedImage()" alt="selected" style="object-fit: cover; width: 100px; height: 100px; border-radius: 50%;">
                                        <span class="badge badge-pill badge-primary">
                                            <i class="fas fa-caret-left"></i>
                                            <strong>Seleccionada</strong>
                                        </span>
                                    </div>
                                    <div v-show="uploadedImage != undefined && !selected" class="col text-center">
                                        <img :src="newImageURL" alt="uploaded" style="object-fit: cover; width: 100px; height: 100px; border-radius: 50%;">
                                        <span class="badge badge-pill badge-primary">
                                            <i class="fas fa-caret-left"></i>
                                            <strong>Seleccionada</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="showSelectedImage()">Aceptar</button>
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
            <div v-if="entry.image != null && !showImage && uploadedImage == undefined" class="card-avatar">
                <img :src="asset + '/' + entry.image + entry.imageType" :alt="entry.title" class="img img-resize">
            </div>
            <div v-if="showImage && selected" class="card-avatar">
                <img :src="getSelectedImage()" alt="selected image" class="img img-resize">
            </div>
            <div v-if="uploadedImage != undefined && !selected" class="card-avatar">
                <img :src="newImageURL" alt="uploaded image" class="img img-resize">
            </div>
            <input form="createForm" type="hidden" id="lastSelected" name="lastSelected" v-model="lastSelected">
        </div>
    </div>
</template>
<script>
export default {
    props:{
        images: Array,
        entry: {},
        asset: String,
    },
    data: function(){
        return {
            inputValue: 0,
            selectedImage: {},
            showImage: false,
            uploadedImage: undefined,
            selected: false,
            lastSelected: ''
        }
    },
    computed:{
        newImageURL: function(){
            if(this.uploadedImage != undefined){
                return this.uploadedImage;
            }else{
                return '#';
            }
        }
    },
    methods:{
        changeInputValue: function(img){
            this.inputValue = img.id;
            this.selectedImage = img;
            this.selected = true;
            this.lastSelected = 'media';
        },
        getSelectedImage: function(){
            if(this.inputValue == 0){
                return '#'
            }else{
                var vm = this;
                var image = _.find(this.images, function(img){
                    return img.image == vm.selectedImage.image;
                });
                return vm.asset + '/' + image.image + image.imageType;
            }
        },
        showSelectedImage: function() {
            if(this.inputValue){
                this.showImage = true;
            }
        },
        showUploadedImage: function(ev){
            var vm = this;
            const file = ev.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e){
                vm.uploadedImage = e.target.result;
            } 
            reader.readAsDataURL(file);
            this.selected = false;
            this.lastSelected = 'upload';
        }    
    }
}
</script>
