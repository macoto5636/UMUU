import Vue from 'vue'
import VueRouter from 'vue-router'


import Top from './components/templates_components/TopComponent.vue'
import Admin from './components/templates_components/AdminComponent.vue'

import AdminLogin from './components/admin/adminLogin.vue'

//注文、配送管理
import Shipping from  './components/shipping/ShippingComponent.vue'
import ShippingDetail from './components/shipping/ShippingDetail.vue'

import Login from  './components/login/LoginBComponent.vue'

import Mypage from  './components/templates_components/MypageComponent.vue'

//レビュー
import Review from './components/reviews/root.vue'

//新規登録 newuser
import Newuser from  './components/newuser/NewUserPageComponent.vue'
import Newuser1 from  './components/newuser/NewUser1Component.vue'
import Newuser2 from  './components/newuser/NewUser2Component.vue'
import Newuser3 from  './components/newuser/NewUser3Component.vue'

//パスワード忘れた
//メイン画面
import PassForget from './components/password_forget/PassWordForgetPageComponent'
import PassForget1 from './components/password_forget/PassWordForget1Component'
//メールを受け付けたよ!!
import PassForget2 from './components/password_forget/PassWordForget2Component'
//パスワード再設定
import PassForget3 from './components/password_forget/PassWordForget3Component'
//パスワード再設定完了
import PassForget4 from './components/password_forget/PassWordForget4Component'

//個人情報の確認
import Verification from './components/user_verification/UserVerificationPageComponent'
import Verification1 from './components/user_verification/UserVerification1Component'
//アカウント情報変更
import UserChange from './components/user_change/UserChangePageComponent'
import UserChange1 from './components/user_change/UserChange1Component'
import UserChange2 from './components/user_change/UserChange2Component'

//お問い合わせ inquiry
import Inquiry from './components/inquiry/Inquiry.vue'
import InquiryForm from './components/inquiry/InquiryForm.vue'
import InquiryConfirm from './components/inquiry/InquiryConfirm.vue'

//注文履歴 orderhistory
import Order_History from './components/order_history/order_history.vue'

//商品関連 product
import Product from  './components/product/ProductComponent.vue'
import ProductDetail from  './components/product/ProductDetail.vue'

//商品管理関連 product_admin
import ProductAdmin from  './components/product_admin/ProductAdmin.vue'
import ProductAddPage from './components/product_admin/ProductAddPage.vue'
import ProductAdd from  './components/product_admin/ProductAdd.vue'
import ProductAddCheck from  './components/product_admin/ProductAddCheck.vue'
import Category from  './components/product_admin/Category.vue'

import ProductEditPage from  './components/product_admin/ProductEditPage.vue'
import ProductEdit from  './components/product_admin/ProductEdit.vue'
import ProductEditCheck from  './components/product_admin/ProductEditCheck.vue'

//注文関連 order
import OrderPage from  './components/order/OrderPageComponent.vue'
import Order from  './components/order/OrderComponent.vue'
import OrderConfirm from './components/order/OrderConfirm.vue'
import OrderComplete from './components/order/OrderComplete.vue'

//入庫関連 storing
import Storing from  './components/storing/StoringComponent.vue'

//ニュース関連 news
import News from './components/news/NewsComponent.vue'
import NewsGetList from './components/news/NewsGetListComponent.vue'
import NewsArticle from './components/news/NewsArticle.vue'
import NewsEdit from  './components/news/NewsEditComponent.vue'

//日計表
import Nikkei from './components/nikkei/nikkeiPage.vue'

//カート関連 cart
import Cart from  './components/cart/root.vue'

//欲しいもの関連
import Want from './components/wants/root.vue'

import store from './store'


Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: Top
    },
    {
        path: '/login',
        component: Login,
        meta: { requiresAuth: false }
    },
    {
        path: '/newuser',
        component: Newuser,
        children:[
            {
                path: '/newuser',
                component: Newuser1
            },
            {
                path: '/confirm',
                component: Newuser2
            },
            {
                path: '/complete',
                component: Newuser3
            }
        ]
    },
    {
        path: '/pass/forget',
        component: PassForget,
        children:[
            {
                path:'/pass/forget',
                component:PassForget1
            },
            {
                path:'/pass/forget/receve',
                component:PassForget2
            },
            {
                path:'/pass/resetting',
                component:PassForget3
            },
            {
                path:'/pass/resetting/end',
                component:PassForget4
            }
        ]
    },
    {
        path: '/user/Verification',
        component: Verification,

        children:[
            {
                path:'/user/Verification',
                component: Verification1
            }
        ]
        
    },
    {
        path:'/user/change',
        component: UserChange,
        children:[
            {
                path:'/user/change',
                component:UserChange1,
            },
            {
                path:'/user/change/end',
                component:UserChange2,
            }
        ]
    },
    {
        path:'/review/{id}',
        component: Review,
        name:'Review',
        meta:{requiresAuth: true}
    },
    {
        path: '/product',
        component: Product,
        name: 'productList',
        props:true,
    },
    {
        path: '/product/:id',
        name: 'product',
        component: ProductDetail,
    },
    {
        path: '/order',
        component: OrderPage,
        children:[
            {
                path: '/order',
                component: Order,
                meta: { requiresAuth: true }
            },
            {
                path: '/order/confirm',
                component: OrderConfirm,
                meta: { requiresAuth: true }
            },
            {
                path: '/order/complete',
                component: OrderComplete,
                meta: { requiresAuth: true }
            },

        ]
    },
    {
        path: '/inquiry',
        component: Inquiry,
        children:[
            {
                path: '/inquiry',
                component: InquiryForm
            },
            {
                path: '/inquiry/confirm',
                component: InquiryConfirm
            },
        ]
    },
    {
        path:'/news',
        component: News,
        children:[
            {
                path: '/news',
                component: NewsGetList,
            },
            {
                path: '/news/:id',
                name: 'news',
                component: NewsArticle,
            },
        ]
    },
    {
        path: '/admin',
        component: AdminLogin,
    },
    {
        path: '/admin/menu',
        component: Admin,
        meta: { requiresAuth: true }
    },
    {
        path: '/admin/newsedit',
        component: NewsEdit,
        meta: { requiresAuth: true }
        
    },
    {
        path: '/admin/shipping',
        component: Shipping,
        meta: { requiresAuth: true }
    },
    {
        path: '/admin/shipping/:id',
        component: ShippingDetail,
        name: 'ShippingDetail',
        meta: { requiresAuth: true },
        props:true,
    },
    {
        path: '/admin/storing',
        component: Storing,
        meta: { requiresAuth: true }
    },
    {
        path: '/admin/product',
        component: ProductAdmin,
        meta: { requiresAuth: true }
    },
    {
        path: '/admin/product/category',
        component: Category,
        meta:{requiresAuth:true}
    },
    {
        path: '/admin/product/add',
        component: ProductAddPage,
        children:[
            {
                path: '/admin/product/add',
                component: ProductAdd,
                meta: { requiresAuth: true }
            },
            {
                path: '/admin/product/add/check',
                component: ProductAddCheck,
                name: 'productAddCheck',
                props:true,
                meta:{requiresAuth:true}
            },
        ]
    },
    {
        path: '/admin/product/:id',
        component: ProductEditPage,
        name: 'productEdit',
        props: true,
        children:[
            {
                path: '/admin/product/:id',
                component: ProductEdit,
                name: 'productEdit',
                
            },
            {
                path: '/admin/product/:id/check',
                component: ProductEditCheck,
                name: 'productEditCheck'
            }
        ]
    },
    {
        path: '/mypage',
        component: Mypage,
        meta: { requiresAuth: true } 
    },
    {
        path: '/mypage/order_history',
        component: Order_History,
        meta:{ requiresAuth: true }
    },
    {
        path:'/cart',
        component: Cart,
        meta:{ requiresAuth: true }
    },
    {
        path:'/mypage/want',
        component: Want,
        meta:{requiresAuth: true}
    },
    {
        path:'/admin/nikkei',
        component: Nikkei,
        meta:{requiresAuth: true}
    },



]

const router = new VueRouter({
    mode: 'history',
    routes,
    scrollBehavior (to, from, savedPosition) {
        if (savedPosition) {
           return savedPosition
        } else {
           return { x: 0, y: 0 }
        }
      }
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      // このルートはログインされているかどうか認証が必要です。
      // もしされていないならば、ログインページにリダイレクトします。
      if (!store.state.isLogin) {
        if(!store.state.admin){
            next({
                path: '/login',
                query: { redirect: to.fullPath }
              })
        }else{
            next({
                path: '/admin',
                query: { redirect: to.fullPath }
            })
        }

      } else {
        next()
      }
    } else {
      next() // next() を常に呼び出すようにしてください!
    }
  })

export default router