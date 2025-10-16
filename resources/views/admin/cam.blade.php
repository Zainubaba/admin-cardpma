<!doctype html>
<html lang="en">

<head>

    <style type="text/css">
        form input {
            margin-right: 15px;
        }

        #results {
            display: inline-block;
            margin: 20px;
            padding: 20px;
            border: 1px solid;
            background: #ccc;
        }

        .hide {
            display: none;
        }


        .dropdown-toggle {
            height: 40px;
            /* width: 400px !important; */
        }

        @media (max-width: 576px) {
            .navcenter {
                margin-left: 60px;
            }
        }

        @media (min-width: 576px) {
            .navcenter {
                margin-left: 260px;
            }
        }

        @media only screen and (max-width:1200px){
            .avatararea{
                max-width:35%;
                margin-left:80px;
            }
        }
        @media only screen and (min-width:1200px){
            .avatararea{
                max-width:65%;
                margin-left:80px;
            }
        }

        @media only screen and (max-width:995px){
            .avatararea{
                max-width:55%;
                margin-left:230px;
            }
        }

        @media only screen and (max-width:768px){
            .avatararea{
                max-width:60%;
            }
        }

        @media only screen and (max-width:430px){
            .avatararea{
                max-width: 65%;
                margin-left: 170px;
            }
        }

        @media only screen and (max-width:380px){
            .avatararea{
                margin-left: 140px;
            }
        }

        @media only screen and (max-width:330px){
            .avatararea{
                margin-left: 130px;
            }
        }

        .submit {

            background-color: white;
            border-radius: 10px;
            padding: 5px;
            color: black;
            font-size: 20px;
            margin-left: 82%;
            width: 120px;
        }

        .submit:hover {
            background-color: #0E3E65;
            color: white;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Font-->
    <link rel="stylesheet" type="text/css" href="/css/nunito-font.css">
    <link rel="stylesheet" type="text/css"
        href="/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

    <!-- {{ url('css/app.css') }} -->
    <!-- Main Style Css -->

    <!-- webcame link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    {{-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> --}}
    {{-- <link rel="stylesheet" href="cam/assets/css/bootstrap.min.css" /> --}}
    <link rel="stylesheet" href="cam/assets/css/layout.css" />
    <link rel="stylesheet" href="cam/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="cam/cropper/cropper.css" />

</head>


<body>

    <i id="svgcamera" class="fa fa-camera" style="font-size:36px; color:#54656f;"></i>

    <section class="a2z-area">
        <div class="container"  style="display: none; margin-left:-140px;"  id="popupcamera">
            <div class="row">
                <div class="col-lg-6">
                    <div class="avatararea">
                        <label><b>ATTACH</b></label>
                        <!-- input file -->
                        <!-- <div class="box">
  <input type="file" id="file-input">
 </div> -->
                        <!-- leftbox -->
                        <div class="box-2">
                            <div class="result"></div>
                        </div>
                        <!--rightbox-->
                        <div class="box-2 img-result hide">
                            <!-- result of crop -->
                            <img class="cropped" src="" alt="">
                        </div>
                        <!-- input file -->
                        <div class="box ">
                            <div id="saveDiv" class="options hide">
                                <label> Width</label>
                                <input type="number" class="img-w" value="300" min="100" max="1200" />

                                <!-- save btn -->
                                <button id="saveBtn" class="btn save hide">Save</button>
                            </div>
                            <div style="width:100%">
                                <!-- add autoplay muted playsinline for iOS -->
                                <video id="cam" autoplay muted playsinline>Not
                                    available</video>
                                <canvas id="canvas" style="display:none"></canvas>
                                <img id="photo" style="display:none"
                                    alt="The screen capture will appear in this box.">
                            </div>
                            <div class="row">
                                <div class="imagearea col-lg-5 col-md-5 col-sm-12">
                                    <div class="avatarimage hide" id="drop-area">
                                        <img width="200" id="output" name="output"
                                            src="cam/assets/img/avatar.jpg" alt="avatar" />
                                        <p>Drop your document here</p>
                                        <input type="hidden" name="complain_pic" class="image-tag" id="imagepic">
                                    </div>

                                    <div class="buttonarea">
                                        <!-- <button class="btn upload" data-toggle="modal" data-target="#myModal" onclick="cropImage()"><i class="fa fa-upload"></i> &nbsp; Upload</button> -->
                                        {{-- <div>
                                                                    <label class="btn upload">
                                                                        <i class="fa fa-upload"></i> &nbsp; Upload<input
                                                                            type="file" class="sr-only"
                                                                            id="file-input" name="complain_pic"
                                                                            accept="image/*" /></label>
                                                                </div> --}}
                                        <div class="btn-group" role="group" aria-label="Basic example">

                                            <button type="button" id="switchFrontBtn" class="btn btn-secondary">Front
                                                Camera</button>
                                            <button type="button" id="switchBackBtn" class="btn btn-secondary">Back
                                                Camera</button>
                                            <button type="button" id="snapBtn"
                                                class="btn btn-secondary">Snap</button>
                                        </div>

                                    </div>

                                    <div class="alert" role="alert"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- The Make Selection Modal -->
    <div class="modal" id="myModal" style="display:none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Make a selection</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div id="cropimage">
                        <img id="imageprev" src="assets/img/bg.png" />
                    </div>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            0%
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="btngroup">
                        <button type="button" class="btn upload1 float-left" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btnsmall" id="rotateL" title="Rotate Left">
                            <i class="fa fa-undo"></i>
                        </button>
                        <button type="button" class="btn btnsmall" id="rotateR" title="Rotate Right">
                            <i class="fa fa-repeat"></i>
                        </button>
                        <button type="button" class="btn btnsmall" id="scaleX" title="Flip Horizontal">
                            <i class="fa fa-arrows-h"></i>
                        </button>
                        <button type="button" class="btn btnsmall" id="scaleY" title="Flip Vertical">
                            <i class="fa fa-arrows-v"></i>
                        </button>
                        <button type="button" class="btn btnsmall" id="reset" title="Reset">
                            <i class="fa fa-refresh"></i>
                        </button>
                        <button type="button" class="btn camera1 float-right" id="saveAvatar">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Camera Modal -->
    <div class="modal" id="cameraModal" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Take a picture</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div id="my_camera"></div>
                    {{-- <input type="hidden" name="vcnicf" id="vcnicf" class="image-tag"> --}}
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn upload" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn camera" onclick="take_snapshot()">
                        Take a picture
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery.steps.js"></script>
    <script src="js/main.js"></script>
    <script src="/js/webcam.js"></script>
    <script src="/js/webcam.min.js"></script>
    <script src="cam/assets/js/jquery-1.12.4.min.js"></script>
    <script src="cam/assets/js/bootstrap.min.js"></script>
    <script src="cam/assets/js/dropzone.js"></script>
    <!-- Script -->
    <script src="cam/webcamjs/webcam.min.js"></script>
    <script src="cam/cropper/cropper.js"></script>

    <script language="JavaScript">
        // Configure a few settings and attach camera
        function configure() {
            Webcam.set({
                width: 640,
                height: 480,
                image_format: "jpeg",
                jpeg_quality: 100,
            });
            Webcam.attach("#my_camera");
        }
        // // A button for taking snaps
        const saveBtn = document.getElementById('saveBtn');

        saveBtn.onclick = function() {
            document.getElementById('saveDiv').style.display = "none"
        }

        function take_snapshot() {
            // take snapshot and get image data

            var fileimage = document.querySelector("#output");
            let result = document.querySelector(".result");
            result.style.display = "block";

            upload = document.querySelector("#file-input");

            // Webcam.snap(function(data_uri) {
            //     fileimage.src = data_uri;
            //     console.log(fileimage.src);
            //     let image = document.createElement('input');
            //     image.name = 'random';
            //     image.value = data_uri;
            //     result.appendChild(image);
            //     let img = document.createElement("img");
            //     img.id = "image";
            //     img.src = data_uri;
            //     // clean result before
            //     result.innerHTML = "";
            //     // append new image
            //     result.appendChild(img);

            //     save.classList.remove("hide");
            //     options.classList.remove("hide");
            //     // init cropper
            //     console.log(img);
            //     cropper = new Cropper(img);
            //     // display results in page
            //     $("#cameraModal").modal("hide");
            //     $("#myModal").modal({
            //         backdrop: "static"
            //     });
            //     $(".image-tag").val(data_uri);
            //     $("#cropimage").html('<img id="imageprev" src="' + data_uri + '"/>');
            //     // cropImage();
            //     $("#myModal").modal("hide");


            //     //document.getElementById('cropimage').innerHTML = ;
            // });

            Webcam.reset();
        }

        function saveSnap() {
            // Get base64 value from <img id='imageprev'> source
            var base64image = document.getElementById("imageprev").src;
            console.log(base64image);
            Webcam.upload(base64image, "upload.php", function(code, text) {
                console.log("Save successfully");
                // console.log(text);
            });
        }

        $("#cameraModal").on("show.bs.modal", function() {
            configure();
        });

        $("#cameraModal").on("hide.bs.modal", function() {
            Webcam.reset();
            $("#cropimage").html("");
        });

        $("#myModal").on("hide.bs.modal", function() {
            $("#cropimage").html('<img id="imageprev" src="assets/img/bg.png"/>');
        });

        /* UPLOAD Image */
        var input = document.getElementById("input");
        var $alert = $(".alert");

        /* DRAG and DROP File */
        $("#drop-area").on("dragenter", function(e) {
            e.preventDefault();
        });

        $("#drop-area").on("dragover", function(e) {
            e.preventDefault();
        });

        $("#drop-area").on("drop", function(e) {
            var image = document.querySelector("#imageprev");
            var files = e.originalEvent.dataTransfer.files;
            var done = function(url) {
                input.value = "";
                image.src = url;
                $alert.hide();
                $("#myModal").modal({
                    backdrop: "static"
                });
                cropImage();
            };

            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }

            e.preventDefault();
        });

        /* INPUT UPLOAD FILE */
        input.addEventListener("change", function(e) {
            var image = document.querySelector("#imageprev");
            var imageFile = document.querySelector("#output");

            var files = e.target.files;
            var done = function(url) {
                input.value = "";
                image.src = url;
                imageFile.src = url;

                $alert.hide();
                $("#myModal").modal({
                    backdrop: "static"
                });
                cropImage();
            };
            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
        /* CROP IMAGE AFTER UPLOAD */
        function cropImage() {
            var image = document.querySelector("#imageprev");

            var minAspectRatio = 0.5;
            var maxAspectRatio = 1.5;

            var cropper = new Cropper(image, {
                aspectRatio: 11 / 12,
                minCropBoxWidth: 220,
                minCropBoxHeight: 240,

                ready: function() {
                    var cropper = this.cropper;
                    var containerData = cropper.getContainerData();
                    var cropBoxData = cropper.getCropBoxData();
                    var aspectRatio = cropBoxData.width / cropBoxData.height;
                    //var aspectRatio = 4 / 3;
                    var newCropBoxWidth;
                    cropper.setDragMode("move");
                    if (aspectRatio < minAspectRatio || aspectRatio > maxAspectRatio) {
                        newCropBoxWidth =
                            cropBoxData.height * ((minAspectRatio + maxAspectRatio) / 2);

                        cropper.setCropBoxData({
                            left: (containerData.width - newCropBoxWidth) / 2,
                            width: newCropBoxWidth,
                        });
                    }
                },

                cropmove: function() {
                    var cropper = this.cropper;
                    var cropBoxData = cropper.getCropBoxData();
                    var aspectRatio = cropBoxData.width / cropBoxData.height;

                    if (aspectRatio < minAspectRatio) {
                        cropper.setCropBoxData({
                            width: cropBoxData.height * minAspectRatio,
                        });
                    } else if (aspectRatio > maxAspectRatio) {
                        cropper.setCropBoxData({
                            width: cropBoxData.height * maxAspectRatio,
                        });
                    }
                },
            });

            $("#scaleY").click(function() {
                var Yscale = cropper.imageData.scaleY;
                if (Yscale == 1) {
                    cropper.scaleY(-1);
                } else {
                    cropper.scaleY(1);
                }
            });

            $("#scaleX").click(function() {
                var Xscale = cropper.imageData.scaleX;
                if (Xscale == 1) {
                    cropper.scaleX(-1);
                } else {
                    cropper.scaleX(1);
                }
            });

            $("#rotateR").click(function() {
                cropper.rotate(45);
            });
            $("#rotateL").click(function() {
                cropper.rotate(-45);
            });
            $("#reset").click(function() {
                cropper.reset();
            });

            $("#saveAvatar").click(function() {
                var $progress = $(".progress");
                var $progressBar = $(".progress-bar");
                var avatar = document.getElementById("avatarimage");
                var $alert = $(".alert");
                canvas = cropper.getCroppedCanvas({
                    width: 220,
                    height: 240,
                });

                $progress.show();
                $alert.removeClass("alert-success alert-warning");
                canvas.toBlob(function(blob) {
                    var formData = new FormData();

                    formData.append("avatar", blob, "avatar.jpg");
                    $.ajax("upload.php", {
                        method: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,

                        xhr: function() {
                            var xhr = new XMLHttpRequest();

                            xhr.upload.onprogress = function(e) {
                                var percent = "0";
                                var percentage = "0%";

                                if (e.lengthComputable) {
                                    percent = Math.round((e.loaded / e.total) * 100);
                                    percentage = percent + "%";
                                    $progressBar
                                        .width(percentage)
                                        .attr("aria-valuenow", percent)
                                        .text(percentage);
                                }
                            };

                            return xhr;
                        },

                        success: function() {
                            //$alert.show().addClass('alert-success').text('Upload success');
                        },

                        error: function() {
                            avatar.src = initialAvatarURL;
                            $alert.show().addClass("alert-warning").text("Upload error");
                        },

                        complete: function() {
                            $("#myModal").modal("hide");

                            $progress.hide();
                            initialAvatarURL = avatar.src;
                            avatar.src = canvas.toDataURL();
                            console.log("avatar: ", avatar.src);
                        },
                    });
                });
            });
        }
    </script>
    <script>
        // vars
        let result = document.querySelector(".result"),
            img_result = document.querySelector("#output"),
            img_w = document.querySelector(".img-w"),
            img_h = document.querySelector(".img-h"),
            options = document.querySelector(".options"),
            save = document.querySelector(".save"),
            cropped = document.querySelector("#output"),
            dwn = document.querySelector(".download"),
            upload = document.querySelector("#file-input"),
            cropper = "";

        // on change show image with crop options
        upload.addEventListener("change", (e) => {
            result.style.display = "block";

            // document.getElementById("cameraModal").style.display="none";
            if (e.target.files.length) {
                // start file reader
                const reader = new FileReader();
                reader.onload = (e) => {
                    if (e.target.result) {
                        // create new image
                        let img = document.createElement("img");
                        img.id = "image";
                        img.src = e.target.result;
                        console.log("image: ", img.src);
                        // clean result before
                        result.innerHTML = "";
                        // append new image
                        result.appendChild(img);
                        // show save btn and options
                        save.classList.remove("hide");
                        options.classList.remove("hide");
                        // init cropper
                        cropper = new Cropper(img);


                    }
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // save on click
        save.addEventListener("click", (e) => {
            result.style.display = "none";

            e.preventDefault();
            // get result to data uri
            let imgSrc = cropper
                .getCroppedCanvas({
                    width: img_w.value, // input value
                })
                .toDataURL();
            // remove hide class of img
            cropped.classList.remove("hide");
            img_result.classList.remove("hide");
            // show image cropped
            cropped.src = imgSrc;
            $(".image-tag").val(imgSrc);
            dwn.classList.remove("hide");
            dwn.download = "imagename.png";
            dwn.setAttribute("href", imgSrc);
        });
    </script>
    <script>
        /*
                                            Please try with devices with camera!
                                            */

        /*
        Reference:
        https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
        https://developers.google.com/web/updates/2015/07/mediastream-deprecations?hl=en#stop-ended-and-active
        https://developer.mozilla.org/en-US/docs/Web/API/WebRTC_API/Taking_still_photos
        */

        // reference to the current media stream
        var mediaStream = null;

        // Prefer camera resolution nearest to 1280x720.
        var constraints = {
            audio: false,
            video: {
                width: {
                    ideal: 640
                },
                height: {
                    ideal: 480
                },
                facingMode: "environment"
            }
        };

        async function getMediaStream(constraints) {
            try {
                mediaStream = await navigator.mediaDevices.getUserMedia(constraints);
                let video = document.getElementById('cam');
                video.srcObject = mediaStream;
                video.onloadedmetadata = (event) => {
                    video.play();
                };
            } catch (err) {
                console.error(err.message);
            }
        };

        async function switchCamera(cameraMode) {
            try {
                // stop the current video stream
                if (mediaStream != null && mediaStream.active) {
                    var tracks = mediaStream.getVideoTracks();
                    tracks.forEach(track => {
                        track.stop();
                    })
                }

                // set the video source to null
                document.getElementById('cam').srcObject = null;

                // change "facingMode"
                constraints.video.facingMode = cameraMode;

                // get new media stream
                await getMediaStream(constraints);
            } catch (err) {
                console.error(err.message);
                alert(err.message);
            }
        }
        let video = document.getElementById('cam');
        let photo = document.getElementById('photo');

        function takePicture() {
            let canvas = document.getElementById('canvas');

            let context = canvas.getContext('2d');

            const height = video.videoHeight;
            const width = video.videoWidth;

            if (width && height) {
                canvas.width = width;
                canvas.height = height;
                context.drawImage(video, 0, 0, width, height);
                var data = canvas.toDataURL('image/png');
                photo.setAttribute('src', data);

                // take snapshot and get image data

                var fileimage = document.querySelector("#output");
                let result = document.querySelector(".result");
                result.style.display = "block";

                upload = document.querySelector("#file-input");


                fileimage.src = data;
                let img = document.createElement("img");
                img.id = "image";
                img.src = data;
                // console.log(data);
                // clean result before
                result.innerHTML = "";
                document.getElementById('imagepic').value = data;
                console.log(data, 'random value is here');
                // append new image
                result.appendChild(img);
                save.classList.remove("hide");
                options.classList.remove("hide");
                // init cropper
                cropper = new Cropper(img);
                photo.style.display = "none";
                video.style.display = "none";



                //document.getElementById('cropimage').innerHTML = ;



            } else {
                clearphoto();
            }
        }


        function clearPhoto() {
            let canvas = document.getElementById('canvas');
            let photo = document.getElementById('photo');
            let context = canvas.getContext('2d');

            context.fillStyle = "#AAA";
            context.fillRect(0, 0, canvas.width, canvas.height);
            var data = canvas.toDataURL('image/png');
            photo.setAttribute('src', data);
        }

        document.getElementById('switchFrontBtn').onclick = (event) => {
            switchCamera("user");
            video.style.display = "block";
            video.style.maxWidth = "200px";
        }

        document.getElementById('switchBackBtn').onclick = (event) => {
            switchCamera("environment");
            video.style.display = "block";
            video.style.maxWidth = "200px";

        }

        document.getElementById('snapBtn').onclick = (event) => {
            takePicture();

            event.preventDefault();
        }

        clearPhoto();
    </script>

    <!------ close------>

    <script>
        const svgcamera = document.getElementById('svgcamera');
        console.log(svgcamera);
        const popupcamera = document.getElementById('popupcamera');
        console.log(popupcamera);
        let isSvgVisible = true;

        svgcamera.addEventListener("click", function() {
            if (isSvgVisible) {
                popupcamera.style.display = "inline-block";
                console.log(popupcamera);
            } else {
                popupcamera.style.display = "none";
            }
            isSvgVisible = !isSvgVisible;
        });
    </script>


</body>

</html>
