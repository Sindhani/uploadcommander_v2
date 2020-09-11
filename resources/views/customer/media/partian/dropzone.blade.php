<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Upload Local Files</h4>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <ul class="list-style-circle">
                        <li>Only jpg, jpeg, png, bmp, gif files allowed.</li>
                        <li>Maximum 10 files upload at a once.</li>
                        <li>Max filesize 2 MB.</li>
                    </ul>
                    <p class="card-text"></p>
                    <form action="{{ route('customer.media.store')}}" class="dropzone dropzone-area" id="dpz-multiple-files">
                        <div class="dz-message">Drop Files Here Or Click To Upload</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone(".dropzone",{
        maxFilesize: 10,  // 3 mb
        acceptedFiles: ".jpeg,.jpg,.png,.bpm,.gif,.mp4",
        maxFiles: 10,
        //maxThumbnailFilesize: 1, // MB
        addRemoveLinks: false,
        //dictRemoveFile: " Trash",
        init: function () {
            // Set up any event handlers
            this.on('success', function() {
                if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                    location.reload();
                }
            })
        }
    });
    myDropzone.on("sending", function(file, xhr, formData) {
        formData.append("_token", CSRF_TOKEN);
    });
</script>
@endpush