<template>
  <div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <div class="container">
      <div class="row mt-3">
        <div class="col-lg-6">
          <h3 class="text-info">Registered Users</h3>
        </div>
        <div class="col-lg-6">
          <button class="btn btn-info flot-right" v-on:click="showAdd()">
            <i class="fas fa-user"></i> Add New User
          </button>
        </div>
      </div>
      <hr class="bg-info w-100">
      
      <div class="alert alert-success" v-if="successMsg">
        {{successMsg}}
      </div>
      <!-- user-table -->
      <div class="row">
        <div class="col-lg-12">
          <table class="table table-bordered table-striped">
            <thead>
              <tr class="text-center bg-info text-light">
                <th>ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>PHONE.NO</th>
                <th>EDIT</th>
                <th>DELETE</th>
              </tr>
            </thead>
            <tbody>
              <tr class="text-center" v-for="(user,index) in users" :key="index">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.phone }}</td>
                <td @click="showUpdate(user)"><a href="#" class="test-success"><i class="fas fa-edit text-success"></i></a></td>
                <td @click="showDelete(user)"><a href="#" class="test-success"><i class="fas fa-trash-alt text-danger"></i></a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Add-User -->
    <create-user v-if="showAddModal" v-show="showAddModal" @close="closeModal" @refreshUsers="getAllusers" @success="success"></create-user>
    <update-user v-if="showUpdateModal" v-show="showUpdateModal" @close="closeModal" @refreshUsers="getAllusers" @success="success" :user="editUser"></update-user>
    <delete-user v-if="showDeleteModal" v-show="showDeleteModal" @close="closeModal" @refreshUsers="getAllusers" @success="success" :user="deleteUser"></delete-user>
  </div>
</template>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script>

import create from './create.vue';
import axios from 'axios';
import updateVue from './update.vue';
import deleteVue from './delete.vue';


export default {
  name: 'user',
   components: {
     'create-user':create,
     'update-user':updateVue,
     'delete-user' :deleteVue
  },
  data() {
    return {
      successMsg: "",
      showUpdateModal: false,
      showDeleteModal: false,
      showAddModal: false,
      users: [],
      editUser: null,
    }
  },
  mounted: function() {
    this.getAllusers();
  },
  methods:{
    closeModal() {
      this.showAddModal = false;
      this.showUpdateModal = false;
      this.showDeleteModal = false;
    },
    getAllusers(){
      axios.get("http://vue.local/backend/database.php")
      .then((res) => {
        this.users = res.data.user;
      })
      .catch((err) => {
        console.log(err);
      })
    },
    success(msg){
      this.successMsg = msg;
    },
    showAdd(){
      this.showAddModal = true;
      this.successMsg = "";
    },
    showUpdate(user){
      this.editUser = user;
      this.showUpdateModal = true;
    },
    showDelete(user){
      this.deleteUser = user;
      this.showDeleteModal = true;
    },
  },
}
</script>

<style>

</style>
