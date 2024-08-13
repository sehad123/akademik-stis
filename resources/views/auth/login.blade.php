<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIPADU | Log in</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    
    <div class="card-body">
      <div id="alert-container"></div>
      <form id="login-form" action="{{ url('login') }}" method="post">
        <div class="card-header text-center">
          <a href="#" class="h1"><b>SIPADU</b></a>
        </div>
        {{ csrf_field() }}
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" required placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" required placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">Remember Me</label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="card card-outline card-primary mt-3" id="face-verification-card" style="display: none;">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Face Verification</b></a>
    </div>
    <div class="card-body">
      <video id="video" width="320" height="240" autoplay></video>
    </div>
  </div>
</div>

<script>
  const video = document.getElementById('video');

  navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
      video.srcObject = stream;
    })
    .catch(err => {
      console.error('Error accessing the camera: ', err);
    });

  function showAlert(message) {
    const alertContainer = document.getElementById('alert-container');
    alertContainer.innerHTML = `<div class="alert alert-danger">${message}</div>`;
  }

  function captureAndVerifyFace(userId) {
    const canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
    const dataURL = canvas.toDataURL('image/png');

    fetch('{{ url('verify-face') }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({
        image: dataURL,
        user_id: userId
      })
    })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        window.location.href = data.redirect_url;
      } else {
        showAlert(data.message);
        setTimeout(() => {
          captureAndVerifyFace(userId); // Capture and verify face again
        }, 2000); // Delay before retrying
      }
    })
    .catch(error => console.error('Error:', error));
  }

  document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    fetch('{{ url('login') }}', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        document.getElementById('login-form').style.display = 'none';
        document.getElementById('face-verification-card').style.display = 'block';
        captureAndVerifyFace(data.user_id); // Start capturing and verifying face
      } else {
        showAlert(data.message);
      }
    })
    .catch(error => console.error('Error:', error));
  });
</script>

<script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
