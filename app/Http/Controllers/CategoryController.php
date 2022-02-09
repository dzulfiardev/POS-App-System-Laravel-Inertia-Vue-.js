<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class CategoryController extends Controller
{
	public function category()
	{
		request()->validate([
			'search'		=> ['nullable'],
			'direction' => ['nullable', 'in:asc,desc'],
			'field' 		=> ['nullable', 'in:category_code,category_name']
		]);

		$query = Category::query();

		if (request('search')) {
			$query->where('category_name', 'LIKE', '%' . request('search') . '%')
				->orWhere('category_code', 'LIKE', '%' . request('search') . '%');
		}

		if (request('field') && request('direction')) {
			if (request()->has(['field', 'direction'])) {
				$query->orderBy(request('field'), request('direction'));
			}
		}

		return Inertia::render('Inventories/Category', [
			'title' 	=> env('APP_NAME') . ' | Manage Cateogry',
			'heading' => 'Manage Category',
			'data' 		=> $query->orderBy('id', 'desc')->paginate(8)->withPath('category')->appends(request()->all()),
			'filters' => request()->all(['search', 'field', 'direction']),
		]);
	}

	public function showSingle()
	{
		$id = request('id');
		return response(Category::where('id', $id)->first());
	}

	public function create(Request $request)
	{
		if ($request->action == 'edit') {
			$validationRules = 'required';
			$alertMessage = 'Success Update Data';
		} else {
			$validationRules = 'required|unique:categories';
			$alertMessage = 'Success Add New Data';
		}

		Validator::make($request->all(), [
			'category_code' => $validationRules,
			'category_name' => $validationRules,
		], [
			'required'	=> ':attribute is required',
			'unique'		=> ':attribute cannot be same an others'
		])->validate();

		Category::updateOrCreate(
			['id' => request('id')],
			[
				'category_code' => request('category_code'),
				'category_name' => request('category_name'),
			]
		);

		return Redirect::route('category')->with('message', $alertMessage);
	}

	public function destroy()
	{
		Category::destroy(request('id'));
		return Redirect::route('category')->with('message', 'Success Delete Data');
	}

	public function bulkDestroy()
	{
		Category::destroy(request('categoriesId')); //array

		return Redirect::route('category')->with('message', 'Success Delete ' . count(request('categoriesId')) . ' data');
	}

	public function testing()
	{
		return response(Category::where('id', 10)->first());
	}
}
