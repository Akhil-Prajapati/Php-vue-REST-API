<template>
  <div id="overlay">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="model-title">Update User</h5>
                <button type="button" class="close" @click="hideModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-danger" v-if="errorMsg">
                {{errorMsg}}
                </div>
                    <div class="form-group my-2">
                        <input type="text" name="name" v-model="name" class="form-control form-control-lg" >
                    </div>
                    <div class="form-group my-2">
                        <input type="text" name="email" v-model="email" class="form-control form-control-lg" >
                    </div>
                    <div class="form-group my-2">
                        <input type="text" name="phone" v-model="phone" class="form-control form-control-lg">
                    </div>
                    <div class="form-group my-2">
                        <button class="btn btn-success btn-block btn-lg w-100" @click="selectUser()">
                            Update User
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

    props: ['user'],

    data(){
        return{
            name: this.user.name,
            email: this.user.email,
            phone: this.user.phone,
            errorMsg: "",
            currentUser: {}
        }
    },
    methods: {
        hideModal() {
            this.$emit("close");
        },
        // ?id="+this.user.id+"&method='update'"
        selectUser(){
            let data = new FormData();
            data.append('id', this.user.id);
            data.append('name', this.name);
            data.append('email', this.email);
            data.append('phone', this.phone);
            data.append('req',2);
            Axios.post("http://vue.local/backend/database.php", data,{
                headers: {
                    'Content-Type': 'application/json',
                }
            }).then((res) => {
                if (res.data.error) {
                    this.errorMsg = res.data.massage;
                } else {
                    this.$emit("success", res.data.massage);
                    this.hideModal();
                    this.$emit("refreshUsers");
                }
                console.log(res.data.error);
            })
            .catch((err) => {
                console.log(err);
            });
            
        },
    },
    mounted() {
    window.addEventListener('keydown', event => {
      if (event.keyCode === 27) { 
        this.hideModal();
        console.log(this.user.name);
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