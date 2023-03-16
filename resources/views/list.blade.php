@extends('layout');
@section('content')
<div class="container">
    <div class="text-center p-2">
        <h2 class="bold text-muted">Employees List</h2>
    </div>
    <div class=" text-center m-2">
        <a href="/create" class="btn btn-success">Add Employee</a>
        <a href="/upload" class="btn btn-info">Add Multiple</a>
        <a href="/export" class="btn btn-primary">Export to Excel</a>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>DOB</th>
                        <th>DOJ</th>
                        <th>Gender</th>
                        <th>Designation</th>
                        <th>Manager</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $emp)
                    <tr>
                        <td>{{ $emp->name }}</td>
                        <td>{{ $emp->email }}</td>
                        <td>{{ $emp->dob }}</td>
                        <td>{{ $emp->doj }}</td>
                        <td>{{ $emp->gender }}</td>
                        <td>{{ $emp->designation }}</td>
                        <td>{{ $emp->manager }}</td>
                        <td><form action="/delete_emp/{{ $emp->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-warning">Delete</button>
                        </form></td>
                    </tr>            
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    
@endsection