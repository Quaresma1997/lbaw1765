<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
	public static function getAll() {
		return DB::table('categories')->get();
	}
}
