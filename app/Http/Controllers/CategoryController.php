<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
	public function category()
	{
		request()->validate([
			'direction' => ['in:asc,desc'],
			'field' 		=> ['in:category_code,category_name']
		]);

		$query = Category::query();

		if (request('search')) {
			$query->where('category_name', 'LIKE', '%' . request('search') . '%')
				->orWhere('category_code', 'LIKE', '%' . request('search') . '%');
		}

		if (request()->has(['field', 'direction'])) {
			$query->orderBy(request('field'), request('direction'));
		}

		$data = [
			'title' => env('APP_NAME') . ' | Manage Cateogry',
			'heading' => 'Manage Category',
			'data' => $query->orderBy('id', 'desc')->paginate(8),
		];
		return inertia('Inventories/Category', $data);
	}

	public function create(Request $request)
	{
		Validator::make($request->all(), [
			'category_code' => 'required|unique:categories',
			'category_name' => 'required|unique:categories',
		], [
			'required' => ':attribute is required',
			'unique'	=> ':attribute cannot be same an others'
		])->validate();

		$store = [
			'category_code' => $request->category_code,
			'category_name' => $request->category_name,
		];

		Category::create($store);

		return Redirect::route('category');
	}

	public function testing()
	{
		return Category::orderByDesc('id')->paginate(8);
	}
}
