<template>
    <div>
        <header-component v-if="admin==false" />
        <admin-header v-else />
        <div class="top container-fluid">
            
            <div class="row">
                
                <div class="side d-none d-md-block col-sm-3 col-lg-2">
                    <sidemenu-component></sidemenu-component>
                </div>
                <div class="main col-md-9 col-lg-10">
                    <RouterView />
                </div>
            </div>
        </div>
        <footer-component />
    </div>
</template>


<script>
export default {
    computed:{
        admin : function(){
            return this.$store.state.admin
        },
    }
}
</script>

<style>
    .top{
        background-color: whitesmoke;
    }

    .main{
        background-color: white;
        
    }

</style>