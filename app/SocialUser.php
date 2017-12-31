<?php namespace App;
use Illuminate\Database\Eloquent\Model;

class SocialUser extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'social_user';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['fullname', 'facebook_id'];
}
