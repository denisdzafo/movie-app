<template>
  <div>
      <section id="header" class="intro-section pb-2" :style='{ backgroundImage: "url(" + img_src + ")", }'>
         <div class="container text-center">
            <h1 class="text-shadow mb-5">Login</h1>
         </div>
      </section>
      <section class="content">
         <div class="container">
            <div class="row justify-content-md-center">
               <div class="col-6">
                  <div class="card card-default">
                      <div class="card-body">
                        <form >
                           <div class="form-group row mb-3">
                              <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                              <div class="col-md-6">
                                 <input id="email" type="email" class="form-control" v-model="email" required>
                              </div>
                           </div>
                           <div class="form-group row mb-3">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                              <div class="col-md-6">
                                 <input id="password" type="password" class="form-control" v-model="password" required>
                              </div>
                           </div>
                           <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                 <button 
                                     type="button"
                                     class="btn btn-primary"
                                     @click = "login()">
                                  Login
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
  import store from '../store'
  import movieDataService from "../services/movieDataService";    
  export default {
    data() {
      return {
        email: null,
        password: null,
        success: false,
        has_error: false,
        error: '',
        img_src:'/register.jpg',
      }
    },
    mounted() {
      //
    },
    methods: {
      login() {
          var data = {
            email: this.email,
            password: this.password
          };
        movieDataService.login(data)
          .then(response => {
              store.commit('loginUser')
              localStorage.setItem('token', response.data.token)

              store.commit('logedUser', response.data.user)
              localStorage.setItem('user', response.data.user)
              this.$router.push({ name: 'Homepage' })
          })
          .catch(e => {
            console.log(e);
          });
      }
    }
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