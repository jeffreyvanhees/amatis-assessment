<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Cart
                <div class="btn btn-sm btn-danger float-right" @click="clearCart">Clear all</div>
            </div>
            <div v-if="loading">Fething products...</div>

            <ul v-else class="list-group">
                <li v-for="cartItem in cart" :key="cartItem.id" class="list-group-item border-left-0 border-right-0">
                    <div @click="deleteItem(cartItem.id)" class="btn btn-danger btn-sm float-right"><i class="fa fa-trash"></i></div>
                    <p class="mb-2 font-weight-bold">{{ cartItem.name }}</p>
                    <p class="mb-0">{{ cartItem.price | currency }} <small>+ {{ cartItem.vat | currency }} VAT</small></p>
                </li>
            </ul>

            <div class="card-body" v-if="!cart.length">
                Your cart is empty. Please add a product.
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-6 font-weight-bold">Subtotal:</div>
                    <div class="col-6 text-right">{{ meta.price_total | currency }}</div>
                </div>
                <div class="row mt-2">
                    <div class="col-6 font-weight-bold">VAT:</div>
                    <div class="col-6 text-right">{{ meta.vat_total | currency }}</div>
                </div>
                <div class="row mt-2">
                    <div class="col-6 font-weight-bold">Total price:</div>
                    <div class="col-6 text-right">{{ meta.price_including_vat_total | currency }}</div>
                </div>
            </div>
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
                cart: state => state.cart.cart,
                meta: state => state.cart.meta,
            }),
        },

        mounted() {

            // Fetch cart items when component has been mounted
            store.dispatch('fetchCartItems').then(() => {
                this.loading = false
            });
        },

        methods: {

            // Delete product from cart
            deleteItem: function(id) {
                store.dispatch('deleteCartItem', id).then(() => {
                    this.loading = false
                });
            },

            // Clear whole cart
           clearCart: function() {
               store.dispatch('clearCartItems').then(() => {
                   this.loading = false
               });
           }
        }
    }
</script>
