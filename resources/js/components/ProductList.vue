<template>
    <div class="container">
        <div class="card">
            <div class="card-header">Catalog</div>
            <ul class="list-group">
                <div v-if="loading">Fething products...</div>
                <li v-else v-for="product in products" :key="product.id" class="list-group-item border-left-0 border-right-0">
                    <button
                        :disabled="alreadyInCart(product.id)"
                        class="btn btn-primary btn-sm float-right"
                        @click="addCartItem(product.id)">
                        <i class="fa fa-plus"></i>
                    </button>
                    <p class="mb-2 font-weight-bold">{{ product.name }}</p>
                    <p class="mb-0">{{ product.price | currency }} <small>+ {{ product.vat | currency }} VAT ({{ product.tax_rate }}%)</small> = {{ product.price_including_vat | currency }}</p>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex';
    import store from '../store';

    export default {
        data() {
            return {
                loading: true
            }
        },

        computed: {
            ...mapState({
                products: state => state.product.products
            }),
        },

        mounted() {

            // Fetch products when component has been mounted
            store.dispatch('fetchProducts').then(() => {
                this.loading = false
            });
        },

        methods: {

            // Checks if the product is already in the cart
            alreadyInCart(id) {
                return _.find(this.$store.state.cart.cart, {
                    id: id
                });
            },

            // Adds product to the cart
            addCartItem: function (productId) {
                store.dispatch('addCartItem', productId);
            }
        }
    }
</script>
