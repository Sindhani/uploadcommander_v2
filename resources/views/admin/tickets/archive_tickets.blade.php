@extends('admin.layouts.admin')

@section('page_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css">
    <style>
        #myTable, #myTable1{
            font-size: 11px;
        }
        .dots{
            background-color: darkgray;
            color: white;
            padding: 0px 8px 0px 9px;
            font-size: 14px;
            border-radius: 73px;
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
                    <h3 class="content-header-title mb-0 d-inline-block">Ticket Archive</h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active">Ticket Archive</li>
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
                                            <h4 class="mb-2" style="font-weight: bold;">Archived Tickets</h4>
                                            <table id="myTable1">
                                                <thead>
                                                    <tr>
                                                        <th>Ticket ID</th>
                                                        <th>Customer Number</th>
                                                        <th>Date</th>
                                                        <th>Customer</th>
                                                        <th>Subject</th>
                                                        <th>Supporter</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($arch_tickets as $tickets)
                                                    <tr>
                                                        <td>
                                                            <a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$tickets->ticket_id)}}&DipoEerTsdaltiL" title="View" style="color: gray;">
                                                            {{$tickets->ticket_id}}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$tickets->ticket_id)}}&DipoEerTsdaltiL" title="View" style="color: gray;">{{$tickets->customer_number}}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$tickets->ticket_id)}}&DipoEerTsdaltiL" title="View" style="color: gray;">
                                                            {{date('d.m.yy', strtotime($tickets->created_at))}}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    @if(!empty($tickets->photo))
                                                                    <a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$tickets->ticket_id)}}&DipoEerTsdaltiL" title="View" style="color: gray;">
                                                                    <img src="{{url('user_photo/'.$tickets->photo)}}" alt="avatar" height="30" style="border-radius: 50px;"></a>
                                                                    @else
                                                                    <a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$tickets->ticket_id)}}&DipoEerTsdaltiL" title="View" style="color: gray;">
                                                                    <img src="{{url('images/user.jpg')}}" alt="avatar" height="30" style="border-radius: 50px;"></a>
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$tickets->ticket_id)}}&DipoEerTsdaltiL" title="View" style="color: gray;">
                                                                    {{$tickets->first_name}}&nbsp;{{ $tickets->last_name}}
                                                                </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$tickets->ticket_id)}}&DipoEerTsdaltiL" title="View" style="color: gray;">
                                                            {{$tickets->ticket_subject}}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @if(!empty($tickets->supporter))
                                                                <a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$tickets->ticket_id)}}&DipoEerTsdaltiL" title="View" style="color: gray;">
                                                                <?php $supporter = explode(',', $tickets->supporter);
                                                                    echo $supporter[1];
                                                                ?>
                                                                </a>
                                                                @else
                                                                <a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$tickets->ticket_id)}}&DipoEerTsdaltiL" title="View" style="color: gray;">
                                                                    <span><i class="fa fa-ellipsis-h dots" aria-hidden="true"></i></span>
                                                                </a>
                                                                @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$tickets->ticket_id)}}&DipoEerTsdaltiL" title="View" style="color: gray;">
                                                            {{$tickets->ticket_status}}
                                                            </a>
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
<script>
    $(document).ready( function () {
        $('#myTable , #myTable1').DataTable();
    } );

    $('.openTicket').on('click',function(){
        var userName = $(this).attr('data-user');
        var userID = $(this).attr('data-userID');
        var ticketID = $(this).attr('data-ticketID');

        $.ajax({
            url: "{{route('admin.change_ticket_status')}}",
            type: "POST",
            data:{"_token":"{{ csrf_token() }}", 'id':userID, 'userName':userName, 'ticketID':ticketID},
            success: function(data){
                // alert('working good');
                // $('.status').parent().find('.supporter').html(data);
                $('.card').load(location.href + ' .card-body'); 
            },
            error:function(e){
                // alert('something wents wrong');
            }
        })
    })


    $('select').change(function(){
        $(this).find(':selected').addClass('selected')
            .siblings('option').removeClass('selected');
        
        var option = $(this).find(':selected').attr('value');
        var id = $(this).attr('data-ticketID');
        if(option != ""){
            $.ajax({
                url: "{{route('admin.update_ticket_status')}}",
                type: "POST",
                data: {"_token":"{{ csrf_token() }}", 'option':option, 'ticket_id':id},
                success:function(data){
                    $.toast({
                        heading: 'Success',
                        text: 'Status updated successfully!',
                        showHideTransition: 'slide',
                        icon: 'success',
                        position: 'top-right'
                    })
                    setTimeout(function(){
                        window.location.reload();
                    },3000);
                },
                error:function(e){
                    $.toast({
                        heading: 'Error',
                        text: 'Something wents wrong, Please try again later.',
                        showHideTransition: 'fade',
                        icon: 'error',
                        position: 'top-right'
                    })
                }
            })
        }
       
    });
</script>

@endsection

@section('scripts')
@endsection