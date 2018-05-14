<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Http\Request;

class boardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
       return Board::all();

    }

    public function show($boardId)
    {
       $board = Board::findOrFail($boardId);
       return $board;
    }

    public function store(Request $request)
    {
      Board::create([
      'name' => $request->name,
      'user_id'=> $request->user_id,
    ]);
    return response()->json(['message'=>'success'],200);
    }
    public function update(Request $request,$requestId)
    {
       $board = Board::find($requestId);
       $board->update($request->all());
        return response()->json(['message'=>'success','board'=>$board],200);

    }

    public function destory($id)
    {
       if(Board::destory($id)){
         return response()->json(['status'=>'success','message'=>'Board Delete Successfully']);
       }else{
         return response()->json(['status'=>'error','message'=>'Some want wrong'],200);
       }
    }
}
