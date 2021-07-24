<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->user = $this->guard()->user();
    }

    public function getAllDepartment() {
        $data = Department::all();

        return response()->json([
            'status' => 'OK',
            'data' => $data
        ]);
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
