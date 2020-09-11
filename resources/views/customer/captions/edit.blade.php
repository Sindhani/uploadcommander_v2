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
				<div class="row match-height">
					<div class="col-12">
						{!! Form::open(['route' => ['customer.captions.update', $caption->id], 'method' => 'put']) !!}
						{!! Form::label('captionTitle', 'Caption Title')  !!}
						{!! Form::text('caption_name', $caption->caption_name, ['class' => 'form-control', 'placeholder' => 'Caption Title here...']) !!}
						{!! Form::label('captionContent', 'Caption Content', ['class' => 'mt-1']) !!}
						<p class="lead emoji-picker-container">
							{!! Form::textarea('caption_content', $caption->caption_content, ['class' => 'form-control', 'rows' => '5', 'data-emojiable' => 'true', 'placeholder' => 'Write Caption Content ...']) !!}
						</p>
						{!! Form::submit('Update', ['class' => 'btn btn-sm btn-outline-danger float-right ml-1']) !!}
						{!! Form::button('Back', ['class' => 'mt-1 btn btn-sm btn-outline-blue-grey', 'onclick' => 'window.history.back();']) !!}
						{!! Form::close() !!}
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