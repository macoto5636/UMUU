<template>
    <div class="container my-4">
        <div class="row">
            <div class="col-sm-8 col-md-6 mx-auto">
                <form class="needs-validation" @submit.prevent="login">
                    <div class="my-4">
                        <input v-model="email" type="email"  v-bind:class="{'form-control':true, 'is-invalid':isError}" id="email" placeholder="メールアドレス" required>
                        <div class="invalid-feedback">
                            {{ErrorMessage}}
                        </div>
                    </div>
                    <div class="my-4">
                        <input v-model="password" type="password" v-bind:class="{'form-control':true, 'is-invalid':isError}" id="password" placeholder="パスワード" required>
                    </div>
                    <button class="btn btn-primary btn-block mt-5" type="submit">ログイン</button>
                </form>
                <div class="mt-3">
                    <router-link to="/pass/forget" class="atag">パスワードをお忘れの方はこちら</router-link>
                </div>
                <div class="mt-3">
                    <hr>
                </div>
                <div class="my-3">
                    <p class="text-center">はじめての方はこちら</p>
                    <router-link to="/newuser" tag="button" class="btn btn-danger btn-block">新規会員登録</router-link>
                </div>
            </div>
            
        </div>
    </div>
</template>

<script>

export default {
    data(){
        return{
            isError:false,
            email:'',
            password:'',
            ErrorMessage:'メールアドレスまたはパスワードが不正です',
        }
    },
    methods: {
        login(){
            var self = this;
            axios.post('/api/login',{
                email: this.email,
                password: this.password
            }).then(res => {
                const token = res.data.access_token;
                axios.defaults.headers.common['Authorization'] = 'Bearer' + token;
                axios.get('api/me').then(res => {
                    this.$store.commit('user',res.data);

                    axios.get('api/cart/count/' + self.$store.state.user.id).then(res => {
                        this.$store.commit('count',res.data);
                    })
                })
                
                this.$store.commit('authState',true);
                this.$router.push({path:'/mypage'});
                //エラー
            }).catch((error) => {
                this.isError = true;
            })	
        },

    }
}
</script>

<style scoped>
.container{
    background-color: white;
}
.a{
    color : royalblue;
}
.a:hover{
    color : royalblue;
    text-decoration: underline solid royalblue;
}
</style>