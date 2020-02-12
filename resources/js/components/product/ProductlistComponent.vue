<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <product-header 
                    v-bind:count="filteredList.length"
                    v-bind:sortOrder="sortOrder"
                    v-on:sortOrderChanged="sortOrderChanged"
                    v-on:priceBetween="priceBetween">
                </product-header>
            </div>
            <div v-if="filteredList==''" class="col">
                <div class="none">該当する商品はありません</div>
            </div>
            <div v-else class="line-up col my-3">
                <product class="mx-3 mx-auto"
                    v-bind:path="path"
                    v-bind:path2="path2"
                    v-for="product in filteredList"
                    v-bind:key="product.id"
                    v-bind:product="product">
                </product>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['products'],
    data: function(){
        return{
            //並び替えの選択値(1:標準2:価格が安い3:価格が高い)
            sortOrder: 1,
            //画像のパス
             path: "/product_image/",
            //商品詳細んのパス
            path2: "details?id=",
            //値段A～値段B
            priceA:undefined,
            priceB:undefined,
        }
    },
    methods:{
        //［並べ替え］の選択値が変わったときに呼び出されるメソッド
        sortOrderChanged: function(order){
            //新しい選択値で上書き
            this.sortOrder = order;
        },
        //値段検索を入力された場合呼び出される
        priceBetween:function(priceA,priceB){
            this.priceA = priceA;
            this.priceB = priceB;
            console.log("Adayo" +this.priceA + "Bdayo" + this.priceB);
        },
    },
    computed:{
        //絞り込み後の商品リストを返す算出プロパティ
        filteredList: function(){
            //絞り込み後の商品リストを返す配列
            var newList = [];
            for(var i=0; i<this.products.length; i++){
                //表示対象かどうか判定するフラグ
                var isShow = true;
                
                if(this.priceB !== undefined){
                    //入力された値段の範囲外か
                    if(this.priceA > this.products[i].price ||  this.priceB < this.products[i].price){
                        isShow = false;
                    }
                }

                //表示対象の商品だけを配列に追加
                if(isShow){
                    newList.push(this.products[i]);
                }
            }
            //並べ替え
            if(this.sortOrder == 1){
            }
            else if(this.sortOrder == 2){
                //安い順
                newList.sort(function(a,b){
                    return a.price - b.price;
                });
            }
            else if(this.sortOrder == 3){
                //高い
                newList.sort(function(a,b){
                    return b.price - a.price;
                });
            }
            return newList;
        },
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

.none{
    height: 400px;
    text-align: center;
    background-color: lightgray;
    margin:20px;
    padding-top: 150px;
}
</style>