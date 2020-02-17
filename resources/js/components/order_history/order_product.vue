<template>
    <div class="container">
        <div class="row">
            <div class="col col-md-3">
            <img v-bind:src="path + product.image" width="100px" height="100px">
            </div>
            <div class="col col-md-9">
                {{product.product_name}}<br>
                <div class="price">￥{{product.price }}</div>
                <div align="right">{{order_detail.number}}個</div>
                <div align="right">
                    <router-link :to="{ name: 'product', params: { id: product.id }}" class="btn btn-secondary mt-2">
                        再度購入
                    </router-link>
                    <router-link :to="{ name: 'Review', params: { id: product.id }}"  v-if="order.state_id==3" class="btn btn-primary mt-2 ml-2">
                        レビューを書く
                    </router-link>
                </div>

            </div>
        </div>
        <hr>
    </div>
</template>

<script>
export default {
    props:['order_detail','order'],
    data(){
        return{
            product:{},
            path: "/product_image/",
            path2: "details?id="
        }
    },
    filters:{
		number_format:function(val){
            if(val === null){
                return null;
            }else{
                return val.toLocaleString();
            }
    	}
	},
    created(){
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