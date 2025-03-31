<?php
namespace App\Http\Controllers;

use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::orderBy("created_at", "desc")->paginate(10);
        return view("admin.review.index", compact("reviews"));
    }
}
