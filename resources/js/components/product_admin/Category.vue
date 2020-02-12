<template>
    <div class="container">
        <title-component>
            <span slot="title">Category Admin</span>
            <span slot="subtitle">カテゴリ管理</span>
        </title-component>
        <div class="row">
            <div class="col-8 mx-auto my-3">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>カテゴリ名</th>
                    </tr>
                    <tr v-for="item in categoryies" v-bind:key="item.id">
                        <td width=50px>{{item.id}}</td>
                        <td>{{item.category_name}}</td>
                    </tr>
                </table>
                <div @click="$router.push('/admin/product')" class="btn btn-secondary my-2">　戻る　</div>
            </div>
        </div>
        
    </div>
</template>

<script>
export default {
    data(){
        return{
            categoryies:{}
        }
    },
    mounted(){
        var self = this;
        axios.get('/api/category/index').then(function(response){
            self.categoryies = response.data;
        }).catch(function(error){
            console.log(error.response.data);
            console.log(error.response.status);      // 例：400
            console.log(error.response.statusText);  // Bad Request
            console.log(error.response.headers);
        }); 
    }
}
</script>