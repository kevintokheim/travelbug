<?php

namespace travelbug\Http\Controllers;

use Auth; 

use travelbug\Models\User;
use Illuminate\Http\Request;

class StatusController extends Controller
{
	//Handles validation and posting of a status
	public function postStatus(Request $request)
	{
		$this->validate($request, [
			'status' => 'required|max:1000',
		]);
		
		Auth::user()->statuses()->create([
			'body' => $request->input('status'),
		]);
		
		return redirect()->back()->with('info', 'status posted');
	}
}
