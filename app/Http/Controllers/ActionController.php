<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Action;

class ActionController extends Controller
{
    public function getActions() {
        $actions = Action::getActions();

        return response()->json([
            'actions' => $actions
            
        ]);
    }
}
