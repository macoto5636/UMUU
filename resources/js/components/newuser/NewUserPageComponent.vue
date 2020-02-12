<template>
    <div class="container my-3">
        <title-component>
            <span slot="title">Registration</span>
            <span slot="subtitle">新規会員登録</span>
        </title-component>

        <router-view v-bind:user.sync="user"></router-view>
    </div>
</template>

<script>
export default {
    data(){
        return{
            user:{
                email: "",
                password:"",
                repassword:"",
                firstname:"",
                lastname:"",
                kana_firstname:"",
                kana_lastname:"",
                postalcode:null,
                prefecture:"",
                adress:"",
                adress2:"",
            }
        }
    }
}
</script>