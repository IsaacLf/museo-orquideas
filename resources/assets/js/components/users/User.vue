<template>
    <div>
        <div class="row">
            <div class="col-md-auto">
                <h1 class="my-inline-block">Usuarios</h1>
            </div>
            <div class="col-md-auto">
                <a href="#" @click="showForm = !showForm" class="btn btn-primary">
                    {{ showForm ? 'Ocultar' : 'Añadir nuevo' }}
                </a>
            </div>
        </div>
        <transition name="fade">
            <div class="row justify-content-center" v-show="showForm">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Añadir nuevo usuario</h4>
                            <p class="card-category">Complete los campos para crear un nuevo usuario</p>
                        </div>
                        <div class="card-body">
                            <form :action="action" id="userNew" method="POST">
                                <input type="hidden" name="_token" :value="csrf">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="bmd-label-floating" for="formUsername">Nombre de usuario*</label>
                                            <input class="form-control" type="text" name="username" id="formUsername" v-model="username" required>
                                            <span class="bmd-help">
                                                {{ isUsernameAvailable(username) ? '' : 'El nombre de usuario ya está en uso, elige otro'}}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="bmd-label-floating" for="formEmail">Correo electrónico*</label>
                                            <input class="form-control" type="email" name="email" id="formEmail" v-model="email" required>
                                            <span class="bmd-help">
                                                {{ isEmailAvailable(email) ? '' : 'El correo electrónico ya está en uso, elige otro'}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="bmd-label-floating" for="formName">Nombre</label>
                                            <input class="form-control" type="text" name="name" id="formName" value="">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="bmd-label-floating" for="formLastname">Apellido</label>
                                            <input class="form-control" type="text" name="lastname" id="formLastname" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="formProfile">Perfil</label>
                                            <div class="col">
                                                <select v-model="selected" class="form-control" name="profile" id="formProfile">
                                                    <option v-for="option in options" v-bind:value="option.value" :key="option.id">
                                                        {{option.text}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="bmd-label-floating" for="formPassword">Contraseña*</label>
                                            <input class="form-control" type="password" name="password" id="formPassword" value="" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                * Los campos marcados con el asterisco son obligatorios
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
        <div class="row justify-content">
            <div class="col md-auto">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title">Lista de Usuarios</h4>
                        <p class="card-category">Todos los usuarios registrados en el sistema</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-shopping">
                                <thead class="text-info text-center">
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Perfil</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Correo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr v-for="user in users" :key="user.id">
                                        <th>{{user.id}}</th>
                                        <th>{{user.username}}</th>
                                        <th>{{getProfile(user.profile)}}</th>
                                        <th>{{user.name}}</th>
                                        <th>{{user.last_name}}</th>
                                        <th>{{user.email}}</th>
                                        <th>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-round btn-info btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-round btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </th>
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
export default {
    props: {
        users: Array,
        url: String,
        action: String
    },
    data: function(){
        return{
            showForm: false,
            selected: 'editor',
            options: [
                {text: 'Editor', value: 'editor'},
                {text: 'Administrador', value: 'administrator'}
            ],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            username: '',
            email: ''
        }
    },
    computed:{
        isAvailable: function(){
            return this.isUsernameAvailable(this.username);
        }
    },
    methods:{
        getProfile: function(string){
            switch(string){
                case 'administrator':
                    return 'Administrador';
                    break;
                case 'editor':
                    return 'Editor';
                    break;
                default:
                    return 'Indefinido';
            }
        },
        isUsernameAvailable: function(string){
            var found = _.find(this.users,['username', string]);
            if(found === undefined){
                return true
            }
            return false;
        },
        isEmailAvailable: function(string){
            var found = _.find(this.users,['email', string]);
            if(found === undefined){
                return true
            }
            return false;
        }
    }
}
</script>

