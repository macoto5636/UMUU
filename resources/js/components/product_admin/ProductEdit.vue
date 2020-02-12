<template>
    <div class="container">
        <form @submit="$router.push({name:'productEditCheck', params: { id: product.id }})">
        <div class="row my-3">
            <div class="col-12">
                <table class="table my-3">         
                    <tr>
                        <th>画像</th>
                        <td>
                            <div class="row">
                                <div class="col-6">
                                    <img class="product_image col-sm-9 col-md-4 mx-auto m-5 img-thumbnail " :src="'/product_image/' + product.image" width="200px" height="200px">
                                </div>
                                <div class="col-6 my-auto">
                                    <input @change="selectedFile" type="file" name="file">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>商品ID</th>
                        <td>{{product.id}}</td>
                    </tr>
                    <tr>
                        <th>商品名</th>
                        <td>
                            <div class="row">
                                <div class="col">
                                <input v-model="product.product_name" type="text" class="form-control" id="name" required>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>カテゴリ</th>
                        <td>
                            <select v-model="product.category_name" options="categories" class="form-control" id="inquiry">
                            <option v-for="category in categories" v-bind:key="category.id" v-bind:value="category.category_name">
                                {{category.category_name}}
                            </option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <th>売値</th>
                        <td>
                            <div class="row">
                                <div class="col-3"><input v-model="product.price" type="number" class="form-control" id="price" min="1" max="999999" required></div>
                                <div class="col-2">円</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>在庫</th>
                        <td>
                            <div class="row">
                                　{{product.stock}}個
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>商品詳細</th>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <textarea v-model="product.product_details" type="text" class="form-control" id="detail" rows="8" required></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>栄養詳細</th>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <textarea v-model="product.component_details" type="text" class="form-control" id="component_detail" rows="5" required></textarea>
                                </div>
                            </div>
                            
                        </td>
                    </tr>
                    <tr>
                        <th>状態</th>
                        <td>
                            <div class="row">
                                <div class="col ml-5">
                                    <input v-model="product.display" class="form-check-input" type="radio" id="state1" value="1">
                                    <label class="form-check-label" for="state1">出品</label><br>
                                    <input v-model="product.display" class="form-check-input" type="radio" id="state2" value="2">
                                    <label class="form-check-label" for="state2">停止</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <backadmin-component>
                    <span slot="title">　戻る　</span>
                </backadmin-component>
            </div>
            <div class="col-6">
                <div align=right>
                    <button class="btn btn-primary" type="submit">　確認　</button>
                </div>
            </div>
            
        </div>
        </form>
    </div>
</template>

<script>
export default {
    props:{
        product: Object,
    },
    data(){
        return{
            categories:{},
            uploadFile:null
        }
    },
    mounted(){
        this.getCategory();
    },
    methods: {
        getCategory(){
            var self = this;
            axios.get('/api/category/index').then(res => {
                self.categories = res.data;
            }).catch(function(error){
                // The request was made and the server responded with a status code
                // that falls out of the range of 2xx
                console.log(error.response.data);
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
            });   
        },
        selectedFile(e){
            e.preventDefault();
            let files = e.target.files;
            this.uploadFile = files[0];
        }
    }
}
</script>
<style scoped>
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>