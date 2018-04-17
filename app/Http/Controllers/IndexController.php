<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class IndexController extends Controller
{
    /**
     * Shows the index
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
      return view('pages.index');
    }

}
