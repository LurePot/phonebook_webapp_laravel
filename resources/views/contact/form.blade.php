@include('partial.flash')
@include("partial.error")

<div class="form-group pb-3">
    {!! Form::label('name', 'Name', ['class' => 'form-label']); !!}
    {!! Form::text('name', null, [ 'class'=>'form-control', 'id'=>'name', 'placeholder'=>'Name']) !!}
</div>
<div class="form-group pb-3">
    {!! Form::label('phone', 'Phone', ['class' => 'form-label']); !!}
    {!! Form::text('phone', null, ['class'=>'form-control', 'id'=>'phone', 'placeholder'=>'Phone']) !!}
</div>
<div class="form-group pb-3">
    {!! Form::label('email', 'Email', ['class' => 'form-label']); !!}
    {!! Form::text('email', null, ['class'=>'form-control', 'id'=>'email', 'placeholder'=>'Email']) !!}
</div>
<div class="form-group pb-3">
    {!! Form::label('photo', 'Photo', ['class' => 'form-label']); !!}
    {!! Form::file('photo', ['class'=>'form-control', 'id'=>'Photo']) !!}
</div>
