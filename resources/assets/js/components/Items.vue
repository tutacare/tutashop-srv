<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Items</div>
                    <div class="panel-body">
                        <form @submit.prevent="addItem">
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
                          <button type="submit" class="btn btn-default" v-if="!edit">Add New Item</button>
                        </form>
                        <button class="btn btn-default" v-if="edit" @click="editItem(id)">Edit Item</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading">Items</div>
              <div class="panel-body">
                <!-- table -->
                <table class="table table-striped">
                  <thead>
                    <th>UPC/EAN/ISBN</th>
                    <th>Item Name</th>
                    <th>Size</th>
                    <th>Cost Price</th>
                    <th>Selling Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                  <tr v-for="item in results">
                    <td>{{item.upc_ean_isbn}}</td>
                    <td>{{item.item_name}}</td>
                    <td>{{item.size}}</td>
                    <td>{{item.cost_price}}</td>
                    <td>{{item.selling_price}}</td>
                    <td>{{item.quantity}}</td>
                    <td>
                      <button class="btn btn-default" @click="showItem(item.id)">Edit</button>
                      <button class="btn btn-danger" @click="removeItem(item.id)">Remove</button>
                    </td>
                  </tr>
                  </tbody>
                </table>
                <!-- .end table -->
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
            id: '',
            upc_ean_isbn: '',
            item_name: '',
            size: '',
            description: '',
            cost_price: '',
            selling_price: '',
            quantity: '',
            results: [],
            edit: false
          }
        },
        methods: {
          clearForm() {
            this.upc_ean_isbn = '',
            this.item_name = '',
            this.size = '',
            this.description = '',
            this.cost_price = '',
            this.selling_price = '',
            this.quantity = ''
          },
          getItem() {
            axios.get("/api/item")
            .then(
              response => {this.results = response.data.item},  
              )
            .catch(e => {
            this.errors.push(e)
            });
          },
          showItem(id) {
            this.edit = true
            axios.get("/api/item/" + id)
            .then(
              response => {
                this.id = response.data.item.id,
                this.upc_ean_isbn = response.data.item.upc_ean_isbn,
                this.item_name = response.data.item.item_name,
                this.size = response.data.item.size,
                this.description = response.data.item.description,
                this.cost_price = response.data.item.cost_price,
                this.selling_price = response.data.item.selling_price,
                this.quantity = response.data.item.quantity
              },  
              )
            .catch(e => {
            (error) => console.log(error)
            });
          },
          editItem(id) {
            axios.put("/api/item/" + id, {
              upc_ean_isbn: this.upc_ean_isbn,
              item_name: this.item_name,
              size: this.size,
              description: this.description,
              cost_price: this.cost_price,
              selling_price: this.selling_price,
              quantity: this.quantity
            })
            .then(
              (response => {
                this.clearForm(),
                this.getItem(),
                this.edit = false
              })
              )
            .catch(
              (error) => console.log(error)
              );
          },
          removeItem(id) {
            const confirmBox = confirm("Are you sure want remove?")
            if(confirmBox)
             axios.delete("/api/item/" + id)
             .then(
              (response => {
                this.getItem()
              })
              )
            .catch(
              (error) => console.log(error)
              );
          },
          addItem() {
            axios.post("/api/item", {
              upc_ean_isbn: this.upc_ean_isbn,
              item_name: this.item_name,
              size: this.size,
              description: this.description,
              cost_price: this.cost_price,
              selling_price: this.selling_price,
              quantity: this.quantity
            })
            .then(
              (response => {
                this.clearForm(),
                this.getItem()
              })
              )
            .catch(
              (error) => console.log(error)
              );
          }
          
        },
        mounted() {
          this.getItem()
        }
    }
</script>
