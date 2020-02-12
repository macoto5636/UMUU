<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-6 mx-auto my-5">
                <h3>管理者ログイン</h3>
                <form @submit.prevent="login">
                    <div class="my-4">
                        <input v-model="email" type="email" class="form-control" id="email" placeholder="ID" required>
                    </div>
                    <div class="my-4">
                        <input v-model="password" type="password" class="form-control" id="password" placeholder="パスワード" required>
                    </div>
                    <button class="btn btn-primary btn-block mt-5" type="submit">ログイン</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted(){
        this.$store.commit('admin',true);
    },
    data(){
        return{
            isError:false,
            email:'',
            password:'',
            user:{},
        }
    },
    methods: {
        login(){
            var self = this;
            axios.post('/api/login',{
                email: this.email,
                password: this.password
            }).then(res => {
                const token = res.data.access_token;
                axios.defaults.headers.common['Authorization'] = 'Bearer' + token;
                axios.get('api/me').then(res => {
                    this.$store.commit('user',res.data);
                    self.user = res.data; 
                    console.log(self.user);

                    this.$store.commit('authState',true);

                    if(self.user.role_id == 2){
                        this.$router.push({path:'/admin/menu'});
                    }else{
                        this.$router.push({path:'/'}); 
                    }
                })

            })
        }
    }
}
</script>