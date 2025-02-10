@extends('layouts.app')

@section('title', 'Create')

@section('content')
    <div class="row justify-content-center">
        <div class="col-6 mx-auto">
            <form action="{{route('contacts.store')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="company" class="form-label">Company</label>
                    <input type="text" name="company" id="company" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control">
                </div>
                <div class="mb-5">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
@endsection