@extends('layouts.admin')

@section('title', 'Dashboard')
@section('index', 'Dashboard')
@section('content')
    <div class="row">
        @include('partial.flash')
        @include('partial.error')


        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Contact</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Favourite List</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Block List</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Trash List</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-header rounded py-2 d-flex justify-content-between bg-info">
        <h6 class="m-0 font-weight-bold text-light mt-2">Add Contact</h6>
        <a href="{{ url('/contact/create') }}" class="btn btn-success btn-circle btn-sm" title="Add Contact">
            <i class="fa-solid fa-address-book"></i>
        </a>
    </div>

    <div class="card-body">
        @foreach ($bookmark as $cont)
        <table class="table table-hover my-0">
            <thead>
                {{-- sum Contact --}}
                <tr>
                    <th colspan="5">
                        <h5 class="font-weight-bold tex-info">Bookmark: ({{ $bookmark->count() }})</h5>
                    </th>
            </thead>
            <tbody>
               
                    <tr>
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
                        <td class="d-none d-xl-table-cell">{{ $cont->phone }}</td>
                        <td class="d-none d-xl-table-cell">{{ $cont->email }}</td>
                        <td class="d-flex justify-content-between" width="120px">
                            {{-- bookmark --}}
                            <a href="{{ url('contact/' . $cont->id . '/bookmark') }}"
                                class="btn btn-info btn-circle btn-sm fav" title="Favourite">
                                <i class="fas fa-star"></i>
                            </a>

                        </td>
                    </tr>
            </tbody>
            @endforeach
        </table>
    </div>

    <div class="card mb-4">
        
        @if ($contacts->count() > 0)
            
       
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
                    @foreach ($contacts as $cont)
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
           <li class="btn btn-warning">Contact list is empty</li>
        @endif
    </div>
    </div>
    </div>
@endsection
