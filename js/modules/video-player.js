export function videoPlayer() {
// Video Player
  const videoPlayer = document.querySelector('#player-container video');

  // ===========================================
  // PLYR VIDEO PLAYER
  // ===========================================

  function initVideoPlayer() {
    if (videoPlayer && typeof Plyr !== 'undefined') {
      const player = new Plyr(videoPlayer, {
        controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'fullscreen']
      });
    }
  }
  
  // ===========================================
  // EVENT LISTENERS
  // ===========================================
  // Video Player
  initVideoPlayer();
}