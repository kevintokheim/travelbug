<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		//Creates a table with an incrementing id, user id, friend id, and 
		//a boolean which tells whether the user has accepted a friend request or not
		
        Schema::create('friends', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('friend_id');
			$table->boolean('accepted');
			$table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('friends');
    }
}
