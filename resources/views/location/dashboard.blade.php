<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Live Worker Map
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <div class="py-6 max-w-5xl mx-auto px-4">
        <div id="map" style="height: 500px;" class="rounded-lg shadow"></div>
        <div id="worker-list" class="mt-4 bg-white shadow rounded-lg p-4"></div>
    </div>

    <script>
        const map = L.map('map').setView([50.1109, 8.6821], 13); // Frankfurt center
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let markers = {};

        function refreshMap() {
            fetch('{{ route("location.data") }}')
                .then(res => res.json())
                .then(workers => {
                    const listEl = document.getElementById('worker-list');
                    listEl.innerHTML = '<h3 class="font-semibold mb-2">Active workers (' + workers.length + ')</h3>';

                    // Remove markers for workers no longer active
                    const activeNames = workers.map(w => w.user_name);
                    Object.keys(markers).forEach(name => {
                        if (!activeNames.includes(name)) {
                            map.removeLayer(markers[name]);
                            delete markers[name];
                        }
                    });

                    workers.forEach(w => {
                        const latlng = [w.latitude, w.longitude];

                        if (markers[w.user_name]) {
                            markers[w.user_name].setLatLng(latlng);
                        } else {
                            markers[w.user_name] = L.marker(latlng).addTo(map);
                        }
                        markers[w.user_name].bindPopup(
                            `<b>${w.user_name}</b><br>On shift since ${w.shift_started}<br>Last seen: ${w.last_seen}`
                        );

                        listEl.innerHTML += `<div class="py-1">🟢 ${w.user_name} — since ${w.shift_started}, last seen ${w.last_seen}</div>`;
                    });
                });
        }

        refreshMap();
        setInterval(refreshMap, 15000);
    </script>
</x-app-layout>