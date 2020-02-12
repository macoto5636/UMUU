<!-- ニュース -->
<!-- ニュースの一覧を表示したり、ニュースの個別ページを表示する ここ自体に処理はない -->
<!-- 追加したい機能：特になし -->

<template>
    <div class="contaienr">
        <title-component class="mb-3">
            <span slot="title">News</span>
            <span slot="subtitle">ニュース</span>
        </title-component>
        <div class="row">
            <router-view></router-view>
        </div>
    </div>
</template>