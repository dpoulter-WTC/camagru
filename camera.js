(function() {
  var width = 800;
  var height = 600;
  var streaming = false;
  var video = null;
  var canvas = null;
  var photo = null;
  var startbutton = null;
  var cont = null;

  function startup() {
    video = document.getElementById('video');
    canvas = document.getElementById('canvas');
    var ctx = canvas.getContext('2d');
    photo = document.getElementById('photo');
    startbutton = document.getElementById('startbutton');
    cont = document.getElementById('continue');
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
          navigator.mediaDevices.getUserMedia({
            video: true
          })
          .then(function(stream) {
            video.srcObject = stream;
          })
          .catch(function(error) {
            console.log('error', error);
          });
          video.play();
        },
        function(err) {
          console.log("An error occured! " + err);
        }
      );
      video.addEventListener('canplay', function(ev){
        if (!streaming) {
          height = width*3/4;
          //height = video.videoHeight / (video.videoWidth/width);
          if (isNaN(height)) {
            height = width*3/4;
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

      cont.addEventListener('click', function(ev){
        move_on();
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

    function move_on() {
      window.location.href='photo_edit.php';
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
        xhr.send(encodeURI('photo=' + dataURL));

      } else {
        clearphoto();
      }
    }
    window.addEventListener('load', startup, false);
  })();
