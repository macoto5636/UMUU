<template>
    <div class="container">
        <div class="row">
            <div class="line-up col my-3">
                <product class="mx-3 mx-auto"
                    v-bind:path="path"
                    v-bind:path2="path2"
                    v-for="product in new_products"
                    v-bind:key="product.id"
                    v-bind:product="product">
                </product>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['new_products'],
    data(){
        return{
            path: '/product_image/',
            path2: "details?id=",
        }

    }
}
</script>

<style scoped>
.line-up{
	display: flex;
	flex-flow: row;
	justify-content:left;
	flex-wrap: wrap;
    background-color: white;
}
</style>