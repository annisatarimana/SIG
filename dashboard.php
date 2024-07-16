<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: " . $CONFIG["PATH"]["VIEWS"]["LOGIN"]);
    $_SESSION['alert'] = [
        'type' => 'error',
        'title' => 'Akses ke halaman tidak sah'
    ];
    exit;
} else {
    require $CONFIG["PATH"]["APP"] . "data/scripts/leaflet/get_marker.php";
}

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
                        <a class="nav-link" href="add_marker.php">Tambah Marker</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu lain
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="edit_marker.php">Kelola Markers</a></li>
                            <li><button class="dropdown-item" onclick="resetView()" data-bs-toggle="tooltip" data-bs-placement="right" title="Memfokuskan tampilan ke seluruh marker dalam peta">Tampilkan semua marker</button></li>
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
        <div id="map" style="height: 90vh;"></div>
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
                toast: true,
                showConfirmButton: false,
                position: "top-end",
                timer: 3000,
            })
            <?php unset($_SESSION['alert']); ?>
        }

        var markersLatLng = [];
        if (json.markers !== undefined) {
            var data = json.markers.data;
            data.forEach(data => {
                const name = (data.name === "" ? "Marker tanpa nama" : data.name);
                const description = (data.description === "" ? "" : data.description);

                const content = `
                <h6 class="mb-3">${name}</h6>
                <p class="mb-3">${description}</p>
                `;


                var marker = L.marker([data.lat, data.lng])
                    .on('click', (e) => {
                        map.flyTo(e.latlng, map.getZoom() > 13 ? map.getZoom() : 13, {
                            animate: true,
                            duration: 1
                        });
                    })
                    .bindPopup(content, {
                        autoPan: false
                    })
                    .addTo(map)

                    marker.setIcon(iconCoffeeShop)
                markersLatLng.push([data.lat, data.lng]);
            });
            resetView();
        }

        function resetView() {
            map.fitBounds(markersLatLng, {
                maxZoom: 13,
                animate: true,
                duration: 3.0
            });
        }

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

</body>

</html>