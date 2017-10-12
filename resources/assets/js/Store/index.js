import Vue from 'vue';
import Vuex from 'vuex';
import VuexPersist from 'vuex-persist';
import * as Cookies from 'js-cookie';
import modules from './modules';

Vue.use(Vuex);

/**
 * Vuex Local persistence
 */
const vuexLocalPersistence = new VuexPersist({
    key: 'transparent_web',
    storage: window.localStorage,
    modules: [],
});

/**
 * Vuex cookie persistence
 */
const vuexCookiePersistence = new VuexPersist({
    key: 'transparent_web',
    restoreState: (key, storage) => Cookies.getJSON(key),
    saveState: (key, state, storage) => Cookies.set(key, state, {
        expires: 3
    }),
    modules: ['Auth'],
});

export default new Vuex.Store({
  modules,
  strict: process.env.NODE_ENV !== 'production',
  plugins: [vuexCookiePersistence.plugin]
})

