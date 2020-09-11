@extends('customer.tickets.ticket_layout')

@section('vendor_style')
    <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/ui/prism.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/file-uploaders/dropzone.css')}}">
@endsection
@section('styles')
    <style>
        .pics img {
            height: 100px;
            margin-top: 10px;
            padding: 9px;
        }

        .add_new_pics img {
            height: 100px;
            margin-top: 10px;
            padding: 9px;
        }

        .click-zoom input[type=checkbox] {
            display: none
        }

        .click-zoom img {

            transition: transform 0.75s ease;
            cursor: zoom-in
        }

        .click-zoom input[type=checkbox]:checked ~ img {
            transform: scale(2);
            margin: 50px;
            cursor: zoom-out
        }

        .dropzone {
            min-height: 220px;
            border: 2px dashed #6967ce;
            background: #F4F5FA;
        }

        .dropzone .dz-message {
            font-size: 1rem;
            top: 50%;
            left: 0;
            width: 100%;
            height: auto;
            position: inherit;
            color: #6967ce;
            text-align: center;
            margin-top: 50px;
        }

        .dropzone .dz-message:before {
            content: "\e9d1";
            font-family: 'feather';
            font-size: 80px;
            position: inherit;
            top: 48px;
            width: 80px;
            height: 80px;
            display: inline-block;
            left: 50%;
            margin-left: 0px;
            line-height: 1;
            z-index: 2;
            color: #6967ce;
            text-indent: 0px;
            font-weight: normal;
            -webkit-font-smoothing: antialiased;
        }

        .customer-chat {
            background-color: #0c78be !important;
        }

        .default {
            height: calc(100% - 0px) !important;

        }

        .default-text {
            margin: 37%;
        }

        .chat-content a {
            color: #a5d8ed;
        }

        .chat-content p {
            text-align: left;
        }

        input[type="file"] {
            font-size: 11px;
            width: 150px;
        }

        .add_more_files {
            color: #5654c8 !important;
        }

        .ft-delete {
            font-size: 20px;
            position: absolute;
            margin-left: 89%;
            margin-top: -3px;
            z-index: 9;
            cursor: pointer;
        }

        .ticket_status {
            color: orange;
            border: 1px solid orange;
            font-size: 11px;
            padding: 2px 7px;
            border-radius: 50px;
        }

        .chat-app-window, .chat-app-form {
            @if(isset($_GET["OikgHtobntCsd8oF"]) || isset($_GET["last_ticket"]))
    width: 100%;
        @endif




        }

        .ticket_history_card {
            margin-left: 884px;
            position: absolute;
            @if(isset($_GET["OikgHtobntCsd8oF"]) || isset($_GET["last_ticket"]))
            @if(@$data1->ticket_status == 'complete' || @$data1->ticket_status == 'no answer')
    width: 427px;
            @else
    width: 410px;
            @endif
            @endif
    height: 100%;
        }

        .add_new_ticket {
            font-size: 15px !important;
        }

        .camera {
            display: block;
            font-size: 30px;
            position: absolute;
            margin-left: 90%;
            cursor: pointer;
            z-index: 999;
            margin-top: 10px !important;
        }

        .msg_pic {
            display: none;
        }

        .message_pic {
            margin-top: 7px !important;
            margin-right: 73%;
            display: none;
            height: 100px;
        }

        input[name="message"] {
            height: 59px !important;
        }

        .chat-application .chat-app-window {

            @if(isset($_GET['action']))
            @else
    height: 500px !important;
        @endif





        }

        section[class="chat-app-window"] {
            width: 100% !important;
        }

        .chat-application .chat-fixed-search {

            z-index: 1 !important;

            width: 100%;

        }

        div[class="sidebar-content card d-none d-lg-block"] {
            @if(isset($_GET["OikgHtobntCsd8oF"]))
    width: 100% !important;
            @else
    width: 106% !important;
        @endif




        }

        div[class="app-content content"] {
            overflow-y: scroll !important;
        }

        div[class="mb-1 secondary text-bold-700 mt-2"] {
            padding: 18px !important;
        }

        form[id="dpz-file-limits"] {
            width: 97% !important;
        }

    </style>




@endsection
@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">


        <div class="row" style=" @if(isset($_GET['action'])) height:100%; @endif">
            <div class="col-md-3" style="z-index: 3;">
                <div class="" style="height: 100%;overflow-y: scroll;overflow-x: hidden;width: 107%;">
                    <div class="sidebar-content card d-none d-lg-block"
                            style="@if(count($data) == 0 || count($data) < 4) height: 100% @endif">
                        <div class="card-body chat-fixed-search">
                            <a type="button" href="{{route('customer.tickets')}}?action=add_ticket"
                                    class=" font-large-1 cursor-pointer add_new_ticket btn btn-success ml-2">New Ticket
                                <i class="ft-edit"></i> </a>
                        </div>
                        <div id="users-list" class="list-group position-relative">
                            <div class="users-list-padding media-list mt-1">
                                @if(count($data) > 0)
                                    @foreach($data as $ticket)
                                        <a href="{{route('customer.ticket_detail')}}?Ze3pBwnG0pQwrZi={{str_replace('#','',$ticket->ticket_id)}}&OikgHtobntCsd8oF"
                                                class="media border-bottom-blue-grey border-bottom-lighten-5 ticket_list
                                                @if( @$_GET['Ze3pBwnG0pQwrZi'] == str_replace('#','',$ticket->ticket_id) ) border-right-primary  border-right-2 @endif
                                                @if($last_ticket->ticket_id == $ticket->ticket_id) @endif"
                                                data-ticket-id="{{$ticket->ticket_id}}" id="{{$ticket->ticket_id}}">
                                            <!-- border-right-primary  border-right-2 -->
                                            <div class="media-left pr-1">
                                    <span class="avatar avatar-md"><img class="media-object rounded-circle box-shadow-3"
                                                src="{{ (Auth::guard('customers')->user()->photo)?asset('user_photo/'.Auth::guard('customers')->user()->photo):asset('images/user.jpg') }}"
                                                alt="Generic placeholder image">
                                    </span>
                                            </div>
                                            <div class="media-body w-100">
                                                <h6 class="list-group-item-heading font-medium-1 text-bold-700">#{{$ticket->ticket_id}}&nbsp;</h6>
                                                <p class="font-small-3 text-muted text-bold-500">{{$ticket->created_at->diffForHumans()}}</p>
                                                <p class="list-group-item-text text-muted mb-0 lighten-1">{{ \Illuminate\Support\Str::limit($ticket->ticket_body, 100, $end='...') }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <h6 class="mt-5"
                                            style="text-align: center;">There is no ticket. Create a ticket using given link at above.</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="z-index: 3 !important">


                <div class="content-wrapper" style="width: 105%;margin-left: -1px;">
                    <!-- <div class="content-wrapper-before" style="z-index: -1 !important;"></div> -->
                    <div class="content-header row"></div>
                    @if(!isset($_GET["OikgHtobntCsd8oF"]) && !isset($_GET["action"]))
                        <div class="content-body" style="overflow-y: auto;width: 100%;">
                            <section class="chat-app-window">
                                @if(!empty($data1))
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-1 secondary text-bold-700"
                                                    style="text-align: initial;"> TICKET #{{@$data1->ticket_id}} <br>
                                                <h4>{{@$data1->ticket_subject}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chats">
                                        <div class="chats">
                                            <div class="chat">
                                                <div class="chat-avatar">
                                                    <a class="avatar" data-toggle="tooltip" href="#"
                                                            data-placement="right" title="" data-original-title=""> <img
                                                                src="{{ (Auth::guard('customers')->user()->photo)?asset('user_photo/'.Auth::guard('customers')->user()->photo):asset('images/user.jpg') }}"
                                                                class="box-shadow-4" alt="avatar"/> </a>
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-content customer-chat">
                                                        <p>{{@$data1->ticket_body}}<br>
                                                            {{date('M d Y H:i', strtotime(@$data1->created_at))}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(!empty(@$data1->image_msg))
                                                <div class="chat">
                                                    <div class="chat-avatar">
                                                        <a class="avatar" data-toggle="tooltip" href="#"
                                                                data-placement="right" title="" data-original-title="">
                                                            <img src="{{ (Auth::guard('customers')->user()->photo)?asset('user_photo/'.Auth::guard('customers')->user()->photo):asset('images/user.jpg') }}"
                                                                    class="box-shadow-4" alt="avatar"/> </a>
                                                    </div>
                                                    <div class="chat-body">
                                                        <div class="chat-content customer-chat">
                                                            <div class="click-zoom">
                                                                <label> <input type="checkbox"> <img
                                                                            src="{{asset('replies-attachments/'.@$data1->image_msg)}}"
                                                                            alt="Message Image"
                                                                            style="height: 150px; width: 200px;">
                                                                </label>
                                                            </div>
                                                            <p>
                                                                {{date('M d Y H:i', strtotime(@$data1->created_at))}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty(@$data1->attachment1))
                                                <div class="chat">
                                                    <div class="chat-avatar">
                                                        <a class="avatar" data-toggle="tooltip" href="#"
                                                                data-placement="right" title="" data-original-title="">
                                                            <img src="{{ (Auth::guard('customers')->user()->photo)?asset('user_photo/'.Auth::guard('customers')->user()->photo):asset('images/user.jpg') }}"
                                                                    class="box-shadow-4" alt="avatar"/> </a>
                                                    </div>
                                                    <div class="chat-body">
                                                        <div class="chat-content customer-chat">
                                                            <div class="click-zoom">
                                                                <label> <input type="checkbox"> <img
                                                                            src="{{asset('user-attachments/'.@$data1->attachment1)}}"
                                                                            alt="Message Image"
                                                                            style="height: 150px; width: 200px;">
                                                                </label>
                                                            </div>
                                                            <p>
                                                                {{date('M d Y H:i', strtotime(@$data1->created_at))}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty(@$data1->attachment2))
                                                <div class="chat">
                                                    <div class="chat-avatar">
                                                        <a class="avatar" data-toggle="tooltip" href="#"
                                                                data-placement="right" title="" data-original-title="">
                                                            <img src="{{ (Auth::guard('customers')->user()->photo)?asset('user_photo/'.Auth::guard('customers')->user()->photo):asset('images/user.jpg') }}"
                                                                    class="box-shadow-4" alt="avatar"/> </a>
                                                    </div>
                                                    <div class="chat-body">
                                                        <div class="chat-content customer-chat">
                                                            <div class="click-zoom">
                                                                <label> <input type="checkbox"> <img
                                                                            src="{{asset('user-attachments/'.@$data1->attachment2)}}"
                                                                            alt="Message Image"
                                                                            style="height: 150px; width: 200px;">
                                                                </label>
                                                            </div>
                                                            <p>
                                                                {{date('M d Y H:i', strtotime(@$data1->created_at))}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty(@$data1->attachment3))
                                                <div class="chat">
                                                    <div class="chat-avatar">
                                                        <a class="avatar" data-toggle="tooltip" href="#"
                                                                data-placement="right" title="" data-original-title="">
                                                            <img src="{{ (Auth::guard('customers')->user()->photo)?asset('user_photo/'.Auth::guard('customers')->user()->photo):asset('images/user.jpg') }}"
                                                                    class="box-shadow-4" alt="avatar"/> </a>
                                                    </div>
                                                    <div class="chat-body">
                                                        <div class="chat-content customer-chat">
                                                            <div class="click-zoom">
                                                                <label> <input type="checkbox"> <img
                                                                            src="{{asset('user-attachments/'.@$data1->attachment3)}}"
                                                                            alt="Message Image"
                                                                            style="height: 150px; width: 200px;">
                                                                </label>
                                                            </div>
                                                            <p>
                                                                {{date('M d Y H:i', strtotime(@$data1->created_at))}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty(@$data1->attachment4))
                                                <div class="chat">
                                                    <div class="chat-avatar">
                                                        <a class="avatar" data-toggle="tooltip" href="#"
                                                                data-placement="right" title="" data-original-title="">
                                                            <img src="{{ (Auth::guard('customers')->user()->photo)?asset('user_photo/'.Auth::guard('customers')->user()->photo):asset('images/user.jpg') }}"
                                                                    class="box-shadow-4" alt="avatar"/> </a>
                                                    </div>
                                                    <div class="chat-body">
                                                        <div class="chat-content customer-chat">
                                                            <div class="click-zoom">
                                                                <label> <input type="checkbox"> <img
                                                                            src="{{asset('user-attachments/'.@$data1->attachment4)}}"
                                                                            alt="Message Image"
                                                                            style="height: 150px; width: 200px;">
                                                                </label>
                                                            </div>
                                                            <p>
                                                                {{date('M d Y H:i', strtotime(@$data1->created_at))}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty(@$data1->attachment5))
                                                <div class="chat">
                                                    <div class="chat-avatar">
                                                        <a class="avatar" data-toggle="tooltip" href="#"
                                                                data-placement="right" title="" data-original-title="">
                                                            <img src="{{ (Auth::guard('customers')->user()->photo)?asset('user_photo/'.Auth::guard('customers')->user()->photo):asset('images/user.jpg') }}"
                                                                    class="box-shadow-4" alt="avatar"/> </a>
                                                    </div>
                                                    <div class="chat-body">
                                                        <div class="chat-content customer-chat">
                                                            <div class="click-zoom">
                                                                <label> <input type="checkbox"> <img
                                                                            src="{{asset('user-attachments/'.@$data1->attachment5)}}"
                                                                            alt="Message Image"
                                                                            style="height: 150px; width: 200px;">
                                                                </label>
                                                            </div>
                                                            <p>
                                                                {{date('M d Y H:i', strtotime(@$data1->created_at))}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty($tocket_replies))
                                                @foreach($tocket_replies as $replies)
                                                    @if($replies->is_supporter_replied == 1)
                                                        <div class="chat chat-left">
                                                            <div class="chat-avatar">
                                                                <a class="avatar" data-toggle="tooltip" href="#"
                                                                        data-placement="left" title=""
                                                                        data-original-title="">
                                                                    @if($replies->supporter_photo)
                                                                        <img src="{{asset('user_photo/'.$replies->supporter_photo)}}"
                                                                                class="box-shadow-4" alt="avatar"/>
                                                                    @else
                                                                        <img src="{{asset('images/user.jpg')}}"
                                                                                class="box-shadow-4" alt="avatar"/>
                                                                    @endif
                                                                </a>
                                                            </div>
                                                            <div class="chat-body">
                                                                <div class="chat-content">
                                                                    <p>{{$replies->reply_body}} <br> <br>
                                                                        {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                    </p>
                                                                    <hr style="margin-right: 29px;margin-left: -10px;">
                                                                    <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                                                    <p>Please visit our <a href="#">FAQ Helpcenter</a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if(!empty($replies->image_msg))
                                                            <div class="chat chat-left">
                                                                <div class="chat-avatar">
                                                                    <a class="avatar" data-toggle="tooltip" href="#"
                                                                            data-placement="left" title=""
                                                                            data-original-title="">
                                                                        @if($replies->supporter_photo)
                                                                            <img src="{{asset('user_photo/'.$replies->supporter_photo)}}"
                                                                                    class="box-shadow-4" alt="avatar"/>
                                                                        @else
                                                                            <img src="{{asset('images/user.jpg')}}"
                                                                                    class="box-shadow-4" alt="avatar"/>
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                                <div class="chat-body">
                                                                    <div class="chat-content">
                                                                        <div class="click-zoom">
                                                                            <label> <input type="checkbox"> <img
                                                                                        src="{{asset('replies-attachments/'.$replies->image_msg)}}"
                                                                                        alt="Message Image"
                                                                                        style="height: 150px; width: 200px;">
                                                                            </label>
                                                                        </div>
                                                                        <p>
                                                                            {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                        </p>
                                                                        <hr style="margin-right: 29px;margin-left: -10px;">
                                                                        <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                                                        <p>Please visit our <a
                                                                                    href="#">FAQ Helpcenter</a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if(!empty($replies->supporter_attachment1))
                                                            <div class="chat chat-left">
                                                                <div class="chat-avatar">
                                                                    <a class="avatar" data-toggle="tooltip" href="#"
                                                                            data-placement="left" title=""
                                                                            data-original-title="">
                                                                        @if($replies->supporter_photo)
                                                                            <img src="{{asset('user_photo/'.$replies->supporter_photo)}}"
                                                                                    class="box-shadow-4" alt="avatar"/>
                                                                        @else
                                                                            <img src="{{asset('images/user.jpg')}}"
                                                                                    class="box-shadow-4" alt="avatar"/>
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                                <div class="chat-body">
                                                                    <div class="chat-content">
                                                                        <div class="click-zoom">
                                                                            <label> <input type="checkbox"> <img
                                                                                        src="{{asset('replies-attachments/'.$replies->supporter_attachment1)}}"
                                                                                        alt="Message Image"
                                                                                        style="height: 150px; width: 200px;">
                                                                            </label>
                                                                        </div>
                                                                        <p>
                                                                            {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                        </p>
                                                                        <hr style="margin-right: 29px;margin-left: -10px;">
                                                                        <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                                                        <p>Please visit our <a
                                                                                    href="#">FAQ Helpcenter</a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if(!empty($replies->supporter_attachment2))
                                                            <div class="chat chat-left">
                                                                <div class="chat-avatar">
                                                                    <a class="avatar" data-toggle="tooltip" href="#"
                                                                            data-placement="left" title=""
                                                                            data-original-title="">
                                                                        @if($replies->supporter_photo)
                                                                            <img src="{{asset('user_photo/'.$replies->supporter_photo)}}"
                                                                                    class="box-shadow-4" alt="avatar"/>
                                                                        @else
                                                                            <img src="{{asset('images/user.jpg')}}"
                                                                                    class="box-shadow-4" alt="avatar"/>
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                                <div class="chat-body">
                                                                    <div class="chat-content">
                                                                        <div class="click-zoom">
                                                                            <label> <input type="checkbox"> <img
                                                                                        src="{{asset('replies-attachments/'.$replies->supporter_attachment2)}}"
                                                                                        alt="Message Image"
                                                                                        style="height: 150px; width: 200px;">
                                                                            </label>
                                                                        </div>
                                                                        <p>
                                                                            {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                        </p>
                                                                        <hr style="margin-right: 29px;margin-left: -10px;">
                                                                        <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                                                        <p>Please visit our <a
                                                                                    href="#">FAQ Helpcenter</a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if(!empty($replies->supporter_attachment3))
                                                            <div class="chat chat-left">
                                                                <div class="chat-avatar">
                                                                    <a class="avatar" data-toggle="tooltip" href="#"
                                                                            data-placement="left" title=""
                                                                            data-original-title="">
                                                                        @if($replies->supporter_photo)
                                                                            <img src="{{asset('user_photo/'.$replies->supporter_photo)}}"
                                                                                    class="box-shadow-4" alt="avatar"/>
                                                                        @else
                                                                            <img src="{{asset('images/user.jpg')}}"
                                                                                    class="box-shadow-4" alt="avatar"/>
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                                <div class="chat-body">
                                                                    <div class="chat-content">
                                                                        <div class="click-zoom">
                                                                            <label> <input type="checkbox"> <img
                                                                                        src="{{asset('replies-attachments/'.$replies->supporter_attachment3)}}"
                                                                                        alt="Message Image"
                                                                                        style="height: 150px; width: 200px;">
                                                                            </label>
                                                                        </div>
                                                                        <p>
                                                                            {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                        </p>
                                                                        <hr style="margin-right: 29px;margin-left: -10px;">
                                                                        <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                                                        <p>Please visit our <a
                                                                                    href="#">FAQ Helpcenter</a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if(!empty($replies->supporter_attachment4))
                                                            <div class="chat chat-left">
                                                                <div class="chat-avatar">
                                                                    <a class="avatar" data-toggle="tooltip" href="#"
                                                                            data-placement="left" title=""
                                                                            data-original-title="">
                                                                        @if($replies->supporter_photo)
                                                                            <img src="{{asset('user_photo/'.$replies->supporter_photo)}}"
                                                                                    class="box-shadow-4" alt="avatar"/>
                                                                        @else
                                                                            <img src="{{asset('images/user.jpg')}}"
                                                                                    class="box-shadow-4" alt="avatar"/>
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                                <div class="chat-body">
                                                                    <div class="chat-content">
                                                                        <div class="click-zoom">
                                                                            <label> <input type="checkbox"> <img
                                                                                        src="{{asset('replies-attachments/'.$replies->supporter_attachment4)}}"
                                                                                        alt="Message Image"
                                                                                        style="height: 150px; width: 200px;">
                                                                            </label>
                                                                        </div>
                                                                        <p>
                                                                            {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                        </p>
                                                                        <hr style="margin-right: 29px;margin-left: -10px;">
                                                                        <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                                                        <p>Please visit our <a
                                                                                    href="#">FAQ Helpcenter</a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if(!empty($replies->supporter_attachment5))
                                                            <div class="chat chat-left">
                                                                <div class="chat-avatar">
                                                                    <a class="avatar" data-toggle="tooltip" href="#"
                                                                            data-placement="left" title=""
                                                                            data-original-title="">
                                                                        @if($replies->supporter_photo)
                                                                            <img src="{{asset('user_photo/'.$replies->supporter_photo)}}"
                                                                                    class="box-shadow-4" alt="avatar"/>
                                                                        @else
                                                                            <img src="{{asset('images/user.jpg')}}"
                                                                                    class="box-shadow-4" alt="avatar"/>
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                                <div class="chat-body">
                                                                    <div class="chat-content">
                                                                        <div class="click-zoom">
                                                                            <label> <input type="checkbox"> <img
                                                                                        src="{{asset('replies-attachments/'.$replies->supporter_attachment5)}}"
                                                                                        alt="Message Image"
                                                                                        style="height: 150px; width: 200px;">
                                                                            </label>
                                                                        </div>
                                                                        <p>
                                                                            {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                        </p>
                                                                        <hr style="margin-right: 29px;margin-left: -10px;">
                                                                        <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                                                        <p>Please visit our <a
                                                                                    href="#">FAQ Helpcenter</a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                    @elseif($replies->is_customer_replied == 1)
                                                        <div class="chat">
                                                            <div class="chat-avatar">
                                                                <a class="avatar" data-toggle="tooltip" href="#"
                                                                        data-placement="right" title=""
                                                                        data-original-title=""> <img
                                                                            src="{{$replies->customer_pic?asset('user_photo/' .$replies->customer_pic ):asset('images/user.jpg')}}"
                                                                            class="box-shadow-4" alt="avatar"/> </a>
                                                            </div>
                                                            <div class="chat-body">
                                                                <div class="chat-content customer-chat">
                                                                    <p>{{$replies->reply_body}}
                                                                        <br>
                                                                        {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if(!empty($replies->image_msg))
                                                            <div class="chat">
                                                                <div class="chat-avatar">
                                                                    <a class="avatar" data-toggle="tooltip" href="#"
                                                                            data-placement="right" title=""
                                                                            data-original-title=""> <img
                                                                                src="{{$replies->customer_pic?asset('user_photo/' .$replies->customer_pic ):asset('images/user.jpg')}}"
                                                                                class="box-shadow-4" alt="avatar"/> </a>
                                                                </div>
                                                                <div class="chat-body">
                                                                    <div class="chat-content customer-chat">
                                                                        <div class="click-zoom">
                                                                            <label> <input type="checkbox"> <img
                                                                                        src="{{asset('replies-attachments/'.$replies->image_msg)}}"
                                                                                        alt="Message Image"
                                                                                        style="height: 150px; width: 200px;">
                                                                            </label>
                                                                        </div>
                                                                        <p>{{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if(!empty($replies->customer_attachment1))
                                                            <div class="chat">
                                                                <div class="chat-avatar">
                                                                    <a class="avatar" data-toggle="tooltip" href="#"
                                                                            data-placement="right" title=""
                                                                            data-original-title=""> <img
                                                                                src="{{$replies->customer_pic?asset('user_photo/' .$replies->customer_pic ):asset('images/user.jpg')}}"
                                                                                class="box-shadow-4" alt="avatar"/> </a>
                                                                </div>
                                                                <div class="chat-body">
                                                                    <div class="chat-content customer-chat">
                                                                        <div class="click-zoom">
                                                                            <label> <input type="checkbox"> <img
                                                                                        src="{{asset('replies-attachments/'.$replies->customer_attachment1)}}"
                                                                                        alt="Message Image"
                                                                                        style="height: 150px; width: 200px;">
                                                                            </label>
                                                                        </div>
                                                                        <p>{{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if(!empty($replies->customer_attachment2))
                                                            <div class="chat">
                                                                <div class="chat-avatar">
                                                                    <a class="avatar" data-toggle="tooltip" href="#"
                                                                            data-placement="right" title=""
                                                                            data-original-title=""> <img
                                                                                src="{{$replies->customer_pic?asset('user_photo/' .$replies->customer_pic ):asset('images/user.jpg')}}"
                                                                                class="box-shadow-4" alt="avatar"/> </a>
                                                                </div>
                                                                <div class="chat-body">
                                                                    <div class="chat-content customer-chat">
                                                                        <div class="click-zoom">
                                                                            <label> <input type="checkbox"> <img
                                                                                        src="{{asset('replies-attachments/'.$replies->customer_attachment2)}}"
                                                                                        alt="Message Image"
                                                                                        style="height: 150px; width: 200px;">
                                                                            </label>
                                                                        </div>
                                                                        <p>{{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if(!empty($replies->customer_attachment3))
                                                            <div class="chat">
                                                                <div class="chat-avatar">
                                                                    <a class="avatar" data-toggle="tooltip" href="#"
                                                                            data-placement="right" title=""
                                                                            data-original-title=""> <img
                                                                                src="{{$replies->customer_pic?asset('user_photo/' .$replies->customer_pic ):asset('images/user.jpg')}}"
                                                                                class="box-shadow-4" alt="avatar"/> </a>
                                                                </div>
                                                                <div class="chat-body">
                                                                    <div class="chat-content customer-chat">
                                                                        <div class="click-zoom">
                                                                            <label> <input type="checkbox"> <img
                                                                                        src="{{asset('replies-attachments/'.$replies->customer_attachment3)}}"
                                                                                        alt="Message Image"
                                                                                        style="height: 150px; width: 200px;">
                                                                            </label>
                                                                        </div>
                                                                        <p>{{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if(!empty($replies->customer_attachment4))
                                                            <div class="chat">
                                                                <div class="chat-avatar">
                                                                    <a class="avatar" data-toggle="tooltip" href="#"
                                                                            data-placement="right" title=""
                                                                            data-original-title=""> <img
                                                                                src="{{$replies->customer_pic?asset('user_photo/' .$replies->customer_pic ):asset('images/user.jpg')}}"
                                                                                class="box-shadow-4" alt="avatar"/> </a>
                                                                </div>
                                                                <div class="chat-body">
                                                                    <div class="chat-content customer-chat">
                                                                        <div class="click-zoom">
                                                                            <label> <input type="checkbox"> <img
                                                                                        src="{{asset('replies-attachments/'.$replies->customer_attachment4)}}"
                                                                                        alt="Message Image"
                                                                                        style="height: 150px; width: 200px;">
                                                                            </label>
                                                                        </div>
                                                                        <p>{{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if(!empty($replies->customer_attachment5))
                                                            <div class="chat">
                                                                <div class="chat-avatar">
                                                                    <a class="avatar" data-toggle="tooltip" href="#"
                                                                            data-placement="right" title=""
                                                                            data-original-title=""> <img
                                                                                src="{{$replies->customer_pic?asset('user_photo/' .$replies->customer_pic ):asset('images/user.jpg')}}"
                                                                                class="box-shadow-4" alt="avatar"/> </a>
                                                                </div>
                                                                <div class="chat-body">
                                                                    <div class="chat-content customer-chat">
                                                                        <div class="click-zoom">
                                                                            <label> <input type="checkbox"> <img
                                                                                        src="{{asset('replies-attachments/'.$replies->customer_attachment5)}}"
                                                                                        alt="Message Image"
                                                                                        style="height: 150px; width: 200px;">
                                                                            </label>
                                                                        </div>
                                                                        <p>{{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </section>
                            <section class="chat-app-form" style="height: 20%;">
                                @if(!empty($data1))
                                    @if(@$data1->ticket_status == 'complete' || @$data1->ticket_status == 'no answer')
                                        <h5>You can not further reply to this Ticket.</h5>
                                    @else
                                        <form style="width: 98% !important;"
                                                action="{{route('customer.add_ticket_replies')}}"
                                                enctype="multipart/form-data" method="post"
                                                class="chat-app-input d-flex">
                                            @csrf
                                            <input type="hidden" name="customerID"
                                                    value="{{Auth::guard('customers')->user()->id}}"> <input
                                                    type="hidden" name="ticketID" value="{{@$data1->ticket_id}}">
                                            @if(!empty($sup))
                                                <input type="hidden" name="supporterID" value="{{$sup->id}}">
                                            @endif
                                            <fieldset class="col-10 m-0" id="add_files">
                                                <div class="input-group position-relative">
                                                    <input type="text" class="form-control"
                                                            placeholder="Ticket Message*...max 4000 chracters"
                                                            name="message" maxlength="4000" value="{{old('message')}}"
                                                            required="" aria-describedby="button-addon2"> <label
                                                            class="camera" title="Add image as a message"> <i
                                                                class="ficon ft-camera"></i> <input id="imgInp"
                                                                class="msg_pic" type="file" size="60" name="msg_pic[]"
                                                                multiple="" accept=".jpeg,.jpg,.png,.pdf,.docx">
                                                    </label>
                                                </div>
                                                <div class="input-group pics"></div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative col-2 m-0"
                                                    style="margin-left: -25px !important;">
                                                <button type="submit" class="btn btn-danger">
                                                    <span class=" d-lg-none d-xl-block">Send Message </span>
                                                </button>
                                            </fieldset>
                                        </form>
                                    <!-- <form action="{{route('customer.dropzone.store')}}" class="dropzone dropzone-area" id="dpz-file-limits" enctype="multipart/form-data" method="post">
                            @csrf
                                            <div class="dz-message">
                                                <br> Add Attachments <br>
                                                Drop Files Here Or Click To Upload
                                            </div>
                                        </form> -->
                                    @endif
                                @endif
                            </section>
                        </div>
                    @elseif(isset($_GET["OikgHtobntCsd8oF"]))
                        <div class="content-body" style="overflow-y: auto;">
                            <section class="chat-app-window">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-1 secondary text-bold-700"
                                                style="text-align: initial;"> TICKET #{{@$data1->ticket_id}} <br>
                                            <h4>{{@$data1->ticket_subject}}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="chats">
                                    <div class="chats">
                                        <div class="chat">
                                            <div class="chat-avatar">
                                                <a class="avatar" data-toggle="tooltip" href="#" data-placement="right"
                                                        title="" data-original-title=""> <img
                                                            src="{{ (Auth::guard('customers')->user()->photo)?asset('user_photo/'.Auth::guard('customers')->user()->photo):asset('images/user.jpg') }}"
                                                            class="box-shadow-4" alt="avatar"/> </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content customer-chat">
                                                    <p>{{@$data1->ticket_body}}<br>
                                                        <br>{{date('M d Y H:i', strtotime(@$data1->created_at))}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @if(!empty(@$data1->image_msg))
                                            <div class="chat">
                                                <div class="chat-avatar">
                                                    <a class="avatar" data-toggle="tooltip" href="#"
                                                            data-placement="right" title="" data-original-title=""> <img
                                                                src="{{ (Auth::guard('customers')->user()->photo)?asset('user_photo/'.Auth::guard('customers')->user()->photo):asset('images/user.jpg') }}"
                                                                class="box-shadow-4" alt="avatar"/> </a>
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-content customer-chat">
                                                        <div class="click-zoom">
                                                            <label> <input type="checkbox"> <img
                                                                        src="{{asset('replies-attachments/'.@$data1->image_msg)}}"
                                                                        alt="Message Image"
                                                                        style="height: 150px; width: 200px;"> </label>
                                                        </div>
                                                        <p>{{date('M d Y H:i', strtotime(@$data1->created_at))}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if(!empty(@$data1->attachment1))
                                            <div class="chat">
                                                <div class="chat-avatar">
                                                    <a class="avatar" data-toggle="tooltip" href="#"
                                                            data-placement="right" title="" data-original-title=""> <img
                                                                src="{{ (Auth::guard('customers')->user()->photo)?asset('user_photo/'.Auth::guard('customers')->user()->photo):asset('images/user.jpg') }}"
                                                                class="box-shadow-4" alt="avatar"/> </a>
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-content customer-chat">
                                                        <div class="click-zoom">
                                                            <label> <input type="checkbox"> <img
                                                                        src="{{asset('user-attachments/'.@$data1->attachment1)}}"
                                                                        alt="Message Image"
                                                                        style="height: 150px; width: 200px;"> </label>
                                                        </div>
                                                        <p>{{date('M d Y H:i', strtotime(@$data1->created_at))}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if(!empty(@$data1->attachment2))
                                            <div class="chat">
                                                <div class="chat-avatar">
                                                    <a class="avatar" data-toggle="tooltip" href="#"
                                                            data-placement="right" title="" data-original-title=""> <img
                                                                src="{{ (Auth::guard('customers')->user()->photo)?asset('user_photo/'.Auth::guard('customers')->user()->photo):asset('images/user.jpg') }}"
                                                                class="box-shadow-4" alt="avatar"/> </a>
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-content customer-chat">
                                                        <div class="click-zoom">
                                                            <label> <input type="checkbox"> <img
                                                                        src="{{asset('user-attachments/'.@$data1->attachment2)}}"
                                                                        alt="Message Image"
                                                                        style="height: 150px; width: 200px;"> </label>
                                                        </div>
                                                        <p>{{date('M d Y H:i', strtotime(@$data1->created_at))}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if(!empty(@$data1->attachment3))
                                            <div class="chat">
                                                <div class="chat-avatar">
                                                    <a class="avatar" data-toggle="tooltip" href="#"
                                                            data-placement="right" title="" data-original-title=""> <img
                                                                src="{{ (Auth::guard('customers')->user()->photo)?asset('user_photo/'.Auth::guard('customers')->user()->photo):asset('images/user.jpg') }}"
                                                                class="box-shadow-4" alt="avatar"/> </a>
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-content customer-chat">
                                                        <div class="click-zoom">
                                                            <label> <input type="checkbox"> <img
                                                                        src="{{asset('user-attachments/'.@$data1->attachment3)}}"
                                                                        alt="Message Image"
                                                                        style="height: 150px; width: 200px;"> </label>
                                                        </div>
                                                        <p>{{date('M d Y H:i', strtotime(@$data1->created_at))}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if(!empty(@$data1->attachment4))
                                            <div class="chat">
                                                <div class="chat-avatar">
                                                    <a class="avatar" data-toggle="tooltip" href="#"
                                                            data-placement="right" title="" data-original-title=""> <img
                                                                src="{{ (Auth::guard('customers')->user()->photo)?asset('user_photo/'.Auth::guard('customers')->user()->photo):asset('images/user.jpg') }}"
                                                                class="box-shadow-4" alt="avatar"/> </a>
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-content customer-chat">
                                                        <div class="click-zoom">
                                                            <label> <input type="checkbox"> <img
                                                                        src="{{asset('user-attachments/'.@$data1->attachment4)}}"
                                                                        alt="Message Image"
                                                                        style="height: 150px; width: 200px;"> </label>
                                                        </div>
                                                        <p>{{date('M d Y H:i', strtotime(@$data1->created_at))}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if(!empty(@$data1->attachment5))
                                            <div class="chat">
                                                <div class="chat-avatar">
                                                    <a class="avatar" data-toggle="tooltip" href="#"
                                                            data-placement="right" title="" data-original-title=""> <img
                                                                src="{{ (Auth::guard('customers')->user()->photo)?asset('user_photo/'.Auth::guard('customers')->user()->photo):asset('images/user.jpg') }}"
                                                                class="box-shadow-4" alt="avatar"/> </a>
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-content customer-chat">
                                                        <div class="click-zoom">
                                                            <label> <input type="checkbox"> <img
                                                                        src="{{asset('user-attachments/'.@$data1->attachment5)}}"
                                                                        alt="Message Image"
                                                                        style="height: 150px; width: 200px;"> </label>
                                                        </div>
                                                        <p>{{date('M d Y H:i', strtotime(@$data1->created_at))}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @foreach($tocket_replies as $replies)
                                            @if($replies->is_supporter_replied == 1)
                                                <div class="chat chat-left">
                                                    <div class="chat-avatar">
                                                        <a class="avatar" data-toggle="tooltip" href="#"
                                                                data-placement="left" title="" data-original-title="">
                                                            @if($replies->supporter_photo)
                                                                <img src="{{asset('user_photo/'.$replies->supporter_photo)}}"
                                                                        class="box-shadow-4" alt="avatar"/>
                                                            @else
                                                                <img src="{{asset('images/user.jpg')}}"
                                                                        class="box-shadow-4" alt="avatar"/>
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="chat-body">
                                                        <div class="chat-content">
                                                            <p>{{$replies->reply_body}} <br> <br>
                                                                {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                            </p>
                                                            <hr style="margin-right: 29px;margin-left: -10px;">
                                                            <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                                            <p>Please visit our <a href="#">FAQ Helpcenter</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(!empty($replies->image_msg))
                                                    <div class="chat chat-left">
                                                        <div class="chat-avatar">
                                                            <a class="avatar" data-toggle="tooltip" href="#"
                                                                    data-placement="left" title=""
                                                                    data-original-title="">
                                                                @if($replies->supporter_photo)
                                                                    <img src="{{asset('user_photo/'.$replies->supporter_photo)}}"
                                                                            class="box-shadow-4" alt="avatar"/>
                                                                @else
                                                                    <img src="{{asset('images/user.jpg')}}"
                                                                            class="box-shadow-4" alt="avatar"/>
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content">
                                                                <div class="click-zoom">
                                                                    <label> <input type="checkbox"> <img
                                                                                src="{{asset('replies-attachments/'.$replies->image_msg)}}"
                                                                                alt="Message Image"
                                                                                style="height: 150px; width: 200px;">
                                                                    </label>
                                                                </div>
                                                                <p>
                                                                    {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                </p>
                                                                <hr style="margin-right: 29px;margin-left: -10px;">
                                                                <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                                                <p>Please visit our <a href="#">FAQ Helpcenter</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(!empty($replies->supporter_attachment1))
                                                    <div class="chat chat-left">
                                                        <div class="chat-avatar">
                                                            <a class="avatar" data-toggle="tooltip" href="#"
                                                                    data-placement="left" title=""
                                                                    data-original-title="">
                                                                @if($replies->supporter_photo)
                                                                    <img src="{{asset('user_photo/'.$replies->supporter_photo)}}"
                                                                            class="box-shadow-4" alt="avatar"/>
                                                                @else
                                                                    <img src="{{asset('images/user.jpg')}}"
                                                                            class="box-shadow-4" alt="avatar"/>
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content">
                                                                <div class="click-zoom">
                                                                    <label> <input type="checkbox"> <img
                                                                                src="{{asset('replies-attachments/'.$replies->supporter_attachment1)}}"
                                                                                alt="Message Image"
                                                                                style="height: 150px; width: 200px;">
                                                                    </label>
                                                                </div>
                                                                <p>
                                                                    {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                </p>
                                                                <hr style="margin-right: 29px;margin-left: -10px;">
                                                                <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                                                <p>Please visit our <a href="#">FAQ Helpcenter</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(!empty($replies->supporter_attachment2))
                                                    <div class="chat chat-left">
                                                        <div class="chat-avatar">
                                                            <a class="avatar" data-toggle="tooltip" href="#"
                                                                    data-placement="left" title=""
                                                                    data-original-title="">
                                                                @if($replies->supporter_photo)
                                                                    <img src="{{asset('user_photo/'.$replies->supporter_photo)}}"
                                                                            class="box-shadow-4" alt="avatar"/>
                                                                @else
                                                                    <img src="{{asset('images/user.jpg')}}"
                                                                            class="box-shadow-4" alt="avatar"/>
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content">
                                                                <div class="click-zoom">
                                                                    <label> <input type="checkbox"> <img
                                                                                src="{{asset('replies-attachments/'.$replies->supporter_attachment2)}}"
                                                                                alt="Message Image"
                                                                                style="height: 150px; width: 200px;">
                                                                    </label>
                                                                </div>
                                                                <p>
                                                                    {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                </p>
                                                                <hr style="margin-right: 29px;margin-left: -10px;">
                                                                <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                                                <p>Please visit our <a href="#">FAQ Helpcenter</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(!empty($replies->supporter_attachment3))
                                                    <div class="chat chat-left">
                                                        <div class="chat-avatar">
                                                            <a class="avatar" data-toggle="tooltip" href="#"
                                                                    data-placement="left" title=""
                                                                    data-original-title="">
                                                                @if($replies->supporter_photo)
                                                                    <img src="{{asset('user_photo/'.$replies->supporter_photo)}}"
                                                                            class="box-shadow-4" alt="avatar"/>
                                                                @else
                                                                    <img src="{{asset('images/user.jpg')}}"
                                                                            class="box-shadow-4" alt="avatar"/>
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content">
                                                                <div class="click-zoom">
                                                                    <label> <input type="checkbox"> <img
                                                                                src="{{asset('replies-attachments/'.$replies->supporter_attachment3)}}"
                                                                                alt="Message Image"
                                                                                style="height: 150px; width: 200px;">
                                                                    </label>
                                                                </div>
                                                                <p>
                                                                    {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                </p>
                                                                <hr style="margin-right: 29px;margin-left: -10px;">
                                                                <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                                                <p>Please visit our <a href="#">FAQ Helpcenter</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(!empty($replies->supporter_attachment4))
                                                    <div class="chat chat-left">
                                                        <div class="chat-avatar">
                                                            <a class="avatar" data-toggle="tooltip" href="#"
                                                                    data-placement="left" title=""
                                                                    data-original-title="">
                                                                @if($replies->supporter_photo)
                                                                    <img src="{{asset('user_photo/'.$replies->supporter_photo)}}"
                                                                            class="box-shadow-4" alt="avatar"/>
                                                                @else
                                                                    <img src="{{asset('images/user.jpg')}}"
                                                                            class="box-shadow-4" alt="avatar"/>
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content">
                                                                <div class="click-zoom">
                                                                    <label> <input type="checkbox"> <img
                                                                                src="{{asset('replies-attachments/'.$replies->supporter_attachment4)}}"
                                                                                alt="Message Image"
                                                                                style="height: 150px; width: 200px;">
                                                                    </label>
                                                                </div>
                                                                <p>
                                                                    {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                </p>
                                                                <hr style="margin-right: 29px;margin-left: -10px;">
                                                                <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                                                <p>Please visit our <a href="#">FAQ Helpcenter</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(!empty($replies->supporter_attachment5))
                                                    <div class="chat chat-left">
                                                        <div class="chat-avatar">
                                                            <a class="avatar" data-toggle="tooltip" href="#"
                                                                    data-placement="left" title=""
                                                                    data-original-title="">
                                                                @if($replies->supporter_photo)
                                                                    <img src="{{asset('user_photo/'.$replies->supporter_photo)}}"
                                                                            class="box-shadow-4" alt="avatar"/>
                                                                @else
                                                                    <img src="{{asset('images/user.jpg')}}"
                                                                            class="box-shadow-4" alt="avatar"/>
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content">
                                                                <div class="click-zoom">
                                                                    <label> <input type="checkbox"> <img
                                                                                src="{{asset('replies-attachments/'.$replies->supporter_attachment5)}}"
                                                                                alt="Message Image"
                                                                                style="height: 150px; width: 200px;">
                                                                    </label>
                                                                </div>
                                                                <p>
                                                                    {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                </p>
                                                                <hr style="margin-right: 29px;margin-left: -10px;">
                                                                <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                                                <p>Please visit our <a href="#">FAQ Helpcenter</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @elseif($replies->is_customer_replied == 1)
                                                <div class="chat">
                                                    <div class="chat-avatar">
                                                        <a class="avatar" data-toggle="tooltip" href="#"
                                                                data-placement="right" title="" data-original-title="">
                                                            <img src="{{$replies->customer_pic?asset('user_photo/' .$replies->customer_pic ):asset('images/user.jpg')}}"
                                                                    class="box-shadow-4" alt="avatar"/> </a>
                                                    </div>
                                                    <div class="chat-body">
                                                        <div class="chat-content customer-chat">
                                                            <p>{{$replies->reply_body}} <br> <br>
                                                                {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(!empty($replies->image_msg))
                                                    <div class="chat">
                                                        <div class="chat-avatar">
                                                            <a class="avatar" data-toggle="tooltip" href="#"
                                                                    data-placement="right" title=""
                                                                    data-original-title=""> <img
                                                                        src="{{$replies->customer_pic?asset('user_photo/' .$replies->customer_pic ):asset('images/user.jpg')}}"
                                                                        class="box-shadow-4" alt="avatar"/> </a>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content customer-chat">
                                                                <div class="click-zoom">
                                                                    <label> <input type="checkbox"> <img
                                                                                src="{{asset('replies-attachments/'.$replies->image_msg)}}"
                                                                                alt="Message Image"
                                                                                style="height: 150px; width: 200px;">
                                                                    </label>
                                                                </div>
                                                                <p>
                                                                    {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(!empty($replies->customer_attachment1))
                                                    <div class="chat">
                                                        <div class="chat-avatar">
                                                            <a class="avatar" data-toggle="tooltip" href="#"
                                                                    data-placement="right" title=""
                                                                    data-original-title=""> <img
                                                                        src="{{$replies->customer_pic?asset('user_photo/' .$replies->customer_pic ):asset('images/user.jpg')}}"
                                                                        class="box-shadow-4" alt="avatar"/> </a>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content customer-chat">
                                                                <div class="click-zoom">
                                                                    <label> <input type="checkbox"> <img
                                                                                src="{{asset('replies-attachments/'.$replies->customer_attachment1)}}"
                                                                                alt="Message Image"
                                                                                style="height: 150px; width: 200px;">
                                                                    </label>
                                                                </div>
                                                                <p>
                                                                    {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(!empty($replies->customer_attachment2))
                                                    <div class="chat">
                                                        <div class="chat-avatar">
                                                            <a class="avatar" data-toggle="tooltip" href="#"
                                                                    data-placement="right" title=""
                                                                    data-original-title=""> <img
                                                                        src="{{$replies->customer_pic?asset('user_photo/' .$replies->customer_pic ):asset('images/user.jpg')}}"
                                                                        class="box-shadow-4" alt="avatar"/> </a>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content customer-chat">
                                                                <div class="click-zoom">
                                                                    <label> <input type="checkbox"> <img
                                                                                src="{{asset('replies-attachments/'.$replies->customer_attachment2)}}"
                                                                                alt="Message Image"
                                                                                style="height: 150px; width: 200px;">
                                                                    </label>
                                                                </div>
                                                                <p>
                                                                    {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(!empty($replies->customer_attachment3))
                                                    <div class="chat">
                                                        <div class="chat-avatar">
                                                            <a class="avatar" data-toggle="tooltip" href="#"
                                                                    data-placement="right" title=""
                                                                    data-original-title=""> <img
                                                                        src="{{$replies->customer_pic?asset('user_photo/' .$replies->customer_pic ):asset('images/user.jpg')}}"
                                                                        class="box-shadow-4" alt="avatar"/> </a>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content customer-chat">
                                                                <div class="click-zoom">
                                                                    <label> <input type="checkbox"> <img
                                                                                src="{{asset('replies-attachments/'.$replies->customer_attachment3)}}"
                                                                                alt="Message Image"
                                                                                style="height: 150px; width: 200px;">
                                                                    </label>
                                                                </div>
                                                                <p>
                                                                    {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(!empty($replies->customer_attachment4))
                                                    <div class="chat">
                                                        <div class="chat-avatar">
                                                            <a class="avatar" data-toggle="tooltip" href="#"
                                                                    data-placement="right" title=""
                                                                    data-original-title=""> <img
                                                                        src="{{$replies->customer_pic?asset('user_photo/' .$replies->customer_pic ):asset('images/user.jpg')}}"
                                                                        class="box-shadow-4" alt="avatar"/> </a>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content customer-chat">
                                                                <div class="click-zoom">
                                                                    <label> <input type="checkbox"> <img
                                                                                src="{{asset('replies-attachments/'.$replies->customer_attachment4)}}"
                                                                                alt="Message Image"
                                                                                style="height: 150px; width: 200px;">
                                                                    </label>
                                                                </div>
                                                                <p>
                                                                    {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(!empty($replies->customer_attachment5))
                                                    <div class="chat">
                                                        <div class="chat-avatar">
                                                            <a class="avatar" data-toggle="tooltip" href="#"
                                                                    data-placement="right" title=""
                                                                    data-original-title=""> <img
                                                                        src="{{$replies->customer_pic?asset('user_photo/' .$replies->customer_pic ):asset('images/user.jpg')}}"
                                                                        class="box-shadow-4" alt="avatar"/> </a>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content customer-chat">
                                                                <div class="click-zoom">
                                                                    <label> <input type="checkbox"> <img
                                                                                src="{{asset('replies-attachments/'.$replies->customer_attachment5)}}"
                                                                                alt="Message Image"
                                                                                style="height: 150px; width: 200px;">
                                                                    </label>
                                                                </div>
                                                                <p>
                                                                    {{date('M d Y H:i', strtotime($replies->created_at))}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                            <section class="chat-app-form">
                                @if(@$data1->ticket_status == 'complete' || @$data1->ticket_status == 'no answer')
                                    <h5>You can not further reply to this Ticket.</h5>
                                @else
                                    <form style="width: 98% !important;"
                                            action="{{route('customer.add_ticket_replies')}}"
                                            enctype="multipart/form-data" method="post" class="chat-app-input d-flex">
                                        @csrf
                                        <input type="hidden" name="customerID"
                                                value="{{Auth::guard('customers')->user()->id}}"> <input type="hidden"
                                                name="ticketID" value="{{@$data1->ticket_id}}">
                                        @if(!empty($sup))
                                            <input type="hidden" name="supporterID" value="{{$sup->id}}">
                                        @endif
                                        <fieldset class="col-10 m-0" id="add_files">
                                            <div class="input-group position-relative">
                                                <input type="text" class="form-control"
                                                        placeholder="Ticket Message*...max 4000 chracters"
                                                        name="message" maxlength="4000" value="{{old('message')}}"
                                                        required="" aria-describedby="button-addon2"> <label
                                                        class="camera" title="Add image as a message"> <i
                                                            class="ficon ft-camera"></i> <input id="imgInp"
                                                            class="msg_pic" type="file" size="60" name="msg_pic[]"
                                                            multiple="" accept=".jpeg,.jpg,.png,.pdf,.docx"> </label>
                                            </div>
                                            <div class="input-group pics"></div>
                                        </fieldset>
                                        <fieldset class="form-group position-relative col-2 m-0"
                                                style="margin-left: -25px !important;">
                                            <button type="submit" class="btn btn-danger">
                                                <span class="d-none d-lg-none d-xl-block">Send Message </span>
                                            </button>
                                        </fieldset>
                                    </form><br>
                                @endif
                            </section>
                        </div>
                    @elseif(isset($_GET["action"]))
                        <div class="content-body" style="width: 155%;margin-left: -3%;">
                            <section class="chat-app-window default">
                                <div class="mb-1 secondary text-bold-700">
                                    <form class="Ticket_form" action="{{route('customer.add_ticket')}}"
                                            enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="ticket No"><b>Ticket ID*: </b></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="hidden" name="ticket_no" value="UCS-{{$ticket_id}}">
                                                    <input type="text" name="ticket_no" value="UCS-{{$ticket_id}}"
                                                            class="form-control" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="subject" class="form-control ticket_subject"
                                                    placeholder="Subject*" value="{{old('subject')}}" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control add_ticket_text" name="message" id="message"
                                                    placeholder="Ticket Message*...max 4000 chracters" maxlength="4000"
                                                    value="{{old('message')}}" rows="8" cols="130"
                                                    required=""></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                                                            name="msg_pic[]" aria-describedby="inputGroupFileAddon01"
                                                            multiple="" accept=".jpeg,.jpg,.png,.pdf,.docx"> <label
                                                            class="custom-file-label" for="inputGroupFile01"
                                                            style="text-align: initial;">Chose one or miltiple files</label>
                                                </div>
                                            </div>
                                            <div class="input-group add_new_pics"></div>
                                        </div>

                                    </form>
                                    <!-- <div class="form-group" > -->
                                <!-- <form action="{{route('customer.dropzone.store')}}" class="dropzone dropzone-area" id="dpz-file-limits" enctype="multipart/form-data" method="post">
                                    @csrf
                                        <div class="dz-message">
                                            <br>Add Attachments <br>
                                            Drop Files Here Or Click To Upload
                                        </div>
                                    </form> -->
                                    <!-- </div> -->
                                    <div class="form-group">
                                        <input type="submit" name="submit" class="btn btn-success add_new_ticket_btn"
                                                style="float:right;">
                                    </div>
                                </div>
                            </section>
                        </div>
                    @endif
                </div>
            </div>


            <div class="col-md-3"
                    style=" @if(isset($_GET['action'])) z-index: -2 !important @else z-index: 3 !important @endif">
                @if(isset($_GET["OikgHtobntCsd8oF"]))
                    <div class="content-wrapper">
                        <!-- <div class="content-wrapper-before"></div> -->
                        <div class="content-header row"></div>
                        <div class="content-body">
                            <section class="default"
                                    style="padding: 0px;overflow-x: hidden;background-color: white;background-image: none;margin-left: -6%;height: 586px;overflow-y: auto;">
                                <div class="card" style="background-color: #edeef0;padding: 5px;">
                                    <div class="mb-1 secondary text-bold-700 mt-2" style="    background-color: white;">
                                        <div class="mb-1 secondary text-bold-700">
                                            TICKET #{{@$data1->ticket_id}} <br> <span
                                                    class="ticket_status">{{@$data1->ticket_status}}</span>
                                        </div>
                                        <div class="mb-1 ml-1 secondary text-bold-700"
                                                style="text-align: left;">Your Supporter <br>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="chat-avatar">
                                                        <a class="avatar" data-toggle="tooltip" href="#"
                                                                data-placement="left" title="" data-original-title="">
                                                            @if(!empty($sup))
                                                                @if($sup->photo)
                                                                    <img src="{{asset('user_photo/'.$sup->photo)}}"
                                                                            class="box-shadow-4" alt="avatar"
                                                                            style="width: 140%;max-width: 140%;"/>
                                                                @else
                                                                    <img src="{{asset('images/user.jpg')}}"
                                                                            class="box-shadow-4" alt="avatar"
                                                                            style="width: 140%;max-width: 140%;"/>
                                                                @endif
                                                            @endif
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    @if(!empty($sup))
                                                        {{$sup->first_name}} {{$sup->surname}}
                                                        <br>
                                                        {{$sup_role->name}}
                                                    @else
                                                        <span>No Supporter assigned</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row mt-4 mb-4 attachments">
                                                <div class="col-md-12">
                                                    <h6><i class="ficon ft-paperclip"></i>Attachments</h6>
                                                </div>
                                                <div class="col-md-12" style="overflow-y: auto;height: 250px;">
                                                    @if(!empty(@$data1->image_msg))
                                                        <a href="{{url('replies-attachments')}}/{{@$data1->image_msg}}"
                                                                target="_blank" title="">{{@$data1->image_msg}}</a><br>
                                                    @endif
                                                    @if(!empty(@$data1->attachment1))
                                                        <a href="{{url('user-attachments')}}/{{@$data1->attachment1}}"
                                                                target="_blank" title="">{{@$data1->attachment1}}</a>
                                                        <br>
                                                    @endif
                                                    @if(!empty(@$data1->attachment2))
                                                        <a href="{{url('user-attachments')}}/{{@$data1->attachment2}}"
                                                                target="_blank" title="">{{@$data1->attachment2}}</a>
                                                        <br>
                                                    @endif
                                                    @if(!empty(@$data1->attachment3))
                                                        <a href="{{url('user-attachments')}}/{{@$data1->attachment3}}"
                                                                target="_blank" title="">{{@$data1->attachment3}}</a>
                                                        <br>
                                                    @endif
                                                    @if(!empty(@$data1->attachment4))
                                                        <a href="{{url('user-attachments')}}/{{@$data1->attachment4}}"
                                                                target="_blank" title="">{{@$data1->attachment4}}</a>
                                                        <br>
                                                    @endif
                                                    @if(!empty(@$data1->attachment5))
                                                        <a href="{{url('user-attachments')}}/{{@$data1->attachment5}}"
                                                                target="_blank" title="">{{@$data1->attachment5}}</a>
                                                        <br>
                                                    @endif
                                                    @foreach($tocket_replies as $replies)
                                                        @if($replies->is_supporter_replied == 1)
                                                            @if(!empty($replies->image_msg))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->image_msg}}"
                                                                        target="_blank"
                                                                        title="">{{$replies->image_msg}}</a><br>
                                                            @endif
                                                            @if(!empty($replies->supporter_attachment1))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment1}}"
                                                                        target="_blank"
                                                                        title="">{{$replies->supporter_attachment1}}</a>
                                                                <br>
                                                            @endif
                                                            @if(!empty($replies->supporter_attachment2))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment2}}"
                                                                        target="_blank"
                                                                        title="">{{$replies->supporter_attachment2}}</a>
                                                                <br>
                                                            @endif
                                                            @if(!empty($replies->supporter_attachment3))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment3}}"
                                                                        target="_blank"
                                                                        title="">{{$replies->supporter_attachment3}}</a>
                                                                <br>
                                                            @endif
                                                            @if(!empty($replies->supporter_attachment4))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment4}}"
                                                                        target="_blank"
                                                                        title="">{{$replies->supporter_attachment4}}</a>
                                                                <br>
                                                            @endif
                                                            @if(!empty($replies->supporter_attachment5))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment5}}"
                                                                        target="_blank"
                                                                        title="">{{$replies->supporter_attachment5}}</a>
                                                                <br>
                                                            @endif
                                                        @elseif($replies->is_customer_replied == 1)
                                                            @if(!empty($replies->image_msg))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->image_msg}}"
                                                                        target="_blank"
                                                                        title="">{{$replies->image_msg}}</a><br>
                                                            @endif
                                                            @if(!empty($replies->customer_attachment1))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment1}}"
                                                                        target="_blank"
                                                                        title="">{{$replies->customer_attachment1}}</a>
                                                                <br>
                                                            @endif
                                                            @if(!empty($replies->customer_attachment2))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment2}}"
                                                                        target="_blank"
                                                                        title="">{{$replies->customer_attachment2}}</a>
                                                                <br>
                                                            @endif
                                                            @if(!empty($replies->customer_attachment3))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment3}}"
                                                                        target="_blank"
                                                                        title="">{{$replies->customer_attachment3}}</a>
                                                                <br>
                                                            @endif
                                                            @if(!empty($replies->customer_attachment4))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment4}}"
                                                                        target="_blank"
                                                                        title="">{{$replies->customer_attachment4}}</a>
                                                                <br>
                                                            @endif
                                                            @if(!empty($replies->customer_attachment5))
                                                                <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment5}}"
                                                                        target="_blank"
                                                                        title="">{{$replies->customer_attachment5}}</a>
                                                                <br>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <h6><a href="#" title="">VISIT OUR HELPCENTER</a></h6>
                                        </div>
                                    </div>
                                </div>

                            </section>
                        </div>
                    </div>
            </div>
            @endif
            @if(isset($_GET["last_ticket"]))

                <div class="content-wrapper">
                    <div class="content-header row"></div>
                    <div class="content-body">
                        <section class="default" style="
                      padding: 0px;overflow-x: hidden;background-color: white;background-image: none;margin-left: 3%;height: 586px;overflow-y: auto;">
                            @if(!empty($last_ticket))
                                <div class="card" style="background-color: #edeef0;padding: 5px;">
                                    <div class="mb-1 secondary text-bold-700 mt-2" style="background-color: white;">
                                        <div class="mb-1 secondary text-bold-700">
                                            TICKET #{{@$data1->ticket_id}} <br> <span
                                                    class="ticket_status">{{@$data1->ticket_status}}</span>
                                        </div>
                                        <div class="mb-1 ml-1 secondary text-bold-700"
                                                style="text-align: left;">Your Supporter <br>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="chat-avatar">
                                                        <a class="avatar" data-toggle="tooltip" href="#"
                                                                data-placement="left" title="" data-original-title="">
                                                            @if(!empty($sup))
                                                                @if($sup->photo)
                                                                    <img src="{{asset('user_photo/'.$sup->photo)}}"
                                                                            class="box-shadow-4" alt="avatar"
                                                                            style="width: 140%;max-width: 140%;"/>
                                                                @else
                                                                    <img src="{{asset('images/user.jpg')}}"
                                                                            class="box-shadow-4" alt="avatar"
                                                                            style="width: 140%;max-width: 140%;"/>
                                                                @endif
                                                            @endif
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    @if(!empty($sup))
                                                        {{$sup->first_name}} {{$sup->surname}}
                                                        <br>
                                                        {{$sup_role->name}}
                                                    @else
                                                        <span>No Supporter assigned</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row mt-4 mb-4 attachments">
                                                <div class="col-md-12">
                                                    <h6><i class="ficon ft-paperclip"></i>Attachments</h6>
                                                </div>
                                                <div class="col-md-12" style="height: 250px;overflow-y: auto;">
                                                    @if(!empty(@$data1->image_msg))
                                                        <a href="{{url('replies-attachments')}}/{{@$data1->image_msg}}"
                                                                target="_blank" title="">{{@$data1->image_msg}}</a><br>
                                                    @endif
                                                    @if(!empty(@$data1->attachment1))
                                                        <a href="{{url('user-attachments')}}/{{@$data1->attachment1}}"
                                                                target="_blank" title="">{{@$data1->attachment1}}</a>
                                                        <br>
                                                    @endif
                                                    @if(!empty(@$data1->attachment2))
                                                        <a href="{{url('user-attachments')}}/{{@$data1->attachment2}}"
                                                                target="_blank" title="">{{@$data1->attachment2}}</a>
                                                        <br>
                                                    @endif
                                                    @if(!empty(@$data1->attachment3))
                                                        <a href="{{url('user-attachments')}}/{{@$data1->attachment3}}"
                                                                target="_blank" title="">{{@$data1->attachment3}}</a>
                                                        <br>
                                                    @endif
                                                    @if(!empty(@$data1->attachment4))
                                                        <a href="{{url('user-attachments')}}/{{@$data1->attachment4}}"
                                                                target="_blank" title="">{{@$data1->attachment4}}</a>
                                                        <br>
                                                    @endif
                                                    @if(!empty(@$data1->attachment5))
                                                        <a href="{{url('user-attachments')}}/{{@$data1->attachment5}}"
                                                                target="_blank" title="">{{@$data1->attachment5}}</a>
                                                        <br>
                                                    @endif
                                                    @if(!empty($tocket_replies))
                                                        @foreach($tocket_replies as $replies)
                                                            @if($replies->is_supporter_replied == 1)
                                                                @if(!empty($replies->image_msg))
                                                                    <a href="{{url('replies-attachments')}}/{{$replies->image_msg}}"
                                                                            target="_blank"
                                                                            title="">{{$replies->image_msg}}</a><br>
                                                                @endif
                                                                @if(!empty($replies->supporter_attachment1))
                                                                    <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment1}}"
                                                                            target="_blank"
                                                                            title="">{{$replies->supporter_attachment1}}</a>
                                                                    <br>
                                                                @endif
                                                                @if(!empty($replies->supporter_attachment2))
                                                                    <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment2}}"
                                                                            target="_blank"
                                                                            title="">{{$replies->supporter_attachment2}}</a>
                                                                    <br>
                                                                @endif
                                                                @if(!empty($replies->supporter_attachment3))
                                                                    <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment3}}"
                                                                            target="_blank"
                                                                            title="">{{$replies->supporter_attachment3}}</a>
                                                                    <br>
                                                                @endif
                                                                @if(!empty($replies->supporter_attachment4))
                                                                    <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment4}}"
                                                                            target="_blank"
                                                                            title="">{{$replies->supporter_attachment4}}</a>
                                                                    <br>
                                                                @endif
                                                                @if(!empty($replies->supporter_attachment5))
                                                                    <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment5}}"
                                                                            target="_blank"
                                                                            title="">{{$replies->supporter_attachment5}}</a>
                                                                    <br>
                                                                @endif
                                                            @elseif($replies->  is_customer_replied == 1)
                                                                @if(!empty($replies->image_msg))
                                                                    <a href="{{url('replies-attachments')}}/{{$replies->image_msg}}"
                                                                            target="_blank"
                                                                            title="">{{$replies->image_msg}}</a><br>
                                                                @endif
                                                                @if(!empty($replies->customer_attachment1))
                                                                    <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment1}}"
                                                                            target="_blank"
                                                                            title="">{{$replies->customer_attachment1}}</a>
                                                                    <br>
                                                                @endif
                                                                @if(!empty($replies->customer_attachment2))
                                                                    <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment2}}"
                                                                            target="_blank"
                                                                            title="">{{$replies->customer_attachment2}}</a>
                                                                    <br>
                                                                @endif
                                                                @if(!empty($replies->customer_attachment3))
                                                                    <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment3}}"
                                                                            target="_blank"
                                                                            title="">{{$replies->customer_attachment3}}</a>
                                                                    <br>
                                                                @endif
                                                                @if(!empty($replies->customer_attachment4))
                                                                    <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment4}}"
                                                                            target="_blank"
                                                                            title="">{{$replies->customer_attachment4}}</a>
                                                                    <br>
                                                                @endif
                                                                @if(!empty($replies->customer_attachment5))
                                                                    <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment5}}"
                                                                            target="_blank"
                                                                            title="">{{$replies->customer_attachment5}}</a>
                                                                    <br>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <h6><a href="#" title="">VIST OUR HELPCENTER</a></h6>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </section>
                    </div>
                </div>
        </div>

        @endif


    </div>
    </div>



    </div>
    <!-- END: Content-->
@endsection

@section('scripts')
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"
            type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"
            type="text/javascript"></script>
    @if (Session::has('success'))
        <script>
            $.toast({
                heading: 'Success',
                text: '{{ Session::get("success") }}',
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-right'
            })
        </script>
    @endif

    @if (Session::has('danger'))

        <script>
            $.toast({
                heading: 'Error',
                text: '{{ Session::get("danger") }}',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right'
            })
        </script>
    @endif
    <script>
        if(window.location.href == 'https://uc2.schmidt-tudl-it.de/customer/tickets'){
            window.location.replace('https://uc2.schmidt-tudl-it.de/customer/tickets?last_ticket=');
        }
    </script>
    <script>
        $('.ticket_list').click(function () {
            $(this).addClass('border-right-primary border-right-2').siblings().removeClass('border-right-primary border-right-2');
        });
    </script>
    <script>
        $('.add_new_ticket_btn').on('click', function () {
            var x = $('.ticket_subject').val();
            var y = $('.add_ticket_text').val();

            if (x === "" && y === "") {
                // alert("Subject and message must be filled out");
                $.toast({
                    heading: 'Error',
                    text: 'Subject and message must be filled out',
                    showHideTransition: 'fade',
                    icon: 'error',
                    position: 'top-right'
                })
                $('.ticket_subject').css('border', '1px solid red');
                $('.add_ticket_text').css('border', '1px solid red');
                return false;
            } else if (x === "") {
                // alert("Subject must be filled out");
                $.toast({
                    heading: 'Error',
                    text: 'Subject must be filled out',
                    showHideTransition: 'fade',
                    icon: 'error',
                    position: 'top-right'
                })
                $('.ticket_subject').css('border', '1px solid red');
                return false;
            } else if (y === "") {
                // alert("Message must be filled out");
                $.toast({
                    heading: 'Error',
                    text: 'Message must be filled out',
                    showHideTransition: 'fade',
                    icon: 'error',
                    position: 'top-right'
                })
                $('.add_ticket_text').css('border', '1px solid red');
                return false;
            } else {
                $('.Ticket_form').submit();
            }
        });

        $(".ticket_subject").keyup(function () {
            $(".ticket_subject").css('border', '1px solid lightgray');
        });
        $(".add_ticket_text").keyup(function () {
            $(".add_ticket_text").css('border', '1px solid lightgray');
        });
    </script>
    <script>
        $('.dz-remove').on('click', function () {
            alert('do something amazing here....');
        })
    </script>
    <script>
        $(function () {
            // Multiple images preview in browser
            var imagesPreview = function (input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;
                    if (filesAmount <= 5) {
                        for (i = 0; i < filesAmount; i++) {
                            var reader = new FileReader();

                            reader.onload = function (event) {
                                $($.parseHTML('<img>')).attr('src', event.target.result).attr('name', 'msg_pic[' + i + ']').appendTo(placeToInsertImagePreview);
                            }

                            reader.readAsDataURL(input.files[i]);

                            // j++;
                        }
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'You are allowed to upload max 5 files.',
                            showHideTransition: 'fade',
                            icon: 'error',
                            position: 'top-right'
                        })
                    }
                }

            };

            $('#imgInp').on('change', function () {
                $('div.pics').empty();
                imagesPreview(this, 'div.pics');
            });

            $('#inputGroupFile01').on('change', function () {
                $('div.pics').empty();
                imagesPreview(this, 'div.add_new_pics');
            });
        });
    </script>
@endsection