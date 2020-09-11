@extends('admin.layouts.admin')

@section('page_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        #myTable{
            font-size: 11px;
        }
        .dots{
            background-color: darkgray;
            color: white;
            padding: 0px 8px 0px 9px;
            font-size: 14px;
            border-radius: 73px;
        }
        .left_card_h{
            border-left: 1px solid lightgray;
            border-top: 1px solid lightgray;
            overflow-y: auto;
        }
        .right_card_h{
            border: 1px solid lightgray;
        }
        .avatar-middle{
            height: 60px;
            margin-left: 25px;
        }
        .middle_list_text{
            margin-right: 10px;
        }
        .list_id{
            margin-left: -14px;
        }
        .date{
            margin-left: 14px;
        }
        .status{
            border: 1px solid #f0ba56;
            color: #f0ba56;
            padding: 5px 21px;
            border-radius: 50px;
        }
        .close_file{
            position: absolute;
            margin-top: -8px;
            font-size: 18px;
            margin-left: 98%;
            z-index: 9;
        }
        .add_more_files{
            color: #fff;
            background-color: #3dc82c;
            border-color: #3abd2a;
        }
        .add_new_ticket_btn{
            color: #fff;
            background-color: #3dc82c;
            border-color: #3abd2a;
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
                    <h3 class="content-header-title mb-0 d-inline-block">Ticket Detail</h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active">Ticket Detail</li>
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
                                        <div class="row">
                                            <div class="col-md-9 left_card_h">
                                               <div class="card middle-card">
                                                   <div class="card-header middle-card-header">
                                                        <h5 style="color: gray;">TICKET {{$data->ticket_id}}</h5>
                                                        <h3>{{$data->ticket_subject}}</h3>
                                                        <hr class="mt-1">
                                                   </div>
                                                   <div class="row">
                                                        <div class="col-md-2">
                                                            <img src="{{asset('user_photo/'.$customer->photo)}}" alt="Avatar" class="avatar-middle">
                                                        </div>
                                                        <div class="col-md-10 middle_list_text_row">
                                                            <div class="row">
                                                                <div class="col-9 list_id">
                                                                    <h5 class="name" style="margin-bottom: -4px;">{{$customer->first_name}} {{$customer->last_name}}</h5>
                                                                    <small>{{$customer->company_name}}</small>
                                                                </div>
                                                                <div class="col-3 date"><small>{{date('M d Y H:i', strtotime($data->created_at))}}</small></div>
                                                            </div>
                                                            <div class="row middle_list_text">
                                                                <p>{{$data->ticket_body}}</p>
                                                            </div><br>
                                                            @if(!empty($data->attachment1))
                                                            <a href="{{url('user-attachments')}}/{{$data->attachment1}}" target="_blank" title="">{{$data->attachment1}}</a><br>
                                                            @endif
                                                            @if(!empty($data->attachment2))
                                                            <a href="{{url('user-attachments')}}/{{$data->attachment2}}" target="_blank" title="">{{$data->attachment2}}</a><br>
                                                            @endif
                                                            @if(!empty($data->attachment3))
                                                            <a href="{{url('user-attachments')}}/{{$data->attachment3}}" target="_blank" title="">{{$data->attachment3}}</a><br>
                                                            @endif
                                                            @if(!empty($data->attachment4))
                                                            <a href="{{url('user-attachments')}}/{{$data->attachment4}}" target="_blank" title="">{{$data->attachment4}}</a><br>
                                                            @endif
                                                            @if(!empty($data->attachment5))
                                                            <a href="{{url('user-attachments')}}/{{$data->attachment5}}" target="_blank" title="">{{$data->attachment5}}</a>
                                                            @endif
                                                            
                                                        </div>
                                                    </div>
                                                    <hr class="middle_hr">
                                                    @foreach($tocket_replies as $replies)
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            @if($replies->is_supporter_replied == 1)
                                                            <img src="{{asset('images/user.jpg')}}" alt="Avatar" class="avatar-middle">
                                                             @elseif($replies->  is_customer_replied == 1)
                                                            <img src="{{asset('user_photo/' .$replies->customer_pic )}}" alt="Avatar" class="avatar-middle">
                                                            @endif
                                                        </div>
                                                        <div class="col-md-10 middle_list_text_row">
                                                            <div class="row">
                                                                <div class="col-8 list_id">
                                                                    @if($replies->is_supporter_replied == 1)
                                                                    <h5 class="name">{{$replies->supporter_firstname}} {{$replies->supporter_lastname}}</h5><small>{{$replies->supporter_roleName}}</small>
                                                                    @elseif($replies->  is_customer_replied == 1)
                                                                    <h5 class="name">{{$replies->customer_firstname}} {{$replies->customer_lastname}}</h5><small>{{$replies->customer_company}}</small>
                                                                    @endif
                                                                </div>
                                                                <div class="col-3 date"><small>{{date('M d Y H:i', strtotime($replies->created_at))}}</small></div>
                                                            </div>
                                                            <div class="row middle_list_text">
                                                            <p>{{$replies->reply_body}}</p>
                                                                <br>
                                                                @if($replies->is_supporter_replied == 1)
                                                                @if(!empty($replies->supporter_attachment1))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment1}}" target="_blank" title="">{{$replies->supporter_attachment1}}</a>
                                                                @endif
                                                                @if(!empty($replies->supporter_attachment2))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment2}}" target="_blank" title="">{{$replies->supporter_attachment2}}</a>
                                                                @endif
                                                                @if(!empty($replies->supporter_attachment3))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment3}}" target="_blank" title="">{{$replies->supporter_attachment3}}</a>
                                                                @endif
                                                                @if(!empty($replies->supporter_attachment4))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment4}}" target="_blank" title="">{{$replies->supporter_attachment4}}</a>
                                                                @endif
                                                                @if(!empty($replies->supporter_attachment5))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment5}}" target="_blank" title="">{{$replies->supporter_attachment5}}</a>
                                                                @endif
                                                                @elseif($replies->  is_customer_replied == 1)
                                                                @if(!empty($replies->customer_attachment1))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment1}}" target="_blank" title="">{{$replies->customer_attachment1}}</a>
                                                                @endif
                                                                @if(!empty($replies->customer_attachment2))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment2}}" target="_blank" title="">{{$replies->customer_attachment2}}</a>
                                                                @endif
                                                                @if(!empty($replies->customer_attachment3))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment3}}" target="_blank" title="">{{$replies->customer_attachment3}}</a>
                                                                @endif
                                                                @if(!empty($replies->customer_attachment4))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment4}}" target="_blank" title="">{{$replies->customer_attachment4}}</a>
                                                                @endif
                                                                @if(!empty($replies->customer_attachment5))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment5}}" target="_blank" title="">{{$replies->customer_attachment5}}</a>
                                                                @endif
                                                                @endif
                                                            </div>
                                                            @if($replies->is_supporter_replied == 1)
                                                            <hr style="margin-right: 29px;">
                                                            <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                                            <p>Please visit our <a href="#">FAQ Helpcenter</a></p>
                                                            @endif
                                                            <hr style="margin-left: -75px;margin-right: 30px;">
                                                        </div>
                                                    </div>
                                                    @endforeach
                                               </div>
                                            </div>
                                            <div class="col-md-3 right_card_h">
                                                <div class="card right_card">
                                                    <div class="card-header" style="text-align: center;">
                                                        <h4>TICKET {{$data->ticket_id}}</h4>
                                                        <small>{{date('M d Y H:i', strtotime($data->created_at))}}</small><br><br>
                                                        <small for="status" class="status lable lable-warning">{{$data->ticket_status}}</small>
                                                    </div>
                                                    <div class="mt-3">
                                                        <h5 class="right_card_body_text">Customer</h5>
                                                        <div class="row right_card_row">
                                                            <div class="col-md-3">
                                                                <img src="{{asset('user_photo/'.$customer->photo)}}" alt="Avatar" class="avatar-right" height="45">
                                                            </div>
                                                            <div class="col-md-9 right_card_text">
                                                                <h4>{{$customer->first_name}} {{$customer->last_name}}</h4>
                                                                <small>{{$customer->company_name}}</small>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <h5><i class="fa fa-paperclip mr-1" style="font-size: 23px;"></i>Attachments</h5><br>
                                                            @foreach($tocket_replies as $replies)
                                                            @if($replies->is_customer_replied == 1)
                                                                @if(!empty($replies->customer_attachment1))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment1}}" target="_blank" title="" style="font-size: 10px;">{{$replies->customer_attachment1}}</a>
                                                                @endif
                                                                @if(!empty($replies->customer_attachment2))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment2}}" target="_blank" title="" style="font-size: 10px;">{{$replies->customer_attachment2}}</a>
                                                                @endif
                                                                @if(!empty($replies->customer_attachment3))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment3}}" target="_blank" title="" style="font-size: 10px;">{{$replies->customer_attachment3}}</a>
                                                                @endif
                                                                @if(!empty($replies->customer_attachment4))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment4}}" target="_blank" title="" style="font-size: 10px;">{{$replies->customer_attachment4}}</a>
                                                                @endif
                                                                @if(!empty($replies->customer_attachment5))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment5}}" target="_blank" title="" style="font-size: 10px;">{{$replies->customer_attachment5}}</a>
                                                                @endif
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($data->ticket_status != 'no answer' || $data->ticket_status != 'complete')
                                        <div class="col-md-9 reply_card mt-4 mb-5">
                                            <form action="{{route('admin.add_ticket_replies')}}" enctype="multipart/form-data" method="post">
                                                @csrf
                                                <input type="hidden" name="supporterID" value="{{Auth::user()->id}}">
                                                <input type="hidden" name="ticketID" value="{{$data->ticket_id}}">
                                                <input type="hidden" name="customerID" value="{{$data->customer_id}}">
                                                <div class="form-group">
                                                    <textarea class="fomr-control add_ticket_text" name="message" rows="10" cols="98" id="message" placeholder="Ticket Message*...max 4000 chracters" maxlength="4000" value="{{old('message')}}" required=""></textarea>
                                                </div>
                                                <div class="form-group" id="add_more_files_div">
                                                    <div class="input-group" id="inputFile01">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                                        </div>
                                                        <div class="custom-file attachment_files">
                                                            <input type="file" name="attachments1" class="custom-file-input" id="inputGroupFile01"
                                                            aria-describedby="inputGroupFileAddon01" accept=".png,.jpg,.jpeg,.pdf,.doc">
                                                            <label class="custom-file-label" for="inputGroupFile01" id="files_no1">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-success add_more_files">Add More</button>
                                                </div>
                                                <input type="submit" name="submit" class="btn btn-success add_new_ticket_btn" style="float:right;">
                                            </form>
                                        </div>
                                        @endif
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
<script>
    var count = 1;

    $('.add_more_files').on('click',function(){
        if(count > 4){
            alert('your are allow to attach 5 file per ticket.');
            $('.add_more_files').hide();
        }else{
            count++;
            // console.log(count);
        $('#add_more_files_div').append('<div class="input-group mt-1" id="inputFile01"><label for="close" class="close_file" style="cursor:pointer;"><i class="fa fa-window-close" aria-hidden="true"></i></label><div class="input-group-prepend"><span class="input-group-text" id="inputGroupFileAddon01">Upload</span></div><div class="custom-file attachment_files"><input type="file" name="attachments'+count+'" class="custom-file-input" id="inputGroupFile01"aria-describedby="inputGroupFileAddon01" accept=".png,.jpg,.jpeg,.pdf,.doc"><label class="custom-file-label" for="inputGroupFile01" id="files_no'+count+'">Choose file</label></div></div>');

        }
    })

    $(document).ready(function(){
          $(document).delegate('.close_file','click',function(){
               $(this).parent().remove();
               $(this).hide();
               $('.add_more_files').show();
               count += -1;
               // console.log(count);
           })
      })

    var files = [];
    var fileName = [];
    $(document).delegate('#inputGroupFile01','change',function(){

        var multi_files = $(this).prop("files");

        // console.log(multi_files);
        var number = multi_files.length;
        // console.log(number);
        
        // files.push($('#inputGroupFile01').val());

        // console.log(files);

        if(multi_files.length > 5){
            alert('You are allow to slect only 5 files per ticket.');
        }
        else{
            if(files.length >= 5){
                alert('You are allow to slect only 5 files per ticket.');
            }else{
                var i;
                var j;
                var k = 1;
                for(i = 0; i < multi_files.length; i++){
                    files.push(multi_files[i]);
                    fileName.push(multi_files[i].name);
                    $('#files_no'+count).html(multi_files[i].name);

                }
                
                // $('.selected_files').empty();
                
                for(j = 0; j < fileName.length; j++){
                    $('.selected_files').append('<span>'+fileName[j]+'</span><br>');
                }
            }
            
            }
        // console.log(files);
        // console.log(fileName.length);
    })
</script>
@endsection

@section('scripts')
@endsection