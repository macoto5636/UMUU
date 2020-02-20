<!-- ニュース一覧 -->
<!-- ニュースの一覧を表示する -->
<!-- 追加したい機能：ソート機能 -->
<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>タイトル</th>
                            <th>投稿日</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(news,index) in newses" :key="index">
                            <td v-on:click="goto(news.id,index)">
                                {{ news.title }}        
                            </td>
                            <td v-on:click="goto(news.id,index)">
                                {{ news.created_at }}                     
                            </td>
                        </tr>
                    </tbody>
                </table>
                <router-link to="/">
                    <button class="btn btn-secondary btn-sm my-3">トップへ戻る</button>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            newses: []
        }
    },
    mounted(){
        axios.get('api/newses').then(response => this.newses = response.data);
    },
    methods:{
        goto : function(id,index){
            this.$router.push({name:'news',params:{id:id}});
        }
    }
}
</script>