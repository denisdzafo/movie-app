<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MovieRepository;
use App\Repositories\UserRepository;
use App\Http\Requests\SingleMovieRequest;
use League\Fractal;

class MovieController extends Controller
{


    private $movieRepository;

    private $userRepository;

    public function __construct(MovieRepository $movieRepository, UserRepository $userRepository)
    {
        $this->movieRepository = $movieRepository;
        $this->userRepository = $userRepository;
    }

    public function getAllMovies(Request $request)
    {
        if($request->get('user_id')){
            $userRequestNumber = $this->userRepository->getUserRequestNumber($request->get('user_id'));
            if($userRequestNumber < 1000){
                $requestParammeters = [];
                $category_id = $request->get('category_id');
                $searchText = $request->get('searchText');
                $movies = $this->movieRepository->getMoviesByCategoryAndSearch($category_id, $searchText);
                $this->userRepository->increaseRequestNumber($request->get('user_id'));
                return response()->json(['data' => $movies], 200);
            }
            return  response()->json(['message' => 'You have reached maximum number of requests'], 422);
        }

        $movies = $this->movieRepository->getAllMovies();
        return response()->json(['data' => $movies], 200);
    }

    public function getSingleMovie(SingleMovieRequest $request)
    {
        $userRequestNumber = $this->userRepository->getUserRequestNumber($request->get('user_id'));

        if($userRequestNumber < 1000){
            $movie = $this->movieRepository->getSingleMovie($request->get('movie_id'));
            $this->userRepository->increaseRequestNumber($request->get('user_id'));
            $movie = $this->transformSingleMovie($movie);
            return response()->json(['data' => $movie], 200);

        }
        return  response()->json(['message' => 'You have reached maximum number of requests'], 422);
        
    }

    public function getMovieCategories()
    {
        $categories = $this->movieRepository->getMovieCategories();
        return response()->json(['data' => $categories], 200);
    }

    private function transformSingleMovie($movie)
    {
        $category =  $this->movieRepository->getCategory($movie['category_id']);
        $data = [];
        $data['id']=$movie['id'];
        $data['title']=$movie['title'];
        $data['refrence_code']=$movie['refrence_code'];
        $data['category']=$category['name'];
        $data['image']=$movie['image'];
        $data['year']=$movie['year'];

        return $data;
    }
}
