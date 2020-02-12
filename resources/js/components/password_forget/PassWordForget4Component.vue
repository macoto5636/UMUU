<template>
    <div class="container my-3">
        <div class="row">
            <div class="col-sm-12 col-md-12 mx-auto my-3 text-center">
                <h3>パスワード再設定申込受付完了</h3>
            </div>
            <div class="col-sm-12 col-md-12 mx-auto my-3 text-center">
                <h5>パスワードの再設定が完了しました。</h5>
            </div>
            <div class="col-sm-12 col-md-8 mx-auto my-3 text-center">
                <router-link to="/login">ログインはこちらから</router-link>
            </div>
        </div>
    </div>    
</template>

<style scoped>
.container{
    background-color: white;
}
</style>

<script>
export default {
    data(){
        return{
            errorMessage:{
                email:"正しいメールアドレスを入力してください",
            },
            email:'',

            //エラー表示・非表示を切り替えるために使用
            emailflg:false,
        }
    },
    
}
</script>