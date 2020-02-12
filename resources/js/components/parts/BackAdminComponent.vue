<!-- 戻るボタン -->
<!-- ただの戻るボタン -->
<!-- 追加したい機能：-->

<template>
    <div>
        <button v-on:click="$router.back()" tag="button" class="btn btn-secondary">
            <slot name="title"></slot>
        </button>
    </div>
</template>