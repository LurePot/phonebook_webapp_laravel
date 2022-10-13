@extends('layouts.admin')

@section('title', 'Dashboard')
@section('index')
{{-- <h3 class="text-capitalize"> of {{ Auth::user()->name }}</h3> --}}
@endsection
@section('content')
    <div class="row">
        @include('partial.flash')
        @include('partial.error')


        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body"><h4> Total Contact : {{count($contacts)}}</h4> </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ url('/contact/') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body"><h4> Favorite List : {{count($bookmark)}}</h4></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ url('/favorite/') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body"><h4> Black List : {{ count($blacklist) }}</h4></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body"><h4>Trashed List : {{count($trashed)}}</h4></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-header rounded py-2 d-flex justify-content-between bg-info">
        <h5 class="m-0 font-weight-bold text-light mt-1"> Add Contact</h5>
        <a href="{{ url('/contact/create') }}" class="btn btn-success btn-circle btn-sm" title="Add Contact">
            <i class="fa-solid fa-address-book"></i>
        </a>
    </div>
{{-- ======================================================= --}}
{{-- bookmark --}}
<div class="card mb-4 mt-3">

    @if ($bookmark->count() > 0)


        <div class="card-header">
          <h4 class="text-success"><i class="fa fa-bookmark" aria-hidden="true"></i>
            Favorite Contact List</h4> 
        </div>
        <div class="card-body">
            <table class='table table-responsive'>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th class="d-none d-xl-table-cell">Relation</th>
                        <th>Number</th>
                        <th>Email</th>
                        <th class="d-none d-xl-table-cell">Contact ID</th>
                        <th>Action</th>
                    </tr>
                </thead>
               
                <tbody>
                    @foreach ($bookmark as $fav)
                        <tr>
                            <a href="{{ url('contact/' . $fav->id) }}"> <span>
                                    <td>

                                        @if ($fav?->photo == null || $fav?->photo == '')
                                            <img class="ms-0"
                                                src="{{ url(Storage::url('public/contact/default2.png')) }}"
                                                alt="{{ $fav?->name }}" width='30px'
                                                class="rounded-circle d-block float-start me-4 mt-2 mb-2">
                                        @else
                                            <img class="ms-0"
                                                src="{{ url(Storage::url('public/contact/' . $fav->photo)) }}"
                                                alt="{{ $user?->name }}" width='30px'
                                                class="border  border-success rounded-circle d-block float-start me-4 mt-2 mb-2">
                                        @endif

                                    </td>
                                    <td class="text-capitalize">{{ $fav->name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $fav->relation }}</td>
                                    <td>{{ $fav->phone }}</td>
                                    <td>{{ $fav->email }}</td>
                                    <td class="d-none d-xl-table-cell"><i class="fa fa-bookmark text-success"></i></td>
                                    
                                </span> </a>
                            <td class="d-flex justify-content-between align-self-center">
                                
                                {{-- {!! Form::open(['method' => 'delete', 'route' => ['favorite.destroy', $fav->id]]) !!} --}}
                                <form action="{{url('/destroy/'. $fav->id)}}" method="POST">
                                    @csrf
                                 {{-- {{DB::table('favorites')->where('con_id', $fav->id)->delete()}} --}}
                                <button onclick="return confirm('Are you sure?')"
                                    class="btn btn-danger btn-sm btn-circle me-1">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                                <a href="{{ url('favorite/' . $fav->id) }}" class="btn btn-info btn-circle btn-sm me-1"
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
        <li class="btn btn-warning text-info"> <h4>Your Favorite list is empty</h4></li>
    @endif
</div>
{{-- ======================================================= --}}
    <div class="card mb-5">

        @if ($contacts->count() > 0)


            <div class="card-header">
               <h4 class="text-primary"> <i class="fa fa-address-book" aria-hidden="true"></i>
               Your Contact List </h4>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th class="d-none d-xl-table-cell">Relation</th>
                            <th>Number</th>
                            <th class="d-none d-xl-table-cell">Email</th>
                            <th>Bookmark</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th class="d-none d-xl-table-cell">Relation</th>
                            <th>Number</th>
                            <th class="d-none d-xl-table-cell">Email</th>
                            <th>Bookmark</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($contacts as $con)
                            <tr>
                                <a href="{{ url('contact/' . $con->id) }}"> <span>
                                        <td>

                                            @if ($con?->photo == null || $con?->photo == '')
                                                <img class="ms-0"
                                                    src="{{ url(Storage::url('public/contact/default2.png')) }}"
                                                    alt="{{ $con?->name }}" width='30px'
                                                    class="rounded-circle d-block float-start me-4 mt-2 mb-2">
                                            @else
                                                <img class="ms-0"
                                                    src="{{ url(Storage::url('public/contact/' . $con->photo)) }}"
                                                    alt="{{ $user?->name }}" width='30px'
                                                    class="border  border-success rounded-circle d-block float-start me-4 mt-2 mb-2">
                                            @endif

                                        </td>
                                        <td class="text-capitalize">{{ $con->name }}</td>
                                        <td class="d-none d-xl-table-cell">{{ $con->relation }}</td>
                                        <td>{{ $con->phone }}</td>
                                        <td class="d-none d-xl-table-cell">{{ $con->email }}</td>
                                        <td>
                                            <form action="{{ url('favorite', $con->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-secondary"
                                                    data-bs-toggle="tooltip" title="Add To Favorite">
                                                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </span> </a>
                                <td class="d-flex justify-content-between align-self-center">
                                    {!! Form::open(['method' => 'delete', 'route' => ['contact.destroy', $con->id]]) !!}
                                    <button onclick="return confirm('Are you sure?')"
                                        class="btn btn-danger btn-sm btn-circle me-1">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    {!! Form::close() !!}
                                    <a href="{{ url('contact/' . $con->id . '/edit') }}"
                                        class="btn btn-primary btn-circle btn-sm me-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ url('contact/' . $con->id) }}" class="btn btn-info btn-circle btn-sm me-1"
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
            <li class="btn btn-warning text-danger"><h4>Your contact list is empty</h4></li>
        @endif
    </div>
    </div>
    </div>
@endsection
@section('script')
    <script>
        
       
    </script>
@endsection
