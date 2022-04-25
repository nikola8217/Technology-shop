<template>
     <div>
        <div class="row">
            <div class="mb-3">
                    <h3 style="text-align: center;">Poruke</h3>

            </div>

            
           
        </div>

        <table class="table table-hover" style="border-radius: 10px; background-color: #fff;">
            <thead style="background-color: #0b5ed7; color: #fff;">
                <tr style="border-radius: 10px">
                    
                    <th style="text-align: center;">Subject</th>
                    <th style="text-align: center;">Email adresa</th>
                    <th style="text-align: center;">Akcije</th>
                    
                   
                </tr>
            </thead>
            <tbody>
                <tr v-for="(msg, index) in this.messages" :key="index">
                    
                    <td style="text-align: center;"><a :href="'/message/' + msg.id">{{ msg.subject }}</a></td>
                    <td style="text-align: center;">{{ msg.email }}</td>
                    <td style="text-align: center;">
                        
                        <button class="btn btn-danger" value="Obriši" @click="deleteMsg(msg.id)">Obriši</button>
                    </td>
                    
                </tr>
                
            </tbody>
        </table>

       


    </div>
</template>

<script>
export default {
    mounted() {
        this.getMessages();
    },

    methods: {
        getMessages() {
            axios.get('/getMessages')
                .then(response => {
                    this.messages = response.data.messages;
                })
            .catch(error => {
                console.log(error);
                })
        },
    },

    data() {
        return {
            messages: []
        }
    }
}
</script>