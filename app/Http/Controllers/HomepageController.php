<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
   public function Home() {
    $categories = Category::with('courses')->get(); 
    
    return view('welcome', compact('categories'));
}
}
