<template>
    <div>
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="card" style="height: 300px;">
                    <div class="card-body" style="padding: 50px;">
                        <h3 style="text-align:center;">Ukupan broj korisničkih naloga</h3>
                        <p style="font-size: 80px; text-align:center;"> {{ this.countU }} </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card" style="height: 300px;">
                    <div class="card-body" style="padding: 50px;">
                        <h3 style="text-align:center;">Ukupan broj kategorija</h3>
                        <p style="font-size: 80px; text-align:center;"> {{ this.countC }} </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card" style="height: 300px;">
                    <div class="card-body" style="padding: 50px;">
                        <h3 style="text-align:center;">Ukupan broj proizvoda</h3>
                        <p style="font-size: 80px; text-align:center;"> {{ this.countP }} </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <div class="card" style="height: 500px;">
                    <div class="card-body" style="padding: 50px;">
                        <h3 class="mb-5" style="text-align:center;">Poslednji korisnik</h3>
                        <p style="font-size: 50px; text-align:center;"> {{ this.lastU }} </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card" style="height: 500px;">
                    <div class="card-body" style="padding: 50px;">
                        <h3 class="mb-5" style="text-align:center;">Poslednja kategorija</h3>
                        <p style="font-size: 50px; text-align:center;"> {{ this.lastC }} </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card" style="height: 500px;">
                    <div class="card-body" style="padding: 50px;">
                        <h3 class="mb-5" style="text-align:center;">Poslednji proizvod</h3>
                        <p style="font-size: 50px; text-align:center;"> {{ this.lastP }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.countUsers();
        this.countCat();
        this.countProducts();
        this.lastUser();
        this.lastCat();
        this.lastProduct();
    },

    methods: {
        countUsers() {
            axios.get('/countUsers')
                .then(response => {
                    this.countU = response.data.count;
                })
            .catch(error => {
                console.log(error);
                })
        },

        countCat() {
            axios.get('/countCat')
                .then(response => {
                    this.countC = response.data.count;
                })
            .catch(error => {
                console.log(error);
                })
        },

        countProducts() {
            axios.get('/countProducts')
                .then(response => {
                    this.countP = response.data.count;
                })
            .catch(error => {
                console.log(error);
                })
        },

        lastUser() {
            axios.get('/lastUser')
                .then(response => {
                    this.lastU = response.data.last;
                })
            .catch(error => {
                console.log(error);
                })
        },

        lastCat() {
            axios.get('/lastCat')
                .then(response => {
                    this.lastC = response.data.last;
                })
            .catch(error => {
                console.log(error);
                })
        },

        lastProduct() {
            axios.get('/lastProduct')
                .then(response => {
                    this.lastP = response.data.last;
                })
            .catch(error => {
                console.log(error);
                })
        },
    },

    data() {
        return {
            countU: '',
            countC: '',
            countP: '',
            lastU: '',
            lastC: '',
            lastP: ''
        }
    }
}
</script>