@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h1>Departments</h1>
        </div>
        <div class="col-md-6">
            <a href="{{ route('departmentsCreate') }}" class="btn btn-dark mt-2 float-right">
                Create New Department
            </a>
        </div>
    </div>
   <div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Director</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departments as $dep)
                    <tr>
                        {{-- every time that we start a loop in laravel we get $loop->index --}}
                        <td>{{$loop->index + 1}}</td>
                        <td>{{$dep->name}}</td>
                        <td>{{$dep->director_id}}</td>
                        <td>
                            <a href="{{route('departmentsEdit' , $dep->id)}}" class="btn btn-submit">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
   </div>
@endsection