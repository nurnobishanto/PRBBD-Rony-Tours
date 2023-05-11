@extends('adminlte::page')

@section('title', 'View Expense Categories')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>View Expense Categories - {{$expenseCat->name}}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.expense-categories.index')}}">Expense Categories</a></li>
                <li class="breadcrumb-item active">Update Expense Categories</li>
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
                                <input name="name" value="{{$expenseCat->name}}" type="text" disabled required class="form-control" id="name" placeholder="Enter Expense Categories Name">
                            </div>
                        </div>
                    </div>



                        <form action="{{ route('admin.expense-categories.destroy', $expenseCat->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <a href="{{route('admin.expense-categories.index')}}" class="btn btn-success" >Go Back</a>
                            @can('expense_category.update')
                                <a href="{{route('admin.expense-categories.edit',['expense_category'=>$expenseCat->id])}}" class="btn btn-warning "><i class="fa fa-pen"></i> Edit</a>
                            @endcan
                            @can('expense_category.delete')
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
