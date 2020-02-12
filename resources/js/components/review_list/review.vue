<template>
<div class="container bottom-origin my-2">
    <div class="row">
        <div class="col-md-3 mt-2  pl-0">
            <h5 class="font-weight-bold">{{review.title}}</h5>
        </div>
        <div class="col-2 ">
            <star-rating v-bind:star-size="20"
            v-bind:read-only="true"
            v-bind:increment="1"
            v-bind:rating="review.score"
            v-bind:show-rating="false"
            >
            </star-rating>
        </div><!--col-->
        
    </div>
    <div class="row">
        <div class="col-12 mb-2">
            投稿日時：{{review.created_at}}
        </div><!--col-->
    </div><!--row-->
    <div class="row">
        <div class="col-md-8">
            {{review.article}}
        </div>
    </div><!--row-->
</div><!--container-->
</template>

<script>
export default {
    props:['review'],
	data: function(){
		return{
            
		}
    },
}
</script>

<style>

</style>