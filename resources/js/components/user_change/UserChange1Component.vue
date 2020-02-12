<template>
    <div class="container my-3">
        <div class="row">
            <div class="col-sm-10 col-md-8 mx-auto my-3">
                <form class="needs-validation" @submit.prevent="checkForm">
                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input  v-model="user.email" type="email" v-bind:class="{'form-control':true, 'is-invalid':emailflg}" id="email" >
                        <div class="invalid-feedback">
                            {{errorMessage.email}}
                        </div>
                    </div>
            
                    <div class="form-group">
                        <label for="firstname">氏名</label>
                        <div class="row">
                            <div class="col">
                                <input  v-model="user.first_name" type="text"  v-bind:class="{'form-control':true, 'is-invalid':firstnameflg}" id="firstname" >
                                <div class="invalid-feedback">
                                    {{ errorMessage.firstname}}
                                </div>
                            </div>
                            
                            <div class="col">
                                <input  v-model="user.last_name" type="text"  v-bind:class="{'form-control':true, 'is-invalid':lastnameflg}" id="lastname" >
                                <div class="invalid-feedback">
                                    {{ errorMessage.lastname}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kana_firstname">氏名カナ</label>
                        <div class="row">
                            <div class="col">
                                <input v-model="user.kana_first_name" type="text"  v-bind:class="{'form-control':true, 'is-invalid':kana_firstnameflg}" id="kana_firstname" >
                                <div class="invalid-feedback">
                                    {{ errorMessage.kana_firstname}}
                                </div>
                            </div>
                            <div class="col">
                                <input  v-model="user.kana_last_name" type="text"  v-bind:class="{'form-control':true, 'is-invalid':kana_lastnameflg}" id="kana_lastname" >
                                <div class="invalid-feedback">
                                    {{ errorMessage.kana_lastname}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="postalcode"><b>〒</b>郵便番号</label>
                                <input  v-model="user.postalcode" type="text"  v-bind:class="{'form-control':true, 'is-invalid':postalcodeflg}" id="postalcode" >
                            <div class="invalid-feedback">
                                {{ errorMessage.postalcode}}
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="prefecture">都道府県</label>
                        <div class="row">
                            <div class="col-sm-10 col-md-6">
                                <select v-model="user.prefecture"  v-bind:class="{'form-control':true, 'is-invalid':prefectureflg}" id="prefecture" name="prefecture">
                                        <option selected></option>
                                        <option value="北海道">北海道</option>
                                        <option value="青森県">青森県</option>
                                        <option value="岩手県">岩手県</option>
                                        <option value="宮城県">宮城県</option>
                                        <option value="秋田県">秋田県</option>
                                        <option value="山形県">山形県</option>
                                        <option value="福島県">福島県</option>
                                        <option value="茨城県">茨城県</option>
                                        <option value="栃木県">栃木県</option>
                                        <option value="群馬県">群馬県</option>
                                        <option value="埼玉県">埼玉県</option>
                                        <option value="千葉県">千葉県</option>
                                        <option value="東京都">東京都</option>
                                        <option value="神奈川県">神奈川県</option>
                                        <option value="新潟県">新潟県</option>
                                        <option value="富山県">富山県</option>
                                        <option value="石川県">石川県</option>
                                        <option value="福井県">福井県</option>
                                        <option value="山梨県">山梨県</option>
                                        <option value="長野県">長野県</option>
                                        <option value="岐阜県">岐阜県</option>
                                        <option value="静岡県">静岡県</option>
                                        <option value="愛知県">愛知県</option>
                                        <option value="三重県">三重県</option>
                                        <option value="滋賀県">滋賀県</option>
                                        <option value="京都府">京都府</option>
                                        <option value="大阪府">大阪府</option>
                                        <option value="兵庫県">兵庫県</option>
                                        <option value="奈良県">奈良県</option>
                                        <option value="和歌山県">和歌山県</option>
                                        <option value="鳥取県">鳥取県</option>
                                        <option value="島根県">島根県</option>
                                        <option value="岡山県">岡山県</option>
                                        <option value="広島県">広島県</option>
                                        <option value="山口県">山口県</option>
                                        <option value="徳島県">徳島県</option>
                                        <option value="香川県">香川県</option>
                                        <option value="愛媛県">愛媛県</option>
                                        <option value="高知県">高知県</option>
                                        <option value="福岡県">福岡県</option>
                                        <option value="佐賀県">佐賀県</option>
                                        <option value="長崎県">長崎県</option>
                                        <option value="熊本県">熊本県</option>
                                        <option value="大分県">大分県</option>
                                        <option value="宮崎県">宮崎県</option>
                                        <option value="鹿児島県">鹿児島県</option>
                                        <option value="沖縄県">沖縄県</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ errorMessage.prefecture}}
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="adress">住所</label>
                        <input  v-model="user.adress" type="text"  v-bind:class="{'form-control':true, 'is-invalid':adressflg}" name="adress" id="adress">
                        <div class="invalid-feedback">
                            {{ errorMessage.adress}}
                        </div>
                    </div>

                    <div class="my-3">
                        <hr>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block my-3">アカウント情報変更</button>
                        
                </form>
            </div>
        </div>
    </div>    
</template>

<script>
export default {
    data(){
        return{
            user:{},
            errorMessage:{
                email:"正しいメールアドレスを入力してください",
                firstname:"入力してください",
                lastname:"入力してください",
                kana_firstname:"カタカナで入力してください",
                kana_lastname:"カタカナ入力してください",
                postalcode:"郵便番号が不正です",
                prefecture:"選択してください",
                adress:"住所が不正です",
            },

            //エラー表示・非表示を切り替えるために使用
            emailflg:false,
            firstnameflg:false,
            lastnameflg:false,
            kana_firstnameflg:false,
            kana_lastnameflg:false,
            postalcodeflg:false,
            prefectureflg:false,
            adressflg:false,
        }
    },
    mounted(){
        this.user = this.$store.state.user;
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
            //氏名
            if(this.user.firstname == ''){
                checkflg = false;
                this.firstnameflg = true;
                console.log("氏名入力性や");
            }else{
                this.firstnameflg= false;
            }

            if(this.user.lastname == ''){
                checkflg = false;
                this.lastnameflg = true;
            }else{
                this.lastnameflg = false;
            }

            //カタカナチェック
            regexp = /^[ァ-ヶー　]*$/;
            if(!regexp.test(this.user.kana_first_name) || this.user.kana_first_name == ''){
                checkflg = false;
                this.kana_firstnameflg = true;
            }else{
                this.kana_firstnameflg = false;
            }

            if(!regexp.test(this.user.kana_last_name || this.user.kana_last_name == '')){
                checkflg = false;
                this.kana_lastnameflg = true;
            }else{
                this.kana_lastnameflg = false;
            }

            //郵便番号チェック
            regexp = /^[0-9]+$/;
            if(!regexp.test(this.user.postalcode)){
                checkflg = false;
                this.postalcodeflg = true;
            }else{
                this.postalcodeflg = false;
            }

            //都道府県
            if(this.user.prefecture == ''){
                checkflg = false;
                this.prefectureflg = true;
            }else{
                this.prefectureflg = false;
            }
            
            if(checkflg == false){
                //ページを遷移させない
                console.log("フラグがfalse");
                 e.preventDefault();
            }else{
                console.log("フラグがtrue");
                this.userChange();
            }

        },
        userChange(){
            
            console.log("変更できるかな？");
            axios.post('/api/user/change',this.user).then(function(response){
                console.log("変更された？");
                console.log(response.data);
                
            }).catch(function(error){
                // The request was made and the server responded with a status code
                // that falls out of the range of 2xx
                console.log(error.response.data);
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
            });
            this.$router.push('/user/Verification');
        }
    },
}
</script>

<style scoped>
.container{
    background-color: white;
}
</style>