<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;

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

	public function showAll()
	{
		$query = Brand::query();

		if (request('search')) {
			$query->where('brand_name', 'LIKE', '%' . request('search') . '%')
				->orWhere('brand_code', 'LIKE', '%' . request('search') . '%');
		}

		if (request('field') && request('direction')) {
			if (request()->has(['field', 'direction'])) {
				$query->orderBy(request('field'), request('direction'));
			}
		}

		$data = [
			'success' => $query->orderBy('id', 'desc')->paginate(8),
		];

		return response($data, 201);
	}

	public function filter()
	{
		$query = Brand::query();

		if (request('search')) {
			$query->where('brand_name', 'LIKE', '%' . request('search') . '%')
				->orWhere('brand_code', 'LIKE', '%' . request('search') . '%');
		}

		if (request('field') && request('direction')) {
			if (request()->has(['field', 'direction'])) {
				$query->orderBy(request('field'), request('direction'));
			}
		}

		$data = [
			'success' => $query->orderBy('id', 'desc')->paginate(8),
		];

		return response($data, 201);
	}

	public function show($id)
	{
		$data = [
			'success' => Brand::find($id)
		];
		return response($data, 201);
	}

	public function create()
	{
		if (request('id')) {
			$brand = Brand::find(request('id'));
			if ($brand->brand_code == request('brand_code')) {
				$validCode = 'required|numeric';
			} else {
				$validCode = 'required|unique:brands|numeric';
			}
		} else {
			$validCode = 'required|unique:brands|numeric';
		}

		$validator = Validator::make(request()->all(), [
			'brand_code' => $validCode,
			'brand_name' => 'required|string'
		]);

		if ($validator->fails()) {
			$msg = [
				'error' => $validator->errors()
			];
			return response($msg, 422);
		}

		Brand::updateOrCreate(
			['id' => request('id')],
			[
				'brand_name' => request('brand_name'),
				'brand_code' => request('brand_code'),
			],
		);

		$actionText = "";
		if (request('id')) {
			$actionText = 'Update';
		} else {
			$actionText = 'Add';
		}

		$msg = [
			'success' => "Success $actionText New Brand"
		];

		return response($msg, 200);
	}

	public function destroy()
	{
		$brand = Brand::find(request('id'));

		Brand::destroy(request('id'));
		$msg = [
			'success' => "Success delete brand $brand->brand_name"
		];
		return response($msg, 201);
	}

	public function bulkDestroy()
	{
		Brand::destroy(request('id'));
		$msg = [
			'success' => "Success delete " . count(request('id')) . " brands"
		];

		return response($msg, 201);
	}
}
