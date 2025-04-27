<?php

namespace App\Http\Controllers;

use App\Models\WatchList;
use Illuminate\Http\Request;

class WatchListController extends Controller
{
    public function toggle(Request $request)
    {
        if ($request->add) {
            $this->add($request);
        } else {
            $this->remove($request);
        }

        $data = WatchList::get();
        return response()->json([
            'status' => true,
            'list' => $data
        ]);
    }

    public function isAdded($userId)
    {
        $isAdded = WatchList::where('user_id', $userId)->where('movie_id', $movieId)->first();
        return response()->json([
            'status' => true,
            'isAdded' => $isAdded
        ]);
    }

    public function add($request)
    {
        WatchList::create([
            'user_id' => $request->userId,
            'movie_id' => $request->movieId,
        ]);
    }

    public function remove($request)
    {
        WatchList::where('user_id', $request->userId)
            ->where('movie_id', $request->movieId)
            ->delete();
    }
}
