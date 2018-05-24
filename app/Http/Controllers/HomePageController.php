<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Category;
use App\User;

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
        if(Auth::user()->is_admin)
            return redirect('admin');
        
        $categories = Category::all();
      return view('pages.homepage', ['categories' => $categories]);
    }

}
