<template>
    <div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto my-3">
				<ul class="list-group list-group-horizontal">
					<li class="item list-group-item">
						<div class="number">1</div>
						<div class="name">商品決定</div>
					</li>
					<li class="item-active list-group-item">
						<div class="number">2</div>
						<div class="name">お客様情報</div>
					</li>
					<li class="item list-group-item">
						<div class="number">3</div>
						<div class="name">確認</div>
					</li>
					<li class="item list-group-item">
						<div class="number">4</div>
						<div class="name">完了</div>
					</li>
				</ul>
			</div>
			<div class="col-10 my-3 mx-auto">
			<p>お届け先の確認、配達方法とお支払い方法を選択してください</p>
			<h3>
				<div class="light mb-2"><i class="fas fa-map-marker-alt"></i> お届け先</div>
				<div align=right><font size=3 class="btn btn-secondary btn-sm mr-5" data-toggle="modal" data-target="#userUpdate">　変更　</font></div> 
			</h3>	
				<table class="table" >
					<tr><th>お名前</th><td>{{ user.first_name + user.last_name }}</td></tr>
					<tr><th>郵便番号</th><td>{{ user.postalcode}}</td></tr>
					<tr><th>住所</th><td>{{ user.prefecture + user.adress }}</td></tr>
				</table>  


			<h3>
				<div class="light mb-2"><i class="fas fa-box"></i> 配達方法</div>
			</h3>
				<table class="table">
					<tr>
						<th><input v-model="info.shipping" type="radio" name="shipping" value="1" id="normal" checked="checked"> 
							<label for="normal">通常発送(￥500)</label>
						</th>
						<td><label for="normal">通常の配達方法です</label></td>
					</tr>
					<tr>
						<th><input v-model="info.shipping" type="radio" name="shipping" value="2" id="fast"> 
							<label for="fast">お急ぎ発送(￥800)</label>
						</th>
						<td><label for="fast">通常より早くお届けします</label></td>
					</tr>
				</table>

			<h3>
				<div class="light mb-2"><i class="far fa-credit-card"></i> お支払い方法</div>
			</h3>
				<table class="table">
					<tr>
						<th><input v-model="info.payment" type="radio" name="payment" value="1" id="credit" checked="checked">
							<label for="credit">クレジットカード支払い</label>
						</th>
						<td>
							<label for="credit">クレジットカードの登録が必要になります</label>
							<div v-if="info.payment ==1">
								<font size="6">
									<i class="fab fa-cc-visa"></i>
									<i class="fab fa-cc-mastercard"></i>
									<i class="fab fa-cc-jcb"></i>
									<i class="fab fa-cc-diners-club"></i>
									<i class="fab fa-cc-amex"></i>
								</font>
								<table class="table">
									<tr>
										<th class="th">番号</th>
										<td><input type="number" min="0" max="9999">
											<input type="number" min="0" max="9999">
											<input type="number" min="0" max="9999">
											<input type="number" min="0" max="9999">
										</td>
									</tr>
									<tr>
										<th class="th">CVC</th>
										<td><input type="number" min="0" max="999"></td>
									</tr>
									<tr>
										<th class="th">期限</th>
										<td> 
											<select>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
											</select>
											月
											<select>
												<option value="2020">2020</option>
												<option value="2021">2021</option>
												<option value="2022">2022</option>
												<option value="2023">2023</option>
												<option value="2024">2024</option>
												<option value="2025">2025</option>
												<option value="2026">2026</option>
												<option value="2027">2027</option>
												<option value="2028">2028</option>
												<option value="2029">2029</option>
												<option value="2030">2030</option>
											</select>
											年
										</td>
									</tr>
									<tr>
										<th class="th">名義</th>
										<td><input type="text"></td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<th><input v-model="info.payment" type="radio" name="payment" value="2" id="conbini"> 
							<label for="conbini">コンビニ支払い</label>
						</th>
						<td><label for="conbini">各コンビニ端末での手数料はお客様負担になります</label>
							<div v-if="info.payment ==2">
								<table class="table table-borderless">
									<tr>
										<td>
											<img :src="'/image/SevenEleven.jpg'" height="100px" width="100px">
										</td>
										<td>
											<img :src="'/image/Lawson.jpg'" height="100px" width="100px">
										</td>
										<td>
											<img :src="'/image/FamilyMart.jpg'" height="100px" width="100px">
										</td>
									</tr>
									<tr>
										<td>
											<input type="radio" name="conbini" id="seven" value="1" checked="checked">
											<label for="seven">セブンイレブン</label>
										</td>
										<td>
											<input type="radio" name="conbini" id="roson" value="2">
											<label for="roson">ローソン</label>
										</td>
										<td>
											<input  type="radio" name="conbini" id="famima" value="3">
											<label for="famima">ファミリーマート</label>
										</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
				</table>

				<div class="light my-3 btn btn-secondary" v-on:click="$router.back()">カートに戻る</div>
				<div class="next" align=right><div @click="$router.push('/order/confirm')" class="btn btn-primary">　次へ　</div></div>
			</div>	
		</div>  


		<!-- Modal -->
		<!-- 住所・名前、変更時 -->
		<div class="modal fade" id="userUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">名前・住所変更(※未実装)</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-row">
					<div class="form-group col">
						<label for="firstname">姓</label>
						<input type="text" class="form-control" id="firstname">
					</div>
					<div class="form-group col">
						<label for="lastname">名</label>
						<input type="text" class="form-control" id="lastname">
					</div>
				</div>
				<div class="form-group">
					<label for="postalcode">郵便番号</label>
					<input type="text" class="form-control" id="postalcode">
				</div>
				<div class="form-group">
                        <label for="prefecture">都道府県</label>
                        <div class="row">
                            <div class="col-sm-10 col-md-6">
                                <select v-model="user.prefecture" class="form-control" id="prefecture" name="prefecture">
                                        <option selected></option>
                                        <option value="北海道">北海道</option>
                                        <option value="青森県">青森県</option>
                                        <option value="岩手県">岩手県</option>
                                        <option value="宮城県">宮城県</option>
                                        <option value="秋田県">秋田県</option>
                                        <option value="山形県">山形県</option>
                                        <option value="福島県">福島県</option>
                                        <option value="茨城県">茨城県</option>
                                        <option value="栃木県">栃木県</option>
                                        <option value="群馬県">群馬県</option>
                                        <option value="埼玉県">埼玉県</option>
                                        <option value="千葉県">千葉県</option>
                                        <option value="東京都">東京都</option>
                                        <option value="神奈川県">神奈川県</option>
                                        <option value="新潟県">新潟県</option>
                                        <option value="富山県">富山県</option>
                                        <option value="石川県">石川県</option>
                                        <option value="福井県">福井県</option>
                                        <option value="山梨県">山梨県</option>
                                        <option value="長野県">長野県</option>
                                        <option value="岐阜県">岐阜県</option>
                                        <option value="静岡県">静岡県</option>
                                        <option value="愛知県">愛知県</option>
                                        <option value="三重県">三重県</option>
                                        <option value="滋賀県">滋賀県</option>
                                        <option value="京都府">京都府</option>
                                        <option value="大阪府">大阪府</option>
                                        <option value="兵庫県">兵庫県</option>
                                        <option value="奈良県">奈良県</option>
                                        <option value="和歌山県">和歌山県</option>
                                        <option value="鳥取県">鳥取県</option>
                                        <option value="島根県">島根県</option>
                                        <option value="岡山県">岡山県</option>
                                        <option value="広島県">広島県</option>
                                        <option value="山口県">山口県</option>
                                        <option value="徳島県">徳島県</option>
                                        <option value="香川県">香川県</option>
                                        <option value="愛媛県">愛媛県</option>
                                        <option value="高知県">高知県</option>
                                        <option value="福岡県">福岡県</option>
                                        <option value="佐賀県">佐賀県</option>
                                        <option value="長崎県">長崎県</option>
                                        <option value="熊本県">熊本県</option>
                                        <option value="大分県">大分県</option>
                                        <option value="宮崎県">宮崎県</option>
                                        <option value="鹿児島県">鹿児島県</option>
                                        <option value="沖縄県">沖縄県</option>
                                    </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="adress">市町村</label>
                        <input type="text" class="form-control" name="adress" id="adress" placeholder="大阪市北区中崎町">
                    </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
				<button type="button" class="btn btn-primary">変更</button>
			</div>
			</div>
		</div>
		</div>
    </div>
</template>
<script>
export default {
	data(){
		return{

		}
	},
	props:{
        info: Object,
    },
	computed:{
        user : function(){
            return this.$store.state.user
        },
	}
}
</script>

<style scoped>
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.th{
	width:100px;
}
th{
	width:230px;
}
.next{
	margin-top:30px;
}

.light{
    text-align: left;
    float: left;
}

ul{
	list-style-type: none;
}

li{
	display: inline;
}

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
			
</style>