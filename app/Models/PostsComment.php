<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostsComment extends Model
{
	protected $fillable = [
		'text',
		'post_id'
	];
}
