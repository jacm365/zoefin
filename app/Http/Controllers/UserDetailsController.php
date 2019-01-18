<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;

class UserDetailsController extends Controller
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

    /**
     * Get the formated user data.
     *
     * @return array
     */
    private function getUserData()
    {
        $user = Auth::user();
        $id = $user->id;
        $rawData = User::where('users.id', $id)
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->leftJoin('professions', 'users.profession_id', '=', 'professions.id')
            ->first();
        $userData = [
            'id' => '1',
            'name' => $rawData->first_name.' '.$rawData->last_name,
            'age' => $rawData->age,
            'gender' => ($rawData->gender=='M')?'Male':'Female',
            'zip' => $rawData->zip_code,
            'role' => $rawData->slug,
            'profession' => $rawData->profession
        ];
        return $userData;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('userdetails', $this->getUserData());
    }
}
