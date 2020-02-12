<template>
<div class="d-flex main-option">
	<div class="search-result my-3 col-3">
		<font size=3>検索結果 {{count}} 件</font>
	</div><!--search-result-->
	<div class="d-flex my-3  col-5">
        値段：<input type="text" class="w-25 h-75" v-on:keydown.enter="priceBetween(priceA,priceB)" v-model="priceA">～
        <input type="text" class="w-25 h-75" v-on:keydown.enter="priceBetween(priceA,priceB)" v-model="priceB">
    </div>
	<div class="sort-select my-3 col-3">
	<!-- sort-resultの要素 -->
		<select class="form-control" v-bind:value="sortOrder" v-on:change="$emit('sortOrderChanged',parseInt($event.target.value))" style="font-size: 13px;">
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
	data(){
		return{
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

<style>
.search-result{
	margin-top: 5px ;
}
.search-product{
	margin:0 auto 0 0;
}
.sort-select{
	margin: 0 0 0 auto;
}
.main-option{
	width: 100%;
	display: flex;
	border-bottom: solid 2px #DDDDDD;
	border-top: solid 2px #DDDDDD;
}
</style>