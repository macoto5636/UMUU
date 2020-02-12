<template>
    <div class="container">
        <div class="row">
            <div class="col-4 col-md-3 mx-auto">
                <img class="img-fruit my-3 mx-auto" v-bind:src="path+cart.image" width="100px" height="100px">
            </div>
            <div class="col-8 col-md-9 ">
                <div>
                    {{cart.product_name}}<br>
                    <div class="light"> ￥{{cart.price | number_format}}</div>
                    <div align=right>
                        数量:{{cart.number}}個
                    </div>
                    <hr>
                    <!-- <div align=right class="shoukei">￥{{cart.price * cart.number | number_format}}</div> -->
                </div>
            </div><!--product-details-->
        </div>
    </div>
</template>

<script>
export default {
    props:['cart','index','path'],
    filters:{
        number_format:function(val){
            return val.toLocaleString();
        }
    }
}
</script>

<style scoped>
.light{
    text-align: left;
    float: left;
}
</style>