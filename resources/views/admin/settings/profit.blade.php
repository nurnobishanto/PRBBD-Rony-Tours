@extends('adminlte::page')

@section('title', 'Profit Settings')

@section('content_header')
    <h1>Profit Settings</h1>
@stop

@section('content')
    <div class="col-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <h5 class="card-header">Profit Settings</h5>
            <div class="card-body">
                <form action="{{route('admin.update_settings')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="adult_service">Adult service charge</label>
                                <input name="adult_service" value="{{getSetting('adult_service')}}" id="adult_service" class="form-control" type="number" min="0" max="50" placeholder="Enter adult Service charge (%)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="child_service">Child service charge</label>
                                <input name="child_service" value="{{getSetting('child_service')}}" id="child_service" class="form-control" type="number" min="0" max="50" placeholder="Enter child Service charge (%)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="infant_service">Infant service charge</label>
                                <input name="infant_service" value="{{getSetting('infant_service')}}" id="infant_service" class="form-control" type="number" min="0" max="50" placeholder="Enter Infant Service charge (%)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="extra_service">Extra service charge</label>
                                <input name="extra_service" value="{{getSetting('extra_service')}}" id="extra_service" class="form-control" type="number" min="0"  placeholder="Extra Service charge (flat)">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_profit">User profit from fly hub discount</label>
                                <input name="user_profit" value="{{getSetting('user_profit')}}" id="user_profit" class="form-control" type="number" min="0"  placeholder="User profit from fly hub discount">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="agent_profit">Agent profit from fly hub discount</label>
                                <input name="agent_profit" value="{{getSetting('agent_profit')}}" id="agent_profit" class="form-control" type="number" min="0"  placeholder="Agent profit from fly hub discount">
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Save" class="btn btn-success">
                </form>
            </div>

        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
