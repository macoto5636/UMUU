<template>
    <div class="container my-3">
        <title-component>
            <span slot="title">Storing</span>
            <span slot="subtitle">入庫管理</span>
        </title-component>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="input-group my-3">
                    <input v-model="keyword" type="text" class="form-control" style="width:250px;">
                    <div class="input-group-append">
                    <button @click="search_product" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                    </div>
                </div>
            </div>
        </div>
        <table class="table my-3">
            <thead>
                <tr>
                    <th width="50px" @click="sortBy('id')" :cass="sortedClass('id')">商品ID</th>
                    <th width="250px" @click="sortBy('product_name')" :cass="sortedClass('product_name')">商品名</th>
                    <th width="100px" @click="sortBy('category_id1')" :cass="sortedClass('category_id1')">カテゴリ名</th>
                    <th width="100px" @click="sortBy('price')" :cass="sortedClass('price')">販売価格</th>
                    <th width="100px" @click="sortBy('stock')" :cass="sortedClass('stock')">在庫数</th>
                    <th width="50px">入庫数</th>
                    <th width="70px"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product,index) in eventedAction" :key="index">
                    <td>{{ product.id }}</td>
                    <td>{{ product.product_name }}</td>
                    <td>{{ product.category_name }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.stock }}</td>
                    <td><input v-model="number[index]" type="number" name="number" step=0 min=0 max=999 value="0"></td>
                    <td><div v-if="number[index] >= 1" class="btn btn-sm btn-primary" @click="onClick(product.id,number[index],index)" data-toggle="modal" data-target="#exampleModal">入庫</div></td>
                </tr>
            </tbody>
        </table>
        <backadmin-component class="mt-4">
            <span slot="title">メニューに戻る</span>
        </backadmin-component>

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
                選択した商品を入庫してよろしいでしょうか?
                <li>商品ID：{{product_id}} 入庫数:{{stock}}</li>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">いいえ</button>
                <button type="button" class="btn btn-primary" @click="onStoring">はい</button>
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
            products:[],
            number:[],
            sort:{
                key: '',
                isAsc: false
            },
            product_id:'',
            stock:0,
            num:'',
            keyword: '',
        }
    },
    computed:{
        eventedAction: function() {
            let list = this.products.slice();

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
    methods:{
        storing_check(){

        },
        sortBy(key){
            this.sort.isAsc = this.sort.key === key ? !this.sort.isAsc : false;
            this.sort.key = key;
        },
        sortedClass(key) {
            return this.sort.key === key ? `sorted ${this.sort.isAsc ? 'asc' : 'desc' }` : '';
        },
        onClick(id,number,index){
            this.product_id = id;
            this.stock = number;
            this.num = index;
        },
        onStoring(){
            var update ={
                'id' : this.product_id,
                'stock' : this.stock,
            }
            var self = this
            axios.post('/api/products/edit',update).then(res => {
                $('#exampleModal').modal('hide');
                this.number[this.num] = 0;
                axios.get('/api/products').then(response => this.products = response.data);
                //this.$router.push({path:'/admin/menu'});
            }).catch(function(error){
               
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
                
            });

        },
        search_product:function(){
            console.log('ooi');
			axios.post('/api/products/search',{keyword: this.keyword}).then((res)=>{
				this.products= res.data
              })
         
        },
    },
    mounted(){
        axios.get('/api/products').then(response => this.products = response.data)
    },
}
</script>

<style scoped>
th:hover{
    text-decoration: underline solid #000000;
}
</style>