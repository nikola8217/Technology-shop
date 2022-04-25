<template>
    <div>
        <div class="row">
            <div class="mb-3">
                    <h3 style="text-align: center;">CompShop Blog</h3>

            </div>

            <div class="col-md-12" >
                <div class="mb-3" style="text-align: right">
                    <button class="btn btn-primary" @click="showAddBlog()">Kreiraj blog</button>
                </div>
            </div>
           
        </div>

        <table class="table table-hover" style="border-radius: 10px; background-color: #fff;">
            <thead style="background-color: #0b5ed7; color: #fff;">
                <tr style="border-radius: 10px">
                    <th style="text-align: center;">ID</th>
                    <th style="text-align: center;">Blog</th>
                    <th style="text-align: center;">Napisao</th>
                    <th style="text-align: center;">Akcije</th>
                   
                </tr>
            </thead>
            <tbody>
                <tr v-for="(blog, index) in this.blogs" :key="index">
                    <td style="text-align: center;">{{ blog.id }}</td>
                    <td style="text-align: center;"><a :href="'/blog/' + blog.id">{{ blog.title }}</a></td>
                    <td style="text-align: center;">{{ blog.created_by }}</td>
                    <td style="text-align: center;">
                        <button class="btn btn-success" value="Ažuriraj" @click="showEditBlog(blog.id)">Ažuriraj</button>
                        <button class="btn btn-danger" value="Obriši" @click="deleteBlog(blog.id)">Obriši</button>
                    </td>
                    
                </tr>
                
            </tbody>
        </table>

        <!-- Modal dodaj blog -->
            <div id="addBlog" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Kreiraj blog</h4>
                        </div>
                        <div class="modal-body">
                             <div class="form-group">
                                <div class="mb-3">
                                    <label>Naslov</label>
                                    <input type="text" v-model="title"  id="title" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label>Tekst</label>
                                    <textarea cols="30" rows="50" v-model="text" class="form-control"></textarea>
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
                            <button type="button" class="btn btn-danger" data-dismiss="modal" @click="closeAddBlog()">Zatvori</button>
                            <button type="button" class="btn btn-primary" @click="createBlog()">Sačuvaj</button>
                        </div>
                    </div>

                </div>
            </div>
        <!-- Kraj modal dodaj korisnika  -->

        <!-- Modal dodaj blog -->
            <div id="editBlog" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Kreiraj blog</h4>
                        </div>
                        <div class="modal-body">
                             <div class="form-group">
                                <div class="mb-3">
                                    <label>Naslov</label>
                                    <input type="text" v-model="title"  id="title" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label>Tekst</label>
                                    <textarea cols="30" rows="50" v-model="text" class="form-control"></textarea>
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
                            <button type="button" class="btn btn-danger" data-dismiss="modal" @click="closeEditBlog()">Zatvori</button>
                            <button type="button" class="btn btn-primary" @click="editBlog()">Sačuvaj</button>
                        </div>
                    </div>

                </div>
            </div>
        <!-- Kraj modal dodaj korisnika  -->


    </div>
</template>

<script>
export default {
    mounted() {
        this.getBlogs();
    },

    methods: {
        showAddBlog() {
            $("#addBlog").modal("show");
        },

        closeAddBlog() {
            $("#addBlog").modal('hide');
            this.clearBlogModel();
        },

        clearBlogModel() {
            this.title = '';
            this.text = '';
            this.img = '';
        },

        async createBlog() {
             await axios.post('/createBlog', {
                
                    title: this.title,
                    text: this.text,
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
                                this.getBlogs();
                                this.closeAddBlog();
                                
                            }
                        })
                    }  
                               
                }).catch((error) => {
                    console.log(error);
            });
        },

        getBlogs() {
            axios.get('/getBlogs')
                .then(response => {
                    this.blogs = response.data.blogs;
                })
            .catch(error => {
                console.log(error);
                })
        },

        showEditBlog(id) {
            this.currentBlogId = id;
            this.title = this.blogs.find(a => a.id == id).title;
            this.text = this.blogs.find(a => a.id == id).body;
            this.img = this.blogs.find(a => a.id == id).img;
            
            $ ("#editBlog").modal("show");
        },

        closeEditBlog() {
            $("#editBlog").modal('hide');

            this.clearBlogModel();
        },

         async editBlog() {
            
            await axios.post('/editBlog', {

                    id: this.currentBlogId,
                    title: this.title,
                    text: this.text,
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
                                this.getBlogs();
                                this.closeEditBlog();
                                
                            }
                        })
                    }  
                               
                }).catch((error) => {
                    console.log(error);
            });
        },

        deleteBlog(id){
            this.currentBlogId = id;
            axios.delete('/deleteBlog/' + id)
                .then()
                .catch(err => (console.log(err)));
            this.getBlogs();
        },
    },

    data() {
        return  {
            title: '',
            text: '',
            img: '',
            blogs: [],
            currentBlogId: ''
        }
    }
}
</script>