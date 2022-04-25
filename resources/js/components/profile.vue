<template>
    <div>
        <div class="container" style="margin-top: 50px">
            <div class="row">
                <div class="col-md-4" v-for="(u, index) in this.user" :key="index">
                    <div class="card" > 
                        <div class="card-body">
                            <h4><b>Ime:</b></h4>
                            <h4  style="margin-bottom: 30px;">{{ u.name }}</h4>
                            <h4><b>Prezime:</b></h4>
                            <h4  style="margin-bottom: 30px;">{{ u.lastname }}</h4>
                            <h4><b>Email:</b></h4>
                            <h4  style="margin-bottom: 30px;">{{ u.email }}</h4>
                            <h4><b>Ukupan broj bodova:</b></h4>
                            <h4  >{{ u.brBodova }}</h4>
                            <hr>
                           
                            <a href="#" class="btn btn-primary" @click="openChangePass()">Promeni šifru</a>
                        </div>
                    </div>
                </div>

                <!-- Modal dodaj korisnika -->
                <div id="changePass" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Promenite šifru</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label>Unesite staru šifru</label>
                                        <input type="password" v-model="old"  class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Unesite novu šifru</label>
                                        <input type="password" v-model="pass"  class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Potvrdite novu šifru</label>
                                        <input type="password" v-model="conf"  class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="closeChangePass()">Zatvori</button>
                                <button type="button" class="btn btn-primary" @click="changePass()">Sačuvaj</button>
                            </div>
                        </div>

                    </div>
                </div>
            <!-- Kraj modal dodaj korisnika  -->


                <div class="col-md-8">
                    <table class="table table-hover" style="border-radius: 10px; background-color: #fff;">
                        <thead style="background-color: #0b5ed7; color: #fff;">
                            <tr style="border-radius: 10px">
                                <th style="text-align: center;">Kupac</th>
                                <th style="text-align: center;">Adresa</th>
                                <th style="text-align: center;">Drzava</th>
                                <th style="text-align: center;">Telefon</th>
                                <th style="text-align: center;">UkupnaCena</th>
                                <th style="text-align: center;">Akcije</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="ck in ckarray.data" :key="ck.id">
                                <td style=" ">{{ ck.name }}</td>
                                <td style=" ">{{ ck.street }}, {{ ck.pb }}, {{ ck.city }} </td>
                                <td style="">{{ ck.country }}</td>
                                <td style="">{{ ck.phone }}</td>
                                <td style="  ">{{ ck.total }},00 dinara</td>
                                <td style="text-align: center; width: 300px;">
                                    <button class="btn btn-danger" value="Obriši" @click="deleteCK(ck.id)">Otkazi</button>
                                </td>
                                
                            </tr>
                            
                        </tbody>
                    </table>
                    <pagination :data="ckarray" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
export default {

    mounted(){
        
        this.getUser();
        // this.getCK();
        // this.getResults();
        
    },

    created() {
            this.getResults();
        },

    methods: {
        getUser() {   
            axios.get('/getUserAuth')
                .then((response) => {
                    this.user = response.data.user;
                })
                .catch(error => {
                    console.log(error);
                })
            
        },

        async getResults(page) {
            if (typeof page === "undefined") {
                page = 1;
            }
            await axios
                .get("/ck?page=" + page)
                .then((response) => {
                this.ckarray = response.data;
                // console.log(ckarray);
                });
            // console.log(this.ckarray);
        },

        deleteCK(id){
            this.currentCKId = id;
            axios.delete('/deleteCK/' + id)
                .then()
                .catch(err => (console.log(err)));
            Swal.fire({
                title: '',
                text: 'Porudzbina je otkazana!',
                icon: 'success',
                confirmButtonColor: "#0b5ed7"
            })
            .then(value => {
                if(value.isConfirmed){
                    this.getResults();           
                }
            })
        },

        openChangePass() {
            $("#changePass").modal("show");
        },

        closeChangePass() {
            $("#changePass").modal('hide');
            this.old = "";
            this.pass = "";
            this.conf = "";
        },

        async changePass() {
             await axios.post('/changePass', {
                
                    old: this.old,
                    pass: this.pass,
                    conf: this.conf
                   
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
                                
                                this.closeChangePass();
                                
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
           user:[],
           ckarray: {},
           pagination: {},
           currentCKId: "",
           old: "",
           pass: "",
           conf: ""
           
        }
    }

    
}
</script>