<template>
    <nav class="navbar navbar-expand-md navbar-light">
            <div id="menu">
                <button class="navbar-toggler mx-2" type="button" data-toggle="collapse" data-target="#menu-a" aria-controls="menu-a" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <router-link to="/" class="navbar-brand">
                <font size="5" color="#808080">U</font>
                <font size="5" color="#00bfff">M</font>
                <font size="5" color="#808080">UU</font>
            </router-link>

            <div class="collapse navbar-collapse mx-3" id="menu-a">
                <ul class="navbar-nav mt-1 mt-lg-0">
                <li class="nav-item">
                    <router-link to="/" class="nav-link">トップ</router-link>
                </li>
                <li class="nav-item">
                    <div to="/product" class="nav-link" v-on:click="search_id()">商品一覧</div>
                </li>
                <li class="nav-item">
                    <router-link to="/inquiry" class="nav-link">お問い合わせ</router-link>
                </li>
                </ul>
            </div>

            <form class="form-inline ml-3 mx-auto" @submit.prevent="search(serch_word)" >
                <div class="input-group">       
                    <input v-model="serch_word" type="text" class="form-control" style="width:250px;" placeholder="商品検索">
                    <div class="input-group-append">
                        <button type="submit"  class="btn btn-primary">
                                <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            

            <div class="dropdown mx-3">
                <a class="dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hover="dropdown">
                    <font size="5" color="#808080">
                        <i class="fas fa-user"></i>
                    </font>
                </a>
                <div v-if="isLogin">
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" style="z-index:9999">
                        <div class="mx-3">
                            <p>{{ user.first_name + user.last_name }}さん</p>
                            <router-link to="/mypage" tag="button" class="btn btn-primary btn-block">マイページ</router-link>
                            <button @click="logout" class="btn btn-danger btn-block">ログアウト</button>   
                        </div>
                        
                    </div>
                </div>
                <div v-else>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" style="z-index:9999">
                        <div class="mx-3">
                        <p>ゲストさん</p>
                            <router-link to="/login" tag="button" class="btn btn-primary btn-block">ログイン</router-link>
                        <hr>
                            <p>初めての方は</p>
                            <router-link to="/newuser" tag="button" class="btn btn-danger btn-block">新規登録</router-link>
                        </div>
                    </div>
                </div>
            </div>

            <div id="basket" class="navbar-nav mx-2">
                <router-link to="/cart">
                    <font size="5" color="#808080">
                         <i class="fas fa-shopping-cart"></i>
                    </font>
                    <span v-if="cart > 0" class="badge badge-primary">{{cart}}</span>
                </router-link>
            </div>
    </nav>
</template>

<script>
export default {
    data(){
        return{
            serch_word:'',
        }
    },
    computed:{
        isLogin : function(){
            return this.$store.state.isLogin
        },
        user : function(){
            return this.$store.state.user
        },
        cart : function(){
            if(this.isLogin == true){
                return this.$store.state.count;
            }else{
                return 0;
            }
        },
    },
    methods:{
        logout(){
            var self = this;
            //axios.post('/api/logout').then(res => {
                axios.defaults.headers.common['Authorization'] = '';
                this.$store.commit('RESET_VUEX_STATE');
                axios.get('api/cart/count/' + self.$store.state.user.id).then(res => {
                        this.$store.commit('count',-(res.data));
                })
                this.$router.push({path: '/'});
            //})
        },
        search(word){
            if(this.$router.name === 'productList'){
                this.$store.commit('changeKeyword',word);
                this.$store.commit('changeCategory',0);        
            }else{
                this.$store.commit('changeKeyword',word);
                this.$store.commit('changeCategory',0);    
                this.$router.push({path: '/product'});
            }            
        },
        search_id(){
            if(this.$router.name === 'productList'){
                this.$store.commit('changeCategory',0);    
                this.$store.commit('changeKeyword','');
            }else{
                this.$store.commit('changeCategory',0);
                this.$store.commit('changeKeyword','');
                this.$router.push({path: '/product'});
            }            
        }
    }
}
</script>

<style scoped>
    .dropdown:hover > .dropdown-menu{
        display: block;
    }

    .dropdown-menu:hover > .doropdown-menu{
        display: block;
    }

    .navbar{
        box-shadow: 0 8px 6px -6px #dcdcdc;
        z-index: 999;
    }
    .badge{
        margin-left:  -10px;
    }

</style>