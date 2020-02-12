<template>
<div class="container">
    <title-component>
        <span slot="title">Wants</span>
        <span slot="subtitle">欲しいものリスト</span>
    </title-component>
    <div class="row">
        <wants-header
        class="mx-auto"
        v-on:sortOrderChanged="sortOrderChanged"
        v-bind:count="filteredList.length"
        v-bind:sortOrder="sortOrder"
        v-on:searchItems="searchItems"
        v-on:priceBetween="priceBetween">
        </wants-header>
    </div>
    <div v-if="filteredList==''" class="none">欲しいものリストに商品がありません</div>
    <div v-else class="row"  v-for="(item,index) in filteredList" v-bind:key="item.product_id">
        <wants-product
            class="col-10 mx-auto"
            v-bind:item="item"
            v-bind:index="index"
            v-bind:path="path"
            v-on:sendItem="onDeleteItem">
        </wants-product>
    </div>

</div>
</template>

<script>
export default {
	data: function(){
		return{
            //カートない商品
            items:{},
            //画像のパス
            path: "/product_image/",
            //並び替えの選択値(1:標準2:価格が安い3:価格が高い)
            sortOrder: 1,
            //検索ワード
            keyword:'',
            //値段A～値段B
            priceA:undefined,
            priceB:undefined,
		}
	},
    mounted: function(){
        //wantsテーブルのデータをitemsに格納
        console.log(this.items);
        var self = this;
        axios.get('/api/wants/user_get/' + self.$store.state.user.id).then(function(response){
            self.items = response.data;
			console.log(self.items);
        }).catch(function(error){
            console.log(error.response.data);
            console.log(error.response.status);      // 例：400
            console.log(error.response.statusText);  // Bad Request
            console.log(error.response.headers);
        }); 
	},
    
    methods:{        
        //［並べ替え］の選択値が変わったときに呼び出されるメソッド
        sortOrderChanged: function(order){
            //新しい選択値で上書き
            this.sortOrder = order;
        },
        //キーワードが入力された場合呼び出される
        searchItems:function(keyword){
            this.keyword = keyword;
            console.log("keyword二文字が入りました" + this.keyword);
        },
        //値段検索を入力された場合呼び出される
        priceBetween:function(priceA,priceB){
            this.priceA = priceA;
            this.priceB = priceB;
            console.log("Adayo" +this.priceA + "Bdayo" + this.priceB);
        },
        onDeleteItem(id,index){
            var self = this;
            axios.delete('/api/wants/delete/' + id)
                .then(response =>{
                    console.log(response);
                    this.items.splice(index,1);
                }).catch(error=>{
                    console.log(error);
                })
        }

	},

    computed:{
    //絞り込み後の欲しい物リストを返す算出プロパティ
        filteredList: function(){
            //絞り込み後の商品リストを返す配列
            var newList = [];
            //正規表現でキーワードに一致する商品を抽出
            var regexp = new RegExp(this.keyword);
            for(var i=0; i<this.items.length; i++){

                //表示対象かどうか判定するフラグ
                var isShow = true;

                //キーワードに一致するか
                if(this.keyword !="" && regexp.test(this.items[i].product_name)==false){
                    isShow = false;
                }

                if(this.priceB !== undefined){
                    //入力された値段の範囲外か
                    if(this.priceA > this.items[i].price ||  this.priceB < this.items[i].price){
                        isShow = false;
                    }
                }

                //表示対象の商品だけを配列に追加
                if(isShow){
                    newList.push(this.items[i]);
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

        }
    }

}
</script>

<style scoped>

.info-title{
    display: flex;
	flex-flow: row;
}
.info-title .border-list{
    border-top: solid 2px #DDDDDD;
    border-bottom: solid 2px #DDDDDD;
    width: 40%;
}
.info-title  span{
    font-size:15px;
    margin-right: 10px;
    margin-left: 10px;
}
.none{
    height: 400px;
    text-align: center;
    background-color: lightgray;
    margin:20px;
    padding-top: 150px;
}
</style>