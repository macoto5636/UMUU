import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex)

//初期化
export const initialState = {
    user : {},
    isLogin: false,
    count:0,
    admin: false,
    keyword:'',
    category_id:0,
}

const mutations = {
    RESET_VUEX_STATE(state){
        Object.assign(state, JSON.parse(localStorage.getItem('initialState')));
    }
}

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
        },
        RESET_VUEX_STATE(state) {
            Object.assign(state, JSON.parse(localStorage.getItem('initialState')));
        }, 
    },
    getter:{
        user(state){
            return state.user;
        },
        inSigenedIn(state){
            return state.status;
        }
    },
    plugins:[createPersistedState({key: 'UMUU'})],
});