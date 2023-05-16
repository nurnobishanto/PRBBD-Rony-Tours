@extends('layouts.frontend')
@section('main_content')
<!-- Dashboard Area -->

<section id="dashboard_main_arae" class="section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                @include('frontend.user.partial.sidebar')
            </div>
            <div class="col-lg-8">
                <div class="dashboard_common_table">
                    <h3>Support <button onclick="createSupport()" class="btn pull-right btn-primary">Create New</button></h3>
                    <div class=" table-responsive-lg table_common_area" >
                        <table class="table " id="dataTable">
                            <thead>
                                <tr>
                                    <th>Sl no.</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($supports as $support)
                                <tr>
                                    <td>{{$support->id}}</td>
                                    <td>{{$support->support_department->name}}</td>
                                    <td class="complete">{{($support->status)?'OPEN':'CLOSED'}}</td>
                                    <td>
                                        <a href="{{route('user.support_chat',['id'=>$support->id])}}" ><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<script>
    function createSupport() {
        Swal.fire({
            title: '<strong>Create New <u>Support ticket</u></strong>',
            icon: 'question',
            html:
                '<form id="creatSupport" method="post" action="{{route('user.support_create')}}"> @csrf' +
                '<div class="form-group">'+
                '<select id="department"  class="form-control" name="support_department_id"> ' +
                '<option value="">Select support department</option>'+
                @foreach($departments as $dep)
                    '<option value="{{$dep->id}}">{{$dep->name}}</option>'+
                @endforeach
                    '</select>'+
                '</div>'+
                '<div class="form-group">'+
                '<input id="subject"  class="form-control mt-2" name="subject"> ' +
                '</div>'+
                '<div class="form-group mt-2">'+
                '<textarea id="msg" class="form-control" name="msg" placeholder="Enter message"></textarea>'+
                '</div>'+
                '</form>'
            ,
            showCloseButton: true,

            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText:"Submit"
        }).then((result) => {
            if (result.isConfirmed) {
                var dep = $('#department').val();
                var msg = $('#msg').val();
                if(dep.length >0 && msg.length>3){
                    $('#creatSupport').submit();
                }else {
                    alert('Department and Message required!')
                }

            }
        });
    }

    $(document).ready( function () {

        $('#dataTable').DataTable();
    } );
</script>
@endsection
