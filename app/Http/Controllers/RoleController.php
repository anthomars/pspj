<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getRole()
    {
        $role = Role::all();

        return response()->json([
            'status' => 'success',
            'data' => $role
        ]);
    }
}
