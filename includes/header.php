
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Complaint Management System</title>

  <!-- Bootstrap CSS -->
  <link href="./bootstrap-5.3.2-dist/bootstrap-5.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
  <style>
    body.light-theme {
      background-color: #ffffff;
      color: #000000;
    }

    body.dark-theme {
      background-color: #343a40;
      color: #f8f9fa;
    }

    .navbar.light-theme {
      background-color: #f8f9fa;
    }

    .navbar.dark-theme {
      background-color: #343a40;
    }

    .form-control {
      max-width: 400px;
    }

    #sidebar {
      background-color: #f8f9fa;
      min-height: 100vh;
      padding-top: 20px;
      padding-left: 10px;
    }

    #sidebar .nav-link {
      color: #333;
      padding: 15px;
      text-decoration: none;
      display: block;
    }

    #sidebar .nav-link.active {
      background-color: #1abc9c;
      color: white;
    }

    #sidebar .nav-link:hover {
      background-color: #1abc9c;
      color: white;
    }

    .content {
      margin-left: 240px;
      padding: 20px;
    }

    .navbar-custom {
      background-color: #1abc9c;
    }

    .navbar-custom .navbar-brand, 
    .navbar-custom .navbar-text, 
    .navbar-custom .navbar-nav .nav-link {
      color: white;
    }

    .greeting {
      text-align: center;
      margin-top: 100px;
    }

    .greeting img {
      max-width: 300px;
      margin-bottom: 20px;
    }

  </style>
</head>
<body class="light-theme">
  <div class="content">
    <nav class="navbar navbar-expand-lg navbar-custom">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Online Complaint Management System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <form class="d-flex w-50 mx-auto">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
          </form>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="themeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-moon"></i> Theme
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="themeDropdown">
                <li><a class="dropdown-item" href="#" onclick="setTheme('light')">Light</a></li>
                <li><a class="dropdown-item" href="#" onclick="setTheme('dark')">Dark</a></li>
                <li><a class="dropdown-item" href="#" onclick="setTheme('system')">System</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="bi bi-bell"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="bi bi-person-circle"></i> AA</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <script>
    function setTheme(theme) {
      const body = document.body;
      const navbar = document.querySelector('.navbar');
      body.classList.remove('light-theme', 'dark-theme');
      navbar.classList.remove('light-theme', 'dark-theme');
      if (theme === 'light') {
        body.classList.add('light-theme');
        navbar.classList.add('light-theme');
      } else if (theme === 'dark') {
        body.classList.add('dark-theme');
        navbar.classList.add('dark-theme');
      } else if (theme === 'system') {
        const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)").matches;
        if (prefersDarkScheme) {
          body.classList.add('dark-theme');
          navbar.classList.add('dark-theme');
        } else {
          body.classList.add('light-theme');
          navbar.classList.add('light-theme');
        }
      }
    }
  </script>

<script src="./bootstrap-5.3.2-dist/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
</body>
</html>
