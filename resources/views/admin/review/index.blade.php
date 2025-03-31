@extends('admin.layouts.master')

@section('title')
    <title>Review List Page</title>
@endsection
@section('content')
    <h2 class="main-title">Review List</h2>
  <div class="card">
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Movie Name</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Reply to</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
  </div>
@endsection
