<template>
    <div class="container">
        <title-component>
                <span slot="title">Order History</span>
                <span slot="subtitle">注文履歴</span>
        </title-component>
        <div class="row">
            <div class="col">
                <div v-if="orders==''" class="none">該当する注文はありません</div>
                <order-history-list v-else v-bind:orders="orders"></order-history-list>
            </div>
        </div>
        

    </div>
</template>

<script>
export default {
    data:function(){
        return{
            orders:{},
        }
    },
    computed:{
        user : function(){
            return this.$store.state.user
        }
    },
    mounted: function(){
        var self = this;
        //注文表から注文をとりだす
        axios.get('/api/order/user/' + self.user.id).then(function(response){
        	self.orders = response.data;
			console.log(self.orders);
        }).catch(function(error){
                console.log(error.response.data);
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
            }); 

    }
}
</script>

<style scoped>
.none{
    height: 400px;
    text-align: center;
    background-color: lightgray;
    margin:20px;
    padding-top: 150px;
}
</style>