@extends('admin.layouts.profileLayout')

@section('title')
    <title>
        Admin Profile Details</title>
@endsection

@section('content')
    <div class="text-primary fw-bold fs-4 mb-2">My Profile</div>
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-2">
                    <img src="{{ asset('admin/img/avatar/avatar-illustrated-03.png') }}"
                        class="border border-5 border-primary border-opacity-10 rounded-circle img-fluid"
                        style="width: 150px">
                </div>
                <div class="col">
                    <div class="text-primary fs-3 mb-2 fw-bold">{{ Auth::user()->name }}</div>
                    <div class="  @if (Auth::user()->role == 'superadmin') text-primary @else text-secondary @endif">
                        {{ Auth::user()->role }}</div>
                    <div class="text-secondary">{{ Auth::user()->city }}, Myanmar</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card my-2">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center p-2">
                <div class="text-primary fs-5  fw-bold ">Personal Information</div>
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" href=""
                    class="btn btn-danger text-white"> <span>Edit</span> <i class="fa-solid fa-pen"
                        style="font-size: 15px"></i></button>
            </div>
        </div>
        @php
            $temp = explode(' ', Auth::user()->name, 2);
        @endphp
        <div class="card-body">
            <div class="row my-3">
                <div class="col-4 d-flex flex-column">
                    <span class="text-secondary">First Name</span>
                    <span>{{ $temp[0] }}</span>
                </div>
                <div class="col-4 d-flex flex-column">
                    <span class="text-secondary">Last Name</span>
                    <span>{{ $temp[1] }}</span>
                </div>
                <div class="col-4 d-flex flex-column">
                    <span class="text-secondary">Date of birth</span>
                    <span>{{ Auth::user()->date_of_birth }}</span>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-4 d-flex flex-column">
                    <span class="text-secondary">Email Address</span>
                    <span>{{ Auth::user()->email }}</span>
                </div>
                <div class="col-4 d-flex flex-column">
                    <span class="text-secondary">Phone Number</span>
                    <span>(+95){{ Auth::user()->phone_number }}</span>
                </div>
                <div class="col-4 d-flex flex-column">
                    <span class="text-secondary">Role</span>
                    <span>{{ Auth::user()->role }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center p-2">
                <div class="text-primary fs-5  fw-bold ">Address</div>
                <a href="" class="btn btn-outline-danger"> <span>Edit</span> <i class="fa-solid fa-pen"
                        style="font-size: 15px"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row my-3">
                <div class="col-4 d-flex flex-column">
                    <span class="text-secondary">Address</span>
                    <span>
                        @if (Auth::user()->address == null)
                            -
                        @else
                            {{ Auth::user()->address }}
                        @endif
                    </span>
                </div>
                <div class="col-4 d-flex flex-column">
                    <span class="text-secondary">City</span>
                    <span>
                        @if (Auth::user()->city == null)
                            -
                        @else
                            {{ Auth::user()->city }}
                        @endif
                    </span>
                </div>
                <div class="col-4 d-flex flex-column">
                    <span class="text-secondary">Postal Code</span>
                    <span>
                        @if (Auth::user()->postal_code == null)
                            -
                        @else
                            {{ Auth::user()->postal_code }}
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('admin#dashboard') }}" class="w-100 mt-2 btn btn-outline-primary">Back to dashboard</a>

    {{-- Modal --}}
    <form action="{{ route('admin#profile#edit') }}" method="POST">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Edit Personal Information</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row my-2">
                            <div class="col">
                                <label for="" class="text-secondary">First Name</label>
                                <input type="text" class="form-control" name="firstName"
                                    value="{{ old('firstName', $temp[0]) }}">
                            </div>
                            <div class="col">
                                <label for="" class="text-secondary">Last Name</label>
                                <input type="text" class="form-control" name="lastName"
                                    value="{{ old('lastName', $temp[1]) }}">
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="" class="text-secondary">Email Address</label>
                                <input type="text" class="form-control" name="email"
                                    value="{{ old('email', Auth::user()->email) }}">
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="" class="text-secondary">Date of Birth</label>
                                <input type="date" class="form-control" name="date_of_birth"
                                    value="{{ old('date_of_birth', Auth::user()->date_of_birth) }}">
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="" class="text-secondary">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control"
                                    value="{{ old('phone_number', Auth::user()->phone_number) }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
