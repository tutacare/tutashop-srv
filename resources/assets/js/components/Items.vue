<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                      <h4 class="panel-title">
                       <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          #Item Form
                        </a>
                      </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        <form @submit.prevent="addItem">
                        <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="upc_ean_isbn">UPC/EAN/ISBN</label>
                            <input type="text" v-model="item.upc_ean_isbn" class="form-control" id="upc_ean_isbn" placeholder="UPC/EAN/ISBN">
                          </div>
                          <div class="form-group">
                            <label for="item_name">Item Name *</label>
                            <input type="text" v-model="item.item_name" class="form-control" id="item_name" placeholder="Item Name">
                          </div>
                          <div class="form-group">
                            <label for="size">Size</label>
                            <input type="text" v-model="item.size" class="form-control" id="size" placeholder="Size">
                          </div>
                          <div class="form-group">
                            <label for="description">Description</label>
                            <textarea v-model="item.description" class="form-control" rows="3"></textarea>
                          </div>
                          </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="cost_price">Cost Price *</label>
                            <input type="text" v-model="item.cost_price" class="form-control" id="cost_price" placeholder="Cost Price">
                          </div>
                          <div class="form-group">
                            <label for="selling_price">Selling Price *</label>
                            <input type="text" v-model="item.selling_price" class="form-control" id="selling_price" placeholder="Selling Price">
                          </div>
                          <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" v-model="item.quantity" class="form-control" id="quantity" placeholder="Quantity">
                          </div>
                          <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <input type="file" class="form-control" @change="avatarChange">
                          </div>
                          </div>
                          </div>
                          <button type="submit" class="btn btn-primary" v-if="!edit">Add New Item</button>
                        </form>
                        <button class="btn btn-warning" v-if="edit" @click="editItem(item.id)">Edit Item</button>
                    </div>
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
                    <th>Avatar</th>
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
                    <td><img :src="'/img/items/' + item.avatar" width="100px"></td>
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
            item: {
              id: '',
              upc_ean_isbn: '',
              item_name: '',
              size: '',
              description: '',
              cost_price: '',
              selling_price: '',
              quantity: '',
              avatar: ''
            },
            results: [],
            edit: false
          }
        },
        methods: {
          avatarChange(e) {
            //console.log(e.target.files[0])
            var fileReader = new FileReader()
            fileReader.readAsDataURL(e.target.files[0])
            fileReader.onload = (e) => {
              this.item.avatar = e.target.result
            }
            //console.log(this.item)
          },
          clearForm() {
            this.item = {
              upc_ean_isbn: '',
              item_name: '',
              size: '',
              description: '',
              cost_price: '',
              selling_price: '',
              quantity: ''
            }
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
            $('.collapse').collapse('show')
            this.edit = true
            axios.get("/api/item/" + id)
            .then(
              response => {
                this.item = response.data.item
              },  
              )
            .catch(e => {
            (error) => console.log(error)
            });
          },
          editItem(id) {
            const item = this.item
            axios.put("/api/item/" + id, item)
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
            const item = this.item
            axios.post("/api/item", item)
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
