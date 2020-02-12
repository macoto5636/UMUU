<template>
    <div class="container">

        <div class="row">

                <img class="product_image col-sm-9 col-md-4 mx-auto m-5 img-thumbnail " :src="'/product_image/' + product.image" width="200px" height="300px">
      
            <div class="col-sm-12 col-md-8 mx-auto">
                <div class="mt-3"> 
                    <h3> {{ product.product_name}} </h3>
                </div>
                <div class="row">
                    <div class="category col"> 
                        カテゴリ：{{ product.category_name }}
                    </div>
                    
                </div>
                
                <hr class="my-2">
                 
                <div class="light"> 
                    価格：<font size="5" color="#b22222">￥{{product.price | number_format}}</font><br>
                    <div v-if="product.stock!=0">在庫：<font size="5" color="#008000">{{product.stock}}点</font></div>
                    <div v-else>在庫：<font size="5" color="#ff0000">売り切れ</font><br>
                                <font size="2" color="gray">入荷までしばらくお待ちください。</font>
                    </div>
                </div>
                <div v-if="product.stock!=0" align="right">
                    <input v-model="number" type="number" v-bind:max="product.stock" min="1">個
                    <div v-if="isLogin ==false" @click="$router.push('/login');" class="btn btn-primary ml-2" data-toggle="tooltip" data-placement="top" title="先にログインしてください">カートに入れる</div>
                    <div v-else class="btn btn-primary ml-2" @click="goShoping">カートに入れる</div>
                </div>
                <div align="right">
                        
                        <div v-if="isLogin == false"  @click="$router.push('/login')" class="wanted" data-toggle="tooltip" data-placement="top" title="先にログインしてください">欲しいものリストに追加する</div>
                        <div v-else-if="wantsCheck==''" @click="addWant" class="want">欲しいものリストに追加する</div>
                        <div v-else class="wanted">欲しいものリストに追加済</div>
                </div>

                <hr class="my-5">

                <ul>                   
                    <li class="Product_Details"><p>商品詳細:</p>{{ product.product_details }}</li>
                    <li class="Component_Details"><p>原材料名:</p>{{ product.component_details}}</li>
                </ul>

            </div>

            <div class="col">
                <hr class="my-2">
                <review-list></review-list>
            </div>
        
        </div>
    </div>
</template>

<script>
export default {
    data: function(){
        return{
            product: {},
            number: 1,
            wantsCheck: {},
        }
    },
    computed:{
        isLogin : function(){
            return this.$store.state.isLogin
        },
    },
    created(){
        this.updated();
    },
    mounted: function(){
        this.getItem();
        
        var self = this;

        if(this.$store.state.isLogin == true){
            this.check();
        }
        
    }, 
    filters:{
		number_format:function(val){
        	return val.toLocaleString();
    	}
	},
    methods: {
        getItem: function(){
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
        goShoping(){
            var add = {
                'user_id' : this.$store.state.user.id,
                'product_id' : this.product.id,
                'number' : this.number
            };

            axios.post('/api/cart/add',add).then(res => {
                this.$store.commit('count',1);  
                this.$router.push('/cart');
            }).catch(function(error){
                // The request was made and the server responded with a status code
                // that falls out of the range of 2xx
                console.log(error.response.data);
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
            });   
        },
        addWant(){
            var add = {
                'user_id' : this.$store.state.user.id,
                'product_id' : this.product.id,
            };
            var self = this;
            axios.post('/api/wants/add',add).then(res => {
                alert('欲しいものリストに商品を追加しました！');
                self.check();
            }).catch(function(error){
                // The request was made and the server responded with a status code
                // that falls out of the range of 2xx
                console.log(error.response.data);
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
            }); 
        },
        check(){
            var self = this;
            axios.get('/api/wants/check/' + self.$store.state.user.id +'/'+self.$route.params.id ).then(res => {
                self.wantsCheck = res.data;
                console.log(self.wantsCheck);
            }).catch(function(error){
                console.log(error.response.data);
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
            }); 
        },
        updated(){
            $('[data-toggle="tooltip"]').tooltip();
        }
    }
}
</script>

<style scoped>
.row{
    background-color: white;
}
.category{
    margin-top: -8px;
}
.hyoka{
    margin-top: -10px;
}
.re{
    background-color: gray;
    height: 100px;
}
.light{
    text-align: left;
    float: left;
}
.want{
    color : royalblue;
}
.want:hover{
    color : royalblue;
    text-decoration: underline solid royalblue;
}
.wanted{
    color : gray;
}
.product_image{
    padding: 40px;
}
</style>