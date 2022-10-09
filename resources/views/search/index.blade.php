@extends('layouts.admin')

@section('title', 'Search Results')
@section('index', 'Search Results')


@section('content')
    <div class="row">
        @include('partial.flash')
        @include('partial.error')
        <div class="card-header rounded py-2 d-flex justify-content-between bg-info">
            <h6 class="m-0 font-weight-bold text-light mt-2">Search List</h6>
            <a href="{{ url('/dashboard') }}" class="btn btn-success btn-circle btn-sm" title="Back To Dashboard">
                <i class="fa-solid fa-home"></i>
            </a>
        </div>

        
        <div class="card my-2 ">
            @if($contact->isNotEmpty())
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Contact Information
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Relation</th>
                            <th>Number</th>
                            <th>Email</th>
                            <th>Bookmark</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Relation</th>
                            <th>Number</th>
                            <th>Email</th>
                            <th>Bookmark</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($contact as $cont)
                            <tr>
                                <a href="{{ url('contact/' . $cont->id) }}"> <span>
                                        <td>
    
                                            @if ($cont?->photo == null || $cont?->photo == '')
                                                <img class="ms-0"
                                                    src="{{ url(Storage::url('public/contact/default2.png')) }}"
                                                    alt="{{ $cont?->name }}" width='30px'
                                                    class="rounded-circle d-block float-start me-4 mt-2 mb-2">
                                            @else
                                                <img class="ms-0"
                                                    src="{{ url(Storage::url('public/contact/' . $cont->photo)) }}"
                                                    alt="{{ $user?->name }}" width='30px'
                                                    class="border  border-success rounded-circle d-block float-start me-4 mt-2 mb-2">
                                            @endif
    
                                        </td>
                                        <td>{{ $cont->name }}</td>
                                        <td>{{ $cont->relation }}</td>
                                        <td>{{ $cont->phone }}</td>
                                        <td>{{ $cont->email }}</td>
                                        <td>
                                         
                                            <form ...>
                                                <input type="checkbox" name="favorites[]" id="fav1" value="1" />
                                                <label for="fav1">Favorite</label>
                                              </form>
    
                                        </td>
                                    </span> </a>
                                <td class="d-flex justify-content-between align-self-center">
                                    {!! Form::open(['method' => 'delete', 'route' => ['contact.destroy', $cont->id]]) !!}
                                    <button onclick="return confirm('Are you sure?')"
                                        class="btn btn-danger btn-sm btn-circle me-1">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    {!! Form::close() !!}
                                    <a href="{{ url('contact/' . $cont->id . '/edit') }}"
                                        class="btn btn-primary btn-circle btn-sm me-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ url('contact/' . $cont->id) }}" class="btn btn-primary btn-circle btn-sm me-1"
                                        title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
               <div class="btn btn-warning"><h3>No Results Match Your Search</h3></div>
            @endif
        </div>
    
    </div>
@endsection
