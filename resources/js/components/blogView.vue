<template>
    <div>
        <div class="row" v-for="(blog, index) in this.blogs" :key="index">
            <div class="mb-3">
                <h2 style="text-align: center;"> {{ blog.title }} </h2>
            </div>

            <img class="mb-5" v-bind:src="blog.img" alt="Card image cap">

            <p class="mb-5"> {{ blog.body }} </p>

            <span>Napisao {{ blog.created_by }} </span>
            
        </div>

    </div>
</template>

<script>
export default {
    mounted() {
        this.getBlog(this.id);

    },

    props: ['id'],

    methods: {

        async getBlog(id) {
            
            await axios.get('/getBlog/' + id)
                .then((response) => {
                    this.blogs = response.data.blog;
                })
            .catch(error => {
                console.log(error);
                })
        },

    },

    data() {
        return {
            blogs: [],
        }
    }
}
</script>