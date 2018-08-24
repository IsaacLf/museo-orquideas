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
                            <tr v-for="item in mData" v-bind:key="item.id">
                                <td>
                                    <div class="img-container">
                                        <img class="img-square" v-bind:src="asset+'/'+item.image + item.imageType" v-bind:alt="item.name">
                                    </div>
                                </td>
                                <td> {{ item.name }} </td>
                                <td> {{ getDate(item.created_at) }} </td>
                                <td>
                                    <div class="btn-group">
                                        <a @click="toggleEdit(item)" href="#" class="btn btn-round btn-info btn-sm" role="button" data-toggle="modal" data-target="#editarMedio">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a @click="deleteMedia(item.id)" href="#" class="btn btn-round btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                 <!-- Modal -->
                <div class="modal fade" id="editarMedio" tabindex="-1" role="dialog" aria-labelledby="editarMedioLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-muted">
                                <h5 class="modal-title" id="editarMedioLabel">Editar imagen</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-dark">
                                <div class="card mb-0 mt-0">
                                    <div class="row align-items-center">
                                        <div class="col-md-auto justify-content-center ml-4 mt-2 mb-2">
                                            <div class="my-column n">
                                                <img v-show="!uploadedNew" v-bind:src="asset+'/'+editFields.image + editFields.imageType" v-bind:alt="editFields.name" style="height: 150px; width: 150px; border-radius: 15%;">
                                                <img v-show="uploadedNew" v-bind:src="uploadedImageSrc" v-bind:alt="editFields.name" style="height: 150px; width: 150px; border-radius: 15%;">
                                                <div class="my-overlay">
                                                    <div class="upload-btn-wrapper" style="position: unset;">
                                                        <a href="#" class="icon">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <input type="file" class="myfile" name="newimage" id="image" @change="showUploadedImage" accept="image/*" form="editMedia">
                                                    </div>
                                                </div>
                                            </div>                                                                                        
                                        </div>
                                        <div class="col">
                                            <form id="editMedia" enctype="multipart/form-data">
                                                <div class="form-group row mt-0 mb-0">
                                                    <label class="col-md-3 col-form-label" for="mname">Nombre</label>
                                                    <div class="col">
                                                        <input class="form-control" type="text" name="name" id="mname" v-model="editFields.name">
                                                    </div>
                                                </div>
                                                <div class="form-group row mt-0 mb-0">
                                                    <label for="type" class="col-md-3 col-form-label">Nombre original</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="type" id="type" v-model="editFields.image" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row mt-0 mb-0">
                                                    <label for="type" class="col-md-3 col-form-label">Tipo</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="type" id="type" v-model="editFields.imageType" readonly>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="discardChanges">Cerrar</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="updateMedia">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
                <div class="alert alert-danger" role="alert" v-if="mData.length === 0 && stext === '' ">
                    <strong>Lo siento, no parece haber elementos aquí ... deberías subir algunos nuevos!!</strong>
                </div>
                <div class="alert alert-danger" role="alert" v-else-if="mData.length === 0 && stext !== '' ">
                    <strong>
                        No se ha encontrado ninguna coincidencia para "{{ stext}}"
                    </strong> 
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
        asset: {},
        stext: String,
    },
    data() {
        return {
            Media: [],
            editFields: {
                id: '',
                image: '',
                imageType: '',
                name: '',
                file: {}
            },
            uploadedNew: false,
            uploadedImage: {},
            formData : {}
        }
    },
    created: function(){
        // this.stext = 'g';
        // this.Media = this.media;
    },
    computed: {
        mData: function(){
            if(this.stext === ''){
                return this.media;
            }else{
                var text = this.stext;
                return _.filter(this.media, function(obj){
                    return (_.includes(_.toLower(obj.name), _.toLower(text)));
                });
            }
        },
        uploadedImageSrc: function(){
            if(this.uploadedNew == false){
                return '#';
            }else{
                return this.uploadedImage;
            }
        }        
    },
    methods: {
        getDate: function(value){
            return moment(value).locale('es').format('llll');
        },
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
        updateMedia: function(){
            let vm = this;
            if(vm.uploadedNew){
                var formData = new FormData();
                formData.append('Hola', 'Mundo');
                formData.append('Equis', 'De');
                formData.append('LoL', 'SoS');
                // formData.append('name', vm.editFields.name);
                // formData.append('newimage', vm.editFields.file);
                vm.formData = formData;
                fetch('api/media/' + vm.editFields.id, {
                    method: 'PUT',
                    body: formData,
                    headers: {
                        'Accept': 'application/json, application/xml, text/plain, text/html, *.*',
                    }
                })
                .then(res => res.json())
                .then(data => {
                    swal(
                        "Imagen actualizada correctamente",
                        {icon: 'success',
                        timer: 3000}
                    );
                    vm.$emit('call-api');
                })
                .catch(err => console.log(err));
            } else {
                fetch('api/media/' + vm.editFields.id, {
                    method: 'PUT',
                    body: JSON.stringify(vm.editFields),
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    swal(
                        "Imagen actualizada correctamente",
                        {icon: 'success',
                        timer: 3000}
                    );
                    vm.$emit('call-api');
                })
                .catch(err => console.log(err));
            }
        },
        toggleEdit: function(media){
            let vm = this;
            vm.editFields.id = media.id;
            vm.editFields.image = media.image;
            vm.editFields.imageType = media.imageType;
            vm.editFields.name = media.name;
        },
        showUploadedImage: function(ev){
            var vm = this;
            const file = ev.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e){
                vm.uploadedImage = e.target.result;
            } 
            reader.readAsDataURL(file);
            vm.editFields.file = file;
            vm.uploadedNew = true;
        },
        getUploadedImage: function(){
            if(this.uploadedNew == false){
                return '#';
            }else{
                var vm = this;
                return vm.uploadedImage;
            }
        },
        discardChanges: function(){
            let vm = this;
            vm.uploadedNew = false;
            vm.uploadedImage = '';
        }
    }
}
</script>

