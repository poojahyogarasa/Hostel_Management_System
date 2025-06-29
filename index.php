
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hostel Management System</title>
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
      overflow-x: hidden;
    }
    .slideshow-container {
      position: fixed;
      top: 0;
      left: 0;
      z-index: -1;
      width: 100%;
      height: 100%;
    }
    .slide {
      display: none;
      height: 100%;
      background-position: center;
      background-size: cover;
      position: absolute;
      width: 100%;
    }
    .overlay {
      background: rgba(255,255,255,0.9);
      padding: 50px;
      border-radius: 15px;
      text-align: center;
      max-width: 700px;
      margin: auto;
      margin-top: 10%;
      box-shadow: 0 8px 30px rgba(0,0,0,0.2);
    }
    h1 {
      color: #0d47a1;
      font-size: 36px;
    }
    p {
      font-size: 18px;
      margin-bottom: 20px;
      color: #333;
    }
    .btn-group a {
      padding: 12px 28px;
      margin: 10px;
      font-size: 18px;
      color: #fff;
      background: linear-gradient(to right, #1976d2, #1e88e5);
      border-radius: 30px;
      text-decoration: none;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      display: inline-block;
    }
    .btn-group a:hover {
      background: linear-gradient(to right, #1565c0, #1e88e5);
    }
  </style>
</head>
<body>
<div class="slideshow-container">
  <div class="slide" style="background-image: url('assets/slide1.jpg');"></div>
  <div class="slide" style="background-image: url('assets/slide2.jpg');"></div>
  <div class="slide" style="background-image: url('assets/slide3.jpg');"></div>
  <div class="slide" style="background-image: url('assets/slide4.jpg');"></div>
</div>

<div class="overlay">
  <h1>Welcome to Hostel Management System 🏠</h1>
  <p>Efficient • Organized • Modern Hostel Operations</p>
  <div class="btn-group">
    <a href="login_student.php">🎓 Student Login</a>
    <a href="admin_login.php">🛡️ Admin Login</a>
  </div>
</div>

<script>
  let slides = document.getElementsByClassName("slide");
  let index = 0;
  function showSlides() {
    for (let i = 0; i < slides.length; i++) slides[i].style.display = "none";
    index++;
    if (index > slides.length) index = 1;
    slides[index-1].style.display = "block";
    setTimeout(showSlides, 4000);
  }
  showSlides();
</script>
</body>
</html>
