<!-- ニュース記事 -->
<!-- ニュースのタイトルや内容などを表示する -->
<!-- 追加したい機能： -->

<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p style="text-align:right">{{ news.created_at }}</p>
                <h2>{{ news.title }}</h2> 
                <hr>
            </div>
            <div class="col-12 mb-4 ml-2">
                {{ news.article }}
            </div>
        </div>
        <router-link to="/news">
             <button class="btn btn-secondary btn-sm my-3">ニュース一覧へ戻る</button>
        </router-link>
    </div>
</template>

<script>
export default {
    data: function(){
        return{
            news: []
        }
    },
    mounted: function(){
        this.getItem();
    },
    methods:{
        //news取得
        getItem(){
            axios.get('/api/newses/' + this.$route.params.id)
            .then((res) => {
                this.news = res.data;
            });
        }
    }
}
</script>

<style scoped>
h2 {
  position: relative;
  padding-left: 25px;
}


</style>