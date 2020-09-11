@extends('customer.layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{asset('app-assets/css/plugins/charts/chartist.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('app-assets/css/plugins/charts/chartist.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('app-assets/vendors/css/forms/icheck/icheck.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('app-assets/vendors/css/forms/toggle/switchery.min.css')}}" rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <style>
        .my-graph {
            width: 700px;
            height: 400px;
        }

        .removeAccountButton:hover {
            box-shadow: 0 8px 6px -6px black !important;

        }

        .main-box {
            background-color: gray;
            padding: 10px 12px;
        }

        .box {

            display: flex;
        }

        .icons {

            padding-right: 10px;

            /* padding-left: 10px; */

            display: flex;

            justify-content: center;

            align-items: center;

            /* padding-right: 10px; */
        }

        .content {

        }

        .three {
            display: flex;
            justify-content: end;
        }

        #draggable {
            width: 150px;
            height: 150px;
            padding: 0.5em;
        }

        .wrapper {
            display: flex;
            justify-content: space-between;

        }

        .box {
            display: flex;
            flex-direction: column;

        }

        .socialIcon {
            width: 50px;
            height: 50px;
            border: 1px solid gray;
            border-radius: 50px;
            padding-top: 15px;
        }

        .fa {
            font-size: large;

            display: flex;
            justify-content: center;
            align-items: center;
            align-self: center;
            align-content: center;
            color: #000;
            flex-direction: column;
        }

        .toggle.ios, .toggle-on.ios, .toggle-off.ios {
            border-radius: 20px;
        }

        .toggle.ios .toggle-handle {
            border-radius: 20px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .colorActive {
            border: 2px solid whitesmoke !important;
            box-shadow: 0px 2px 12px grey;
        }

        /*  following css is for custom upload button on the Setting Tab*/

        .file-upload {
            height: 100px;
            width: 100px;
            border-radius: 5px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #626E82;
            overflow: hidden;
            background-image: linear-gradient(to bottom, #2590EB 50%, #FFFFFF 50%);
            background-size: 100% 200%;
            transition: all 1s;
            color: #FFFFFF;
            font-size: 80px;
        }

        .file-upload input[type='file'] {
            height: 200px;
            width: 200px;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        .file-upload:hover {
            background-position: 0 -100%;
            color: #2590EB;
        }
    </style>
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3
                            class="content-header-title mb-0 d-inline-block border-right-0">Social Collections</h3>
                </div>
            </div>
            <div class="content-body">
                @if(Session::has('warning'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Warning</strong> {{Session::get('warning')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 id="basic-forms" class="card-title">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="setting-tab" data-toggle="tab"
                                       href="#setting"
                                       role="tab" aria-controls="home" aria-selected="true">Setting</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                       role="tab"
                                       aria-controls="profile" aria-selected="false">Collections</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact"
                                       role="tab"
                                       aria-controls="contact" aria-selected="false">Statistics</a>
                                </li>
                            </ul>
                        </h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show" aria-expanded="true">
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active mt-3" id="setting" role="tabpanel"
                                         aria-labelledby="setting-tab">

                                        @include('customer.link_collections.settings2')
                                    </div>
                                    <div class="tab-pane fade mt-3" id="profile" role="tabpanel"
                                         aria-labelledby="profile-tab">
                                        @include('customer.link_collections.collections')
                                    </div>
                                    <div class="tab-pane fade mt-3" id="contact" role="tabpanel"
                                         aria-labelledby="contact-tab">
                                        @include('customer.link_collections.statistics', $links_stats)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="{{asset('app-assets/vendors/js/charts/chartist.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/forms/icheck/icheck.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/forms/toggle/switchery.min.js')}}"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        function firstColor() {
            var x = document.getElementById('setBgColor');
            x.style.background = 'linear-gradient(0deg, rgba(240,244,231,1) 0%, rgba(198,226,117,1) 26%, rgba(129,219,200,1) 67%, rgba(25,214,217,1) 100%)';
        }
        function secondColor() {
            var x = document.getElementById('setBgColor');
            x.style.background = 'linear-gradient(to bottom, rgb(228,245,252) 0%,rgb(159,216,239) 52%,rgb(42,176,237) 100%)';
        }
        function thirdColor() {
            var x = document.getElementById('setBgColor');
            x.style.background = 'linear-gradient(to bottom, rgb(180,227,145) 0%,rgb(97,196,25) 50%,rgb(180,227,145) 100%)';
        }
    </script>
    <script>

        {{--Docuement Ready Function is Started Here--}}
        //======================================================================================================================
        $(function () {
//======================================================================================================================
//      Below functions grabs the image of from settingTab background Button and sends to server
//======================================================================================================================
            var perfEntries = performance.getEntriesByType("navigation");
            if (perfEntries[0].type === "back_forward") {
                location.reload(true);
            }
//======================================================================================================================
//        The following code brings statistics data from servery every 10 seconds
//======================================================================================================================
            setInterval(function () {
                $.ajax({
                    method: 'get',
                    url: "{{route('customer.statistics.index')}}",
                    data: {
                        visits_counts: "{{Auth::guard('customers')->id()}}"
                    },
                    success: function (data) {
                        $('.viewFigurePersonalLink').html(data.personal_link_visits);
                        $('.viewFigureTotalLinks').html(data.clicks_count);
//                        Below the is formula for calculating the CTR(Click Through Rate)
                        var clicks = data.clicks_count;
                        var impressions = data.personal_link_visits;
                        var ctr = Math.ceil((clicks / impressions) * 100);
                        $('.viewFigureClickRate ').html(ctr + "%");
                    }
                })
            }, 10000);
//======================================================================================================================
//      Below functions grabs the image of from settingTab background Button and sends to server
//======================================================================================================================
            var button_type_id = null;
            var formdata = new FormData();
            $("#uploadBackgroundImage").on("change", function () {
                var file = this.files[0];
                if (formdata) {
                    formdata.append("image", file);

                    $.ajax({
                        url: "{{route('customer.social-collection.store')}}",
                        type: "post",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            $('.gradientFirst').css({
                                'background': response.bg_color,
                                'background-size': "cover",
                                'background-position': 'center'
                            });
                            $('#setBgColor').css({
                                'background': response.bg_color,
                                'background-size': "cover",
                                'background-position': 'center'
                            });
                            $('.statisticsMobile').css({
                                'background': response.bg_color,
                                'background-size': "cover",
                                'background-position': 'center'
                            });
                            $('.collectionMobile').css({
                                'background': response.bg_color,
                                'background-size': "cover",
                                'background-position': 'center'
                            });
                        }
                    });
                }
            });
//======================================================================================================================
//      Below functions grabs the status of checkbox from settings tab
//======================================================================================================================
            function setState(data) {
                $.ajax({
                    url: data.url,
                    type: 'get',
                    data: {
                        _token: data._token,
                        id: data.id,
                        name: data.name,
                        profile: data.profile,
                        logo: data.logo
                    },
                });
            }

            var gradientColor = null;
            var settingTabCheckboxes = {
                _token: "{{csrf_token()}}",
                id: "{{$settings->id}}",
                url: "{{route('customer.social-collection.index')}}"
            };
            $('.settingCheckboxLinkname').change(function () {
                if ($(this).prop('checked') === true) {
                    settingTabCheckboxes.name = 1;
                } else {
                    settingTabCheckboxes.name = 0;
                }
            });
            $('.settingCheckboxPicture').change(function () {
                if ($(this).prop('checked') === true) {
                    settingTabCheckboxes.profile = 1;
                } else {
                    settingTabCheckboxes.profile = 0;
                }

                $('.settingCheckboxLogo').change(function () {
                    if ($(this).prop('checked') === true) {
                        settingTabCheckboxes.logo = 1;
                    } else {
                        settingTabCheckboxes.logo = 0;
                    }
                });
                $('.settingCheckbox').each(function () {
                    $(this).change(function () {
                        setState(settingTabCheckboxes);
                    });
                });
            });
//======================================================================================================================
//Following Code grabs the status of the setting Tab Checkbox from Database every time Database value Changes.
//======================================================================================================================
            $.ajax({
                url: "{{route('customer.social-collection.index')}}",
                type: 'get',
                data: {
                    _token: "{{csrf_token()}}",
                    id: "{{$settings->id}}",
                    checkbox: 'yes'
                },
                success: function (data) {
                    gradientColor = data[0].bg_color;
                    $('.gradient').each(function () {
                        var index = $(this).css('background').indexOf('repeat');
                        var substring = $(this).css('background').substr(0, index);
                        if (substring === gradientColor) {
                            $('.gradientFirst').removeClass('colorActive');
                            $(this).addClass('colorActive');
                        }
                        else {
//                            $('.gradientFirst').addClass('colorActive');
                        }
                    });

                    $('#setBgColor').css({
                        'background': gradientColor,
                        'background-position': 'center',
                        'background-size': 'cover'
                    });
                    $('.collectionMobile').css({
                        'background': gradientColor,
                        'background-position': 'center',
                        'background-size': 'cover'
                    });
                    $('.statisticsMobile').css({
                        'background': gradientColor,
                        'background-position': 'center',
                        'background-size': 'cover'
                    });
                    if (data[0].link_name_option === "1") {
                        $('.settingCheckboxLinkname').attr('checked', 'checked');
                        $('#setLinkname').show();
                        $('#collectionLinkName').show();
                        $('#statisticsLinkName').show();
                        settingTabCheckboxes.name = data[0].link_name_option;
                    }

                    if (data[0].profile_picture_option === "1") {
                        $('.settingCheckboxPicture').attr('checked', 'checked');
                        $('#setProfilePicture').show();
                        $('#collectionProfilePicture').show();
                        $('#statisticsProfilePicture').show();
                        settingTabCheckboxes.profile = data[0].profile_picture_option;
                    }
                    if (data[0].logo_option === "1") {
                        $('.settingCheckboxLogo').attr('checked', 'checked');
                        $('#setUcLogo').show();
                        $('#collectionLogo').show();
                        $('#statisticsLogo').show();
                        settingTabCheckboxes.logo = data[0].logo_option;
                    }
                }
            });
//======================================================================================================================
//Following Code sends Gradient data to the database
//======================================================================================================================
            $.ajax({
                method: 'get',
                url: '{{route('customer.social-collection.store')}}',
                data: {
                    _token: "{{csrf_token()}}",
                    color: "{{$settings->id}}"
                },
                success: function (data) {
                },
                error: function (error) {

                }
            });
//======================================================================================================================
            $('.gradient').on('click', function () {
                $.ajax({
                    url: "{{route('customer.social-collection.index')}}",
                    type: 'get',
                    data: {
                        _token: "{{csrf_token()}}",
                        id: "{{$settings->id}}",
                        gradient: $(this).css('background'),
                    }
                });
            });
//======================================================================================================================
//Following Code is for selecting the active tab
//======================================================================================================================
            if (location.hash) {
                $("a[href='" + location.hash + "']").tab("show");
            }
            $(document.body).on("click", "a[data-toggle='tab']", function (event) {
                location.hash = this.getAttribute("href");
            });

            $(window).on("popstate", function () {
                var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
                $("a[href='" + anchor + "']").tab("show");
            });
//======================================================================================================================
            //This code is for the checkboxes which toggles the elements on the mobile screen
//======================================================================================================================
            $('#link_name').change(function () {
                $('#setLinkname').toggle();
            });

            $('#profile_picture').change(function () {
                $('#setProfilePicture').toggle();
            });

            $('#logo').change(function () {
                $('#setUcLogo').toggle();
            });
//======================================================================================================================
//collections page setting
//======================================================================================================================
            $('.settingCheckboxLinkname').change(function () {
                $('#collectionLinkName').toggle();
            });

            $('.settingCheckboxPicture').change(function () {
                $('#collectionProfilePicture').toggle();
            });
            $('.settingCheckboxLogo').change(function () {
                $('#collectionLogo').toggle();
            });
//======================================================================================================================
// statistics page setting
//======================================================================================================================
            $('.settingCheckboxLinkname').change(function () {
                $('#statisticsLinkName').toggle();
            });
            $('.settingCheckboxPicture').change(function () {
                $('#statisticsProfilePicture').toggle();
            });
            $('.settingCheckboxLogo').change(function () {
                $('#statisticsLogo').toggle();
            });
//======================================================================================================================
//User Name Input Box code which is executed when enter is pressed. 'which' checks for key 13 is the code
//======================================================================================================================
            $('#settings').on('keypress', function (e) {
                if (e.which == 13) {
                    $(this).submit();
                }
            });
//======================================================================================================================
            //This code is for sorting the draggable divs, Jquery Library is used
//======================================================================================================================
            $("#sortable").sortable({
//                placeholder: "ui-state-highlight",
                update: function (event, ui) {
                    var nextPosition;
                    console.log(ui.item);
                    var index = ui.item.attr('data-id').replace('key', '');
                    currPosition = $('#val' + index);
                    if (ui.item.next().attr('id') === undefined) {
                        nextPosition = $('.collectionMobile span:last');
                        currPosition.insertAfter(nextPosition);
                    } else {
                        index = ui.item.next().attr('id').replace('key', '');
                        nextPosition = $('#val' + index);
                        currPosition.insertBefore(nextPosition);
                    }
                }
            });
//======================================================================================================================
            //this function sets the gradient color of the mobile
//======================================================================================================================
            $('.gradient').each(function (index, element) {
                $(this).click(function () {
                    $('.gradient').removeClass('colorActive');
                    $(this).addClass('colorActive');
//                    $('#setBgColor').css('background', $(this).css('background'));
//                    $('.collectionMobile').css('background', $(this).css('background'));
//                    $('.statisticsMobile').css('background', $(this).css('background'));

                });
            });

// below code is for draggable functionality Jquery Library is used
//======================================================================================================================
            $(".draggable").draggable({
                opacity: 0.35,
                containment: "parent",
                axis: "y",
                cursor: "all-scroll",
                connectToSortable: "#sortable"
            });
            $('#bgColor').change(function () {
                $('#setBgColor').css('background-color', this.value);
            });

            $('#icheck').iCheck({
                checkboxClass: 'skin skin-square',
            });
            var switchery = new Switchery('.switchery', {
                color: '#37BC9B',
                size: 'small'
            });
//======================================================================================================================

//======================================================================================================================

            $.ajax({
                method: 'get',
                url: "{{route('customer.social_links.index')}}",
                success: function (data) {
                    $.each(data, function (i, value) {
                        button_type_id = this.id;
                        $('.sortable').append('' +
                            '<div class=" draggable m-2 " >' +
                            '<div class="container"> ' +
                            '<div class="row shadow ">' +
                            '<div class="col-md-1  px-1 py-1 border-right-black"><i class="fas fa-2x fa-ellipsis-v"></i>' +
                            '</div>' +
                            '<div class="col-md-10 ">' +
                            '<div class="row">' +
                            '<div class="col-6 p-1 " ><b>' + this.button_title + '</b></div>' +
                            '<div class="col-6 p-1 text-right">' +
                            '<input type="checkbox" data-id="' + this.id + '"  key="' + this.id + '" button-type="' +
                            this.button_type + '" value=' + this.button_title + ' name="showButton" class="switchery abc" ' +
                            'data-size="sm" id="collectionTabCheckbox' + this.id + '"/>' +
                            '</div>' +
                            '</div>' +
                            '<div class="row ">' +
                            '<div class="col"><i>' + this.account_name + '</i></div>' +
                            '<div class="col text-right pb-2">' +
                            '<form action="{{url('customer/social_links/')}}' + '/' + this.id + '" method="post" >' +
                            '<input type="hidden" name="_token" value="{{csrf_token()}}">' +
                            '<input type="hidden" name="_method" value="DELETE">' +
                            '<button type="submit" class="deleteSocialLink btn btn-sm btn-outline-danger" >' +
                            ' <i  class="fa fa-trash fa-4x deleteSocialLink" id="delete-data " delete-data=' + this.id
                            + '></i></button></form>' +
                            '</div>' +
                            '</div></div></div></div>');
                    });
                },
                error: function (errors) {
                    console.log(errors);
                }
            });
//======================================================================================================================
// Following code sends collection tab checkboxes data to the database
//======================================================================================================================
            $('body').on('click', 'input[name="showButton"]', function (index) {
                var collectionTabCheckboxes = null;
                if ($(this).prop('checked') === true) {
                    collectionTabCheckboxes = 1;
                    if ($(this).attr('button-type') === 'round_button') {
                        $('.collectionAccountButtons').append('<a href="{{route('username', $settings->user_name)}}" id="'
                            + $(this).attr('data-id') + '" class="btn btn-block border round removeAccountButton">'
                            + $(this).attr('value') + '</a>');
                    } else {
                        $('.collectionAccountButtons').append('<a href="{{route('username', $settings->user_name)}}" id="'
                            + $(this).attr('data-id') + '" class="btn btn-block border  removeAccountButton">'
                            + $(this).attr('value') + '</a>');
                    }
                }
                else {
                    collectionTabCheckboxes = 0;
                    $('#' + $(this).attr('data-id')).remove();

                }
                $.ajax({
                    method: 'get',
                    url: "{{route('customer.social_links.index')}}",
                    data: {
                        visibility: collectionTabCheckboxes,
                        id: $(this).attr('data-id')
                    }
                });
            });
//======================================================================================================================
//        Below code changes the border style of button displayed on mobile screen
//======================================================================================================================
            $('.changeButtonType').click(function () {
                var value = $(this).val();
                if (value === 'round_button') {
                    $('.removeAccountButton').addClass('round');
                }
                else {
                    $('.removeAccountButton').removeClass('round');
                }
                $.ajax({
                    url: "{{route('customer.social_links.index')}}",
                    type: "get",
                    data: {
                        button_type: value
                    }
                });
            });
//======================================================================================================================
//        Below code grabs data from Social-links Controller and sets the checkbox according to it
//======================================================================================================================
            $.ajax({
                method: 'get',
                url: "{{route('customer.social_links.index')}}",
                data: {
                    collectionTabCheckboxes: $(this).attr('data-id')
                },
                success: function (data) {
                    $.each(data, function (index, item) {
                        if (item.visibility === 1) {
                            $('#collectionTabCheckbox' + item.id).prop('checked', 'checked');
                            $('.collectionAccountButtons').append('<a href="{{route('username', $settings->user_name)}}" id="'
                                + item.id + '" class="btn btn-block border removeAccountButton">'
                                + item.button_title + '</a>');
                        }
                        if (item.button_type === "round_button") {
                            $('.removeAccountButton').addClass('round')
                        }
                    });

                }
            });

//======================================================================================================================
//        Document Ready Function is Ended Here
//======================================================================================================================
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
    <script>
        var monthly = [];
        $.ajax({
            url: "{{route('customer.analysis.index')}}",
            type: "get",
            success: function (data) {
                $.each(data, function(index, val){
                    monthly.push(val);
                })
                }
        });
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: 'Clicks',

//                    data: [0, 50, 100, 150, 200, 250, 300, 350, 400, 450, 500],
                    data: monthly,
                    fill: true,
                    borderColor: '#8E98FB',
                    backgroundColor: '#8E98FB',
                    borderWidth: 1
                },
//                    {
//                        label: 'Series 2',
//                        data: [1288, 30000, 32000, 7588, 99, 242, 1417, 5504, 75, 6811],
//                        fill: true,
//                        borderColor: '#E19FEF',
//                        backgroundColor: '#E19FEF',
//                        borderWidth: 1
//                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>


@endsection

