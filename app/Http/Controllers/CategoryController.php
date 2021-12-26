<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
	public function category()
	{
		$data = [
			'title' => env('APP_NAME') . ' | Manage Cateogry',
			'heading' => 'Manage Category',
		];
		return inertia('Inventories/Category', $data);
	}
}
