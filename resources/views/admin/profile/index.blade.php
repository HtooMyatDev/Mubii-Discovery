@extends('admin.layouts.profileLayout')

@section('title')
    <title>
        Admin Profile Details
    </title>
@endsection

@section('content')
    <div class="text-primary fw-bold fs-4 mb-2">My Profile</div>
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-2">
                    <img src="{{ asset(Auth::user()->profile == null ? 'admin/img/avatar/avatar-illustrated-02.png' : 'admin/profile/' . Auth::user()->profile) }}"
                        class="border border-5 border-primary border-opacity-10 rounded-circle img-fluid output"
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
            <div class="row"></div>
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
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2" href=""
                    class="btn btn-outline-danger"> <span>Edit</span> <i class="fa-solid fa-pen"
                        style="font-size: 15px"></i></button>

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

    {{-- Personal Modal --}}
    <form action="{{ route('admin#profile#edit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="personal" name="status">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Edit Personal Information</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row my-2">
                            <div class="col w-100">
                                <label for="" class="text-secondary">Profile Picture</label>
                                <div class="row d-flext align-items-center">
                                    <div class="col-2">
                                        <img src="{{ asset(Auth::user()->profile == null ? 'admin/img/avatar/avatar-illustrated-02.png' : 'admin/profile/' . Auth::user()->profile) }}"
                                            class="w-100 img-thumbnail output">
                                    </div>
                                    <div class="col-5">
                                        <input type="file" name="profile" class="btn btn-primary form-control"
                                            onchange="loadFile(event)">
                                        @error('profile')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="" class="text-secondary">First Name</label>
                                <input type="text" class="form-control" name="firstName"
                                    value="{{ old('firstName', $temp[0]) }}">
                                @error('firstName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="" class="text-secondary">Last Name</label>
                                <input type="text" class="form-control" name="lastName"
                                    value="{{ old('lastName', $temp[1]) }}">
                                @error('lastName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="" class="text-secondary">Email Address</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ old('email', Auth::user()->email) }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="" class="text-secondary">Date of Birth</label>
                                <input type="date" class="form-control" name="date_of_birth"
                                    value="{{ old('date_of_birth', Auth::user()->date_of_birth) }}">
                                @error('date_of_birth')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="" class="text-secondary">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control"
                                    value="{{ old('phone_number', Auth::user()->phone_number) }}">
                                @error('phone_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
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

    {{-- Address Modal --}}
    <form action="{{ route('admin#profile#edit') }}" method="POST">
        @csrf

        <input type="hidden" value="address" name="status">
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Edit Address Information</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row my-2">
                            <div class="col">
                                <label for="" class="text-secondary">Address</label>
                                <input type="text" class="form-control" name="address"
                                    value="{{ old('address', Auth::user()->address) }}">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="" class="text-secondary">City</label>
                                <input type="text" class="form-control" name="city"
                                    value="{{ old('city', Auth::user()->city) }}">
                                @error('city')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col">
                                <label for="" class="text-secondary">Postal Code</label>
                                <input type="text" name="postal_code" class="form-control"
                                    value="{{ old('postal_code', Auth::user()->postal_code) }}">
                                @error('postal_code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
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
