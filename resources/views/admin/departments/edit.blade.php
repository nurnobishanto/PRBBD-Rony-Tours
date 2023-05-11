@extends('adminlte::page')

@section('title', 'Update Expense category')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Update Expense category</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.expense-categories.index')}}">Expense Categories</a></li>
                <li class="breadcrumb-item active">Update Expense category</li>
            </ol>

        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.expense-categories.update',['expense_category'=>$expenseCat->id])}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
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
                                    <label for="name">Expense Category Name</label>
                                    <input name="name" value="{{$expenseCat->name}}" class="form-control" id="name" type="text" placeholder="Enter Expense Category Name">
                                </div>
                            </div>
                        </div>
                        @can('expense_category.update')
                            <button class="btn btn-success" type="submit">Update</button>
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

@stop
