console.log("js is loaded");

// Variable declarations
const videoPlayer = document.querySelector('#player');

// Initialize video player
function initVideoPlayer() {
    if (videoPlayer && typeof Plyr !== 'undefined') {
        const player = new Plyr('#player', {
            controls: [
                'play-large',
                'play',
                'progress',
                'current-time',
                'mute',
                'volume',
                'fullscreen'
            ]
        });
        console.log('Video player initialized');
    }
}

initVideoPlayer();
