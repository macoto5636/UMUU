<!-- タイトル -->
<!-- 各機能のタイトルに使う -->
<!-- 追加したい機能： -->

<template>
    <div>
        <div class="title midashi5">
            <slot name="title"></slot>
        </div>
        <div class="subtitle">
            <slot name="subtitle"></slot>
        </div>
    </div>
</template>

<style scoped>
.title{
    font-size: 40px;
    text-align: center;
}

.subtitle{
    margin-top: -0.5em;
    font-size: 20px;
    text-align: center;
}

.midashi5 {
    overflow: hidden;
    text-align: center;
}

.midashi5 span:before {
    margin-right: 0.5em;
    right: 100%;
}

.midashi5 span:before,
.midashi5 span:after {
    border-bottom: 2px solid #999999;
    border-top: 2px solid #999999;
    content: "";
    height: 0.4em;
    margin-top: -0.2em;
    position: absolute;
    top: 50%;
    width: 200em;
}

.midashi5 span:after {
    left: 100%;
    margin-left: 0.5em;
}

.midashi5 span:before,
.midashi5 span:after {
    border-bottom: 2px solid #999999;
    border-top: 2px solid #999999;
    content: "";
    height: 0.4em;
    margin-top: -0.2em;
    position: absolute;
    top: 50%;
    width: 200em;
}

.midashi5 span {
    position: relative;
}

</style>