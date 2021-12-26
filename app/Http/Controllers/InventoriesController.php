<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoriesController extends Controller
{
	public function inventories()
	{
		$data = [
			'title' => env('APP_NAME') . ' | Manage Inventory',
			'heading' => 'Manage Inventory'
		];
		return inertia('Inventories/Inventories', $data);
	}
}
