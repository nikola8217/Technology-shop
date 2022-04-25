<template>
    <div>
        <div class="container" style="margin-top: 30px">

            <h2 style="text-align: center;">Naše mušterije kažu</h2>
                <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                        <h4>"This company is the best. I am so happy with the result!"<br><span style="font-style:normal;">Michael Roe, Vice President, Comment Box</span></h4>
                        </div>
                        <div class="item">
                        <h4>"One word... WOW!!"<br><span style="font-style:normal;">John Doe, Salesman, Rep Inc</span></h4>
                        </div>
                        <div class="item">
                        <h4>"Could I... BE any more happy with this company?"<br><span style="font-style:normal;">Chandler Bing, Actor, FriendsAlot</span></h4>
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            <div class="row" >
                <h2 style="text-align: center;">Specijalne ponude samo kod nas!</h2>


                <!-- dugme korpa  -->

                <div class="col-md-12 text-right" style="text-align:center;">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#cart" @click="viewCart()">
                        <i class="fa fa-shopping-cart"></i>      
                    </button>    
                </div>  

                <!-- kraj dugme korpa  -->


                <!-- modal korpa  -->

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

                <!-- kraj modal korpa  -->


                <div class="col-md-6" v-for="(act, index) in this.actions" :key="index" style="margin-top: 30px;">
                    <div class="card" >
                        <img class="card-img-top" v-bind:src="act.img" alt="Card image cap" >
                        <div class="card-body">
                            <h5 class="card-title">{{ act.name }}</h5>
                            <p class="card-text">{{ act.price }},00 dinara</p><hr>
                            <a href="#" class="btn btn-primary">Detaljnije</a>
                            <a href="#" class="btn btn-success" @click="addCart(act)">Dodaj u korpu</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row" style="margin-top: 80px; margin-bottom: 50px" >
                <h2 style="text-align: center;">Bacite pogled na naše ostale proizvode!</h2>
                <div class="col-md-4" v-for="(cat, index) in this.categories" :key="index" style="margin-top: 30px;">
                    <div class="card" >
                        <img class="card-img-top" v-bind:src="cat.img" alt="Card image cap" >
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
        this.getActions();
        this.getCat();

        
    },

    created() {
        this.viewCart();
    },
        
    methods:{
        getActions() {
            axios.get('/getActions')
                .then(response => {
                    this.actions = response.data.actions;
                })
            .catch(error => {
                console.log(error);
                })
        },

        getCat() {
            axios.get('/getCategories')
                .then(response => {
                    this.categories = response.data.categories;
                })
            .catch(error => {
                console.log(error);
                })
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
        }


       
    },

    data(){
        return{
           actions: [],
           categories: [],
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

<style>
    .carousel-control.right, .carousel-control.left {
  background-image: none;
  color: #f4511e;
}

.carousel-indicators li {
  border-color: #f4511e;
}

.carousel-indicators li.active {
  background-color: #f4511e;
}

.item h4 {
  font-size: 19px;
  line-height: 1.375em;
  font-weight: 400;
  font-style: italic;
  margin: 70px 0;
}

.item span {
  font-style: normal;
}
</style>