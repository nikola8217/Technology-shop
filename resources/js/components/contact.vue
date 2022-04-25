<template>
    <div>
        <div class="container" style="margin-top: 30px; margin-bottom: 50px;">
            <h2 class="text-center mb-5">Kontaktirajte nas</h2>
            <div class="container-fluid bg-grey">
        
        <div class="row">
            <div class="col-sm-5">
            <p>Kontaktirajte nas a mi cemo vam odgovoriti u što kraćem roku!</p>
            <p><span class="glyphicon glyphicon-map-marker"></span> Chicago, US</p>
            <p><span class="glyphicon glyphicon-phone"></span> +00 1515151515</p>
            <p><span class="glyphicon glyphicon-envelope"></span> myemail@something.com</p>
            </div>
            <div class="col-sm-7">
            <div class="row mb-3">
                <div class="col-sm-6 form-group">
                <input class="form-control" id="name" name="name" placeholder="Email" type="email" v-model="email">
                </div>
                <div class="col-sm-6 form-group">
                <input class="form-control" id="email" name="email" placeholder="Subject" type="text" v-model="subject">
                </div>
            </div>
            <textarea class="form-control" id="comments" name="comments"  rows="5" v-model="text"></textarea><br>
            <div class="row">
                <div class="col-sm-12 form-group">
                    <button class="btn btn-primary" type="submit" @click="sendMessage()">Pošaljite mail</button>
                </div>
            </div>
            </div>
        </div>
        </div> 
        <img v-bind:src="'../img/map.jpg'" class="w3-image w3-greyscale-min" style="width:100%">
            

        </div> 

       

    

    </div>
</template>

<script>
export default {
    mounted(){
       
        
    },
        
    methods:{
       async sendMessage() {
             await axios.post('/sendMessage', {
                
                    email: this.email,
                    subject: this.subject,
                    text: this.text
                   
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
                                this.email = '';
                                this.subject = '';
                                this.text = '';
                                
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
           email: '',
           subject: '',
           text: ''
        }
    }
}
</script>

<style>
    .container-fluid {
    padding: 60px 50px;
  }
  .bg-grey {
    background-color: #f6f6f6;
  }

  
  
</style>