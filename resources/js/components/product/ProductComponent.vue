<template>
    <div class="container">
        <title-component>
            <span slot="title">Product List</span>
            <span slot="subtitle">商品一覧</span>
        </title-component>

        <div class="row">
            <div class="col-sm-10 col-lg-6 mx-auto">
                <form @submit.prevent="search_product">
                    <div class="input-group my-3">
                        <div class="input-group-prepend">
                            <select @change="search_product" v-model="ctgr_id" class="form-control" id="inputGroupSelect01" placeholder="カテゴリ">
                                <option value="0">すべて</option>
                                <option v-for="category in categories" v-bind:key="category.id" v-bind:value="category.id">
                                {{category.category_name}}
                                </option>
                            </select>
                        </div>
                        <input v-model="word" type="text" class="form-control" aria-label="Text input with dropdown button" style="width:270px;" placeholder="商品検索">
                            <div class="input-group-append">
                            <button  type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                            
                        </div>
                    </div>
                </form>
                </div>
            
            <div class="col-12">
                <product-list v-bind:products="products"></product-list>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function(){
        return{
            products:{},
            categories:{},
            word:String,
            ctgr_id:0,
        }
    },
    computed:{
        keyword : function(){
            this.word = this.$store.state.keyword;
            return this.$store.state.keyword;
        },
        category_id : function(){
            this.ctgr_id = this.$store.state.category_id;
            return this.$store.state.category_id;
        }
    },
    mounted: function(){
        var self = this;
        //商品表から全件取得、後あと消す
        var serach={
            keyword:this.keyword,
            category_id:this.category_id
        }
        axios.post('/api/products/search',serach).then((res)=>{
			this.products= res.data
        }).catch(function(error){
                console.log(error.response.data);
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
        });

        axios.get('/api/category/index').then(res => {
            self.categories = res.data;
        }).catch(function(error){
                console.log(error.response.data);
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
        });
        
        

    },
    watch:{
        keyword:function(){
            var serach={
                keyword:this.keyword,
                category_id:this.category_id
            }
            console.log('ooi');
			axios.post('/api/products/search',serach).then((res)=>{
				this.products= res.data
            })
        },
        category_id:function(){
            var serach={
                keyword:this.keyword,
                category_id:this.category_id
            }
            console.log('ooi');
			axios.post('/api/products/search',serach).then((res)=>{
				this.products= res.data
            })
        }
    },
    methods:{
        search_product:function(){
            this.$store.commit('changeKeyword',this.word);
            this.$store.commit('changeCategory',this.ctgr_id);
            var serach={
                keyword:this.keyword,
                category_id:this.category_id
            }
            console.log('ooi');
			axios.post('/api/products/search',serach).then((res)=>{
				this.products= res.data
              })
            return false;
        },
    }
}
</script>