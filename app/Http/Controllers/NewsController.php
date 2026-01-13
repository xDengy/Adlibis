<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class NewsController extends Controller
{
	public function get()
	{
		return News::orderBy('created_at', 'desc')->get();
		// Если нужна пагинация
		// return News::orderBy('id', 'desc')->cursorPaginate(15);
	}
	
	public function find($id)
	{
		return News::find($id);
	}
	
	public function create(Request $request)
	{
		try {
			$request->validate([
				'title' => 'required|string|max:255',
				'description' => 'required|string',
			]);
		} catch (Exception $exception) {
			return ['error' => $exception->getMessage()];
		}
		$arRequest = $request->all();
		
		return News::create($arRequest);
	}
}
