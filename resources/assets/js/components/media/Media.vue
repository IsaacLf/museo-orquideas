<template>
    <div>
        <div class="row">
            <div class="col-md-auto">
                <h1 class="my-inline-block">Biblioteca de medios</h1>
            </div>
            <div class="col-md-auto">
                <a href="#" @click="flag = !flag" class="btn btn-warning">
                    {{ flag ? 'Ocultar' : 'Añadir nuevo' }}
                </a>
                <transition name="slide-fade">
                    <input v-show="flag" class="btn btn-success" type="submit" value="Guardar" form="form"/>
                </transition>
            </div>
        </div>
        <transition name="fade">
            <div class="row" v-show="flag">
                <div class="col-md-12">
                    <form id="form" method="post" v-bind:action="action+'/upload-new'">
                        <input type="hidden" name="_token" :value="csrf">
                        <div id="uploader">
                            <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
                        </div>
                    </form>
                    <!-- <form v-bind:action="action+'/upload-new'" method="POST" class="dropzone" id="imageDrop">
                        <input type="hidden" name="_token" :value="csrf">
                    </form> -->
                </div>
            </div>
        </transition>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between mb-0" style="height:50px;">
            <div class="container">
                <ul class="navbar-nav">
                    <li class="nav-item" v-bind:class="[ currentLink=='list' ? 'active' : '' ]">
                        <a @click="setCurrent('list')" href="#" class="nav-link">
                            <span class="fas fa-th-list"></span>
                        </a>
                    </li>
                    <li class="nav-item" v-bind:class="[ currentLink=='square' ? 'active' : '' ]">
                        <a @click="setCurrent('square')" href="#" class="nav-link">
                            <span class="fas fa-th"></span>
                        </a>
                    </li>
                </ul>
                <transition name="fade">
                    <form class="form-inline" v-show="search">
                        <input class="form-control text-white" type="search" placeholder="Buscar" aria-label="Search" v-model="stext">
                    </form>
                </transition>
            </div>
        </nav>
        <div class="container-fluid">
            <transition name="component-fade" mode="out-in">
                <component v-bind:is="currentComponent" :media="media" :asset="asset" :stext="stext"></component>
            </transition>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        media: {},
        asset: {},
        action: {},
    },
    created: function(){
        this.initForm();
    },
    data () {
        return {
        currentLink: 'square',
        flag: false,
        search: false,
        stext: '',
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    computed: {
        currentComponent: function(){
            return 'media-'+this.currentLink;
        }
    },
    methods: {
        setCurrent: function(string){
            this.currentLink = string;
            if(string === 'list'){
                this.search = true;
            }else{
                this.search = false;
            }
        },
        initForm: function(){
            $(document).ready(function() {
                $("#uploader").plupload({
                    // General settings
                    runtimes: 'html5',
                    
                    // Fake server response here 
                    // url : '../upload.php',
                    // url:"../media",
                    url:"../media",

                    multipart: true,

                    // multipart_params: {
                    //     'key': '${filename}',
                    //     'Filename': '${filename}',
                    //     'Content-Type': 'image/*'
                    // },
                    // Maximum file size
                    max_file_size: '1000mb',

                    // User can upload no more then 20 files in one go (sets multiple_queues to false)
                    max_file_count: 20,
                    
                    chunk_size: '1mb',

                    // Resize images on clientside if we can
                    // resize : {
                    //     width: 200, 
                    //     height: 200, 
                    //     quality: 90,
                    //     crop: true // crop to exact dimensions
                    // },

                    // Specify what files to browse for
                    filters: [
                        { title: "Image files", extensions: "jpg,gif,png" },
                        { title: "Zip files", extensions:  "zip,avi" }
                    ],

                    // Rename files by clicking on their titles
                    rename: true,
                    
                    // Sort files
                    sortable: true,

                    // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
                    dragdrop: true,

                    // Views to activate
                    views: {
                        list: false,
                        thumbs: true, // Show thumbs
                        active: 'thumbs'
                    },

                });

                //This was added by me ~Victor~ to Change the language of the showed up text, so it can be in spanish
                $(document).ready(function() {
                    $('.plupload_header_title').text('Selecciona tus archivos');
                    $('.plupload_header_text').text('Añade archivos a la cola y luego da click en el botón \'Iniciar carga\' o en el botón Guardar');
                    $('div.plupload_droptext').text('Arrastra archivos aquí');
                    $('a#uploader_browse >.ui-button-text').text('Añadir archivos');
                    $('a#uploader_start >.ui-button-text').text('Iniciar carga');
                })

                // Handle the case when form was submitted before uploading has finished
                $('#form').submit(function(e) {
                    // Files in queue upload them first
                    if ($('#uploader').plupload('getFiles').length > 0) {

                        // When all files are uploaded submit form
                        $('#uploader').on('complete', function() {
                            $('#form')[0].submit();
                        });

                        $('#uploader').plupload('start');
                    } else {
                        alert("Debes tener al menos un archivo subido para poder guardar");
                    }
                    return false; // Keep the form from submitting
                });
            });
        }
    }
}
</script>
