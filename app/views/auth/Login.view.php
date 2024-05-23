<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/bootstrap.css">
    <title>Login</title>
</head>
<body>
    <div class="d-flex justify-content-center text-bg-primary min-vh-100">
    <div class="card text-bg-dark col align-self-center" style="max-width: 450px;">
        <div class="card-body">
            <h3 class="card-title mt-3 mb-4">Welcome Back!</h3>
            <form action="./login" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <button type="submit" class="btn btn-primary mt-3 mb-3 w-25">Login</button>
            </form>
            <a href="./register" style="">Don't Have an account</a>
        </div>
    </div>
    </div>
</body>
</html>