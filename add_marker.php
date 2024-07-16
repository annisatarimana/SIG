<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

$_SESSION['alert'] = [
    'type' => 'info',
    'title' => 'Tambah Marker',
    'text' => 'Klik satu titik di peta untuk menambahkan marker baru'
]

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIG</title>

    <link rel="stylesheet" href="./assets/lib/leaflet/leaflet.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <span class="navbar-brand">Kendari Spot Coffee</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Tampilan Utama</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu lain
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="edit_marker.php">Kelola Markers</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./data/scripts/auth/logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card m-5">
                    <div class="card-body">
                        <form action="./data/scripts/leaflet/save_marker.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <div class="form-text">Klik pada peta untuk menambahkan Latidude dan Longitude secara otomatis</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputLat" class="form-label">Latitude</label>
                                <input type="text" class="form-control form-control-sm" id="inputLat" value="" name="lat">
                            </div>
                            <div class="mb-3">
                                <label for="inputLng" class="form-label">Longitude</label>
                                <input type="text" class="form-control form-control-sm" id="inputLng" value="" name="lng">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control form-control-sm" id="name" value="" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <input type="text" class="form-control form-control-sm" id="description" value="" name="description">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div id="map" style="height: 90vh;"></div>
            </div>
        </div>
    </div>

    <script src="./assets/lib/leaflet/leaflet.js"></script>
    <script src="./assets/js/init-leaflet.js"></script>
    <script src="./assets/js/leaflet-icons.js"></script>
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
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            })
            <?php unset($_SESSION['alert']); ?>
        }

        var previousMarker;
        map.on('click', (e) => {

            if (previousMarker !== undefined) {
                previousMarker.remove()
            }

            var latlng = e.latlng;
            const inputLat = document.getElementById('inputLat');
            const inputLng = document.getElementById('inputLng');

            inputLat.value = latlng.lat;
            inputLng.value = latlng.lng;

            var marker = L.marker(latlng, {
                    draggable: true,
                    autoPan: true,
                })
                .on('moveend', (e) => {
                    var latlng = e.target.getLatLng();
                    inputLat.value = latlng.lat;
                    inputLng.value = latlng.lng;

                    map.panTo(latlng, map.getZoom(), {
                        animate: true,
                    });
                })
                .addTo(map);
                marker.setIcon(iconCoffeeShop)
            previousMarker = marker;

            map.panTo(latlng, map.getZoom(), {
                animate: true,
            });
        })
    </script>

</body>

</html>