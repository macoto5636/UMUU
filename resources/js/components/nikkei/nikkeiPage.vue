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
                <download-excel
                    v-if="orders!=''"
                    class = "btn btn-secondary"
                    :data = "excel"
                    :fields = "excel_fields"
                    worksheet = "My Worksheet"
                    name  = "sales.xls"> 
                    この日の売上をダウンロード
                </download-excel>
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
            <div class="col-12">
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";
export default {
    data(){
        return{
            fields:{
                'NAME':'name',
                'City':'city'
            },
            hi: new Date(),
            orders:{},
            sum:0,
            count:0,
            //excel出力用変数群
            excel:[],
            excelSum:0,
            excel_fields: {
                '注文ID': 'id',
                'ユーザID': 'user_id',
                '商品名': 'name',
                '商品別売上数量': 'pruduct_number',
                '商品別売上': 'product_sales',
                '合計金額': 'sum',
                '購入日':'created_at'
            },
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
        //excelに出力するデータを取得
            axios.post('/api/sales/excel',add).then(function(response){
                self.excel = response.data;
            });

        axios.post('/api/sales/excel/sum',add).then(function(response){
                self.excelSum = response.data;
                self.excel.push({'sum':self.excelSum});
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

        //excelに出力するデータを取得下も
        axios.post('/api/sales/excel',add).then(function(response){
            self.excel = response.data;
        });

        axios.post('/api/sales/excel/sum',add).then(function(response){
            self.excelSum = response.data;
            self.excel.push({'sum':self.excelSum});
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
        },
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