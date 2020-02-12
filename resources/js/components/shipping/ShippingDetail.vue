<template>
    <div class="container my-3">
        <title-component>
            <span slot="title">Shipping</span>
            <span slot="subtitle">注文・配送管理</span>
        </title-component>
        <div class="row">
            <div class="col-7">
                注文日:{{order.created_at | moment }}
            </div>
            <div class="col-5">
                <div align="right">合計:￥{{price + order.postage | number_format }}</div>
            </div>
            <div class="col">
                    注文番号：{{$route.params.id}}　　
                        {{order.state_name}}
                        <hr>
            </div>
        </div>
        <shipping-product class="my-3"
                v-for="order_detail in order_details"
                v-bind:key="order_detail.id"
                v-bind:order_detail="order_detail"
        />
        <table class="table">
            <tr>
                <th>配送方法</th>
                <td>{{order.shipping_name}}</td>
                <td>￥{{order.postage}}</td>
            </tr>
            <tr>
                <th>配送先</th>
                <td>{{order.first_name + order.last_name}}様</td>
                <td>〒{{order.postalcode}}　{{order.prefecture + order.adress}}</td>
            </tr>
        </table>

        <div class="row">
            <div class="col">
                <div @click="$router.push('/admin/shipping')" class="btn btn-secondary my-2">戻る</div>
                <div v-if="order.state_id == 2" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary my-2 ml-3">発送する</div>
            </div>
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
                注文を発送済にしてよろしいでしょうか?
                <li>注文番号：{{$route.params.id}}</li>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">いいえ</button>
                <button type="button" class="btn btn-primary" @click="onShipping">はい</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";
export default {
    data(){
        return{
            order:[],
            order_detail:[],
            price:0
        }
    },
    filters:{
        number_format:function(val){
        	return val.toLocaleString();
        },
        moment:function(val){
            return moment(val).format('YYYY/MM/DD');
        }
    },
    mounted(){
        var self = this;
        axios.get('/api/order/getdetail/' + this.$route.params.id).then(function(response){
            self.order = response.data;
        }).catch(function(error){
                // The request was made and the server responded with a status code
                // that falls out of the range of 2xx
                console.log(error.response.data);
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
        }); 

        axios.get('/api/order/user_detail/' + this.$route.params.id).then(function(response){
            self.order_details = response.data;
            for(var item in self.order_details){
                self.price += self.order_details[item]['price'];
            }      
        }).catch(function(error){
                // The request was made and the server responded with a status code
                // that falls out of the range of 2xx
                console.log(error.response.data);
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
        }); 
    },
    methods:{
        onShipping(){
            var update ={
                'id' : this.$route.params.id,
                'state_id' : 3,
            }
            var self = this
            axios.post('/api/order/edit',update).then(res => {
                $('#exampleModal').modal('hide');
                 axios.get('/api/order/getdetail/' + this.$route.params.id).then(function(response){
                    self.order = response.data;
                })
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
.light{
    text-align: left;
    float: left;
}
</style>