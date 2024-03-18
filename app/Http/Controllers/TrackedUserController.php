<?php

namespace App\Http\Controllers;

use App\Models\TrackedUser;
use Illuminate\View\View;

class TrackedUserController extends Controller
{

    public function index(): View
    {
        $users = TrackedUser::all();
        return view('user.index', ['users' => $users]);
    }

    public function show(TrackedUser $user): View{
        return view('user.show', ['user'=>$user]);
    }
}
