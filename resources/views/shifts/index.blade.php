@if ($activeShift)
<script>
function sendLocation() {
    if (!navigator.geolocation) return;

    navigator.geolocation.getCurrentPosition(function (position) {
        fetch('{{ route("location.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                latitude: position.coords.latitude,
                longitude: position.coords.longitude,
            }),
        });
    }, function (error) {
        console.log('Location error:', error);
    });
}

// Send immediately, then every 15 seconds
sendLocation();
setInterval(sendLocation, 15000);
</script>
@endif