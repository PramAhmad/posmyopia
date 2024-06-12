<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(RoleDataTable $datatable)
    {
        return $datatable->render('role.index');
    }
}
