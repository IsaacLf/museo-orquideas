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
                                    <tr v-for="user in Users" :key="user.id">
                                        <th>{{user.id}}</th>
                                        <th>{{user.username}}</th>
                                        <th>{{getProfile(user.profile)}}</th>
                                        <th>{{user.name}}</th>
                                        <th>{{user.last_name}}</th>
                                        <th>{{user.email}}</th>
                                        <th>
                                            <div class="btn-group">
                                                <a @click="toggleEdit(user)" href="#" class="btn btn-round btn-info btn-sm" role="button" data-toggle="modal" data-target="#editarUsuario">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a @click="deleteUser(user.id)" href="#" class="btn btn-round btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Modal -->
                            <div class="modal fade" id="editarUsuario" tabindex="-1" role="dialog" aria-labelledby="editarUsuarioLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-muted">
                                            <h5 class="modal-title" id="editarUsuarioLabel">Editar usuario</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-dark">
                                            <div class="card mb-0 mt-0">
                                                <div class="card-body">
                                                    <form id="userEdit">
                                                        <div class="form-row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label class="bmd-label-static" for="formUsername">Nombre de usuario*</label>
                                                                    <input class="form-control" type="text" name="username" id="formUsername" v-model="editFields.username" required>
                                                                    <span class="bmd-help">
                                                                        {{ isUsernameAvailable(editFields.username) ? '' : 'El nombre de usuario ya está en uso, elige otro'}}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label class="bmd-label-static" for="formEmail">Correo electrónico*</label>
                                                                    <input class="form-control" type="email" name="email" id="formEmail" v-model="editFields.email" required>
                                                                    <span class="bmd-help">
                                                                        {{ isEmailAvailable(editFields.email) ? '' : 'El correo electrónico ya está en uso, elige otro'}}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label class="bmd-label-static" for="formName">Nombre</label>
                                                                    <input class="form-control" type="text" name="name" id="formName" v-model="editFields.name">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label class="bmd-label-static" for="formLastname">Apellido</label>
                                                                    <input class="form-control" type="text" name="lastname" id="formLastname" v-model="editFields.lastname">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row justify-content-center">
                                                            <div class="col">
                                                                <div class="form-group row justify-content-center">
                                                                    <label class="col-md-2 col-form-label" for="formProfile">Perfil</label>
                                                                    <div class="col-md-4">
                                                                        <select v-model="editFields.profile" class="form-control" name="profile" id="formProfile">
                                                                            <option v-for="option in options" v-bind:value="option.value" :key="option.id">
                                                                                {{option.text}}
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal" @click="updateUser">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import swal from 'sweetalert'
export default {
    props: {
        users: Array,
        url: String,
        action: String,
        user: {}
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
            email: '',
            Users: [],
            editFields: {
                'id': '',
                'username': '',
                'email': '',
                'name': '',
                'lastname': '',
                'profile': ''
            },
            currentUserEdit: {}
        }
    },
    created: function(){
        this.Users = this.users;
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
            var found = _.find(this.Users,['username', string]);
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
        },
        deleteUser: function(id){
            let vm = this;
            if(this.user.id != id){
                swal({
                    title: "¿Desea eliminar a este usuario?",
                    text: "Si esta seguro de eliminar al usuario, dé click en 'Si'",
                    icon: "warning",
                    buttons: ["Cancelar","Sí"],
                    closeModal: true,
                    dangerMode: true
                }).then((result) => { // <--
                    if (result) { // <-- if confirmed
                        fetch('api/users/' + id, {method: 'delete'})
                        .then(res => res.json())
                        .then(data => {
                            swal(
                                "Usuario eliminado correctamente",
                                {icon: 'success',
                                timer: 3000}
                            );
                            vm.fetchUsers();
                        })
                        .catch(err => console.log(err));
                        
                    }
                });
            } else {
                swal(
                    "No puedes eliminarte a ti mismo desde tu cuenta",
                    {icon: 'info',
                    timer: 3000}
                );
            }
        },
        fetchUsers: function(){
            var vm = this;
            fetch('api/users')
            .then(res => res.json())
            .then(res => {
                vm.Users = res.data;
            });
        },
        toggleEdit: function(user){
            let vm = this;
            vm.currentUserEdit = user;
            vm.editFields.id = user.id;
            vm.editFields.username = user.username;
            vm.editFields.name = user.name;
            vm.editFields.lastname = user.last_name;
            vm.editFields.email = user.email;
            vm.editFields.profile = user.profile;
        },
        updateUser: function() {
            let vm = this;
            if(vm.currentUserEdit.profile === 'administrator' 
            && vm.editFields.profile === 'editor' 
            && vm.getAdminNumber() <= 1){
                swal(
                    "Debe haber al menos 1 usuario con privilegios de administración",
                    {icon: 'error'}
                );
            } else {
                fetch('api/users/' + vm.editFields.id, {
                    method: 'put',
                    body: JSON.stringify(vm.editFields),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    swal(
                        "Usuario actualizado correctamente",
                        {icon: 'success',
                        timer: 3000}
                    );
                    vm.fetchUsers();
                })
                .catch(err => console.log(err));
            }
        },
        discardChanges: function(){

        },
        getAdminNumber: function(){
            let vm = this;
            var number = 0;
            _.forEach(vm.Users, function(user){
                if(user.profile === 'administrator')
                    number++;
            });
            return number;
        }
    }
}
</script>

