<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        return response()->json(Activity::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateActivityRequest $request)
    {
        $comment = Activity::create($request->all());

        return response()->json('Activity created successfully!', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity, $ownerId)
    {
        if ($activity->board()->user_id != $ownerId) {
            return response()->json('Unauthorized', 401);
        }

        $activity->delete();
        return response()->json('Activity deleted!', 200);
    }
}
