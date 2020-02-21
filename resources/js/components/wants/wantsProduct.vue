<template>
<div class="product d-flex">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img class="img-fruit" v-bind:src="path+item.image" width="100px" height="100px" style="object-fit: contain;">
            </div>
            <div class="product-details text-break col-10">
            <ul class="ml-2">
                <li>{{item.product_name}}</li>
                <li>￥{{item.price | number_format}}</li>
                <li><router-link :to="{ name: 'product', params: { id: item.product_id }}" class="btn btn-primary">詳細</router-link><div class="btn btn-danger ml-3" @click="sendItem(item.id,index)">削除</div></li>
            </ul>
            </div>
        </div><!--product-details-->
    </div>
</div>
</template>

<script>
export default {
	props:['item','path','index'],

    data:function(){
        return{
            //商品詳細のパス
            path2: "product/details?id="
        }
    },

    filters:{
	number_format:function(val){
        	return val.toLocaleString();
    	}
    },
    methods:{
        sendItem(id,index){
            this.$emit('sendItem',id,index);
        }
    }
    
    
}
</script>

<style scoped>
.product-details ul{
    list-style-type:none;
}
.product-details li{
    font-size:20px;
}
.product{
    width: 600px;				
}
.btn-width{
    width: 100px;
}
</style>