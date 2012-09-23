jQuery.noConflict();

jQuery.fn.quickEach = (function() {
   var jq = jQuery([1]);
   return function(c) {
    var i = -1,
        el, len = this.length;
    try {
     while (++i < len && (el = jq[0] = this[i]) && c.call(jq, i, el) !== false);
    } catch (e) {
     delete jq[0];
     throw e;
    }
    delete jq[0];
    return this;
   };
}());

(function($){
    
    $(window).load(function(){
        equalHeights();
    });
    
    $(window).smartresize(function(){
        equalHeights();
    });
    
    $('#tabs').tabs();
    
    $('.thumb').fancybox({
        'overlayColor': '#000',
        'transitionIn': 'elastic',
        'transitionOut': 'elastic'
    });
    
    $('.show-share-button').on('click', function(){
        $(this).hide();
        $('.share-buttons').fadeIn('fast');
    });
    
    
    /*  Search Form
    *************************************************************************/
    $('#s').focus(function(){
        var t = $(this);
        if( t.val() == t.attr('title') )
            t.val('');
    }).blur(function(){
        var t = $(this);
        if( t.val() === '' )
            t.val(t.attr('title'));
    });

    /*  Header Menus
    *************************************************************************/
    var hoverConfig = {
         over: function(){
                $('ul', $(this)).fadeIn('fast');
            },
         timeout: 150,
         out: function(){
            $('ul', $(this)).fadeOut('fast');
            }
    };

    $('.primary-nav ul > li').hoverIntent(hoverConfig);
    
    /*  AudioPlayer
    *************************************************************************/
    
    // Set title and playing/pause class
    $('.jp-jplayer').quickEach(function(){
       this.bind($.jPlayer.event.loadedmetadata, function(event) {
            // This doesn't work in all browsers, but that's ok.
            setTrackTitle(event.jPlayer.status.media, this);
        }).bind($.jPlayer.event.play, function(event) {
           
            $('.jp-playlist ul', $(this).next()).removeClass('paused').addClass('playing');
            setTrackTitle(event.jPlayer.status.media, this);
            
        }).bind($.jPlayer.event.pause, function(event) {
            $('.jp-playlist ul', $(this).next()).removeClass('playing').addClass('paused');
            setTrackTitle(event.jPlayer.status.media, this);
        });
    });
    
    // Pause player when current song in playlist is clicked
    $('a.jp-playlist-current').on('click', function(e){
       console.log('try');
       var player = $(this).closest(".jp-jplayer");
       console.log(player);
       player.jPlayer("pause");
    });
    
    // Toggle playlist
    $('.sidebar .jp-playlist, .home .jp-playlist').hide();
    
    $('.toggle-playlist').on('click', function(e){
        $(this).siblings('.jp-playlist').slideToggle();
        e.preventDefault();
    });
    
    /**
     * Move pause button
     * (total freaking hack)
     **/
    function movePause( currentSong ){
        var $pause = $('.jp-controls');
        $pause.css('top', currentSong.position().top);
    }

    $('#tracklist-tab .jp-jplayer').bind($.jPlayer.event.play, function(event) {
        movePause( $('#tracklist-tab .jp-playlist-current') );
        console.log(event);
    }).bind($.jPlayer.event.ended, function(event) {
        movePause( $('#tracklist-tab .jp-playlist-current').next('li') );
        console.log(event);
    });

    //  Sets the current track title
    function setTrackTitle(track_info, myself){
        
        var title = track_info.title;
        var artist = track_info.artist;
        //var trackNum = track_info.track_num;
        
        if(artist && artist !== ''){
           title = title + ' by ' + artist;
        }
        
        $('p.song-title', $(myself).next()).html(title);
    }
    
    function equalHeights(){
        // We would do min-height, but Firefox has a bug that doesn't play nice with box-sizing: border-box
        
        // Sidebar
        var sidebar_height = $('.sidebar').height(),
            $page = $('section.page'),
            page_height = $page.height();
        
        if( $page.length > 0 && page_height < sidebar_height ){
            $page.css('minHeight', sidebar_height);
        } else {
            $page.css('minHeight', 'auto');
        }
        
        // Blog posts
        $('.blog article.post').quickEach(function(){
            var $postmeta = $('.postmeta', this),
                meta_height = parseInt($postmeta.height()) + parseInt($postmeta.css('marginTop')),
                entry_height = $('.entry', this).height();
            
            if( meta_height > entry_height ){
                $('.entry').css('height', meta_height);
            } else {
                $('.entry').css('height', 'auto');
            }
        });
    }
    
})(jQuery);