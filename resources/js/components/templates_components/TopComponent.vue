<template>
    <div class="container-fluid">
        
        <div>
            <carousel-component />
        </div>
            
            <title-component>
                <span slot="title">New Item</span>
                <span slot="subtitle">新着商品</span>
            </title-component>
            <newproduct v-bind:new_products="new_products"></newproduct>
            <title-component>
                <span slot="title">News</span>
                <span slot="subtitle">新着情報</span>
            </title-component>
            <div class="row">
            <newslist-component class="col-md-8 mx-auto" />
            </div>
    </div>
</template>

<script>
export default {
    data: function(){
        return{
            new_products:{},
        }
    },
    mounted: function(){
        var self = this;
        //商品取得（６件分）
        axios.get('/api/products/relation').then(function(response){
            self.new_products = response.data;
            console.log(self.new_products);
        });
        this.$store.commit('admin',false);
    },
}
</script>

<style scoped>

</style>