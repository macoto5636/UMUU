<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-md-8 mx-auto my-3">
                <form class="needs-validation" action="" @submit.prevent="checkform">
                    <div class="form-growp">
                        <label for="inquiry">問い合わせ内容<span class="badge badge-secondary">必須</span></label>
                        <select v-model="inquiry.title" class="form-control" id="inquiry">
                            <option value="ログインができない">ログインができない</option>
                            <option value="会員情報を確認したい">会員情報を確認したい</option>
                            <option value="注文内容を確認したい">注文内容を確認したい</option>
                            <option value="支払い方法を変更したい">支払い方法を変更したい</option>
                            <option value="その他">その他</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">お名前<span class="badge badge-secondary">必須</span></label>
                        <input v-model="inquiry.name" type="text" class="form-control" id="name" required>
                    </div>

                    <div class="form-group">
                        <label for="tel">電話番号</label>
                        <input v-model="inquiry.tel" type="text" v-bind:class="{'form-control':true, 'is-invalid':telflg}" id="tel">
                        <div class="invalid-feedback">
                            {{errorMessage.tel}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">メールアドレス<span class="badge badge-secondary">必須</span></label>
                        <input v-model="inquiry.email" type="email" v-bind:class="{'form-control':true, 'is-invalid':emailflg}" id="email" required>
                        <div class="invalid-feedback">
                            {{errorMessage.email}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="reemail">メールアドレス確認<span class="badge badge-secondary">必須</span></label>
                        <input v-model="inquiry.reemail" type="email" v-bind:class="{'form-control':true, 'is-invalid':reemailflg}" id="reemail">
                        <div class="invalid-feedback">
                            {{errorMessage.reemail}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="detail">詳細<span class="badge badge-secondary">必須</span></label>
                        <textarea v-model="inquiry.content" type="text" class="form-control" id="detail" rows="5" required></textarea>
                    </div>

                    <hr class="my-2">

                    <div class="form-check">
                        <input v-model="inquiry.kiyaku" v-bind:class="{'form-check-input':true, 'is-invalid':kiyakuflg}" type="checkbox" id="kiyaku">
                        <label class="form-check-label" for="kiyaku">
                            <a href="" data-toggle="modal" data-target="#exampleModalLong">利用規約</a>に同意する
                        </label>
                        <div class="invalid-feedback">
                            {{errorMessage.kiyaku}}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block my-3">確認</button>
                </form>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">利用規約</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                個人情報保護ポリシー
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">確認</button>
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
        
    data(){
        return{
            errorMessage:{
                email:"正しいメールアドレスを入力してください",
                reemail:"同じメールアドレスを入力してください",
                tel:"正しい電話番号を入力してください",
                kiyaku:"規約に同意してください",
            },

            //エラー表示・非表示を切り替えるために使用
            emailflg:false,
            reemailflg:false,
            telflg:false,
            kiyakuflg:false,
        }
    },
    mounted(){
        if(this.$store.state.isLogin == true){
            var user = this.$store.state.user
            this.inquiry.name = user.first_name + user.last_name;
            this.inquiry.tel = user.tel;
            this.inquiry.email = user.email;
            this.inquiry.reemail = user.email;
        }
    },

    methods:{

        checkform(){
            var checkflg = true;
            console.log("checkformに飛んだ");
            //メールアドレスチェック
            var regexp = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/;
            if(!regexp.test(this.inquiry.email)){
                checkflg = false;
                this.emailflg = true;
            }else{
                this.emailflg = false;
            }
            if(this.inquiry.email != this.inquiry.reemail){
                checkflg = false;
                this.reemailflg = true
            }else{
                this.reemailflg = false;
            }

            //電話番号チェック
            regexp = /^[0-9]+$/;
            if(!regexp.test(this.inquiry.tel)){
                checkflg = false;
                this.telflg = true;
            }else{
                this.telflg = false;
            }

            //規約
            this.kiyakuflg = !this.inquiry.kiyaku;

            if(checkflg == false){
                //ページを遷移させない
                console.log("フラグがfalse");
                return;
            }else{
                this.$router.push('/inquiry/confirm');
            }
        },
    }
}
</script>