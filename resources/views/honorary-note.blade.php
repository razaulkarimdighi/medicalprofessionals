@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-3">Details</h4>
                    </div>
                    <div class="table-responsive-sm">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>{{ $data->first_name }}</td>
                            <td>{{ $data->last_name }}</td>
                            <td>{{ $data->phone }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->location }}</td>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4>Honorary Note</h4>
                        @if ($data->honorary_note)
                        <div class="">
                            <iframe  width="100%" height="400" src="{{ asset('storage/honorary/'.$data->honorary_note) }}">Honorary Note</iframe>
                        </div>
                    @else
                        <h6 class="text-center">No Honorary Note available</h6>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
@push('style')
<style>

</style>
@endpush
{{-- src="{{ asset('storage/honorary/'.$data->honorary_note) }} --}}

