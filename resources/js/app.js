/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'
import router from './router'
import Vuex from 'vuex'
import App from './App.vue'
import store from './store'

Vue.use(Vuex);
require('./bootstrap');

window.state = store.state;
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//サイトパーツ(ヘッダーやフッター、サイドメニュー等) siteparts
Vue.component('header-component', require('./components/siteparts/HeaderComponent.vue').default);
Vue.component('admin-header', require('./components/siteparts/AdminHeader.vue').default);
Vue.component('footer-component', require('./components/siteparts/FooterComponent.vue').default);
Vue.component('sidemenu-component', require('./components/siteparts/SidemenuComponent.vue').default);

//パーツ関連(タイトルやボタン等) parts
Vue.component('carousel-component', require('./components/parts/CarsouselComponent.vue').default);
Vue.component('title-component', require('./components/parts/TitleComponent.vue').default);
Vue.component('backadmin-component', require('./components/parts/BackAdminComponent.vue').default);

//ログイン関連 login
Vue.component('loginform-component', require('./components/login/LoginFormComponent.vue').default);

//ニュース関連 news
Vue.component('newslist-component', require('./components/news/NewslistComponent.vue').default);

//商品関連 product
Vue.component('product', require('./components/product/Product.vue').default);
Vue.component('product-header', require('./components/product/ProductHeaderComponent.vue').default);
Vue.component('product-list', require('./components/product/ProductlistComponent.vue').default);
Vue.component('newproduct', require('./components/product/NewProduct.vue').default);

//買い物かご関連 cart
Vue.component('cart-product', require('./components/cart/cartProduct.vue').default);
Vue.component('root', require('./components/cart/root.vue').default);
Vue.component('total-payment', require('./components/cart/totalPayment.vue').default);

//注文関連 order
Vue.component('order-component', require('./components/order/OrderComponent.vue').default);
Vue.component('order-product', require('./components/order/OrderProduct.vue').default);

//注文履歴 order_history
Vue.component('order-history-list', require('./components/order_history/order_history_list.vue').default);
Vue.component('order-parts', require('./components/order_history/order_parts.vue').default);
Vue.component('order-product', require('./components/order_history/order_product.vue').default);

//欲しいもの関連 want
//欲しい物リスト画面のコンポーネント
Vue.component('wants-product', require('./components/wants/wantsProduct.vue').default);
//単価表示・削除・カートに移動ボタンを表示する
Vue.component('wants-side', require('./components/wants/wantsSide.vue').default);
//検索・between・単価安い高い ヘッダー
Vue.component('wants-header', require('./components/wants/wantsHeader.vue').default);
//コンポーネントのroot
Vue.component('wants-root', require('./components/wants/root.vue').default);

//レビュー投稿画面
Vue.component('review-root', require('./components/reviews/root.vue').default);
//レビュー表示画面
Vue.component('review-list', require('./components/review_list/root.vue').default);
Vue.component('review', require('./components/review_list/review.vue').default);
//レビューの星 npm install vue-star-ratingを打って
import StarRating from 'vue-star-rating';
Vue.component('star-rating', StarRating);

//発送
Vue.component('shipping-product', require('./components/shipping/ShippingProduct.vue').default);

//カレンダー
import Calendar from 'v-calendar/lib/components/calendar.umd'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'
Vue.component('calendar', Calendar)
Vue.component('date-picker', DatePicker)

Vue.component('nikkei-order', require('./components/nikkei/nikkeiOrder.vue').default);

//templates_components
Vue.component('top-component', require('./components/templates_components/TopComponent.vue').default);
Vue.component('admin-component', require('./components/templates_components/AdminComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 var Auth = {
     loggedIn: false,
     login: function(){ this.loggedIn = true },
     logout: function(){ this.loggedIn = false}
 };

const app = new Vue({
    el: '#app',
    router,
    store: store,
    components: {App},
    template: '<App />'
});
