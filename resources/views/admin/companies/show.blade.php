@extends('layouts.admin')
@section('content')
<div class="well">
   @if(Auth::check())
   <div class="row">
      <div class="col-md-12">
         <a style="margin-right: 10px;" href="/admin/companies/{{ $company->id }}" class="btn btn-primary pull-left">
         View
         </a>
         <a style="margin-right: 10px;" href="/admin/companies/{{ $company->id }}/edit" class="btn btn-success pull-left">
         Edit
         </a>
         <div class="pull-left">
            <form method="POST" action="{{ route('companies.destroy', $company->id)}}">
               @csrf
               @method('DELETE')
               <button class="btn btn-danger" type="submit">Delete</button>
            </form>
         </div>
      </div>
   </div>
   @endif
   <br> 
   <div class="row">
      @if($company->logo)
      <div class="col-md-2">
         <img src="/storage/{{ $company->logo }}" alt="{{ $company->name . '_logo' }}" class="img-thumbnail rounded pull-left">
      </div>
      @endif
      <div class="col-md-10">
         <h3 style="margin-top: 0px;">
            <a href="/admin/companies/{{ $company->id }}">{{ $company->name }}</a>
         </h3>
         @if($company->email)
         <p>
            <b>Email:</b> {{ $company->email }}
         </p>
         @endif
         @if($company->website)
         <p>
            <b>Website:</b> {{ $company->website }}
         </p>
         @endif
      </div>
   </div>
   <br>
   @if(count($company->employees) > 0)
       <div class="emplyees">
           <h1>Employees</h1>
           <br>
          <div class="table-responsive">
             <table class="table table-bordered">
                <thead>
                   <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                   </tr>
                </thead>
                <tbody>
                   @foreach($company->employees as $employee) 
                   <tr>
                      <th scope="row">{{ $employee->id }}</th>
                      <td>{{ $employee->last_name }}, {{ $employee->first_name }}</td>
                      <td>{{ $employee->email }}</td>
                      <td>{{ $employee->phone }}</td>
                   </tr>
                   @endforeach
                </tbody>
             </table>
          </div>
       </div>
   @endif
</div>
@if(Auth::check())
   <a href="/admin/companies" class="btn btn-default">Go back to companies</a>
@else
   <a href="/companies" class="btn btn-default">Go back to companies</a>
@endif
@endsection