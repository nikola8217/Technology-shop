<template>
    <div>
        <div class="row">
            <div class="mb-3">
                    <h3 style="text-align: center;">Podaci o proizvodima</h3>

            </div>

            <div class="col-md-12" >
                <div class="mb-3" style="text-align: right">
                    <button class="btn btn-primary" @click="showAddPro()">Dodaj proizvod</button>
                </div>
            </div>
           
        </div>
            
        <table class="table table-hover" style="border-radius: 10px; background-color: #fff;">
            <thead style="background-color: #0b5ed7; color: #fff;">
                <tr style="border-radius: 10px">
                    <th style="text-align: center;">ID</th>
                    <th style="text-align: center;">Slika</th>
                    <th style="text-align: center;">Naziv proizvoda</th>
                    <th style="text-align: center;">Opis</th>
                    <th style="text-align: center;">Cena</th>
                    <th style="text-align: center;">Akcije</th>
                   
                </tr>
            </thead>
            <tbody>
                <tr v-for="(pro, index) in this.products" :key="index">
                    <td style="text-align: center; ">{{ pro.id }}</td>
                    <td style="text-align: center; " > <img v-bind:src="pro.img" alt="" style="width: 100px; height: 100px;"></td>
                    <td style=" ">{{ pro.name }}</td>
                    <td style="">{{ pro.description }}</td>
                    <td style="  ">{{ pro.price }},00 dinara</td>
                    <td style="text-align: center; width: 300px;">
                        <button class="btn btn-success" value="Ažuriraj" @click="showEditPro(pro.id)">Ažuriraj</button>
                        <button class="btn btn-danger" value="Obriši" @click="deletePro(pro.id)">Obriši</button>
                    </td>
                    
                </tr>
                
            </tbody>
        </table>

        

        <!-- Modal dodaj korisnika -->
            <div id="addPro" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Dodaj proizvod</h4>
                        </div>
                        <div class="modal-body">
                             <div class="form-group">
                                <div class="mb-3">
                                    <label>Naziv</label>
                                    <input type="text" v-model="name"  id="name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label>Opis</label>
                                    <textarea cols="30" rows="10" v-model="description" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label>Cena</label>
                                    <input type="text"  v-model="price" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label>Slika</label>
                                    <input type="text"  v-model="img" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" @click="closeAddPro()">Zatvori</button>
                            <button type="button" class="btn btn-primary" @click="createPro()">Sačuvaj</button>
                        </div>
                    </div>

                </div>
            </div>
        <!-- Kraj modal dodaj korisnika  -->

         <!-- Modal edit kategoriju  -->
        <div id="editPro" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Izmeni proizvod</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label>Naziv</label>
                                    <input type="text" v-model="name"  id="name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label>Opis</label>
                                    <textarea cols="30" rows="10" v-model="description" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label>Cena</label>
                                    <input type="text"  v-model="price" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label>Slika</label>
                                    <input type="text"  v-model="img" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" @click="closeEditPro()">Zatvori</button>
                            <button type="button" class="btn btn-primary" @click="editPro()">Sačuvaj</button>
                        </div>
                    </div>

                </div>
            </div>

        <!-- Kraj edit Kategoriju  -->


        

       
            
    </div>
</template>

<script>
export default {
    mounted(){
        
        this.getProducts(this.id);
        
    },

    props:['id'],
        
    methods:{
        async getProducts(id) {
            await axios.get('/getPro/' + id)
                .then((response) => {
                    this.products = response.data.products;
                })
            .catch(error => {
                console.log(error);
                })
        },

        showAddPro() {
            $("#addPro").modal("show");
        },

        closeAddPro() {
            $("#addPro").modal('hide');
            this.clearProModel();
        },

        clearProModel() {
            this.name = '';
            this.description = '';
            this.price = '';
            this.img = '';
        },

        async createPro() {
             await axios.post('/createProduct', {
                
                    name: this.name,
                    desc: this.description,
                    price: this.price,
                    img: this.img,
                    cat_id: this.id 
                   
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
                                this.getProducts(this.id);
                                this.closeAddPro();
                                
                            }
                        })
                    }  
                               
                }).catch((error) => {
                    console.log(error);
            });
        },

        showEditPro(id) {
            this.currentProId = id;
            this.name = this.products.find(a => a.id == id).name;
            this.description = this.products.find(a => a.id == id).description;
            this.price = this.products.find(a => a.id == id).price;
            this.img = this.products.find(a => a.id == id).img;
            
            
            $ ("#editPro").modal("show");
        },

        closeEditPro() {
            $("#editPro").modal('hide');
        },

         async editPro() {
            
            await axios.post('/editProduct', {

                    id: this.currentProId,
                    name: this.name,
                    desc: this.description,
                    price: this.price,
                    img: this.img
                   
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
                                this.getProducts(this.id);
                                this.closeEditPro();
                                
                            }
                        })
                    }  
                               
                }).catch((error) => {
                    console.log(error);
            });
        },

        deletePro(id){
            this.currentProId = id;
            axios.delete('/deleteProduct/' + id)
                .then()
                .catch(err => (console.log(err)));
            this.getProducts(this.id);
        },

    },

    data(){
        return{
            products: [],
            name: '',
            description: '',
            price: '',
            img: '',
            currentProId: ''
        }
    }
}
</script>