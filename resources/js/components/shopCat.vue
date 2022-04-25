<template>
    <div>
        <div class="container" style="margin-top: 30px">

            <div class="row" style="margin-top: 60px; margin-bottom: 611px" >
                <div class="col-md-4" v-for="(cat, index) in this.categories" :key="index" style="margin-top: 30px;">
                    <div class="card" style="text-align:center;">
                        <img class="card-img-top" v-bind:src="cat.img" alt="Card image cap" style="width:150px; height:150px; margin-left: 130px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ cat.name }}</h5><hr>
                            <a :href="'/products/' + cat.id" class="btn btn-primary">Detaljnije</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    mounted(){
        this.getCat();

        
    },
        
    methods:{
        getCat() {
            axios.get('/getCategories')
                .then(response => {
                    this.categories = response.data.categories;
                })
            .catch(error => {
                console.log(error);
                })
        },
       
    },

    data(){
        return{
           categories: []
        }
    }
}
</script>

