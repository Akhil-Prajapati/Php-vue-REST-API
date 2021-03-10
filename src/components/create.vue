<template>
  <div id="overlay">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="model-title">Add New User</h5>
                <button type="button" class="close" @click="hideModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-danger" v-if="errorMsg">
                {{errorMsg}}
                </div>
                    <div class="form-group my-2">
                        <input type="text" name="name" v-model="newUser.name" class="form-control form-control-lg" placeholder="Name">
                    </div>
                    <span class="text-danger" v-if="error_obj.name">
                        {{"*"+error_obj.name}}
                    </span>
                    <div class="form-group my-2">
                        <input type="text" name="email" v-model="newUser.email" class="form-control form-control-lg" placeholder="Email">
                    </div>
                    <span class="text-danger" v-if="error_obj.email">
                        {{"*"+error_obj.email}}
                    </span>
                    <div class="form-group my-2">
                        <input type="text" name="phone" v-model="newUser.phone" class="form-control form-control-lg" placeholder="Phone.No">
                    </div>
                    <span class="text-danger" v-if="error_obj.phone">
                        {{"*"+error_obj.phone}}
                    </span>
                    <div class="form-group my-2">
                        <button class="btn btn-info btn-block btn-lg w-100" @click="addUser() ">
                            Add User
                        </button>
                    </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import Axios from 'axios';

export default {
    name: 'create',
    components: {    

    },
    data(){
        return{
            newUser: {name: "",email: "",phone: ""},
            errorMsg: "",
            error_obj:{}
        }
    },
    methods: {
        hideModal() {
            this.$emit("close");
        },
        user(){
            let data = new FormData();
            data.append('name', this.newUser.name);
            data.append('email', this.newUser.email);
            data.append('phone', this.newUser.phone);
            data.append('req',1);
            Axios.post("http://vue.local/backend/database.php", data,{
                headers: {
                    'Content-Type': 'application/json'
                }

            }).then((res) => {
                if (res.data.error) {
                    this.errorMsg = res.data.massage;
                    // this.$emit("errMsg", res.data.massage);
                    // this.errorMsg = msg;
                } else {
                    this.$emit("success", res.data.massage);
                    this.hideModal();
                    this.newUser.name = "";
                    this.newUser.email = "";
                    this.newUser.phone = "";
                    this.$emit("refreshUsers");
                }
                console.log(res.data.error);
            })
            .catch((err) => {
                console.log(err);
            });
        },
        addUser(){
            this.error_obj = {};
            if (this.newUser.name.trim() == "") {
                this.error_obj.name ="please fill the name";
            }
            if (/\S+@\S+\.\S+/.test(this.newUser.email) == false) {
                this.error_obj.email ="please enter valid email";
            }
            if (/(\+?( |-|\.)?\d{1,2}( |-|\.)?)?(\(?\d{3}\)?|\d{3})( |-|\.)?(\d{3}( |-|\.)?\d{4})/.test(this.newUser.phone) == false) {
                this.error_obj.phone ="please enter valid phone number";
            }
            if (Object.keys(this.error_obj).length == 0) {
                this.user();
            }
        },
    },
    mounted() {
            
    window.addEventListener('keydown', event => {
      if (event.keyCode === 27) { 
        this.hideModal();
      }
    })
  }
}
</script>

<style>
#overlay{
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.6);
}
.close{
    padding: 0;
    border: none;
    background: none;
}
.close:focus {
  outline: none;
  box-shadow: none;
  text-decoration: none;
  
}
</style>