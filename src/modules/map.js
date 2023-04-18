import L from 'leaflet'


class Map {
    constructor() {

        this.mapContainer = document.querySelector('#map')
        this.initMap()
    }



    initMap = () => {

        if (this.mapContainer) {

            const geoSplit = this.mapContainer.dataset.geo.replace(' ', '').split(',')
            if (geoSplit.length == 2) {
                let config = {
                    minZoom: 14,
                    maxZoom: 18,
                };
                const zoom = 16;
                const lat = geoSplit[0];
                const lng = geoSplit[1];
                const map = L.map("map", config).setView([lat, lng], zoom);

                L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
                    attribution:
                        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                }).addTo(map);


                var rmIcon = L.icon({
                    iconUrl: rmData.theme_url + '/src/images/RMProperties-Logo-Map.png',
                    shadowUrl: rmData.theme_url + '/src/images/RMProperties-Logo-Map-shadow.png',
                    iconSize: [150, 150], // size of the icon
                    shadowSize: [150, 150], // size of the shadow
                    iconAnchor: [75, 150], // point of the icon which will correspond to marker's location
                    shadowAnchor: [60, 150],  // the same for the shadow
                    popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
                });

                L.marker([lat, lng], { icon: rmIcon }).addTo(map);


            }
        }
    }
}


export default Map