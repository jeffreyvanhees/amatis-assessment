export default {

    state: {
        cart: [],
        meta: []
    },

    actions: {

        // Fetch cart items from API
        fetchCartItems({commit}) {
            return axios.get('api/cart')
                .then(response => {
                    commit('setCart', response.data);
                });
        },

        // Add item to cart
        addCartItem({commit}, id) {
            return axios.post('api/cart/' + id)
                .then(response => {
                    this.dispatch('fetchCartItems');
                });
        },

        // Delete item from cart
        deleteCartItem({commit}, id) {
            return axios.delete('api/cart/' + id)
                .then(response => {
                    this.dispatch('fetchCartItems');
                });
        },

        // Clear all cart items
        clearCartItems({commit}) {
            return axios.delete('api/cart/clear')
                .then(response => {
                    this.dispatch('fetchCartItems');
                });
        },
    },

    mutations: {
        setCart(state, cart) {
            state.cart = cart.data;
            state.meta = cart.meta;
        },
    },

}
