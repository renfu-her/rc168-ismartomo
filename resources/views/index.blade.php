<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QR Code</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div style="width: 300px" id="reader"></div>
        <div id="qrcode-result"></div>
        <div id="show-image"></div>
    </div>

    <script src="{{ asset('js/html5-qrcode.min.js') }}"></script>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // Handle on success condition with the decoded text or result.
            console.log(`Scan result: ${decodedText}`, decodedResult);
            $('#qrcode-result').html(decodedText);
            $('#show-image').html(`<img id="qrcode-data" src="${decodedText}" alt="QR Code">`);

        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 6,
                qrbox: 250
            });
        html5QrcodeScanner.render(onScanSuccess);
    </script>

    <div class="container">
        <h1>Webcam 照相</h1>

        <div class="col-12">
            <form>
                <input type="button" value="取得相機權限" onClick="setup(); $(this).hide().next().show();">
                <input type="button" value="照相" onClick="take_snapshot()" style="display: none" id="take_picture">
            </form>
            <div class="gap-3"></div>
            <div id="my_camera"></div>
        </div>
        <div class="col-12">
            <div id="results">照相的圖片</div>
        </div>
    </div>



    <!-- First, include the Webcam.js JavaScript Library -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/webcam.min.js') }}"></script>

    <!-- Configure a few settings and attach camera -->
    <script language="JavaScript">
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90,
            constraints: {
                facingMode: "user"
            }
        });
    </script>

    <!-- A button for taking snaps -->

    <!-- Code to handle taking the snapshot and displaying it locally -->
    <script language="JavaScript">
        function setup() {
            Webcam.reset();
            Webcam.attach('#my_camera');
        }

        function take_snapshot() {
            $('#take_picture').show();

            // take snapshot and get image data
            Webcam.snap(function(data_uri) {
                // display results in page
                document.getElementById('results').innerHTML =
                    '<h2>Here is your image:</h2>' +
                    '<img id="camera-data" src="' + data_uri + '"/>';
            });
        }
    </script>




    <style type="text/css">
        body {
            font-family: Helvetica, sans-serif;
        }

        h2,
        h3 {
            margin-top: 0;
        }

        form {
            margin-top: 15px;
        }

        form>input {
            margin-right: 15px;
        }

        #results {
            /* margin: 20px; */
            margin-top: 20px;
            padding: 20px;
            border: 1px solid;
            background: #ccc;
        }
    </style>
</body>

</html>
