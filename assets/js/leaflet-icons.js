var LeafIcon = L.Icon.extend({
    options: {
        shadowUrl: './assets/images/marker-shadow.png',
        iconSize: [25, 41],
        shadowSize: [41, 41],
        iconAnchor: [12, 41],
        shadowAnchor: [12, 41],
        popupAnchor: [0, -41],
        tooltipAnchor: [25, -25],
    }
})

var 
    iconCoffeeShop      = new LeafIcon({iconUrl: './assets/images/coffee-shop.png'});