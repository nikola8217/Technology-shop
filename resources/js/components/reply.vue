<template>
    <div>
        <div class="row">
            <div class="card mb-5" v-for="(msg, index) in this.msgs" :key="index">
                <div class="card-body">
                    <p><b>{{ msg.subject }}</b></p><span>Od: {{ msg.email }} </span> <br><br><br>
                    <p> {{ msg.body }} </p>

                </div>
            </div>
        </div>

        <form>
        

        <div class="form-group mb-3">
            <label for="exampleFormControlTextarea1 mb-3">Odgovor: </label> <br><br>
            <textarea class="form-control"  rows="7"></textarea>
        </div>

        </form>
    </div>
</template>

<script>
export default {
    mounted() {
        

        this.getMessage(this.id);
        this.email = this.msgs.email;
        
        
        
    },

    props: ['id'],

    methods: {
        async getMessage(id) {
            
            await axios.get('/getMessage/' + id)
                .then((response) => {
                    this.msgs = response.data.msg;
                })
            .catch(error => {
                console.log(error);
                })
        },
    },

    data() {
        return {
            msgs: [],
            email: ''
           
        }
    }
}
</script>