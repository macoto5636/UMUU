<template>
    <div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto my-3">
				<ul class="list-group list-group-horizontal">
					<li class="item list-group-item">
						<div class="number">1</div>
						<div class="name">商品決定</div>
					</li>
					<li class="item list-group-item">
						<div class="number">2</div>
						<div class="name">お客様情報</div>
					</li>
					<li class="item-active list-group-item">
						<div class="number">3</div>
						<div class="name">確認</div>
					</li>
					<li class="item list-group-item">
						<div class="number">4</div>
						<div class="name">完了</div>
					</li>
				</ul>
			</div>
		</div>
        <div class="col-10 my-3 mx-auto">
			<p>内容を確認してください</p>
            <!-- お客様情報 -->
            <h3>
				<div class="title mt-4">お客様情報</div>
			</h3>

            <table class="table">
                <tr>
                    <th>お届け先</th>
                    <td>
                        {{ user.first_name + user.last_name }} <br>
                        〒{{ user.postalcode }}　{{ user.prefecture + user.adress }}
                    </td>
                </tr>
                <tr>
                    <th>配送方法</th>
                    <td>
                        {{ haisou.shipping_name }}
                    </td>
                </tr>
                <tr>
                    <th>お支払い方法</th>
                    <td v-if="info.payment == 1">
                        クレジットカード支払い
                    </td>
                    <td v-else-if="info.payment ==2">
                        コンビニ支払い
                    </td>
                </tr>
            </table>

			<h3>
				<div class="title my-4">注文内容</div>
			</h3>

            <!-- カート内商品の表示 -->
            <div class="row my-2" id="product" v-for="cart in carts" v-bind:key="cart.product_id">
                <div class="col-4 col-md-3 mx-auto">
                    <img class="img-fruit my-3 mx-auto" v-bind:src="path+cart.image" width="100px" height="100px">
                </div>
                <div class="col-8 col-md-9 ">
                    <div>
                        {{cart.product_name}}<br>
                        <div class="light"> ￥{{cart.price | number_format}}</div>
                        <div align=right>
                            {{cart.number}}個
                        </div>
                        <hr>
                        <div align=right class="shoukei">
                            ￥{{cart.price * cart.number | number_format}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="souryou my-3" align=right>送料：￥{{haisou.postage}}</div>
            <hr>
            <div align=right>合計：<font size="5" color="#ff0000">￥{{orderSum | number_format}}</font></div>

            <div class="light my-3 btn btn-secondary" v-on:click="$router.back()">戻る</div>
			<div class="next" align=right><div class="btn btn-primary" @click="goNext">　注文確定　</div></div>	
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            carts:{},
            //画像のパス
            path: "/product_image/",
            haisou:{},
            order_id:1,
        }
    },
    props:{
        info: Object,
    },
    filters:{
	number_format:function(val){
        	return val.toLocaleString();
    	}
    },
    computed:{
        user : function(){
            return this.$store.state.user
        },
        orderSum(){
            var sum = 0;
            for(var i = 0; i<this.carts.length; i++){
                sum += (this.carts[i].price * this.carts[i].number);
             }
            sum += this.haisou.postage;
            return sum;
        }
	},
    mounted(){
        this.$nextTick(function () {
        //cartsにカートのデータを格納
        var self = this;
        axios.get('/api/cart/user_get/'+ self.$store.state.user.id).then(function(response){
            self.carts = response.data;
            console.log(self.carts);
            if(self.carts == ''){
                self.$router.push('/');
            }
        }).catch(function(error){
            console.log(error.response.data);
            console.log(error.response.status);      // 例：400
            console.log(error.response.statusText);  // Bad Request
            console.log(error.response.headers);
        }); 

        axios.get('/api/order/shipping_get/'+ self.info.shipping).then(function(response){
            self.haisou = response.data;
            console.log(self.haisou);
        }).catch(function(error){
            console.log(error.response.data);
            console.log(error.response.status);      // 例：400
            console.log(error.response.statusText);  // Bad Request
            console.log(error.response.headers);
        });

        axios.get('/api/order/index2').then(function(response){
            var orders = response.data;
            console.log(orders);
            self.order_id = orders.id + 1;
            console.log(self.order_id);
        }).catch(function(error){
            console.log(error.response.data);
            console.log(error.response.status);      // 例：400
            console.log(error.response.statusText);  // Bad Request
            console.log(error.response.headers);
        });

        })
    },
    methods:{
        orderAdd(){
            var state = 1;

            if(this.info.payment == 1){
                state = 2;
            }

            var add = {
                'user_id' : this.$store.state.user.id,
                'state_id' : state,
                'payment_id' : this.info.payment,
                'shipping_id' : this.haisou.id,
            };

            axios.post('/api/order/add',add).then(res => {
                console.log(res.data);
                this.order_id = res.data;
                console.log(this.order_id);
            }).catch(function(error){
                // The request was made and the server responded with a status code
                // that falls out of the range of 2xx
                console.log(error.response.data);
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
            });
        },
        orderDetailAdd(){
            console.log(this.order_id);
            for(var i = 0; i<this.carts.length; i++){
                var add = {
                    'order_id' : this.order_id,
                    'product_id' : this.carts[i].product_id,
                    'number' : this.carts[i].number,
                    'price' : this.carts[i].price * this.carts[i].number,
                }

                axios.post('/api/order/add_detail',add).then(res => {

                }).catch(function(error){
                    // The request was made and the server responded with a status code
                    // that falls out of the range of 2xx
                    console.log(error.response.data);
                    console.log(error.response.status);      // 例：400
                    console.log(error.response.statusText);  // Bad Request
                    console.log(error.response.headers);
                });
            } 
        },
        orderDetailDelete(){
            for(var i=0; i<this.carts.length; i++){
                axios.delete('/api/cart/delete/' + this.carts[i].id)
                .then((response) => {
                    this.$store.commit('count',-1);
                    console.log(response);
                }).catch((error) => {
                    console.log(error);
                });
            }
        },
        goNext(){
            this.orderAdd();
            this.orderDetailAdd();
            this.orderDetailDelete();
            this.$router.push('/order/complete');
        }
    }
}
</script>

<style scoped>
#product{
    border-bottom: solid 2px #DDDDDD;
}
.title{
    border-bottom: solid 1px gray;
}
.next{
	margin-top:15px;
}
.light{
    text-align: left;
    float: left;
}
.item-active{
	height: 80px;
	width: 200px;
	padding: auto;
	text-align: center;
	background-color: orange;
	color: white;
	border-color: white;
}

.item{
	height: 80px;
	width: 200px;
	padding: auto;
	text-align: center;
	background-color: tan;
	color: white;
	border-color: white;
}

.number{
    border-bottom: solid 1px white;
}
</style>