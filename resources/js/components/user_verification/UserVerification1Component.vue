<template>
    <div class="container my-3">
        <div class="row">
            <div class="col-sm-10 col-md-8 mx-auto my-3">
                <form class="needs-validation">
                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input  v-bind:value="user.email" type="email" class="form-control" id="email" readonly>
                    </div>
            
                    <div class="form-group">
                        <label for="firstname">氏名</label>
                        <div class="row">
                            <div class="col">
                                <input  v-bind:value="user.first_name" type="text"  class="form-control" id="firstname" readonly>
                            </div>
                            
                            <div class="col">
                                <input  v-bind:value="user.last_name" type="text"  class="form-control" id="lastname" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kana_firstname">氏名カナ</label>
                        <div class="row">
                            <div class="col">
                                <input v-bind:value="user.kana_first_name" type="text"  class="form-control" id="kana_firstname" readonly>
                            </div>
                            <div class="col">
                                <input  v-bind:value="user.kana_last_name" type="text"  class="form-control" id="kana_lastname" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="postalcode"><b>〒</b>郵便番号</label>
                        <input  v-bind:value="user.postalcode" type="text"  class="form-control" id="postalcode" readonly>
                    </div>

                    <div class="form-group">
                        <label for="prefecture">都道府県</label>
                         <input  v-bind:value="user.prefecture" type="text"  class="form-control" id="postalcode" readonly>
                    </div>

                    <div class="form-group">
                        <label for="adress">住所</label>
                        <input  v-bind:value="user.adress" type="text"  class="form-control" name="adress" id="adress" readonly>
                    </div>

                    <div class="my-3">
                        <hr>
                    </div>
                    <button v-on:click="$router.push('/mypage')" class="btn btn-primary my-3">マイページへ</button>
                    <button v-on:click="$router.push('/user/change')" class="btn btn-danger my-3 mx-5">アカウント情報変更</button>
                        
                </form>
            </div>
        </div>
    </div>    
</template>

<script>
export default {
    data(){
        return{
            user:{}
        }
    },
    mounted(){
        this.user = this.$store.state.user;
    },
    methods:{
        test(){
            console.log(this.user.email);
        }
    }
}
</script>

<style scoped>
.container{
    background-color: white;
}
</style>