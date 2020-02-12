<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-md-8 mx-auto my-3">
                <form action="" @submit="$router.push('/inquiry/confirm')">
                    <div class="form-growp">
                        <label for="inquiry">問い合わせ内容<span class="badge badge-secondary">必須</span></label>
                        <select v-model="inquiry.title" class="form-control" id="inquiry">
                            <option value="該当する" selected>該当する問い合わせ項目を選択してください</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">お名前<span class="badge badge-secondary">必須</span></label>
                        <input v-model="inquiry.name" type="text" class="form-control" id="name" required>
                    </div>

                    <div class="form-group">
                        <label for="tel">電話番号</label>
                        <input v-model="inquiry.tel" type="text" class="form-control" id="tel">
                    </div>

                    <div class="form-group">
                        <label for="email">メールアドレス<span class="badge badge-secondary">必須</span></label>
                        <input v-model="inquiry.email" type="email" class="form-control" id="email" required>
                    </div>

                    <div class="form-group">
                        <label for="reemail">メールアドレス確認<span class="badge badge-secondary">必須</span></label>
                        <input v-model="inquiry.reemail" type="email" class="form-control" id="reemail">
                    </div>

                    <div class="form-group">
                        <label for="detail">詳細<span class="badge badge-secondary">必須</span></label>
                        <textarea v-model="inquiry.content" type="text" class="form-control" id="detail" rows="5" required></textarea>
                    </div>

                    <hr class="my-2">

                    <div class="form-check">
                        <input v-model="inquiry.kiyaku" class="form-check-input" type="checkbox" id="kiyaku">
                        <label class="form-check-label" for="kiyaku">
                            <a href="" data-toggle="modal" data-target="#exampleModalLong">利用規約</a>に同意する
                        </label>
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
    mounted(){
        if(this.$store.state.isLogin == true){
            var user = this.$store.state.user
            this.inquiry.name = user.first_name + user.last_name;
            this.inquiry.tel = user.tel;
            this.inquiry.email = user.email;
            this.inquiry.reemail = user.email;
        }
    },
}
</script>