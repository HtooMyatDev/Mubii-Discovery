@extends('admin.layouts.master')

@section('title')
    <title>
        Payment Methods
    </title>
@endsection

@section('content')
    <div class="row">
        <div class="col-4">
            <form action="{{ route('payment#create') }}" method="POST">
                @csrf
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
                                        <option @if (old('paymentMethod') == $method) selected @endif
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
                                <button type="submit" class="btn btn-outline-primary w-100">create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col" class="text-primary">#</th>
                                <th scope="col" class="text-primary">Payment Name</th>
                                <th scope="col" class="text-primary">Payment Method</th>
                                <th scope="col" class="text-primary">Payment Number</th>
                                <th scope="col" class="text-primary">created_at</th>
                                <th scope="col" class="text-primary">updated_at</th>
                                <th scope="col" class="text-primary">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $payment)
                                <tr>
                                    <td scope="row">{{ $payment->id }}</td>
                                    <td>{{ $payment->payment_name }}</td>
                                    <td>{{ $payment->payment_type }}</td>
                                    <td>{{ $payment->payment_number }}</td>
                                    <td>{{ $payment->created_at }}</td>
                                    <td>{{ $payment->updated_at }}</td>
                                    <td class="d-flex justify-content-center align-items-center gap-2">
                                        <a href="" class="btn btn-sm btn-outline-primary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <a href="" class="btn btn-sm btn-outline-danger">
                                            <i class="fa-solid fa-trash "></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
