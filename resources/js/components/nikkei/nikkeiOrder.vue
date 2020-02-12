<template>
    <div class="container">
        <div class="row m-3">
            <div class="col">
                注文番号：{{order.id}}
                <table class="table">
                <tr v-for="item in orderdetails" v-bind:key="item.id">
                    <td width=400px>{{item.product_name}}</td> 
                    <td width=100px>{{item.category_name}}</td>
                    <td width=50px>￥{{item.product_price | number_format}}</td> 
                    <td width=50px>{{ item.number}}個</td> 
                    <td width=100px>￥{{ item.price | number_format }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>小計</td>
                    <td>￥{{price | number_format}}</td>
                </tr>
                </table>
                <div align=right>送料：￥{{order.postage}}　　合計：￥{{price + order.postage | number_format}}</div>
                <div class="line my-2">　</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['order'],
    data(){
        return{
            orderdetails:{},
            price:0,
        }
    },
    filters:{
        number_format:function(val){
            return val.toLocaleString();
        }
	},
    mounted(){
        var self = this;
        axios.get('/api/order/user_detail/' + self.order.id).then(function(response){
            self.orderdetails = response.data;
            for(var item in self.orderdetails){
                self.price += self.orderdetails[item]['price'];
            }
            self.sendItem(self.price + self.order.postage);      
        });
    },
    methods:{
        sendItem(price){
            this.$emit('sendItem',price);
            console.log("追加"+price);
        }
    }
}
</script>

<style scoped>
.line{
    border-bottom: 2px solid gray;
}
</style>