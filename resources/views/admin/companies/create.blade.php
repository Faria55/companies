@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h1>Create company</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="textfield" class="form-control" id="name" name="name" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="logo">Company logo</label>
                    <input type="file" id="logo" name="logo">
                    <p class="help-block">Insrt company logo. Min. Dimension: 100x100</p>
                </div>

                <div class="form-group">
                    <label for="website">Company website</label>
                    <input type="website" class="form-control" id="website" name="website" value="{{ old('website') ?  old('website') : '' }}">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>    
        </div>
    </div>
@endsection