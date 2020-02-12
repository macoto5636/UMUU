<template>
<div class="container ">
    <div class="row ">
        <button type="button"  class="btn btn-primary btn-block mb-2">
            {{message}}
        </button>
    </div>
    <div class="row">
        <div class="col-md-6 offset-3">
            <button class="btn btn-primary btn-width ">削除</button>
        </div>
    </div>
</div>
</template>

<script>
export default {
	props:['item','index'],
    data: function(){
        return{
            message:"カートに追加する"
        }
    },
    methods:{
    //削除するデータを親に渡す
        sendItem: function(index,email,pro_id){
            console.log("削除するデータを親に渡します");
            console.log(index+  "メール" +email+ "商品コード" + pro_id);
            this.$emit('sendItem',index,email,pro_id);
        },

    //カートに追加する
        pushCart: function(index,email,pro_id){
            console.log("カートに移動します");
            this.message = "カートに追加されました"
            console.log(index+  "メール" +email+ "商品コード" + pro_id);
                axios.get('api/wants/push/' + email + '/' + pro_id).then(function(response){
			        console.log(self.items);
                });	
        },
    
	},
}
</script>