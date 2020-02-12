<template>
    <div class="container">
        <title-component>
                <span slot="title">MyPage</span>
                <span slot="subtitle">マイページ</span>
        </title-component>
        <div class="mt-2">
            <h4><i class="fas fa-user-check"></i> ようこそ！{{ user.first_name + user.last_name }} さん</h4>
            <hr>
        </div>
        <div class="row">
            <div class="mt-2 mx-auto">
                <router-link to="/mypage/order_history">
                    <button class="btn btn-primary">
                        <font size="5"><i class="fas fa-box"></i> 注文履歴</font><br>
                        配送状況の確認
                    </button>
                </router-link>
            </div>
            <div class="mt-2 mx-auto">
                <router-link to="/mypage/want">
                    <button class="btn btn-success">
                        <font size="5"><i class="fas fa-heart"></i> 欲しいもの</font><br>
                        欲しいものリストの管理
                    </button>
                </router-link>
            </div>
            <div class="mt-2 mx-auto">
                <router-link to="/user/Verification">
                    <button class="btn btn-danger">
                        <font size="5"><i class="fas fa-key"></i> アカウント</font><br>
                        個人情報の確認・変更
                    </button>
                </router-link>
            </div>
            <div class=" mx-auto mt-2">
                <button class="btn btn-info">
                    <font size="5"><i class="fas fa-credit-card"></i> 定期購入</font><br>
                    定期購入の確認・停止
                </button>
            </div>
        </div>

        <div class="mt-4">
        <h4><i class="fas fa-volume-up"></i> UMUUからのお知らせ</h4>
        <hr>
        </div>
        <newslist-component />
        
    </div>
</template>

<script>
export default {
    computed:{
        user : function(){
            return this.$store.state.user
        }
    }
    
}
</script>

<style scoped>
    .btn{
        width: 230px;
        height: 100px;
        color: white;
    }

</style>