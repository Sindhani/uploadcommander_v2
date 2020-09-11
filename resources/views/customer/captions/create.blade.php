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
				<!-- Chart -->
				<div class="row match-height">
					<div class="col-6">
					</div>
					<div class="col-6">
						<div class="row">
						</div>
						<div class="row">
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
                assetsPath: '{{asset('/app-assets/vendors/img/emoji-picker')}}',
                popupButtonClasses: 'fa fa-smile-o',


            });
            window.emojiPicker.discover();
        });
	</script>


@endsection