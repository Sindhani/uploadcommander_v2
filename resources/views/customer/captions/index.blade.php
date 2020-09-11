@extends('customer.layouts.app')
@section('styles')
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
@endsection



@section('content')
	<div class="app-content content">
		<div class="content-wrapper">
			<div class="content-wrapper-before"></div>
			<div class="content-header row">
				<div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
					<h3 class="content-header-title mb-0 d-inline-block border-right-0">Captions</h3>
				</div>
			</div>
			<div class="content-body">
			@if(Session::has('success'))
				@include('customer.captions.success')
			@endif
				<section id="base-style">

				<!-- Chart -->
				<div class="container">
					<div class="row match-height">
						<div class="col-12">

							<a href="{{route('customer.captions.create')}}" class="float-right">
								<button type="button" class="btn btn-sm btn-primary">Add Caption</button>
							</a>

							<div class="row">

								{{--Card CSS --}}
								@foreach($captions as $caption)
									<div class="col-xs-12 col-sm-12 col-lg-4 ">
										<div class="card bg-light mb-3 ml-2" style="max-width: 18rem;">
											<div class="card-header card-title">{{$caption->caption_name}}</div>

											<div class="card-body">
												<a href="{{route('customer.captions.show', $caption->id)}}">
													<p class="card-text">{{$caption->caption_content}}</p>
												</a>
												<p class="mt-5">

												<form method="POST" action="{{ route('customer.captions.destroy', $caption->id) }}">
													@csrf
													<input name="_method" type="hidden" value="DELETE">
													<button type="submit"
													        class="btn btn-sm btn-outline-danger ml-1 show_confirm float-right"
													         title='Delete'><i
																class="fa fa-trash"> </i></button>
												</form>


												<a href="{{route('customer.captions.edit', $caption->id)}}">
													<button type="submit"
													        class="btn btn-sm btn-outline-info float-right ml-1">
														<i class="fa fa-edit"></i>
													</button>
												</a>
												</p>
											</div>
										</div>
									</div>
								@endforeach

								{{--Card CSS ended--}}
							</div>

					</div>
				</div>
				</div>

				</section>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
	<script type="text/javascript">
        $('.show_confirm').click(function (e) {
            if (!confirm('Are you sure you want to delete this?')) {
                e.preventDefault();
            }
        });
	</script>

@endsection
