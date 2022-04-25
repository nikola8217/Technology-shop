<template>
    <div>
        <div class="row">
            <div class="mb-3">
                    <h3 style="text-align: center;">Sve narudzbine</h3>

            </div>
           
        </div>

         <table class="table table-hover" style="border-radius: 10px; background-color: #fff;">
                        <thead style="background-color: #0b5ed7; color: #fff;">
                            <tr style="border-radius: 10px">
                                <th style="text-align: center;">Kupac</th>
                                <th style="text-align: center;">Adresa</th>
                                <th style="text-align: center;">Drzava</th>
                                <th style="text-align: center;">Telefon</th>
                                <th style="text-align: center;">Ukupna Cena</th>
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
                .get("/getCheck?page=" + page)
                .then((response) => {
                this.ckarray = response.data;
                // console.log(ckarray);
                });
            // console.log(this.ckarray);
        },

        deleteCK(id){
            this.currentCKId = id;
            axios.delete('/deleteCKMen/' + id)
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
    },

    data() {
        return {
            ckarray: {},
            currentCKId: ''
        }
    }
}
</script>