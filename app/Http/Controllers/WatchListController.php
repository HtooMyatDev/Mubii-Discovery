<?php

namespace App\Http\Controllers;

use App\Models\WatchList;
use Illuminate\Http\Request;

class WatchListController extends Controller
{
    public function toggle(Request $request)
    {
        if ($request->add) {
            $data = $this->add($request);
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        }
        //  else {
        //     $this->remove($request);
        // }
    }

    public function add($request)
    {
        $data = WatchList::create([
            'user_id' => $request->userId,
            'movie_id' => $request->movieId,
        ]);
        logger($data);

        return $data;
    }

    public function remove($request) {}
}
