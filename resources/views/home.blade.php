@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1>Wellcome {{ Auth::user()->name }}</h1>
        <br>
        <a href="/admin/companies" class="btn btn-primary">View companies</a>
        <a href="/admin/employees" class="btn btn-primary">View employees</a>
    </div>
</div>
@endsection
