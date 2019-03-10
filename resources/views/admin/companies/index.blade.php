@extends('layouts.admin')
@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif    
    <h1>
        Companies
    </h1>
    <br>
    <br>
    @if(count($companies) > 0)
        @foreach($companies as $company)
            <div class="well">
                <div class="row">
                    @if($company->logo)
                        <div class="col-md-1">
                            <img style="width: 90px;" src="/storage/{{ $company->logo }}" alt="{{ $company->name . '_logo' }}" class="img-thumbnail rounded pull-left">
                        </div>
                    @endif
                    <div class="col-md-11">
                        <h3 style="margin-top: 0px;">
                            @if(Auth::check())
                                <a href="/admin/companies/{{ $company->id }}">{{ $company->name }}</a>
                            @else
                                <a href="/companies/{{ $company->id }}">{{ $company->name }}</a>
                            @endif
                        </h3>
                        @if($company->email)
                        <p>
                            <b>Email:</b> 
                            {{ $company->email }}
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
            </div>
            
        @endforeach

        {{ $companies->links() }}
            
    @else
        <p>No companies added</p>
    @endif
@endsection
