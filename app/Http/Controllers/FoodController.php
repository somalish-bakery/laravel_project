<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    // For the Home Page (Image 2, 3, 4)
    public function index() {
        // Get only the "Popular" items for the home page slider
        $featuredDishes = Food::where('is_popular', true)->take(3)->get();
        return view('home', compact('featuredDishes'));
    }

    // For the Full Menu Page (Image 5)
    public function menu(Request $request) {
        $category = $request->query('category', 'All');
        
        if ($category == 'All') {
            $foods = Food::all();
        } else {
            $foods = Food::where('category', $category)->get();
        }

        return view('menu', compact('foods'));
    }
}