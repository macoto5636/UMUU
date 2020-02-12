<template>
<div class="container">
    <div class="row my-4 border-bottom">
      <div class="col-1 ">
        <!--ここに商品画像-->
        <img class="img-fruit mb-3" :src="'/product_image/' + product.image"  width="60px" height="60px">
      </div>
      <div class="col-5 my-3 ">
          {{product.product_name}}
      </div>
    </div><!--row-->
    <form @submit.prevent="sendReview">
      <div class="row">
        <div class="col-12 ">
          <h3>レビューを投稿する</h3>
        </div>
      </div><!--row-->
      <div class="row my-3">
          <div class="col-12 ">
            <h4>全体的な評価</h4>
          </div>
          <div class="col-3">
            <star-rating v-bind:star-size="30" @rating-selected ="setRating">
            </star-rating>
          </div><!--col-->
      </div><!--row-->
      <div class="row my-3">
        <div class="col-12">
            <h4>レビューのタイトル</h4>
        </div><!--col-->
        <div class="col">
          <div class="form-group">
            <input type="text" name="title" class="form-control" 
            v-model="title"
            placeholder="最も伝えたいポイントはなんですか">
          </div><!--form-group-->
        </div>
      </div><!--row-->
      <div class="row my-3">
        <div class="col-12">
            <h4>ここにレビューを記入してください</h4>
        </div><!--col-->
        <div class="col-12">
          <div class="form-group">
            <textarea name="article" class="form-control" rows="3" 
            placeholder="気に入ったこと/気に入らなかったことはなんですか"
            v-model="article">
            </textarea>
          </div><!--form-group-->
        </div><!--col-->
      </div><!--row-->
      <div class="row ">
        <input type="hidden" name="review" v-bind:value="rating">
        <div class="col-12">
          <input type="submit" value="投稿" class="btn btn-primary">
        </div>
      </div>
    </form>
</div><!--container-->
</template>

<script>
export default {
	data: function(){
		return{
      //reviewの値を格納
      rating:0,
      title:'',
      article:'',
      product:{}
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
  methods:{
    //選択した星の数を格納
    setRating:function(rating){
      this.rating = rating;
      console.log(rating);
    },
    //レビューを投稿　画面遷移とか設定できなくてごめん
    sendReview:function(){
      var add = {
        "product_id":this.$route.params.id,
        "user_id": this.$store.state.user.id,
        "title": this.title,
        "article": this.article,
        "rating": this.rating,
      }
      axios.post('/api/reviews/send',add)
      .then((response) => {
      console.log("追加");
      }).catch((error) => {
        console.log(error);
      })	
      alert('レビューを投稿しました');
      this.$router.push('/product/' + this.$route.params.id);
    }

  }
}
</script>

<style scoped>
.border-origin{
    border-bottom:  solid 3px #DDDDDD;
}


</style>