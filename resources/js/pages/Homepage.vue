<template>
<div>  
  <section id="header" class="intro-section pb-2" :style='{ backgroundImage: "url(" + img_src + ")", }'>
     <div class="container text-center">
        <h1 class="text-shadow mb-5 text-intro">Movie App</h1>
     </div>
  </section>

  <section class="user-section">
    <div class="container">
      <div class="row messsage mb-4" v-if="requestLimit" > <h5>{{requestLimit}}</h5> </div>
      <div class="row" v-if="$store.getters.user.id">
          <div class="col-md-3 mb-20">
              <input 
                type="text" 
                placeholder="Search Movie "
                class="form-control"
                v-model="searchText"
                @keyup="searchTime()"> 
          </div>

          <div class="col-md-3 mb-20" > 
             <select  v-model="categorySelected" class="form-select" @change = "getMoviesByCategory()">
                <option :value="nullCategory">All</option>
                <option :value="category.id" v-for="category in categories">{{category.name}}</option>
              </select>
          </div>
        </div>
        </div>
  </section>
  <section class="movie-section">
     <div class="container">
        <div class="row" >
           <div class="col-md-4" v-for="movie in movies">
            <b-button v-b-modal.modal-1 @click="getSingleMovie(movie.id)" class="movie-post" 
            :disabled=!$store.getters.user.id >
              <div >
                 <img :src="movie.image" alt="" class="movie-image">
                 <h5 class="movie-title">{{movie.title}}</h5>
              </div>
              </b-button>
           </div>
           
        </div>
     </div>
  </section>

  <div>
  <b-modal id="modal-1" title="Movie Details" v-if="singleMovie">
    <img :src="singleMovie.image" alt="" class="movie-image">
    <h5 class="movie-title">{{singleMovie.title}}</h5>
    <p>Refrence code: {{singleMovie.refrence_code}}</p>
    <p>Category: {{singleMovie.category}}</p>
    <p>Year: {{singleMovie.year}}</p>
  </b-modal>

  
</div>
</div>
</template>

<script>
import movieDataService from "../services/movieDataService";

    export default {
    data() {
      return {
        img_src:'/register.jpg',
        movies: [],
        categories: [],
        searchText: null,
        categorySelected: null,
        singleMovie:null,
        nullCategory: null,
        requestLimit: null,
      }
    },
    components: {
        
    },
    mounted(){
        this.getMovies({searchText: this.searchText, category_id: this.categorySelected});
        this.getCategories();
    },
    methods: {
      getMovies(data) {
        movieDataService.getMovies(data)
          .then(response => {
              this.movies = response.data.data;
          })
          .catch(response => {
              this.requestLimit = "You have reached maximum number of requests";
          });
      },

      getCategories() {
        movieDataService.getCategories()
          .then(response => {
              this.categories = response.data.data;
          })
          .catch(e => {
            console.log(e);
          });
      },

      searchTime(){
        let data = {
          searchText: this.searchText,
          category_id: this.categorySelected,
           user_id: this.$store.getters.user.id
        };

        if(this.timer){
          clearTimeout(this.timer);
          this.timer = null;
        }

        this.timer = setTimeout(() => {
            this.getMovies(data);
        }, 500)
      },

      getMoviesByCategory(){
        let data = {
          searchText: this.searchText,
          category_id: this.categorySelected,
          user_id: this.$store.getters.user.id
        };
        this.getMovies(data);
      },

      getSingleMovie(id){
        let data = {
          user_id: this.$store.getters.user.id,
          movie_id: id
        }
        console.log(data);
        movieDataService.getSingleMovie(data)
          .then(response => {
              this.singleMovie = response.data.data;
          })
          .catch(e => {
          });
      }
    }
  }
</script>

<style scoped>
  .movie-section{
    padding-bottom: 80px;
  }

  .movie-image{
      width: 100%;
      height: auto;
  }

  .movie-title{
      padding-top:20px;
  }     
  
  .movie-price {
      color: #9d9d9d;
  }

  .movie-post{   
      padding: 20px;
      -webkit-box-shadow: 0px 0px 15px -1px #525252;
  }

  .movie-post:hover{
      box-shadow: 11px 18px 26px 0px #525252;
  }

  .intro-section{        
      background-size: cover;
      background: center center no-repeat;
      color: #fff;
      min-height: 85vh;
  }

  .text-intro{
    padding-top: 230px;
  }

  .user-section{
    margin-top: 15px;
    margin-bottom:  35px;
  }

  .movie-post{
    margin-bottom:  35px;
  }

  .messsage{
    color:  red;
  }
</style>