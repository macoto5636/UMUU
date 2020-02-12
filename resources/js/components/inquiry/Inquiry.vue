<template>
    <div class="container">
        <title-component>
            <span slot="title">Contact</span>
            <span slot="subtitle">お問い合わせ</span>
        </title-component>
        <div class="main">
        <router-view v-bind:inquiry.sync="inquiry"></router-view>
        </div>
    </div>
     
</template>

<script>
export default {
    data(){
        return{
            inquiry:{
                title:"",
                name:"",
                tel:"",
                email:"",
                reemail:"",
                detail:"",
                kiyaku:false,
            }
        }
    },
}
</script>

<style scoped>
    .main{
        background-color: white;
    }
</style>