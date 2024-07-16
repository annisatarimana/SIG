<?php
session_start();
require_once 'config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: " . $CONFIG["PATH"]["VIEWS"]["DASHBOARD"]);
    $_SESSION['alert'] = [
        'type' => 'info',
        'title' => 'Anda perlu Logout untuk mengakses halaman ini'
    ];
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIG</title>

    <link rel="stylesheet" href="./assets/lib/leaflet/leaflet.css">
    <link rel="stylesheet" href="./assets/css//my.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <div class="bg-image" style="background-image: url(./assets/images/background.png); height: 100vh;">
    <div class="mask" style="background-color: rgba(255, 255, 255, 0.9);">
        <div class="container">
            <div class="d-flex flex-column justify-content-center w-50 vh-100 align-items-center mx-auto">
                <div class="row">
                    <div class="col">
                        <h4>Kendari Spot Coffee</h4>
                    </div>
                </div>
                <form class="row g-3" method="POST" action="./data/scripts/auth/login.php">
                    <div class="col-12">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" autocomplete="off" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" autocomplete="off" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <div class="col-md-6 d-flex flex-row justify-content-end">
                        <a href="register.php">Belum punya akun, daftar disini</a>
                    </div>
                    <input type="hidden" name="action" value="login">
                </form>
            </div>
        </div>
    </div>
    </div>


    <script src="./assets/lib/leaflet/leaflet.js"></script>
    <script>
        var json = <?= json_encode($_SESSION); ?>;
        console.log(json);

        if (json.alert !== undefined) {
            Swal.fire({
                title: json.alert.title,
                icon: json.alert.type,
                text: json.alert.text,
                toast: true,
                showConfirmButton: false,
                position: "top-end",
                timer: 3000,
            })
            <?php unset($_SESSION['alert']); ?>
        }
    </script>

</body>

</html>