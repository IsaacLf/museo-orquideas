<template>
    <div>
        <div class="card">
            <div class="card-header card-header-success">
                <h4 class="card-title">Vista de Cuadrícula</h4>
            </div>
            <div class="card-body">
                <div class="img-group-8" v-if="media.length > 0">
                    <img v-for="item in media" v-bind:key="item.id" class="img-item" v-bind:src="asset+'/'+item.image" v-bind:alt="item.name">
                </div>
                <div class="card-text" v-else>
                    <p>Lo siento, no parece haber elementos aquí ... deberías subir algunos nuevos!!</p>
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
    }
}
</script>
