<!-- ニュースの最新３つ分をとりだす -->
<!-- トップに埋め込む用 -->
<template>
    <div class="container">
        <table class="table table-hover">
            <tbody>
                <tr v-for="(news,index) in newses" :key="index">
                    <td v-on:click="goto(news.id,index)">{{ news.title }}</td>
                    <td v-on:click="goto(news.id,index)">{{ news.created_at }}</td>
                </tr>
            </tbody>
        </table>
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
        axios.get('api/newses/take').then(response => this.newses = response.data);
        console.log('hello');
    },
    methods:{
        goto : function(id,index){
            this.$router.push({name:'news',params:{id:id}});
        }
    }
}
</script>