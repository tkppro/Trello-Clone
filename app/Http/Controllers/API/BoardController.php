<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Board;
use Illuminate\Http\Request;
use App\Http\Requests\CreateBoardRequest;
use Auth;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Auth::user()->boards()->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBoardRequest $request)
    {
        $board = Board::create([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
        ]);

        return response()->json([
            'message' => 'Board created successfully!',
            'data' => $board,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        $board = Board::with('tasks.cards')->findOrFail($board->id);
        
        return response()->json($board, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(CreateBoardRequest $request, Board $board)
    {
        if ($board->user_id != auth()->user()->id) {
            return response()->json('Unauthorized!', 401);
        }
      
        $board->update($request->all());
        
        return response()->json([
            'message' => 'Board updated successfully!',
            'data' => $board,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board)
    {
        if ($board->user_id != auth()->user()->id) {
            return response()->json('Unauthorized!', 401);
        }
      
        $board->delete();
        
        return response()->json('Deleted board!', 200);
    }
}
