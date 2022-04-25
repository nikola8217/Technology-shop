<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function getComments($id) {
        $data = Comment::getComments($id);
    
        return response()->json($data);
    }

    public function comment(Request $request) {
        $kom = $request->kom;
        $pro_id = $request->pro_id;

        $check = Auth::check();

        if(!$check) {
            return redirect('/login');
        }

        else if(empty($kom)) {
            return response()->json(['error'=>'Unesite komentar!']);
        }

        else {
            Comment::createComment($pro_id, $kom);

            return response()->json([
                'success'=>'Ostavili ste komentar!'
            ]);
        }


    }

    public function deleteComment($id) {
        $check = Comment::where([
            ['id', '=', $id],
            ['user_id', '=', auth()->user()->id]
        ])->first();

        if(!$check) {
            return response()->json(['error'=>'Vi niste postavili ovaj komentar i ne možete ga obrisati!']);
        }

        else {
            Comment::where('id', $id)->delete();

            return response()->json([
                'success'=>'Komentar je obrisan!'
            ]);
        }
    }
}
