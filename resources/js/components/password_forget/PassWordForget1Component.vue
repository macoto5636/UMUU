<template>
    <div class="container my-3">
        <div class="row">
            <div class="col-sm-10 col-md-8 mx-auto my-3">
                <form class="needs-validation" @submit.prevent="checkForm">
                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input  v-model="email" type="email" v-bind:class="{'form-control':true, 'is-invalid':emailflg}" id="email" placeholder="umuu@example.com" required >
                        <div class="invalid-feedback">
                            {{errorMessage.email}}
                        </div>
                    </div>
                    
                    <div class="my-3">
                        <hr>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block my-3">確認</button>
                        
                </form>
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
    methods:{
        //入力されたデータをチェック
        checkForm:function(e){

            var checkflg = true;
            console.log("checkformに飛んだ");
            //メールアドレスチェック
            var regexp = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/;
            if(!regexp.test(this.email)){
                checkflg = false;
                this.emailflg = true;
            }else{
                this.emailflg = false;
            }

            if(checkflg == false){
                //ページを遷移させない
                console.log("フラグがfalse");
                 e.preventDefault();
            }else{
                this.checkMail();
            }
        },

        //メールアドレスが存在するか
        checkMail(){
            axios.post('/api/pass/forget',{
            email: this.email
            }).then((res)=>{
                console.log(res.data);
                //存在したらメールを送信する
                if(Boolean(res.data)){
                    console.log("メール送信");
                    this.sendMail();
                    return;
                }
                console.log("メール送信できまえん");
                
                this.errorMessage.email = '入力されたメールアドレスが存在しません';
                this.emailflg = true;
            }).catch((error) =>{
            })
        },
        //メールを送信
        sendMail(){
            console.log("今から送信すっぞ");
            axios.post('/api/mail',{
            email: this.email
            }).then((res)=>{
                console.log("メール遅れてる？？？");
                this.$router.push('/pass/forget/receve');
            }).catch(function(error){
                console.log(error.response.data);
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
            }); 
        }


    }
    
}
</script>