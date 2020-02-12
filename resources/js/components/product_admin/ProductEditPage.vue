<template>
    <div class="container">
        <title-component>
            <span slot="title">Product Edit</span>
            <span slot="subtitle">商品編集</span>
        </title-component>
        <div class="main">
        <router-view v-bind:product.sync="product"></router-view>
        </div>
    </div>
     
</template>

<script>
export default {
    data(){
        return{
            product:{},
        }
    },
    mounted(){
        console.log(this.$route.params.id);
            var self = this;
            axios.get('/api/products/' + this.$route.params.id).then(res => {
                self.product = res.data;
            }).catch(function(error){
                // The request was made and the server responded with a status code
                // that falls out of the range of 2xx
                console.log(error.response.data);
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
            });  
    },
}
</script>
