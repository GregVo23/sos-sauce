<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of all categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Category::orderBy('name')->get());
    }
}
