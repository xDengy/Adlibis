<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class PostsController extends Controller
{
	public function get()
	{
		return Post::orderBy('created_at', 'desc')->get();
		// Если нужна пагинация
		// return Post::orderBy('id', 'desc')->cursorPaginate(15);
	}
	
	public function find($id)
	{
		return Post::find($id);
	}
	
	public function create(Request $request)
	{
		try {
			$request->validate([
				'title' => 'required|string|max:255',
				'description' => 'required|string',
				'video' => 'required|file|mimes:mp4,mov,ogg,webm',
			]);
		} catch (Exception $exception) {
			return ['error' => $exception->getMessage()];
		}
		$arRequest = $request->all();
		
		$file = $request->file('video');
			
		$folder = time();
		Storage::disk('public')->put($folder, $file);
		$arRequest['attachment'] = $folder . '/' . $file->hashName();
		return Post::create($arRequest);
	}
}
