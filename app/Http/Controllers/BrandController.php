<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandController extends Controller
{
	public function brand()
	{
		$data = [
			'title' => env('APP_NAME') . ' | Manage Brand',
			'heading' => 'Manage Brand',
		];
		return inertia('Inventories/Brand', $data);
	}
}
