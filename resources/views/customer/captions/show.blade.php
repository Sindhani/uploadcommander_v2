@extends('customer.layouts.app')
@section('styles')
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="{{asset('app-assets/vendors/css/emoji-picker/emoji.css')}}" rel="stylesheet">
	<style>

		.emoji-picker {
			width: 20px !important;
		}

		.emoji-wysiwyg-editor {
			height: 250px !important;
		}
	</style>


@endsection
@section('content')

	<div class="app-content content">
		<div class="content-wrapper">

			<div class="content-header row">
			</div>
			<div class="content-body">
				<div class="row">
					<div class="col-6">
						<div class="border-1 border-black px-2 py-2 shadow">

							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active " id="home-tab" data-toggle="tab" href="#facebook"
									   role="tab"
									   aria-controls="home" aria-selected="true">Facebook</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="profile-tab" data-toggle="tab" href="#instagram" role="tab"
									   aria-controls="profile" aria-selected="false">Instagram</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="contact-tab" data-toggle="tab" href="#twitter" role="tab"
									   aria-controls="contact" aria-selected="false">Twitter</a>
								</li>
							</ul>
							<div class="tab-content" id="myTabContent">
								<div class="mt-3">
									<div class="tab-pane fade show active" id="facebook" role="tabpanel"
									     aria-labelledby="home-tab">
										<div><img src="{{asset('images/boy.jpg')}}" width="250" height="250px"></div>
										<div class="mt-2">
											{{--facebook snippet--}}
											<div class="container">
												<div class="col-md-5">
													<div class="panel panel-default">
														<div class="panel-body">
															<section class="post-heading">
																<div class="row">
																	<div class="col-md-11">
																		<div class="media">
																			<div class="media-left">
																				<a href="#">
																					<img class="media-object photo-profile"
																					     src="{{asset('images/gavatar.png')}}"
																					     width="40" height="40"
																					     alt="...">
																				</a>
																			</div>
																			<div class="media-body">
																				<a href="#" class="anchor-username"><h4
																							class="media-heading">Bayu
																						Darmantra</h4></a>
																				<a href="#" class="anchor-time">51
																					mins</a>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-1">
																		<a href="#"><i
																					class="glyphicon glyphicon-chevron-down"></i></a>
																	</div>
																</div>
															</section>
															<section class="post-body">
																<p>{{$template->template_content ?? ''}}</p>
															</section>
															<section class="post-footer">
																<hr>
																<div class="post-footer-option container">
																	<ul class="list-unstyled">
																		<li><a href="#"><i
																						class="glyphicon glyphicon-thumbs-up"></i>
																				Like</a></li>
																		<li><a href="#"><i
																						class="glyphicon glyphicon-comment"></i>
																				Comment</a></li>
																		<li><a href="#"><i
																						class="glyphicon glyphicon-share-alt"></i>
																				Share</a></li>
																	</ul>
																</div>
																<div class="post-footer-comment-wrapper">
																	<div class="comment-form">

																	</div>
																	<div class="comment">
																		<div class="media">
																			<div class="media-left">
																				<a href="#">
																					<img class="media-object photo-profile"
																					     src="{{asset('images/gavatar.png')}}"
																					     width="32" height="32"
																					     alt="...">
																				</a>
																			</div>
																			<div class="media-body">
																				<a href="#" class="anchor-username"><h4
																							class="media-heading">Media
																						heading</h4></a>
																				<a href="#" class="anchor-time">51
																					mins</a>
																			</div>
																		</div>
																	</div>
																</div>
															</section>
														</div>
													</div>
												</div>

												<div class="tab-pane fade" id="instagram" role="tabpanel"
												     aria-labelledby="profile-tab">
													khna is sonmnnn fire
												</div>
											</div>

										</div>
										{{--facebook snippet ended--}}
									</div>

									<div class="tab-pane fade" id="twitter" role="tabpanel"
									     aria-labelledby="contact-tab">

									</div>
								</div>
								{{--facebook snippet ended--}}
							</div>
							<div class="tab-pane fade" id="instagram" role="tabpanel"
							     aria-labelledby="profile-tab">Instagrame Page
							</div>
							<div class="tab-pane fade" id="twitter" role="tabpanel"
							     aria-labelledby="contact-tab">Twitter Page

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="row px-2 mb-5">

					<div class="col-4 px-2">
						<h3>Facebook Tag</h3>
						<a href="">#tag1</a><br>
						<a href="">#tag1</a><br>
						<a href="">#tag1</a><br>
						<a href="">#tag1</a><br>
						<a href="">#tag1</a><br>


					</div>
					<div class="col-4 px-2">
						<h3>Twitter Tag</h3>
						<a href="">#tag1</a><br>
						<a href="">#tag1</a><br>
						<a href="">#tag1</a><br>
						<a href="">#tag1</a><br>
						<a href="">#tag1</a><br>
					</div>
					<div class="col-4 px-2">
						<h3>Instagram Tag</h3>
						<a href="">#tag1</a><br>
						<a href="">#tag1</a><br>
						<a href="">#tag1</a><br>
						<a href="">#tag1</a><br>
						<a href="">#tag1</a><br>
					</div>
				</div>
				<hr>
				<div class="row mt-5">
					<div class="col-12">
						{!! Form::open(['route' => 'customer.captions.store']) !!}
						{!! Form::label('captionTitle', 'Caption Title')  !!}
						{!! Form::text('caption_name', '', ['class' => 'form-control', 'placeholder' => 'Caption Title here...']) !!}
						{!! Form::label('captionContent', 'Caption Content', ['class' => 'mt-1']) !!}
						<p class="lead emoji-picker-container">
							{!! Form::textarea('caption_content', '', ['class' => 'form-control', 'rows' => '5', 'data-emojiable' => 'true', 'placeholder' => 'Write Caption Content ...']) !!}
						</p>
						{!! Form::submit('Add', ['class' => 'mt-0 btn btn-small btn-primary']) !!}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
@endsection
@section('scripts')
	<script src="{{asset('app-assets/vendors/js/emoji-picker/config.js')}}"></script>
	<script src="{{asset('app-assets/vendors/js/emoji-picker/util.js')}}"></script>
	<script src="{{asset('app-assets/vendors/js/emoji-picker/jquery.emojiarea.js')}}"></script>
	<script src="{{asset('app-assets/vendors/js/emoji-picker/emoji-picker.js')}}"></script>
	<script>

        $(function () {
            window.emojiPicker = new EmojiPicker({
                emojiable_selector: '[ data-emojiable = true]',
                assetsPath: '{{asset('app-assets/vendors/img/emoji-picker/')}}',
                popupButtonClasses: 'fa fa-smile-o',
            });
            window.emojiPicker.discover();
        });
	</script>
@endsection