<template>
    <div class="container my-3">
        <div class="row">
            <div class="col-sm-10 col-md-8 mx-auto my-3">
                <form class="needs-validation" @submit.prevent="checkForm">
                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input v-model="email" type="email" v-bind:class="{'form-control':true, 'is-invalid':emailflg}" id="email" placeholder="umuu@example.com" required >
                        <div class="invalid-feedback">
                            {{errorMessage.email}}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">パスワード(英数字6文字以上)</label>
                        <input v-model="password" type="password"  v-bind:class="{'form-control':true, 'is-invalid':passwordflg}" id="password" required>
                        <div class="invalid-feedback">
                            {{ errorMessage.password}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">パスワード再入力(英数字6文字以上)</label>
                        <input v-model="repassword" type="password"  v-bind:class="{'form-control':true, 'is-invalid':repasswordflg}" id="repassword">
                        <div class="invalid-feedback">
                            {{ errorMessage.repassword}}
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
                password:"パスワードは6文字以上かつ半角英数字のみです",
                repassword:'同じパスワードを入力してください',
            },

            email:'',
            password:'',
            repassword:'',
            //エラー表示・非表示を切り替えるために使用
            emailflg:false,
            passwordflg:false,
            repasswordflg:false,
        }
    },
    methods:{
        checkForm(e){
            var checkflg = true;
            console.log("checkformに飛んだ");
            //メールアドレスチェック
            var regexp = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/;
            if(!regexp.test(this.user.email)){
                checkflg = false;
                this.emailflg = true;
            }else{
                this.emailflg = false;
            }
            //パスワードチェック
            regexp = /^([a-zA-Z0-9]{6,})$/;
            if(!regexp.test(this.user.password)){
                checkflg = false;
                this.passwordflg = true;
            }else{
                this.passwordflg = false;
            }
            //再入力
            if(this.user.password != this.user.repassword){
                checkflg = false;
                this.repasswordflg = true;
            }else{
                this.repasswordflg = false;
            }

            if(checkflg == false){
                //ページを遷移させない
                console.log("フラグがfalse");
                 e.preventDefault();
            }else{
                this.passUpdate();
            }

        },
        //パスワード更新
        passUpdate(){
            console.log("とりあえず侵入");
            axios.post('/api/pass/resetting',{
            email: this.email,
            password: this.password
            }).then((res)=>{
                console.log("パスワード再設定できた？");
                console.log(res.data);
                this.$router.push('/pass/resetting/end');
            })
        }

    }

    
}
</script>