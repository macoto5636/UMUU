<template>
    <div class="container">
        <title-component>
            <span slot="title">Product Add</span>
            <span slot="subtitle">商品追加</span>
        </title-component>

        <router-view v-bind:product.sync="product"></router-view>
    </div>
    
</template>

<script>
export default {
    data(){
        return{
            product:{
                product_name:'',
                category_name:'',
                price:'',
                image:'',
                image_file:'',
                stock:0,
                product_details:'',
                component_details:'',
                display:1,
            }
        }
    }
}
</script>