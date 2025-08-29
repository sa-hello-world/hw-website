<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    public function index(): View
    {
        abort_unless(Auth::user()->can('viewAny', User::class), 403);

        $users = User::orderBy('name')->paginate(15);
        $totalUserCount = User::count();
        $membersCount = User::all()->filter(function ($user) {
            return $user->is_member;
        })->count();
        $currentSchoolYear = SchoolYear::current();

        return view('board.users.index', compact('users', 'membersCount', 'currentSchoolYear', 'totalUserCount'));
    }
}
