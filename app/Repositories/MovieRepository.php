<?php

namespace App\Repositories;

use App\Models\Movie;
use App\Models\Category;

class MovieRepository 
{
	private $movie;

	private $category;

	public function __construct(Movie $movie, Category $category)
	{
		$this->movie = $movie;
		$this->category = $category;
	}
	
	public function getAllMovies()
	{
        return $this->movie->all();
	}

	public function getSingleMovie($id)
	{
		return $this->movie->find($id);
	}

	public function getMoviesByCategoryAndSearch($category_id, $searchText = null)
	{
		if($category_id)
			return $this->movie->where('title', 'LIKE', '%'.$searchText.'%')->where('category_id', $category_id)->get();

		return $this->movie->where('title', 'LIKE', '%'.$searchText.'%')->get();
	}

	public function getMovieCategories()
	{
		return $this->category::all();
	}

	public function getCategory($id)
	{
		return $this->category->find($id);
	}

}