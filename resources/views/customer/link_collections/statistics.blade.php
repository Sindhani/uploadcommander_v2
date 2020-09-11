<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="row ">
                <div class="my-graph">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <div class="container px-3"><div class="row mt-2">
                <div class="col-lg-4 p-0">
                    <div class="text-center border border-right-0  border-left-0 p-3">
                        <p>Total Views</p>
                        <span class="viewFigurePersonalLink p-2 count">...</span>
                    </div>
                </div>
                <div class="col-lg-4 p-0">
                    <div class="text-center border border-right-0 p-3">
                        <p>Clicks on your Links</p>
                        <span class="viewFigureTotalLinks p-2">...</span>
                    </div>
                </div>
                <div class="col-lg-4 p-0">
                    <div class="text-center border border-right-0 p-3">
                        <p>Click Rate</p>
                        <span class="viewFigureClickRate p-2">...</span>
                    </div>
                </div>
            </div></div>
        </div>
        <div class="col-lg-4">
            <div class="col-lg-5">
                <div class="px-1 py-1 shadow setBgColor mx-auto statisticsMobile" style="
													        height: 600px;
													        width: 320px;
													        position: relative;
													        border: solid black 15px;
													        border-radius: 24px;
													        background-color: #7ecff4;

															">
                    <div class="" style="display: none; " id="statisticsProfilePicture">
                        <img src="{{asset('images/'.$settings->picture)}}"
                             class="mb-1 mx-auto d-block" width="100px" height="100px"
                             style="border-width: 1px; border-radius: 50%;">
                    </div>
                    <div class="" style="display: none;" id="statisticsLinkName">
                        <div class="text-center">{{"@".$settings->user_name}}</div>
                    </div>
                    <div class="statisticsAccountButtons"></div>
                    <div class="" style="display: none; position: absolute; bottom: 5px;" id="statisticsLogo">
                        <img src="{{asset('images/logo.png')}}" class="mb-2 mx-auto d-block " width="270" height="40">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row pt-5">
        @include('customer.link_collections.partials.statistics_button')
    </div>
</div>

