jQuery.noConflict();jQuery.fn.quickEach=function(){var e=jQuery([1]);return function(t){var n=-1,r,i=this.length;try{while(++n<i&&(r=e[0]=this[n])&&t.call(e,n,r)!==!1);}catch(s){delete e[0];throw s}delete e[0];return this}}();(function(e){function n(t){var n=e(".jp-controls");n.css("top",t.position().top)}function r(t,n){var r=t.title,i=t.artist;i&&i!==""&&(r=r+" by "+i);e("p.song-title",e(n).next()).html(r)}function i(){var t=e(".sidebar").height(),n=e("section.page"),r=n.height();n.length>0&&r<t?n.css("minHeight",t):n.css("minHeight","auto");e(".blog article.post").quickEach(function(){var t=e(".postmeta",this),n=parseInt(t.height())+parseInt(t.css("marginTop")),r=e(".entry",this).height();n>r?e(".entry").css("minHeight",n):e(".entry").css("minHeight","auto")})}e(window).load(function(){i()});e(window).smartresize(function(){i()});e("#tabs").tabs();e(".video-flex").fitVids();e(".thumb").colorbox({maxWidth:"90%",maxHeight:"90%"});e(".show-share-button").on("click",function(){e(this).hide();e(".share-buttons").fadeIn("fast")});e("#s").focus(function(){var t=e(this);t.val()==t.attr("title")&&t.val("")}).blur(function(){var t=e(this);t.val()===""&&t.val(t.attr("title"))});var t={over:function(){e("ul",e(this)).fadeIn("fast")},timeout:150,out:function(){e("ul",e(this)).fadeOut("fast")}};e(".primary-nav ul > li").hoverIntent(t);e(".jp-jplayer").quickEach(function(){this.bind(e.jPlayer.event.loadedmetadata,function(e){r(e.jPlayer.status.media,this)}).bind(e.jPlayer.event.play,function(t){e(".jp-playlist ul",e(this).next()).removeClass("paused").addClass("playing");r(t.jPlayer.status.media,this)}).bind(e.jPlayer.event.pause,function(t){e(".jp-playlist ul",e(this).next()).removeClass("playing").addClass("paused");r(t.jPlayer.status.media,this)})});e("a.jp-playlist-current").on("click",function(t){console.log("try");var n=e(this).closest(".jp-jplayer");console.log(n);n.jPlayer("pause")});e(".sidebar .jp-playlist, .home .jp-playlist").hide();e(".toggle-playlist").on("click",function(t){e(this).siblings(".jp-playlist").slideToggle();t.preventDefault()});e("#tracklist-tab .jp-jplayer").bind(e.jPlayer.event.play,function(t){n(e("#tracklist-tab .jp-playlist-current"));console.log(t)}).bind(e.jPlayer.event.ended,function(t){n(e("#tracklist-tab .jp-playlist-current").next("li"));console.log(t)})})(jQuery);