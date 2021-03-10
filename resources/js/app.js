require('./bootstrap');

import Vue from 'vue';

import Swal from 'sweetalert2';

var app = new Vue({
    el: '#app',

    data: {
        items: [],
        newItem: '',
        currentItem: {
            name: '',
            id: undefined
        }
    },

    methods: {
        addItem() {
            if (this.newItem != '') {
                axios.post('/api/item/store', {
                    newItem: this.newItem
                }).then((response) => {
                    this.items = response.data.items;
                    this.newItem = ''
                }).catch((error) => {
                    console.log(error);
                });
            }
        },
        checkItem(itemId) {
            axios.put('/api/item/update/' + itemId).then((response) => {
                this.items = response.data.items;
            }).catch((error) => {
                console.log(error);
            });
        },
        selectItem(itemId, itemName) {
            if (this.currentItem.id === undefined || this.currentItem.id != itemId) {
                this.currentItem = {
                    id: itemId,
                    name: itemName
                };
            } else {
                this.currentItem = {
                    name: '',
                    id: undefined
                };
            }
        },
        changeItem() {
            axios.put('/api/item/edit/' + this.currentItem.id, {
                itemName: this.currentItem.name
            }).then((response) => {
                this.items = response.data.items;
            });
        },
        deleteItem(itemId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/item/destroy/' + itemId).then((response) => {
                        this.items = response.data.items;
                        Swal.fire(
                            'Deleted!',
                            'The item has been deleted.',
                            'success'
                        );
                    }).catch((error) => {
                        console.log(error);
                    });
                }
            });
        }
    },
    mounted() {
        axios.get('/api/item/index').then((response) => {
            this.items = response.data.items;
        }).catch((error) => {
            console.log(error);
        });
    }
});
