<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Category;

class HomePageController extends Controller
{
    /**
     * Shows the index
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        $categories = Category::getAll();
      return view('pages.homepage', ['categories' => $categories]);
    }

}
