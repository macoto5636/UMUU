<template>
    <div class="container my-3">
        <h4 class="my-3"><i class="far fa-check-circle"></i>ユーザ登録が完了しました！</h4>

        <div class="jumbotron my-3">
            <h1 class="display-4">ようこそ UMUUへ！</h1>
            <p class="lead">様々な種類の健康食品を取り揃えております。きっとあなたのお探しの商品も見つかります。</p>
            <hr class="my-4">
            <p>さらに情報を追加する場合</p>
            <router-link to="/mypage" class="btn btn-primary" role="button">マイページ</router-link>
            <hr class="my-4">
            <p>商品を探す場合</p>
            <router-link to="/product" class="btn btn-primary" role="button">商品一覧</router-link>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        user: Object
    },
    mounted(){

        axios.post('/api/login',{
                email: this.user.email,
                password: this.user.password
            }).then(res => {
                const token = res.data.access_token;
                axios.defaults.headers.common['Authorization'] = 'Bearer' + token;
                axios.get('api/me').then(res => {
                    this.$store.commit('user',res.data);
                })
                this.$store.commit('authState',true);
                //エラー
            }).catch((error) => {
                console.log(error.response.data);
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
            })	
    },
}
</script>