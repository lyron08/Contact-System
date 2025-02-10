@extends('layouts.app')

@section('title', 'Create')

@section('content')
    <div class="row justify-content-center">
        <div class="col-6 mx-auto">
            <form action="{{route('contacts.update', $contact->id)}}" method="post">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name', $contact->name)}}">
                </div>
                <div class="mb-3">
                    <label for="company" class="form-label">Company</label>
                    <input type="text" name="company" id="company" class="form-control" value="{{old('company', $contact->company_name)}}">
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{old('phone_number', $contact->phone_number)}}">
                </div>
                <div class="mb-5">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{old('email', $contact->company_email)}}">
                </div>

                <button type="submit" class="btn btn-warning">Update</button>
            </form>
        </div>
    </div>
@endsection