@extends('admin.layouts.admin')

@section('page_styles')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/editors/tinymce/tinymce.min.css')}}">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Add HelpDesk Entry</h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">{{ __('Support') }}</a></li>
                                <li class="breadcrumb-item active">HelpDesk-Add Entry</li>
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
                                            	<a href="{{route('admin.helpdesk.index')}}" type="button" class="btn btn-primary mr-1" ><i class="ft-arrow-left"></i>Go Back</a>
                                        	</div>
                                            <form class="form-horizontal" id="helpdesk_form" action="#" method="post" accept-charset="utf-8">
                                                @csrf
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <label style="float: right;">Is Menu</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="checkbox" name="is_menu" class="is_menu" id="is_menu">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <label style="float: right;">Linked Page</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input id="linked_page" type="text" name="linked_page" value="" class=" form-control linked_page"  placeholder="Add Page Link After ({{ Request::server ('SERVER_NAME') }})">
                                                        <!-- <select name="linked_page" class=" form-control linked_page" id="linked_page">
                                                            <option value="">Select default Site</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select> -->
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <label style="float: right;">Assignment</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <!-- <input id="assignment" type="text" name="assignment" value="" class="form-control assignment" placeholder="Add assigned Menu"> -->
                                                        <select name="assignment" class="form-control assignment" id="assignment">
                                                            <option value="">Select Assigned Menu</option>
                                                            @foreach($helpdesk as $help)
                                                            <option value="{{$help->description}}">{{$help->description}}</option>}
                                                            option
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <label style="float: right;">Description</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                       <input class="form-control" type="text" name="description" value="" placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <label style="float: right;">Content</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <textarea class="tinymce-classic content" name="content">
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <label style="float: right;">Is Active</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="checkbox" name="is_active">
                                                    </div>
                                                </div>
                                                <div class="form-group row" style="justify-content: flex-end;margin-right: 0%;">
                                                    <a href="{{route('admin.helpdesk.index')}}" class="btn btn-danger mr-1"><i class="fa fa-times mr-1"></i>Cancel</a>
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o mr-1"></i>Save</button>
                                                </div>
                                            </form>
                                            @include('mceImageUpload::upload_form')
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
 <!-- BEGIN: Page Vendor JS-->
<script src="{{asset('app-assets/vendors/js/editors/tinymce/tinymce.js')}}" type="text/javascript"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="{{asset('app-assets/js/scripts/editors/editor-tinymce.js')}}" type="text/javascript"></script>
<!-- END: Page JS-->
<script src="{{asset('app-assets/vendors/js/extensions/sweetalert2.all.js')}}" type="text/javascript"></script>
<!-- BEGIN: Page JS-->
<script src="{{asset('app-assets/js/scripts/extensions/sweet-alerts.js')}}" type="text/javascript"></script>
<!-- END: Page JS-->
@endsection

@section('scripts')
<script>

    document.getElementById('is_menu').onchange = function() {
        document.getElementById('linked_page').disabled = this.checked;
        document.getElementById('assignment').disabled = this.checked;
        // document.getElementById('mceu_53').disabled = this.checked;
        if(this.checked){
            tinymce.activeEditor.getBody().setAttribute('contenteditable', false);
        }else{
            tinymce.activeEditor.getBody().setAttribute('contenteditable', true);
        }
    };

    //add end category
   $('#helpdesk_form').on('submit', function(event){
      tinyMCE.triggerSave();
      event.preventDefault();
      $.ajax({
         url:"{{route('admin.helpdesk.store')}}",
         method:"POST",
         data:new FormData(this),
         dataType:'JSON',
         contentType: false,
         cache: false,
         processData: false,
         success:function(data){
          if(data.message){
            swal({
                position: 'top-end',
                type: 'success',
                title: data.message,
                showConfirmButton: false,
                timer: 1500
            });

             $('#helpdesk_form')[0].reset();

            setTimeout(function(){
                location.replace("{{route('admin.helpdesk.index')}}");
             },2000);

          }else if(data.error){
            swal({
                position: 'top-end',
                type: 'error',
                title: data.error,
                showConfirmButton: false,
                timer: 3000
            });
          }
         },
         error:function(e){
          swal({
                position: 'top-end',
                type: 'error',
                title: 'something went wrong, Please try again later.',
                showConfirmButton: false,
                timer: 3000
            });
         }
      })
   });
</script>
@endsection