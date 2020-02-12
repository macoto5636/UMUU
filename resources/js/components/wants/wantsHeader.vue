<template>
<div class="d-flex border-origin ">
	<div class="search-result my-3 col-2">
		検索結果 {{count}} 件
	</div><!--search-result-->
    <div class="d-flex my-3  col-5">
        値段：<input type="text" class="w-25 h-75" v-on:keydown.enter="priceBetween(priceA,priceB)" v-model="priceA">～
        <input type="text" class="w-25 h-75" v-on:keydown.enter="priceBetween(priceA,priceB)" v-model="priceB">
    </div>
    <div class="d-flex my-3  col-3 form-group">
        <input type="text"  
        v-model="keyword" v-on:keydown.enter="$emit('searchItems',keyword)" 
        class="form-control h-75" placeholder="キーワードを入力">
    </div>
	<div class="sort-select my-3 col-2">
	<!-- sort-resultの要素 -->
		<select v-bind:value="sortOrder" v-on:change="$emit('sortOrderChanged',parseInt($event.target.value))" style="font-size: 15px;">
			<option value="1" >並べ替え:標準</option>
			<option value="2">値段が安い順</option>
			<option value="3">値段が高い順</option>
		</select>
	</div><!--sort-select-->
</div>
</template>

<script>
//aaaa
export default {
	props:['count','sortOrder'],

    data:function(){
        return{
            keyword:"",
            priceA:undefined,
            priceB:undefined,

        }
    },
    methods:{
        priceBetween:function(priceA = "0",priceB = "99999"){
            console.log("priceBetweenよびだし");
            priceA = parseInt(priceA);
            priceB = parseInt(priceB);
            //不正な値が入力された場合
            if(priceA > priceB || isNaN(priceA) || isNaN(priceB)){
                console.log("数値ではない物を入力砂");
                return;
            }
            this.$emit('priceBetween',priceA, priceB);
        }
    },
    
}
</script>

<style scoped>
.border-origin{
    border-bottom:  solid 3px #DDDDDD;
    border-top: solid 3px #DDDDDD;
    font-size:15px;
}
</style>