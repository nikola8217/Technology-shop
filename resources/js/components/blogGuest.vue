<template>
    <div>
        <div class="row">
            <div class="card mb-3" v-for="blog in blogs.data" :key="blog.id">
                    <div class="card-body">
                        
                            <img class="mb-5" style='width: 100%; height: 400px; padding:30px;' v-bind:src="blog.img" alt="Card image cap">
                        

                        
                            <h3 class="mb-5"><a :href="'/blogView/' + blog.id"  style="color: black; padding: 30px; text-align: center;"> {{ blog.title }} </a></h3>

                            <span style="padding: 30px;">Napisao {{ blog.created_by }} </span>
                        
                        

                    </div>
                </div>
        
                <pagination :data="blogs" @pagination-change-page="getResults" style="margin-bottom: 50px;"></pagination>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.getResults();
    },

    methods: {
        async getResults(page) {
            if (typeof page === "undefined") {
                page = 1;
            }
            await axios
                .get("/getAllBlogs?page=" + page)
                .then((response) => {
                this.blogs = response.data;
                // console.log(ckarray);
                });
            // console.log(this.ckarray);
        },
    },

    data() {
        return {
            blogs: {}
        }
    }
}
</script>