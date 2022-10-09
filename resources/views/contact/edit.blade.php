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

       
        <div class="card-body text-end bg-image mt-2 rounded bg-success ">
            @if ($contact?->photo == null || $contact?->photo == '')
                <img src="{{ url(Storage::url('public/contact/default2.png')) }}" alt="image" class="image-fluid rounded-circle" height="110px">
            @else
                <img src="{{ url(Storage::url('public/contact/' . $contact->photo)) }}" class="image-fluid rounded-circle" height="110px" alt="image">
            @endif
        </div>
        <div class="card-body">
            {!! Form::model($contact, ['method' => 'put','enctype'=>'multipart/form-data','class'=>'user','route' => ['contact.update', $contact->id]]) !!}
            <div class="form-group pb-3">
                {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name']) !!}
            </div>
            <div class="form-group pb-3">
                {!! Form::label('relation', 'Relation', ['class' => 'form-label']) !!}
                {!! Form::text('relation', null, ['class' => 'form-control', 'id' => 'relation', 'placeholder' => 'Relation']) !!}
            </div>
            <div class="form-group pb-3">
                {!! Form::label('phone', 'Phone', ['class' => 'form-label']) !!}
                {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Phone']) !!}
            </div>
            <div class="form-group pb-3">
                {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
                {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) !!}
            </div>
            <div class="form-group pb-3">
                {!! Form::label('photo', 'Photo', ['class' => 'form-label']) !!}
                {!! Form::file('photo', null, ['required','class' => 'form-control', 'id' => 'photo']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update Contact', ['class'=>'btn btn-primary btn-block']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

