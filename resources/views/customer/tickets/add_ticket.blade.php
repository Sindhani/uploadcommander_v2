@extends('customer.layouts.app')

@section('vendor_style')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endsection

@section('content')
<style>
            /* width */
        ::-webkit-scrollbar {
        width: 8px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
        background: #f1f1f1; 
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: #888; 
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #1b94d1; 
        }
    .right_card{
        text-align: center;
        border: 1px solid lightgray;
        height: 350px;
    }
    .left-card{
        border: 1px solid lightgray;
        height: 452px;
        overflow-y: auto;
        overflow-x: hidden;
    }
    .middle-card-header h5, h3{
        font-weight: bold;
    }
    .middle-card{
        /* border: 1px solid lightgray; */
        height: 452px;
        overflow-y: auto;
        overflow-x: hidden;
        border-left: 1px solid lightgray;
        border-top: 1px solid lightgray;
        -webkit-box-shadow: -5px 0px 13px -4px rgba(148,148,148,1);
        -moz-box-shadow: -5px 0px 13px -4px rgba(148,148,148,1);
        box-shadow: -5px 0px 13px -4px rgba(148,148,148,1);
    }
    #sorting{
        height: 45px;
        width: 100%;
        border: none;
        background-color: #f3f4fa;
        position: absolute;
    }
    .avatar {
        vertical-align: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-left: 8px;
        margin-top: 8px;
    }
    .avatar-middle {
        vertical-align: center;
        width: 50px;
        height: 50px;
        margin-left: 20px;
    }
    .avatar-right{
        vertical-align: center;    
        width: 35px;
        height: 35px;
        margin-left: 5px;

    }
    .list-unstyled{
        margin-top: 52px;
    }
    .list_text_row{
        margin-left: 25%;
        margin-top: -39px;
    }
    .middle_list_text_row{
        margin-left: 19%;
        margin-top: -50px;
    }
    .list_id{
        margin-left: -9px;
    }
    .list_text{
        margin-left: -9px;
        padding-right: 18px;
        color: #464855;
    }
    .add_ticket_form{
        padding-left: 15%;
    }
    
</style>
   <!-- BEGIN: Content-->
   <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Add Ticket</h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">{{ __('Home') }}</a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('Add New Tickets') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Base style table -->
                <section id="base-style">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                       <h5>Add New Ticket</h5>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <!-- <div class="table-responsive"> -->
                                            @if (Session::has('success'))
                                                <div class="alert alert-success mt-2" role="alert">{{ Session::get('success') }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                            @endif
                                            @if (Session::has('danger'))
                                                <div class="alert alert-danger mt-2" role="alert">{{ Session::get('danger') }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                            @endif

                                            <div class="row mt-1">
                                            <div class="col-md-3">
                                                <div class="card left-card"> 
                                                    <select name="sorting" id="sorting">
                                                        <option value="">-- Sort By --</option>
                                                        <option value="Date">Sort By Date</option>
                                                        <option value="ticket_no">Sort By Ticket No</option>
                                                        <!-- <option value="">-- Sort By --</option> -->
                                                    </select>
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <a href="#">
                                                                <div class="row">
                                                                    <div class="col-md-1">
                                                                        <img src="{{url('user_photo/1594721653.JPG')}}" alt="Avatar" class="avatar">
                                                                    </div>
                                                                    <div class="col-md-10 list_text_row">
                                                                        <div class="row">
                                                                            <div class="col-7 list_id"><h4>#123</h4></div>
                                                                            <div class="col-4"><small>Today</small></div>
                                                                        </div>
                                                                        <div class="row list_text">
                                                                            <p>this is the static design test list text. look at text, is it align correctly or not?</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li><hr>
                                                        <li>
                                                            <a href="#">
                                                                <div class="row">
                                                                    <div class="col-md-1">
                                                                        <img src="{{url('user_photo/1594721653.JPG')}}" alt="Avatar" class="avatar">
                                                                    </div>
                                                                    <div class="col-md-10 list_text_row">
                                                                        <div class="row">
                                                                            <div class="col-8 list_id"><h4>#123</h4></div>
                                                                            <div class="col-4"><small>Today</small></div>
                                                                        </div>
                                                                        <div class="row list_text">
                                                                            <p>this is the static design test list text. look at text, is it align correctly or not?</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li><hr>
                                                        <li>
                                                            <a href="#">
                                                                <div class="row">
                                                                    <div class="col-md-1">
                                                                        <img src="{{url('user_photo/1594721653.JPG')}}" alt="Avatar" class="avatar">
                                                                    </div>
                                                                    <div class="col-md-10 list_text_row">
                                                                        <div class="row">
                                                                            <div class="col-7 list_id"><h4>#123</h4></div>
                                                                            <div class="col-5"><small>Today</small></div>
                                                                        </div>
                                                                        <div class="row list_text">
                                                                            <p>this is the static design test list text. look at text, is it align correctly or not?</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li><hr>
                                                        <li>
                                                            <a href="#">
                                                                <div class="row">
                                                                    <div class="col-md-1">
                                                                        <img src="{{url('user_photo/1594721653.JPG')}}" alt="Avatar" class="avatar">
                                                                    </div>
                                                                    <div class="col-md-10 list_text_row">
                                                                        <div class="row">
                                                                            <div class="col-7 list_id"><h4>#123</h4></div>
                                                                            <div class="col-5"><small>Today</small></div>
                                                                        </div>
                                                                        <div class="row list_text">
                                                                            <p>this is the static design test list text. look at text, is it align correctly or not?</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li><hr>
                                                        <li>
                                                            <a href="#">
                                                                <div class="row">
                                                                    <div class="col-md-1">
                                                                        <img src="{{url('user_photo/1594721653.JPG')}}" alt="Avatar" class="avatar">
                                                                    </div>
                                                                    <div class="col-md-10 list_text_row">
                                                                        <div class="row">
                                                                            <div class="col-7 list_id"><h4>#123</h4></div>
                                                                            <div class="col-5"><small>Today</small></div>
                                                                        </div>
                                                                        <div class="row list_text">
                                                                            <p>this is the static design test list text. look at text, is it align correctly or not?</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li><hr>
                                                        <li>
                                                            <a href="#">
                                                                <div class="row">
                                                                    <div class="col-md-1">
                                                                        <img src="{{url('user_photo/1594721653.JPG')}}" alt="Avatar" class="avatar">
                                                                    </div>
                                                                    <div class="col-md-10 list_text_row">
                                                                        <div class="row">
                                                                            <div class="col-7 list_id"><h4>#123</h4></div>
                                                                            <div class="col-5"><small>Today</small></div>
                                                                        </div>
                                                                        <div class="row list_text">
                                                                            <p>this is the static design test list text. look at text, is it align correctly or not?</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-9 add_ticket_form">
                                                <form action="#">
                                                    @csrf
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <label for="ticket No"><b>Ticket ID: </b></label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" name="ticket_no" value="#123" class="form-control" disabled/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="subject" class="form-control" placeholder="Subject">
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea class="fomr-control" name="message" id="message" cols="82" rows="10" placeholder="Ticket Message"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                                            </div>
                                                            <div class="custom-file">
                                                                <input type="file" name="attachments[]" class="custom-file-input" id="inputGroupFile01"
                                                                aria-describedby="inputGroupFileAddon01" multiple>
                                                                <label class="custom-file-label" for="inputGroupFile01" id="files_no">Choose one or multiple file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="submit" name="submit" class="btn btn-primary add_new_ticket_btn" style="float:right;">
                                                </form>
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Base style table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('scripts')
<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script>

@endsection