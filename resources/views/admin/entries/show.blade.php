<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container" id="app">
        <h1>{{$entry->title}}</h1>
        <p>{{$entry->synonym}}</p>
        <p>{{$entry->distribution}}</p>
        <p>{{$entry->description}}</p>
        <p>{{ $url }}</p>
        <hr>
        <h1>jQuery UI Widget</h1>
        <!-- Esto es exactamente el ejemplo -->
        {!! QrCode::size(300)->margin(0.5)->generate(Request::url()); !!}
        <p>Escanéame para volver a la página principal.</p>
        <!-- Aquí termina el ejemplo -->
        <p>You can see this example with different themes on the <a href="http://plupload.com/example_jquery_ui.php">www.plupload.com</a> website.</p>

        <form id="form" method="post" action="/echo/json">
            <div id="uploader">
                <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
            </div>
            <br />
            <input type="submit" value="Submit" />
        </form>
    </div>
    <script src="{{ asset('js/plupload.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/jquery.ui.plupload.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
        $("#uploader").plupload({
            // General settings
            runtimes: 'html5,flash,silverlight,html4',
            
            // Fake server response here 
            // url : '../upload.php',
            url: "/echo/json",

            // Maximum file size
            max_file_size: '1000mb',

            // User can upload no more then 20 files in one go (sets multiple_queues to false)
            max_file_count: 20,
            
            chunk_size: '1mb',

            // Resize images on clientside if we can
            resize : {
                width: 200, 
                height: 200, 
                quality: 90,
                crop: true // crop to exact dimensions
            },

            // Specify what files to browse for
            filters: [
                { title: "Image files", extensions: "jpg,gif,png" },
                { title: "Zip files", extensions:  "zip,avi" }
            ],

            // Rename files by clicking on their titles
            rename: true,
            
            // Sort files
            sortable: true,

            // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
            dragdrop: true,

            // Views to activate
            views: {
                list: false,
                thumbs: true, // Show thumbs
                active: 'thumbs'
            },

            // Flash settings
            flash_swf_url : 'http://rawgithub.com/moxiecode/moxie/master/bin/flash/Moxie.cdn.swf',

            // Silverlight settings
            silverlight_xap_url : 'http://rawgithub.com/moxiecode/moxie/master/bin/silverlight/Moxie.cdn.xap'
        });


        // Handle the case when form was submitted before uploading has finished
        $('#form').submit(function(e) {
            // Files in queue upload them first
            if ($('#uploader').plupload('getFiles').length > 0) {

                // When all files are uploaded submit form
                $('#uploader').on('complete', function() {
                    $('#form')[0].submit();
                });

                $('#uploader').plupload('start');
            } else {
                alert("You must have at least one file in the queue.");
            }
            return false; // Keep the form from submitting
        });
    });
    </script>
</body>
</html>