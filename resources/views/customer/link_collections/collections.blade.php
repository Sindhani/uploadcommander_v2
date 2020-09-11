<div class="row">
    <div class="col-md-3">
        <div class="card" style="height: 642px;">

            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="form-group">
                        {!! Form::open(['route' => 'customer.social_links.store']) !!}
                        <div class="form-body">
                            <div class="form-group">
                                {!! Form::select('account',
                                        [
                                        'facebook' => 'Facebook',
                                        'linkedin' => 'LinkedIn',
                                        'instagram' => 'Instagram',
                                        'twitter' => 'Twitter',
                                        'twitter' => 'Twitter',
                                        'custom' => 'Custom',

                                        ], null,
                                        [
                                        'placeholder' => 'Select Social Media Type','class' =>'form-control input-lg',
                                        'id' => 'account'])
                                !!}
                            </div>
                            <div class="form-group">

                                {!! Form::text('account_name','',
                                        [
                                        'placeholder' => 'Your Facebook User Name',
                                        'id' => 'account_name',
                                        'class' => 'form-control'])
                                !!}
                            </div>

                            <div class="form-group">

                                {!! Form::text('button_title','',
                                        [
                                        'placeholder' => 'Title of the Button',
                                        'id' => 'button_title',
                                        'class' => 'form-control'])
                                !!}
                            </div>
                            <div class="form-check control skin skin-square">
                                <input type="radio" id="customRadio1" name="button_type" class="custom-control-input changeButtonType" value="square_button">
                                <label class="custom-control-label" for="customRadio1">Square Button</label>
                            </div>
                            <div class="form-check control skin skin-square">
                                <input type="radio" id="customRadio2" name="button_type" class="custom-control-input changeButtonType" value="round_button">
                                <label class="custom-control-label " for="customRadio2">Round Button</label>

                            </div>

                            <div class="form-actions left">
                                {!! Form::button('<i class="la la-check-square-o"></i> Add Link',
                                        [
                                        'type' => 'submit',
                                        'class' => 'btn btn-primary',


                                        ])
                                !!}
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card" style="height: 642px;">
            <div class="card-content collapse show">
                <div class="card-body sortable" style="height: 400px;" id="sortable">

                </div>
            </div>
        </div>
    </div>


    <div class="col-md-4">
        <div class="card" style="height: 642px;">
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="px-1 py-1 shadow setBgColor mx-auto collectionMobile" style="
													        height: 600px;
													        width: 320px;
													        position: relative;
													        border: solid black 15px;
													        border-radius: 24px;
													        background-color: #7ecff4;

															">
                        <div class="" style="display: none; " id="collectionProfilePicture">
                            <img src="{{asset('images/'.$settings->picture)}}"

                                    class="mb-1 mx-auto d-block" width="100px" height="100px"
                                    style="border-width: 1px; border-radius: 50%;">
                        </div>


                        <div class="" style="display: none;" id="collectionLinkName">
                            <div class="text-center">{{"@".$settings->user_name}}</div>
                        </div>
                        <div class="collectionAccountButtons"></div>
                        <div class="" style="display: none; position: absolute; bottom: 5px;" id="collectionLogo">
                            <img src="{{asset('images/logo.png')}}" class="mb-2 mx-auto d-block " width="270"
                                    height="40">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
