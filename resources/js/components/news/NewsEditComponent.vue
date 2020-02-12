<!-- ニュース管理 -->
<!-- ニュースのリスト、ニュースの投稿ができる -->
<!-- 追加したい機能：ニュースの削除/ニュースの変数/マークアップ -->

<template>
    <div class="container my-3">
        <title-component>
            <span slot="title">News Edit</span>
            <span slot="subtitle">ニュース管理</span>
        </title-component>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">一覧</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">記事投稿</a>
            </li>
        </ul>
            <div class="tab-content" id="myTabContent">
            <!-- 一覧表示 -->
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <table class="table">
                    <thead>
                        <tr>
                            <th>タイトル</th>
                            <th>記事</th>
                            <th>日付</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(news,index) in newses" :key="index">
                            <td>{{ news.title }}</td>
                            <td>{{ news.article }}</td>
                            <td>{{ news.date }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- 記事投稿表示 -->
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <form class="mt-4"> 
                    <div class="form-group">
                        <label for="title">タイトル</label>
                        <input v-model="title" type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="text">内容</label>
                        <textarea v-model="text" class="form-control" id="text" name="text" rows="5" required></textarea>
                    </div>
                    <input v-on:click="createNews" class="btn btn-primary" type="button" value="　投稿　">
                </form>
            </div>
        </div>
        <backadmin-component class="mt-4">
            <span slot="title">メニューに戻る</span>
        </backadmin-component>
    </div>
</template>

<script>
export default {
    data(){
        return{
            newses:[],
            title:'',
            text:''
        }
    },
    methods:{
        createNews(){
            //テンプレートのv-modelのtitleとarticleの
            //入力値を取得し、配列に格納
            var article = {
                'title' : this.title,
                'text' : this.text
            };

            //axios.postの第一引数にルートを、
            //第二引数にポストする配列を渡す
            axios.post('/api/newses/create', article).then(res => {
                alert("記事が投稿されました");
                this.title = '';
                this.text = '';
                axios.get('/api/newses').then(response => this.newses = response.data);

            });
        }
    },
    mounted(){
        axios.get('/api/newses').then(response => this.newses = response.data)
    }
}
</script>