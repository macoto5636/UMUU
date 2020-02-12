<template>
    <div class="parts">
        <div class="container">
            <div class="topparts">
                <div class="row">
                    <div class="col-7">
                        注文日:{{order.created_at | moment }}
                    </div>
                    <div class="col-5">
                        <div align="right">合計:￥{{price + order.postage | number_format }}</div>
                    </div>
                    <div class="light">
                        注文番号：{{order.id}}　　
                        {{order.state_name}}　　
                    </div>
                        <div v-if="order.state_id==1" align="right" class="btn btn-sm btn-danger mb-1" data-toggle="modal" data-target="#exampleModal" >キャンセルする</div>
              
                </div>
            </div>
            <order-product class="my-3"
                v-for="order_detail in order_details"
                v-bind:order="order"
                v-bind:key="order_detail.id"
                v-bind:order_detail="order_detail"
            >
            </order-product>
            <div class="light">配送方法：{{order.shipping_name}}</div>
            <div align="right">￥{{order.postage}}</div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">確認</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                注文をキャンセルしてよろしいでしょうか？
                <li>注文番号：{{order.id}}</li>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">いいえ</button>
                <button type="button" class="btn btn-primary" @click="onCancel">はい</button>
            </div>
            </div>
        </div>
        </div>

    </div>
</template>

<script>
import moment from "moment";
export default {
    data:function(){
        return{
            order_details:{},
            products:{},
            price : 0,
        }
    },
    props:['order','path','path2'],
    filters:{
        number_format:function(val){
        	return val.toLocaleString();
        },
        moment:function(val){
            return moment(val).format('YYYY/MM/DD');
        }
    },
    mounted: function(){
        var self = this;
        axios.get('/api/order/user_detail/' + self.order.id).then(function(response){
            self.order_details = response.data;
            for(var item in self.order_details){
                self.price += self.order_details[item]['price'];
            } 
            self.price += self.order.postage;     
        });

    },
    methods:{
        onCancel(){
            var update ={
                'id' : this.order.id,
                'state_id' : 4,
            }
            var self = this
            axios.post('/api/order/edit',update).then(res => {
                $('#exampleModal').modal('hide');
                this.$router.push({path:'/mypage'})
            }).catch(function(error){  
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
                
            });
        },
    }
}
</script>

<style scoped>
.parts{
    margin: 2em;
    padding :1em;
    border: solid 1px gray;
    border-radius: 10px;
}

.topparts{
    border-bottom: solid 1px gray;
}

.light{
    text-align: left;
    float: left;
}

.state{
    font-weight: bold;
}

</style>