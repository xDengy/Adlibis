<?php

namespace App\Http\Controllers;

use App\Models\PostsComment;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class PostCommentsController extends Controller
{
	public function get()
	{
		return PostsComment::orderBy('id', 'desc')->cursorPaginate(15);
	}
	
	public function create($id, Request $request)
	{
		try {
			$request->validate([
				'text' => 'required|string',
			]);
		} catch (Exception $exception) {
			return ['error' => $exception->getMessage()];
		}
		$arRequest = $request->all();
		
		$arRequest['post_id'] = $id;
		return PostsComment::create($arRequest);
	}
	
	public function update($id, $commentId, Request $request)
	{
		try {
			$request->validate([
				'text' => 'required|string',
			]);
		} catch (Exception $exception) {
			return ['error' => $exception->getMessage()];
		}
		$arRequest = $request->all();
		
		$comment = PostsComment::find($commentId);
		if ($comment) {
			foreach ($arRequest as $key => $value) {
				$comment[$key] = $value;
			}
			$comment->save();
		}
		return $comment;
	}
	
	public function delete($id, $commentId)
	{
		$result = ['status' => 'error'];
		$comment = PostsComment::find($commentId);
		if ($comment) {
			$comment->delete();
			$result['status'] = 'success';
		}
		return $result;
	}
}
