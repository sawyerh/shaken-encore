// ColorBox v1.3.20.1 - jQuery lightbox plugin
// (c) 2012 Jack Moore - jacklmoore.com
// License: http://www.opensource.org/licenses/mit-license.php
(function(e,t,n){function r(n,r,i){var s=t.createElement(n);return r&&(s.id=g+r),i&&(s.style.cssText=i),e(s)}function i(e){var t=B.length,n=(et+e)%t;return n<0?t+n:n}function s(e,t){return Math.round((/%/.test(e)?(t==="x"?u():a())/100:1)*parseInt(e,10))}function o(e){return J.photo||/\.(gif|png|jp(e|g|eg)|bmp|ico)((#|\?).*)?$/i.test(e)}function u(){return n.innerWidth||j.width()}function a(){return n.innerHeight||j.height()}function f(){var t,n=e.data(Z,m);n==null?(J=e.extend({},v),console&&console.log&&console.log("Error: cboxElement missing settings object")):J=e.extend({},n);for(t in J)e.isFunction(J[t])&&t.slice(0,2)!=="on"&&(J[t]=J[t].call(Z));J.rel=J.rel||Z.rel||"nofollow",J.href=J.href||e(Z).attr("href"),J.title=J.title||Z.title,typeof J.href=="string"&&(J.href=e.trim(J.href))}function l(t,n){e.event.trigger(t),n&&n.call(Z)}function c(){var e,t=g+"Slideshow_",n="click."+g,r,i,s;J.slideshow&&B[1]?(r=function(){z.text(J.slideshowStop).unbind(n).bind(E,function(){if(J.loop||B[et+1])e=setTimeout(ot.next,J.slideshowSpeed)}).bind(w,function(){clearTimeout(e)}).one(n+" "+S,i),A.removeClass(t+"off").addClass(t+"on"),e=setTimeout(ot.next,J.slideshowSpeed)},i=function(){clearTimeout(e),z.text(J.slideshowStart).unbind([E,w,S,n].join(" ")).one(n,function(){ot.next(),r()}),A.removeClass(t+"on").addClass(t+"off")},J.slideshowAuto?r():i()):A.removeClass(t+"off "+t+"on")}function h(t){it||(Z=t,f(),B=e(Z),et=0,J.rel!=="nofollow"&&(B=e("."+y).filter(function(){var t=e.data(this,m),n;return t&&(n=t.rel||this.rel),n===J.rel}),et=B.index(Z),et===-1&&(B=B.add(Z),et=B.length-1)),nt||(nt=rt=!0,A.show(),J.returnFocus&&e(Z).blur().one(x,function(){e(this).focus()}),L.css({opacity:+J.opacity,cursor:J.overlayClose?"pointer":"auto"}).show(),J.w=s(J.initialWidth,"x"),J.h=s(J.initialHeight,"y"),ot.position(),C&&j.bind("resize."+k+" scroll."+k,function(){L.css({width:u(),height:a(),top:j.scrollTop(),left:j.scrollLeft()})}).trigger("resize."+k),l(b,J.onOpen),$.add(R).hide(),V.html(J.close).show()),ot.load(!0))}function p(){!A&&t.body&&(at=!1,j=e(n),A=r(ut).attr({id:m,"class":N?g+(C?"IE6":"IE"):""}).hide(),L=r(ut,"Overlay",C?"position:absolute":"").hide(),q=r(ut,"LoadingOverlay").add(r(ut,"LoadingGraphic")),O=r(ut,"Wrapper"),M=r(ut,"Content").append(F=r(ut,"LoadedContent","width:0; height:0; overflow:hidden"),R=r(ut,"Title"),U=r(ut,"Current"),W=r(ut,"Next"),X=r(ut,"Previous"),z=r(ut,"Slideshow").bind(b,c),V=r(ut,"Close")),O.append(r(ut).append(r(ut,"TopLeft"),_=r(ut,"TopCenter"),r(ut,"TopRight")),r(ut,!1,"clear:left").append(D=r(ut,"MiddleLeft"),M,P=r(ut,"MiddleRight")),r(ut,!1,"clear:left").append(r(ut,"BottomLeft"),H=r(ut,"BottomCenter"),r(ut,"BottomRight"))).find("div div").css({"float":"left"}),I=r(ut,!1,"position:absolute; width:9999px; visibility:hidden; display:none"),$=W.add(X).add(U).add(z),e(t.body).append(L,A.append(O,I)))}function d(){return A?(at||(at=!0,K=_.height()+H.height()+M.outerHeight(!0)-M.height(),Q=D.width()+P.width()+M.outerWidth(!0)-M.width(),G=F.outerHeight(!0),Y=F.outerWidth(!0),A.css({"padding-bottom":K,"padding-right":Q}),W.click(function(){ot.next()}),X.click(function(){ot.prev()}),V.click(function(){ot.close()}),L.click(function(){J.overlayClose&&ot.close()}),e(t).bind("keydown."+g,function(e){var t=e.keyCode;nt&&J.escKey&&t===27&&(e.preventDefault(),ot.close()),nt&&J.arrowKey&&B[1]&&(t===37?(e.preventDefault(),X.click()):t===39&&(e.preventDefault(),W.click()))}),e("."+y,t).live("click",function(e){e.which>1||e.shiftKey||e.altKey||e.metaKey||(e.preventDefault(),h(this))})),!0):!1}var v={transition:"elastic",speed:300,width:!1,initialWidth:"600",innerWidth:!1,maxWidth:!1,height:!1,initialHeight:"450",innerHeight:!1,maxHeight:!1,scalePhotos:!0,scrolling:!0,inline:!1,html:!1,iframe:!1,fastIframe:!0,photo:!1,href:!1,title:!1,rel:!1,opacity:.9,preloading:!0,current:"image {current} of {total}",previous:"previous",next:"next",close:"close",xhrError:"This content failed to load.",imgError:"This image failed to load.",open:!1,returnFocus:!0,reposition:!0,loop:!0,slideshow:!1,slideshowAuto:!0,slideshowSpeed:2500,slideshowStart:"start slideshow",slideshowStop:"stop slideshow",onOpen:!1,onLoad:!1,onComplete:!1,onCleanup:!1,onClosed:!1,overlayClose:!0,escKey:!0,arrowKey:!0,top:!1,bottom:!1,left:!1,right:!1,fixed:!1,data:undefined},m="colorbox",g="cbox",y=g+"Element",b=g+"_open",w=g+"_load",E=g+"_complete",S=g+"_cleanup",x=g+"_closed",T=g+"_purge",N=!e.support.opacity&&!e.support.style,C=N&&!n.XMLHttpRequest,k=g+"_IE6",L,A,O,M,_,D,P,H,B,j,F,I,q,R,U,z,W,X,V,$,J,K,Q,G,Y,Z,et,tt,nt,rt,it,st,ot,ut="div",at;if(e.colorbox)return;e(p),ot=e.fn[m]=e[m]=function(t,n){var r=this;t=t||{},p();if(d()){if(!r[0]){if(r.selector)return r;r=e("<a/>"),t.open=!0}n&&(t.onComplete=n),r.each(function(){e.data(this,m,e.extend({},e.data(this,m)||v,t))}).addClass(y),(e.isFunction(t.open)&&t.open.call(r)||t.open)&&h(r[0])}return r},ot.position=function(e,t){function n(e){_[0].style.width=H[0].style.width=M[0].style.width=e.style.width,M[0].style.height=D[0].style.height=P[0].style.height=e.style.height}var r,i=0,o=0,f=A.offset(),l,c;j.unbind("resize."+g),A.css({top:-9e4,left:-9e4}),l=j.scrollTop(),c=j.scrollLeft(),J.fixed&&!C?(f.top-=l,f.left-=c,A.css({position:"fixed"})):(i=l,o=c,A.css({position:"absolute"})),J.right!==!1?o+=Math.max(u()-J.w-Y-Q-s(J.right,"x"),0):J.left!==!1?o+=s(J.left,"x"):o+=Math.round(Math.max(u()-J.w-Y-Q,0)/2),J.bottom!==!1?i+=Math.max(a()-J.h-G-K-s(J.bottom,"y"),0):J.top!==!1?i+=s(J.top,"y"):i+=Math.round(Math.max(a()-J.h-G-K,0)/2),A.css({top:f.top,left:f.left}),e=A.width()===J.w+Y&&A.height()===J.h+G?0:e||0,O[0].style.width=O[0].style.height="9999px",r={width:J.w+Y,height:J.h+G,top:i,left:o},e===0&&A.css(r),A.dequeue().animate(r,{duration:e,complete:function(){n(this),rt=!1,O[0].style.width=J.w+Y+Q+"px",O[0].style.height=J.h+G+K+"px",J.reposition&&setTimeout(function(){j.bind("resize."+g,ot.position)},1),t&&t()},step:function(){n(this)}})},ot.resize=function(e){nt&&(e=e||{},e.width&&(J.w=s(e.width,"x")-Y-Q),e.innerWidth&&(J.w=s(e.innerWidth,"x")),F.css({width:J.w}),e.height&&(J.h=s(e.height,"y")-G-K),e.innerHeight&&(J.h=s(e.innerHeight,"y")),!e.innerHeight&&!e.height&&(F.css({height:"auto"}),J.h=F.height()),F.css({height:J.h}),ot.position(J.transition==="none"?0:J.speed))},ot.prep=function(t){function n(){return J.w=J.w||F.width(),J.w=J.mw&&J.mw<J.w?J.mw:J.w,J.w}function s(){return J.h=J.h||F.height(),J.h=J.mh&&J.mh<J.h?J.mh:J.h,J.h}if(!nt)return;var u,a=J.transition==="none"?0:J.speed;F.remove(),F=r(ut,"LoadedContent").append(t),F.hide().appendTo(I.show()).css({width:n(),overflow:J.scrolling?"auto":"hidden"}).css({height:s()}).prependTo(M),I.hide(),e(tt).css({"float":"none"}),C&&e("select").not(A.find("select")).filter(function(){return this.style.visibility!=="hidden"}).css({visibility:"hidden"}).one(S,function(){this.style.visibility="inherit"}),u=function(){function t(){N&&A[0].style.removeAttribute("filter")}var n,s,u=B.length,f,c="frameBorder",h="allowTransparency",p,d,v,y;if(!nt)return;p=function(){clearTimeout(st),q.detach().hide(),l(E,J.onComplete)},N&&tt&&F.fadeIn(100),R.html(J.title).add(F).show();if(u>1){typeof J.current=="string"&&U.html(J.current.replace("{current}",et+1).replace("{total}",u)).show(),W[J.loop||et<u-1?"show":"hide"]().html(J.next),X[J.loop||et?"show":"hide"]().html(J.previous),J.slideshow&&z.show();if(J.preloading){n=[i(-1),i(1)];while(s=B[n.pop()])y=e.data(s,m),y&&y.href?(d=y.href,e.isFunction(d)&&(d=d.call(s))):d=s.href,o(d)&&(v=new Image,v.src=d)}}else $.hide();J.iframe?(f=r("iframe")[0],c in f&&(f[c]=0),h in f&&(f[h]="true"),f.name=g+ +(new Date),J.fastIframe?p():e(f).one("load",p),f.src=J.href,J.scrolling||(f.scrolling="no"),e(f).addClass(g+"Iframe").appendTo(F).one(T,function(){f.src="//about:blank"})):p(),J.transition==="fade"?A.fadeTo(a,1,t):t()},J.transition==="fade"?A.fadeTo(a,0,function(){ot.position(0,u)}):ot.position(a,u)},ot.load=function(t){var n,i,u=ot.prep;rt=!0,tt=!1,Z=B[et],t||f(),l(T),l(w,J.onLoad),J.h=J.height?s(J.height,"y")-G-K:J.innerHeight&&s(J.innerHeight,"y"),J.w=J.width?s(J.width,"x")-Y-Q:J.innerWidth&&s(J.innerWidth,"x"),J.mw=J.w,J.mh=J.h,J.maxWidth&&(J.mw=s(J.maxWidth,"x")-Y-Q,J.mw=J.w&&J.w<J.mw?J.w:J.mw),J.maxHeight&&(J.mh=s(J.maxHeight,"y")-G-K,J.mh=J.h&&J.h<J.mh?J.h:J.mh),n=J.href,st=setTimeout(function(){q.show().appendTo(M)},100),J.inline?(r(ut).hide().insertBefore(e(n)[0]).one(T,function(){e(this).replaceWith(F.children())}),u(e(n))):J.iframe?u(" "):J.html?u(J.html):o(n)?(e(tt=new Image).addClass(g+"Photo").error(function(){J.title=!1,u(r(ut,"Error").html(J.imgError))}).load(function(){var e;tt.onload=null,J.scalePhotos&&(i=function(){tt.height-=tt.height*e,tt.width-=tt.width*e},J.mw&&tt.width>J.mw&&(e=(tt.width-J.mw)/tt.width,i()),J.mh&&tt.height>J.mh&&(e=(tt.height-J.mh)/tt.height,i())),J.h&&(tt.style.marginTop=Math.max(J.h-tt.height,0)/2+"px"),B[1]&&(J.loop||B[et+1])&&(tt.style.cursor="pointer",tt.onclick=function(){ot.next()}),N&&(tt.style.msInterpolationMode="bicubic"),setTimeout(function(){u(tt)},1)}),setTimeout(function(){tt.src=n},1)):n&&I.load(n,J.data,function(t,n,i){u(n==="error"?r(ut,"Error").html(J.xhrError):e(this).contents())})},ot.next=function(){!rt&&B[1]&&(J.loop||B[et+1])&&(et=i(1),ot.load())},ot.prev=function(){!rt&&B[1]&&(J.loop||et)&&(et=i(-1),ot.load())},ot.close=function(){nt&&!it&&(it=!0,nt=!1,l(S,J.onCleanup),j.unbind("."+g+" ."+k),L.fadeTo(200,0),A.stop().fadeTo(300,0,function(){A.add(L).css({opacity:1,cursor:"auto"}).hide(),l(T),F.remove(),setTimeout(function(){it=!1,l(x,J.onClosed)},1)}))},ot.remove=function(){e([]).add(A).add(L).remove(),A=null,e("."+y).removeData(m).removeClass(y).die()},ot.element=function(){return e(Z)},ot.settings=v})(jQuery,document,this);(function(e){e.fn.fitVids=function(t){var n={customSelector:null},r=document.createElement("div"),i=document.getElementsByTagName("base")[0]||document.getElementsByTagName("script")[0];r.className="fit-vids-style";r.innerHTML="&shy;<style>               .fluid-width-video-wrapper {                 width: 100%;                              position: relative;                       padding: 0;                            }                                                                                   .fluid-width-video-wrapper iframe,        .fluid-width-video-wrapper object,        .fluid-width-video-wrapper embed {           position: absolute;                       top: 0;                                   left: 0;                                  width: 100%;                              height: 100%;                          }                                       </style>";i.parentNode.insertBefore(r,i);t&&e.extend(n,t);return this.each(function(){var t=["iframe[src*='player.vimeo.com']","iframe[src*='www.youtube.com']","iframe[src*='www.kickstarter.com']","object","embed"];n.customSelector&&t.push(n.customSelector);var r=e(this).find(t.join(","));r.each(function(){var t=e(this);if(this.tagName.toLowerCase()=="embed"&&t.parent("object").length||t.parent(".fluid-width-video-wrapper").length)return;var n=this.tagName.toLowerCase()=="object"||t.attr("height")?t.attr("height"):t.height(),r=t.attr("width")?t.attr("width"):t.width(),i=n/r;if(!t.attr("id")){var s="fitvid"+Math.floor(Math.random()*999999);t.attr("id",s)}t.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",i*100+"%");t.removeAttr("height").removeAttr("width")})})}})(jQuery);(function(e){e.fn.hoverIntent=function(t,n){var r={sensitivity:7,interval:100,timeout:0};r=e.extend(r,n?{over:t,out:n}:t);var i,s,o,u,a=function(e){i=e.pageX;s=e.pageY},f=function(t,n){n.hoverIntent_t=clearTimeout(n.hoverIntent_t);if(Math.abs(o-i)+Math.abs(u-s)<r.sensitivity){e(n).unbind("mousemove",a);n.hoverIntent_s=1;return r.over.apply(n,[t])}o=i;u=s;n.hoverIntent_t=setTimeout(function(){f(t,n)},r.interval)},l=function(e,t){t.hoverIntent_t=clearTimeout(t.hoverIntent_t);t.hoverIntent_s=0;return r.out.apply(t,[e])},c=function(t){var n=jQuery.extend({},t),i=this;i.hoverIntent_t&&(i.hoverIntent_t=clearTimeout(i.hoverIntent_t));if(t.type=="mouseenter"){o=n.pageX;u=n.pageY;e(i).bind("mousemove",a);i.hoverIntent_s!=1&&(i.hoverIntent_t=setTimeout(function(){f(n,i)},r.interval))}else{e(i).unbind("mousemove",a);i.hoverIntent_s==1&&(i.hoverIntent_t=setTimeout(function(){l(n,i)},r.timeout))}};return this.bind("mouseenter",c).bind("mouseleave",c)}})(jQuery);(function(e,t){var n=function(e,t,n){var r;return function(){function u(){n||e.apply(s,o);r=null}var s=this,o=arguments;r?clearTimeout(r):n&&e.apply(s,o);r=setTimeout(u,t||100)}};jQuery.fn[t]=function(e){return e?this.bind("resize",n(e)):this.trigger(t)}})(jQuery,"smartresize");(function(e,t){function n(t){return!e(t).parents().andSelf().filter(function(){return e.curCSS(this,"visibility")==="hidden"||e.expr.filters.hidden(this)}).length}function r(t,r){var i=t.nodeName.toLowerCase();if("area"===i){var s=t.parentNode,o=s.name,u;if(!t.href||!o||s.nodeName.toLowerCase()!=="map")return!1;u=e("img[usemap=#"+o+"]")[0];return!!u&&n(u)}return(/input|select|textarea|button|object/.test(i)?!t.disabled:"a"==i?t.href||r:r)&&n(t)}e.ui=e.ui||{};e.ui.version||(e.extend(e.ui,{version:"1.8.18",keyCode:{ALT:18,BACKSPACE:8,CAPS_LOCK:20,COMMA:188,COMMAND:91,COMMAND_LEFT:91,COMMAND_RIGHT:93,CONTROL:17,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,INSERT:45,LEFT:37,MENU:93,NUMPAD_ADD:107,NUMPAD_DECIMAL:110,NUMPAD_DIVIDE:111,NUMPAD_ENTER:108,NUMPAD_MULTIPLY:106,NUMPAD_SUBTRACT:109,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SHIFT:16,SPACE:32,TAB:9,UP:38,WINDOWS:91}}),e.fn.extend({propAttr:e.fn.prop||e.fn.attr,_focus:e.fn.focus,focus:function(t,n){return typeof t=="number"?this.each(function(){var r=this;setTimeout(function(){e(r).focus(),n&&n.call(r)},t)}):this._focus.apply(this,arguments)},scrollParent:function(){var t;e.browser.msie&&/(static|relative)/.test(this.css("position"))||/absolute/.test(this.css("position"))?t=this.parents().filter(function(){return/(relative|absolute|fixed)/.test(e.curCSS(this,"position",1))&&/(auto|scroll)/.test(e.curCSS(this,"overflow",1)+e.curCSS(this,"overflow-y",1)+e.curCSS(this,"overflow-x",1))}).eq(0):t=this.parents().filter(function(){return/(auto|scroll)/.test(e.curCSS(this,"overflow",1)+e.curCSS(this,"overflow-y",1)+e.curCSS(this,"overflow-x",1))}).eq(0);return/fixed/.test(this.css("position"))||!t.length?e(document):t},zIndex:function(n){if(n!==t)return this.css("zIndex",n);if(this.length){var r=e(this[0]),i,s;while(r.length&&r[0]!==document){i=r.css("position");if(i==="absolute"||i==="relative"||i==="fixed"){s=parseInt(r.css("zIndex"),10);if(!isNaN(s)&&s!==0)return s}r=r.parent()}}return 0},disableSelection:function(){return this.bind((e.support.selectstart?"selectstart":"mousedown")+".ui-disableSelection",function(e){e.preventDefault()})},enableSelection:function(){return this.unbind(".ui-disableSelection")}}),e.each(["Width","Height"],function(n,r){function i(t,n,r,i){e.each(s,function(){n-=parseFloat(e.curCSS(t,"padding"+this,!0))||0,r&&(n-=parseFloat(e.curCSS(t,"border"+this+"Width",!0))||0),i&&(n-=parseFloat(e.curCSS(t,"margin"+this,!0))||0)});return n}var s=r==="Width"?["Left","Right"]:["Top","Bottom"],o=r.toLowerCase(),u={innerWidth:e.fn.innerWidth,innerHeight:e.fn.innerHeight,outerWidth:e.fn.outerWidth,outerHeight:e.fn.outerHeight};e.fn["inner"+r]=function(n){return n===t?u["inner"+r].call(this):this.each(function(){e(this).css(o,i(this,n)+"px")})},e.fn["outer"+r]=function(t,n){return typeof t!="number"?u["outer"+r].call(this,t):this.each(function(){e(this).css(o,i(this,t,!0,n)+"px")})}}),e.extend(e.expr[":"],{data:function(t,n,r){return!!e.data(t,r[3])},focusable:function(t){return r(t,!isNaN(e.attr(t,"tabindex")))},tabbable:function(t){var n=e.attr(t,"tabindex"),i=isNaN(n);return(i||n>=0)&&r(t,!i)}}),e(function(){var t=document.body,n=t.appendChild(n=document.createElement("div"));n.offsetHeight,e.extend(n.style,{minHeight:"100px",height:"auto",padding:0,borderWidth:0}),e.support.minHeight=n.offsetHeight===100,e.support.selectstart="onselectstart"in n,t.removeChild(n).style.display="none"}),e.extend(e.ui,{plugin:{add:function(t,n,r){var i=e.ui[t].prototype;for(var s in r)i.plugins[s]=i.plugins[s]||[],i.plugins[s].push([n,r[s]])},call:function(e,t,n){var r=e.plugins[t];if(!!r&&!!e.element[0].parentNode)for(var i=0;i<r.length;i++)e.options[r[i][0]]&&r[i][1].apply(e.element,n)}},contains:function(e,t){return document.compareDocumentPosition?e.compareDocumentPosition(t)&16:e!==t&&e.contains(t)},hasScroll:function(t,n){if(e(t).css("overflow")==="hidden")return!1;var r=n&&n==="left"?"scrollLeft":"scrollTop",i=!1;if(t[r]>0)return!0;t[r]=1,i=t[r]>0,t[r]=0;return i},isOverAxis:function(e,t,n){return e>t&&e<t+n},isOver:function(t,n,r,i,s,o){return e.ui.isOverAxis(t,r,s)&&e.ui.isOverAxis(n,i,o)}}))})(jQuery);(function(e,t){if(e.cleanData){var n=e.cleanData;e.cleanData=function(t){for(var r=0,i;(i=t[r])!=null;r++)try{e(i).triggerHandler("remove")}catch(s){}n(t)}}else{var r=e.fn.remove;e.fn.remove=function(t,n){return this.each(function(){n||(!t||e.filter(t,[this]).length)&&e("*",this).add([this]).each(function(){try{e(this).triggerHandler("remove")}catch(t){}});return r.call(e(this),t,n)})}}e.widget=function(t,n,r){var i=t.split(".")[0],s;t=t.split(".")[1],s=i+"-"+t,r||(r=n,n=e.Widget),e.expr[":"][s]=function(n){return!!e.data(n,t)},e[i]=e[i]||{},e[i][t]=function(e,t){arguments.length&&this._createWidget(e,t)};var o=new n;o.options=e.extend(!0,{},o.options),e[i][t].prototype=e.extend(!0,o,{namespace:i,widgetName:t,widgetEventPrefix:e[i][t].prototype.widgetEventPrefix||t,widgetBaseClass:s},r),e.widget.bridge(t,e[i][t])},e.widget.bridge=function(n,r){e.fn[n]=function(i){var s=typeof i=="string",o=Array.prototype.slice.call(arguments,1),u=this;i=!s&&o.length?e.extend.apply(null,[!0,i].concat(o)):i;if(s&&i.charAt(0)==="_")return u;s?this.each(function(){var r=e.data(this,n),s=r&&e.isFunction(r[i])?r[i].apply(r,o):r;if(s!==r&&s!==t){u=s;return!1}}):this.each(function(){var t=e.data(this,n);t?t.option(i||{})._init():e.data(this,n,new r(i,this))});return u}},e.Widget=function(e,t){arguments.length&&this._createWidget(e,t)},e.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",options:{disabled:!1},_createWidget:function(t,n){e.data(n,this.widgetName,this),this.element=e(n),this.options=e.extend(!0,{},this.options,this._getCreateOptions(),t);var r=this;this.element.bind("remove."+this.widgetName,function(){r.destroy()}),this._create(),this._trigger("create"),this._init()},_getCreateOptions:function(){return e.metadata&&e.metadata.get(this.element[0])[this.widgetName]},_create:function(){},_init:function(){},destroy:function(){this.element.unbind("."+this.widgetName).removeData(this.widgetName),this.widget().unbind("."+this.widgetName).removeAttr("aria-disabled").removeClass(this.widgetBaseClass+"-disabled "+"ui-state-disabled")},widget:function(){return this.element},option:function(n,r){var i=n;if(arguments.length===0)return e.extend({},this.options);if(typeof n=="string"){if(r===t)return this.options[n];i={},i[n]=r}this._setOptions(i);return this},_setOptions:function(t){var n=this;e.each(t,function(e,t){n._setOption(e,t)});return this},_setOption:function(e,t){this.options[e]=t,e==="disabled"&&this.widget()[t?"addClass":"removeClass"](this.widgetBaseClass+"-disabled"+" "+"ui-state-disabled").attr("aria-disabled",t);return this},enable:function(){return this._setOption("disabled",!1)},disable:function(){return this._setOption("disabled",!0)},_trigger:function(t,n,r){var i,s,o=this.options[t];r=r||{},n=e.Event(n),n.type=(t===this.widgetEventPrefix?t:this.widgetEventPrefix+t).toLowerCase(),n.target=this.element[0],s=n.originalEvent;if(s)for(i in s)i in n||(n[i]=s[i]);this.element.trigger(n,r);return!(e.isFunction(o)&&o.call(this.element[0],n,r)===!1||n.isDefaultPrevented())}}})(jQuery);(function(e,n){function r(){return++o}function i(){return++s}var s=0,o=0;e.widget("ui.tabs",{options:{add:null,ajaxOptions:null,cache:!1,cookie:null,collapsible:!1,disable:null,disabled:[],enable:null,event:"click",fx:null,idPrefix:"ui-tabs-",load:null,panelTemplate:"<div></div>",remove:null,select:null,show:null,spinner:"<em>Loading&#8230;</em>",tabTemplate:"<li><a href='#{href}'><span>#{label}</span></a></li>"},_create:function(){this._tabify(!0)},_setOption:function(e,t){if(e=="selected"){if(this.options.collapsible&&t==this.options.selected)return;this.select(t)}else this.options[e]=t,this._tabify()},_tabId:function(e){return e.title&&e.title.replace(/\s/g,"_").replace(/[^\w\u00c0-\uFFFF-]/g,"")||this.options.idPrefix+i()},_sanitizeSelector:function(e){return e.replace(/:/g,"\\:")},_cookie:function(){var t=this.cookie||(this.cookie=this.options.cookie.name||"ui-tabs-"+r());return e.cookie.apply(null,[t].concat(e.makeArray(arguments)))},_ui:function(e,t){return{tab:e,panel:t,index:this.anchors.index(e)}},_cleanup:function(){this.lis.filter(".ui-state-processing").removeClass("ui-state-processing").find("span:data(label.tabs)").each(function(){var t=e(this);t.html(t.data("label.tabs")).removeData("label.tabs")})},_tabify:function(t){function r(t,n){t.css("display",""),!e.support.opacity&&n.opacity&&t[0].style.removeAttribute("filter")}var i=this,s=this.options,o=/^#.+/;this.list=this.element.find("ol,ul").eq(0),this.lis=e(" > li:has(a[href])",this.list),this.anchors=this.lis.map(function(){return e("a",this)[0]}),this.panels=e([]),this.anchors.each(function(t,n){var r=e(n).attr("href"),u=r.split("#")[0],f;u&&(u===location.toString().split("#")[0]||(f=e("base")[0])&&u===f.href)&&(r=n.hash,n.href=r);if(o.test(r))i.panels=i.panels.add(i.element.find(i._sanitizeSelector(r)));else if(r&&r!=="#"){e.data(n,"href.tabs",r),e.data(n,"load.tabs",r.replace(/#.*$/,""));var l=i._tabId(n);n.href="#"+l;var c=i.element.find("#"+l);c.length||(c=e(s.panelTemplate).attr("id",l).addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").insertAfter(i.panels[t-1]||i.list),c.data("destroy.tabs",!0)),i.panels=i.panels.add(c)}else s.disabled.push(t)}),t?(this.element.addClass("ui-tabs ui-widget ui-widget-content ui-corner-all"),this.list.addClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all"),this.lis.addClass("ui-state-default ui-corner-top"),this.panels.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom"),s.selected===n?(location.hash&&this.anchors.each(function(e,t){if(t.hash==location.hash){s.selected=e;return!1}}),typeof s.selected!="number"&&s.cookie&&(s.selected=parseInt(i._cookie(),10)),typeof s.selected!="number"&&this.lis.filter(".ui-tabs-selected").length&&(s.selected=this.lis.index(this.lis.filter(".ui-tabs-selected"))),s.selected=s.selected||(this.lis.length?0:-1)):s.selected===null&&(s.selected=-1),s.selected=s.selected>=0&&this.anchors[s.selected]||s.selected<0?s.selected:0,s.disabled=e.unique(s.disabled.concat(e.map(this.lis.filter(".ui-state-disabled"),function(e,t){return i.lis.index(e)}))).sort(),e.inArray(s.selected,s.disabled)!=-1&&s.disabled.splice(e.inArray(s.selected,s.disabled),1),this.panels.addClass("ui-tabs-hide"),this.lis.removeClass("ui-tabs-selected ui-state-active"),s.selected>=0&&this.anchors.length&&(i.element.find(i._sanitizeSelector(i.anchors[s.selected].hash)).removeClass("ui-tabs-hide"),this.lis.eq(s.selected).addClass("ui-tabs-selected ui-state-active"),i.element.queue("tabs",function(){i._trigger("show",null,i._ui(i.anchors[s.selected],i.element.find(i._sanitizeSelector(i.anchors[s.selected].hash))[0]))}),this.load(s.selected)),e(window).bind("unload",function(){i.lis.add(i.anchors).unbind(".tabs"),i.lis=i.anchors=i.panels=null})):s.selected=this.lis.index(this.lis.filter(".ui-tabs-selected")),this.element[s.collapsible?"addClass":"removeClass"]("ui-tabs-collapsible"),s.cookie&&this._cookie(s.selected,s.cookie);for(var u=0,f;f=this.lis[u];u++)e(f)[e.inArray(u,s.disabled)!=-1&&!e(f).hasClass("ui-tabs-selected")?"addClass":"removeClass"]("ui-state-disabled");s.cache===!1&&this.anchors.removeData("cache.tabs"),this.lis.add(this.anchors).unbind(".tabs");if(s.event!=="mouseover"){var l=function(e,t){t.is(":not(.ui-state-disabled)")&&t.addClass("ui-state-"+e)},c=function(e,t){t.removeClass("ui-state-"+e)};this.lis.bind("mouseover.tabs",function(){l("hover",e(this))}),this.lis.bind("mouseout.tabs",function(){c("hover",e(this))}),this.anchors.bind("focus.tabs",function(){l("focus",e(this).closest("li"))}),this.anchors.bind("blur.tabs",function(){c("focus",e(this).closest("li"))})}var h,p;s.fx&&(e.isArray(s.fx)?(h=s.fx[0],p=s.fx[1]):h=p=s.fx);var d=p?function(t,n){e(t).closest("li").addClass("ui-tabs-selected ui-state-active"),n.hide().removeClass("ui-tabs-hide").animate(p,p.duration||"normal",function(){r(n,p),i._trigger("show",null,i._ui(t,n[0]))})}:function(t,n){e(t).closest("li").addClass("ui-tabs-selected ui-state-active"),n.removeClass("ui-tabs-hide"),i._trigger("show",null,i._ui(t,n[0]))},v=h?function(e,t){t.animate(h,h.duration||"normal",function(){i.lis.removeClass("ui-tabs-selected ui-state-active"),t.addClass("ui-tabs-hide"),r(t,h),i.element.dequeue("tabs")})}:function(e,t,n){i.lis.removeClass("ui-tabs-selected ui-state-active"),t.addClass("ui-tabs-hide"),i.element.dequeue("tabs")};this.anchors.bind(s.event+".tabs",function(){var t=this,n=e(t).closest("li"),r=i.panels.filter(":not(.ui-tabs-hide)"),o=i.element.find(i._sanitizeSelector(t.hash));if(n.hasClass("ui-tabs-selected")&&!s.collapsible||n.hasClass("ui-state-disabled")||n.hasClass("ui-state-processing")||i.panels.filter(":animated").length||i._trigger("select",null,i._ui(this,o[0]))===!1){this.blur();return!1}s.selected=i.anchors.index(this),i.abort();if(s.collapsible){if(n.hasClass("ui-tabs-selected")){s.selected=-1,s.cookie&&i._cookie(s.selected,s.cookie),i.element.queue("tabs",function(){v(t,r)}).dequeue("tabs"),this.blur();return!1}if(!r.length){s.cookie&&i._cookie(s.selected,s.cookie),i.element.queue("tabs",function(){d(t,o)}),i.load(i.anchors.index(this)),this.blur();return!1}}s.cookie&&i._cookie(s.selected,s.cookie);if(!o.length)throw"jQuery UI Tabs: Mismatching fragment identifier.";r.length&&i.element.queue("tabs",function(){v(t,r)}),i.element.queue("tabs",function(){d(t,o)}),i.load(i.anchors.index(this));e.browser.msie&&this.blur()}),this.anchors.bind("click.tabs",function(){return!1})},_getIndex:function(e){typeof e=="string"&&(e=this.anchors.index(this.anchors.filter("[href$="+e+"]")));return e},destroy:function(){var t=this.options;this.abort(),this.element.unbind(".tabs").removeClass("ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-collapsible").removeData("tabs"),this.list.removeClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all"),this.anchors.each(function(){var t=e.data(this,"href.tabs");t&&(this.href=t);var n=e(this).unbind(".tabs");e.each(["href","load","cache"],function(e,t){n.removeData(t+".tabs")})}),this.lis.unbind(".tabs").add(this.panels).each(function(){e.data(this,"destroy.tabs")?e(this).remove():e(this).removeClass(["ui-state-default","ui-corner-top","ui-tabs-selected","ui-state-active","ui-state-hover","ui-state-focus","ui-state-disabled","ui-tabs-panel","ui-widget-content","ui-corner-bottom","ui-tabs-hide"].join(" "))}),t.cookie&&this._cookie(null,t.cookie);return this},add:function(t,r,i){i===n&&(i=this.anchors.length);var s=this,o=this.options,u=e(o.tabTemplate.replace(/#\{href\}/g,t).replace(/#\{label\}/g,r)),f=t.indexOf("#")?this._tabId(e("a",u)[0]):t.replace("#","");u.addClass("ui-state-default ui-corner-top").data("destroy.tabs",!0);var l=s.element.find("#"+f);l.length||(l=e(o.panelTemplate).attr("id",f).data("destroy.tabs",!0)),l.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide"),i>=this.lis.length?(u.appendTo(this.list),l.appendTo(this.list[0].parentNode)):(u.insertBefore(this.lis[i]),l.insertBefore(this.panels[i])),o.disabled=e.map(o.disabled,function(e,t){return e>=i?++e:e}),this._tabify(),this.anchors.length==1&&(o.selected=0,u.addClass("ui-tabs-selected ui-state-active"),l.removeClass("ui-tabs-hide"),this.element.queue("tabs",function(){s._trigger("show",null,s._ui(s.anchors[0],s.panels[0]))}),this.load(0)),this._trigger("add",null,this._ui(this.anchors[i],this.panels[i]));return this},remove:function(t){t=this._getIndex(t);var n=this.options,r=this.lis.eq(t).remove(),i=this.panels.eq(t).remove();r.hasClass("ui-tabs-selected")&&this.anchors.length>1&&this.select(t+(t+1<this.anchors.length?1:-1)),n.disabled=e.map(e.grep(n.disabled,function(e,n){return e!=t}),function(e,n){return e>=t?--e:e}),this._tabify(),this._trigger("remove",null,this._ui(r.find("a")[0],i[0]));return this},enable:function(t){t=this._getIndex(t);var n=this.options;if(e.inArray(t,n.disabled)!=-1){this.lis.eq(t).removeClass("ui-state-disabled"),n.disabled=e.grep(n.disabled,function(e,n){return e!=t}),this._trigger("enable",null,this._ui(this.anchors[t],this.panels[t]));return this}},disable:function(e){e=this._getIndex(e);var t=this,n=this.options;e!=n.selected&&(this.lis.eq(e).addClass("ui-state-disabled"),n.disabled.push(e),n.disabled.sort(),this._trigger("disable",null,this._ui(this.anchors[e],this.panels[e])));return this},select:function(e){e=this._getIndex(e);if(e==-1){if(!this.options.collapsible||this.options.selected==-1)return this;e=this.options.selected}this.anchors.eq(e).trigger(this.options.event+".tabs");return this},load:function(t){t=this._getIndex(t);var n=this,r=this.options,i=this.anchors.eq(t)[0],s=e.data(i,"load.tabs");this.abort();if(!(!s||this.element.queue("tabs").length!==0&&e.data(i,"cache.tabs"))){this.lis.eq(t).addClass("ui-state-processing");if(r.spinner){var o=e("span",i);o.data("label.tabs",o.html()).html(r.spinner)}this.xhr=e.ajax(e.extend({},r.ajaxOptions,{url:s,success:function(s,o){n.element.find(n._sanitizeSelector(i.hash)).html(s),n._cleanup(),r.cache&&e.data(i,"cache.tabs",!0),n._trigger("load",null,n._ui(n.anchors[t],n.panels[t]));try{r.ajaxOptions.success(s,o)}catch(u){}},error:function(e,s,o){n._cleanup(),n._trigger("load",null,n._ui(n.anchors[t],n.panels[t]));try{r.ajaxOptions.error(e,s,t,i)}catch(o){}}})),n.element.dequeue("tabs");return this}this.element.dequeue("tabs")},abort:function(){this.element.queue([]),this.panels.stop(!1,!0),this.element.queue("tabs",this.element.queue("tabs").splice(-2,2)),this.xhr&&(this.xhr.abort(),delete this.xhr),this._cleanup();return this},url:function(e,t){this.anchors.eq(e).removeData("cache.tabs").data("load.tabs",t);return this},length:function(){return this.anchors.length}}),e.extend(e.ui.tabs,{version:"1.8.18"}),e.extend(e.ui.tabs.prototype,{rotation:null,rotate:function(e,n){var r=this,i=this.options,s=r._rotate||(r._rotate=function(t){clearTimeout(r.rotation),r.rotation=setTimeout(function(){var e=i.selected;r.select(++e<r.anchors.length?e:0)},e),t&&t.stopPropagation()}),o=r._unrotate||(r._unrotate=n?function(e){t=i.selected,s()}:function(e){e.clientX&&r.rotate(null)});e?(this.element.bind("tabsshow",s),this.anchors.bind(i.event+".tabs",o),s()):(clearTimeout(r.rotation),this.element.unbind("tabsshow",s),this.anchors.unbind(i.event+".tabs",o),delete this._rotate,delete this._unrotate);return this}})})(jQuery);