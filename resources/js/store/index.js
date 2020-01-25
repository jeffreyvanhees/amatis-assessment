import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import product from './product';
import cart from './cart';

export default new Vuex.Store({
    strict: true,
    modules: {
        product,
        cart,
    },
});
