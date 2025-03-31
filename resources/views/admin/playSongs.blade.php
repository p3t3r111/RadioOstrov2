@extends('layouts.main')

@section('title')
Rádio ostrov
@endsection

@section('content')
    <div class="w-full h-full flex justify-center">
        <iframe 
            id="frame" 
            src="https://open.spotify.com/embed/playlist/2YgC0FpYjIED8J7e9AfTEC" 
            style="border-radius:12px; width:80%; height:80vh;" 
            frameborder="0" 
            allowfullscreen 
            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" 
            loading="lazy">
        </iframe>
    </div>
    {{-- @php
        $songIds = [];
        foreach ($items as $item) {
            array_push($songIds, $item['songId']);
        }
    @endphp

    <script src="https://sdk.scdn.co/spotify-player.js"></script>
    <script>
        let songIds = <?php echo json_encode($songIds) ?>;
        let currentSong = 0;

        window.onSpotifyWebPlaybackSDKReady = () => {
            const token = 'BQCXVDMjSJdhMdDoK5-nujOTU-SgQdLmmweBeNZ2Y7sZuEW84IDzpo0o1NQoSa1KQcTu6dMmHtCrBwtldmHzDKqaZZuMGxu3c19NVcj3Y0cNWxaga8d9dU2dXTutczXFgY5LbnBwdOHNPo-9WPsfVHtMotAbFYt0cUyJaPJTKBwJaWuOWyNZdfSk5Ty9eAt6-rtQH5CXvwAlh7Bi2JUk82Sc2adaa-NXPqZ0QPnM';
            const player = new Spotify.Player({
                name: 'Radio Ostrov',
                getOAuthToken: cb => { cb(token); },
                volume: .5
            });

            let deviceId = null;

            player.addListener('ready', ({ device_id }) => {
                console.log('Ready with Device ID', device_id);
                deviceId = device_id;
                let trackUri = 'https://open.spotify.com/track/'+songIds[currentSong];
                playTrackOnDevice(token, deviceId, trackUri);
            });

            player.connect();
            console.log("Hrajem");
            
        };

    function playTrackOnDevice(token, deviceId, trackUri) {
        console.log(trackUri);        
        fetch(`https://api.spotify.com/v1/me/player/play?device_id=${deviceId}`, {
            method: 'PUT',
            body: JSON.stringify({ uris: [trackUri] }),
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
        }).then(response => {
            if (response.ok) {
                console.log('Track is playing!');
            } else {
                console.error('Failed to play track:', response);
            }
        });
    }
    </script> --}}
@endsection