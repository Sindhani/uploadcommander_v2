<div id="dropbox-container"></div>

@push('scripts')
<script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs" data-app-key="dkw3zknc7o5j4f1"></script>
<script>
    options = {
        success: function(files) {
            var count = 0;
            files.forEach(function(file) {
                 //alert('files: ' + JSON.stringify(file));
                //add_img_to_list(file);
                $.ajax({
                    url: '{{ url('customer/copyFile') }}',
                    data: 'url='+encodeURI(file.link)+'&_token={{ csrf_token() }}&name='+file.name+'&size='+file.bytes+'&provider=dropbox',
                    type: 'POST',
                    success: function () {
                        count = parseInt(count) + 1;
                        if(count == files.length) {
                            window.location.reload();
                        }
                    },
                    error: function () {
                        alert('Something is wrong. Please upload again.');
                    }
                });
            });

        },
        cancel: function() {
            //optional
        },
        linkType: "direct", // "preview" or "direct"
        multiselect: true, // true or false
        //extensions: ['.png', '.jpg', '.jpeg', '.gif', '.bmp', '.mp4'],
        extensions: ['.png', '.jpg', '.jpeg', '.gif', '.bmp'],
    };

    var button = Dropbox.createChooseButton(options);
    document.getElementById("dropbox-container").appendChild(button);

    function add_img_to_list(file) {
        var li  = document.createElement('li');
        var a   = document.createElement('a');
        a.href = file.link;
        var img = new Image();
        var src = file.thumbnailLink;
        src = src.replace("bounding_box=75", "bounding_box=256");
        src = src.replace("mode=fit", "mode=crop");
        img.src = src;
        img.className = "th"
        alert(file.link);
        //document.getElementById("img_list").appendChild(li).appendChild(a).appendChild(img);
    }

    //Dropbox.choose(options);
</script>
@endpush
