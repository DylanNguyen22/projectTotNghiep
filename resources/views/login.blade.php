<!DOCTYPE html>
<html>

<head>
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 400px;
            padding: 20px;
        }

        .card-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-login {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="card">
        <h3 class="card-title">Đăng nhập</h3>
        <form action="" method="POST">
            @if (isset($msg))
                <div class="alert alert-danger" role="alert">
                    Tài khoản hoặc mật khẩu không chính xác!
                </div>
            @endif
            <div class="form-group">
                <label for="email">Tên đăng nhập</label>
                <input type="text" maxlength="20" class="form-control" name="username" @if (isset($username)) value="{{ $username }}" @endif required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-login">Đăng nhập</button>
            @csrf
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
