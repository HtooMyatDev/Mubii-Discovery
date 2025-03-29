@extends('admin.layouts.master')

@section('title')
    <title>
        Payment Methods Edit
    </title>
@endsection

@section('content')
    <h2 class="main-title">Edit Payment Information</h2>
    <div class="row">
        <div class="col-6 offset-3">
            <form action="{{ route('payment#update') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $data->id }}">
                <div class="card p-2">
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col">
                                <p class="text-secondary my-2">Payment Name</p>
                                <input type="text" name="paymentName"
                                    class="form-control border-primary border-opacity-50"
                                    placeholder="Enter account name..."
                                    value="{{ old('paymentName', $data->payment_name) }}">
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
                                    placeholder="Enter account number..."
                                    value="{{ old('paymentNumber', $data->payment_number) }}">
                                @error('paymentNumber')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col">
                                <p class="text-secondary my-2">Payment Method</p>
                                <select name="paymentMethod" class="form-select border-primary border-opacity-50">
                                    <option value="" selected disabled>Select Payment Method</option>
                                    @foreach (['KBZPay', 'AYAPay', 'KBZBank', 'WavePay', 'AYABank'] as $method)
                                        <option @if (old('paymentMethod', $data->payment_type) == $method) selected @endif
                                            value="{{ $method }}">{{ $method }}</option>
                                    @endforeach
                                </select>
                                @error('paymentMethod')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <a href="{{ route('payment#list') }}" class="btn btn-outline-danger w-100">cancel</a>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-outline-primary w-100">update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
