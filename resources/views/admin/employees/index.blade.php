@extends('layouts.admin')
@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif   
<h1>
        Employees
    </h1>
    <br>
    <div class="row">
        
        <div class="col-md-12">
            <form id="employees" class="form-inline pull-left" method="get" action="{{ route('employees.index')}}">
                <div class="form-group">
                    <label for="company_id">Company</label>
                    <select class="form-control" name="company_id">
                        <option value="">Select a company</option>
                        @foreach($companies as $company)
                            {{-- maybe should have used Form::select --}}
                            <option value="{{ $company['id'] }}" <?php print $company['id'] == Request()->company_id ? 'selected' : '';?>>
                            {{ $company['name'] }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">First or last name</label>
                    <input type="textfield" class="form-control" id="name" name="name" value="{{ Request()->name }}">
                </div>
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
            <form class="pull-left" method="get" action="{{ route('employees.index')}}">
                <button class="btn btn-success" type="submit">Clear</button>
            </form>
        </div>
    </div>
    <br>
    @if(count($employees) > 0)
        @foreach($employees as $employee)
            <div class="well">
                <div class="row">
                    @if($employee->logo)
                        <div class="col-md-1">
                            <img style="width: 90px;" src="/storage/{{ $employee->logo }}" alt="{{ $employee->name . '_logo' }}" class="img-thumbnail rounded pull-left">
                        </div>
                    @endif
                    <div class="col-md-11">
                        <h3 style="margin-top: 0px;">
                           <a href="/admin/employees/{{ $employee->id }}">{{ $employee->first_name . ' ' . $employee->last_name }}</a>
                        </h3>
                        @if($employee->email)
                        <p>
                            <b>Email:</b> 
                            {{ $employee->email }}
                        </p>
                        @endif
                        @if($employee->phone)
                            <p>
                                <b>Phone:</b> {{ $employee->phone }}
                            </p>
                        @endif
                        @if($employee->company)
                            <p>
                                <b>Company:</b> {{ $employee->company->name }}
                            </p>
                        @endif
                    </div>
                </div>

                <br>
                @if(Auth::check())
                    <div class="row">
                        <div class="col-md-12">
                            <a style="margin-right: 10px;" href="/admin/employees/{{ $employee->id }}" class="btn btn-primary pull-left">
                                    View
                            </a>
                            <a style="margin-right: 10px;" href="/admin/employees/{{ $employee->id }}/edit" class="btn btn-success pull-left">
                                Edit
                            </a>
                            <div class="pull-left">
                                <form method="POST" action="{{ route('employees.destroy', $employee->id)}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            
        @endforeach

        {{ $employees->links() }}
            
    @else
        <p>No employees added</p>
    @endif
@endsection
