@extends('admin.tickets.ticket_layout')

@section('page_styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/ui/prism.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/file-uploaders/dropzone.css')}}">
<style>
    .pics img{
        height: 100px;
        margin-top: 10px;
        padding: 9px;
    }
    .add_more_files{
        color: #5654c8 !important;
    }
    .customer-chat {
        background-color: #0c78be !important;
    }
    .ft-delete{
        font-size: 20px;
        position: absolute;
        margin-left: 89%;
        margin-top: -6px;
        z-index: 9;
        cursor: pointer;
    }
    .chat-application .users-list-padding {
        padding-top: 0px !important;
        padding-bottom: 60px;
    }
    .chat-application .content-right{
        height: 100%;
        width: calc(100% - 0px) !important;
    }
    .ticket_status{
        color: orange;
        border: 1px solid orange;
        font-size: 11px;
        padding: 2px 7px;
        border-radius: 50px;
    }
    .ticket_status_hsitory{
        color: orange;
        border: 1px solid orange;
        font-size: 15px;
        padding: 3px 10px;
        border-radius: 50px;
    }
    .chat-content a{
        color: #a5d8ed;
    }
    .chat-content p{
        text-align:left;
    }
    input[type="file"]{
        font-size: 12px;
        width: 171px;
    }
    .outer_body{
        margin-left: 2%;
        margin-right: 2%;
        margin-bottom: 3%;
        padding-bottom: 0px;
        background-color: #edeef0;
        border-radius: 10px;
    }
    .customer{
        width: 68% !important;
        max-width: 68% !important;
        height: auto !important;
        border: 0 none !important;
        border-radius: 1000px !important;
        margin-left: 36%;
    }
    .customer-image{
        width: 110% !important;
        max-width: 110% !important;
        height: auto !important;
        border: 0 none !important;
        border-radius: 1000px !important;
        margin-left: 36%;
    }
    .cust_detail{
        float: right;
        background-color: white;
        color: #7473d2;
        border-radius: 50px;
    }
    .cust_detail:hover{
        color: white !important;
    }
    .history_table{
        border-top: 1px solid lightgray;
        width: 100%;
        text-align: initial;
    }
    .history_table td{
        padding: 8px 0px 8px 0px;
        font-size: 12px;
    }
    .history_table tr{
        border-bottom: 1px solid lightgray; 
    }
    .modal-header{
        border-bottom: 1px solid lightgray;
    }
    .detail_outer_body{
        margin-left: 2%;
        margin-right: 2%;
        margin-bottom: 4%;
        padding-bottom: 1px;
        background-color: #edeef0;
        border-radius: 10px;
    }
    .ticket_hsitory_card{
        width: 456px;
        float: right;
        margin-top: -62%;
        height: 103%;
        overflow-y: auto;
        position: absolute;
        margin-left: 639px;
        height: 100% !important;
        overflow-x: hidden;
        @if( $data->ticket_status == 'complete' || $data->ticket_status == 'no answer')
        margin-top: -57%;
        @else
        margin-top: -70%;
        @endif
    }
    .dropzone {
        min-height: 179px;
        border: 2px dashed #6967ce;
        background: #F4F5FA;
    }
    .dropzone .dz-message:before {
        content: "\e9d1";
        font-family: 'feather';
        font-size: 60px;
        position: absolute;
        top: 48px;
        width: 80px;
        height: 80px;
        display: inline-block;
        left: 50%;
        margin-left: -40px;
        line-height: 1;
        z-index: 2;
        color: #6967ce;
        text-indent: 0px;
        font-weight: normal;
        -webkit-font-smoothing: antialiased;
    }
    .dropzone .dz-message {
        font-size: 1rem;
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        height: 300px;
        margin-top: -30px;
        color: #6967ce;
        text-align: center;
    }
    .camera{
        display: block;
        font-size: 30px;
        position: absolute;
        margin-left: 90%;
        cursor: pointer;
        z-index: 999;
     }
    .msg_pic{
        display: none;
    }
    .message_pic{
        margin-top: 7px !important;
        margin-right: 75%;
        display: none;
        height: 100px;
    }
    .click-zoom input[type=checkbox] {
      display: none
    }

    .click-zoom img {
      
      transition: transform 0.75s ease;
      cursor: zoom-in
    }

    .click-zoom input[type=checkbox]:checked~img {
      transform: scale(2);
      margin: 50px;
      cursor: zoom-out
    }

    .avatar {
        position: relative;
        display: inline-block;
        width: 40px;
        white-space: nowrap;
        border-radius: 1000px;
        vertical-align: bottom;
    }
    .chat-application .chat-app-window {
        height: 500px !important;
    }

</style>
@endsection
@section('content')
 <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-right">
            <div class="content-wrapper">
                <div class="content-wrapper-before"></div>
                <div class="content-header row">
                </div>
                <div class="content-body" style="overflow-y: auto;overflow-x: hidden;">



<div class="row">
    <div class="col-md-7">
    <section class="chat-app-window">
                        <a href="{{route('admin.tickets')}}" title=""><span style="float: left;"><i class="ficon ft-arrow-left"></i>Back</span></a>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-1 secondary text-bold-700" style="text-align: initial;">TICKET #{{$data->ticket_id}} <br> 
                                    <h5>{{$data->ticket_subject}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="chats">
                            <div class="chats">
                                <div class="chat">
                                    <div class="chat-avatar">
                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                            <img src="{{asset('user_photo/'.$customer->photo)}}" class="box-shadow-4" alt="avatar" />
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content customer-chat">
                                            <p>{{$data->ticket_body}} <br>
                                            <br>{{date('M d Y H:i', strtotime($data->created_at))}}</p>
                                        </div>
                                    </div>
                                </div>
                                @if(!empty($data->image_msg))
                                <div class="chat">
                                    <div class="chat-avatar">
                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                            <img src="{{asset('user_photo/'.$customer->photo)}}" class="box-shadow-4" alt="avatar" />
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content customer-chat">
                                            <div class="click-zoom">
                                              <label>
                                                <input type="checkbox">
                                                   <img src="{{asset('replies-attachments/'.$data->image_msg)}}" alt="Message Image" style="height: 150px; width: 200px;">
                                              </label>
                                            </div>
                                            <p>{{date('M d Y H:i', strtotime($data->created_at))}}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(!empty($data->attachment1))
                                <div class="chat">
                                    <div class="chat-avatar">
                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                            <img src="{{asset('user_photo/'.$customer->photo)}}" class="box-shadow-4" alt="avatar" />
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content customer-chat">
                                            <div class="click-zoom">
                                              <label>
                                                <input type="checkbox">
                                                   <img src="{{asset('user-attachments/'.$data->attachment1)}}" alt="Message Image" style="height: 150px; width: 200px;">
                                              </label>
                                            </div>
                                            <p>{{date('M d Y H:i', strtotime($data->created_at))}}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(!empty($data->attachment2))
                                <div class="chat">
                                    <div class="chat-avatar">
                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                            <img src="{{asset('user_photo/'.$customer->photo)}}" class="box-shadow-4" alt="avatar" />
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content customer-chat">
                                            <div class="click-zoom">
                                              <label>
                                                <input type="checkbox">
                                                   <img src="{{asset('user-attachments/'.$data->attachment2)}}" alt="Message Image" style="height: 150px; width: 200px;">
                                              </label>
                                            </div>
                                            <p>{{date('M d Y H:i', strtotime($data->created_at))}}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(!empty($data->attachment3))
                                <div class="chat">
                                    <div class="chat-avatar">
                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                            <img src="{{asset('user_photo/'.$customer->photo)}}" class="box-shadow-4" alt="avatar" />
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content customer-chat">
                                            <div class="click-zoom">
                                              <label>
                                                <input type="checkbox">
                                                   <img src="{{asset('user-attachments/'.$data->attachment3)}}" alt="Message Image" style="height: 150px; width: 200px;">
                                              </label>
                                            </div>
                                            <p>{{date('M d Y H:i', strtotime($data->created_at))}}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(!empty($data->attachment4))
                                <div class="chat">
                                    <div class="chat-avatar">
                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                            <img src="{{asset('user_photo/'.$customer->photo)}}" class="box-shadow-4" alt="avatar" />
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content customer-chat">
                                            <div class="click-zoom">
                                              <label>
                                                <input type="checkbox">
                                                   <img src="{{asset('user-attachments/'.$data->attachment4)}}" alt="Message Image" style="height: 150px; width: 200px;">
                                              </label>
                                            </div>
                                            <p>{{date('M d Y H:i', strtotime($data->created_at))}}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(!empty($data->attachment5))
                                <div class="chat">
                                    <div class="chat-avatar">
                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                            <img src="{{asset('user_photo/'.$customer->photo)}}" class="box-shadow-4" alt="avatar" />
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content customer-chat">
                                            <div class="click-zoom">
                                              <label>
                                                <input type="checkbox">
                                                   <img src="{{asset('user-attachments/'.$data->attachment5)}}" alt="Message Image" style="height: 150px; width: 200px;">
                                              </label>
                                            </div>
                                            <p>{{date('M d Y H:i', strtotime($data->created_at))}}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @foreach($tocket_replies as $replies)
                                @if($replies->is_supporter_replied == 1)
                                <div class="chat chat-left">
                                    <div class="chat-avatar">
                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                            @if(!$replies->sup_photo)
                                            <img src="{{asset('images/user.jpg')}}" class="box-shadow-4" alt="avatar" />
                                            @else
                                            <img src="{{asset('user_photo/' .$replies->sup_photo )}}" class="box-shadow-4" alt="avatar" />
                                            @endif
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content">
                                            <p>{{$replies->reply_body}} <br>
                                             <br>
                                            {{date('M d Y H:i', strtotime($replies->created_at))}}
                                        </p>
                                        <hr style="margin-right: 29px;margin-left: -10px;">
                                            <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                        </div>
                                    </div>
                                </div>
                                @if(!empty($replies->image_msg))
                                <div class="chat chat-left">
                                    <div class="chat-avatar">
                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                            @if(!$replies->sup_photo)
                                            <img src="{{asset('images/user.jpg')}}" class="box-shadow-4" alt="avatar" />
                                            @else
                                            <img src="{{asset('user_photo/' .$replies->sup_photo )}}" class="box-shadow-4" alt="avatar" />
                                            @endif
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content">
                                            <div class="click-zoom">
                                              <label>
                                                <input type="checkbox">
                                                   <img src="{{asset('replies-attachments/'.$replies->image_msg)}}" alt="Message Image" style="height: 150px; width: 200px;">
                                              </label>
                                            </div>
                                            <p>
                                            {{date('M d Y H:i', strtotime($replies->created_at))}}
                                        </p>
                                        <hr style="margin-right: 29px;margin-left: -10px;">
                                            <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(!empty($replies->supporter_attachment1))
                                <div class="chat chat-left">
                                    <div class="chat-avatar">
                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                            @if(!$replies->sup_photo)
                                            <img src="{{asset('images/user.jpg')}}" class="box-shadow-4" alt="avatar" />
                                            @else
                                            <img src="{{asset('user_photo/' .$replies->sup_photo )}}" class="box-shadow-4" alt="avatar" />
                                            @endif
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content">
                                            <div class="click-zoom">
                                              <label>
                                                <input type="checkbox">
                                                   <img src="{{asset('replies-attachments/'.$replies->supporter_attachment1)}}" alt="Message Image" style="height: 150px; width: 200px;">
                                              </label>
                                            </div>
                                            <p>
                                            {{date('M d Y H:i', strtotime($replies->created_at))}}
                                        </p>
                                        <hr style="margin-right: 29px;margin-left: -10px;">
                                            <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(!empty($replies->supporter_attachment2))
                                <div class="chat chat-left">
                                    <div class="chat-avatar">
                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                            @if(!$replies->sup_photo)
                                            <img src="{{asset('images/user.jpg')}}" class="box-shadow-4" alt="avatar" />
                                            @else
                                            <img src="{{asset('user_photo/' .$replies->sup_photo )}}" class="box-shadow-4" alt="avatar" />
                                            @endif
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content">
                                            <div class="click-zoom">
                                              <label>
                                                <input type="checkbox">
                                                   <img src="{{asset('replies-attachments/'.$replies->supporter_attachment2)}}" alt="Message Image" style="height: 150px; width: 200px;">
                                              </label>
                                            </div>
                                            <p>
                                            {{date('M d Y H:i', strtotime($replies->created_at))}}
                                        </p>
                                        <hr style="margin-right: 29px;margin-left: -10px;">
                                            <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(!empty($replies->supporter_attachment3))
                                <div class="chat chat-left">
                                    <div class="chat-avatar">
                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                            @if(!$replies->sup_photo)
                                            <img src="{{asset('images/user.jpg')}}" class="box-shadow-4" alt="avatar" />
                                            @else
                                            <img src="{{asset('user_photo/' .$replies->sup_photo )}}" class="box-shadow-4" alt="avatar" />
                                            @endif
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content">
                                            <div class="click-zoom">
                                              <label>
                                                <input type="checkbox">
                                                   <img src="{{asset('replies-attachments/'.$replies->supporter_attachment3)}}" alt="Message Image" style="height: 150px; width: 200px;">
                                              </label>
                                            </div>
                                            <p>
                                            {{date('M d Y H:i', strtotime($replies->created_at))}}
                                        </p>
                                        <hr style="margin-right: 29px;margin-left: -10px;">
                                            <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(!empty($replies->supporter_attachment4))
                                <div class="chat chat-left">
                                    <div class="chat-avatar">
                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                            @if(!$replies->sup_photo)
                                            <img src="{{asset('images/user.jpg')}}" class="box-shadow-4" alt="avatar" />
                                            @else
                                            <img src="{{asset('user_photo/' .$replies->sup_photo )}}" class="box-shadow-4" alt="avatar" />
                                            @endif
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content">
                                            <div class="click-zoom">
                                              <label>
                                                <input type="checkbox">
                                                   <img src="{{asset('replies-attachments/'.$replies->supporter_attachment4)}}" alt="Message Image" style="height: 150px; width: 200px;">
                                              </label>
                                            </div>
                                            <p>
                                            {{date('M d Y H:i', strtotime($replies->created_at))}}
                                        </p>
                                        <hr style="margin-right: 29px;margin-left: -10px;">
                                            <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(!empty($replies->supporter_attachment5))
                                <div class="chat chat-left">
                                    <div class="chat-avatar">
                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                            @if(!$replies->sup_photo)
                                            <img src="{{asset('images/user.jpg')}}" class="box-shadow-4" alt="avatar" />
                                            @else
                                            <img src="{{asset('user_photo/' .$replies->sup_photo )}}" class="box-shadow-4" alt="avatar" />
                                            @endif
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content">
                                            <div class="click-zoom">
                                              <label>
                                                <input type="checkbox">
                                                   <img src="{{asset('replies-attachments/'.$replies->supporter_attachment5)}}" alt="Message Image" style="height: 150px; width: 200px;">
                                              </label>
                                            </div>
                                            <p>
                                            {{date('M d Y H:i', strtotime($replies->created_at))}}
                                        </p>
                                        <hr style="margin-right: 29px;margin-left: -10px;">
                                            <h6>{{$replies->supporter_firstname}} {{$replies->supporter_lastname}} | {{$replies->supporter_roleName}}</h6>
                                        </div>
                                    </div>
                                </div>
                                @endif

                               @elseif($replies->is_customer_replied == 1)
                                <div class="chat">
                                    <div class="chat-avatar">
                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                            <img src="{{asset('user_photo/' .$replies->customer_pic )}}" class="box-shadow-4" alt="avatar" />
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content customer-chat">
                                            <p>{{$replies->reply_body}} <br>
                                                <br>
                                                {{date('M d Y H:i', strtotime($replies->created_at))}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                 @if(!empty($replies->image_msg))
                                 <div class="chat">
                                        <div class="chat-avatar">
                                            <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                <img src="{{asset('user_photo/' .$replies->customer_pic )}}" class="box-shadow-4" alt="avatar" />
                                            </a>
                                        </div>
                                        <div class="chat-body">
                                            <div class="chat-content customer-chat">
                                                <div class="click-zoom">
                                                  <label>
                                                    <input type="checkbox">
                                                       <img src="{{asset('replies-attachments/'.$replies->image_msg)}}" alt="Message Image" style="height: 150px; width: 200px;">
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
                                                <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                    <img src="{{asset('user_photo/' .$replies->customer_pic )}}" class="box-shadow-4" alt="avatar" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content customer-chat">
                                                    <div class="click-zoom">
                                                      <label>
                                                        <input type="checkbox">
                                                           <img src="{{asset('replies-attachments/'.$replies->customer_attachment1)}}" alt="Message Image" style="height: 150px; width: 200px;">
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
                                                <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                    <img src="{{asset('user_photo/' .$replies->customer_pic )}}" class="box-shadow-4" alt="avatar" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content customer-chat">
                                                    <div class="click-zoom">
                                                      <label>
                                                        <input type="checkbox">
                                                           <img src="{{asset('replies-attachments/'.$replies->customer_attachment2)}}" alt="Message Image" style="height: 150px; width: 200px;">
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
                                                <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                    <img src="{{asset('user_photo/' .$replies->customer_pic )}}" class="box-shadow-4" alt="avatar" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content customer-chat">
                                                    <div class="click-zoom">
                                                      <label>
                                                        <input type="checkbox">
                                                           <img src="{{asset('replies-attachments/'.$replies->customer_attachment3)}}" alt="Message Image" style="height: 150px; width: 200px;">
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
                                                <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                    <img src="{{asset('user_photo/' .$replies->customer_pic )}}" class="box-shadow-4" alt="avatar" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content customer-chat">
                                                    <div class="click-zoom">
                                                      <label>
                                                        <input type="checkbox">
                                                           <img src="{{asset('replies-attachments/'.$replies->customer_attachment4)}}" alt="Message Image" style="height: 150px; width: 200px;">
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
                                                <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                    <img src="{{asset('user_photo/' .$replies->customer_pic )}}" class="box-shadow-4" alt="avatar" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content customer-chat">
                                                    <div class="click-zoom">
                                                      <label>
                                                        <input type="checkbox">
                                                           <img src="{{asset('replies-attachments/'.$replies->customer_attachment5)}}" alt="Message Image" style="height: 150px; width: 200px;">
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
                            </div>
                        </div>
                    </section>
                    <section class="chat-app-form">
                        @if( $data->ticket_status == 'complete' || $data->ticket_status == 'no answer')
                        <h5 class="mt-5">Ticket Status is ( {{$data->ticket_status}} ). you can not reply to the ticket with this status.</h5>
                        @else
                        <form action="{{route('admin.add_ticket_replies')}}" enctype="multipart/form-data" method="post" class="chat-app-input d-flex">
                            @csrf
                            <input type="hidden" name="supporterID" value="{{Auth::user()->id}}">
                            <input type="hidden" name="supporter" value="{{Auth::user()->id}},{{Auth::user()->first_name}} {{Auth::user()->surname}}">
                            <input type="hidden" name="ticketID" value="{{$data->ticket_id}}">
                            <input type="hidden" name="customerID" value="{{$data->customer_id}}">
                            <fieldset class="col-10 m-0">
                                <div class="input-group position-relative">
                                    <input type="text" class="form-control" placeholder="Send message" name="message" id="message" placeholder="Ticket Message*...max 4000 chracters" maxlength="4000" value="{{old('message')}}" required="" aria-describedby="button-addon2">
                                    <label class="camera" title="Add image as a message"> <i class="ficon ft-camera"></i>
                                        <input id="imgInp" class="msg_pic" type="file" size="60" name="msg_pic[]"  multiple="" accept=".jpeg,.jpg,.png,.pdf,.docx">
                                    </label>
                                </div>
                                <div class="input-group pics">
                                </div>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left col-2 m-0" style="margin-left: -16px !important;">
                                <button type="submit" class="btn btn-danger">
                                    <i class="la la-paper-plane-o d-xl-none"></i>
                                    <span class="d-none d-lg-none d-xl-block">Send Message </span>
                                </button>
                            </fieldset>
                        </form>
                        <!-- <form action="{{route('customer.dropzone.store')}}" class="dropzone dropzone-area mt-2" id="dpz-file-limits" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="dz-message">
                                Add Attachments<br>Drop Files Here Or Click To Upload
                            </div>
                        </form> -->
                        @endif
                    </section>
    </div>
    <div class="col-md-5">

    <div class="card" style="width: 109%;
    margin-left: -30px;     overflow-y: auto;
    height: 797px;">
                                <div class="card-header">
                                    <h5>TICKET #{{$data->ticket_id}}</h5>
                                    <span class="ticket_status">{{$data->ticket_status}}</span>
                                </div>
                                <div class="card-body outer_body">
                                    <div class="card">
                                        <div class="card-body" style="float: left;">
                                           <div class="row">
                                               <div class="col-md-6">
                                                   <h5 style="float: left;">CUSTOMER&nbsp; { {{$customer->customer_number}} }</h5>
                                               </div>
                                               <div class="col-md-6">
                                               </div>
                                           </div>
                                           <div class="row mt-2">
                                               <div class="col-md-2">
                                               <div class="chat-avatar">
                                                    <a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                                        <img src="{{asset('user_photo/'.$customer->photo)}}" class="box-shadow-4 customer-image" alt="avatar" />
                                                                                                    
                                                    </a>
                                                </div>
                                                </div>
                                               <div class="col-md-4" style="text-align: initial;font-size: 11px;">
                                                   <h5 style="font-size: 12px;font-weight: bold;">{{$customer->first_name}} {{$customer->last_name}}</h5>
                                                    <h6><strong>{{$customer->company_name}} </strong></h6>
                                                    <p>{{$customer->street}} {{$customer->street_no}}</p>
                                                    <p>{{$customer->zipcode}} {{$customer->city}}</p>
                                               </div>
                                               <div class="col-md-6" style="text-align: end;">
                                                   <h5>Last Login</h5>
                                                   <p>{{date('M d Y H:i', strtotime($customer->last_login))}}</p><br>
                                                   <h5>Peckage</h5>
                                                   <p>@if(empty($customer->subscription_name))
                                                    No Package
                                                    @else
                                                    {{$customer->subscription_name}}
                                                    @endif
                                                </p>
                                               </div>
                                               <h6><a href="mailto:{{$customer->email}}">EMail: {{$customer->email}}</a></h6>
                                           </div>
                                           <div class="row">
                                            <div class="col-md-4">
                                            </div>
                                            <div class="col-md-8">
                                               <a href="{{url('admin/customer/'.$customer->id.'/edit')}}" type="button" class="btn btn-primary cust_detail">Open Customer</a>
                                            </div>
                                           </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body outer_body mt-1">
                                    <div class="card">
                                        <div class="card-body" style="float: left;">
                                           <div class="row">
                                               <div class="col-md-6">
                                                   <h5 style="float: left;">History</h5>
                                               </div>
                                               <div class="col-md-6">
                                               </div>
                                           </div>
                                           <div class="row mt-2" style="height: 315px;overflow-y: auto;">
                                            <table class="history_table">
                                                <tbody>
                                                    @if($ticket_history->count() > 0)
                                                    @foreach($ticket_history as $history)
                                                    <tr>
                                                        <td>{{$history->created_at}}</td>
                                                        <td>{{$history->detail}}</td>
                                                    </tr>
                                                    @endforeach
                                                    @else
                                                    <tr>
                                                        <td style="text-align: center;">
                                                            There is no history found for this ticket.
                                                        </td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-1 mb-5 mr-2 ml-2">
                                    <div class="col-md-12">
                                        <div class="row">
                                        <h5 style="float:left;">Attachments:</h5>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-10">
                                        @if(!empty($data->image_msg))
                                        <a href="{{url('replies-attachments')}}/{{$data->image_msg}}" target="_blank" title="">{{$data->image_msg}}</a><br>
                                        @endif                           
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
                                        <a href="{{url('user-attachments')}}/{{$data->attachment5}}" target="_blank" title="">{{$data->attachment5}}</a><br>
                                        @endif   
                                         @foreach($tocket_replies as $replies)
                                         @if(!empty($replies->image_msg))
                                        <a href="{{url('replies-attachments')}}/{{$replies->image_msg}}" target="_blank" title="">{{$replies->image_msg}}</a><br>
                                        @endif 
                                         @if(!empty($replies->supporter_attachment1))
                                        <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment1}}" target="_blank" title="">{{$replies->supporter_attachment1}}</a><br>
                                        @endif
                                        @if(!empty($replies->supporter_attachment2))
                                        <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment2}}" target="_blank" title="">{{$replies->supporter_attachment2}}</a><br>
                                        @endif
                                        @if(!empty($replies->supporter_attachment3))
                                        <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment3}}" target="_blank" title="">{{$replies->supporter_attachment3}}</a><br>
                                        @endif
                                        @if(!empty($replies->supporter_attachment4))
                                        <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment4}}" target="_blank" title="">{{$replies->supporter_attachment4}}</a><br>
                                        @endif
                                        @if(!empty($replies->supporter_attachment5))
                                        <a href="{{url('replies-attachments')}}/{{$replies->supporter_attachment5}}" target="_blank" title="">{{$replies->supporter_attachment5}}</a><br>
                                        @endif 
                                        @if(!empty($replies->customer_attachment1))
                                        <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment1}}" target="_blank" title="">{{$replies->customer_attachment1}}</a><br>
                                        @endif
                                        @if(!empty($replies->customer_attachment2))
                                        <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment2}}" target="_blank" title="">{{$replies->customer_attachment2}}</a><br>
                                        @endif
                                        @if(!empty($replies->customer_attachment3))
                                        <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment3}}" target="_blank" title="">{{$replies->customer_attachment3}}</a><br>
                                        @endif
                                        @if(!empty($replies->customer_attachment4))
                                        <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment4}}" target="_blank" title="">{{$replies->customer_attachment4}}</a><br>
                                        @endif
                                        @if(!empty($replies->customer_attachment5))
                                        <a href="{{url('replies-attachments')}}/{{$replies->customer_attachment5}}" target="_blank" title="">{{$replies->customer_attachment5}}</a><br>
                                        @endif
                                         @endforeach
                                         </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 col-md-12">
                                        @if($data->ticket_status == 'complete' || $data->ticket_status == 'no answer')
                                        <div class="row">
                                        <h5 style="float: left;">Assign ticket to another supporter</h5>
                                        </div>
                                        <div class="row">
                                        <p style="text-align: initial;">You can not assign this ticket to another Supporter, because ticket status is ( {{$data->ticket_status}} ).</p>
                                        </div>
                                        @else
                                        <h5 style="float: left;">Assign ticket to another supporter</h5>
                                        @if(!empty($data->supporter))
                                        <?php  
                                            $support = explode(',',$data->supporter);
                                            $sup_id = $support[0];
                                            // echo $sup_id;
                                        ?>
                                        @endif
                                        <select class="form-control supporter assign_supporter" name="supporter">
                                            <option value="">--Select Supporter--</option>
                                            @foreach($supporters as $supporter)
                                            <option value="{{$supporter->id}},{{$supporter->first_name}} {{$supporter->surname}}" @if(!empty($data->supporter)) <?php echo ($sup_id == $supporter->id) ? 'selected' : '' ?> @endif>{{$supporter->first_name}} {{$supporter->surname}} | {{$supporter->supporter_role}}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Ticket Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <select name="status" class="form-control ticket_statuss" data-ticketID="{{$data->ticket_id}}">
                                <option value="Pending" <?php echo ($data->ticket_status == 'Pending') ? 'selected' : '' ?>>Pending</option>
                                <option value="waiting for customer reply" <?php echo ($data->ticket_status == 'waiting for customer reply') ? 'selected' : '' ?>>waiting for customer reply</option>
                                <option value="no answer" <?php echo ($data->ticket_status == 'no answer') ? 'selected' : '' ?>>no answer</option>
                                <option value="complete" <?php echo ($data->ticket_status == 'complete') ? 'selected' : '' ?>>complete</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>







                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('page_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" type="text/javascript"></script>
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('app-assets/vendors/js/extensions/dropzone.min.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/vendors/js/ui/prism.min.js')}}" type="text/javascript"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="{{asset('app-assets/js/scripts/extensions/dropzone.js')}}" type="text/javascript"></script>
<!-- END: Page JS-->
@if (Session::has('success'))
    <script>
        $.toast({
            heading: 'Success',
            text: '{{ Session::get("success") }}',
            showHideTransition: 'slide',
            icon: 'success',
            position: 'top-right'
        })  

        $(document).ready(function(){
            $('#exampleModal').modal('show');
        })
    </script>
@endif

@if (count($errors) > 0)
@foreach ($errors->all() as $error)
<script>
    $.toast({
        heading: 'Error',
        text: '{{ $error }}',
        showHideTransition: 'fade',
        icon: 'error',
        position: 'top-right'
    })
</script>
@endforeach
@endif
<script>
    var count = 1;

    $('.add_more_files').on('click',function(){
        if(count > 4){
            // alert('your are allow to attach 5 file per ticket.');
            $.toast({
                heading: 'Error',
                text: 'your are allow to attach 5 file per ticket.',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right'
            })
            $('.add_more_files').hide();
        }else{
            count++;
            // console.log(count);
        $('#add_files').append('<div class="input-group col-md-6" id="inputFile01"><label for="close"><i class="ficon ft-delete close_file"></i></label><div class="input-group-prepend"><span class="input-group-text" id="inputGroupFileAddon01">Upload</span></div><div class="custom-file attachment_files"><input type="file" name="attachments'+count+'" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" accept=".png,.jpg,.jpeg,.pdf,.doc"><label class="custom-file-label" for="inputGroupFile01" id="files_no'+count+'" style="text-align: justify;">Choose file</label></div></div>');

        }
    })

    $(document).ready(function(){
          $(document).delegate('.close_file','click',function(){
               $(this).parent().parent().remove();
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
            // alert('You are allow to slect only 5 files per ticket.');
            $.toast({
                heading: 'Error',
                text: 'your are allow to attach 5 file per ticket.',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right'
            })
        }
        else{
            if(files.length >= 5){
                // alert('You are allow to slect only 5 files per ticket.');
                $.toast({
                    heading: 'Error',
                    text: 'your are allow to attach 5 file per ticket.',
                    showHideTransition: 'fade',
                    icon: 'error',
                    position: 'top-right'
                })
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

    $('.assign_supporter').change(function(){
        $(this).find(':selected').addClass('selected')
            .siblings('option').removeClass('selected');

        var option = $(this).find(':selected').attr('value');
        var id = '{{$data->ticket_id}}';

        // alert(option);
        $.ajax({
            url:"{{route('admin.change_supporter')}}",
            type:'post',
            data:{'_token':'{{ csrf_token() }}','supporter':option,'ticket_id':id},
            success:function(data){
                // console.log('success');
                $.toast({
                    heading: 'Success',
                    text: 'Ticket assigned successfully.',
                    showHideTransition: 'slide',
                    icon: 'success',
                    position: 'top-right'
                })  

                setTimeout(function(){
                    window.location.reload();
                },3000);
            },
            error:function(e){
                // console.log('error');
                $.toast({
                    heading: 'Error',
                    text: 'Something wents wrong, Please try again latter.',
                    showHideTransition: 'fade',
                    icon: 'error',
                    position: 'top-right'
                })
            }
        })
    })
</script>
<script>
     $('.ticket_statuss').change(function(){
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
<script>
    $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;
            if(filesAmount <= 5){
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).attr('name','msg_pic['+i+']').appendTo(placeToInsertImagePreview);
                    }

                    reader.readAsDataURL(input.files[i]);
                } 
            }else{
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

    $('#imgInp').on('change', function() {
        $('div.pics').empty();
        imagesPreview(this, 'div.pics');
    });
});
</script>
@endsection