<template>
    <div class="container my-3">
        <div class="row">
            <div class="col-sm-10 col-md-8 mx-auto my-3">
                <h4><i class="far fa-check-circle"></i>　内容を確認して下さい</h4>
                <div class="my-3">
                    <p>メールアドレス</p>
                    <div class="ml-4">{{ user.email }}</div>

                    <hr>

                    <p class="mt-3">パスワード</p>
                    <div class="ml-4">セキュリティ上、表示されません</div>
                    
                    <hr>

                    <p class="mt-3">氏名</p>
                    <div class="ml-4">{{ user.firstname + "　" + user.lastname}}</div>

                    <hr>

                    <p class="mt-3">氏名カナ</p>
                    <div class="ml-4">{{ user.kana_firstname + "　" + user.kana_lastname}}</div>

                    <hr>

                    <p class="mt-3">郵便番号</p>
                    <div class="ml-4">{{ user.postalcode }}</div>

                    <hr>

                    <p class="mt-3">住所</p>
                    <div class="ml-4">{{ user.prefecture + user.adress + user.adress2 }}</div>

                    <hr>
                </div>
                
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-primary btn-block my-3" v-on:click="$router.back()">戻る</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-danger btn-block my-3" v-on:click="register">登録</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        user: Object
    },
    methods:{
        //登録ボタン押下時
        register:function(){
            //ハッシュ化するための宣言
            //const sha_obj = new jsSHA("SHA-256","TEXT");
            //パスワードをハッシュ化
            //sha_obj.update(user.password);

            var newUser = {
                'email' : this.user.email,
                'password' : this.user.password,
                'firstname' : this.user.firstname,
                'lastname' : this.user.lastname,
                'kana_firstname' : this.user.kana_firstname,
                'kana_lastname' : this.user.kana_lastname,
                'postalcode' : this.user.postalcode,
                'prefecture' : this.user.prefecture,
                'adress' : this.user.adress + this.user.adress2,
                'role_id' : 2
            };

            //axios.postの第一引数にルートを、
            //第二引数にポストする配列を渡す
            axios.post('/api/user/create',newUser).then(res => {
                console.log("OK");
                this.$router.push('/complete');
            }).catch(function(error){
                if (error.response) {
                    // The request was made and the server responded with a status code
                    // that falls out of the range of 2xx
                    console.log(error.response.data);
                    console.log(error.response.status);      // 例：400
                    console.log(error.response.statusText);  // Bad Request
                    console.log(error.response.headers);
                } else if (error.request) {
                    // The request was made but no response was received
                    // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                    // http.ClientRequest in node.js
                    console.log(error.request);
                } else {
                    // Something happened in setting up the request that triggered an Error
                    console.log('Error', error.message);
                }
            });
        },
    }
}
</script>

<style scoped>
.container{
    background-color: white;
}
</style>
