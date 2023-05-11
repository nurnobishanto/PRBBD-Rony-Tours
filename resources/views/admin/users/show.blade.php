@extends('adminlte::page')

@section('title', 'View User')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>View User - {{$user->name}}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Users</a></li>
                <li class="breadcrumb-item active">Update User</li>
            </ol>

        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        @if (count($errors) > 0)
                            <div class = "alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="name" value="{{$user->name}}" type="text" disabled required class="form-control" id="name" placeholder="Enter User Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input name="name" value="{{$user->email}}" type="text" disabled required class="form-control" id="name" placeholder="Enter User Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{asset($user->photo)}}" alt="{{$user->name}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Roles</label>
                                @foreach($user->roles as $role)
                                    <span class="badge badge-success">{{$role->name}}</span>
                                @endforeach

                            </div>
                        </div>
                    </div>



                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <a href="{{route('admin.roles.index')}}" class="btn btn-success" >Go Back</a>
                            @can('roles.update')
                                <a href="{{route('admin.users.edit',['user'=>$user->id])}}" class="btn btn-warning "><i class="fa fa-pen"></i> Edit</a>
                            @endcan
                            @can('roles.delete')
                                <button onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                            @endcan
                        </form>

                </div>
            </div>
        </div>
    </div>
@stop
@section('toastr',true)
@section('css')

@stop

@section('js')
    <script>
        function checkSinglePermission(idName, className,inGroupCount,total,groupCount) {
            if($('.'+className+' input:checked').length === inGroupCount){
                $('#'+idName).prop('checked',true);
            }else {
                $('#'+idName).prop('checked',false);
            }
            if($('.permissions input:checked').length === total+groupCount){
                $('#select_all').prop('checked',true);
            }else {
                $('#select_all').prop('checked',false);
            }
        }

        function checkPermissionByGroup(idName, className,total,groupCount) {
            if($('#'+idName).is(':checked')){
                $('.'+className+' input').prop('checked',true);
            }else {
                $('.'+className+' input').prop('checked',false);
            }
            if($('.permissions input:checked').length === total+groupCount){
                $('#select_all').prop('checked',true);
            }else {
                $('#select_all').prop('checked',false);
            }
        }

        $('#select_all').click(function(event) {
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    </script>
@stop
