require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('login-component', require('./components/login.vue').default);
Vue.component('register-component', require('./components/register.vue').default);
Vue.component('users-component', require('./components/users.vue').default);
Vue.component('category-component', require('./components/category.vue').default);
Vue.component('products-component', require('./components/products.vue').default);
Vue.component('home-component', require('./components/home.vue').default);
Vue.component('about-component', require('./components/about.vue').default);
Vue.component('contact-component', require('./components/contact.vue').default);
Vue.component('shopcat-component', require('./components/shopCat.vue').default);
Vue.component('shoppro-component', require('./components/shopPro.vue').default);
Vue.component('product-component', require('./components/product.vue').default);
Vue.component('checkout-component', require('./components/checkout.vue').default);
Vue.component('profile-component', require('./components/profile.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('homeadmin-component', require('./components/homeAdmin.vue').default);
Vue.component('homemen-component', require('./components/homeMen.vue').default);
Vue.component('blogsmen-component', require('./components/blogsMen.vue').default);
Vue.component('blog-component', require('./components/blog.vue').default);
Vue.component('blogguest-component', require('./components/blogGuest.vue').default);
Vue.component('blogview-component', require('./components/blogView.vue').default);
Vue.component('checkmen-component', require('./components/checkMen.vue').default);
Vue.component('messages-component', require('./components/messages.vue').default);
Vue.component('reply-component', require('./components/reply.vue').default);





const app = new Vue({
    el: '#app',
});
