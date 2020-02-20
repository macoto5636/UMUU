<template>
<div class="product">
    <router-link :to="{ name: 'product', params: { id: product.id }}">
        <img v-bind:src="path+product.image" width="150px" height="150px" style="object-fit: contain;">
        {{product.product_name}}<br>
        <span class="price">￥{{product.price | number_format}}</span><br>

    </router-link>
</div>
</template> 

<script>
export default {
	props:['product','path','path2'],
	filters:{
		number_format:function(val){
        	return val.toLocaleString();
    	}
	},

}
</script>

<style>
.product{
	margin-right:5px;
	width: 150px;
	word-wrap: break-word;
	border-bottom: solid 2px #DDDDDD;
	margin-top:15px;
}
th{
    width: 100px;
}
</style>