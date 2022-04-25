<template>
    <div>
        <div class="container" style="margin-top: 30px; margin-bottom: 60px;">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <h3 class="card-header">Narudzbina</h3>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Proizvod</th>
                                        <th>Cena</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="cart in carts" v-bind:key="cart.id">
                                        <td> {{ cart.name }} </td>
                                        <td> {{ cart.price }},00 dinara </td>
                                    </tr>
                                </tbody>
                            </table>
                           
                            <form class="form">
                                <div class="card-body">
                                    

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Ulica i broj</label>
                                                <input class="form-control" type="text" v-model="street">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Postanski broj</label>
                                                <input class="form-control" type="text" v-model="pb">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Grad</label>
                                                <input class="form-control" type="text" v-model="city">
                                            </div>
                                        </div>                           
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Drzava</label>
                                                <input class="form-control" type="text" v-model="country">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Broj telefona</label>
                                                <input class="form-control" type="text" v-model="phone">
                                            </div>
                                        </div>

                                                    
                                    </div>

                                    <div class="row" style="text-align: right;">
                                        <div class="mb-3">
                                            <p>Ukupno: {{ total }},00 dinara</p>
                                            <a class="btn btn-primary" @click="checkout()">Izvrši kupovinu</a>
                                        </div>
                                    </div>

                                </div>


                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
export default {
    data() {
        return {
            carts: [],
            total: '',
            street: '',
            pb: '',
            city: '',
            country: '',
            phone: '',
            points: ''
        }
    },

    created() {
        this.viewCart();
    },

    mounted() {
        this.getPoints();
    },

    

    methods: {
        viewCart() {
            if(localStorage.getItem('carts')) {
                this.carts = JSON.parse(localStorage.getItem('carts'));
                this.total = this.carts.reduce((total, item) => {
                    return total + item.price;
                }, 0);
                localStorage.setItem('total', this.total);
            }
        },

        checkout() {

            if(this.points >= 50) {
                Swal.fire({
                    title: '',
                    text: 'Imate 50 poena! Ostvarili ste pravo na popust od 20%, da li želite da ga iskoristite?',
                    icon: 'question',
                    confirmButtonColor: "#0b5ed7"
                })
                .then(value => {
                    if(value.isConfirmed){
                        this.popust();
                        Swal.fire({
                            title: '',
                            text: 'Ukupna cena sa popustom je ' + this.total + ',00 dinara!',
                            icon: 'question',
                            confirmButtonColor: "#0b5ed7"
                        })
                        .then(value => {
                            if(value.isConfirmed){
                                axios.post('/buy', {
                
                                        street: this.street,
                                        pb: this.pb,
                                        city: this.city,
                                        country: this.country,
                                        phone: this.phone,
                                        total: this.total
                                    
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
                                                text: 'Uspešno ste potrošili poene i izvršili kupovinu!',
                                                icon: 'success',
                                                confirmButtonColor: "#0b5ed7"
                                            })
                                            .then(value => {
                                                if(value.isConfirmed){
                                                    this.minusPoints();
                                                    localStorage.clear();
                                                    window.location.href = '/profile';
                                                    
                                                }
                                            })
                                        }  
                                                
                                    }).catch((error) => {
                                        console.log(error);
                                });                              
                            }
                        })      
                    }

                    else {
                        axios.post('/buy', {
                
                            street: this.street,
                            pb: this.pb,
                            city: this.city,
                            country: this.country,
                            phone: this.phone,
                            total: this.total
                                    
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
                                        text: 'Uspešno ste izvršili kupovinu!',
                                        icon: 'success',
                                        confirmButtonColor: "#0b5ed7"
                                    })
                                    .then(value => {
                                        if(value.isConfirmed){
                                        this.plusPoints();
                                        localStorage.clear();
                                        window.location.href = '/profile';            
                                    }
                                })
                            }  
                                                
                            }).catch((error) => {
                        console.log(error);
                        });                       
                    }
                })
            }

            else {
                axios.post('/buy', {
                
                            street: this.street,
                            pb: this.pb,
                            city: this.city,
                            country: this.country,
                            phone: this.phone,
                            total: this.total
                                    
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
                                        text: 'Uspešno ste izvršili kupovinu!',
                                        icon: 'success',
                                        confirmButtonColor: "#0b5ed7"
                                    })
                                    .then(value => {
                                        if(value.isConfirmed){
                                        this.plusPoints();
                                        localStorage.clear();
                                        window.location.href = '/profile';            
                                    }
                                })
                            }  
                                                
                            }).catch((error) => {
                        console.log(error);
                        });                  
            }

             
        },

        popust() {
            this.total = this.total - this.total * 20/100;
        },

        getPoints() {
            axios.get('/points')
                .then(response => {
                    this.points = response.data.bodovi;
                })
            .catch(error => {
                console.log(error);
                })
        },

        async minusPoints() {           
            this.points = this.points - 50;

            await axios.post('/updatePoints', {
                
                    points: this.points
                   
                }).then((response) => {
                   
                               
                }).catch((error) => {
                    console.log(error);
            });
        },

        async plusPoints() {
            this.points = this.points + 10;

            await axios.post('/updatePoints', {
                
                    points: this.points
                   
                }).then((response) => {
                   
                               
                }).catch((error) => {
                    console.log(error);
            });

            
        }

        

       
    }
}
</script>