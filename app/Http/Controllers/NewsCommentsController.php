<?php

namespace App\Http\Controllers;

use App\Models\NewsComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class NewsCommentsController extends Controller
{
    public function get()
    {
	    return NewsComment::orderBy('id', 'desc')->cursorPaginate(15);
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
	    
		$arRequest['news_id'] = $id;
	    return NewsComment::create($arRequest);
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
	    
		$comment = NewsComment::find($commentId);
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
	    $comment = NewsComment::find($commentId);
		if ($comment) {
			$comment->delete();
			$result['status'] = 'success';
		}
		return $result;
    }
}
