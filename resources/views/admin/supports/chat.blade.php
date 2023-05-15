@extends('adminlte::page')

@section('title', 'Support Tickets')

@section('content_header')
    <h1 class="ml-2">Support Ticket - </h1>
    <div class="d-flex justify-content-center">
        <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Support Ticket</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card card-primary card-outline direct-chat direct-chat-primary">
                            <div class="card-header">
                                <h3 class="card-title">Support Chat</h3>
                                <div class="card-tools">
                                    @if($support->status)
                                    <a href="{{route('admin.chat_end',['id'=>$support->id])}}" class="btn btn-danger">
                                        close
                                    </a>
                                    @else
                                        <a href="{{route('admin.chat_open',['id'=>$support->id])}}" class="btn btn-info">
                                            open
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="direct-chat-messages">

                                    @foreach($chats as $chat)
                                    @if($chat->sender == 1)
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-left">{{$support->user->name}}</span>
                                            <span class="direct-chat-timestamp float-right">{{$support->updated_at}}</span>
                                        </div>
                                        <img class="direct-chat-img" src="{{asset('/vendor/adminlte/dist/img/AdminLTELogo.png')}}" alt="Message User Image">
                                        <div class="direct-chat-text">
                                            {{$chat->body}}
                                        </div>
                                    </div>
                                    @else
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-right">Admin</span>
                                            <span class="direct-chat-timestamp float-left">{{$support->updated_at}}</span>
                                        </div>
                                        <img class="direct-chat-img" src="{{asset('/vendor/adminlte/dist/img/AdminLTELogo.png')}}" alt="Message User Image">
                                        <div class="direct-chat-text">
                                            {{$chat->body}}
                                        </div>

                                    </div>
                                    @endif
                                    @endforeach

                                </div>

                            </div>
                            <div class="card-footer">
                                @if($support->status)
                                <form action="{{route('admin.chat_send',['id'=>$support->id])}}" method="post">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" name="msg" placeholder="Type Message ..." class="form-control">
                                        <span class="input-group-append">
                      <button type="submit" class="btn btn-primary">Send</button>
                    </span>
                                    </div>
                                </form>
                                @else
                                    <p class="text-danger text-center border">This Support is closed</p>
                                @endif
                            </div>
                            <!-- /.card-footer-->
                        </div>
                     </div>
                </div>
        </div>
    </div>
@stop



@section('css')

@stop

@section('js')


@stop
