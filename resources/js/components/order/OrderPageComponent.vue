<template>
    <div class="container my-3">
        <title-component>
            <span slot="title">Order</span>
            <span slot="subtitle">注文</span>
        </title-component>

        <router-view v-bind:info.sync="info"></router-view>
    </div>
</template>

<script>
export default {
    data(){
		return{
			info:{
                payment:1,
                shipping:1
            }
		}
	},
}
</script>
