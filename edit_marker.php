<?php
session_start();
require_once 'config.php';

require $CONFIG["PATH"]["APP"] . "data/scripts/leaflet/get_marker.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: " . $CONFIG["PATH"]["VIEWS"]["LOGIN"]);
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
                        <a class="nav-link" href="dashboard.php">Tampilan Utama</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu lain
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="add_marker.php">Tambah marker</a></li>
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
                        <form id="inputForm" action="./data/scripts/leaflet/update_marker.php" method="POST">
                            <fieldset id="formFieldSet">
                                <input type="hidden" id="inputMarkerId" value="" name="marker_id">
                                <div class="mb-3">
                                    <div id="formText" class="form-text">Klik pada marker untuk mulai mengubah informasi marker</div>
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
                                    <input type="text" class="form-control form-control-sm" id="inputName" value="" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <input type="text" class="form-control form-control-sm" id="inputDesc" value="" name="description">
                                </div>
                                <button type="submit" name="action" value="update" id="submitBtn" class="btn btn-primary">Ubah</button>
                                <button type="submit" name="action" value="delete" id="deleteBtn" class="btn btn-danger">Hapus</button>
                                <button type="button" id="resetBtn" class="btn btn-light" onclick="resetForm(populateMarker)">Reset</button>
                            </fieldset>
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
        
        var markersLatLng = [];
        var markers = [];
        
        var markersGroup = L.layerGroup().addTo(map);
        
        const formText = document.getElementById('formText');
        const formFieldSet = document.getElementById("formFieldSet")
        const inputForm = document.getElementById('inputForm');
        const inputMarkerId = document.getElementById('inputMarkerId');
        const inputLat = document.getElementById('inputLat');
        const inputLng = document.getElementById('inputLng');
        const inputName = document.getElementById('inputName');
        const inputDesc = document.getElementById('inputDesc');
        const submitBtn = document.getElementById('submitBtn');
        const deleteBtn = document.getElementById('deleteBtn');
        
        var onEditMarker = false;
        var selectedMarker;
        
        disableInputForm();
        
        if (json.markers !== undefined) {
            var data = json.markers.data;
            populateMarker();
        }
        
        function populateMarker() {
            markersGroup.clearLayers()
            data.forEach(data => {
                var marker = L.marker([data.lat, data.lng])
                .on('click', (e) => {
                    markersGroup.clearLayers()
                    
                    const id = data.id;
                    const lat = (e.latlng.lat !== data.lat ? e.latlng.lat : data.lat);
                    const lng = (e.latlng.lng !== data.lng ? e.latlng.lng : data.lng);
                    const name = data.name;
                    const desc = data.description;
                    
                    inputMarkerId.value = id;
                    inputLat.value = lat;
                    inputLng.value = lng;
                    inputName.value = name;
                    inputDesc.value = desc;
                    
                    map.flyTo([lat, lng], map.getZoom() > 15 ? map.getZoom() : 15, {
                        animate: true,
                        duration: 3.0
                    })
                    
                    var marker = L.marker([lat, lng], {
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
                    });
                    marker.setIcon(iconCoffeeShop)
                    markersGroup.addLayer(marker);
                    selectedMarker = marker;
                    formText.innerText = "Klik atau drag marker untuk memperbarui posisi Latitude dan Longitude"
                    dispatchMarkedIdEvent();
                    
                })
                
                markersLatLng.push([data.lat, data.lng]);
                marker.setIcon(iconCoffeeShop)
                markersGroup.addLayer(marker)
                
            });
            map.fitBounds(markersLatLng, {
                maxZoom: 13
            })
        }
        
        function dispatchMarkedIdEvent() {
            const event = new CustomEvent('valueChangeMarkerId');
            inputMarkerId.dispatchEvent(event);
            onEditMarker = true;
        }
        
        function resetForm(populateMarker) {
            formText.innerText = "Klik pada marker untuk mulai mengubah informasi marker";
            inputMarkerId.value = "";
            inputLat.value = "";
            inputLng.value = "";
            inputName.value = "";
            inputDesc.value = "";

            disableInputForm();

            populateMarker();
        }

        function disableInputForm(b = true) {
            if (!b) {
                formFieldSet.removeAttribute('disabled');
                return;
            }
            formFieldSet.setAttribute('disabled', b);
        }

        inputMarkerId.addEventListener('valueChangeMarkerId', (e) => {
            var toggleButtonInput = e.target.value !== "";
            if (toggleButtonInput) {
                disableInputForm(false);
            }
        })

        map.on('click', (e) => {
            if (onEditMarker && selectedMarker !== undefined) {
                inputLat.value = e.latlng.lat;
                inputLng.value = e.latlng.lng;
                selectedMarker.setLatLng(e.latlng);

                map.panTo(e.latlng, map.getZoom(), {
                    animate: true,
                });
            }
        })
    </script>

</body>

</html>