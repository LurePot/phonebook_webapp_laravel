@extends('layouts.admin')

@section('title', 'Add Contact')
@section('index', 'Add Contact')
@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header rounded py-2 d-flex justify-content-between bg-info">
            <h6 class="m-0 font-weight-bold text-light mt-2">Add Contact</h6>
            <a href="{{ url('dashboard') }}" class="btn btn-warning btn-circle btn-sm" title="Back to Tag List">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="card-body">
            {{ Form::open(['route' => ['contact.store'], 'class' => 'user', 'enctype' => 'multipart/form-data']) }}
            @include('partial.flash')
            @include('partial.error')

            <div class="form-group pb-3">
                {!! Form::label('name', 'Name', ['class' => 'form-label required']) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name']) !!}
            </div>
            <div class="form-group pb-3">
                {!! Form::label('relation', 'Relation', ['class' => 'form-label']) !!}
                {!! Form::text('relation', null, ['class' => 'form-control', 'id' => 'relation', 'placeholder' => 'Relation']) !!}
            </div>
            <div class="form-group pb-3">
                {!! Form::label('phone', 'Phone', ['class' => 'form-label required']) !!}
                {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Phone']) !!}
            </div>
            <div class="form-group pb-3">
                {!! Form::label('email', 'Email', ['class' => 'form-label required']) !!}
                {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) !!}
            </div>
            <div class="form-group pb-3">
                {!! Form::label('photo', 'Photo', ['class' => 'form-label required']) !!}
                {{-- {!! Form::file('photo', null, ['required','class' => 'form-control', 'id' => 'photo']) !!} --}}
                <input class="form-control" name="photo" id="photo" type="file">
            </div>

             

            <div class="form-group">
                {!! Form::submit('Add Contact', ['class' => 'btn btn-info btn-block']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
