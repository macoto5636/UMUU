<template>
    <div class="container my-3">
        <title-component>
            <span slot="title">Admin Menu</span>
            <span slot="subtitle">管理者メニュー</span>
        </title-component>
        <ul class="list-group mt-3 mb-5">
            <div v-for="item in items" :key="item.title">
                <router-link v-bind:to="item.href" class="list-group-item list-group-item-action text-center">
                    {{ item.title }}
                </router-link>
            </div>
        </ul>
    </div>
</template>

<script>
export default {
    data(){
        return{
            items:[
                {title: '商品管理',
                href: '/admin/product',
                },
                {title: '注文・配送管理',
                href: '/admin/shipping',
                },
                {title: '入庫管理',
                href: '/admin/storing',
                },
                {title:'売上日計表',
                href: '/admin/nikkei'
                },
                {title: 'ニュース管理',
                href: '/admin/newsedit',
                },
            ]
        }
    }
}
</script>