<?php

namespace App\Http\Controllers;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        return Review::with('user:id,name')->get();
    }

    public function store(Request $r)
    {
        $r->validate([
            'judul' => 'required',
            'isi' => 'required'
        ]);

        return Review::create([
            'judul' => $r->judul,
            'isi' => $r->isi,
            'user_id' => Auth::id()
        ]);
    }

    public function show($id)
    {
        $review = Review::with('user:id,name')->findOrFail($id);
        return response()->json($review);
    }

    public function like($id)
    {
        $review = Review::findOrFail($id);
        $review->likes += 1;
        $review->save();
        return response()->json(['message' => 'Liked']);
    }
}