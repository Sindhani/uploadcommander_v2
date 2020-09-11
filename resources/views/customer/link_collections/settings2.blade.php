<div class="row">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="text-center">Profile Picture</h3>
                <img id="profilePicture" class="mb-2  mx-auto d-block " width="200" height="200"
                     style="border-radius: 50%;"
                     src="{{($settings->picture)? asset('images/').'/'.$settings->picture : asset('images/user.jpeg')}}">
                {!! Form::open(['route' => ['customer.social-collection.update', $settings->id], 'method' => 'put', 'files' => true]) !!}

                {!! Form::file('Change Profile Picture', [
                'class' => 'btn btn-sm btn-outline-primary rounded-pill mx-auto d-block',
                'onChange' => 'this.form.submit();',
                'name' => 'image',
                ]) !!}
                {!! Form::close() !!}
                <div class="row mt-2 ml-2">
                </div>
                <div class="row">
                    {{--<div style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center;"--}}
                    {{--class="border rounded text-center gradient">--}}
                    {{--<i class="fas fa-5x fa-camera"></i>--}}
                    {{--</div>--}}
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="file-upload gradientFirst">
                            <input type="file" id="uploadBackgroundImage" name="backgroundImage"/>
                            <i class="fas fa-camera"></i>
                        </div>
                    </form>
                    <div style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center;
                    background: -moz-linear-gradient(top, #000 0%, #fff 100%);"
                         class="border rounded text-center ml-2 gradient">
                        <i class="far fa-5x fa-circle"></i>
                    </div>
                    <div style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center;
                        background: linear-gradient(to bottom, rgb(228,245,252) 0%,rgb(159,216,239) 52%,rgb(42,176,237) 100%);"
                         class="border rounded text-center ml-1 gradient">
                        <i class="far fa-5x fa-circle"></i>
                    </div>
                    <div style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center;
                    background: linear-gradient(to bottom, rgb(180,227,145) 0%,rgb(97,196,25) 50%,rgb(180,227,145) 100%);"
                         class="border rounded text-center ml-1 gradient">
                        <i class="far fa-5x fa-circle"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                {!! Form::open(['route' => ['customer.check.username', $settings->id], 'method' => 'post']) !!}

                {!! Form::text('link', $settings->user_name, ['placeholder' => 'Write your link', 'class' => 'form-control mb-2', 'id' => 'settings']) !!}
                {!! Form::close() !!}

                {!! Form::open(['route' => ['customer.social-collection.update', $settings->id ], 'method' => 'put', 'name' => 'settings']) !!}
                <div class="form-check">
                    {!! Form::checkbox('link_name_option',  'link_name', $settings->link_name_option === 1 ? 'checked' : '',['class' => 'form-check-input switchery settingCheckboxLinkname settingCheckbox',
                     'id' => 'link_name',
                     ]) !!}
                </div>
                {!!  Form::label('link_name_option', 'Show Linkname on the Page', ['class' => 'form-check-label link_name_option ml-1 mb-2 ']) !!}
                <div class="form-check">
                    {!! Form::checkbox('profile_picture_option', 'profile_picture', false, ['class' => 'form-check-input switchery settingCheckboxPicture settingCheckbox',
                     'id' => 'profile_picture']) !!}
                </div>
                {!!  Form::label('profile_picture_option', 'Show Profile Picture on the page', ['class' => 'form-check-label ml-1 mb-2']) !!}
                <div class="form-check">

                    {!! Form::checkbox('logo_option', 'logo' ,false, ['class' => 'form-check-input switchery settingCheckboxLogo settingCheckbox', 'id' => 'logo']) !!}
                </div>
                {!!  Form::label('logo_option', 'Show UC-logo on the page', ['class' => 'form-check-label ml-1']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-lg-4 px2">
        <div id="setBgColor" class="px-1 py-1 shadow" style="   height: 600px;
													        width: 320px;
													        position: relative;
													        border: solid black 15px;
													        border-radius: 35px;
													        background-color: #7ecff4;
													        margin-top: -70px;
														">
            <div class="" style="display: none; " id="setProfilePicture">
                <img src="{{asset('images/'.$settings->picture)}}"
                     class="mb-1 mx-auto d-block" width="100px" height="100px"
                     style="border-width: 1px; border-radius: 50%;">
            </div>
            <div class="" style="display: none;" id="setLinkname">
                <div class="text-center">{{"@".$settings->user_name}}</div>

            </div>
            <div class="" style="display: none; position: absolute; bottom: 5px;" id="setUcLogo">
                <img src="{{asset('images/logo.png')}}" class="mb-2 mx-auto d-block " width="270" height="40">
            </div>

        </div>
    </div>
</div>

