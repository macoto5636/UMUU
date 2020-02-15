<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-md-8 mx-auto my-3">
                <h4><i class="far fa-check-circle"></i>　内容を確認して下さい</h4>
                <div class="my-3">
                    <p>お問い合わせ内容</p>
                    <div class="ml-4">{{ inquiry.title }}</div>

                    <hr>

                    <p class="mt-3">お名前</p>
                    <div class="ml-4">{{ inquiry.name }}</div>

                    <hr>

                    <p class="mt-3">電話番号</p>
                    <div class="ml-4">{{ inquiry.tel }}</div>

                    <hr>

                    <p class="mt-3">メールアドレス</p>
                    <div class="ml-4">{{ inquiry.email }}</div>

                    <hr>

                    <p class="mt-3">詳細</p>
                    <div class="ml-4">{{ inquiry.content }}</div>

                    <hr>
                </div>

                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-primary btn-block my-3" v-on:click="$router.back()">戻る</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-danger btn-block my-3" v-on:click="register">送信</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        inquiry: Object
    },
    methods:{

        //送信
        register(){
            console.log("メール送信できる？");
            axios.post('/api/inquiry/send',this.inquiry).then(function(response){
                console.log("遅れたか？");
                console.log(response.data);
                
            }).catch(function(error){
                // The request was made and the server responded with a status code
                // that falls out of the range of 2xx
                console.log(error.response.data);
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
            });
             this.$router.push('/inquiry/end');
           
        }
    }
}
</script>