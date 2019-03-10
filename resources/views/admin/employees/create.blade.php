@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h1>Edit employee</h1>
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
            <form method="POST" action="{{ route('employees.store') }}">
                @csrf
                <div class="form-group">
                    <label for="first_name">First name</label>
                    <input type="textfield" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}">
                </div>
                <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input type="textfield" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="phone" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                </div>

                <div class="form-group">
                    <label for="company_id">Company</label>
                    <select name="company_id" class="form-control">
                        <option value="">Select a company</option>
                        @foreach($companies as $company)
                            {{-- maybe should have used Form::select --}}
                            <option value="{{ $company['id'] }}" <?php print $company['id'] == old('company_id') ? 'selected' : '';?>>
                            {{ $company['name'] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>    
        </div>
    </div>
@endsection