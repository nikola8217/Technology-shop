<template>
    <div>
        <div class="row">
            <div class="mb-3">
                    <h3 style="text-align: center;">Podaci o kategorijama</h3>

            </div>

            <div class="col-md-12" >
                <div class="mb-3" style="text-align: right">
                    <button class="btn btn-primary" @click="showAddCat()">Dodaj kategoriju</button>
                </div>
            </div>
           
        </div>
            
        <table class="table table-hover" style="border-radius: 10px; background-color: #fff;">
            <thead style="background-color: #0b5ed7; color: #fff;">
                <tr style="border-radius: 10px">
                    <th style="text-align: center;">ID</th>
                    <th style="text-align: center;">Naziv kategorije</th>
                    <th style="text-align: center;">Akcije</th>
                   
                </tr>
            </thead>
            <tbody>
                <tr v-for="(cat, index) in this.categories" :key="index">
                    <td style="text-align: center;">{{ cat.id }}</td>
                    <td style="text-align: center;"><a :href="'/category/' + cat.id">{{ cat.name }}</a></td>
                    <td style="text-align: center;">
                        <button class="btn btn-success" value="Ažuriraj" @click="showEditCat(cat.id)">Ažuriraj</button>
                        <button class="btn btn-danger" value="Obriši" @click="deleteCat(cat.id)">Obriši</button>
                    </td>
                    
                </tr>
                
            </tbody>
        </table>


        <!-- Modal dodaj korisnika -->
            <div id="addCat" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Dodaj kategoriju</h4>
                        </div>
                        <div class="modal-body">
                             <div class="form-group">
                                <div class="mb-3">
                                    <label>Naziv kategorije</label>
                                    <input type="text" v-model="name" id="name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" @click="closeAddCat()">Zatvori</button>
                            <button type="button" class="btn btn-primary" @click="createCat()">Sačuvaj</button>
                        </div>
                    </div>

                </div>
            </div>
        <!-- Kraj modal dodaj korisnika  -->

        <!-- Modal edit kategoriju  -->
        <div id="editCat" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Izmeni kategoriju</h4>
                        </div>
                        <div class="modal-body">
                             <div class="form-group">
                                <div class="mb-3">
                                    <label>Naziv kategorije</label>
                                    <input type="text" v-model="name" id="name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" @click="closeEditCat()">Zatvori</button>
                            <button type="button" class="btn btn-primary" @click="editCat()">Sačuvaj</button>
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
        this.getCategories();

        
    },
        
    methods:{
        getCategories() {
            axios.get('/getCategories')
                .then(response => {
                    this.categories = response.data.categories;
                })
            .catch(error => {
                console.log(error);
                })
        },

        showAddCat() {
            $("#addCat").modal("show");
        },

        closeAddCat() {
            $("#addCat").modal('hide');
            this.clearCatModel();
        },

        clearCatModel() {
            this.name = '';
        },

        async createCat() {
             await axios.post('/createCat', {
                
                    name: this.name
                   
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
                                this.getCategories();
                                this.closeAddCat();
                                
                            }
                        })
                    }  
                               
                }).catch((error) => {
                    console.log(error);
            });
        },

        showEditCat(id) {
            this.currentCatId = id;
            this.name = this.categories.find(a => a.id == id).name;
            
            
             $ ("#editCat").modal("show");
        },

        closeEditCat() {
            $("#editCat").modal('hide');
        },

        async editCat() {
            
            await axios.post('/editCat', {

                    id: this.currentCatId,
                    name: this.name,
                   
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
                                this.getCategories();
                                this.closeEditCat();
                                
                            }
                        })
                    }  
                               
                }).catch((error) => {
                    console.log(error);
            });
        },

        deleteCat(id){
            this.currentCatId = id;
            axios.delete('/deleteCat/' + id)
                .then()
                .catch(err => (console.log(err)));
            this.getCategories();
        },

    },

    data(){
        return{
            categories: [],
            name: '',
            currentCatId: ''
        }
    }
}
</script>