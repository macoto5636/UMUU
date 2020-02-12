import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex)

export default new Vuex.Store({
    state:{
        user: {},
        isLogin: false,
        count:0,
        admin: false,
        keyword:'',
        category_id:'',
    },
    mutations:{
        user(state,user){
            state.user = user;
        },
        authState(state,status){
            state.isLogin = status;
        },
        count(state,count){
            state.count += count;
        },
        cartzero(state){
            state.count = 0;
        },
        admin(state,admin){
            state.admin = admin;
        },
        changeKeyword(state,keyword){
            state.keyword = keyword;
        },
        changeCategory(state,category){
            state.category_id = category;
        }
    },
    getter:{
        user(state){
            return state.user;
        },
        inSigenedIn(state){
            return state.status;
        }
    }
});