<template>
   <div>
      <section id="header" class="intro-section pb-2" :style='{ backgroundImage: "url(" + img_src + ")", }'>
         <div class="container text-center">
            <h1 class="text-shadow mb-5">Register</h1>
         </div>
      </section>
      <section class="content">
         <div class="container">
            <div class="row justify-content-md-center">
               <div class="col-6">
                  <div class="card card-default">
                     <div class="card-header">Register Form</div>
                     <div class="card-body">
                        <div class="alert alert-danger" v-if="has_error && !success">
                           <p v-if="error == 'registration_validation_error'">Validation Errors.</p>
                           <p v-else>Error, can not register at the moment. If the problem persists, please contact an administrator.</p>
                        </div>
                        <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
                           <div class="form-group row mb-2">
                              <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                              <div class="col-md-6">
                                 <input id="name" type="text" class="form-control" v-model="name" required>
                              </div>
                           </div>
                           <div class="form-group row mb-2">
                              <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                              <div class="col-md-6">
                                 <input id="email" type="email" class="form-control" v-model="email" required>
                              </div>
                           </div>
                           <div class="form-group row mb-2">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                              <div class="col-md-6">
                                 <input id="password" type="password" class="form-control" v-model="password" required>
                              </div>
                           </div>
                           <div class="form-group row mb-2">
                              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                              <div class="col-md-6">
                                 <input id="password-confirm" type="password" class="form-control" v-model="password_confirmation" required>
                              </div>
                           </div>
                           <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                 <button type="submit" class="btn btn-primary">
                                 Register
                                 </button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
</template>
<script>

import movieDataService from "../services/movieDataService";

  export default {
    data() {
      return {
        img_src:'/storage/register.jpg',
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        has_error: false,
        error: '',
        errors: {},
        success: false
      }
    },
    methods: {
      register() {
        var data = {
            name: this.name,
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation,
            user_role_id: 3
          };
        movieDataService.register(data)
          .then(response => {
               this.$router.push({ name: 'Login' })
          })
          .catch(e => {
            console.log(e);
          });
      }
    },

  }
</script>

<style scoped>
  .intro-section{        
    background-size: cover;
    background: center center no-repeat;
    color: #fff;
    min-height: 85vh;
  }
  .content{
    padding-bottom: 80px;
  }

@media (min-width: 992px) {
  .intro-section {    
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
  }
}
</style>