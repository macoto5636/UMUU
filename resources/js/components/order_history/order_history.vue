<template>
    <div class="container">
        <title-component>
                <span slot="title">Order History</span>
                <span slot="subtitle">注文履歴</span>
        </title-component>
        <div class="row">
            <div class="col">
                <div v-if="orders==''" class="none">該当する注文はありません</div>
                <div v-else>
                    <ul>
                        <li v-for="order in getItems" v-bind:key="order.id">
                            <order-parts
                            v-bind:path="path"
                            v-bind:path2="path2"
                            v-bind:order = "order"
                            >
                            </order-parts>
                        </li>
                    </ul>
                    <div class="row">
                    <paginate 
                        class="mx-auto"
                        :page-count="getPageCount"
                        :page-range="2"
                        :margin-pages="2"
                        :click-handler="clickCallback"
                        :prev-text="'前へ'"
                        :next-text="'次へ'"
                        :container-class="'pagination'"
                        :page-class="'page-item'"
                        :page-link-class="'page-link'"
                        :prev-class="'page-item'"
                        :prev-link-class="'page-link'"
                        :next-class="'page-item'"
                        :next-link-class="'page-link'">
                    </paginate>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
</template>

<script>
export default {
    data:function(){
        return{
            orders:{},
            parPage: 3,
            currentPage: 1,
            //画像のパス
            path: "/product_image/",
            //商品詳細んのパス
            path2: "details?id="
        }
    },
    methods:{
        clickCallback: function(pageNum){
            this.currentPage = Number(pageNum);
            $('html,body').animate({
                scrollTop: 0
            }, 100); 
            
        },
    },
    computed:{
        user : function(){
            return this.$store.state.user
        },
        getItems(){
            let current = this.currentPage * this.parPage;
            let start = current - this.parPage;
            return this.orders.slice(start,current);
        },
        getPageCount(){
            return Math.ceil(this.orders.length / this.parPage);
        }
    },
    created: function(){
        var self = this;
        //注文表から注文をとりだす
        axios.get('/api/order/user/' + self.user.id).then(function(response){
        	self.orders = response.data;
			console.log(self.orders);
        }).catch(function(error){
                console.log(error.response.data);
                console.log(error.response.status);      // 例：400
                console.log(error.response.statusText);  // Bad Request
                console.log(error.response.headers);
        }); 

    }
}
</script>

<style scoped>
.none{
    height: 400px;
    text-align: center;
    background-color: lightgray;
    margin:20px;
    padding-top: 150px;
}

ul {
  list-style: none;
}
</style>