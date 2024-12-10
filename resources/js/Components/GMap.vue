<script setup>
import { ref, watchEffect } from 'vue';
const props = defineProps({
  lat: {
    type: Number,
    default: 14.0712288
  },
  lng: {
    type: Number,
    default: 122.9600479
  },
  show: {
    type: Boolean,
    default: true,
  },
  isView: {
    type: Boolean,
    default: true
  }
});

const emit = defineEmits(['update:show', 'newLocation']);
const position = ref({ lat: props.lat, lng: props.lng });
const address = ref(null);

const close = () => {
  emit('update:show', false);
  emit('newLocation', {
    lat: position.value.lat,
    lng: position.value.lng,
    address: address.value
  });
};


const mapContainer = ref(null);


watchEffect(async ()=>{
    if(props.show){
        const { Map } = await google.maps.importLibrary("maps");
        const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer();

        const geocoder = new google.maps.Geocoder();
        const infowindow = new google.maps.InfoWindow();


        const myLatlng = { lat: 14.0712288, lng: 122.9600479 };
        const map = new Map(mapContainer.value, {
            center: myLatlng,
            zoom: 14,
            mapId: "gis-mapping",
        });
        const marker = new AdvancedMarkerElement({
            position: myLatlng,
            map,
            title: "Click to zoom",
        });

        directionsRenderer.setMap(map);

        function calculateAndDisplayRoute(directionsService, directionsRenderer, destination) {
            directionsService
                .route({
                    origin: myLatlng,
                    destination: destination,
                    travelMode: google.maps.TravelMode.DRIVING,
                })
                .then((response) => {
                    directionsRenderer.setDirections(response);
                })
                .catch((e) => window.alert("Directions request failed due to " + status));
        }

        function geocodeLatLng(latlng, geocoder, map, infowindow) {
            geocoder
                .geocode({ location: latlng })
                .then((response) => {
                if (response.results[0]) {
                    const marker = new google.maps.Marker({
                        position: latlng,
                        map: map,
                    });
                    const formattedAddress = response.results[0].formatted_address;
                    address.value = formattedAddress;
                    infowindow.setContent(formattedAddress);
                    infowindow.open(map, marker);
                } else {
                    window.alert("No results found");
                }
                })
                .catch((e) => window.alert("Geocoder failed due to: " + e));
        }

        marker.addListener("click", () => {
            map.setCenter(marker.position);
        });

        let prevMarker = null;
        map.addListener("click", (e) => {
            if(prevMarker){
                prevMarker.map = null;
            }
            prevMarker = new google.maps.marker.AdvancedMarkerElement({
                position: e.latLng,
                map: map,
            });
            map.panTo(e.latLng);
            const { lat, lng } = e.latLng;

            position.value = { lat: lat(), lng: lng() };

            geocodeLatLng(e.latLng,geocoder, map, infowindow);
            calculateAndDisplayRoute(directionsService, directionsRenderer, e.latLng);
        });
    }
})
</script>

<template>
  <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl">
      <div class="flex justify-between items-center p-4 border-b">
        <h3 class="text-lg font-semibold">Map Location</h3>
        <button @click="close" class="text-gray-500 hover:text-gray-700">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
            </path>
          </svg>
        </button>
      </div>
      <div class="p-4 bg-gray-300 h-[80vh]">
        <div ref="mapContainer" class="h-full"></div>
      </div>
    </div>
  </div>
</template>
