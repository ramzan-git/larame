<?php

  

namespace App\Http\Controllers;

  

class PostController extends Controller

{

  

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function index()

    {

        return view('index');

    }

    public function func_me()
    {
        return "This is direct text from <strong>controller function</strong>
        <br> with out viw";

    }

    public function show($id)

    {

        return 'Post ID:'. $id;

    }


}