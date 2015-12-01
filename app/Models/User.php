<?php

namespace travelbug\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'username', 'password', 'first_name', 'last_name', 'location'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    //Gets the user's name
    public function getName()
    {
		if ($this->first_name && $this->last_name){
			return "{$this->first_name} {$this->last_name}";
		}
		
		if ($this->first_name){
			return $this->first_name;
		}
		
		return null;
	}
	
	// ?: = 'Or'
	//Gets either the user's name or their username
	public function getNameOrUsername()
	{
		return $this->getName() ?: $this->username;
	}
	
	//Gets either the user's first name or their username
	public function getFirstNameOrUsername()
	{
		return $this->first_name ?: $this->username;
	}
	
	//Gets a default avatar picture from gravatar.com
	public function getAvatarUrl()
	{
		return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?d=mm&s=70";
	}
	
	//Connects many statuses to a single user using a hasMany (or 'one-to-many') relationship
	//Connects a status to a user_id
	public function statuses()
	{
		return $this->hasMany('travelbug\Models\Status', 'user_id');
	}
	
	//Friends of mine
	public function friendsOfMine()
	{
		return $this->belongsToMany('travelbug\Models\User', 'friends', 'user_id', 'friend_id');
	}
	
	//Friends of my friends
	public function friendOf()
	{
		return $this->belongsToMany('travelbug\Models\User', 'friends', 'friend_id', 'user_id');
	}
	 
	//Method for joining two users with the friends table in the database
	//Displays a uses friends where the pivot table ('accepted') is equal to 1, or true.
	//The user who sends a friend request has their id stored in the user_id table,
	//whereas the user who is being requested has their id stored in the friend_id table.
	
	public function friends()
	{
		return $this->friendsOfMine()->wherePivot('accepted', true)->get()->merge($this->friendOf()->wherePivot('accepted', true)->get());
	}
	
	//Method for friend requesting. 
	//Displays on the user's profile friend requests that have not been accepted
	//where the other user is adding you.
	public function friendRequests()
	{
		return $this->friendsOfMine()->wherePivot('accepted', false)->get();
	}
	
	//Shows a user pending friend requests
	//When a user friend requests another user, that request is stored in the database,
	//but is not accepted until the 'accepted' column (the pivot) is turned to 1, or true.
	public function friendRequestsPending()
	{
		return $this->friendOf()->wherePivot('accepted', false)->get();
	}
	
	//Checks to see if a user has a friend request pending from another user
	//Checks a user's id against the id passed into the database
	public function hasFriendRequestPending(User $user)
	{
		return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
	}
	
	//Checks to see if you have received a friend request from a particular user
	public function hasFriendRequestReceived(User $user)
	{
		return (bool) $this->friendRequests()->where('id', $user->id)->count();
	}
	
	//Method for adding a friend
	public function addFriend(User $user) 
	{
		$this->friendOf()->attach($user->id);
	}
	
	//Method for accepting a friend request
	//Turns the pivot table/accepted column in friends database to 'true', or 1.
	public function acceptFriendRequest(User $user)
	{
		$this->friendRequests()->where('id', $user->id)->first()->pivot->update([
			'accepted' => true,
		]);
	}
	
	//Allows user to check if they are friends with another user
	//Uses friends method (which is essentially a list of friends) to check to see if 
	//a particular user is in their friends list
	public function isFriendsWith(User $user)
	{
		return (bool) $this->friends()->where('id', $user->id)->count();
	}
	
}









