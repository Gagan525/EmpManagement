<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeesExport;

class AdminController extends Controller
{
    //
    public function login(Request $req)
    {
        $user = User::where(["email" => $req->email])->first();
        if(!$user || !Hash::check($req->password, $user->password))
        {
            return "Username or password not matched";
        }
        else{
            $req->session()->put('admin', $user);
            return redirect('/list');
        }
    }

    public function logout(Request $req)
    {
        Auth::logout();

        $req->session()->invalidate();

        $req->session()->regenerateToken();

        return redirect('/');
    }

    public function empList()
    {
        $empList = Employee::all();
        return view("/list", ["data" => $empList]);
    }

    public function deleteEmp($id)
    {
        $row = Employee::findOrFail($id);
        $row->delete();
        return redirect('/list')->with('success', 'Employee deleted successfully');
    }

    public function downloadEmpAsExcel() {
        return Excel::download(new EmployeesExport, 'data.xlsx');
    }

}
