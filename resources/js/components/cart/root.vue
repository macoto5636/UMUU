<template>
<div class="container">
    <title-component>
        <span slot="title">Shopping Cart</span>
        <span slot="subtitle">ショッピングカート</span>
    </title-component>
    <div class="row">
        <div v-if="items==''" class="col-11 mx-auto none">現在、カートの中に商品はありません</div>
        <div v-else class="col-md-8 mt-3">   

            <cart-product
                v-for="(item,index) in items" v-bind:key="item.product_id"
                v-bind:item="item"
                v-bind:index="index"
                v-bind:path="path"
                v-on:sendItem="onDeleteItem">
            </cart-product>
        </div>

        <div v-if="items != ''" class="col-md-4 my-3">
            <total-payment
            v-bind:items="items">
            </total-payment>
        </div>
    </div>
</div>
</template>

<script>
export default {
	data: function(){
		return{
            //カートない商品
            items:{},
            //画像のパス
            path: "/product_image/",
		}
    },
    mounted: function(){
	   //itemsにカートのデータを格納
        var self = this;
        axios.get('/api/cart/user_get/'+ self.$store.state.user.id).then(function(response){
            self.items = response.data;
            console.log(self.items);
        }).catch(function(error){
            console.log(error.response.data);
            console.log(error.response.status);      // 例：400
            console.log(error.response.statusText);  // Bad Request
            console.log(error.response.headers);
        }); 
    }, 
    methods:{
    //買い物カートから削除
        onDeleteItem:function(id,index){ 
            axios.delete('api/cart/delete/' + id)
            .then((response) => {
                console.log(response);
                this.items.splice(index,1);
                this.$store.commit('count',-1);  
            }).catch((error) => {
                console.log(error);
            })	
        }

	}

}
</script>

<style scoped>
.none{
    height: 400px;
    text-align: center;
    background-color: lightgray;
    margin-bottom:20px;
    padding-top: 150px;
}
</style>