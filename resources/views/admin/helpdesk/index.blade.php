@extends('admin.layouts.admin')

@section('page_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g==" crossorigin="anonymous" />
    <style>
        .ft-trash{
            color: red;
        }
        .delete{
            border: none;
            background: none;
            padding: 0px;
            margin: 0px;
        }
        .menu_active{
            border: none;
            background: none;
            padding: 0px;
            margin: 0px;
            display: none;
            color: #1c96d3;
        }
        .menu_inactive{
            color: #f02626;
            border: none;
            background: none;
            padding: 0px;
            margin: 0px;
            display: none;
        }
        .child_active{
            border: none;
            background: none;
            padding: 0px;
            margin: 0px;
            display: none;
            color: #1c96d3;
        }
        .child_inactive{
            color: #f02626;
            border: none;
            background: none;
            padding: 0px;
            margin: 0px;
            display: none;
        }
    </style>
@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">HelpDesk</h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">{{ __('Support') }}</a></li>
                                <li class="breadcrumb-item active">HelpDesk</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Base style table -->
                <section id="horizontal-form-layouts">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-content collpase show">
                                    <div class="card-body">
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <strong>Whoops!</strong> There were some problem.<br><br>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if (Session::has('success'))
                                            <div class="alert alert-success mt-2" role="alert">{{ Session::get('success') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        @endif
                                        <div class="archived mt-3">
                                        	<div class="row" style="justify-content: flex-end;">
                                            	<a href="{{route('admin.helpdesk.create')}}" type="button" class="btn btn-primary mr-1" ><i class="ft-plus"></i>Add Entry</a>
                                        	</div>
                                            <table id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>Entry ID</th>
                                                        <th>is Menu</th>
                                                        <th>Description</th>
                                                        <th>Link Page</th>
                                                        <th>Creator</th>
                                                        <th>Create Date</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $count = 1; @endphp
                                                    @foreach($helpdesk as $hpdesk)
                                                    @if($hpdesk->is_menu == '1')
                                                    <tr style="background-color: #f4f5fa;">
                                                        <td>{{$count++}}</td>
                                                        <td>X</td>
                                                        <td>{{$hpdesk->description}}</td>
                                                        <td></td>
                                                        <td>{{$hpdesk->creater}}</td>
                                                        <td>{{$hpdesk->created_at}}</td>
                                                        <td>@if($hpdesk->is_active == '1') Active @else InActive @endif</td>
                                                        <td>
                                                            <div class="row">
                                                                <button class="menu_active" type="button" data-status="menu" data-id="{{$hpdesk->id}}" style="@if($hpdesk->is_active == '1') display: none; @else display: block; @endif"><i class="ft-check mr-1"></i></button>
                                                                <button class="menu_inactive" type="button" data-status="menu" data-id="{{$hpdesk->id}}" style="@if($hpdesk->is_active == '1') display: block; @else display: none; @endif"><i class="fa fa-times mr-1"></i></button>
                                                                <a href="{{route('admin.helpdesk.edit', $hpdesk->id)}}?edit={{$hpdesk->is_menu}}"><i class="ft-edit mr-1"></i></a>
                                                                <button class="delete" type="button" data-delete="menu" data-id="{{$hpdesk->id}}"><i class="ft-trash"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @foreach($children as $child)
                                                    @if($hpdesk->description == $child->assignment)
                                                    <tr>
                                                        <td>{{$count++}}</td>
                                                        <td></td>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$child->description}}</td>
                                                        <td>{{$child->linked_page}}</td>
                                                        <td>{{$child->creater}}</td>
                                                        <td>{{$child->created_at}}</td>
                                                        <td>@if($child->is_active == '1') Active @else InActive @endif</td>
                                                        <td>
                                                            <div class="row">
                                                                <button class="child_active" type="button" data-status="child" data-id="{{$child->id}}" style="@if($child->is_active == '1') display: none; @else display: block; @endif"><i class="ft-check mr-1"></i></button>
                                                                <button class="child_inactive" type="button" data-status="child" data-id="{{$child->id}}" style="@if($child->is_active == '1') display: block; @else display: none; @endif"><i class="fa fa-times mr-1"></i></button>
                                                                <a href="{{route('admin.helpdesk.edit', $child->id)}}?edit={{$child->is_menu}}"><i class="ft-edit mr-1"></i></a>
                                                                <button class="delete" type="button" data-delete="child" data-id="{{$child->id}}"><i class="ft-trash"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('page_scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww==" crossorigin="anonymous"></script>
<script src="{{asset('app-assets/vendors/js/extensions/sweetalert2.all.js')}}" type="text/javascript"></script>
<!-- BEGIN: Page JS-->
<script src="{{asset('app-assets/js/scripts/extensions/sweet-alerts.js')}}" type="text/javascript"></script>
<!-- END: Page JS-->
@endsection

@section('scripts')
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
<script>
    $('.delete').on('click', function(event){
      event.preventDefault();
      var delete_data = $(this).attr('data-delete');
      var data_id = $(this).attr('data-id');
      // alert(delete_data);
      // alert(data_id);
      var route = "{{route('admin.helpdesk.destroy',"+data_id+")}}";
      // alert(route);
      if(delete_data == 'menu'){
          $.confirm({
            title: 'Confirm!',
            content: 'Are you sure you want to delete this? it may delete its chlid nodes.',
            buttons: {
                confirm: function () {
                    $.ajax({
                        url: route,
                        type: 'DELETE',
                        data:{'_token':'{{ csrf_token() }}', 'data_id':data_id, 'delete_menu':delete_data},
                        success:function(data){
                            swal({
                                position: 'top-end',
                                type: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(function(){
                                window.location.reload();
                            },2000);
                        },
                        error:function(e){
                            swal({
                                position: 'top-end',
                                type: 'error',
                                title: 'Something wents wrong, Please try again later.',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }

                    });
                },
                cancel: function () {
                    $.alert('Canceled!');
                },
            }
        });
      }else if(delete_data == 'child'){
        $.confirm({
            title: 'Confirm!',
            content: 'Are you sure you want to delete this?',
            buttons: {
                confirm: function () {
                    $.ajax({
                        url: route,
                        type: 'DELETE',
                        data:{'_token':'{{ csrf_token() }}', 'data_id':data_id, 'delete_menu':delete_data},
                        success:function(data){
                            swal({
                                position: 'top-end',
                                type: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 3000
                            });
                            setTimeout(function(){
                                window.location.reload();
                            },2000);
                        },
                        error:function(e){
                            swal({
                                position: 'top-end',
                                type: 'success',
                                title: 'Something wents wrong, Please try again later.',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }

                    });
                },
                cancel: function () {
                    $.alert('Canceled!');
                },
            }
        });
      }
   });
</script>
<script>
    $('.menu_active').on('click',function(){
        var data_id = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        // alert(data_id);
        // alert(status);
        // alert('make inactive')

        $.ajax({
            url: "{{route('admin.hpMakeActive')}}",
            type: "POST",
            data:{'_token':'{{ csrf_token() }}', 'data_status':status, 'data_id':data_id},
            success:function(data){
                swal({
                    position: 'top-end',
                    type: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function(){
                    window.location.reload();
                },2000);
            },
            error:function(e){
                swal({
                    position: 'top-end',
                    type: 'error',
                    title: 'Something wents wrong, Please try again later.',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    })

    $('.menu_inactive').on('click',function(){
        var data_id = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        // alert(data_id);
        // alert(status);
        // alert('make active')

        $.ajax({
            url: "{{route('admin.hpMakeInActive')}}",
            type: "POST",
            data:{'_token':'{{ csrf_token() }}', 'data_status':status, 'data_id':data_id},
            success:function(data){
                swal({
                    position: 'top-end',
                    type: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function(){
                    window.location.reload();
                },2000);
            },
            error:function(e){
                swal({
                    position: 'top-end',
                    type: 'error',
                    title: 'Something wents wrong, Please try again later.',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    })

     $('.child_active').on('click',function(){
        var data_id = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        // alert(data_id);
        // alert(status);
        // alert('make inactive')

        $.ajax({
            url: "{{route('admin.hpMakeActive')}}",
            type: "POST",
            data:{'_token':'{{ csrf_token() }}', 'data_status':status, 'data_id':data_id},
            success:function(data){
                swal({
                    position: 'top-end',
                    type: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function(){
                    window.location.reload();
                },2000);
            },
            error:function(e){
                swal({
                    position: 'top-end',
                    type: 'error',
                    title: 'Something wents wrong, Please try again later.',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    })

    $('.child_inactive').on('click',function(){
        var data_id = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        // alert(data_id);
        // alert(status);
        // alert('make active')

        $.ajax({
            url: "{{route('admin.hpMakeInActive')}}",
            type: "POST",
            data:{'_token':'{{ csrf_token() }}', 'data_status':status, 'data_id':data_id},
            success:function(data){
                swal({
                    position: 'top-end',
                    type: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function(){
                    window.location.reload();
                },2000);
            },
            error:function(e){
                swal({
                    position: 'top-end',
                    type: 'error',
                    title: 'Something wents wrong, Please try again later.',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    })

</script>
@endsection