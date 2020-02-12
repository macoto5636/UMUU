<template>
    <div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto my-3">
				<ul class="list-group list-group-horizontal">
					<li class="item list-group-item">
						<div class="number">1</div>
						<div class="name">商品決定</div>
					</li>
					<li class="item list-group-item">
						<div class="number">2</div>
						<div class="name">お客様情報</div>
					</li>
					<li class="item list-group-item">
						<div class="number">3</div>
						<div class="name">確認</div>
					</li>
					<li class="item-active list-group-item">
						<div class="number">4</div>
						<div class="name">完了</div>
					</li>
				</ul>
			</div>
		    <div class="col-12">
                <div align=center>
                    <font size="30"><i class="far fa-check-circle"></i></font><br>
                    <font size="5">ご購入ありがとうございました</font><br>
					<font size="5">注文番号は {{order.id}} です</font><br><br>

					<router-link to="/mypage/order_history"><div class="want">注文履歴へ</div></router-link>
                </div>
		    </div>
		</div>
    </div>
</template>

<script>
export default {
	data(){
		return{
			order:{}
		}
	},
	mounted(){
		var self = this;
		 axios.get('/api/order/index2').then(function(response){
			self.order = response.data;
			console.log(self.order);
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
.item-active{
	height: 80px;
	width: 200px;
	padding: auto;
	text-align: center;
	background-color: orange;
	color: white;
	border-color: white;
}

.item{
	height: 80px;
	width: 200px;
	padding: auto;
	text-align: center;
	background-color: tan;
	color: white;
	border-color: white;
}

.number{
    border-bottom: solid 1px white;
}

.want{
    color : royalblue;
}
.want:hover{
    color : royalblue;
    text-decoration: underline solid royalblue;
}
</style>