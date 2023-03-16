<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'doj' => 'required|date',
            'gender' => 'required|string|in:male,female',
            'designation' => 'required|string|max:255',
            'manager' => 'required|string|max:255',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required|string|min:8|confirmed',
            'email' => 'required|string|email|max:255|unique:employees',
        ]);
        
        $picture = $request->file('picture');
        $pictureName = time() . '.' . $picture->extension();
        $picture->move(public_path('images'), $pictureName);

        $employee = new Employee;
        $employee->name = $request->input('name');
        $employee->dob = $request->input('dob');
        $employee->doj = $request->input('doj');
        $employee->gender = $request->input('gender');
        $employee->designation = $request->input('designation');
        $employee->manager = $request->input('manager');
        $employee->picture = $pictureName;
        $employee->password = Hash::make($request->input('password'));
        $employee->email = $request->input('email');
        if($employee->save()){
            return redirect()->route('employees.create')->with('success', 'Employee registered successfully.');
        }
        else{
            return redirect()->route('employees.create')->with('failed', 'Employee registered unsuccessfully.');
        }
    
    }

    public function upload()
    {
        return view('employees.upload');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls',
        ]);

        $file = $request->file('file');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('files'), $filename);

        $rows = \Excel::toCollection(null, public_path('files/' . $filename));
        // echo '<pre>';
        // print_r($rows);

        foreach ($rows[0] as $key => $row) {
            if ($key != 0) {
                $employee = new Employee;
                $employee->name = $row[0];
                $employee->dob = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1])->format('Y-m-d');
                $employee->doj = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2])->format('Y-m-d');
                $employee->gender = $row[3];
                $employee->designation = $row[4];
                $employee->manager = $row[5];
                $employee->picture = 'default.png';
                $employee->password = Hash::make('password');
                $employee->email = $row[6];
                $employee->save();
            }
        }

        return redirect()->route('employees.upload')->with('success', 'Employees imported successfully.');
    }

    public function login(Request $req){
        if (preg_match("/^[a-zA-Z0-9._%+-]+@gmail\.com$/", $req->email)) {
            $emp = Employee::where(["email" => $req->email])->first();
            if(!$emp || !Hash::check($req->password, $emp->password))
            {
                return redirect()->route('employees.login')->with('failed', 'Username or Password not matched!');
            }
            else{
                $req->session()->put('employee', $emp);
                // return view('employees.gmail.inbox');
                return redirect()->route("employees.gmail.auth");
            }
        }else{
            return redirect()->route('employees.login')->with('failed', 'Login with Gmail Id!');
        }
    }

    public function logout(Request $req)
    {
        Auth::logout();

        $req->session()->invalidate();

        $req->session()->regenerateToken();

        return redirect('employee/login');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
