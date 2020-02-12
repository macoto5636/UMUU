<template>
    <div class="container my-3">
        <div class="row">
            <div class="col-sm-10 col-md-8 mx-auto my-3">
                <form class="needs-validation" @submit.prevent="checkForm">
                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input v-model="user.email" type="email" v-bind:class="{'form-control':true, 'is-invalid':emailflg}" id="email" placeholder="例：umuu@example.com" required >
                        <div class="invalid-feedback">
                            {{errorMessage.email}}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">パスワード(英数字6文字以上)</label>
                        <input v-model="user.password" type="password"  v-bind:class="{'form-control':true, 'is-invalid':passwordflg}" id="password" required>
                        <div class="invalid-feedback">
                            {{ errorMessage.password}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">パスワード再入力(英数字6文字以上)</label>
                        <input v-model="user.repassword" type="password"  v-bind:class="{'form-control':true, 'is-invalid':repasswordflg}" id="repassword">
                        <div class="invalid-feedback">
                            {{ errorMessage.repassword}}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="firstname">氏名</label>
                        <div class="row">
                            <div class="col">
                                <input v-model="user.firstname" type="text"  v-bind:class="{'form-control':true, 'is-invalid':firstnameflg}" id="firstname" placeholder="例：田中">
                                <div class="invalid-feedback">
                                    {{ errorMessage.firstname}}
                                </div>
                            </div>
                            
                            <div class="col">
                                <input v-model="user.lastname" type="text"  v-bind:class="{'form-control':true, 'is-invalid':lastnameflg}" id="lastname" placeholder="例：太郎">
                                <div class="invalid-feedback">
                                    {{ errorMessage.lastname}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kana_firstname">氏名カナ</label>
                        <div class="row">
                            <div class="col">
                                <input v-model="user.kana_firstname" type="text"  v-bind:class="{'form-control':true, 'is-invalid':kana_firstnameflg}" id="kana_firstname" placeholder="例：タナカ">
                                <div class="invalid-feedback">
                                    {{ errorMessage.kana_firstname}}
                                </div>
                            </div>
                            <div class="col">
                                <input v-model="user.kana_lastname" type="text"  v-bind:class="{'form-control':true, 'is-invalid':kana_lastnameflg}" id="kana_lastname" placeholder="例：タロウ">
                                <div class="invalid-feedback">
                                    {{ errorMessage.kana_lastname}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="postalcode"><b>〒</b>郵便番号</label>
                        <input v-model="user.postalcode" type="text"  v-bind:class="{'form-control':true, 'is-invalid':postalcodeflg}" id="postalcode" placeholder="例：1234567">
                        <div class="invalid-feedback">
                            {{ errorMessage.postalcode}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="prefecture">都道府県</label>
                        <div class="row">
                            <div class="col-sm-10 col-md-6">
                                <select v-model="user.prefecture"  v-bind:class="{'form-control':true, 'is-invalid':prefectureflg}" id="prefecture" name="prefecture">
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
                                <div class="invalid-feedback">
                                    {{ errorMessage.prefecture}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="adress">市町村</label>
                        <input v-model="user.adress" type="text"  v-bind:class="{'form-control':true, 'is-invalid':adressflg}" name="adress" id="adress" placeholder="例：大阪市北区中崎町">
                        <div class="invalid-feedback">
                            {{ errorMessage.adress}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="adress">番地</label>
                        <input v-model="user.adress2" type="text" v-bind:class="{'form-control':true, 'is-invalid':adress2flg}" name="adress2" id="adress2" placeholder="例：2-4-5">
                        <div class="invalid-feedback">
                            {{ errorMessage.adress2}}
                        </div>
                    </div>

                    <div class="my-3">
                        <hr>
                    </div>

                    <div class="form-check">
                        <input v-model="user.kiyaku"  v-bind:class="{'form-check-input':true,'is-invalid':kiyakflg}" type="checkbox" id="kiyaku">
                        <label class="form-check-label" for="kiyaku">
                            <a href="" data-toggle="modal" data-target="#exampleModalLong">利用規約</a>に同意する
                        </label>
                        <div class="invalid-feedback">
                            {{ errorMessage.kiyaku}}
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block my-3">確認</button>
                        
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">利用規約</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                利用規約
                この利用規約（以下，「本規約」といいます。）は，＿＿＿＿＿（以下，「当社」といいます。）がこのウェブサイト上で提供するサービス（以下，「本サービス」といいます。）の利用条件を定めるものです。登録ユーザーの皆さま（以下，「ユーザー」といいます。）には，本規約に従って，本サービスをご利用いただきます。

                <h3>第1条（適用）</h3>
                <p>本規約は，ユーザーと当社との間の本サービスの利用に関わる一切の関係に適用されるものとします。
                当社は本サービスに関し，本規約のほか，ご利用にあたってのルール等，各種の定め（以下，「個別規定」といいます。）をすることがあります。これら個別規定はその名称のいかんに関わらず，本規約の一部を構成するものとします。
                本規約の規定が前条の個別規定の規定と矛盾する場合には，個別規定において特段の定めなき限り，個別規定の規定が優先されるものとします。
                </p>
                <h3>第2条（利用登録）</h3>
                <p>本サービスにおいては，登録希望者が本規約に同意の上，当社の定める方法によって利用登録を申請し，当社がこれを承認することによって，利用登録が完了するものとします。
                当社は，利用登録の申請者に以下の事由があると判断した場合，利用登録の申請を承認しないことがあり，その理由については一切の開示義務を負わないものとします。
                </p>
                <li>利用登録の申請に際して虚偽の事項を届け出た場合</li>
                <li>本規約に違反したことがある者からの申請である場合</li>
                <li>その他，当社が利用登録を相当でないと判断した場合</li>
                第3条（ユーザーIDおよびパスワードの管理）<br>
                ユーザーは，自己の責任において，本サービスのユーザーIDおよびパスワードを適切に管理するものとします。
                ユーザーは，いかなる場合にも，ユーザーIDおよびパスワードを第三者に譲渡または貸与し，もしくは第三者と共用することはできません。当社は，ユーザーIDとパスワードの組み合わせが登録情報と一致してログインされた場合には，そのユーザーIDを登録しているユーザー自身による利用とみなします。
                ユーザーID及びパスワードが第三者によって使用されたことによって生じた損害は，当社に故意又は重大な過失がある場合を除き，当社は一切の責任を負わないものとします。
                第4条（利用料金および支払方法）<br>
                ユーザーは，本サービスの有料部分の対価として，当社が別途定め，本ウェブサイトに表示する利用料金を，当社が指定する方法により支払うものとします。
                ユーザーが利用料金の支払を遅滞した場合には，ユーザーは年14．6％の割合による遅延損害金を支払うものとします。
                第5条（禁止事項）<br>
                ユーザーは，本サービスの利用にあたり，以下の行為をしてはなりません。

                法令または公序良俗に違反する行為
                犯罪行為に関連する行為
                本サービスの内容等，本サービスに含まれる著作権，商標権ほか知的財産権を侵害する行為
                当社，ほかのユーザー，またはその他第三者のサーバーまたはネットワークの機能を破壊したり，妨害したりする行為
                本サービスによって得られた情報を商業的に利用する行為
                当社のサービスの運営を妨害するおそれのある行為
                不正アクセスをし，またはこれを試みる行為
                他のユーザーに関する個人情報等を収集または蓄積する行為
                不正な目的を持って本サービスを利用する行為
                本サービスの他のユーザーまたはその他の第三者に不利益，損害，不快感を与える行為
                他のユーザーに成りすます行為
                当社が許諾しない本サービス上での宣伝，広告，勧誘，または営業行為
                面識のない異性との出会いを目的とした行為
                当社のサービスに関連して，反社会的勢力に対して直接または間接に利益を供与する行為
                その他，当社が不適切と判断する行為
                第6条（本サービスの提供の停止等）<br>
                当社は，以下のいずれかの事由があると判断した場合，ユーザーに事前に通知することなく本サービスの全部または一部の提供を停止または中断することができるものとします。
                本サービスにかかるコンピュータシステムの保守点検または更新を行う場合
                地震，落雷，火災，停電または天災などの不可抗力により，本サービスの提供が困難となった場合
                コンピュータまたは通信回線等が事故により停止した場合
                その他，当社が本サービスの提供が困難と判断した場合
                当社は，本サービスの提供の停止または中断により，ユーザーまたは第三者が被ったいかなる不利益または損害についても，一切の責任を負わないものとします。
                第7条（利用制限および登録抹消）<br>
                当社は，ユーザーが以下のいずれかに該当する場合には，事前の通知なく，ユーザーに対して，本サービスの全部もしくは一部の利用を制限し，またはユーザーとしての登録を抹消することができるものとします。
                本規約のいずれかの条項に違反した場合
                登録事項に虚偽の事実があることが判明した場合
                料金等の支払債務の不履行があった場合
                当社からの連絡に対し，一定期間返答がない場合
                本サービスについて，最終の利用から一定期間利用がない場合
                その他，当社が本サービスの利用を適当でないと判断した場合
                当社は，本条に基づき当社が行った行為によりユーザーに生じた損害について，一切の責任を負いません。
                第8条（退会）<br>
                ユーザーは，当社の定める退会手続により，本サービスから退会できるものとします。

                第9条（保証の否認および免責事項）<br>
                当社は，本サービスに事実上または法律上の瑕疵（安全性，信頼性，正確性，完全性，有効性，特定の目的への適合性，セキュリティなどに関する欠陥，エラーやバグ，権利侵害などを含みます。）がないことを明示的にも黙示的にも保証しておりません。
                当社は，本サービスに起因してユーザーに生じたあらゆる損害について一切の責任を負いません。ただし，本サービスに関する当社とユーザーとの間の契約（本規約を含みます。）が消費者契約法に定める消費者契約となる場合，この免責規定は適用されません。
                前項ただし書に定める場合であっても，当社は，当社の過失（重過失を除きます。）による債務不履行または不法行為によりユーザーに生じた損害のうち特別な事情から生じた損害（当社またはユーザーが損害発生につき予見し，または予見し得た場合を含みます。）について一切の責任を負いません。また，当社の過失（重過失を除きます。）による債務不履行または不法行為によりユーザーに生じた損害の賠償は，ユーザーから当該損害が発生した月に受領した利用料の額を上限とします。
                当社は，本サービスに関して，ユーザーと他のユーザーまたは第三者との間において生じた取引，連絡または紛争等について一切責任を負いません。
                第10条（サービス内容の変更等）<br>
                当社は，ユーザーに通知することなく，本サービスの内容を変更しまたは本サービスの提供を中止することができるものとし，これによってユーザーに生じた損害について一切の責任を負いません。

                第11条（利用規約の変更）<br>
                当社は，必要と判断した場合には，ユーザーに通知することなくいつでも本規約を変更することができるものとします。なお，本規約の変更後，本サービスの利用を開始した場合には，当該ユーザーは変更後の規約に同意したものとみなします。

                第12条（個人情報の取扱い）<br>
                当社は，本サービスの利用によって取得する個人情報については，当社「プライバシーポリシー」に従い適切に取り扱うものとします。

                第13条（通知または連絡）<br>
                ユーザーと当社との間の通知または連絡は，当社の定める方法によって行うものとします。当社は,ユーザーから,当社が別途定める方式に従った変更届け出がない限り,現在登録されている連絡先が有効なものとみなして当該連絡先へ通知または連絡を行い,これらは,発信時にユーザーへ到達したものとみなします。

                第14条（権利義務の譲渡の禁止）<br>
                ユーザーは，当社の書面による事前の承諾なく，利用契約上の地位または本規約に基づく権利もしくは義務を第三者に譲渡し，または担保に供することはできません。

                第15条（準拠法・裁判管轄）<br>
                本規約の解釈にあたっては，日本法を準拠法とします。
                本サービスに関して紛争が生じた場合には，当社の本店所在地を管轄する裁判所を専属的合意管轄とします。
                以上
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">確認</button>
            </div>
            </div>
        </div>
        </div>

    </div>    
</template>

<style scoped>
.container{
    background-color: white;
}
</style>

<script>
export default {
    data(){
        return{
            errorMessage:{
                email:"正しいメールアドレスを入力してください",
                password:"パスワードは6文字以上かつ半角英数字のみです",
                repassword:'同じパスワードを入力してください',
                firstname:"入力してください",
                lastname:"入力してください",
                kana_firstname:"カタカナで入力してください",
                kana_lastname:"カタカナ入力してください",
                postalcode:"郵便番号が不正です",
                prefecture:"選択してください",
                adress:"住所が不正です",
                adress2:"正しい番地を入力してください",
                kiyaku:"規約に同意してください"
            },

            //エラー表示・非表示を切り替えるために使用
            emailflg:false,
            passwordflg:false,
            repasswordflg:false,
            firstnameflg:false,
            lastnameflg:false,
            kana_firstnameflg:false,
            kana_lastnameflg:false,
            postalcodeflg:false,
            prefectureflg:false,
            adressflg:false,
            adress2flg:false,
            kiyakflg:false,
        }
    },
    props:{
        user: Object
    },
    watch:{
       'user.postalcode': function(postalcode){
            let _this = this
            new YubinBango.Core(postalcode, function(addr){
                _this.user.prefecture = addr.region
                _this.user.adress = addr.locality
                _this.user.adress += addr.street
            })
        }
    },
    methods:{
        //入力されたデータをチェック
        checkForm:function(e){

            var checkflg = true;
            console.log("checkformに飛んだ");
            //メールアドレスチェック
            var regexp = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/;
            if(!regexp.test(this.user.email)){
                checkflg = false;
                this.emailflg = true;
            }else{
                this.emailflg = false;
            }
            //パスワードチェック
            regexp = /^([a-zA-Z0-9]{6,})$/;
            if(!regexp.test(this.user.password)){
                checkflg = false;
                this.passwordflg = true;
            }else{
                this.passwordflg = false;
            }
            //再入力
            if(this.user.password != this.user.repassword){
                checkflg = false;
                this.repasswordflg = true;
            }else{
                this.repasswordflg = false;
            }
            //氏名
            if(this.user.firstname == ''){
                checkflg = false;
                this.firstnameflg = true;
                console.log("氏名入力性や");
            }else{
                this.firstnameflg= false;
            }

            if(this.user.lastname == ''){
                checkflg = false;
                this.lastnameflg = true;
            }else{
                this.lastnameflg = false;
            }

            //カタカナチェック
            regexp = /^[ァ-ヶー　]*$/;
            if(!regexp.test(this.user.kana_firstname) || this.user.kana_firstname == ''){
                checkflg = false;
                this.kana_firstnameflg = true;
            }else{
                this.kana_firstnameflg = false;
            }

            if(!regexp.test(this.user.kana_lastname || this.user.kana_lastnameflg == '')){
                checkflg = false;
                this.kana_lastnameflg = true;
            }else{
                this.kana_lastnameflg = false;
            }

            //郵便番号チェック
            regexp = /^[0-9]+$/;
            if(!regexp.test(this.user.postalcode)){
                checkflg = false;
                this.postalcodeflg = true;
            }else{
                this.postalcodeflg = false;
            }

            //番地チェック
            regexp = /^[0-9]+(-[0-9]+)*$/;
            if(!regexp.test(this.user.adress2)){
                checkflg = false;
                this.adress2flg = true;
            }else{
                this.adress2flg = false;
            }

            //住所が日本語化をチェック
            regexp = /^[\u30a0-\u30ff\u3040-\u309f\u3005-\u3006\u30e0-\u9fcf]+$/;
            if(!regexp.test(this.user.adress)){
                checkflg = false;
                this.adressflg = true;
            }else{
                this.adressflg = false;
            }

            //都道府県
            if(this.user.prefecture == ''){
                checkflg = false;
                this.prefectureflg = true;
            }else{
                this.prefectureflg = false;
            }
            //規約
            if(this.user.kiyaku == false){
                checkflg = false;
                this.kiyakflg = true;
            }else{
                this.kiyakflg = false;
            }
            
            if(checkflg == false){
                //ページを遷移させない
                console.log("フラグがfalse");
                 e.preventDefault();
            }else{
                console.log("フラグがtrue");
                this.$router.push('/confirm');
            }
            

            
        },
    }
    
}
</script>