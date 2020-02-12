<template>
    <div class="container">
        <div class="row my-3">
            <div class="col-12">
                <table class="table my-3">
                    <tr>
                        <th>画像</th>
                        <td>
                            <div class="row">
                                <div class="col mx-auto">
                                    <img class="product_image col-sm-9 col-md-4 mx-auto m-5 img-thumbnail " :src="'/product_image/' + product.image" width="200px" height="200px">
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
                            {{product.product_name}}
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
                        <th>在庫</th>
                        <td>
                            {{product.stock}}個
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
            <div class="col-6">
                <backadmin-component>
                    <span slot="title">　戻る　</span>
                </backadmin-component>
            </div>
            <div class="col-6">
                <div align=right>
                    <div class="btn btn-primary" @click="onResister">　登録　</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        product: Object,
    },
    methods:{
        onResister(){
            var update = {
                'id' : this.product.id,
                'product_name' : this.product.product_name,
                'category_name' : this.product.category_name.trim(),
                'price' : this.product.price,
                'product_details' : this.product.product_details,
                'component_details' : this.product.component_details,
                'image' : this.product.image,
                'display' : this.product.display,
            }

            axios.post('/api/products/update',update).then(res => {
                alert('商品の編集が完了しました');
                this.$router.push('/admin/product');
            }).catch(function(error){
                this.$router.push('/admin/product');
                console.log(error.response.data);
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
                
            });
            
        }
    }    
}
</script>

<style scoped>
th{
    width: 100px;
}
</style>