<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Items</div>
                    <div class="panel-body">
                        <form @submit.prevent="onSubmitted">
                          <div class="form-group">
                            <label for="upc_ean_isbn">UPC/EAN/ISBN</label>
                            <input type="text" v-model="upc_ean_isbn" class="form-control" id="upc_ean_isbn" placeholder="UPC/EAN/ISBN">
                          </div>
                          <div class="form-group">
                            <label for="item_name">Item Name *</label>
                            <input type="text" v-model="item_name" class="form-control" id="item_name" placeholder="Item Name">
                          </div>
                          <div class="form-group">
                            <label for="size">Size</label>
                            <input type="text" v-model="size" class="form-control" id="size" placeholder="Size">
                          </div>
                          <div class="form-group">
                            <label for="description">Description</label>
                            <textarea v-model="description" class="form-control" rows="3"></textarea>
                          </div>
                          <div class="form-group">
                            <label for="cost_price">Cost Price *</label>
                            <input type="text" v-model="cost_price" class="form-control" id="cost_price" placeholder="Cost Price">
                          </div>
                          <div class="form-group">
                            <label for="selling_price">Selling Price *</label>
                            <input type="text" v-model="selling_price" class="form-control" id="selling_price" placeholder="Selling Price">
                          </div>
                          <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" v-model="quantity" class="form-control" id="quantity" placeholder="Quantity">
                          </div>
                          <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
    export default {
        data () {
          return {
            upc_ean_isbn: '',
            item_name: '',
            size: '',
            description: '',
            cost_price: '',
            selling_price: '',
            quantity: ''
          }
        },
        methods: {
          onSubmitted() {
            axios.post("http://tutashop-srv.dev/api/item", {
              upc_ean_isbn: this.upc_ean_isbn,
              item_name: this.item_name,
              size: this.size,
              description: this.description,
              cost_price: this.cost_price,
              selling_price: this.selling_price,
              quantity: this.quantity
            })
            .then(
              (response) => console.log(response)
              )
            .catch(
              (error) => console.log(error)
              );
          }
        }
    }
</script>
