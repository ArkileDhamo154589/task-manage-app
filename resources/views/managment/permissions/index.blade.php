@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-md-6">
                <h5 class="text-light">Permissions</h5>
            </div>
            <div class="col-md-6">
                @can('permissions-create')
                <a href="{{ route('permissionsCreate') }}" class="btn btn-success  float-right">
                    Create New permission
                </a>
                @endcan
            </div>
        </div> 
    </div>
    <div class="card-body">
        <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            @canany(['permissions-update', 'permissions-delete'])
                            <th>Actions</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $per)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$per->name}}</td>
                            <td>{{$per->display_name}}</td>
                            <td>{{$per->description}}</td>
                            @canany(['permissions-update', 'permissions-delete'])
                                <td>
                                    @can('roles-update')
                                    <div class="float-left mx-1">
                                        <a href="{{route('permissionsEdit' , $per->id)}}" class="btn btn-success ">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    @endcan
                                    @can('permissions-update')
                                    <div class="float-left mx-1">
                                        <form action="{{ route('permissionDelete', $per->id)}}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    @endcan
                                </td>
                                @endcanany
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
       </div>
    </div>
</div>

@endsection