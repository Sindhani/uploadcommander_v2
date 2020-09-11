<a href="javascript:void(0);" id="openUrl"><i class="la la-chain"></i> URL</a>


<div class="modal fade text-left" id="defaultSize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18"><i class="la la-chain"></i> URL</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Media URL</label>
                        <input type="text" class="form-control" id="url" name="url">
                        <small class="form-text text-muted">Enter valid media url.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="upload">Upload</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
$(document).ready(function () {
    $("#openUrl").click(function () {
        $("#url").val('');
        $("#defaultSize").modal('show');
    });
    $("#upload").click(function () {
        if($("#url").val()=='') {
            alert('Please enter media url.');
            return false;
        }

        $.ajax({
            url: '{{ url('customer/copyFile') }}',
            data: 'url='+$("#url").val()+'&_token={{ csrf_token() }}&name=&size=&provider=url',
            type: 'POST',
            success: function () {
                window.location.reload();
            },
            error: function () {
                alert('Please enter valid url.');
            }
        });
    });
});
</script>
@endpush