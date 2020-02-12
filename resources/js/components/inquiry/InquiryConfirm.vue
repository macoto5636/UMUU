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

    }
}
</script>