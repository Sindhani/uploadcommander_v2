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
                    <h3 class="content-header-title mb-0 d-inline-block">Ticket System</h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active">Ticket System</li>
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

                                        <div class="card">
                                            <div class="card-header" style="background-color: #d3d3d34f;height: auto;">
                                                <div class="card" style="padding: 16px;">
                                                    <b><h5>Hello {{ Auth::user()->first_name }} {{ Auth::user()->surname }}</h5></b>
                                                    <br>
                                                    @if($recent_tickets->count() > 0)
                                                    <p>The following support ticket are assigned to you and waiting for your answer.</p>
                                                    @endif
                                                    <div class="row">
                                                        @foreach($recent_tickets as $tickets)
                                                        <div class="col-md-2">
                                                            <a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$tickets->ticket_id)}}&DipoEerTsdaltiL" title="Ticket ID">{{$tickets->ticket_id}}</a>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <table id="myTable">
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
                                                @foreach($data as $ticket)
                                                <tr>
                                                    <td><a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$ticket->ticket_id)}}&DipoEerTsdaltiL" title="View" style="color: gray;">{{$ticket->ticket_id}}</a></td>
                                                    <td><a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$ticket->ticket_id)}}&DipoEerTsdaltiL" title="View" style="color: gray;">{{$ticket->customer_number}}</a></td>
                                                    <td><a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$ticket->ticket_id)}}&DipoEerTsdaltiL" title="View" style="color: gray;">{{date('d-m-Y', strtotime($ticket->created_at))}}</a></td>
                                                    <td><div class="row">
                                                        <div class="col-md-3">
                                                            @if(!empty($ticket->photo))
                                                            <a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$ticket->ticket_id)}}&DipoEerTsdaltiL" title="View" style="color: gray;">
                                                            <img src="{{url('user_photo/'.$ticket->photo)}}" alt="avatar" height="30" style="border-radius: 50px;"></a>
                                                            @else
                                                            <a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$ticket->ticket_id)}}&DipoEerTsdaltiL" title="View" style="color: gray;">
                                                            <img src="{{url('images/user.jpg')}}" alt="avatar" height="30" style="border-radius: 50px;"></a>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-8">
                                                            <a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$ticket->ticket_id)}}&DipoEerTsdaltiL" title="View" style="color: gray;">
                                                            {{$ticket->first_name}}&nbsp;{{ $ticket->last_name}}
                                                        </a>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td><a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$ticket->ticket_id)}}&DipoEerTsdaltiL" title="View" style="color: gray;">{{$ticket->ticket_subject}}</a></td>
                                                    <td class="supporter">
                                                    @if(!empty($ticket->supporter))
                                                    <a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$ticket->ticket_id)}}&DipoEerTsdaltiL" title="View" style="color: gray;">
                                                    <?php $supporter = explode(',', $ticket->supporter);
                                                        echo $supporter[1];
                                                    ?>
                                                    </a>
                                                    @else
                                                    <a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$ticket->ticket_id)}}&DipoEerTsdaltiL" title="View" style="color: gray;">
                                                        <span><i class="fa fa-ellipsis-h dots" aria-hidden="true"></i></span>
                                                    </a>
                                                    @endif
                                                    </td>
                                                    <td class="status">
                                                        @if($ticket->ticket_status == 'open')
                                                            <a href="{{route('admin.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$ticket->ticket_id)}}&DipoEerTsdaltiL" type="button" class="btn btn-success openTicket" style="background-color: #3dc82c;" data-user="{{ Auth::user()->first_name }} {{ Auth::user()->surname }}" data-userID="{{ Auth::user()->id }}" data-ticketID="{{$ticket->ticket_id}}">{{$ticket->ticket_status}}
                                                            </a>
                                                        @else
                                                            <select name="status" class="form-control" data-ticketID="{{$ticket->ticket_id}}">
                                                                <option value="Pending" <?php echo ($ticket->ticket_status == 'Pending') ? 'selected' : '' ?>>Pending</option>
                                                                <option value="waiting for customer reply" <?php echo ($ticket->ticket_status == 'waiting for customer reply') ? 'selected' : '' ?>>waiting for customer reply</option>
                                                                <option value="no answer" <?php echo ($ticket->ticket_status == 'no answer') ? 'selected' : '' ?>>no answer</option>
                                                                <option value="complete" <?php echo ($ticket->ticket_status == 'complete') ? 'selected' : '' ?>>complete</option>
                                                            </select>
                                                        @endif
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