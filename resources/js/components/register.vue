<template>
    <div>
        <div class="title">
            Registrujte se
        </div>
        <div class="form">
            <div class="mb-3">
                <div class="inputfield">
                    <label>Ime</label>
                    <input v-model="name" type="text" class="input">
                </div> 
            </div>

            <div class="mb-3">
                <div class="inputfield">
                    <label>Prezime</label>
                    <input v-model="lastname" type="text" class="input">
                </div> 
            </div>

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
                <div class="inputfield">
                    <label>Potvrda šifra</label>
                    <input v-model="confirm_password" type="password" class="input">
                </div> 
            </div>  

            <div class="mb-3">
                <input type="submit" value="Register" class="btn btn-primary" style="width:100%" @click="register()">
            </div>
            <p>Imate nalog? Prijavite se <a href="/login">ovde</a>.</p>
        </div>
    </div>
</template>

<script>
export default{
        mounted(){
            
        },
        
        methods:{
            async register() {

            await axios.post('/registration', {
                
                    name: this.name,
                    lastname: this.lastname,
                    email: this.email,
                    password: this.password,
                    confirm_password: this.confirm_password
                   
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
                                window.location.href = '/login';
                                
                            }
                        })
                    }  
                               
                }).catch((error) => {
                    console.log(error);
            });
        },
        },
        data(){
            return{
                name: '',
                lastname: '',
                email: '',
                password: '',
                confirm_password: ''
            }
        }
    }

</script>