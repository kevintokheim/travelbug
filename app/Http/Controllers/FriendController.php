<?php

namespace travelbug\Http\Controllers;

use Auth;
use travelbug\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
	public function getIndex()
	{
		$friends = Auth::user()->friends();
		$requests = Auth::user()->friendRequests();
		return view('friends.index')->with('friends', $friends)->with('requests', $requests);
	}
	 
	//Method for adding a friend
	public function getAdd($username)
	{
		$user = User::where('username', $username)->first();
		
		if(!$user){
			return redirect()->route('home')->with('info', 'That user could not be found.');
		}
		
		//Checks to see if a user has a friend request pending
		if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())){
			return redirect()->route('profile.index', ['username' => $user->username])->with('info', 'Friend request already pending.');
		}
		
		//Checks to see if two users are already friends
		if(Auth::user()->isFriendsWith($user)){
			return redirect()->route('profile.index', ['username' => $user->username])->with('info', 'You are already friends.');
		}
		
		Auth::user()->addFriend($user);
		
		return redirect()->route('profile.index', ['username' => $username])->with('info', 'Friend Request sent.');
	}
	
	public function getAccept($username)
	{
		$user = User::where('username', $username)->first();
		
		if(!$user){
			return redirect()->route('home')->with('info', 'That user could not be found.');
		}
		
		if(!Auth::user()->hasFriendRequestReceived($user)){
			return redirect()->route('home');
		}
		
		Auth::user()->acceptFriendRequest($user);
		
		return redirect()->back()->with('info', 'Friend request accepted.');
		
		//return redirect()->route('profile.index', ['username' => $username])->with('info', 'Friend request accepted.');
		
		//dd($username);
	}
}
