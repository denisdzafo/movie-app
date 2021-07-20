import http from "../http-common";

class movieDataService {
	register(data) {
	    return http.post("/auth/register", data);
	  }

	  login(data) {
	  	return http.post("/auth/login", data);
	  }

	  getMovies(data) {
	    return http.post(`/movies/get`, data);
	  }

	  getSingleMovie(data) {
	    return http.post("/movies/single", data);
	  }

	  getCategories(){
	  	return http.get(`/movies/categories`);
	  }

	  logout() {
	  	return http.post("/auth/logout");
	  }

}

export default new movieDataService();
