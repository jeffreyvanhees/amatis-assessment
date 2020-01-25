export default {

    state: {
        products: [],
    },

    actions: {

        // Fetch products from API
        fetchProducts({commit}) {
            return axios.get('api/products')
                .then(response => {
                    commit('setProducts', response.data.data);
                });
        },
    },

    mutations: {
        setProducts(state, products) {
            state.products = products;
        },
    },

}
