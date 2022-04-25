<template>
    <div>
        <div class="title">
            Ulogujte se
        </div>
        <div class="form">
            <div class="mb-3">
                <div class="inputfield">
                    <label>Email</label>
                    <input v-model="email" type="email" class="input">
                </div> 
            </div>

            <div class="mb-3">
                <div class="inputfield">
                    <label>Šifra</label>
                    <input v-model="password" type="password" class="input">
                </div> 
            </div>  

            <div class="mb-3">
                <input type="submit" value="Login" class="btn btn-primary" style="width:100%" @click="login()">
            </div>
            <p>Nemate nalog? Kreirajte ga <a href="/register">ovde</a>.</p>
        </div>

        <!-- modal izaberi rolu  -->
        <div id="selectRola" class="modal fade" role="dialog">
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
                                    <select class="form-control" id="select" v-model="rola">
                                        <option v-for="role in roles" :key="role.role_id" :value="role.role_id">Rola {{ role.role_id }} </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-danger" data-dismiss="modal" @click="closeEditUser()">Zatvori</button> -->
                            <button type="button" class="btn btn-primary" @click="postaviSesiju()">Nastavi</button>
                        </div>
                    </div>

                </div>
            </div>

    </div>
</template>

<script>
    export default{
        mounted(){
            
        },
        
        methods:{
            async login() {

            let th = this;

            await axios.post('/login_in', {
                
                    email: this.email,
                    password: this.password,
                   
                }).then((response) => {
                    

                    if(response.data.error){                                   
                        Swal.fire({
                            title: '',
                            text: response.data.error,
                            icon: 'warning',
                            confirmButtonColor: "#0b5ed7"
                        })
                    }

                     else if(response.data.count > 1){

                        //  alert(response.data.role.role_id);
                        //  return false;
                            
                        $("#selectRola").modal('show');
                        th.roles = response.data.role;
                        th.rola = th.roles[0].role_id;

                        
                    }

                    else if(response.data.successAdmin){                                   
                        window.location.href = '/homeAdmin';
                    }

                    else if(response.data.successMen){                                   
                        window.location.href = '/homeMen';
                    }

                   
                    else {                                                                      
                        window.location.href = '/';
                    }  
                               
                }).catch((error) => {
                    console.log(error);
            });
        },

        postaviSesiju(){
            
            //     let rez = this.role.some((item) => {
            //     return item.role_id == this.role_id
            // });

               axios.post('/postaviSesijuRole',{
                    id: this.rola
                }).then(function(response) {      
                    
                    
                    if(response.data.role == 1){
                        window.location.href = '/';   
                    }
                    
                    if(response.data.role == 3){
                        window.location.href = '/homeMen';   
                    }

                    else {
                        window.location.href = '/homeAdmin';
                    }
                                    
                }).catch((error) => {
                    console.log(error);
                });
            
        }
        },
        data(){
            return{
                email: '',
                password: '',
                role_id: '',
                roles: [],
                rola: ''
            }
        }
    }
</script>