<template>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div id="menu">
                <button class="navbar-toggler mx-2" type="button" data-toggle="collapse" data-target="#menu-a" aria-controls="menu-a" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <router-link to="/admin/menu" class="navbar-brand">
                <font size="5" color="#808080">U</font>
                <font size="5" color="#00bfff">M</font>
                <font size="5" color="#808080">UU</font>
            </router-link>

    </nav>
</template>

<style scoped>
    .navbar{
        box-shadow: 0 10px 6px -6px #dcdcdc;
        z-index: 9999;
    }
</style>