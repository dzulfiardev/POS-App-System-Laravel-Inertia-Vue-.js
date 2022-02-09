<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
	use HasFactory;

	protected $guarded = [];
	protected $table = 'brands';
	protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'brand_code',
		'brand_name',
		'created_at',
		'updated_at',
	];
}
