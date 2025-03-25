@extends('admin.layouts.profileLayout')


@section('title')
    <title>
        Change Password Page
    </title>
@endsection

@section('content')
    <div class="text-primary fw-bold fs-4 mb-2">Change Account Password</div>
    <form action="{{ route('admin#profile#change-password') }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="password">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center my-3">
                    <div class="col d-flex flex-column">
                        <span class="text-secondary">Old Password</span>
                        <input type="text" class="form-control" name="oldPassword">
                        @error('oldPassword')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row align-items-center my-3">
                    <div class="col d-flex flex-column">
                        <span class="text-secondary">New Password</span>
                        <input type="password" class="form-control" name="newPassword">
                        @error('newPassword')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row align-items-center my-3">
                    <div class="col d-flex flex-column">
                        <span class="text-secondary">Renter New Password</span>
                        <input type="password" class="form-control" name="newPasswordConfirmation">
                        @error('newPasswordConfirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row align-items-center my-3">
                    <div class="col d-flex flex-column">
                        <button type="submit" class="form-control btn btn-outline-primary">Change Password</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
