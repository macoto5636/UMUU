<template>
    <div class="container">
        <title-component>
            <span slot="title">Day Sales</span>
            <span slot="subtitle">売上日計表</span>
        </title-component>

        <div class="row my-3">
            <div class="col-4 mx-auto">
                <date-picker
                 v-model='hi'
                />
            </div>
            <div class="col-12">
                <div v-if="orders!=''">
                <div class="line mt-2 mb-5"></div>
                    <div align=center>売上：￥{{sum | number_format}}　注文件数：{{count}}件</div>
                <div class="line mt-5"></div>
                </div>
                
                <div v-if="orders==''" class="none">この日の売上はありません</div>
                <nikkei-order
                    v-else
                    v-for="order in orders"
                    v-bind:key="order.id"
                    v-bind:order="order"
                    v-on:sendItem="daySum"
                >
                </nikkei-order>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";
export default {
    data(){
        return{
            hi: new Date(),
            orders:{},
            sum:0,
            count:0
        }
    },
    watch:{
        hi(){
           var self = this;
           this.sum = 0;
           this.count = 0;
            var add ={
                'date':moment(this.hi).format('YYYY-MM-DD')
            }
		 axios.post('/api/order/nikkei',add).then(function(response){
			self.orders = response.data;
			console.log(self.orders);
        }); 
        }
    },
    mounted(){
        var self = this;
            var add ={
                'date':moment(this.hi).format('YYYY-MM-DD')
            }
		 axios.post('/api/order/nikkei',add).then(function(response){
			self.orders = response.data;
			console.log(self.orders);
        });
    },
    filters:{
	number_format:function(val){
        	return val.toLocaleString();
    	}
	},
    methods:{
        daySum(price){
            this.count += 1;
            this.sum += price;
            console.log("a");
        }
    }
}
</script>

<style scoped>
.none{
    height: 400px;
    text-align: center;
    background-color: lightgray;
    margin:20px;
    padding-top: 150px;
}

.line{
    border-bottom: 2px solid gray;
}
</style>