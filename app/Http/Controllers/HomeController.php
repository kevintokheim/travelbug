<?php

namespace travelbug\Http\Controllers;

use Auth;
use travelbug\Models\Status;	

class HomeController extends Controller
{
	public function index()
	{
		if (Auth::check()){
			$statuses = Status::where(function($query){
				return $query->where('user_id', Auth::user()->id);
			})->orderBy('created_at', 'desc')->paginate(10);
			
			return view('timeline.index')->with('statuses', $statuses);
		}
		
		return view('home');
	}
}
