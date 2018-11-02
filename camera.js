(function() {
  var width = 1920;
  var height = 0;
  var streaming = false;
  var video = null;
  var canvas = null;
  var photo = null;
  var startbutton = null;
  var filter = null;
  let filterIndex = 0;
  const filters = [
    'grayscale(1)',
    'sepia(1)',
    'blur(3px)',
    'brightness(5)',
    'contrast(8)',
    'hue-rotate(90deg)',
    'hue-rotate(180deg)',
    'hue-rotate(270deg)',
    'saturate(10)',
    'invert(1)',
    ''
  ];

  function startup() {
    video = document.getElementById('video');
    canvas = document.getElementById('canvas');
    var ctx = canvas.getContext('2d');
    photo = document.getElementById('photo');
    startbutton = document.getElementById('startbutton');
    filter = document.getElementById('filter');
    navigator.getMedia = ( navigator.getUserMedia ||
      navigator.webkitGetUserMedia ||
      navigator.mozGetUserMedia ||
      navigator.msGetUserMedia);
      navigator.getMedia(
        {
          video: true,
          audio: false
        },
        function(stream) {
          if (navigator.mozGetUserMedia) {
            video.mozSrcObject = stream;
          } else {
            var vendorURL = window.URL || window.webkitURL;
            video.src = vendorURL.createObjectURL(stream);
          }
          video.play();
        },
        function(err) {
          console.log("An error occured! " + err);
        }
      );

      video.addEventListener('canplay', function(ev){
        if (!streaming) {
          height = video.videoHeight / (video.videoWidth/width);
          if (isNaN(height)) {
            height = width / (4/3);
          }
          video.setAttribute('width', width);
          video.setAttribute('height', height);
          canvas.setAttribute('width', width);
          canvas.setAttribute('height', height);
          streaming = true;
        }
      }, false);

      startbutton.addEventListener('click', function(ev){
        takepicture();
        ev.preventDefault();
      }, false);

      filter.addEventListener('click', function(ev){
        if (filterIndex > 11)
          filterIndex = 0;
        document.getElementById("video").style.filter = filters[filterIndex];
        document.getElementById("photo").style.filter = filters[filterIndex];
        document.getElementById("canvas").style.filter = filters[filterIndex];
        filterIndex++;

      }, false);
      clearphoto();
    }
    function clearphoto() {
      var context = canvas.getContext('2d');
      context.fillStyle = "#AAA";
      context.fillRect(0, 0, canvas.width, canvas.height);

      var data = canvas.toDataURL('image/png');
      photo.setAttribute('src', data);
    }
    function takepicture() {
      var context = canvas.getContext('2d');
      if (width && height) {
        canvas.width = width;
        canvas.height = height;
        context.drawImage(video, 0, 0, width, height);

        var dataURL = canvas.toDataURL('image/jpeg');
        console.log(dataURL);
        photo.setAttribute('src', dataURL);
        xhr = new XMLHttpRequest();
        xhr.open('POST', 'photo_upload.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status !== 200) {
                alert('Request failed.  Returned status of ' + xhr.status);
            }
        };
        xhr.send(encodeURI('photo=' + dataURL + '&user=Daniel'));

      } else {
        clearphoto();
      }
    }
    window.addEventListener('load', startup, false);
  })();
