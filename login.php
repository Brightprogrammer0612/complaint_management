<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="./bootstrap-5.3.2-dist/bootstrap-5.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-container h2 {
            margin-bottom: 30px;
            text-align: center;
        }
        .btn-primary {
            width: 100%;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 5px;
        }
        .mb-3 {
            margin-bottom: 20px;
        }
        .alert {
            display: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_GET['error']; ?>
            </div>
        <?php } ?>

        <form action="login_process.php" method="post" id="loginForm">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" onclick="showWaitMessage()">Login</button>
        </form>
    </div>

    <script>
        function showWaitMessage() {
            alert("Please wait while we log you in...");
        }
    </script>

<script src="./bootstrap-5.3.2-dist/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
</body>
</html>
