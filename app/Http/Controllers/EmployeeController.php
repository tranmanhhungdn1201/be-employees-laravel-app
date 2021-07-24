<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->user = $this->guard()->user();
    }

    public function getAllEmployee() {
        $data = Employee::all();

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
