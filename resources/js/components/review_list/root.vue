<template>
<div class="container">
    <div class="row border-origin">
        <div class="col">
            <h3>カスタマーレビュー</h3>
            <star-rating v-bind:star-size="25"
            v-bind:read-only="true"
            v-bind:increment="0.1"
            v-bind:rating="review_avg"
            >
            </star-rating>
        </div><!--col-->
    </div><!--row-->
    <div v-if="reviews==''" class="none">この商品にまだレビューはありません</div>
    <review
        v-for="review in reviews" 
        v-bind:key="review.product_id"
        v-bind:review="review"
    >
    </review>
</div><!--container-->
</template>

<script>
export default {
	data: function(){
		return{
            reviews:{},
            review_avg:0,
		}
    },
    mounted: function(){
        //wantsテーブルのデータをitemsに格納
        var self = this;
        axios.get('/api/reviews/get/' + this.$route.params.id).then(function(response){
        	self.reviews = response.data;
			console.log(self.reviews);
        });
        //reviewの平均を取得
        axios.get('/api/reviews/get_avg/' + this.$route.params.id).then(function(response){
        	self.review_avg = response.data;
			console.log(self.review_avg);
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

<style>
.border-origin{
    border-bottom:  solid 3px #DDDDDD;
}
.none{
    height: 400px;
    text-align: center;
    background-color: lightgray;
    margin:20px;
    padding-top: 150px;
}

</style>