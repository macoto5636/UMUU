<template>
<form action="" method="get">
<aside class="purchase">
    <ul class="my-3">
        <li>小計<span>￥{{cartSum | number_format}}</span></li>
        <li><router-link to="/order"><input type="button" value="購入手続き" class="btn btn-primary btn-width mb-2"></router-link></li>
        <li><router-link to="/product"><input type="button" value="買い物を続ける" class="btn btn-secondary btn-width mb-2"></router-link></li>
    </ul>
    <input type="hidden" v-bind:value="cartSum" name="cartSum">
    <input type="hidden" v-bind:value="items" name="items">
   
</aside>
</form>
</template>

<script>
export default {
	props:['items'],
    filters:{
	number_format:function(val){
        	return val.toLocaleString();
    	}
	},
    computed:{
    //合計金額を返す
    cartSum:function(){
        var sum = 0;
        for(var i = 0; i<this.items.length; i++){
            sum += (this.items[i].price * this.items[i].number);
        }
        return sum;
        }
    }
}
</script>

<style soped>
.purchase{
    border:solid 2px #DDDDDD;
}
.purchase ul{
    list-style-type:none;
    font-size:20px;
				
}
li span{
    color:red;
}
.purchase li:first-child{
    font-size:25px;
}

.btn-width{
    width: 85%;
}
</style>