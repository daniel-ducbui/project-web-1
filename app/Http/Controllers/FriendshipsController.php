<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friendship;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Expr\Cast\String_;

class FriendshipsController extends Controller
{
    //
    public function befriend($name, $id)
    {
        $user = Auth::user();
        $request = Auth::user()->befriend($id);
//        dd($request);
        if ($request) {
            return redirect()->back()->with('message', $request);
        }
    }
}
