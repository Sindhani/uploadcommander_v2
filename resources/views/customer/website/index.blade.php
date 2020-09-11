@extends('customer.website.layout.app')
@section('title', 'Custom Website')
@section('css')
    .fluid-container {
    background: {{$links_options->bg_color}};
    height: 100vh;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    position: relative;
    }
@endsection
@section('contents')
    <div>
        <img src="{{(asset('images'.'/'.$links_options->picture)) ? (asset('images'.'/'.$links_options->picture)) : asset('images/user.jpeg')}}"
             title="profile Picture"
             class="d-block mx-auto d-block" width="200" height="200"
             style="border-radius: 50%;">
    </div>
    <h1 class="mx-auto  p-2 text-center text-uppercase">{{"@".$links_options->user_name}}</h1>
    @foreach($buttons as $link)
        @if($link->button_type=="round_button")
            <div class="text-center  my-2">
                <a href="{{$link->account_name}}" class="click_count text-capitalize"
                   button-type="{{$link->account}}" data-id="{{$link->id}}">
                    <button type="button" class="btn btnsss px-5 round_button">{{$link->account_name}}</button>
                </a>
            </div>
        @else
            <div class="text-center  my-2">
                <a href="{{$link->account_name}}" class="click_count text-capitalize btn btnsss px-5"
                   button-type="{{$link->account}}" data-id="{{$link->id}}">
                    {{$link->account_name}}
                </a>
            </div>
        @endif
    @endforeach
    @if($links_options->logo_option==1)
        <div class="images-box">
            <img src="{{asset('images/logo.png')}}" class="mb-2 mx-auto d-block " width="270" height="40">
        </div>

    @endif
@stop
@section('scripts')
    <script>
        $(function () {
            $(".click_count").on("click", function (evt) {
                evt.preventDefault();
                var link = $(this).attr('href');
                $.ajax({
                    type: 'get',
                    url: "{{route('customer.social_links.index')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        id: $(this).attr('data-id'),
                        statistics: $(this).attr('button-type')
                    },
                    success: function (data) {
                        console.log(data);
                    },
                    error:function () {
                        alert('error occord');
                    }
                }).done(function () {
                    window.location = "//" + link;
                });
            });
        });
    </script>
@stop