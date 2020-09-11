@foreach($links_stats as $links)
<div class="col-lg-4 p-2">
    <div class="card pull-up bg-gradient-directional-danger">
        <div class="card-header bg-hexagons-danger">
            <h4 class="card-title white">{{$links->button_title}}</h4>
        </div>
        <div class="card-content collapse show bg-hexagons-danger">
            <div class="card-body">
                <div class="media d-flex">
                    <div class="align-self-center width-100">
                        <div id="Analytics-donut-chart" class="height-100 donutShadow">
                            <i class="fab fa-3x fa-{{$links->account}}"></i>

                        </div>
                    </div>
                    <div class="media-body text-right mt-1">
                        <h3 class="font-large-2 white">{{$links->clicks_count}}</h3>
                        <h6 class="mt-1"><span class="text-muted white">Clicks since {{$links->created_at}}</span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @endforeach