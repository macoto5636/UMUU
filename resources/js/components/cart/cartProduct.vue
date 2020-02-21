<template>
    <div class="container">
        <div class="row">
            <div class="col-4 col-md-3 mx-auto">
                <img class="img-fruit my-3 mx-auto" v-bind:src="path+item.image" width="100px" height="100px" style="object-fit: contain;">
            </div>
            <div class="col-8 col-md-9 ">
                <div class="product-details">
                        {{item.product_name}}<br>
                        <div class="light"> ￥{{item.price | number_format}}</div>
                        <div align=right>
                            数量:<input v-model="number" type="number" v-bind:max="item.stock" min="1">個
                        </div>
                        <hr>
                        <div class="light">
                            <div class="want"  v-on:click="sendItem(item.id,index)">削除</div>
                        </div>
                        <div align=right class="shoukei">￥{{itemSum(item.product_id,number) | number_format}}</div>
                </div>
            </div><!--product-details-->
        </div>
    </div>

</template>

<script>
export default {
	props:['item','index','path'],
    data(){
        return{
            number : this.item.number
        }
    },
    filters:{
	number_format:function(val){
        	return val.toLocaleString();
    	}
	},
    
    methods:{
        //削除するデータを親に渡す
        sendItem(id,index){
            this.$emit('sendItem',id,index);
        }
	},
    
    computed:{
    //商品一つの合計金額を算出
    itemSum:function(){
        var self = this;
        return function (pro_id,number) {
            console.log("数量更新中");
            var edit = {
                'user_id' : this.$store.state.user.id,
                'product_id' : pro_id,
                'number' : Number(number)
            };
            console.log(edit);
            console.log("aa");
            this.item.number = number;
            axios.post('/api/cart/edit',edit).then((res)=>
            {
            }).catch(function(error){
                    // The request was made and the server responded with a status code
                    // that falls out of the range of 2xx
                    console.log(error.response.data);
                    console.log(error.response.status);      // 例：400
                    console.log(error.response.statusText);  // Bad Request
                    console.log(error.response.headers);
                });
            return (self.item.price * self.number);
            }
        },
    }
    
}
</script>

<style scoped>
.product-details {
    font-size:20px;
}
.container{
    border-bottom: solid 2px #DDDDDD;
}

.btn-width{
    width: 100px;
}
.light{
    text-align: left;
    float: left;
}
.shoukei{
    margin-top: -10px;
}
.want{
    color : royalblue;
    font-size: 15px;
    margin-top: -8px;
}
.want:hover{
    color : royalblue;
    font-size: 15px;
    text-decoration: underline solid royalblue;
    margin-top: -8px;
}
</style>