<template>
<div id="app">
   <div>
      <nav class="navbar navbar-expand-lg fixed-top">
         <div class="container">
            <a href="#" class="navbar-brand scrollTo">Movie Api</a>
            <button type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><span class="fa fa-bars"></span></button>
            <div id="navbarcollapse" class="collapse navbar-collapse">
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                     <router-link to="/" class="nav-link link-scroll">Home</router-link>
                  </li>          
                    <li class="nav-item" v-if="!$store.getters.user.id">
                     <router-link to="/register" class="nav-link link-scroll">Register</router-link>
                    </li>
                    <li class="nav-item" v-if="!$store.getters.user.id">
                       <router-link to="/login" class="nav-link link-scroll">Login</router-link>
                    </li>

                    <li class="nav-item" v-if="$store.getters.user.id">
                       <a @click="logout()" class="nav-link link-scroll">Logout</a>
                    </li>
                  
               </ul>
            </div>
         </div>
      </nav>
      <div class="main">
         <router-view />
      </div>
   </div>
</div>
</template>

<script>
import movieDataService from './services/movieDataService'

export default {
  name: 'Index',
    methods: {
    logout(){
      movieDataService.logout()
          .then(response => {
            this.$router.go()
              store.commit('logoutUser')
              localStorage.setItem('token', null)

              store.commit('logedUser', null)

              
          })
          .catch(e => {
            console.log(e);
          });
      }
    }
  }

  

</script>

<style type="text/css">
      .navbar {
      padding-top: 0;
      padding-bottom: 0;
      background: #fff;
      border-bottom: 1px solid #e6e6e6;
    }

    @media (max-width: 991.98px) {
      .navbar {
        padding-top: 15px;
        padding-bottom: 15px;
      }
    }

    .navbar-brand {
      text-transform: uppercase;
      letter-spacing: 0.1em;
      font-weight: 700;
      font-family: "Roboto Slab", serif;
    }

    .nav-link {
      text-transform: uppercase;
      letter-spacing: 0.1em;
      margin: 0 5px;
      color: #777;
      padding-top: 30px;
      padding-bottom: 30px;
      border-top: 4px solid transparent;
      -webkit-transition: all 0.3s;
      transition: all 0.3s;
      font-size: 0.875rem;
    }

    @media (max-width: 991.98px) {
      nav.navbar a.nav-link {
        padding-top: 0.7rem;
        padding-bottom: 0.7rem;
        border: none;
      }
    }

    .nav-link:hover {
      color: #333;
      border-top-color: #3490dc;
    }

    @media (max-width: 1199.98px) {
      .nav-link:hover {
        color: #4fbfa8;
      }
    }
</style>