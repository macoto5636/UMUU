<template>
    <div class="my-3">
        <!--
        <ul class="list-group mt-3">
            <div v-for="item in items" :key="item.title">
                <router-link v-bind:to="item.href" class="list-group-item list-group-item-action">
                    {{ item.title }}
                </router-link>
            </div>
        </ul>
        -->
        <div v-if="admin == false">
            <div class="title">カテゴリ一覧</div>
                <div class="subtitle">サプリメント</div>
                    <div v-on:click="search(1)" ><div class="sub">美容サプリ</div></div>
                    <div v-on:click="search(2)" ><div class="sub">健康サプリ</div></div>     
                    <div v-on:click="search(3)" ><div class="sub">ダイエットサプリ</div> </div>
                <div class="subtitle">食品・飲料</div>
                    <div v-on:click="search(4)" ><div class="sub">スムージー</div></div>
                    <div v-on:click="search(5)" ><div class="sub">酵素</div> </div>
                    <div v-on:click="search(6)" ><div class="sub">雑炊</div> </div>
                    <div v-on:click="search(7)" ><div class="sub">クッキー</div> </div>
            <br>
            
            <div class="titleonly">アカウントサービス</div>
                <div v-if="isLogin==true">
                    <router-link to="/mypage"><div class="sub">マイページ</div></router-link>
                    <router-link to="/cart"><div class="sub">ショッピングカート</div></router-link>
                    <router-link to="/mypage/order_history"><div class="sub">注文履歴</div></router-link>
                    <router-link to="/mypage/want"><div class="sub">欲しいものリスト</div></router-link>
                    <router-link to="/mypage"><div class="sub">アカウント管理</div></router-link>
                    <router-link to="/mypage"><div class="sub">定期購入管理</div></router-link>                
                </div>
                <div v-else>
                    <router-link to="/login"><div class="sub">ログイン</div></router-link>
                    <router-link to="/newuser"><div class="sub">会員登録</div></router-link>
                </div>
                <br>

            <div class="titleonly">その他</div>
                <router-link to="/news"><div class="sub">ニュース</div></router-link>            
                <router-link to="/inquiry"><div class="sub">お問い合わせ</div></router-link> 

            <div v-if="isLogin == false" class="btn btn-sm btn-secondary my-3" @click="logoutB">　管理者画面へ　</div>
        </div>
        <div v-else>
            <div class="titleonly">メニュー</div>
                <router-link to="/admin/product"><div class="sub">商品管理</div></router-link>
                <router-link to="/admin/shipping"><div class="sub">注文・配送管理</div></router-link>
                <router-link to="/admin/storing"><div class="sub">入庫管理</div></router-link>
                <router-link to="/admin/nikkei"><div class="sub">売上日計表</div></router-link>
                <router-link to="/admin/newsedit"><div class="sub">ニュース管理</div></router-link>
            <br>
            <br>
                <div class="btn btn-sm btn-secondary" @click="logout">　ECサイトへ　</div>
        </div>
        
    </div>
</template>

<script>
export default {
    computed:{
        isLogin : function(){
            return this.$store.state.isLogin
        },
        admin : function(){
            return this.$store.state.admin
        },
    },
    methods:{
        logout(){
            //axios.post('/api/logout').then(res => {
                axios.defaults.headers.common['Authorization'] = '';
                this.$store.commit('authState',false);
                this.$router.push({path: '/'});
            //})
            this.$router.push({path: '/'});
        },
        logoutB(){
            //axios.post('/api/logout').then(res => {
                axios.defaults.headers.common['Authorization'] = '';
                this.$store.commit('authState',false);
                this.$router.push({path: '/admin'});
            //})
            this.$router.push({path: '/admin'});
        },
        search(id){
            if(this.$router.name === 'productList'){
                this.$store.commit('changeCategory',id);    
                this.$store.commit('changeKeyword','');
            }else{
                this.$store.commit('changeCategory',id);
                this.$router.push({path: '/product'});
                this.$store.commit('changeKeyword','');
            }            
        }
    }
}
</script>

<style scoped>
.title{
    font-size: 20px;

}
.subtitle{
    margin-top:3px;
    border-bottom: solid 1px gray;
}

.sub{
    font-size:15px;
    margin: 3px;
    color : royalblue;
}

.titleonly{
    font-size: 20px;
    border-bottom: solid 1px gray;
}

.sub:hover{
    color : royalblue;
    text-decoration: underline solid royalblue;
}
</style>