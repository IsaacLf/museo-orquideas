<template>
    <div>
        <div class="row">
            <div class="col-md-auto">
                <h1 class="my-inline-block">Biblioteca de medios</h1>
            </div>
            <div class="col-md-auto">
                <a href="#" @click="flag = !flag" class="btn btn-warning">Añadir nuevo</a>
            </div>
        </div>
        <transition name="fade">
            <div class="row" v-show="showImageDrop">
                <div class="col-md-12">
                    <form v-bind:action="action+'/upload-new'" method="POST" class="dropzone" id="imageDrop">
                        <input type="hidden" name="_token" :value="csrf">
                        <!-- <input type="file" name="file"> -->
                    </form>
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
                <form class="form-inline">
                    <input class="form-control" type="search" placeholder="Buscar" aria-label="Search">
                    <button class="btn btn-primary btn-sm" type="submit">Buscar</button>
                </form>
            </div>
        </nav>
        <div class="container-fluid">
            <transition name="component-fade" mode="out-in">
                <component v-bind:is="currentComponent" :media="media" :asset="asset"></component>
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
    data () {
        return {
        currentLink: 'square',
        flag: false,
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    computed: {
        currentComponent: function(){
            return 'media-'+this.currentLink;
        },
        showImageDrop: function(){
            return this.flag;
        }
    },
    methods: {
        setCurrent: function(string){
            this.currentLink = string;
        }
    }
}
</script>
