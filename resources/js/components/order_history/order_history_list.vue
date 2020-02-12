<template>
    <div class="container">
        <div class="line-up">
            <order-parts
                v-bind:path="path"
                v-bind:path2="path2"
                v-for="order in filteredList"
                v-bind:key="order.id"
                v-bind:order = "order"
            >
            </order-parts>
        </div>
    </div>
</template>

<script>
export default {
    props:['orders'],
    data: function(){
        return{
            sortOrder:1,
            //画像のパス
             path: "/product_image/",
            //商品詳細んのパス
            path2: "details?id="
        }
    },
    methods:{

    },
    computed:{
        filteredList: function(){
            //絞り込み後の商品リストを返す配列
            var newList = [];
            for(var i=0; i<this.orders.length;i++){
                newList.push(this.orders[i]);
            }
            return newList;
        }
    }
}
</script>