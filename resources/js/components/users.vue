<template>
    <div>
        <div class="row">
            <div class="mb-3">
                    <h3 style="text-align: center;">Podaci o korisnicima</h3>

            </div>

            <div class="col-md-12" >
                <div class="mb-3" style="text-align: right">
                    <!-- <a class="btn btn-primary">Dodaj korisnika</a> -->
                    <button class="btn btn-primary" @click="openAddUser()">Dodaj korinsika</button>
                </div>

                <!-- <modal id="bv-modal-example" hide-footer>
                    <template #modal-title>
                        Using <code>$bvModal</code> Methods
                    </template>
                    <div class="d-block text-center">
                        <h3>Hello From This Modal!</h3>
                    </div>
                    <button class="mt-3" block @click="$bvModal.hide('bv-modal-example')">Close Me</button>
                </modal>
                   -->
            </div>
           
        </div>
            
        <table class="table table-hover" style="border-radius: 10px; background-color: #fff;">
            <thead style="background-color: #0b5ed7; color: #fff;">
                <tr style="border-radius: 10px">
                    <th>Ime</th>
                    <!-- <th>Prezime</th> -->
                    <th>Email</th>
                    <th>Rola</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in this.users" :key="index">
                    <td>{{ user.name + ' ' + user.lastname }}</td>
                    <!-- <td> {{ user.lastname }} </td> -->
                    <td> {{ user.email }} </td>
                    <!-- <td>{{ user.userRole }}</td> -->
                    <td v-html="user.userRole"></td>
                    <td>
                        <button class="btn btn-success" value="Ažuriraj" @click="showEditUser(user.id)">Ažuriraj</button>
                        <button class="btn btn-danger" value="Obriši" @click="deleteUser(user.id)">Obriši</button>
                    </td>
                    
                </tr>
                
            </tbody>
        </table>

        <!-- Modal dodaj korisnika -->
            <div id="addUser" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                            <h4 class="modal-title">Dodaj korinsika</h4>
                        </div>
                        <div class="modal-body">
                             <div class="form-group">
                                <div class="mb-3">
                                    <label>Ime</label>
                                    <input type="text" v-model="name" id="name" class="form-control">
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="mb-3">
                                    <label>Prezime</label>
                                    <input type="text" v-model="lastname" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" v-model="email" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label>Šifra</label>
                                    <input type="password" v-model="password" class="form-control" >
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="mb-3">
                                    <label>Potvrdite šifru</label>
                                    <input type="password" v-model="confirm_password" class="form-control">
                                </div>
                            </div>

                            <div class="form-group" v-for="(role, index) in this.roles" :key="index">
                                <div class="mb-3">
                                    <input type="checkbox" :value="role.id" class="cb">
                                    <label>{{ role.name }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" @click="closeAddUser()">Zatvori</button>
                            <button type="button" class="btn btn-primary" @click="createUser()">Sačuvaj</button>
                        </div>
                    </div>

                </div>
            </div>
        <!-- Kraj modal dodaj korisnika  -->

        <!-- Modal izmeni korisnika  -->
            <div id="editUser" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                            <h4 class="modal-title">Izmeni korinsika</h4>
                        </div>
                        <div class="modal-body">
                             <div class="form-group">
                                <div class="mb-3">
                                    <label>Ime</label>
                                    <input type="text" v-model="name" id="name" class="form-control">
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="mb-3">
                                    <label>Prezime</label>
                                    <input type="text" v-model="lastname" class="form-control">
                                </div>
                            </div>
                           

                            <div class="form-group" v-for="(role, index) in this.roles" :key="index">
                                <div class="mb-3">
                                    <input type="checkbox" :value="role.id" class="cb">
                                    <label>{{ role.name }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" @click="closeEditUser()">Zatvori</button>
                            <button type="button" class="btn btn-success" @click="editUser()">Sačuvaj</button>
                        </div>
                    </div>

                </div>
            </div>
    </div>
</template>

<script>
export default {
    mounted(){
        this.getUsers();
        this.getRoles();

        
    },
        
    methods:{
        getUsers() {
            axios.get('/getUsers')
                .then(response => {
                    this.users = response.data.users;
                })
            .catch(error => {
                console.log(error);
                })
        },

        openAddUser() {
            $("#addUser").modal("show");
        },

        closeAddUser() {
            $("#addUser").modal('hide');
            this.clearUserModel();
        },

        clearUserModel() {
            this.name = '';
            this.lastname = '';
            this.email = '';
            this.password = '';
            this.confirm_password = '';
        },

        getRoles() {
            axios.get('/getRoles')
                .then(response => {
                    this.roles = response.data.roles;
                })
            .catch(error => {
                console.log(error);
                })
        },

        async createUser() {
            this.checkRoles = [];

            let check = $('.cb').map(function() {
                if(this.checked)
                    return this.value;
            }).get();

            this.checkRoles = check;

            // console.log(this.checkRoles);
            

            await axios.post('/createUser', {
                
                    name: this.name,
                    lastname: this.lastname,
                    email: this.email,
                    password: this.password,
                    confirm_password: this.confirm_password,
                    check_roles: this.checkRoles
                   
                }).then((response) => {
                    if(response.data.error){                                   
                        Swal.fire({
                            title: '',
                            text: response.data.error,
                            icon: 'warning',
                            confirmButtonColor: "#0b5ed7"
                        })
                    }
                    else {                                                                      
                        Swal.fire({
                            title: '',
                            text: response.data.success,
                            icon: 'success',
                            confirmButtonColor: "#0b5ed7"
                        })
                        .then(value => {
                            if(value.isConfirmed){
                                this.getUsers();
                                this.closeAddUser();
                                
                            }
                        })
                    }  
                               
                }).catch((error) => {
                    console.log(error);
            });
        },

        showEditUser(id) {
            this.currentUserId = id;
            this.name = this.users.find(a => a.id == id).name;
            this.lastname = this.users.find(a => a.id == id).lastname;
            
            
             $ ("#editUser").modal("show");
        },

        closeEditUser() {
            $("#editUser").modal('hide');
        },

        async editUser() {
            this.checkRoles = [];

            let check = $('.cb').map(function() {
                if(this.checked)
                    return this.value;
            }).get();

            this.checkRoles = check;

            // console.log(this.checkRoles);
            

            await axios.post('/editUser', {

                    id: this.currentUserId,
                    name: this.name,
                    lastname: this.lastname,
                    check_roles: this.checkRoles
                   
                }).then((response) => {
                    if(response.data.error){                                   
                        Swal.fire({
                            title: '',
                            text: response.data.error,
                            icon: 'warning',
                            confirmButtonColor: "#0b5ed7"
                        })
                    }
                    else {                                                                      
                        Swal.fire({
                            title: '',
                            text: response.data.success,
                            icon: 'success',
                            confirmButtonColor: "#0b5ed7"
                        })
                        .then(value => {
                            if(value.isConfirmed){
                                this.getUsers();
                                this.closeEditUser();
                                
                            }
                        })
                    }  
                               
                }).catch((error) => {
                    console.log(error);
            });
        },

        deleteUser(id){
            this.currentUserId = id;
            axios.delete('/deleteUser/' + id)
                .then()
                .catch(err => (console.log(err)));
            this.getUsers();
        },




    },

    data(){
        return{
            users: [],
            name: '',
            lastname: '',
            email: '',
            password: '',
            confirm_password: '',
            roles: [],
            role: '',
            checkRoles: [],
            currentUserId: '',
        }
    }
}
</script>