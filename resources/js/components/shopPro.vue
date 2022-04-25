<template>
    <div>
        <div class="container" style="margin-top: 30px">

            
                <div class="row mt-2">
                    
                    <div class="col-md-12 text-right" style="text-align:center;">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#cart" @click="viewCart()">
                            <i class="fa fa-shopping-cart"></i>
                            
                        </button>    
                    </div>       
                </div>
            

            <!-- Modal korpa -->
            <div id="cart" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Vaša korpa</h4>
                        </div>
                        <div class="modal-body">
                             <table class="table table-striped text-left">
                                 <tbody>
                                     <tr v-for="(cart, n) in carts" v-bind:key="cart.id">
                                         <td><img v-bind:src="cart.img"  alt="" width="100" height="100"></td>
                                         <td> {{ cart.name }} </td>
                                         <td> {{ cart.price }}, 00 dinara </td>
                                         <!-- <td width="100"><input type="text" readonly class="form-control" v-model="cart.amount"></td> -->
                                         <td width="60">
                                             <button @click="removeCart(n)" class="btn btn-danger btn-sm">Ukloni</button>
                                         </td>
                                     </tr>
                                 </tbody>

                             </table>
                        </div>
                        <div class="modal-footer">
                            Ukupno: {{ totalprice }},00 dinara
                            <a @click="createCheckout()" class="btn btn-primary">Checkout</a>
                        </div>
                    </div>

                </div>
            </div>
        <!-- Kraj modal korpa  -->

        

            <div class="row" style="margin-bottom: 25px" >
                <div class="col-md-4" v-for="pro in products.data" :key="pro.id" style="margin-top: 30px;">
                    <div class="card" style="text-align:center;">
                        <img class="card-img-top" v-bind:src="pro.img" alt="Card image cap" style="width:150px; height:150px; margin-left: 130px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ pro.name }}</h5>
                            <p>{{ pro.price }},00 dinara</p>
                            <!-- <input type="number" v-model="quantity" style="width: 60px;"> -->
                            <hr>
                            <a :href="'/product/' + pro.id" class="btn btn-primary">Detaljnije</a>
                            <a href="#" class="btn btn-success" @click="addCart(pro)">Dodaj u korpu</a>
                        </div>
                    </div>
                </div>
            </div>

            <pagination :data="products" @pagination-change-page="getResults" style="margin-bottom: 50px;"></pagination>

        </div>


            
    </div>
</template>

<script>
export default {
    mounted(){
        
        // this.getProducts(this.id);
        // this.viewCart();
        this.getResults();
        
    },

    created() {
        this.viewCart();
        
    },

    props:['id'],
        
    methods:{
        // async getProducts(id) {
            
        //     await axios.get('/getProducts/' + id)
        //         .then((response) => {
        //             this.products = response.data.products;
        //         })
        //     .catch(error => {
        //         console.log(error);
        //         })
        // },

        async getResults(page) {
            if (typeof page === "undefined") {
                page = 1;
            }
            
            await axios
                .get("/getProducts/" + this.id + "?page=" + page)
                .then((response) => {
                this.products = response.data;
                // console.log(ckarray);
                });
            // console.log(this.products);
        },

        viewCart() {
            

            if(localStorage.getItem('carts')) {
                this.carts = JSON.parse(localStorage.getItem('carts'));
                this.badge = this.carts.length;
                this.totalprice = this.carts.reduce((total, item) => {
                    return total + item.price;
                }, 0);
            }

            $("#cart").modal("show");
        },

        addCart(pro) {
            this.cartadd.id = pro.id;
            this.cartadd.name = pro.name;
            this.cartadd.price = pro.price;
            this.cartadd.img = pro.img;
            // this.carts.amount = this.quantity;
            this.carts.push(this.cartadd);
            this.cartadd = {};
            this.storeCart();
        },

        removeCart(pro) {
            this.carts.splice(pro, 1);
            this.storeCart();
        },

        storeCart() {
            let parsed = JSON.stringify(this.carts);
            localStorage.setItem('carts', parsed);
            this.viewCart();
        },

        createCheckout() {

           
           
            if (this.totalprice == 0) {
                 Swal.fire({
                    title: '',
                    text: 'Vaša korpa je prazna!',
                    icon: 'warning',
                    confirmButtonColor: "#0b5ed7"
                })

                // $("#cart").modal("hide");
            }

            else {
                window.location.href = '/checkout';
            }
        },

        

    },

    data(){
        return{
            products: {},
            carts: [],
            cartadd: {
                id: '',
                name: '',
                price: '',
                // amount: ''
                cart: ''
            },
            badge: '0',
            quantity: '1',
            totalprice: '0',
            
           
        }
    }
}
</script>