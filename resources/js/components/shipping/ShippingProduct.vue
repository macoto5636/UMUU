<template>
    <div class="container">
        <div class="row">
            <div class="col col-md-3">
            <img v-bind:src="path + product.image" width="100px" height="100px">
            </div>
            <div class="col col-md-9">
                {{product.product_name}}<br>
                <div class="price">￥{{product.price | number_format}}</div>
                <div align="right">{{order_detail.number}}個</div>

            </div>
        </div>
        <hr>
    </div>
</template>

<script>
export default {
    props:['order_detail'],
    data(){
        return{
            product:{},
            path: "/product_image/",
            path2: "details?id="
        }
    },
    filters:{
		number_format:function(val){
        	return val.toLocaleString();
    	}
	},
    mounted(){
        var self = this;
        axios.get('/api/order/order_product/' + self.order_detail['product_id']).then(function(response){
            self.product = response.data;
        });
    }
}
</script>

<style scoped>
.price{
    text-align: left;
    float: left;
}

</style>