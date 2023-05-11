@extends('adminlte::page')

@section('title', 'Create Expense Category')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Create Expense Category</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.expense-categories.index')}}">Expense Categories</a></li>
                <li class="breadcrumb-item active">Create Expense Category</li>
            </ol>

        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.expense-categories.store')}}" method="POST" enctype="multipart/form-data">
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
                                    <input name="name" class="form-control" id="name" type="text" placeholder="Enter Expense Category Name">
                                </div>
                            </div>
                        </div>
                        @can('expense_category.create')
                            <button class="btn btn-success" type="submit">Create</button>
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
