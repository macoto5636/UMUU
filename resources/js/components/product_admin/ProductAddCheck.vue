<template>
    <div class="container">
        <div class="row my-3 mx-5">
            <div>
            <div @click="$router.back()" class="btn btn-secondary my-2">戻る</div>
            </div>
            <div class="col-12">
                <table class="table my-3">         
                    <tr>
                        <th>商品名</th>
                        <td>
                            <div class="row">
                                <div class="col">
                                {{product.product_name}}
                                </div>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>カテゴリ</th>
                        <td>
                            {{product.category_name}}
                        </td>
                    </tr>
                    <tr>
                        <th>売値</th>
                        <td>
                            {{product.price}}円
                        </td>
                    </tr>
                    <tr>
                        <th>画像</th>
                        <td>
                            <div v-if="product.image!=''" class="col-9" height="100px" width="150px">
                                    <img :src="product.image" alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>商品詳細</th>
                        <td>
                            {{product.product_details}}
                        </td>
                    </tr>
                    <tr>
                        <th>栄養詳細</th>
                        <td>
                            {{product.component_details}}
                        </td>
                    </tr>
                    <tr>
                        <th>状態</th>
                        <td v-if="product.display == 1">出品</td>
                        <td v-else>停止</td>
                    </tr>
                </table>
            </div>

            <div class="col my-3">
                <div>
                    <button class="btn btn-primary btn-block" type="submit" @click="onResister">登録</button>
                </div>
            </div>
            
        </div>

    </div>
</template>

<script>
export default {
    props:{
        product:Object
    },
    methods:{
        onResister(){

            var add = {
                'product_name' : this.product.product_name,
                'category_name' : this.product.category_name,
                'price' : this.product.price,
                'product_details' : this.product.product_details,
                'component_details' : this.product.component_details,
                'stock': this.product.stock,
                'image' : this.product.image_file,
                'display' : this.product.display,
            }

            const formData = new FormData();

            console.log(this.product.category_name);

            formData.append('product_name',this.product.product_name);
            formData.append('category_name',this.product.category_name);
            formData.append('price',this.product.price);
            formData.append('product_details',this.product.product_details);
            formData.append('component_details',this.product.component_details);
            formData.append('stock',this.product.stock);
            formData.append('image',this.product.image_file);
            formData.append('display',this.product.display);

            axios.post('/api/products/insert',formData).then(res => {
                console.log(res);
                alert('商品の登録が完了しました');
                this.$router.push('/admin/product');
            }).catch(function(error){
                console.log(error.response.data);
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
            });
        }
    }
}
</script>