@extends('layouts.admin')

@section('title', 'Update Contact')
@section('index', 'Update Contact')


@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header rounded py-2 d-flex justify-content-between bg-info">
            <h6 class="m-0 font-weight-bold text-light mt-1">Contact Details</h6>
            <a href="{{ url('contact') }}" class="btn btn-warning btn-circle btn-sm" title="Back to Tag List">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="card-body text-lg-end text-center bg-image mt-2 rounded bg-primary ">
            @if ($contact?->photo == null || $contact?->photo == '')
                <img src="{{ url(Storage::url('public/contact/default2.png')) }}" alt="image"
                    class="image-fluid rounded-circle" height="110px">
            @else
                <img src="{{ url(Storage::url('public/contact/' . $contact->photo)) }}" class="image-fluid rounded-circle"
                    height="110px" alt="image">
            @endif
        </div>
        <div class="card-body">
            <table class="table table-responsive">

                <tr>
                    <th>Name</th>
                    <td>{{ $contact->name }}</td>
                </tr>
                <tr>
                    <th>Relation</th>
                    <td>{{ $contact->relation }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $contact->phone }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $contact->email }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
