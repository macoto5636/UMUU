<template>
    <div class="contaienr">
        <title-component class="mb-3">
            <span slot="title">UserChange</span>
            <span slot="subtitle">アカウント情報変更</span>
        </title-component>
        <div class="row">
            <router-view 
            ></router-view>
        </div>
    </div>
</template>

<script>
export default { 
}
</script>