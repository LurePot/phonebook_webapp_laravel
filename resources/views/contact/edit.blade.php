@extends('layouts.admin')

@section('title', 'Update Contact')
@section('index', 'Update Contact')

@section('content')
@include('partial.flash')
@include('partial.error')
    <div class="card card-hover shadow mb-4">
        <div class="card-header rounded py-2 d-flex justify-content-between bg-info">
            <h6 class="m-0 font-weight-bold text-light mt-1">Update Contact</h6>
            <a href="{{url('contact')}}" class="btn btn-warning btn-circle btn-sm" title="Back to Contact List">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>

       
        <div class="card-body text-lg-start text-center bg-image mt-2 rounded bg-success ">
            @if ($contact?->photo == null || $contact?->photo == '')
                <img src="{{ url(Storage::url('public/contact/default2.png')) }}" alt="image" class="image-fluid rounded-circle" height="110px">
            @else
                <img src="{{ url(Storage::url('public/contact/' . $contact->photo)) }}" class="image-fluid rounded-circle" height="110px" alt="image">
            @endif
        </div>
        <div class="card-body">
            {!! Form::model($contact, ['method' => 'put','enctype'=>'multipart/form-data','class'=>'user','route' => ['contact.update', $contact->id]]) !!}
            <div class="form-group row">
                <div class="col-sm-6 mt-2 mb-2 mb-sm-0">
                {!! Form::label('name', 'Full Name', ['class' => 'form-label']) !!}
                {!! Form::text('name', null, ['class' => 'form-control text-capitalize', 'id' => 'name', 'placeholder' => 'Name']) !!}
                </div>
                <div class="col-sm-6 mt-2">
                {!! Form::label('location', 'Location', ['class' => 'form-label']) !!}
                {!! Form::text('location', null, ['class' => 'form-control', 'id' => 'location', 'placeholder' => 'Gulshan, Dhaka, 1212']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mt-2 mb-2 mb-sm-0">
                {!! Form::label('phone', 'Phone', ['class' => 'form-label']) !!}
                {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Phone']) !!}
            </div>
            <div class="col-sm-6 mt-2">
                {!! Form::label('altph', 'Alternative Number', ['class' => 'form-label']) !!}
                {!! Form::text('altph', null, ['class' => 'form-control', 'id' => 'altph', 'placeholder' => 'Alternative']) !!}
            </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mt-2 mb-2 mb-sm-0">
                {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
                {!! Form::text('email', null, ['class' => 'form-control text-lowercase', 'id' => 'email', 'placeholder' => 'Email']) !!}
            </div>
            <div class="col-sm-6 mt-2">
                {!! Form::label('altml', 'Alternative Email', ['class' => 'form-label']) !!}
                {!! Form::text('altml', null, ['class' => 'form-control text-lowercase', 'id' => 'altml', 'placeholder' => 'Alternative']) !!}
            </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mt-2 mb-2 mb-sm-0">
                {!! Form::label('relation', 'Relation', ['class' => 'form-label']) !!}
                {!! Form::text('relation', null, ['class' => 'form-control', 'id' => 'relation', 'placeholder' => 'Relation']) !!}
            </div>
            <div class="col-sm-6 mt-2">
                {!! Form::label('photo', 'Photo', ['class' => 'form-label']) !!} <br>
                {{-- {!! Form::file('photo', null, ['required','class' => 'form-control form-control-lg', 'id' => 'photo']) !!} --}}
                <input class="form-control" name="photo" id="photo" type="file">
            </div>
          </div>
            <div class="form-group row mt-3">
                {!! Form::submit('Update Contact', ['class'=>'btn btn-lg btn-success btn-block text-light']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

