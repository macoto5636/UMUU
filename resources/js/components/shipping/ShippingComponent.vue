<template>
    <div class="container my-3">
        <title-component>
            <span slot="title">Shipping</span>
            <span slot="subtitle">注文・配送管理</span>
        </title-component>

        <div>
            <download-excel
                class   = "btn btn-secondary"
                :data   = "orders"
                :fields = "excel_fields"
                worksheet = "My Worksheet"
                name    = "orders.xls"> 
                注文データをダウンロード
            </download-excel>
        </div>

        <table class="table my-3">
            <thead>
                <tr>
                    <th @click="sortBy('id')" :class="sortedClass('id')">注文ID</th>
                    <th @click="sortBy('user_id')" :class="sortedClass('user_id')">顧客ID</th>
                    <th @click="sortBy('payment_id')" :class="sortedClass('payment_id')">支払い方法</th>
                    <th @click="sortBy('shipping_id')" :class="sortedClass('shipping_id')">配送方法</th>
                    <th @click="sortBy('state_id')" :class="sortedClass('state_id')">状態</th>
                    <th @click="sortBy('created_at')" :class="sortedClass('created_at')">注文日時</th>      
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(order,index) in eventedAction" :key="index">
                    <td>{{ order.id }}</td>
                    <td>{{ order.user_id }}</td>
                    <td>{{ order.payment_name }}</td>
                    <td>{{ order.shipping_name }}</td>
                    <td>{{ order.state_name }}</td>
                    <td>{{ order.created_at }}</td>
                    <td><router-link  :to="{ name: 'ShippingDetail', params: { id: order.id }}" class="btn btn-sm btn-secondary">詳細</router-link>　
                        <div v-if="order.state_id == 2" class="btn btn-sm btn-primary" @click="onClick(order.id)" data-toggle="modal" data-target="#exampleModal">
                            発送する
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div @click="$router.push('/admin/menu')" class="btn btn-secondary my-2">メニューに戻る</div>
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
                選択した注文を発送済にしてよろしいでしょうか?
                <li>注文番号：{{order_id}}</li>
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
export default {
    data(){
        return{
            orders:[],
            sort:{
                key: '',
                isAsc: false
            },
            order_id:'',

            excel_fields:{
                '注文ID':'id',
                '顧客ID':'user_id',
                '支払い方法':'payment_name',
                '配送方法':'shipping_name',
                '状態':'state_name',
                '注文日時':'created_at'

            }
        }
    },
    computed:{
        eventedAction: function() {
            let list = this.orders.slice();

            // ソート実施
            if(this.sort.key) {
                list.sort((a, b) => {
                a = a[this.sort.key];
                b = b[this.sort.key];
                return (a === b ? 0 : a > b ? 1 : -1) * (this.sort.isAsc ? 1 : -1);
                });
            }

            return list;
        }   
    },
    mounted(){
        var self = this;
        console.log("aaaa");
        axios.get('/api/order/gets').then(response => this.orders = response.data) 
        .catch(function(error){
                // The request was made and the server responded with a status code
                // that falls out of the range of 2xx
                console.log(error.response.data);
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
        }); 
    },
    methods:{
        sortBy(key){
             console.log(this.orders);
            this.sort.isAsc = this.sort.key === key ? !this.sort.isAsc : false;
            this.sort.key = key;
        },
        sortedClass(key) {
            return this.sort.key === key ? `sorted ${this.sort.isAsc ? 'asc' : 'desc' }` : '';
        },
        onClick(id){
            this.order_id = id;
        },
        onShipping(){
            var update ={
                'id' : this.order_id,
                'state_id' : 3,
            }
            var self = this
            axios.post('/api/order/edit',update).then(res => {
                $('#exampleModal').modal('hide');
                axios.get('/api/order/gets').then(response => this.orders = response.data)
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
th:hover{

    text-decoration: underline solid #000000;
}
.modal-content{
    z-index: 9999;
}
</style>