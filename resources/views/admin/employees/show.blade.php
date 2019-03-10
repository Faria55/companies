@extends('layouts.admin')
@section('content')
<div class="well">
   @if(Auth::check())
   <div class="row">
      <div class="col-md-12">
         
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

   <br>

         
      
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
                
            
</div>
@if(Auth::check())
    <a href="/admin/employees" class="btn btn-default">Go back to employees</a>
@else
    <a href="/employees" class="btn btn-default">Go back to employees</a>
@endif
@endsection