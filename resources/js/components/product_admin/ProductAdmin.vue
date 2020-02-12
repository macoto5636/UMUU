<template>
    <div class="container">
        <title-component>
            <span slot="title">Product Admin</span>
            <span slot="subtitle">商品管理</span>
        </title-component>
        <div class="row my-3">
            <div class="col-6 col-lg-4 mx-auto">
                <router-link to="/admin/product/add" tag="button" class="btn btn-danger btn-block">新規商品追加</router-link>
            </div>
            <div class="col-6 col-lg-4 mx-auto">
                <router-link to="/admin/product/category" tag="button" class="btn btn-success btn-block">カテゴリ一覧</router-link>
            </div>
        </div>
        <hr class="my-3">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="input-group my-3">
                    <input v-model="keyword" type="text" class="form-control" style="width:250px;">
                    <div class="input-group-append">
                    <button v-on:click="search_product" type="button" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                    </div>
                </div>
            </div>
            <div class="col-12">
                

                <table class="table table-hover"> 
                    <thead>
                        <tr>
                            <th @click="sortBy('id')" :class="sortedClass('id')">ID</th>
                            <th @click="sortBy('product_name')" :class="sortedClass('prodcut_name')">商品名</th>
                            <th @click="sortBy('category_id1')" :class="sortedClass('category_id1')">カテゴリ</th>  
                            <th @click="sortBy('price')"  :class="sortedClass('price')">売値(円)</th>
                            <th @click="sortBy('stock')" :class="sortedClass('stock')">在庫(個)</th>
                            <th @click="sortBy('display')" :class="sortedClass('display')">状態</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(product,index) in eventedAction" :key="index">
                            <td>{{ product.id }}</td>
                            <td>{{ product.product_name }}</td>
                            <td>{{ product.category_name }}</td>
                            <td>{{ product.price }}</td>
                            <td>{{ product.stock }}</td>
                            <td v-if="product.display == 1">出品</td>
                            <td v-else>停止</td>
                            <td><router-link :to="{ name: 'productEdit', params: { id: product.id }}" class="btn btn-sm btn-secondary">編集</router-link></td>
                        </tr>  
                    </tbody>

                </table>

            </div>
        </div>
        <div @click="$router.push('/admin/menu')" class="btn btn-secondary my-2">メニューに戻る</div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            products:[],
            keyword: '',
            sort:{
                key: '',
                isAsc: false
            }
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
    mounted(){
        axios.get('/api/products').then(response => this.products = response.data)
    },
    methods:{
        search_product:function(){
            console.log('ooi');
			axios.post('/api/products/search',{keyword: this.keyword}).then((res)=>{
				this.products= res.data
      		})
        },
        sortBy(key){
            this.sort.isAsc = this.sort.key === key ? !this.sort.isAsc : false;
            this.sort.key = key;
        },
        sortedClass: function(key) {
            return this.sort.key === key ? `sorted ${this.sort.isAsc ? 'asc' : 'desc' }` : '';
        }
    }
}
</script>

<style scoped>

th:hover{

    text-decoration: underline solid #000000;
}

</style>