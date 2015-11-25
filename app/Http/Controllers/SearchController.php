<?php

namespace travelbug\Http\Controllers;

use DB;
use travelbug\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	public function getResults(Request $request)
	{
		//Search result
		$query = $request->input('query');
		
		//If no result turns up in the search, the user is redirected to the home page
		if (!$query) {
			return redirect()->route('home');
		}

		
		//Performs a raw DB query which compares the query to the first and last name of a user
		//or to the username.
		//There may be a better, faster and safer way to do this search
		$users = User::where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', "%{$query}%")->orWhere('username', 'LIKE', "%{$query}%")->get();
		
		//dd($users);
		
		return view('search.results')->with('users', $users);
	}
}
