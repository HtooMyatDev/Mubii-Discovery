@extends('admin.layouts.master')

@section('title')
    <title>
        Payment Methods
    </title>
@endsection

@section('content')
    <div class="row">
        <div class="col-4">
            <form action="" method="POST">
                <div class="card">
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col">
                                <p class="text-secondary my-2">Payment Name</p>
                                <input type="text" name="paymentName"
                                    class="form-control border-primary border-opacity-50"
                                    placeholder="Enter account name..." value="{{ old('paymentName') }}">
                                @error('paymentName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col">
                                <p class="text-secondary my-2">Payment Number</p>
                                <input type="number" name="paymentNumber"
                                    class="form-control border-primary border-opacity-50"
                                    placeholder="Enter account number..." value="{{ old('paymentNumber') }}">
                                @error('paymentName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col">
                                <p class="text-secondary my-2">Payment Method</p>
                                <select name="" id="" class="form-select border-primary border-opacity-50">
                                    <option value="" selected disabled>Select Payment Method</option>
                                    @foreach (['KBZPay', 'AYAPay', 'KBZBank', 'WavePay', 'AYABank'] as $method)
                                        <option value="{{ $method }}">{{ $method }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body"></div>
            </div>
        </div>
    </div>
@endsection
