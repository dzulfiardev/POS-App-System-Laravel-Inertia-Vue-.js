<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use HasFactory;
	protected $guarded = [];
	protected $table = 'categories';
	protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'category_code',
		'category_name',
		'created_at',
		'updated_at',
	];
}
