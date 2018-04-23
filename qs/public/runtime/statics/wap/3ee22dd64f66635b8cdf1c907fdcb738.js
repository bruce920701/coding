/*!
 * =====================================================
 * SUI Mobile - http://m.sui.taobao.org/
 *
 * =====================================================
 */
$.smVersion="0.6.2",+function(a){"use strict";var b={autoInit:!1,showPageLoadingIndicator:!0,router:!0,swipePanel:"left",swipePanelOnlyClose:!0};a.smConfig=a.extend(b,a.config)}(Zepto),+function(a){"use strict";a.compareVersion=function(a,b){var c=a.split("."),d=b.split(".");if(a===b)return 0;for(var e=0;e<c.length;e++){var f=parseInt(c[e]);if(!d[e])return 1;var g=parseInt(d[e]);if(g>f)return-1;if(f>g)return 1}return-1},a.getCurrentPage=function(){return a(".page-current")[0]||a(".page")[0]||document.body}}(Zepto),function(a){"use strict";function b(a,b){function c(a){if(a.target===this)for(b.call(this,a),d=0;d<e.length;d++)f.off(e[d],c)}var d,e=a,f=this;if(b)for(d=0;d<e.length;d++)f.on(e[d],c)}["width","height"].forEach(function(b){var c=b.replace(/./,function(a){return a[0].toUpperCase()});a.fn["outer"+c]=function(a){var c=this;if(c){var d=c[b](),e={width:["left","right"],height:["top","bottom"]};return e[b].forEach(function(b){a&&(d+=parseInt(c.css("margin-"+b),10))}),d}return null}}),a.support=function(){var a={touch:!!("ontouchstart"in window||window.DocumentTouch&&document instanceof window.DocumentTouch)};return a}(),a.touchEvents={start:a.support.touch?"touchstart":"mousedown",move:a.support.touch?"touchmove":"mousemove",end:a.support.touch?"touchend":"mouseup"},a.getTranslate=function(a,b){var c,d,e,f;return"undefined"==typeof b&&(b="x"),e=window.getComputedStyle(a,null),window.WebKitCSSMatrix?f=new WebKitCSSMatrix("none"===e.webkitTransform?"":e.webkitTransform):(f=e.MozTransform||e.transform||e.getPropertyValue("transform").replace("translate(","matrix(1, 0, 0, 1,"),c=f.toString().split(",")),"x"===b&&(d=window.WebKitCSSMatrix?f.m41:16===c.length?parseFloat(c[12]):parseFloat(c[4])),"y"===b&&(d=window.WebKitCSSMatrix?f.m42:16===c.length?parseFloat(c[13]):parseFloat(c[5])),d||0},a.requestAnimationFrame=function(a){return requestAnimationFrame?requestAnimationFrame(a):webkitRequestAnimationFrame?webkitRequestAnimationFrame(a):mozRequestAnimationFrame?mozRequestAnimationFrame(a):setTimeout(a,1e3/60)},a.cancelAnimationFrame=function(a){return cancelAnimationFrame?cancelAnimationFrame(a):webkitCancelAnimationFrame?webkitCancelAnimationFrame(a):mozCancelAnimationFrame?mozCancelAnimationFrame(a):clearTimeout(a)},a.fn.dataset=function(){var b={},c=this[0].dataset;for(var d in c){var e=b[d]=c[d];"false"===e?b[d]=!1:"true"===e?b[d]=!0:parseFloat(e)===1*e&&(b[d]=1*e)}return a.extend({},b,this[0].__eleData)},a.fn.data=function(b,c){var d=a(this).dataset();if(!b)return d;if("undefined"==typeof c){var e=d[b],f=this[0].__eleData;return f&&b in f?f[b]:e}for(var g=0;g<this.length;g++){var h=this[g];b in d&&delete h.dataset[b],h.__eleData||(h.__eleData={}),h.__eleData[b]=c}return this},a.fn.animationEnd=function(a){return b.call(this,["webkitAnimationEnd","animationend"],a),this},a.fn.transitionEnd=function(a){return b.call(this,["webkitTransitionEnd","transitionend"],a),this},a.fn.transition=function(a){"string"!=typeof a&&(a+="ms");for(var b=0;b<this.length;b++){var c=this[b].style;c.webkitTransitionDuration=c.MozTransitionDuration=c.transitionDuration=a}return this},a.fn.transform=function(a){for(var b=0;b<this.length;b++){var c=this[b].style;c.webkitTransform=c.MozTransform=c.transform=a}return this},a.fn.prevAll=function(b){var c=[],d=this[0];if(!d)return a([]);for(;d.previousElementSibling;){var e=d.previousElementSibling;b?a(e).is(b)&&c.push(e):c.push(e),d=e}return a(c)},a.fn.nextAll=function(b){var c=[],d=this[0];if(!d)return a([]);for(;d.nextElementSibling;){var e=d.nextElementSibling;b?a(e).is(b)&&c.push(e):c.push(e),d=e}return a(c)},a.fn.show=function(){function a(a){var c,d;return b[a]||(c=document.createElement(a),document.body.appendChild(c),d=getComputedStyle(c,"").getPropertyValue("display"),c.parentNode.removeChild(c),"none"===d&&(d="block"),b[a]=d),b[a]}var b={};return this.each(function(){"none"===this.style.display&&(this.style.display=""),"none"===getComputedStyle(this,"").getPropertyValue("display"),this.style.display=a(this.nodeName)})}}(Zepto),function(a){"use strict";var b={},c=navigator.userAgent,d=c.match(/(Android);?[\s\/]+([\d.]+)?/),e=c.match(/(iPad).*OS\s([\d_]+)/),f=c.match(/(iPod)(.*OS\s([\d_]+))?/),g=!e&&c.match(/(iPhone\sOS)\s([\d_]+)/);if(b.ios=b.android=b.iphone=b.ipad=b.androidChrome=!1,d&&(b.os="android",b.osVersion=d[2],b.android=!0,b.androidChrome=c.toLowerCase().indexOf("chrome")>=0),(e||g||f)&&(b.os="ios",b.ios=!0),g&&!f&&(b.osVersion=g[2].replace(/_/g,"."),b.iphone=!0),e&&(b.osVersion=e[2].replace(/_/g,"."),b.ipad=!0),f&&(b.osVersion=f[3]?f[3].replace(/_/g,"."):null,b.iphone=!0),b.ios&&b.osVersion&&c.indexOf("Version/")>=0&&"10"===b.osVersion.split(".")[0]&&(b.osVersion=c.toLowerCase().split("version/")[1].split(" ")[0]),b.webView=(g||e||f)&&c.match(/.*AppleWebKit(?!.*Safari)/i),b.os&&"ios"===b.os){var h=b.osVersion.split(".");b.minimalUi=!b.webView&&(f||g)&&(1*h[0]===7?1*h[1]>=1:1*h[0]>7)&&a('meta[name="viewport"]').length>0&&a('meta[name="viewport"]').attr("content").indexOf("minimal-ui")>=0}var i=a(window).width(),j=a(window).height();b.statusBar=!1,b.webView&&i*j===screen.width*screen.height?b.statusBar=!0:b.statusBar=!1;var k=[];if(b.pixelRatio=window.devicePixelRatio||1,k.push("pixel-ratio-"+Math.floor(b.pixelRatio)),b.pixelRatio>=2&&k.push("retina"),b.os&&(k.push(b.os,b.os+"-"+b.osVersion.split(".")[0],b.os+"-"+b.osVersion.replace(/\./g,"-")),"ios"===b.os))for(var l=parseInt(b.osVersion.split(".")[0],10),m=l-1;m>=6;m--)k.push("ios-gt-"+m);b.statusBar?k.push("with-statusbar-overlay"):a("html").removeClass("with-statusbar-overlay"),k.length>0&&a("html").addClass(k.join(" ")),b.isWeixin=/MicroMessenger/i.test(c),a.device=b}(Zepto),function(){"use strict";function a(b,d){function e(a,b){return function(){return a.apply(b,arguments)}}var f;if(d=d||{},this.trackingClick=!1,this.trackingClickStart=0,this.targetElement=null,this.touchStartX=0,this.touchStartY=0,this.lastTouchIdentifier=0,this.touchBoundary=d.touchBoundary||10,this.layer=b,this.tapDelay=d.tapDelay||200,this.tapTimeout=d.tapTimeout||700,!a.notNeeded(b)){for(var g=["onMouse","onClick","onTouchStart","onTouchMove","onTouchEnd","onTouchCancel"],h=this,i=0,j=g.length;j>i;i++)h[g[i]]=e(h[g[i]],h);c&&(b.addEventListener("mouseover",this.onMouse,!0),b.addEventListener("mousedown",this.onMouse,!0),b.addEventListener("mouseup",this.onMouse,!0)),b.addEventListener("click",this.onClick,!0),b.addEventListener("touchstart",this.onTouchStart,!1),b.addEventListener("touchmove",this.onTouchMove,!1),b.addEventListener("touchend",this.onTouchEnd,!1),b.addEventListener("touchcancel",this.onTouchCancel,!1),Event.prototype.stopImmediatePropagation||(b.removeEventListener=function(a,c,d){var e=Node.prototype.removeEventListener;"click"===a?e.call(b,a,c.hijacked||c,d):e.call(b,a,c,d)},b.addEventListener=function(a,c,d){var e=Node.prototype.addEventListener;"click"===a?e.call(b,a,c.hijacked||(c.hijacked=function(a){a.propagationStopped||c(a)}),d):e.call(b,a,c,d)}),"function"==typeof b.onclick&&(f=b.onclick,b.addEventListener("click",function(a){f(a)},!1),b.onclick=null)}}var b=navigator.userAgent.indexOf("Windows Phone")>=0,c=navigator.userAgent.indexOf("Android")>0&&!b,d=/iP(ad|hone|od)/.test(navigator.userAgent)&&!b,e=d&&/OS 4_\d(_\d)?/.test(navigator.userAgent),f=d&&/OS [6-7]_\d/.test(navigator.userAgent),g=navigator.userAgent.indexOf("BB10")>0,h=!1;a.prototype.needsClick=function(a){for(var b=a;b&&"BODY"!==b.tagName.toUpperCase();){if("LABEL"===b.tagName.toUpperCase()&&(h=!0,/\bneedsclick\b/.test(b.className)))return!0;b=b.parentNode}switch(a.nodeName.toLowerCase()){case"button":case"select":case"textarea":if(a.disabled)return!0;break;case"input":if(d&&"file"===a.type||a.disabled)return!0;break;case"label":case"iframe":case"video":return!0}return/\bneedsclick\b/.test(a.className)},a.prototype.needsFocus=function(a){switch(a.nodeName.toLowerCase()){case"textarea":return!0;case"select":return!c;case"input":switch(a.type){case"button":case"checkbox":case"file":case"image":case"radio":case"submit":return!1}return!a.disabled&&!a.readOnly;default:return/\bneedsfocus\b/.test(a.className)}},a.prototype.sendClick=function(a,b){var c,d;document.activeElement&&document.activeElement!==a&&document.activeElement.blur(),d=b.changedTouches[0],c=document.createEvent("MouseEvents"),c.initMouseEvent(this.determineEventType(a),!0,!0,window,1,d.screenX,d.screenY,d.clientX,d.clientY,!1,!1,!1,!1,0,null),c.forwardedTouchEvent=!0,a.dispatchEvent(c)},a.prototype.determineEventType=function(a){return c&&"select"===a.tagName.toLowerCase()?"mousedown":"click"},a.prototype.focus=function(a){var b,c=["date","time","month","number","email"];d&&a.setSelectionRange&&-1===c.indexOf(a.type)?(b=a.value.length,a.setSelectionRange(b,b)):a.focus()},a.prototype.updateScrollParent=function(a){var b,c;if(b=a.fastClickScrollParent,!b||!b.contains(a)){c=a;do{if(c.scrollHeight>c.offsetHeight){b=c,a.fastClickScrollParent=c;break}c=c.parentElement}while(c)}b&&(b.fastClickLastScrollTop=b.scrollTop)},a.prototype.getTargetElementFromEventTarget=function(a){return a.nodeType===Node.TEXT_NODE?a.parentNode:a},a.prototype.onTouchStart=function(a){var b,c,f;if(a.targetTouches.length>1)return!0;if(b=this.getTargetElementFromEventTarget(a.target),c=a.targetTouches[0],d){if(f=window.getSelection(),f.rangeCount&&!f.isCollapsed)return!0;if(!e){if(c.identifier&&c.identifier===this.lastTouchIdentifier)return a.preventDefault(),!1;this.lastTouchIdentifier=c.identifier,this.updateScrollParent(b)}}return this.trackingClick=!0,this.trackingClickStart=a.timeStamp,this.targetElement=b,this.touchStartX=c.pageX,this.touchStartY=c.pageY,a.timeStamp-this.lastClickTime<this.tapDelay&&a.preventDefault(),!0},a.prototype.touchHasMoved=function(a){var b=a.changedTouches[0],c=this.touchBoundary;return Math.abs(b.pageX-this.touchStartX)>c||Math.abs(b.pageY-this.touchStartY)>c?!0:!1},a.prototype.onTouchMove=function(a){return this.trackingClick?((this.targetElement!==this.getTargetElementFromEventTarget(a.target)||this.touchHasMoved(a))&&(this.trackingClick=!1,this.targetElement=null),!0):!0},a.prototype.findControl=function(a){return void 0!==a.control?a.control:a.htmlFor?document.getElementById(a.htmlFor):a.querySelector("button, input:not([type=hidden]), keygen, meter, output, progress, select, textarea")},a.prototype.onTouchEnd=function(a){var b,g,h,i,j,k=this.targetElement;if(!this.trackingClick)return!0;if(a.timeStamp-this.lastClickTime<this.tapDelay)return this.cancelNextClick=!0,!0;if(a.timeStamp-this.trackingClickStart>this.tapTimeout)return!0;var l=["date","time","month"];if(-1!==l.indexOf(a.target.type))return!1;if(this.cancelNextClick=!1,this.lastClickTime=a.timeStamp,g=this.trackingClickStart,this.trackingClick=!1,this.trackingClickStart=0,f&&(j=a.changedTouches[0],k=document.elementFromPoint(j.pageX-window.pageXOffset,j.pageY-window.pageYOffset)||k,k.fastClickScrollParent=this.targetElement.fastClickScrollParent),h=k.tagName.toLowerCase(),"label"===h){if(b=this.findControl(k)){if(this.focus(k),c)return!1;k=b}}else if(this.needsFocus(k))return a.timeStamp-g>100||d&&window.top!==window&&"input"===h?(this.targetElement=null,!1):(this.focus(k),this.sendClick(k,a),d&&"select"===h||(this.targetElement=null,a.preventDefault()),!1);return d&&!e&&(i=k.fastClickScrollParent,i&&i.fastClickLastScrollTop!==i.scrollTop)?!0:(this.needsClick(k)||(a.preventDefault(),this.sendClick(k,a)),!1)},a.prototype.onTouchCancel=function(){this.trackingClick=!1,this.targetElement=null},a.prototype.onMouse=function(a){return this.targetElement?a.forwardedTouchEvent?!0:a.cancelable&&(!this.needsClick(this.targetElement)||this.cancelNextClick)?(a.stopImmediatePropagation?a.stopImmediatePropagation():a.propagationStopped=!0,a.stopPropagation(),h||a.preventDefault(),!1):!0:!0},a.prototype.onClick=function(a){var b;return this.trackingClick?(this.targetElement=null,this.trackingClick=!1,!0):"submit"===a.target.type&&0===a.detail?!0:(b=this.onMouse(a),b||(this.targetElement=null),b)},a.prototype.destroy=function(){var a=this.layer;c&&(a.removeEventListener("mouseover",this.onMouse,!0),a.removeEventListener("mousedown",this.onMouse,!0),a.removeEventListener("mouseup",this.onMouse,!0)),a.removeEventListener("click",this.onClick,!0),a.removeEventListener("touchstart",this.onTouchStart,!1),a.removeEventListener("touchmove",this.onTouchMove,!1),a.removeEventListener("touchend",this.onTouchEnd,!1),a.removeEventListener("touchcancel",this.onTouchCancel,!1)},a.notNeeded=function(a){var b,d,e,f;if("undefined"==typeof window.ontouchstart)return!0;if(d=+(/Chrome\/([0-9]+)/.exec(navigator.userAgent)||[,0])[1]){if(!c)return!0;if(b=document.querySelector("meta[name=viewport]")){if(-1!==b.content.indexOf("user-scalable=no"))return!0;if(d>31&&document.documentElement.scrollWidth<=window.outerWidth)return!0}}if(g&&(e=navigator.userAgent.match(/Version\/([0-9]*)\.([0-9]*)/),e[1]>=10&&e[2]>=3&&(b=document.querySelector("meta[name=viewport]")))){if(-1!==b.content.indexOf("user-scalable=no"))return!0;if(document.documentElement.scrollWidth<=window.outerWidth)return!0}return"none"===a.style.msTouchAction||"manipulation"===a.style.touchAction?!0:(f=+(/Firefox\/([0-9]+)/.exec(navigator.userAgent)||[,0])[1],f>=27&&(b=document.querySelector("meta[name=viewport]"),b&&(-1!==b.content.indexOf("user-scalable=no")||document.documentElement.scrollWidth<=window.outerWidth))?!0:"none"===a.style.touchAction||"manipulation"===a.style.touchAction?!0:!1)},a.attach=function(b,c){return new a(b,c)},window.FastClick=a}(),+function(a){"use strict";function b(b){var c,e=a(this),f=(e.attr("href"),e.dataset());e.hasClass("open-popup")&&(c=f.popup?f.popup:".popup",a.popup(c)),e.hasClass("close-popup")&&(c=f.popup?f.popup:".popup.modal-in",a.closeModal(c)),e.hasClass("modal-overlay")&&(a(".modal.modal-in").length>0&&d.modalCloseByOutside&&a.closeModal(".modal.modal-in"),a(".actions-modal.modal-in").length>0&&d.actionsCloseByOutside&&a.closeModal(".actions-modal.modal-in")),e.hasClass("popup-overlay")&&a(".popup.modal-in").length>0&&d.popupCloseByOutside&&a.closeModal(".popup.modal-in")}var c=document.createElement("div");a.modalStack=[],a.modalStackClearQueue=function(){a.modalStack.length&&a.modalStack.shift()()},a.modal=function(b){b=b||{};var e="",f="";if(b.buttons&&b.buttons.length>0)for(var g=0;g<b.buttons.length;g++)f+='<span class="modal-button'+(b.buttons[g].bold?" modal-button-bold":"")+'">'+b.buttons[g].text+"</span>";var h=b.extraClass||"",i=b.title?'<div class="modal-title">'+b.title+"</div>":"",j=b.text?'<div class="modal-text">'+b.text+"</div>":"",k=b.afterText?b.afterText:"",l=b.buttons&&0!==b.buttons.length?"":"modal-no-buttons",m=b.verticalButtons?"modal-buttons-vertical":"";e='<div class="modal '+h+" "+l+'"><div class="modal-inner">'+(i+j+k)+'</div><div class="modal-buttons '+m+'">'+f+"</div></div>",c.innerHTML=e;var n=a(c).children();return a(d.modalContainer).append(n[0]),n.find(".modal-button").each(function(c,d){a(d).on("click",function(d){b.buttons[c].close!==!1&&a.closeModal(n),b.buttons[c].onClick&&b.buttons[c].onClick(n,d),b.onClick&&b.onClick(n,c)})}),a.openModal(n),n[0]},a.alert=function(b,c,e){return"function"==typeof c&&(e=arguments[1],c=void 0),a.modal({text:b||"",title:"undefined"==typeof c?d.modalTitle:c,buttons:[{text:d.modalButtonOk,bold:!0,onClick:e}]})},a.confirm=function(b,c,e,f){return"function"==typeof c&&(f=arguments[2],e=arguments[1],c=void 0),a.modal({text:b||"",title:"undefined"==typeof c?d.modalTitle:c,buttons:[{text:d.modalButtonCancel,onClick:f},{text:d.modalButtonOk,bold:!0,onClick:e}]})},a.prompt=function(b,c,e,f){return"function"==typeof c&&(f=arguments[2],e=arguments[1],c=void 0),a.modal({text:b||"",title:"undefined"==typeof c?d.modalTitle:c,afterText:'<input type="text" class="modal-text-input">',buttons:[{text:d.modalButtonCancel},{text:d.modalButtonOk,bold:!0}],onClick:function(b,c){0===c&&f&&f(a(b).find(".modal-text-input").val()),1===c&&e&&e(a(b).find(".modal-text-input").val())}})},a.modalLogin=function(b,c,e,f){return"function"==typeof c&&(f=arguments[2],e=arguments[1],c=void 0),a.modal({text:b||"",title:"undefined"==typeof c?d.modalTitle:c,afterText:'<input type="text" name="modal-username" placeholder="'+d.modalUsernamePlaceholder+'" class="modal-text-input modal-text-input-double"><input type="password" name="modal-password" placeholder="'+d.modalPasswordPlaceholder+'" class="modal-text-input modal-text-input-double">',buttons:[{text:d.modalButtonCancel},{text:d.modalButtonOk,bold:!0}],onClick:function(b,c){var d=a(b).find('.modal-text-input[name="modal-username"]').val(),g=a(b).find('.modal-text-input[name="modal-password"]').val();0===c&&f&&f(d,g),1===c&&e&&e(d,g)}})},a.modalPassword=function(b,c,e,f){return"function"==typeof c&&(f=arguments[2],e=arguments[1],c=void 0),a.modal({text:b||"",title:"undefined"==typeof c?d.modalTitle:c,afterText:'<input type="password" name="modal-password" placeholder="'+d.modalPasswordPlaceholder+'" class="modal-text-input">',buttons:[{text:d.modalButtonCancel},{text:d.modalButtonOk,bold:!0}],onClick:function(b,c){var d=a(b).find('.modal-text-input[name="modal-password"]').val();0===c&&f&&f(d),1===c&&e&&e(d)}})},a.showPreloader=function(b){return a.hidePreloader(),a.showPreloader.preloaderModal=a.modal({title:b||d.modalPreloaderTitle,text:'<div class="preloader"></div>'}),a.showPreloader.preloaderModal},a.hidePreloader=function(){a.showPreloader.preloaderModal&&a.closeModal(a.showPreloader.preloaderModal)},a.showIndicator=function(){a(".preloader-indicator-modal")[0]||a(d.modalContainer).append('<div class="preloader-indicator-overlay"></div><div class="preloader-indicator-modal"><span class="preloader preloader-white"></span></div>')},a.hideIndicator=function(){a(".preloader-indicator-overlay, .preloader-indicator-modal").remove()},a.actions=function(b){var e,f,g;b=b||[],b.length>0&&!a.isArray(b[0])&&(b=[b]);for(var h,i="",j=0;j<b.length;j++)for(var k=0;k<b[j].length;k++){0===k&&(i+='<div class="actions-modal-group">');var l=b[j][k],m=l.label?"actions-modal-label":"actions-modal-button";l.bold&&(m+=" actions-modal-button-bold"),l.color&&(m+=" color-"+l.color),l.bg&&(m+=" bg-"+l.bg),l.disabled&&(m+=" disabled"),i+='<span class="'+m+'">'+l.text+"</span>",k===b[j].length-1&&(i+="</div>")}h='<div class="actions-modal">'+i+"</div>",c.innerHTML=h,e=a(c).children(),a(d.modalContainer).append(e[0]),f=".actions-modal-group",g=".actions-modal-button";var n=e.find(f);return n.each(function(c,d){var f=c;a(d).children().each(function(c,d){var h,i=c,j=b[f][i];a(d).is(g)&&(h=a(d)),h&&h.on("click",function(b){j.close!==!1&&a.closeModal(e),j.onClick&&j.onClick(e,b)})})}),a.openModal(e),e[0]},a.popup=function(b,c){if("undefined"==typeof c&&(c=!0),"string"==typeof b&&b.indexOf("<")>=0){var e=document.createElement("div");if(e.innerHTML=b.trim(),!(e.childNodes.length>0))return!1;b=e.childNodes[0],c&&b.classList.add("remove-on-close"),a(d.modalContainer).append(b)}return b=a(b),0===b.length?!1:(b.show(),b.find(".content").scroller("refresh"),b.find("."+d.viewClass).length>0&&a.sizeNavbars(b.find("."+d.viewClass)[0]),a.openModal(b),b[0])},a.pickerModal=function(b,c){if("undefined"==typeof c&&(c=!0),"string"==typeof b&&b.indexOf("<")>=0){if(b=a(b),!(b.length>0))return!1;c&&b.addClass("remove-on-close"),a(d.modalContainer).append(b[0])}return b=a(b),0===b.length?!1:(b.show(),a.openModal(b),b[0])},a.loginScreen=function(b){return b||(b=".login-screen"),b=a(b),0===b.length?!1:(b.show(),b.find("."+d.viewClass).length>0&&a.sizeNavbars(b.find("."+d.viewClass)[0]),a.openModal(b),b[0])},a.toast=function(b,c,d){var e=a('<div class="modal toast '+(d||"")+'">'+b+"</div>").appendTo(document.body);a.openModal(e,function(){setTimeout(function(){a.closeModal(e)},c||2e3)})},a.openModal=function(b,c){b=a(b);var e=b.hasClass("modal"),f=!b.hasClass("toast");if(a(".modal.modal-in:not(.modal-out)").length&&d.modalStack&&e&&f)return void a.modalStack.push(function(){a.openModal(b,c)});var g=b.hasClass("popup"),h=b.hasClass("login-screen"),i=b.hasClass("picker-modal"),j=b.hasClass("toast");e&&(b.show(),b.css({marginTop:-Math.round(b.outerHeight()/2)+"px"})),j&&b.css({marginLeft:-Math.round(b.outerWidth()/2/1.185)+"px"});var k;h||i||j||(0!==a(".modal-overlay").length||g||a(d.modalContainer).append('<div class="modal-overlay"></div>'),0===a(".popup-overlay").length&&g&&a(d.modalContainer).append('<div class="popup-overlay"></div>'),k=a(g?".popup-overlay":".modal-overlay"));b[0].clientLeft;return b.trigger("open"),i&&a(d.modalContainer).addClass("with-picker-modal"),h||i||j||k.addClass("modal-overlay-visible"),b.removeClass("modal-out").addClass("modal-in").transitionEnd(function(a){b.hasClass("modal-out")?b.trigger("closed"):b.trigger("opened")}),"function"==typeof c&&c.call(this),!0},a.closeModal=function(b){if(b=a(b||".modal-in"),"undefined"==typeof b||0!==b.length){var c=b.hasClass("modal"),e=b.hasClass("popup"),f=b.hasClass("toast"),g=b.hasClass("login-screen"),h=b.hasClass("picker-modal"),i=b.hasClass("remove-on-close"),j=a(e?".popup-overlay":".modal-overlay");return e?b.length===a(".popup.modal-in").length&&j.removeClass("modal-overlay-visible"):h||f||j.removeClass("modal-overlay-visible"),b.trigger("close"),h&&(a(d.modalContainer).removeClass("with-picker-modal"),a(d.modalContainer).addClass("picker-modal-closing")),b.removeClass("modal-in").addClass("modal-out").transitionEnd(function(c){b.hasClass("modal-out")?b.trigger("closed"):b.trigger("opened"),h&&a(d.modalContainer).removeClass("picker-modal-closing"),e||g||h?(b.removeClass("modal-out").hide(),i&&b.length>0&&b.remove()):b.remove()}),c&&d.modalStack&&a.modalStackClearQueue(),!0}},a(document).on("click"," .modal-overlay, .popup-overlay, .close-popup, .open-popup, .close-picker",b);var d=a.modal.prototype.defaults={modalStack:!0,modalButtonOk:"确定",modalButtonCancel:"取消",modalPreloaderTitle:"加载中",modalContainer:document.body}}(Zepto),+function(a){"use strict";var b=!1,c=function(c){function d(a){a=new Date(a);var b=a.getFullYear(),c=a.getMonth(),d=c+1,e=a.getDate(),f=a.getDay();return h.params.dateFormat.replace(/yyyy/g,b).replace(/yy/g,(b+"").substring(2)).replace(/mm/g,10>d?"0"+d:d).replace(/m/g,d).replace(/MM/g,h.params.monthNames[c]).replace(/M/g,h.params.monthNamesShort[c]).replace(/dd/g,10>e?"0"+e:e).replace(/d/g,e).replace(/DD/g,h.params.dayNames[f]).replace(/D/g,h.params.dayNamesShort[f])}function e(b){if(b.preventDefault(),a.device.isWeixin&&a.device.android&&h.params.inputReadOnly&&(this.focus(),this.blur()),!h.opened&&(h.open(),h.params.scrollToInput)){var c=h.input.parents(".content");if(0===c.length)return;var d,e=parseInt(c.css("padding-top"),10),f=parseInt(c.css("padding-bottom"),10),g=c[0].offsetHeight-e-h.container.height(),i=c[0].scrollHeight-e-h.container.height(),j=h.input.offset().top-e+h.input[0].offsetHeight;if(j>g){var k=c.scrollTop()+j-g;k+g>i&&(d=k+g-i+f,g===i&&(d=h.container.height()),c.css({"padding-bottom":d+"px"})),c.scrollTop(k,300)}}}function f(b){h.input&&h.input.length>0?b.target!==h.input[0]&&0===a(b.target).parents(".picker-modal").length&&h.close():0===a(b.target).parents(".picker-modal").length&&h.close()}function g(){h.opened=!1,h.input&&h.input.length>0&&h.input.parents(".content").css({"padding-bottom":""}),h.params.onClose&&h.params.onClose(h),h.destroyCalendarEvents()}var h=this,i={monthNames:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],monthNamesShort:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],dayNames:["周日","周一","周二","周三","周四","周五","周六"],dayNamesShort:["周日","周一","周二","周三","周四","周五","周六"],firstDay:1,weekendDays:[0,6],multiple:!1,dateFormat:"yyyy-mm-dd",direction:"horizontal",minDate:null,maxDate:null,touchMove:!0,animate:!0,closeOnSelect:!0,monthPicker:!0,monthPickerTemplate:'<div class="picker-calendar-month-picker"><a href="#" class="link icon-only picker-calendar-prev-month"><i class="icon icon-prev"></i></a><div class="current-month-value"></div><a href="#" class="link icon-only picker-calendar-next-month"><i class="icon icon-next"></i></a></div>',yearPicker:!0,yearPickerTemplate:'<div class="picker-calendar-year-picker"><a href="#" class="link icon-only picker-calendar-prev-year"><i class="icon icon-prev"></i></a><span class="current-year-value"></span><a href="#" class="link icon-only picker-calendar-next-year"><i class="icon icon-next"></i></a></div>',weekHeader:!0,scrollToInput:!0,inputReadOnly:!0,toolbar:!0,toolbarCloseText:"Done",toolbarTemplate:'<div class="toolbar"><div class="toolbar-inner">{{monthPicker}}{{yearPicker}}</div></div>'};c=c||{};for(var j in i)"undefined"==typeof c[j]&&(c[j]=i[j]);h.params=c,h.initialized=!1,h.inline=h.params.container?!0:!1,h.isH="horizontal"===h.params.direction;var k=h.isH&&b?-1:1;return h.animating=!1,h.addValue=function(a){if(h.params.multiple){h.value||(h.value=[]);for(var b,c=0;c<h.value.length;c++)new Date(a).getTime()===new Date(h.value[c]).getTime()&&(b=c);"undefined"==typeof b?h.value.push(a):h.value.splice(b,1),h.updateValue()}else h.value=[a],h.updateValue()},h.setValue=function(a){h.value=a,h.updateValue()},h.updateValue=function(){h.wrapper.find(".picker-calendar-day-selected").removeClass("picker-calendar-day-selected");var b,c;for(b=0;b<h.value.length;b++){var e=new Date(h.value[b]);h.wrapper.find('.picker-calendar-day[data-date="'+e.getFullYear()+"-"+e.getMonth()+"-"+e.getDate()+'"]').addClass("picker-calendar-day-selected")}if(h.params.onChange&&h.params.onChange(h,h.value,h.value.map(d)),h.input&&h.input.length>0){if(h.params.formatValue)c=h.params.formatValue(h,h.value);else{for(c=[],b=0;b<h.value.length;b++)c.push(d(h.value[b]));c=c.join(", ")}a(h.input).val(c),a(h.input).trigger("change")}},h.initCalendarEvents=function(){function c(a){i||g||(g=!0,j=n="touchstart"===a.type?a.targetTouches[0].pageX:a.pageX,l=n="touchstart"===a.type?a.targetTouches[0].pageY:a.pageY,o=(new Date).getTime(),u=0,x=!0,w=void 0,q=r=h.monthsTranslate)}function d(a){if(g){if(m="touchmove"===a.type?a.targetTouches[0].pageX:a.pageX,n="touchmove"===a.type?a.targetTouches[0].pageY:a.pageY,"undefined"==typeof w&&(w=!!(w||Math.abs(n-l)>Math.abs(m-j))),h.isH&&w)return void(g=!1);if(a.preventDefault(),h.animating)return void(g=!1);x=!1,i||(i=!0,s=h.wrapper[0].offsetWidth,t=h.wrapper[0].offsetHeight,h.wrapper.transition(0)),a.preventDefault(),v=h.isH?m-j:n-l,u=v/(h.isH?s:t),r=100*(h.monthsTranslate*k+u),h.wrapper.transform("translate3d("+(h.isH?r:0)+"%, "+(h.isH?0:r)+"%, 0)")}}function e(a){return g&&i?(g=i=!1,p=(new Date).getTime(),300>p-o?Math.abs(v)<10?h.resetMonth():v>=10?b?h.nextMonth():h.prevMonth():b?h.prevMonth():h.nextMonth():-.5>=u?b?h.prevMonth():h.nextMonth():u>=.5?b?h.nextMonth():h.prevMonth():h.resetMonth(),void setTimeout(function(){x=!0},100)):void(g=i=!1)}function f(b){if(x){var c=a(b.target).parents(".picker-calendar-day");if(0===c.length&&a(b.target).hasClass("picker-calendar-day")&&(c=a(b.target)),0!==c.length&&(!c.hasClass("picker-calendar-day-selected")||h.params.multiple)&&!c.hasClass("picker-calendar-day-disabled")){c.hasClass("picker-calendar-day-next")&&h.nextMonth(),c.hasClass("picker-calendar-day-prev")&&h.prevMonth();var d=c.attr("data-year"),e=c.attr("data-month"),f=c.attr("data-day");h.params.onDayClick&&h.params.onDayClick(h,c[0],d,e,f),h.addValue(new Date(d,e,f).getTime()),h.params.closeOnSelect&&h.close()}}}var g,i,j,l,m,n,o,p,q,r,s,t,u,v,w,x=!0;h.container.find(".picker-calendar-prev-month").on("click",h.prevMonth),h.container.find(".picker-calendar-next-month").on("click",h.nextMonth),h.container.find(".picker-calendar-prev-year").on("click",h.prevYear),h.container.find(".picker-calendar-next-year").on("click",h.nextYear),h.wrapper.on("click",f),h.params.touchMove&&(h.wrapper.on(a.touchEvents.start,c),h.wrapper.on(a.touchEvents.move,d),h.wrapper.on(a.touchEvents.end,e)),h.container[0].f7DestroyCalendarEvents=function(){h.container.find(".picker-calendar-prev-month").off("click",h.prevMonth),h.container.find(".picker-calendar-next-month").off("click",h.nextMonth),h.container.find(".picker-calendar-prev-year").off("click",h.prevYear),h.container.find(".picker-calendar-next-year").off("click",h.nextYear),h.wrapper.off("click",f),h.params.touchMove&&(h.wrapper.off(a.touchEvents.start,c),h.wrapper.off(a.touchEvents.move,d),h.wrapper.off(a.touchEvents.end,e))}},h.destroyCalendarEvents=function(a){"f7DestroyCalendarEvents"in h.container[0]&&h.container[0].f7DestroyCalendarEvents()},h.daysInMonth=function(a){var b=new Date(a);return new Date(b.getFullYear(),b.getMonth()+1,0).getDate()},h.monthHTML=function(a,b){a=new Date(a);var c=a.getFullYear(),d=a.getMonth();a.getDate();"next"===b&&(a=11===d?new Date(c+1,0):new Date(c,d+1,1)),"prev"===b&&(a=0===d?new Date(c-1,11):new Date(c,d-1,1)),("next"===b||"prev"===b)&&(d=a.getMonth(),c=a.getFullYear());var e=h.daysInMonth(new Date(a.getFullYear(),a.getMonth()).getTime()-864e6),f=h.daysInMonth(a),g=new Date(a.getFullYear(),a.getMonth()).getDay();0===g&&(g=7);var i,j,k,l=[],m=6,n=7,o="",p=0+(h.params.firstDay-1),q=(new Date).setHours(0,0,0,0),r=h.params.minDate?new Date(h.params.minDate).getTime():null,s=h.params.maxDate?new Date(h.params.maxDate).getTime():null;if(h.value&&h.value.length)for(j=0;j<h.value.length;j++)l.push(new Date(h.value[j]).setHours(0,0,0,0));for(j=1;m>=j;j++){var t="";for(k=1;n>=k;k++){var u=k;p++;var v=p-g,w="";0>v?(v=e+v+1,w+=" picker-calendar-day-prev",i=new Date(0>d-1?c-1:c,0>d-1?11:d-1,v).getTime()):(v+=1,v>f?(v-=f,w+=" picker-calendar-day-next",i=new Date(d+1>11?c+1:c,d+1>11?0:d+1,v).getTime()):i=new Date(c,d,v).getTime()),i===q&&(w+=" picker-calendar-day-today"),l.indexOf(i)>=0&&(w+=" picker-calendar-day-selected"),h.params.weekendDays.indexOf(u-1)>=0&&(w+=" picker-calendar-day-weekend"),(r&&r>i||s&&i>s)&&(w+=" picker-calendar-day-disabled"),i=new Date(i);var x=i.getFullYear(),y=i.getMonth();t+='<div data-year="'+x+'" data-month="'+y+'" data-day="'+v+'" class="picker-calendar-day'+w+'" data-date="'+(x+"-"+y+"-"+v)+'"><span>'+v+"</span></div>"}o+='<div class="picker-calendar-row">'+t+"</div>"}return o='<div class="picker-calendar-month" data-year="'+c+'" data-month="'+d+'">'+o+"</div>"},h.animating=!1,h.updateCurrentMonthYear=function(a){"undefined"==typeof a?(h.currentMonth=parseInt(h.months.eq(1).attr("data-month"),10),h.currentYear=parseInt(h.months.eq(1).attr("data-year"),10)):(h.currentMonth=parseInt(h.months.eq("next"===a?h.months.length-1:0).attr("data-month"),10),h.currentYear=parseInt(h.months.eq("next"===a?h.months.length-1:0).attr("data-year"),10)),h.container.find(".current-month-value").text(h.params.monthNames[h.currentMonth]),h.container.find(".current-year-value").text(h.currentYear)},h.onMonthChangeStart=function(a){h.updateCurrentMonthYear(a),h.months.removeClass("picker-calendar-month-current picker-calendar-month-prev picker-calendar-month-next");var b="next"===a?h.months.length-1:0;h.months.eq(b).addClass("picker-calendar-month-current"),h.months.eq("next"===a?b-1:b+1).addClass("next"===a?"picker-calendar-month-prev":"picker-calendar-month-next"),h.params.onMonthYearChangeStart&&h.params.onMonthYearChangeStart(h,h.currentYear,h.currentMonth)},h.onMonthChangeEnd=function(a,b){h.animating=!1;var c,d,e;h.wrapper.find(".picker-calendar-month:not(.picker-calendar-month-prev):not(.picker-calendar-month-current):not(.picker-calendar-month-next)").remove(),"undefined"==typeof a&&(a="next",b=!0),b?(h.wrapper.find(".picker-calendar-month-next, .picker-calendar-month-prev").remove(),d=h.monthHTML(new Date(h.currentYear,h.currentMonth),"prev"),c=h.monthHTML(new Date(h.currentYear,h.currentMonth),"next")):e=h.monthHTML(new Date(h.currentYear,h.currentMonth),a),("next"===a||b)&&h.wrapper.append(e||c),("prev"===a||b)&&h.wrapper.prepend(e||d),h.months=h.wrapper.find(".picker-calendar-month"),h.setMonthsTranslate(h.monthsTranslate),h.params.onMonthAdd&&h.params.onMonthAdd(h,"next"===a?h.months.eq(h.months.length-1)[0]:h.months.eq(0)[0]),h.params.onMonthYearChangeEnd&&h.params.onMonthYearChangeEnd(h,h.currentYear,h.currentMonth);
},h.setMonthsTranslate=function(a){a=a||h.monthsTranslate||0,"undefined"==typeof h.monthsTranslate&&(h.monthsTranslate=a),h.months.removeClass("picker-calendar-month-current picker-calendar-month-prev picker-calendar-month-next");var b=100*-(a+1)*k,c=100*-a*k,d=100*-(a-1)*k;h.months.eq(0).transform("translate3d("+(h.isH?b:0)+"%, "+(h.isH?0:b)+"%, 0)").addClass("picker-calendar-month-prev"),h.months.eq(1).transform("translate3d("+(h.isH?c:0)+"%, "+(h.isH?0:c)+"%, 0)").addClass("picker-calendar-month-current"),h.months.eq(2).transform("translate3d("+(h.isH?d:0)+"%, "+(h.isH?0:d)+"%, 0)").addClass("picker-calendar-month-next")},h.nextMonth=function(b){("undefined"==typeof b||"object"==typeof b)&&(b="",h.params.animate||(b=0));var c=parseInt(h.months.eq(h.months.length-1).attr("data-month"),10),d=parseInt(h.months.eq(h.months.length-1).attr("data-year"),10),e=new Date(d,c),f=e.getTime(),g=h.animating?!1:!0;if(h.params.maxDate&&f>new Date(h.params.maxDate).getTime())return h.resetMonth();if(h.monthsTranslate--,c===h.currentMonth){var i=100*-h.monthsTranslate*k,j=a(h.monthHTML(f,"next")).transform("translate3d("+(h.isH?i:0)+"%, "+(h.isH?0:i)+"%, 0)").addClass("picker-calendar-month-next");h.wrapper.append(j[0]),h.months=h.wrapper.find(".picker-calendar-month"),h.params.onMonthAdd&&h.params.onMonthAdd(h,h.months.eq(h.months.length-1)[0])}h.animating=!0,h.onMonthChangeStart("next");var l=100*h.monthsTranslate*k;h.wrapper.transition(b).transform("translate3d("+(h.isH?l:0)+"%, "+(h.isH?0:l)+"%, 0)"),g&&h.wrapper.transitionEnd(function(){h.onMonthChangeEnd("next")}),h.params.animate||h.onMonthChangeEnd("next")},h.prevMonth=function(b){("undefined"==typeof b||"object"==typeof b)&&(b="",h.params.animate||(b=0));var c=parseInt(h.months.eq(0).attr("data-month"),10),d=parseInt(h.months.eq(0).attr("data-year"),10),e=new Date(d,c+1,-1),f=e.getTime(),g=h.animating?!1:!0;if(h.params.minDate&&f<new Date(h.params.minDate).getTime())return h.resetMonth();if(h.monthsTranslate++,c===h.currentMonth){var i=100*-h.monthsTranslate*k,j=a(h.monthHTML(f,"prev")).transform("translate3d("+(h.isH?i:0)+"%, "+(h.isH?0:i)+"%, 0)").addClass("picker-calendar-month-prev");h.wrapper.prepend(j[0]),h.months=h.wrapper.find(".picker-calendar-month"),h.params.onMonthAdd&&h.params.onMonthAdd(h,h.months.eq(0)[0])}h.animating=!0,h.onMonthChangeStart("prev");var l=100*h.monthsTranslate*k;h.wrapper.transition(b).transform("translate3d("+(h.isH?l:0)+"%, "+(h.isH?0:l)+"%, 0)"),g&&h.wrapper.transitionEnd(function(){h.onMonthChangeEnd("prev")}),h.params.animate||h.onMonthChangeEnd("prev")},h.resetMonth=function(a){"undefined"==typeof a&&(a="");var b=100*h.monthsTranslate*k;h.wrapper.transition(a).transform("translate3d("+(h.isH?b:0)+"%, "+(h.isH?0:b)+"%, 0)")},h.setYearMonth=function(a,b,c){"undefined"==typeof a&&(a=h.currentYear),"undefined"==typeof b&&(b=h.currentMonth),("undefined"==typeof c||"object"==typeof c)&&(c="",h.params.animate||(c=0));var d;if(d=a<h.currentYear?new Date(a,b+1,-1).getTime():new Date(a,b).getTime(),h.params.maxDate&&d>new Date(h.params.maxDate).getTime())return!1;if(h.params.minDate&&d<new Date(h.params.minDate).getTime())return!1;var e=new Date(h.currentYear,h.currentMonth).getTime(),f=d>e?"next":"prev",g=h.monthHTML(new Date(a,b));h.monthsTranslate=h.monthsTranslate||0;var i,j,l=h.monthsTranslate,m=h.animating?!1:!0;d>e?(h.monthsTranslate--,h.animating||h.months.eq(h.months.length-1).remove(),h.wrapper.append(g),h.months=h.wrapper.find(".picker-calendar-month"),i=100*-(l-1)*k,h.months.eq(h.months.length-1).transform("translate3d("+(h.isH?i:0)+"%, "+(h.isH?0:i)+"%, 0)").addClass("picker-calendar-month-next")):(h.monthsTranslate++,h.animating||h.months.eq(0).remove(),h.wrapper.prepend(g),h.months=h.wrapper.find(".picker-calendar-month"),i=100*-(l+1)*k,h.months.eq(0).transform("translate3d("+(h.isH?i:0)+"%, "+(h.isH?0:i)+"%, 0)").addClass("picker-calendar-month-prev")),h.params.onMonthAdd&&h.params.onMonthAdd(h,"next"===f?h.months.eq(h.months.length-1)[0]:h.months.eq(0)[0]),h.animating=!0,h.onMonthChangeStart(f),j=100*h.monthsTranslate*k,h.wrapper.transition(c).transform("translate3d("+(h.isH?j:0)+"%, "+(h.isH?0:j)+"%, 0)"),m&&h.wrapper.transitionEnd(function(){h.onMonthChangeEnd(f,!0)}),h.params.animate||h.onMonthChangeEnd(f)},h.nextYear=function(){h.setYearMonth(h.currentYear+1)},h.prevYear=function(){h.setYearMonth(h.currentYear-1)},h.layout=function(){var a,b="",c="",d=h.value&&h.value.length?h.value[0]:(new Date).setHours(0,0,0,0),e=h.monthHTML(d,"prev"),f=h.monthHTML(d),g=h.monthHTML(d,"next"),i='<div class="picker-calendar-months"><div class="picker-calendar-months-wrapper">'+(e+f+g)+"</div></div>",j="";if(h.params.weekHeader){for(a=0;7>a;a++){var k=a+h.params.firstDay>6?a-7+h.params.firstDay:a+h.params.firstDay,l=h.params.dayNamesShort[k];j+='<div class="picker-calendar-week-day '+(h.params.weekendDays.indexOf(k)>=0?"picker-calendar-week-day-weekend":"")+'"> '+l+"</div>"}j='<div class="picker-calendar-week-days">'+j+"</div>"}c="picker-modal picker-calendar "+(h.params.cssClass||"");var m=h.params.toolbar?h.params.toolbarTemplate.replace(/{{closeText}}/g,h.params.toolbarCloseText):"";h.params.toolbar&&(m=h.params.toolbarTemplate.replace(/{{closeText}}/g,h.params.toolbarCloseText).replace(/{{monthPicker}}/g,h.params.monthPicker?h.params.monthPickerTemplate:"").replace(/{{yearPicker}}/g,h.params.yearPicker?h.params.yearPickerTemplate:"")),b='<div class="'+c+'">'+m+'<div class="picker-modal-inner">'+j+i+"</div></div>",h.pickerHTML=b},h.params.input&&(h.input=a(h.params.input),h.input.length>0&&(h.params.inputReadOnly&&h.input.prop("readOnly",!0),h.inline||h.input.on("click",e))),h.inline||a("html").on("click",f),h.opened=!1,h.open=function(){var b=!1;h.opened||(h.value||h.params.value&&(h.value=h.params.value,b=!0),h.layout(),h.inline?(h.container=a(h.pickerHTML),h.container.addClass("picker-modal-inline"),a(h.params.container).append(h.container)):(h.container=a(a.pickerModal(h.pickerHTML)),a(h.container).on("close",function(){g()})),h.container[0].f7Calendar=h,h.wrapper=h.container.find(".picker-calendar-months-wrapper"),h.months=h.wrapper.find(".picker-calendar-month"),h.updateCurrentMonthYear(),h.monthsTranslate=0,h.setMonthsTranslate(),h.initCalendarEvents(),b&&h.updateValue()),h.opened=!0,h.initialized=!0,h.params.onMonthAdd&&h.months.each(function(){h.params.onMonthAdd(h,this)}),h.params.onOpen&&h.params.onOpen(h)},h.close=function(){h.opened&&!h.inline&&a.closeModal(h.container)},h.destroy=function(){h.close(),h.params.input&&h.input.length>0&&h.input.off("click",e),a("html").off("click",f)},h.inline&&h.open(),h};a.fn.calendar=function(b){return this.each(function(){var d=a(this);if(d[0]){var e={};"INPUT"===d[0].tagName.toUpperCase()?e.input=d:e.container=d,new c(a.extend(e,b))}})},a.initCalendar=function(b){var c=a(b?b:document.body);c.find("[data-toggle='date']").each(function(){a(this).calendar()})}}(Zepto),+function(a){"use strict";var b=function(b){function c(){if(g.opened)for(var a=0;a<g.cols.length;a++)g.cols[a].divider||(g.cols[a].calcSize(),g.cols[a].setValue(g.cols[a].value,0,!1))}function d(b){if(b.preventDefault(),a.device.isWeixin&&a.device.android&&g.params.inputReadOnly&&(this.focus(),this.blur()),!g.opened&&(g.open(),g.params.scrollToInput)){var c=g.input.parents(".content");if(0===c.length)return;var d,e=parseInt(c.css("padding-top"),10),f=parseInt(c.css("padding-bottom"),10),h=c[0].offsetHeight-e-g.container.height(),i=c[0].scrollHeight-e-g.container.height(),j=g.input.offset().top-e+g.input[0].offsetHeight;if(j>h){var k=c.scrollTop()+j-h;k+h>i&&(d=k+h-i+f,h===i&&(d=g.container.height()),c.css({"padding-bottom":d+"px"})),c.scrollTop(k,300)}}}function e(b){g.opened&&(g.input&&g.input.length>0?b.target!==g.input[0]&&0===a(b.target).parents(".picker-modal").length&&g.close():0===a(b.target).parents(".picker-modal").length&&g.close())}function f(){g.opened=!1,g.input&&g.input.length>0&&g.input.parents(".content").css({"padding-bottom":""}),g.params.onClose&&g.params.onClose(g),g.container.find(".picker-items-col").each(function(){g.destroyPickerCol(this)})}var g=this,h={updateValuesOnMomentum:!1,updateValuesOnTouchmove:!0,rotateEffect:!1,momentumRatio:7,freeMode:!1,scrollToInput:!0,inputReadOnly:!0,toolbar:!0,toolbarCloseText:"确定",toolbarTemplate:'<header class="bar bar-nav">                <button class="button button-link pull-right close-picker">确定</button>                <h1 class="title">请选择</h1>                </header>'};b=b||{};for(var i in h)"undefined"==typeof b[i]&&(b[i]=h[i]);g.params=b,g.cols=[],g.initialized=!1,g.inline=g.params.container?!0:!1;var j=a.device.ios||navigator.userAgent.toLowerCase().indexOf("safari")>=0&&navigator.userAgent.toLowerCase().indexOf("chrome")<0&&!a.device.android;return g.setValue=function(a,b){for(var c=0,d=0;d<g.cols.length;d++)g.cols[d]&&!g.cols[d].divider&&(g.cols[d].setValue(a[c],b),c++)},g.updateValue=function(){for(var b=[],c=[],d=0;d<g.cols.length;d++)g.cols[d].divider||(b.push(g.cols[d].value),c.push(g.cols[d].displayValue));b.indexOf(void 0)>=0||(g.value=b,g.displayValue=c,g.params.onChange&&g.params.onChange(g,g.value,g.displayValue),g.input&&g.input.length>0&&(a(g.input).val(g.params.formatValue?g.params.formatValue(g,g.value,g.displayValue):g.value.join(" ")),a(g.input).trigger("change")))},g.initPickerCol=function(b,c){function d(){s=a.requestAnimationFrame(function(){m.updateItems(void 0,void 0,0),d()})}function e(b){u||t||(b.preventDefault(),t=!0,v=w="touchstart"===b.type?b.targetTouches[0].pageY:b.pageY,x=(new Date).getTime(),F=!0,z=B=a.getTranslate(m.wrapper[0],"y"))}function f(b){if(t){b.preventDefault(),F=!1,w="touchmove"===b.type?b.targetTouches[0].pageY:b.pageY,u||(a.cancelAnimationFrame(s),u=!0,z=B=a.getTranslate(m.wrapper[0],"y"),m.wrapper.transition(0)),b.preventDefault();var c=w-v;B=z+c,A=void 0,q>B&&(B=q-Math.pow(q-B,.8),A="min"),B>r&&(B=r+Math.pow(B-r,.8),A="max"),m.wrapper.transform("translate3d(0,"+B+"px,0)"),m.updateItems(void 0,B,0,g.params.updateValuesOnTouchmove),D=B-C||B,E=(new Date).getTime(),C=B}}function h(b){if(!t||!u)return void(t=u=!1);t=u=!1,m.wrapper.transition(""),A&&("min"===A?m.wrapper.transform("translate3d(0,"+q+"px,0)"):m.wrapper.transform("translate3d(0,"+r+"px,0)")),y=(new Date).getTime();var c,e;y-x>300?e=B:(c=Math.abs(D/(y-E)),e=B+D*g.params.momentumRatio),e=Math.max(Math.min(e,r),q);var f=-Math.floor((e-r)/o);g.params.freeMode||(e=-f*o+r),m.wrapper.transform("translate3d(0,"+parseInt(e,10)+"px,0)"),m.updateItems(f,e,"",!0),g.params.updateValuesOnMomentum&&(d(),m.wrapper.transitionEnd(function(){a.cancelAnimationFrame(s)})),setTimeout(function(){F=!0},100)}function i(b){if(F){a.cancelAnimationFrame(s);var c=a(this).attr("data-picker-value");m.setValue(c)}}var k=a(b),l=k.index(),m=g.cols[l];if(!m.divider){m.container=k,m.wrapper=m.container.find(".picker-items-col-wrapper"),m.items=m.wrapper.find(".picker-item");var n,o,p,q,r;m.replaceValues=function(a,b){m.destroyEvents(),m.values=a,m.displayValues=b;var c=g.columnHTML(m,!0);m.wrapper.html(c),m.items=m.wrapper.find(".picker-item"),m.calcSize(),m.setValue(m.values[0],0,!0),m.initEvents()},m.calcSize=function(){g.params.rotateEffect&&(m.container.removeClass("picker-items-col-absolute"),m.width||m.container.css({width:""}));var b,c;b=0,c=m.container[0].offsetHeight,n=m.wrapper[0].offsetHeight,o=m.items[0].offsetHeight,p=o*m.items.length,q=c/2-p+o/2,r=c/2-o/2,m.width&&(b=m.width,parseInt(b,10)===b&&(b+="px"),m.container.css({width:b})),g.params.rotateEffect&&(m.width||(m.items.each(function(){var c=a(this);c.css({width:"auto"}),b=Math.max(b,c[0].offsetWidth),c.css({width:""})}),m.container.css({width:b+2+"px"})),m.container.addClass("picker-items-col-absolute"))},m.calcSize(),m.wrapper.transform("translate3d(0,"+r+"px,0)").transition(0);var s;m.setValue=function(b,c,e){"undefined"==typeof c&&(c="");var f=m.wrapper.find('.picker-item[data-picker-value="'+b+'"]').index();if("undefined"!=typeof f&&-1!==f){var h=-f*o+r;m.wrapper.transition(c),m.wrapper.transform("translate3d(0,"+h+"px,0)"),g.params.updateValuesOnMomentum&&m.activeIndex&&m.activeIndex!==f&&(a.cancelAnimationFrame(s),m.wrapper.transitionEnd(function(){a.cancelAnimationFrame(s)}),d()),m.updateItems(f,h,c,e)}},m.updateItems=function(b,c,d,e){"undefined"==typeof c&&(c=a.getTranslate(m.wrapper[0],"y")),"undefined"==typeof b&&(b=-Math.round((c-r)/o)),0>b&&(b=0),b>=m.items.length&&(b=m.items.length-1);var f=m.activeIndex;m.activeIndex=b,m.wrapper.find(".picker-selected").removeClass("picker-selected"),g.params.rotateEffect&&m.items.transition(d);var h=m.items.eq(b).addClass("picker-selected").transform("");if((e||"undefined"==typeof e)&&(m.value=h.attr("data-picker-value"),m.displayValue=m.displayValues?m.displayValues[b]:m.value,f!==b&&(m.onChange&&m.onChange(g,m.value,m.displayValue),g.updateValue())),g.params.rotateEffect){(c-(Math.floor((c-r)/o)*o+r))/o;m.items.each(function(){var b=a(this),d=b.index()*o,e=r-c,f=d-e,g=f/o,h=Math.ceil(m.height/o/2)+1,i=-18*g;i>180&&(i=180),-180>i&&(i=-180),Math.abs(g)>h?b.addClass("picker-item-far"):b.removeClass("picker-item-far"),b.transform("translate3d(0, "+(-c+r)+"px, "+(j?-110:0)+"px) rotateX("+i+"deg)")})}},c&&m.updateItems(0,r,0);var t,u,v,w,x,y,z,A,B,C,D,E,F=!0;m.initEvents=function(b){var c=b?"off":"on";m.container[c](a.touchEvents.start,e),m.container[c](a.touchEvents.move,f),m.container[c](a.touchEvents.end,h),m.items[c]("click",i)},m.destroyEvents=function(){m.initEvents(!0)},m.container[0].f7DestroyPickerCol=function(){m.destroyEvents()},m.initEvents()}},g.destroyPickerCol=function(b){b=a(b),"f7DestroyPickerCol"in b[0]&&b[0].f7DestroyPickerCol()},a(window).on("resize",c),g.columnHTML=function(a,b){var c="",d="";if(a.divider)d+='<div class="picker-items-col picker-items-col-divider '+(a.textAlign?"picker-items-col-"+a.textAlign:"")+" "+(a.cssClass||"")+'">'+a.content+"</div>";else{for(var e=0;e<a.values.length;e++)c+='<div class="picker-item" data-picker-value="'+a.values[e]+'">'+(a.displayValues?a.displayValues[e]:a.values[e])+"</div>";d+='<div class="picker-items-col '+(a.textAlign?"picker-items-col-"+a.textAlign:"")+" "+(a.cssClass||"")+'"><div class="picker-items-col-wrapper">'+c+"</div></div>"}return b?c:d},g.layout=function(){var a,b="",c="";g.cols=[];var d="";for(a=0;a<g.params.cols.length;a++){var e=g.params.cols[a];d+=g.columnHTML(g.params.cols[a]),g.cols.push(e)}c="picker-modal picker-columns "+(g.params.cssClass||"")+(g.params.rotateEffect?" picker-3d":""),b='<div class="'+c+'">'+(g.params.toolbar?g.params.toolbarTemplate.replace(/{{closeText}}/g,g.params.toolbarCloseText):"")+'<div class="picker-modal-inner picker-items">'+d+'<div class="picker-center-highlight"></div></div></div>',g.pickerHTML=b},g.params.input&&(g.input=a(g.params.input),g.input.length>0&&(g.params.inputReadOnly&&g.input.prop("readOnly",!0),g.inline||g.input.on("click",d))),g.inline||a("html").on("click",e),g.opened=!1,g.open=function(){g.opened||(g.layout(),g.inline?(g.container=a(g.pickerHTML),g.container.addClass("picker-modal-inline"),a(g.params.container).append(g.container),g.opened=!0):(g.container=a(a.pickerModal(g.pickerHTML)),a(g.container).one("opened",function(){g.opened=!0}).on("close",function(){f()})),g.container[0].f7Picker=g,g.container.find(".picker-items-col").each(function(){var a=!0;(!g.initialized&&g.params.value||g.initialized&&g.value)&&(a=!1),g.initPickerCol(this,a)}),g.initialized?g.value&&g.setValue(g.value,0):g.params.value&&g.setValue(g.params.value,0)),g.initialized=!0,g.params.onOpen&&g.params.onOpen(g)},g.close=function(){g.opened&&!g.inline&&a.closeModal(g.container)},g.destroy=function(){g.close(),g.params.input&&g.input.length>0&&g.input.off("click",d),a("html").off("click",e),a(window).off("resize",c)},g.inline&&g.open(),g};a(document).on("click",".close-picker",function(){var b=a(".picker-modal.modal-in");a.closeModal(b)}),a.fn.picker=function(c){var d=arguments;return this.each(function(){if(this){var e=a(this),f=e.data("picker");if(!f){var g=a.extend({input:this,value:e.val()?e.val().split(" "):""},c);f=new b(g),e.data("picker",f)}"string"==typeof c&&f[c].apply(f,Array.prototype.slice.call(d,1))}})}}(Zepto),+function(a){"use strict";var b=new Date,c=function(a){for(var b=[],c=1;(a||31)>=c;c++)b.push(10>c?"0"+c:c);return b},d=function(a,b){var d=new Date(b,parseInt(a)+1-1,1),e=new Date(d-1);return c(e.getDate())},e=function(a){return 10>a?"0"+a:a},f="01 02 03 04 05 06 07 08 09 10 11 12".split(" "),g=function(){for(var a=[],b=1950;2030>=b;b++)a.push(b);return a}(),h={rotateEffect:!1,value:[b.getFullYear(),e(b.getMonth()+1),e(b.getDate()),b.getHours(),e(b.getMinutes())],onChange:function(a,b,c){var e=d(a.cols[1].value,a.cols[0].value),f=a.cols[2].value;f>e.length&&(f=e.length),a.cols[2].setValue(f)},formatValue:function(a,b,c){return c[0]+"-"+b[1]+"-"+b[2]+" "+b[3]+":"+b[4]},cols:[{values:g},{values:f},{values:c()},{divider:!0,content:"  "},{values:function(){for(var a=[],b=0;23>=b;b++)a.push(b);return a}()},{divider:!0,content:":"},{values:function(){for(var a=[],b=0;59>=b;b++)a.push(10>b?"0"+b:b);return a}()}]};a.fn.datetimePicker=function(b){return this.each(function(){if(this){var c=a.extend(h,b);a(this).picker(c),b.value&&a(this).val(c.formatValue(c,c.value,c.value))}})}}(Zepto),+function(a){"use strict";function b(a,b){this.wrapper="string"==typeof a?document.querySelector(a):a,this.scroller=$(this.wrapper).find(".content-inner")[0],this.scrollerStyle=this.scroller&&this.scroller.style,this.options={resizeScrollbars:!0,mouseWheelSpeed:20,snapThreshold:.334,startX:0,startY:0,scrollY:!0,directionLockThreshold:5,momentum:!0,bounce:!0,bounceTime:600,bounceEasing:"",preventDefault:!0,preventDefaultException:{tagName:/^(INPUT|TEXTAREA|BUTTON|SELECT)$/},HWCompositing:!0,useTransition:!0,useTransform:!0,eventPassthrough:void 0};for(var c in b)this.options[c]=b[c];this.translateZ=this.options.HWCompositing&&f.hasPerspective?" translateZ(0)":"",this.options.useTransition=f.hasTransition&&this.options.useTransition,this.options.useTransform=f.hasTransform&&this.options.useTransform,this.options.eventPassthrough=this.options.eventPassthrough===!0?"vertical":this.options.eventPassthrough,this.options.preventDefault=!this.options.eventPassthrough&&this.options.preventDefault,this.options.scrollY="vertical"===this.options.eventPassthrough?!1:this.options.scrollY,this.options.scrollX="horizontal"===this.options.eventPassthrough?!1:this.options.scrollX,this.options.freeScroll=this.options.freeScroll&&!this.options.eventPassthrough,this.options.directionLockThreshold=this.options.eventPassthrough?0:this.options.directionLockThreshold,this.options.bounceEasing="string"==typeof this.options.bounceEasing?f.ease[this.options.bounceEasing]||f.ease.circular:this.options.bounceEasing,this.options.resizePolling=void 0===this.options.resizePolling?60:this.options.resizePolling,this.options.tap===!0&&(this.options.tap="tap"),"scale"===this.options.shrinkScrollbars&&(this.options.useTransition=!1),this.options.invertWheelDirection=this.options.invertWheelDirection?-1:1,3===this.options.probeType&&(this.options.useTransition=!1),this.x=0,this.y=0,this.directionX=0,this.directionY=0,this._events={},this._init(),this.refresh(),this.scrollTo(this.options.startX,this.options.startY),this.enable()}function c(a,b,c){var d=document.createElement("div"),e=document.createElement("div");return c===!0&&(d.style.cssText="position:absolute;z-index:9999",e.style.cssText="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;position:absolute;background:rgba(0,0,0,0.5);border:1px solid rgba(255,255,255,0.9);border-radius:3px"),e.className="iScrollIndicator","h"===a?(c===!0&&(d.style.cssText+=";height:5px;left:2px;right:2px;bottom:0",e.style.height="100%"),d.className="iScrollHorizontalScrollbar"):(c===!0&&(d.style.cssText+=";width:5px;bottom:2px;top:2px;right:1px",e.style.width="100%"),d.className="iScrollVerticalScrollbar"),d.style.cssText+=";overflow:hidden",b||(d.style.pointerEvents="none"),d.appendChild(e),d}function d(b,c){this.wrapper="string"==typeof c.el?document.querySelector(c.el):c.el,this.wrapperStyle=this.wrapper.style,this.indicator=this.wrapper.children[0],this.indicatorStyle=this.indicator.style,this.scroller=b,this.options={listenX:!0,listenY:!0,interactive:!1,resize:!0,defaultScrollbars:!1,shrink:!1,fade:!1,speedRatioX:0,speedRatioY:0};for(var d in c)this.options[d]=c[d];this.sizeRatioX=1,this.sizeRatioY=1,this.maxPosX=0,this.maxPosY=0,this.options.interactive&&(this.options.disableTouch||(f.addEvent(this.indicator,"touchstart",this),f.addEvent(a,"touchend",this)),this.options.disablePointer||(f.addEvent(this.indicator,f.prefixPointerEvent("pointerdown"),this),f.addEvent(a,f.prefixPointerEvent("pointerup"),this)),this.options.disableMouse||(f.addEvent(this.indicator,"mousedown",this),f.addEvent(a,"mouseup",this))),this.options.fade&&(this.wrapperStyle[f.style.transform]=this.scroller.translateZ,this.wrapperStyle[f.style.transitionDuration]=f.isBadAndroid?"0.001s":"0ms",this.wrapperStyle.opacity="0")}var e=a.requestAnimationFrame||a.webkitRequestAnimationFrame||a.mozRequestAnimationFrame||a.oRequestAnimationFrame||a.msRequestAnimationFrame||function(b){a.setTimeout(b,1e3/60)},f=function(){function b(a){return f===!1?!1:""===f?a:f+a.charAt(0).toUpperCase()+a.substr(1)}var c={},d=document.createElement("div").style,f=function(){for(var a,b=["t","webkitT","MozT","msT","OT"],c=0,e=b.length;e>c;c++)if(a=b[c]+"ransform",a in d)return b[c].substr(0,b[c].length-1);return!1}();c.getTime=Date.now||function(){return(new Date).getTime()},c.extend=function(a,b){for(var c in b)a[c]=b[c]},c.addEvent=function(a,b,c,d){a.addEventListener(b,c,!!d)},c.removeEvent=function(a,b,c,d){a.removeEventListener(b,c,!!d)},c.prefixPointerEvent=function(b){return a.MSPointerEvent?"MSPointer"+b.charAt(9).toUpperCase()+b.substr(10):b},c.momentum=function(a,b,c,d,f,g,h){function i(){+new Date-o>50&&(h._execEvent("scroll"),o=+new Date),+new Date-n<k&&e(i)}var j,k,l=a-b,m=Math.abs(l)/c;m/=2,m=m>1.5?1.5:m,g=void 0===g?6e-4:g,j=a+m*m/(2*g)*(0>l?-1:1),k=m/g,d>j?(j=f?d-f/2.5*(m/8):d,l=Math.abs(j-a),k=l/m):j>0&&(j=f?f/2.5*(m/8):0,l=Math.abs(a)+j,k=l/m);var n=+new Date,o=n;return e(i),{destination:Math.round(j),duration:k}};var g=b("transform");return c.extend(c,{hasTransform:g!==!1,hasPerspective:b("perspective")in d,hasTouch:"ontouchstart"in a,hasPointer:a.PointerEvent||a.MSPointerEvent,hasTransition:b("transition")in d}),c.isBadAndroid=/Android /.test(a.navigator.appVersion)&&!/Chrome\/\d/.test(a.navigator.appVersion)&&!1,c.extend(c.style={},{transform:g,transitionTimingFunction:b("transitionTimingFunction"),transitionDuration:b("transitionDuration"),transitionDelay:b("transitionDelay"),transformOrigin:b("transformOrigin")}),c.hasClass=function(a,b){var c=new RegExp("(^|\\s)"+b+"(\\s|$)");return c.test(a.className)},c.addClass=function(a,b){if(!c.hasClass(a,b)){var d=a.className.split(" ");d.push(b),a.className=d.join(" ")}},c.removeClass=function(a,b){if(c.hasClass(a,b)){var d=new RegExp("(^|\\s)"+b+"(\\s|$)","g");a.className=a.className.replace(d," ")}},c.offset=function(a){for(var b=-a.offsetLeft,c=-a.offsetTop;a=a.offsetParent;)b-=a.offsetLeft,c-=a.offsetTop;return{left:b,top:c}},c.preventDefaultException=function(a,b){for(var c in b)if(b[c].test(a[c]))return!0;return!1},c.extend(c.eventType={},{touchstart:1,touchmove:1,touchend:1,mousedown:2,mousemove:2,mouseup:2,pointerdown:3,pointermove:3,pointerup:3,MSPointerDown:3,MSPointerMove:3,MSPointerUp:3}),c.extend(c.ease={},{quadratic:{style:"cubic-bezier(0.25, 0.46, 0.45, 0.94)",fn:function(a){return a*(2-a)}},circular:{style:"cubic-bezier(0.1, 0.57, 0.1, 1)",fn:function(a){return Math.sqrt(1- --a*a)}},back:{style:"cubic-bezier(0.175, 0.885, 0.32, 1.275)",fn:function(a){var b=4;return(a-=1)*a*((b+1)*a+b)+1}},bounce:{style:"",fn:function(a){return(a/=1)<1/2.75?7.5625*a*a:2/2.75>a?7.5625*(a-=1.5/2.75)*a+.75:2.5/2.75>a?7.5625*(a-=2.25/2.75)*a+.9375:7.5625*(a-=2.625/2.75)*a+.984375}},elastic:{style:"",fn:function(a){var b=.22,c=.4;return 0===a?0:1===a?1:c*Math.pow(2,-10*a)*Math.sin((a-b/4)*(2*Math.PI)/b)+1}}}),c.tap=function(a,b){var c=document.createEvent("Event");c.initEvent(b,!0,!0),c.pageX=a.pageX,c.pageY=a.pageY,a.target.dispatchEvent(c)},c.click=function(a){var b,c=a.target;/(SELECT|INPUT|TEXTAREA)/i.test(c.tagName)||(b=document.createEvent("MouseEvents"),b.initMouseEvent("click",!0,!0,a.view,1,c.screenX,c.screenY,c.clientX,c.clientY,a.ctrlKey,a.altKey,a.shiftKey,a.metaKey,0,null),b._constructed=!0,c.dispatchEvent(b))},c}();b.prototype={version:"5.1.3",_init:function(){this._initEvents(),(this.options.scrollbars||this.options.indicators)&&this._initIndicators(),this.options.mouseWheel&&this._initWheel(),this.options.snap&&this._initSnap(),this.options.keyBindings&&this._initKeys()},destroy:function(){this._initEvents(!0),this._execEvent("destroy")},_transitionEnd:function(a){a.target===this.scroller&&this.isInTransition&&(this._transitionTime(),this.resetPosition(this.options.bounceTime)||(this.isInTransition=!1,this._execEvent("scrollEnd")))},_start:function(a){if((1===f.eventType[a.type]||0===a.button)&&this.enabled&&(!this.initiated||f.eventType[a.type]===this.initiated)){!this.options.preventDefault||f.isBadAndroid||f.preventDefaultException(a.target,this.options.preventDefaultException)||a.preventDefault();var b,c=a.touches?a.touches[0]:a;this.initiated=f.eventType[a.type],this.moved=!1,this.distX=0,this.distY=0,this.directionX=0,this.directionY=0,this.directionLocked=0,this._transitionTime(),this.startTime=f.getTime(),this.options.useTransition&&this.isInTransition?(this.isInTransition=!1,b=this.getComputedPosition(),this._translate(Math.round(b.x),Math.round(b.y)),this._execEvent("scrollEnd")):!this.options.useTransition&&this.isAnimating&&(this.isAnimating=!1,this._execEvent("scrollEnd")),this.startX=this.x,this.startY=this.y,this.absStartX=this.x,this.absStartY=this.y,this.pointX=c.pageX,this.pointY=c.pageY,this._execEvent("beforeScrollStart")}},_move:function(a){if(this.enabled&&f.eventType[a.type]===this.initiated){this.options.preventDefault&&a.preventDefault();var b,c,d,e,g=a.touches?a.touches[0]:a,h=g.pageX-this.pointX,i=g.pageY-this.pointY,j=f.getTime();if(this.pointX=g.pageX,this.pointY=g.pageY,this.distX+=h,this.distY+=i,d=Math.abs(this.distX),e=Math.abs(this.distY),!(j-this.endTime>300&&10>d&&10>e)){if(this.directionLocked||this.options.freeScroll||(d>e+this.options.directionLockThreshold?this.directionLocked="h":e>=d+this.options.directionLockThreshold?this.directionLocked="v":this.directionLocked="n"),"h"===this.directionLocked){if("vertical"===this.options.eventPassthrough)a.preventDefault();else if("horizontal"===this.options.eventPassthrough)return void(this.initiated=!1);i=0}else if("v"===this.directionLocked){if("horizontal"===this.options.eventPassthrough)a.preventDefault();else if("vertical"===this.options.eventPassthrough)return void(this.initiated=!1);h=0}h=this.hasHorizontalScroll?h:0,i=this.hasVerticalScroll?i:0,b=this.x+h,c=this.y+i,(b>0||b<this.maxScrollX)&&(b=this.options.bounce?this.x+h/3:b>0?0:this.maxScrollX),(c>0||c<this.maxScrollY)&&(c=this.options.bounce?this.y+i/3:c>0?0:this.maxScrollY),this.directionX=h>0?-1:0>h?1:0,this.directionY=i>0?-1:0>i?1:0,this.moved||this._execEvent("scrollStart"),this.moved=!0,this._translate(b,c),j-this.startTime>300&&(this.startTime=j,this.startX=this.x,this.startY=this.y,1===this.options.probeType&&this._execEvent("scroll")),this.options.probeType>1&&this._execEvent("scroll")}}},_end:function(a){if(this.enabled&&f.eventType[a.type]===this.initiated){this.options.preventDefault&&!f.preventDefaultException(a.target,this.options.preventDefaultException)&&a.preventDefault();var b,c,d=f.getTime()-this.startTime,e=Math.round(this.x),g=Math.round(this.y),h=Math.abs(e-this.startX),i=Math.abs(g-this.startY),j=0,k="";if(this.isInTransition=0,this.initiated=0,this.endTime=f.getTime(),!this.resetPosition(this.options.bounceTime)){if(this.scrollTo(e,g),!this.moved)return this.options.tap&&f.tap(a,this.options.tap),this.options.click&&f.click(a),void this._execEvent("scrollCancel");if(this._events.flick&&200>d&&100>h&&100>i)return void this._execEvent("flick");if(this.options.momentum&&300>d&&(b=this.hasHorizontalScroll?f.momentum(this.x,this.startX,d,this.maxScrollX,this.options.bounce?this.wrapperWidth:0,this.options.deceleration,this):{destination:e,duration:0},c=this.hasVerticalScroll?f.momentum(this.y,this.startY,d,this.maxScrollY,this.options.bounce?this.wrapperHeight:0,this.options.deceleration,this):{destination:g,duration:0},e=b.destination,g=c.destination,j=Math.max(b.duration,c.duration),this.isInTransition=1),this.options.snap){var l=this._nearestSnap(e,g);this.currentPage=l,j=this.options.snapSpeed||Math.max(Math.max(Math.min(Math.abs(e-l.x),1e3),Math.min(Math.abs(g-l.y),1e3)),300),e=l.x,g=l.y,this.directionX=0,this.directionY=0,k=this.options.bounceEasing}return e!==this.x||g!==this.y?((e>0||e<this.maxScrollX||g>0||g<this.maxScrollY)&&(k=f.ease.quadratic),void this.scrollTo(e,g,j,k)):void this._execEvent("scrollEnd")}}},_resize:function(){var a=this;clearTimeout(this.resizeTimeout),this.resizeTimeout=setTimeout(function(){a.refresh()},this.options.resizePolling)},resetPosition:function(b){var c=this.x,d=this.y;if(b=b||0,!this.hasHorizontalScroll||this.x>0?c=0:this.x<this.maxScrollX&&(c=this.maxScrollX),!this.hasVerticalScroll||this.y>0?d=0:this.y<this.maxScrollY&&(d=this.maxScrollY),c===this.x&&d===this.y)return!1;if(this.options.ptr&&this.y>44&&-1*this.startY<$(a).height()&&!this.ptrLock){d=this.options.ptrOffset||44,this._execEvent("ptr"),this.ptrLock=!0;var e=this;setTimeout(function(){e.ptrLock=!1},500)}return this.scrollTo(c,d,b,this.options.bounceEasing),!0},disable:function(){this.enabled=!1},enable:function(){this.enabled=!0},refresh:function(){this.wrapperWidth=this.wrapper.clientWidth,this.wrapperHeight=this.wrapper.clientHeight,this.scrollerWidth=this.scroller.offsetWidth,this.scrollerHeight=this.scroller.offsetHeight,this.maxScrollX=this.wrapperWidth-this.scrollerWidth,this.maxScrollY=this.wrapperHeight-this.scrollerHeight,this.hasHorizontalScroll=this.options.scrollX&&this.maxScrollX<0,this.hasVerticalScroll=this.options.scrollY&&this.maxScrollY<0,this.hasHorizontalScroll||(this.maxScrollX=0,this.scrollerWidth=this.wrapperWidth),this.hasVerticalScroll||(this.maxScrollY=0,this.scrollerHeight=this.wrapperHeight),this.endTime=0,this.directionX=0,this.directionY=0,this.wrapperOffset=f.offset(this.wrapper),this._execEvent("refresh"),this.resetPosition()},on:function(a,b){this._events[a]||(this._events[a]=[]),this._events[a].push(b)},off:function(a,b){if(this._events[a]){var c=this._events[a].indexOf(b);c>-1&&this._events[a].splice(c,1)}},_execEvent:function(a){if(this._events[a]){var b=0,c=this._events[a].length;if(c)for(;c>b;b++)this._events[a][b].apply(this,[].slice.call(arguments,1))}},scrollBy:function(a,b,c,d){a=this.x+a,b=this.y+b,c=c||0,this.scrollTo(a,b,c,d)},scrollTo:function(a,b,c,d){d=d||f.ease.circular,this.isInTransition=this.options.useTransition&&c>0,!c||this.options.useTransition&&d.style?(this._transitionTimingFunction(d.style),this._transitionTime(c),this._translate(a,b)):this._animate(a,b,c,d.fn)},scrollToElement:function(a,b,c,d,e){if(a=a.nodeType?a:this.scroller.querySelector(a)){var g=f.offset(a);g.left-=this.wrapperOffset.left,g.top-=this.wrapperOffset.top,c===!0&&(c=Math.round(a.offsetWidth/2-this.wrapper.offsetWidth/2)),d===!0&&(d=Math.round(a.offsetHeight/2-this.wrapper.offsetHeight/2)),g.left-=c||0,g.top-=d||0,g.left=g.left>0?0:g.left<this.maxScrollX?this.maxScrollX:g.left,g.top=g.top>0?0:g.top<this.maxScrollY?this.maxScrollY:g.top,b=void 0===b||null===b||"auto"===b?Math.max(Math.abs(this.x-g.left),Math.abs(this.y-g.top)):b,this.scrollTo(g.left,g.top,b,e)}},_transitionTime:function(a){if(a=a||0,this.scrollerStyle[f.style.transitionDuration]=a+"ms",!a&&f.isBadAndroid&&(this.scrollerStyle[f.style.transitionDuration]="0.001s"),
this.indicators)for(var b=this.indicators.length;b--;)this.indicators[b].transitionTime(a)},_transitionTimingFunction:function(a){if(this.scrollerStyle[f.style.transitionTimingFunction]=a,this.indicators)for(var b=this.indicators.length;b--;)this.indicators[b].transitionTimingFunction(a)},_translate:function(a,b){if(this.options.useTransform?this.scrollerStyle[f.style.transform]="translate("+a+"px,"+b+"px)"+this.translateZ:(a=Math.round(a),b=Math.round(b),this.scrollerStyle.left=a+"px",this.scrollerStyle.top=b+"px"),this.x=a,this.y=b,this.indicators)for(var c=this.indicators.length;c--;)this.indicators[c].updatePosition()},_initEvents:function(b){var c=b?f.removeEvent:f.addEvent,d=this.options.bindToWrapper?this.wrapper:a;c(a,"orientationchange",this),c(a,"resize",this),this.options.click&&c(this.wrapper,"click",this,!0),this.options.disableMouse||(c(this.wrapper,"mousedown",this),c(d,"mousemove",this),c(d,"mousecancel",this),c(d,"mouseup",this)),f.hasPointer&&!this.options.disablePointer&&(c(this.wrapper,f.prefixPointerEvent("pointerdown"),this),c(d,f.prefixPointerEvent("pointermove"),this),c(d,f.prefixPointerEvent("pointercancel"),this),c(d,f.prefixPointerEvent("pointerup"),this)),f.hasTouch&&!this.options.disableTouch&&(c(this.wrapper,"touchstart",this),c(d,"touchmove",this),c(d,"touchcancel",this),c(d,"touchend",this)),c(this.scroller,"transitionend",this),c(this.scroller,"webkitTransitionEnd",this),c(this.scroller,"oTransitionEnd",this),c(this.scroller,"MSTransitionEnd",this)},getComputedPosition:function(){var b,c,d=a.getComputedStyle(this.scroller,null);return this.options.useTransform?(d=d[f.style.transform].split(")")[0].split(", "),b=+(d[12]||d[4]),c=+(d[13]||d[5])):(b=+d.left.replace(/[^-\d.]/g,""),c=+d.top.replace(/[^-\d.]/g,"")),{x:b,y:c}},_initIndicators:function(){function a(a){for(var b=h.indicators.length;b--;)a.call(h.indicators[b])}var b,e=this.options.interactiveScrollbars,f="string"!=typeof this.options.scrollbars,g=[],h=this;this.indicators=[],this.options.scrollbars&&(this.options.scrollY&&(b={el:c("v",e,this.options.scrollbars),interactive:e,defaultScrollbars:!0,customStyle:f,resize:this.options.resizeScrollbars,shrink:this.options.shrinkScrollbars,fade:this.options.fadeScrollbars,listenX:!1},this.wrapper.appendChild(b.el),g.push(b)),this.options.scrollX&&(b={el:c("h",e,this.options.scrollbars),interactive:e,defaultScrollbars:!0,customStyle:f,resize:this.options.resizeScrollbars,shrink:this.options.shrinkScrollbars,fade:this.options.fadeScrollbars,listenY:!1},this.wrapper.appendChild(b.el),g.push(b))),this.options.indicators&&(g=g.concat(this.options.indicators));for(var i=g.length;i--;)this.indicators.push(new d(this,g[i]));this.options.fadeScrollbars&&(this.on("scrollEnd",function(){a(function(){this.fade()})}),this.on("scrollCancel",function(){a(function(){this.fade()})}),this.on("scrollStart",function(){a(function(){this.fade(1)})}),this.on("beforeScrollStart",function(){a(function(){this.fade(1,!0)})})),this.on("refresh",function(){a(function(){this.refresh()})}),this.on("destroy",function(){a(function(){this.destroy()}),delete this.indicators})},_initWheel:function(){f.addEvent(this.wrapper,"wheel",this),f.addEvent(this.wrapper,"mousewheel",this),f.addEvent(this.wrapper,"DOMMouseScroll",this),this.on("destroy",function(){f.removeEvent(this.wrapper,"wheel",this),f.removeEvent(this.wrapper,"mousewheel",this),f.removeEvent(this.wrapper,"DOMMouseScroll",this)})},_wheel:function(a){if(this.enabled){a.preventDefault(),a.stopPropagation();var b,c,d,e,f=this;if(void 0===this.wheelTimeout&&f._execEvent("scrollStart"),clearTimeout(this.wheelTimeout),this.wheelTimeout=setTimeout(function(){f._execEvent("scrollEnd"),f.wheelTimeout=void 0},400),"deltaX"in a)1===a.deltaMode?(b=-a.deltaX*this.options.mouseWheelSpeed,c=-a.deltaY*this.options.mouseWheelSpeed):(b=-a.deltaX,c=-a.deltaY);else if("wheelDeltaX"in a)b=a.wheelDeltaX/120*this.options.mouseWheelSpeed,c=a.wheelDeltaY/120*this.options.mouseWheelSpeed;else if("wheelDelta"in a)b=c=a.wheelDelta/120*this.options.mouseWheelSpeed;else{if(!("detail"in a))return;b=c=-a.detail/3*this.options.mouseWheelSpeed}if(b*=this.options.invertWheelDirection,c*=this.options.invertWheelDirection,this.hasVerticalScroll||(b=c,c=0),this.options.snap)return d=this.currentPage.pageX,e=this.currentPage.pageY,b>0?d--:0>b&&d++,c>0?e--:0>c&&e++,void this.goToPage(d,e);d=this.x+Math.round(this.hasHorizontalScroll?b:0),e=this.y+Math.round(this.hasVerticalScroll?c:0),d>0?d=0:d<this.maxScrollX&&(d=this.maxScrollX),e>0?e=0:e<this.maxScrollY&&(e=this.maxScrollY),this.scrollTo(d,e,0),this._execEvent("scroll")}},_initSnap:function(){this.currentPage={},"string"==typeof this.options.snap&&(this.options.snap=this.scroller.querySelectorAll(this.options.snap)),this.on("refresh",function(){var a,b,c,d,e,f,g=0,h=0,i=0,j=this.options.snapStepX||this.wrapperWidth,k=this.options.snapStepY||this.wrapperHeight;if(this.pages=[],this.wrapperWidth&&this.wrapperHeight&&this.scrollerWidth&&this.scrollerHeight){if(this.options.snap===!0)for(c=Math.round(j/2),d=Math.round(k/2);i>-this.scrollerWidth;){for(this.pages[g]=[],a=0,e=0;e>-this.scrollerHeight;)this.pages[g][a]={x:Math.max(i,this.maxScrollX),y:Math.max(e,this.maxScrollY),width:j,height:k,cx:i-c,cy:e-d},e-=k,a++;i-=j,g++}else for(f=this.options.snap,a=f.length,b=-1;a>g;g++)(0===g||f[g].offsetLeft<=f[g-1].offsetLeft)&&(h=0,b++),this.pages[h]||(this.pages[h]=[]),i=Math.max(-f[g].offsetLeft,this.maxScrollX),e=Math.max(-f[g].offsetTop,this.maxScrollY),c=i-Math.round(f[g].offsetWidth/2),d=e-Math.round(f[g].offsetHeight/2),this.pages[h][b]={x:i,y:e,width:f[g].offsetWidth,height:f[g].offsetHeight,cx:c,cy:d},i>this.maxScrollX&&h++;this.goToPage(this.currentPage.pageX||0,this.currentPage.pageY||0,0),this.options.snapThreshold%1===0?(this.snapThresholdX=this.options.snapThreshold,this.snapThresholdY=this.options.snapThreshold):(this.snapThresholdX=Math.round(this.pages[this.currentPage.pageX][this.currentPage.pageY].width*this.options.snapThreshold),this.snapThresholdY=Math.round(this.pages[this.currentPage.pageX][this.currentPage.pageY].height*this.options.snapThreshold))}}),this.on("flick",function(){var a=this.options.snapSpeed||Math.max(Math.max(Math.min(Math.abs(this.x-this.startX),1e3),Math.min(Math.abs(this.y-this.startY),1e3)),300);this.goToPage(this.currentPage.pageX+this.directionX,this.currentPage.pageY+this.directionY,a)})},_nearestSnap:function(a,b){if(!this.pages.length)return{x:0,y:0,pageX:0,pageY:0};var c=0,d=this.pages.length,e=0;if(Math.abs(a-this.absStartX)<this.snapThresholdX&&Math.abs(b-this.absStartY)<this.snapThresholdY)return this.currentPage;for(a>0?a=0:a<this.maxScrollX&&(a=this.maxScrollX),b>0?b=0:b<this.maxScrollY&&(b=this.maxScrollY);d>c;c++)if(a>=this.pages[c][0].cx){a=this.pages[c][0].x;break}for(d=this.pages[c].length;d>e;e++)if(b>=this.pages[0][e].cy){b=this.pages[0][e].y;break}return c===this.currentPage.pageX&&(c+=this.directionX,0>c?c=0:c>=this.pages.length&&(c=this.pages.length-1),a=this.pages[c][0].x),e===this.currentPage.pageY&&(e+=this.directionY,0>e?e=0:e>=this.pages[0].length&&(e=this.pages[0].length-1),b=this.pages[0][e].y),{x:a,y:b,pageX:c,pageY:e}},goToPage:function(a,b,c,d){d=d||this.options.bounceEasing,a>=this.pages.length?a=this.pages.length-1:0>a&&(a=0),b>=this.pages[a].length?b=this.pages[a].length-1:0>b&&(b=0);var e=this.pages[a][b].x,f=this.pages[a][b].y;c=void 0===c?this.options.snapSpeed||Math.max(Math.max(Math.min(Math.abs(e-this.x),1e3),Math.min(Math.abs(f-this.y),1e3)),300):c,this.currentPage={x:e,y:f,pageX:a,pageY:b},this.scrollTo(e,f,c,d)},next:function(a,b){var c=this.currentPage.pageX,d=this.currentPage.pageY;c++,c>=this.pages.length&&this.hasVerticalScroll&&(c=0,d++),this.goToPage(c,d,a,b)},prev:function(a,b){var c=this.currentPage.pageX,d=this.currentPage.pageY;c--,0>c&&this.hasVerticalScroll&&(c=0,d--),this.goToPage(c,d,a,b)},_initKeys:function(){var b,c={pageUp:33,pageDown:34,end:35,home:36,left:37,up:38,right:39,down:40};if("object"==typeof this.options.keyBindings)for(b in this.options.keyBindings)"string"==typeof this.options.keyBindings[b]&&(this.options.keyBindings[b]=this.options.keyBindings[b].toUpperCase().charCodeAt(0));else this.options.keyBindings={};for(b in c)this.options.keyBindings[b]=this.options.keyBindings[b]||c[b];f.addEvent(a,"keydown",this),this.on("destroy",function(){f.removeEvent(a,"keydown",this)})},_key:function(a){if(this.enabled){var b,c=this.options.snap,d=c?this.currentPage.pageX:this.x,e=c?this.currentPage.pageY:this.y,g=f.getTime(),h=this.keyTime||0,i=.25;switch(this.options.useTransition&&this.isInTransition&&(b=this.getComputedPosition(),this._translate(Math.round(b.x),Math.round(b.y)),this.isInTransition=!1),this.keyAcceleration=200>g-h?Math.min(this.keyAcceleration+i,50):0,a.keyCode){case this.options.keyBindings.pageUp:this.hasHorizontalScroll&&!this.hasVerticalScroll?d+=c?1:this.wrapperWidth:e+=c?1:this.wrapperHeight;break;case this.options.keyBindings.pageDown:this.hasHorizontalScroll&&!this.hasVerticalScroll?d-=c?1:this.wrapperWidth:e-=c?1:this.wrapperHeight;break;case this.options.keyBindings.end:d=c?this.pages.length-1:this.maxScrollX,e=c?this.pages[0].length-1:this.maxScrollY;break;case this.options.keyBindings.home:d=0,e=0;break;case this.options.keyBindings.left:d+=c?-1:5+this.keyAcceleration>>0;break;case this.options.keyBindings.up:e+=c?1:5+this.keyAcceleration>>0;break;case this.options.keyBindings.right:d-=c?-1:5+this.keyAcceleration>>0;break;case this.options.keyBindings.down:e-=c?1:5+this.keyAcceleration>>0;break;default:return}if(c)return void this.goToPage(d,e);d>0?(d=0,this.keyAcceleration=0):d<this.maxScrollX&&(d=this.maxScrollX,this.keyAcceleration=0),e>0?(e=0,this.keyAcceleration=0):e<this.maxScrollY&&(e=this.maxScrollY,this.keyAcceleration=0),this.scrollTo(d,e,0),this.keyTime=g}},_animate:function(a,b,c,d){function g(){var m,n,o,p=f.getTime();return p>=l?(h.isAnimating=!1,h._translate(a,b),void(h.resetPosition(h.options.bounceTime)||h._execEvent("scrollEnd"))):(p=(p-k)/c,o=d(p),m=(a-i)*o+i,n=(b-j)*o+j,h._translate(m,n),h.isAnimating&&e(g),void(3===h.options.probeType&&h._execEvent("scroll")))}var h=this,i=this.x,j=this.y,k=f.getTime(),l=k+c;this.isAnimating=!0,g()},handleEvent:function(a){switch(a.type){case"touchstart":case"pointerdown":case"MSPointerDown":case"mousedown":this._start(a);break;case"touchmove":case"pointermove":case"MSPointerMove":case"mousemove":this._move(a);break;case"touchend":case"pointerup":case"MSPointerUp":case"mouseup":case"touchcancel":case"pointercancel":case"MSPointerCancel":case"mousecancel":this._end(a);break;case"orientationchange":case"resize":this._resize();break;case"transitionend":case"webkitTransitionEnd":case"oTransitionEnd":case"MSTransitionEnd":this._transitionEnd(a);break;case"wheel":case"DOMMouseScroll":case"mousewheel":this._wheel(a);break;case"keydown":this._key(a);break;case"click":a._constructed||(a.preventDefault(),a.stopPropagation())}}},d.prototype={handleEvent:function(a){switch(a.type){case"touchstart":case"pointerdown":case"MSPointerDown":case"mousedown":this._start(a);break;case"touchmove":case"pointermove":case"MSPointerMove":case"mousemove":this._move(a);break;case"touchend":case"pointerup":case"MSPointerUp":case"mouseup":case"touchcancel":case"pointercancel":case"MSPointerCancel":case"mousecancel":this._end(a)}},destroy:function(){this.options.interactive&&(f.removeEvent(this.indicator,"touchstart",this),f.removeEvent(this.indicator,f.prefixPointerEvent("pointerdown"),this),f.removeEvent(this.indicator,"mousedown",this),f.removeEvent(a,"touchmove",this),f.removeEvent(a,f.prefixPointerEvent("pointermove"),this),f.removeEvent(a,"mousemove",this),f.removeEvent(a,"touchend",this),f.removeEvent(a,f.prefixPointerEvent("pointerup"),this),f.removeEvent(a,"mouseup",this)),this.options.defaultScrollbars&&this.wrapper.parentNode.removeChild(this.wrapper)},_start:function(b){var c=b.touches?b.touches[0]:b;b.preventDefault(),b.stopPropagation(),this.transitionTime(),this.initiated=!0,this.moved=!1,this.lastPointX=c.pageX,this.lastPointY=c.pageY,this.startTime=f.getTime(),this.options.disableTouch||f.addEvent(a,"touchmove",this),this.options.disablePointer||f.addEvent(a,f.prefixPointerEvent("pointermove"),this),this.options.disableMouse||f.addEvent(a,"mousemove",this),this.scroller._execEvent("beforeScrollStart")},_move:function(a){var b,c,d,e,g=a.touches?a.touches[0]:a,h=f.getTime();this.moved||this.scroller._execEvent("scrollStart"),this.moved=!0,b=g.pageX-this.lastPointX,this.lastPointX=g.pageX,c=g.pageY-this.lastPointY,this.lastPointY=g.pageY,d=this.x+b,e=this.y+c,this._pos(d,e),1===this.scroller.options.probeType&&h-this.startTime>300?(this.startTime=h,this.scroller._execEvent("scroll")):this.scroller.options.probeType>1&&this.scroller._execEvent("scroll"),a.preventDefault(),a.stopPropagation()},_end:function(b){if(this.initiated){if(this.initiated=!1,b.preventDefault(),b.stopPropagation(),f.removeEvent(a,"touchmove",this),f.removeEvent(a,f.prefixPointerEvent("pointermove"),this),f.removeEvent(a,"mousemove",this),this.scroller.options.snap){var c=this.scroller._nearestSnap(this.scroller.x,this.scroller.y),d=this.options.snapSpeed||Math.max(Math.max(Math.min(Math.abs(this.scroller.x-c.x),1e3),Math.min(Math.abs(this.scroller.y-c.y),1e3)),300);(this.scroller.x!==c.x||this.scroller.y!==c.y)&&(this.scroller.directionX=0,this.scroller.directionY=0,this.scroller.currentPage=c,this.scroller.scrollTo(c.x,c.y,d,this.scroller.options.bounceEasing))}this.moved&&this.scroller._execEvent("scrollEnd")}},transitionTime:function(a){a=a||0,this.indicatorStyle[f.style.transitionDuration]=a+"ms",!a&&f.isBadAndroid&&(this.indicatorStyle[f.style.transitionDuration]="0.001s")},transitionTimingFunction:function(a){this.indicatorStyle[f.style.transitionTimingFunction]=a},refresh:function(){this.transitionTime(),this.options.listenX&&!this.options.listenY?this.indicatorStyle.display=this.scroller.hasHorizontalScroll?"block":"none":this.options.listenY&&!this.options.listenX?this.indicatorStyle.display=this.scroller.hasVerticalScroll?"block":"none":this.indicatorStyle.display=this.scroller.hasHorizontalScroll||this.scroller.hasVerticalScroll?"block":"none",this.scroller.hasHorizontalScroll&&this.scroller.hasVerticalScroll?(f.addClass(this.wrapper,"iScrollBothScrollbars"),f.removeClass(this.wrapper,"iScrollLoneScrollbar"),this.options.defaultScrollbars&&this.options.customStyle&&(this.options.listenX?this.wrapper.style.right="8px":this.wrapper.style.bottom="8px")):(f.removeClass(this.wrapper,"iScrollBothScrollbars"),f.addClass(this.wrapper,"iScrollLoneScrollbar"),this.options.defaultScrollbars&&this.options.customStyle&&(this.options.listenX?this.wrapper.style.right="2px":this.wrapper.style.bottom="2px")),this.options.listenX&&(this.wrapperWidth=this.wrapper.clientWidth,this.options.resize?(this.indicatorWidth=Math.max(Math.round(this.wrapperWidth*this.wrapperWidth/(this.scroller.scrollerWidth||this.wrapperWidth||1)),8),this.indicatorStyle.width=this.indicatorWidth+"px"):this.indicatorWidth=this.indicator.clientWidth,this.maxPosX=this.wrapperWidth-this.indicatorWidth,"clip"===this.options.shrink?(this.minBoundaryX=-this.indicatorWidth+8,this.maxBoundaryX=this.wrapperWidth-8):(this.minBoundaryX=0,this.maxBoundaryX=this.maxPosX),this.sizeRatioX=this.options.speedRatioX||this.scroller.maxScrollX&&this.maxPosX/this.scroller.maxScrollX),this.options.listenY&&(this.wrapperHeight=this.wrapper.clientHeight,this.options.resize?(this.indicatorHeight=Math.max(Math.round(this.wrapperHeight*this.wrapperHeight/(this.scroller.scrollerHeight||this.wrapperHeight||1)),8),this.indicatorStyle.height=this.indicatorHeight+"px"):this.indicatorHeight=this.indicator.clientHeight,this.maxPosY=this.wrapperHeight-this.indicatorHeight,"clip"===this.options.shrink?(this.minBoundaryY=-this.indicatorHeight+8,this.maxBoundaryY=this.wrapperHeight-8):(this.minBoundaryY=0,this.maxBoundaryY=this.maxPosY),this.maxPosY=this.wrapperHeight-this.indicatorHeight,this.sizeRatioY=this.options.speedRatioY||this.scroller.maxScrollY&&this.maxPosY/this.scroller.maxScrollY),this.updatePosition()},updatePosition:function(){var a=this.options.listenX&&Math.round(this.sizeRatioX*this.scroller.x)||0,b=this.options.listenY&&Math.round(this.sizeRatioY*this.scroller.y)||0;this.options.ignoreBoundaries||(a<this.minBoundaryX?("scale"===this.options.shrink&&(this.width=Math.max(this.indicatorWidth+a,8),this.indicatorStyle.width=this.width+"px"),a=this.minBoundaryX):a>this.maxBoundaryX?"scale"===this.options.shrink?(this.width=Math.max(this.indicatorWidth-(a-this.maxPosX),8),this.indicatorStyle.width=this.width+"px",a=this.maxPosX+this.indicatorWidth-this.width):a=this.maxBoundaryX:"scale"===this.options.shrink&&this.width!==this.indicatorWidth&&(this.width=this.indicatorWidth,this.indicatorStyle.width=this.width+"px"),b<this.minBoundaryY?("scale"===this.options.shrink&&(this.height=Math.max(this.indicatorHeight+3*b,8),this.indicatorStyle.height=this.height+"px"),b=this.minBoundaryY):b>this.maxBoundaryY?"scale"===this.options.shrink?(this.height=Math.max(this.indicatorHeight-3*(b-this.maxPosY),8),this.indicatorStyle.height=this.height+"px",b=this.maxPosY+this.indicatorHeight-this.height):b=this.maxBoundaryY:"scale"===this.options.shrink&&this.height!==this.indicatorHeight&&(this.height=this.indicatorHeight,this.indicatorStyle.height=this.height+"px")),this.x=a,this.y=b,this.scroller.options.useTransform?this.indicatorStyle[f.style.transform]="translate("+a+"px,"+b+"px)"+this.scroller.translateZ:(this.indicatorStyle.left=a+"px",this.indicatorStyle.top=b+"px")},_pos:function(a,b){0>a?a=0:a>this.maxPosX&&(a=this.maxPosX),0>b?b=0:b>this.maxPosY&&(b=this.maxPosY),a=this.options.listenX?Math.round(a/this.sizeRatioX):this.scroller.x,b=this.options.listenY?Math.round(b/this.sizeRatioY):this.scroller.y,this.scroller.scrollTo(a,b)},fade:function(a,b){if(!b||this.visible){clearTimeout(this.fadeTimeout),this.fadeTimeout=null;var c=a?250:500,d=a?0:300;a=a?"1":"0",this.wrapperStyle[f.style.transitionDuration]=c+"ms",this.fadeTimeout=setTimeout(function(a){this.wrapperStyle.opacity=a,this.visible=+a}.bind(this,a),d)}}},b.utils=f,a.IScroll=b}(window),+function(a){"use strict";function b(b){var c=Array.apply(null,arguments);c.shift();var e;return this.each(function(){var f=a(this),g=a.extend({},f.dataset(),"object"==typeof b&&b),h=f.data("scroller");return h||f.data("scroller",h=new d(this,g)),"string"==typeof b&&"function"==typeof h[b]&&(e=h[b].apply(h,c),void 0!==e)?!1:void 0}),void 0!==e?e:this}var c={scrollTop:a.fn.scrollTop,scrollLeft:a.fn.scrollLeft};!function(){a.extend(a.fn,{scrollTop:function(a,b){if(this.length){var d=this.data("scroller");return d&&d.scroller?d.scrollTop(a,b):c.scrollTop.apply(this,arguments)}}}),a.extend(a.fn,{scrollLeft:function(a,b){if(this.length){var d=this.data("scroller");return d&&d.scroller?d.scrollLeft(a,b):c.scrollLeft.apply(this,arguments)}}})}();var d=function(b,c){var d=this.$pageContent=a(b);this.options=a.extend({},this._defaults,c);var e=this.options.type,f="js"===e||"auto"===e&&a.device.android&&a.compareVersion("4.4.0",a.device.osVersion)>-1||"auto"===e&&a.device.ios&&a.compareVersion("6.0.0",a.device.osVersion)>-1;if(f){var g=d.find(".content-inner");if(!g[0]){var h=d.children();h.length<1?d.children().wrapAll('<div class="content-inner"></div>'):d.html('<div class="content-inner">'+d.html()+"</div>")}if(d.hasClass("pull-to-refresh-content")){var i=a(window).height()+(d.prev().hasClass(".bar")?1:61);d.find(".content-inner").css("min-height",i+"px")}var j=a(b).hasClass("pull-to-refresh-content"),k=0===d.find(".fixed-tab").length,l={probeType:1,mouseWheel:!0,click:a.device.androidChrome,useTransform:k,scrollX:!0};j&&(l.ptr=!0,l.ptrOffset=44),this.scroller=new IScroll(b,l),this._bindEventToDomWhenJs(),a.initPullToRefresh=a._pullToRefreshJSScroll.initPullToRefresh,a.pullToRefreshDone=a._pullToRefreshJSScroll.pullToRefreshDone,a.pullToRefreshTrigger=a._pullToRefreshJSScroll.pullToRefreshTrigger,a.destroyToRefresh=a._pullToRefreshJSScroll.destroyToRefresh,d.addClass("javascript-scroll"),k||d.find(".content-inner").css({width:"100%",position:"absolute"});var m=this.$pageContent[0].scrollTop;m&&(this.$pageContent[0].scrollTop=0,this.scrollTop(m))}else d.addClass("native-scroll")};d.prototype={_defaults:{type:"native"},_bindEventToDomWhenJs:function(){if(this.scroller){var a=this;this.scroller.on("scrollStart",function(){a.$pageContent.trigger("scrollstart")}),this.scroller.on("scroll",function(){a.$pageContent.trigger("scroll")}),this.scroller.on("scrollEnd",function(){a.$pageContent.trigger("scrollend")})}},scrollTop:function(a,b){return this.scroller?void 0===a?-1*this.scroller.getComputedPosition().y:(this.scroller.scrollTo(0,-1*a,b),this):this.$pageContent.scrollTop(a,b)},scrollLeft:function(a,b){return this.scroller?void 0===a?-1*this.scroller.getComputedPosition().x:(this.scroller.scrollTo(-1*a,0),this):this.$pageContent.scrollTop(a,b)},on:function(a,b){return this.scroller?this.scroller.on(a,function(){b.call(this.wrapper)}):this.$pageContent.on(a,b),this},off:function(a,b){return this.scroller?this.scroller.off(a,b):this.$pageContent.off(a,b),this},refresh:function(){return this.scroller&&this.scroller.refresh(),this},scrollHeight:function(){return this.scroller?this.scroller.scrollerHeight:this.$pageContent[0].scrollHeight}};var e=a.fn.scroller;a.fn.scroller=b,a.fn.scroller.Constructor=d,a.fn.scroller.noConflict=function(){return a.fn.scroller=e,this},a(function(){a('[data-toggle="scroller"]').scroller()}),a.refreshScroller=function(b){b?a(b).scroller("refresh"):a(".javascript-scroll").each(function(){a(this).scroller("refresh")})},a.initScroller=function(b){this.options=a.extend({},"object"==typeof b&&b),a('[data-toggle="scroller"],.content').scroller(b)},a.getScroller=function(b){return b=b.hasClass("content")?b:b.parents(".content"),b?a(b).data("scroller"):a(".content.javascript-scroll").data("scroller")},a.detectScrollerType=function(b){return b?a(b).data("scroller")&&a(b).data("scroller").scroller?"js":"native":void 0}}(Zepto),+function(a){"use strict";var b=function(b,c,d){var e=a(b);if(2===arguments.length&&"boolean"==typeof c&&(d=c),0===e.length)return!1;if(e.hasClass("active"))return d&&e.trigger("show"),!1;var f=e.parent(".tabs");if(0===f.length)return!1;var g=f.children(".tab.active").removeClass("active");if(e.addClass("active"),e.trigger("show"),c?c=a(c):(c=a("string"==typeof b?'.tab-link[href="'+b+'"]':'.tab-link[href="#'+e.attr("id")+'"]'),(!c||c&&0===c.length)&&a("[data-tab]").each(function(){e.is(a(this).attr("data-tab"))&&(c=a(this))})),0!==c.length){var h;if(g&&g.length>0){var i=g.attr("id");i&&(h=a('.tab-link[href="#'+i+'"]')),(!h||h&&0===h.length)&&a("[data-tab]").each(function(){g.is(a(this).attr("data-tab"))&&(h=a(this))})}return c&&c.length>0&&c.addClass("active"),h&&h.length>0&&h.removeClass("active"),c.trigger("active"),!0}},c=a.showTab;a.showTab=b,a.showTab.noConflict=function(){return a.showTab=c,this},a(document).on("click",".tab-link",function(c){c.preventDefault();var d=a(this);b(d.data("tab")||d.attr("href"),d)})}(Zepto),+function(a){"use strict";function b(b){var d=Array.apply(null,arguments);d.shift(),this.each(function(){var d=a(this),e=a.extend({},d.dataset(),"object"==typeof b&&b),f=d.data("fixedtab");f||d.data("fixedtab",f=new c(this,e))})}a.initFixedTab=function(){var b=a(".fixed-tab");0!==b.length&&a(".fixed-tab").fixedTab()};var c=function(b,c){var d=this.$pageContent=a(b),e=d.clone(),f=d[0].getBoundingClientRect().top;e.css("visibility","hidden"),this.options=a.extend({},this._defaults,{fixedTop:f,shadow:e,offset:0},c),this._bindEvents()};c.prototype={_defaults:{offset:0},_bindEvents:function(){this.$pageContent.parents(".content").on("scroll",this._scrollHandler.bind(this)),this.$pageContent.on("active",".tab-link",this._tabLinkHandler.bind(this))},_tabLinkHandler:function(b){var c=a(b.target).parents(".buttons-fixed").length>0,d=this.options.fixedTop,e=this.options.offset;a.refreshScroller(),c&&this.$pageContent.parents(".content").scrollTop(d-e)},_scrollHandler:function(b){var c=a(b.target),d=this.$pageContent,e=this.options.shadow,f=this.options.offset,g=this.options.fixedTop,h=c.scrollTop(),i=h>=g-f;i?(e.insertAfter(d),d.addClass("buttons-fixed").css("top",f)):(e.remove(),d.removeClass("buttons-fixed").css("top",0))}},a.fn.fixedTab=b,a.fn.fixedTab.Constructor=c,a(document).on("pageInit",function(){a.initFixedTab()})}(Zepto),+function(a){"use strict";var b=0,c=function(c){function d(){j.hasClass("refreshing")||(-1*i.scrollTop()>=44?j.removeClass("pull-down").addClass("pull-up"):j.removeClass("pull-up").addClass("pull-down"))}function e(){j.hasClass("refreshing")||(j.removeClass("pull-down pull-up"),j.addClass("refreshing transitioning"),j.trigger("refresh"),b=+new Date)}function f(){i.off("scroll",d),i.scroller.off("ptr",e)}var g=a(c);if(g.hasClass("pull-to-refresh-content")||(g=g.find(".pull-to-refresh-content")),g&&0!==g.length){var h=g.hasClass("content")?g:g.parents(".content"),i=a.getScroller(h[0]);if(i){var j=g;i.on("scroll",d),i.scroller.on("ptr",e),g[0].destroyPullToRefresh=f}}},d=function(c){if(c=a(c),0===c.length&&(c=a(".pull-to-refresh-content.refreshing")),0!==c.length){var d=+new Date-b,e=d>1e3?0:1e3-d,f=a.getScroller(c);setTimeout(function(){f.refresh(),c.removeClass("refreshing"),c.transitionEnd(function(){c.removeClass("transitioning")})},e)}},e=function(b){if(b=a(b),0===b.length&&(b=a(".pull-to-refresh-content")),!b.hasClass("refreshing")){b.addClass("refreshing");var c=a.getScroller(b);c.scrollTop(45,200),b.trigger("refresh")}},f=function(b){b=a(b);var c=b.hasClass("pull-to-refresh-content")?b:b.find(".pull-to-refresh-content");0!==c.length&&c[0].destroyPullToRefresh&&c[0].destroyPullToRefresh()};a._pullToRefreshJSScroll={initPullToRefresh:c,pullToRefreshDone:d,pullToRefreshTrigger:e,destroyPullToRefresh:f}}(Zepto),+function(a){"use strict";a.initPullToRefresh=function(b){function c(b){if(h){if(!a.device.android)return;if("targetTouches"in b&&b.targetTouches.length>1)return}i=!1,h=!0,j=void 0,p=void 0,s.x="touchstart"===b.type?b.targetTouches[0].pageX:b.pageX,s.y="touchstart"===b.type?b.targetTouches[0].pageY:b.pageY,l=(new Date).getTime(),m=a(this)}function d(b){if(h){var c="touchmove"===b.type?b.targetTouches[0].pageX:b.pageX,d="touchmove"===b.type?b.targetTouches[0].pageY:b.pageY;if("undefined"==typeof j&&(j=!!(j||Math.abs(d-s.y)>Math.abs(c-s.x))),!j)return void(h=!1);if(o=m[0].scrollTop,"undefined"==typeof p&&0!==o&&(p=!0),!i){if(m.removeClass("transitioning"),o>m[0].offsetHeight)return void(h=!1);r&&(q=m.attr("data-ptr-distance"),q.indexOf("%")>=0&&(q=m[0].offsetHeight*parseInt(q,10)/100)),v=m.hasClass("refreshing")?q:0,u=m[0].scrollHeight!==m[0].offsetHeight&&a.device.ios?!1:!0,u=!0}return i=!0,k=d-s.y,k>0&&0>=o||0>o?(a.device.ios&&parseInt(a.device.osVersion.split(".")[0],10)>7&&0===o&&!p&&(u=!0),u&&(b.preventDefault(),n=Math.pow(k,.85)+v,m.transform("translate3d(0,"+n+"px,0)")),u&&Math.pow(k,.85)>q||!u&&k>=2*q?(t=!0,m.addClass("pull-up").removeClass("pull-down")):(t=!1,m.removeClass("pull-up").addClass("pull-down")),void 0):(m.removeClass("pull-up pull-down"),void(t=!1))}}function e(){if(!h||!i)return h=!1,void(i=!1);if(n&&(m.addClass("transitioning"),n=0),m.transform(""),t){if(m.hasClass("refreshing"))return;m.addClass("refreshing"),m.trigger("refresh")}else m.removeClass("pull-down");h=!1,i=!1}function f(){g.off(a.touchEvents.start,c),g.off(a.touchEvents.move,d),g.off(a.touchEvents.end,e)}var g=a(b);if(g.hasClass("pull-to-refresh-content")||(g=g.find(".pull-to-refresh-content")),g&&0!==g.length){var h,i,j,k,l,m,n,o,p,q,r,s={},t=!1,u=!1,v=0;m=g,m.attr("data-ptr-distance")?r=!0:q=44,g.on(a.touchEvents.start,c),g.on(a.touchEvents.move,d),g.on(a.touchEvents.end,e),g[0].destroyPullToRefresh=f}},a.pullToRefreshDone=function(b){a(window).scrollTop(0),b=a(b),0===b.length&&(b=a(".pull-to-refresh-content.refreshing")),b.removeClass("refreshing").addClass("transitioning"),b.transitionEnd(function(){b.removeClass("transitioning pull-up pull-down")})},a.pullToRefreshTrigger=function(b){b=a(b),0===b.length&&(b=a(".pull-to-refresh-content")),b.hasClass("refreshing")||(b.addClass("transitioning refreshing"),b.trigger("refresh"))},a.destroyPullToRefresh=function(b){b=a(b);var c=b.hasClass("pull-to-refresh-content")?b:b.find(".pull-to-refresh-content");0!==c.length&&c[0].destroyPullToRefresh&&c[0].destroyPullToRefresh()}}(Zepto),+function(a){"use strict";function b(){var b,c=a(this),d=a.getScroller(c),e=d.scrollTop(),f=d.scrollHeight(),g=c[0].offsetHeight,h=c[0].getAttribute("data-distance"),i=c.find(".virtual-list"),j=c.hasClass("infinite-scroll-top");if(h||(h=50),"string"==typeof h&&h.indexOf("%")>=0&&(h=parseInt(h,10)/100*g),h>g&&(h=g),j)h>e&&c.trigger("infinite");else if(e+g>=f-h){if(i.length>0&&(b=i[0].f7VirtualList,b&&!b.reachEnd))return;c.trigger("infinite")}}a.attachInfiniteScroll=function(c){a.getScroller(c).on("scroll",b)},a.detachInfiniteScroll=function(c){a.getScroller(c).off("scroll",b)},a.initInfiniteScroll=function(b){function c(){a.detachInfiniteScroll(d),b.off("pageBeforeRemove",c)}b=a(b);var d=b.hasClass("infinite-scroll")?b:b.find(".infinite-scroll");0!==d.length&&(a.attachInfiniteScroll(d),b.forEach(function(b){if(a(b).hasClass("infinite-scroll-top")){var c=b.scrollHeight-b.clientHeight;a(b).scrollTop(c)}}),b.on("pageBeforeRemove",c))}}(Zepto),+function(a){"use strict";a(function(){a(document).on("focus",".searchbar input",function(b){var c=a(b.target);c.parents(".searchbar").addClass("searchbar-active")}),a(document).on("click",".searchbar-cancel",function(b){var c=a(b.target);c.parents(".searchbar").removeClass("searchbar-active")}),a(document).on("blur",".searchbar input",function(b){var c=a(b.target);c.parents(".searchbar").removeClass("searchbar-active")})})}(Zepto),+function(a){"use strict";a.allowPanelOpen=!0,a.openPanel=function(b){function c(){f.transitionEnd(function(d){d.target===f[0]?(b.hasClass("active")?b.trigger("opened"):b.trigger("closed"),a.allowPanelOpen=!0):c()})}if(!a.allowPanelOpen)return!1;("left"===b||"right"===b)&&(b=".panel-"+b),b=b?a(b):a(".panel").eq(0);var d=b.hasClass("panel-right")?"right":"left";if(0===b.length||b.hasClass("active"))return!1;a.closePanel(),a.allowPanelOpen=!1;var e=b.hasClass("panel-reveal")?"reveal":"cover";b.css({display:"block"}).addClass("active"),b.trigger("open");var f=(b[0].clientLeft,"reveal"===e?a(a.getCurrentPage()):b);return c(),a(document.body).addClass("with-panel-"+d+"-"+e),!0},a.closePanel=function(){var b=a(".panel.active");if(0===b.length)return!1;var c=b.hasClass("panel-reveal")?"reveal":"cover",d=b.hasClass("panel-left")?"left":"right";b.removeClass("active");var e="reveal"===c?a(".page"):b;b.trigger("close"),a.allowPanelOpen=!1,e.transitionEnd(function(){b.hasClass("active")||(b.css({display:""}),b.trigger("closed"),a("body").removeClass("panel-closing"),a.allowPanelOpen=!0)}),a("body").addClass("panel-closing").removeClass("with-panel-"+d+"-"+c)},a(document).on("click",".open-panel",function(b){var c=a(b.target).data("panel");a.openPanel(c)}),a(document).on("click",".close-panel, .panel-overlay",function(b){a.closePanel()}),a.initSwipePanels=function(){function b(b){if(a.allowPanelOpen&&(g||h)&&!m&&!(a(".modal-in, .photo-browser-in").length>0)&&(i||h||!(a(".panel.active").length>0)||e.hasClass("active"))){if(x.x="touchstart"===b.type?b.targetTouches[0].pageX:b.pageX,x.y="touchstart"===b.type?b.targetTouches[0].pageY:b.pageY,i||h){if(a(".panel.active").length>0)f=a(".panel.active").hasClass("panel-left")?"left":"right";else{if(h)return;f=g}if(!f)return}if(e=a(".panel.panel-"+f),e[0]){if(s=e.hasClass("active"),j&&!s){if("left"===f&&x.x>j)return;if("right"===f&&x.x<window.innerWidth-j)return}n=!1,m=!0,o=void 0,p=(new Date).getTime(),v=void 0}}}function c(b){if(m&&e[0]&&!b.f7PreventPanelSwipe){var c="touchmove"===b.type?b.targetTouches[0].pageX:b.pageX,d="touchmove"===b.type?b.targetTouches[0].pageY:b.pageY;
if("undefined"==typeof o&&(o=!!(o||Math.abs(d-x.y)>Math.abs(c-x.x))),o)return void(m=!1);if(!v&&(v=c>x.x?"to-right":"to-left","left"===f&&"to-left"===v&&!e.hasClass("active")||"right"===f&&"to-right"===v&&!e.hasClass("active")))return void(m=!1);if(l){var g=(new Date).getTime()-p;return 300>g&&("to-left"===v&&("right"===f&&a.openPanel(f),"left"===f&&e.hasClass("active")&&a.closePanel()),"to-right"===v&&("left"===f&&a.openPanel(f),"right"===f&&e.hasClass("active")&&a.closePanel())),m=!1,console.log(3),void(n=!1)}n||(u=e.hasClass("panel-cover")?"cover":"reveal",s||(e.show(),w.show()),t=e[0].offsetWidth,e.transition(0)),n=!0,b.preventDefault();var h=s?0:-k;"right"===f&&(h=-h),q=c-x.x+h,"right"===f?(r=q-(s?t:0),r>0&&(r=0),-t>r&&(r=-t)):(r=q+(s?t:0),0>r&&(r=0),r>t&&(r=t)),"reveal"===u?(y.transform("translate3d("+r+"px,0,0)").transition(0),w.transform("translate3d("+r+"px,0,0)")):e.transform("translate3d("+r+"px,0,0)").transition(0)}}function d(b){if(!m||!n)return m=!1,void(n=!1);m=!1,n=!1;var c,d=(new Date).getTime()-p,g=0===r||Math.abs(r)===t;if(c=s?r===-t?"reset":300>d&&Math.abs(r)>=0||d>=300&&Math.abs(r)<=t/2?"left"===f&&r===t?"reset":"swap":"reset":0===r?"reset":300>d&&Math.abs(r)>0||d>=300&&Math.abs(r)>=t/2?"swap":"reset","swap"===c&&(a.allowPanelOpen=!0,s?(a.closePanel(),g&&(e.css({display:""}),a("body").removeClass("panel-closing"))):a.openPanel(f),g&&(a.allowPanelOpen=!0)),"reset"===c)if(s)a.allowPanelOpen=!0,a.openPanel(f);else if(a.closePanel(),g)a.allowPanelOpen=!0,e.css({display:""});else{var h="reveal"===u?y:e;a("body").addClass("panel-closing"),h.transitionEnd(function(){a.allowPanelOpen=!0,e.css({display:""}),a("body").removeClass("panel-closing")})}"reveal"===u&&(y.transition(""),y.transform("")),e.transition("").transform(""),w.css({display:""}).transform("")}var e,f,g=a.smConfig.swipePanel,h=a.smConfig.swipePanelOnlyClose,i=!0,j=!1,k=2,l=!1;if(g||h){var m,n,o,p,q,r,s,t,u,v,w=a(".panel-overlay"),x={},y=a(".page");a(document).on(a.touchEvents.start,b),a(document).on(a.touchEvents.move,c),a(document).on(a.touchEvents.end,d)}},a.initSwipePanels()}(Zepto),+function(a){"use strict";function b(a){for(var b=["external","tab-link","open-popup","close-popup","open-panel","close-panel"],c=b.length-1;c>=0;c--)if(a.hasClass(b[c]))return!0;var d=a.get(0),e=d.getAttribute("href"),f=["http","https"];return/^(\w+):/.test(e)&&f.indexOf(RegExp.$1)<0?!0:d.hasAttribute("external")?!0:!1}function c(b){var c=a.smConfig.routerFilter;if(a.isFunction(c)){var d=c(b);if("boolean"==typeof d)return d}return!0}window.CustomEvent||(window.CustomEvent=function(a,b){b=b||{bubbles:!1,cancelable:!1,detail:void 0};var c=document.createEvent("CustomEvent");return c.initCustomEvent(a,b.bubbles,b.cancelable,b.detail),c},window.CustomEvent.prototype=window.Event.prototype);var d={pageLoadStart:"pageLoadStart",pageLoadCancel:"pageLoadCancel",pageLoadError:"pageLoadError",pageLoadComplete:"pageLoadComplete",pageAnimationStart:"pageAnimationStart",pageAnimationEnd:"pageAnimationEnd",beforePageRemove:"beforePageRemove",pageRemoved:"pageRemoved",beforePageSwitch:"beforePageSwitch",pageInit:"pageInitInternal"},e={getUrlFragment:function(a){var b=a.indexOf("#");return-1===b?"":a.slice(b+1)},getAbsoluteUrl:function(a){var b=document.createElement("a");b.setAttribute("href",a);var c=b.href;return b=null,c},getBaseUrl:function(a){var b=a.indexOf("#");return-1===b?a.slice(0):a.slice(0,b)},toUrlObject:function(a){var b=this.getAbsoluteUrl(a),c=this.getBaseUrl(b),d=this.getUrlFragment(a);return{base:c,full:b,original:a,fragment:d}},supportStorage:function(){var a="sm.router.storage.ability";try{return sessionStorage.setItem(a,a),sessionStorage.removeItem(a),!0}catch(b){return!1}}},f={sectionGroupClass:"page-group",curPageClass:"page-current",visiblePageClass:"page-visible",pageClass:"page"},g={leftToRight:"from-left-to-right",rightToLeft:"from-right-to-left"},h=window.history,i=function(){this.sessionNames={currentState:"sm.router.currentState",maxStateId:"sm.router.maxStateId"},this._init(),this.xhr=null,window.addEventListener("popstate",this._onPopState.bind(this))};i.prototype._init=function(){this.$view=a("body"),this.cache={};var b=a(document),c=location.href;this._saveDocumentIntoCache(b,c);var d,g,i=e.toUrlObject(c),j=b.find("."+f.pageClass),k=b.find("."+f.curPageClass),l=k.eq(0);if(i.fragment&&(g=b.find("#"+i.fragment)),g&&g.length?k=g.eq(0):k.length||(k=j.eq(0)),k.attr("id")||k.attr("id",this._generateRandomId()),l.length&&l.attr("id")!==k.attr("id")?(l.removeClass(f.curPageClass),k.addClass(f.curPageClass)):k.addClass(f.curPageClass),d=k.attr("id"),null===h.state){var m={id:this._getNextStateId(),url:e.toUrlObject(c),pageId:d};h.replaceState(m,"",c),this._saveAsCurrentState(m),this._incMaxStateId()}},i.prototype.load=function(b,c){void 0===c&&(c=!1),this._isTheSameDocument(location.href,b)?this._switchToSection(e.getUrlFragment(b)):(this._saveDocumentIntoCache(a(document),location.href),this._switchToDocument(b,c))},i.prototype.forward=function(){h.forward()},i.prototype.back=function(){h.back()},i.prototype.loadPage=i.prototype.load,i.prototype._switchToSection=function(b){if(b){var c=this._getCurrentSection(),d=a("#"+b);c!==d&&(this._animateSection(c,d,g.rightToLeft),this._pushNewState("#"+b,b))}},i.prototype._switchToDocument=function(a,b,c,d){var f=e.toUrlObject(a).base;b&&delete this.cache[f];var g=this.cache[f],h=this;g?this._doSwitchDocument(a,c,d):this._loadDocument(a,{success:function(b){try{h._parseDocument(a,b),h._doSwitchDocument(a,c,d)}catch(e){location.href=a}},error:function(){location.href=a}})},i.prototype._doSwitchDocument=function(b,c,g){"undefined"==typeof c&&(c=!0);var h,i=e.toUrlObject(b),j=this.$view.find("."+f.sectionGroupClass),k=a(a("<div></div>").append(this.cache[i.base].$content).html()),l=k.find("."+f.pageClass),m=k.find("."+f.curPageClass);i.fragment&&(h=k.find("#"+i.fragment)),h&&h.length?m=h.eq(0):m.length||(m=l.eq(0)),m.attr("id")||m.attr("id",this._generateRandomId());var n=this._getCurrentSection();n.trigger(d.beforePageSwitch,[n.attr("id"),n]),l.removeClass(f.curPageClass),m.addClass(f.curPageClass),this.$view.prepend(k),this._animateDocument(j,k,m,g),c&&this._pushNewState(b,m.attr("id"))},i.prototype._isTheSameDocument=function(a,b){return e.toUrlObject(a).base===e.toUrlObject(b).base},i.prototype._loadDocument=function(b,c){this.xhr&&this.xhr.readyState<4&&(this.xhr.onreadystatechange=function(){},this.xhr.abort(),this.dispatch(d.pageLoadCancel)),this.dispatch(d.pageLoadStart),c=c||{};var e=this;this.xhr=a.ajax({url:b,success:a.proxy(function(b,d,e){var f=a("<html></html>");f.append(b),c.success&&c.success.call(null,f,d,e)},this),error:function(a,b,f){c.error&&c.error.call(null,a,b,f),e.dispatch(d.pageLoadError)},complete:function(a,b){c.complete&&c.complete.call(null,a,b),e.dispatch(d.pageLoadComplete)}})},i.prototype._parseDocument=function(a,b){var c=b.find("."+f.sectionGroupClass);if(!c.length)throw new Error("missing router view mark: "+f.sectionGroupClass);this._saveDocumentIntoCache(b,a)},i.prototype._saveDocumentIntoCache=function(b,c){var d=e.toUrlObject(c).base,g=a(b);this.cache[d]={$doc:g,$content:g.find("."+f.sectionGroupClass)}},i.prototype._getLastState=function(){var a=sessionStorage.getItem(this.sessionNames.currentState);try{a=JSON.parse(a)}catch(b){a=null}return a},i.prototype._saveAsCurrentState=function(a){sessionStorage.setItem(this.sessionNames.currentState,JSON.stringify(a))},i.prototype._getNextStateId=function(){var a=sessionStorage.getItem(this.sessionNames.maxStateId);return a?parseInt(a,10)+1:1},i.prototype._incMaxStateId=function(){sessionStorage.setItem(this.sessionNames.maxStateId,this._getNextStateId())},i.prototype._animateDocument=function(b,c,e,g){var h=e.attr("id"),i=b.find("."+f.curPageClass);i.addClass(f.visiblePageClass).removeClass(f.curPageClass),e.trigger(d.pageAnimationStart,[h,e]),this._animateElement(b,c,g),b.animationEnd(function(){i.removeClass(f.visiblePageClass),a(window).trigger(d.beforePageRemove,[b]),b.remove(),a(window).trigger(d.pageRemoved)}),c.animationEnd(function(){e.trigger(d.pageAnimationEnd,[h,e]),e.trigger(d.pageInit,[h,e])})},i.prototype._animateSection=function(a,b,c){var e=b.attr("id");a.trigger(d.beforePageSwitch,[a.attr("id"),a]),a.removeClass(f.curPageClass),b.addClass(f.curPageClass),b.trigger(d.pageAnimationStart,[e,b]),this._animateElement(a,b,c),b.animationEnd(function(){b.trigger(d.pageAnimationEnd,[e,b]),b.trigger(d.pageInit,[e,b])})},i.prototype._animateElement=function(a,b,c){"undefined"==typeof c&&(c=g.rightToLeft);var d,e,f=["page-from-center-to-left","page-from-center-to-right","page-from-right-to-center","page-from-left-to-center"].join(" ");switch(c){case g.rightToLeft:d="page-from-center-to-left",e="page-from-right-to-center";break;case g.leftToRight:d="page-from-center-to-right",e="page-from-left-to-center";break;default:d="page-from-center-to-left",e="page-from-right-to-center"}a.removeClass(f).addClass(d),b.removeClass(f).addClass(e),a.animationEnd(function(){a.removeClass(f)}),b.animationEnd(function(){b.removeClass(f)})},i.prototype._getCurrentSection=function(){return this.$view.find("."+f.curPageClass).eq(0)},i.prototype._back=function(b,c){if(this._isTheSameDocument(b.url.full,c.url.full)){var d=a("#"+b.pageId);if(d.length){var e=this._getCurrentSection();this._animateSection(e,d,g.leftToRight),this._saveAsCurrentState(b)}else location.href=b.url.full}else this._saveDocumentIntoCache(a(document),c.url.full),this._switchToDocument(b.url.full,!1,!1,g.leftToRight),this._saveAsCurrentState(b)},i.prototype._forward=function(b,c){if(this._isTheSameDocument(b.url.full,c.url.full)){var d=a("#"+b.pageId);if(d.length){var e=this._getCurrentSection();this._animateSection(e,d,g.rightToLeft),this._saveAsCurrentState(b)}else location.href=b.url.full}else this._saveDocumentIntoCache(a(document),c.url.full),this._switchToDocument(b.url.full,!1,!1,g.rightToLeft),this._saveAsCurrentState(b)},i.prototype._onPopState=function(a){var b=a.state;if(b&&b.pageId){var c=this._getLastState();return c?void(b.id!==c.id&&(b.id<c.id?this._back(b,c):this._forward(b,c))):void(console.error&&console.error("Missing last state when backward or forward"))}},i.prototype._pushNewState=function(a,b){var c={id:this._getNextStateId(),pageId:b,url:e.toUrlObject(a)};h.pushState(c,"",a),this._saveAsCurrentState(c),this._incMaxStateId()},i.prototype._generateRandomId=function(){return"page-"+ +new Date},i.prototype.dispatch=function(a){var b=new CustomEvent(a,{bubbles:!0,cancelable:!0});window.dispatchEvent(b)},a(function(){if(a.smConfig.router&&e.supportStorage()){var d=a("."+f.pageClass);if(!d.length){var g="Disable router function because of no .page elements";return void(window.console&&window.console.warn&&console.warn(g))}var h=a.router=new i;a(document).on("click","a",function(d){var e=a(d.currentTarget),f=c(e);if(f&&!b(e))if(d.preventDefault(),e.hasClass("back"))h.back();else{var g=e.attr("href");if(!g||"#"===g)return;var i="true"===e.attr("data-no-cache");h.load(g,i)}})}})}(Zepto),+function(a){"use strict";a.lastPosition=function(b){function c(b,c){e.forEach(function(d,e){if(0!==a(d).length){var f=b,g=sessionStorage.getItem(f);c.find(d).scrollTop(parseInt(g))}})}function d(b,c){var d=b;e.forEach(function(b,e){0!==a(b).length&&sessionStorage.setItem(d,c.find(b).scrollTop())})}if(sessionStorage){var e=b.needMemoryClass||[];a(window).off("beforePageSwitch").on("beforePageSwitch",function(a,b,c){d(b,c)}),a(window).off("pageAnimationStart").on("pageAnimationStart",function(a,b,d){c(b,d)})}}}(Zepto),+function(a){"use strict";var b=function(){var b=a(".page-current");return b[0]||(b=a(".page").addClass("page-current")),b};a.initPage=function(c){var d=b();d[0]||(d=a(document.body));var e=d.hasClass("content")?d:d.find(".content");e.scroller(),a.initPullToRefresh(e),a.initInfiniteScroll(e),a.initCalendar(e),a.initSwiper&&a.initSwiper(e)},a.smConfig.showPageLoadingIndicator&&(a(window).on("pageLoadStart",function(){a.showIndicator()}),a(window).on("pageAnimationStart",function(){a.hideIndicator()}),a(window).on("pageLoadCancel",function(){a.hideIndicator()}),a(window).on("pageLoadComplete",function(){a.hideIndicator()}),a(window).on("pageLoadError",function(){a.hideIndicator(),a.toast("加载失败")})),a(window).on("pageAnimationStart",function(b,c,d){a.closeModal(),a.closePanel(),a("body").removeClass("panel-closing"),a.allowPanelOpen=!0}),a(window).on("pageInit",function(){a.hideIndicator(),a.lastPosition({needMemoryClass:[".content"]})}),window.addEventListener("pageshow",function(a){a.persisted&&location.reload()}),a.init=function(){var c=b(),d=c[0].id;a.initPage(),c.trigger("pageInit",[d,c])},a(function(){FastClick.attach(document.body),a.smConfig.autoInit&&a.init(),a(document).on("pageInitInternal",function(b,c,d){a.init()})})}(Zepto),+function(a){"use strict";if(a.device.ios){var b=function(a){var b,c;a=a||document.querySelector(a),a&&a.addEventListener("touchstart",function(d){b=d.touches[0].pageY,c=a.scrollTop,0>=c&&(a.scrollTop=1),c+a.offsetHeight>=a.scrollHeight&&(a.scrollTop=a.scrollHeight-a.offsetHeight-1)},!1)},c=function(){var c=a(".page-current").length>0?".page-current ":"",d=a(c+".content");new b(d[0])};a(document).on(a.touchEvents.move,".page-current .bar",function(){event.preventDefault()}),a(document).on("pageLoadComplete",function(){c()}),a(document).on("pageAnimationEnd",function(){c()}),c()}}(Zepto);
/*!
 * =====================================================
 * SUI Mobile - http://m.sui.taobao.org/
 *
 * =====================================================
 */
+function(a){"use strict";var b=function(c,d){function e(){return"horizontal"===o.params.direction}function f(){o.autoplayTimeoutId=setTimeout(function(){o.params.loop?(o.fixLoop(),o._slideNext()):o.isEnd?d.autoplayStopOnLast?o.stopAutoplay():o._slideTo(0):o._slideNext()},o.params.autoplay)}function g(b,c){var d=a(b.target);if(!d.is(c))if("string"==typeof c)d=d.parents(c);else if(c.nodeType){var e;return d.parents().each(function(a,b){b===c&&(e=c)}),e?c:void 0}if(0!==d.length)return d[0]}function h(a,b){b=b||{};var c=window.MutationObserver||window.WebkitMutationObserver,d=new c(function(a){a.forEach(function(a){o.onResize(),o.emit("onObserverUpdate",o,a)})});d.observe(a,{attributes:"undefined"==typeof b.attributes?!0:b.attributes,childList:"undefined"==typeof b.childList?!0:b.childList,characterData:"undefined"==typeof b.characterData?!0:b.characterData}),o.observers.push(d)}function i(b,c){b=a(b);var d,f,g;d=b.attr("data-swiper-parallax")||"0",f=b.attr("data-swiper-parallax-x"),g=b.attr("data-swiper-parallax-y"),f||g?(f=f||"0",g=g||"0"):e()?(f=d,g="0"):(g=d,f="0"),f=f.indexOf("%")>=0?parseInt(f,10)*c+"%":f*c+"px",g=g.indexOf("%")>=0?parseInt(g,10)*c+"%":g*c+"px",b.transform("translate3d("+f+", "+g+",0px)")}function j(a){return 0!==a.indexOf("on")&&(a=a[0]!==a[0].toUpperCase()?"on"+a[0].toUpperCase()+a.substring(1):"on"+a),a}var k=this.defaults,l=d&&d.virtualTranslate;d=d||{};for(var m in k)if("undefined"==typeof d[m])d[m]=k[m];else if("object"==typeof d[m])for(var n in k[m])"undefined"==typeof d[m][n]&&(d[m][n]=k[m][n]);var o=this;if(o.params=d,o.classNames=[],o.$=a,o.container=a(c),0!==o.container.length){if(o.container.length>1)return void o.container.each(function(){new a.Swiper(this,d)});o.container[0].swiper=o,o.container.data("swiper",o),o.classNames.push("swiper-container-"+o.params.direction),o.params.freeMode&&o.classNames.push("swiper-container-free-mode"),o.support.flexbox||(o.classNames.push("swiper-container-no-flexbox"),o.params.slidesPerColumn=1),(o.params.parallax||o.params.watchSlidesVisibility)&&(o.params.watchSlidesProgress=!0),["cube","coverflow"].indexOf(o.params.effect)>=0&&(o.support.transforms3d?(o.params.watchSlidesProgress=!0,o.classNames.push("swiper-container-3d")):o.params.effect="slide"),"slide"!==o.params.effect&&o.classNames.push("swiper-container-"+o.params.effect),"cube"===o.params.effect&&(o.params.resistanceRatio=0,o.params.slidesPerView=1,o.params.slidesPerColumn=1,o.params.slidesPerGroup=1,o.params.centeredSlides=!1,o.params.spaceBetween=0,o.params.virtualTranslate=!0,o.params.setWrapperSize=!1),"fade"===o.params.effect&&(o.params.slidesPerView=1,o.params.slidesPerColumn=1,o.params.slidesPerGroup=1,o.params.watchSlidesProgress=!0,o.params.spaceBetween=0,"undefined"==typeof l&&(o.params.virtualTranslate=!0)),o.params.grabCursor&&o.support.touch&&(o.params.grabCursor=!1),o.wrapper=o.container.children("."+o.params.wrapperClass),o.params.pagination&&(o.paginationContainer=a(o.params.pagination),o.params.paginationClickable&&o.paginationContainer.addClass("swiper-pagination-clickable")),o.rtl=e()&&("rtl"===o.container[0].dir.toLowerCase()||"rtl"===o.container.css("direction")),o.rtl&&o.classNames.push("swiper-container-rtl"),o.rtl&&(o.wrongRTL="-webkit-box"===o.wrapper.css("display")),o.params.slidesPerColumn>1&&o.classNames.push("swiper-container-multirow"),o.device.android&&o.classNames.push("swiper-container-android"),o.container.addClass(o.classNames.join(" ")),o.translate=0,o.progress=0,o.velocity=0,o.lockSwipeToNext=function(){o.params.allowSwipeToNext=!1},o.lockSwipeToPrev=function(){o.params.allowSwipeToPrev=!1},o.lockSwipes=function(){o.params.allowSwipeToNext=o.params.allowSwipeToPrev=!1},o.unlockSwipeToNext=function(){o.params.allowSwipeToNext=!0},o.unlockSwipeToPrev=function(){o.params.allowSwipeToPrev=!0},o.unlockSwipes=function(){o.params.allowSwipeToNext=o.params.allowSwipeToPrev=!0},o.params.grabCursor&&(o.container[0].style.cursor="move",o.container[0].style.cursor="-webkit-grab",o.container[0].style.cursor="-moz-grab",o.container[0].style.cursor="grab"),o.imagesToLoad=[],o.imagesLoaded=0,o.loadImage=function(a,b,c,d){function e(){d&&d()}var f;a.complete&&c?e():b?(f=new Image,f.onload=e,f.onerror=e,f.src=b):e()},o.preloadImages=function(){function a(){"undefined"!=typeof o&&null!==o&&(void 0!==o.imagesLoaded&&o.imagesLoaded++,o.imagesLoaded===o.imagesToLoad.length&&(o.params.updateOnImagesReady&&o.update(),o.emit("onImagesReady",o)))}o.imagesToLoad=o.container.find("img");for(var b=0;b<o.imagesToLoad.length;b++)o.loadImage(o.imagesToLoad[b],o.imagesToLoad[b].currentSrc||o.imagesToLoad[b].getAttribute("src"),!0,a)},o.autoplayTimeoutId=void 0,o.autoplaying=!1,o.autoplayPaused=!1,o.startAutoplay=function(){return"undefined"!=typeof o.autoplayTimeoutId?!1:o.params.autoplay?o.autoplaying?!1:(o.autoplaying=!0,o.emit("onAutoplayStart",o),void f()):!1},o.stopAutoplay=function(){o.autoplayTimeoutId&&(o.autoplayTimeoutId&&clearTimeout(o.autoplayTimeoutId),o.autoplaying=!1,o.autoplayTimeoutId=void 0,o.emit("onAutoplayStop",o))},o.pauseAutoplay=function(a){o.autoplayPaused||(o.autoplayTimeoutId&&clearTimeout(o.autoplayTimeoutId),o.autoplayPaused=!0,0===a?(o.autoplayPaused=!1,f()):o.wrapper.transitionEnd(function(){o.autoplayPaused=!1,o.autoplaying?f():o.stopAutoplay()}))},o.minTranslate=function(){return-o.snapGrid[0]},o.maxTranslate=function(){return-o.snapGrid[o.snapGrid.length-1]},o.updateContainerSize=function(){o.width=o.container[0].clientWidth,o.height=o.container[0].clientHeight,o.size=e()?o.width:o.height},o.updateSlidesSize=function(){o.slides=o.wrapper.children("."+o.params.slideClass),o.snapGrid=[],o.slidesGrid=[],o.slidesSizesGrid=[];var a,b=o.params.spaceBetween,c=0,d=0,f=0;"string"==typeof b&&b.indexOf("%")>=0&&(b=parseFloat(b.replace("%",""))/100*o.size),o.virtualSize=-b,o.rtl?o.slides.css({marginLeft:"",marginTop:""}):o.slides.css({marginRight:"",marginBottom:""});var g;o.params.slidesPerColumn>1&&(g=Math.floor(o.slides.length/o.params.slidesPerColumn)===o.slides.length/o.params.slidesPerColumn?o.slides.length:Math.ceil(o.slides.length/o.params.slidesPerColumn)*o.params.slidesPerColumn);var h;for(a=0;a<o.slides.length;a++){h=0;var i=o.slides.eq(a);if(o.params.slidesPerColumn>1){var j,k,l,m,n=o.params.slidesPerColumn;"column"===o.params.slidesPerColumnFill?(k=Math.floor(a/n),l=a-k*n,j=k+l*g/n,i.css({"-webkit-box-ordinal-group":j,"-moz-box-ordinal-group":j,"-ms-flex-order":j,"-webkit-order":j,order:j})):(m=g/n,l=Math.floor(a/m),k=a-l*m),i.css({"margin-top":0!==l&&o.params.spaceBetween&&o.params.spaceBetween+"px"}).attr("data-swiper-column",k).attr("data-swiper-row",l)}"none"!==i.css("display")&&("auto"===o.params.slidesPerView?h=e()?i.outerWidth(!0):i.outerHeight(!0):(h=(o.size-(o.params.slidesPerView-1)*b)/o.params.slidesPerView,e()?o.slides[a].style.width=h+"px":o.slides[a].style.height=h+"px"),o.slides[a].swiperSlideSize=h,o.slidesSizesGrid.push(h),o.params.centeredSlides?(c=c+h/2+d/2+b,0===a&&(c=c-o.size/2-b),Math.abs(c)<.001&&(c=0),f%o.params.slidesPerGroup===0&&o.snapGrid.push(c),o.slidesGrid.push(c)):(f%o.params.slidesPerGroup===0&&o.snapGrid.push(c),o.slidesGrid.push(c),c=c+h+b),o.virtualSize+=h+b,d=h,f++)}o.virtualSize=Math.max(o.virtualSize,o.size);var p;if(o.rtl&&o.wrongRTL&&("slide"===o.params.effect||"coverflow"===o.params.effect)&&o.wrapper.css({width:o.virtualSize+o.params.spaceBetween+"px"}),(!o.support.flexbox||o.params.setWrapperSize)&&(e()?o.wrapper.css({width:o.virtualSize+o.params.spaceBetween+"px"}):o.wrapper.css({height:o.virtualSize+o.params.spaceBetween+"px"})),o.params.slidesPerColumn>1&&(o.virtualSize=(h+o.params.spaceBetween)*g,o.virtualSize=Math.ceil(o.virtualSize/o.params.slidesPerColumn)-o.params.spaceBetween,o.wrapper.css({width:o.virtualSize+o.params.spaceBetween+"px"}),o.params.centeredSlides)){for(p=[],a=0;a<o.snapGrid.length;a++)o.snapGrid[a]<o.virtualSize+o.snapGrid[0]&&p.push(o.snapGrid[a]);o.snapGrid=p}if(!o.params.centeredSlides){for(p=[],a=0;a<o.snapGrid.length;a++)o.snapGrid[a]<=o.virtualSize-o.size&&p.push(o.snapGrid[a]);o.snapGrid=p,Math.floor(o.virtualSize-o.size)>Math.floor(o.snapGrid[o.snapGrid.length-1])&&o.snapGrid.push(o.virtualSize-o.size)}0===o.snapGrid.length&&(o.snapGrid=[0]),0!==o.params.spaceBetween&&(e()?o.rtl?o.slides.css({marginLeft:b+"px"}):o.slides.css({marginRight:b+"px"}):o.slides.css({marginBottom:b+"px"})),o.params.watchSlidesProgress&&o.updateSlidesOffset()},o.updateSlidesOffset=function(){for(var a=0;a<o.slides.length;a++)o.slides[a].swiperSlideOffset=e()?o.slides[a].offsetLeft:o.slides[a].offsetTop},o.updateSlidesProgress=function(a){if("undefined"==typeof a&&(a=o.translate||0),0!==o.slides.length){"undefined"==typeof o.slides[0].swiperSlideOffset&&o.updateSlidesOffset();var b=o.params.centeredSlides?-a+o.size/2:-a;o.rtl&&(b=o.params.centeredSlides?a-o.size/2:a),o.slides.removeClass(o.params.slideVisibleClass);for(var c=0;c<o.slides.length;c++){var d=o.slides[c],e=o.params.centeredSlides===!0?d.swiperSlideSize/2:0,f=(b-d.swiperSlideOffset-e)/(d.swiperSlideSize+o.params.spaceBetween);if(o.params.watchSlidesVisibility){var g=-(b-d.swiperSlideOffset-e),h=g+o.slidesSizesGrid[c],i=g>=0&&g<o.size||h>0&&h<=o.size||0>=g&&h>=o.size;i&&o.slides.eq(c).addClass(o.params.slideVisibleClass)}d.progress=o.rtl?-f:f}}},o.updateProgress=function(a){"undefined"==typeof a&&(a=o.translate||0);var b=o.maxTranslate()-o.minTranslate();0===b?(o.progress=0,o.isBeginning=o.isEnd=!0):(o.progress=(a-o.minTranslate())/b,o.isBeginning=o.progress<=0,o.isEnd=o.progress>=1),o.isBeginning&&o.emit("onReachBeginning",o),o.isEnd&&o.emit("onReachEnd",o),o.params.watchSlidesProgress&&o.updateSlidesProgress(a),o.emit("onProgress",o,o.progress)},o.updateActiveIndex=function(){var a,b,c,d=o.rtl?o.translate:-o.translate;for(b=0;b<o.slidesGrid.length;b++)"undefined"!=typeof o.slidesGrid[b+1]?d>=o.slidesGrid[b]&&d<o.slidesGrid[b+1]-(o.slidesGrid[b+1]-o.slidesGrid[b])/2?a=b:d>=o.slidesGrid[b]&&d<o.slidesGrid[b+1]&&(a=b+1):d>=o.slidesGrid[b]&&(a=b);(0>a||"undefined"==typeof a)&&(a=0),c=Math.floor(a/o.params.slidesPerGroup),c>=o.snapGrid.length&&(c=o.snapGrid.length-1),a!==o.activeIndex&&(o.snapIndex=c,o.previousIndex=o.activeIndex,o.activeIndex=a,o.updateClasses())},o.updateClasses=function(){o.slides.removeClass(o.params.slideActiveClass+" "+o.params.slideNextClass+" "+o.params.slidePrevClass);var b=o.slides.eq(o.activeIndex);if(b.addClass(o.params.slideActiveClass),b.next("."+o.params.slideClass).addClass(o.params.slideNextClass),b.prev("."+o.params.slideClass).addClass(o.params.slidePrevClass),o.bullets&&o.bullets.length>0){o.bullets.removeClass(o.params.bulletActiveClass);var c;o.params.loop?(c=Math.ceil(o.activeIndex-o.loopedSlides)/o.params.slidesPerGroup,c>o.slides.length-1-2*o.loopedSlides&&(c-=o.slides.length-2*o.loopedSlides),c>o.bullets.length-1&&(c-=o.bullets.length)):c="undefined"!=typeof o.snapIndex?o.snapIndex:o.activeIndex||0,o.paginationContainer.length>1?o.bullets.each(function(){a(this).index()===c&&a(this).addClass(o.params.bulletActiveClass)}):o.bullets.eq(c).addClass(o.params.bulletActiveClass)}o.params.loop||(o.params.prevButton&&(o.isBeginning?(a(o.params.prevButton).addClass(o.params.buttonDisabledClass),o.params.a11y&&o.a11y&&o.a11y.disable(a(o.params.prevButton))):(a(o.params.prevButton).removeClass(o.params.buttonDisabledClass),o.params.a11y&&o.a11y&&o.a11y.enable(a(o.params.prevButton)))),o.params.nextButton&&(o.isEnd?(a(o.params.nextButton).addClass(o.params.buttonDisabledClass),o.params.a11y&&o.a11y&&o.a11y.disable(a(o.params.nextButton))):(a(o.params.nextButton).removeClass(o.params.buttonDisabledClass),o.params.a11y&&o.a11y&&o.a11y.enable(a(o.params.nextButton)))))},o.updatePagination=function(){if(o.params.pagination&&o.paginationContainer&&o.paginationContainer.length>0){for(var a="",b=o.params.loop?Math.ceil((o.slides.length-2*o.loopedSlides)/o.params.slidesPerGroup):o.snapGrid.length,c=0;b>c;c++)a+=o.params.paginationBulletRender?o.params.paginationBulletRender(c,o.params.bulletClass):'<span class="'+o.params.bulletClass+'"></span>';o.paginationContainer.html(a),o.bullets=o.paginationContainer.find("."+o.params.bulletClass)}},o.update=function(a){function b(){d=Math.min(Math.max(o.translate,o.maxTranslate()),o.minTranslate()),o.setWrapperTranslate(d),o.updateActiveIndex(),o.updateClasses()}if(o.updateContainerSize(),o.updateSlidesSize(),o.updateProgress(),o.updatePagination(),o.updateClasses(),o.params.scrollbar&&o.scrollbar&&o.scrollbar.set(),a){var c,d;o.params.freeMode?b():(c="auto"===o.params.slidesPerView&&o.isEnd&&!o.params.centeredSlides?o.slideTo(o.slides.length-1,0,!1,!0):o.slideTo(o.activeIndex,0,!1,!0),c||b())}},o.onResize=function(){if(o.updateContainerSize(),o.updateSlidesSize(),o.updateProgress(),("auto"===o.params.slidesPerView||o.params.freeMode)&&o.updatePagination(),o.params.scrollbar&&o.scrollbar&&o.scrollbar.set(),o.params.freeMode){var a=Math.min(Math.max(o.translate,o.maxTranslate()),o.minTranslate());o.setWrapperTranslate(a),o.updateActiveIndex(),o.updateClasses()}else o.updateClasses(),"auto"===o.params.slidesPerView&&o.isEnd&&!o.params.centeredSlides?o.slideTo(o.slides.length-1,0,!1,!0):o.slideTo(o.activeIndex,0,!1,!0)};var p=["mousedown","mousemove","mouseup"];window.navigator.pointerEnabled?p=["pointerdown","pointermove","pointerup"]:window.navigator.msPointerEnabled&&(p=["MSPointerDown","MSPointerMove","MSPointerUp"]),o.touchEvents={start:o.support.touch||!o.params.simulateTouch?"touchstart":p[0],move:o.support.touch||!o.params.simulateTouch?"touchmove":p[1],end:o.support.touch||!o.params.simulateTouch?"touchend":p[2]},(window.navigator.pointerEnabled||window.navigator.msPointerEnabled)&&("container"===o.params.touchEventsTarget?o.container:o.wrapper).addClass("swiper-wp8-"+o.params.direction),o.initEvents=function(b){var c=b?"off":"on",e=b?"removeEventListener":"addEventListener",f="container"===o.params.touchEventsTarget?o.container[0]:o.wrapper[0],g=o.support.touch?f:document,h=o.params.nested?!0:!1;o.browser.ie?(f[e](o.touchEvents.start,o.onTouchStart,!1),g[e](o.touchEvents.move,o.onTouchMove,h),g[e](o.touchEvents.end,o.onTouchEnd,!1)):(o.support.touch&&(f[e](o.touchEvents.start,o.onTouchStart,!1),f[e](o.touchEvents.move,o.onTouchMove,h),f[e](o.touchEvents.end,o.onTouchEnd,!1)),!d.simulateTouch||o.device.ios||o.device.android||(f[e]("mousedown",o.onTouchStart,!1),g[e]("mousemove",o.onTouchMove,h),g[e]("mouseup",o.onTouchEnd,!1))),window[e]("resize",o.onResize),o.params.nextButton&&(a(o.params.nextButton)[c]("click",o.onClickNext),o.params.a11y&&o.a11y&&a(o.params.nextButton)[c]("keydown",o.a11y.onEnterKey)),o.params.prevButton&&(a(o.params.prevButton)[c]("click",o.onClickPrev),o.params.a11y&&o.a11y&&a(o.params.prevButton)[c]("keydown",o.a11y.onEnterKey)),o.params.pagination&&o.params.paginationClickable&&a(o.paginationContainer)[c]("click","."+o.params.bulletClass,o.onClickIndex),(o.params.preventClicks||o.params.preventClicksPropagation)&&f[e]("click",o.preventClicks,!0)},o.attachEvents=function(){o.initEvents()},o.detachEvents=function(){o.initEvents(!0)},o.allowClick=!0,o.preventClicks=function(a){o.allowClick||(o.params.preventClicks&&a.preventDefault(),o.params.preventClicksPropagation&&(a.stopPropagation(),a.stopImmediatePropagation()))},o.onClickNext=function(a){a.preventDefault(),o.slideNext()},o.onClickPrev=function(a){a.preventDefault(),o.slidePrev()},o.onClickIndex=function(b){b.preventDefault();var c=a(this).index()*o.params.slidesPerGroup;o.params.loop&&(c+=o.loopedSlides),o.slideTo(c)},o.updateClickedSlide=function(b){var c=g(b,"."+o.params.slideClass);if(!c)return o.clickedSlide=void 0,void(o.clickedIndex=void 0);if(o.clickedSlide=c,o.clickedIndex=a(c).index(),o.params.slideToClickedSlide&&void 0!==o.clickedIndex&&o.clickedIndex!==o.activeIndex){var d,e=o.clickedIndex;if(o.params.loop)if(d=a(o.clickedSlide).attr("data-swiper-slide-index"),e>o.slides.length-o.params.slidesPerView)o.fixLoop(),e=o.wrapper.children("."+o.params.slideClass+'[data-swiper-slide-index="'+d+'"]').eq(0).index(),setTimeout(function(){o.slideTo(e)},0);else if(e<o.params.slidesPerView-1){o.fixLoop();var f=o.wrapper.children("."+o.params.slideClass+'[data-swiper-slide-index="'+d+'"]');e=f.eq(f.length-1).index(),setTimeout(function(){o.slideTo(e)},0)}else o.slideTo(e);else o.slideTo(e)}};var q,r,s,t,u,v,w,x,y,z="input, select, textarea, button",A=Date.now(),B=[];o.animating=!1,o.touches={startX:0,startY:0,currentX:0,currentY:0,diff:0};var C,D;o.onTouchStart=function(b){if(b.originalEvent&&(b=b.originalEvent),C="touchstart"===b.type,C||!("which"in b)||3!==b.which){if(o.params.noSwiping&&g(b,"."+o.params.noSwipingClass))return void(o.allowClick=!0);if(!o.params.swipeHandler||g(b,o.params.swipeHandler)){if(q=!0,r=!1,t=void 0,D=void 0,o.touches.startX=o.touches.currentX="touchstart"===b.type?b.targetTouches[0].pageX:b.pageX,o.touches.startY=o.touches.currentY="touchstart"===b.type?b.targetTouches[0].pageY:b.pageY,s=Date.now(),o.allowClick=!0,o.updateContainerSize(),o.swipeDirection=void 0,o.params.threshold>0&&(w=!1),"touchstart"!==b.type){var c=!0;a(b.target).is(z)&&(c=!1),document.activeElement&&a(document.activeElement).is(z)&&document.activeElement.blur(),c&&b.preventDefault()}o.emit("onTouchStart",o,b)}}},o.onTouchMove=function(b){if(b.originalEvent&&(b=b.originalEvent),!(C&&"mousemove"===b.type||b.preventedByNestedSwiper)){if(o.params.onlyExternal)return r=!0,void(o.allowClick=!1);if(C&&document.activeElement&&b.target===document.activeElement&&a(b.target).is(z))return r=!0,void(o.allowClick=!1);if(o.emit("onTouchMove",o,b),!(b.targetTouches&&b.targetTouches.length>1)){if(o.touches.currentX="touchmove"===b.type?b.targetTouches[0].pageX:b.pageX,o.touches.currentY="touchmove"===b.type?b.targetTouches[0].pageY:b.pageY,"undefined"==typeof t){var c=180*Math.atan2(Math.abs(o.touches.currentY-o.touches.startY),Math.abs(o.touches.currentX-o.touches.startX))/Math.PI;t=e()?c>o.params.touchAngle:90-c>o.params.touchAngle}if(t&&o.emit("onTouchMoveOpposite",o,b),"undefined"==typeof D&&o.browser.ieTouch&&(o.touches.currentX!==o.touches.startX||o.touches.currentY!==o.touches.startY)&&(D=!0),q){if(t)return void(q=!1);if(D||!o.browser.ieTouch){o.allowClick=!1,o.emit("onSliderMove",o,b),b.preventDefault(),o.params.touchMoveStopPropagation&&!o.params.nested&&b.stopPropagation(),r||(d.loop&&o.fixLoop(),v=o.getWrapperTranslate(),o.setWrapperTransition(0),o.animating&&o.wrapper.trigger("webkitTransitionEnd transitionend oTransitionEnd MSTransitionEnd msTransitionEnd"),o.params.autoplay&&o.autoplaying&&(o.params.autoplayDisableOnInteraction?o.stopAutoplay():o.pauseAutoplay()),y=!1,o.params.grabCursor&&(o.container[0].style.cursor="move",o.container[0].style.cursor="-webkit-grabbing",o.container[0].style.cursor="-moz-grabbin",o.container[0].style.cursor="grabbing")),r=!0;var f=o.touches.diff=e()?o.touches.currentX-o.touches.startX:o.touches.currentY-o.touches.startY;f*=o.params.touchRatio,o.rtl&&(f=-f),o.swipeDirection=f>0?"prev":"next",u=f+v;var g=!0;if(f>0&&u>o.minTranslate()?(g=!1,o.params.resistance&&(u=o.minTranslate()-1+Math.pow(-o.minTranslate()+v+f,o.params.resistanceRatio))):0>f&&u<o.maxTranslate()&&(g=!1,o.params.resistance&&(u=o.maxTranslate()+1-Math.pow(o.maxTranslate()-v-f,o.params.resistanceRatio))),g&&(b.preventedByNestedSwiper=!0),!o.params.allowSwipeToNext&&"next"===o.swipeDirection&&v>u&&(u=v),!o.params.allowSwipeToPrev&&"prev"===o.swipeDirection&&u>v&&(u=v),o.params.followFinger){if(o.params.threshold>0){if(!(Math.abs(f)>o.params.threshold||w))return void(u=v);if(!w)return w=!0,o.touches.startX=o.touches.currentX,o.touches.startY=o.touches.currentY,u=v,void(o.touches.diff=e()?o.touches.currentX-o.touches.startX:o.touches.currentY-o.touches.startY)}(o.params.freeMode||o.params.watchSlidesProgress)&&o.updateActiveIndex(),o.params.freeMode&&(0===B.length&&B.push({position:o.touches[e()?"startX":"startY"],time:s}),B.push({position:o.touches[e()?"currentX":"currentY"],time:(new Date).getTime()})),o.updateProgress(u),o.setWrapperTranslate(u)}}}}}},o.onTouchEnd=function(b){if(b.originalEvent&&(b=b.originalEvent),o.emit("onTouchEnd",o,b),q){o.params.grabCursor&&r&&q&&(o.container[0].style.cursor="move",o.container[0].style.cursor="-webkit-grab",o.container[0].style.cursor="-moz-grab",o.container[0].style.cursor="grab");var c=Date.now(),d=c-s;if(o.allowClick&&(o.updateClickedSlide(b),o.emit("onTap",o,b),300>d&&c-A>300&&(x&&clearTimeout(x),x=setTimeout(function(){o&&(o.params.paginationHide&&o.paginationContainer.length>0&&!a(b.target).hasClass(o.params.bulletClass)&&o.paginationContainer.toggleClass(o.params.paginationHiddenClass),o.emit("onClick",o,b))},300)),300>d&&300>c-A&&(x&&clearTimeout(x),o.emit("onDoubleTap",o,b))),A=Date.now(),setTimeout(function(){o&&o.allowClick&&(o.allowClick=!0)},0),!q||!r||!o.swipeDirection||0===o.touches.diff||u===v)return void(q=r=!1);q=r=!1;var e;if(e=o.params.followFinger?o.rtl?o.translate:-o.translate:-u,o.params.freeMode){if(e<-o.minTranslate())return void o.slideTo(o.activeIndex);if(e>-o.maxTranslate())return void o.slideTo(o.slides.length-1);if(o.params.freeModeMomentum){if(B.length>1){var f=B.pop(),g=B.pop(),h=f.position-g.position,i=f.time-g.time;o.velocity=h/i,o.velocity=o.velocity/2,Math.abs(o.velocity)<.02&&(o.velocity=0),(i>150||(new Date).getTime()-f.time>300)&&(o.velocity=0)}else o.velocity=0;B.length=0;var j=1e3*o.params.freeModeMomentumRatio,k=o.velocity*j,l=o.translate+k;o.rtl&&(l=-l);var m,n=!1,p=20*Math.abs(o.velocity)*o.params.freeModeMomentumBounceRatio;l<o.maxTranslate()&&(o.params.freeModeMomentumBounce?(l+o.maxTranslate()<-p&&(l=o.maxTranslate()-p),m=o.maxTranslate(),n=!0,y=!0):l=o.maxTranslate()),l>o.minTranslate()&&(o.params.freeModeMomentumBounce?(l-o.minTranslate()>p&&(l=o.minTranslate()+p),m=o.minTranslate(),n=!0,y=!0):l=o.minTranslate()),0!==o.velocity&&(j=o.rtl?Math.abs((-l-o.translate)/o.velocity):Math.abs((l-o.translate)/o.velocity)),o.params.freeModeMomentumBounce&&n?(o.updateProgress(m),o.setWrapperTransition(j),o.setWrapperTranslate(l),o.onTransitionStart(),o.animating=!0,o.wrapper.transitionEnd(function(){y&&(o.emit("onMomentumBounce",o),o.setWrapperTransition(o.params.speed),o.setWrapperTranslate(m),o.wrapper.transitionEnd(function(){o.onTransitionEnd()}))})):o.velocity?(o.updateProgress(l),o.setWrapperTransition(j),o.setWrapperTranslate(l),o.onTransitionStart(),o.animating||(o.animating=!0,o.wrapper.transitionEnd(function(){o.onTransitionEnd()}))):o.updateProgress(l),o.updateActiveIndex()}return void((!o.params.freeModeMomentum||d>=o.params.longSwipesMs)&&(o.updateProgress(),o.updateActiveIndex()))}var t,w=0,z=o.slidesSizesGrid[0];for(t=0;t<o.slidesGrid.length;t+=o.params.slidesPerGroup)"undefined"!=typeof o.slidesGrid[t+o.params.slidesPerGroup]?e>=o.slidesGrid[t]&&e<o.slidesGrid[t+o.params.slidesPerGroup]&&(w=t,z=o.slidesGrid[t+o.params.slidesPerGroup]-o.slidesGrid[t]):e>=o.slidesGrid[t]&&(w=t,z=o.slidesGrid[o.slidesGrid.length-1]-o.slidesGrid[o.slidesGrid.length-2]);var C=(e-o.slidesGrid[w])/z;if(d>o.params.longSwipesMs){if(!o.params.longSwipes)return void o.slideTo(o.activeIndex);"next"===o.swipeDirection&&(C>=o.params.longSwipesRatio?o.slideTo(w+o.params.slidesPerGroup):o.slideTo(w)),"prev"===o.swipeDirection&&(C>1-o.params.longSwipesRatio?o.slideTo(w+o.params.slidesPerGroup):o.slideTo(w))}else{if(!o.params.shortSwipes)return void o.slideTo(o.activeIndex);"next"===o.swipeDirection&&o.slideTo(w+o.params.slidesPerGroup),"prev"===o.swipeDirection&&o.slideTo(w)}}},o._slideTo=function(a,b){return o.slideTo(a,b,!0,!0)},o.slideTo=function(a,b,c,d){"undefined"==typeof c&&(c=!0),"undefined"==typeof a&&(a=0),0>a&&(a=0),o.snapIndex=Math.floor(a/o.params.slidesPerGroup),o.snapIndex>=o.snapGrid.length&&(o.snapIndex=o.snapGrid.length-1);var e=-o.snapGrid[o.snapIndex];o.params.autoplay&&o.autoplaying&&(d||!o.params.autoplayDisableOnInteraction?o.pauseAutoplay(b):o.stopAutoplay()),o.updateProgress(e);for(var f=0;f<o.slidesGrid.length;f++)-e>=o.slidesGrid[f]&&(a=f);return"undefined"==typeof b&&(b=o.params.speed),o.previousIndex=o.activeIndex||0,o.activeIndex=a,e===o.translate?(o.updateClasses(),!1):(o.onTransitionStart(c),0===b?(o.setWrapperTransition(0),o.setWrapperTranslate(e),o.onTransitionEnd(c)):(o.setWrapperTransition(b),o.setWrapperTranslate(e),o.animating||(o.animating=!0,o.wrapper.transitionEnd(function(){o.onTransitionEnd(c)}))),o.updateClasses(),!0)},o.onTransitionStart=function(a){"undefined"==typeof a&&(a=!0),o.lazy&&o.lazy.onTransitionStart(),a&&(o.emit("onTransitionStart",o),o.activeIndex!==o.previousIndex&&o.emit("onSlideChangeStart",o))},o.onTransitionEnd=function(a){o.animating=!1,o.setWrapperTransition(0),"undefined"==typeof a&&(a=!0),o.lazy&&o.lazy.onTransitionEnd(),a&&(o.emit("onTransitionEnd",o),o.activeIndex!==o.previousIndex&&o.emit("onSlideChangeEnd",o)),o.params.hashnav&&o.hashnav&&o.hashnav.setHash()},o.slideNext=function(a,b,c){return o.params.loop?o.animating?!1:(o.fixLoop(),o.slideTo(o.activeIndex+o.params.slidesPerGroup,b,a,c)):o.slideTo(o.activeIndex+o.params.slidesPerGroup,b,a,c)},o._slideNext=function(a){return o.slideNext(!0,a,!0)},o.slidePrev=function(a,b,c){return o.params.loop?o.animating?!1:(o.fixLoop(),o.slideTo(o.activeIndex-1,b,a,c)):o.slideTo(o.activeIndex-1,b,a,c)},o._slidePrev=function(a){return o.slidePrev(!0,a,!0)},o.slideReset=function(a,b){return o.slideTo(o.activeIndex,b,a)},o.setWrapperTransition=function(a,b){o.wrapper.transition(a),"slide"!==o.params.effect&&o.effects[o.params.effect]&&o.effects[o.params.effect].setTransition(a),o.params.parallax&&o.parallax&&o.parallax.setTransition(a),o.params.scrollbar&&o.scrollbar&&o.scrollbar.setTransition(a),o.params.control&&o.controller&&o.controller.setTransition(a,b),o.emit("onSetTransition",o,a)},o.setWrapperTranslate=function(a,b,c){var d=0,f=0,g=0;e()?d=o.rtl?-a:a:f=a,o.params.virtualTranslate||(o.support.transforms3d?o.wrapper.transform("translate3d("+d+"px, "+f+"px, "+g+"px)"):o.wrapper.transform("translate("+d+"px, "+f+"px)")),o.translate=e()?d:f,b&&o.updateActiveIndex(),"slide"!==o.params.effect&&o.effects[o.params.effect]&&o.effects[o.params.effect].setTranslate(o.translate),o.params.parallax&&o.parallax&&o.parallax.setTranslate(o.translate),o.params.scrollbar&&o.scrollbar&&o.scrollbar.setTranslate(o.translate),o.params.control&&o.controller&&o.controller.setTranslate(o.translate,c),o.emit("onSetTranslate",o,o.translate)},o.getTranslate=function(a,b){var c,d,e,f;return"undefined"==typeof b&&(b="x"),o.params.virtualTranslate?o.rtl?-o.translate:o.translate:(e=window.getComputedStyle(a,null),window.WebKitCSSMatrix?f=new WebKitCSSMatrix("none"===e.webkitTransform?"":e.webkitTransform):(f=e.MozTransform||e.OTransform||e.MsTransform||e.msTransform||e.transform||e.getPropertyValue("transform").replace("translate(","matrix(1, 0, 0, 1,"),c=f.toString().split(",")),"x"===b&&(d=window.WebKitCSSMatrix?f.m41:16===c.length?parseFloat(c[12]):parseFloat(c[4])),"y"===b&&(d=window.WebKitCSSMatrix?f.m42:16===c.length?parseFloat(c[13]):parseFloat(c[5])),o.rtl&&d&&(d=-d),d||0)},o.getWrapperTranslate=function(a){return"undefined"==typeof a&&(a=e()?"x":"y"),o.getTranslate(o.wrapper[0],a)},o.observers=[],o.initObservers=function(){if(o.params.observeParents)for(var a=o.container.parents(),b=0;b<a.length;b++)h(a[b]);h(o.container[0],{childList:!1}),h(o.wrapper[0],{attributes:!1})},o.disconnectObservers=function(){for(var a=0;a<o.observers.length;a++)o.observers[a].disconnect();o.observers=[]},o.createLoop=function(){o.wrapper.children("."+o.params.slideClass+"."+o.params.slideDuplicateClass).remove();var b=o.wrapper.children("."+o.params.slideClass);o.loopedSlides=parseInt(o.params.loopedSlides||o.params.slidesPerView,10),o.loopedSlides=o.loopedSlides+o.params.loopAdditionalSlides,o.loopedSlides>b.length&&(o.loopedSlides=b.length);var c,d=[],e=[];for(b.each(function(c,f){var g=a(this);c<o.loopedSlides&&e.push(f),c<b.length&&c>=b.length-o.loopedSlides&&d.push(f),g.attr("data-swiper-slide-index",c)}),c=0;c<e.length;c++)o.wrapper.append(a(e[c].cloneNode(!0)).addClass(o.params.slideDuplicateClass));for(c=d.length-1;c>=0;c--)o.wrapper.prepend(a(d[c].cloneNode(!0)).addClass(o.params.slideDuplicateClass))},o.destroyLoop=function(){o.wrapper.children("."+o.params.slideClass+"."+o.params.slideDuplicateClass).remove(),o.slides.removeAttr("data-swiper-slide-index")},o.fixLoop=function(){var a;o.activeIndex<o.loopedSlides?(a=o.slides.length-3*o.loopedSlides+o.activeIndex,a+=o.loopedSlides,o.slideTo(a,0,!1,!0)):("auto"===o.params.slidesPerView&&o.activeIndex>=2*o.loopedSlides||o.activeIndex>o.slides.length-2*o.params.slidesPerView)&&(a=-o.slides.length+o.activeIndex+o.loopedSlides,a+=o.loopedSlides,o.slideTo(a,0,!1,!0))},o.appendSlide=function(a){if(o.params.loop&&o.destroyLoop(),"object"==typeof a&&a.length)for(var b=0;b<a.length;b++)a[b]&&o.wrapper.append(a[b]);else o.wrapper.append(a);o.params.loop&&o.createLoop(),o.params.observer&&o.support.observer||o.update(!0)},o.prependSlide=function(a){o.params.loop&&o.destroyLoop();var b=o.activeIndex+1;if("object"==typeof a&&a.length){for(var c=0;c<a.length;c++)a[c]&&o.wrapper.prepend(a[c]);b=o.activeIndex+a.length}else o.wrapper.prepend(a);o.params.loop&&o.createLoop(),o.params.observer&&o.support.observer||o.update(!0),o.slideTo(b,0,!1)},o.removeSlide=function(a){o.params.loop&&o.destroyLoop();var b,c=o.activeIndex;if("object"==typeof a&&a.length){for(var d=0;d<a.length;d++)b=a[d],o.slides[b]&&o.slides.eq(b).remove(),c>b&&c--;c=Math.max(c,0)}else b=a,o.slides[b]&&o.slides.eq(b).remove(),c>b&&c--,c=Math.max(c,0);o.params.observer&&o.support.observer||o.update(!0),o.slideTo(c,0,!1)},o.removeAllSlides=function(){for(var a=[],b=0;b<o.slides.length;b++)a.push(b);o.removeSlide(a)},o.effects={fade:{fadeIndex:null,setTranslate:function(){for(var a=0;a<o.slides.length;a++){var b=o.slides.eq(a),c=b[0].swiperSlideOffset,d=-c;o.params.virtualTranslate||(d-=o.translate);var f=0;e()||(f=d,d=0);var g=o.params.fade.crossFade?Math.max(1-Math.abs(b[0].progress),0):1+Math.min(Math.max(b[0].progress,-1),0);g>0&&1>g&&(o.effects.fade.fadeIndex=a),b.css({opacity:g}).transform("translate3d("+d+"px, "+f+"px, 0px)")}},setTransition:function(a){if(o.slides.transition(a),o.params.virtualTranslate&&0!==a){var b=null!==o.effects.fade.fadeIndex?o.effects.fade.fadeIndex:o.activeIndex;o.slides.eq(b).transitionEnd(function(){for(var a=["webkitTransitionEnd","transitionend","oTransitionEnd","MSTransitionEnd","msTransitionEnd"],b=0;b<a.length;b++)o.wrapper.trigger(a[b])})}}},cube:{setTranslate:function(){var b,c=0;o.params.cube.shadow&&(e()?(b=o.wrapper.find(".swiper-cube-shadow"),0===b.length&&(b=a('<div class="swiper-cube-shadow"></div>'),o.wrapper.append(b)),b.css({height:o.width+"px"})):(b=o.container.find(".swiper-cube-shadow"),0===b.length&&(b=a('<div class="swiper-cube-shadow"></div>'),o.container.append(b))));for(var d=0;d<o.slides.length;d++){var f=o.slides.eq(d),g=90*d,h=Math.floor(g/360);o.rtl&&(g=-g,h=Math.floor(-g/360));var i=Math.max(Math.min(f[0].progress,1),-1),j=0,k=0,l=0;d%4===0?(j=4*-h*o.size,l=0):(d-1)%4===0?(j=0,l=4*-h*o.size):(d-2)%4===0?(j=o.size+4*h*o.size,l=o.size):(d-3)%4===0&&(j=-o.size,l=3*o.size+4*o.size*h),o.rtl&&(j=-j),e()||(k=j,j=0);var m="rotateX("+(e()?0:-g)+"deg) rotateY("+(e()?g:0)+"deg) translate3d("+j+"px, "+k+"px, "+l+"px)";if(1>=i&&i>-1&&(c=90*d+90*i,o.rtl&&(c=90*-d-90*i)),f.transform(m),o.params.cube.slideShadows){var n=e()?f.find(".swiper-slide-shadow-left"):f.find(".swiper-slide-shadow-top"),p=e()?f.find(".swiper-slide-shadow-right"):f.find(".swiper-slide-shadow-bottom");0===n.length&&(n=a('<div class="swiper-slide-shadow-'+(e()?"left":"top")+'"></div>'),f.append(n)),0===p.length&&(p=a('<div class="swiper-slide-shadow-'+(e()?"right":"bottom")+'"></div>'),f.append(p)),n.length&&(n[0].style.opacity=-f[0].progress),p.length&&(p[0].style.opacity=f[0].progress)}}if(o.wrapper.css({"-webkit-transform-origin":"50% 50% -"+o.size/2+"px","-moz-transform-origin":"50% 50% -"+o.size/2+"px","-ms-transform-origin":"50% 50% -"+o.size/2+"px",
"transform-origin":"50% 50% -"+o.size/2+"px"}),o.params.cube.shadow)if(e())b.transform("translate3d(0px, "+(o.width/2+o.params.cube.shadowOffset)+"px, "+-o.width/2+"px) rotateX(90deg) rotateZ(0deg) scale("+o.params.cube.shadowScale+")");else{var q=Math.abs(c)-90*Math.floor(Math.abs(c)/90),r=1.5-(Math.sin(2*q*Math.PI/360)/2+Math.cos(2*q*Math.PI/360)/2),s=o.params.cube.shadowScale,t=o.params.cube.shadowScale/r,u=o.params.cube.shadowOffset;b.transform("scale3d("+s+", 1, "+t+") translate3d(0px, "+(o.height/2+u)+"px, "+-o.height/2/t+"px) rotateX(-90deg)")}var v=o.isSafari||o.isUiWebView?-o.size/2:0;o.wrapper.transform("translate3d(0px,0,"+v+"px) rotateX("+(e()?0:c)+"deg) rotateY("+(e()?-c:0)+"deg)")},setTransition:function(a){o.slides.transition(a).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(a),o.params.cube.shadow&&!e()&&o.container.find(".swiper-cube-shadow").transition(a)}},coverflow:{setTranslate:function(){for(var b=o.translate,c=e()?-b+o.width/2:-b+o.height/2,d=e()?o.params.coverflow.rotate:-o.params.coverflow.rotate,f=o.params.coverflow.depth,g=0,h=o.slides.length;h>g;g++){var i=o.slides.eq(g),j=o.slidesSizesGrid[g],k=i[0].swiperSlideOffset,l=(c-k-j/2)/j*o.params.coverflow.modifier,m=e()?d*l:0,n=e()?0:d*l,p=-f*Math.abs(l),q=e()?0:o.params.coverflow.stretch*l,r=e()?o.params.coverflow.stretch*l:0;Math.abs(r)<.001&&(r=0),Math.abs(q)<.001&&(q=0),Math.abs(p)<.001&&(p=0),Math.abs(m)<.001&&(m=0),Math.abs(n)<.001&&(n=0);var s="translate3d("+r+"px,"+q+"px,"+p+"px)  rotateX("+n+"deg) rotateY("+m+"deg)";if(i.transform(s),i[0].style.zIndex=-Math.abs(Math.round(l))+1,o.params.coverflow.slideShadows){var t=e()?i.find(".swiper-slide-shadow-left"):i.find(".swiper-slide-shadow-top"),u=e()?i.find(".swiper-slide-shadow-right"):i.find(".swiper-slide-shadow-bottom");0===t.length&&(t=a('<div class="swiper-slide-shadow-'+(e()?"left":"top")+'"></div>'),i.append(t)),0===u.length&&(u=a('<div class="swiper-slide-shadow-'+(e()?"right":"bottom")+'"></div>'),i.append(u)),t.length&&(t[0].style.opacity=l>0?l:0),u.length&&(u[0].style.opacity=-l>0?-l:0)}}if(o.browser.ie){var v=o.wrapper[0].style;v.perspectiveOrigin=c+"px 50%"}},setTransition:function(a){o.slides.transition(a).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(a)}}},o.lazy={initialImageLoaded:!1,loadImageInSlide:function(b){if("undefined"!=typeof b&&0!==o.slides.length){var c=o.slides.eq(b),d=c.find("img.swiper-lazy:not(.swiper-lazy-loaded):not(.swiper-lazy-loading)");0!==d.length&&d.each(function(){var b=a(this);b.addClass("swiper-lazy-loading");var d=b.attr("data-src");o.loadImage(b[0],d,!1,function(){b.attr("src",d),b.removeAttr("data-src"),b.addClass("swiper-lazy-loaded").removeClass("swiper-lazy-loading"),c.find(".swiper-lazy-preloader, .preloader").remove(),o.emit("onLazyImageReady",o,c[0],b[0])}),o.emit("onLazyImageLoad",o,c[0],b[0])})}},load:function(){if(o.params.watchSlidesVisibility)o.wrapper.children("."+o.params.slideVisibleClass).each(function(){o.lazy.loadImageInSlide(a(this).index())});else if(o.params.slidesPerView>1)for(var b=o.activeIndex;b<o.activeIndex+o.params.slidesPerView;b++)o.slides[b]&&o.lazy.loadImageInSlide(b);else o.lazy.loadImageInSlide(o.activeIndex);if(o.params.lazyLoadingInPrevNext){var c=o.wrapper.children("."+o.params.slideNextClass);c.length>0&&o.lazy.loadImageInSlide(c.index());var d=o.wrapper.children("."+o.params.slidePrevClass);d.length>0&&o.lazy.loadImageInSlide(d.index())}},onTransitionStart:function(){o.params.lazyLoading&&(o.params.lazyLoadingOnTransitionStart||!o.params.lazyLoadingOnTransitionStart&&!o.lazy.initialImageLoaded)&&(o.lazy.initialImageLoaded=!0,o.lazy.load())},onTransitionEnd:function(){o.params.lazyLoading&&!o.params.lazyLoadingOnTransitionStart&&o.lazy.load()}},o.scrollbar={set:function(){if(o.params.scrollbar){var b=o.scrollbar;b.track=a(o.params.scrollbar),b.drag=b.track.find(".swiper-scrollbar-drag"),0===b.drag.length&&(b.drag=a('<div class="swiper-scrollbar-drag"></div>'),b.track.append(b.drag)),b.drag[0].style.width="",b.drag[0].style.height="",b.trackSize=e()?b.track[0].offsetWidth:b.track[0].offsetHeight,b.divider=o.size/o.virtualSize,b.moveDivider=b.divider*(b.trackSize/o.size),b.dragSize=b.trackSize*b.divider,e()?b.drag[0].style.width=b.dragSize+"px":b.drag[0].style.height=b.dragSize+"px",b.divider>=1?b.track[0].style.display="none":b.track[0].style.display="",o.params.scrollbarHide&&(b.track[0].style.opacity=0)}},setTranslate:function(){if(o.params.scrollbar){var a,b=o.scrollbar,c=b.dragSize;a=(b.trackSize-b.dragSize)*o.progress,o.rtl&&e()?(a=-a,a>0?(c=b.dragSize-a,a=0):-a+b.dragSize>b.trackSize&&(c=b.trackSize+a)):0>a?(c=b.dragSize+a,a=0):a+b.dragSize>b.trackSize&&(c=b.trackSize-a),e()?(o.support.transforms3d?b.drag.transform("translate3d("+a+"px, 0, 0)"):b.drag.transform("translateX("+a+"px)"),b.drag[0].style.width=c+"px"):(o.support.transforms3d?b.drag.transform("translate3d(0px, "+a+"px, 0)"):b.drag.transform("translateY("+a+"px)"),b.drag[0].style.height=c+"px"),o.params.scrollbarHide&&(clearTimeout(b.timeout),b.track[0].style.opacity=1,b.timeout=setTimeout(function(){b.track[0].style.opacity=0,b.track.transition(400)},1e3))}},setTransition:function(a){o.params.scrollbar&&o.scrollbar.drag.transition(a)}},o.controller={setTranslate:function(a,c){var d,e,f=o.params.control;if(o.isArray(f))for(var g=0;g<f.length;g++)f[g]!==c&&f[g]instanceof b&&(a=f[g].rtl&&"horizontal"===f[g].params.direction?-o.translate:o.translate,d=(f[g].maxTranslate()-f[g].minTranslate())/(o.maxTranslate()-o.minTranslate()),e=(a-o.minTranslate())*d+f[g].minTranslate(),o.params.controlInverse&&(e=f[g].maxTranslate()-e),f[g].updateProgress(e),f[g].setWrapperTranslate(e,!1,o),f[g].updateActiveIndex());else f instanceof b&&c!==f&&(a=f.rtl&&"horizontal"===f.params.direction?-o.translate:o.translate,d=(f.maxTranslate()-f.minTranslate())/(o.maxTranslate()-o.minTranslate()),e=(a-o.minTranslate())*d+f.minTranslate(),o.params.controlInverse&&(e=f.maxTranslate()-e),f.updateProgress(e),f.setWrapperTranslate(e,!1,o),f.updateActiveIndex())},setTransition:function(a,c){var d=o.params.control;if(o.isArray(d))for(var e=0;e<d.length;e++)d[e]!==c&&d[e]instanceof b&&d[e].setWrapperTransition(a,o);else d instanceof b&&c!==d&&d.setWrapperTransition(a,o)}},o.parallax={setTranslate:function(){o.container.children("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function(){i(this,o.progress)}),o.slides.each(function(){var b=a(this);b.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function(){var a=Math.min(Math.max(b[0].progress,-1),1);i(this,a)})})},setTransition:function(b){"undefined"==typeof b&&(b=o.params.speed),o.container.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function(){var c=a(this),d=parseInt(c.attr("data-swiper-parallax-duration"),10)||b;0===b&&(d=0),c.transition(d)})}},o._plugins=[];for(var E in o.plugins)if(o.plugins.hasOwnProperty(E)){var F=o.plugins[E](o,o.params[E]);F&&o._plugins.push(F)}return o.callPlugins=function(a){for(var b=0;b<o._plugins.length;b++)a in o._plugins[b]&&o._plugins[b][a](arguments[1],arguments[2],arguments[3],arguments[4],arguments[5])},o.emitterEventListeners={},o.emit=function(a){o.params[a]&&o.params[a](arguments[1],arguments[2],arguments[3],arguments[4],arguments[5]);var b;if(o){if(o.emitterEventListeners[a])for(b=0;b<o.emitterEventListeners[a].length;b++)o.emitterEventListeners[a][b](arguments[1],arguments[2],arguments[3],arguments[4],arguments[5]);o.callPlugins&&o.callPlugins(a,arguments[1],arguments[2],arguments[3],arguments[4],arguments[5])}},o.on=function(a,b){return a=j(a),o.emitterEventListeners[a]||(o.emitterEventListeners[a]=[]),o.emitterEventListeners[a].push(b),o},o.off=function(a,b){var c;if(a=j(a),"undefined"==typeof b)return o.emitterEventListeners[a]=[],o;if(o.emitterEventListeners[a]&&0!==o.emitterEventListeners[a].length){for(c=0;c<o.emitterEventListeners[a].length;c++)o.emitterEventListeners[a][c]===b&&o.emitterEventListeners[a].splice(c,1);return o}},o.once=function(a,b){a=j(a);var c=function(){b(arguments[0],arguments[1],arguments[2],arguments[3],arguments[4]),o.off(a,c)};return o.on(a,c),o},o.a11y={makeFocusable:function(a){return a[0].tabIndex="0",a},addRole:function(a,b){return a.attr("role",b),a},addLabel:function(a,b){return a.attr("aria-label",b),a},disable:function(a){return a.attr("aria-disabled",!0),a},enable:function(a){return a.attr("aria-disabled",!1),a},onEnterKey:function(b){13===b.keyCode&&(a(b.target).is(o.params.nextButton)?(o.onClickNext(b),o.isEnd?o.a11y.notify(o.params.lastSlideMsg):o.a11y.notify(o.params.nextSlideMsg)):a(b.target).is(o.params.prevButton)&&(o.onClickPrev(b),o.isBeginning?o.a11y.notify(o.params.firstSlideMsg):o.a11y.notify(o.params.prevSlideMsg)))},liveRegion:a('<span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>'),notify:function(a){var b=o.a11y.liveRegion;0!==b.length&&(b.html(""),b.html(a))},init:function(){if(o.params.nextButton){var b=a(o.params.nextButton);o.a11y.makeFocusable(b),o.a11y.addRole(b,"button"),o.a11y.addLabel(b,o.params.nextSlideMsg)}if(o.params.prevButton){var c=a(o.params.prevButton);o.a11y.makeFocusable(c),o.a11y.addRole(c,"button"),o.a11y.addLabel(c,o.params.prevSlideMsg)}a(o.container).append(o.a11y.liveRegion)},destroy:function(){o.a11y.liveRegion&&o.a11y.liveRegion.length>0&&o.a11y.liveRegion.remove()}},o.init=function(){o.params.loop&&o.createLoop(),o.updateContainerSize(),o.updateSlidesSize(),o.updatePagination(),o.params.scrollbar&&o.scrollbar&&o.scrollbar.set(),"slide"!==o.params.effect&&o.effects[o.params.effect]&&(o.params.loop||o.updateProgress(),o.effects[o.params.effect].setTranslate()),o.params.loop?o.slideTo(o.params.initialSlide+o.loopedSlides,0,o.params.runCallbacksOnInit):(o.slideTo(o.params.initialSlide,0,o.params.runCallbacksOnInit),0===o.params.initialSlide&&(o.parallax&&o.params.parallax&&o.parallax.setTranslate(),o.lazy&&o.params.lazyLoading&&o.lazy.load())),o.attachEvents(),o.params.observer&&o.support.observer&&o.initObservers(),o.params.preloadImages&&!o.params.lazyLoading&&o.preloadImages(),o.params.autoplay&&o.startAutoplay(),o.params.keyboardControl&&o.enableKeyboardControl&&o.enableKeyboardControl(),o.params.mousewheelControl&&o.enableMousewheelControl&&o.enableMousewheelControl(),o.params.hashnav&&o.hashnav&&o.hashnav.init(),o.params.a11y&&o.a11y&&o.a11y.init(),o.emit("onInit",o)},o.cleanupStyles=function(){o.container.removeClass(o.classNames.join(" ")).removeAttr("style"),o.wrapper.removeAttr("style"),o.slides&&o.slides.length&&o.slides.removeClass([o.params.slideVisibleClass,o.params.slideActiveClass,o.params.slideNextClass,o.params.slidePrevClass].join(" ")).removeAttr("style").removeAttr("data-swiper-column").removeAttr("data-swiper-row"),o.paginationContainer&&o.paginationContainer.length&&o.paginationContainer.removeClass(o.params.paginationHiddenClass),o.bullets&&o.bullets.length&&o.bullets.removeClass(o.params.bulletActiveClass),o.params.prevButton&&a(o.params.prevButton).removeClass(o.params.buttonDisabledClass),o.params.nextButton&&a(o.params.nextButton).removeClass(o.params.buttonDisabledClass),o.params.scrollbar&&o.scrollbar&&(o.scrollbar.track&&o.scrollbar.track.length&&o.scrollbar.track.removeAttr("style"),o.scrollbar.drag&&o.scrollbar.drag.length&&o.scrollbar.drag.removeAttr("style"))},o.destroy=function(a,b){o.detachEvents(),o.stopAutoplay(),o.params.loop&&o.destroyLoop(),b&&o.cleanupStyles(),o.disconnectObservers(),o.params.keyboardControl&&o.disableKeyboardControl&&o.disableKeyboardControl(),o.params.mousewheelControl&&o.disableMousewheelControl&&o.disableMousewheelControl(),o.params.a11y&&o.a11y&&o.a11y.destroy(),o.emit("onDestroy"),a!==!1&&(o=null)},o.init(),o}};b.prototype={defaults:{direction:"horizontal",touchEventsTarget:"container",initialSlide:0,speed:300,autoplay:!1,autoplayDisableOnInteraction:!0,freeMode:!1,freeModeMomentum:!0,freeModeMomentumRatio:1,freeModeMomentumBounce:!0,freeModeMomentumBounceRatio:1,setWrapperSize:!1,virtualTranslate:!1,effect:"slide",coverflow:{rotate:50,stretch:0,depth:100,modifier:1,slideShadows:!0},cube:{slideShadows:!0,shadow:!0,shadowOffset:20,shadowScale:.94},fade:{crossFade:!1},parallax:!1,scrollbar:null,scrollbarHide:!0,keyboardControl:!1,mousewheelControl:!1,mousewheelForceToAxis:!1,hashnav:!1,spaceBetween:0,slidesPerView:1,slidesPerColumn:1,slidesPerColumnFill:"column",slidesPerGroup:1,centeredSlides:!1,touchRatio:1,touchAngle:45,simulateTouch:!0,shortSwipes:!0,longSwipes:!0,longSwipesRatio:.5,longSwipesMs:300,followFinger:!0,onlyExternal:!1,threshold:0,touchMoveStopPropagation:!0,pagination:null,paginationClickable:!1,paginationHide:!1,paginationBulletRender:null,resistance:!0,resistanceRatio:.85,nextButton:null,prevButton:null,watchSlidesProgress:!1,watchSlidesVisibility:!1,grabCursor:!1,preventClicks:!0,preventClicksPropagation:!0,slideToClickedSlide:!1,lazyLoading:!1,lazyLoadingInPrevNext:!1,lazyLoadingOnTransitionStart:!1,preloadImages:!0,updateOnImagesReady:!0,loop:!1,loopAdditionalSlides:0,loopedSlides:null,control:void 0,controlInverse:!1,allowSwipeToPrev:!0,allowSwipeToNext:!0,swipeHandler:null,noSwiping:!0,noSwipingClass:"swiper-no-swiping",slideClass:"swiper-slide",slideActiveClass:"swiper-slide-active",slideVisibleClass:"swiper-slide-visible",slideDuplicateClass:"swiper-slide-duplicate",slideNextClass:"swiper-slide-next",slidePrevClass:"swiper-slide-prev",wrapperClass:"swiper-wrapper",bulletClass:"swiper-pagination-bullet",bulletActiveClass:"swiper-pagination-bullet-active",buttonDisabledClass:"swiper-button-disabled",paginationHiddenClass:"swiper-pagination-hidden",observer:!1,observeParents:!1,a11y:!1,prevSlideMessage:"Previous slide",nextSlideMessage:"Next slide",firstSlideMessage:"This is the first slide",lastSlideMessage:"This is the last slide",runCallbacksOnInit:!0},isSafari:function(){var a=navigator.userAgent.toLowerCase();return a.indexOf("safari")>=0&&a.indexOf("chrome")<0&&a.indexOf("android")<0}(),isUiWebView:/(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(navigator.userAgent),isArray:function(a){return"[object Array]"===Object.prototype.toString.apply(a)},browser:{ie:window.navigator.pointerEnabled||window.navigator.msPointerEnabled,ieTouch:window.navigator.msPointerEnabled&&window.navigator.msMaxTouchPoints>1||window.navigator.pointerEnabled&&window.navigator.maxTouchPoints>1},device:function(){var a=navigator.userAgent,b=a.match(/(Android);?[\s\/]+([\d.]+)?/),c=a.match(/(iPad).*OS\s([\d_]+)/),d=!c&&a.match(/(iPhone\sOS)\s([\d_]+)/);return{ios:c||d||c,android:b}}(),support:{touch:window.Modernizr&&Modernizr.touch===!0||function(){return!!("ontouchstart"in window||window.DocumentTouch&&document instanceof DocumentTouch)}(),transforms3d:window.Modernizr&&Modernizr.csstransforms3d===!0||function(){var a=document.createElement("div").style;return"webkitPerspective"in a||"MozPerspective"in a||"OPerspective"in a||"MsPerspective"in a||"perspective"in a}(),flexbox:function(){for(var a=document.createElement("div").style,b="alignItems webkitAlignItems webkitBoxAlign msFlexAlign mozBoxAlign webkitFlexDirection msFlexDirection mozBoxDirection mozBoxOrient webkitBoxDirection webkitBoxOrient".split(" "),c=0;c<b.length;c++)if(b[c]in a)return!0}(),observer:function(){return"MutationObserver"in window||"WebkitMutationObserver"in window}()},plugins:{}},a.Swiper=b}(Zepto),+function(a){"use strict";a.Swiper.prototype.defaults.pagination=".page-current .swiper-pagination",a.swiper=function(b,c){return new a.Swiper(b,c)},a.fn.swiper=function(b){return new a.Swiper(this,b)},a.initSwiper=function(b){function c(a){function b(){a.destroy(),d.off("pageBeforeRemove",b)}d.on("pageBeforeRemove",b)}var d=a(b||document.body),e=d.find(".swiper-container");if(0!==e.length)for(var f=0;f<e.length;f++){var g,h=e.eq(f);if(h.data("swiper"))h.data("swiper").update(!0);else{g=h.dataset();var i=a.swiper(h[0],g);c(i)}}},a.reinitSwiper=function(b){var c=a(b||".page-current"),d=c.find(".swiper-container");if(0!==d.length)for(var e=0;e<d.length;e++){var f=d[0].swiper;f&&f.update(!0)}}}(Zepto),+function(a){"use strict";var b=function(b){var c,d=this,e=this.defaults;b=b||{};for(var f in e)"undefined"==typeof b[f]&&(b[f]=e[f]);d.params=b;var g=d.params.navbarTemplate||'<header class="bar bar-nav"><a class="icon icon-left pull-left photo-browser-close-link'+("popup"===d.params.type?" close-popup":"")+'"></a><h1 class="title"><div class="center sliding"><span class="photo-browser-current"></span> <span class="photo-browser-of">'+d.params.ofText+'</span> <span class="photo-browser-total"></span></div></h1></header>',h=d.params.toolbarTemplate||'<nav class="bar bar-tab"><a class="tab-item photo-browser-prev" href="#"><i class="icon icon-prev"></i></a><a class="tab-item photo-browser-next" href="#"><i class="icon icon-next"></i></a></nav>',i=d.params.template||'<div class="photo-browser photo-browser-'+d.params.theme+'">{{navbar}}{{toolbar}}<div data-page="photo-browser-slides" class="content">{{captions}}<div class="photo-browser-swiper-container swiper-container"><div class="photo-browser-swiper-wrapper swiper-wrapper">{{photos}}</div></div></div></div>',j=d.params.lazyLoading?d.params.photoLazyTemplate||'<div class="photo-browser-slide photo-browser-slide-lazy swiper-slide"><div class="preloader'+("dark"===d.params.theme?" preloader-white":"")+'"></div><span class="photo-browser-zoom-container"><img data-src="{{url}}" class="swiper-lazy"></span></div>':d.params.photoTemplate||'<div class="photo-browser-slide swiper-slide"><span class="photo-browser-zoom-container"><img src="{{url}}"></span></div>',k=d.params.captionsTheme||d.params.theme,l=d.params.captionsTemplate||'<div class="photo-browser-captions photo-browser-captions-'+k+'">{{captions}}</div>',m=d.params.captionTemplate||'<div class="photo-browser-caption" data-caption-index="{{captionIndex}}">{{caption}}</div>',n=d.params.objectTemplate||'<div class="photo-browser-slide photo-browser-object-slide swiper-slide">{{html}}</div>',o="",p="";for(c=0;c<d.params.photos.length;c++){var q=d.params.photos[c],r="";"string"==typeof q||q instanceof String?r=q.indexOf("<")>=0||q.indexOf(">")>=0?n.replace(/{{html}}/g,q):j.replace(/{{url}}/g,q):"object"==typeof q&&(q.hasOwnProperty("html")&&q.html.length>0?r=n.replace(/{{html}}/g,q.html):q.hasOwnProperty("url")&&q.url.length>0&&(r=j.replace(/{{url}}/g,q.url)),q.hasOwnProperty("caption")&&q.caption.length>0?p+=m.replace(/{{caption}}/g,q.caption).replace(/{{captionIndex}}/g,c):r=r.replace(/{{caption}}/g,"")),o+=r}var s=i.replace("{{navbar}}",d.params.navbar?g:"").replace("{{noNavbar}}",d.params.navbar?"":"no-navbar").replace("{{photos}}",o).replace("{{captions}}",l.replace(/{{captions}}/g,p)).replace("{{toolbar}}",d.params.toolbar?h:"");d.activeIndex=d.params.initialSlide,d.openIndex=d.activeIndex,d.opened=!1,d.open=function(b){return"undefined"==typeof b&&(b=d.activeIndex),b=parseInt(b,10),d.opened&&d.swiper?void d.swiper.slideTo(b):(d.opened=!0,d.openIndex=b,"standalone"===d.params.type&&a(d.params.container).append(s),"popup"===d.params.type&&(d.popup=a.popup('<div class="popup photo-browser-popup">'+s+"</div>"),a(d.popup).on("closed",d.onPopupClose)),"page"===d.params.type?(a(document).on("pageBeforeInit",d.onPageBeforeInit),a(document).on("pageBeforeRemove",d.onPageBeforeRemove),d.params.view||(d.params.view=a.mainView),void d.params.view.loadContent(s)):(d.layout(d.openIndex),void(d.params.onOpen&&d.params.onOpen(d))))},d.close=function(){d.opened=!1,d.swiperContainer&&0!==d.swiperContainer.length&&(d.params.onClose&&d.params.onClose(d),d.attachEvents(!0),"standalone"===d.params.type&&d.container.removeClass("photo-browser-in").addClass("photo-browser-out").transitionEnd(function(){d.container.remove()}),d.swiper.destroy(),d.swiper=d.swiperContainer=d.swiperWrapper=d.slides=t=u=v=void 0)},d.onPopupClose=function(){d.close(),a(d.popup).off("pageBeforeInit",d.onPopupClose)},d.onPageBeforeInit=function(b){"photo-browser-slides"===b.detail.page.name&&d.layout(d.openIndex),a(document).off("pageBeforeInit",d.onPageBeforeInit)},d.onPageBeforeRemove=function(b){"photo-browser-slides"===b.detail.page.name&&d.close(),a(document).off("pageBeforeRemove",d.onPageBeforeRemove)},d.onSliderTransitionStart=function(b){d.activeIndex=b.activeIndex;var c=b.activeIndex+1,e=b.slides.length;if(d.params.loop&&(e-=2,c-=b.loopedSlides,1>c&&(c=e+c),c>e&&(c-=e)),d.container.find(".photo-browser-current").text(c),d.container.find(".photo-browser-total").text(e),a(".photo-browser-prev, .photo-browser-next").removeClass("photo-browser-link-inactive"),b.isBeginning&&!d.params.loop&&a(".photo-browser-prev").addClass("photo-browser-link-inactive"),b.isEnd&&!d.params.loop&&a(".photo-browser-next").addClass("photo-browser-link-inactive"),d.captions.length>0){d.captionsContainer.find(".photo-browser-caption-active").removeClass("photo-browser-caption-active");var f=d.params.loop?b.slides.eq(b.activeIndex).attr("data-swiper-slide-index"):d.activeIndex;d.captionsContainer.find('[data-caption-index="'+f+'"]').addClass("photo-browser-caption-active")}var g=b.slides.eq(b.previousIndex).find("video");g.length>0&&"pause"in g[0]&&g[0].pause(),d.params.onSlideChangeStart&&d.params.onSlideChangeStart(b)},d.onSliderTransitionEnd=function(a){d.params.zoom&&t&&a.previousIndex!==a.activeIndex&&(u.transform("translate3d(0,0,0) scale(1)"),v.transform("translate3d(0,0,0)"),t=u=v=void 0,w=x=1),d.params.onSlideChangeEnd&&d.params.onSlideChangeEnd(a)},d.layout=function(b){"page"===d.params.type?d.container=a(".photo-browser-swiper-container").parents(".view"):d.container=a(".photo-browser"),"standalone"===d.params.type&&d.container.addClass("photo-browser-in"),d.swiperContainer=d.container.find(".photo-browser-swiper-container"),d.swiperWrapper=d.container.find(".photo-browser-swiper-wrapper"),d.slides=d.container.find(".photo-browser-slide"),d.captionsContainer=d.container.find(".photo-browser-captions"),d.captions=d.container.find(".photo-browser-caption");var c={nextButton:d.params.nextButton||".photo-browser-next",prevButton:d.params.prevButton||".photo-browser-prev",indexButton:d.params.indexButton,initialSlide:b,spaceBetween:d.params.spaceBetween,speed:d.params.speed,loop:d.params.loop,lazyLoading:d.params.lazyLoading,lazyLoadingInPrevNext:d.params.lazyLoadingInPrevNext,lazyLoadingOnTransitionStart:d.params.lazyLoadingOnTransitionStart,preloadImages:d.params.lazyLoading?!1:!0,onTap:function(a,b){d.params.onTap&&d.params.onTap(a,b)},onClick:function(a,b){d.params.exposition&&d.toggleExposition(),d.params.onClick&&d.params.onClick(a,b)},onDoubleTap:function(b,c){d.toggleZoom(a(c.target).parents(".photo-browser-slide")),d.params.onDoubleTap&&d.params.onDoubleTap(b,c)},onTransitionStart:function(a){d.onSliderTransitionStart(a)},onTransitionEnd:function(a){d.onSliderTransitionEnd(a)},onLazyImageLoad:function(a,b,c){d.params.onLazyImageLoad&&d.params.onLazyImageLoad(d,b,c)},onLazyImageReady:function(b,c,e){a(c).removeClass("photo-browser-slide-lazy"),d.params.onLazyImageReady&&d.params.onLazyImageReady(d,c,e)}};d.params.swipeToClose&&"page"!==d.params.type&&(c.onTouchStart=d.swipeCloseTouchStart,c.onTouchMoveOpposite=d.swipeCloseTouchMove,c.onTouchEnd=d.swipeCloseTouchEnd),d.swiper=a.swiper(d.swiperContainer,c),0===b&&d.onSliderTransitionStart(d.swiper),d.attachEvents()},d.attachEvents=function(a){var b=a?"off":"on";if(d.params.zoom){var c=d.params.loop?d.swiper.slides:d.slides;c[b]("gesturestart",d.onSlideGestureStart),c[b]("gesturechange",d.onSlideGestureChange),c[b]("gestureend",d.onSlideGestureEnd),c[b]("touchstart",d.onSlideTouchStart),c[b]("touchmove",d.onSlideTouchMove),c[b]("touchend",d.onSlideTouchEnd)}d.container.find(".photo-browser-close-link")[b]("click",d.close)},d.exposed=!1,d.toggleExposition=function(){d.container&&d.container.toggleClass("photo-browser-exposed"),d.params.expositionHideCaptions&&d.captionsContainer.toggleClass("photo-browser-captions-exposed"),d.exposed=!d.exposed},d.enableExposition=function(){d.container&&d.container.addClass("photo-browser-exposed"),d.params.expositionHideCaptions&&d.captionsContainer.addClass("photo-browser-captions-exposed"),d.exposed=!0},d.disableExposition=function(){d.container&&d.container.removeClass("photo-browser-exposed"),d.params.expositionHideCaptions&&d.captionsContainer.removeClass("photo-browser-captions-exposed"),d.exposed=!1};var t,u,v,w=1,x=1,y=!1;d.onSlideGestureStart=function(){return t||(t=a(this),u=t.find("img, svg, canvas"),v=u.parent(".photo-browser-zoom-container"),0!==v.length)?(u.transition(0),void(y=!0)):void(u=void 0)},d.onSlideGestureChange=function(a){u&&0!==u.length&&(w=a.scale*x,w>d.params.maxZoom&&(w=d.params.maxZoom-1+Math.pow(w-d.params.maxZoom+1,.5)),w<d.params.minZoom&&(w=d.params.minZoom+1-Math.pow(d.params.minZoom-w+1,.5)),u.transform("translate3d(0,0,0) scale("+w+")"))},d.onSlideGestureEnd=function(){u&&0!==u.length&&(w=Math.max(Math.min(w,d.params.maxZoom),d.params.minZoom),u.transition(d.params.speed).transform("translate3d(0,0,0) scale("+w+")"),x=w,y=!1,1===w&&(t=void 0))},d.toggleZoom=function(){t||(t=d.swiper.slides.eq(d.swiper.activeIndex),u=t.find("img, svg, canvas"),v=u.parent(".photo-browser-zoom-container")),u&&0!==u.length&&(v.transition(300).transform("translate3d(0,0,0)"),w&&1!==w?(w=x=1,u.transition(300).transform("translate3d(0,0,0) scale(1)"),t=void 0):(w=x=d.params.maxZoom,u.transition(300).transform("translate3d(0,0,0) scale("+w+")")))};var z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q={},R={};d.onSlideTouchStart=function(b){u&&0!==u.length&&(z||("android"===a.device.os&&b.preventDefault(),z=!0,Q.x="touchstart"===b.type?b.targetTouches[0].pageX:b.pageX,Q.y="touchstart"===b.type?b.targetTouches[0].pageY:b.pageY))},d.onSlideTouchMove=function(b){if(u&&0!==u.length&&(d.swiper.allowClick=!1,z&&t)){A||(H=u[0].offsetWidth,I=u[0].offsetHeight,J=a.getTranslate(v[0],"x")||0,K=a.getTranslate(v[0],"y")||0,v.transition(0));var c=H*w,e=I*w;if(!(c<d.swiper.width&&e<d.swiper.height)){if(D=Math.min(d.swiper.width/2-c/2,0),F=-D,E=Math.min(d.swiper.height/2-e/2,0),G=-E,R.x="touchmove"===b.type?b.targetTouches[0].pageX:b.pageX,R.y="touchmove"===b.type?b.targetTouches[0].pageY:b.pageY,!A&&!y&&(Math.floor(D)===Math.floor(J)&&R.x<Q.x||Math.floor(F)===Math.floor(J)&&R.x>Q.x))return void(z=!1);b.preventDefault(),b.stopPropagation(),A=!0,B=R.x-Q.x+J,C=R.y-Q.y+K,D>B&&(B=D+1-Math.pow(D-B+1,.8)),B>F&&(B=F-1+Math.pow(B-F+1,.8)),E>C&&(C=E+1-Math.pow(E-C+1,.8)),C>G&&(C=G-1+Math.pow(C-G+1,.8)),L||(L=R.x),O||(O=R.y),M||(M=Date.now()),N=(R.x-L)/(Date.now()-M)/2,P=(R.y-O)/(Date.now()-M)/2,Math.abs(R.x-L)<2&&(N=0),Math.abs(R.y-O)<2&&(P=0),L=R.x,O=R.y,M=Date.now(),v.transform("translate3d("+B+"px, "+C+"px,0)")}}},d.onSlideTouchEnd=function(){if(u&&0!==u.length){if(!z||!A)return z=!1,void(A=!1);z=!1,A=!1;var a=300,b=300,c=N*a,e=B+c,f=P*b,g=C+f;0!==N&&(a=Math.abs((e-B)/N)),0!==P&&(b=Math.abs((g-C)/P));var h=Math.max(a,b);B=e,C=g;var i=H*w,j=I*w;D=Math.min(d.swiper.width/2-i/2,0),F=-D,E=Math.min(d.swiper.height/2-j/2,0),G=-E,B=Math.max(Math.min(B,F),D),C=Math.max(Math.min(C,G),E),v.transition(h).transform("translate3d("+B+"px, "+C+"px,0)")}};var S,T,U,V,W,X=!1,Y=!0,Z=!1;return d.swipeCloseTouchStart=function(){Y&&(X=!0)},d.swipeCloseTouchMove=function(a,b){if(X){Z||(Z=!0,T="touchmove"===b.type?b.targetTouches[0].pageY:b.pageY,V=d.swiper.slides.eq(d.swiper.activeIndex),W=(new Date).getTime()),b.preventDefault(),U="touchmove"===b.type?b.targetTouches[0].pageY:b.pageY,S=T-U;var c=1-Math.abs(S)/300;V.transform("translate3d(0,"+-S+"px,0)"),d.swiper.container.css("opacity",c).transition(0)}},d.swipeCloseTouchEnd=function(){if(X=!1,!Z)return void(Z=!1);Z=!1,Y=!1;var b=Math.abs(S),c=(new Date).getTime()-W;return 300>c&&b>20||c>=300&&b>100?void setTimeout(function(){"standalone"===d.params.type&&d.close(),"popup"===d.params.type&&a.closeModal(d.popup),d.params.onSwipeToClose&&d.params.onSwipeToClose(d),Y=!0},0):(0!==b?V.addClass("transitioning").transitionEnd(function(){Y=!0,V.removeClass("transitioning")}):Y=!0,d.swiper.container.css("opacity","").transition(""),void V.transform(""))},d};b.prototype={defaults:{photos:[],container:"body",initialSlide:0,spaceBetween:20,speed:300,zoom:!0,maxZoom:3,minZoom:1,exposition:!0,expositionHideCaptions:!1,type:"standalone",navbar:!0,toolbar:!0,theme:"light",swipeToClose:!0,backLinkText:"Close",ofText:"of",loop:!1,lazyLoading:!1,lazyLoadingInPrevNext:!1,lazyLoadingOnTransitionStart:!1}},a.photoBrowser=function(c){return a.extend(c,a.photoBrowser.prototype.defaults),new b(c)},a.photoBrowser.prototype={defaults:{}}}(Zepto);
// Zepto.cookie plugin
// 
// Copyright (c) 2010, 2012 
// @author Klaus Hartl (stilbuero.de)
// @author Daniel Lacy (daniellacy.com)
// 
// Dual licensed under the MIT and GPL licenses:
// http://www.opensource.org/licenses/mit-license.php
// http://www.gnu.org/licenses/gpl.html
(function(a){a.extend(a.fn,{cookie:function(b,c,d){var e,f,g,h;if(arguments.length>1&&String(c)!=="[object Object]"){d=a.extend({},d);if(c===null||c===undefined)d.expires=-1;return typeof d.expires=="number"&&(e=d.expires*24*60*60*1e3,f=d.expires=new Date,f.setTime(f.getTime()+e)),c=String(c),document.cookie=[encodeURIComponent(b),"=",d.raw?c:encodeURIComponent(c),d.expires?"; expires="+d.expires.toUTCString():"",d.path?"; path="+d.path:"",d.domain?"; domain="+d.domain:"",d.secure?"; secure":""].join("")}return d=c||{},h=d.raw?function(a){return a}:decodeURIComponent,(g=(new RegExp("(?:^|; )"+encodeURIComponent(b)+"=([^;]*)")).exec(document.cookie))?h(g[1]):null}})})(Zepto);
$(document).on("pageInit", ".page", function(e, pageId, $page) {
totop();
colsebut();
init_ui_lazy();


if(typeof(appId) != 'undefined'){
	

	// 微信分享

	wx.config({
		  debug: false,
		  appId: appId,
		  timestamp: timestamp,
		  nonceStr: nonceStr,
		  signature: signature,
		  jsApiList: [
		    // 所有要调用的 API 都要加到这个列表中
		    'onMenuShareAppMessage',
		    'onMenuShareTimeline',
		    'onMenuShareQQ',
		    'onMenuShareWeibo',
		    'onMenuShareQZone',
		    'scanQRCode',
		    
		  ]
		});

		// 分享给朋友
		wx.ready(function () {

		  // 在这里调用 API
			wx.onMenuShareAppMessage({
			    title: share_title, // 分享标题
			    desc: share_content, // 分享描述
			    link: share_url, // 分享链接
			    imgUrl: imgUrl, // 分享图标
			    success: function () {
			        // 用户确认分享后执行的回调函数

			    },
			    cancel: function () {
			        // 用户取消分享后执行的回调函数

			    }
			});

			// 分享到朋友圈
			wx.onMenuShareTimeline({
			    title: share_title, // 分享标题
			    desc: share_content, // 分享描述
			    link: share_url, // 分享链接
			    imgUrl: imgUrl, // 分享图标
			    success: function () {
			        // 用户确认分享后执行的回调函数

			    },
			    cancel: function () {
			        // 用户取消分享后执行的回调函数

			    }
			});

			// 分享到qq
			wx.onMenuShareQQ({
			    title: share_title, // 分享标题
			    desc: share_content, // 分享描述
			    link: share_url, // 分享链接
			    imgUrl: imgUrl, // 分享图标
			    success: function () {
			       // 用户确认分享后执行的回调函数
			    },
			    cancel: function () {
			       // 用户取消分享后执行的回调函数
			    }
			});

			// 分享到腾讯微博
			wx.onMenuShareWeibo({
			    title: share_title, // 分享标题
			    desc: share_content, // 分享描述
			    link: share_url, // 分享链接
			    imgUrl: imgUrl, // 分享图标
			    success: function () {
			       // 用户确认分享后执行的回调函数
			    },
			    cancel: function () {
			        // 用户取消分享后执行的回调函数
			    }
			});

			// 分享到qq空间
			wx.onMenuShareQZone({
			    title: share_title, // 分享标题
			    desc: share_content, // 分享描述
			    link: share_url, // 分享链接
			    imgUrl: imgUrl, // 分享图标
			    success: function () {
			       // 用户确认分享后执行的回调函数
			    },
			    cancel: function () {
			        // 用户取消分享后执行的回调函数
			    }
			});
			



	        wx.error(function(res){
	            // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
	           // alert("errorMSG:"+res);
	        });
		});
	


}
$(document).off('click', '#scanQRCode');
$(document).on('click', '#scanQRCode', function() {
	wx.scanQRCode({
	    needResult: 1, 
	    scanType: ["qrCode","barCode"],
	    success: function (res) {
	    	
	    	var result = res.resultStr; //二维码URL	    	
			var query = new Object();
			query.act = "scanqrcode";
			query.url = result;
			$.ajax({
				url:AJAX_URL,
				data:query,
				type:"POST",
				dataType: "json",
				success:function(data){
					if(data.status==1){
						 $.router.load(result, true);
					}else{
						$.alert('非本站链接！');
					}
				},
				error:function(o){
					$.alert(o.responseText);
				}
			});
	    }
	});

});

});
$(document).on("pageAnimationEnd", ".page", function(e, pageId, $page) {
	//alert(1);

});

//路由禁用
$.config = {
	swipePanelOnlyClose:true, // 初始化侧栏禁止滑动打开
	router: true  // 初始化禁用路由
};




// 初始化回到头部
function colsebut() {
	$(".Client").find(".close_but").bind("click",function(){
		console.log(123);
		$(".Client").hide();
		$(".shade").hide();
		close_appdown();
	});
	$(".shade").click(function(){
		$(".Client").hide();
		$(this).hide();
		close_appdown();
	});
}
function close_appdown(){
	var query = new Object();
	query.act = "close_appdown";
	$.ajax({
		url:AJAX_URL,
		data:query,
		type:"POST",
		success:function(){

		},
		error:function(o){
			alert(o.responseText);
		}
	});
}
/*回到顶部*/    
function totop(){
	var totophight=$(window).height() - $(".bar-tab").height() - $(".bar-nav").height() - $(".headerindex").height();
	$(document).on('click','.totop', function () {
		$(".content").scrollTo({toT:0});
	        return false;
	});	
	$(".content").scroll(function(){
	if ($(".content").scrollTop()>totophight){
	    $(".totop").show();
	}
	else
	{
	    $(".totop").hide();
	}
	});
}                                                     

/*首页导航条变化*/
function headerScroll(){  
	$(".content").scroll(function(){
		var top=$(".content").scrollTop();
		var opacity=top/100;
		if (opacity>=0.6) {
			$(".headerindex .mark").css({"opacity":0.6,"box-shadow":"0 0 0 #d82020"});
			$(".headerindex .middle a").css("background-color","rgba(255,255,255,1)");
		}else{
			$(".headerindex .mark").css({"opacity":opacity,"box-shadow":"0 2px 3px #d82020"});
			$(".headerindex .middle a").css("background-color","rgba(255,255,255,0.8)");
		};
	});
};

//以下是处理UI的公共函数
function init_ui_lazy()
{
	$.refresh_image();
	$(".content").bind("scroll", function(e){
		$.refresh_image();
	});	
	
}

//重新刷新页面数据
function refreshdata(contentArr){
	var url=window.location.href;
	var content = new Array();
	$.ajax({
		url:url,
		type:"POST",
		success:function(html)
		{	
			for (var i = 0; i < contentArr.length; i++) {
			$(contentArr[i]).html($(html).find(contentArr[i]).html());
			//console.log(contentArr[i]);
			}
		},
		error:function()
		{
			$.toast("加载失败咯~");
		}
	});
}

//无图片时
/*function noimg(){
	$("img").each(function(i,obj){
		var img = $(this);
		var ifnull=$.trim($(this).attr("src"));
			console.log(ifnull);
		if(img.attr("src")==""){
			console.log($(this).attr("src")+11);
			$(this).attr("src","no_image");
		}else{
		console.log(2);
		};
	});
}*/

/**
 * 延时加载图片
 * 
 */	
 $.refresh_image = function(){
	$("img[date-load='1']").ui_lazy({placeholder:'',no_image:no_image});
};	
$.fn.ui_lazy = function(options){
	var op = {placeholder:"",src:"",refresh:false,no_image:""};
	options = $.extend({},op, options);
	var imgs = this;	
	imgs.each(function(){
 	
		var img = $(this);			
		var windheight = $(".content").height();
		var imgoffset = img.offset().top;
		var screenheight = $(".content").height();
		if(img.attr("date-load")||options.refresh)
		{
		    if(windheight>=imgoffset)
		    {			 
		    	if(options.src!=""){
		    		//img.attr("src",options.src);
			    	img.attr("src",img.attr("data-src"));
			    	img.attr("isload",true);
			    	img.attr("date-load",false);  
		    	}
		    	else{
			    	img.attr("src",img.attr("data-src"));
			    	img.attr("isload",true);
			    	img.attr("date-load",false);  
		    	}  
		    	if (img.attr("data-src") == "") {
		    		img.attr("src",no_image);
		    	};	
		    }
		}		
	});			
}	

//首页下拉加载刷新事件
var stop=true;
function init_auto_load_data(){

var page=2;
var page_total = 0;
var pageload=$(".page-load");
if (pageload.length==0) {
var loadhtml="<div class='page-load hide'><span class='loading'>"+"</span></div>"
$(".j-ajaxlist").append(loadhtml);
};
$(document).on('infinite', '.infinite-index-bottom',function() {
 // 如果正在加载，则退出

	$(".page-load").removeClass("hide");
    if(page_total>0 && page>page_total){
            stop=false;
            $(".page-load span").removeClass("loading").addClass("loaded").html("拉到底部啦~");
    }else{
    	$(".page-load span").removeClass("loading").addClass("loaded").html("正在加载更多~");
    }

    //if (!stop) return;
    if(stop==true){ 
        stop=false; 
        var query = new Object();
        query.page = page;
        query.act="load_index_list_data";

        $.ajax({
                url: INDEX_URL,
                data: query,
                type: "POST",
                dataType: "json",
                success: function (obj) {
                	if (page_total != page) {
                    $(".j-ajaxadd").append(obj.html);    
                    stop=true;                    
                    page++;
                    page_total = obj.page_total;
                    console.log(page_total);
                	};
                },
                error: function() {
                    $(".page-load span").html("网络被风吹走啦~");
                }
        });
    } else{
    	$(".page-load span").removeClass("loading").addClass("loaded").html("拉到底部啦~");
    	$(document).off('infinite', '.infinite-scroll-bottom');
    }
});
}


//列表页下拉刷新
var infinite_loading = false;
function init_list_scroll_bottom(){
var pageload=$(".page-load");
if (pageload.length==0) {
var loadhtml="<div class='page-load hide'><span class=''>"+"</span></div>"
$(".j-ajaxlist").append(loadhtml);
};

	$(document).on('infinite', '.infinite-scroll-bottom',function() {
		
		if(infinite_loading)return;
		var next_dom = $(".j-ajaxlist").find("span.current").next();
		$(".page-load").removeClass("hide");
		if(next_dom.length>0){
				var url = $(".j-ajaxlist .pages").find("span.current").next().attr("href");
				$(".page-load span").removeClass("loading").addClass("loaded").html("正在加载更多~");
				infinite_loading = true;
				$.ajax({
					url:url,
					type:"POST",
					success:function(html)
					{
						$(".j-ajaxadd").append($(html).find(".j-ajaxadd").html());
						$(".j-ajaxlist .pages").html($(html).find(".j-ajaxlist .pages").html());
						infinite_loading = false;
					},
					error:function()
					{
						$(".page-load span").removeClass("loading").addClass("loaded").html("网络被风吹走啦~");
					}
				});
			}
			else
			{
				$(".page-load span").removeClass("loading").addClass("loaded").html("没有更多信息~");
				$(document).off('infinite', '.infinite-scroll-bottom');
			}
	});
}


//相同页面出现不同下拉加载使用 
//ajaxlist:执行的大结构
//ajaxadd:append进去的结构
var infinite_loading2 = false;
var infinite_callback = "";
function init_listscroll(ajaxlist,ajaxadd,infinite_loading2,callback){
    infinite_callback="";
var pageload=$(ajaxlist).find(".page-load");
if (pageload.length==0) {
var loadhtml="<div class='page-load hide'><span class='loading'>"+"</span></div>"
$(ajaxlist).append(loadhtml);
};

	infinite(ajaxlist,ajaxadd,infinite_loading2,callback);
}

function infinite(ajaxlist,ajaxadd,infinite_loading2,callback){
    infinite_callback=callback;
    $(document).off('infinite', '.infinite-scroll-bottom');
	$(document).on('infinite', '.infinite-scroll-bottom',function() {
		if(infinite_loading2)return;
		var next_dom = $(ajaxlist).find("span.current").next();
		$(ajaxlist).find(".page-load").removeClass("hide");
		if(next_dom.length>0)
			{
				var url =$(ajaxlist).find(".pages").find("span.current").next().attr("href");
				$(ajaxlist).find(".page-load span").removeClass("loading").addClass("loaded").html("正在加载更多~");
				infinite_loading2 = true;
				$.ajax({
					url:url,
					type:"POST",
					success:function(html)
					{
						$(ajaxadd).append($(html).find(ajaxadd).html());
						$(ajaxlist).find(".pages").html($(html).find(ajaxlist).find(".pages").html());
						infinite_loading2 = false;
                        if(typeof infinite_callback =="function"){
                            infinite_callback();
                        }
					},
					error:function()
					{
						$(ajaxlist).find(".page-load span").removeClass("loading").addClass("loaded").html("网络被风吹走啦~");
					}
				});
			}
			else
			{
				$(ajaxlist).find(".page-load span").removeClass("loading").addClass("loaded").html("没有更多信息~");
				$(document).off('infinite', '.infinite-scroll-bottom');
			}
	});
}


function share_complete(share_key){
    $.alert("分享成功");
}





$(document).on("pageInit", ".page", function(e, pageId, $page) {
	/*
	 *打开规格选择窗口
	 *触发源.j-open-choose
	*/

	$(document).on('click',".j-open-choose",function(){
		console.log(01);
		var page_id= $(".page").attr("id");
		if(page_id !="dealgroup"){
			$(".j-flippedout-close").attr("rel","spec");
			$(".j-spec-choose-close").attr("rel","spec");
			$(".flippedout-spec").addClass("showflipped").addClass("z-open");
			$(".spec-choose").addClass("z-open");
			$(".totop").addClass("vhide");//隐藏回到头部按钮
		}
	});

	/*
	 *打开下拉导航窗口
	 *触发源.j-opendropdowm
	*/
	$(document).on('click',".j-opendropdowm",function(){
		$(".j-flippedout-close").attr("rel","dropdowm");
		$(".flippedout").addClass("showflipped").addClass("dropdowm-open");
		$(".m-nav-dropdown").addClass("showdropdown");
		$(".m-nav-dropdown .nav-dropdown-con").addClass("dropdown-open");
		$(".j-flippedout-close").children(".iconfont").addClass("jump");
	});

	$(document).on('click',".j-opendropdowm-default",function(){
		console.log(0);
		$(".j-flippedout-close").attr("rel","dropdowm");
		$(".flippedout-default").addClass("showflipped").addClass("dropdowm-open");
		$(".m-nav-dropdown").addClass("showdropdown");
		$(".m-nav-dropdown .nav-dropdown-con").addClass("dropdown-open");
		$(".flippedout-default .j-flippedout-close").children(".iconfont").addClass("jump");
	});

	/*
	 *打开分享弹出窗口
	 *触发源为.j-openshare
	*/
	$(document).on('click',".j-openshare",function(){
		$(".j-flippedout-close").attr("rel","share");
		$("#boxclose_share").attr("rel","share");
		$(".flippedout").addClass("z-open").addClass("showflipped");
		$(".box_share").addClass("z-open");
		$(".totop").addClass("vhide");//隐藏回到头部按钮
	});



	/*
	 *下拉导航点击分享操作
	 *触发源为.j-dropdown-share
	*/
	$(document).on('click',".j-dropdown-share",function(){
		$(".j-flippedout-close").attr("rel","share");
		$("#boxclose_share").attr("rel","share");
		$(".m-nav-dropdown .nav-dropdown-con").removeClass("dropdown-open");//下拉导航还原
		$(".j-flippedout-close .iconfont").removeClass("jump");
		$(".box_share").addClass("z-open");
		$(".totop").addClass("vhide");//隐藏回到头部按钮
	});

	var imglight = new Swiper ('.img-light', {
		onSlideChangeStart: function(swiper){
			var index = $(".img-light-box .swiper-slide-active").attr("rel");
			$(".light-index .now-index").html(index);
		}
	});

	/*
	 *评论图点击显示当前评论所有图片集
	*/
	$('.page').on('click',".j-review-item,.j-comment-item",function(){
		var flag = $(this).parent(".comment-imglist").attr("rel");
		if(flag == "review"){
			var obj = "j-review-item";
		}else{
			var obj = "j-comment-item";
		}
		$(".pop-light-img").addClass("z-open-black");
		$(".light-txt").addClass("z-open");
		$(".img-light-box").addClass("z-open");
		$(".j-flippedout-close").attr("rel","light");
		$(".totop").addClass("vhide");//隐藏回到头部按钮
		var index = 0;

		$(this).parent(".comment-imglist").children("." + obj).each(function(index){//动态为查看器添加内容
			var url = $(this).find("img").attr("data-lingtsrc");
			index = parseInt(index) + 1;
			imglight.appendSlide('<div class="swiper-slide j-slide-img" rel="'+ index +'"><img class="j-slide-img" src="'+ url +'" width="100%"></div>');
		});
		var index = parseInt($(this).attr("data"))-1;//获取点击的是第几张图片
		imglight.slideTo(index,0);//设置查看器图片为点击的图片
		if(flag == "review"){
			var txt = $(this).parent().siblings().children(".comment-txt").html();//获取评论内容
		}else{
			var txt = $(this).parent().siblings(".comment-txt").html();//获取评论内容
		}
		var name = $(this).parent().siblings(".commenter").children().children(".username").html();//获取用户名
		console.log(txt);
		console.log(name);
		//$(".light-txt .light-con").html(txt);//设置评论内容
		//$(".light-txt .light-name .name").html(name);//设置用户名
		$(".light-index .light-count").html($(this).parent().children("." + obj).length); //设置图片索引总数
		$(".light-index .now-index").html($(this).attr("data"));//设置当前图片索引

	});

	/*
	 *为新添加的查看器图片添加点击关闭事件
	*/
	$(".swiper-wrapper").on("click",".j-slide-img",function(){
		$(".pop-light-img").removeClass("z-open-black").removeClass("showflipped");
		$(".light-txt").removeClass("z-open");
		$(".img-light-box").removeClass("z-open");
		imglight.removeAllSlides();
		$(".totop").removeClass("vhide");
	});


	/*
	 *关闭弹出层
	*/
	$(document).on("click","#boxclose_share,.j-spec-choose-close,.j-flippedout-close,.nav-dropdown-con .dropdown-navlist a",function(){
		var rel = $(this).attr("rel");
		$(".flippedout").removeClass("showflipped").removeClass("dropdowm-open").removeClass("z-open");
		$(".cancel-shoucan").removeClass("z-open");
		if(rel == "light"){
			//关闭图片查看器
			$(".pop-light-img").removeClass("z-open-black");
			$(".light-txt").removeClass("z-open");
			$(".img-light-box .j-flippedout-close").removeClass("showflipped");
			imglight.removeAllSlides();

		}else if (rel == "spec") {
			//关闭图片规格选择器
			$(".flippedout-spec").removeClass("showflipped").removeClass("z-open");
			$(".spec-choose").removeClass("z-open");
			$(".spec-btn-list").removeClass("isAddCart");
			$(".img-light-box").removeClass("z-open");

		}else if (rel == "dropdowm") {
			//关闭下拉导航
			$(".flippedout-default").removeClass("showflipped").removeClass("dropdowm-open").removeClass("z-open");
			$(".m-nav-dropdown").removeClass("showdropdown");
			$(".nav-dropdown-con").removeClass("dropdown-open");
			$(".j-flippedout-close .iconfont").removeClass("jump");

		}else if (rel == "share") {
			//关闭分享
			$(".box_share").removeClass("z-open");
			$("#jiathis_weixin_share").remove();
		}else{
			reset_flippedout();
		}

		$(".totop").removeClass("vhide");
	});


});

function fun_add_miuns(e) {
	var operate = e.attr("data-operate");//获取按钮的操作 判断是执行加还是减
	var txt = e.siblings(".numplusminus");//获取当前文本框
	var txt_val = parseInt(txt.val());//获取文本框中的值，并转化为Int类型
	var max = parseInt(txt.attr("data-max"));//获取可购买的最大值
	var min = parseInt(txt.attr("data-min"));//获取可购买的最小值
	var new_val;
	if(operate == "+"){
		if (txt_val < max) {
			new_val = txt_val + 1;//当前文本框中的值小于最大可购买数，则进行+1操作
			txt.val(new_val);
			$("input[name='num']").val(new_val);

			//以下是判断加减按钮是否可用
			if (new_val == max) {
				$(".j-add").addClass("isUse");
			}else if(new_val == min){
				$(".j-miuns").addClass("isUse");
			}else{
				$(".j-add-miuns").removeClass("isUse");
			}
		}

	}else if (operate == "-") {
		if (txt_val > min) {//当前文本框中的值大于最小可购买数，则进行-1操作
			new_val = txt_val - 1;
			txt.val(new_val);
			$("input[name='num']").val(new_val);
			//以下是判断加减按钮是否可用
			if (new_val == max) {
				$(".j-add").addClass("isUse");
			}else if(new_val == min){
				$(".j-miuns").addClass("isUse");
			}else{
				$(".j-add-miuns").removeClass("isUse");
			}
		}
	}

}
$(document).on("pageInit", ".page", function(e, pageId, $page) {
	//列表类型切换
	$(".j-type-btn").click(function() {
		$(this).hide();
	});
	$("#type-cube").click(function() {
		$("#type-list").show();
		$(".m-goods-list ul").removeClass('type-cube').addClass('type-list');
	});
	$("#type-list").click(function() {
		$("#type-cube").show();
		$(".m-goods-list ul").removeClass('type-list').addClass('type-cube');
	});
});

$(document).on("pageInit", ".page", function(e, pageId, $page) {
	reset_flippedout();

	//js_ajax_load();
//专题链接跳转
	go_back();
	$(".page").on("click",".load_page",function(){
		load_page($(this));
	});

    $(".page").on("click",".load_page2",function(){
        load_page2($(this));
    });


	$(document).on("click",".load_content",function(){
		load_content($(this));
	});

	
	$(document).on("click",".header-reload",function(){
		$.showIndicator();
		window.location.reload();
	});


	$(document).on("click",".no_pay_btn , .no_go_pay",function(){
		var error_tip = $(this).attr('error_tip');
		$.toast(error_tip);
	});

});
//导航切换
function nav_tab() {
	$(".m-nav-tab").on('click', '.j-nav-item', function() {
		$(".j-nav-item").removeClass('active');
		$(this).addClass('active');
		tab_line_init();
	});
}
//导航线
function tab_line_init() {
	var m_left=$(".m-nav-tab .active").find('span').offset().left;
	var s_left=$(".m-nav-tab").scrollLeft();
	var m_width=$(".m-nav-tab .active").find('span').width();
	$(".m-nav-tab").find('.tab-line').css({
		left: m_left+s_left,
		width: m_width
	});
}

function open_url(url)
{
	try{
		App.open_type('{"url":"'+url+'"}');
	}
	catch(ex)
	{
		window.open(url);
	}

	
}

//扫码回调
function js_qr_code_scan(qr_code)
{
	$.ajax({
        url:url,
        data:{"coupon_pwd":qr_code},
        type: "POST",
        dataType:"json",
        success: function (obj) {
        	if(obj.status == 0){
				$.toast(obj.info);
			}else if(obj.status == 1){
				$.router.load(obj.url, true);
				//location.href = obj.url;
			}
        },
        error: function() {
            $.toast("网络被风吹走啦~");
        }
	});
	
}


function init_sms_btn()
{
	$(".login-panel").find("button.ph_verify_btn[init_sms!='init_sms']").each(function(i,o){
		$(o).attr("init_sms","init_sms");
		var lesstime = $(o).attr("lesstime");
		var divbtn = $(o).next();
		divbtn.attr("form_prefix",$(o).attr("form_prefix"));
		divbtn.attr("lesstime",lesstime);
		if(parseInt(lesstime)>0)
		init_sms_code_btn($(divbtn),lesstime);	
	});
}

//关于短信验证码倒计时
function init_sms_code_btn(btn,lesstime)
{

	$(btn).stopTime();
	$(btn).removeClass($(btn).attr("rel"));
	$(btn).removeClass($(btn).attr("rel")+"_hover");
	$(btn).removeClass($(btn).attr("rel")+"_active");
	$(btn).attr("rel","disabled");
	$(btn).addClass("disabled");	
	$(btn).find("span").html("重新获取("+lesstime+")");
	$(btn).attr("lesstime",lesstime);
	$(btn).everyTime(1000,function(){
		var lt = parseInt($(btn).attr("lesstime"));
		lt--;
		$(btn).find("span").html("重新获取("+lt+")");
		$(btn).attr("lesstime",lt);
		if(lt==0)
		{
			$(btn).stopTime();
			$(btn).removeClass($(btn).attr("rel"));
			$(btn).removeClass($(btn).attr("rel")+"_hover");
			$(btn).removeClass($(btn).attr("rel")+"_active");
			$(btn).attr("rel","light");
			$(btn).addClass("light");
			$(btn).find("span").html("发送验证码");
		}
	});
}


//专题链接跳转
function go_back()
{
	var back_url = $(".go_back_url").attr('url');

	if($(".go_back").length > 0 && back_url!=''){
		//back_url = back_url.replace(/"/g, '\"');
		$(".go_back").attr('href',back_url);
	}
	/*
	var history_url = document.referrer;
	var reg = new RegExp("^"+ sitename ,"gim");
	if(reg.test(history_url)){
		//location.href = history_url;
		if(back_url !=''){  		
			location.href = back_url;
		}else{
			window.history.go(-1);
		}
	}else{
		location.href = sitename;
	}
	*/
}
function weixin_login()
{
	var url = wx_url;
	if(url.indexOf("?")==-1)
	{
		url+="?weixin_login=1";
	}
	else
	{
		url+="&weixin_login=1";
	}
	location.href = url;
}

function load_page(obj){
	$.showIndicator();
	$(obj).removeClass('load_page');

	var url = $(obj).attr('url');
	if($(obj).attr('str')){
		url = url+$(obj).attr('str');
	}
	var js_url = $(obj).attr('js_url');
	var callback = $(obj).attr('callback');

    $.ajax({
            url: url,
            type: "POST",
            success: function (html) {
            	//console.log(html);
            	$(".page-current").after($(html).find(".page").addClass('page-current')).removeClass('page-current');
            	$(".page-current").find(".back").addClass("close_page").removeClass("back");
            	$(".page-current").find(".go_back").addClass("close_page").removeClass("go_back");
            	
            	loadScript(js_url,callback);
            	$.hideIndicator();
            	$(obj).addClass('load_page');
            	$(".close_page").on("click",function(){
            		close_page();
            	});
            	//$.init();
            },
            error: function() {
                $.toast("网络被风吹走啦~");
                $(obj).addClass('load_page');
            	$.hideIndicator();
            }
    });	
}


function load_page2(obj){
	$.showIndicator();
	$(obj).removeClass('load_page2');
    var url = $(obj).attr('url');
    var js_url = $(obj).attr('js_url');
    var callback = $(obj).attr('callback');

    $.ajax({
        url: url,
        type: "POST",
        success: function (html) {
            //console.log(html);
            $(".page-current").after($(html).find(".page").addClass('loadpage')).removeClass('page-current');
            $(".loadpage").find(".back").addClass("close_page2").removeClass("back");

            loadScript(js_url,callback);
            $.hideIndicator();
           	$(obj).addClass('load_page2');
            $(".close_page2").on("click",function(){
                close_page2();
            });
            //$.init();
        },
        error: function() {
            $.toast("网络被风吹走啦~");
            $(obj).addClass('load_page2');
        	$.hideIndicator();    
        }
    });
}

function close_page(){
	
	if($(".page").length >1){
		$(".page-current").remove();
		$(".page").last().addClass('page-current');
	}
	
}

function close_page2() {
	var page_len=$(".page").length;

    if ($(".page").length > 1) {
    	$(".loadpage").addClass("colsepage").removeClass("loadpage");


        $(".page").eq(page_len-2).addClass('page-current');
        setTimeout(function () {
            $(".colsepage").remove();
        },100);
    }
}


function reset_flippedout(){
	// 去除弹出层
	$(".flippedout").removeClass("showflipped").removeClass("dropdowm-open").removeClass("z-open");
	$(".flippedout-default").removeClass("showflipped").removeClass("dropdowm-open").removeClass("z-open");
	// 去除分享层
	$(".box_share").removeClass("z-open");
	// 去除下拉导航
	$(".m-nav-dropdown").removeClass("showdropdown");
	$(".nav-dropdown-con").removeClass("dropdown-open");
	// 去除规格选择
	$(".spec-choose").removeClass("z-open");
	$(".spec-btn-list").removeClass("isAddCart");
	// 去除关闭层弹跳
	$(".j-flippedout-close .iconfont").removeClass("jump");
}



//异步加载js  
function loadScript(url,callback){  
	var head=document.getElementsByTagName("head");
	var id = document.getElementById(url);
	if (id) {
		head[0].removeChild(id);
	}
    var script = document.createElement("script");  
    script.type="text/javascript";  
    script.id=url;
    
    if(script.readyState){  
        script.onreadystatechange = function(){  
            if(script.readyState=="loaded"||script.readyState=="complete"){  
                script.onreadystatechange=null;  
                if (typeof test == 'function') {
                callback();
                };  
            }  
        }  
    }else{  
        script.onload = function(){  
	        if (typeof test == 'function') {
	        callback();
	        };  
        }  
    }  
    script.src = url;  
    document.getElementsByTagName("head")[0].appendChild(script);  
 
} 

function loadScriptcallback(){

}

function load_content(obj){
	
	var url = $(obj).attr('url');

    $.ajax({
            url: url,
            type: "POST",
            success: function (html) {
            	//console.log(html);
            	$(".page-current .content").replaceWith($(html).find(".page .content"));
            },
            error: function() {
                $.toast("网络被风吹走啦~");
            }
    });
}

function weixin_bind_authorize()
{
	$.ajax({
		url:AJAX_URL,
		data:{"act":"del_is_weixin_bind"},
		type:"post",
		dataType:"json",
		success:function(obj)
		{
			var url = location.href;
			if(url.indexOf("?")==-1)
			{
				url+="?weixin_bind=1";
			}
			else
			{
				url+="&weixin_bind=1";
			}
			//$.loadPage(url);
			location.href = url;
		}
	});
}
function weixin_login_app()
{
	App.third_party_login_sdk("wxlogin");
}
function js_third_party_login_sdk(jsonstr)
{
	js_weixin_login(jsonstr,0);
	
}
function js_weixin_login(jsonstr,type)
{
	$.ajax({
		url:AJAX_URL,
		data:{"act":"is_user","param":jsonstr,"type":type},
		type:"post",
		dataType:"json",
		success:function(obj)
		{
			if(obj.err==1){
				$.toast(obj.err_code);
				return false;
			}
			if(obj.is_user == 1){
				if(obj.is_mobile==1){
					$.toast(obj.err_code);
				}else{
					$.confirm("该微信已有会员，是否合并？",function(){
						$.ajax({
							url:AJAX_URL,
							data:{"act":"get_wx_app_userinfo","param":jsonstr,"type":type},
							type:"post",
							dataType:"json",
							success:function(obj)
							{
								if(obj.err_code == 0){
									$.toast("绑定成功");
									$.loadPage(obj.jump);
									//location.href = obj.jump;
								}	
								else
								{
									$.toast(obj.err);
								}
							}
						});
					},function(){
						location.href=obj.jump;
					});
				}
			}else{
				$.ajax({
					url:AJAX_URL,
					data:{"act":"get_wx_app_userinfo","param":jsonstr,"type":type},
					type:"post",
					dataType:"json",
					success:function(obj)
					{
						if(obj.err_code == 0){
							$.toast("绑定成功");
							$.loadPage(obj.jump);
							//location.href = obj.jump;
						}
						else
						{
							$.toast(obj.err);
						}
					}
				});
			}
		}
	});
}
/**
 * 关于分享
 * @param share_key
 */
function share_complete(share_key){
	$.toast("分享成功");
}
function init_share(){
	
	if($(".j-app-share-btn").length>0){
		
		$(".j-app-share-btn").unbind("click");
		$(".j-app-share-btn").click(function(){
			
			var share_data={};
			share_data["share_content"]=$(this).attr("data-content");
			share_data["share_url"]=$(this).attr("data-url");
			share_data["key"]='';
			share_data['sina_app_api']=1;
			share_data['qq_app_api']=1;
			share_data["share_imageUrl"]=$(this).attr("data-img");
			share_data['share_title'] = $(this).attr("data-title");
			share_data=JSON.stringify(share_data);
			try{
				App.sdk_share(share_data);
			}catch(e){

			}
		});
	}

}





var current_param = {}; //当前页面刷新参数
function set_current_url(url,param)
{
	current_url = url;
	current_param = param;
	save_url = false;
}
/**
 * ajax加载整个页面的方法
 */
$.loadPage = function(url){
	$.showIndicator();
	$.ajax({
		url:url,
		data:current_param,
		type:"POST",
		success:function(html){
			//$(".content").html($(html).find(".content").html());
			$(".page").replaceWith($(html).find(".page"));
			$(".panel").html($(html).find(".panel").html());
			$.hideIndicator(); 			
			set_current_url(url,current_param);
			$.init();				
		},
		error:function()
		{
			$.toast("请求超时");
			$.hideIndicator(); 
		}
	});		
};
//定位
function position(){
	var options = {timeout: 8000};
	if(html_id=="index"||html_id=="main"){
		
	}else if(html_id=="tuan"||html_id=="stores"){
		$(".refresh").addClass('rotate');
	}
	if(app_index=="app"){
		try{
			App.position();
		}
		catch(ex)
		{
			//$.alert("POS"+ex);
			var geolocation = new qq.maps.Geolocation(TENCENT_MAP_APPKEY, "myapp");
			geolocation.getLocation(showPosition, showErr, options);
		}
	}else{
		var geolocation = new qq.maps.Geolocation(TENCENT_MAP_APPKEY, "myapp");
		geolocation.getLocation(showPosition, showErr, options);
	}
}
//app定位成功回调
function js_position(lat,lng){
	has_location = 1;//定位成功;
	userxypoint(lat, lng,"BD09");
}
/*关于定位函数*/

function showPosition(p){ 
	has_location = 1;//定位成功;
    m_latitude = p.lat; //纬度
    m_longitude = p.lng;
	userxypoint(m_latitude, m_longitude,'GCJ02');
}
function showErr(p){
	if(html_id=="index"||html_id=="main"){
		//alert("定位失败");
		console.log("定位失败");
	}else if(html_id=="tuan"||html_id=="stores"){
		console.log("定位失败");
		$(".refresh").removeClass('rotate');
	}
}
//将坐标返回到服务端;
function userxypoint(latitude,longitude,type){
	var query = new Object();
	query.m_latitude = latitude;
	query.m_longitude = longitude;
	query.m_type=type;
	$.ajax({
		url:geo_url,
		data:query,
		type:"post",
		dataType:"json",
		success:function(data){
			if(html_id=="index"){
				if(data.status==0)
				{
					$.confirm("当前城市是["+data.city.name+"],是否切换到"+data.city.name+"站？",function(){
						url=INDEX_URL;
						if(url.indexOf("?")==-1)
						{
							url+="?city_id="+data.city.id;
						}
						else
						{
							url+="&city_id="+data.city.id;
						}
						window.location.href = url;
					},function(){
						$.fn.cookie("cancel_geo",1,1);
					});
				}
			}else if(html_id=="main"){
				if(data.status==0)
				{
					$.confirm("当前城市是["+data.city.name+"],是否切换到"+data.city.name+"站？",function(){
						location.href = INDEX_URL+"&city_id="+data.city.id;
					},function(){
						$.fn.cookie("cancel_geo",1,1);
					});
				}
			}else if(html_id=="tuan"||html_id=="stores"){
				setTimeout(function () {
					$(".refresh").removeClass('rotate');
					$(".address").html("<i class='iconfont'>&#xe62f;</i>"+data.add);
				}, 2000);
			}else if(html_id=="position"){
				location.href = location.href;
			}
		}
		,error:function(){
		}
	});
}
/*end 关于定位函数*/
//登录页面清除input
function clear_input(inputbox,clearbtn) {
	inputbox.bind('input propertychange', function() {
		if (inputbox.val().length==0) {
			clearbtn.hide();
		} else {
			clearbtn.show();
		}
	});
	clearbtn.click(function(){
		inputbox.val('');
		clearbtn.hide();
	});
}

/**
 * 页面刷新，可以配置需要刷新的页面
 */
function js_ajax_load(sess_id){

	var pageId = $(".page-current").attr('id');
	var refresh_page = new Array();  //需要刷新的页面
	refresh_page.push('scores_index','user_center');
	if($.inArray(pageId,refresh_page) >= 0){
		var url = window.location.href;
		url = changeURLArg(url,'sess_id',sess_id);	
		$.ajax({
			url:url,
			type:"post",
			success:function(data){
				$(".content").html($(data).find(".content").html());
			}
			,error:function(){
			}
		});
	}

}


function changeURLArg(url,arg,arg_val){ 
    var pattern=arg+'=([^&]*)'; 
    var replaceText=arg+'='+arg_val; 
    if(url.match(pattern)){ 
        var tmp='/('+ arg+'=)([^&]*)/gi'; 
        tmp=url.replace(eval(tmp),replaceText); 
        return tmp; 
    }else{ 
        if(url.match('[\?]')){ 
            return url+'&'+replaceText; 
        }else{ 
            return url+'?'+replaceText; 
        } 
    } 
    return url+'\n'+arg+'\n'+arg_val; 
} 


function pay_sdk_json(data)
{
	var json = '{"pay_sdk_type":"'+data['pay_sdk_type']+'","config":{';
	for(var k in data['config'])
	{
		json+='"'+k+'":"'+data['config'][k]+'",';
	}
	json = json.substring(0,json.length-1);
	json+='}}';
	return json;

}

function app_detail_json(type,data)
{
	var json = '{'+type+',{'+data+'}}';
	App.app_detail(type,json);

}

/**
 * state： 1：订单支付成功  2	：正在处理中  3：订单支付失败 4：用户中途取消  5：网络连接出错  6：调用第三方失败（主要指：在调用支付sdk之前先遍历所需参数是否为空，为空则返回该值，此时app会抛出对应参数为空，便于调试）
 */
function js_pay_sdk(state){

	if(state==1){
		//$.router.load(pay_success_url, true);
		$.loadPage(location.href);
	}
}


function checkMobilePhone (value){
	value = $.trim(value);
	if(value != '') {
		var reg = /^(1[34578]\d{9})$/;
		return reg.test(value);
	} else {
		return false;
	}
};
function UploadImgCallback(data){
    var data=JSON.parse(data);
    if (data.error == 1000) {
    $.router.load(LOGIN_URL, true);
    } else if (data.error == 2000) {
    $.toast('图片上传发生错误,跟换浏览器重试');
    } else if (data.error > 0) {
    $.toast('图片上传发生错误');
    } else {
    $('img[up-name='+data.name+']').attr('src',data.absolute_url);
    $('input[name='+data.name+']').val(data.url);
    $.toast('图片上传成功');
    }
}

function qrcode_box() {
	$(".j-open-qrcode").on('click', function() {
		$(".m-mask").addClass('active');
		$(".m-qrcode-box").addClass('active');
	});
	$(".j-close-qrcode").on('click', function() {
		$(".m-mask").removeClass('active');
		$(".m-qrcode-box").removeClass('active');
	});
}
function screen_bar() {
	$(document).on("click",".dropdown-navlist",function() {
		screen_bar_close();
	});
	if ($(document).find('.screen-all')) {
		$(".screen-all").attr({
			'data-cid': $("#all-goods .type-detail .active").attr('data-cid'),
			'data-tid': $("#all-goods .type-detail .active").attr('data-tid')
		});
	} else {
		return;
	}
	if ($(document).find('.screen-area')) {
		$(".screen-area").attr({
			'data-qid': $("#area-screen .type-detail .active").attr('data-qid')
		});
	} else {
		return;
	}
	$(".m-screen-bar").on("click",".screen-link",function() {
		screen_bar_close();
		$(".screen-link").removeClass('active');
		$(this).addClass('active');
		$(".m-screen-bar").attr('data-type', $(this).attr('data-type'));
	});
	//筛选
	//标签
	$(".m-screen-bar").on("click",".screen-item a",function(){
		$(".arrow-up").hide();
		$(".arrow-down").show();
		$(".m-screen-list").removeClass('active');
		$(".goods-type li").removeClass('active');
	});
	//全部
	function screen_open() {
		$(".content").css('overflow', 'hidden');
		$(".m-screen-list").addClass('active');
	}
	function screen_close() {
		$(".content").css('overflow', 'auto');
		$(".m-screen-list").removeClass('active');
	}
	$(".m-screen-bar").on("click",".screen-all",function() {
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
			screen_close();
			$("#all-goods").removeClass('active');
		} else {
			$(this).addClass('active');
			$(".screen-area").removeClass('active');
			$("#area-screen").removeClass('active');
			$(this).find('.arrow-down').hide();
			$(this).find('.arrow-up').show();
			screen_open();
			$("#all-goods").addClass('active');
			$("#all-goods .goods-type li").eq($(this).attr("data-id")).addClass('active');
			$("#all-goods .type-detail ul").eq($(this).attr("data-id")).show();
		}
	});
	$(".m-screen-list").on("click",".goods-type li",function() {
		$(".goods-type li").removeClass('active');
		$(this).addClass('active');
		$(".type-detail ul").hide();
		if ($(".goods-type li").hasClass('active')) {
			var type_id = $(this).attr('data-id');
			$(this).parent().parent().find(".type-detail ul").eq(type_id).show();
		}
	});
	$("#all-goods").on('click', '.type-detail li', function() {
		$("#all-goods .type-detail li").removeClass('active');
		$(this).addClass('active');
		$(".screen-all p").html($(this).find('.flex-1').html());
		$(".screen-all").attr('data-id', $(this).parent().attr("data-id"));
		$(".screen-all").attr('data-cid', $(this).attr("data-cid"));
		$(".screen-all").attr('data-tid', $(this).attr("data-tid"));
		$(".screen-link").removeClass('active');
	});
	$("#all-goods").on('click', '.type-detail li:first-child', function() {
		var type_id = $(this).parent().attr('data-id');
		$(".screen-all p").html($("#all-goods .goods-type li").eq(type_id).html());
	});
	//全城
	$(".m-screen-bar").on("click",".screen-area",function() {
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
			screen_close();
			$("#area-screen").removeClass('active');
		} else {
			$(this).addClass('active');
			$(this).find('.arrow-down').hide();
			$(this).find('.arrow-up').show();
			$(".screen-all").removeClass('active');
			$("#all-goods").removeClass('active');
			screen_open();
			$("#area-screen").addClass('active');
			$(".goods-type li").removeClass('acitve');
			$("#area-screen .goods-type li").eq($(this).attr("data-id")).addClass('active');
			$("#area-screen .type-detail ul").eq($(this).attr("data-id")).show();
		}
	});
	$("#area-screen").on('click', '.type-detail li', function() {
		$("#area-screen .type-detail li").removeClass('active');
		$(this).addClass('active');
		$(".screen-area p").html($(this).find('p').html());
		$(".screen-area").attr('data-id', $(this).parent().attr("data-id"));
		$(".screen-area").attr('data-qid', $(this).attr("data-qid"));
		$(".screen-link").removeClass('active');
	});
	$("#area-screen").on('click', '.type-detail li:first-child', function() {
		var type_id = $(this).parent().attr('data-id');
		$(".screen-area p").html($("#area-screen .goods-type li").eq(type_id).html());
	});
	$(document).off('click', '.j-listchoose');
	$(document).on("click",".j-listchoose",function() {
		var c_id = $(".screen-all").attr('data-cid');
		var t_id = $(".screen-all").attr('data-tid');
		var q_id = $(".screen-area").attr('data-qid');
		var order_type = $(".m-screen-bar").attr('data-type');
		var url = sitename+'/wap/index.php?ctl='+ctl_name+'&cate_id='+c_id+'&tid='+t_id+'&qid='+q_id+'&order_type='+order_type;
		if(key!=''){
			url+='&keyword='+key;
		}
		var nidate="<div class='tipimg no_data'>"+"没有数据啦"+"</div>";
		$.ajax({
			url:url,
			type:"POST",
			success:function(html)
			{
				$(".j-ajaxlist").html($(html).find(".j-ajaxlist").html());
				$(".j-pj").html($(html).find(".j-pj").html());
				$(".j-jg").html($(html).find(".j-jg").html());
				$(".j-zj").html($(html).find(".j-zj").html());
				$(".j-zx").html($(html).find(".j-zx").html());
				$("#all-goods").html($(html).find("#all-goods").html());
				$("#area-screen").html($(html).find("#area-screen").html());
				if ($(html).find(".j-ajaxlist").html()==null) {
					$(".j-ajaxlist").html(nidate);
				}else{
					init_list_scroll_bottom();
				};
			},
			error:function()
			{
				$.toast("加载失败咯~");
			}
		});
		$.showIndicator();
		setTimeout(function () {
			$.hideIndicator();
		}, 800);
		screen_bar_close();
	});
	$(document).off('click', '.screen-link');
	$(document).on("click",".screen-link",function() {
		var url = $(this).attr('date-href');
		var nidate="<div class='tipimg no_data'>"+"没有数据啦"+"</div>";
		$.ajax({
			url:url,
			type:"POST",
			success:function(html)
			{
				$(".j-ajaxlist").html($(html).find(".j-ajaxlist").html());
				$(".j-pj").html($(html).find(".j-pj").html());
				$(".j-jg").html($(html).find(".j-jg").html());
				$(".j-zj").html($(html).find(".j-zj").html());
				$(".j-zx").html($(html).find(".j-zx").html());
				$(".m-screen-list").html($(html).find(".m-screen-list").html());
				if ($(html).find(".j-ajaxlist").html()==null) {
					$(".j-ajaxlist").html(nidate);
				}else{
					init_list_scroll_bottom();
				};
			},
			error:function()
			{
				$.toast("加载失败咯~");
			}
		});
		$.showIndicator();
		setTimeout(function () {
			$.hideIndicator();
		}, 800);
		screen_bar_close();
	});
}

function screen_bar_close() {
	$(".m-screen-list").removeClass('active');
	$(".content").css('overflow', 'auto');
	$(".arrow-up").hide();
	$(".arrow-down").show();
	$(".screen-area").removeClass('active');
	$(".screen-all").removeClass('active');
}
function select_box(open,box) {
	open.on('click', function() {
		box.addClass('active');
		$(".m-mask").addClass('active');
	});
	$(".j-close-select").on('click', function() {
		$(".m-select-box").removeClass('active');
		$(".m-mask").removeClass('active');
	});
	$(".j-close-box").on('click', function() {
		box.removeClass('active');
		$(".m-mask").removeClass('active');
	});
}
/*
 * Swipe 1.0
 *
 * Brad Birdsall, Prime
 * Copyright 2011, Licensed GPL & MIT
 *
*/

window.Swipe = function(element, options) {

  // return immediately if element doesn't exist
  if (!element) return null;

  var _this = this;

  // retreive options
  this.options = options || {};
  this.index = this.options.startSlide || 0;
  this.speed = this.options.speed || 300;
  this.callback = this.options.callback || function() {};
  this.delay = this.options.auto || 0;
  this.unresize = this.options.unresize; //anjey

  // reference dom elements
  this.container = element;
  this.element = this.container.children[0]; // the slide pane

  // static css
  //this.container.style.overflow = 'hidden'; //by anjey
  this.element.style.listStyle = 'none';

  // trigger slider initialization
  this.setup();

  // begin auto slideshow
  this.begin();

  // add event listeners
  if (this.element.addEventListener) {
  	//by anjey
  	this.element.addEventListener('mousedown', this, false);
  	 
    this.element.addEventListener('touchstart', this, false);
    this.element.addEventListener('touchmove', this, false);
    this.element.addEventListener('touchend', this, false);
    this.element.addEventListener('webkitTransitionEnd', this, false);
    this.element.addEventListener('msTransitionEnd', this, false);
    this.element.addEventListener('oTransitionEnd', this, false);
    this.element.addEventListener('transitionend', this, false);
    if(!this.unresize){ // anjey
    	window.addEventListener('resize', this, false);
    }
  }

};

Swipe.prototype = {

  setup: function() {

    // get and measure amt of slides
    this.slides = this.element.children;
    this.length = this.slides.length;

    // return immediately if their are less than two slides
    if (this.length < 2) return null;

    // determine width of each slide
    this.width = this.container.getBoundingClientRect().width || this.width; //anjey
    // return immediately if measurement fails
    if (!this.width) return null;

    // hide slider element but keep positioning during setup
    this.container.style.visibility = 'hidden';

    // dynamic css
    this.element.style.width = (this.slides.length * this.width) + 'px';
    var index = this.slides.length;
    while (index--) {
      var el = this.slides[index];
      el.style.width = this.width + 'px';
      el.style.display = 'table-cell';
      el.style.verticalAlign = 'top';
    }
    // set start position and force translate to remove initial flickering
    this.slide(this.index, 0); 

    // show slider element
    this.container.style.visibility = 'visible';

  },

  slide: function(index, duration) {

    var style = this.element.style;

    // fallback to default speed
    if (duration == undefined) {
        duration = this.speed;
    }

    // set duration speed (0 represents 1-to-1 scrolling)
    style.webkitTransitionDuration = style.MozTransitionDuration = style.msTransitionDuration = style.OTransitionDuration = style.transitionDuration = duration + 'ms';

    // translate to given index position
    style.MozTransform = style.webkitTransform = 'translate3d(' + -(index * this.width) + 'px,0,0)';
    style.msTransform = style.OTransform = 'translateX(' + -(index * this.width) + 'px)';

    // set new index to allow for expression arguments
    this.index = index;

  },

  getPos: function() {
    
    // return current index position
    return this.index;

  },

  prev: function(delay) {

    // cancel next scheduled automatic transition, if any
    this.delay = delay || 0;
    clearTimeout(this.interval);

    // if not at first slide
    if (this.index) this.slide(this.index-1, this.speed);

  },

  next: function(delay) {

    // cancel next scheduled automatic transition, if any
    this.delay = delay || 0;
    clearTimeout(this.interval);

    if (this.index < this.length - 1) this.slide(this.index+1, this.speed); // if not last slide
    else this.slide(0, this.speed); //if last slide return to start

  },

  begin: function() {

    var _this = this;

    this.interval = (this.delay)
      ? setTimeout(function() { 
        _this.next(_this.delay);
      }, this.delay)
      : 0;
  
  },
  
  stop: function() {
    this.delay = 0;
    clearTimeout(this.interval);
  },
  
  resume: function() {
    this.delay = this.options.auto || 0;
    this.begin();
  },

  handleEvent: function(e) {
  	var that = this;
  	if(!e.touches){
  		e.touches = new Array(e);
  		e.scale = false;
  	}
    switch (e.type) {
      // by anjey
      case 'mousedown': (function(){
      		that.element.addEventListener('mousemove', that, false);
   			that.element.addEventListener('mouseup', that, false);
   			that.element.addEventListener('mouseout', that, false);
      		that.onTouchStart(e);
      })(); break;
      case 'mousemove': this.onTouchMove(e); break;
      case 'mouseup': (function(){
	      	that.element.removeEventListener('mousemove', that, false);
	   		that.element.removeEventListener('mouseup', that, false);
	   		that.element.removeEventListener('mouseout', that, false);
	      	that.onTouchEnd(e);
      })(); break;
     case 'mouseout': (function(){
      		that.element.removeEventListener('mousemove', that, false);
   			that.element.removeEventListener('mouseup', that, false);
   			that.element.removeEventListener('mouseout', that, false);
      		that.onTouchEnd(e);
      })(); break;
    	
      case 'touchstart': this.onTouchStart(e); break;
      case 'touchmove': this.onTouchMove(e); break;
      case 'touchend': this.onTouchEnd(e); break;
      case 'webkitTransitionEnd':
      case 'msTransitionEnd':
      case 'oTransitionEnd':
      case 'transitionend': this.transitionEnd(e); break;
      case 'resize': this.setup(); break;
    }
  },

  transitionEnd: function(e) {
    e.preventDefault();
    if (this.delay) this.begin();

    this.callback(e, this.index, this.slides[this.index]);

  },

  onTouchStart: function(e) {
    
    this.start = {

      // get touch coordinates for delta calculations in onTouchMove
      pageX: e.touches[0].pageX,
      pageY: e.touches[0].pageY,

      // set initial timestamp of touch sequence
      time: Number( new Date() )

    };

    // used for testing first onTouchMove event
    this.isScrolling = undefined;
    
    // reset deltaX
    this.deltaX = 0;

    // set transition time to 0 for 1-to-1 touch movement
    this.element.style.MozTransitionDuration = this.element.style.webkitTransitionDuration = 0;

  },

  onTouchMove: function(e) {

    // ensure swiping with one touch and not pinching
    if(e.touches.length > 1 || e.scale && e.scale !== 1) return;

    this.deltaX = e.touches[0].pageX - this.start.pageX;

    // determine if scrolling test has run - one time test
    if ( typeof this.isScrolling == 'undefined') {
      this.isScrolling = !!( this.isScrolling || Math.abs(this.deltaX) < Math.abs(e.touches[0].pageY - this.start.pageY) );
    }

    // if user is not trying to scroll vertically
    if (!this.isScrolling) {

      // prevent native scrolling 
      e.preventDefault();

      // cancel slideshow
      clearTimeout(this.interval);

      // increase resistance if first or last slide
      this.deltaX = 
        this.deltaX / 
          ( (!this.index && this.deltaX > 0               // if first slide and sliding left
            || this.index == this.length - 1              // or if last slide and sliding right
            && this.deltaX < 0                            // and if sliding at all
          ) ?                      
          ( Math.abs(this.deltaX) / this.width + 1 )      // determine resistance level
          : 1 );                                          // no resistance if false
      
      // translate immediately 1-to-1
      this.element.style.MozTransform = this.element.style.webkitTransform = 'translate3d(' + (this.deltaX - this.index * this.width) + 'px,0,0)';

    }

  },

  onTouchEnd: function(e) {

    // determine if slide attempt triggers next/prev slide
    var isValidSlide = 
          Number(new Date()) - this.start.time < 250      // if slide duration is less than 250ms
          && Math.abs(this.deltaX) > 20                   // and if slide amt is greater than 20px
          || Math.abs(this.deltaX) > this.width/2,        // or if slide amt is greater than half the width

    // determine if slide attempt is past start and end
        isPastBounds = 
          !this.index && this.deltaX > 0                          // if first slide and slide amt is greater than 0
          || this.index == this.length - 1 && this.deltaX < 0;    // or if last slide and slide amt is less than 0

    // if not scrolling vertically
    if (!this.isScrolling) {

      // call slide function with slide end value based on isValidSlide and isPastBounds tests
      this.slide( this.index + ( isValidSlide && !isPastBounds ? (this.deltaX < 0 ? 1 : -1) : 0 ), this.speed );

    }

  }

};

/**
 * Created by Administrator on 2016/9/8.
 */




$(document).on("pageInit", "#uc_address_index", function(e, pageId, $page){
	
	
	
	
    $("#uc_address_index").on('click','.confirm-address', function () {
        var _this=$(this);
        $.confirm('确定要删除该地址吗？', function () {
        	$.ajax({
				url: _this.attr('del_url'),
				data: {},
				dataType: "json",
				type: "post",
				success: function(obj){
					if(obj.status == 1){
						_this.parents("li").remove();
					}else{
						$.alert(obj.info);
					}
				},
        	});
        });
    });


    $("#uc_address_index").on("change",".j-address-set input[type=radio]",function () {
		

        if($(this).prop('checked')==true){

			var vobj=$(this);
        	$.ajax({
				url: $(this).attr('dfurl'),
				data: {},
				dataType: "json",
				type: "post",
				success: function(obj){
					if(obj.status == 1){
						vobj.parents(".j-address-set").find(".u-set-default").addClass("j-address-color");
						vobj.parents("li").siblings("li").find(".u-set-default").removeClass("j-address-color");
					}else{
						$.toast("失败");
					}
				},
        	});
            
        }
    });
    

});
$(document).on("pageInit", "#biz_coupon_check", function(e, pageId, $page) {
	function openSelect(open_btn,open_item) {
		$(open_btn).on('click', function() {
			$(".delivery-mask").addClass('active');
			$(open_item).addClass('active');
		});
		$(".delivery-mask").on('click', function() {
			$(this).removeClass('active');
			$(open_item).removeClass('active');
		});
	}
	function closeSelect(close_item) {
		$(".delivery-mask").removeClass('active');
		$(close_item).removeClass('active');
	}
	//绑定团购数量
	$(".flex-box .coupon_use_count").on("blur",function(){
		var use_count = $(this).val();
		var can_number = $(".coupon-check-count .num").text();
		if(isNaN(use_count)||parseInt(use_count)<=0){
			use_count=1;
		}
		if(parseInt(use_count) > parseInt(can_number)){
			use_count=can_number;
		}
		$(this).val(use_count);
	});
	$(".flex-box .coupon_use_count").on("focus",function(){
		$(this).select();
	});
	//团购券数量
	$(".flex-box .count-disable").on("click",function(){
		var use_count = $(".flex-box .coupon_use_count").val();
		var can_number = $(".coupon-check-count .num").text();
		use_count = parseInt(use_count) - 1;
		if(isNaN(use_count)||parseInt(use_count)<=0){
			use_count=1;
		}
		if(use_count>can_number){
			use_count=can_number;
		}
		$(".flex-box .coupon_use_count").val(use_count);
	});
	$(".flex-box .count-plus").on("click",function(){
		var use_count = $(".flex-box .coupon_use_count").val();
		var can_number = $(".coupon-check-count .num").text();
		use_count = parseInt(use_count) + 1;
		if(isNaN(use_count)||parseInt(use_count)<=0){
			use_count=1;
		}
		if(use_count>can_number){
			use_count=can_number;
		}
		$(".flex-box .coupon_use_count").val(use_count);
	});
	//选择验证门店
	openSelect('.j-shop-select','.shop-select');
	$(".shop-list").on('click', 'li', function() {
		$(".shop-list li").removeClass('active');
		$(this).addClass('active');
	});
	$(".shop-cancle").on('click', function() {
		closeSelect('.shop-select');
	});
	$(".shop-confirm").on('click', function() {
		closeSelect('.shop-select');
		$(".j-shop-select .shop-name").html($(".shop-select .active .shop-name").html());
		$(".j-shop-select .shop-id").val($(".shop-select .active .shop-id").val());
	});
	
	//核销提交
	$(".check-confirm").on('click', function() {
		var query = new Object();
		query.location_id = $(".j-shop-select .shop-id").val();
		query.coupon_use_count = $(".flex-box .coupon_use_count").val();
		query.coupon_pwd = coupon_pwd;
		$.ajax({
			url:url,
			data:query,
			dataType: "json",
			type:"post",
			success:function(obj){
				if(obj.status==1){
					$.toast(obj.info);
					setTimeout(function() {
                    	location.href = obj.jump;
                    }, 1500);
				}else{
					$.toast(obj.info);
				}
			},
            error: function() {
                $.toast("网络被风吹走啦~");
           	}
		});
	});
});
$(document).on("pageInit", "#biz_coupon_use_log", function(e, pageId, $page) {
	$(document).on('click', '.j-use-search', function() {
		$(".use-search-bar").addClass('open');
	});
	$(".use-search-bar").on('click', '.j-close-use-search', function() {
		$(".use-search-bar").removeClass('open');
		window.location.reload();
	});

	init_list_scroll_bottom();

	$('.search').bind('click', function() {
		var pwd = $.trim($('input[name="coupon_pwd"]').val());
		if (pwd == '') {
			$.toast('请输入要搜索的券码');
			return;
		}
		pwd = pwd.replace(/\s/g,'');
		if (pwd.length!=12) {
			$.toast('请输入有效券码');
			return;
		}
		var param = {
			act: 'search_log',
			coupon_pwd: pwd
		};
		$.ajax({
			url: use_log,
			type:"GET",
			data: param,
			dataType:"JSON",
			success: function(html) {

				$('.j-ajaxlist').html($(html).find('.j-ajaxlist').html());
				init_list_scroll_bottom();
			},
			error: function(err) {
				console.log(err);
			}
		});
		return false;
	});
});
/**
 * 
 */
$(document).on("pageInit", "#biz_dc_abnormal_order", function(e, pageId, $page) {
	
	init_list_scroll_bottom();//下拉刷新加载
	
	var _rehei=$(".j-red-reward").height();
	
	$(document).on('click',".j-handle",function () {
        $(".totop").addClass("vible");
        $(".popup-box .j-trans-way").css({"bottom":-_rehei});
        $(".popup-box").css({"transition":"all 0.3s linear","opacity":"1","z-index":"9999"});
        $(".popup-box .j-red-reward").css({"transition":"bottom 0.3s linear","bottom":"0"});
        $(".popup-box .pup-box-bg").css({"transition":"opacity 0.3s linear","opacity":"0.6"});
        
        var data_account=$(this).attr('dada-account');
        
        $("input[name='order_id']").val($(this).attr('data-id'));
        $("input[name='dada_account']").val(data_account);
        
        if(!is_open_dada_delivery){
        	$("#dada-data").find(".item-title").html("委托达达配送(未开启，请在pc后台开启)"); 	
        }
        else if(data_account == ''){
        	$("#dada-data").find(".item-title").html("委托达达配送(帐号未注册，请在pc后台开启)");
        }
        else if(!delivery_money_enough){
        	$("#dada-data").find(".item-title").html("委托达达配送(配送余额不足，请在pc后台充值)"); 
        }
        
        if(!is_open_dada_delivery || data_account == '' || !delivery_money_enough){
        	$("#dada-data").find("input[name='delivery_part']").attr('checked',true);
        	$("#dada-data").find("input[name='delivery_part']").attr('disabled','disabled');
        	$("#dada-data").find(".icon-form-checkbox").css('border','gray!important');
        	$("#dada-data").find(".icon-form-checkbox").css('background-color','gray');
        }
        
	});
	
	$(document).on('click',".j-cancel",function () {
        popupTransition();
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },300);
    });
	
	$(document).on('click',".j-box-bg",function () {
        popupTransition();
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },300);
    });
	
	/*弹出层动画效果*/
    function popupTransition() {
        /* $(".j-cancel").parents(".m-trans-way").css({"transition":"bottom 0.3s linear","bottom":-_hei});*/
        //$(".popup-box .j-trans-way").css({"transition":"bottom 0.3s linear","bottom":-_hei});
        $(".popup-box .j-red-reward").css({"transition":"bottom 0.3s linear","bottom":-_rehei});
        $(".j-cancel").parents(".popup-box").find(".pup-box-bg").css({"transition":"opacity 0.3s linear","opacity":"0"});
        $(".j-cancel").parents(".popup-box").css({"transition":"all 0.3s linear 0.3s","opacity":"0","z-index":"-1"});
    }
	
    $("input[type='radio']").change(function(){
    	popupTransition();
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },300);
    	
    	var type=$("input[type='radio']:checked").val();
    	
    	var dada_account=$("input[name='dada_account']").val();
    	
    	if(type==2){
    		if(!is_open_dada_delivery){
    			$.toast('达达未开启，请在pc后台开启'); 
    			return false;
    		}
    		if(dada_account == ''){
    			$.toast('达达帐号未注册，请在pc后台开启'); 
    			return false;
    		}
    		if(delivery_money_enough == 0){
    			$.toast('达达配送余额不足，请在pc后台充值'); 
    			return false;
    		}
    	}
    	var query=new Object();
    	query.act="accept_order";
    	query.type=type;
    	query.id=$("input[name='order_id']").val();
    	
    	$.ajax({
        	  url:ajax_url,
        	  data:query,
        	  type:'post',
        	  dataType:'json',
        	  success:function(data){
        		  
        		  $.toast(data.info); 
    			  setTimeout(function () {
   				  	  location.reload(); 
 			      }, 1000);
        		  
        	  }
          });
    	
    	return false;
    });
    
});
$(document).on("pageInit", "#biz_dc_order", function(e, pageId, $page) {
	init_listscroll(".j-ajaxlist-"+sort_1,".j-ajaxadd-"+sort_1);
	
	function tab_line() {
		var init_width=$(".j-list-choose.active span").width();
		var init_left=$(".j-list-choose.active span").offset().left;
		$(".list-nav-line").css({
			width: init_width,
			left: init_left
		});
	}
	tab_line();
	
	//分类加载内容
	$(".j-list-choose").on('click', function() {
		$(document).off('infinite', '.infinite-scroll-bottom');
		var sort=$(this).attr("sort");
		//alert(sort);
		$(".j-list-choose").removeClass('active');
		$(this).addClass('active');
		$(".biz-order-list").hide();
		tab_line();
		var url=$(this).attr("data-href");
		$(".j-ajaxlist-"+sort).show();
		$(".content").scrollTop(1); 
		if($(".j-ajaxlist-"+sort).html()==null){
			  $.ajax({
			    url:url,
			    type:"POST",
			    success:function(html)
			    {
			      //console.log("成功");
			      
			      $(".content").append($(html).find(".content").html());
			      init_listscroll(".j-ajaxlist-"+sort,".j-ajaxadd-"+sort);
			    },
			    error:function()
			    {
			    	
			    	$(".j-ajaxlist-"+sort).find(".page-load span").removeClass("loading").addClass("loaded").html("网络被风吹走啦~");
			      //console.log("加载失败");
			    }
			  });
		}
		else{
			if( $(".content").scrollTop()>0 ){
				infinite(".j-ajaxlist-"+sort,".j-ajaxadd-"+sort);
			}
        }

	});
	
	
	/*$(document).on('click', '.j-accept', function() {
		var url = $(this).attr('data_url');
		var query = new Object();
		$.ajax({
      	  url:url,
      	  type:'post',
      	  dataType:'json',
      	  success:function(data){
      		  if(data.status == 1){
       			 $.toast(data.info); 
       			 setTimeout(function () {
  				  location.reload(); 
			      }, 2000);
      		  }else{
      			$.toast(data.info);
      			 setTimeout(function () {
     				  location.reload(); 
   			      }, 2000);
      		  }
      	  }
        });
	});*/
	
	var _rehei=$(".j-red-reward").height();
	
	$(document).on('click',".j-accept",function () {
        $(".totop").addClass("vible");
        $(".popup-box .j-trans-way").css({"bottom":-_rehei});
        $(".popup-box").css({"transition":"all 0.3s linear","opacity":"1","z-index":"9999"});
        $(".popup-box .j-red-reward").css({"transition":"bottom 0.3s linear","bottom":"0"});
        $(".popup-box .pup-box-bg").css({"transition":"opacity 0.3s linear","opacity":"0.6"});
        $("input[name='order_id']").val($(this).attr('data-id'));
	});
	
	$(document).on('click',".j-cancel",function () {
        popupTransition();
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },300);
    });
	
	$(document).on('click',".j-box-bg",function () {
        popupTransition();
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },300);
    });
	
	/*弹出层动画效果*/
    function popupTransition() {
        /* $(".j-cancel").parents(".m-trans-way").css({"transition":"bottom 0.3s linear","bottom":-_hei});*/
        //$(".popup-box .j-trans-way").css({"transition":"bottom 0.3s linear","bottom":-_hei});
        $(".popup-box .j-red-reward").css({"transition":"bottom 0.3s linear","bottom":-_rehei});
        $(".j-cancel").parents(".popup-box").find(".pup-box-bg").css({"transition":"opacity 0.3s linear","opacity":"0"});
        $(".j-cancel").parents(".popup-box").css({"transition":"all 0.3s linear 0.3s","opacity":"0","z-index":"-1"});
    }
	
    $("input[type='radio']").change(function(){
    	popupTransition();
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },300);
    	
    	var type=$("input[type='radio']:checked").val();
    	
    	if(type==2){
    		if(!is_open_dada_delivery){
    			$.toast('达达未开启，请在pc后台开启'); 
    			return false;
    		}
    		if(dada_account == ''){
    			$.toast('达达帐号未注册，请在pc后台开启'); 
    			return false;
    		}
    		if(delivery_money_enough == 0){
    			$.toast('达达配送余额不足，请在pc后台充值'); 
    			return false;
    		}
    	}
    	var query=new Object();
    	query.act="accept_order";
    	query.type=type;
    	query.id=$("input[name='order_id']").val();
    	
    	$.ajax({
        	  url:ajax_url,
        	  data:query,
        	  type:'post',
        	  dataType:'json',
        	  success:function(data){
        		  if(data.status == 1){
        			  $.toast(data.info); 
        			  setTimeout(function () {
       				  	  location.reload(); 
     			      }, 2000);
           		  }else{
           			  $.toast(data.info);
           			  setTimeout(function () {
          				  location.reload(); 
    			      }, 2000);
           		  }
        	  }
          });
    	
    	return false;
    });
	
});
$(document).on("pageInit", "#dc_resview", function(e, pageId, $page) {
	//通用方法（接单，取消，确认）	
	$(document).on('click', '.j-submit', function() {
		var url = $(this).attr('data_url');
		var query = new Object();
		$.ajax({
      	  url:url,
      	  type:'post',
      	  dataType:'json',
      	  success:function(data){
      		  if(data.status == 1){
       			 $.toast(data.info); 
       			 setTimeout(function () {
  				  location.reload(); 
			      }, 2000);
      		  }else{
      			$.toast(data.info);
      			 setTimeout(function () {
     				  location.reload(); 
   			      }, 2000);
      		  }
      	  }
        });
	});

});
$(document).on("pageInit", "#biz_dc_rsorder", function(e, pageId, $page) {
	init_listscroll(".j-ajaxlist-"+sort_1,".j-ajaxadd-"+sort_1);
	
	$(document).on('click', '.j-submit', function() {
		var url = $(this).attr('data_url');
		var query = new Object();
		$.ajax({
      	  url:url,
      	  type:'post',
      	  dataType:'json',
      	  success:function(data){
      		  if(data.status == 1){
       			 $.toast(data.info); 
       			 setTimeout(function () {
  				  location.reload(); 
			      }, 2000);
      		  }else{
      			$.toast(data.info);
      			 setTimeout(function () {
     				  location.reload(); 
   			      }, 2000);
      		  }
      	  }
        });
	});
	
	
	function tab_line() {
		var init_width=$(".j-list-choose.active span").width();
		var init_left=$(".j-list-choose.active span").offset().left;
		$(".list-nav-line").css({
			width: init_width,
			left: init_left
		});
	}
	tab_line();
	
	//分类加载内容
	$(".j-list-choose").on('click', function() {
		$(document).off('infinite', '.infinite-scroll-bottom');
		var sort=$(this).attr("sort");
		//alert(sort);
		$(".j-list-choose").removeClass('active');
		$(this).addClass('active');
		$(".biz-order-list").hide();
		tab_line();
		var url=$(this).attr("data-href");
		$(".j-ajaxlist-"+sort).show();
		$(".content").scrollTop(1); 
		if($(".j-ajaxlist-"+sort).html()==null){
			  $.ajax({
			    url:url,
			    type:"POST",
			    success:function(html)
			    {
			      //console.log("成功");
			      
			      $(".content").append($(html).find(".content").html());
			      init_listscroll(".j-ajaxlist-"+sort,".j-ajaxadd-"+sort);
			    },
			    error:function()
			    {
			    	
			    	$(".j-ajaxlist-"+sort).find(".page-load span").removeClass("loading").addClass("loaded").html("网络被风吹走啦~");
			      //console.log("加载失败");
			    }
			  });
		}
		else{
			if( $(".content").scrollTop()>0 ){
				infinite(".j-ajaxlist-"+sort,".j-ajaxadd-"+sort);
			}
        }

	});


	
});
$(document).on("pageInit", "#dc_view", function(e, pageId, $page) {
	//通用方法（接单，取消，确认）	
	$(document).on('click', '.j-submit', function() {
		var url = $(this).attr('data_url');
		var query = new Object();
		$.ajax({
      	  url:url,
      	  type:'post',
      	  dataType:'json',
      	  success:function(data){
      		  if(data.status == 1){
       			 $.toast(data.info); 
       			 setTimeout(function () {
  				  location.reload(); 
			      }, 2000);
      		  }else{
      			$.toast(data.info);
      			 setTimeout(function () {
     				  location.reload(); 
   			      }, 2000);
      		  }
      	  }
        });
	});

	var _rehei=$(".j-red-reward").height();
	
	$(document).on('click',".j-accept",function () {
        $(".totop").addClass("vible");
        $(".popup-box .j-trans-way").css({"bottom":-_rehei});
        $(".popup-box").css({"transition":"all 0.3s linear","opacity":"1","z-index":"9999"});
        $(".popup-box .j-red-reward").css({"transition":"bottom 0.3s linear","bottom":"0"});
        $(".popup-box .pup-box-bg").css({"transition":"opacity 0.3s linear","opacity":"0.6"});
	});
	
	$(document).on('click',".j-cancel",function () {
        popupTransition();
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },300);
    });
	
	$(document).on('click',".j-box-bg",function () {
        popupTransition();
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },300);
    });
	
	/*弹出层动画效果*/
    function popupTransition() {
        /* $(".j-cancel").parents(".m-trans-way").css({"transition":"bottom 0.3s linear","bottom":-_hei});*/
        //$(".popup-box .j-trans-way").css({"transition":"bottom 0.3s linear","bottom":-_hei});
        $(".popup-box .j-red-reward").css({"transition":"bottom 0.3s linear","bottom":-_rehei});
        $(".j-cancel").parents(".popup-box").find(".pup-box-bg").css({"transition":"opacity 0.3s linear","opacity":"0"});
        $(".j-cancel").parents(".popup-box").css({"transition":"all 0.3s linear 0.3s","opacity":"0","z-index":"-1"});
    }
    
    /*$(document).off('click',".label-checkbox");
    $(document).on('click',".list-block",function(){
    	var val=$(this).find("input[name='delivery_type']").val();
    	
    	alert(111);
    });*/
    
    $("input[type='radio']").change(function(){
    	popupTransition();
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },300);
    	
    	var type=$("input[type='radio']:checked").val();
    	
    	if(type==2){
    		if(!is_open_dada_delivery){
    			$.toast('达达未开启，请在pc后台开启'); 
    			return false;
    		}
    		if(dada_account == ''){
    			$.toast('达达帐号未注册，请在pc后台开启'); 
    			return false;
    		}
    		if(delivery_money_enough == 0){
    			$.toast('达达配送余额不足，请在pc后台充值'); 
    			return false;
    		}
    	}
    	var query=new Object();
    	query.act="accept_order";
    	query.type=type;
    	query.id=order_id;
    	
    	$.ajax({
        	  url:ajax_url,
        	  data:query,
        	  type:'post',
        	  dataType:'json',
        	  success:function(data){
        		  if(data.status == 1){
        			  $.toast(data.info); 
        			  setTimeout(function () {
       				  	  location.reload(); 
     			      }, 2000);
           		  }else{
           			  $.toast(data.info);
           			  setTimeout(function () {
          				  location.reload(); 
    			      }, 2000);
           		  }
        	  }
          });
    	
    	return false;
    });
	
});
$(document).on("pageInit", "#biz_getpassword", function(e, pageId, $page) {

});

$(document).on("pageInit", "#biz_info_setting", function(e, pageId, $page)  {

    //退出登录
	$(".btn-con").click(function(){
		var exit_url=$(this).attr("data-url");
		var query = new Object();
		query.act='loginout';
		$.ajax({
			url:exit_url,
			data:query,
			type:"POST",
			dataType:"json",
			success:function(obj){
				if(obj.status)
				{
					$.toast(obj.info);
					setTimeout(function(){
						$.router.load(obj.jump,true);
					},1500);
				}
				else
				{
					$.toast(obj.info);
					return false;
				}
			},
			error:function(){
			$.toast("服务器提交错误");
			return false;
			}
		});
		return false;
	});

});
$(document).on("pageInit", "#biz_manage", function(e, pageId, $page) {
	$(".biz-manage-list").on('click', '.j-unauth', function() {
		$.toast("没有操作权限");
	});
	dc_popup($(".j-open-dc"),$(".j-dc-popup"));
	dc_popup($(".j-open-rs"),$(".j-rs-popup"));
	$(".j-close-popup").on('click', function() {
		$(".dc-mask").removeClass('active');
		$(".dc-popup").removeClass('active');
	});
	//打开弹层
	function dc_popup(dc_open,popup) {
		dc_open.on('click', function() {
			$(".dc-mask").addClass('active');
			popup.addClass('active');
			/* Act on the event */
		});
	}
});
$(document).on("pageInit", "#biz_money_log", function(e, pageId, $page) {
	init_listscroll(".j-ajaxlist-"+type_1,".j-ajaxadd-"+type_1);
	
	function tab_line() {
		var init_width=$(".j-list-choose.active span").width();
		var init_left=$(".j-list-choose.active span").offset().left;
		$(".list-nav-line").css({
			width: init_width,
			left: init_left
		});
	}
	tab_line();
	
	//分类加载内容
	$(".j-list-choose").on('click', function() {
		$(document).off('infinite', '.infinite-scroll-bottom');
		var type=$(this).attr("type");
//		alert(type);
		$(".j-list-choose").removeClass('active');
		$(this).addClass('active');
		$(".biz-money-log").hide();
		tab_line();
		var url=$(this).attr("data-href");
		$(".j-ajaxlist-"+type).show();
		$(".content").scrollTop(1); 
		if($(".j-ajaxlist-"+type).html()==null){
			  $.ajax({
			    url:url,
			    type:"POST",
			    success:function(html)
			    {
			      //console.log("成功");
			      
			      $(".content").append($(html).find(".content").html());
			      init_listscroll(".j-ajaxlist-"+type,".j-ajaxadd-"+type);
			    },
			    error:function()
			    {
			    	
			    	$(".j-ajaxlist-"+type).find(".page-load span").removeClass("loading").addClass("loaded").html("网络被风吹走啦~");
			      //console.log("加载失败");
			    }
			  });
		}
		else{
			if( $(".content").scrollTop()>0 ){
				infinite(".j-ajaxlist-"+type,".j-ajaxadd-"+type);
			}
        }

	});
	
});
$(document).on("pageInit", "#biz_msg_cate", function(e, pageId, $page) {
	refreshdata([".biz_msg_change"]);
});
$(document).on("pageInit", "#biz_msg_index", function(e, pageId, $page) {
	
});
$(document).on("pageInit", "#biz_presell_order", function(e, pageId, $page) {
    init_listscroll(".j-ajaxlist-0",".j-ajaxadd-0");
    init_listscroll(".j-ajaxlist-1",".j-ajaxadd-1");
    init_listscroll(".j-ajaxlist-2",".j-ajaxadd-2");
    function tab_line() {
        var init_width=$(".biz-shop-order-tab .active span").width();
        var init_left=$(".j-tab-item.active span").offset().left;
        $(".tab-line").css({
            width: init_width,
            left: init_left
        });
    }
    tab_line();
    $(".biz-shop-order-tab").on('click', '.j-tab-item', function(event) {
        var type=$(this).attr("type");

        if($(".content").find(".j-ajaxadd-"+type).length > 0){

            $(".biz-shop-order-tab .j-tab-item").removeClass('active');
            $(this).addClass('active').siblings().removeClass('active');

            $(".content .m-biz-shop-order-list").removeClass('active');
            $(".content").find(".j-ajaxlist-"+type).addClass('active').siblings().removeClass('active');
            tab_line();
            init_listscroll(".j-ajaxlist-"+type,".j-ajaxadd-"+type);
        }else{


            $(document).off('infinite', '.infinite-scroll-bottom');
            $(".j-tab-item").removeClass('active');
            $(this).addClass('active');
            var item_width=$(this).find('span').width();
            var item_left=$(this).find('span').offset().left;
            $(".tab-line").css({
                width: item_width,
                left: item_left
            });
            var url=$(this).attr("data-href");

            $.ajax({
                url:url,
                type:"POST",
                success:function(html)
                {

                    $(".j-ajaxlist-"+type).addClass('active').html($(html).find(".j-ajaxlist-"+type).html()).siblings().removeClass('active');

                    if ($(html).find(".j-ajaxadd-"+type).length==0) {
                        return;
                    }else{
                        init_listscroll(".j-ajaxlist-"+type,".j-ajaxadd-"+type);
                    };
                },
                error:function()
                {
                    $.toast("加载失败咯~");
                }
            });
            $.showIndicator();
            setTimeout(function () {
                $.hideIndicator();
            }, 800);
        }
    });
    var swiperm = new Swiper(".j-order-shop-img", {
        scrollbarHide: true,
        slidesPerView: 'auto',
        freeMode: false
    });
});
$(document).on("pageInit", "#biz_presell_order_delivery", function(e, pageId, $page) {
    function openSelect(open_btn,open_item) {
        $('.delivery-hd').on('click', open_btn, function() {
            $(".delivery-mask").addClass('active');
            $(open_item).addClass('active');
        });
        $(".delivery-mask").on('click', function() {
            $(this).removeClass('active');
            $(open_item).removeClass('active');
        });
    }
    function closeSelect(close_item) {
        $(".delivery-mask").removeClass('active');
        $(close_item).removeClass('active');
    }
    //选择发货门店
    openSelect('.j-shop-select','.shop-select');
    $(".shop-list").on('click', 'li', function() {
        $(".shop-list li").removeClass('active');
        $(this).addClass('active');
    });
    $(".shop-cancle").on('click', function() {
        closeSelect('.shop-select');
    });
    $(".shop-confirm").on('click', function() {
        closeSelect('.shop-select');
        $(".delivery-hd .shop-name").html($(".shop-select .active .shop-name").html());
        $(".delivery-hd input[name='location_id']").val($(".shop-select .active .shop-name").attr("data-id"));
    });
    //选择配送方式
    openSelect('.j-logistics-select','.logistics-select');
    $(".logistics-list").on('click', 'li', function() {
        $(".logistics-list li").removeClass('active');
        $(this).addClass('active');
    });
    $(".logistics-cancle").on('click', function() {
        closeSelect('.logistics-select');
    });
    $(".logistics-confirm").on('click', function() {
        closeSelect('.logistics-select');
        var express_id=$(".logistics-select .active .logistics-name").attr("data-id");
        $(".delivery-hd .logistics-name").html($(".logistics-select .active .logistics-name").html());
        $(".delivery-hd input[name='express_id']").val(express_id);
        if(express_id == 0){
            $(".delivery-hd .j-logistics-code").css("display",'none');
            $(".delivery-hd .j-remark").css("display",'none');
            $(".user-delivery-info").hide();

            $(".delivery-hd input[name='is_delivery']").val(0);

            $(".write-logistics-code input[name='delivery_sn']").attr("disabled","disabled");
            $(".write-remark input[name='memo']").attr("disabled","disabled");
            $(".j-goods-item[is-delivery='1']").removeClass("active").addClass("disable");
            $(".j-goods-item[is-delivery='0']").removeClass("disable");
            $(".j-goods-item[is-delivery='0'] input[type='checkbox']").removeAttr("disabled");
            $(".j-goods-item[is-delivery='1'] input[type='checkbox']").prop('checked',false).attr("disabled","disabled");
            all_check();
        }else{
            $(".delivery-hd .j-logistics-code").css("display",'flex');
            $(".delivery-hd .j-remark").css("display",'flex');
            $(".user-delivery-info").show();

            $(".delivery-hd input[name='is_delivery']").val(1);

            $(".write-logistics-code input[name='delivery_sn']").removeAttr("disabled");
            $(".write-remark input[name='memo']").removeAttr("memo");
            $(".j-goods-item[is-delivery='0']").removeClass("active").addClass("disable");
            $(".j-goods-item[is-delivery='1']").removeClass("disable");
            $(".j-goods-item[is-delivery='1'] input[type='checkbox']").removeAttr("disabled");
            $(".j-goods-item[is-delivery='0'] input[type='checkbox']").prop('checked',false).attr("disabled","disabled");
            all_check();
        }
    });
    //输入单号
    openSelect('.j-logistics-code','.write-logistics-code');
    $(".shop-list").on('click', 'li', function() {
        $(".shop-list li").removeClass('active');
        $(this).addClass('active');
    });
    $(".j-logistics-code").on('click', function() {
        $(".write-logistics-code .logistics-code").attr('placeholder',$(this).find('.logistics-code').html());
        /* Act on the event */
    });
    $(".logistics-code-cancle").on('click', function() {
        closeSelect('.write-logistics-code');
    });
    $(".logistics-code-confirm").on('click', function() {
        closeSelect('.write-logistics-code');
        $(".delivery-hd .logistics-code").html($(".write-logistics-code .logistics-code").val())
    });
    //输入备注
    openSelect('.j-remark','.write-remark');
    $(".shop-list").on('click', 'li', function() {
        $(".shop-list li").removeClass('active');
        $(this).addClass('active');
    });
    $(".j-remark").on('click', function() {
        $(".write-remark .remark").attr('value',$(this).find('.remark').html());
        /* Act on the event */
    });
    $(".remark-cancle").on('click', function() {
        closeSelect('.write-remark');
    });
    $(".remark-confirm").on('click', function() {
        closeSelect('.write-remark');
        if (document.getElementById('remark').value=='') {
            $(".delivery-hd .remark").html('请输入发货备注')
        } else {
            $(".delivery-hd .remark").html($(".write-remark .remark").val())
        }
    });
    //选择商品
    $(".j-goods-item").click(function() {
        if(!$(this).hasClass("disable")){
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(this).find('input').prop("checked",false);
            } else {
                $(this).addClass('active');
                $(this).find('input').prop("checked",true);
            }
            all_check();
        }
    });
    function all_check() {
        var goods_num = $(".j-goods-item").length;
        var not_num = $(".disable").length;
        goods_num=goods_num-not_num;
        var check_num = $(".delivery-goods-list .active").length;
        $(".delivery-count").html(check_num);
        if (goods_num==check_num) {
            $('.j-all-goods').addClass('active');
        } else {
            $('.j-all-goods').removeClass('active');
        }
    }
    $(".delivery-nav").on('click', '.j-all-goods', function() {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $(".j-goods-item").removeClass('active');
            $(".j-goods-item").find('input').prop("checked",false);
        } else {
            $(this).addClass('active');
            $(".j-goods-item").addClass('active');
            $(".disable").removeClass('active');
            $(".j-goods-item.active").find('input').prop("checked",true);
        }
        var check_num = $(".delivery-goods-list .active").length;
        $(".delivery-count").html(check_num);
    });

    $("form[name='do_delivery']").bind("submit",function(){

        var is_delivery=$("input[name='is_delivery']").val();
        if(is_delivery==1){
            var delivery_sn=$("input[name='delivery_sn']").val();
            var express_id=$("input[name='express_id']").val();
            if($.trim(delivery_sn)==""){
                $.toast("请填写快递单号");
                return false;
            }
            if(express_id==0){
                $.toast("请选择快递");
                return false;
            }
        }

        var deal_num=$("input[type='checkbox']:checked").length;
        if(deal_num==0){
            $.toast("请选择发货商品");
            return false;
        }

        var ajax_url = $("form[name='do_delivery']").attr("action");
        var query = $("form[name='do_delivery']").serialize();
        $.ajax({
            url:ajax_url,
            data:query,
            dataType:"json",
            type:"POST",
            success:function(obj){
                //console.log(obj);
                if(obj.status==1){
                    $.toast("发货成功");
                    $(".logistics-code").val('');
                    $("#remark").val('');
                    $(".j-goods-item").find('input').attr("checked",false);
                    if(obj.jump){
                        setTimeout(function(){
                            location.href = obj.jump;
                        },1500);
                    }
                }else if(obj.status==0){
                    if(obj.info)
                    {
                        $.toast(obj.info);
                        if(obj.jump){
                            setTimeout(function(){
                                location.href = obj.jump;
                            },1500);
                        }
                    }
                    else
                    {
                        if(obj.jump)location.href = obj.jump;
                    }

                }
            }
        });
        return false;
    });
    var autoTextarea = function (elem, extra, maxHeight) {
        extra = extra || 0;
        var isFirefox = !!document.getBoxObjectFor || 'mozInnerScreenX' in window,
            isOpera = !!window.opera && !!window.opera.toString().indexOf('Opera'),
            addEvent = function (type, callback) {
                elem.addEventListener ?
                    elem.addEventListener(type, callback, false) :
                    elem.attachEvent('on' + type, callback);
            },
            getStyle = elem.currentStyle ? function (name) {
                var val = elem.currentStyle[name];

                if (name === 'height' && val.search(/px/i) !== 1) {
                    var rect = elem.getBoundingClientRect();
                    return rect.bottom - rect.top -
                        parseFloat(getStyle('paddingTop')) -
                        parseFloat(getStyle('paddingBottom')) + 'px';
                };

                return val;
            } : function (name) {
                return getComputedStyle(elem, null)[name];
            },
            minHeight = parseFloat(getStyle('height'));

        elem.style.resize = 'none';

        var change = function () {
            var scrollTop, height,
                padding = 0,
                style = elem.style;

            if (elem._length === elem.value.length) return;
            elem._length = elem.value.length;

            if (!isFirefox && !isOpera) {
                padding = parseInt(getStyle('paddingTop')) + parseInt(getStyle('paddingBottom'));
            };
            scrollTop = document.body.scrollTop || document.documentElement.scrollTop;

            elem.style.height = minHeight + 'px';
            if (elem.scrollHeight > minHeight) {
                if (maxHeight && elem.scrollHeight > maxHeight) {
                    height = maxHeight - padding;
                    style.overflowY = 'auto';
                } else {
                    height = elem.scrollHeight - padding;
                    style.overflowY = 'hidden';
                };
                style.height = height + extra + 'px';
                scrollTop += parseInt(style.height) - elem.currHeight;
                document.body.scrollTop = scrollTop;
                document.documentElement.scrollTop = scrollTop;
                elem.currHeight = parseInt(style.height);
            };
        };

        addEvent('propertychange', change);
        addEvent('input', change);
        addEvent('focus', change);
        change();
    };
    var text = document.getElementById("remark");
    autoTextarea(text);
});
$(document).on("pageInit", "#biz_presell_order_logistics", function(e, pageId, $page) {

    if($(".buttons-tab .tab-link").length>0){
        var _width=$(".buttons-tab .tab-link.active").find("span").width();
        var _left=$(".buttons-tab .tab-link.active").find("span").offset().left;

        var btm_line=$(".buttons-tab .bottom_line");
        btm_line.css({"width":_width+"px","left":_left+"px"});

        var _tabs=$(".tabBox .tab_box");
    }
    $(".buttons-tab .tab-link").click(function () {
        var _wid=$(this).find("span").width();
        var _lef=$(this).find("span").offset().left;

        btm_line.css({"width":_wid+"px","left":_lef+"px"});
        var _index=$(this).index();

        $(this).addClass("active").siblings(".tab-link").removeClass("active");
        _tabs.eq(_index).addClass("active").siblings(".tab_box").removeClass("active");

    });

    $(".no_delivery_deal").click(function(){
        if($("input[type='checkbox']").length==$("input[disabled='disabled']").length){
            $("#uc_logistic nav.bar-tab").hide();
        }else{
            $("#uc_logistic nav.bar-tab").show();
        }
    });

});

/**
 * Created by Administrator on 2016/11/28.
 */
$(document).on("pageInit", "#biz_qrcode", function(e, pageId, $page) {	


    /*提交订单选择配送方式点击事件*/
    var _hei=$(".j-trans-way").height();
    var _rehei=$(".j-red-reward").height();
    $(".popup-box .j-trans-way").css({"bottom":-_hei});
    $(".popup-box .j-red-reward").css({"bottom":-_rehei});
    var _bhei=$(".pup-box-bg").height();


    $(document).on('click',".j-cancel",function () {
        popupTransition();
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },300);
    });


    $(document).on('click',".j-trans",function () {
    	var index = $(".j-trans").index($(this));
        $(".totop").addClass("vible");
        $(".popup-box .j-red-reward").css({"bottom":-_rehei});
        $(".popup-box").css({"transition":"all 0.3s linear","opacity":"1","z-index":"9999"});
        $(".popup-box .j-trans-way").eq(index).css({"transition":"bottom 0.3s linear","bottom":"0"});
        $(".popup-box .pup-box-bg").css({"transition":"opacity 0.3s linear","opacity":"0.6"});
    });
    $(document).on('click',".j-reward",function () {
        $(".totop").addClass("vible");
        $(".popup-box .j-trans-way").css({"bottom":-_hei});
        $(".popup-box").css({"transition":"all 0.3s linear","opacity":"1","z-index":"9999"});
        $(".popup-box .j-red-reward").css({"transition":"bottom 0.3s linear","bottom":"0"});
        $(".popup-box .pup-box-bg").css({"transition":"opacity 0.3s linear","opacity":"0.6"});
    });


    /*弹出层动画效果*/
    function popupTransition() {
        /* $(".j-cancel").parents(".m-trans-way").css({"transition":"bottom 0.3s linear","bottom":-_hei});*/
        $(".popup-box .j-trans-way").css({"transition":"bottom 0.3s linear","bottom":-_hei});
        $(".popup-box .j-red-reward").css({"transition":"bottom 0.3s linear","bottom":-_rehei});
        $(".j-cancel").parents(".popup-box").find(".pup-box-bg").css({"transition":"opacity 0.3s linear","opacity":"0"});
        $(".j-cancel").parents(".popup-box").css({"transition":"all 0.3s linear 0.3s","opacity":"0","z-index":"100"});
		setTimeout(function () {
                $(".j-cancel").parents(".popup-box").css({"z-index":"-1"});
            },300);
    }
    /*弹出层动画效果*/

    $(document).on('click',".j-trans-list li,.j-reward-list li",function () {
        var lue_name=$(this).find(".pay-way-name .j-company-name").text();
        var lue_momey=$(this).find(".pay-way-name .j-company-money").text();
        var lue_reward=$(this).find(".pay-way-name").text();
		var qrcode=$(this).find(".pay-way-name").attr("qrcode");
		var qrcode_urls=$(this).find(".pay-way-name").attr("qrcode_urls");

        $(this).parents("ul").find("input").prop("checked",false);
		
		$(this).find("input[name='location_id']").prop("checked",true);
        $(".j-reward .j-reward-money").text(lue_reward);
		$(".qrcode img").attr("src",qrcode);
		$(".biz_qrcode_save").attr("href",qrcode_urls);
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },500);
        popupTransition();
        //count_buy_total();
    });




    /*弹层开始*/
    $(".choose-list .j-choose").click(function(){
        $(this).siblings(".j-choose").removeClass("active");
        $(this).addClass("active");
        setSpecgood();
        var data_value= $(".j-choose.active").attr("data-value");
        var data_value = []; // 定义一个空数组
        var txt = $('.j-choose.active'); // 获取所有文本框
        for (var i = 0; i < txt.length; i++) {
            data_value.push(txt.eq(i).attr("data-value")); // 将文本框的值添加到数组中
        }
        $(".good-specifications span").empty();
        $(".good-specifications span").addClass("isChoose");
        $(".good-specifications span").append("已选规格：");
        $.each(data_value,function(i){
            $(".good-specifications span").append("<em class='tochooseda'>" + data_value[i] + "</em>");
            //传值可以考虑更改这里
            $(".spec-data").attr("data-value"+[i],data_value[i]);
        });
    });


    $(document).on('click',".j-box-bg",function () {
        popupTransition();
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },300);
    });

    function cssAnition() {
        $(".flippedout").removeClass("z-open");
        $(".spec-choose").removeClass("z-open");
        $(".j-flippedout-close").removeClass("showflipped");
        $(".j-open-choose").bind("click",open_choose);
        setTimeout("$('.flippedout').removeClass('showflipped')",300);
    }
	$(".biz_qrcode_save").unbind('click').bind('click',function () {
		if(app_index=='app'){
			try{
				App.savePhotoToLocal (this.href);
			}
			catch(ex)
			{
				$.toast("此app版本不支持下载图片");
			}
			
			return false;
		}
    });
});
$(document).on("pageInit", "#biz_refund_order_view", function(e, pageId, $page) {
	$(".refund-btn").on('click', '.j-refund-agree', function() {
		$.confirm('是否立即退款', function () {
			$.ajax({
				url: $('.j-refund-agree').attr("data-href"),
				data: {},
				dataType: "json",
				type: "post",
				success: function(obj){
					console.log(obj);
					if(obj.biz_login_status==0){
						$.router.load(obj.jump,true);
					}else{
						if(obj.status){
							$.toast(obj.info);
							$.loadPage(window.location.href );
						}else{
							$.toast(obj.info);
						}
					}
				},
        	});
		});
	});
	$(".refund-btn").on('click', '.j-refund-refuse', function() {
		$.confirm('是否拒绝退款', function () {
			$.ajax({
				url: $('.j-refund-refuse').attr("data-href"),
				data: {},
				dataType: "json",
				type: "post",
				success: function(obj){
					if(obj.biz_login_status==0){
						$.router.load(obj.jump,true);
					}else{
						if(obj.status){
							$.toast(obj.info);
							$.loadPage(window.location.href );
						}else{
							$.toast(obj.info);
						}
					}
				},
        	});
		});
	});
});
$(document).on("pageInit", "#biz_shop_order", function(e, pageId, $page) {
	init_listscroll(".j-ajaxlist-0",".j-ajaxadd-0");
	init_listscroll(".j-ajaxlist-1",".j-ajaxadd-1");
	init_listscroll(".j-ajaxlist-2",".j-ajaxadd-2");
	function tab_line() {
		var init_width=$(".biz-shop-order-tab .active span").width();
		var init_left=$(".j-tab-item.active span").offset().left;
		$(".tab-line").css({
			width: init_width,
			left: init_left
		});
	}
	tab_line();
	$(".biz-shop-order-tab").on('click', '.j-tab-item', function(event) {
		var type=$(this).attr("type");
		
		if($(".content").find(".j-ajaxadd-"+type).length > 0){

			$(".biz-shop-order-tab .j-tab-item").removeClass('active');
			$(this).addClass('active').siblings().removeClass('active');
			
			$(".content .m-biz-shop-order-list").removeClass('active');
			$(".content").find(".j-ajaxlist-"+type).addClass('active').siblings().removeClass('active');
			tab_line();
			init_listscroll(".j-ajaxlist-"+type,".j-ajaxadd-"+type);
		}else{
		

			$(document).off('infinite', '.infinite-scroll-bottom');
			$(".j-tab-item").removeClass('active');
			$(this).addClass('active');
			var item_width=$(this).find('span').width();
			var item_left=$(this).find('span').offset().left;
			$(".tab-line").css({
				width: item_width,
				left: item_left
			});
			var url=$(this).attr("data-href");
			
			$.ajax({
				url:url,
				type:"POST",
				success:function(html)
				{
					
					$(".j-ajaxlist-"+type).addClass('active').html($(html).find(".j-ajaxlist-"+type).html()).siblings().removeClass('active');
			
					if ($(html).find(".j-ajaxadd-"+type).length==0) {
						return;
					}else{
						init_listscroll(".j-ajaxlist-"+type,".j-ajaxadd-"+type);
					};
				},
				error:function()
				{
					$.toast("加载失败咯~");
				}
			});
			$.showIndicator();
			setTimeout(function () {
				$.hideIndicator();
			}, 800);
		}
	});
	var swiperm = new Swiper(".j-order-shop-img", {
	    scrollbarHide: true,
	    slidesPerView: 'auto',
	    freeMode: false,
	});
});
$(document).on("pageInit", "#biz_shop_order_delivery", function(e, pageId, $page) {
	function openSelect(open_btn,open_item) {
		$('.delivery-hd').on('click', open_btn, function() {
			$(".delivery-mask").addClass('active');
			$(open_item).addClass('active');
		});
		$(".delivery-mask").on('click', function() {
			$(this).removeClass('active');
			$(open_item).removeClass('active');
		});
	}
	function closeSelect(close_item) {
		$(".delivery-mask").removeClass('active');
		$(close_item).removeClass('active');
	}
	//选择发货门店
	openSelect('.j-shop-select','.shop-select');
	$(".shop-list").on('click', 'li', function() {
		$(".shop-list li").removeClass('active');
		$(this).addClass('active');
	});
	$(".shop-cancle").on('click', function() {
		closeSelect('.shop-select');
	});
	$(".shop-confirm").on('click', function() {
		closeSelect('.shop-select');
		$(".delivery-hd .shop-name").html($(".shop-select .active .shop-name").html());
		$(".delivery-hd input[name='location_id']").val($(".shop-select .active .shop-name").attr("data-id"));
	});
	//选择配送方式
	openSelect('.j-logistics-select','.logistics-select');
	$(".logistics-list").on('click', 'li', function() {
		$(".logistics-list li").removeClass('active');
		$(this).addClass('active');
	});
	$(".logistics-cancle").on('click', function() {
		closeSelect('.logistics-select');
	});
	$(".logistics-confirm").on('click', function() {
		closeSelect('.logistics-select');
		var express_id=$(".logistics-select .active .logistics-name").attr("data-id");
		$(".delivery-hd .logistics-name").html($(".logistics-select .active .logistics-name").html());
		$(".delivery-hd input[name='express_id']").val(express_id);
		if(express_id == 0){
			$(".delivery-hd .j-logistics-code").css("display",'none');
			$(".delivery-hd .j-remark").css("display",'none');
			$(".user-delivery-info").hide();

			$(".delivery-hd input[name='is_delivery']").val(0);

			$(".write-logistics-code input[name='delivery_sn']").attr("disabled","disabled");
			$(".write-remark input[name='memo']").attr("disabled","disabled");
			$(".j-goods-item[is-delivery='1']").removeClass("active").addClass("disable");
			$(".j-goods-item[is-delivery='0']").removeClass("disable");
			$(".j-goods-item[is-delivery='0'] input[type='checkbox']").removeAttr("disabled");
			$(".j-goods-item[is-delivery='1'] input[type='checkbox']").prop('checked',false).attr("disabled","disabled");
			all_check();
		}else{
			$(".delivery-hd .j-logistics-code").css("display",'flex');
			$(".delivery-hd .j-remark").css("display",'flex');
			$(".user-delivery-info").show();

			$(".delivery-hd input[name='is_delivery']").val(1);

			$(".write-logistics-code input[name='delivery_sn']").removeAttr("disabled");
			$(".write-remark input[name='memo']").removeAttr("memo");
			$(".j-goods-item[is-delivery='0']").removeClass("active").addClass("disable");
			$(".j-goods-item[is-delivery='1']").removeClass("disable");
			$(".j-goods-item[is-delivery='1'] input[type='checkbox']").removeAttr("disabled");
			$(".j-goods-item[is-delivery='0'] input[type='checkbox']").prop('checked',false).attr("disabled","disabled");
			all_check();
		}
	});
	//输入单号
	openSelect('.j-logistics-code','.write-logistics-code');
	$(".shop-list").on('click', 'li', function() {
		$(".shop-list li").removeClass('active');
		$(this).addClass('active');
	});
	$(".j-logistics-code").on('click', function() {
		$(".write-logistics-code .logistics-code").attr('placeholder',$(this).find('.logistics-code').html());
		/* Act on the event */
	});
	$(".logistics-code-cancle").on('click', function() {
		closeSelect('.write-logistics-code');
	});
	$(".logistics-code-confirm").on('click', function() {
		closeSelect('.write-logistics-code');
		$(".delivery-hd .logistics-code").html($(".write-logistics-code .logistics-code").val())
	});
	//输入备注
	openSelect('.j-remark','.write-remark');
	$(".shop-list").on('click', 'li', function() {
		$(".shop-list li").removeClass('active');
		$(this).addClass('active');
	});
	$(".j-remark").on('click', function() {
		$(".write-remark .remark").attr('value',$(this).find('.remark').html());
		/* Act on the event */
	});
	$(".remark-cancle").on('click', function() {
		closeSelect('.write-remark');
	});
	$(".remark-confirm").on('click', function() {
		closeSelect('.write-remark');
		if (document.getElementById('remark').value=='') {
			$(".delivery-hd .remark").html('请输入发货备注')
		} else {
			$(".delivery-hd .remark").html($(".write-remark .remark").val())
		}
	});
	//选择商品
	$(".j-goods-item").click(function() {
		if(!$(this).hasClass("disable")){
			if ($(this).hasClass('active')) {
				$(this).removeClass('active');
				$(this).find('input').prop("checked",false);
			} else {
				$(this).addClass('active');
				$(this).find('input').prop("checked",true);
			}
			all_check();
		}
	});
	function all_check() {
		var goods_num = $(".j-goods-item").length;
		var not_num = $(".disable").length;
		goods_num=goods_num-not_num;
		var check_num = $(".delivery-goods-list .active").length;
		$(".delivery-count").html(check_num);
		if (goods_num==check_num) {
			$('.j-all-goods').addClass('active');
		} else {
			$('.j-all-goods').removeClass('active');
		}
	}
	$(".delivery-nav").on('click', '.j-all-goods', function() {
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
			$(".j-goods-item").removeClass('active');
			$(".j-goods-item").find('input').prop("checked",false);
		} else {
			$(this).addClass('active');
			$(".j-goods-item").addClass('active');
			$(".disable").removeClass('active');
			$(".j-goods-item.active").find('input').prop("checked",true);
		}
		var check_num = $(".delivery-goods-list .active").length;
		$(".delivery-count").html(check_num);
	});

	$("form[name='do_delivery']").bind("submit",function(){

		var is_delivery=$("input[name='is_delivery']").val();
		if(is_delivery==1){
			var delivery_sn=$("input[name='delivery_sn']").val();
			var express_id=$("input[name='express_id']").val();
			if($.trim(delivery_sn)==""){
				$.toast("请填写快递单号");
				return false;
			}
			if(express_id==0){
				$.toast("请选择快递");
				return false;
			}
		}

		var deal_num=$("input[type='checkbox']:checked").length;
		if(deal_num==0){
			$.toast("请选择发货商品");
			return false;
		}

		var ajax_url = $("form[name='do_delivery']").attr("action");
		var query = $("form[name='do_delivery']").serialize();
		$.ajax({
			url:ajax_url,
			data:query,
			dataType:"json",
			type:"POST",
			success:function(obj){
				//console.log(obj);
				if(obj.status==1){
					$.toast("发货成功");
					$(".logistics-code").val('');
					$("#remark").val('');
					$(".j-goods-item").find('input').attr("checked",false);
					if(obj.jump){
						setTimeout(function(){
							location.href = obj.jump;
						},1500);
					}
				}else if(obj.status==0){
					if(obj.info)
					{
						$.toast(obj.info);
						if(obj.jump){
							setTimeout(function(){
								location.href = obj.jump;
							},1500);
						}
					}
					else
					{
						if(obj.jump)location.href = obj.jump;
					}

				}
			}
		});
		return false;
	});
	var autoTextarea = function (elem, extra, maxHeight) {
	        extra = extra || 0;
	        var isFirefox = !!document.getBoxObjectFor || 'mozInnerScreenX' in window,
	        isOpera = !!window.opera && !!window.opera.toString().indexOf('Opera'),
	                addEvent = function (type, callback) {
	                        elem.addEventListener ?
	                                elem.addEventListener(type, callback, false) :
	                                elem.attachEvent('on' + type, callback);
	                },
	                getStyle = elem.currentStyle ? function (name) {
	                        var val = elem.currentStyle[name];

	                        if (name === 'height' && val.search(/px/i) !== 1) {
	                                var rect = elem.getBoundingClientRect();
	                                return rect.bottom - rect.top -
	                                        parseFloat(getStyle('paddingTop')) -
	                                        parseFloat(getStyle('paddingBottom')) + 'px';
	                        };

	                        return val;
	                } : function (name) {
	                                return getComputedStyle(elem, null)[name];
	                },
	                minHeight = parseFloat(getStyle('height'));

	        elem.style.resize = 'none';

	        var change = function () {
	                var scrollTop, height,
	                        padding = 0,
	                        style = elem.style;

	                if (elem._length === elem.value.length) return;
	                elem._length = elem.value.length;

	                if (!isFirefox && !isOpera) {
	                        padding = parseInt(getStyle('paddingTop')) + parseInt(getStyle('paddingBottom'));
	                };
	                scrollTop = document.body.scrollTop || document.documentElement.scrollTop;

	                elem.style.height = minHeight + 'px';
	                if (elem.scrollHeight > minHeight) {
	                        if (maxHeight && elem.scrollHeight > maxHeight) {
	                                height = maxHeight - padding;
	                                style.overflowY = 'auto';
	                        } else {
	                                height = elem.scrollHeight - padding;
	                                style.overflowY = 'hidden';
	                        };
	                        style.height = height + extra + 'px';
	                        scrollTop += parseInt(style.height) - elem.currHeight;
	                        document.body.scrollTop = scrollTop;
	                        document.documentElement.scrollTop = scrollTop;
	                        elem.currHeight = parseInt(style.height);
	                };
	        };

	        addEvent('propertychange', change);
	        addEvent('input', change);
	        addEvent('focus', change);
	        change();
	};
	var text = document.getElementById("remark");
	autoTextarea(text);
});

$(document).on("pageInit", "#biz_shop_order_logistics", function(e, pageId, $page) {

    if($(".buttons-tab .tab-link").length>0){
        var _width=$(".buttons-tab .tab-link.active").find("span").width();
        var _left=$(".buttons-tab .tab-link.active").find("span").offset().left;

        var btm_line=$(".buttons-tab .bottom_line");
        btm_line.css({"width":_width+"px","left":_left+"px"});

        var _tabs=$(".tabBox .tab_box");
    }
    $(".buttons-tab .tab-link").click(function () {
        var _wid=$(this).find("span").width();
        var _lef=$(this).find("span").offset().left;

        btm_line.css({"width":_wid+"px","left":_lef+"px"});
        var _index=$(this).index();

        $(this).addClass("active").siblings(".tab-link").removeClass("active");
        _tabs.eq(_index).addClass("active").siblings(".tab_box").removeClass("active");
//        init_confirm_button();

    });

//    if($(".no_delivery").hasClass("active") &&
//        $("input[type='checkbox']").length==$("input[disabled='disabled']").length
//        ){
//        $("#uc_logistic nav.bar-tab").hide();
//    }else{
//        init_confirm_button();
//    }

    $(".no_delivery_deal").click(function(){
        if($("input[type='checkbox']").length==$("input[disabled='disabled']").length){
            $("#uc_logistic nav.bar-tab").hide();
        }else{
            $("#uc_logistic nav.bar-tab").show();
        }
    });

//    $(document).on("click",".confirm_order",function(){
//        var data_id = $(".tabBox .tab_box.active").attr("data_id");
//        var query = new Object();
//        if(data_id){
//            query.item_id = data_id;
//            query.act = 'verify_delivery';
//        }else{
//            var order_ids=new Array();
//            $(".tabBox .tab_box.active").find("input[name='my-radio']:checked").each(function(){
//                order_ids.push($(this).attr("data_id"));
//            });
//            query.order_ids=JSON.stringify(order_ids);
//            query.act = 'verify_no_delivery';
//        }
//        $.ajax({
//            url: order_url,
//            data: query,
//            dataType: "json",
//            type: "POST",
//            success: function(obj){
//                if(obj.status==0){
//
//                    $.toast(obj.info);
//                }
//                if(obj.status == 1){
//                    $.toast(obj.info)
//                    window.setTimeout(function(){
//                        $("#uc_logistic .tabBox .tab_box.active").attr("is_arrival",1);
//                        init_confirm_button();
//                        window.location.href=obj.jump;
//                    },1500);
//                }
//            },
//            error:function(ajaxobj)
//            {
//
////						if(ajaxobj.responseText!='')
////						alert(ajaxobj.responseText);
//            }
//
//        });
//    });
});

//function init_confirm_button(){
//    var status = $("#uc_logistic .tabBox .tab_box.active").attr("status");
//    if(status==1){
//        $("#uc_logistic nav.bar-tab").hide();
//    }else{
//        $("#uc_logistic nav.bar-tab").show();
//    }
//}
$(document).on("pageInit", "#biz_shop_verify", function(e, pageId, $page) {
	$(".biz-link-bar").on('click', '.j-qrcode', function() {
		if(app_index == 'wap'){
			$.toast("手机浏览器暂不支持，请下载APP");
		}
	});
	$(".biz-manager-bar").on('click', '.j-unopen', function() {
		$.toast("暂未开放");
	});
	$(".biz-manager-bar").on('click', '.store_pay_unopen', function() {
		$.toast("没有操作权限");
	});
	$(".to-qrcode").on('click', function() {
		if(is_store_payment==1){
			if(open_store_payment_count>0){
				
			}else{
				$.toast("不存在支持到店买单的门店");
				return false;
			}
		}else{
			$.toast("该商户不支持到店买单");
			return false;
		}
	});


/* 消费券验证 */
	var pre_coupon_pwd="";
	$("input[name='qr_code']").keyup(function(){
		var coupon_pwd = $(this).val();
		var code_len = coupon_pwd.length;
		var code_rule = /^[0-9]{12}$/;

		if(pre_coupon_pwd == coupon_pwd){

		}else{
			pre_coupon_pwd = coupon_pwd;
			if(code_len == 12){
				if(!code_rule.test(coupon_pwd)){
					$.toast('您输入的券码无效');
				}
				else{
					$.post(index_check_url, { "coupon_pwd": coupon_pwd },function(data){
						if (data.status){
							$(".code-input").val("");
							location.href = data.jump+'&coupon_pwd='+coupon_pwd;
						}else{
							$.toast(data.info);
						}
					}, "json");
				}
			}else if (code_len > 12){
				$.toast('您输入的券码无效');
			}
		}
	});


});



$(document).on("pageInit", "#biz_shop_view", function(e, pageId, $page) {
	$(".shop-invoice-bar").click(function(){
		$(this).toggleClass("active");
	});

});



$(document).on("pageInit", "#biz_store_pay_order", function(e, pageId, $page) {
	function stopPropagation(e) {
			if (e.stopPropagation)
				e.stopPropagation();
			else
				e.cancelBubble = true;
		}
	$(document).bind('click', function() {
		$(".m-month-list").removeClass('active');
	});
	$(document).on('click','.j-month-select',function(e) {
		stopPropagation(e);
		$(".m-month-list").addClass('active');
	});


	$(".j-month").unbind();
	$(".j-month").bind('click', function() {
	//$(document).on('click', '.j-month', function() {
		$.showIndicator();
		$.loadPage($(this).attr("data-href"));
		$.showIndicator();
		setTimeout(function () {
			$.hideIndicator();
		}, 800);
		/*$(".m-month-list").removeClass('active');
		var url=$(this).attr("data-href");
		$.ajax({
			url:url,
			type:"POST",
			success:function(html)
			{
				$(".j-ajaxlist").html($(html).find(".j-ajaxlist").html());
				if ($(html).find(".j-ajaxlist").html()==null) {
					return;
				}else{
					init_list_scroll_bottom();
				};
			},
			error:function()
			{
				$.toast("加载失败咯~");
			}
		});
		$.showIndicator();
		setTimeout(function () {
			$.hideIndicator();
		}, 800);*/
	});
});
$(document).on("pageInit", "#biz_tuan_order", function(e, pageId, $page) {
	init_list_scroll_bottom();
	var swiperm = new Swiper(".j-order-shop-img", {
	    scrollbarHide: true,
	    slidesPerView: 'auto',
	    freeMode: false,
	});
});
$(document).on("pageInit", "#biz_tuan_view", function(e, pageId, $page) {
	$(".shop-invoice-bar").click(function(){
		$(this).toggleClass("active");
	});

});



$(document).on("pageInit", "#biz_user_login", function(e, pageId, $page) {
	clear_input($('#account_name'),$('.j-name-clear'));
	clear_input($('#account_password'),$(".j-password-clear"));
	$("#login-btn").bind("click",function(){
		var account_name = $.trim($("input[name='account_name']").val());
		var account_password = $.trim($("input[name='account_password']").val());
		var form = $("form[name='user_login_form']");
		if(!account_name){
			$.toast("请填写账户名称");
			return false;
		}
		if(!account_password){
			$.toast("请输入密码");
			return false;
		}

		var query = $(form).serialize();
		var ajaxurl = $(form).attr("action");
		$.ajax({
			url:ajaxurl,
			data:query,
			type:"post",
			dataType:"json",
			success:function(data){
				if(data["status"]==1){
					$.toast(data.info);
					window.setTimeout(function(){
						location.href = data.jump;
					},1500);
				}else{
					$.toast(data.info);
					return false;
				}
			}
			,error:function(){
				$.toast("服务器提交错误");
				return false;
			}
		});
		return false;
	});
});
$(document).on("pageInit", "#biz_vs_order", function(e, pageId, $page) {
	init_listscroll(".j-ajaxlist-0",".j-ajaxadd-0");
	init_listscroll(".j-ajaxlist-1",".j-ajaxadd-1");
	init_listscroll(".j-ajaxlist-2",".j-ajaxadd-2");
	function tab_line() {
		var init_width=$(".biz-shop-order-tab .active span").width();
		var init_left=$(".j-tab-item.active span").offset().left;
		$(".tab-line").css({
			width: init_width,
			left: init_left
		});
	}
	tab_line();
	$(".biz-shop-order-tab").on('click', '.j-tab-item', function(event) {
		var type=$(this).attr("type");
		
		if($(".content").find(".j-ajaxadd-"+type).length > 0){

			$(".biz-shop-order-tab .j-tab-item").removeClass('active');
			$(this).addClass('active').siblings().removeClass('active');
			
			$(".content .m-biz-shop-order-list").removeClass('active');
			$(".content").find(".j-ajaxlist-"+type).addClass('active').siblings().removeClass('active');
			tab_line();
			init_listscroll(".j-ajaxlist-"+type,".j-ajaxadd-"+type);
		}else{
		

			$(document).off('infinite', '.infinite-scroll-bottom');
			$(".j-tab-item").removeClass('active');
			$(this).addClass('active');
			var item_width=$(this).find('span').width();
			var item_left=$(this).find('span').offset().left;
			$(".tab-line").css({
				width: item_width,
				left: item_left
			});
			var url=$(this).attr("data-href");
			
			$.ajax({
				url:url,
				type:"POST",
				success:function(html)
				{
					
					$(".j-ajaxlist-"+type).addClass('active').html($(html).find(".j-ajaxlist-"+type).html()).siblings().removeClass('active');
			
					if ($(html).find(".j-ajaxadd-"+type).length==0) {
						return;
					}else{
						init_listscroll(".j-ajaxlist-"+type,".j-ajaxadd-"+type);
					};
				},
				error:function()
				{
					$.toast("加载失败咯~");
				}
			});
			$.showIndicator();
			setTimeout(function () {
				$.hideIndicator();
			}, 800);
		}
	});
	var swiperm = new Swiper(".j-order-shop-img", {
	    scrollbarHide: true,
	    slidesPerView: 'auto',
	    freeMode: false,
	});
});
$(document).on("pageInit", "#biz_vs_order_view", function(e, pageId, $page) {
    var t1= parseInt($(".j-data-time").attr('data-time'));
    
    var leftGRObj = setInterval(GetRTime,1000);
    function GetRTime(){
      var t= $(".j-data-time").attr('data-time');
      var is_load = $(".j-data-time").attr('is_load');
      if(is_load==1){
          var d=0;
          var h=0;
          var m=0;
          var s=0;

            d=Math.floor(t/60/60/24);
            h=Math.floor(t/60/60%24);
            m=Math.floor(t/60%60);
            s=Math.floor(t%60);
            if (d>0) {
                $(".j-data-time .j-time").html(d + "天" + h +"小时" + m +"分钟" + s +"秒");
            } else {
                $(".j-data-time .j-time").html(h +"小时" + m +"分钟" + s +"秒");
            }
            if (h<1) {
                $(".j-data-time .j-time").html(m +"分钟" + s +"秒");
            }
            
            if (m<1) {
                $(".j-data-time .j-time").html(s +"秒");
            }

            if(t==0){

                $(".j-data-time .j-time").html("0秒");
                $(".pay_btn").addClass('no_pay_btn').removeClass('pay_btn').attr('error_tip','支付超时').attr('href','javascript:void(0)');     
                clearInterval(leftGRObj);
                $.loadPage(location.href);
                
            }
            t = t -1;
            $(".j-data-time").attr('data-time',t);
      }else{
          $(".j-data-time .j-time").html("0秒");
          clearInterval(leftGRObj);
      }
  
    }
    //打开送货时间选择
    $(".j-open-time").on('click', function() {
        $(".dc-mask").addClass('active');
        $(".time-select").addClass('active');
        var send_time=$(this).find('input').attr('value');
        $(".j-time-choose").each(function() {
            if ($(this).attr('value')==send_time) {
                $(this).addClass('active');
            }
        });
    });
    //关闭送货时间选择
    $(".j-close-time").on('click', function() {
        $(".dc-mask").removeClass('active');
        $(".time-select").removeClass('active');
    });
    //选择日期
    $(".j-day-item").on('click', function() {
        $(".j-day-item").removeClass('active');
        $(this).addClass('active');
        $(".time-select .select-time").removeClass("vs-show");
        $(".time-select .select-time").eq($(this).index()).addClass("vs-show");
    });
    //选择时间
    $(".j-time-choose").on('click', function() {
        $(".j-time-choose").removeClass('active');
        $(this).addClass('active');
        $(".j-send-day").html($(".j-day-item").eq($(this).parent().index()).find('p').html());
        $(".j-send-time").html($(this).find('p').html());
        $("#time-value").attr('value', $(this).attr('value'));
    });
    
    // 关闭弹层
    $(document).off('click', '.j-close-select');
    $(document).on('click', '.j-close-select', function() {
        $(".m-select-box").removeClass('active');
        $(".m-mask").removeClass('active');
    });
    // 工作日志文本框
    var _close=false;
    $(document).on('click',".j-work-log",function () {
        if($(".workArea textarea").val()){
           $(".workTitle-fill").html($(".workArea textarea").val());
        }
        if(_close==false){
            $('.workArea').show();
            return _close=true;
        }
        if(_close==true){
            $('.workArea').hide();
            return _close=false;
        }
    });

    $('#biz_vs_order_view .workBox .workArea textarea').on('input propertychange', function() {
        var that = $(this),
            _val = that.val();
        if (_val.length > 100) {
            that.val(_val.substring(0, 100));
        }
    });
});
$(document).on("pageInit", "#biz_vs_pay_items", function(e, pageId, $page) {
    //扫码弱提示
    $('.j-qrcode').on('click', function() {
        $.toast('请下载APP使用扫码功能')
    });
    select_box($(".j-vspay-popup"),$(".setting-box"));
    //
    price_count();
    function price_count() {
        var sum = 0;
        $(".vs_pay.active .u-txt").each(function() {
            sum += parseFloat($(this).parents().find(".u-txt").val() * $(this).parents().find(".vs-price").val());
        });
        sum = sum.toFixed(2);
        $('.price_all em').text(sum);
    }

    //切换
    $(".j-tab-link").on('click', function() {

        var $me = $(this);
        var rel = parseInt($(this).attr("rel"));
        $(".j-tab-link").removeClass("active");
        $me.addClass('active');
        var _index = $me.index();
        $('.vs_pay').removeClass('active');
        $('.vs_pay').eq(_index).addClass('active');
        $('.select-btn').addClass('hide');
        $('.select-btn').eq(_index).removeClass('hide');
        if ($me.hasClass("active")) {
            var ac_left = $(".j-tab-link.active").offset().left;
            $('.buttons-tab .tab-line').css("left", ac_left);
        }
        price_count();
    });
    var ac_left = $(".j-tab-link.active").offset().left;
    var ac_width = $(".j-tab-link.active").width();
    $('.buttons-tab .tab-line').css({ "left": ac_left, "width": ac_width });




    /*输入框加减按钮*/
    $(".j-add").click(function() {
        var val = parseInt($(this).parent().find(".u-txt").val());
        var id = parseInt($(this).parent().find(".u-txt").attr("deal-id"));
        var max = parseInt($(this).parent().find(".u-txt").attr("max"));
        var user_max = parseInt($(this).parent().find(".u-txt").attr("user_max_bought"));
        //var user_min=parseInt($(this).parent().find(".u-txt").attr("user_min_bought"));
        val++;
        var num = $(".u-txt[deal-id='" + id + "']").length;
        if (val >= max && max != -1) {
            val = max;
            $(this).addClass('u-reduce').removeClass('u-add');
        }
        if (val >= 2) {
            $(this).parent().find('.j-sub').addClass('u-add').removeClass('u-reduce');
        }
        $(this).parent().find(".u-txt").val(val);
        price_count()
    });
    $(".j-sub").click(function() {
        var val = $(this).parent().find(".u-txt").val();
        var user_min = parseInt($(this).parent().find(".u-txt").attr("user_min_bought"));
        var id = parseInt($(this).parent().find(".u-txt").attr("deal-id"));
        var num = $(".u-txt[deal-id='" + id + "']").length;
        var max = parseInt($(this).parent().find(".u-txt").attr("max"));
        val--;
        if (val == 1) {
            $(this).addClass('u-reduce').removeClass('u-add');
        }
        if (val < max) {
            $(this).parent().find('j-add').addClass('u-add').removeClass('u-reduce');
        }
        if (val < 1) {
            val = 1;
            $.confirm('确定要删除这个宝贝吗？', function() {
                var id = parseInt($(this).parents(".service-list").attr("data-id"));

                $.ajax({
                    url: '',
                    data: id,
                    type: "post",
                    dataType: "json",
                    success: function(data) {
                        $(this).parents(".service-list").remove;
                    },
                    error: function() {}
                });


            });
        }
        $(this).parent().find(".u-txt").val(val);
        price_count()
    });
});
$(document).on("pageInit", "#biz_withdrawal_bindbank", function(e, pageId, $page) {

	$("#btn").bind("click",function(){
		var phone=$("#phonenumer").val();
		if(phone==""){
			$.toast("请到PC端绑定手机");
		}
	});
	
	$("form[name='add_card']").bind("submit",function(){		
		var bank_name = $("form[name='add_card']").find("input[name='bank_name']").val();
		var bank_account = $("form[name='add_card']").find("input[name='bank_account']").val();
		var bank_user = $("form[name='add_card']").find("input[name='bank_user']").val();
		var sms_verify = $("form[name='add_card']").find("input[name='sms_verify']").val();		
		if($.trim(bank_name)=="")
		{
			$.toast("请输入开户行名称");
			return false;
		}
		if($.trim(bank_account)=="")
		{
			$.toast("请输入开户行账号");
			return false;
		}
		if($.trim(bank_user)=="")
		{
			$.toast("请输入开户人真实姓名");
			return false;
		}
		if($.trim(sms_verify)=="")
		{
			$.toast("请输入短信验证码");
			return false;
		}
		
		var ajax_url = $("form[name='add_card']").attr("action");
		var query = $("form[name='add_card']").serialize();
		$.ajax({
			url:ajax_url,
			data:query,
			dataType:"json",
			type:"POST",
			success:function(obj){
				if(obj.status==1){
					$.toast(obj.info);	
					setTimeout(function(){
						location.href = obj.jump;
					},1500);
				}else if(obj.status==0){
					if(obj.info)
					{
						$.toast(obj.info);
						if(obj.jump){
							setTimeout(function(){
								location.href = obj.jump;
							},1500);
						}
					}
					else
					{
						if(obj.jump)location.href = obj.jump;
					}
					
				}
				else{
					
				}
			}
		});		
		return false;
	});
});

$(document).on("pageInit", "#biz_withdrawal_form", function(e, pageId, $page) {
	$(".ui-textbox").val('');
	$("form[name='withdrawal_form']").find("input[name='money']").change(function(){
		var money=parseFloat($(this).val());
		if(money>all_money){
			$.toast("提现超额");
			$(this).val(all_money);
		}
	});

	submit();
	function submit(){	
		$(".withdrawal_submit").bind("click",function(){	
			$(".withdrawal_submit").attr('disabled',"true");
			setTimeout(function(){
				$(".withdrawal_submit").removeAttr("disabled");
			},3000);
			
			var money = $("form[name='withdrawal_form']").find("input[name='money']").val();
			var pwd = $("form[name='withdrawal_form']").find("input[name='pwd_verify']").val();
			if(is_bank=="")
			{	
				$.toast("请先绑定银行卡");
				setTimeout(function(){
					load_page($(".load_page"));
				},1000);
				return false;
			}
			
			/*if($.trim(pwd)=="")
			{
				$.toast("请输入登录密码");
				return false;
			}*/
			
			if($.trim(money)==""||isNaN(money)||parseFloat(money)<=0)
			{
				$.toast("请输入正确的提现金额");
				return false;
			}
			
			var ajax_url = $("form[name='withdrawal_form']").attr("action");
			var query = $("form[name='withdrawal_form']").serialize();
			//console.log(query);
			$.ajax({
				url:ajax_url,
				data:query,
				dataType:"json",
				type:"POST",
				success:function(obj){
					if(obj.status==1){
						$(".ui-textbox").val('');
						$.toast("提现申请成功，请等待管理员审核");
						if(obj.jump){
							setTimeout(function(){
								$.router.load(obj.jump, true);
								//location.href = obj.jump;
							},1500);
						}
					}else if(obj.status==0){
						if(obj.info)
						{
							$.toast(obj.info);
							if(obj.jump){
								setTimeout(function(){
									$.router.load(obj.jump, true);
									//location.href = obj.jump;
								},1500);
							}
						}
						else
						{
							if(obj.jump)$.router.load(obj.jump, true);
						}
						
					}
				}
			});		
			return false;
		});
	}
});

/**
 * Created by Administrator on 2016/9/7.
 */


$(document).on("pageInit", "#cart", function(e, pageId, $page) {
    $(".j-youhui").on('click', function() {
        $(".youhui-mask").addClass('active');
        $(".cart-youhui-box").addClass('active');
        
        var query = new Object();
        query.id = $(this).attr("data-id");
    	query.act = "get_youhui";
        
        $.ajax({
            url:CART_URL,
            data:query,
            type:"post",
            dataType:"json",
            success:function(data){
                
                $(".cart-youhui-box").find(".shop-name").html(data.supplier_name);
                $(".cart-youhui-box").find(".youhui-wrap").empty();
                
                var lenght=data.list.length;
                var li="";
                for(var i=0;i<lenght;i++){
                	
                	if(data['list'][i]['status']==1){
	                	li+="<div class='youhui-item b-line flex-box'>"+
									"<div class='youhui-info flex-1'>"+
										"<p class='youhui-price'>"+data['list'][i]['youhui_value']+"元</p>"+
										"<p class='youhui-tip'>"+data['list'][i]['use_info']+"</p>"+
										"<p class='youhui-time'>使用期限："+data['list'][i]['time_info']+"</p>"+
									"</div>"+
									"<a href='javascript:void(0);' class='youhui-btn j-get-youhui' data-id='"+data['list'][i]['id']+"' status='"+data['list'][i]['status']+"'>"+data['list'][i]['status_info']+"</a>"+
								"</div>";
                	}else{
                		li+="<div class='youhui-item b-line flex-box'>"+
								"<div class='youhui-info flex-1'>"+
									"<p class='youhui-price'>"+data['list'][i]['youhui_value']+"元</p>"+
									"<p class='youhui-tip'>"+data['list'][i]['use_info']+"</p>"+
									"<p class='youhui-time'>使用期限："+data['list'][i]['time_info']+"</p>"+
								"</div>"+
								"<a href='javascript:void(0);' class='youhui-btn' style='border: 1px solid gray;color: gray;' data-id='"+data['list'][i]['id']+"' status='"+data['list'][i]['status']+"'>"+data['list'][i]['status_info']+"</a>"+
							"</div>";
                	}
                }
                $(li).appendTo($(".cart-youhui-box .youhui-wrap"));
               
            }
            ,error:function(){
            }
        });
        
    });
    
    $(".cart-youhui-box").on('click', ".j-get-youhui" ,function() {
    	var status=$(this).attr("status");
    	
    	$(".youhui-mask").removeClass('active');
        $(".cart-youhui-box").removeClass('active');
        
    	if(status==1){
	    	var query = new Object();
	        query.data_id = $(this).attr("data-id");
	    	query.act = "download_youhui";
	    	
	    	$.ajax({
	            url:CART_URL,
	            data:query,
	            type:"post",
	            dataType:"json",
	            success:function(data){
	            	$.toast(data.info);
	            	if(data.status){
		            	setTimeout(function(){
		            		window.location.reload();
		            	},1000);
	            	}
	            }
	            ,error:function(){
	            }
	        });
    	}else{
    		$.toast("您已经领取了优惠券，留一点给别人吧~");
    	}
    });
    
    $(".j-close-mask").on('click', function() {
        $(".youhui-mask").removeClass('active');
        $(".cart-youhui-box").removeClass('active');
    });
    count_buy_total();
    //count_buy_total(1);
    isSelect();
    /*编辑按钮点击事件开始*/
    $(".j-edit-cur").unbind("click");
    $(".j-edit-cur").click(function () {
        var deal_json_key='dealkey_161010493611354';
        var $this=$(this);
        var curBtn=$this.text();
        var $parents=$this.parent().parent().parent();

        if(curBtn=="编辑"){
            $parents.find(".m-cart-list li .z-opera-sure").css("display","none");
            $parents.find(".m-cart-list li .z-opera-edit").addClass("active");
            $this.text("完成");
            isSelect();
        }else if(curBtn=="完成"){
            $parents.find(".m-cart-list li .z-opera-sure").css("display","flex");
            $parents.find(".m-cart-list li .z-opera-edit").removeClass('active');
            $this.text("编辑");
            isSelect();
        }
    });

    $(".j-edit-all").unbind("click");
    $(".j-edit-all").click(function () {
        var allBtn= $(this).text();
        if(allBtn=="编辑全部"){
            var accnum=$(".m-conBox .j-select-body").find("input[type=checkbox]:checked").length;
            $(".m-cart-list li .z-opera-sure").css("display","none");
            $(".m-cart-list li .z-opera-edit").addClass("active");
            $(".j-del-order").show().text("删除("+accnum+")");
            $(".allCount").hide();
            $(".j-accounts").hide();
            $(".j-edit-cur").hide();
            isSelect();
            $(this).text("完成");
        }else if(allBtn=="完成"){
            var accnum=$(".m-conBox .j-select-body").find("input[type=checkbox]:checked").length;
            $(".m-cart-list li .z-opera-sure").css("display","flex");
            $(".m-cart-list li .z-opera-edit").removeClass('active');
            $(this).text("编辑全部");
            $(".j-del-order").hide();
            $(".allCount").show();
            $(".j-edit-cur").show().text("编辑");
            $(".j-accounts").show().text("结算("+accnum+")");
            isSelect();
        }
    });
    /*编辑按钮点击事件结束*/


    /*点击删除按钮*/
    $(".z-opera-edit").off('click','.confirm-ok');
    $(".z-opera-edit").on('click','.confirm-ok', function () {
        var _this=$(this);
        var _parent=$(_this).parents(".j-select-body");
        var parents=$(_this).parents(".j-conBox");
        $.confirm('确定要删除这个宝贝吗？', function () {
            var query = new Object();
            var id = parseInt($(_this).parents("li").attr("data-id"));
            var ids = new Array();
            ids.push(id);
            query.act='clear_deal_cart';
            query.id = ids;
            $.ajax({
                url:CART_URL,
                data:query,
                type:"post",
                dataType:"json",
                success:function(data){
                    if(data.status==-1)
                    {
                        location.href=data.jump;
                    }else if(data.status==1)
                    {
                        _this.parents("li").remove();
                        var accn=$(".m-conBox .j-select-body").find("input[type=checkbox]:checked").length;
                        $(".j-del-order").text("删除("+accn+")");

                        var childLen=_parent.find("li").length;
                        if(childLen==0){
                            parents.remove();
                        }

                        var count=isSelect();
                        if(count==0){
                            location.reload();
                        }
                    }else{
                        $.alert(data.info);
                    }
                }
                ,error:function(){
                }
            });


        });
    });

    /*点击全删除按钮*/


    /*点击删除全部按钮*/
    // $(document).on('click','.j-del-order', function () {
    $('.j-del-order').off('click');
    $('.j-del-order').on('click', function() {
        var _this=$(this);
        $.confirm('确定要删除所选宝贝吗？', function () {
            var checkBox=$(".m-conBox").find("input[type=checkbox]:checked");
            if(checkBox.length==0){
                $.confirm('没有选择宝贝');
            }

            var query = new Object();
            var ids = new Array();
            var checked_box = $(".m-cart-list").find("input[type=checkbox]:checked");
            checked_box.each(function(){
                var id = parseInt($(this).parents("li").attr("data-id"));
                ids.push(id);
            });

            query.act='clear_deal_cart';
            query.id = ids;
            $.ajax({
                url:CART_URL,
                data:query,
                type:"post",
                dataType:"json",
                success:function(data){
                    if(data.status==-1)
                    {
                        location.href=data.jump;
                    }else if(data.status==1)
                    {

                        checkBox.parent().parent().remove();
                        $(".j-del-order").text("删除(0)");
                        var count=isSelect();
                        $(".j-select-all label input[type=checkbox]").prop("checked",false);
                        if(count==0){
                            location.reload();
                        }
                    }else{
                        $.alert(data.info);
                    }
                }
                ,error:function(){
                }
            });





        });
    });
    /*点击删除全部按钮*/



    /*返回按钮*/
    /*
     $(document).on('click','.j-sure-cancel', function () {
     var _this=$(this);
     $.confirm('您确定要取消订单吗？', function () {
     window.history.back(-1);
     });
     });
     */



    /*输入框加减按钮*/
    $(".u-add").click(function () {
        var val=parseInt($(this).parent().find(".u-txt").val());
        var id=parseInt($(this).parent().find(".u-txt").attr("deal-id"));
        var max=parseInt($(this).parent().find(".u-txt").attr("max"));
        var user_max=parseInt($(this).parent().find(".u-txt").attr("user_max_bought"));
        //var user_min=parseInt($(this).parent().find(".u-txt").attr("user_min_bought"));
        val++;
        var num=$(".u-txt[deal-id='"+id+"']").length;
        if(val>max && max!=-1){
            val=max;
        }

        if(num==1){
            if((max>user_max && max!=-1) || (max==-1)){
                if(user_max>0 && val>user_max){
                    val=user_max;
                    $.alert("该商品最多还能购买"+user_max+"件");
                }
            }
        }else{
            var allval=0;
            $(".u-txt[deal-id='"+id+"']").each(function(){
                allval+=parseInt($(this).val());
            });
            if(user_max>0 && allval>=user_max){
                $.alert("该商品最多还能购买"+user_max+"件");
                if(val>1){
                    val=val-1;
                }
            }
            if(val>max && max!=-1){
                $.alert("库存不足");
                val=max;
            }
        }

        $(this).parent().find(".u-txt").val(val);
        $(this).parents(".item-inner").find(".j-count-num").text(val);
        isSelect();
    });
    $(".u-reduce").click(function () {
        var val=$(this).parent().find(".u-txt").val();
        var user_min=parseInt($(this).parent().find(".u-txt").attr("user_min_bought"));
        var id=parseInt($(this).parent().find(".u-txt").attr("deal-id"));
        var num=$(".u-txt[deal-id='"+id+"']").length;
        val--;
        /*if(num==1){
         if(user_min>0 && val<user_min){
         val=user_min;
         alert("该商品最小购买量为"+user_min);
         }
         }else{
         var allval=0;
         $(".u-txt[deal-id='"+id+"']").each(function(){
         allval+=parseInt($(this).val());
         });
         if(user_min>0 && allval<=user_min){
         alert("该商品最小购买量为"+user_min);
         val=val+1;
         }
         }*/
        if(val<1){
            val=1;
        }
        $(this).parents(".item-inner").find(".j-count-num").text(val);
        $(this).parent().find(".u-txt").val(val);
        isSelect();
    });
    /*改变编辑框数量*/
    $(".u-txt").blur(function () {
        var val=parseInt($(this).parent().find(".u-txt").val());
        var max=parseInt($(this).parent().find(".u-txt").attr("max"));
        var user_min=parseInt($(this).parent().find(".u-txt").attr("user_min_bought"));
        var user_max=parseInt($(this).parent().find(".u-txt").attr("user_max_bought"));
        var id=parseInt($(this).parent().find(".u-txt").attr("deal-id"));
        var num=$(".u-txt[deal-id='"+id+"']").length;

        if(val>0){
            if(num==1){
                if(user_max>0 && val>user_max){
                    if( (user_max<max && max!=-1) || (max==-1)){
                        val=user_max;
                        $.alert("该商品最多还能购买"+user_max+"件");
                    }

                }/*else if(user_min>0 && val<user_min){
                 val=user_min;
                 alert("该商品最小购买量为"+user_min);
                 }*/else{
                    if(val>max && max!=-1){
                        val=max;
                        $.alert("该商品库存不足");
                    }else{
                        val=val;
                    }
                }
            }else{
                var allval=0;

                $(".u-txt[deal-id='"+id+"']").each(function(){
                    allval+=parseInt($(this).val());
                });
                var elseval=allval-val;
                if(user_max>0 && allval>=user_max){
                    $.alert("该商品最多还能购买"+user_max+"件");
                    val=user_max-elseval;
                }/*else if(user_min>0 && allval<=user_min){
                 alert("该商品最小购买量为"+user_min);
                 val=user_min-elseval;
                 }*/
                if(val>max && max!=-1){
                    val=max;
                    $.alert("该商品库存不足");
                }else{
                    val=val;
                }

            }
        }else{
            /*if(user_min>0){
             val=user_min;
             }else{*/
            val=1;
            /*}*/
            $.alert("请输入有效数字");
        }
        $(this).parent().find(".u-txt").val(val);
        $(this).parents(".item-inner").find(".j-count-num").text(val);
        isSelect();
    });



    /*点击清空按钮*/
    $('.j-clear-all').off('click');
    $('.j-clear-all').on('click', function () {
        var _this=$(this);
        $(_this).removeClass('j-clear-all');
        $.confirm('您确定要清空失效商品吗？', function () {
        	
            var disable_id = new Array();
            $(".m-invalid .m-cart-list .item-content").each(function(i,obj){
                disable_id.push($(obj).attr("data-id"));
            });
            var query = new Object();
            query.act='clear_deal_cart';
            query.id = disable_id;
            $.ajax({
                url:CART_URL,
                data:query,
                type:"post",
                dataType:"json",
                success:function(data){
                    if(data.status==-1)
                    {
                        location.href=data.jump;
                    }else if(data.status==1)
                    {
                        _this.parents(".m-invalid").remove();
                        var count=isSelect();
                        if(count==0){
                            location.reload();
                        }
                    }else{
                        $.alert(data.info);
                    }
                    $(_this).addClass('j-clear-all');
                }
                ,error:function(){
                	$(_this).addClass('j-clear-all');
                }
            });

        });
    });


    /*全选按钮点击事件*/
    $(".j-select-all label input[type=checkbox]").change(function () {
        if($(this).attr('checked')==false){
            //如果全选按钮没有选中，则列表的中的按钮也全部是未选中状态
            $(".m-cart").find("label input[type=checkbox]").prop("checked",false);
        }else {
            //如果全选按钮选中，则列表的中的按钮也全部是选中状态
            $(".m-cart").find("label input[type=checkbox]").prop("checked",true);
        }
        isSelect();
    });



    /*列表中头部checkbox按钮点击事件开始*/

    $(".j-select-title input[type=checkbox]").change(function () {
        if($(this).is(':checked')==false){
            $(this).parents(".m-conBox").find(".m-cart-list label input[type=checkbox]").prop("checked",false);
        }else {
            $(this).parents(".m-conBox").find(".m-cart-list label input[type=checkbox]").prop("checked",true);
        }
        isSelect();
        var accn=$(".m-conBox .j-select-body").find("input[type=checkbox]:checked").length;
        $(".j-del-order").text("删除("+accn+")");
        $(".j-accounts").text("结算("+accn+")");

    });
    /*列表中头部checkbox按钮点击事件结束*/

    /*宝贝列表单个checkbox点击事件开始*/
    $(".j-select-body input[type=checkbox]").change(function () {
        isSelect();

        var _samePar=$(this).parents(".m-cart-list").find("input[type=checkbox]");
        var _len=_samePar.length;
        _samePar.each(function () {
            var anum=$(this).parents(".m-cart-list").find("input[type=checkbox]:checked").length;

            if(anum<_len){
                $(this).parents(".m-conBox").find(".j-select-title input[type=checkbox]").prop("checked",false);
            }else {
                $(this).parents(".m-conBox").find(".j-select-title input[type=checkbox]").prop("checked",true);
            }
        });

    });
    /*宝贝列表单个checkbox点击事件接结束*/

    /*判断是否全部选中*/
    function isSelect() {
        var _checkbox=$(".m-cart-list label input[type=checkbox]");
        var _radio=$(".m-cart-list label input[type=checkbox]:checked");

        var _lenght=_checkbox.length;

        _checkbox.each(function () {
            var a=$(".m-cart-list label input[type=checkbox]:checked").length;
            if(a<_lenght){
                $(".j-select-all label input[type=checkbox]").prop("checked",false);
            }else {
                $(".j-select-all label input[type=checkbox]").prop("checked",true);
                $(".j-select-title input[type=checkbox]").prop("checked",true);
            }
        });

        var allprice = 0;
        var promote_price = 0;
        var promote_count = 0;
        var select_count = 0;
        _radio.each(function () {
            var data_price=parseFloat($(this).parents("li").find(".u-money").attr("data_value"));
            var data_num=parseInt($(this).parents("li").find(".j-count-num").text());
            var allow_promote = parseInt($(this).parents("li").attr("allow_promote"));
            select_count++;
            var account=data_num*data_price;
            allprice+=account;
            if(allow_promote==1){
                promote_price+=account;
                promote_count++;
            }
        });


        if(typeof(promote_cfg)!='undefined'){
            if(promote_cfg && promote_count==select_count){
                var all_promote_price=0;
                for(var i=0;i<promote_cfg.length;i++){
                    if(promote_price >= parseInt(promote_cfg[i]['discount_limit'])){
                        allprice -= parseInt(promote_cfg[i]['discount_amount']);
                        all_promote_price+=parseInt(promote_cfg[i]['discount_amount']);
                    }
                }
                $("#promote_price").html("¥"+all_promote_price);
            }else{
                $("#promote_price").html("¥0");
            }
        }
        allprice = allprice.toFixed(2);
        var priceStr=allprice.toString();
        if(priceStr.indexOf(".") > 0 ){
            var price_split=priceStr.split(".");
            $(".j-price-int").text(price_split[0]);
            $(".j-price-piont").text(price_split[1]);
        }else {
            $(".j-price-int").text(priceStr);
            $(".j-price-piont").text("00");
        }


        var accn=$(".m-conBox .j-select-body").find("input[type=checkbox]:checked").length;
        var allaccn=$(".m-conBox .j-select-body").find("input[type=checkbox]").length;
        $(".j-del-order").text("删除("+accn+")");
        $(".j-accounts").text("结算("+accn+")");
        if(accn==0){
            $(".j-accounts").addClass("invalid");
            /*if(index){
             location.reload();
             }*/
        }else{
            $(".j-accounts").removeClass("invalid");
        }
        return allaccn;
    }


    $(".j-accounts").unbind("click");
    $(".j-accounts").click(function(){
        if(is_login==0){
            if(app_index=="app"){
                App.login_sdk();
            }else{
                $.router.load(login_url, true);
            }
            return false;
        }
        var _this=$(this);
        var _radio=$(".m-cart-list label input[type=checkbox]");
        var checked_ids = new Array();
        var nochecked_ids = new Array();
        $(_radio).each(function(){
            var id = $(this).parents("li").attr("data-id");
            var attr = $(this).parents("li").find(".sizes").attr("attr_key");
            var attr_str = $(this).parents("li").find(".sizes").attr("attr_str");
            var number = parseInt($(this).parents("li").find(".j-count-num").text());
            var cart_item = new Object();
            cart_item.id = id;
            cart_item.attr = attr;
            cart_item.attr_str = attr_str;
            cart_item.number = number;
            if($(this).is(":checked")){
                checked_ids.push(cart_item);
            }else{
                nochecked_ids.push(cart_item);
            }

        });
        var disable_raido = $(".m-invalid .m-cart-list li");
        $(disable_raido).each(function(){ //失效商品
            var id = parseInt($(this).attr("data-id"));
            var cart_item = new Object();
            cart_item.id = id;
            nochecked_ids.push(cart_item);
        });

        //console.log(nochecked_ids);return false;
        if(checked_ids.length==0){
            return false;
        }
		$.showIndicator();
        var query = new Object();
        query.act='set_cart_status';
        query.checked_ids = checked_ids;
        query.nochecked_ids = nochecked_ids;

        $.ajax({
            url:CART_URL,
            data:query,
            type:"post",
            dataType:"json",
            success:function(data){
                if(data.status==-1)
                {
                    $.hideIndicator();
					$.alert(data.info,function(){
						if(app_index=="app"){
							App.login_sdk();
						}else{
							window.location.href=data.jump;
						}
                    });
                    /*window.setTimeout(function(){
                    	//$.router.load(data.jump,true);
                    	window.location.href=data.jump;
                    },1000);*/

                }else if(data.status==1)
                {
        			
        			
        		    setTimeout(function () {
        		    	 $.hideIndicator();
        		    }, 2000);
					location.href = cart_check_url;
					
                  //  $.router.load(cart_check_url, true);
                }else{
					$.hideIndicator();
                	$.alert(data.info,function(){
                		if(data.jump){
                			window.location.href=data.jump;
                		}
                	});
                }
            }
            ,error:function(){
				$.hideIndicator();
            }
        });


    });



    /*提交订单选择配送方式点击事件*/
    var _hei=$(".j-trans-way").height();
    var _rehei=$(".j-red-reward").height();
    $(".popup-box .j-trans-way").css({"bottom":-_hei});
    $(".popup-box .j-red-reward").css({"bottom":-_rehei});
    var _bhei=$(".pup-box-bg").height();


    $(".j-cancel").click(function () {
        popupTransition();
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },300);
    });


    $(".j-trans").click(function () {
        $(".totop").addClass("vible");
        $(".popup-box .j-red-reward").css({"bottom":-_rehei});
        $(".popup-box").css({"transition":"all 0.3s linear","opacity":"1","z-index":"9999"});
        $(".popup-box .j-trans-way").css({"transition":"bottom 0.3s linear","bottom":"0"});
        $(".popup-box .pup-box-bg").css({"transition":"opacity 0.3s linear","opacity":"0.6"});
    });
    $(".j-reward").click(function () {
        $(".totop").addClass("vible");
        $(".popup-box .j-trans-way").css({"bottom":-_hei});
        $(".popup-box").css({"transition":"all 0.3s linear","opacity":"1","z-index":"9999"});
        $(".popup-box .j-red-reward").css({"transition":"bottom 0.3s linear","bottom":"0"});
        $(".popup-box .pup-box-bg").css({"transition":"opacity 0.3s linear","opacity":"0.6"});
    });


    /*弹出层动画效果*/
    function popupTransition() {
        /* $(".j-cancel").parents(".m-trans-way").css({"transition":"bottom 0.3s linear","bottom":-_hei});*/
        $(".popup-box .j-trans-way").css({"transition":"bottom 0.3s linear","bottom":-_hei});
        $(".popup-box .j-red-reward").css({"transition":"bottom 0.3s linear","bottom":-_rehei});
        $(".j-cancel").parents(".popup-box").find(".pup-box-bg").css({"transition":"opacity 0.3s linear","opacity":"0"});
        $(".j-cancel").parents(".popup-box").css({"transition":"all 0.3s linear 0.3s","opacity":"0","z-index":"-1"});
    }
    /*弹出层动画效果*/

    /*弹出框点击事件*/
    function listCli(obj) {
        obj.click(function () {
            var lue_name=$(this).find(".pay-way-name .j-company-name").text();
            var lue_momey=$(this).find(".pay-way-name .j-company-money").text();
            var lue_reward=$(this).find(".pay-way-name").text();

            var parText=$(obj).parents(".m-trans-way").find(".u-ti").text();

            $(this).parents("ul").find("input").prop("checked",false);
            if(parText=="配送方式"){
                $(this).find("input[name='delivery']").prop("checked",true);
                var is_pick=$(this).find("input[name='delivery']").val();
                //alert(is_pick);
                $(".j-trans .j-trans-commpany").find(".j-company-name").text(lue_name);
                if(is_pick!=-1){
                    $(".j-trans .j-trans-commpany").find(".j-company-money").text(lue_momey);
                    $("#delivery-address").show();
                }else{
                    $(".j-trans .j-trans-commpany").find(".j-company-money").text("");
                    $("#delivery-address").hide();
                }
            }
            if(parText=="红包"){
                $(this).find("input[name='ecvsn']").prop("checked",true);
                $(".j-reward .j-reward-money").text(lue_reward);
            }
            setTimeout(function () {
                $(".totop").removeClass("vible");
            },500);
            popupTransition();
            count_buy_total();
        });
    }

    listCli($(".j-reward-list li"));
    listCli($(".j-trans-list li"));








    /*弹层开始*/
    $(".choose-list .j-choose").click(function(){
        $(this).siblings(".j-choose").removeClass("active");
        $(this).addClass("active");
        setSpecgood();
        var data_value= $(".j-choose.active").attr("data-value");
        var data_value = []; // 定义一个空数组
        var txt = $('.j-choose.active'); // 获取所有文本框
        for (var i = 0; i < txt.length; i++) {
            data_value.push(txt.eq(i).attr("data-value")); // 将文本框的值添加到数组中
        }
        $(".good-specifications span").empty();
        $(".good-specifications span").addClass("isChoose");
        $(".good-specifications span").append("已选规格：");
        $.each(data_value,function(i){
            $(".good-specifications span").append("<em class='tochooseda'>" + data_value[i] + "</em>");
            //传值可以考虑更改这里
            $(".spec-data").attr("data-value"+[i],data_value[i]);
        });
    });


    $(".j-box-bg").click(function () {
        popupTransition();
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },300);
    });



    
    $(".j-open-choose").bind("click",open_choose);
    function open_choose(){
        $(".j-flippedout-close").attr("rel","spec");
        $(".j-spec-choose-close").attr("rel","spec");
        $(".flippedout").addClass("showflipped").addClass("z-open");
        $(".spec-choose").addClass("z-open");
        $(".totop").addClass("vhide");//隐藏回到头部按钮
        var $this=$(this);
        $(this).unbind("click");
        $this.parents("li").addClass("choose");
        //调用属性HTML
        var id =  $this.parents("li").attr("data-id");
        var attr_key = $this.parents("li").find(".sizes").attr("attr_key");
        var query = new Object();
        query.act='get_cart_deal_attr';
        query.id = id;
        query.attr_key = attr_key;
        $.ajax({
            url:CART_URL,
            data:query,
            type:"post",
            dataType:"json",
            success:function(data){
                if(data.status==-1)
                {
                    location.href=data.jump;
                }else if(data.status==1)
                {
                    $(".page-current .cart_box").html(data.html);
                    set_attr_name();
                    $(".flippedout .choose-list .j-choose").click(function(){
                        if(!$(this).hasClass("active")){
                            $(this).siblings(".j-choose").removeClass("active");
                            $(this).addClass("active");
                            set_attr_name();
                        }
                    });


                    $(".j-spec-choose-close,.j-flippedout-close,.j-cancel-flip").click(function(){
                        cssAnition();
                    });

                    $(".j-nowbuy").click(function () {
                        if($(this).attr('max') && $(this).attr('max')==0){
                            $.alert("库存不足");
                        }else{
                            if($this.parents("li").hasClass("choose")){
                                $this.parents("li").removeClass("choose");
                            }

                            var attr_check_ids = new Array();
                            var attr_name = '';
                            $(".showflipped .spec-info .j-choose.active").each(function(i,obj){
                                attr_name+=$(obj).text();
                                attr_check_ids.push($(obj).attr("data-id"));
                            });

                            if(attr_check_ids.length==attr_num){

                                var attr_checked_ids = attr_check_ids.join(",");
                                //同步属性
                                $this.parents("li").find(".sizes").attr({'attr_key':attr_checked_ids,'attr_str':attr_name}).text("规格:"+attr_name);
                                var deal_name=$this.parents("li").find(".item-subtitle a").attr('deal-name'); 
                                if(deal_name){
                                	$this.parents("li").find(".item-subtitle a").html(deal_name+"["+attr_name+"]");
                                }
                                
                                //同步值
                                if($(this).attr('max') != '不限'){

                                    $(".item-content[data-id='"+id+"']").find("input[type=text]").attr("max",$(this).attr('max'));
                                    $(".item-content[data-id='"+id+"']").find(".u-surplus").html("仅剩"+$(this).attr('max')+"件");
                                    if($(this).attr('max')>=10){
                                    	$(".item-content[data-id='"+id+"']").find(".u-surplus").hide();
                                    }else{
                                    	$(".item-content[data-id='"+id+"']").find(".u-surplus").show();
                                    }
 
                                    $val=$(".item-content[data-id='"+id+"']").find("input[type=text]").val();
                                    var $val=parseInt($val);
                                    var $max=parseInt($(this).attr('max'));
                                    if($val>$max){
                                        $(".item-content[data-id='"+id+"']").find("input[type=text]").val($max);
                                        $(".item-content[data-id='"+id+"']").find(".j-count-num").text($max);
                                        isSelect();
                                    }
                                }else{

                                    $(".item-content[data-id='"+id+"']").find("input[type=text]").attr("max",$(this).attr('max'));
                                    $(".item-content[data-id='"+id+"']").find(".u-surplus").html("");
                                    $val=$(".item-content[data-id='"+id+"']").find("input[type=text]").val();
                                }

                                //同步价格
                                var num=parseFloat($(".showflipped .spec-goodprice").attr("data_value"));
                                num = Math.round(num*100)/100;  //保留两位小数
                                num =Number(num).toFixed(2);  //保留两位小数
                                var num_arr = num.split('.');
                                var price_str='¥ <i class="j-goods-money">'+num_arr[0]+'.</i>'+num_arr[1];
                                $this.parents("li").find(".u-money").attr("data_value",num).html(price_str);

                                cssAnition();
                            }else{
                                $.alert("请选择属性");
                            }
                        }
                    });

                }else{
                    $.alert(data.info);
                }
            }
            ,error:function(){
            }
        });
    }

    function set_attr_name(){
        var attr_name='';
        var attr_check_ids = new Array();
        var attr_check_key='';
        var deal_price = deal_current_price; // 商品基础价
        $(".showflipped .spec-info .j-choose.active").each(function(i,obj){
            attr_name+='&nbsp;&nbsp;'+$(obj).text();
            attr_check_ids.push($(obj).attr("data-id"));
        });

        var attr_check_ids_new = attr_check_ids.sort();
        attr_check_key=attr_check_ids_new.join("_");
        if(deal_attr_stock_json[attr_check_key]){
            var stock = deal_attr_stock_json[attr_check_key]['stock_cfg'];
            if(parseInt(stock)<0){
                stock = '不限';
            }
            deal_price += parseFloat(deal_attr_stock_json[attr_check_key]['price']);
        }else{
            var stock = '不限';
        }
        $(".spec-goodspec").empty();
        $(".spec-goodspec").append("已选择");
        //$(".spec-goodspec em").html(attr_name);
        $(".spec-goodspec").append("<em class='choose_item'>" + attr_name + "</em>");
        $(".spec-goodstock").text("库存:"+stock);
        $(".j-nowbuy").attr("max",stock);

        
        /*$.each(deal_attr_json,function(i,obj){
            $.each(obj['attr_list'],function(xi,xobj){
                if($.inArray(xobj.id,attr_check_ids_new) >= 0){

                    deal_price += parseFloat(xobj.price);
                }
            });

        });*/

		deal_price=parseFloat(deal_price).toFixed(2);
        $(".spec-goodprice").attr("data_value",deal_price).html("¥"+deal_price);

    }


    function cssAnition() {
        $(".flippedout").removeClass("showflipped").removeClass("dropdowm-open").removeClass("z-open");
        $(".spec-choose").removeClass("z-open");
        $(".j-open-choose").bind("click",open_choose);
    }


    function count_buy_total()
    {
        ajaxing = true;
        var query = new Object();

        //获取配送方式
        var delivery_id = $("input[name='delivery']:checked").val();

        if(!delivery_id)
        {
            delivery_id = 0;
        }
        query.delivery_id = delivery_id;

        var address_id = $("input[name='address_id']").val();

        //全额支付
        if($("input[name='all_account_money']").attr("checked"))
        {
            query.all_account_money = 1;
        }
        else
        {
            query.all_account_money = 0;
        }

        //代金券
        var ecvsn = $("input[name='ecvsn']:checked").val();

        if(!ecvsn)
        {
            ecvsn = '';
        }

        var ecvpassword = $("input[name='ecvpassword']").val();
        if(!ecvpassword)
        {
            ecvpassword = '';
        }

        var buy_type = $("input[name='buy_type']").val();
        query.ecvsn = ecvsn;
        query.ecvpassword = ecvpassword;
        query.address_id = address_id;
        query.buy_type = buy_type;
        //支付方式
        var payment = $("input[name='payment']:checked").val();
        if(!payment)
        {
            payment = 0;
        }
        query.payment = payment;
        query.bank_id = $("input[name='payment']:checked").attr("rel");
        query.id = order_id;
        //query.reward = reward;
        query.act = "count_buy_total";
        $.ajax({
            url: AJAX_URL,
            data:query,
            type: "POST",
            dataType: "json",
            success: function(data){
                //alert(1111);
                /*if(data.free && delivery_id!=-1){
                 $(".j-company-money").html("运费：0");
                 }*/
                if(data.total_price==0 && $('div').is('.voucher_box')){
                    $(".voucher_box").remove();
                    count_buy_total();
                }
                /*if(reward==1){*/
                $("#cart_total").html(data.html);
                $(".total_price_box").html(data.pay_price_html);
                ajaxing = false;
                /*}else{
                 var ecv_money = parseFloat($("input[name='ecvsn']:checked").attr("money"));
                 var pay_moeny = parseFloat(data);
                 if(pay_moeny<ecv_money){
                 //$("div.j-reward-money").html("不使用红包");
                 var now_ecv=0;
                 $(".j-reward-list li").each(function(){
                 var this_money=parseFloat($(this).find("input[name='ecvsn']").attr("money"));
                 if(pay_moeny<this_money){
                 $(this).remove();
                 }else{
                 if(this_money>now_ecv){
                 now_ecv=this_money;
                 }
                 }
                 });
                 now_ecv=parseFloat(now_ecv);
                 $(".j-reward-list li").each(function(){
                 var this_money=parseFloat($(this).find("input[name='ecvsn']").attr("money"));
                 if(this_money==now_ecv){
                 $(".j-reward-list").find("input[name='ecvsn']").removeAttr("checked");   ;
                 $(this).find("input[name='ecvsn']").attr("checked","checked");
                 $("div.j-reward-money").html($(this).find(".pay-way-name").html());
                 }
                 });
                 }*/
                //count_buy_total(1);
                //}
            },
            error:function(ajaxobj)
            {
//    			if(ajaxobj.responseText!='')
//    			alert(LANG['REFRESH_TOO_FAST']);
            }
        });
    }
    
    
    $(".go_pay").unbind("click");
    $(".go_pay").click(function(){
        var query = $("#pay_box").serialize();
        //console.log(query);
        /*if($("input[name='payment']:checked").val()==-1){
         query['is_pick']=1;
         }else{
         query['is_pick']=0;
         }*/
        var url = $("#pay_box").attr("action");
        $.ajax({
            url: url,
            data:query,
            type: "POST",
            dataType: "json",
            success: function(data){

                if(data.status==1)
                {
                    location.href=data.jump;
                }else{
                    $.alert(data.info);
                }

                ajaxing = false;
            },
            error:function(ajaxobj)
            {

            }
        });

    });


});

/**
 * Created by Administrator on 2016/11/28.
 */
$(document).on("pageInit", "#cart_check", function(e, pageId, $page) {
    //打开发票须知
    $(document).on('click','.j-open-invoice-popup', function () {
      $.popup('.invoice-popup');
    });
    //发票类型
    $(document).off('click', '.j-open-type');
    $(document).on('click', '.j-open-type', function() {
        var shop_id=$(this).parents(".m-invoice-box").attr('shop-id');
        $(".invoice-type-box").attr('shop-id', shop_id);
        $('.invoice-type-box').addClass('active');
        $(".m-mask").addClass('active');
    });
    $(document).off('click', '.j-select-type');
    $(document).on('click', '.j-select-type', function() {
        var val_id=$(this).attr('value');
        var shop_id=$(this).parents(".invoice-type-box").attr('shop-id');
        var obj=$(".m-invoice-box[shop-id='"+shop_id+"']");
        obj.find('.invoice-type .invoice-tip').html($(this).find('.invoice-type').html());
        obj.find('.invoice-type input').val($(this).attr('value'));
        if (val_id==0) {
            obj.find('.invoice-detail').addClass('hide');
        } else if (val_id == 1) {
            obj.find('.invoice-detail').removeClass('hide');
            obj.find('.inv-tax-box').addClass('hide');
        } else {
            obj.find('.invoice-detail').removeClass('hide');
            obj.find('.inv-tax-box').removeClass('hide');
        }
    });
    //发票内容
    $(document).off('click', '.j-open-info');
    $(document).on('click', '.j-open-info', function() {
        var shop_id = $(this).parents('.m-invoice-box').attr('shop-id');
        var link_shop_id = shop_id;
        if(! parseInt(shop_id)) {
            link_shop_id = shop_id
            shop_id = 0;
        }
        $('div[shop-id="'+shop_id+'"]').attr('link-shop-id', link_shop_id);
        $('div[shop-id="'+shop_id+'"]').addClass('active');
        $('.invoice-type-box').removeClass('active');
        $(".m-mask").addClass('active');
    })
    $(document).off('click', '.j-select-info');
    $(document).on('click', '.j-select-info', function() {
        var shop_id=$(this).parents(".invoice-info-box").attr('link-shop-id');
        var obj=$(".m-invoice-box[shop-id='"+shop_id+"']");
        obj.find('.invoice-info .invoice-tip').html($(this).find('.invoice-info').html());
        obj.find('.invoice-info input').val($(this).attr('value'));
    });

    // 关闭弹层
    $(document).off('click', '.j-close-select');
    $(document).on('click', '.j-close-select', function() {
        $(".m-select-box").removeClass('active');
        $(".m-mask").removeClass('active');
    });

    var _close=false;
    $(document).on('click',"#cart_check .remarkBox p.remarkTitle",function () {
    	var remarkArea = $(this).siblings('.remarkArea');
        if(_close==false){
            $(remarkArea).show();
            return _close=true;
        }
        if(_close==true){
            $(remarkArea).hide();
            return _close=false;
        }
    });

    /*$("#cart_check .remarkBox .remarkArea textarea")[0].oninput=function () {
        var _value=$(this).val();

        $(".remarkBox .textInfo").attr("data_val",_value);
        // console.log($(".remarkBox .textInfo").attr("data_val"));
    };*/
    $('#cart_check .remarkBox .remarkArea textarea').on('input propertychange', function() {
        var that = $(this),
            _val = that.val();
        if (_val.length > 100) {
            that.val(_val.substring(0, 100));
        }
    });

    count_buy_total();
    //count_buy_total(1);
    isSelect();
    /*编辑按钮点击事件开始*/
    $(".j-edit-cur").click(function () {
        var deal_json_key='dealkey_161010493611354';
        var $this=$(this);
        var curBtn=$this.text();
        var $parents=$this.parent().parent().parent();

        if(curBtn=="编辑"){
            $parents.find(".m-cart-list li .z-opera-sure").hide();
            $parents.find(".m-cart-list li .z-opera-edit").addClass("active");
            $this.text("完成");
            isSelect();
        }else if(curBtn=="完成"){
            $parents.find(".m-cart-list li .z-opera-sure").show();
            $parents.find(".m-cart-list li .z-opera-edit").removeClass('active');
            $this.text("编辑");
            isSelect();
        }
    });

    $(".j-edit-all").click(function () {
        var allBtn= $(this).text();
        if(allBtn=="编辑全部"){
            var accnum=$(".m-conBox .j-select-body").find("input[type=checkbox]:checked").length;
            $(".m-cart-list li .z-opera-sure").hide();
            $(".m-cart-list li .z-opera-edit").addClass("active");
            $(".j-del-order").show().text("删除("+accnum+")");
            $(".allCount").hide();
            $(".j-accounts").hide();
            $(".j-edit-cur").hide();
            isSelect();
            $(this).text("完成");
        }else if(allBtn=="完成"){
            var accnum=$(".m-conBox .j-select-body").find("input[type=checkbox]:checked").length;
            $(".m-cart-list li .z-opera-sure").show();
            $(".m-cart-list li .z-opera-edit").removeClass('active');
            $(this).text("编辑全部");
            $(".j-del-order").hide();
            $(".allCount").show();
            $(".j-edit-cur").show().text("编辑");
            $(".j-accounts").show().text("结算("+accnum+")");
            isSelect();
        }
    });
    /*编辑按钮点击事件结束*/


    /*点击删除按钮*/

    $(document).on('click','.confirm-ok', function () {
        var _this=$(this);
        var _parent=$(_this).parents(".j-select-body");
        var parents=$(_this).parents(".j-conBox");
        $.confirm('确定要删除这个宝贝吗？', function () {

            var query = new Object();
            var id = parseInt($(_this).parents("li").attr("data-id"));
            var ids = new Array();
            ids.push(id);
            query.act='clear_deal_cart';
            query.id = ids;
            $.ajax({
                url:CART_URL,
                data:query,
                type:"post",
                dataType:"json",
                success:function(data){
                    if(data.status==-1)
                    {
                        location.href=data.jump;
                    }else if(data.status==1)
                    {
                        _this.parents("li").remove();
                        var accn=$(".m-conBox .j-select-body").find("input[type=checkbox]:checked").length;
                        $(".j-del-order").text("删除("+accn+")");

                        var childLen=_parent.find("li").length;
                        if(childLen==0){
                            parents.remove();
                        }
                        var count=isSelect();
                        if(count==0){
                            location.reload();
                        }
                    }else{
                        $.alert(data.info);
                    }
                }
                ,error:function(){
                }
            });


        });
    });

    /*点击全删除按钮*/


    /*点击删除全部按钮*/
    $(document).on('click','.j-del-order', function () {
        var _this=$(this);
        $.confirm('确定要删除所选宝贝吗？', function () {
            var checkBox=$(".m-conBox").find("input[type=checkbox]:checked");
            if(checkBox.length==0){
                $.confirm('没有选择宝贝');
            }

            var query = new Object();
            var ids = new Array();
            var checked_box = $(".m-cart-list").find("input[type=checkbox]:checked");
            checked_box.each(function(){
                var id = parseInt($(this).parents("li").attr("data-id"));
                ids.push(id);
            });

            query.act='clear_deal_cart';
            query.id = ids;
            $.ajax({
                url:CART_URL,
                data:query,
                type:"post",
                dataType:"json",
                success:function(data){
                    if(data.status==-1)
                    {
                        location.href=data.jump;
                    }else if(data.status==1)
                    {

                        checkBox.parent().parent().remove();
                        $(".j-del-order").text("删除(0)");
                        var count=isSelect();
                        $(".j-select-all label input[type=checkbox]").prop("checked",false);
                        if(count==0){
                            location.reload();
                        }
                    }else{
                        $.alert(data.info);
                    }
                }
                ,error:function(){
                }
            });





        });
    });
    /*点击删除全部按钮*/



    /*返回按钮*/
    /*
     $(document).on('click','.j-sure-cancel', function () {
     var _this=$(this);
     $.confirm('您确定要取消订单吗？', function () {
     window.history.back(-1);
     });
     });
     */
    $(document).off('click', '.j-sure-cancel');
    $(document).on("click",".j-sure-cancel",function(){
        var _this=$(this);
        $(this).removeClass('j-sure-cancel');
        $.confirm('您确定要取消订单吗？', function () {
        	$(_this).addClass('j-sure-cancel');
        	if(app_index=='app'){
        		App.page_finsh();
        	}else{
        		$.router.back();
        	}
        	
        	//$.router.load('#cart');
        },function(){
        	 $(_this).addClass('j-sure-cancel');
        });
    });


    /*输入框加减按钮*/
    $(".u-add").click(function () {
        var val=parseInt($(this).parent().find(".u-txt").val());
        var id=parseInt($(this).parent().find(".u-txt").attr("deal-id"));
        var max=parseInt($(this).parent().find(".u-txt").attr("max"));
        var user_max=parseInt($(this).parent().find(".u-txt").attr("user_max_bought"));
        //var user_min=parseInt($(this).parent().find(".u-txt").attr("user_min_bought"));
        val++;
        var num=$(".u-txt[deal-id='"+id+"']").length;
        if(val>max && max!=-1){
            val=max;
        }

        if(num==1){
            if((max>user_max && max!=-1) || (max==-1)){
                if(user_max>0 && val>user_max){
                    val=user_max;
                    $.alert("该商品最多还能购买"+user_max+"件");
                }
            }
        }else{
            var allval=0;
            $(".u-txt[deal-id='"+id+"']").each(function(){
                allval+=parseInt($(this).val());
            });
            if(user_max>0 && allval>=user_max){
                $.alert("该商品最多还能购买"+user_max+"件");
                if(val>1){
                    val=val-1;
                }
            }
            if(val>max && max!=-1){
                $.alert("库存不足");
                val=max;
            }
        }

        $(this).parent().find(".u-txt").val(val);
        $(this).parents(".item-inner").find(".j-count-num").text(val);
        isSelect();
    });
    $(".u-reduce").click(function () {
        var val=$(this).parent().find(".u-txt").val();
        var user_min=parseInt($(this).parent().find(".u-txt").attr("user_min_bought"));
        var id=parseInt($(this).parent().find(".u-txt").attr("deal-id"));
        var num=$(".u-txt[deal-id='"+id+"']").length;
        val--;
        /*if(num==1){
         if(user_min>0 && val<user_min){
         val=user_min;
         alert("该商品最小购买量为"+user_min);
         }
         }else{
         var allval=0;
         $(".u-txt[deal-id='"+id+"']").each(function(){
         allval+=parseInt($(this).val());
         });
         if(user_min>0 && allval<=user_min){
         alert("该商品最小购买量为"+user_min);
         val=val+1;
         }
         }*/
        if(val<1){
            val=1;
        }
        $(this).parents(".item-inner").find(".j-count-num").text(val);
        $(this).parent().find(".u-txt").val(val);
        isSelect();
    });
    /*改变编辑框数量*/
    $(".u-txt").blur(function () {
        var val=parseInt($(this).parent().find(".u-txt").val());
        var max=parseInt($(this).parent().find(".u-txt").attr("max"));
        var user_min=parseInt($(this).parent().find(".u-txt").attr("user_min_bought"));
        var user_max=parseInt($(this).parent().find(".u-txt").attr("user_max_bought"));
        var id=parseInt($(this).parent().find(".u-txt").attr("deal-id"));
        var num=$(".u-txt[deal-id='"+id+"']").length;

        if(val>0){
            if(num==1){
                if(user_max>0 && val>user_max){
                    if( (user_max<max && max!=-1) || (max==-1)){
                        val=user_max;
                        $.alert("该商品最多还能购买"+user_max+"件");
                    }

                }/*else if(user_min>0 && val<user_min){
                 val=user_min;
                 alert("该商品最小购买量为"+user_min);
                 }*/else{
                    if(val>max){
                        val=max;
                        $.alert("该商品库存不足");
                    }else{
                        val=val;
                    }
                }
            }else{
                var allval=0;

                $(".u-txt[deal-id='"+id+"']").each(function(){
                    allval+=parseInt($(this).val());
                });
                var elseval=allval-val;
                if(user_max>0 && allval>=user_max){
                    $.alert("该商品最多还能购买"+user_max+"件");
                    val=user_max-elseval;
                }/*else if(user_min>0 && allval<=user_min){
                 alert("该商品最小购买量为"+user_min);
                 val=user_min-elseval;
                 }*/
                if(val>max){
                    val=max;
                    $.alert("该商品库存不足");
                }else{
                    val=val;
                }

            }
        }else{
            /*if(user_min>0){
             val=user_min;
             }else{*/
            val=1;
            /*}*/
            $.alert("请输入有效数字");
        }
        $(this).parent().find(".u-txt").val(val);
        $(this).parents(".item-inner").find(".j-count-num").text(val);
        isSelect();
    });



    /*点击清空按钮*/
    $(document).on('click','.j-clear-all', function () {
        var _this=$(this);
        $.confirm('您确定要清空失效商品吗？', function () {
            var disable_id = new Array();
            $(".m-invalid .m-cart-list .item-content").each(function(i,obj){
                disable_id.push($(obj).attr("data-id"));
            });
            var query = new Object();
            query.act='clear_deal_cart';
            query.id = disable_id;
            $.ajax({
                url:CART_URL,
                data:query,
                type:"post",
                dataType:"json",
                success:function(data){
                    if(data.status==-1)
                    {
                        location.href=data.jump;
                    }else if(data.status==1)
                    {
                        _this.parents(".m-invalid").remove();
                    }else{
                        $.alert(data.info);
                    }
                }
                ,error:function(){
                }
            });

        });
    });


    /*全选按钮点击事件*/
    $(".j-select-all label input[type=checkbox]").change(function () {
        if($(this).attr('checked')==false){
            //如果全选按钮没有选中，则列表的中的按钮也全部是未选中状态
            $(".m-cart").find("label input[type=checkbox]").prop("checked",false);
        }else {
            //如果全选按钮选中，则列表的中的按钮也全部是选中状态
            $(".m-cart").find("label input[type=checkbox]").prop("checked",true);
        }
        isSelect();
    });



    /*列表中头部checkbox按钮点击事件开始*/

    $(".j-select-title input[type=checkbox]").change(function () {
        if($(this).is(':checked')==false){
            $(this).parents(".m-conBox").find(".m-cart-list label input[type=checkbox]").prop("checked",false);
        }else {
            $(this).parents(".m-conBox").find(".m-cart-list label input[type=checkbox]").prop("checked",true);
        }
        isSelect();
        var accn=$(".m-conBox .j-select-body").find("input[type=checkbox]:checked").length;
        $(".j-del-order").text("删除("+accn+")");
        $(".j-accounts").text("结算("+accn+")");

    });
    /*列表中头部checkbox按钮点击事件结束*/

    /*宝贝列表单个checkbox点击事件开始*/
    $(".j-select-body input[type=checkbox]").change(function () {
        isSelect();

        var _samePar=$(this).parents(".m-cart-list").find("input[type=checkbox]");
        var _len=_samePar.length;
        _samePar.each(function () {
            var anum=$(this).parents(".m-cart-list").find("input[type=checkbox]:checked").length;

            if(anum<_len){
                $(this).parents(".m-conBox").find(".j-select-title input[type=checkbox]").prop("checked",false);
            }else {
                $(this).parents(".m-conBox").find(".j-select-title input[type=checkbox]").prop("checked",true);
            }
        });

    });
    /*宝贝列表单个checkbox点击事件接结束*/

    /*判断是否全部选中*/
    function isSelect() {
        var _checkbox=$(".m-cart-list label input[type=checkbox]");
        var _radio=$(".m-cart-list label input[type=checkbox]:checked");

        var _lenght=_checkbox.length;

        _checkbox.each(function () {
            var a=$(".m-cart-list label input[type=checkbox]:checked").length;
            if(a<_lenght){
                $(".j-select-all label input[type=checkbox]").prop("checked",false);
            }else {
                $(".j-select-all label input[type=checkbox]").prop("checked",true);
            }
        });

        var allprice = 0;
        var promote_price = 0;
        var promote_count = 0;
        var select_count = 0;
        _radio.each(function () {
            var data_price=parseFloat($(this).parents("li").find(".u-money").attr("data_value"));
            var data_num=parseInt($(this).parents("li").find(".j-count-num").text());
            var allow_promote = parseInt($(this).parents("li").attr("allow_promote"));
            select_count++;
            var account=data_num*data_price;
            allprice+=account;
            if(allow_promote==1){
                promote_price+=account;
                promote_count++;
            }
        });


        if(typeof(promote_cfg)!='undefined'){
            if(promote_cfg && promote_count==select_count){
                var all_promote_price=0;
                for(var i=0;i<promote_cfg.length;i++){
                    if(promote_price >= parseInt(promote_cfg[i]['discount_limit'])){
                        allprice -= parseInt(promote_cfg[i]['discount_amount']);
                        all_promote_price+=parseInt(promote_cfg[i]['discount_amount']);
                    }
                }
                $("#promote_price").html("¥"+all_promote_price);
            }else{
                $("#promote_price").html("¥0");
            }
        }
        allprice = allprice.toFixed(2);
        var priceStr=allprice.toString();
        if(priceStr.indexOf(".") > 0 ){
            var price_split=priceStr.split(".");
            $(".j-price-int").text(price_split[0]);
            $(".j-price-piont").text(price_split[1]);
        }else {
            $(".j-price-int").text(priceStr);
            $(".j-price-piont").text("00");
        }


        var accn=$(".m-conBox .j-select-body").find("input[type=checkbox]:checked").length;
        var allaccn=$(".m-conBox .j-select-body").find("input[type=checkbox]").length;
        $(".j-del-order").text("删除("+accn+")");
        $(".j-accounts").text("结算("+accn+")");
        if(accn==0){
            $(".j-accounts").addClass("invalid");
            /*if(index){
             location.reload();
             }*/
        }else{
            $(".j-accounts").removeClass("invalid");
        }
        return allaccn;
    }



    $(document).on('click',".j-accounts",function(){
        var _this=$(this);
        var _radio=$(".m-cart-list label input[type=checkbox]");
        var checked_ids = new Array();
        var nochecked_ids = new Array();
        $(_radio).each(function(){
            var id = $(this).parents("li").attr("data-id");
            var attr = $(this).parents("li").find(".sizes").attr("attr_key");
            var attr_str = $(this).parents("li").find(".sizes").attr("attr_str");
            var number = parseInt($(this).parents("li").find(".j-count-num").text());
            var cart_item = new Object();
            cart_item.id = id;
            cart_item.attr = attr;
            cart_item.attr_str = attr_str;
            cart_item.number = number;
            if($(this).is(":checked")){
                checked_ids.push(cart_item);
            }else{
                nochecked_ids.push(cart_item);
            }

        });
        var disable_raido = $(".m-invalid .m-cart-list li");
        $(disable_raido).each(function(){ //失效商品
            var id = parseInt($(this).attr("data-id"));
            var cart_item = new Object();
            cart_item.id = id;
            nochecked_ids.push(cart_item);
        });

        //console.log(nochecked_ids);return false;
        if(checked_ids.length==0){
            return false;
        }

        var query = new Object();
        query.act='set_cart_status';
        query.checked_ids = checked_ids;
        query.nochecked_ids = nochecked_ids;

        $.ajax({
            url:CART_URL,
            data:query,
            type:"post",
            dataType:"json",
            success:function(data){
                if(data.status==-1)
                {
                    $.toast(data.info);
                    window.setTimeout(function(){
                        location.href=data.jump;
                    },1000);

                }else if(data.status==1)
                {
                    location.href = cart_check_url;

                }else{
                    $.alert(data.info);
                }
            }
            ,error:function(){
            }
        });


    });



    /*提交订单选择配送方式点击事件*/
    var _hei=$(".j-trans-way").height();
    var _rehei=$(".j-red-reward").height();
    $(".popup-box .j-trans-way").css({"bottom":-_hei});
    $(".popup-box .j-red-reward").css({"bottom":-_rehei});
    var _bhei=$(".pup-box-bg").height();


    $(document).on('click',".j-cancel",function () {
        popupTransition();
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },300);
    });


    $(document).on('click',".j-trans",function () {
    	//var index = $(".j-trans").index($(this));
        $(".totop").addClass("vible");
        $(".popup-box .j-red-reward").css({"bottom":-_rehei});
        $(".popup-box").css({"transition":"all 0.3s linear","opacity":"1","z-index":"9999"});
        $(".popup-box .j-trans-way").css({"transition":"bottom 0.3s linear","bottom":"0"});
        $(".popup-box .pup-box-bg").css({"transition":"opacity 0.3s linear","opacity":"0.6"});

        $(".j-trans-way").find(".j-trans-list").hide();
        $(".j-trans-way").find(".j-trans-list[data-id='"+$(this).attr("data-id")+"']").show();

    });
    $(document).on('click',".j-reward",function () {
        $(".totop").addClass("vible");
        $(".popup-box .j-trans-way").css({"bottom":-_hei});
        $(".popup-box").css({"transition":"all 0.3s linear","opacity":"1","z-index":"9999"});
        $(".popup-box .j-red-reward").css({"transition":"bottom 0.3s linear","bottom":"0"});
        $(".popup-box .pup-box-bg").css({"transition":"opacity 0.3s linear","opacity":"0.6"});
    });


    /*弹出层动画效果*/
    function popupTransition() {
        /* $(".j-cancel").parents(".m-trans-way").css({"transition":"bottom 0.3s linear","bottom":-_hei});*/
        $(".popup-box .j-trans-way").css({"transition":"bottom 0.3s linear","bottom":-_hei});
        $(".popup-box .j-red-reward").css({"transition":"bottom 0.3s linear","bottom":-_rehei});
        $(".j-cancel").parents(".popup-box").find(".pup-box-bg").css({"transition":"opacity 0.3s linear","opacity":"0"});
        $(".j-cancel").parents(".popup-box").css({"transition":"all 0.3s linear 0.3s","opacity":"0","z-index":"-1"});
    }
    /*弹出层动画效果*/

    /*弹出框点击事件*/
    function listCli(obj) {
        obj.click(function () {
            var lue_name=$(this).find(".pay-way-name .j-company-name").text();
            var lue_momey=$(this).find(".pay-way-name .j-company-money").text();
            var lue_reward=$(this).find(".pay-way-name").text();

            var parText=$(obj).parents(".m-trans-way").find(".u-ti").text();

            $(this).parents("ul").find("input").prop("checked",false);
            if(parText=="优惠券"){
            	var data_id=$(this).parents("ul").attr("data-id");
            	alert(data_id);
                $(this).find("input[name='youhui_log_id["+data_id+"]']").prop("checked",true);
                var money=$(this).find("input[name='youhui_log_id["+data_id+"]']").attr("money");
                //alert(is_pick);
                $(".j-trans .j-trans-commpany").find(".j-company-name").text("-"+money);

            }
            if(parText=="红包"){
                $(this).find("input[name='ecvsn']").prop("checked",true);
                $(".j-reward .j-reward-money").text(lue_reward);
            }
            setTimeout(function () {
                $(".totop").removeClass("vible");
            },500);
            popupTransition();
            count_buy_total();
        });
    }

    /*listCli($(".j-reward-list li"));
    listCli($(".j-trans-list li"));*/

    $(document).on('click',".j-trans-list li,.j-reward-list li",function () {

        var lue_name=$(this).find(".pay-way-name .j-company-name").text();
        var lue_momey=$(this).find(".pay-way-name .j-company-money").text();
        var lue_reward=$(this).find(".pay-way-name").text();

        var parText=$(this).parents(".m-trans-way").find(".u-ti").text();

        $(this).parents("ul").find("input[disabled=false]").prop("checked",false);
        if(parText=="优惠券"){
        	if($(this).find('input').attr("disabled")=="disabled"){
        		$.toast("该优惠券已选择，无法选择");
        		return false;
        	}
        	
        	var data_id=$(this).parents("ul").attr("data-id");

            var youhui_id=$(this).find("input[name='youhui_log_id["+data_id+"]']").val();

        	if (data_id=='p_wl'){
        		var p_yz_youhui=$("input[name='youhui_log_id[p_yz]']:checked").val();
        		if(p_yz_youhui==youhui_id && youhui_id!=0){

        			return false;
        		}
        		else{
        			$(".j-trans-way ul[data-id='p_yz']").find("input[disabled='disabled']").prop("checked",false);
        			$(".j-trans-way ul[data-id='p_yz']").find("input[disabled='disabled']").parent().find(".icon-form-checkbox").removeClass("disabled-checked");
        			$(".j-trans-way ul[data-id='p_yz']").find("input:not([value='"+youhui_id+"'])").removeAttr("disabled");
        			if(youhui_id!=0){
	        			$(".j-trans-way ul[data-id='p_yz']").find("input[value='"+youhui_id+"']").attr("disabled","disabled");
	        			//$(".j-trans-way ul[data-id='p_yz']").find("input[value='"+youhui_id+"']").prop("checked",true);
	        			$(".j-trans-way ul[data-id='p_yz']").find("input[value='"+youhui_id+"']").parent().find(".icon-form-checkbox").addClass("disabled-checked");
        			}
        		}
        	}
            else if(data_id=='p_yz'){
            	var p_wl_youhui=$("input[name='youhui_log_id[p_wl]']:checked").val();
            	if(p_wl_youhui==youhui_id && youhui_id!=0){

        			return false;
        		}
        		else{
        			$(".j-trans-way ul[data-id='p_wl']").find("input[disabled='disabled']").prop("checked",false);
        			$(".j-trans-way ul[data-id='p_wl']").find("input[disabled='disabled']").parent().find(".icon-form-checkbox").removeClass("disabled-checked");
        			$(".j-trans-way ul[data-id='p_wl']").find("input:not([value='"+youhui_id+"'])").removeAttr("disabled");
        			if(youhui_id!=0){
	        			$(".j-trans-way ul[data-id='p_wl']").find("input[value='"+youhui_id+"']").attr("disabled","disabled");
	        			//$(".j-trans-way ul[data-id='p_wl']").find("input[value='"+youhui_id+"']").prop("checked",true);
	        			$(".j-trans-way ul[data-id='p_wl']").find("input[value='"+youhui_id+"']").parent().find(".icon-form-checkbox").addClass("disabled-checked");
        			}
        		}

            }

            $(this).find("input[name='youhui_log_id["+data_id+"]']").prop("checked",true);


            var money=$(this).find("input[name='youhui_log_id["+data_id+"]']").attr("money");
            //alert(is_pick);
            if(money){
            	$(".j-trans[data-id='"+data_id+"'] .j-trans-commpany").find(".j-company-money").text("-￥"+money);
            	$(".j-trans[data-id='"+data_id+"'] .j-trans-commpany").find(".j-company-money").css("color","red");
            }else{
            	$(".j-trans[data-id='"+data_id+"'] .j-trans-commpany").find(".j-company-money").text("不使用优惠券");
            	$(".j-trans[data-id='"+data_id+"'] .j-trans-commpany").find(".j-company-money").css("color","#5f646e");
            }

        }
        if(parText=="红包"){
        	if($(this).find('input').attr("disabled")=="disabled"){
        		$.toast("应付金额已为零");
        		return false;
        	}
        	
            $(this).find("input[name='ecvsn']").prop("checked",true);
            $(".j-reward .j-reward-money").text(lue_reward);
        }
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },500);
        popupTransition();
        count_buy_total();
    });




    /*弹层开始*/
    $(".choose-list .j-choose").click(function(){
        $(this).siblings(".j-choose").removeClass("active");
        $(this).addClass("active");
        setSpecgood();
        var data_value= $(".j-choose.active").attr("data-value");
        var data_value = []; // 定义一个空数组
        var txt = $('.j-choose.active'); // 获取所有文本框
        for (var i = 0; i < txt.length; i++) {
            data_value.push(txt.eq(i).attr("data-value")); // 将文本框的值添加到数组中
        }
        $(".good-specifications span").empty();
        $(".good-specifications span").addClass("isChoose");
        $(".good-specifications span").append("已选规格：");
        $.each(data_value,function(i){
            $(".good-specifications span").append("<em class='tochooseda'>" + data_value[i] + "</em>");
            //传值可以考虑更改这里
            $(".spec-data").attr("data-value"+[i],data_value[i]);
        });
    });


    $(document).on('click',".j-box-bg",function () {
        popupTransition();
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },300);
    });




    $(".j-open-choose").bind("click",open_choose);
    function open_choose(){
        var $this=$(this);
        $(this).unbind("click");
        $this.parents("li").addClass("choose");
        //调用属性HTML
        var id =  $this.parents("li").attr("data-id");
        var attr_key = $this.parents("li").find(".sizes").attr("attr_key");
        var query = new Object();
        query.act='get_cart_deal_attr';
        query.id = id;
        query.attr_key = attr_key;
        $.ajax({
            url:CART_URL,
            data:query,
            type:"post",
            dataType:"json",
            success:function(data){
                if(data.status==-1)
                {
                    location.href=data.jump;
                }else if(data.status==1)
                {
                    $(".page-current").append(data.html);
                    set_attr_name();
                    $(".flippedout .choose-list .j-choose").click(function(){
                        if(!$(this).hasClass("active")){
                            $(this).siblings(".j-choose").removeClass("active");
                            $(this).addClass("active");
                            set_attr_name();
                        }
                    });


                    $(".j-spec-choose-close,.j-flippedout-close,.j-cancel-flip").click(function(){
                        cssAnition();
                    });

                    $(".j-nowbuy").click(function () {
                        if($(this).attr('max') && $(this).attr('max')==0){
                            $.alert("库存不足");
                        }else{
                            if($this.parents("li").hasClass("choose")){
                                $this.parents("li").removeClass("choose");
                            }

                            var attr_check_ids = new Array();
                            var attr_name = '';
                            $(".showflipped .spec-info .j-choose.active").each(function(i,obj){
                                attr_name+=$(obj).text();
                                attr_check_ids.push($(obj).attr("data-id"));
                            });

                            if(attr_check_ids.length==attr_num){

                                var attr_checked_ids = attr_check_ids.join(",");
                                //同步属性
                                $this.parents("li").find(".sizes").attr({'attr_key':attr_checked_ids,'attr_str':attr_name}).text("规格:"+attr_name);

                                //同步值
                                if(parseInt($(this).attr('max')) != 99999){

                                    $(".item-content[data-id='"+id+"']").find("input[type=text]").attr("max",$(this).attr('max'));
                                    $(".item-content[data-id='"+id+"']").find(".u-surplus").html("仅剩"+$(this).attr('max')+"件");
                                    $val=$(".item-content[data-id='"+id+"']").find("input[type=text]").val();
                                    var $val=parseInt($val);
                                    var $max=parseInt($(this).attr('max'));
                                    if($val>$max){
                                        $(".item-content[data-id='"+id+"']").find("input[type=text]").val($max);
                                        $(".item-content[data-id='"+id+"']").find(".j-count-num").text($max);
                                        isSelect();
                                    }
                                }else{

                                    $(".item-content[data-id='"+id+"']").find("input[type=text]").attr("max",$(this).attr('max'));
                                    $(".item-content[data-id='"+id+"']").find(".u-surplus").html("");
                                    $val=$(".item-content[data-id='"+id+"']").find("input[type=text]").val();
                                }

                                //同步价格
                                var num=parseFloat($(".showflipped .spec-goodprice").attr("data_value"));
                                num = Math.round(num*100)/100;  //保留两位小数
                                num =Number(num).toFixed(2);  //保留两位小数
                                var num_arr = num.split('.');
                                var price_str='¥ <i class="j-goods-money">'+num_arr[0]+'.</i>'+num_arr[1];
                                $this.parents("li").find(".u-money").attr("data_value",num).html(price_str);

                                cssAnition();
                            }else{
                                $.alert("请选择属性");
                            }
                        }
                    });

                }else{
                    $.alert(data.info);
                }
            }
            ,error:function(){
            }
        });
    }

    function set_attr_name(){
        var attr_name='';
        var attr_check_ids = new Array();
        var attr_check_key='';
        $(".showflipped .spec-info .j-choose.active").each(function(i,obj){
            attr_name+='&nbsp;&nbsp;'+$(obj).text();
            attr_check_ids.push($(obj).attr("data-id"));
        });

        var attr_check_ids_new = attr_check_ids.sort();
        attr_check_key=attr_check_ids_new.join("_");
        if(deal_attr_stock_json[attr_check_key]){
            var stock = deal_attr_stock_json[attr_check_key]['stock_cfg'];
            if(parseInt(stock)<0){
                stock = 99999;
            }
        }else{
            var stock = 99999;
        }
        $(".spec-goodspec").empty();
        $(".spec-goodspec").append("已选择");
        //$(".spec-goodspec em").html(attr_name);
        $(".spec-goodspec").append("<em class='choose_item'>" + attr_name + "</em>");
        $(".spec-goodstock").text("库存:"+stock+"件");
        $(".j-nowbuy").attr("max",stock);
        //deal_current_price
        var deal_price = deal_current_price;
        $.each(deal_attr_json,function(i,obj){
            $.each(obj['attr_list'],function(xi,xobj){
                if($.inArray(xobj.id,attr_check_ids_new) >= 0){

                    deal_price += parseFloat(xobj.price);
                }
            });

        });

        $(".spec-goodprice").attr("data_value",parseFloat(deal_price)).html("¥"+parseFloat(deal_price));

    }


    function cssAnition() {
        $(".flippedout").removeClass("z-open");
        $(".spec-choose").removeClass("z-open");
        $(".j-flippedout-close").removeClass("showflipped");
        $(".j-open-choose").bind("click",open_choose);
        setTimeout("$('.flippedout').removeClass('showflipped')",300);
    }


    function count_buy_total()
    {
        ajaxing = true;
        var query = new Object();

        //获取配送方式
        var delivery_id = $("input[name='delivery']:checked").val();

        if(!delivery_id)
        {
            delivery_id = 0;
        }
        query.delivery_id = delivery_id;

        var address_id = $("input[name='address_id']").val();

        //全额支付
        if($("input[name='all_account_money']").attr("checked"))
        {
            query.all_account_money = 1;
        }
        else
        {
            query.all_account_money = 0;
        }
		//积分抵现
		if($('input[name="all_score"]:checked').length>0)
		{
			query.all_score = 1;
		}
		else
		{
			query.all_score = 0;
		}

		//优惠券
		var youhui =new Object();
		$(".j-trans-way ul").each(function(){
			var data_id=$(this).attr("data-id");
			youhui[data_id]=$("input[name='youhui_log_id["+data_id+"]']:checked").val();

		});
		query.youhui_ids = youhui;

        //代金券
        var ecvsn = $("input[name='ecvsn']:checked").val();

        if(!ecvsn)
        {
            ecvsn = '';
        }

        var ecvpassword = $("input[name='ecvpassword']").val();
        if(!ecvpassword)
        {
            ecvpassword = '';
        }

        var id = $("input[name='id']").val();
        var buy_type = $("input[name='buy_type']").val();
        query.ecvsn = ecvsn;
        query.ecvpassword = ecvpassword;
        query.address_id = address_id;
        query.id = id;
        query.buy_type = buy_type;
        //支付方式
        var payment = $("input[name='payment']:checked").val();
        if(!payment)
        {
            payment = 0;
        }
        query.payment = payment;
        query.bank_id = $("input[name='payment']:checked").attr("rel");
        query.order_id = order_id;
        //query.reward = reward;
        query.act = "count_buy_total";
        $.ajax({
            url: AJAX_URL,
            data:query,
            type: "POST",
            dataType: "json",
            success: function(data){
                //alert(1111);
                /*if(data.free && delivery_id!=-1){
                 $(".j-company-money").html("运费：0");
                 }*/
            	//console.log(data);
                if(data.total_price==0 && $('div').is('.voucher_box')){
                    $(".voucher_box").remove();
                    count_buy_total();
                }
                /*if(reward==1){*/
                $("#cart_total").html(data.html);
                $(".total_price_box").html(data.pay_price_html);
                ajaxing = false;
				if($('input[name="all_score"]').length){
					$("input[name='all_score']").unbind('change');
					$("input[name='all_score']").bind("change",function () {
						count_buy_total();
					});
				}

				if(data.ecv_no_use_status==1 && $('.voucher_box')){
                    $(".j-red-reward").find("input[name='ecvsn']").prop("checked",false);
                    $(".j-red-reward").find("input:not([value='0'])").attr("disabled",'disabled');
                    $(".j-red-reward").find("input:not([value='0'])").parent().find(".icon-form-checkbox").addClass("disabled-checked");
                    $(".j-red-reward").find("input[value='0']").prop("checked",true);
                    $(".j-reward .j-reward-money").text("不使用红包");
                }else{
                	$(".j-red-reward").find("input[name='ecvsn']").removeAttr("disabled");
                	$(".j-red-reward").find("input[name='ecvsn']").parent().find(".icon-form-checkbox").removeClass("disabled-checked");
                }
				
                /*}else{
                 var ecv_money = parseFloat($("input[name='ecvsn']:checked").attr("money"));
                 var pay_moeny = parseFloat(data);
                 if(pay_moeny<ecv_money){
                 //$("div.j-reward-money").html("不使用红包");
                 var now_ecv=0;
                 $(".j-reward-list li").each(function(){
                 var this_money=parseFloat($(this).find("input[name='ecvsn']").attr("money"));
                 if(pay_moeny<this_money){
                 $(this).remove();
                 }else{
                 if(this_money>now_ecv){
                 now_ecv=this_money;
                 }
                 }
                 });
                 now_ecv=parseFloat(now_ecv);
                 $(".j-reward-list li").each(function(){
                 var this_money=parseFloat($(this).find("input[name='ecvsn']").attr("money"));
                 if(this_money==now_ecv){
                 $(".j-reward-list").find("input[name='ecvsn']").removeAttr("checked");   ;
                 $(this).find("input[name='ecvsn']").attr("checked","checked");
                 $("div.j-reward-money").html($(this).find(".pay-way-name").html());
                 }
                 });
                 }*/
                //count_buy_total(1);
                //}
            },
            error:function(ajaxobj)
            {
//    			if(ajaxobj.responseText!='')
//    			alert(LANG['REFRESH_TOO_FAST']);
            }
        });
    }
    //预售支付
    $(".j-presell").on('click', function() {
        $.modal({
              text: '预售商品，定金不退！ 确认继续下单？',
              buttons: [
                {
                  text: '再想想',
                  onClick: function() {
                    $.alert('再想想')
                  }
                },
                {
                  text: '继续支付',
                  onClick: function() {
                    $.alert('继续支付')
                  }
                },
              ]
            });
    });
    var pay_lock = false;
    $(".go_pay").click(function() {
        if (pay_lock) {
            return;
        }

        // 发票内容完整性确认
        var ivo_check = invoice_check();
        if (!ivo_check) {
            $.toast('请完善发票内容');
            return false;
        }

		$.showIndicator();
        pay_lock = true;
        var query = $("#pay_box").serialize();
        var url = $("#pay_box").attr("action");

        $.ajax({
            url: url,
            data:query,
            type: "POST",
            dataType: "json",
            success: function(data){
				$.hideIndicator();
                if(data.status==1) {
                    pay_lock = false;
                    //先留着，后期有用
//                    if(app_index=='app'){
//                    	App.app_detail(data.type,'{"id":'+data.id+'}');
//                    }else{
//                    	$.router.load(data.jump, true);
//                    }
                    $.router.load(data.jump, true);
                    
                } else if (data.status == -2) {
                    $.toast(data.info);
                    setTimeout(function() {
                        pay_lock = false;
                        $.router.load(data.jump, true);
                    }, 2000);
                } else {
                    pay_lock = false;
                    $.alert(data.info);
                }

                ajaxing = false;
            },
            error:function(ajaxobj) {
				$.hideIndicator();

            }
        });

    });


    function invoice_check() {
        // 如果开票判断是否选择发票须知
        $status = true;
        // 判断每个发票填充的内容是否合法
        $('div.invoice-type').each(function(index, elm) {
            var type = $(elm).find('input').val();
            type = parseInt(type);
            if (type !== 0) {
                var title = $.trim($(elm).parent().find('.invoice-title').val());
                if (title === '') {
                    $status = false;
                    return false;
                }
                if (type === 2) {
                    var taxnu = $.trim($(elm).parent().find('.invoice-taxnu').val());
                    if (taxnu === '') {
                        $status = false;
                        return false;
                    }
                }
            }
        });
        return $status;
    }
});
$(document).on("pageInit", "#cate", function(e, pageId, $page) {
	var active_length=$(".cate-list li.active").length;
	if(active_length==0){
		$(".cate-list li").eq(0).addClass('active');
		$(".cate-info ul").eq(0).addClass('active');
	}
	$(".cate-list li").click(function() {
		$(".cate-list li").removeClass('active');
		$(".cate-info ul").removeClass('active');
		$(this).addClass('active');
		$(".cate-info ul").eq($(this).index()).addClass('active');
	});;
});

/**
 * Created by Administrator on 2016/11/28.
 */
$(document).on("pageInit", "#changepassword", function(e, pageId, $page) {
    $(".userBtn-yellow").click(function () {
        $("#ph_getpassword").submit();
    });


    $("#ph_getpassword").bind("submit",function(){
        var mobile = $.trim($(this).find("input[name='user_mobile']").val());
        var user_pwd = $.trim($(this).find("input[name='user_pwd']").val());
        var sms_verify = $.trim($(this).find("input[name='sms_verify']").val());

        if(mobile=="")
        {
            $.toast("请输入手机号");
            return false;
        }
        if(user_pwd=="")
        {
            $.toast("请输入密码");
            return false;
        }
        if (user_pwd.length < 4) {
            $.toast('密码过短');
            return false;
        }
        if(sms_verify=="")
        {
            $.toast("请输入收到的验证码");
            return false;
        }

        var query = $(this).serialize();
        var ajax_url = $(this).attr("action");
        $.ajax({
            url:ajax_url,
            data:query,
            type:"POST",
            dataType:"json",
            success:function(obj){
                if(obj.status) {
                    // 先清理当前页的信息
                    //$('input[name=sms_verify]').val('');
                    //$('#btn').attr('lesstime', 0);

                    // 执行跳转
                    // $.alert(obj.info,function(){
                    // 	location.href = obj.jump;
                    // });
                    // 转弱提示跳转
                    $.toast(obj.info);
                    setTimeout(function() {
                        $.router.load(obj.jump);
                    }, 1500);
                } else {
                    $.toast(obj.info);
                }
            }
        });

        return false;
    });
});
/**
 * Created by Administrator on 2016/11/28.
 */
$(document).on("pageInit", "#changeuname", function(e, pageId, $page) {
    $(".userBtn-yellow").click(function () {
        $("#ph_getuname").submit();
    });


    $("#ph_getuname").bind("submit",function(){
        var user_name = $.trim($(this).find("input[name='user_name']").val());
        if(user_name=="")
        {
            $.toast("请输入昵称");
            return false;
        }
        
        //获取字符长度（包括中文）
        var name_len = getByteLen(user_name);
        if (name_len < 4) {
            $.toast('昵称过短');
            return false;
        }
        if(/\_/.test(user_name) == true){
        	$.toast('用户名不能使用下划线');
            return false;
        }
        var query = $(this).serialize();
        var ajax_url = $(this).attr("action");
        $.ajax({
            url:ajax_url,
            data:query,
            type:"POST",
            dataType:"json",
            success:function(obj){
                if(obj.status) {
                    // 转弱提示跳转
                    $.toast(obj.info);
                    setTimeout(function() {
                    	location.href = obj.jump;
                    }, 1500);
                } else {
                    $.toast(obj.info);
                }
            }
        });

        return false;
    });
    
    
    function getByteLen(val) { 
    	var len = 0; 
    	for (var i = 0; i < val.length; i++) { 
	    	if (val[i].match(/[^\x00-\xff]/ig) != null){
		    	len += 2; 
	    	} //全角 
	    	else{
		    	len += 1; 
	    	} 
    	} 
    	return len; 
    } 
    
});
$(document).on("pageInit", ".page", function(e, pageId, $page) {

	
	$('#search').keyup(function(){
		search_city();
	}).focus(function(){
		$('#search_result').show();
	});
	$("#search").blur(function(){
		setTimeout(function(){
	 		$('#search_result').hide();
		},"500");
	});
	$(".searchbar .searchbar-cancel").click(function(){
		$('.searchbar #search').val('');
	});
	
    $(document).off('click', '.city_change');
    $(document).on('click', '.city_change', function() {
		$.ajax({
			url: $(this).attr('url'),
			data: {},
			dataType: "json",
			type: "post",
			success: function(obj){
				$.router.load(obj.jump, true);
			}
		});
	});
	
});
function search_city(){
	var query = new Object();
	query.act = "searchcity";
	var kw=$.trim($('#search').val());
	query.kw=kw;
	//if(kw){
		$.ajax({
					url: CITY_URL,
					data: query,
					dataType: "json",
					type: "post",
					success: function(data){
							
						$('#search_result').remove();
						$('.searchbar').append(data.city.html);
						$('#search_result').show();
						
					}
		});
	//}


}
$(document).on("pageInit", "#dcorder_index", function(e, pageId, $page) {
	init_list_scroll_bottom();//下拉刷新加载
	//打开评论
	$(document).on('click', '.j-open-comment', function() {
		$(".img-comment-1").attr("src",$(this).parents('li').find(".img-comment").attr('src'));
		$(".name-comment-1").html($(this).parents('li').find(".name-comment").html());
		$("input[name='order_id_1']").val($(this).parents('li').find("input[name='order_id']").val());
		$("input[name='location_id_1']").val($(this).parents('li').find("input[name='location_id']").val());
		$.popup('.popup-comment');
	});
	//关闭当前弹层
	$(document).on('click', '.j-close-popup', function() {
	    $(this).parents('.popup').removeClass('modal-in').addClass('modal-out');
	});
	$(".comment-stars").on('click', '.j-point', function() {
		$(".j-point").removeClass('active');
		$(this).addClass('active');
		$(this).prevAll().addClass('active');
		$("#star-value").attr('value', $(this).attr('value'));
	});
	
	$('.order-edit-bar').on('click','.to-pay',function(){
		
		var url = $(this).attr('data_url');
		var jump_url = $(this).attr('jump_url');
		$.ajax({
			url:url,
			type:'post',
			dataType:'json',
			success:function(data){
				if(data.status == 1){
					location.href = jump_url;
				}else{
					$.toast(data.info);
				}
			}
		});
		
	});
	
	
	//发表评论
	$('.j-comment-sub').bind('click',function(){
		
    	var is_pass=1;
    	var dp_points=$("#star-value").val();
			if(dp_points==0){
				$.toast('请给出您宝贵的评分！');
				is_pass=0;
				return false;
			}
    	if(is_pass==1){

	    	if($("textarea[name='content']").val()==''){
	    		$.toast('请填写您的宝贵意见！');
	    		is_pass=0;
	    		return false;
	    	}
    	}
    		
		if(is_pass==0){
			return false;
		}


    	var url=$(this).attr('action');
    	
		var query = new Object();
		query.location_id = $("input[name='location_id_1']").val();
		query.order_id = $("input[name='order_id_1']").val();
		 
		query.dp_points=dp_points;

    	query.content = $("textarea[name='content']").val(); 
    	$.ajax({
			url:url,
			data:query,
			type:'post',
			dataType:'json', 
			success:function(data){
			
				if(data.status==1){
				$.showIndicator();
			      setTimeout(function () {
			    	  close_comment();
			      }, 2000);
					
				}else{
					$.toast(data.info);
				}
				
				function close_comment(){
					$.toast(data.info);
					$(".popup-comment").removeClass('modal-in').addClass('modal-out');
					$.hideIndicator();
					$(".j-point").removeClass('active');
					$("#star-value").attr('value', '');
					$("textarea[name='content']").val('');
					var AJAX_URL = data.jump;
					var is_ajax  = 1;
					$.ajax({
						url:AJAX_URL,
						data:{"is_ajax":is_ajax},
						type:'post',
						dataType:'json', 
						success:function(obj){
							$(".infinite-scroll-bottom").html(obj.html);
							init_list_scroll_bottom();//下拉刷新加载
						}
					});
				}
			}
    	});
    	   
          
    });
	
});
$(document).on("pageInit", "#dcorder_view", function(e, pageId, $page) {
	//打开评论
	$(document).on('click', '.j-open-comment', function() {
		$(".img-comment-1").attr("src",$(".img-comment").attr('src'));
		$(".name-comment-1").html($(".name-comment").html());
		$("input[name='order_id_1']").val($("input[name='order_id']").val());
		$("input[name='location_id_1']").val($("input[name='location_id']").val());
		$.popup('.popup-comment');
	});
	//关闭当前弹层
	$(document).on('click', '.j-close-popup', function() {
	    $(this).parents('.popup').removeClass('modal-in').addClass('modal-out');
	});
	$(".comment-stars").on('click', '.j-point', function() {
		$(".j-point").removeClass('active');
		$(this).addClass('active');
		$(this).prevAll().addClass('active');
		$("#star-value").attr('value', $(this).attr('value'));
	});
	
	
	//发表评论
	$('.j-comment-sub').bind('click',function(){
		
    	var is_pass=1;
    	var dp_points=$("#star-value").val();
			if(dp_points==0){
				$.toast('请给出您宝贵的评分！');
				is_pass=0;
				return false;
			}
    	if(is_pass==1){

	    	if($("textarea[name='content']").val()==''){
	    		$.toast('请填写您的宝贵意见！');
	    		is_pass=0;
	    		return false;
	    	}
    	}
    		
		if(is_pass==0){
			return false;
		}


    	var url=$(this).attr('action');
    	
		var query = new Object();
		query.location_id = $("input[name='location_id_1']").val();
		query.order_id = $("input[name='order_id_1']").val();
		 
		query.dp_points=dp_points;

    	query.content = $("textarea[name='content']").val(); 
    	$.ajax({
			url:url,
			data:query,
			type:'post',
			dataType:'json', 
			success:function(data){
			
				if(data.status==1){
//				$.showIndicator();
				$.toast(data.info);
			      setTimeout(function () {
			    	  close_comment();
			      }, 2000);
					
				}else{
					$.toast(data.info);
				}
				
				function close_comment(){
					location.reload(); 
					$(".popup-comment").removeClass('modal-in').addClass('modal-out');
					$.hideIndicator();
					$(".j-point").removeClass('active');
					$("#star-value").attr('value', '');
					$("textarea[name='content']").val('');
					
//					var AJAX_URL = data.jump;
//					var is_ajax  = 1;
//					$.ajax({
//						url:AJAX_URL,
//						data:{"is_ajax":is_ajax},
//						type:'post',
//						dataType:'json', 
//						success:function(obj){
//							$(".infinite-scroll-bottom").html(obj.html);
//							init_list_scroll_bottom();//下拉刷新加载
//						}
//					});
				}
			}
    	});
    	   
          
    });
	var lock = true;
	
	$(".dc-view-bar").on('click', '.j-cancle', function() {
		
		if(!lock){
			return;
		}else{
			lock = false;
			var url = $(this).attr('data_url');
			var query = new Object();
			//取消订单
			
			
			$.confirm('确定要取消订单吗？', function () {
		          $.ajax({
		        	  url:url,
		        	  type:'post',
		        	  dataType:'json',
		        	  success:function(data){
		        		  if(data.status == 1){
		        			  $.toast(data.info);
		        			  setTimeout(function () {
		        				  location.reload(); 
		    			      }, 2000);
		        			  
		        		  }else{
		        			  $.confirm(data.info,function(){
		        				  lock = true;
		        				  window.location.href = "tel:"+data.location_tel;
		        			  },function(){
		        				  location.reload(); 
		        			  });
		        		  }
		        	  }
		          });
		      },function () {
	        	  lock = true;
	          });
		}
		
	});
	
	$(".dc-view-bar").on('click', '.j-quick', function() {
		//催单
		if(!lock){
			return;
		}else{
			lock = false;
			var url = $(this).attr('data_url');
			var query = new Object();
			$.ajax({
	      	  url:url,
	      	  type:'post',
	      	  dataType:'json',
	      	  success:function(data){
	      		  if(data.status == 1){
	      			 $.toast(data.info);
	      			 lock = true;
	      			  
	      		  }else{
	      			$.toast(data.info);
	      			lock = true;
	      		  }
	      	  }
	        });
		}
		
	});
	$(".dc-view-bar").on('click','.harvest',function(){
		//确认收货
		if(!lock){
			return;
		}else{
			lock = false;
			var url = $(this).attr('data_url');
			$.confirm('确定收到商品了吗？', function () {
				$.ajax({
					url:url,
					type:'post',
					dataType:'json',
					success:function(data){
						if(data.status == 1){
							$.toast(data.info);
							setTimeout(function () {
		      				  location.reload(); 
		  			      }, 2000);
						}else{
							$.toast(data.info);
							lock = true;
						}
					}
				});
			});
		}
		
		
		
	});
	
	$(".dc-view-bar").on('click','.to-pay',function(){
		if(!lock){
			return;
		}else{
			lock = false;
			var url = $(this).attr('data_url');
			var jump_url = $(this).attr('jump_url');
			$.ajax({
				url:url,
				type:'post',
				dataType:'json',
				success:function(data){
					if(data.status == 1){
						location.href = jump_url;
					}else{
						$.toast(data.info);
						lock = true;
					}
				}
			});
		}
		
		
	});
});
$(document).on("pageInit", "#dc_cart", function(e, pageId, $page) {

	var lock = false; // 全局锁定变量

	//打开送货时间选择
	$(".j-open-time").on('click', function() {
		$(".dc-mask").addClass('active');
		$(".time-select").addClass('active');
		var send_time=$(this).find('input').attr('value');
		$(".j-time-choose").each(function() {
			if ($(this).attr('value')==send_time) {
				$(this).addClass('active');
			}
		});
	});
	//关闭送货时间选择
	$(".j-close-time").on('click', function() {
		$(".dc-mask").removeClass('active');
		$(".time-select").removeClass('active');
	});
	//选择时间
	$(".j-time-choose").on('click', function() {
		$(".j-time-choose").removeClass('active');
		$(this).addClass('active');
		$(".j-send-time").html($(this).find('p').html());
		$("#time-value").attr('value', $(this).attr('value'));
	});
	//打开备注
	$(".j-open-memo").on('click', function() {
		$("#memo").focus();
		$(".dc-mask").addClass('active');
		$(".memo-box").addClass('active');
	});
	//关闭备注
	$(".j-close-memo").on('click', function() {
		var memo = $.trim($('textarea[name="dc_comment"]').val()).substr(0,100);
		$('#memo').val(memo);
		close_memo();
	});
	//确认备注
	$(".j-memo").on('click', function() {
		var memo_txt = $.trim($('textarea[name="dc_comment"]').val());
		if (memo_txt == "") {
			$(".memo-txt").html('<span class="default-txt">备注您的口味、偏好等</span>');
		}else {
			if (memo_txt.length > 100) {
				$.toast('备注不超过100字,当前'+memo_txt.length+'字');
				return;
			}
			$(".memo-txt").html(memo_txt);
		}
		close_memo();
	});
	function close_memo() {
		$(".dc-mask").removeClass('active');
		$(".memo-box").removeClass('active');
	}
	//打开选择地址
	$(document).on('click', '.open-address', function() {
		if (lock) {
			return;
		}
		lock = true;
		load_consignee_list();
		$.popup('.popup-address');
		setTimeout(function() {
			lock = false;
		}, 2000);
	});
	$(".popup-address").on('click', '.j-select-address', function() {
		$(".dc-address-list li").removeClass('active');
		$(this).parent().addClass('active');
		$(".dc-address-box .dc-address-info").html($(this).html());
		cal_delivery_p();
		var con_id = $(".dc-address-box .dc-address-info").find('input').val();
		if (con_id) {
			window.history.replaceState({}, document.title, base_url+'&consignee_id='+con_id);
		}
	});
	function cal_delivery_p() { // 判断地址的起送价和计算配送费
		var dp = Number($('.dc-address-box .dc-address-info').find('.delivery_price').val());
		if (!dp) {
			dp = 0;
		}
		if (dp <= 0) {
			dp = 0;
			$('.de-price-box').addClass('hide');
		} else {
			$('.de-price-box').removeClass('hide');
		}
		dp = Math.round(dp * 100) / 100;
		$('em.delivery_price').html(dp);
		cal_price();
	}
	//打开新增地址
	$(document).on('click', '.j-open-new-address', function() {
		$.popup('.popup-address-new');
	});
	//打开编辑地址
	$(document).on('click', '.j-open-edit', function() {
		if (lock) {
			return;
		}
		lock = true;
		var id = $(this).attr('data-id');
		var param = {'act':'add', 'id':id};
		$.ajax({
			url: DC_CONSIGNEE_URL,
			data: param,
			type: "post",
			dataType:"json",
			success: function(data){
				lock = false;
				$('.popup-address-edit').html(data.html);
				$.popup('.popup-address-edit');
			},
			error: function() {
				lock = false;
				$.toast('网络异常地址加载错误');
			}
		});
	});
	// 新增地址
	$('.popup-address-new').on('click', '.j-save-address', function() {
		var consignee = $('.add-item input[name="consignee"]').val();
		if (!consignee) {
			$.toast('请填写姓名');
			return;
		}
		var mobile = $('.add-item input[name="mobile"]').val();
		if (!mobile) {
			$.toast('请填写手机号');
			return;
		}
		if (!checkMobilePhone(mobile)) {
			$.toast('请正确填写手机号');
			return;
		}
		var address = $('.add-item input[name="address"]').val();
		if (!address) {
			$.toast('请填写门牌信息');
			return;
		}
		var api_address = $('.add-item input[name="api_address"]').val();
		if (!api_address) {
			$.toast('请定位一个地址');
			return;
		}
		var xpoint = $('.add-item input[name="xpoint"]').val();
		var ypoint = $('.add-item input[name="ypoint"]').val();
		if (!xpoint || !ypoint) {
			$.toast('地址定位发送错误,请重试');
			return;
		}

		var param = {
			'act':'save_dc_consignee',
			'consignee':consignee,
			'mobile': mobile,
			'api_address': api_address,
			'address': address,
			'xpoint': xpoint,
			'ypoint': ypoint
		};
		if (lock) {
			return;
		}
		lock = true;
		var _this = this;
		$.ajax({
			url: DC_CONSIGNEE_URL,
			data: param,
			type: "post",
			dataType:"json",
			success: function(data){
				if (data.status) {
					$.toast('保存成功');
					//关闭当前弹层
					load_consignee_list();
					setTimeout(function() {
						$(_this).parents('.popup').removeClass('modal-in').addClass('modal-out');
						if ($('.dc-address-box').hasClass('j-open-new-address')) {
							$('.dc-address-box').removeClass('j-open-new-address').addClass('open-address');
						}
						// 如果只有一个地址，并且这个地址是有效的，直接获取并返回提交订单页
						if ($('.popup-bd').find('ul').length == 1 && $('.active-address-list').find('li').length == 1) {
							syn_address()
							return false;
						}
						$.popup('.popup-address');
					}, 2000);
				} else {
					$.toast(data.info);
				}
				lock = false;
			},
			error: function() {
				lock = false;
				$.toast('网络异常地址加载错误');
			}
		});
	});
	// 修改地址再写一份
	$(document).on('click', '.j-edit-address', function() {
		var consignee = $('.edit-item input[name="consignee"]').val();
		if (!consignee) {
			$.toast('请填写姓名');
			return;
		}
		var mobile = $('.edit-item input[name="mobile"]').val();
		if (!mobile) {
			$.toast('请填写手机号');
			return;
		}
		if (!checkMobilePhone(mobile)) {
			$.toast('请正确填写手机号');
			return;
		}
		var address = $('.edit-item input[name="address"]').val();
		if (!address) {
			$.toast('请填写门牌信息');
			return;
		}
		var api_address = $('.edit-item input[name="api_address"]').val();
		if (!api_address) {
			$.toast('请定位一个地址');
			return;
		}
		var xpoint = $('.edit-item input[name="xpoint"]').val();
		var ypoint = $('.edit-item input[name="ypoint"]').val();
		if (!xpoint || !ypoint) {
			$.toast('地址定位发送错误,请重试');
			return;
		}
		var id = $('.edit-item input[name="consignee_id"]').val();
		var param = {
			'act':'save_dc_consignee',
			'id': id,
			'consignee':consignee,
			'mobile': mobile,
			'api_address': api_address,
			'address': address,
			'xpoint': xpoint,
			'ypoint': ypoint
		};
		if (lock) {
			return;
		}
		lock = true;
		var _this = this;
		$.ajax({
			url: DC_CONSIGNEE_URL,
			data: param,
			type: "post",
			dataType:"json",
			success: function(data){
				$.toast(data.info);
				if (data.status) {
					//关闭当前弹层
					load_consignee_list();
					setTimeout(function() {
						$(_this).parents('.popup').removeClass('modal-in').addClass('modal-out');
					}, 2000);
				}
				lock = false;
			},
			error: function() {
				lock = false;
				$.toast('网络异常地址加载错误');
			}
		});
	});
	// 清空新增/修改地址信息
	function cls_add_info() {
		$('input[name="consignee"]').val('');
		$('input[name="mobile"]').val('');
		$('input[name="xpoint"]').val('');
		$('input[name="ypoint"]').val('');
		$('input[name="api_address"]').val('');
		$('input[name="address"]').val('');
	}
	// 计算支付金额
	function cal_price() {
		var cart_price = Number(total_price);
		var delivery_price = Number($('em.delivery_price').html());
		var package_price = Number($('em.package_price').html());
		var promote_amount = Number($('em.promote_amount').html());
		var total_count = cart_price + package_price + delivery_price;
		var pay_price = total_count - promote_amount;
		if (pay_price <= 0) {
			pay_price = 0;
		}
		total_count = Math.round(total_count * 100) / 100;
		pay_price = Math.round(pay_price * 100) / 100;
		$('em.total_count').html(total_count);
		$('em.pay_price').html(pay_price);
	}

	function load_consignee_list() {
		cls_add_info();
		var param = {'act':'index', 'lid': location_id};
		$.ajax({
			url: DC_CONSIGNEE_URL,
			data: param,
			type: "post",
			dataType:"json",
			success: function(data){
				$('.popup-bd').html(data.html);
				addrListActiveCheck();
			},
		});
	}
	function addrListActiveCheck() {
		var default_id = $('.j-ajaxaddress').find('input[name="consignee_id"]').val();
		if (default_id) {
			$(".dc-address-list li").removeClass('active');
			$('li[data-id="'+default_id+'"]').addClass('active');
		}
	}
	$(document).on('click', '.j-del-address', function() {
		$.confirm('确定要删除这个地址吗？', function () {
			var id = $('.edit-item input[name="consignee_id"]').val();
			if (!id) {
				$.toast('页面异常，请刷新重试');
				return;
			}
			var param = {'act': 'del', 'id': id};
			$.ajax({
				url: DC_CONSIGNEE_URL,
				data: param,
				type: "post",
				dataType: "json",
				success: function(data) {
					if (data.status) {
						$.toast('删除成功');
						load_consignee_list();
						setTimeout(function() {
							$('.popup-address-edit').removeClass('modal-in').addClass('modal-out');
						}, 2000);
					} else {
						$.toast(data.info);
					}
				}
			})
		});
	});
	//关闭当前地址弹层
	$(document).on('click', '.j-close-popup', function() {
	    $(this).parents('.popup').removeClass('modal-in').addClass('modal-out');
	    // $('#uc_address_map_pick').hide();
	});
	// 地址列表页返回的数据同步
	$(document).on('click', '.address-back', syn_address);
	function syn_address() {
		var addrhtml = $($('.active-address-list li.active').children().get(1)).html();
		if (!addrhtml) {
			addrhtml = $($('.active-address-list li').children().get(1)).html();
			if (!addrhtml) {
				addrhtml = '请选择送餐地址';
				$(".dc-address-box .dc-address-info").addClass('no-address');
			}
		}
		$(".dc-address-box .dc-address-info").html(addrhtml);
		cal_delivery_p();
	}

	var priceChangeLock = false;
	$('.dc-data-btn').on('click', function() {
		if (lock) {
			return;
		}
		if (priceChangeLock) {
			$.confirm('商品价格出错，请重新下单', function() {
				dc_cart_clear();
				$.router.back();
			})
			return;
		}
		lock = true;
		if (!$('input[name="consignee_id"]').val()) {
			$.toast('请选择一个配送地址');
			return;
		}
		var param = $('form[name="cart_form"]').serialize();
		var action = $(this).attr('data-url');
		$.ajax({
			url: action,
			data: param,
			type: "post",
			dataType: "json",
			success: function(data) {
				lock = false;
				if (data.user_login_status == 0) {
					setTimeout(function() {
						$.router.load(data.jump, true);
					}, 2000);
				}
				if (data.status == 1) {
					setTimeout(function() {
						$.router.load(data.jump, true);
					}, 2000);
				} else {
					if (data.isPriceChange) {
						priceChangeLock = true;
						$.confirm(data.info, function() {
							dc_cart_clear();
							$.router.back();
						});
						return;
					}
				}
				$.toast(data.info);
			}
		});
	})
});

function dc_pickmap(street, addr, x, y) {
    $('.modal-in input[name="api_address"]').val(street);
    // var patt = /^([^(]*?省|)([^(]*?市|)([^(]*?(区|县)|)(.*)/;
    // var mat = addr.match(patt);
    // var addr1 = mat.pop();
    // $('.add-item textarea[name="address"]').val(addr1);
    $('.modal-in input[name=xpoint]').val(x);
    $('.modal-in input[name=ypoint]').val(y);
    $('.popup-address-map').removeClass('modal-in').addClass('modal-out');
}
$(document).on('click', '.dc_mappick', function() {

    var region = '';
    /*$('#uc_address_map_pick').show();*/
    
    $.popup('.popup-address-map');
    $('#uc_address_map_pick').addClass('baidu_mapBox');
    // 百度地图API功能
    var map = new BMap.Map("baidu_allmap");
    var orx = $('.modal-in input[name="xpoint"]').val();
    var ory = $('.modal-in input[name="ypoint"]').val();
    var point = new BMap.Point(0,0);
    map.centerAndZoom(point,16);
    map.enableScrollWheelZoom(true);
    var myValue = '';
    // region += $('input[name="street"]').val();

    var geoc = new BMap.Geocoder();

    if (orx && ory) {
        map.panTo(new BMap.Point(orx, ory));
        getLoc();
    } else {
        var geolocation = new BMap.Geolocation();
		geolocation.getCurrentPosition(function(r){
			if(this.getStatus() == BMAP_STATUS_SUCCESS){
				// var mk = new BMap.Marker(r.point);
				// map.addOverlay(mk);
				map.panTo(r.point);
			} else {
				$.toast('定位异常，请手动尝试');
			}        
		},{enableHighAccuracy: true})
    }

    map.addEventListener('moveend', getLoc); // 移动结束检索地区
    function getLoc() {
        var p = map.getCenter();
        geoc.getLocation(p, function(rs) {
            var addComp = rs.addressComponents;
            var lstr = /*addComp.province + addComp.city + addComp.district +*/ addComp.street + addComp.streetNumber;
            var sstr = addComp.street ? addComp.street : addComp.district;
            var surrPois = rs.surroundingPois;
            var cx = rs.point.lng;
            var cy = rs.point.lat;
            var res = '<div class="r-loca">';
            res += '<div class="b-line" onclick="dc_pickmap(\''+sstr+'\',\''+lstr+'\','+cx+','+cy+')"><li class="loca-curr"><h3><i class="search-icon iconfont">&#xe62f;</i><em>[当前]</em>'+sstr+'</h3><p class="loca-curr">'+lstr+'</p></li></div>';
            if (surrPois) {
                // console.log(surrPois);
                for (i in surrPois) {
                    var x = surrPois[i].point.lng;
                    var y = surrPois[i].point.lat;
                    res += '<div class="b-line" onclick="dc_pickmap(\''+surrPois[i]['title']+'\',\''+surrPois[i]['address']+'\','+x+','+y+');"><li><h3><i class="search-icon iconfont">&#xe62f;</i>'+surrPois[i]['title']+'</h3><p>'+surrPois[i]['address']+'</p></li></div>';
                }
            }
            res += '</div>'
            $('#baidu-m-result').html(res);
        });
    }

    // 搜索方法
    var ac = new BMap.Autocomplete({'input':'suggestId', 'location': map});
    ac.addEventListener('onhighlight', function(e) {
        var str = '';
        var _value = e.fromitem.value;
        var value = '';
        if (e.fromitem.index > -1) {
            value = _value.province + _value.city + _value.district + _value.street;
        }
        str = "FromItem<br />index = " + e.fromitem.index + "<br />value= " + value;

        value = "";
        if (e.toitem.index > -1) {
            _value = e.toitem.value;
            value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
        }    
        str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
        $("#baidu_searchResultPanel").html(str);
    });

    var geocoder = new BMap.Geocoder();
    ac.addEventListener("onconfirm", function(e) {    //鼠标点击下拉列表后的事件
    var _value = e.item.value;
        myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
        $("#baidu_searchResultPanel").html("onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue);
        geocoder.getPoint(myValue, function(point) {
        	if (point) {
        		var street = _value.business;
        		dc_pickmap(street, '', point.lng, point.lat);
        	} else {
        		setPlace();
        	}
        })
    });

    function setPlace(){
        function myFun(){
            var pp = local.getResults().getPoi(0);    //获取第一个智能搜索的结果
            if (!pp) {
                $.toast('地址查询错误');
                setTimeout(function() {
                    // var pro = myValue.substr(0, myValue.indexOf('省'));
                    // console.log(pro);
                    map.centerAndZoom('北京', 12);
                }, 2000);
                
                return;
            }
            map.centerAndZoom(pp.point, 18);
        }
        var local = new BMap.LocalSearch(map, { //智能搜索
            onSearchComplete: myFun
        });
        // local.clearResults();
        local.search(myValue);
    }

    // 添加定位控件
    var geolocationControl = new BMap.GeolocationControl({
        // 靠左上角位置
        anchor: BMAP_ANCHOR_BOTTOM_LEFT,
        // 是否显示定位信息面板
        showAddressBar: false,
        // 启用显示定位
        enableGeolocation: true
    });
    geolocationControl.addEventListener("locationSuccess", function(e){

    });
    geolocationControl.addEventListener("locationError",function(e){
        // 定位失败事件
        alert(e.message);
    });
    map.addControl(geolocationControl);
})
$(document).on("pageInit", "#dc_location", function(e, pageId, $page) {
	init_list_scroll_bottom();//下拉刷新加载
	
	var mySwiper = new Swiper('.j-index-banner', {
		speed: 400,
		spaceBetween: 0,
		pagination: '.swiper-pagination',
		autoplay: 2500
	});
	var mySwiper = new Swiper('.j-sort_nav', {
	    speed: 400,
	    spaceBetween: 0
	});
	$(document).on('click', '.j-open-youhui', function() {
		var i_height=$(this).parent().find('.youhui-item').height();
		var t_height=i_height*$(this).parent().find('.youhui-item').length;
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
			$(this).parent().find('.youhui-list').css('max-height', i_height*2);
		} else {
			$(this).addClass('active');
			$(this).parent().find('.youhui-list').css('max-height', t_height);
		}
	});
});
$(document).on("pageInit", "#dc_locations_list", function(e, pageId, $page) {
	init_list_scroll_bottom();//下拉刷新加载
	
	$("#dc_locations_list").on('click', '.j-open-youhui', function() {
		var i_height=$(this).parent().find('.youhui-item').height();
		var t_height=i_height*$(this).parent().find('.youhui-item').length;
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
			$(this).parent().find('.youhui-list').css('max-height', i_height*2);
		} else {
			$(this).addClass('active');
			$(this).parent().find('.youhui-list').css('max-height', t_height);
		}
	});
	$("#dc_locations_list").on('click', '.j-open-select', function() {
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
			$(".dc-select").removeClass('active');
			$(".dc-mask").removeClass('active');
		} else {
			$(".j-open-select").removeClass('active');
			$(this).addClass('active');
			$(".dc-select").removeClass('active');
			$(".dc-select").eq($(this).index()).addClass('active');
			$(".dc-mask").addClass('active');
		}
	});
	
	$("#dc_locations_list").on('click', '.j-fliter-item', function() {
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
			$(this).find('input').prop("checked",false);
		} else {
			$(this).find('input').prop("checked",true);
			$(this).addClass('active');
		}
	});
	
	$(".dc-dp-dis").find(".j-ajaxchoose").click(function(){
		$(".dc-cate-list").find(".j-ajaxchoose").removeClass("active");
		$(this).addClass("active");
		
		var sort=$(this).attr('data-id');
		$("input[name='sort']").val(sort);
		
		var sort=$(this).find(".select-tit").html();
		$(".now-sort").html(sort);
		
		param_location();
	});
	
	$(".dc-cate-list").find(".j-ajaxchoose").click(function(){
		$(".dc-cate-list").find(".j-ajaxchoose").removeClass("active");
		$(this).addClass("active");
		
		var sort=$(this).attr('data-id');
		$("input[name='cid']").val(sort);
		
		var cate=$(this).find(".select-tit").html();
		$(".now-cate-name").html(cate);
		
		param_location();
	});
	
	$("#dc_locations_list").on('click', '.j-close-select', function() {
		$(".j-open-select").removeClass('active');
		$(".dc-select").removeClass('active');
		$(".dc-mask").removeClass('active');
		
		param_location();
	});
	
	function param_location(){
		
		var query = $("form[name='dc_location_param']").serialize();
		var ajax_url = $("form[name='dc_location_param']").attr("action");
		$(".content").scrollTop(0);
		$(document).off('infinite', '.infinite-scroll-bottom');
		
		$.ajax({
			url:ajax_url,
			data:query,
			dataType:"html",
			type:"POST",
			success:function(html){
				
				$(".j-ajaxlist").html($(html).find(".j-ajaxlist").html());
				
				init_list_scroll_bottom();
			}
		});
		return false;
	}

});

$(document).on("pageInit", "#dc_location_index", function(e, pageId, $page) {
	
	init_list_scroll_bottom();//下拉刷新加载
	
	/*if(menu_id){
		dc_change_num(menu_id,menu_num,1);
		$(".goods-info[data_id='"+menu_id+"']").find(".goods-num-box").removeClass('no-num').addClass("num");
        var g_height=$(".goods-info[data_id='"+menu_id+"']").parent().offset().top;
        var m_height=$(".m-cate-list").offset().top;
        $(".m-cate-list").scrollTo({toT:g_height-m_height});
        $(".goods-info[data_id='"+menu_id+"']").parent().addClass('search-menu');
	}*/
	
	if(is_in_open_time==0 || is_free_delivery==2){
		dc_cart_clear();
	}else{
		// cart_total_price();
        load_dc_cart_list();
	}
    // 异步获取购物车信息
    function load_dc_cart_list() {
        var param = {
            'act': 'get_dc_cart_list',
            'location_id': location_id
        };
        $.ajax({
            url:ajaxurl,
            data: param,
            dataType: 'json',
            success: function(data) {
                if (data.hasCart) {
                    var mAndN = data.menuidAndNum;
                    for (mid in mAndN) {
                        $(".goods-info[data_id='"+mid+"']").find(".goods-num-box").removeClass('no-num').addClass("num");
                        $(".goods-num[data_id='"+mid+"']").html(mAndN[mid]);
                        $(".min[data_id='"+mid+"']").attr("onclick","dc_change_num("+mid+","+mAndN[mid]+",-1);");
                        $(".plus[data_id='"+mid+"']").attr("onclick","dc_change_num("+mid+","+mAndN[mid]+",1);");

                        $item=$("<li class='flex-box b-line'  data_id='"+mid+"'>"
                            +"<p class='goods-name flex-1'>"+$(".goods-info[data_id='"+mid+"']").find(".goods-name").html()+"</p>"
                            +"<p class='edit-price' price='"+$(".goods-info[data_id='"+mid+"']").find(".price").attr("price")+"'>"+$(".goods-info[data_id='"+mid+"']").find(".price").html()+"</p>"
                            +"<div class='goods-num-box flex-box'>"
                            +"<a href='javascript:void(0);' class='min iconfont' data_id='"+mid+"' onclick='dc_change_num("+mid+","+mAndN[mid]+",-1);'>&#xe915;</a>"
                            +"<p class='goods-num' data_id='"+mid+"'>"+mAndN[mid]+"</p>"
                            +"<a href='javascript:void(0);' class='iconfont plus' data_id='"+mid+"' onclick='dc_change_num("+mid+","+mAndN[mid]+",1);'>&#xe685;</a>"
                            +"</div></li>");
                        $(".edit-list").prepend($item);
                    }
                }
                if (menu_id) { // 从搜索入口进来的，购物车信息加1
                    var cartNum = parseInt($(".goods-num[data_id='"+menu_id+"']").html());
                    dc_change_num(menu_id, cartNum, 1);
                    $(".goods-info[data_id='"+menu_id+"']").find(".goods-num-box").removeClass('no-num').addClass("num");
                    var g_height=$(".goods-info[data_id='"+menu_id+"']").parent().offset().top;
                    var m_height=$(".m-cate-list").offset().top;
                    $(".m-cate-list").scrollTo({toT:g_height-m_height});
                    $(".goods-info[data_id='"+menu_id+"']").parent().addClass('search-menu');
                    window.history.replaceState({}, document.title, base_url);
                }
                cart_total_price();
            }
        })
    }
	
	
	var swiper = new Swiper('.m-youhui-info', {
		speed:500,
        pagination: '',
        direction: 'vertical',
        slidesPerView: 1,
        paginationClickable: true,
        spaceBetween: 0,
        mousewheelControl: true,
        autoplay: 3000,
        loop: true
    });
    tab_line();
    function tab_line() {
    	var init_width=$(".shop-tab li:first-child span").width();
    	var init_left=$(".shop-tab li:first-child span").offset().left;
    	$(".m-shop-tab .tab-line").css({
    		width: init_width,
    		left: init_left
    	});
    }
    $(".j-tab-item").bind('click', function() {
    	var l_width=$(this).find('span').width();
    	var l_left=$(this).find('span').offset().left;
    	$(".j-tab-item").removeClass('active');
    	$(this).addClass('active');
    	$(".m-shop-tab .tab-line").css({
    		width: l_width,
    		left: l_left
    	});
    	$(".j-shop-item").removeClass('active');
    	$(".j-shop-item").eq($(this).index()).addClass('active');
    });
    
    $(".plus").bind('click', function() {
    	if(is_in_open_time && is_free_delivery!=2){
    		$(this).parent().removeClass('no-num');
    	}
    });
    $(".j-cate-select").bind('click', function() {
    	$(".m-cate-list").unbind('scroll');
    	$(".j-cate-select").removeClass('active');
    	$(this).addClass('active');
    	var menu_top=$(".menu").offset().top;
    	var list_top=$(".m-cate-list").scrollTop();
    	var cate_top=$(".dc-cate-list").eq($(this).index()).offset().top;
    	s_height=cate_top-menu_top+list_top;
    	$(".m-cate-list").scrollTo({toT:s_height});
    });
    $(".m-cate-list").bind('touchstart', function() {
	    $(".m-cate-list").bind('scroll', function() {
			cate_scroll();
	    });
    });

    function cate_scroll() {
    	var menu_top=$(".menu").offset().top;
    	$(".cate-title").each(function(){
    		var cate_top=$(this).offset().top;
    		if (cate_top<=menu_top) {
    			$(".j-cate-select").removeClass('active');
    			$(".j-cate-select").eq($(this).parent().index()).addClass('active');
    		}
    	});
    }
    
    $(document).off('click',".j-show-edit");
    $(document).on('click',".j-show-edit", function() {
        if($('.cart-count').hasClass("hide")==false){
            $(".cart-count").toggleClass('active');
            $(".cart-mask").toggleClass('active');
        }
    });
    $(document).on('click', ".j-empty-edit",function() {
        $.toast("购物车是空的");
    });
    $(".no-goods-btn").bind('click', function() {
        $.toast("还未达到起送价格");
    });
    $(".j-close-edit").on('click', function() {
    	$(".cart-count").removeClass('active');
    	$(".cart-mask").removeClass('active');
    });
    $(".j-open-detail").bind('click', function() {
    	$(".dc-shop-detail").addClass('active');
    });
    $(".j-close-detail").bind('click', function() {
    	$(".dc-shop-detail").removeClass('active');
    });
    $(".m-cate-list .plus").on('click', function() {
    	if(is_in_open_time){
	    	$(".m-fly").addClass('active').css({
	    		left: $(this).offset().left,
	    		top: $(this).offset().top
	    	});
	        $(".cart-bar .cart-ico .iconfont").addClass('active');
	    	bool.init();
	    	bool.setOptions({
	    		targetEl: $("#target")
	    	});
	    	bool.start();
    	}
    });
    var bool = new Parabola({
    	el: ".m-fly",
		curvature: 0.004,
		duration: 300,
    	callback:function(){
            setTimeout('$(".cart-bar .cart-ico .iconfont").removeClass("active")', 300);
    		$(".m-fly").removeClass('active');
    	}
    });
    
    
    //增加收藏
	$('.add_location_collect').bind('click',function(){
		add_location_collect_function($(this));
        if ($(this).hasClass('collected')) {
            $(this).removeClass('collected');
        } else {
            $(this).addClass('collected');
        }
	});

    
    
});

function dc_change_num(id,count,num){
	
	if(is_in_open_time==0){
		$.toast("商家休息中，无法下单");
		return;
	}
	
	if(is_free_delivery==2){
		$.toast("超出配送范围，无法配送");
		return;
	}
	
	var menu_id=parseInt(id);
	var number=parseInt(num);
	var number_total=parseInt(count)+num;
	if(number_total<0){
		$.toast("该商品数量无法再减少");
		return;
	}
	if(num==1){
		if(count==0){
			$item=$("<li class='flex-box b-line'  data_id='"+id+"'>"
				+"<p class='goods-name flex-1'>"+$(".goods-info[data_id='"+id+"']").find(".goods-name").html()+"</p>"
				+"<p class='edit-price' price='"+$(".goods-info[data_id='"+id+"']").find(".price").attr("price")+"'>"+$(".goods-info[data_id='"+id+"']").find(".price").html()+"</p>"
				+"<div class='goods-num-box flex-box'>"
				+"<a href='javascript:void(0);' class='min iconfont' data_id='"+id+"' onclick='dc_change_num("+id+","+number_total+",-1);'>&#xe915;</a>"
				+"<p class='goods-num' data_id='"+id+"'>"+number_total+"</p>"
				+"<a href='javascript:void(0);' class='iconfont plus' data_id='"+id+"' onclick='dc_change_num("+id+","+number_total+",1);'>&#xe685;</a>"
				+"</div></li>");
			$(".edit-list").prepend($item);
			
		}
		
	}
	else{
		if(count==1){
			$(".edit-list").find("li[data_id='"+id+"']").remove();
			$(".goods-info[data_id='"+id+"']").find(".goods-num-box").removeClass("num").addClass("no-num");
		}
	}
	$(".goods-num[data_id='"+id+"']").html(number_total);
	$(".min[data_id='"+id+"']").attr("onclick","dc_change_num("+id+","+number_total+",-1);");
	$(".plus[data_id='"+id+"']").attr("onclick","dc_change_num("+id+","+number_total+",1);");
	cart_total_price();
	
	var query=new Object();
	query.menu_id=menu_id;
	query.number=number;
	query.number_total=number_total;
	query.tid=tid;
	query.location_id=location_id;
	query.supplier_id=supplier_id;
	query.distance=distance;
	query.act='dc_add_cart';
	$.ajax({
		url:ajaxurl,
		data:query,
		type:'post',
		dataType:'json',
		success:function(data){
			if(data.status==1){
				
			}else{
				$.toast(data.info);
				setTimeout(function(){
					window.location.reload();
				},500);
			}
		}
	});
		
}

//计算购物车商品价格
function cart_total_price(){
	var cart_num=0;
	var total_price=0;
	$(".edit-list").find("li[data_id]").each(function(){
		var num=parseInt($(this).find(".goods-num").html());
		var price=parseFloat($(this).find(".edit-price").attr("price"));
		cart_num+=num;
		total_price+=price*num;
	});
	
	var mune_price=total_price;
	
	if(payonline_conf){
		if(mune_price>0){
			var max=payonline_conf.length-1;
			if(mune_price>payonline_conf[max]['discount_limit']){
				var discount_limit=payonline_conf[max]['discount_limit'];
				var discount_amount=payonline_conf[max]['discount_amount'];
			}else{
				for(var i=0;i<=max;i++ ){
					if(payonline_conf[i]['discount_limit']>mune_price){
						if(i>0){
							var discount_limit=payonline_conf[i-1]['discount_limit'];
							var discount_amount=payonline_conf[i-1]['discount_amount'];
						}
						break;
					}
				}
			}	
		}
		
		if(discount_limit){
			if($(".cart-tip").length)
			{
				$(".cart-tip").html("已满"+discount_limit+",结算减"+discount_amount+"元");
			}
			else{
				var cart_tip=$("<div class='cart-tip t-line'>已满"+discount_limit+",结算减"+discount_amount+"元</div>");
				$(".cart-count").prepend(cart_tip);
			}
		}else{
			$(".cart-tip").remove();
		}
	}
	
	if(mune_price>=package_start_price && package_start_price>=0){
		total_package_price=0;
	}else{
		total_package_price=cart_num*package_price;
	}
	
	//total_price+=total_package_price;
	$(".no-goods-btn").remove();
	$(".cart-btn").remove();
	if(total_price>0){
		total_package_price=total_package_price.toFixed(2);
		total_price=total_price.toFixed(2);
		
		if(total_package_price>0){
			$(".cart-bar").find('.send-price').html("另需打包费￥"+total_package_price);
		}else{
			$(".cart-bar").find('.send-price').html('');
		}
		
		$(".package_price").attr("price",total_package_price);
        $(".no-goods-txt").hide();
        $(".cart-price").show();
        $(".send-price").show();
		$(".cart-price").html("￥"+total_price);
        $(".cart-ico").removeClass('j-empty-edit');
        $(".cart-ico").addClass('j-show-edit');
	}else{
        $(".no-goods-txt").show();
        $(".cart-price").hide();
        $(".send-price").hide();
        $(".cart-ico").removeClass('j-show-edit');
        $(".cart-ico").addClass('j-empty-edit');
        $(".cart-count").removeClass('active');
        $(".cart-mask").removeClass('active');
        setTimeout('$(".edit-list").empty()', 500);
		$(".goods-info").each(function(){
			$(this).find(".goods-num-box").addClass("no-num");
			$(this).find(".min").attr("onclick","dc_change_num("+$(this).attr("data_id")+",0,-1);");
			$(this).find(".plus").attr("onclick","dc_change_num("+$(this).attr("data_id")+",0,1);");
		});
	}
	
	if(cart_num>9){
		$(".num-count").html("9+");
	}else{
		$(".num-count").html(cart_num);
	}
	
	if(cart_num==0){
		$(".num-count").addClass("hide");
	}else{
		$(".num-count").removeClass("hide");
	}
	
	if(is_in_open_time==0){
		var btn=$("<div class='no-goods-btn cart-btn'>休息中</div>");
		btn.appendTo($(".cart-bar"));
	}
	else if(is_free_delivery==2){
		var btn=$("<div class='no-goods-btn cart-btn'>超出配送范围</div>");
		btn.appendTo($(".cart-bar"));
	}
	else if(mune_price>=start_price && total_price>0){	
		var btn=$("<a href='"+buy_url+"' data-no-cache='true' class='external cart-btn'>结算</a>");
		btn.appendTo($(".cart-bar"));
	}
	else{
		var btn=$("<div class='no-goods-btn cart-btn'>￥"+start_price.toFixed(2)+"起送</div>");
		btn.appendTo($(".cart-bar"));
	}
}

//清空购物车
function dc_cart_clear(){
	var query=new Object();
	query.location_id=location_id;
	query.act='dc_cart_clear';
	$.ajax({
			url:ajaxurl,
			data:query,
			type:'post',
			dataType:'json',
			success:function(data){
				if(data.status==1){
					$(".edit-list").empty();
					cart_total_price();
				}
			}
	});
	
}

function add_location_collect_function(o){
	var query=new Object();

	var url=$(o).attr('action-url');
	
	$.ajax({
			url:url,
			data:query,
			type:'post',
			dataType:'json',
			success:function(data){
				if(data.status==1){
					$.toast(data.info);
				}else if(data.status==0){
					$.toast(data.info);
				}
				if(data.status==-1){
					$.toast(data.info);
				}
			}
	});
	
}

//滑动脚本
$.fn.scrollTo =function(options){
        var defaults = {
            toT : 0,    //滚动目标位置
            durTime :100,  //过渡动画时间
            delay : 10,     //定时器时间
            callback:null   //回调函数
        };
        var opts = $.extend(defaults,options),
            timer = null,
            _this = this,
            curTop = _this.scrollTop(),//滚动条当前的位置
            subTop = opts.toT - curTop,    //滚动条目标位置和当前位置的差值
            index = 0,
            dur = Math.round(opts.durTime / opts.delay),
            smoothScroll = function(t){
                index++;
                var per = Math.round(subTop/dur);
                if(index >= dur){
                    _this.scrollTop(t);
                    window.clearInterval(timer);
                    if(opts.callback && typeof opts.callback == 'function'){
                        opts.callback();
                    }
                    return;
                }else{
                    _this.scrollTop(curTop + index*per);
                }
                sb=index;
            };
        timer = window.setInterval(function(){
            smoothScroll(opts.toT);
        }, opts.delay);
        return _this;
    };
    var Parabola = function(opts){
        this.init(opts);
    };
    Parabola.prototype = {
        constructor: Parabola,
        /*
         * @fileoverview 页面初始化
         * @param opts {Object} 配置参数
         */
        init: function(opts){
            this.opts =  $.extend(defaultConfig, opts || {});
            // 如果没有运动的元素 直接return
            if(!this.opts.el) {
                return;
            }
            // 取元素 及 left top
            this.$el = $(this.opts.el);
            this.$elLeft = this._toInteger(this.$el.offset().left);
            this.$elTop = this._toInteger(this.$el.offset().top);
            // 计算x轴，y轴的偏移量
            if(this.opts.targetEl) {
                this.diffX = this._toInteger($(this.opts.targetEl).offset().left+10) - this.$elLeft;
                this.diffY = this._toInteger($(this.opts.targetEl).offset().top) - this.$elTop;
            }else {
                this.diffX = this.opts.offset[0];
                this.diffY = this.opts.offset[1];
            }
            // 运动时间
            this.duration = this.opts.duration;
            // 抛物线曲率
            this.curvature = this.opts.curvature;
            
            // 计时器
            this.timerId = null;
            /*
             * 根据两点坐标以及曲率确定运动曲线函数（也就是确定a, b的值）
             * 公式： y = a*x*x + b*x + c;
             * 因为经过(0, 0), 因此c = 0
             * 于是：
             * y = a * x*x + b*x;
             * y1 = a * x1*x1 + b*x1;
             * y2 = a * x2*x2 + b*x2;
             * 利用第二个坐标：
             * b = (y2 - a*x2*x2) / x2
             */
             this.b = (this.diffY - this.curvature * this.diffX * this.diffX) / this.diffX;

             // 是否自动运动
             if(this.opts.autostart) {
                 this.start();
             }
        },
        /*
         * @fileoverview 开始
         */
        start: function(){
            // 开始运动
            var self = this;
            // 设置起始时间 和 结束时间
            this.begin = (new Date()).getTime();
            this.end = this.begin + this.duration;
            
            // 如果目标的距离为0的话 就什么不做
            if(this.diffX === 0 && this.diffY === 0) {
                return;
            }
            if(!!this.timerId) {
                clearInterval(this.timerId);
                this.stop();
            }
            // 每帧（对于大部分显示屏）大约16~17毫秒。默认大小是166.67。也就是默认10px/ms
            this.timerId = setInterval(function(){
                var t = (new Date()).getTime();
                self.step(t);
            },16);
            return this;
        },
        /*
         * @fileoverview 执行每一步
         * @param {string} t 时间
         */
        step: function(t){
            var opts = this.opts;
            var x,
                y;
            // 如果当前运行的时间大于结束的时间
            if(t > this.end) {
                // 运行结束
                x = this.diffX;
                y = this.diffY;
                this.move(x,y);
                this.stop();
                // 结束后 回调
                if(typeof opts.callback === 'function') {
                    opts.callback.call(this);
                }
            }else {
                // 每一步x轴的位置
                x = this.diffX * ((t - this.begin) / this.duration);
                // 每一步y轴的位置 y = a * x *x + b*x + c; c = 0
                y = this.curvature * x * x + this.b * x;
                // 移动
                this.move(x,y);
                if(typeof opts.stepCallback === 'function') {
                    opts.stepCallback.call(this,x,y);
                }
            }
            return this;
        },
        /*
         * @fileoverview 给元素定位
         * @param {x,y} x,y坐标
         * @return this
         */
        move: function(x,y) {
            this.$el.css({
                "position":'absolute',
                "left": this.$elLeft + x + 'px',
                "top": this.$elTop + y + 'px'
            });
            return this;
        },
        /*
         * 获取配置项
         * @param {object} options配置参数
         * @return {object} 返回配置参数项
         */
        getOptions: function(options){
            if(typeof options !== "object") {
                options = {};
            }
            options = $.extend(defaultConfig, options || {});
            return options;
        },
        /*
         * 设置options
         * @param options
         */
        setOptions: function(options) {
            this.reset();
            if(typeof options !== 'object') {
                options = {};
            }
            options = $.extend(this.opts,options);
            this.init(options);
            return this;
        },
        /*
         * 重置
         */
        reset: function(x,y) {
            this.stop();
            x = x ? x : 0;
            y = y ? y : 0;
            this.move(x,y);
            return this;
        },
        /*
         * 停止
         */
        stop: function(){
            if(!!this.timerId){
                clearInterval(this.timerId);
            }
            return this;
        },
        /*
         * 变成整数
         * isFinite() 函数用于检查其参数是否是无穷大。
         */
        _toInteger: function(text){
            text = parseInt(text);
            return isFinite(text) ? text : 0;
        }
    };
    var defaultConfig = {
        //需要运动的元素 {object | string}
        el: null,

        // 运动的元素在 X轴，Y轴的偏移位置
        offset: [0,0],

        // 终点元素 
        targetEl: null,

        // 运动时间，默认为500毫秒
        duration: 500,

        // 抛物线曲率，就是弯曲的程度，越接近于0越像直线，默认0.001
        curvature: 0.01,
        
        // 运动后执行的回调函数
        callback: null,

        // 是否自动开始运动，默认为false
        autostart: false,
        
        // 运动过程中执行的回调函数，this指向该对象，接受x，y参数，分别表示X，Y轴的偏移位置。
        stepCallback: null
    };
/**
 * Created by Administrator on 2016/9/7.
 */

$(document).on("pageInit", "#dc_order_pay", function(e, pageId, $page) {

	// $('.fee_count').hide();
	init_payment_input();
	init_pay_btn();
	function init_payment_input(){
		account_click();

		$('#all_account_money').live('click', account_click)
		
		$(".payment").live("click", payment_click);
	}

	function account_click() {
		$(this).addClass('active');
		$("input[name='all_account_money']").prop("checked",true);
		$(".payment").removeClass('active');
		$("input[name='payment']").prop("checked",false);
		$('.fee_count').addClass('hide');
		$('.fee_count .payment_fee').text(0);
		local_count();
	}

	function payment_click() {
		$("input[name='payment']").prop("checked",false);
		$(".payment").removeClass('active');
		$(this).siblings("input[name='payment']").prop("checked",true);
		$(this).addClass("active");

		$("#all_account_money").removeClass("active");
		$("input[name='all_account_money']").prop("checked",false);
		var fee = Number($('.active .fee_amount').text());
		fee = fee > 0 ? fee.toFixed(2) : 0;
		if (fee > 0) {
			$('.fee_count').removeClass('hide');
		} else {
			$('.fee_count').addClass('hide');
		}
		$('.fee_count .payment_fee').text(fee);
		local_count()
	}

	function local_count() {
		var total= $('.total_count').text().replace(",","");
		var payment_fee= $('.payment_fee').text().replace(",","");
		var discount= 0; // $('.discount').text().replace(",","");
		var ready_pay = Number(total) - Number(discount) + Number(payment_fee);
		$('.ready_pay').text(ready_pay.toFixed(2));
	}

	function init_pay_btn(){
	    $(".u-sure-pay").bind("click",function(){
	    	var all_account_money = 0; // 是否余额支付
			var payment = 0;
			//全额支付
			if($("#all_account_money").hasClass("active")) {
				all_account_money = 1;
			} else { // 其它支付方式
				payment = $("input[name='payment']:checked").val();
			}

			if (all_account_money == 0 && payment == 0) {
				$.toast('请选择一个支付方式');
				return;
			}
			var query = {
				'payment': payment, 
				'all_account_money': all_account_money,
				'id': order_id,
				'act': 'order_done'
			};
	        $.ajax({
				url: ORDER_AJAX,
				data:query,
				type: "POST",
				dataType: "json",
				success: function(data){
					if(data.status==1){
						if(data.app_index=='wap' ){  //SKD支付做好后，用 App.pay_sdk支付
							if(data.pay_status==1){
								$.router.load(data.jump, true);
							}else{
								location.href=data.jump;
							}
						} else if( data.app_index=='app' && data.pay_status==1){  //APP余额支付
							 $.router.load(data.jump, true);

						} else if( data.app_index=='app' && data.pay_status==0){  //APP第三方支付
							if(data.online_pay==3){
								try {

									var str = pay_sdk_json(data.sdk_code);
									App.pay_sdk(str);
								} catch (ex) {

									$.toast(ex);
									$.loadPage(location.href);
								}
							}else{
								var pay_json = '{"open_url_type":"1","url":"'+data.jump+'","title":"'+data.title+'"}';

								try {
									App.open_type(pay_json);
									$.confirm('已支付完成？', function () {
										$.loadPage(location.href);

									},function(){
										$.loadPage(location.href);

									});
								} catch (ex) {
									$.toast(ex);
									$.loadPage(location.href);
								}
							}
						}
					}else{
						
						$.alert(data.info);
					}
				},
				error:function(ajaxobj) {

				}
			});
	    });
	};
});


$(document).on("pageInit", "#dc_point", function(e, pageId, $page) {
	init_list_scroll_bottom();//下拉刷新加载
});
$(document).on("pageInit", "#dc_position", function(e, pageId, $page) {
	//左侧结果点击对象
	var cur_item = null;
	var total;
	var cur_page = 0;
	var marker_array = new Array();
	$(function(){
	
		init_search_name();
		var map = new BMap.Map("map_show");
		map.centerAndZoom(CITY_NAME,12);                   // 初始化地图,设置城市和地图级别。
		//添加点击事件监听
		map.addEventListener("click", function(e){    
		 
		 var query = {ak:BAIDU_APPKEY,location:e.point.lat+","+e.point.lng,output:"json"};
			$.ajax({
				url:"http://api.map.baidu.com/geocoder/v2/",
				dataType:"jsonp",
				callback:"callback",
				data:query,
				success:function(obj){
					var address = obj.result.formatted_address;
					var title = obj.result.sematic_description;
					var infoWindow_obj = create_window({title:title,content:address,lng:e.point.lng,lat:e.point.lat});
					map.openInfoWindow(infoWindow_obj,new BMap.Point(e.point.lng,e.point.lat)); //开启信息窗口
				}
			});
	
		});
		var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
			{"input" : "q_text"
			,"location" : map
		});
	
	
		if($.trim(dc_title)!=''){
			$('#q_text').val(dc_title);
			ac.setInputValue(dc_title);
		}
		var myValue;
		ac.addEventListener("onconfirm", function(e) {    //鼠标点击下拉列表后的事件
			var _value = e.item.value;
			myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
	
			searchlocation(myValue,_value.city);
		});
	
		
		$('.dc_clear_history').bind('click',function(){
			$.ajax({
				url:dc_clear_history_url,
				type:"GET",
				success:function(data){
					$('.search-history').hide();
					$('.history_address').hide();
					$('#now_address').html("<p class='flex-1 address'>定位失败</p><div class='flex-box re-position'><p class='iconfont position-ico'>&#xe691;</p><p>重新定位</p></div>");
				}
			});
			return false;
		});
	
			
	
		$('.result-item').bind("click",function(){
	
			var data=$(this).attr('data-params');
			var dataset=eval("("+data+")");  //json字体串转为json对象
			url=dc_position_url;
			$.ajax({
				url:url,
				type:"POST",
				data:{'xpoint':dataset.lng,'m_longitude':dataset.lng,'ypoint':dataset.lat,'m_latitude':dataset.lat,'dc_title':dataset.title,'dc_content':dataset.content,'dc_num':dataset.dc_num,'city':dataset.city},
				success:function(data){
					if(is_vs){
						location.href=vs_url;
					}else{
						location.href=dc_url;		
					}
	
				}
			});
		});
	
	
		$('.do_search').bind('click',function(){
			var kw=$.trim($("#q_text").val());
		
			searchlocation(kw,CITY_NAME);
		});
	
			
		$('.re-position').live('click', function() {
			relocation();
		})
	});
	
	$('.history_address_d').bind('click',function(){
		var h_val = $(this).html();
		searchlocation(h_val,CITY_NAME);
	});
	
	function init_search_name(){
	
		if(typeof(dc_title)!='undefined'){
		$('#q_text').val(dc_title);
		}
	}
	
	
	function searchlocation(kw,city){
	
		cur_item = null;
		marker_array = new Array();
		var op_ak = BAIDU_APPKEY;
		if($.trim(kw)){
		var op_q=encodeURIComponent(kw);
		}
		else
		{
		var op_q = encodeURIComponent($.trim($("#q_text").val()));
		}
	
		if(op_q==''){
			alert('请输入地址搜索周边商家');
			return false;
		}
		
		var op_page_size = 1;
		var op_page_num = cur_page;
		var op_region = encodeURIComponent(city);
		var url = "http://api.map.baidu.com/place/v2/search?ak="+op_ak+"&output=json&query="+op_q+"&page_size="+op_page_size+"&page_num="+op_page_num+"&scope=1&region="+op_region;
	
		if($.trim($("#q_text").val())){
			$.ajax({
				url:url,
				dataType:"jsonp",
		        jsonp: 'callback',
				type:"GET",
				success:function(obj){
					if(obj.status == 0){			
							var item=obj.results[0];
							var query = new Object();
							query.act = "get_dc_num";
							query.dc_xpoint = item.location.lng;
							query.dc_ypoint = item.location.lat;
							query.dc_title = item.name;
							query.city = city;
							query.dc_content = item.address;
							$.ajax({
								url:DC_AJAX_URL,
								data:query,
								dataType:"json",
								type:"POST",
								success:function(objdata)
								{
					
									url=dc_position_url;
									$.ajax({
										url:url,
										type:"POST",
										dataType:"json",
										data:{'xpoint':item.location.lng,'m_longitude':item.location.lng,'ypoint':item.location.lat,'m_latitude':item.location.lat,'dc_title':item.name,'dc_content':item.address,'dc_num':objdata.dc_num,'city':city},
										success:function(obj){
	
											if(obj.status){
												if(is_vs){
													location.href=vs_url;
												}else{
													location.href=dc_url;		
												}
											}else{
												$.toast(obj.info);
											}
										
										
										}
									});
									
								
								}
							});
							
	
	
					}
				}
			});
		}	
		
	}

	function relocation() {

		var options = {timeout: 8000};
		var geolocation = new qq.maps.Geolocation(TENCENT_MAP_APPKEY, "myapp");
		geolocation.getLocation(showPosition, showErr, options);

	}
	function showPosition(p){
		has_location = 1;//定位成功;
		m_latitude = p.lat; //纬度
		m_longitude = p.lng;
		userxypoint(m_latitude, m_longitude,'GCJ02');
	}
	function showErr(p){
		//alert("定位失败");
		console.log("定位失败");
	}
//将坐标返回到服务端;
	function userxypoint(latitude,longitude,type){
		var query = new Object();
		query.m_latitude = latitude;
		query.m_longitude = longitude;
		query.m_type=type;
		//alert(latitude+":"+longitude);
		//return;
		$.ajax({
			url:geo_url,
			data:query,
			type:"post",
			dataType:"json",
			success:function(data){

				if(data.status==1)
				{
					if(is_vs){
						location.href=vs_url;
					}else{
						location.href=dc_url;		
					}

				}
				else
				{
					alert(data.info);
				}
			}
			,error:function(){
			}
		});
	}
});


			
$(document).on("pageInit", "#dc_res_cart", function(e, pageId, $page) {

	//打开送货时间选择
	$(".j-open-time").on('click', function() {
		$(".dc-mask").addClass('active');
		$(".time-select").addClass('active');
		var send_time=$(this).find('input').attr('value');
		$(".j-time-choose").each(function() {
			if ($(this).attr('value')==send_time) {
				$(this).addClass('active');
			}
		});
	});
	//关闭送货时间选择
	$(".j-close-time").on('click', function() {
		$(".dc-mask").removeClass('active');
		$(".time-select").removeClass('active');
	});
	//选择时间
	$(".j-time-choose").on('click', function() {
        if ($(this).hasClass('timeerror')) {
            $.toast('本时段无法预订');
            return;
        }
        if ($(this).hasClass('fullbuy')) {
            $.toast('本时段预订已满');
            return;
        }
		$(".j-time-choose").removeClass('active');
		$(this).addClass('active');
		$(".j-res-time").html($(this).find('p').html());
		$("#time-value").attr('value', $(this).attr('value'));
	});
	//打开备注
	$(".j-open-memo").on('click', function() {
		$("#memo").focus();
		$(".dc-mask").addClass('active');
		$(".memo-box").addClass('active');
	});
	//关闭备注
	$(".j-close-memo").on('click', function() {
        var memo = $.trim($('textarea[name="dc_comment"]').val()).substr(0,100);
        $('#memo').val(memo);
		close_memo();
	});
	//确认备注
	$(".j-memo").on('click', function() {
        var memo = $.trim($('textarea[name="dc_comment"]').val());
        if (memo == "") {
            $(".j-res-memo").html('<span class="default-txt">备注您的口味、偏好等</span>');
        }else {
            if (memo.length > 100) {
                $.toast('备注不超过100字,当前'+memo.length+'字');
                return;
            }
            $(".j-res-memo").html(memo);
        }
        close_memo();
	});
    function close_memo() {
        $(".dc-mask").removeClass('active');
        $(".memo-box").removeClass('active');
    }
	//选择只订座
	$(".j-only-res").on('click', function() {
        if ($(this).hasClass('active')) {
            return;
        }
		$(".res-way").removeClass('active');
		$(this).addClass('active');
		$("#res-way").attr('value', $(this).attr('value'));
        $('.res-goods-info').hide();
        pay_price_format();
		/* Act on the event */
	});
	//打开菜单
	$(document).on('click', '.j-open-menu', function() {
        /*if ($(this).hasClass('active')) {
            return;
        }*/
        if ($(this).hasClass('res-way')) {
            if ($('.res-goods-info').find('.goods-list li').length > 0) {
                $(".res-way").removeClass('active');
                $(this).addClass('active');
                $("#res-way").attr('value', $(this).attr('value'));
                $('.res-goods-info').show();
                pay_price_format();
                return;
            }
        }
        var param = {
            'lid': location_id, 
            'table_menu_id': table_menu_id,
            'act': 'res_cart_item'
        };
        $.ajax({
            url: CART_URL,
            data: param,
            dataType: 'json',
            success: function(data) {
                $('.j-shop-item').html(data.html);
                $.popup('.popup-menu');
            }
        })
	});
	//关闭菜单
	$(document).on('click', '.j-close-popup', function() {
        refresh_dc_cart();
        $(this).parents('.popup').show();
	    $(this).parents('.popup').removeClass('modal-in').addClass('modal-out');
        pay_price_format();
	});
	//购物车脚本
    $(".plus").bind('click', function() {
    	$(this).parent().removeClass('no-num');
    });
    $(".menu").on('click', '.j-cate-select',function() {
    	$(".m-cate-list").unbind('scroll');
    	$(".j-cate-select").removeClass('active');
    	$(this).addClass('active');
    	var menu_top=$(".menu").offset().top;
    	var list_top=$(".m-cate-list").scrollTop();
    	var cate_top=$(".dc-cate-list").eq($(this).index()).offset().top;
    	s_height=cate_top-menu_top+list_top;
    	$(".m-cate-list").scrollTo({toT:s_height});
    });
    $(".m-cate-list").bind('touchstart', function() {
	    $(".m-cate-list").bind('scroll', function() {
			cate_scroll();
	    });
    });

    function cate_scroll() {
    	var menu_top=$(".menu").offset().top;
    	$(".cate-title").each(function(){
    		var cate_top=$(this).offset().top;
    		if (cate_top<=menu_top) {
    			$(".j-cate-select").removeClass('active');
    			$(".j-cate-select").eq($(this).parent().index()).addClass('active');
    		}
    	});
    }
    $(document).on('click',".j-show-edit", function() {
        if($('.cart-count').hasClass("hide")==false){
            $(".cart-count").toggleClass('active');
            $(".cart-mask").toggleClass('active');
        }
    });
    $(document).on('click', ".j-empty-edit",function() {
        $.toast("购物车是空的");
    });
    $(".no-goods-btn").bind('click', function() {
        $.toast("还未达到最低价格");
    });
    $(document).on('click', ".j-close-edit", function() {
        refresh_dc_cart();
        $(this).parents('.popup').hide();
        $(this).parents('.popup').removeClass('modal-in').addClass('modal-out');
    	// $(".cart-count").removeClass('active');
    	// $(".cart-mask").removeClass('active');
        
    });
    $(".j-open-detail").bind('click', function() {
    	$(".dc-shop-detail").addClass('active');
    });
    $(".j-close-detail").bind('click', function() {
    	$(".dc-shop-detail").removeClass('active');
    });
    $(".menu").on('click', '.m-cate-list .plus',function() {
    	$(".m-fly").addClass('active').css({
    		left: $(this).offset().left,
    		top: $(this).offset().top
    	});
        $(".cart-bar .cart-ico .iconfont").addClass('active');
    	bool.init();
    	bool.setOptions({
    		targetEl: $("#target")
    	});
    	bool.start();
    });
    var bool = new Parabola({
    	el: ".m-fly",
		curvature: 0.004,
		duration: 300,
    	callback:function(){
            setTimeout('$(".cart-bar .cart-ico .iconfont").removeClass("active")', 300);
    		$(".m-fly").removeClass('active');
    	}
    });

    // 确认支付
    $('.res-pay').on('click', function() {
        if ($(this).hasClass('disable')) {
            return;
        }
        // 进本信息判断
        var time_id = $('input[name="order_delivery_time"]').val();
        if (time_id == 0) {
            $.toast('请选择到店时间');
            return;
        }
        var consignee = $.trim($('input[name="consignee"]').val());
        if (!consignee) {
            $.toast('请输入预订人的姓名');
            return;
        }
        var mobile = $.trim($('input[name="mobile"]').val());
        if (mobile == '') {
            $.toast('请输入预订人的手机号');
            return;
        }
        if (/^1[34578]\d{9}$/.test(mobile) == false) {
            $.toast('手机号码格式有误');
            return;
        }
        var dc_comment = $.trim($('textarea[name="dc_comment"]').val());

        // 订座定金
        var res_price = Number($('.res-price').attr('data-value'));
        // 预订方式
        var rs_type = Number($('#res-way').val());
        var count_price = Number($('.count-price').attr('data-value'));
        if (res_price > 0 && rs_type == 2) { // 有订单有点菜
            if (count_price < res_price) {
                $.toast('点菜的金额需要超过定金金额');
                return;
            }
        }
        var param = {
            'lid': location_id,
            'item_time_id': time_id,
            'table_menu_id': table_menu_id,
            'consignee': consignee,
            'mobile': mobile,
            'dc_comment': dc_comment,
            'rs_type': rs_type,
            'rs_date': rs_date,
            'act': 'res_make_order',
            // 'act': 'old_make_order',
        };

        $.ajax({
            url: CART_URL,
            data: param,
            dataType: 'json',
            type: 'post',
            success: function(data) {
                if (data.user_login_status == 0) {
                    $.toast('未登录');
                } else {
                    $.toast(data.info);
                    if (data.status == 1) {
                        setTimeout(function() {
                            $.router.load(data.jump, true);
                        }, 2000);
                    }
                }
            }
        });
    });
    // refresh_dc_cart();
    // 获取实时的购物车信息
    function refresh_dc_cart() {
        var param = {
            'location_id': location_id,
            'table_menu_id': table_menu_id,
            'act': 'dc_res_cart_list',
        };

        $.ajax({
            url: DC_AJAX_URL,
            data: param,
            dataType: 'json',
            type: 'post',
            success: function(data) {
                if (data.list.length > 0) {
                    var list_html = '';
                    // var total_html = '';
                    var list = data.list;
                    for (i in list) {
                        list_html += '<li class="flex-box">' + 
                        '<p class="goods-name flex-1">'+list[i].name+'</p>' + 
                        '<p class="goods-num">x'+list[i].num+'</p>' + 
                        '<p class="goods-price" data-value="'+list[i].unit_price+'">'+list[i].format_unit_price+'</p>' + 
                        '</li>';
                    }
                    $('.res-goods-info .goods-list').html(list_html);
                    $('.count-price').html(data.format_total_price);
                    $('.count-price').attr('data-value', data.total_price);
                    $(".res-way").removeClass('active');
                    $('.j-open-menu').addClass('active');
                    $("#res-way").attr('value', 2);
                    $('.res-goods-info').show();
                } else { // 未点菜
                    $(".res-way").removeClass('active');
                    $('.j-only-res').addClass('active');
                    $("#res-way").attr('value', 1);
                    $('.res-goods-info').hide();
                }
                pay_price_format();
            }
        });
    }

    function pay_price_format() {
        var res_way = Number($('#res-way').val());
        if (res_way != 1 && res_way != 2) {
            res_way = 1;
        }
        item_price = Number(item_price);
        var rht = '预订定金';
        var rp = item_price;
        if (res_way == 1) {
            $('.res-pay').removeClass('disable');
        } else {
            var cp = Number($('.count-price').attr('data-value'));
            if (cp >= item_price) {
                rht = '预订菜金';
                rp = cp;
                $('.res-pay').removeClass('disable');
            } else {
                rht = '还差';
                rp = Math.round((item_price - cp) * 100)/100;
                $('.res-pay').addClass('disable');
            }
        }
        $('.res-content').html(rht);
        $('.res-price').html('&yen;' + rp);
    }
    pay_price_format();
});


function dc_change_res_num(id,count,num) {
    var menu_id=parseInt(id);
    var number=parseInt(num);
    var number_total=parseInt(count)+num;
    if(number_total<0){
        // $.toast("该商品数量无法再减少");
        return;
    }
    if(num==1){
        if(count==0){
            $(".goods-info[data_id='"+id+"']").find(".goods-num-box").removeClass("no-num").addClass("num");
            $item=$("<li class='flex-box b-line'  data_id='"+id+"'>"
                +"<p class='goods-name flex-1'>"+$(".goods-info[data_id='"+id+"']").find(".goods-name").html()+"</p>"
                +"<p class='edit-price' price='"+$(".goods-info[data_id='"+id+"']").find(".price").attr("price")+"'>"+$(".goods-info[data_id='"+id+"']").find(".price").html()+"</p>"
                +"<div class='goods-num-box flex-box'>"
                +"<a href='javascript:void(0);' class='min iconfont' data_id='{$item.menu_id}' onclick='dc_change_res_num("+id+","+number_total+",-1);'>&#xe915;</a>"
                +"<p class='goods-num' data_id='"+id+"'>"+number_total+"</p>"
                +"<a href='javascript:void(0);' class='iconfont plus' data_id='{$item.menu_id}' onclick='dc_change_res_num("+id+","+number_total+",1);'>&#xe685;</a>"
                +"</div></li>");
            $(".edit-list").prepend($item);
        }
    } else{
        if(count==1){
            $(".edit-list").find("li[data_id='"+id+"']").remove();
            $(".goods-info[data_id='"+id+"']").find(".goods-num-box").removeClass("num").addClass("no-num");
        }
    }
    $(".goods-num[data_id='"+id+"']").html(number_total);
    $(".min[data_id='"+id+"']").attr("onclick","dc_change_res_num("+id+","+number_total+",-1);");
    $(".plus[data_id='"+id+"']").attr("onclick","dc_change_res_num("+id+","+number_total+",1);");
    res_cart_total_price();
    
    var query=new Object();
    query.menu_id=menu_id;
    query.number=number;
    query.number_total=number_total;
    // query.tid=tid;
    query.table_menu_id = table_menu_id;
    query.location_id=location_id;
    // query.supplier_id=supplier_id;
    query.act='dc_add_cart';
    $.ajax({
        url:DC_AJAX_URL,
        data:query,
        type:'post',
        dataType:'json',
        success:function(data){
            if(data.status==1){
                
            }else{
                $.toast(data.info);
                setTimeout(function(){
                    window.location.reload();
                },500);
            }
        }
    });
}

//计算购物车商品价格
function res_cart_total_price(){
    var cart_num=0;
    var total_price=0;
    $(".edit-list").find("li[data_id]").each(function(){
        var num=parseInt($(this).find(".goods-num").html());
        var price=parseFloat($(this).find(".edit-price").attr("price"));
        cart_num+=num;
        total_price+=price*num;
    });

    $(".no-goods-btn").remove();
    $(".cart-btn").remove();
    if(total_price>0){
        total_price=total_price.toFixed(2);


        $(".no-goods-txt").hide();
        $(".cart-price").show();
        $(".send-price").show();
        $(".cart-price").html("￥"+total_price);
        $(".cart-ico").removeClass('j-empty-edit');
        $(".cart-ico").addClass('j-show-edit');
    }else{
        $(".no-goods-txt").show();
        $(".cart-price").hide();
        $(".send-price").hide();
        $(".cart-ico").removeClass('j-show-edit');
        $(".cart-ico").addClass('j-empty-edit');
        $(".cart-count").removeClass('active');
        $(".cart-mask").removeClass('active');
        setTimeout('$(".edit-list").empty()', 500);
        $(".goods-info").each(function(){
            $(this).find(".goods-num-box").addClass("no-num");
            $(this).find(".min").attr("onclick","dc_change_res_num("+$(this).attr("data_id")+",0,-1);");
            $(this).find(".plus").attr("onclick","dc_change_res_num("+$(this).attr("data_id")+",0,1);");
        });
    }
    
    $(".num-count").html(cart_num);
    if(cart_num==0){
        $(".num-count").addClass("hide");
    }else{
        $(".num-count").removeClass("hide");
    }
    if(total_price>0){  
        var btn=$("<a class='cart-btn j-close-edit'>确认</a>");
        btn.appendTo($(".cart-bar"));
    }
    else{
        var btn=$("<div class='no-goods-btn cart-btn'>未点菜</div>");
        btn.appendTo($(".cart-bar"));
    }
}

//清空购物车
function dc_res_cart_clear(){
    var query=new Object();
    query.table_menu_id=table_menu_id;
    query.location_id=location_id;
    query.act='dc_cart_clear';
    $.ajax({
        url:DC_AJAX_URL,
        data:query,
        type:'post',
        dataType:'json',
        success:function(data){
            if(data.status==1){
                $('.goods-list').html('');
                $('.res-goods-info').hide();
                $(".edit-list").empty();
                res_cart_total_price();
            }
        }
    });
}
$(document).on("pageInit", "#dc_search_index", function(e, pageId, $page) {

	var cookieKey = "dc_cookobj_" + type;

	$("#search_form").bind('submit',function(){
		return false;
	});
    
    $(".search-btn").bind("click",function(){
    	search_submit();
    	return false;
    });
    
    $('#lid_search_result table tr').live('click',function(){
    	var url=$(this).attr('data-i');
    	location.href=url;
    });
    
    
	//按回车键判断函数
	$(document).keypress(function(e){
        var eCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
        if (eCode == 13){
        	search_submit();
        	return false;
        }
	});
	
	//初始化历史搜索记录
	var cookarr = new Array();
	dc_cookobj = $.fn.cookie(cookieKey);
	if(dc_cookobj){
		var cookarr = dc_cookobj.split(',');
	}
	var key_html='';
	$.each(cookarr,function(i,obj){
		if(obj){
			$("#history").css({display:""});	
		}
		key_html+='<li>'+ obj +'</li>';	
	});
    $(".history-search .key-list").html(key_html);
    
    

	  //搜索提交
	  function search_submit(){
	  	var content=$.trim($("#keyword").val());
	  	if(content==''){
	  		alert("请输入内容！");
	  		window.location.reload();
	  		return false
	  	}else{
	  		if($.inArray(content ,cookarr)== -1){
	  			cookarr.push(content);
	  		}
	  		$.fn.cookie(cookieKey,cookarr);
	  	}
	  	var dc_search_url=$("form[name='search_form']").attr('action');
	  	var query=new Object();
	      query.keyword=content;
	      query.type=$("#keyword").attr('search_type');
	  	$.ajax({
	  		url:dc_search_url,
	  		data:query,
	  		type:'post',
	  		dataType:'json',
	  		success:function(data){
	  			$('#search_content').html(data.html);
	  		    toRed(content);
	  		}
	  	});
	  }
    
	//历史记录点击事件
	$(".key-list li").click(function() {
		$("#keyword").val($(this).text());
		search_submit();
	});  

	//清空历史记录
	$('.confirm-ok').on('click', function () {
	      $.confirm('确定要清空历史数据？', function () {
	          $(".history-search .key-list").remove();
	          $.fn.cookie(cookieKey,cookarr,{ expires: -1 });
	          $("#history").css({display:"none"});
	          window.location.reload();
	      });
	});
 });  

//关键字标红
function toRed(content){
	$("#search_content .shop-name").each(function () {
		var bodyHtml = $(this).html();
		var x = bodyHtml.replace(new RegExp(content,"gm"),"<font color='red' >"+content+"</font>");
		$(this).html(x);
	});
}


$(document).on("pageInit", "#dc_table", function(e, pageId, $page) {

	$('a.rs-btn').on('click', function() {
		if (location_close) {
			$.toast('店铺休息中,暂停预订');
			return;
		} else {
			$.router.load($(this).attr('data-url'), true);
		}
	})

	$(".j-rs-day").on('click', function() {
		$(".j-rs-day").removeClass('active');
		$(this).addClass('active');
		$(".shop-rs-list").removeClass('active');
		$(".shop-rs-list").eq($(this).index()).addClass('active');
	});


	//增加收藏
	$('.add_location_collect').bind('click',function(){
		add_location_collect_function($(this));
        if ($(this).hasClass('collected')) {
            $(this).removeClass('collected');
        } else {
            $(this).addClass('collected');
        }
	});
});
$(document).on("pageInit", "#dc_table_list", function(e, pageId, $page) {
	init_list_scroll_bottom();//下拉刷新加载
	$("#dc_table_list").on('click', '.j-open-select', function() {
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
			$(".dc-select").removeClass('active');
			$(".dc-mask").removeClass('active');
		} else {
			$(".j-open-select").removeClass('active');
			$(this).addClass('active');
			$(".dc-select").removeClass('active');
			$(".dc-select").eq($(this).index()).addClass('active');
			$(".dc-mask").addClass('active');
		}
	});
	/*$(".dc-dp-dis").find(".j-ajaxchoose").click(function(){
		$(".dc-cate-list").find(".j-ajaxchoose").removeClass("active");
		$(this).addClass("active");
		var sort=$(this).attr('data-id');
		$("input[name='sort']").val(sort);
		var sort=$(this).find(".select-tit").html();
		$(".now-sort").html(sort);
		param_location();
	});*/
	$('.dc-dp-dis').on('click', '.j-ajaxchoose', function() {
		$(".dc-cate-list").find(".j-ajaxchoose").removeClass("active");
		$(this).addClass("active");
		var sort=$(this).attr('data-id');
		$("input[name='sort']").val(sort);
		var sort=$(this).find(".select-tit").html();
		$(".now-sort").html(sort);
		param_location();
	})
	/*$(".dc-cate-list").find(".j-ajaxchoose").click(function(){
		$(".dc-cate-list").find(".j-ajaxchoose").removeClass("active");
		$(this).addClass("active");
		var sort=$(this).attr('data-id');
		$("input[name='cid']").val(sort);
		var cate=$(this).find(".select-tit").html();
		$(".now-cate-name").html(cate);
		param_location();
	});*/
	$('.dc-cate-list').on('click', '.j-ajaxchoose', function() {
		$(".dc-cate-list").find(".j-ajaxchoose").removeClass("active");
		$(this).addClass("active");
		var sort=$(this).attr('data-id');
		$("input[name='cid']").val(sort);
		var cate=$(this).find(".select-tit").html();
		$(".now-cate-name").html(cate);
		param_location();
	})
	/*$(".dc-area").find('.j-ajaxchoose').click(function() {
		$(".dc-area").find(".j-ajaxchoose").removeClass("active");
		$(this).addClass("active");
		var qid=$(this).attr('data-id');
		$("input[name='qid']").val(qid);
		var aid=$(this).parents('ul').attr('data-id');
		$("input[name='aid']").val(aid);
		var dc_area=$(this).find(".select-tit").html();
		$(".now-area-name").html(dc_area);
		param_location();
	});*/
	$('.dc-area').on('click', '.j-ajaxchoose', function() {
		$(".dc-area").find(".j-ajaxchoose").removeClass("active");
		$(this).addClass("active");
		var qid=$(this).attr('data-id');
		$("input[name='qid']").val(qid);
		var aid=$(this).parents('ul').attr('data-id');
		$("input[name='aid']").val(aid);
		var dc_area=$(this).find(".select-tit").html();
		$(".now-area-name").html(dc_area);
		param_location();
	})
	$("#dc_table_list").on('click', '.j-area', function() {
		$(".j-area").removeClass('active');
		$(this).addClass('active');
		$(".area-list").removeClass('active');
		$(".area-list").eq($(this).index()).addClass('active');
		/* Act on the event */
	});
	$("#dc_table_list").on('click', '.j-close-select', function() {
		$(".j-open-select").removeClass('active');
		$(".dc-select").removeClass('active');
		$(".dc-mask").removeClass('active');
		// param_location();
	});
	function param_location(){
		var query = $("form[name='dc_location_param']").serialize();
		var ajax_url = $("form[name='dc_location_param']").attr("action");
		$(".content").scrollTop(0);
		$(document).off('infinite', '.infinite-scroll-bottom');
		$.ajax({
			url:ajax_url,
			data:query,
			dataType:"html",
			type:"POST",
			success:function(html){
				$(".j-ajaxlist").html($(html).find(".j-ajaxlist").html());
				$(".dc-cate-list").html($(html).find('.dc-cate-list').html());
				$(".dc-dp-dis").html($(html).find('.dc-dp-dis').html());
				$(".dc-area").html($(html).find('.dc-area').html());
				init_list_scroll_bottom();
			}
		});
		return false;
	}

});

$(document).on("pageInit", "#deal", function(e, pageId, $page) {
	loadScript(jia_url);
	$(".j-activeopen").attr("style","");
	$('.content').scrollTop(0);
	//获得默认库存
	var defaultStock=$(".spec-goodstock").text();
	//收藏
	//二维码
	select_box($(".j-open-qrcode"),$(".m-qrcode-box"));

	/*轮播初始化*/
	var mySwiper = new Swiper ('.j-deal-content-banner', {

		autoplay: 3000,/*设置3秒自动播放*/
		spaceBetween: 10,/*图间间隔10px*/
		onSlideChangeStart: function(swiper){/*回调函数：开始变化*/
			slideIndex();
		}
	});


	/*
	 *初始化轮播分页器
	*/
	slideIndex();


	/*
	 *初始化商家标签区是否显示更多图标
	*/
	setFuliIcon();


	/*
	 *显示更多商家标签与商家优惠
	 *用户点击显示区域，下拉显示更多信息，再次点击收起更多信息
	 *区域标识，用于区分商家标签与商家优惠  1：商家优惠   2：商家标签
	*/
	$(".j-activeopen").click(function(){
		var rel = $(this).attr("rel");//区域标识

		if(rel == 1){
			var childlengh = $(this).children("li").length;
		}else if (rel == 2) {
			var allliwidth = 0;
			$(this).children("li").each(function(){
				allliwidth += (parseInt($(this).width()) + parseInt($(this).css("margin-right").replace("px","")));
			});

			var ulwidth = $(this).width();
			var childlengh = Math.ceil(allliwidth / ulwidth);
		}

		var thisheight = $(this).height();
		var childheight = $(this).children("li").height();
		var childmargin = parseInt($(this).children("li").css("margin-top").replace("px",""));
		if(childlengh > 1){
			if($(this).hasClass("isClick")){
				$(this).removeClass("isClick");
				$(this).height(childheight + childmargin * 2);
			}else{
				$(this).addClass("isClick");
				$(this).height((childheight * childlengh)  + (childmargin * (childlengh + 1)));
			}
		}
	});


	/*
	 *显示当前商家更多团购信息
	 *用户点击显示区域，下拉显示更多信息，再次点击收起更多信息
	*/

	$(".j-tuan-showMore").click(function(){
		var childheight = $(this).parent().children(".tuan-list").children("li").height();  //子项高度，用于计算更多高度
		var childlengh = $(this).parent().children(".tuan-list").children("li").length;     //子项个数，用于计算更多高度

		if (childlengh > 1) {
			if($(this).hasClass("isClick")){
				$("#other").html($("#other").attr("content"));
				$(this).removeClass("isClick");
				$(this).parent().children(".tuan-list").height(childheight);
			}else{
				$("#other").html("收起");
				$(this).addClass("isClick");
				$(this).parent().children(".tuan-list").height(childheight * childlengh);
			}
		}
	});

	/*
	 *tab切换时下划线跟随
	*/
//	var t_height=$(".m-head-nav").height();
//	var s_height=$(".deal-detail").offset().top;
//	$(".j-tab-link").click(function(){
//      var $me=$(this);
//		var type = $(this).parent(".tab-list").attr("data-type");
//		var rel = parseInt($(this).attr("rel"));
//		if(rel == 0){
//			$(".content").scrollTop(0);
//          tab_lick_callback($me,type,rel);
//      }
//      else if (rel == 1) {
//			$(".content").scrollTop(s_height-t_height);
//          tab_lick_callback($me,type,rel);
//      }
//      else{
//          tab_lick_callback($me,type,rel);
//      }
//      if ($me.hasClass("active")) {
//			var ac_left = $(".j-tab-link.active").offset().left;
//			$('.m-head-nav .tab-line').css("left",ac_left);
//      }
//	});
	var ac_left = $(".j-tab-link.active").offset().left;
	var ac_width = $(".j-tab-link.active").width();
	$('.m-head-nav .tab-line').css({"left":ac_left,"width":ac_width});
    /**
     * 异步加载点评列表
     */
    function ajax_load_tab3(){
        $.post(get_dp_detail_url,"",function(data){
           var $html=$(data);
           if($html.length){
               $("#tab3").html($html.find("#tab3").html());
               $("#dp_list_click").html($html.find("#dp_list_click").html());
           }
        });
    }
    ajax_load_tab3();

    function tab_lick_callback($me,type,rel){
        $(".j-tab-link").removeClass("active");
        $me.addClass("active");
        setTablineLeft($me.parent(),type,rel);
    }

	$(".j-detail").live("click",function(){
		var index = $(this).attr("data");
		var type = $(this).attr("data-type");
		$(".native-scroll").scrollTop(0);
		setTablineLeft($(".tab-list"),type,index);
		$(".tab-link").eq(index).addClass("active");
	});
    /**
     * 加载推荐列表
     */
    function load_recomend_data(){
        $.get(get_recommend_data_url,"",function(data){
            var html=$(data).html();
            if(html){
                $("#recommend_data").html(html);
            }
        });
    }
    load_recomend_data();
	/*倒计时*/
	leftTimeAct();
	
	var leftTimeObj = setInterval(leftTimeAct,1000);
	function leftTimeAct(){
		var leftTime = parseInt($(".AdvLeftTime").attr("data"));
		
		if(leftTime > 0)
		{
			var day  = parseInt(leftTime / 24 /3600);
			var hour = parseInt((leftTime % (24 *3600)) / 3600);
			var min  = parseInt((leftTime % 3600) / 60);
			var sec  = parseInt((leftTime % 3600) % 60);
			if(day<10){
				day="0"+day;
			}
			if(hour<10){
				hour="0"+hour;
			}
			if(min<10){
				min="0"+min;
			}
			if(sec<10){
				sec="0"+sec;
			}
			$(".AdvLeftTime").find(".day").html(day);
			$(".AdvLeftTime").find(".hour").html(hour);
			$(".AdvLeftTime").find(".min").html(min);
			$(".AdvLeftTime").find(".sec").html(sec);
			leftTime--;
			$(".AdvLeftTime").attr("data",leftTime);
		}
		else{
			$(".AdvLeftTime").html('团购已结束');			
			clearInterval(leftTimeObj);
		}
	}


	/*
	 *底部加入购物车按钮
	*/
	$(".j-addcart").click(function(){
		$(".j-flippedout-close").attr("rel","spec");
		$(".j-spec-choose-close").attr("rel","spec");
		$(".flippedout-spec").addClass("showflipped").addClass("z-open");
		$(".spec-choose").addClass("z-open");
		$(".spec-btn-list").addClass("isAddCart");
		$(".totop").addClass("vhide");//隐藏回到头部按钮
	});

	init_addcart();
	/*
	 *底部立即购买按钮
	 *如未在规格选择按钮选择完所有属性，将规格选择窗口关闭，再次点击购买按钮则会再次弹出规格选择窗口
	 *如果在规格选择窗口选择完所有属性，则进行购买操作，不再弹出规格选择窗口
	 */
	$(".j-nowbuy").click(function(){
		if(is_login==0){
			if(app_index=="app"){
				App.login_sdk();
			}else{
				$.router.load(login_url, true);
			}
			return false;
		}
		var data_num = $(".choose-list").length;//获取属性个数
			//  未选择完商品属性，执行弹出规格选择窗口
			$(".j-flippedout-close").attr("rel","spec");
			$(".j-spec-choose-close").attr("rel","spec");
			$(".flippedout-spec").addClass("showflipped").addClass("z-open");
			$(".spec-choose").addClass("z-open");
			$(".totop").addClass("vhide");//隐藏回到头部按钮
	});
	$(".nowbuy").click(function(){
		var data_num = $(".choose-list").length;//获取属性个数
		//var choose_num = $(".good-specifications span em").length; //获取已选属性个数
		var choose_num = $(".flippedout-spec .spec-goodspec em.choose_item").length; //获取已选属性个数
		if (choose_num < data_num) {
			//  未选择完商品属性，执行弹出规格选择窗口
			$.toast("请选择商品规格");
		}else{
			// 已经选择完商品属性，执行购买操作
			now_buy=1;
			$("#goods-form").submit();
		}
	});
	$(".isOk,a.joincart").click(function(){
		var data_num = $(".choose-list").length;//获取属性个数
		//var choose_num = $(".good-specifications span em").length; //获取已选属性个数
		var choose_num = $(".flippedout-spec .spec-goodspec em.choose_item").length; //获取已选属性个数
		if (choose_num < data_num) {
			//  未选择完商品属性，执行弹出规格选择窗口
			$.toast("请选择商品规格");
		}else{
			// 已经选择完商品属性，执行购买操作
			$("input[name='type']").val("1");
			now_buy=0;
			$("#goods-form").submit();
		}
	});

	/*
	 *规格选择窗口 加减按钮事件
	 */
	$(".flippedout-spec").on('click',".j-add-miuns",function(){
		fun_add_miuns($(this));

		var max=parseInt($(this).attr("max-num"));
		//alert($(".numplusminus").val());
		if(max>=0 && parseInt($(".numplusminus").val())>=max){
			$(this).attr("class","numadd add-miuns j-add-miuns j-add isUse");
			$(".numplusminus").val(max);
		}else{
			setSpecgood();
		}
	});
	$(".choose-list .j-choose").click(function(){
		if($(this).hasClass("active")){ //点击已选择属性，则取消选择
			$(this).removeClass("active");
			$(this).parent().siblings(".spec-tit").addClass("unchoose");
			setSpecgood();
		}else if(!$(this).hasClass("isOver")){
			//判断是否是无库存属性，
			//如果不是无库存则正常选择，无库存属性不做任何操作
			$(this).siblings(".j-choose").removeClass("active");
			$(this).addClass("active");
			$(this).parent().siblings(".spec-tit").removeClass("unchoose");
			setSpecgood();
		}
		var data_value= $(".j-choose.active").attr("data-value");
		var data_id= $(this).attr("data-id");
		$(this).parent().siblings("input.spec-data").val(data_id);
		var data_value = []; // 定义一个空数组
		var txt = $('.j-choose.active'); // 获取所有文本框
		for (var i = 0; i < txt.length; i++) {
			data_value.push(txt.eq(i).attr("data-value")); // 将文本框的值添加到数组中
		}

		if (txt.length == 0) {//非初始化状态时，未选择属性页面操作区内容同步规格选择窗口内容
			$(".good-specifications span").empty();
			$(".good-specifications span").removeClass("isChoose");
			$(".good-specifications span").html($(".spec-goodspec").html());
		}else{//将已选择属性显示在页面操作区
			$(".good-specifications span").empty();
			$(".good-specifications span").addClass("isChoose");
			$(".good-specifications span").append("<i class='gray'>已选规格：</i>");
			$.each(data_value,function(i){
				$(".good-specifications span").append("<em class='tochooseda'>" + data_value[i] + "</em>");
				//传值可以考虑更改这里
				//$(".spec-data").attr("data-id-str"+[i],data_value[i]);
			});
		}
	});





	setSpecgood();
	function setSpecgood() {
		if($(".unchoose").length != 0){
			$(".spec-goodspec").empty();
			$(".spec-goodspec").append("请选择");
			$(".spec-goodstock").text(defaultStock);
			$(".spec-goodprice").text("￥"+deal_price.toFixed(2));
			$("input[name='max_bought']").val("0");
			$(".spec-btn-list").removeClass("isNo");
			$(".spec-btn-list div.noStock").text("确定");
			$(".unchoose").each(function(){
				// 选择<em></em>
				$(".spec-goodspec").append("<em>&nbsp;&nbsp;" + $(this).html() + "</em>");
			});
		}else{
			$(".spec-goodspec").empty();
			$(".spec-goodspec").append("已选择");
			$(".j-choose.active").each(function(){
				$(".spec-goodspec").append("<em class='choose_item'>&nbsp;&nbsp;" + $(this).attr("data-value") + "</em>");
			});
			//开始计算属性库存
			//var pirce=parseFloat(deal_price);
			//$(".choose-list .active").each(function(){
			//	pirce+=parseFloat($(this).attr("pirce"));
			//	$(".spec-goodprice").text("￥"+pirce.toFixed(2));
			//});

			if($(".choose-list").length!=0)
			init_buy_ui();//检测库存
			init_submit_btn_status();
		}
	}

	//库存检测-更新面板-改变按钮状态
	function init_buy_ui(){
			var is_stock = true;      //库存是否满足
			var stock = deal_stock;   //无规格时的库存数
			var deal_show_price = deal_price;
			var deal_show_buy_count = deal_buy_count;
			var deal_remain_stock = -1;  //剩余库存 -1:无限

			var attr_checked_ids = []; // 定义一个空数组
			var txt = $('.j-choose.active'); // 获取所有选中对象
			for (var i = 0; i < txt.length; i++) {
				attr_checked_ids.push($('.j-choose.active').eq(i).attr("data-id")); // 将文本框的值添加到数组中
			}
			var attr_checked_ids = attr_checked_ids.sort(); //排序
			var attr_checked_ids_str = attr_checked_ids.join("_");//转字符串 _ 分割
			var attr_spec_stock_cfg = deal_attr_stock_json[attr_checked_ids_str];
			if(attr_spec_stock_cfg)
			{
				deal_show_buy_count = attr_spec_stock_cfg['buy_count'];
				stock = attr_spec_stock_cfg['stock_cfg'];
				$(".spec-goodprice").text("￥"+(parseFloat(deal_price)+parseFloat(attr_spec_stock_cfg['price'])).toFixed(2));
			}
			else
			{//单个属性库存
				var has_stock_attr = false;
				for(var k=0;k<attr_checked_ids.length;k++)
				{
					var key = attr_checked_ids[k];
					attr_spec_stock_cfg = deal_attr_stock_json[key];
					if(attr_spec_stock_cfg)
					{
						stock = attr_spec_stock_cfg['stock_cfg'];
						has_stock_attr = true;
						break;
					}
				}
				if(!has_stock_attr)
				stock = -1;
			}
			//判断库存是否大于0
			//更新库存显示
			//判断库存，并更新数量显示
			//判断库存是否小于最小购买量，表示库存不足
			if(stock>0){
				$(".spec-goodstock").text("库存:"+stock+"件");
				$(".j-add-miuns").attr("max-num",stock);
				var num=parseInt($(".numplusminus").val());
				//alert(num);
				if(num>stock){
					$(".numplusminus").val(stock);
				}else if(num==0){
					$(".numplusminus").val(1);
				}
			}else{
				if(stock==-1){
					$(".spec-goodstock").text("库存:不限");
					$(".j-add-miuns").attr("max-num",100);
				}
				else{
					$(".spec-goodstock").text("库存:0 件");
					$(".j-add-miuns").attr("max-num",0);
					$(".numplusminus").val(0);
				}
			}
			$("input[name='max_bought']").val(stock);


	}
	//初始化购物车等相关提交按钮状态
	function init_submit_btn_status(){

			var is_stock=true;
			var deal_remain_stock=parseInt($("input[name='max_bought']").val());
			var buy_num=parseInt($("input[name='num']").val());
			var str='';
			if(deal_remain_stock>=0)
			{
                   if(buy_num>deal_remain_stock)
				{
					is_stock = false;
					str="库存不足";
				}
				else if(deal_user_max_bought>0&&buy_num>deal_user_max_bought)
				{
					is_stock = false;
					str="每单最多购买"+deal_user_max_bought+"份";
				}
			}
			else
			{
                   if(deal_user_max_bought>0&&buy_num>deal_user_max_bought)
				{
					is_stock = false;
					str="每单最多购买"+deal_user_max_bought+"份";
				}
			}
			//alert(11);
			if(is_stock){
				$(".spec-btn-list").removeClass("isNo");
			}else{
				$(".spec-btn-list").addClass("isNo");
				$(".spec-btn-list div.noStock").text(str);
			}

	}


	/*
	 *底部收藏按钮
	 *如果已经收藏则执行以下操作，否则本阶段不执行操作
	 */
	 $(".j-collection").click(function(){
		var is_del = $(this).attr("data-isdel");
		if(is_del == 1){
			//打开取消框
			$(".flippedout").addClass("z-open");
			$(".flippedout").addClass("showflipped");
			$(".cancel-shoucan").addClass("z-open");
		}else{
			if(is_login==0){
				if(app_index=="app"){
					App.login_sdk();
				}else{
					$.router.load(login_url, true);
				}
			}else{
				deal_add_collect(deal_id);
			}
		}
	});

	$(".j-head-collect").on("click",function(){
		var is_del = $(this).attr("data-isdel");
		$(".cancel-shoucan").attr("data-ishead",1);
		if(is_del == 1){
		 	//打开取消框
			$(".cancel-shoucan").addClass("z-open");
		}else{
			if(is_login==0){
				if(app_index=="app"){
					App.login_sdk();
				}else{
					$.router.load(login_url, true);
				}
			}else{
				deal_add_collect(deal_id);
			}
		}
	});

	/*
	 *取消收藏按钮弹出后的取消
	*/

	$(".cancel-shoucan .j-cancel").click(function(){
		var is_head = $(".cancel-shoucan").attr("data-ishead");
		if(is_head != 1){
			$(".flippedout").removeClass("z-open");
			$(".flippedout").removeClass("showflipped");
			$(".cancel-shoucan").removeClass("z-open");
		}else{
			$(".cancel-shoucan").removeClass("z-open");
			$(".cancel-shoucan").attr("data-ishead",0);
		}
	});

	/*
	 *取消收藏按钮弹出后的确认
	*/

	$(".cancel-shoucan .j-yes").click(function(){
		var is_head = $(".cancel-shoucan").attr("data-ishead");
		deal_del_collect(deal_id);
		if(is_head != 1){
			$(".flippedout").removeClass("z-open");
			$(".flippedout").removeClass("showflipped");
			$(".cancel-shoucan").removeClass("z-open");
		}else{
			$(".cancel-shoucan").removeClass("z-open");
			$(".cancel-shoucan").attr("data-ishead",0);
			$(".flippedout").removeClass("showflipped").removeClass("dropdowm-open");
			$(".m-nav-dropdown").removeClass("showdropdown");
			$(".nav-dropdown-con").removeClass("dropdown-open");
		}
	});


	// 评价页滚动加载
	var stop=true;
	//var ajax_url=ajax_url;
	function ajax_dp_list(){
		var page=2;
		var page_total = 0;
		var pageload=$(".page-load");
		if (pageload.length==0) {
			var loadhtml="<div class='page-load hide'><span class='loading'>"+"</span></div>"
			$(".j-ajaxlist").append(loadhtml);
		};
		$(document).on('infinite',function() {

			if ($("#tab3").hasClass("active")) {
			$(".page-load").removeClass("hide");
			    if(stop==true){ 
			        stop=false; 
			        var query = new Object();
			        query.data_id = deal_id;
			        query.page = page;
			        query.act="ajax_dp_list";
			        query.dpajax = 1;
			        $.ajax({
		                url: ajax_url,
		                data: query,
		                type: "POST",
		                dataType: "json",
		                success: function (obj) {
		                	if (obj.html != '') {
		                		$(".page-load span").removeClass("loaded").addClass("loading").html("");
			                    $(".j-ajaxadd").append(obj.html);    
			                    stop=true;
			                    page++;
		                	} else {
		                		$(".page-load span").removeClass("loading").addClass("loaded").html("拉到底部啦~");
		                	}
		                },
		                error: function() {
		                    $(".page-load span").html("网络被风吹走啦~");
		                }
			        });
			    } else{
			    	$(".page-load span").removeClass("loading").addClass("loaded").html("拉到底部啦~");
			    }

			};
		});
	}

	if ($('.comment-tit').length == 2) {
		ajax_dp_list();
	}

	// 小能
	$('.xnOpenSdk').bind('click', function() {
		if (app_index != 'app') {
			return;
		}
		if(is_login==0){
			App.login_sdk();
			return false;
		}
		var xnOptionsObj = {
			goods_id:deal_id,
			goods_showURL:$(this).attr('goods_showURL'),
			goodsTitle: $(this).attr('goodsTitle'),
			goodsPrice: $(this).attr('goodsPrice'),
			goods_URL: $(this).attr('goods_URL'),
			settingid: $(this).attr('settingid'),
			appGoods_type: '3',
		};
		xnOptions = JSON.stringify(xnOptionsObj);
		try {
			App.xnOpenSdk(xnOptions);
		} catch (e) {
			$.toast(e);
		}
	})
});




function deal_del_collect(id){
		var query = new Object();
		query.id = id;
		query.act = "del_collect";
		$.ajax({
			url: ajax_url,
			data: query,
			dataType: "json",
			type: "post",
			success: function(obj){
				if(obj.status==0 && obj.user_login_status==0){
					$.alert(obj.info,function(){
						window.location.href=obj.jump;
					});
				}
				if(obj.status == 1){
					$.toast(obj.info);	
					$(".j-collection").attr("data-isdel",0);
					$(".j-head-collect").attr("data-isdel",0);
					$("i.icon-collection").removeClass("isCollection");
					if(obj.collect_count>0){
						$("div.is_Sc").html("<div class='shoucan isSc'><i class='iconfont'>&#xe615;</i><em>"+obj.collect_count+"</em></div>");
					}else{
						$("div.is_Sc").html('<i class="iconfont" id="is_Sc" style="font-size: 1.2rem;">&#xe615;</i>');
					}
				}
			},
			error:function(ajaxobj)
			{
//						if(ajaxobj.responseText!='')
//						alert(ajaxobj.responseText);
			}
		});
	}
	function deal_add_collect(id){
		var query = new Object();
		query.id = id;
		query.act = "add_collect";
		$.ajax({
			url: ajax_url,
			data: query,
			dataType: "json",
			type: "post",
			success: function(obj){
				if(obj.status==0 && obj.user_login_status==0){
					$.toast("请先登录");
					setTimeout(function(){
						window.location.href=obj.jump;
					},1000);
				}
				if(obj.status == 1){
					$(".j-collection").attr("data-isdel",1);
					$(".j-head-collect").attr("data-isdel",1);
					$("i.icon-collection").addClass("isCollection");
					$.toast(obj.info);	
					$("div.is_Sc").html("<div class='shoucan isSc'><i class='iconfont icon-noshoucan'>&#xe615;</i><i class='iconfont icon-shoucan'>&#xe63d;</i><em>"+obj.collect_count+"</em></div>");
					$(".flippedout").removeClass("showflipped").removeClass("dropdowm-open");
					$(".m-nav-dropdown").removeClass("showdropdown");
					$(".nav-dropdown-con").removeClass("dropdown-open");
				}
			},
			error:function(ajaxobj)
			{
//						if(ajaxobj.responseTexst!='')
//						alert(ajaxobj.responseText);
			}
		});
	}

/*
 *初始化商家标签区是否显示更多图标
 *循环遍历累加每个子项的宽度，如果大于内容区域大小则显示更多图标
*/
function setFuliIcon(){
	var ulwidth = $(".shop-fuli").children(".j-activeopen").width();//内容区域宽度
	var allliwidth = 0;//内容宽度，循环遍历累加每个子项的宽度
	$(".shop-fuli").children(".j-activeopen").children("li").each(function(){
		allliwidth += (parseInt($(this).width()) + parseInt($(this).css("margin-right").replace("px","")));
	});

	if(allliwidth < ulwidth){ //如果大于内容区域大小则显示更多图标
		$(".shop-fuli").children(".j-activeopen").children(".iconfont").hide();
	}
}


/*
 *自定义轮播分页器
*/
function slideIndex(){
	var index = $(".swiper-slide-active").attr("rel");
	$(".slideindex em").html(index);
}


/*
 *用于计算tab下划线移动距离
*/
function setTablineLeft(e,type,index){
	if (type == 0) {
		if(index == 1){
			var parentwidth = (e.width() / 3 * index) - 1;
		}else{
			var parentwidth = e.width() / 3 * index;
		}
	}else if (type == 1) {
		if(index > 0){
			var parentwidth = e.width() / index;
		}else{
			var parentwidth = 0;
		}
		
	}
	// $('.m-head-nav .buttons-tab .tab-line').css("left",parentwidth);
}

function init_addcart()
{
	var is_lock=false;
	$("#goods-form").bind("submit",function(){
		if(is_lock) return false;
		is_lock=true;
		var is_stock=true;
		var deal_remain_stock=parseInt($("input[name='max_bought']").val());
		var buy_num=parseInt($("input[name='num']").val());
		if(deal_remain_stock>=0)
		{
			if(buy_num>deal_remain_stock)
			{
				is_stock = false;
				$.toast("库存不足");
			}
			else if(deal_user_max_bought>0&&buy_num>deal_user_max_bought)
			{
				is_stock = false;
				$.toast("每单最多购买"+deal_user_max_bought+"份");
			}
		}
		else
		{
            if(deal_user_max_bought>0&&buy_num>deal_user_max_bought)
			{
				is_stock = false;
				$.toast("每单最多购买"+deal_user_max_bought+"份");
			}
		}
		if(is_stock){
			var query = $(this).serialize();
			var action = $(this).attr("action");
			$.ajax({
				url:action,
				data:query,
				type:"POST",
				dataType:"json",
				success:function(obj){
					if(obj.status==-1)
					{
						$.router.load(obj.jump, true);
					}
					else if(obj.status)
					{
						$(".cart-num").html(obj.cart_num);
						if(obj.in_cart==0){
							if(obj.jump!=""){
								
								$(".flippedout-spec").removeClass("z-open");
								$(".spec-choose").removeClass("z-open");
								$(".flippedout-spec").removeClass("showflipped");
								$(".spec-btn-list").removeClass("isAddCart");
								
								$.showIndicator();
							    setTimeout(function () {
							    	$.hideIndicator();
							    }, 2000);
								$.router.load(obj.jump, true);
							}else{
								is_lock=false;
							}
							
						}else{
							$.toast("加入购物车成功");
							$(".flippedout-spec").removeClass("z-open");
							$(".spec-choose").removeClass("z-open");
							$(".flippedout-spec").removeClass("showflipped");
							$(".spec-btn-list").removeClass("isAddCart");
							setTimeout("$('.flippedout').removeClass('showflipped')",300);
							$('.cart-num').removeClass('hide');
							if(now_buy==1){
								$.router.load(cart_url, true);
							}else{
								is_lock=false;
							}
						}
						
					}
					else
					{
						$.alert(obj.info);
						is_lock=false;
					}
				},
				error:function(o){
					$.alert(o.responseText);
					is_lock=false;
				}
			});
		}else{
			is_lock=false;
		}
		
		return false;
	});
}


$(document).on("pageInit", "#dealgroup", function(e, pageId, $page) {
	$(".goods-check").click(function() {
		if ($(this).find(".iconfont").hasClass('active')) {
		$(this).find(".iconfont").removeClass('active');
		init_price(main_id);
		} else {
		$(this).find(".iconfont").addClass('active');
		init_price(main_id);
		}
	});
	$(".j-open-choose").unbind( "click" );
	$(".j-open-choose").click(function(){
		//alert($(this).attr("data-id"));
		$(".j-flippedout-close").attr("rel","spec");
		$(".j-spec-choose-close").attr("rel","spec");
		$(".flippedout").addClass("showflipped");
		$(".spec-choose[data-id='"+$(this).attr("data-id")+"']").children(".j-flippedout-close").addClass("showflipped");
		$(".flippedout").addClass("z-open");
		$(".spec-choose[data-id='"+$(this).attr("data-id")+"']").addClass("z-open");
	});

	$(".j-spec-choose-close,.j-flippedout-close").unbind( "click" );
	
	
	$(".choose-list .j-choose").click(function(){
		var dataid=$(this).closest(".spec-choose").attr("data-id");
		if($(this).hasClass("active")){ //点击已选择属性，则取消选择
			$(this).removeClass("active");
			$(this).parent().siblings(".spec-tit").addClass("unchoose");
			$(this).closest(".choose-part").removeAttr("data-value");
			setSpecgood(dataid);
			init_price(main_id);
		}else if(!$(this).hasClass("isOver")){
			//判断是否是无库存属性，
			//如果不是无库存则正常选择，无库存属性不做任何操作
			$(this).siblings(".j-choose").removeClass("active");
			$(this).addClass("active");
			$(this).parent().siblings(".spec-tit").removeClass("unchoose");
			$(this).closest(".choose-part").attr("data-value",$(this).attr("data-value"));
			setSpecgood(dataid);
			init_price(main_id);
		}
		/*var data_value= $(".j-choose.active").attr("data-value");
		var data_id= $(this).attr("data-id");
		$(this).parent().siblings("input.spec-data").val(data_id);
		var data_value = []; // 定义一个空数组
		var txt = $('.j-choose.active'); // 获取所有文本框
		for (var i = 0; i < txt.length; i++) {
			data_value.push(txt.eq(i).attr("data-value")); // 将文本框的值添加到数组中
		}

		if (txt.length == 0) {//非初始化状态时，未选择属性页面操作区内容同步规格选择窗口内容
			$(".good-specifications span").empty();
			$(".good-specifications span").removeClass("isChoose");
			$(".good-specifications span").html($(".spec-goodspec").html());
		}else{//将已选择属性显示在页面操作区
			$(".good-specifications span").empty();
			$(".good-specifications span").addClass("isChoose");
			$(".good-specifications span").append("<i class='gray'>已选规格：</i>");
			$.each(data_value,function(i){
				$(".good-specifications span").append("<em class='tochooseda'>" + data_value[i] + "</em>");
				//传值可以考虑更改这里
				//$(".spec-data").attr("data-id-str"+[i],data_value[i]);
			});
		}*/
	});
	
	$(".j-spec-choose-close,.j-flippedout-close,.goods-confirm").click(function(){
		var id=$(".spec-choose.z-open").attr("data-id");
		//$("a.j-open-choose[data-id='"+id+"'] span").empty();
		/*
		if($(".spec-choose[data-id='"+id+"']").find(".unchoose").length != 0){
			$("a.j-open-choose[data-id='"+id+"'] span").addClass("defult");
			$("a.j-open-choose[data-id='"+id+"'] span").text("选择商品属性");
		}else{
			$(".spec-choose[data-id='"+id+"']").find(".j-choose.active").each(function(){
				$("a.j-open-choose[data-id='"+id+"'] span").append( $(this).html() + "&nbsp;");
				$("a.j-open-choose[data-id='"+id+"'] span").removeClass("defult");
			});
		}*/
		$("a.j-open-choose[data-id='"+id+"']").parent().siblings("span").empty();
		var stock=parseFloat($(".spec-choose[data-id='"+id+"']").find(".spec-goodstock").attr("data-stock"));
		if(stock==0){
			$.toast("库存不足");
			$("a.j-open-choose[data-id='"+id+"']").parent().siblings("span").append("<em>&nbsp;&nbsp;库存不足</em>");
		}
			
		$(".flippedout").removeClass("z-open");
		$(".spec-choose").removeClass("z-open");
		$(".j-flippedout-close").removeClass("showflipped");
		$(".spec-btn-list").removeClass("isAddCart");
		$(".nav-dropdown-con").removeClass("dropdown-open");
		$('.flippedout').removeClass('showflipped');
		$(".j-flippedout-close").children(".iconfont").removeClass("jump");
		
	});
	function setSpecgood(id) {
		if($(".spec-choose[data-id='"+id+"']").find(".unchoose").length != 0){
			$(".spec-choose[data-id='"+id+"']").find(".spec-goodspec").empty();
			$(".spec-choose[data-id='"+id+"']").find(".spec-goodspec").append("请选择");
			//$(".spec-choose[data-id='"+id+"']").find(".spec-goodstock").text(defaultStock);
			$(".spec-choose[data-id='"+id+"']").find(".spec-goodprice").text($(".spec-choose[data-id='"+id+"']").find(".spec-goodprice").attr("data-text"));
			var stock=parseFloat($(".spec-choose[data-id='"+id+"']").find(".spec-goodstock").attr("stock"));
			if(stock>=0)
				$(".spec-choose[data-id='"+id+"']").find(".spec-goodstock").text("库存:"+stock+"件");
			else
				$(".spec-choose[data-id='"+id+"']").find(".spec-goodstock").text("库存:不限");
			$(".spec-choose[data-id='"+id+"']").find(".unchoose").each(function(){
				// 选择<em></em>
				$(".spec-choose[data-id='"+id+"']").find(".spec-goodspec").append("<em>&nbsp;&nbsp;" + $(this).html() + "</em>");
			});
			$("a.j-open-choose[data-id='"+id+"'] span").addClass("defult");
			$("a.j-open-choose[data-id='"+id+"'] span").text("选择商品属性");
			$("a.j-open-choose[data-id='"+id+"'] span").parent().siblings("p.price").text("¥"+$(".spec-choose[data-id='"+id+"']").find(".spec-goodprice").attr("data-price"));
			$("a.j-open-choose[data-id='"+id+"'] span").parent().siblings("p.price").attr("data-value",$(".spec-choose[data-id='"+id+"']").find(".spec-goodprice").attr("data-price"));
		}else{
			$(".spec-choose[data-id='"+id+"']").find(".spec-goodspec").empty();
			$("a.j-open-choose[data-id='"+id+"'] span").empty();
			$(".spec-choose[data-id='"+id+"']").find(".spec-goodspec").append("已选择");
			$(".spec-choose[data-id='"+id+"']").find(".j-choose.active").each(function(){
				$(".spec-choose[data-id='"+id+"']").find(".spec-goodspec").append("<em>&nbsp;&nbsp;" + $(this).html() + "</em>");
				$("a.j-open-choose[data-id='"+id+"'] span").append( $(this).html() + "&nbsp;");
				$("a.j-open-choose[data-id='"+id+"'] span").removeClass("defult");
			});
			
			var pirce=parseFloat($(".spec-choose[data-id='"+id+"']").find(".or_pirce").val());
			
			//$(".spec-choose[data-id='"+id+"']").find(".choose-list .active").each(function(){
			//	pirce+=parseFloat($(this).attr("pirce"));
			//	$(".spec-choose[data-id='"+id+"']").find(".spec-goodprice").text("￥"+pirce.toFixed(2));
			//	$(".price[price-id='"+id+"']").attr("data-value",pirce.toFixed(2));
			//	$(".price[price-id='"+id+"']").html("￥"+pirce.toFixed(2));
			//});
			//开始计算属性库存

			init_buy_ui(id);//检测库存
			
			//init_submit_btn_status();
		}
	}
	init_price(main_id);
	function init_price(main_id){
		var main_data=$("p[price-id='"+main_id+"'].price");
		var price=parseFloat(main_data.attr("data-value"))*parseFloat(main_data.attr("data-num"));
		
		$(".deal").each(function(){
			// 选择<em></em>
			if($(this).hasClass("active")){
				var id=$(this).attr("data-id");
				var part_data=$(this).parent().parent().find("p.price");
				price=price+parseFloat(part_data.attr("data-value"))*parseFloat(part_data.attr("data-num"));
			}
		});
		
		$(".dealgroup-bar p.total-price").eq(1).html("<em>&yen;"+price.toFixed(2)+"</em>");
	}
	//库存检测-更新面板-改变按钮状态
	function init_buy_ui(id){
			//var is_stock = true;      //库存是否满足
			//var stock = deal_stock;   //无规格时的库存数
			//var deal_show_price = deal_price;
			//var deal_show_buy_count = deal_buy_count;
			//var deal_remain_stock = -1;  //剩余库存 -1:无限

			var attr_checked_ids = []; // 定义一个空数组
			var txt = $(".spec-choose[data-id='"+id+"']").find('.j-choose.active'); // 获取所有选中对象
			for (var i = 0; i < txt.length; i++) {
				attr_checked_ids.push($(".spec-choose[data-id='"+id+"']").find('.j-choose.active').eq(i).attr("data-value")); // 将文本框的值添加到数组中
			}
			var attr_checked_ids = attr_checked_ids.sort(); //排序
			var attr_checked_ids_str = attr_checked_ids.join("_");//转字符串 _ 分割
			var attr_spec_stock_cfg = deal_attr_stock_json[id][attr_checked_ids_str];
			
			if(attr_spec_stock_cfg)
			{
				stock = attr_spec_stock_cfg['stock_cfg'];
				var price=(parseFloat($(".spec-choose[data-id='"+id+"']").find(".spec-goodprice").attr("data-price"))+parseFloat(attr_spec_stock_cfg['price'])).toFixed(2);
				$(".spec-choose[data-id='"+id+"']").find(".spec-goodprice").text("￥"+price);
				$("a.j-open-choose[data-id='"+id+"'] span").parent().siblings("p.price").text("¥"+price);
				$("a.j-open-choose[data-id='"+id+"'] span").parent().siblings("p.price").attr("data-value",price);
			}
			else
			{//单个属性库存
				var has_stock_attr = false;
				for(var k=0;k<attr_checked_ids.length;k++)
				{
					var key = attr_checked_ids[k];
					attr_spec_stock_cfg = deal_attr_stock_json[id][key];
					if(attr_spec_stock_cfg)
					{
						stock = attr_spec_stock_cfg['stock_cfg'];
						var price=(parseFloat($(".spec-choose[data-id='"+id+"']").find(".spec-goodprice").attr("data-price"))+attr_spec_stock_cfg['price']).toFixed(2);
						$(".spec-choose[data-id='"+id+"']").find(".spec-goodprice").text("￥"+price);
						$("a.j-open-choose[data-id='"+id+"'] span").parent().siblings("p.price").text("¥"+price);
						$("a.j-open-choose[data-id='"+id+"'] span").parent().siblings("p.price").attr("data-value",price);
						has_stock_attr = true;
						break;
					}
				}
				if(!has_stock_attr)
				stock = -1;
			}
			console.log(stock);
			//判断库存是否大于0
			//更新库存显示
			//判断库存，并更新数量显示
			//判断库存是否小于最小购买量，表示库存不足
			if(stock>0){
				$(".spec-choose[data-id='"+id+"']").find(".spec-goodstock").text("库存:"+stock+"件");
				$(".spec-choose[data-id='"+id+"']").find(".spec-goodstock").attr("data-stock",stock);
				$("a.j-open-choose[data-id='"+id+"']").attr("is-stock",1);
			}else{
				if(stock==-1){
					$("a.j-open-choose[data-id='"+id+"']").attr("is-stock",1);
					$(".spec-choose[data-id='"+id+"']").find(".spec-goodstock").text("库存:不限");
					$(".spec-choose[data-id='"+id+"']").find(".spec-goodstock").attr("data-stock","-1");
				}else{
					$("a.j-open-choose[data-id='"+id+"']").attr("is-stock",0);
					$(".spec-choose[data-id='"+id+"']").find(".spec-goodstock").text("库存:0件");//$.alert("库存不足");
					$(".spec-choose[data-id='"+id+"']").find(".spec-goodstock").attr("data-stock","0");
				}
					
			}
			

	}
	
});
/**
 * 合并购买
*/
function relateBy(){
	var idArray = [];
	var idnumArray = [];
	var dealAttrArray = {};
	var is_attr = true;
	idArray.push(main_id);
	idnumArray[main_id]=main_num;
	$(".deal").each(function(){
		// 选择<em></em>
		if($(this).hasClass("active")){
			
			idArray.push(parseFloat($(this).attr("data-id")));
			idnumArray[$(this).attr("data-id")]=$(this).attr("data-num");
		}
	});
	$(".spec-choose").each(function(){
		// 选择<em></em>
		var obj=this;
		var id=parseFloat($(obj).attr("data-id"));
		dealAttrArray[id]={};
		$(this).find(".choose-part").each(function(){
			if(isNaN(parseFloat($(this).attr("data-value")))&&$.inArray(id, idArray)!=-1){
				$.toast("规格未选择");
				is_attr = false;
			}
				
			dealAttrArray[parseFloat($(obj).attr("data-id"))][parseFloat($(this).attr("data-id"))]=parseFloat($(this).attr("data-value"));
			
		});
	});
	var is_stock=$(".main-goods").find(".j-open-choose").attr("is-stock");
	$(".deal").each(function(){
		// 选择<em></em>
		if($(this).hasClass("active")){
			is_stock=$(this).parent().parent().find(".j-open-choose").attr("is-stock");
			if(is_stock=="0")return false;
		}
	});
	if(is_stock=="0"){
		$.toast("库存不足");
		return false;
	}
	
	if(!is_attr){
		return false;
	}
	$.ajax({
		url:ajax_url,
		data:{'id':idArray,'dealAttrArray':dealAttrArray,'idnumArray':idnumArray},
		dataType:"json",
		type:"post",
		global:false,
		success:function(obj){
			if(obj.status==-1)
			{
				location.href = obj.jump;
			}
			else if(obj.status)
			{
				if($("input[name='type']").val()!=1){
					if(obj.jump!="")
					location.href = obj.jump;
				}else{
					$.toast("加入购物车成功");
					$(".j-spec-choose-close,.j-flippedout-close").click();
				}
				
			}
			else
			{
				//$.toast(obj.info);
				//console.log(obj.info);
				//$(obj.info).each(function(index){
				//    alert(this);
				//});
				 $.each(obj.info,function(n,value){
			            //alert(n);
					 	//$.toast(value);
			            //alert(value);
					 	//setTimeout(function () { 
					    //}, 2000);
					 $("span.tis[data-id='"+n+"']").html("<em>&nbsp;&nbsp;"+value+"</em>");
			        });
			}
		}
	});
	
	
}
/**
 * Created by Administrator on 2016/11/18.
 */

$(document).on("pageInit", "#dist_center", function(e, pageId, $page)  {

    $('.dist_scope').bind('click', function() {
        var url = $(this).attr('url');
        window.location = url;
    })
});
$(document).on("pageInit", "#dist_info_setting", function(e, pageId, $page)  {

    //退出登录
    $(".btn-con").click(function(){
        if(app_index=='app'){
            App.logout();
            return false;
        }
        $.confirm("是否退出当前账号？","",function(){
            dist_login_out();
        });
    });
    function dist_login_out(){
        var exit_url=$(this).attr("data-url");
        var query = new Object();
        query.act='loginout';
        $.ajax({
            url:exit_url,
            data:query,
            type:"POST",
            dataType:"json",
            success:function(obj){
                if(obj.status)
                {
                    $.toast(obj.info);
                    setTimeout(function(){
                        window.location.href=obj.jump;
                    },1500);
                }
                else
                {
                    $.toast(obj.info);
                }
            }
        });
    }
});
$(document).on("pageInit", "#dist_msg_index", function(e, pageId, $page) {
	refreshdata([".dist_msg_change"]);
});
$(document).on("pageInit", "#dist_order_index", function(e, pageId, $page) {
	
	$(".content").scrollTop(1);
	if($(".content").scrollTop()>0){
		init_listscroll(".j-ajaxlist-"+status,".j-ajaxadd-"+status);
	}
	
	function tab_line() {
		var init_width=$(".biz-shop-order-tab .active span").width();
		var init_left=$(".j-tab-item.active span").offset().left;
		$(".tab-line").css({
			width: init_width,
			left: init_left
		});
	}
	tab_line();
	$(".biz-shop-order-tab").on('click','.j-tab-item', function(event) {
		var type=$(this).attr("type");
		
		if($(".content").find(".j-ajaxlist-"+type).length > 0){

			$(".biz-shop-order-tab .j-tab-item").removeClass('active');
			$(this).addClass('active').siblings().removeClass('active');
			
			$(".content .m-biz-shop-order-list").removeClass('active');
			$(".content").find(".j-ajaxlist-"+type).addClass('active').siblings().removeClass('active');
			tab_line();
			
			$(".content").scrollTop(1); 
		    if( $(".content").scrollTop()>0 ){
		    	infinite(".j-ajaxlist-"+type,".j-ajaxadd-"+type);
		    }
			
		}else{
		
			$(".j-tab-item").removeClass('active');
			$(this).addClass('active');
			var item_width=$(this).find('span').width();
			var item_left=$(this).find('span').offset().left;
			$(".tab-line").css({
				width: item_width,
				left: item_left
			});
			var url=$(this).attr("data-href");
			
			$.ajax({
				url:url,
				type:"POST",
				success:function(html)
				{
					$(".content").append($(html).find(".content").html());
					$(".j-ajaxlist-"+type).addClass('active').html($(html).find(".j-ajaxlist-"+type).html()).siblings().removeClass('active');
			
					if ($(html).find(".j-ajaxadd-"+type).length==0) {
						return;
					}else{
						$(".content").scrollTop(1); 
					    if( $(".content").scrollTop()>0 ){
							$(document).off('infinite', '.infinite-scroll-bottom');
							init_listscroll(".j-ajaxlist-"+type,".j-ajaxadd-"+type);
					    }
					};
				},
				error:function()
				{
					$.toast("加载失败咯~");
				}
			});
			$.showIndicator();
			setTimeout(function () {
				$.hideIndicator();
			}, 800);
		}
	});
	var swiperm = new Swiper(".j-order-shop-img", {
	    scrollbarHide: true,
	    slidesPerView: 'auto',
	    freeMode: false,
	});
});
$(document).on("pageInit", "#dist_order_view", function(e, pageId, $page) {
	$(".do_delivery").bind("click",function(){
		var action=$(this).attr("action");
		$.confirm('确认发货吗？', function () {
			$.ajax({
				url:action,
				dataType:"json",
				type:"POST",
				success:function(obj){
					console.log(obj);
					if(obj.status==1){
						$.toast("发货成功");
						$(".logistics-code").val('');
						$("#remark").val('');
						$(".j-goods-item").find('input').attr("checked",false);
						if(obj.jump){
							setTimeout(function(){
								location.reload();
							},1500);
						}
					}else if(obj.status==0){
						$.toast(obj.info);
						if(obj.jump){
							setTimeout(function(){
								location.href = obj.jump;
							},1500);
						}
					}
				}
			});
		});
	});
});
// +----------------------------------------------------------------------
// | Copyright (c) 2010-2013 http://www.YiiSpace.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Micheal Chen <shilong.chen2012@gmail.com>
// +----------------------------------------------------------------------
// | FileName: 
// +----------------------------------------------------------------------
// | DateTime: 2017-03-06 09:49
// +----------------------------------------------------------------------
$(document).on("pageInit", "#dist_undeliver", function (e, pageId, $page) {
    $(".biz-link-bar").on('click', '.j-qrcode', function() {
        if(app_index == 'wap'){
            $.toast("手机浏览器暂不支持，请下载APP");
        }
    });
    $(".biz-manager-bar").on('click', '.j-unopen', function() {
        $.toast("暂未开放");
    });
    $(".biz-manager-bar").on('click', '.store_pay_unopen', function() {
        $.toast("没有操作权限");
    });
    $(".to-qrcode").on('click', function() {
        $.toast("暂未开放");
    });
    var pre_coupon_pwd = "";
    $("input[name='qr_code']").keyup(function () {
        var coupon_pwd = $(this).val();
        var code_len = coupon_pwd.length;
        var code_rule = /^[0-9]{12}$/;

        if (pre_coupon_pwd != coupon_pwd){
            pre_coupon_pwd = coupon_pwd;
            if (code_len == 12) {
                if (!code_rule.test(coupon_pwd)) {
                    $.toast('您输入的券码无效');
                }
                else {
                    $.post(index_check_url, { "coupon_pwd": coupon_pwd }, function (data) {
                        if (data.status) {
                            $(".code-input").val("");
                            location.href = data.jump;
                        } else {
                            $.toast(data.info);
                            if(data.jump){
                                setTimeout(function(){
                                        location.href=data.jump;
                                },2000);
                            }
                        }
                    }, "json");
                }
            } else if (code_len > 12) {
                $.toast('您输入的券码无效');
            }
        }
    });
});

// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 吴庆祥
// +----------------------------------------------------------------------
// | FileName: 
// +----------------------------------------------------------------------
// | DateTime: 2017-03-09 10:46
// +----------------------------------------------------------------------
$(document).on("pageInit", "#dist_undeliver_coupon_check", function (e, pageId, $page) {
    $("#dist_undeliver_coupon_check .check-cancel").bind("click",function(){
        window.location.href=index_url;
    });
    $("#dist_undeliver_coupon_check .check-confirm").bind("click",function(){
        var query = {};
        query.coupon_pwd = coupon_pwd;
        $.ajax({
            url:url,
            data:query,
            dataType: "json",
            type:"post",
            success:function(obj){
                if(obj.status==1){
                    $.toast(obj.info);
                    if(obj.jump){
                        setTimeout(function(){
                            location.href = obj.jump;
                        },1000);
                    }
                }else{
                    $.toast(obj.info);
                }
            },
            error: function() {
                $.toast("网络被风吹走啦~");
            }
        });
    });
});

$(document).on("pageInit", "#dist_undeliver_scope", function (e, pageId, $page) {
    // 百度地图API功能
    var map = new BMap.Map("allmap");
    var xpoint = $('input[name="xpoint"]').val();
    var ypoint = $('input[name="ypoint"]').val();
    var xpoints = $('input[name="xpoints"]').val().split(",");
    var ypoints = $('input[name="ypoints"]').val().split(",");
    map.centerAndZoom(new BMap.Point(xpoint, ypoint), 11);
    map.enableScrollWheelZoom(true);
    //鼠标绘制完成回调方法   获取各个点的经纬度
    var styleOptions = {
        strokeColor: "red",    //边线颜色。
        fillColor: "red",      //填充颜色。当参数为空时，圆形将没有填充效果。
        strokeWeight: 3,       //边线的宽度，以像素为单位。
        strokeOpacity: 0.8,       //边线透明度，取值范围0 - 1。
        fillOpacity: 0.6,      //填充的透明度，取值范围0 - 1。
        strokeStyle: 'solid' //边线的样式，solid或dashed。
    };
    var points = [];
    for (var i in xpoints) {
        points.push(new BMap.Point(xpoints[i], ypoints[i]));
    }
    var marker = new BMap.Marker(new BMap.Point(xpoint, ypoint));
    map.addOverlay(marker);
    var polygon = new BMap.Polygon(points, styleOptions);
    map.addOverlay(polygon);
});
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 吴庆祥
// +----------------------------------------------------------------------
// | FileName: 
// +----------------------------------------------------------------------
// | DateTime: 2017-03-10 10:08
// +----------------------------------------------------------------------
$(document).on("pageInit", "#dist_undeliver_verify_log_list", function(e, pageId, $page) {
    $(document).on('click', '.j-use-search', function() {
        $(".use-search-bar").addClass('open');
    });
    $(".use-search-bar").on('click', '.j-close-use-search', function() {
        $(".use-search-bar").removeClass('open');
    });

    init_list_scroll_bottom();

    $('.search').bind('click', function() {
        var pwd = $.trim($('input[name="coupon_pwd"]').val());
        if (pwd == '') {
            $.toast('请输入要搜索的券码');
            return;
        }
        pwd = pwd.replace(/\s/g,'');
        if (pwd.length!=12) {
            $.toast('请输入有效券码');
            return;
        }
        var param = {
            act: 'search_log',
            coupon_pwd: pwd
        };
        $.ajax({
            url: use_log,
            type:"GET",
            data: param,
            dataType:"JSON",
            success: function(html) {
                $('.j-ajaxlist').html($(html).find('.j-ajaxlist').html());
                init_list_scroll_bottom();
            },
            error: function(err) {
                console.log(err);
            }
        });
        return false;
    });
});
$(document).on("pageInit", "#dist_user_getpassword", function(e, pageId, $page)  {
    clear_input($('#phonenumer'),$('.j-phone-clear'));
    clear_input($('#sms_verify'),$('.j-verify-clear'));
    clear_input($('#password'),$('.j-password-clear'));

    $("#getpassword").click(function () {
        $("#ph_getpassword").submit();
    });

    $("#ph_getpassword").bind("submit",function(){
        var mobile = $.trim($(this).find("input[name='user_mobile']").val());
        var user_pwd = $.trim($(this).find("input[name='user_pwd']").val());
        var sms_verify = $.trim($(this).find("input[name='sms_verify']").val());

        if(mobile=="")
        {
            $.toast("请输入手机号");
            return false;
        }
        if(user_pwd=="")
        {
            $.toast("请输入密码");
            return false;
        }
        if (user_pwd.length < 4) {
            $.toast('密码过短');
            return false;
        }
        if(sms_verify=="")
        {
            $.toast("请输入收到的验证码");
            return false;
        }

        var query = $(this).serialize();
        var ajax_url = $(this).attr("action");
        $.ajax({
            url:ajax_url,
            data:query,
            type:"POST",
            dataType:"json",
            success:function(obj){
                if(obj.status) {
                    // 先清理当前页的信息
                    $("input[name='user_mobile']").val('');
                    $("input[name='user_pwd']").val('');
                    $('input[name=sms_verify]').val('');
                    $('#btn').attr('lesstime', 0);

                    // 转弱提示跳转
                    $.toast(obj.info);
                    setTimeout(function() {
                        location.href = obj.jump;
                    }, 1500);
                } else {
                    $.toast(obj.info);
                }
            }
        });

        return false;
    });
});
$(document).on("pageInit", "#dist_user_login", function(e, pageId, $page) {
    function clear_name() {
        if ($('#account_name').val().length==0) {
            $(".j-name-clear").hide();
        } else {
            $('.j-name-clear').show();
        }
    }
    $("#account_name").bind('input propertychange', function() {
        clear_name();
    });
    $('.j-name-clear').click(function(){
        $('#account_name').val('');
        $(".j-name-clear").hide();
    });
    $("#login-btn").bind("click",function(){
        var account_name = $.trim($("input[name='account_name']").val());
        var account_password = $.trim($("input[name='account_password']").val());
        var form = $("form[name='user_login_form']");
        if(!account_name){
            $.toast("请填写账户名称");
            return false;
        }
        if(!account_password){
            $.toast("请输入密码");
            return false;
        }
        var query = $(form).serialize();
        var ajaxurl = $(form).attr("action");
        $.ajax({
            url:ajaxurl,
            data:query,
            type:"post",
            dataType:"json",
            success:function(data){
                if(data["status"]==1){
                    $.toast(data.info);
                    window.setTimeout(function(){
                        location.href = data.jump;
                    },1500);
                }else{
                    $.toast(data.info);
                    return false;
                }
            }
            ,error:function(){
                $.toast("服务器提交错误");
                return false;
            }
        });
        return false;
    });
});
$(document).on("pageInit", "#dist_withdrawal_bindbank", function(e, pageId, $page) {

	$("#btn").bind("click",function(){
		var phone=$("#phonenumer").val();
		if(phone==""){
			$.toast("请到PC端绑定手机");
		}
	});
	
	$("form[name='add_card']").bind("submit",function(){		
		var bank_name = $("form[name='add_card']").find("input[name='bank_name']").val();
		var bank_account = $("form[name='add_card']").find("input[name='bank_account']").val();
		var bank_user = $("form[name='add_card']").find("input[name='bank_user']").val();
		var sms_verify = $("form[name='add_card']").find("input[name='sms_verify']").val();		
		if($.trim(bank_name)=="")
		{
			$.toast("请输入开户行名称");
			return false;
		}
		if($.trim(bank_account)=="")
		{
			$.toast("请输入开户行账号");
			return false;
		}
		if($.trim(bank_user)=="")
		{
			$.toast("请输入开户人真实姓名");
			return false;
		}
		if($.trim(sms_verify)=="")
		{
			$.toast("请输入短信验证码");
			return false;
		}
		
		var ajax_url = $("form[name='add_card']").attr("action");
		var query = $("form[name='add_card']").serialize();
		$.ajax({
			url:ajax_url,
			data:query,
			dataType:"json",
			type:"POST",
			success:function(obj){
				if(obj.status==1){
					$.toast(obj.info);	
					setTimeout(function(){
						location.href = obj.jump;
					},1500);
				}else if(obj.status==0){
					if(obj.info)
					{
						$.toast(obj.info);
						if(obj.jump){
							setTimeout(function(){
								location.href = obj.jump;
							},1500);
						}
					}
					else
					{
						if(obj.jump)location.href = obj.jump;
					}
					
				}
				else{
					
				}
			}
		});		
		return false;
	});
});

$(document).on("pageInit", "#dist_withdrawal_form", function(e, pageId, $page) {
	$(".ui-textbox").val('');
	$("form[name='withdrawal_form']").find("input[name='money']").change(function(){
		var money=parseFloat($(this).val());
		if(money>all_money){
			$.toast("提现超额");
			$(this).val(all_money);
		}
	});

	var load_page_count=0;
	
	$("form[name='withdrawal_form']").bind("submit",function(){		
		var money = $("form[name='withdrawal_form']").find("input[name='money']").val();
		var pwd = $("form[name='withdrawal_form']").find("input[name='pwd_verify']").val();
		if(is_bank=="")
		{	
			if(load_page_count==0){
				$.toast("请先绑定银行卡");
				setTimeout(function(){
					load_page($(".load_page"));
					setTimeout(function(){
						load_page_count=0;
					},100);
				},1500);
			}
			
			load_page_count++;
			return false;
		}
		
		if($.trim(pwd)=="")
		{
			$.toast("请输入登录密码");
			return false;
		}
		
		if($.trim(money)==""||isNaN(money)||parseFloat(money)<=0)
		{
			$.toast("请输入正确的提现金额");
			return false;
		}
		
		var ajax_url = $("form[name='withdrawal_form']").attr("action");
		var query = $("form[name='withdrawal_form']").serialize();
		//console.log(query);
		$.ajax({
			url:ajax_url,
			data:query,
			dataType:"json",
			type:"POST",
			success:function(obj){
				if(obj.status==1){
					$(".ui-textbox").val('');
					$.toast("提现申请成功，请等待管理员审核");
					if(obj.jump){
						setTimeout(function(){
							$.router.load(obj.jump, true);
							//location.href = obj.jump;
						},1500);
					}
				}else if(obj.status==0){
					if(obj.info)
					{
						$.toast(obj.info);
						if(obj.jump){
							setTimeout(function(){
								$.router.load(obj.jump, true);
								//location.href = obj.jump;
							},1500);
						}
					}
					else
					{
						if(obj.jump)$.router.load(obj.jump, true);
					}
					
				}
			}
		});		
		return false;
	});
});

$(document).on("pageInit", "#event", function(e, pageId, $page) {

	loadScript(jia_url);
	/*倒计时*/

	var nowtime = parseInt($(".j-LeftTime").attr("nowtime"));
	var endtime = parseInt($(".j-LeftTime").attr("endtime"));
	var leftTime = (endtime - nowtime) / 1000;
	leftTimeAct();
	setInterval(leftTimeAct,1000);
	
	function leftTimeAct(){
		if(leftTime > 0)
		{
			var day  = parseInt(leftTime / 24 /3600);
			var hour = parseInt((leftTime % (24 *3600)) / 3600);
			var min  = parseInt((leftTime % 3600) / 60);
			var sec  = parseInt((leftTime % 3600) % 60);
			$(".j-LeftTime").find(".day").html(day);
			$(".j-LeftTime").find(".hour").html(hour);
			$(".j-LeftTime").find(".min").html(min);
			$(".j-LeftTime").find(".sec").html(sec);
			leftTime--;
		}
	}

	
	/*
	 *下拉导航收藏按钮
	 *如果已经收藏则执行以下操作，否则本阶段不执行操作
	 */
	$(".j-head-collect").on("click",function(){
		var is_del = $(this).attr("data-isdel");
		if(is_del == 1){
		 	//打开取消框
			$(".cancel-shoucan").addClass("z-open");
		}else{
			if(is_login==0){
				if(app_index=="app"){
					App.login_sdk();
				}else{
					$.router.load(login_url, true);
				}
			}else{
				event_add_collect(id);
			}
		}
	});
	/*
	 *取消收藏按钮弹出后的取消
	 */
	$(".cancel-shoucan .j-cancel").click(function(){
		$(".cancel-shoucan").removeClass("z-open");
	});

	/*
	 *取消收藏按钮弹出后的确认
	 */
	$(".cancel-shoucan .j-yes").click(function(){
		event_del_collect(id);
		$(".cancel-shoucan").removeClass("z-open");
	});
	
	$("#event_submit").unbind("click");
	$("#event_submit").bind("click",function(){
		$.confirm("你确认要报名吗？",function(){
			var url=$(this).attr("url");
			var query = new Object();
			query.event_id = id;
			query.act = "do_submit";
			$.ajax({
				url: url,
				data: query,
				dataType: "json",
				type: "post",
				success:function(data){
					if(data.status==1){
						$.toast(data.info);
						setTimeout(function(){
							window.location.href=data.jump;
						},2000);
					}else{
						$.toast(data.info);
					}
				}
			});
		});
	});

	$(".login_submit").unbind("click");
	$(".login_submit").bind("click",function () {
		if(is_login==0){
			if(app_index=="app"){
				App.login_sdk();
			}else{
				$.router.load(login_url, true);
			}
		}
	});
});

function event_add_collect(id){
	var query = new Object();
	query.id = id;
	query.act = "add_collect";
	$.ajax({
		url: ajax_url,
		data: query,
		dataType: "json",
		type: "post",
		success: function(data){
			if(data.status==0 && data.user_login_status==0){
				$.toast("请先登录");
				setTimeout(function(){
					window.location.href=data.jump;
				},1000);
			}
			if(data.status==1){
				$("i.icon-collection").addClass("isCollection");
				$("div.is_Sc").html("<div class='shoucan isSc'><i class='iconfont icon-noshoucan'>&#xe615;</i><i class='iconfont icon-shoucan'>&#xe63d;</i><em>"+data.collect_count+"</em></div>");
				$.toast(data.info);
				$(".j-head-collect").attr("data-isdel",1);
				$(".flippedout").removeClass("showflipped").removeClass("dropdowm-open");
				$(".m-nav-dropdown").removeClass("showdropdown");
				$(".nav-dropdown-con").removeClass("dropdown-open");
			}
		},
		error:function(ajaxobj)
		{
//					if(ajaxobj.responseText!='')
//					alert(ajaxobj.responseText);
		}
	});
}

function event_del_collect(id){
	var query = new Object();
	query.id = id;
	query.act = "del_collect";
	$.ajax({
		url: ajax_url,
		data: query,
		dataType: "json",
		type: "post",
		success: function(data){
			if(data.status==0 && data.user_login_status==0){
				$.alert(data.info,function(){
					window.location.href=data.jump;
				});
			}
			if(data.status==1){
				$.toast(data.info);	
				$("i.icon-collection").removeClass("isCollection");
				if(data.collect_count>0){
					$("div.is_Sc").html("<div class='shoucan isSc'><i class='iconfont'>&#xe615;</i><em>"+data.collect_count+"</em></div>");
				}else{
					$("div.is_Sc").html('<i class="iconfont" id="is_Sc" style="font-size: 1.2rem;">&#xe615;</i>');
				}
				$(".j-head-collect").attr("data-isdel",0);
				$(".flippedout").removeClass("showflipped").removeClass("dropdowm-open");
				$(".m-nav-dropdown").removeClass("showdropdown");
				$(".nav-dropdown-con").removeClass("dropdown-open");
			}
		},
		error:function(ajaxobj)
		{
//					if(ajaxobj.responseText!='')
//					alert(ajaxobj.responseText);
		}
	});
}

$(document).on("pageInit", "#events", function(e, pageId, $page) {
	init_listscroll(".j_ajaxlist_"+cate_id_1,".j_ajaxadd_"+cate_id_1);
	function tab_line() {
		var init_width=$(".m-events-tab a:first-child").width();
		var init_left=$(".m-events-tab a:first-child").offset().left;
		$(".events-tab-line").css({
			width: init_width,
			left: init_left
		});
	}
	function item_width() {
	}
	var tab_length =$(".m-events-tab li").length;
	if (tab_length<3) {
		$(".m-events-tab").hide();
	} else if(tab_length<6){
		$(".m-events-tab ul").addClass('flex-box');
		$(".m-events-tab ul li").addClass('flex-1');
	}
	else{
		var w_width=$(window).width();
		var item_width=w_width/5.5;
		$(".m-events-tab li").css('width', item_width);
		$(".m-events-tab ul").css('width', item_width*tab_length);
		$(".m-events-tab ul li").addClass('tab-item');
	}
	tab_line();
	$(".m-events-tab li:first-child").addClass('active');
	$(".m-events-tab a").click(function() {
		$(document).off('infinite', '.infinite-scroll-bottom');
		$(".m-events-tab a").removeClass('active');
		$(this).addClass('active');
		$(".m-events-list").hide();
		var item_width=$(this).width();
		var item_left=$(this).offset().left+$(".m-events-tab").scrollLeft();
		$(".events-tab-line").css({
			width: item_width,
			left: item_left
		});
		var url=$(this).attr("data-src");
		var cate_id=$(this).attr("cate-id");
		$(".j_ajaxlist_"+cate_id).show();
		$(".content").scrollTop(1); 
		//alert($(".j_ajaxlist_"+cate_id).html());return false;
		//console.log($(".j_ajaxlist_"+cate_id).html());
		if($(".j_ajaxlist_"+cate_id).html()==null){
			//alert(111111);return false;
			  $.ajax({
			    url:url,
			    type:"POST",
			    success:function(html)
			    {
			      //console.log("成功");
			      
			      $(".content").append($(html).find(".content").html());
			      init_listscroll(".j_ajaxlist_"+cate_id,".j_ajaxadd_"+cate_id);
			    },
			    error:function()
			    {
			    	
			    	$(".j_ajaxlist_"+cate_id).find(".page-load span").removeClass("loading").addClass("loaded").html("网络被风吹走啦~");
			      //console.log("加载失败");
			    }
			  });
		}
		else{
			if( $(".content").scrollTop()>0 ){
				infinite(".j_ajaxlist_"+cate_id,".j_ajaxadd_"+cate_id);
			}
        }
	});
});
$(document).on("pageInit", "#user_getpassword", function(e, pageId, $page)  {
	clear_input($('#phonenumer'),$('.j-phone-clear'));
	clear_input($('#sms_verify'),$('.j-verify-clear'));
	clear_input($('#password'),$('.j-password-clear'));

	$("#getpassword").click(function () {
    	$("#ph_getpassword").submit();
    });
	
	
	$("#ph_getpassword").bind("submit",function(){
		var mobile = $.trim($(this).find("input[name='user_mobile']").val());
		var user_pwd = $.trim($(this).find("input[name='user_pwd']").val());
		var sms_verify = $.trim($(this).find("input[name='sms_verify']").val());

		if(mobile=="")
		{
			$.toast("请输入手机号");
			return false;
		}
		if(user_pwd=="")
		{
			$.toast("请输入密码");
			return false;
		}
		if (user_pwd.length < 4) {
			$.toast('密码过短');
			return false;
		}
		if(sms_verify=="")
		{
			$.toast("请输入收到的验证码");
			return false;
		}
		
		var query = $(this).serialize();
		var ajax_url = $(this).attr("action");
		$.ajax({
			url:ajax_url,
			data:query,
			type:"POST",
			dataType:"json",
			success:function(obj){
				if(obj.status) {
					// 先清理当前页的信息
					$("input[name='user_mobile']").val('');
					$("input[name='user_pwd']").val('');
					$('input[name=sms_verify]').val('');
					$('#btn').attr('lesstime', 0);

					// 执行跳转
					// $.alert(obj.info,function(){
					// 	location.href = obj.jump;
					// });
					// 转弱提示跳转
					$.toast(obj.info);
					setTimeout(function() {
						location.href = obj.jump;
					}, 1500);		
				} else {
					$.toast(obj.info);
				}
			}
		});
		
		return false;
	});
});

$(document).on("pageInit", "#goods", function(e, pageId, $page) {
	init_listscroll(".j-ajaxlist",".j-ajaxadd");
	$(document).on("click",".dropdown-navlist",function() {
		screen_bar_close();
	});
	$(".m-screen-bar").on("click",".screen-link",function() {
		screen_bar_close();
		$(".screen-link").removeClass('active');
		$(this).addClass('active');
	});
	//筛选
	//标签
	$(".screen-item a").click(function(){
		$(".m-screen-list").removeClass('active');
		$(".arrow-up").hide();
		$(".arrow-down").show();
	});
	$(".m-screen-bar").on("click",".screen-item a",function(){
		$(".m-screen-list").find('.mask').removeClass('mask-active');
		$(".arrow-up").hide();
		$(".arrow-down").show();
		$(".m-screen-list").removeClass('active');
	});
	//全部
	function screen_open() {
		$(".content").css('overflow', 'hidden');
		$(".m-screen-list").addClass('active');
	}
	function screen_close() {
		$(".content").css('overflow', 'auto');
		$(".m-screen-list").removeClass('active');
	}
	$(".m-screen-bar").on("click",".screen-all",function() {
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
		} else {
			$(this).addClass('active');
		}
		if ($(this).hasClass('active')) {
			$(".screen-brand").removeClass('active');
			$(".brand-screen").removeClass('active');
			$(this).find('.arrow-down').hide();
			$(this).find('.arrow-up').show();
			screen_open();
			$("#all-goods").addClass('active');
		} else {
			screen_close();
			$("#all-goods").removeClass('active');
		}
	});
	$(".m-screen-list").on("click",".goods-type li",function() {
		$(".goods-type li").removeClass('active');
		$(this).addClass('active');
		$(".type-detail ul").hide();
		if ($(".goods-type li").hasClass('active')) {
			var type_id = $(this).attr('data-id');
			$(this).parent().parent().find(".type-detail ul").eq(type_id).show();
		}
	});
	$("#all-goods").on('click', '.type-detail li a', function() {
		$("#all-goods .type-detail li a").removeClass('active');
		$(this).addClass('active');
		$(".screen-all p").html($(this).find('p').html());
		$(".screen-all").attr('data-cid', $(this).parent().parent().attr("data-id"));
		$(".screen-link").removeClass('active');
	});
	$("#all-goods").on('click', '.type-detail li:first-child a', function() {
		var type_id = $(this).parent().parent().attr('data-id');
		$(".screen-all p").html($("#all-goods .goods-type li").eq(type_id).html());
	});
	//品牌
	$(".m-screen-bar").on("click",".screen-brand",function() {
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
		} else {
			$(this).addClass('active');
		}
		$(".screen-all").removeClass('active');
		$("#all-goods").removeClass('active');
		if ($(this).hasClass('active')) {
			$(this).find('.arrow-down').hide();
			$(this).find('.arrow-up').show();
			$(".m-screen-list").addClass('active');
			$(".brand-screen").addClass('active');
			$(".content").css('overflow', 'hidden');
			$(".m-screen-list").find('.mask').addClass('mask-active');
		} else {
			$(".m-screen-list").find('.mask').removeClass('mask-active');
			$(".brand-screen").removeClass('active');
			$(".content").css('overflow', 'auto');
			$(".m-screen-list").removeClass('active');
		}
	});
	$(".m-screen-list").on("click",".brand-screen li",function() {
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
		} else {
			$(this).addClass('active');
		}
	});
	$(".m-screen-list").on("click",".brand-reset",function() {
		$(".brand-screen li").removeClass('active');
	});
	$(".m-screen-list").on("click",".brand-comfirm",function() {
		var ids = '';
		$(".screen-brand").removeClass('active');
		$(".brand-screen").find('.active').each(function(){
		    ids += $(this).attr("data-id")+",";
		  });
		ids = ids.substring(0,ids.length-1);
		url = $(this).attr('date-href');
		$(this).attr('date-href', url);
		if(ids!=''){
			url +='&bid='+ids;
			$(this).attr('date-href', url);
		}
	});
	//价格
	$(".m-screen-bar").on("click",".screen-price",function() {
		$(this).addClass('active');
		if ($(this).find(".arrow-up").hasClass('active')) {  //降序
			$(this).find(".arrow-up").removeClass('active');
			$(this).find(".arrow-down").addClass('active');
		} else {  //升序
			$(this).find(".arrow-down").removeClass('active');
			$(this).find(".arrow-up").addClass('active');
		}
	});
	//销量
	$(".m-screen-bar").on("click",".screen-sales",function() {
		$(".arrow-up").removeClass('active');
		$(".arrow-down").removeClass('active');
	});
	//背景
	$(".m-screen-list").on("click",".m-screen-list .mask",function() {
		$(".arrow-up").hide();
		$(".arrow-down").show();
		$(".screen-brand").removeClass('active');
		$(".content").css('overflow', 'auto');
		//$(".screen-item a").removeClass('active');
		$(".m-screen-list").find('.mask').removeClass('mask-active');
		$(".m-screen-list").removeClass('active');
		$(".brand-screen li").removeClass('active');
		$(".brand-screen").removeClass('active');
	});
	$(document).off("click",".j-listchoose");
	$(document).on("click",".j-listchoose",function() {
		var url=$(this).attr("date-href");
		var nidate="<div class='tipimg no_data'>"+"没有数据啦"+"</div>";
		$.ajax({
			url:url,
			type:"POST",
			success:function(html)
			{
				$(".j-ajaxlist").html($(html).find(".j-ajaxlist").html());
				$(".j-jg").html($(html).find(".j-jg").html());
				$(".j-pp").html($(html).find(".j-pp").html());
				$(".j-xl").html($(html).find(".j-xl").html());
				$("#all-goods").html($(html).find("#all-goods").html());
				if ($(html).find(".j-ajaxlist").html()==null) {
					$(".j-ajaxlist").html(nidate);
				}else{
					$(document).off('infinite', '.infinite-scroll-bottom');
					init_list_scroll_bottom();
				};
				if ($("#type-cube").css('display')=='none') {
					$(".m-goods-list ul").addClass('type-list').removeClass('type-cube');
				}
				if ($("#type-list").css('display')=='none') {
					$(".m-goods-list ul").removeClass('type-list').addClass('type-cube');
				}
			},
			error:function()
			{
				$.toast("加载失败咯~");
			}
		});
		$.showIndicator();
		setTimeout(function () {
			$.hideIndicator();
		}, 800);
		screen_bar_close();
	});
//	//品牌搜索
//	var all_brand=new Array();
//	$.each(brand_list,function(i,obj){
//		if(obj.id > 0){
//			all_brand.push(obj.id);
//		}	
//	});
//
//	
//	$(".brand-screen .brand-comfirm").bind("click",function(){
//		var brand_arr=new Array();
//		$(".brand-screen .flex-1 li").each(function(){
//			if($(this).hasClass("active")){
//				var data_id = $(this).attr("data-id");
//				if(data_id==0){	
//					brand_arr = all_brand;
//					return false;
//				}else{
//					brand_arr.push(data_id);
//				}
//			}	
//		});
//		
//	});
//	
	
});
$(document).on("pageInit", "#help", function(e, pageId, $page) {
	var nav_num=$(".j-nav-item").length;
	var m_width=$(".m-nav-tab").width();
	if (nav_num>5) {
		$(".m-nav-tab .nav-tab").css('width',m_width*.22*nav_num);
	} else {
		$(".m-nav-tab .nav-tab").css('width', '100%');
	}
	if ($(".m-nav-tab").length!==0) {
		tab_line_init();
		nav_tab();
	}
	$(".j-nav-item").on('click', function() {
		$(".bar-list").removeClass('active');
		$(".bar-list").eq($(this).index()).addClass('active');
		/* Act on the event */
	});

	// 小能
	$('.xnOpenSdk').bind('click', function() {
		if (app_index != 'app') {
			return;
		}
		if(is_login==0){
			App.login_sdk();
			return false;
		}
		var xnOptionsObj = {
			goods_id:'',
			goods_showURL:'',
			goodsTitle: '',
			goodsPrice: '',
			goods_URL: '',
			settingid: settingid,
			appGoods_type: '0',
		};
		xnOptions = JSON.stringify(xnOptionsObj);
		try {
			App.xnOpenSdk(xnOptions);
		} catch (e) {
			$.toast(e);
		}
	})
});
$(document).on("pageInit", "#help_search", function(e, pageId, $page) {
	clear_input($('.search-input'),$('.j-clear'));


	var origkey = '';
	$('.help-search-btn').bind('click', function() {
		var skey = $.trim($('.search-input').val());
		if (!skey) {
			$.toast('搜索关键字不能为空');
			return false;
		}
		if (skey == origkey) {
			return false;
		}
		origkey = skey;

		var query = {'keyword': skey};
		$.ajax({
			url: searchurl,
			data: query,
			dataType: "json",
			type: "post",
			success: function(data){
				if (data.status) {
					var list = data.list;
					var html = '';
					for (var key in list) {
						html += '<li class="b-line"><a href="'+list[key].wap_url+'" class="flex-box">'+
						'<p class="flex-1 bar-tit">'+list[key].title+'</p><div class="iconfont">&#xe607;</div></a></li>';
					}
					$('.bar-list').html(html);
				} else {
					$.toast(data.info);
				}
			}
		});
	});

});
$(document).on("pageInit","#idvalidate",function(){
	$("form[name='idvalidate_scanId']").unbind("submit");
	$("form[name='idvalidate_scanId']").bind("submit", function(event){
		var action = $(this).attr('action');
		var query = $(this).serialize();
		$.ajax({
			url:action,
			data:query,
			type:"POST",
			dataType:"json",
			success: function(obj){
				if(obj.status == 1){
					$.toast(obj.info);
					$.loadPage(location.href);
				}else{
					$.toast(obj.info);
				}
			}
		});
		return false;
	});
	$(".idvalidate_del").unbind("click");
	$(".idvalidate_del").bind("click", function(event){
		$.ajax({
			url:$(this).attr('data-url'),
			type:"POST",
			dataType:"json",
			success: function(obj){
				if(obj.status == 1){
					$.toast(obj.info);
					$.loadPage(location.href);
				}else{
					$.toast(obj.info);
				}
			}
		});
	});
});
$(document).on("pageInit", "#index", function(e, pageId, $page) {
	// 初始化回到头部
	

	headerScroll();/*导航条变化*/
	init_auto_load_data();
/*首页广告图轮播*/
var mySwiper = new Swiper('.j-index-banner', {
    speed: 400,
    spaceBetween: 0,
    pagination: '.swiper-pagination',
     autoplay: 2500
});
/*商家设置头部列表*/
var mySwiper = new Swiper('.j-sort_nav', {
    speed: 400,
    spaceBetween: 0
});
/*方维头条*/
var swiper = new Swiper('.j-headlines', {
        pagination: '',
        direction: 'vertical',
        slidesPerView: 1,
        paginationClickable: true,
        spaceBetween: 0,
        mousewheelControl: true,
        autoplay: 2000,
        loop: true
    });
/*首页小轮播*/
var mySwiper = new Swiper('.j-index-lb', {
    speed: 400,
    spaceBetween: 0,
    autoplay: 2500
});
/*跑马灯*/
var swiper = new Swiper('.j-horse-lamp', {
    scrollbarHide: true,
    slidesPerView: 'auto',
    centeredSlides: false,
    grabCursor: true
});

if($.fn.cookie("cancel_geo")!=1){
	position();
}
});


 $(document).on("pageInit", "#location", function(e, pageId, $page)  {
	 init_list_scroll_bottom();
 });
/**
 * Created by Administrator on 2016/10/13.
 */
$(document).on("pageInit", "#user_login", function(e, pageId, $page)  {
	clear_input($('#phonenumer'),$('.j-phone-clear'));
	clear_input($('#sms_verify'),$('.j-verify-clear'));
	clear_input($('#user_key'),$('.j-name-clear'));
	clear_input($('#password'),$('.j-password-clear'));
	$(document).on('click','.open-popup', function () {
	var url=$(".open-popup").attr("data-src");
	  $.ajax({
	    url:url,
	    type:"POST",
	    success:function(html)
	    {
	      //console.log("成功");

	      $(".popup-agreement .protocol").html($(html).find(".content").html());
	      $(".popup-agreement .title").html($(html).find(".title").html());
	    },
	    error:function()
	    {

	    	$(".popup-agreement").html("网络被风吹走啦~");
	      //console.log("加载失败");
	    }
	  });
	});
   $(".tab-ways li").click(function () {
       var index=$(this).index();
       $(this).addClass("active").siblings("li").removeClass("active");
       $(this).removeClass("b-line").siblings("li").addClass("b-line");
       $(".phone-login").hide();
       $(".phone-login").eq(index).show();
   });


    
    var _cli=0;
    $(".eyes").click(function () {
        _cli++;

       if(_cli==1){
           $(".eyes-no").hide();
           $(".eyes-yes").show();
           $(".password").attr("type","text");
       }
        if(_cli==2){
            $(".eyes-no").show();
            $(".eyes-yes").hide();
            $(".password").attr("type","password");
        }
        if(_cli>=2){
            _cli=0;
        }
    });

    

    
    //var wait=60;
    
    
    
    
    //if($("#btn").attr("lesstime")>0){
    	//wait = $("#btn").attr("lesstime");
    //	time($("#btn"));
    //}
    
    var lock = 0; // 防止频繁提交

    //账号密码登录
    $("#com_login_box").bind("submit",function(){
		var user_key = $.trim($(this).find("input[name='user_key']").val());
		var user_pwd = $.trim($(this).find("input[name='user_pwd']").val());
		if(user_key=="")
		{
			$.toast("请输入登录帐号");
			return false;
		}
		if(user_pwd=="")
		{
			$.toast("请输入密码");
			return false;
		}
		
		var query = $(this).serialize();
		var ajax_url = $(this).attr("action");
		if (!lock) {
			lock = 1;
			$.ajax({
				url:ajax_url,
				data:query,
				type:"POST",
				dataType:"json",
				success:function(obj) {
					if(obj.status) {
						$("#prohibit").show();
						$.toast(obj.info);
						window.setTimeout(function(){ 
							if(obj.url!="")
								location.href = obj.url;
							else
								location.href = obj.jump;
							},1500); 			
					} else {
						$.toast(obj.info);
					}
					setTimeout(function() {
						lock = 0;
					}, 3000);
				}
			});
		}
		
		return false;
	});
    //手机快捷登录
    
    $("#ph_login_box").bind("submit",function(){
		
		var mobile = $.trim($(this).find("input[name='mobile']").val());
		var sms_verify = $.trim($(this).find("input[name='sms_verify']").val());
		if(mobile=="")
		{
			$.toast("请输入手机号");
			return false;
		}
		if(sms_verify=="")
		{
			$.toast("请输入收到的验证码");
			return false;
		}
		
		var query = $(this).serialize();
		var ajax_url = $(this).attr("action");
		if (!lock) {
			lock = 1;
			$.ajax({
				url:ajax_url,
				data:query,
				type:"POST",
				dataType:"json",
				success:function(obj){
					if(obj.status) {
						$("#prohibit").show();
						$.toast(obj.info);
						window.setTimeout(function(){
							location.href = obj.jump;
							},1500);				
					} else {
						$.toast(obj.info);
					}
					setTimeout(function() {
						lock = 0;
					}, 3000);
				}
			});
		}
		
		return false;
	});
    
});

$(document).on("pageInit", "#login_out", function(e, pageId, $page)  {

    //退出登录
	$(".btn-con").click(function(){
		var cookarr=$.fn.cookie('cookobj');
		$.fn.cookie('cookobj',cookarr,{ expires: -1 });
		if(app_index=='app'){
			App.logout();
			return false;
		}
		var exit_url=$(this).attr("data-url");
		var query = new Object();
		query.act='loginout';
		$.ajax({
			url:exit_url,
			data:query,
			type:"POST",
			dataType:"json",
			success:function(obj){
				if(obj.status)
				{
					$.toast(obj.info);
					setTimeout(function(){
						window.location.href=obj.jump;
					},1500);
				}
				else
				{
					$.toast(obj.info);
				}
			}
		});
	});

});
(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define([], factory);
	else {
		var a = factory();
		for(var i in a) (typeof exports === 'object' ? exports : root)[i] = a[i];
	}
})(this, function() {
return /******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports, __webpack_require__) {

	__webpack_require__(7);
	__webpack_require__(8);

	module.exports = __webpack_require__(9);


	/**
	 *
	 * 　　　┏┓　　　┏┓
	 * 　　┏┛┻━━━┛┻┓
	 * 　　┃　　　　　　　┃
	 * 　　┃　　　━　　　┃
	 * 　　┃　┳┛　┗┳　┃
	 * 　　┃　　　　　　　┃
	 * 　　┃　　　┻　　　┃
	 * 　　┃　　　　　　　┃
	 * 　　┗━┓　　　┏━┛Code is far away from bug with the animal protecting
	 * 　　　　┃　　　┃    神兽保佑,代码无bug
	 * 　　　　┃　　　┃
	 * 　　　　┃　　　┗━━━┓
	 * 　　　　┃　　　　　 ┣┓
	 * 　　　　┃　　　　 ┏┛
	 * 　　　　┗┓┓┏━┳┓┏┛
	 * 　　　　　┃┫┫　┃┫┫
	 * 　　　　　┗┻┛　┗┻┛
	 *
	 */


/***/ },
/* 1 */
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(setImmediate) {(function (root) {

	    // Use polyfill for setImmediate for performance gains
	    var asap = (typeof setImmediate === 'function' && setImmediate) ||
	        function (fn) {
	            setTimeout(fn, 1);
	        };

	    // Polyfill for Function.prototype.bind
	    function bind (fn, thisArg) {
	        return function () {
	            fn.apply(thisArg, arguments);
	        }
	    }

	    var isArray = Array.isArray || function (value) {
	            return Object.prototype.toString.call(value) === "[object Array]"
	        };

	    function Promise (fn) {
	        if (typeof this !== 'object') throw new TypeError('Promises must be constructed via new');
	        if (typeof fn !== 'function') throw new TypeError('not a function');
	        this._state     = null;
	        this._value     = null;
	        this._deferreds = []

	        doResolve(fn, bind(resolve, this), bind(reject, this))
	    }

	    function handle (deferred) {
	        var me = this;
	        if (this._state === null) {
	            this._deferreds.push(deferred);
	            return
	        }
	        asap(function () {
	            var cb = me._state ? deferred.onFulfilled : deferred.onRejected
	            if (cb === null) {
	                (me._state ? deferred.resolve : deferred.reject)(me._value);
	                return;
	            }
	            var ret;
	            try {
	                ret = cb(me._value);
	            }
	            catch (e) {
	                deferred.reject(e);
	                return;
	            }
	            deferred.resolve(ret);
	        })
	    }

	    function resolve (newValue) {
	        try { //Promise Resolution Procedure: https://github.com/promises-aplus/promises-spec#the-promise-resolution-procedure
	            if (newValue === this) throw new TypeError('A promise cannot be resolved with itself.');
	            if (newValue && (typeof newValue === 'object' || typeof newValue === 'function')) {
	                var then = newValue.then;
	                if (typeof then === 'function') {
	                    doResolve(bind(then, newValue), bind(resolve, this), bind(reject, this));
	                    return;
	                }
	            }
	            this._state = true;
	            this._value = newValue;
	            finale.call(this);
	        } catch (e) {
	            reject.call(this, e);
	        }
	    }

	    function reject (newValue) {
	        this._state = false;
	        this._value = newValue;
	        finale.call(this);
	    }

	    function finale () {
	        for (var i = 0, len = this._deferreds.length; i < len; i++) {
	            handle.call(this, this._deferreds[i]);
	        }
	        this._deferreds = null;
	    }

	    function Handler (onFulfilled, onRejected, resolve, reject) {
	        this.onFulfilled = typeof onFulfilled === 'function' ? onFulfilled : null;
	        this.onRejected  = typeof onRejected === 'function' ? onRejected : null;
	        this.resolve     = resolve;
	        this.reject      = reject;
	    }

	    /**
	     * Take a potentially misbehaving resolver function and make sure
	     * onFulfilled and onRejected are only called once.
	     *
	     * Makes no guarantees about asynchrony.
	     */
	    function doResolve (fn, onFulfilled, onRejected) {
	        var done = false;
	        try {
	            fn(function (value) {
	                if (done) return;
	                done = true;
	                onFulfilled(value);
	            }, function (reason) {
	                if (done) return;
	                done = true;
	                onRejected(reason);
	            })
	        } catch (ex) {
	            if (done) return;
	            done = true;
	            onRejected(ex);
	        }
	    }

	    Promise.prototype['catch'] = function (onRejected) {
	        return this.then(null, onRejected);
	    };

	    Promise.prototype.then = function (onFulfilled, onRejected) {
	        var me = this;
	        return new Promise(function (resolve, reject) {
	            handle.call(me, new Handler(onFulfilled, onRejected, resolve, reject));
	        })
	    };

	    Promise.all = function () {
	        var args = Array.prototype.slice.call(arguments.length === 1 && isArray(arguments[0]) ? arguments[0] : arguments);

	        return new Promise(function (resolve, reject) {
	            if (args.length === 0) return resolve([]);
	            var remaining = args.length;

	            function res (i, val) {
	                try {
	                    if (val && (typeof val === 'object' || typeof val === 'function')) {
	                        var then = val.then;
	                        if (typeof then === 'function') {
	                            then.call(val, function (val) {
	                                res(i, val)
	                            }, reject);
	                            return;
	                        }
	                    }
	                    args[i] = val;
	                    if (--remaining === 0) {
	                        resolve(args);
	                    }
	                } catch (ex) {
	                    reject(ex);
	                }
	            }

	            for (var i = 0; i < args.length; i++) {
	                res(i, args[i]);
	            }
	        });
	    };

	    Promise.resolve = function (value) {
	        if (value && typeof value === 'object' && value.constructor === Promise) {
	            return value;
	        }

	        return new Promise(function (resolve) {
	            resolve(value);
	        });
	    };

	    Promise.reject = function (value) {
	        return new Promise(function (resolve, reject) {
	            reject(value);
	        });
	    };

	    Promise.race = function (values) {
	        return new Promise(function (resolve, reject) {
	            for (var i = 0, len = values.length; i < len; i++) {
	                values[i].then(resolve, reject);
	            }
	        });
	    };

	    /**
	     * Set the immediate function to execute callbacks
	     * @param fn {function} Function to execute
	     * @private
	     */
	    Promise._setImmediateFn = function _setImmediateFn (fn) {
	        asap = fn;
	    };


	    Promise.prototype.always = function (callback) {
	        var constructor = this.constructor;

	        return this.then(function (value) {
	            return constructor.resolve(callback()).then(function () {
	                return value;
	            });
	        }, function (reason) {
	            return constructor.resolve(callback()).then(function () {
	                throw reason;
	            });
	        });
	    };

	    if (typeof module !== 'undefined' && module.exports) {
	        module.exports = Promise;
	    } else if (!root.Promise) {
	        root.Promise = Promise;
	    }

	})(this);
	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(2).setImmediate))

/***/ },
/* 2 */
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(setImmediate, clearImmediate) {var apply = Function.prototype.apply;

	// DOM APIs, for completeness

	exports.setTimeout = function() {
	  return new Timeout(apply.call(setTimeout, window, arguments), clearTimeout);
	};
	exports.setInterval = function() {
	  return new Timeout(apply.call(setInterval, window, arguments), clearInterval);
	};
	exports.clearTimeout =
	exports.clearInterval = function(timeout) {
	  if (timeout) {
	    timeout.close();
	  }
	};

	function Timeout(id, clearFn) {
	  this._id = id;
	  this._clearFn = clearFn;
	}
	Timeout.prototype.unref = Timeout.prototype.ref = function() {};
	Timeout.prototype.close = function() {
	  this._clearFn.call(window, this._id);
	};

	// Does not start the time, just sets up the members needed.
	exports.enroll = function(item, msecs) {
	  clearTimeout(item._idleTimeoutId);
	  item._idleTimeout = msecs;
	};

	exports.unenroll = function(item) {
	  clearTimeout(item._idleTimeoutId);
	  item._idleTimeout = -1;
	};

	exports._unrefActive = exports.active = function(item) {
	  clearTimeout(item._idleTimeoutId);

	  var msecs = item._idleTimeout;
	  if (msecs >= 0) {
	    item._idleTimeoutId = setTimeout(function onTimeout() {
	      if (item._onTimeout)
	        item._onTimeout();
	    }, msecs);
	  }
	};

	// setimmediate attaches itself to the global object
	__webpack_require__(3);
	exports.setImmediate = setImmediate;
	exports.clearImmediate = clearImmediate;

	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(2).setImmediate, __webpack_require__(2).clearImmediate))

/***/ },
/* 3 */
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(global, process) {(function (global, undefined) {
	    "use strict";

	    if (global.setImmediate) {
	        return;
	    }

	    var nextHandle = 1; // Spec says greater than zero
	    var tasksByHandle = {};
	    var currentlyRunningATask = false;
	    var doc = global.document;
	    var registerImmediate;

	    function setImmediate(callback) {
	      // Callback can either be a function or a string
	      if (typeof callback !== "function") {
	        callback = new Function("" + callback);
	      }
	      // Copy function arguments
	      var args = new Array(arguments.length - 1);
	      for (var i = 0; i < args.length; i++) {
	          args[i] = arguments[i + 1];
	      }
	      // Store and register the task
	      var task = { callback: callback, args: args };
	      tasksByHandle[nextHandle] = task;
	      registerImmediate(nextHandle);
	      return nextHandle++;
	    }

	    function clearImmediate(handle) {
	        delete tasksByHandle[handle];
	    }

	    function run(task) {
	        var callback = task.callback;
	        var args = task.args;
	        switch (args.length) {
	        case 0:
	            callback();
	            break;
	        case 1:
	            callback(args[0]);
	            break;
	        case 2:
	            callback(args[0], args[1]);
	            break;
	        case 3:
	            callback(args[0], args[1], args[2]);
	            break;
	        default:
	            callback.apply(undefined, args);
	            break;
	        }
	    }

	    function runIfPresent(handle) {
	        // From the spec: "Wait until any invocations of this algorithm started before this one have completed."
	        // So if we're currently running a task, we'll need to delay this invocation.
	        if (currentlyRunningATask) {
	            // Delay by doing a setTimeout. setImmediate was tried instead, but in Firefox 7 it generated a
	            // "too much recursion" error.
	            setTimeout(runIfPresent, 0, handle);
	        } else {
	            var task = tasksByHandle[handle];
	            if (task) {
	                currentlyRunningATask = true;
	                try {
	                    run(task);
	                } finally {
	                    clearImmediate(handle);
	                    currentlyRunningATask = false;
	                }
	            }
	        }
	    }

	    function installNextTickImplementation() {
	        registerImmediate = function(handle) {
	            process.nextTick(function () { runIfPresent(handle); });
	        };
	    }

	    function canUsePostMessage() {
	        // The test against `importScripts` prevents this implementation from being installed inside a web worker,
	        // where `global.postMessage` means something completely different and can't be used for this purpose.
	        if (global.postMessage && !global.importScripts) {
	            var postMessageIsAsynchronous = true;
	            var oldOnMessage = global.onmessage;
	            global.onmessage = function() {
	                postMessageIsAsynchronous = false;
	            };
	            global.postMessage("", "*");
	            global.onmessage = oldOnMessage;
	            return postMessageIsAsynchronous;
	        }
	    }

	    function installPostMessageImplementation() {
	        // Installs an event handler on `global` for the `message` event: see
	        // * https://developer.mozilla.org/en/DOM/window.postMessage
	        // * http://www.whatwg.org/specs/web-apps/current-work/multipage/comms.html#crossDocumentMessages

	        var messagePrefix = "setImmediate$" + Math.random() + "$";
	        var onGlobalMessage = function(event) {
	            if (event.source === global &&
	                typeof event.data === "string" &&
	                event.data.indexOf(messagePrefix) === 0) {
	                runIfPresent(+event.data.slice(messagePrefix.length));
	            }
	        };

	        if (global.addEventListener) {
	            global.addEventListener("message", onGlobalMessage, false);
	        } else {
	            global.attachEvent("onmessage", onGlobalMessage);
	        }

	        registerImmediate = function(handle) {
	            global.postMessage(messagePrefix + handle, "*");
	        };
	    }

	    function installMessageChannelImplementation() {
	        var channel = new MessageChannel();
	        channel.port1.onmessage = function(event) {
	            var handle = event.data;
	            runIfPresent(handle);
	        };

	        registerImmediate = function(handle) {
	            channel.port2.postMessage(handle);
	        };
	    }

	    function installReadyStateChangeImplementation() {
	        var html = doc.documentElement;
	        registerImmediate = function(handle) {
	            // Create a <script> element; its readystatechange event will be fired asynchronously once it is inserted
	            // into the document. Do so, thus queuing up the task. Remember to clean up once it's been called.
	            var script = doc.createElement("script");
	            script.onreadystatechange = function () {
	                runIfPresent(handle);
	                script.onreadystatechange = null;
	                html.removeChild(script);
	                script = null;
	            };
	            html.appendChild(script);
	        };
	    }

	    function installSetTimeoutImplementation() {
	        registerImmediate = function(handle) {
	            setTimeout(runIfPresent, 0, handle);
	        };
	    }

	    // If supported, we should attach to the prototype of global, since that is where setTimeout et al. live.
	    var attachTo = Object.getPrototypeOf && Object.getPrototypeOf(global);
	    attachTo = attachTo && attachTo.setTimeout ? attachTo : global;

	    // Don't get fooled by e.g. browserify environments.
	    if ({}.toString.call(global.process) === "[object process]") {
	        // For Node.js before 0.9
	        installNextTickImplementation();

	    } else if (canUsePostMessage()) {
	        // For non-IE10 modern browsers
	        installPostMessageImplementation();

	    } else if (global.MessageChannel) {
	        // For web workers, where supported
	        installMessageChannelImplementation();

	    } else if (doc && "onreadystatechange" in doc.createElement("script")) {
	        // For IE 6–8
	        installReadyStateChangeImplementation();

	    } else {
	        // For older browsers
	        installSetTimeoutImplementation();
	    }

	    attachTo.setImmediate = setImmediate;
	    attachTo.clearImmediate = clearImmediate;
	}(typeof self === "undefined" ? typeof global === "undefined" ? this : global : self));

	/* WEBPACK VAR INJECTION */}.call(exports, (function() { return this; }()), __webpack_require__(4)))

/***/ },
/* 4 */
/***/ function(module, exports) {

	// shim for using process in browser
	var process = module.exports = {};

	// cached from whatever global is present so that test runners that stub it
	// don't break things.  But we need to wrap it in a try catch in case it is
	// wrapped in strict mode code which doesn't define any globals.  It's inside a
	// function because try/catches deoptimize in certain engines.

	var cachedSetTimeout;
	var cachedClearTimeout;

	function defaultSetTimout() {
	    throw new Error('setTimeout has not been defined');
	}
	function defaultClearTimeout () {
	    throw new Error('clearTimeout has not been defined');
	}
	(function () {
	    try {
	        if (typeof setTimeout === 'function') {
	            cachedSetTimeout = setTimeout;
	        } else {
	            cachedSetTimeout = defaultSetTimout;
	        }
	    } catch (e) {
	        cachedSetTimeout = defaultSetTimout;
	    }
	    try {
	        if (typeof clearTimeout === 'function') {
	            cachedClearTimeout = clearTimeout;
	        } else {
	            cachedClearTimeout = defaultClearTimeout;
	        }
	    } catch (e) {
	        cachedClearTimeout = defaultClearTimeout;
	    }
	} ())
	function runTimeout(fun) {
	    if (cachedSetTimeout === setTimeout) {
	        //normal enviroments in sane situations
	        return setTimeout(fun, 0);
	    }
	    // if setTimeout wasn't available but was latter defined
	    if ((cachedSetTimeout === defaultSetTimout || !cachedSetTimeout) && setTimeout) {
	        cachedSetTimeout = setTimeout;
	        return setTimeout(fun, 0);
	    }
	    try {
	        // when when somebody has screwed with setTimeout but no I.E. maddness
	        return cachedSetTimeout(fun, 0);
	    } catch(e){
	        try {
	            // When we are in I.E. but the script has been evaled so I.E. doesn't trust the global object when called normally
	            return cachedSetTimeout.call(null, fun, 0);
	        } catch(e){
	            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error
	            return cachedSetTimeout.call(this, fun, 0);
	        }
	    }


	}
	function runClearTimeout(marker) {
	    if (cachedClearTimeout === clearTimeout) {
	        //normal enviroments in sane situations
	        return clearTimeout(marker);
	    }
	    // if clearTimeout wasn't available but was latter defined
	    if ((cachedClearTimeout === defaultClearTimeout || !cachedClearTimeout) && clearTimeout) {
	        cachedClearTimeout = clearTimeout;
	        return clearTimeout(marker);
	    }
	    try {
	        // when when somebody has screwed with setTimeout but no I.E. maddness
	        return cachedClearTimeout(marker);
	    } catch (e){
	        try {
	            // When we are in I.E. but the script has been evaled so I.E. doesn't  trust the global object when called normally
	            return cachedClearTimeout.call(null, marker);
	        } catch (e){
	            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error.
	            // Some versions of I.E. have different rules for clearTimeout vs setTimeout
	            return cachedClearTimeout.call(this, marker);
	        }
	    }



	}
	var queue = [];
	var draining = false;
	var currentQueue;
	var queueIndex = -1;

	function cleanUpNextTick() {
	    if (!draining || !currentQueue) {
	        return;
	    }
	    draining = false;
	    if (currentQueue.length) {
	        queue = currentQueue.concat(queue);
	    } else {
	        queueIndex = -1;
	    }
	    if (queue.length) {
	        drainQueue();
	    }
	}

	function drainQueue() {
	    if (draining) {
	        return;
	    }
	    var timeout = runTimeout(cleanUpNextTick);
	    draining = true;

	    var len = queue.length;
	    while(len) {
	        currentQueue = queue;
	        queue = [];
	        while (++queueIndex < len) {
	            if (currentQueue) {
	                currentQueue[queueIndex].run();
	            }
	        }
	        queueIndex = -1;
	        len = queue.length;
	    }
	    currentQueue = null;
	    draining = false;
	    runClearTimeout(timeout);
	}

	process.nextTick = function (fun) {
	    var args = new Array(arguments.length - 1);
	    if (arguments.length > 1) {
	        for (var i = 1; i < arguments.length; i++) {
	            args[i - 1] = arguments[i];
	        }
	    }
	    queue.push(new Item(fun, args));
	    if (queue.length === 1 && !draining) {
	        runTimeout(drainQueue);
	    }
	};

	// v8 likes predictible objects
	function Item(fun, array) {
	    this.fun = fun;
	    this.array = array;
	}
	Item.prototype.run = function () {
	    this.fun.apply(null, this.array);
	};
	process.title = 'browser';
	process.browser = true;
	process.env = {};
	process.argv = [];
	process.version = ''; // empty string to avoid regexp issues
	process.versions = {};

	function noop() {}

	process.on = noop;
	process.addListener = noop;
	process.once = noop;
	process.off = noop;
	process.removeListener = noop;
	process.removeAllListeners = noop;
	process.emit = noop;

	process.binding = function (name) {
	    throw new Error('process.binding is not supported');
	};

	process.cwd = function () { return '/' };
	process.chdir = function (dir) {
	    throw new Error('process.chdir is not supported');
	};
	process.umask = function() { return 0; };


/***/ },
/* 5 */
/***/ function(module, exports) {

	//@source https://xts.so/demo/compress/index.html

	// 早期版本的浏览器需要用BlobBuilder来构造Blob，创建一个通用构造器来兼容早期版本
	var BlobConstructor = ((function () {
	    try {
	        new Blob();
	        return true;
	    } catch (e) {
	        return false;
	    }
	})()) ? window.Blob : function (parts, opts) {
	    var bb = new (
	        window.BlobBuilder
	        || window.WebKitBlobBuilder
	        || window.MSBlobBuilder
	        || window.MozBlobBuilder
	    );
	    parts.forEach(function (p) {
	        bb.append(p);
	    });

	    return bb.getBlob(opts ? opts.type : undefined);
	};

	// Android上的AppleWebKit 534以前的内核存在一个Bug，
	// 导致FormData加入一个Blob对象后，上传的文件是0字节
	function hasFormDataBug () {
	    var bCheck = ~navigator.userAgent.indexOf('Android')
	        && ~navigator.vendor.indexOf('Google')
	        && !~navigator.userAgent.indexOf('Chrome');

	    // QQ X5浏览器也有这个BUG
	    return bCheck && navigator.userAgent.match(/AppleWebKit\/(\d+)/).pop() <= 534 || /MQQBrowser/g.test(navigator.userAgent);
	}
	var FormDataShim=(function(){
	    var formDataShimNums = 0;
	    function FormDataShim () {
	        var
	        // Store a reference to this
	        o        = this,
	    
	        // Data to be sent
	        parts = [],
	    
	        // Boundary parameter for separating the multipart values
	        boundary = Array(21).join('-') + (+new Date() * (1e16 * Math.random())).toString(36),
	    
	        // Store the current XHR send method so we can safely override it
	        oldSend  = XMLHttpRequest.prototype.send;
	        this.getParts = function () {
	            return parts.toString();
	        };
	        this.append   = function (name, value, filename) {
	            parts.push('--' + boundary + '\r\nContent-Disposition: form-data; name="' + name + '"');
	    
	            if (value instanceof Blob) {
	                parts.push('; filename="' + (filename || 'blob') + '"\r\nContent-Type: ' + value.type + '\r\n\r\n');
	                parts.push(value);
	            }
	            else {
	                parts.push('\r\n\r\n' + value);
	            }
	            parts.push('\r\n');
	        };
	    
	        formDataShimNums++;
	        XMLHttpRequest.prototype.send = function (val) {
	            var fr,
	                data,
	                oXHR = this;
	    
	            if (val === o) {
	                // Append the final boundary string
	                parts.push('--' + boundary + '--\r\n');
	                // Create the blob
	                data = new BlobConstructor(parts);
	    
	                // Set up and read the blob into an array to be sent
	                fr         = new FileReader();
	                fr.onload  = function () {
	                    oldSend.call(oXHR, fr.result);
	                };
	                fr.onerror = function (err) {
	                    throw err;
	                };
	                fr.readAsArrayBuffer(data);
	    
	                // Set the multipart content type and boudary
	                this.setRequestHeader('Content-Type', 'multipart/form-data; boundary=' + boundary);
	                formDataShimNums--;
	                if(formDataShimNums == 0){
	                    XMLHttpRequest.prototype.send = oldSend;
	                }
	            }
	            else {
	                oldSend.call(this, val);
	            }
	        };
	    };
	    FormDataShim.prototype = Object.create(FormData.prototype);
	    return FormDataShim;
	})();


	module.exports = {
	    Blob    : BlobConstructor,
	    FormData: hasFormDataBug() ? FormDataShim : FormData
	};


/***/ },
/* 6 */
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/* exif */
	(function () {

	    var debug = false;

	    var root = this;

	    var EXIF = function (obj) {
	        if (obj instanceof EXIF) return obj;
	        if (!(this instanceof EXIF)) return new EXIF(obj);
	        this.EXIFwrapped = obj;
	    };

	    if (true) {
	        if (typeof module !== 'undefined' && module.exports) {
	            exports = module.exports = EXIF;
	        }
	        exports.EXIF = EXIF;
	    } else {
	        root.EXIF = EXIF;
	    }

	    var ExifTags = EXIF.Tags = {

	        // version tags
	        0x9000: "ExifVersion",             // EXIF version
	        0xA000: "FlashpixVersion",         // Flashpix format version

	        // colorspace tags
	        0xA001: "ColorSpace",              // Color space information tag

	        // image configuration
	        0xA002: "PixelXDimension",         // Valid width of meaningful image
	        0xA003: "PixelYDimension",         // Valid height of meaningful image
	        0x9101: "ComponentsConfiguration", // Information about channels
	        0x9102: "CompressedBitsPerPixel",  // Compressed bits per pixel

	        // user information
	        0x927C: "MakerNote",               // Any desired information written by the manufacturer
	        0x9286: "UserComment",             // Comments by user

	        // related file
	        0xA004: "RelatedSoundFile",        // Name of related sound file

	        // date and time
	        0x9003: "DateTimeOriginal",        // Date and time when the original image was generated
	        0x9004: "DateTimeDigitized",       // Date and time when the image was stored digitally
	        0x9290: "SubsecTime",              // Fractions of seconds for DateTime
	        0x9291: "SubsecTimeOriginal",      // Fractions of seconds for DateTimeOriginal
	        0x9292: "SubsecTimeDigitized",     // Fractions of seconds for DateTimeDigitized

	        // picture-taking conditions
	        0x829A: "ExposureTime",            // Exposure time (in seconds)
	        0x829D: "FNumber",                 // F number
	        0x8822: "ExposureProgram",         // Exposure program
	        0x8824: "SpectralSensitivity",     // Spectral sensitivity
	        0x8827: "ISOSpeedRatings",         // ISO speed rating
	        0x8828: "OECF",                    // Optoelectric conversion factor
	        0x9201: "ShutterSpeedValue",       // Shutter speed
	        0x9202: "ApertureValue",           // Lens aperture
	        0x9203: "BrightnessValue",         // Value of brightness
	        0x9204: "ExposureBias",            // Exposure bias
	        0x9205: "MaxApertureValue",        // Smallest F number of lens
	        0x9206: "SubjectDistance",         // Distance to subject in meters
	        0x9207: "MeteringMode",            // Metering mode
	        0x9208: "LightSource",             // Kind of light source
	        0x9209: "Flash",                   // Flash status
	        0x9214: "SubjectArea",             // Location and area of main subject
	        0x920A: "FocalLength",             // Focal length of the lens in mm
	        0xA20B: "FlashEnergy",             // Strobe energy in BCPS
	        0xA20C: "SpatialFrequencyResponse",    //
	        0xA20E: "FocalPlaneXResolution",   // Number of pixels in width direction per FocalPlaneResolutionUnit
	        0xA20F: "FocalPlaneYResolution",   // Number of pixels in height direction per FocalPlaneResolutionUnit
	        0xA210: "FocalPlaneResolutionUnit",    // Unit for measuring FocalPlaneXResolution and FocalPlaneYResolution
	        0xA214: "SubjectLocation",         // Location of subject in image
	        0xA215: "ExposureIndex",           // Exposure index selected on camera
	        0xA217: "SensingMethod",           // Image sensor type
	        0xA300: "FileSource",              // Image source (3 == DSC)
	        0xA301: "SceneType",               // Scene type (1 == directly photographed)
	        0xA302: "CFAPattern",              // Color filter array geometric pattern
	        0xA401: "CustomRendered",          // Special processing
	        0xA402: "ExposureMode",            // Exposure mode
	        0xA403: "WhiteBalance",            // 1 = auto white balance, 2 = manual
	        0xA404: "DigitalZoomRation",       // Digital zoom ratio
	        0xA405: "FocalLengthIn35mmFilm",   // Equivalent foacl length assuming 35mm film camera (in mm)
	        0xA406: "SceneCaptureType",        // Type of scene
	        0xA407: "GainControl",             // Degree of overall image gain adjustment
	        0xA408: "Contrast",                // Direction of contrast processing applied by camera
	        0xA409: "Saturation",              // Direction of saturation processing applied by camera
	        0xA40A: "Sharpness",               // Direction of sharpness processing applied by camera
	        0xA40B: "DeviceSettingDescription",    //
	        0xA40C: "SubjectDistanceRange",    // Distance to subject

	        // other tags
	        0xA005: "InteroperabilityIFDPointer",
	        0xA420: "ImageUniqueID"            // Identifier assigned uniquely to each image
	    };

	    var TiffTags = EXIF.TiffTags = {
	        0x0100: "ImageWidth",
	        0x0101: "ImageHeight",
	        0x8769: "ExifIFDPointer",
	        0x8825: "GPSInfoIFDPointer",
	        0xA005: "InteroperabilityIFDPointer",
	        0x0102: "BitsPerSample",
	        0x0103: "Compression",
	        0x0106: "PhotometricInterpretation",
	        0x0112: "Orientation",
	        0x0115: "SamplesPerPixel",
	        0x011C: "PlanarConfiguration",
	        0x0212: "YCbCrSubSampling",
	        0x0213: "YCbCrPositioning",
	        0x011A: "XResolution",
	        0x011B: "YResolution",
	        0x0128: "ResolutionUnit",
	        0x0111: "StripOffsets",
	        0x0116: "RowsPerStrip",
	        0x0117: "StripByteCounts",
	        0x0201: "JPEGInterchangeFormat",
	        0x0202: "JPEGInterchangeFormatLength",
	        0x012D: "TransferFunction",
	        0x013E: "WhitePoint",
	        0x013F: "PrimaryChromaticities",
	        0x0211: "YCbCrCoefficients",
	        0x0214: "ReferenceBlackWhite",
	        0x0132: "DateTime",
	        0x010E: "ImageDescription",
	        0x010F: "Make",
	        0x0110: "Model",
	        0x0131: "Software",
	        0x013B: "Artist",
	        0x8298: "Copyright"
	    };

	    var GPSTags = EXIF.GPSTags = {
	        0x0000: "GPSVersionID",
	        0x0001: "GPSLatitudeRef",
	        0x0002: "GPSLatitude",
	        0x0003: "GPSLongitudeRef",
	        0x0004: "GPSLongitude",
	        0x0005: "GPSAltitudeRef",
	        0x0006: "GPSAltitude",
	        0x0007: "GPSTimeStamp",
	        0x0008: "GPSSatellites",
	        0x0009: "GPSStatus",
	        0x000A: "GPSMeasureMode",
	        0x000B: "GPSDOP",
	        0x000C: "GPSSpeedRef",
	        0x000D: "GPSSpeed",
	        0x000E: "GPSTrackRef",
	        0x000F: "GPSTrack",
	        0x0010: "GPSImgDirectionRef",
	        0x0011: "GPSImgDirection",
	        0x0012: "GPSMapDatum",
	        0x0013: "GPSDestLatitudeRef",
	        0x0014: "GPSDestLatitude",
	        0x0015: "GPSDestLongitudeRef",
	        0x0016: "GPSDestLongitude",
	        0x0017: "GPSDestBearingRef",
	        0x0018: "GPSDestBearing",
	        0x0019: "GPSDestDistanceRef",
	        0x001A: "GPSDestDistance",
	        0x001B: "GPSProcessingMethod",
	        0x001C: "GPSAreaInformation",
	        0x001D: "GPSDateStamp",
	        0x001E: "GPSDifferential"
	    };

	    var StringValues = EXIF.StringValues = {
	        ExposureProgram     : {
	            0: "Not defined",
	            1: "Manual",
	            2: "Normal program",
	            3: "Aperture priority",
	            4: "Shutter priority",
	            5: "Creative program",
	            6: "Action program",
	            7: "Portrait mode",
	            8: "Landscape mode"
	        },
	        MeteringMode        : {
	            0  : "Unknown",
	            1  : "Average",
	            2  : "CenterWeightedAverage",
	            3  : "Spot",
	            4  : "MultiSpot",
	            5  : "Pattern",
	            6  : "Partial",
	            255: "Other"
	        },
	        LightSource         : {
	            0  : "Unknown",
	            1  : "Daylight",
	            2  : "Fluorescent",
	            3  : "Tungsten (incandescent light)",
	            4  : "Flash",
	            9  : "Fine weather",
	            10 : "Cloudy weather",
	            11 : "Shade",
	            12 : "Daylight fluorescent (D 5700 - 7100K)",
	            13 : "Day white fluorescent (N 4600 - 5400K)",
	            14 : "Cool white fluorescent (W 3900 - 4500K)",
	            15 : "White fluorescent (WW 3200 - 3700K)",
	            17 : "Standard light A",
	            18 : "Standard light B",
	            19 : "Standard light C",
	            20 : "D55",
	            21 : "D65",
	            22 : "D75",
	            23 : "D50",
	            24 : "ISO studio tungsten",
	            255: "Other"
	        },
	        Flash               : {
	            0x0000: "Flash did not fire",
	            0x0001: "Flash fired",
	            0x0005: "Strobe return light not detected",
	            0x0007: "Strobe return light detected",
	            0x0009: "Flash fired, compulsory flash mode",
	            0x000D: "Flash fired, compulsory flash mode, return light not detected",
	            0x000F: "Flash fired, compulsory flash mode, return light detected",
	            0x0010: "Flash did not fire, compulsory flash mode",
	            0x0018: "Flash did not fire, auto mode",
	            0x0019: "Flash fired, auto mode",
	            0x001D: "Flash fired, auto mode, return light not detected",
	            0x001F: "Flash fired, auto mode, return light detected",
	            0x0020: "No flash function",
	            0x0041: "Flash fired, red-eye reduction mode",
	            0x0045: "Flash fired, red-eye reduction mode, return light not detected",
	            0x0047: "Flash fired, red-eye reduction mode, return light detected",
	            0x0049: "Flash fired, compulsory flash mode, red-eye reduction mode",
	            0x004D: "Flash fired, compulsory flash mode, red-eye reduction mode, return light not detected",
	            0x004F: "Flash fired, compulsory flash mode, red-eye reduction mode, return light detected",
	            0x0059: "Flash fired, auto mode, red-eye reduction mode",
	            0x005D: "Flash fired, auto mode, return light not detected, red-eye reduction mode",
	            0x005F: "Flash fired, auto mode, return light detected, red-eye reduction mode"
	        },
	        SensingMethod       : {
	            1: "Not defined",
	            2: "One-chip color area sensor",
	            3: "Two-chip color area sensor",
	            4: "Three-chip color area sensor",
	            5: "Color sequential area sensor",
	            7: "Trilinear sensor",
	            8: "Color sequential linear sensor"
	        },
	        SceneCaptureType    : {
	            0: "Standard",
	            1: "Landscape",
	            2: "Portrait",
	            3: "Night scene"
	        },
	        SceneType           : {
	            1: "Directly photographed"
	        },
	        CustomRendered      : {
	            0: "Normal process",
	            1: "Custom process"
	        },
	        WhiteBalance        : {
	            0: "Auto white balance",
	            1: "Manual white balance"
	        },
	        GainControl         : {
	            0: "None",
	            1: "Low gain up",
	            2: "High gain up",
	            3: "Low gain down",
	            4: "High gain down"
	        },
	        Contrast            : {
	            0: "Normal",
	            1: "Soft",
	            2: "Hard"
	        },
	        Saturation          : {
	            0: "Normal",
	            1: "Low saturation",
	            2: "High saturation"
	        },
	        Sharpness           : {
	            0: "Normal",
	            1: "Soft",
	            2: "Hard"
	        },
	        SubjectDistanceRange: {
	            0: "Unknown",
	            1: "Macro",
	            2: "Close view",
	            3: "Distant view"
	        },
	        FileSource          : {
	            3: "DSC"
	        },

	        Components: {
	            0: "",
	            1: "Y",
	            2: "Cb",
	            3: "Cr",
	            4: "R",
	            5: "G",
	            6: "B"
	        }
	    };

	    function addEvent (element, event, handler) {
	        if (element.addEventListener) {
	            element.addEventListener(event, handler, false);
	        } else if (element.attachEvent) {
	            element.attachEvent("on" + event, handler);
	        }
	    }

	    function imageHasData (img) {
	        return !!(img.exifdata);
	    }


	    function base64ToArrayBuffer (base64, contentType) {
	        contentType = contentType || base64.match(/^data\:([^\;]+)\;base64,/mi)[1] || ''; // e.g. 'data:image/jpeg;base64,...' => 'image/jpeg'
	        base64     = base64.replace(/^data\:([^\;]+)\;base64,/gmi, '');
	        var binary = atob(base64);
	        var len    = binary.length;
	        var buffer = new ArrayBuffer(len);
	        var view   = new Uint8Array(buffer);
	        for (var i = 0; i < len; i++) {
	            view[i] = binary.charCodeAt(i);
	        }
	        return buffer;
	    }

	    function objectURLToBlob (url, callback) {
	        var http          = new XMLHttpRequest();
	        http.open("GET", url, true);
	        http.responseType = "blob";
	        http.onload       = function (e) {
	            if (this.status == 200 || this.status === 0) {
	                callback(this.response);
	            }
	        };
	        http.send();
	    }

	    function getImageData (img, callback) {
	        function handleBinaryFile (binFile) {
	            var data     = findEXIFinJPEG(binFile);
	            var iptcdata = findIPTCinJPEG(binFile);
	            img.exifdata = data || {};
	            img.iptcdata = iptcdata || {};
	            if (callback) {
	                callback.call(img);
	            }
	        }

	        if (img.src) {
	            if (/^data\:/i.test(img.src)) { // Data URI
	                var arrayBuffer = base64ToArrayBuffer(img.src);
	                handleBinaryFile(arrayBuffer);

	            } else if (/^blob\:/i.test(img.src)) { // Object URL
	                var fileReader    = new FileReader();
	                fileReader.onload = function (e) {
	                    handleBinaryFile(e.target.result);
	                };
	                objectURLToBlob(img.src, function (blob) {
	                    fileReader.readAsArrayBuffer(blob);
	                });
	            } else {
	                var http          = new XMLHttpRequest();
	                http.onload       = function () {
	                    if (this.status == 200 || this.status === 0) {
	                        handleBinaryFile(http.response);
	                    } else {
	                        callback(new Error("Could not load image"));
	                    }
	                    http = null;
	                };
	                http.open("GET", img.src, true);
	                http.responseType = "arraybuffer";
	                http.send(null);
	            }
	        } else if (window.FileReader && (img instanceof window.Blob || img instanceof window.File)) {
	            var fileReader    = new FileReader();
	            fileReader.onload = function (e) {
	                if (debug) console.log("Got file of length " + e.target.result.byteLength);
	                handleBinaryFile(e.target.result);
	            };

	            fileReader.readAsArrayBuffer(img);
	        }
	    }

	    function findEXIFinJPEG (file) {
	        var dataView = new DataView(file);

	        if (debug) console.log("Got file of length " + file.byteLength);
	        if ((dataView.getUint8(0) != 0xFF) || (dataView.getUint8(1) != 0xD8)) {
	            if (debug) console.log("Not a valid JPEG");
	            return false; // not a valid jpeg
	        }

	        var offset = 2,
	            length = file.byteLength,
	            marker;

	        while (offset < length) {
	            if (dataView.getUint8(offset) != 0xFF) {
	                if (debug) console.log("Not a valid marker at offset " + offset + ", found: " + dataView.getUint8(offset));
	                return false; // not a valid marker, something is wrong
	            }

	            marker = dataView.getUint8(offset + 1);
	            if (debug) console.log(marker);

	            // we could implement handling for other markers here,
	            // but we're only looking for 0xFFE1 for EXIF data

	            if (marker == 225) {
	                if (debug) console.log("Found 0xFFE1 marker");

	                return readEXIFData(dataView, offset + 4, dataView.getUint16(offset + 2) - 2);

	                // offset += 2 + file.getShortAt(offset+2, true);

	            } else {
	                offset += 2 + dataView.getUint16(offset + 2);
	            }

	        }

	    }

	    function findIPTCinJPEG (file) {
	        var dataView = new DataView(file);

	        if (debug) console.log("Got file of length " + file.byteLength);
	        if ((dataView.getUint8(0) != 0xFF) || (dataView.getUint8(1) != 0xD8)) {
	            if (debug) console.log("Not a valid JPEG");
	            return false; // not a valid jpeg
	        }

	        var offset = 2,
	            length = file.byteLength;


	        var isFieldSegmentStart = function (dataView, offset) {
	            return (
	                dataView.getUint8(offset) === 0x38 &&
	                dataView.getUint8(offset + 1) === 0x42 &&
	                dataView.getUint8(offset + 2) === 0x49 &&
	                dataView.getUint8(offset + 3) === 0x4D &&
	                dataView.getUint8(offset + 4) === 0x04 &&
	                dataView.getUint8(offset + 5) === 0x04
	            );
	        };

	        while (offset < length) {

	            if (isFieldSegmentStart(dataView, offset)) {

	                // Get the length of the name header (which is padded to an even number of bytes)
	                var nameHeaderLength = dataView.getUint8(offset + 7);
	                if (nameHeaderLength % 2 !== 0) nameHeaderLength += 1;
	                // Check for pre photoshop 6 format
	                if (nameHeaderLength === 0) {
	                    // Always 4
	                    nameHeaderLength = 4;
	                }

	                var startOffset   = offset + 8 + nameHeaderLength;
	                var sectionLength = dataView.getUint16(offset + 6 + nameHeaderLength);

	                return readIPTCData(file, startOffset, sectionLength);

	                break;

	            }


	            // Not the marker, continue searching
	            offset++;

	        }

	    }

	    var IptcFieldMap = {
	        0x78: 'caption',
	        0x6E: 'credit',
	        0x19: 'keywords',
	        0x37: 'dateCreated',
	        0x50: 'byline',
	        0x55: 'bylineTitle',
	        0x7A: 'captionWriter',
	        0x69: 'headline',
	        0x74: 'copyright',
	        0x0F: 'category'
	    };

	    function readIPTCData (file, startOffset, sectionLength) {
	        var dataView        = new DataView(file);
	        var data            = {};
	        var fieldValue, fieldName, dataSize, segmentType, segmentSize;
	        var segmentStartPos = startOffset;
	        while (segmentStartPos < startOffset + sectionLength) {
	            if (dataView.getUint8(segmentStartPos) === 0x1C && dataView.getUint8(segmentStartPos + 1) === 0x02) {
	                segmentType = dataView.getUint8(segmentStartPos + 2);
	                if (segmentType in IptcFieldMap) {
	                    dataSize    = dataView.getInt16(segmentStartPos + 3);
	                    segmentSize = dataSize + 5;
	                    fieldName   = IptcFieldMap[segmentType];
	                    fieldValue  = getStringFromDB(dataView, segmentStartPos + 5, dataSize);
	                    // Check if we already stored a value with this name
	                    if (data.hasOwnProperty(fieldName)) {
	                        // Value already stored with this name, create multivalue field
	                        if (data[fieldName] instanceof Array) {
	                            data[fieldName].push(fieldValue);
	                        }
	                        else {
	                            data[fieldName] = [data[fieldName], fieldValue];
	                        }
	                    }
	                    else {
	                        data[fieldName] = fieldValue;
	                    }
	                }

	            }
	            segmentStartPos++;
	        }
	        return data;
	    }


	    function readTags (file, tiffStart, dirStart, strings, bigEnd) {
	        var entries = file.getUint16(dirStart, !bigEnd),
	            tags    = {},
	            entryOffset, tag,
	            i;

	        for (i = 0; i < entries; i++) {
	            entryOffset = dirStart + i * 12 + 2;
	            tag         = strings[file.getUint16(entryOffset, !bigEnd)];
	            if (!tag && debug) console.log("Unknown tag: " + file.getUint16(entryOffset, !bigEnd));
	            tags[tag] = readTagValue(file, entryOffset, tiffStart, dirStart, bigEnd);
	        }
	        return tags;
	    }


	    function readTagValue (file, entryOffset, tiffStart, dirStart, bigEnd) {
	        var type        = file.getUint16(entryOffset + 2, !bigEnd),
	            numValues   = file.getUint32(entryOffset + 4, !bigEnd),
	            valueOffset = file.getUint32(entryOffset + 8, !bigEnd) + tiffStart,
	            offset,
	            vals, val, n,
	            numerator, denominator;

	        switch (type) {
	            case 1: // byte, 8-bit unsigned int
	            case 7: // undefined, 8-bit byte, value depending on field
	                if (numValues == 1) {
	                    return file.getUint8(entryOffset + 8, !bigEnd);
	                } else {
	                    offset = numValues > 4 ? valueOffset : (entryOffset + 8);
	                    vals   = [];
	                    for (n = 0; n < numValues; n++) {
	                        vals[n] = file.getUint8(offset + n);
	                    }
	                    return vals;
	                }

	            case 2: // ascii, 8-bit byte
	                offset = numValues > 4 ? valueOffset : (entryOffset + 8);
	                return getStringFromDB(file, offset, numValues - 1);

	            case 3: // short, 16 bit int
	                if (numValues == 1) {
	                    return file.getUint16(entryOffset + 8, !bigEnd);
	                } else {
	                    offset = numValues > 2 ? valueOffset : (entryOffset + 8);
	                    vals   = [];
	                    for (n = 0; n < numValues; n++) {
	                        vals[n] = file.getUint16(offset + 2 * n, !bigEnd);
	                    }
	                    return vals;
	                }

	            case 4: // long, 32 bit int
	                if (numValues == 1) {
	                    return file.getUint32(entryOffset + 8, !bigEnd);
	                } else {
	                    vals = [];
	                    for (n = 0; n < numValues; n++) {
	                        vals[n] = file.getUint32(valueOffset + 4 * n, !bigEnd);
	                    }
	                    return vals;
	                }

	            case 5:    // rational = two long values, first is numerator, second is denominator
	                if (numValues == 1) {
	                    numerator       = file.getUint32(valueOffset, !bigEnd);
	                    denominator     = file.getUint32(valueOffset + 4, !bigEnd);
	                    val             = new Number(numerator / denominator);
	                    val.numerator   = numerator;
	                    val.denominator = denominator;
	                    return val;
	                } else {
	                    vals = [];
	                    for (n = 0; n < numValues; n++) {
	                        numerator           = file.getUint32(valueOffset + 8 * n, !bigEnd);
	                        denominator         = file.getUint32(valueOffset + 4 + 8 * n, !bigEnd);
	                        vals[n]             = new Number(numerator / denominator);
	                        vals[n].numerator   = numerator;
	                        vals[n].denominator = denominator;
	                    }
	                    return vals;
	                }

	            case 9: // slong, 32 bit signed int
	                if (numValues == 1) {
	                    return file.getInt32(entryOffset + 8, !bigEnd);
	                } else {
	                    vals = [];
	                    for (n = 0; n < numValues; n++) {
	                        vals[n] = file.getInt32(valueOffset + 4 * n, !bigEnd);
	                    }
	                    return vals;
	                }

	            case 10: // signed rational, two slongs, first is numerator, second is denominator
	                if (numValues == 1) {
	                    return file.getInt32(valueOffset, !bigEnd) / file.getInt32(valueOffset + 4, !bigEnd);
	                } else {
	                    vals = [];
	                    for (n = 0; n < numValues; n++) {
	                        vals[n] = file.getInt32(valueOffset + 8 * n, !bigEnd) / file.getInt32(valueOffset + 4 + 8 * n, !bigEnd);
	                    }
	                    return vals;
	                }
	        }
	    }

	    function getStringFromDB (buffer, start, length) {
	        var outstr = "", n;
	        for (n = start; n < start + length; n++) {
	            outstr += String.fromCharCode(buffer.getUint8(n));
	        }
	        return outstr;
	    }

	    function readEXIFData (file, start) {
	        if (getStringFromDB(file, start, 4) != "Exif") {
	            if (debug) console.log("Not valid EXIF data! " + getStringFromDB(file, start, 4));
	            return false;
	        }

	        var bigEnd,
	            tags, tag,
	            exifData, gpsData,
	            tiffOffset = start + 6;

	        // test for TIFF validity and endianness
	        if (file.getUint16(tiffOffset) == 0x4949) {
	            bigEnd = false;
	        } else if (file.getUint16(tiffOffset) == 0x4D4D) {
	            bigEnd = true;
	        } else {
	            if (debug) console.log("Not valid TIFF data! (no 0x4949 or 0x4D4D)");
	            return false;
	        }

	        if (file.getUint16(tiffOffset + 2, !bigEnd) != 0x002A) {
	            if (debug) console.log("Not valid TIFF data! (no 0x002A)");
	            return false;
	        }

	        var firstIFDOffset = file.getUint32(tiffOffset + 4, !bigEnd);

	        if (firstIFDOffset < 0x00000008) {
	            if (debug) console.log("Not valid TIFF data! (First offset less than 8)", file.getUint32(tiffOffset + 4, !bigEnd));
	            return false;
	        }

	        tags = readTags(file, tiffOffset, tiffOffset + firstIFDOffset, TiffTags, bigEnd);

	        if (tags.ExifIFDPointer) {
	            exifData = readTags(file, tiffOffset, tiffOffset + tags.ExifIFDPointer, ExifTags, bigEnd);
	            for (tag in exifData) {
	                switch (tag) {
	                    case "LightSource" :
	                    case "Flash" :
	                    case "MeteringMode" :
	                    case "ExposureProgram" :
	                    case "SensingMethod" :
	                    case "SceneCaptureType" :
	                    case "SceneType" :
	                    case "CustomRendered" :
	                    case "WhiteBalance" :
	                    case "GainControl" :
	                    case "Contrast" :
	                    case "Saturation" :
	                    case "Sharpness" :
	                    case "SubjectDistanceRange" :
	                    case "FileSource" :
	                        exifData[tag] = StringValues[tag][exifData[tag]];
	                        break;

	                    case "ExifVersion" :
	                    case "FlashpixVersion" :
	                        exifData[tag] = String.fromCharCode(exifData[tag][0], exifData[tag][1], exifData[tag][2], exifData[tag][3]);
	                        break;

	                    case "ComponentsConfiguration" :
	                        exifData[tag] =
	                            StringValues.Components[exifData[tag][0]] +
	                            StringValues.Components[exifData[tag][1]] +
	                            StringValues.Components[exifData[tag][2]] +
	                            StringValues.Components[exifData[tag][3]];
	                        break;
	                }
	                tags[tag] = exifData[tag];
	            }
	        }

	        if (tags.GPSInfoIFDPointer) {
	            gpsData = readTags(file, tiffOffset, tiffOffset + tags.GPSInfoIFDPointer, GPSTags, bigEnd);
	            for (tag in gpsData) {
	                switch (tag) {
	                    case "GPSVersionID" :
	                        gpsData[tag] = gpsData[tag][0] +
	                            "." + gpsData[tag][1] +
	                            "." + gpsData[tag][2] +
	                            "." + gpsData[tag][3];
	                        break;
	                }
	                tags[tag] = gpsData[tag];
	            }
	        }

	        return tags;
	    }

	    EXIF.getData = function (img, callback) {
	        if ((img instanceof Image || img instanceof HTMLImageElement) && !img.complete) return false;

	        if (!imageHasData(img)) {
	            getImageData(img, callback);
	        } else {
	            if (callback) {
	                callback.call(img);
	            }
	        }
	        return true;
	    }

	    EXIF.getTag = function (img, tag) {
	        if (!imageHasData(img)) return;
	        return img.exifdata[tag];
	    }

	    EXIF.getAllTags = function (img) {
	        if (!imageHasData(img)) return {};
	        var a,
	            data = img.exifdata,
	            tags = {};
	        for (a in data) {
	            if (data.hasOwnProperty(a)) {
	                tags[a] = data[a];
	            }
	        }
	        return tags;
	    }

	    EXIF.pretty = function (img) {
	        if (!imageHasData(img)) return "";
	        var a,
	            data      = img.exifdata,
	            strPretty = "";
	        for (a in data) {
	            if (data.hasOwnProperty(a)) {
	                if (typeof data[a] == "object") {
	                    if (data[a] instanceof Number) {
	                        strPretty += a + " : " + data[a] + " [" + data[a].numerator + "/" + data[a].denominator + "]\r\n";
	                    } else {
	                        strPretty += a + " : [" + data[a].length + " values]\r\n";
	                    }
	                } else {
	                    strPretty += a + " : " + data[a] + "\r\n";
	                }
	            }
	        }
	        return strPretty;
	    }

	    EXIF.readFromBinaryFile = function (file) {
	        return findEXIFinJPEG(file);
	    }

	    if (true) {
	        !(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = function () {
	            return EXIF;
	        }.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	    }
	}.call(this));

/***/ },
/* 7 */
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/**
	 * Mega pixel image rendering library for iOS6 Safari
	 *
	 * Fixes iOS6 Safari's image file rendering issue for large size image (over mega-pixel),
	 * which causes unexpected subsampling when drawing it in canvas.
	 * By using this library, you can safely render the image with proper stretching.
	 *
	 * Copyright (c) 2012 Shinichi Tomita <shinichi.tomita@gmail.com>
	 * Released under the MIT license
	 */
	(function () {

	    /**
	     * Detect subsampling in loaded image.
	     * In iOS, larger images than 2M pixels may be subsampled in rendering.
	     */
	    function detectSubsampling (img) {
	        var iw = img.naturalWidth, ih = img.naturalHeight;
	        if (iw * ih > 1024 * 1024) { // subsampling may happen over megapixel image
	            var canvas   = document.createElement('canvas');
	            canvas.width = canvas.height = 1;
	            var ctx = canvas.getContext('2d');
	            ctx.drawImage(img, -iw + 1, 0);
	            // subsampled image becomes half smaller in rendering size.
	            // check alpha channel value to confirm image is covering edge pixel or not.
	            // if alpha value is 0 image is not covering, hence subsampled.
	            return ctx.getImageData(0, 0, 1, 1).data[3] === 0;
	        } else {
	            return false;
	        }
	    }

	    /**
	     * Detecting vertical squash in loaded image.
	     * Fixes a bug which squash image vertically while drawing into canvas for some images.
	     */
	    function detectVerticalSquash (img, iw, ih) {
	        var canvas    = document.createElement('canvas');
	        canvas.width  = 1;
	        canvas.height = ih;
	        var ctx       = canvas.getContext('2d');
	        ctx.drawImage(img, 0, 0);
	        var data      = ctx.getImageData(0, 0, 1, ih).data;
	        // search image edge pixel position in case it is squashed vertically.
	        var sy = 0;
	        var ey = ih;
	        var py = ih;
	        while (py > sy) {
	            var alpha = data[(py - 1) * 4 + 3];
	            if (alpha === 0) {
	                ey = py;
	            } else {
	                sy = py;
	            }
	            py = (ey + sy) >> 1;
	        }
	        var ratio = (py / ih);
	        return (ratio === 0) ? 1 : ratio;
	    }

	    /**
	     * Rendering image element (with resizing) and get its data URL
	     */
	    function renderImageToDataURL (img, options, doSquash) {
	        var canvas = document.createElement('canvas');
	        renderImageToCanvas(img, canvas, options, doSquash);
	        return canvas.toDataURL("image/jpeg", options.quality || 0.8);
	    }

	    /**
	     * Rendering image element (with resizing) into the canvas element
	     */
	    function renderImageToCanvas (img, canvas, options, doSquash) {
	        var iw         = img.naturalWidth, ih = img.naturalHeight;
	        var width      = options.width, height = options.height;
	        var ctx        = canvas.getContext('2d');
	        ctx.save();
	        transformCoordinate(canvas, ctx, width, height, options.orientation);
	        var subsampled = detectSubsampling(img);
	        if (subsampled) {
	            iw /= 2;
	            ih /= 2;
	        }
	        var d = 1024; // size of tiling canvas
	        var tmpCanvas   = document.createElement('canvas');
	        tmpCanvas.width = tmpCanvas.height = d;
	        var tmpCtx          = tmpCanvas.getContext('2d');
	        var vertSquashRatio = doSquash ? detectVerticalSquash(img, iw, ih) : 1;
	        var dw              = Math.ceil(d * width / iw);
	        var dh              = Math.ceil(d * height / ih / vertSquashRatio);
	        var sy              = 0;
	        var dy              = 0;
	        while (sy < ih) {
	            var sx = 0;
	            var dx = 0;
	            while (sx < iw) {
	                tmpCtx.clearRect(0, 0, d, d);
	                tmpCtx.drawImage(img, -sx, -sy);
	                ctx.drawImage(tmpCanvas, 0, 0, d, d, dx, dy, dw, dh);
	                sx += d;
	                dx += dw;
	            }
	            sy += d;
	            dy += dh;
	        }
	        ctx.restore();
	        tmpCanvas           = tmpCtx = null;
	    }

	    /**
	     * Transform canvas coordination according to specified frame size and orientation
	     * Orientation value is from EXIF tag
	     */
	    function transformCoordinate (canvas, ctx, width, height, orientation) {
	        switch (orientation) {
	            case 5:
	            case 6:
	            case 7:
	            case 8:
	                canvas.width  = height;
	                canvas.height = width;
	                break;
	            default:
	                canvas.width  = width;
	                canvas.height = height;
	        }
	        switch (orientation) {
	            case 2:
	                // horizontal flip
	                ctx.translate(width, 0);
	                ctx.scale(-1, 1);
	                break;
	            case 3:
	                // 180 rotate left
	                ctx.translate(width, height);
	                ctx.rotate(Math.PI);
	                break;
	            case 4:
	                // vertical flip
	                ctx.translate(0, height);
	                ctx.scale(1, -1);
	                break;
	            case 5:
	                // vertical flip + 90 rotate right
	                ctx.rotate(0.5 * Math.PI);
	                ctx.scale(1, -1);
	                break;
	            case 6:
	                // 90 rotate right
	                ctx.rotate(0.5 * Math.PI);
	                ctx.translate(0, -height);
	                break;
	            case 7:
	                // horizontal flip + 90 rotate right
	                ctx.rotate(0.5 * Math.PI);
	                ctx.translate(width, -height);
	                ctx.scale(-1, 1);
	                break;
	            case 8:
	                // 90 rotate left
	                ctx.rotate(-0.5 * Math.PI);
	                ctx.translate(-width, 0);
	                break;
	            default:
	                break;
	        }
	    }


	    /**
	     * MegaPixImage class
	     */
	    function MegaPixImage (srcImage) {
	        if (window.Blob && srcImage instanceof Blob) {
	            var img = new Image();
	            var URL = window.URL && window.URL.createObjectURL ? window.URL :
	                window.webkitURL && window.webkitURL.createObjectURL ? window.webkitURL :
	                    null;
	            if (!URL) {
	                throw Error("No createObjectURL function found to create blob url");
	            }
	            img.src   = URL.createObjectURL(srcImage);
	            this.blob = srcImage;
	            srcImage  = img;
	        }
	        if (!srcImage.naturalWidth && !srcImage.naturalHeight) {
	            var _this               = this;
	            srcImage.onload         = function () {
	                var listeners = _this.imageLoadListeners;
	                if (listeners) {
	                    _this.imageLoadListeners = null;
	                    for (var i = 0, len = listeners.length; i < len; i++) {
	                        listeners[i]();
	                    }
	                }
	            };
	            this.imageLoadListeners = [];
	        }
	        this.srcImage = srcImage;
	    }

	    /**
	     * Rendering megapix image into specified target element
	     */
	    MegaPixImage.prototype.render = function (target, options, callback) {
	        if (this.imageLoadListeners) {
	            var _this = this;
	            this.imageLoadListeners.push(function () {
	                _this.render(target, options, callback);
	            });
	            return;
	        }
	        options       = options || {};
	        var srcImage  = this.srcImage,
	            src       = srcImage.src,
	            srcLength = src.length,
	            imgWidth  = srcImage.naturalWidth, imgHeight = srcImage.naturalHeight,
	            width     = options.width, height = options.height,
	            maxWidth  = options.maxWidth, maxHeight = options.maxHeight,
	            doSquash  = this.blob && this.blob.type === 'image/jpeg' ||
	                src.indexOf('data:image/jpeg') === 0 ||
	                src.indexOf('.jpg') === srcLength - 4 ||
	                src.indexOf('.jpeg') === srcLength - 5;
	        if (width && !height) {
	            height = (imgHeight * width / imgWidth) << 0;
	        } else if (height && !width) {
	            width = (imgWidth * height / imgHeight) << 0;
	        } else {
	            width  = imgWidth;
	            height = imgHeight;
	        }
	        if (maxWidth && width > maxWidth) {
	            width  = maxWidth;
	            height = (imgHeight * width / imgWidth) << 0;
	        }
	        if (maxHeight && height > maxHeight) {
	            height = maxHeight;
	            width  = (imgWidth * height / imgHeight) << 0;
	        }
	        var opt = {width: width, height: height};
	        for (var k in options) opt[k] = options[k];

	        var tagName = target.tagName.toLowerCase();
	        if (tagName === 'img') {
	            target.src = renderImageToDataURL(this.srcImage, opt, doSquash);
	        } else if (tagName === 'canvas') {
	            renderImageToCanvas(this.srcImage, target, opt, doSquash);
	        }
	        if (typeof this.onrender === 'function') {
	            this.onrender(target);
	        }
	        if (callback) {
	            callback();
	        }
	    };

	    /**
	     * Export class to global
	     */
	    if (true) {
	        !(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = function () {
	            return MegaPixImage;
	        }.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)); // for AMD loader
	    } else {
	        this.MegaPixImage = MegaPixImage;
	    }

	})();


/***/ },
/* 8 */
/***/ function(module, exports) {

	function JPEGEncoder (l) {
	    var o = this;
	    var s = Math.round;
	    var k = Math.floor;
	    var O = new Array(64);
	    var K = new Array(64);
	    var d = new Array(64);
	    var Z = new Array(64);
	    var u;
	    var h;
	    var G;
	    var T;
	    var n = new Array(65535);
	    var m = new Array(65535);
	    var P = new Array(64);
	    var S = new Array(64);
	    var j = [];
	    var t = 0;
	    var a = 7;
	    var A = new Array(64);
	    var f = new Array(64);
	    var U = new Array(64);
	    var e = new Array(256);
	    var C = new Array(2048);
	    var x;
	    var i = [0, 1, 5, 6, 14, 15, 27, 28, 2, 4, 7, 13, 16, 26, 29, 42, 3, 8, 12, 17, 25, 30, 41, 43, 9, 11, 18, 24, 31, 40, 44, 53, 10, 19, 23, 32, 39, 45, 52, 54, 20, 22, 33, 38, 46, 51, 55, 60, 21, 34, 37, 47, 50, 56, 59, 61, 35, 36, 48, 49, 57, 58, 62, 63];
	    var g = [0, 0, 1, 5, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0];
	    var c = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
	    var w = [0, 0, 2, 1, 3, 3, 2, 4, 3, 5, 5, 4, 4, 0, 0, 1, 125];
	    var E = [1, 2, 3, 0, 4, 17, 5, 18, 33, 49, 65, 6, 19, 81, 97, 7, 34, 113, 20, 50, 129, 145, 161, 8, 35, 66, 177, 193, 21, 82, 209, 240, 36, 51, 98, 114, 130, 9, 10, 22, 23, 24, 25, 26, 37, 38, 39, 40, 41, 42, 52, 53, 54, 55, 56, 57, 58, 67, 68, 69, 70, 71, 72, 73, 74, 83, 84, 85, 86, 87, 88, 89, 90, 99, 100, 101, 102, 103, 104, 105, 106, 115, 116, 117, 118, 119, 120, 121, 122, 131, 132, 133, 134, 135, 136, 137, 138, 146, 147, 148, 149, 150, 151, 152, 153, 154, 162, 163, 164, 165, 166, 167, 168, 169, 170, 178, 179, 180, 181, 182, 183, 184, 185, 186, 194, 195, 196, 197, 198, 199, 200, 201, 202, 210, 211, 212, 213, 214, 215, 216, 217, 218, 225, 226, 227, 228, 229, 230, 231, 232, 233, 234, 241, 242, 243, 244, 245, 246, 247, 248, 249, 250];
	    var v = [0, 0, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0];
	    var Y = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
	    var J = [0, 0, 2, 1, 2, 4, 4, 3, 4, 7, 5, 4, 4, 0, 1, 2, 119];
	    var B = [0, 1, 2, 3, 17, 4, 5, 33, 49, 6, 18, 65, 81, 7, 97, 113, 19, 34, 50, 129, 8, 20, 66, 145, 161, 177, 193, 9, 35, 51, 82, 240, 21, 98, 114, 209, 10, 22, 36, 52, 225, 37, 241, 23, 24, 25, 26, 38, 39, 40, 41, 42, 53, 54, 55, 56, 57, 58, 67, 68, 69, 70, 71, 72, 73, 74, 83, 84, 85, 86, 87, 88, 89, 90, 99, 100, 101, 102, 103, 104, 105, 106, 115, 116, 117, 118, 119, 120, 121, 122, 130, 131, 132, 133, 134, 135, 136, 137, 138, 146, 147, 148, 149, 150, 151, 152, 153, 154, 162, 163, 164, 165, 166, 167, 168, 169, 170, 178, 179, 180, 181, 182, 183, 184, 185, 186, 194, 195, 196, 197, 198, 199, 200, 201, 202, 210, 211, 212, 213, 214, 215, 216, 217, 218, 226, 227, 228, 229, 230, 231, 232, 233, 234, 242, 243, 244, 245, 246, 247, 248, 249, 250];

	    function M (ag) {
	        var af = [16, 11, 10, 16, 24, 40, 51, 61, 12, 12, 14, 19, 26, 58, 60, 55, 14, 13, 16, 24, 40, 57, 69, 56, 14, 17, 22, 29, 51, 87, 80, 62, 18, 22, 37, 56, 68, 109, 103, 77, 24, 35, 55, 64, 81, 104, 113, 92, 49, 64, 78, 87, 103, 121, 120, 101, 72, 92, 95, 98, 112, 100, 103, 99];
	        for (var ae = 0; ae < 64; ae++) {
	            var aj = k((af[ae] * ag + 50) / 100);
	            if (aj < 1) {
	                aj = 1
	            } else {
	                if (aj > 255) {
	                    aj = 255
	                }
	            }
	            O[i[ae]] = aj
	        }
	        var ah = [17, 18, 24, 47, 99, 99, 99, 99, 18, 21, 26, 66, 99, 99, 99, 99, 24, 26, 56, 99, 99, 99, 99, 99, 47, 66, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99, 99];
	        for (var ad = 0; ad < 64; ad++) {
	            var ai = k((ah[ad] * ag + 50) / 100);
	            if (ai < 1) {
	                ai = 1
	            } else {
	                if (ai > 255) {
	                    ai = 255
	                }
	            }
	            K[i[ad]] = ai
	        }
	        var ac = [1, 1.387039845, 1.306562965, 1.175875602, 1, 0.785694958, 0.5411961, 0.275899379];
	        var ab = 0;
	        for (var ak = 0; ak < 8; ak++) {
	            for (var aa = 0; aa < 8; aa++) {
	                d[ab] = (1 / (O[i[ab]] * ac[ak] * ac[aa] * 8));
	                Z[ab] = (1 / (K[i[ab]] * ac[ak] * ac[aa] * 8));
	                ab++
	            }
	        }
	    }

	    function q (ae, aa) {
	        var ad = 0;
	        var ag = 0;
	        var af = new Array();
	        for (var ab = 1; ab <= 16; ab++) {
	            for (var ac = 1; ac <= ae[ab]; ac++) {
	                af[aa[ag]]    = [];
	                af[aa[ag]][0] = ad;
	                af[aa[ag]][1] = ab;
	                ag++;
	                ad++
	            }
	            ad *= 2
	        }
	        return af
	    }

	    function W () {
	        u = q(g, c);
	        h = q(v, Y);
	        G = q(w, E);
	        T = q(J, B)
	    }

	    function z () {
	        var ac = 1;
	        var ab = 2;
	        for (var aa = 1; aa <= 15; aa++) {
	            for (var ad = ac; ad < ab; ad++) {
	                m[32767 + ad]    = aa;
	                n[32767 + ad]    = [];
	                n[32767 + ad][1] = aa;
	                n[32767 + ad][0] = ad
	            }
	            for (var ae = -(ab - 1); ae <= -ac; ae++) {
	                m[32767 + ae]    = aa;
	                n[32767 + ae]    = [];
	                n[32767 + ae][1] = aa;
	                n[32767 + ae][0] = ab - 1 + ae
	            }
	            ac <<= 1;
	            ab <<= 1
	        }
	    }

	    function V () {
	        for (var aa = 0; aa < 256; aa++) {
	            C[aa]               = 19595 * aa;
	            C[(aa + 256) >> 0]  = 38470 * aa;
	            C[(aa + 512) >> 0]  = 7471 * aa + 32768;
	            C[(aa + 768) >> 0]  = -11059 * aa;
	            C[(aa + 1024) >> 0] = -21709 * aa;
	            C[(aa + 1280) >> 0] = 32768 * aa + 8421375;
	            C[(aa + 1536) >> 0] = -27439 * aa;
	            C[(aa + 1792) >> 0] = -5329 * aa
	        }
	    }

	    function X (aa) {
	        var ac = aa[0];
	        var ab = aa[1] - 1;
	        while (ab >= 0) {
	            if (ac & (1 << ab)) {
	                t |= (1 << a)
	            }
	            ab--;
	            a--;
	            if (a < 0) {
	                if (t == 255) {
	                    F(255);
	                    F(0)
	                } else {
	                    F(t)
	                }
	                a = 7;
	                t = 0
	            }
	        }
	    }

	    function F (aa) {
	        j.push(e[aa])
	    }

	    function p (aa) {
	        F((aa >> 8) & 255);
	        F((aa) & 255)
	    }

	    function N (aZ, ap) {
	        var aL, aK, aJ, aI, aH, aD, aC, aB;
	        var aN   = 0;
	        var aR;
	        const aq = 8;
	        const ai = 64;
	        for (aR = 0; aR < aq; ++aR) {
	            aL         = aZ[aN];
	            aK         = aZ[aN + 1];
	            aJ         = aZ[aN + 2];
	            aI         = aZ[aN + 3];
	            aH         = aZ[aN + 4];
	            aD         = aZ[aN + 5];
	            aC         = aZ[aN + 6];
	            aB         = aZ[aN + 7];
	            var aY     = aL + aB;
	            var aO     = aL - aB;
	            var aX     = aK + aC;
	            var aP     = aK - aC;
	            var aU     = aJ + aD;
	            var aQ     = aJ - aD;
	            var aT     = aI + aH;
	            var aS     = aI - aH;
	            var an     = aY + aT;
	            var ak     = aY - aT;
	            var am     = aX + aU;
	            var al     = aX - aU;
	            aZ[aN]     = an + am;
	            aZ[aN + 4] = an - am;
	            var ax     = (al + ak) * 0.707106781;
	            aZ[aN + 2] = ak + ax;
	            aZ[aN + 6] = ak - ax;
	            an         = aS + aQ;
	            am         = aQ + aP;
	            al         = aP + aO;
	            var at     = (an - al) * 0.382683433;
	            var aw     = 0.5411961 * an + at;
	            var au     = 1.306562965 * al + at;
	            var av     = am * 0.707106781;
	            var ah     = aO + av;
	            var ag     = aO - av;
	            aZ[aN + 5] = ag + aw;
	            aZ[aN + 3] = ag - aw;
	            aZ[aN + 1] = ah + au;
	            aZ[aN + 7] = ah - au;
	            aN += 8
	        }
	        aN = 0;
	        for (aR = 0; aR < aq; ++aR) {
	            aL          = aZ[aN];
	            aK          = aZ[aN + 8];
	            aJ          = aZ[aN + 16];
	            aI          = aZ[aN + 24];
	            aH          = aZ[aN + 32];
	            aD          = aZ[aN + 40];
	            aC          = aZ[aN + 48];
	            aB          = aZ[aN + 56];
	            var ar      = aL + aB;
	            var aj      = aL - aB;
	            var az      = aK + aC;
	            var ae      = aK - aC;
	            var aG      = aJ + aD;
	            var ac      = aJ - aD;
	            var aW      = aI + aH;
	            var aa      = aI - aH;
	            var ao      = ar + aW;
	            var aV      = ar - aW;
	            var ay      = az + aG;
	            var aF      = az - aG;
	            aZ[aN]      = ao + ay;
	            aZ[aN + 32] = ao - ay;
	            var af      = (aF + aV) * 0.707106781;
	            aZ[aN + 16] = aV + af;
	            aZ[aN + 48] = aV - af;
	            ao          = aa + ac;
	            ay          = ac + ae;
	            aF          = ae + aj;
	            var aM      = (ao - aF) * 0.382683433;
	            var ad      = 0.5411961 * ao + aM;
	            var a1      = 1.306562965 * aF + aM;
	            var ab      = ay * 0.707106781;
	            var a0      = aj + ab;
	            var aA      = aj - ab;
	            aZ[aN + 40] = aA + ad;
	            aZ[aN + 24] = aA - ad;
	            aZ[aN + 8]  = a0 + a1;
	            aZ[aN + 56] = a0 - a1;
	            aN++
	        }
	        var aE;
	        for (aR = 0; aR < ai; ++aR) {
	            aE    = aZ[aR] * ap[aR];
	            P[aR] = (aE > 0) ? ((aE + 0.5) | 0) : ((aE - 0.5) | 0)
	        }
	        return P
	    }

	    function b () {
	        p(65504);
	        p(16);
	        F(74);
	        F(70);
	        F(73);
	        F(70);
	        F(0);
	        F(1);
	        F(1);
	        F(0);
	        p(1);
	        p(1);
	        F(0);
	        F(0)
	    }

	    function r (aa, ab) {
	        p(65472);
	        p(17);
	        F(8);
	        p(ab);
	        p(aa);
	        F(3);
	        F(1);
	        F(17);
	        F(0);
	        F(2);
	        F(17);
	        F(1);
	        F(3);
	        F(17);
	        F(1)
	    }

	    function D () {
	        p(65499);
	        p(132);
	        F(0);
	        for (var ab = 0; ab < 64; ab++) {
	            F(O[ab])
	        }
	        F(1);
	        for (var aa = 0; aa < 64; aa++) {
	            F(K[aa])
	        }
	    }

	    function H () {
	        p(65476);
	        p(418);
	        F(0);
	        for (var ae = 0; ae < 16; ae++) {
	            F(g[ae + 1])
	        }
	        for (var ad = 0; ad <= 11; ad++) {
	            F(c[ad])
	        }
	        F(16);
	        for (var ac = 0; ac < 16; ac++) {
	            F(w[ac + 1])
	        }
	        for (var ab = 0; ab <= 161; ab++) {
	            F(E[ab])
	        }
	        F(1);
	        for (var aa = 0; aa < 16; aa++) {
	            F(v[aa + 1])
	        }
	        for (var ah = 0; ah <= 11; ah++) {
	            F(Y[ah])
	        }
	        F(17);
	        for (var ag = 0; ag < 16; ag++) {
	            F(J[ag + 1])
	        }
	        for (var af = 0; af <= 161; af++) {
	            F(B[af])
	        }
	    }

	    function I () {
	        p(65498);
	        p(12);
	        F(3);
	        F(1);
	        F(0);
	        F(2);
	        F(17);
	        F(3);
	        F(17);
	        F(0);
	        F(63);
	        F(0)
	    }

	    function L (ad, aa, al, at, ap) {
	        var ag   = ap[0];
	        var ab   = ap[240];
	        var ac;
	        const ar = 16;
	        const ai = 63;
	        const ah = 64;
	        var aq   = N(ad, aa);
	        for (var am = 0; am < ah; ++am) {
	            S[i[am]] = aq[am]
	        }
	        var an = S[0] - al;
	        al     = S[0];
	        if (an == 0) {
	            X(at[0])
	        } else {
	            ac = 32767 + an;
	            X(at[m[ac]]);
	            X(n[ac])
	        }
	        var ae = 63;
	        for (; (ae > 0) && (S[ae] == 0); ae--) {
	        }
	        if (ae == 0) {
	            X(ag);
	            return al
	        }
	        var ao = 1;
	        var au;
	        while (ao <= ae) {
	            var ak = ao;
	            for (; (S[ao] == 0) && (ao <= ae); ++ao) {
	            }
	            var aj = ao - ak;
	            if (aj >= ar) {
	                au = aj >> 4;
	                for (var af = 1; af <= au; ++af) {
	                    X(ab)
	                }
	                aj = aj & 15
	            }
	            ac = 32767 + S[ao];
	            X(ap[(aj << 4) + m[ac]]);
	            X(n[ac]);
	            ao++
	        }
	        if (ae != ai) {
	            X(ag)
	        }
	        return al
	    }

	    function y () {
	        var ab = String.fromCharCode;
	        for (var aa = 0; aa < 256; aa++) {
	            e[aa] = ab(aa)
	        }
	    }

	    this.encode = function (an, aj, aB) {
	        var aa = new Date().getTime();
	        if (aj) {
	            R(aj)
	        }
	        j                       = new Array();
	        t                       = 0;
	        a                       = 7;
	        p(65496);
	        b();
	        D();
	        r(an.width, an.height);
	        H();
	        I();
	        var al                  = 0;
	        var aq                  = 0;
	        var ao                  = 0;
	        t                       = 0;
	        a                       = 7;
	        this.encode.displayName = "_encode_";
	        var at                  = an.data;
	        var ar                  = an.width;
	        var aA                  = an.height;
	        var ay                  = ar * 4;
	        var ai                  = ar * 3;
	        var ah, ag              = 0;
	        var am, ax, az;
	        var ab, ap, ac, af, ae;
	        while (ag < aA) {
	            ah = 0;
	            while (ah < ay) {
	                ab = ay * ag + ah;
	                ap = ab;
	                ac = -1;
	                af = 0;
	                for (ae = 0; ae < 64; ae++) {
	                    af = ae >> 3;
	                    ac = (ae & 7) * 4;
	                    ap = ab + (af * ay) + ac;
	                    if (ag + af >= aA) {
	                        ap -= (ay * (ag + 1 + af - aA))
	                    }
	                    if (ah + ac >= ay) {
	                        ap -= ((ah + ac) - ay + 4)
	                    }
	                    am    = at[ap++];
	                    ax    = at[ap++];
	                    az    = at[ap++];
	                    A[ae] = ((C[am] + C[(ax + 256) >> 0] + C[(az + 512) >> 0]) >> 16) - 128;
	                    f[ae] = ((C[(am + 768) >> 0] + C[(ax + 1024) >> 0] + C[(az + 1280) >> 0]) >> 16) - 128;
	                    U[ae] = ((C[(am + 1280) >> 0] + C[(ax + 1536) >> 0] + C[(az + 1792) >> 0]) >> 16) - 128
	                }
	                al = L(A, d, al, u, G);
	                aq = L(f, Z, aq, h, T);
	                ao = L(U, Z, ao, h, T);
	                ah += 32
	            }
	            ag += 8
	        }
	        if (a >= 0) {
	            var aw = [];
	            aw[1]  = a + 1;
	            aw[0]  = (1 << (a + 1)) - 1;
	            X(aw)
	        }
	        p(65497);
	        if (aB) {
	            var av = j.length;
	            var aC = new Uint8Array(av);
	            for (var au = 0; au < av; au++) {
	                aC[au] = j[au].charCodeAt()
	            }
	            j      = [];
	            var ak = new Date().getTime() - aa;
	            return aC
	        }
	        var ad = "data:image/jpeg;base64," + btoa(j.join(""));
	        j      = [];
	        var ak = new Date().getTime() - aa;
	        return ad
	    };
	    function R (ab) {
	        if (ab <= 0) {
	            ab = 1
	        }
	        if (ab > 100) {
	            ab = 100
	        }
	        if (x == ab) {
	            return
	        }
	        var aa = 0;
	        if (ab < 50) {
	            aa = Math.floor(5000 / ab)
	        } else {
	            aa = Math.floor(200 - ab * 2)
	        }
	        M(aa);
	        x      = ab;
	    }

	    function Q () {
	        var aa = new Date().getTime();
	        if (!l) {
	            l = 50
	        }
	        y();
	        W();
	        z();
	        V();
	        R(l);
	        var ab = new Date().getTime() - aa;
	    }

	    Q()
	}

	module.exports = JPEGEncoder;

/***/ },
/* 9 */
/***/ function(module, exports, __webpack_require__) {

	// 保证按需加载的文件路径正确
	__webpack_require__.p = getJsDir('lrz') + '/';
	window.URL              = window.URL || window.webkitURL;

	var Promise          = __webpack_require__(1),
	    BlobFormDataShim = __webpack_require__(5),
	    exif             = __webpack_require__(6);


	var UA = (function (userAgent) {
	    var ISOldIOS     = /OS (\d)_.* like Mac OS X/g.exec(userAgent),
	        isOldAndroid = /Android (\d.*?);/g.exec(userAgent) || /Android\/(\d.*?) /g.exec(userAgent);

	    // 判断设备是否是IOS7以下
	    // 判断设备是否是android4.5以下
	    // 判断是否iOS
	    // 判断是否android
	    // 判断是否QQ浏览器
	    return {
	        oldIOS    : ISOldIOS ? +ISOldIOS.pop() < 8 : false,
	        oldAndroid: isOldAndroid ? +isOldAndroid.pop().substr(0, 3) < 4.5 : false,
	        iOS       : /\(i[^;]+;( U;)? CPU.+Mac OS X/.test(userAgent),
	        android   : /Android/g.test(userAgent),
	        mQQBrowser: /MQQBrowser/g.test(userAgent)
	    }
	})(navigator.userAgent);


	function Lrz (file, opts) {
	    var that = this;

	    if (!file) throw new Error('没有收到图片，可能的解决方案：https://github.com/think2011/localResizeIMG/issues/7');

	    opts = opts || {};

	    that.defaults = {
	        width    : null,
	        height   : null,
	        fieldName: 'file',
	        quality  : 0.7
	    };

	    that.file = file;

	    for (var p in opts) {
	        if (!opts.hasOwnProperty(p)) continue;
	        that.defaults[p] = opts[p];
	    }

	    return this.init();
	}

	Lrz.prototype.init = function () {
	    var that         = this,
	        file         = that.file,
	        fileIsString = typeof file === 'string',
	        fileIsBase64 = /^data:/.test(file),
	        img          = new Image(),
	        canvas       = document.createElement('canvas'),
	        blob         = fileIsString ? file : URL.createObjectURL(file);

	    that.img    = img;
	    that.blob   = blob;
	    that.canvas = canvas;

	    if (fileIsString) {
	        that.fileName = fileIsBase64 ? 'base64.jpg' : (file.split('/').pop());
	    } else {
	        that.fileName = file.name;
	    }

	    if (!document.createElement('canvas').getContext) {
	        throw new Error('浏览器不支持canvas');
	    }

	    return new Promise(function (resolve, reject) {
	        img.onerror = function () {
	            var err = new Error('加载图片文件失败');
	            reject(err);
	            throw err;
	        };

	        img.onload = function () {
	            that._getBase64()
	                .then(function (base64) {
	                    if (base64.length < 10) {
	                        var err = new Error('生成base64失败');
	                        reject(err);
	                        throw err;
	                    }

	                    return base64;
	                })
	                .then(function (base64) {
	                    var formData = null;

	                    // 压缩文件太大就采用源文件,且使用原生的FormData() @source #55
	                    if (typeof that.file === 'object' && base64.length > that.file.size) {
	                        formData = new FormData();
	                        file     = that.file;
	                    } else {
	                        formData = new BlobFormDataShim.FormData();
	                        file     = dataURItoBlob(base64);
	                    }

	                    formData.append(that.defaults.fieldName, file, (that.fileName.replace(/\..+/g, '.jpg')));

	                    resolve({
	                        formData : formData,
	                        fileLen : +file.size,
	                        base64  : base64,
	                        base64Len: base64.length,
	                        origin   : that.file,
	                        file   : file
	                    });

	                    // 释放内存
	                    for (var p in that) {
	                        if (!that.hasOwnProperty(p)) continue;

	                        that[p] = null;
	                    }
	                    URL.revokeObjectURL(that.blob);
	                });
	        };

	        // 如果传入的是base64在移动端会报错
	        !fileIsBase64 && (img.crossOrigin = "*");

	        img.src = blob;
	    });
	};

	Lrz.prototype._getBase64 = function () {
	    var that   = this,
	        img    = that.img,
	        file   = that.file,
	        canvas = that.canvas;

	    return new Promise(function (resolve) {
	        try {
	            // 传入blob在android4.3以下有bug
	            exif.getData(typeof file === 'object' ? file : img, function () {
	                that.orientation = exif.getTag(this, "Orientation");

	                that.resize = that._getResize();
	                that.ctx    = canvas.getContext('2d');

	                canvas.width  = that.resize.width;
	                canvas.height = that.resize.height;

	                // 设置为白色背景，jpg是不支持透明的，所以会被默认为canvas默认的黑色背景。
	                that.ctx.fillStyle = '#fff';
	                that.ctx.fillRect(0, 0, canvas.width, canvas.height);

	                // 根据设备对应处理方式
	                if (UA.oldIOS) {
	                    that._createBase64ForOldIOS().then(resolve);
	                }
	                else {
	                    that._createBase64().then(resolve);
	                }
	            });
	        } catch (err) {
	            // 这样能解决低内存设备闪退的问题吗？
	            throw new Error(err);
	        }
	    });
	};


	Lrz.prototype._createBase64ForOldIOS = function () {
	    var that        = this,
	        img         = that.img,
	        canvas      = that.canvas,
	        defaults    = that.defaults,
	        orientation = that.orientation;

	    return new Promise(function (resolve) {
	        !/* require */(/* empty */function() { var __WEBPACK_AMD_REQUIRE_ARRAY__ = [__webpack_require__(7)]; (function (MegaPixImage) {
	            var mpImg = new MegaPixImage(img);

	            if ("5678".indexOf(orientation) > -1) {
	                mpImg.render(canvas, {
	                    width      : canvas.height,
	                    height     : canvas.width,
	                    orientation: orientation
	                });
	            } else {
	                mpImg.render(canvas, {
	                    width      : canvas.width,
	                    height     : canvas.height,
	                    orientation: orientation
	                });
	            }

	            resolve(canvas.toDataURL('image/jpeg', defaults.quality));
	        }.apply(null, __WEBPACK_AMD_REQUIRE_ARRAY__));}());
	    });
	};

	Lrz.prototype._createBase64 = function () {
	    var that        = this,
	        resize      = that.resize,
	        img         = that.img,
	        canvas      = that.canvas,
	        ctx         = that.ctx,
	        defaults    = that.defaults,
	        orientation = that.orientation;

	    // 调整为正确方向
	    switch (orientation) {
	        case 3:
	            ctx.rotate(180 * Math.PI / 180);
	            ctx.drawImage(img, -resize.width, -resize.height, resize.width, resize.height);
	            break;
	        case 6:
	            ctx.rotate(90 * Math.PI / 180);
	            ctx.drawImage(img, 0, -resize.width, resize.height, resize.width);
	            break;
	        case 8:
	            ctx.rotate(270 * Math.PI / 180);
	            ctx.drawImage(img, -resize.height, 0, resize.height, resize.width);
	            break;

	        case 2:
	            ctx.translate(resize.width, 0);
	            ctx.scale(-1, 1);
	            ctx.drawImage(img, 0, 0, resize.width, resize.height);
	            break;
	        case 4:
	            ctx.translate(resize.width, 0);
	            ctx.scale(-1, 1);
	            ctx.rotate(180 * Math.PI / 180);
	            ctx.drawImage(img, -resize.width, -resize.height, resize.width, resize.height);
	            break;
	        case 5:
	            ctx.translate(resize.width, 0);
	            ctx.scale(-1, 1);
	            ctx.rotate(90 * Math.PI / 180);
	            ctx.drawImage(img, 0, -resize.width, resize.height, resize.width);
	            break;
	        case 7:
	            ctx.translate(resize.width, 0);
	            ctx.scale(-1, 1);
	            ctx.rotate(270 * Math.PI / 180);
	            ctx.drawImage(img, -resize.height, 0, resize.height, resize.width);
	            break;

	        default:
	            ctx.drawImage(img, 0, 0, resize.width, resize.height);
	    }

	    return new Promise(function (resolve) {
	        if (UA.oldAndroid || UA.mQQBrowser || !navigator.userAgent) {
	            !/* require */(/* empty */function() { var __WEBPACK_AMD_REQUIRE_ARRAY__ = [__webpack_require__(8)]; (function (JPEGEncoder) {
	                var encoder = new JPEGEncoder(),
	                    img     = ctx.getImageData(0, 0, canvas.width, canvas.height);

	                resolve(encoder.encode(img, defaults.quality * 100));
	            }.apply(null, __WEBPACK_AMD_REQUIRE_ARRAY__));}())
	        }
	        else {
	            resolve(canvas.toDataURL('image/jpeg', defaults.quality));
	        }
	    });
	};

	Lrz.prototype._getResize = function () {
	    var that        = this,
	        img         = that.img,
	        defaults    = that.defaults,
	        width       = defaults.width,
	        height      = defaults.height,
	        orientation = that.orientation;

	    var ret = {
	        width : img.width,
	        height: img.height
	    };

	    if ("5678".indexOf(orientation) > -1) {
	        ret.width  = img.height;
	        ret.height = img.width;
	    }

	    // 如果原图小于设定，采用原图
	    if (ret.width < width || ret.height < height) {
	        return ret;
	    }

	    var scale = ret.width / ret.height;

	    if (width && height) {
	        if (scale >= width / height) {
	            if (ret.width > width) {
	                ret.width  = width;
	                ret.height = Math.ceil(width / scale);
	            }
	        } else {
	            if (ret.height > height) {
	                ret.height = height;
	                ret.width  = Math.ceil(height * scale);
	            }
	        }
	    }
	    else if (width) {
	        if (width < ret.width) {
	            ret.width  = width;
	            ret.height = Math.ceil(width / scale);
	        }
	    }
	    else if (height) {
	        if (height < ret.height) {
	            ret.width  = Math.ceil(height * scale);
	            ret.height = height;
	        }
	    }

	    // 超过这个值base64无法生成，在IOS上
	    while (ret.width >= 3264 || ret.height >= 2448) {
	        ret.width *= 0.8;
	        ret.height *= 0.8;
	    }

	    return ret;
	};

	/**
	 * 获取当前js文件所在路径，必须得在代码顶部执行此函数
	 * @returns {string}
	 */
	function getJsDir (src) {
	    var script = null;

	    if (src) {
	        script = [].filter.call(document.scripts, function (v) {
	            return v.src.indexOf(src) !== -1;
	        })[0];
	    } else {
	        script = document.scripts[document.scripts.length - 1];
	    }

	    if (!script) return null;

	    return script.src.substr(0, script.src.lastIndexOf('/'));
	}


	/**
	 * 转换成formdata
	 * @param dataURI
	 * @returns {*}
	 *
	 * @source http://stackoverflow.com/questions/4998908/convert-data-uri-to-file-then-append-to-formdata
	 */
	function dataURItoBlob (dataURI) {
	    // convert base64/URLEncoded data component to raw binary data held in a string
	    var byteString;
	    if (dataURI.split(',')[0].indexOf('base64') >= 0)
	        byteString = atob(dataURI.split(',')[1]);
	    else
	        byteString = unescape(dataURI.split(',')[1]);

	    // separate out the mime component
	    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

	    // write the bytes of the string to a typed array
	    var ia = new Uint8Array(byteString.length);
	    for (var i = 0; i < byteString.length; i++) {
	        ia[i] = byteString.charCodeAt(i);
	    }

	    return new BlobFormDataShim.Blob([ia.buffer], {type: mimeString});
	}

	window.lrz = function (file, opts) {
	    return new Lrz(file, opts);
	};

	// 版本号来自package.json，构建时自动填充
	window.lrz.version = '__packageJSON.version__';

	module.exports = window.lrz;

	/**
	 *
	 * 　　　┏┓　　　┏┓
	 * 　　┏┛┻━━━┛┻┓
	 * 　　┃　　　　　　　┃
	 * 　　┃　　　━　　　┃
	 * 　　┃　┳┛　┗┳　┃
	 * 　　┃　　　　　　　┃
	 * 　　┃　　　┻　　　┃
	 * 　　┃　　　　　　　┃
	 * 　　┗━┓　　　┏━┛Code is far away from bug with the animal protecting
	 * 　　　　┃　　　┃    神兽保佑,代码无bug
	 * 　　　　┃　　　┃
	 * 　　　　┃　　　┗━━━┓
	 * 　　　　┃　　　　　 ┣┓
	 * 　　　　┃　　　　 ┏┛
	 * 　　　　┗┓┓┏━┳┓┏┛
	 * 　　　　　┃┫┫　┃┫┫
	 * 　　　　　┗┻┛　┗┻┛
	 *
	 */




/***/ }
/******/ ])
});
;
$(document).on("pageInit", "#main", function(e, pageId, $page) {
	init_auto_load_data();
	/*首页广告图轮播*/
	var mySwiper = new Swiper('.j-index-banner', {
	    speed: 400,
	    spaceBetween: 0,
	    pagination: '.swiper-pagination',
     	autoplay: 2500
	});
	/*商家设置头部列表*/
	var mySwiper = new Swiper('.j-sort_nav', {
	    speed: 400,
	    spaceBetween: 0,
	    pagination: '.sort-pagination'
	});
	var mySwiper = new Swiper('.j-index-lb', {
	    speed: 400,
	    spaceBetween: 0
	});
/*地址定位
if($.fn.cookie("cancel_geo")!=1)
	{
		if(navigator.geolocation)
		{
			 var geolocationOptions={timeout:10000,enableHighAccuracy:true,maximumAge:5000};
			 navigator.geolocation.getCurrentPosition(getPositionSuccess, getPositionError, geolocationOptions);
		}
	}
	*/
if($.fn.cookie("cancel_geo")!=1){
	position();
}
});



$(document).on("pageInit", "#nodata", function(e, pageId, $page) {

    if (typeof suijump === 'function') {
        suijump();
    }
});
$(document).on("pageInit", "#notice_index", function(e, pageId, $page) {

init_list_scroll_bottom();
});



/**
 * Created by Administrator on 2016/11/14.
 */

$(document).on("pageInit", "#uc_order", function(e, pageId, $page) {

    var _width=$(".buttons-tab .tab-link.active").find("span").width();
    var _left=$(".buttons-tab .tab-link.active").find("span").offset().left;

    var btm_line=$(".buttons-tab .bottom_line");
    btm_line.css({"width":_width+"px","left":_left+"px"});

    var _tabs=$(".tabBox .tab_box");
	var tab_link=new Array();
	tab_link[0] = true;
	tab_link[1] = true;
	tab_link[2] = true;
	tab_link[3] = true;
	tab_link[4] = true;
    $(".buttons-tab .tab-link").click(function () {
        $(document).off('infinite', '.infinite-scroll-bottom');
    	$(".content").scrollTop(1);
        var _wid=$(this).find("span").width();
        var _lef=$(this).find("span").offset().left;
        btm_line.css({"width":_wid+"px","left":_lef+"px"});
        var _index=$(this).index();
        //加载内容
        if($.trim($(".j_ajaxlist_"+_index).html())==""&&tab_link[_index]){
			tab_link[_index]=false;
            var ajax_url =url[_index];
            $.ajax({
                url:ajax_url,
                type:"POST",
                success:function(html)
                {
                    //alert($(html).find(".j_ajaxlist_"+_index).html());
                    $(".j_ajaxlist_"+_index).append($(html).find(".j_ajaxlist_"+_index).html());
                    manageOrder();

                    //$(ajaxlist).find(".pages").html($(html).find(ajaxlist).find(".pages").html());
                    //init_listscroll(".j_ajaxlist_"+_index,".j_ajaxadd_"+_index,"",manageOrder);
                	if($(".content").scrollTop()>0){
                		init_listscroll(".j_ajaxlist_"+_index,".j_ajaxadd_"+_index,"",manageOrder);
                	}
                },
                error:function()
                {
                    $(".j_ajaxlist_"+_index).find(".page-load span").removeClass("loading").addClass("loaded").html("网络被风吹走啦~");
                }
            });
        }else{
        	if($(".content").scrollTop()>0){
                infinite(".j_ajaxlist_"+_index,".j_ajaxadd_"+_index,"",manageOrder);
        	}
        }
        $(this).addClass("active").siblings(".tab-link").removeClass("active");
        _tabs.eq(_index).addClass("active").siblings(".tab_box").removeClass("active");

        var swiperBox=_tabs.eq(_index).find(".j-order-lamp");


        var swiper = new Swiper(swiperBox, {
            scrollbarHide: true,
            slidesPerView: 'auto',
            centeredSlides: false,
            observer:true,
            grabCursor: true
        });
    });
    function manageOrder(){
        $(".manage-order").unbind("click").bind("click",function(){
              var message=$(this).attr("message");
              var url=$(this).attr("ajaxUrl");
             $.confirm(message, function () {
                 $.showIndicator();
                 $.ajax({
                     url:url,
                     dataType:"json",
                     success:function(data){
                         if(data.status==0){
                             $.toast(data.info);
                         }else{
//                             $.alert(data.info,function(){
//                                 window.location.href=data.jump;
//                             })
                        	 $.toast(data.info);
                        	 window.setTimeout(function(){
                        		 window.location.href=data.jump;
         					},1500);
                         }
                     }
                 });
             });
        });
    }
    var swiperm = new Swiper(".j-order-lamp1", {
        scrollbarHide: true,
        slidesPerView: 'auto',
        centeredSlides: false,
        observer:true,
        grabCursor: true
    });
    init_listscroll(".j_ajaxlist_"+pay_status,".j_ajaxadd_"+pay_status,"",manageOrder);
    manageOrder();

    
});
/**
 * Created by Administrator on 2016/11/16.
 */
$(document).on("pageInit", "#uc_order_dp", function(e, pageId, $page) {
   $(".j-stars .iconfont").click(function () {
       var _index=$(this).index();
       var val=parseInt(_index)+1;
       $(this).parent().parent().find(".star").val(val);
       var $icon=$(this).parent().find(".iconfont");
        $icon.each(function (i) {
           if(i<=_index){
               $icon.eq(i).addClass("active");
           }else {
               $icon.eq(i).removeClass("active");
           }
        });

   });
   
   $(".send_dp").click(function(){
	   $("form[name='dp_submit_form']").unbind("submit");
	   do_dp_form();
	});
   function do_dp_form()
   {
		$("form[name='dp_submit_form']").bind("submit",function(){
			
			var evaluate=$(this).find(".evaluate li");
			
			for(var i=0;i<evaluate.length;i++){
				if(evaluate.eq(i).find(".dp_centent").val()==""){
					$.toast("请填写评价内容");
					return false;
				}else if(evaluate.eq(i).find(".star").val()==""){
					$.toast("请选择评分");
					return false;
				}
			}
			
			/*var i=0;
			$(this).find(".dp_centent").each(function(){
				if($.trim($(this).val())==""){
					$.toast("请填写评价内容");
					return;
				}
				i++;
			});
			$(this).off;
			var k=0;
			$(this).find(".star").each(function(){
				if($.trim($(this).val())==""){
					$.toast("请选择评分");
					return;
				}
				k++;
			});*/
			
//			if(i>=$(this).find(".dp_centent").length  && k>=$(this).find(".star").length){
				var url = $(this).attr("action");
				var query = $(this).serialize();
				$.ajax({
					url:url,
					data:query,
					dataType:"json",
					type:"POST",
					success:function(obj){
						$.toast(obj.info);
						$("form[name='dp_submit_form']").unbind("submit");
						if(obj.jump){
							setTimeout(function(){
								location.href = obj.jump;
							},1000);
						}
					}
				});
//			}

			return false;
		});
	}
});
$(document).on("pageInit", "#order_view", function(e, pageId, $page) {
    select_box($(".j-open-service"),$(".m-service-box"));
    $(".invoice-bar").click(function(){
        $(this).toggleClass("active");
    });
    var t1= parseInt($(".j-data-time").attr('data-time'));
    
	var leftGRObj = setInterval(GetRTime,1000);
    function GetRTime(){
      var t= $(".j-data-time").attr('data-time');
      var is_load = $(".j-data-time").attr('is_load');
      if(is_load==1){
          var d=0;
          var h=0;
          var m=0;
          var s=0;

    	    d=Math.floor(t/60/60/24);
    	    h=Math.floor(t/60/60%24);
    	    m=Math.floor(t/60%60);
    	    s=Math.floor(t%60);
    	    if (d>0) {
    	        $(".j-data-time .j-time").html(d + "天" + h +"小时" + m +"分钟" + s +"秒");
    	    } else {
    	        $(".j-data-time .j-time").html(h +"小时" + m +"分钟" + s +"秒");
    	    }
    	    if (h<1) {
    	        $(".j-data-time .j-time").html(m +"分钟" + s +"秒");
    	    }
    	    
    	    if (m<1) {
    	        $(".j-data-time .j-time").html(s +"秒");
    	    }

    	    if(t==0){

    	    	$(".j-data-time .j-time").html("0秒");
    	    	$(".pay_btn").addClass('no_pay_btn').removeClass('pay_btn').attr('error_tip','支付超时').attr('href','javascript:void(0)'); 	
    	    	clearInterval(leftGRObj);
    	    	$.loadPage(location.href);
    	    	
    	    }
    	    t = t -1;
    	    $(".j-data-time").attr('data-time',t);
      }else{
    	  $(".j-data-time .j-time").html("0秒");
    	  clearInterval(leftGRObj);
      }
  
    }

    $(".cancel_order").unbind("click").bind("click",function(){
        var message=$(this).attr("message");
        var url=$(this).attr("ajaxUrl");
		var button_type=$(this).attr("button-type");
        $.confirm(message, function () {
            $.showIndicator();
            $.ajax({
                url:url,
                dataType:"json",
                success:function(data){
                    if(data.status==0){
                        $.toast(data.info);
                    }else{
//                        $.alert(data.info,function(){
//                            window.location.href=data.jump;
//                        })
                    	$.toast(data.info);
                   	 	window.setTimeout(function(){
							if(button_type=="j-cancel"){
								window.location.href=location.href;
							}else{
								window.location.href=data.jump;
							}
    					},1500);
                    }
                }
            });
        });
    });
    
	$('.xnOpenSdk').bind('click', function() {
		if (app_index != 'app') {
			return;
		}
		if(is_login==0){
			App.login_sdk();
			return false;
		}
		var xnOptionsObj = {
			goods_id:'',
			goods_showURL:'',
			goodsTitle: '',
			goodsPrice: '',
			goods_URL: '',
			settingid: settingid,
			appGoods_type: '0',
		};
		xnOptions = JSON.stringify(xnOptionsObj);
		try {
			App.xnOpenSdk(xnOptions);
		} catch (e) {
			$.toast(e);
		}
	})

});
/**
 * Created by Administrator on 2016/9/7.
 */

$(document).on("pageInit", "#pay", function(e, pageId, $page) {
	count_order_total();
	function count_order_total_change(){
		$("input[name='all_account_money']").unbind('change');
		$("input[name='all_account_money']").bind("change",function () {


			if($("#all_account_money").hasClass("active")){
				$("#all_account_money").removeClass("active");
			}else{
				$("#all_account_money").addClass("active");
			}
			$("input[name='payment']").prop("checked",false);
			count_order_total();

		});

		$(".payment").unbind("click");
		$(".payment").bind("click",function(){
			$("input[name='payment']").prop("checked",false);
			$(this).siblings("input[name='payment']").prop("checked",true);
			$("#all_account_money").removeClass("active");
			count_order_total();
		});
		$(".j_pay_button").unbind("click");
		$(".j_pay_button").bind("click",function(){

			submit_order($(this));

		});
	}
	function count_order_total()
	{
		var is_ajax = 1;
		var query = new Object();

		//全额支付
		if($("#all_account_money").hasClass("active"))
		{
			query.all_account_money = 1;
		}
		else
		{
			query.all_account_money = 0;
		}

		//支付方式
		var payment = $("input[name='payment']:checked").val();
		if(!payment)
		{
			payment = 0;
		}
		var rel=$("input[name='payment']:checked").attr("rel");
		query.payment = payment;
		query.rel = rel;
		query.id = order_id;
		query.is_ajax = is_ajax;
		query.act = "pay";
		$.ajax({
			url: CART_URL,
			data:query,
			type: "POST",
			dataType: "json",
			success: function(data){
				$(".content").html(data.html);
				count_order_total_change();
			},
			error:function(ajaxobj)
			{
//    			if(ajaxobj.responseText!='')
//    			alert(LANG['REFRESH_TOO_FAST']);
			}
		});
	}
	function submit_order(obj)
	{
		
		$(obj).removeClass('j_pay_button');
		var is_ajax = 1;
		var query = new Object();

		//全额支付
		if($("#all_account_money").hasClass("active"))
		{
			query.all_account_money = 1;
		}
		else
		{
			query.all_account_money = 0;
		}

		//支付方式
		var payment = $("input[name='payment']:checked").val();
		if(!payment)
		{
			payment = 0;
		}
		var rel=$("input[name='payment']:checked").attr("rel");
		query.payment = payment;
		query.rel = rel;
		query.id = order_id;
		query.is_ajax = is_ajax;
		query.act = "order_done";
		$.ajax({
			url: CART_URL,
			data:query,
			type: "POST",
			dataType: "json",
			success: function(data){
				if(data.status==1){

					if(data.app_index=='wap' ){  //SKD支付做好后，用 App.pay_sdk支付
						if(data.pay_status==1){
							$.router.load(data.jump, true);
						}else{
							location.href=data.jump;
						}
					} else if( data.app_index=='app' && data.pay_status==1){  //APP余额支付
						 $.router.load(data.jump, true);

					} else if( data.app_index=='app' && data.pay_status==0){  //APP第三方支付
						if(data.online_pay==3){
							try {
								var str = pay_sdk_json(data.sdk_code);
								App.pay_sdk(str);
								$(obj).addClass('j_pay_button');
							} catch (ex) {

								$.toast(ex);
								$.loadPage(location.href);
							}
						}else if(data.online_pay==2){
							var pay_json = '{"open_url_type":"1","url":"'+data.jump+'","title":"'+data.title+'"}';

							try {
								App.open_type(pay_json);
								$.confirm('已支付完成？', function () {
									$.loadPage(location.href);

								},function(){
									$.loadPage(location.href);

								});
							} catch (ex) {
								$.toast(ex);
								$.loadPage(location.href);
							}
						}
					}



				}else if(data.status==0){
					$.alert(data.info);
					$(obj).addClass('j_pay_button');
				}else{
					$(obj).addClass('j_pay_button');
				}

			},
			error:function(ajaxobj)
			{
				$(obj).addClass('j_pay_button');

			}
		});
	}
	

	
});


/**
 * Created by Administrator on 2016/10/11.
 */
$(document).on("pageInit", "#payment_done", function(e, pageId, $page) {
	loadScript(jia_url);
	
    var lent=$(".order-replay").length;
    if (lent>3){
        $(".loadMore").show();
    }else if(lent<=3){
        $(".loadMore").hide();
    }



    var _click=0;
    $(".loadMore").click(function () {
        _click++;
        if(_click==1){
            $(".down_btn").show();
            $(".up_btn").hide();
            $(".j-moreThan").show();
        }
        if(_click==2){
            $(".down_btn").hide();
            $(".up_btn").show();
            $(".j-moreThan").hide();
        }
        if(_click>=2){
            _click=0;
        }

    });



    $(".j-showCode").click(function () {
        $(".codeShowBox").addClass("codeShow");
        $(".codeImgBox").removeClass("transi").addClass("trans");
        var $this=$(this);
        var codeNum=$this.parents(".order-replay").find(".j-codeNum").text();
        var codeSrc=$this.parents(".order-replay").find(".hiddenBox").attr("data-src");
        $(".codeShowBox .codeName").text(codeNum);
        $(".codeShowBox .codeImg").attr("src",codeSrc);
    });

    $(".blackBox").click(function () {
        $(".codeImgBox").removeClass("trans").addClass("transi");
        setTimeout(function () {
            $(".codeShowBox").removeClass("codeShow");
        },150);
    });
});

/**
 * 
 */
$(document).on("pageInit", "#payment_done", function(e, pageId, $page){
	$(".deal-share").click(function(){
		var url_data=$(this).attr("url");
		var that = this;
		if($("#share").is(':checked')){
			var query = new Object();
			query.act="order_shere";
			query.id = id;
			query.url_data
				$.ajax({
					url:AJAX_URL,
					data:query,
					dataType:"json",
					type:"post",
					global:false,
					success:function(obj){
						if(obj.status){
							if (app_index == 'app') {

							//	var pay_json = '{"id":"830","url":"'+data.jump+'","title":"'+data.title+'"}';
								App.app_detail(type,json_parma);
							} else {

								$.router.load(url_data, true);
							}
						}else{
							$.toast(obj.info);
						}
					}
				});
		}else{

		 	if (app_index == 'app') {
	

		 		if(type > 0){

		 			//App.app_detail(type,json_parma);
		 		}else{
		 			$.router.load(url_data, true);
		 		}
		 	} else {

				$.router.load(url_data, true);
		 	}
		}
	});
});
$(document).on("pageInit", "#presell_detail", function(e, pageId, $page) {
	//流程
	select_box($(".j-progress"),$(".j-progress-box"));
	//二维码
	select_box($(".j-open-qrcode"),$(".m-qrcode-box"));
	//购买须知
	select_box($(".j-open-rule"),$(".j-rule-box"));
	//预售倒计时

	leftGRXTime();
	
	var leftGRXObj = setInterval(leftGRXTime,1000);
	function leftGRXTime(){
		  var t =$(".presell-time .j-time").attr('data-time');
		  var d=0;
		  var h=0;
		  var m=0;
		  var s=0;

		    d=Math.floor(t/60/60/24);
		    if (Math.floor(t/60/60%24)<10) {
			    h='0'+Math.floor(t/60/60%24);
		    } else {
		    	h=Math.floor(t/60/60%24);
		    }
		    if (Math.floor(t/60%60)<10) {
			    m='0'+Math.floor(t/60%60);
		    } else {
		    	m=Math.floor(t/60%60);
		    }
		    if (Math.floor(t%60)<10) {
			    s='0'+Math.floor(t%60);
		    } else {
		    	s=Math.floor(t%60);
		    }

			  $(".presell-time .j-day").html(d + "天");
			  $(".presell-time .j-hour").html(h);
			  $(".presell-time .j-min").html(m);
			  $(".presell-time .j-sec").html(s);
			  t = t - 1;
			  $(".presell-time .j-time").attr('data-time',t);	
			  if(t<0){
				  $.loadPage(location.href);
			  }
	

	
	  
	}



	loadScript(jia_url);
	$(".j-activeopen").attr("style","");
	$('.content').scrollTop(0);
	//获得默认库存
	var defaultStock=$(".spec-goodstock").text();
	//收藏


	/*轮播初始化*/
	var mySwiper = new Swiper ('.j-deal-content-banner', {

		autoplay: 3000,/*设置3秒自动播放*/
		spaceBetween: 10,/*图间间隔10px*/
		onSlideChangeStart: function(swiper){/*回调函数：开始变化*/
			slideIndex();
		}
	});


	/*
	 *初始化轮播分页器
	*/
	slideIndex();


	/*
	 *初始化商家标签区是否显示更多图标
	*/
	setFuliIcon();


	/*
	 *显示更多商家标签与商家优惠
	 *用户点击显示区域，下拉显示更多信息，再次点击收起更多信息
	 *区域标识，用于区分商家标签与商家优惠  1：商家优惠   2：商家标签
	*/
	$(".j-activeopen").click(function(){
		var rel = $(this).attr("rel");//区域标识

		if(rel == 1){
			var childlengh = $(this).children("li").length;
		}else if (rel == 2) {
			var allliwidth = 0;
			$(this).children("li").each(function(){
				allliwidth += (parseInt($(this).width()) + parseInt($(this).css("margin-right").replace("px","")));
			});

			var ulwidth = $(this).width();
			var childlengh = Math.ceil(allliwidth / ulwidth);
		}

		var thisheight = $(this).height();
		var childheight = $(this).children("li").height();
		var childmargin = parseInt($(this).children("li").css("margin-top").replace("px",""));
		if(childlengh > 1){
			if($(this).hasClass("isClick")){
				$(this).removeClass("isClick");
				$(this).height(childheight + childmargin * 2);
			}else{
				$(this).addClass("isClick");
				$(this).height((childheight * childlengh)  + (childmargin * (childlengh + 1)));
			}
		}
	});


	/*
	 *显示当前商家更多团购信息
	 *用户点击显示区域，下拉显示更多信息，再次点击收起更多信息
	*/

	$(".j-tuan-showMore").click(function(){
		var childheight = $(this).parent().children(".tuan-list").children("li").height();  //子项高度，用于计算更多高度
		var childlengh = $(this).parent().children(".tuan-list").children("li").length;     //子项个数，用于计算更多高度

		if (childlengh > 1) {
			if($(this).hasClass("isClick")){
				$("#other").html($("#other").attr("content"));
				$(this).removeClass("isClick");
				$(this).parent().children(".tuan-list").height(childheight);
			}else{
				$("#other").html("收起");
				$(this).addClass("isClick");
				$(this).parent().children(".tuan-list").height(childheight * childlengh);
			}
		}
	});

	/*
	 *tab切换时下划线跟随
	*/
	var t_height=$(".m-head-nav").height();
	var s_height=$(".deal-detail").offset().top;
	$(".j-tab-link").click(function(){
        var $me=$(this);
		var type = $(this).parent(".tab-list").attr("data-type");
		var rel = parseInt($(this).attr("rel"));
		if(rel == 0){
			$(".content").scrollTop(0);
            tab_lick_callback($me,type,rel);
        }
        else if (rel == 1) {
			$(".content").scrollTop(s_height-t_height);
            tab_lick_callback($me,type,rel);
        }
        else{
            tab_lick_callback($me,type,rel);
        }
        if ($me.hasClass("active")) {
			var ac_left = $(".j-tab-link.active").offset().left;
			$('.m-head-nav .tab-line').css("left",ac_left);
        }
	});
	var ac_left = $(".j-tab-link.active").offset().left;
	var ac_width = $(".j-tab-link.active").width();
	$('.m-head-nav .tab-line').css({"left":ac_left,"width":ac_width});
    /**
     * 异步加载点评列表
     */
    function ajax_load_tab3(){
        $.post(get_dp_detail_url,"",function(data){
           var $html=$(data);
           if($html.length){
               $("#tab3").html($html.find("#tab3").html());
               $("#dp_list_click").html($html.find("#dp_list_click").html());
           }
        });
    }
    ajax_load_tab3();

    function tab_lick_callback($me,type,rel){
        $(".j-tab-link").removeClass("active");
        $me.addClass("active");
        setTablineLeft($me.parent(),type,rel);
    }

	$(".j-detail").live("click",function(){
		var index = $(this).attr("data");
		var type = $(this).attr("data-type");
		$(".native-scroll").scrollTop(0);
		setTablineLeft($(".tab-list"),type,index);
		$(".tab-link").eq(index).addClass("active");
	});
    /**
     * 加载推荐列表
     */
    function load_recomend_data(){
        $.get(get_recommend_data_url,"",function(data){
            var html=$(data).html();
            if(html){
                $("#recommend_data").html(html);
            }
        });
    }
    load_recomend_data();
	/*倒计时*/
	leftTimeAct();
	
	var leftTimeObj = setInterval(leftTimeAct,1000);
	function leftTimeAct(){
		var leftTime = parseInt($(".AdvLeftTime").attr("data"));
		
		if(leftTime > 0)
		{
			var day  = parseInt(leftTime / 24 /3600);
			var hour = parseInt((leftTime % (24 *3600)) / 3600);
			var min  = parseInt((leftTime % 3600) / 60);
			var sec  = parseInt((leftTime % 3600) % 60);
			if(day<10){
				day="0"+day;
			}
			if(hour<10){
				hour="0"+hour;
			}
			if(min<10){
				min="0"+min;
			}
			if(sec<10){
				sec="0"+sec;
			}
			$(".AdvLeftTime").find(".day").html(day);
			$(".AdvLeftTime").find(".hour").html(hour);
			$(".AdvLeftTime").find(".min").html(min);
			$(".AdvLeftTime").find(".sec").html(sec);
			leftTime--;
			$(".AdvLeftTime").attr("data",leftTime);
		}
		else{
			$(".AdvLeftTime").html('团购已结束');
			
			clearInterval(leftTimeObj);
		}
	}


	/*
	 *底部加入购物车按钮
	*/
	//$(".j-addcart").click(function(){
	//	$(".j-flippedout-close").attr("rel","spec");
	//	$(".j-spec-choose-close").attr("rel","spec");
	//	$(".flippedout-spec").addClass("showflipped").addClass("z-open");
	//	$(".spec-choose").addClass("z-open");
	//	$(".spec-btn-list").addClass("isAddCart");
	//	$(".totop").addClass("vhide");//隐藏回到头部按钮
	//});

	init_addcart();
	/*
	 *底部立即购买按钮
	 *如未在规格选择按钮选择完所有属性，将规格选择窗口关闭，再次点击购买按钮则会再次弹出规格选择窗口
	 *如果在规格选择窗口选择完所有属性，则进行购买操作，不再弹出规格选择窗口
	 */
	$(".j-nowbuy").click(function(){
		if(is_login==0){
			if(app_index=="app"){
				App.login_sdk();
			}else{
				$.router.load(login_url, true);
			}
			return false;
		}
		if(deal_attr_stock_json.length==0){
			now_buy=1;
			$("#goods-form").submit();
			return false;
		}else{
			var data_num = $(".choose-list").length;//获取属性个数
			//  未选择完商品属性，执行弹出规格选择窗口
			$(".j-flippedout-close").attr("rel","spec");
			$(".j-spec-choose-close").attr("rel","spec");
			$(".flippedout-spec").addClass("showflipped").addClass("z-open");
			$(".spec-choose").addClass("z-open");
			$(".totop").addClass("vhide");//隐藏回到头部按钮
		}

	});
	$(".nowbuy").click(function(){
		var data_num = $(".choose-list").length;//获取属性个数
		//var choose_num = $(".good-specifications span em").length; //获取已选属性个数
		var choose_num = $(".flippedout-spec .spec-goodspec em.choose_item").length; //获取已选属性个数
		if (choose_num < data_num) {
			//  未选择完商品属性，执行弹出规格选择窗口
			$.toast("请选择商品规格");
		}else{
			// 已经选择完商品属性，执行购买操作
			now_buy=1;
			$("#goods-form").submit();
		}
	});
	$(".isOk,a.joincart").click(function(){
		var data_num = $(".choose-list").length;//获取属性个数
		//var choose_num = $(".good-specifications span em").length; //获取已选属性个数
		var choose_num = $(".flippedout-spec .spec-goodspec em.choose_item").length; //获取已选属性个数
		if (choose_num < data_num) {
			//  未选择完商品属性，执行弹出规格选择窗口
			$.toast("请选择商品规格");
		}else{
			// 已经选择完商品属性，执行购买操作
			$("input[name='type']").val("1");
			now_buy=0;
			$("#goods-form").submit();
		}
	});

	/*
	 *规格选择窗口 加减按钮事件
	 */
	$(".flippedout-spec").on('click',".j-add-miuns",function(){
		fun_add_miuns($(this));

		var max=parseInt($(this).attr("max-num"));
		//alert($(".numplusminus").val());
		if(max>=0 && parseInt($(".numplusminus").val())>=max){
			$(this).attr("class","numadd add-miuns j-add-miuns j-add isUse");
			$(".numplusminus").val(max);
		}else{
			setSpecgood();
		}
	});
	$(".choose-list .j-choose").click(function(){
		if($(this).hasClass("active")){ //点击已选择属性，则取消选择
			$(this).removeClass("active");
			$(this).parent().siblings(".spec-tit").addClass("unchoose");
			setSpecgood();
		}else if(!$(this).hasClass("isOver")){
			//判断是否是无库存属性，
			//如果不是无库存则正常选择，无库存属性不做任何操作
			$(this).siblings(".j-choose").removeClass("active");
			$(this).addClass("active");
			$(this).parent().siblings(".spec-tit").removeClass("unchoose");
			setSpecgood();
		}
		var data_value= $(".j-choose.active").attr("data-value");
		var data_id= $(this).attr("data-id");
		$(this).parent().siblings("input.spec-data").val(data_id);
		var data_value = []; // 定义一个空数组
		var txt = $('.j-choose.active'); // 获取所有文本框
		for (var i = 0; i < txt.length; i++) {
			data_value.push(txt.eq(i).attr("data-value")); // 将文本框的值添加到数组中
		}

		if (txt.length == 0) {//非初始化状态时，未选择属性页面操作区内容同步规格选择窗口内容
			$(".good-specifications span").empty();
			$(".good-specifications span").removeClass("isChoose");
			$(".good-specifications span").html($(".spec-goodspec").html());
		}else{//将已选择属性显示在页面操作区
			$(".good-specifications span").empty();
			$(".good-specifications span").addClass("isChoose");
			$(".good-specifications span").append("<i class='gray'>已选规格：</i>");
			$.each(data_value,function(i){
				$(".good-specifications span").append("<em class='tochooseda'>" + data_value[i] + "</em>");
				//传值可以考虑更改这里
				//$(".spec-data").attr("data-id-str"+[i],data_value[i]);
			});
		}
	});





	setSpecgood();
	function setSpecgood() {
		if($(".unchoose").length != 0){
			$(".spec-goodspec").empty();
			$(".spec-goodspec").append("请选择");
			$(".spec-goodstock").text(defaultStock);
			$(".spec-goodprice").text("￥"+deal_price.toFixed(2));
			$("input[name='max_bought']").val("0");
			$(".spec-btn-list").removeClass("isNo");
			$(".spec-btn-list div.noStock").text("确定");
			$(".unchoose").each(function(){
				// 选择<em></em>
				$(".spec-goodspec").append("<em>&nbsp;&nbsp;" + $(this).html() + "</em>");
			});
		}else{
			$(".spec-goodspec").empty();
			$(".spec-goodspec").append("已选择");
			$(".j-choose.active").each(function(){
				$(".spec-goodspec").append("<em class='choose_item'>&nbsp;&nbsp;" + $(this).attr("data-value") + "</em>");
			});
			//开始计算属性库存
			//var pirce=parseFloat(deal_price);
			//$(".choose-list .active").each(function(){
			//	pirce+=parseFloat($(this).attr("pirce"));
			//	$(".spec-goodprice").text("￥"+pirce.toFixed(2));
			//});

			if($(".choose-list").length!=0)
			init_buy_ui();//检测库存
			init_submit_btn_status();
		}
	}

	//库存检测-更新面板-改变按钮状态
	function init_buy_ui(){
			var is_stock = true;      //库存是否满足
			var stock = deal_stock;   //无规格时的库存数
			var deal_show_price = deal_price;
			var deal_show_buy_count = deal_buy_count;
			var deal_remain_stock = -1;  //剩余库存 -1:无限

			var attr_checked_ids = []; // 定义一个空数组
			var txt = $('.j-choose.active'); // 获取所有选中对象
			for (var i = 0; i < txt.length; i++) {
				attr_checked_ids.push($('.j-choose.active').eq(i).attr("data-id")); // 将文本框的值添加到数组中
			}
			var attr_checked_ids = attr_checked_ids.sort(); //排序
			var attr_checked_ids_str = attr_checked_ids.join("_");//转字符串 _ 分割
			var attr_spec_stock_cfg = deal_attr_stock_json[attr_checked_ids_str];
			console.log(deal_price);
			console.log(attr_spec_stock_cfg);
			if(attr_spec_stock_cfg)
			{
				deal_show_buy_count = attr_spec_stock_cfg['buy_count'];
				stock = attr_spec_stock_cfg['stock_cfg'];
				$(".spec-goodprice").text("￥"+(parseFloat(deal_price)+parseFloat(attr_spec_stock_cfg['price'])).toFixed(2));
				//$(".spec-goodprice").text("￥"+parseFloat(attr_spec_stock_cfg['presell_deposit_money']).toFixed(2));
			}
			else
			{//单个属性库存
				var has_stock_attr = false;
				for(var k=0;k<attr_checked_ids.length;k++)
				{
					var key = attr_checked_ids[k];
					attr_spec_stock_cfg = deal_attr_stock_json[key];
					if(attr_spec_stock_cfg)
					{
						stock = attr_spec_stock_cfg['stock_cfg'];
						has_stock_attr = true;
						break;
					}
				}
				if(!has_stock_attr)
				stock = -1;
			}
			//判断库存是否大于0
			//更新库存显示
			//判断库存，并更新数量显示
			//判断库存是否小于最小购买量，表示库存不足
			if(stock>0){
				$(".spec-goodstock").text("库存:"+stock+"件");
				$(".j-add-miuns").attr("max-num",stock);
				var num=parseInt($(".numplusminus").val());
				//alert(num);
				if(num>stock){
					$(".numplusminus").val(stock);
				}else if(num==0){
					$(".numplusminus").val(1);
				}
			}else{
				if(stock==-1){
					$(".spec-goodstock").text("库存:不限");
					$(".j-add-miuns").attr("max-num",100);
				}
				else{
					$(".spec-goodstock").text("库存:0 件");
					$(".j-add-miuns").attr("max-num",0);
					$(".numplusminus").val(0);
				}
			}
			$("input[name='max_bought']").val(stock);


	}
	//初始化购物车等相关提交按钮状态
	function init_submit_btn_status(){

			var is_stock=true;
			var deal_remain_stock=parseInt($("input[name='max_bought']").val());
			var buy_num=parseInt($("input[name='num']").val());
			var str='';
			if(deal_remain_stock>=0)
			{
                   if(buy_num>deal_remain_stock)
				{
					is_stock = false;
					str="库存不足";
				}
				else if(deal_user_max_bought>0&&buy_num>deal_user_max_bought)
				{
					is_stock = false;
					str="每单最多购买"+deal_user_max_bought+"份";
				}
			}
			else
			{
                   if(deal_user_max_bought>0&&buy_num>deal_user_max_bought)
				{
					is_stock = false;
					str="每单最多购买"+deal_user_max_bought+"份";
				}
			}
			//alert(11);
			if(is_stock){
				$(".spec-btn-list").removeClass("isNo");
			}else{
				$(".spec-btn-list").addClass("isNo");
				$(".spec-btn-list div.noStock").text(str);
			}

	}


	/*
	 *底部收藏按钮
	 *如果已经收藏则执行以下操作，否则本阶段不执行操作
	 */
	 $(".j-collection").click(function(){
		var is_del = $(this).attr("data-isdel");
		if(is_del == 1){
			//打开取消框
			$(".flippedout").addClass("z-open");
			$(".flippedout").addClass("showflipped");
			$(".cancel-shoucan").addClass("z-open");
		}else{
			if(is_login==0){
				if(app_index=="app"){
					App.login_sdk();
				}else{
					$.router.load(login_url, true);
				}
			}else{
				deal_add_collect(deal_id);
			}
		}
	});

	$(".j-head-collect").on("click",function(){
		var is_del = $(this).attr("data-isdel");
		$(".cancel-shoucan").attr("data-ishead",1);
		if(is_del == 1){
		 	//打开取消框
			$(".cancel-shoucan").addClass("z-open");
		}else{
			if(is_login==0){
				if(app_index=="app"){
					App.login_sdk();
				}else{
					$.router.load(login_url, true);
				}
			}else{
				deal_add_collect(deal_id);
			}
		}
	});

	/*
	 *取消收藏按钮弹出后的取消
	*/

	$(".cancel-shoucan .j-cancel").click(function(){
		var is_head = $(".cancel-shoucan").attr("data-ishead");
		if(is_head != 1){
			$(".flippedout").removeClass("z-open");
			$(".flippedout").removeClass("showflipped");
			$(".cancel-shoucan").removeClass("z-open");
		}else{
			$(".cancel-shoucan").removeClass("z-open");
			$(".cancel-shoucan").attr("data-ishead",0);
		}
	});

	/*
	 *取消收藏按钮弹出后的确认
	*/

	$(".cancel-shoucan .j-yes").click(function(){
		var is_head = $(".cancel-shoucan").attr("data-ishead");
		deal_del_collect(deal_id);
		if(is_head != 1){
			$(".flippedout").removeClass("z-open");
			$(".flippedout").removeClass("showflipped");
			$(".cancel-shoucan").removeClass("z-open");
		}else{
			$(".cancel-shoucan").removeClass("z-open");
			$(".cancel-shoucan").attr("data-ishead",0);
			$(".flippedout").removeClass("showflipped").removeClass("dropdowm-open");
			$(".m-nav-dropdown").removeClass("showdropdown");
			$(".nav-dropdown-con").removeClass("dropdown-open");
		}
	});


	// 评价页滚动加载
	var stop=true;
	//var ajax_url=ajax_url;
	function ajax_dp_list(){
		var page=2;
		var page_total = 0;
		var pageload=$(".page-load");
		if (pageload.length==0) {
			var loadhtml="<div class='page-load hide'><span class='loading'>"+"</span></div>"
			$(".j-ajaxlist").append(loadhtml);
		};
		$(document).on('infinite',function() {

			if ($("#tab3").hasClass("active")) {
			$(".page-load").removeClass("hide");
			    if(stop==true){ 
			        stop=false; 
			        var query = new Object();
			        query.data_id = deal_id;
			        query.page = page;
			        query.act="ajax_dp_list";
			        query.dpajax = 1;
			        $.ajax({
		                url: ajax_url,
		                data: query,
		                type: "POST",
		                dataType: "json",
		                success: function (obj) {
		                	if (obj.html != '') {
		                		$(".page-load span").removeClass("loaded").addClass("loading").html("");
			                    $(".j-ajaxadd").append(obj.html);    
			                    stop=true;
			                    page++;
		                	} else {
		                		$(".page-load span").removeClass("loading").addClass("loaded").html("拉到底部啦~");
		                	}
		                },
		                error: function() {
		                    $(".page-load span").html("网络被风吹走啦~");
		                }
			        });
			    } else{
			    	$(".page-load span").removeClass("loading").addClass("loaded").html("拉到底部啦~");
			    }

			};
		});
	}

	if ($('.comment-tit').length == 2) {
		ajax_dp_list();
	}

	// 小能
	$('.xnOpenSdk').bind('click', function() {
		if (app_index != 'app') {
			return;
		}
		if(is_login==0){
			App.login_sdk();
			return false;
		}
		var xnOptionsObj = {
			goods_id:deal_id,
			goods_showURL:$(this).attr('goods_showURL'),
			goodsTitle: $(this).attr('goodsTitle'),
			goodsPrice: $(this).attr('goodsPrice'),
			goods_URL: $(this).attr('goods_URL'),
			settingid: $(this).attr('settingid'),
			appGoods_type: '3',
		};
		xnOptions = JSON.stringify(xnOptionsObj);
		try {
			App.xnOpenSdk(xnOptions);
		} catch (e) {
			$.toast(e);
		}
	})
});



function deal_del_collect(id){
		var query = new Object();
		query.id = id;
		query.act = "del_collect";
		$.ajax({
			url: ajax_url,
			data: query,
			dataType: "json",
			type: "post",
			success: function(obj){
				if(obj.status==0 && obj.user_login_status==0){
					$.alert(obj.info,function(){
						window.location.href=obj.jump;
					});
				}
				if(obj.status == 1){
					$.toast(obj.info);	
					$(".j-collection").attr("data-isdel",0);
					$(".j-head-collect").attr("data-isdel",0);
					$("i.icon-collection").removeClass("isCollection");
					if(obj.collect_count>0){
						$("div.is_Sc").html("<div class='shoucan isSc'><i class='iconfont'>&#xe615;</i><em>"+obj.collect_count+"</em></div>");
					}else{
						$("div.is_Sc").html('<i class="iconfont" id="is_Sc" style="font-size: 1.2rem;">&#xe615;</i>');
					}
				}
			},
			error:function(ajaxobj)
			{
//						if(ajaxobj.responseText!='')
//						alert(ajaxobj.responseText);
			}
		});
	}
	function deal_add_collect(id){
		var query = new Object();
		query.id = id;
		query.act = "add_collect";
		$.ajax({
			url: ajax_url,
			data: query,
			dataType: "json",
			type: "post",
			success: function(obj){
				if(obj.status==0 && obj.user_login_status==0){
					$.toast("请先登录");
					setTimeout(function(){
						window.location.href=obj.jump;
					},1000);
				}
				if(obj.status == 1){
					$(".j-collection").attr("data-isdel",1);
					$(".j-head-collect").attr("data-isdel",1);
					$("i.icon-collection").addClass("isCollection");
					$.toast(obj.info);	
					$("div.is_Sc").html("<div class='shoucan isSc'><i class='iconfont icon-noshoucan'>&#xe615;</i><i class='iconfont icon-shoucan'>&#xe63d;</i><em>"+obj.collect_count+"</em></div>");
					$(".flippedout").removeClass("showflipped").removeClass("dropdowm-open");
					$(".m-nav-dropdown").removeClass("showdropdown");
					$(".nav-dropdown-con").removeClass("dropdown-open");
				}
			},
			error:function(ajaxobj)
			{
//						if(ajaxobj.responseTexst!='')
//						alert(ajaxobj.responseText);
			}
		});
	}

/*
 *初始化商家标签区是否显示更多图标
 *循环遍历累加每个子项的宽度，如果大于内容区域大小则显示更多图标
*/
function setFuliIcon(){
	var ulwidth = $(".shop-fuli").children(".j-activeopen").width();//内容区域宽度
	var allliwidth = 0;//内容宽度，循环遍历累加每个子项的宽度
	$(".shop-fuli").children(".j-activeopen").children("li").each(function(){
		allliwidth += (parseInt($(this).width()) + parseInt($(this).css("margin-right").replace("px","")));
	});

	if(allliwidth < ulwidth){ //如果大于内容区域大小则显示更多图标
		$(".shop-fuli").children(".j-activeopen").children(".iconfont").hide();
	}
}


/*
 *自定义轮播分页器
*/
function slideIndex(){
	var index = $(".swiper-slide-active").attr("rel");
	$(".slideindex em").html(index);
}


/*
 *用于计算tab下划线移动距离
*/
function setTablineLeft(e,type,index){
	if (type == 0) {
		if(index == 1){
			var parentwidth = (e.width() / 3 * index) - 1;
		}else{
			var parentwidth = e.width() / 3 * index;
		}
	}else if (type == 1) {
		if(index > 0){
			var parentwidth = e.width() / index;
		}else{
			var parentwidth = 0;
		}
		
	}
	// $('.m-head-nav .buttons-tab .tab-line').css("left",parentwidth);
}

function init_addcart()
{
	var is_lock=false;
	$("#goods-form").bind("submit",function(){
		if(is_lock) return false;
		is_lock=true;
		var is_stock=true;
		var deal_remain_stock=parseInt($("input[name='max_bought']").val());
		var buy_num=parseInt($("input[name='num']").val());
		if(deal_remain_stock>=0)
		{
			if(buy_num>deal_remain_stock)
			{
				is_stock = false;
				$.toast("库存不足");
			}
			else if(deal_user_max_bought>0&&buy_num>deal_user_max_bought)
			{
				is_stock = false;
				$.toast("每单最多购买"+deal_user_max_bought+"份");
			}
		}
		else
		{
            if(deal_user_max_bought>0&&buy_num>deal_user_max_bought)
			{
				is_stock = false;
				$.toast("每单最多购买"+deal_user_max_bought+"份");
			}
		}
		if(is_stock){
			var query = $(this).serialize();
			var action = $(this).attr("action");
			$.ajax({
				url:action,
				data:query,
				type:"POST",
				dataType:"json",
				success:function(obj){
					if(obj.status==-1)
					{
						$.router.load(obj.jump, true);
					}
					else if(obj.status)
					{
						$(".cart-num").html(obj.cart_num);
						if(obj.in_cart==0){
							if(obj.jump!=""){
								
								$(".flippedout-spec").removeClass("z-open");
								$(".spec-choose").removeClass("z-open");
								$(".flippedout-spec").removeClass("showflipped");
								$(".spec-btn-list").removeClass("isAddCart");
								
								$.showIndicator();
							    setTimeout(function () {
							    	$.hideIndicator();
							    }, 2000);
								$.router.load(obj.jump, true);
							}else{
								is_lock=false;
							}
							
						}else{
							$.toast("加入购物车成功");
							$(".flippedout-spec").removeClass("z-open");
							$(".spec-choose").removeClass("z-open");
							$(".flippedout-spec").removeClass("showflipped");
							$(".spec-btn-list").removeClass("isAddCart");
							setTimeout("$('.flippedout').removeClass('showflipped')",300);
							$('.cart-num').removeClass('hide');
							if(now_buy==1){
								$.router.load(cart_url, true);
							}else{
								is_lock=false;
							}
						}
						
					}
					else
					{
						$.alert(obj.info);
						is_lock=false;
					}
				},
				error:function(o){
					$.alert(o.responseText);
					is_lock=false;
				}
			});
		}else{
			is_lock=false;
		}
		
		return false;
	});
}


$(document).on("pageInit", "#presell_index", function(e, pageId, $page) {
    // 初始化回到头部

    headerScroll();/*导航条变化*/
    init_auto_load_data();
    /*首页广告图轮播*/
    var mySwiper = new Swiper('.j-index-banner', {
        speed: 400,
        spaceBetween: 0,
        pagination: '.swiper-pagination',
        autoplay: 2500
    });
    /*商家设置头部列表*/
    var mySwiper = new Swiper('.j-sort_nav', {
        speed: 400,
        spaceBetween: 0
    });
    /*方维头条*/
    var swiper = new Swiper('.j-headlines', {
        pagination: '',
        direction: 'vertical',
        slidesPerView: 1,
        paginationClickable: true,
        spaceBetween: 0,
        mousewheelControl: true,
        autoplay: 2000,
        loop: true
    });
    /*首页小轮播*/
    var mySwiper = new Swiper('.j-index-lb', {
        speed: 400,
        spaceBetween: 0,
        autoplay: 2500
    });
    /*跑马灯*/
    var swiper = new Swiper('.j-horse-lamp', {
        scrollbarHide: true,
        slidesPerView: 'auto',
        centeredSlides: false,
        grabCursor: true
    });

    if($.fn.cookie("cancel_geo")!=1){
        position();
    }
});

$(document).on("pageInit", "#pt_detail", function(e, pageId, $page) {
	//流程
	select_box($(".j-progress"),$(".j-progress-box"));
	//二维码
	select_box($(".j-open-qrcode"),$(".m-qrcode-box"));
	//购买须知
	select_box($(".j-open-rule"),$(".j-rule-box"));
	//预售倒计时

	leftGRXTime();
	
	var leftGRXObj = setInterval(leftGRXTime,1000);
	function leftGRXTime(){
		  var t =$(".presell-time .j-time").attr('data-time');
		  var d=0;
		  var h=0;
		  var m=0;
		  var s=0;

		    d=Math.floor(t/60/60/24);
		    if (Math.floor(t/60/60%24)<10) {
			    h='0'+Math.floor(t/60/60%24);
		    } else {
		    	h=Math.floor(t/60/60%24);
		    }
		    if (Math.floor(t/60%60)<10) {
			    m='0'+Math.floor(t/60%60);
		    } else {
		    	m=Math.floor(t/60%60);
		    }
		    if (Math.floor(t%60)<10) {
			    s='0'+Math.floor(t%60);
		    } else {
		    	s=Math.floor(t%60);
		    }

			  $(".presell-time .j-day").html(d + "天");
			  $(".presell-time .j-hour").html(h);
			  $(".presell-time .j-min").html(m);
			  $(".presell-time .j-sec").html(s);
			  t = t - 1;
			  $(".presell-time .j-time").attr('data-time',t);	
			  if(t<0){
				  $.loadPage(location.href);
			  }
	

	
	  
	}



	loadScript(jia_url);
	$(".j-activeopen").attr("style","");
	$('.content').scrollTop(0);
	//获得默认库存
	var defaultStock=$(".spec-goodstock").text();
	//收藏


	/*轮播初始化*/
	var mySwiper = new Swiper ('.j-deal-content-banner', {

		autoplay: 3000,/*设置3秒自动播放*/
		spaceBetween: 10,/*图间间隔10px*/
		onSlideChangeStart: function(swiper){/*回调函数：开始变化*/
			slideIndex();
		}
	});


	/*
	 *初始化轮播分页器
	*/
	slideIndex();


	/*
	 *初始化商家标签区是否显示更多图标
	*/
	setFuliIcon();


	/*
	 *显示更多商家标签与商家优惠
	 *用户点击显示区域，下拉显示更多信息，再次点击收起更多信息
	 *区域标识，用于区分商家标签与商家优惠  1：商家优惠   2：商家标签
	*/
	$(".j-activeopen").click(function(){
		var rel = $(this).attr("rel");//区域标识

		if(rel == 1){
			var childlengh = $(this).children("li").length;
		}else if (rel == 2) {
			var allliwidth = 0;
			$(this).children("li").each(function(){
				allliwidth += (parseInt($(this).width()) + parseInt($(this).css("margin-right").replace("px","")));
			});

			var ulwidth = $(this).width();
			var childlengh = Math.ceil(allliwidth / ulwidth);
		}

		var thisheight = $(this).height();
		var childheight = $(this).children("li").height();
		var childmargin = parseInt($(this).children("li").css("margin-top").replace("px",""));
		if(childlengh > 1){
			if($(this).hasClass("isClick")){
				$(this).removeClass("isClick");
				$(this).height(childheight + childmargin * 2);
			}else{
				$(this).addClass("isClick");
				$(this).height((childheight * childlengh)  + (childmargin * (childlengh + 1)));
			}
		}
	});


	/*
	 *显示当前商家更多团购信息
	 *用户点击显示区域，下拉显示更多信息，再次点击收起更多信息
	*/

	$(".j-tuan-showMore").click(function(){
		var childheight = $(this).parent().children(".tuan-list").children("li").height();  //子项高度，用于计算更多高度
		var childlengh = $(this).parent().children(".tuan-list").children("li").length;     //子项个数，用于计算更多高度

		if (childlengh > 1) {
			if($(this).hasClass("isClick")){
				$("#other").html($("#other").attr("content"));
				$(this).removeClass("isClick");
				$(this).parent().children(".tuan-list").height(childheight);
			}else{
				$("#other").html("收起");
				$(this).addClass("isClick");
				$(this).parent().children(".tuan-list").height(childheight * childlengh);
			}
		}
	});

	/*
	 *tab切换时下划线跟随
	*/
	var t_height=$(".m-head-nav").height();
	var s_height=$(".deal-detail").offset().top;
	$(".j-tab-link").click(function(){
        var $me=$(this);
		var type = $(this).parent(".tab-list").attr("data-type");
		var rel = parseInt($(this).attr("rel"));
		if(rel == 0){
			$(".content").scrollTop(0);
            tab_lick_callback($me,type,rel);
        }
        else if (rel == 1) {
			$(".content").scrollTop(s_height-t_height);
            tab_lick_callback($me,type,rel);
        }
        else{
            tab_lick_callback($me,type,rel);
        }
        if ($me.hasClass("active")) {
			var ac_left = $(".j-tab-link.active").offset().left;
			$('.m-head-nav .tab-line').css("left",ac_left);
        }
	});
	var ac_left = $(".j-tab-link.active").offset().left;
	var ac_width = $(".j-tab-link.active").width();
	$('.m-head-nav .tab-line').css({"left":ac_left,"width":ac_width});
    /**
     * 异步加载点评列表
     */
    function ajax_load_tab3(){
        $.post(get_dp_detail_url,"",function(data){
           var $html=$(data);
           if($html.length){
               $("#tab3").html($html.find("#tab3").html());
               $("#dp_list_click").html($html.find("#dp_list_click").html());
           }
        });
    }
    ajax_load_tab3();

    function tab_lick_callback($me,type,rel){
        $(".j-tab-link").removeClass("active");
        $me.addClass("active");
        setTablineLeft($me.parent(),type,rel);
    }

	$(".j-detail").live("click",function(){
		var index = $(this).attr("data");
		var type = $(this).attr("data-type");
		$(".native-scroll").scrollTop(0);
		setTablineLeft($(".tab-list"),type,index);
		$(".tab-link").eq(index).addClass("active");
	});
    /**
     * 加载推荐列表
     */
    function load_recomend_data(){
        $.get(get_recommend_data_url,"",function(data){
            var html=$(data).html();
            if(html){
                $("#recommend_data").html(html);
            }
        });
    }
    load_recomend_data();
	/*倒计时*/
	leftTimeAct();
	
	var leftTimeObj = setInterval(leftTimeAct,1000);
	function leftTimeAct(){
		var leftTime = parseInt($(".AdvLeftTime").attr("data"));
		
		if(leftTime > 0)
		{
			var day  = parseInt(leftTime / 24 /3600);
			var hour = parseInt((leftTime % (24 *3600)) / 3600);
			var min  = parseInt((leftTime % 3600) / 60);
			var sec  = parseInt((leftTime % 3600) % 60);
			if(day<10){
				day="0"+day;
			}
			if(hour<10){
				hour="0"+hour;
			}
			if(min<10){
				min="0"+min;
			}
			if(sec<10){
				sec="0"+sec;
			}
			$(".AdvLeftTime").find(".day").html(day);
			$(".AdvLeftTime").find(".hour").html(hour);
			$(".AdvLeftTime").find(".min").html(min);
			$(".AdvLeftTime").find(".sec").html(sec);
			leftTime--;
			$(".AdvLeftTime").attr("data",leftTime);
		}
		else{
			$(".AdvLeftTime").html('团购已结束');
			
			clearInterval(leftTimeObj);
		}
	}


	/*
	 *底部加入购物车按钮
	*/
	//$(".j-addcart").click(function(){
	//	$(".j-flippedout-close").attr("rel","spec");
	//	$(".j-spec-choose-close").attr("rel","spec");
	//	$(".flippedout-spec").addClass("showflipped").addClass("z-open");
	//	$(".spec-choose").addClass("z-open");
	//	$(".spec-btn-list").addClass("isAddCart");
	//	$(".totop").addClass("vhide");//隐藏回到头部按钮
	//});

	init_addcart();
	/*
	 *底部立即购买按钮
	 *如未在规格选择按钮选择完所有属性，将规格选择窗口关闭，再次点击购买按钮则会再次弹出规格选择窗口
	 *如果在规格选择窗口选择完所有属性，则进行购买操作，不再弹出规格选择窗口
	 */
	$(".j-nowbuy").click(function(){
		if(is_login==0){
			if(app_index=="app"){
				App.login_sdk();
			}else{
				$.router.load(login_url, true);
			}
			return false;
		}
		if(deal_attr_stock_json.length==0){
			now_buy=1;
			$("#goods-form").submit();
			return false;
		}else{
			var data_num = $(".choose-list").length;//获取属性个数
			//  未选择完商品属性，执行弹出规格选择窗口
			$(".j-flippedout-close").attr("rel","spec");
			$(".j-spec-choose-close").attr("rel","spec");
			$(".flippedout-spec").addClass("showflipped").addClass("z-open");
			$(".spec-choose").addClass("z-open");
			$(".totop").addClass("vhide");//隐藏回到头部按钮
		}

	});
	$(".nowbuy").click(function(){
		var data_num = $(".choose-list").length;//获取属性个数
		//var choose_num = $(".good-specifications span em").length; //获取已选属性个数
		var choose_num = $(".flippedout-spec .spec-goodspec em.choose_item").length; //获取已选属性个数
		if (choose_num < data_num) {
			//  未选择完商品属性，执行弹出规格选择窗口
			$.toast("请选择商品规格");
		}else{
			// 已经选择完商品属性，执行购买操作
			now_buy=1;
			$("#goods-form").submit();
		}
	});
	$(".isOk,a.joincart").click(function(){
		var data_num = $(".choose-list").length;//获取属性个数
		//var choose_num = $(".good-specifications span em").length; //获取已选属性个数
		var choose_num = $(".flippedout-spec .spec-goodspec em.choose_item").length; //获取已选属性个数
		if (choose_num < data_num) {
			//  未选择完商品属性，执行弹出规格选择窗口
			$.toast("请选择商品规格");
		}else{
			// 已经选择完商品属性，执行购买操作
			$("input[name='type']").val("1");
			now_buy=0;
			$("#goods-form").submit();
		}
	});

	/*
	 *规格选择窗口 加减按钮事件
	 */
	$(".flippedout-spec").on('click',".j-add-miuns",function(){
		fun_add_miuns($(this));

		var max=parseInt($(this).attr("max-num"));
		//alert($(".numplusminus").val());
		if(max>=0 && parseInt($(".numplusminus").val())>=max){
			$(this).attr("class","numadd add-miuns j-add-miuns j-add isUse");
			$(".numplusminus").val(max);
		}else{
			setSpecgood();
		}
	});
	$(".choose-list .j-choose").click(function(){
		if($(this).hasClass("active")){ //点击已选择属性，则取消选择
			$(this).removeClass("active");
			$(this).parent().siblings(".spec-tit").addClass("unchoose");
			setSpecgood();
		}else if(!$(this).hasClass("isOver")){
			//判断是否是无库存属性，
			//如果不是无库存则正常选择，无库存属性不做任何操作
			$(this).siblings(".j-choose").removeClass("active");
			$(this).addClass("active");
			$(this).parent().siblings(".spec-tit").removeClass("unchoose");
			setSpecgood();
		}
		var data_value= $(".j-choose.active").attr("data-value");
		var data_id= $(this).attr("data-id");
		$(this).parent().siblings("input.spec-data").val(data_id);
		var data_value = []; // 定义一个空数组
		var txt = $('.j-choose.active'); // 获取所有文本框
		for (var i = 0; i < txt.length; i++) {
			data_value.push(txt.eq(i).attr("data-value")); // 将文本框的值添加到数组中
		}

		if (txt.length == 0) {//非初始化状态时，未选择属性页面操作区内容同步规格选择窗口内容
			$(".good-specifications span").empty();
			$(".good-specifications span").removeClass("isChoose");
			$(".good-specifications span").html($(".spec-goodspec").html());
		}else{//将已选择属性显示在页面操作区
			$(".good-specifications span").empty();
			$(".good-specifications span").addClass("isChoose");
			$(".good-specifications span").append("<i class='gray'>已选规格：</i>");
			$.each(data_value,function(i){
				$(".good-specifications span").append("<em class='tochooseda'>" + data_value[i] + "</em>");
				//传值可以考虑更改这里
				//$(".spec-data").attr("data-id-str"+[i],data_value[i]);
			});
		}
	});





	setSpecgood();
	function setSpecgood() {
		if($(".unchoose").length != 0){
			$(".spec-goodspec").empty();
			$(".spec-goodspec").append("请选择");
			$(".spec-goodstock").text(defaultStock);
			$(".spec-goodprice").text("￥"+deal_price.toFixed(2));
			$("input[name='max_bought']").val("0");
			$(".spec-btn-list").removeClass("isNo");
			$(".spec-btn-list div.noStock").text("确定");
			$(".unchoose").each(function(){
				// 选择<em></em>
				$(".spec-goodspec").append("<em>&nbsp;&nbsp;" + $(this).html() + "</em>");
			});
		}else{
			$(".spec-goodspec").empty();
			$(".spec-goodspec").append("已选择");
			$(".j-choose.active").each(function(){
				$(".spec-goodspec").append("<em class='choose_item'>&nbsp;&nbsp;" + $(this).attr("data-value") + "</em>");
			});
			//开始计算属性库存
			//var pirce=parseFloat(deal_price);
			//$(".choose-list .active").each(function(){
			//	pirce+=parseFloat($(this).attr("pirce"));
			//	$(".spec-goodprice").text("￥"+pirce.toFixed(2));
			//});

			if($(".choose-list").length!=0)
			init_buy_ui();//检测库存
			init_submit_btn_status();
		}
	}

	//库存检测-更新面板-改变按钮状态
	function init_buy_ui(){
			var is_stock = true;      //库存是否满足
			var stock = deal_stock;   //无规格时的库存数
			var deal_show_price = deal_price;
			var deal_show_buy_count = deal_buy_count;
			var deal_remain_stock = -1;  //剩余库存 -1:无限

			var attr_checked_ids = []; // 定义一个空数组
			var txt = $('.j-choose.active'); // 获取所有选中对象
			for (var i = 0; i < txt.length; i++) {
				attr_checked_ids.push($('.j-choose.active').eq(i).attr("data-id")); // 将文本框的值添加到数组中
			}
			var attr_checked_ids = attr_checked_ids.sort(); //排序
			var attr_checked_ids_str = attr_checked_ids.join("_");//转字符串 _ 分割
			var attr_spec_stock_cfg = deal_attr_stock_json[attr_checked_ids_str];
			console.log(deal_price);
			console.log(attr_spec_stock_cfg);
			if(attr_spec_stock_cfg)
			{
				deal_show_buy_count = attr_spec_stock_cfg['buy_count'];
				stock = attr_spec_stock_cfg['stock_cfg'];
				$(".spec-goodprice").text("￥"+(parseFloat(deal_price)+parseFloat(attr_spec_stock_cfg['price'])).toFixed(2));
				//$(".spec-goodprice").text("￥"+parseFloat(attr_spec_stock_cfg['presell_deposit_money']).toFixed(2));
			}
			else
			{//单个属性库存
				var has_stock_attr = false;
				for(var k=0;k<attr_checked_ids.length;k++)
				{
					var key = attr_checked_ids[k];
					attr_spec_stock_cfg = deal_attr_stock_json[key];
					if(attr_spec_stock_cfg)
					{
						stock = attr_spec_stock_cfg['stock_cfg'];
						has_stock_attr = true;
						break;
					}
				}
				if(!has_stock_attr)
				stock = -1;
			}
			//判断库存是否大于0
			//更新库存显示
			//判断库存，并更新数量显示
			//判断库存是否小于最小购买量，表示库存不足
			if(stock>0){
				$(".spec-goodstock").text("库存:"+stock+"件");
				$(".j-add-miuns").attr("max-num",stock);
				var num=parseInt($(".numplusminus").val());
				//alert(num);
				if(num>stock){
					$(".numplusminus").val(stock);
				}else if(num==0){
					$(".numplusminus").val(1);
				}
			}else{
				if(stock==-1){
					$(".spec-goodstock").text("库存:不限");
					$(".j-add-miuns").attr("max-num",100);
				}
				else{
					$(".spec-goodstock").text("库存:0 件");
					$(".j-add-miuns").attr("max-num",0);
					$(".numplusminus").val(0);
				}
			}
			$("input[name='max_bought']").val(stock);


	}
	//初始化购物车等相关提交按钮状态
	function init_submit_btn_status(){

			var is_stock=true;
			var deal_remain_stock=parseInt($("input[name='max_bought']").val());
			var buy_num=parseInt($("input[name='num']").val());
			var str='';
			if(deal_remain_stock>=0)
			{
                   if(buy_num>deal_remain_stock)
				{
					is_stock = false;
					str="库存不足";
				}
				else if(deal_user_max_bought>0&&buy_num>deal_user_max_bought)
				{
					is_stock = false;
					str="每单最多购买"+deal_user_max_bought+"份";
				}
			}
			else
			{
                   if(deal_user_max_bought>0&&buy_num>deal_user_max_bought)
				{
					is_stock = false;
					str="每单最多购买"+deal_user_max_bought+"份";
				}
			}
			//alert(11);
			if(is_stock){
				$(".spec-btn-list").removeClass("isNo");
			}else{
				$(".spec-btn-list").addClass("isNo");
				$(".spec-btn-list div.noStock").text(str);
			}

	}


	/*
	 *底部收藏按钮
	 *如果已经收藏则执行以下操作，否则本阶段不执行操作
	 */
	 $(".j-collection").click(function(){
		var is_del = $(this).attr("data-isdel");
		if(is_del == 1){
			//打开取消框
			$(".flippedout").addClass("z-open");
			$(".flippedout").addClass("showflipped");
			$(".cancel-shoucan").addClass("z-open");
		}else{
			if(is_login==0){
				if(app_index=="app"){
					App.login_sdk();
				}else{
					$.router.load(login_url, true);
				}
			}else{
				deal_add_collect(deal_id);
			}
		}
	});

	$(".j-head-collect").on("click",function(){
		var is_del = $(this).attr("data-isdel");
		$(".cancel-shoucan").attr("data-ishead",1);
		if(is_del == 1){
		 	//打开取消框
			$(".cancel-shoucan").addClass("z-open");
		}else{
			if(is_login==0){
				if(app_index=="app"){
					App.login_sdk();
				}else{
					$.router.load(login_url, true);
				}
			}else{
				deal_add_collect(deal_id);
			}
		}
	});

	/*
	 *取消收藏按钮弹出后的取消
	*/

	$(".cancel-shoucan .j-cancel").click(function(){
		var is_head = $(".cancel-shoucan").attr("data-ishead");
		if(is_head != 1){
			$(".flippedout").removeClass("z-open");
			$(".flippedout").removeClass("showflipped");
			$(".cancel-shoucan").removeClass("z-open");
		}else{
			$(".cancel-shoucan").removeClass("z-open");
			$(".cancel-shoucan").attr("data-ishead",0);
		}
	});

	/*
	 *取消收藏按钮弹出后的确认
	*/

	$(".cancel-shoucan .j-yes").click(function(){
		var is_head = $(".cancel-shoucan").attr("data-ishead");
		deal_del_collect(deal_id);
		if(is_head != 1){
			$(".flippedout").removeClass("z-open");
			$(".flippedout").removeClass("showflipped");
			$(".cancel-shoucan").removeClass("z-open");
		}else{
			$(".cancel-shoucan").removeClass("z-open");
			$(".cancel-shoucan").attr("data-ishead",0);
			$(".flippedout").removeClass("showflipped").removeClass("dropdowm-open");
			$(".m-nav-dropdown").removeClass("showdropdown");
			$(".nav-dropdown-con").removeClass("dropdown-open");
		}
	});


	// 评价页滚动加载
	var stop=true;
	//var ajax_url=ajax_url;
	function ajax_dp_list(){
		var page=2;
		var page_total = 0;
		var pageload=$(".page-load");
		if (pageload.length==0) {
			var loadhtml="<div class='page-load hide'><span class='loading'>"+"</span></div>"
			$(".j-ajaxlist").append(loadhtml);
		};
		$(document).on('infinite',function() {

			if ($("#tab3").hasClass("active")) {
			$(".page-load").removeClass("hide");
			    if(stop==true){ 
			        stop=false; 
			        var query = new Object();
			        query.data_id = deal_id;
			        query.page = page;
			        query.act="ajax_dp_list";
			        query.dpajax = 1;
			        $.ajax({
		                url: ajax_url,
		                data: query,
		                type: "POST",
		                dataType: "json",
		                success: function (obj) {
		                	if (obj.html != '') {
		                		$(".page-load span").removeClass("loaded").addClass("loading").html("");
			                    $(".j-ajaxadd").append(obj.html);    
			                    stop=true;
			                    page++;
		                	} else {
		                		$(".page-load span").removeClass("loading").addClass("loaded").html("拉到底部啦~");
		                	}
		                },
		                error: function() {
		                    $(".page-load span").html("网络被风吹走啦~");
		                }
			        });
			    } else{
			    	$(".page-load span").removeClass("loading").addClass("loaded").html("拉到底部啦~");
			    }

			};
		});
	}

	if ($('.comment-tit').length == 2) {
		ajax_dp_list();
	}

	// 小能
	$('.xnOpenSdk').bind('click', function() {
		if (app_index != 'app') {
			return;
		}
		if(is_login==0){
			App.login_sdk();
			return false;
		}
		var xnOptionsObj = {
			goods_id:deal_id,
			goods_showURL:$(this).attr('goods_showURL'),
			goodsTitle: $(this).attr('goodsTitle'),
			goodsPrice: $(this).attr('goodsPrice'),
			goods_URL: $(this).attr('goods_URL'),
			settingid: $(this).attr('settingid'),
			appGoods_type: '3',
		};
		xnOptions = JSON.stringify(xnOptionsObj);
		try {
			App.xnOpenSdk(xnOptions);
		} catch (e) {
			$.toast(e);
		}
	})
});



function deal_del_collect(id){
		var query = new Object();
		query.id = id;
		query.act = "del_collect";
		$.ajax({
			url: ajax_url,
			data: query,
			dataType: "json",
			type: "post",
			success: function(obj){
				if(obj.status==0 && obj.user_login_status==0){
					$.alert(obj.info,function(){
						window.location.href=obj.jump;
					});
				}
				if(obj.status == 1){
					$.toast(obj.info);	
					$(".j-collection").attr("data-isdel",0);
					$(".j-head-collect").attr("data-isdel",0);
					$("i.icon-collection").removeClass("isCollection");
					if(obj.collect_count>0){
						$("div.is_Sc").html("<div class='shoucan isSc'><i class='iconfont'>&#xe615;</i><em>"+obj.collect_count+"</em></div>");
					}else{
						$("div.is_Sc").html('<i class="iconfont" id="is_Sc" style="font-size: 1.2rem;">&#xe615;</i>');
					}
				}
			},
			error:function(ajaxobj)
			{
//						if(ajaxobj.responseText!='')
//						alert(ajaxobj.responseText);
			}
		});
	}
	function deal_add_collect(id){
		var query = new Object();
		query.id = id;
		query.act = "add_collect";
		$.ajax({
			url: ajax_url,
			data: query,
			dataType: "json",
			type: "post",
			success: function(obj){
				if(obj.status==0 && obj.user_login_status==0){
					$.toast("请先登录");
					setTimeout(function(){
						window.location.href=obj.jump;
					},1000);
				}
				if(obj.status == 1){
					$(".j-collection").attr("data-isdel",1);
					$(".j-head-collect").attr("data-isdel",1);
					$("i.icon-collection").addClass("isCollection");
					$.toast(obj.info);	
					$("div.is_Sc").html("<div class='shoucan isSc'><i class='iconfont icon-noshoucan'>&#xe615;</i><i class='iconfont icon-shoucan'>&#xe63d;</i><em>"+obj.collect_count+"</em></div>");
					$(".flippedout").removeClass("showflipped").removeClass("dropdowm-open");
					$(".m-nav-dropdown").removeClass("showdropdown");
					$(".nav-dropdown-con").removeClass("dropdown-open");
				}
			},
			error:function(ajaxobj)
			{
//						if(ajaxobj.responseTexst!='')
//						alert(ajaxobj.responseText);
			}
		});
	}

/*
 *初始化商家标签区是否显示更多图标
 *循环遍历累加每个子项的宽度，如果大于内容区域大小则显示更多图标
*/
function setFuliIcon(){
	var ulwidth = $(".shop-fuli").children(".j-activeopen").width();//内容区域宽度
	var allliwidth = 0;//内容宽度，循环遍历累加每个子项的宽度
	$(".shop-fuli").children(".j-activeopen").children("li").each(function(){
		allliwidth += (parseInt($(this).width()) + parseInt($(this).css("margin-right").replace("px","")));
	});

	if(allliwidth < ulwidth){ //如果大于内容区域大小则显示更多图标
		$(".shop-fuli").children(".j-activeopen").children(".iconfont").hide();
	}
}


/*
 *自定义轮播分页器
*/
function slideIndex(){
	var index = $(".swiper-slide-active").attr("rel");
	$(".slideindex em").html(index);
}


/*
 *用于计算tab下划线移动距离
*/
function setTablineLeft(e,type,index){
	if (type == 0) {
		if(index == 1){
			var parentwidth = (e.width() / 3 * index) - 1;
		}else{
			var parentwidth = e.width() / 3 * index;
		}
	}else if (type == 1) {
		if(index > 0){
			var parentwidth = e.width() / index;
		}else{
			var parentwidth = 0;
		}
		
	}
	// $('.m-head-nav .buttons-tab .tab-line').css("left",parentwidth);
}

function init_addcart()
{
	var is_lock=false;
	$("#goods-form").bind("submit",function(){
		if(is_lock) return false;
		is_lock=true;
		var is_stock=true;
		var deal_remain_stock=parseInt($("input[name='max_bought']").val());
		var buy_num=parseInt($("input[name='num']").val());
		if(deal_remain_stock>=0)
		{
			if(buy_num>deal_remain_stock)
			{
				is_stock = false;
				$.toast("库存不足");
			}
			else if(deal_user_max_bought>0&&buy_num>deal_user_max_bought)
			{
				is_stock = false;
				$.toast("每单最多购买"+deal_user_max_bought+"份");
			}
		}
		else
		{
            if(deal_user_max_bought>0&&buy_num>deal_user_max_bought)
			{
				is_stock = false;
				$.toast("每单最多购买"+deal_user_max_bought+"份");
			}
		}
		if(is_stock){
			var query = $(this).serialize();
			var action = $(this).attr("action");
			$.ajax({
				url:action,
				data:query,
				type:"POST",
				dataType:"json",
				success:function(obj){
					if(obj.status==-1)
					{
						$.router.load(obj.jump, true);
					}
					else if(obj.status)
					{
						$(".cart-num").html(obj.cart_num);
						if(obj.in_cart==0){
							if(obj.jump!=""){
								
								$(".flippedout-spec").removeClass("z-open");
								$(".spec-choose").removeClass("z-open");
								$(".flippedout-spec").removeClass("showflipped");
								$(".spec-btn-list").removeClass("isAddCart");
								
								$.showIndicator();
							    setTimeout(function () {
							    	$.hideIndicator();
							    }, 2000);
								$.router.load(obj.jump, true);
							}else{
								is_lock=false;
							}
							
						}else{
							$.toast("加入购物车成功");
							$(".flippedout-spec").removeClass("z-open");
							$(".spec-choose").removeClass("z-open");
							$(".flippedout-spec").removeClass("showflipped");
							$(".spec-btn-list").removeClass("isAddCart");
							setTimeout("$('.flippedout').removeClass('showflipped')",300);
							$('.cart-num').removeClass('hide');
							if(now_buy==1){
								$.router.load(cart_url, true);
							}else{
								is_lock=false;
							}
						}
						
					}
					else
					{
						$.alert(obj.info);
						is_lock=false;
					}
				},
				error:function(o){
					$.alert(o.responseText);
					is_lock=false;
				}
			});
		}else{
			is_lock=false;
		}
		
		return false;
	});
}


$(document).on("beforePageSwitch", "#publish", function(e, pageId, $page) {
	upfile_data = [];
});

$(document).on("pageInit", "#publish", function(e, pageId, $page) {
	$(".add_expression").addClass("curr");
	bind_publish_item_textarea_set_expression();

	if (ifimgup==0){
		imgup();//图片上传
		ifimgup=1;
	};

	var mySwiper = new Swiper('.swiper-container')
	 /*表单提交事件*/
	 $("form[name='publish_form']").submit(function(){
		var form = $("form[name='publish_form']");
		var content = $("#publish_item_textarea").val();
		if(content.length>0){
			 $(".publish_btn").css("background-color","#6D6D6D");
			 $(".publish_btn").attr("disabled","disabled");
			 var url = $(form).attr("action");
			 var query = new Object();
			 query.content = content;
			 query.img_data = upfile_data;
			 $.ajax({
				url:url,
				data:query,
				type:"post",
				dataType:"json",
				success:function(data){
					$.toast(data.info);
					if (data.status) {
						setTimeout(function() {
							$.router.load(data.jump, true);
						}, 2000);
					}	
				},
				error:function(){
					$.toast("服务器提交错误");
				}
			});
			/*setTimeout(function() {
				$(".publish_btn").css("background-color", '');
				$(".publish_btn").removeAttr("disabled");
			}, 2000);*/
			
			return false;
		}else{
			$.toast("发表的内容不能为空");
		}
		 return false;
	 });
});



/*图片上传*/
var ifimgup=0;
function imgup(){
	var img_index = 0;	
	$("#file-btn").live("change",function(){
		if(this.files[0].type=='image/png'||this.files[0].type=='image/jpeg'||this.files[0].type=='image/gif'){	 
		 	img_box_show();
		 	var demo_box = $(".img-show-box");
	     	var item_box = '<div class="img_load img-item img-index-'+img_index+'" data-index="'+img_index+'"><img src="'+LOADING_IMG+'"></div>';
	     	if($(".img-show-box .img-item").length >0){
	     		$(".img-show-box .img-item").last().after(item_box);
	     		if($(".img-show-box .img-item").length==3){
	     			$(".img-show-box .item-add").remove();
	     		}
	     	}else{
	     		demo_box.html(item_box);
	     		$(".add_img .file-btn").remove();
	     		$(".img-show-box").append('<div class="item-add"><img src="'+add_img_icon+'"/><input class="file-btn" id="file-btn" type="file" capture="camera" /></div>');
	     		$(".add_img").bind("click",function(){img_box_show();});
	     	}
	        lrz(this.files[0], {width:1200, height:900})
		        .then(function(results) {
	        		var data = {
	                    base64: results.base64,
	                    size: results.base64Len // 校验用，防止未完整接收
	                };
	        		upfile_data[img_index] = JSON.stringify(data);
	        		// console.log(img_index);
	        		// console.log(upfile_data.length);
	        		demo_report(results.base64, results.origin.size);
	        		img_index++;
		        })
		        .catch(function(err) {
		        	$.toast('图片获取失败');
		        })
	 	}else{
	 		$.toast("上传的文件格式有误");
	 	}
	});
	 
}
/*图片base64 数组*/
var upfile_data = new Array();
function demo_report(base64,size) {
    var img = new Image();

    if(size === 'NaNKB') size = '';
    if(size>0){
    	var span_html = '<span class="item_span" style="background-image: url('+base64+');background-size: cover;background-position: 50% 20%;background-repeat: no-repeat;"></span><a class="close-btn" href="javascript:void(0);" onclick="del_img_box(this)"><i class="iconfont" style="font-size:0.65rem;">&#xe635;</i></a>';
    	$(".img_load").html(span_html);
    	$(".img_load").removeClass('img_load');
    	
    }
}

function add_img(){
	img_box_show();
	if(type==1 && $(".img-show-box .img-item").length<3){
		return $("#file-btn").click();
	}
	if($(".img-show-box .img-item").length == 0){
 		return $("#file-btn").click();
 	}
}

function add_expression(){
	expression_show();
}
function expression_show(){
	$(".add_expression").addClass("curr");
	$(".expression").show();
	$(".add_img").removeClass("curr");
	$(".img-show-box").hide();
}
function img_box_show(){
	$(".add_img").addClass("curr");
	$(".img-show-box").show();
	$(".add_expression").removeClass("curr");
	$(".expression").hide();
}

function del_img_box(obj){
	var index = $(obj).parent().attr("data-index");
	delete upfile_data[index];
	$(".img-index-"+index).remove();
	setTimeout(function(){
		$(".img-index-"+index).remove();
		if($(".img-show-box .img-item").length<3 && $(".img-show-box .item-add").length==0){
			$(".img-show-box").append('<div class="item-add"><img src="'+add_img_icon+'"/><input class="file-btn" id="file-btn" type="file" capture="camera" /></div>');
		}
	},500);
}


/*表情事件*/
function bind_publish_item_textarea_set_expression()
{
	$(".emotion_publish_item_textarea").find("a").bind("click",function(){
		var o = $(this);
		insert_publish_item_textarea_cnt("["+$(o).attr("rel")+"]");	
	});
	
}

function insert_publish_item_textarea_cnt(cnt)
{
	var val = $("#publish_item_textarea").val();
//	var pos = $("#publish_item_textarea").attr("position");
//	var bpart = val.substr(0,pos);
//	var epart = val.substr(pos,val.length);
//	$("#publish_item_textarea").val(bpart+cnt+epart);
	$("#publish_item_textarea").val(val+cnt);
	// $.weeboxs.close("form_pop_box");
	
}


/**
 * Created by Administrator on 2016/10/14.
 */
$(document).on("pageInit", "#user_register", function(e, pageId, $page)  {
	clear_input($('#phonenumer'),$('.j-phone-clear'));
	clear_input($('#sms_verify'),$('.j-verify-clear'));
	clear_input($('#password'),$('.j-password-clear'));

    var _cli=0;
    $(".eyes").click(function () {
        _cli++;

        if(_cli==1){
            $(".eyes-no").hide();
            $(".eyes-yes").show();
            $(".password").attr("type","text");
        }
        if(_cli==2){
            $(".eyes-no").show();
            $(".eyes-yes").hide();
            $(".password").attr("type","password");
        }
        if(_cli>=2){
            _cli=0;
        }
    });

    $(".userBtn-yellow").click(function () {
    	$("#ph_register").submit();
    });
    //手机注册
    $("#ph_register").bind("submit",function(){
		
		var mobile = $.trim($(this).find("input[name='user_mobile']").val());
		var user_pwd = $.trim($(this).find("input[name='user_pwd']").val());
		var sms_verify = $.trim($(this).find("input[name='sms_verify']").val());
		if(mobile=="")
		{
			$.toast("请输入手机号");
			return false;
		}
		if(user_pwd=="")
		{
			$.toast("请输入密码");
			return false;
		}
		if(sms_verify=="")
		{
			$.toast("请输入收到的验证码");
			return false;
		}
		
		var query = $(this).serialize();
		var ajax_url = $(this).attr("action");
		$.ajax({
			url:ajax_url,
			data:query,
			type:"POST",
			dataType:"json",
			success:function(obj){
				if(obj.status)
				{
					$("#prohibit").show();
					$.toast(obj.info);
					window.setTimeout(function(){
						location.href = obj.jump;
						},1500);
				}
				else
				{
					$.toast(obj.info);
				}
			}
		});
		
		return false;
	});


    /*var _input=$("input");
    _input.each(function (e) {
        $(this)[0].addEventListener("blur",function () {
            
            document.querySelector(".third-login").style.display="block";
        },false);

        $(this)[0].addEventListener("focus",function () {
            document.querySelector(".third-login").style.display="none";
        },false);
    });*/

});
$(document).on("pageInit", "#rsorder_index", function(e, pageId, $page) {
	init_list_scroll_bottom();//下拉刷新加载
	//打开评论
	$(document).on('click', '.j-open-comment', function() {
		$(".img-comment-1").attr("src",$(this).parents('li').find(".img-comment").attr('src'));
		$(".name-comment-1").html($(this).parents('li').find(".name-comment").html());
		$("input[name='order_id_1']").val($(this).parents('li').find("input[name='order_id']").val());
		$("input[name='location_id_1']").val($(this).parents('li').find("input[name='location_id']").val());
		$.popup('.popup-comment');
	});
	//关闭当前弹层
	$(document).on('click', '.j-close-popup', function() {
	    $(this).parents('.popup').removeClass('modal-in').addClass('modal-out');
	});
	$(".comment-stars").on('click', '.j-point', function() {
		$(".j-point").removeClass('active');
		$(this).addClass('active');
		$(this).prevAll().addClass('active');
		$("#star-value").attr('value', $(this).attr('value'));
	});
	
	
	//发表评论
	$('.j-comment-sub').bind('click',function(){
		
    	var is_pass=1;
    	var dp_points=$("#star-value").val();
			if(dp_points==0){
				$.toast('请给出您宝贵的评分！');
				is_pass=0;
				return false;
			}
    	if(is_pass==1){

	    	if($("textarea[name='content']").val()==''){
	    		$.toast('请填写您的宝贵意见！');
	    		is_pass=0;
	    		return false;
	    	}
    	}
    		
		if(is_pass==0){
			return false;
		}


    	var url=$(this).attr('action');
    	
		var query = new Object();
		query.location_id = $("input[name='location_id_1']").val();
		query.order_id = $("input[name='order_id_1']").val();
		 
		query.dp_points=dp_points;

    	query.content = $("textarea[name='content']").val(); 
    	query.is_rs = 1;
     	$.ajax({
			url:url,
			data:query,
			type:'post',
			dataType:'json', 
			success:function(data){
			
				if(data.status==1){
				$.showIndicator();
			      setTimeout(function () {
			    	  close_comment();
			      }, 2000);
					
				}else{
					$.toast(data.info);
				}
				
				function close_comment(){
					$.toast(data.info);
					$(".popup-comment").removeClass('modal-in').addClass('modal-out');
					$.hideIndicator();
					$(".j-point").removeClass('active');
					$("#star-value").attr('value', '');
					$("textarea[name='content']").val('');
					var AJAX_URL = data.jump;
					var is_ajax  = 1;
					$.ajax({
						url:AJAX_URL,
						data:{"is_ajax":is_ajax},
						type:'post',
						dataType:'json', 
						success:function(obj){
							$(".infinite-scroll-bottom").html(obj.html);
							init_list_scroll_bottom();//下拉刷新加载
						}
					});
				}
			}
    	});
    	   
          
    });
	
	$('.order-edit-bar').on('click','.to-pay',function(){
		var url = $(this).attr('data_url');
		var jump_url = $(this).attr('jump_url');
		var query = new Object();
		query.is_rs = 1;
		$.ajax({
			url:url,
			data:query,
			type:'post',
			dataType:'json',
			success:function(data){
				if(data.status == 1){
					location.href = jump_url;
				}else{
					$.toast(data.info);
				}
			}
		});
		
	});
	
});
$(document).on("pageInit", "#rsorder_view", function(e, pageId, $page) {
	//打开评论
	$(document).on('click', '.j-open-comment', function() {
		$(".img-comment-1").attr("src",$(".img-comment").attr('src'));
		$(".name-comment-1").html($(".name-comment").html());
		$("input[name='order_id_1']").val($("input[name='order_id']").val());
		$("input[name='location_id_1']").val($("input[name='location_id']").val());
		$.popup('.popup-comment');
	});
	//关闭当前弹层
	$(document).on('click', '.j-close-popup', function() {
	    $(this).parents('.popup').removeClass('modal-in').addClass('modal-out');
	});
	$(".comment-stars").on('click', '.j-point', function() {
		$(".j-point").removeClass('active');
		$(this).addClass('active');
		$(this).prevAll().addClass('active');
		$("#star-value").attr('value', $(this).attr('value'));
	});
	
	
	
	//发表评论
	$('.j-comment-sub').bind('click',function(){
		
    	var is_pass=1;
    	var dp_points=$("#star-value").val();
			if(dp_points==0){
				$.toast('请给出您宝贵的评分！');
				is_pass=0;
				return false;
			}
    	if(is_pass==1){

	    	if($("textarea[name='content']").val()==''){
	    		$.toast('请填写您的宝贵意见！');
	    		is_pass=0;
	    		return false;
	    	}
    	}
    		
		if(is_pass==0){
			return false;
		}


    	var url=$(this).attr('action');
    	
		var query = new Object();
		query.location_id = $("input[name='location_id_1']").val();
		query.order_id = $("input[name='order_id_1']").val();
		
		query.dp_points=dp_points;

    	query.content = $("textarea[name='content']").val(); 
    	$.ajax({
			url:url,
			data:query,
			type:'post',
			dataType:'json', 
			success:function(data){
			
				if(data.status==1){
//				$.showIndicator();
				$.toast(data.info);
			      setTimeout(function () {
			    	  close_comment();
			      }, 2000);
					
				}else{
					$.toast(data.info);
				}
				
				function close_comment(){
					location.reload(); 
					$(".popup-comment").removeClass('modal-in').addClass('modal-out');
					$.hideIndicator();
					$(".j-point").removeClass('active');
					$("#star-value").attr('value', '');
					$("textarea[name='content']").val('');
					
//					var AJAX_URL = data.jump;
//					var is_ajax  = 1;
//					$.ajax({
//						url:AJAX_URL,
//						data:{"is_ajax":is_ajax},
//						type:'post',
//						dataType:'json', 
//						success:function(obj){
//							$(".infinite-scroll-bottom").html(obj.html);
//							init_list_scroll_bottom();//下拉刷新加载
//						}
//					});
				}
			}
    	});
    	   
          
    });
	var lock = true;
	
	$(".dc-view-bar").on('click', '.j-cancle', function() {
		if(!lock){
			return;
		}else{
			lock = false;
			var url = $(this).attr('data_url');
			var query = new Object();
			//取消订单
			$.confirm('确定要取消订单吗？', function () {
		          $.ajax({
		        	  url:url,
		        	  type:'post',
		        	  dataType:'json',
		        	  success:function(data){
		        		  if(data.status == 1){
		        			  $.toast(data.info);
		        			  setTimeout(function () {
		        				  location.reload(); 
		    			      }, 2000);
		        			  
		        		  }else{
		        			  $.confirm(data.info,function(){
		        				  lock = true;
		        				  window.location.href = "tel:"+data.location_tel;
		        			  },function(){
		        				  location.reload(); 
		        			  });
		        		  }
		        	  }
		          });
		      },function () {
	        	  lock = true;
	          });
		}
	});
	
	$(".dc-view-bar").on('click','.to-pay',function(){
		if(!lock){
			return;
		}else{
			lock = false;
			var url = $(this).attr('data_url');
			var jump_url = $(this).attr('jump_url');
			var query = new Object();
			query.is_rs = 1;
			$.ajax({
				url:url,
				data:query,
				type:'post',
				dataType:'json',
				success:function(data){
					if(data.status == 1){
						location.href = jump_url;
					}else{
						lock = true;
						$.toast(data.info);
					}
				}
			});
		}
		
	});
	
});
$(document).on("pageInit", "#scores", function(e, pageId, $page) {
    init_list_scroll_bottom();
});
$(document).on("pageInit", "#scores_index", function(e, pageId, $page) {
	init_auto_load_data();
	 var mySwiper = new Swiper ('.j-score-type', {
		scrollbarHide: true,
        slidesPerView: 'auto',
        centeredSlides: false,
        grabCursor: true
	});
	 
	$(".signin").live("click",function(){
        var query = new Object();
        query.act="signin";
        $.ajax({
                url: INDEX_URL,
                data: query,
                type: "POST",
                dataType: "json",
                success: function (obj) {
                	if(obj.status==1){
                		$(".sign").removeClass('signin').find("span").html(obj.info);
                		$(".sign-day").html(obj.sign_info);
                		$(".user-info .score em").html(obj.score);
                		
                	}else{
                		$.alert(obj.info);
                	}
                },
        });
	});
	$(".ulogin").unbind("click");
	$(".ulogin").bind("click",function () {
		if(is_login==0){
			if(app_index=="app"){
				App.login_sdk();
			}else{
				$.router.load(login_url, true);
			}
		}
	});



});


$(document).on("pageInit", "#search_index", function(e, pageId, $page) {
	$("input[name='search_type']").val(2);
	//搜索类型切换

	function stopPropagation(e) {
			if (e.stopPropagation)
				e.stopPropagation();
			else
				e.cancelBubble = true;
		}

		$(document).bind('click', function() {
			$(".type-select").removeClass('active');
		});
		function clear_search() {
			if ($('#keyword').val().length==0) {
				$("#close").hide();
			} else {
				$('#close').show();
			}
		}
		$("#keyword").bind('input propertychange', function() {
			clear_search();
		});
		$('#close').click(function(){
			$('#keyword').val('');
			$("#close").hide();
		});
		$('.search-type').bind('click', function(e) {
			stopPropagation(e);
			$(".type-select").addClass('active');
		});
		$(".type-select li a").click(function() {
			$(".search-list li").hide();
			$("input[name='search_type']").val($(this).attr("data"));
			if($(this).html()=="商城"){
				$("input[name='keyword']").attr("placeholder","搜索商品");
			}else{
				$("input[name='keyword']").attr("placeholder","搜索"+$(this).html());
			}
		});
		$(".type-select li").bind("click",function(){
			$(".search-list li").hide();
			$(".search-list li").eq($(this).index()).show();
		});

	//初始化历史搜索记录
	var cookarr = new Array();
	cookobj = $.fn.cookie('cookobj');
	if(cookobj){
		var cookarr = cookobj.split(',');
	}
	var key_html='';
	$.each(cookarr,function(i,obj){
		if(obj){
			$("#history").css({display:""});	
		}
		key_html+='<li>'+ obj +'</li>';	
	});
    $(".history-search .key-list").html(key_html);
    
	function search_submit(){
		var keyword = $.trim($("#keyword").val());
		if(keyword==''){
			$.alert("请输入搜索内容");
			return false;
		}
		if($.inArray(keyword ,cookarr)== -1){
			cookarr.push(keyword);
		}
		$.fn.cookie('cookobj',cookarr);
		
		$("form[name='search_form']").submit();
		
	}
	$(".key-list li").click(function() {
		$("#keyword").val($(this).text());
		search_submit();
		
	});
	
	$(".key-list li").click(function() {
		$("#keyword").val($(this).text());
		search_submit();
		
	});
	
	$(".search").click(function(){
		search_submit();
	});
	
	
	//按回车键判断函数
	$(document).keypress(function(e){
        var eCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
        if (eCode == 13){
        	search_submit();
        	return false;
        }
	});
	/*
	$("form[name='search_form']").bind('submit',function(){
		search_submit();
		return false;
		
	});
	*/
	$('.confirm-ok').on('click', function () {
	      $.confirm('确定要清空历史数据？', function () {
	          $(".history-search .key-list").remove();
	          $.fn.cookie('cookobj',cookarr,{ expires: -1 });
	          $("#history").css({display:"none"});
	          window.location.reload();
	      });
	});
});
/**
 * Created by Administrator on 2016/11/4.
 */

$(document).on("pageInit", "#login_out", function(e, pageId, $page) {

   $(".fun-check-login").bind("click",function () {
       if(app_index=='app'){
           App.login_sdk();
       }
   });
   
   $(document).on('click','.open-about', function () {
	   $.popup('.popup-about');
   });
   
});
$(document).on("pageInit", "#shop", function(e, pageId, $page) {
	init_auto_load_data();
	var mySwiper = new Swiper('.j-index-banner', {
		speed: 400,
		spaceBetween: 0,
		pagination: '.swiper-pagination',
		autoplay: 2500
	});
	var mySwiper = new Swiper('.j-index-lb', {
	    speed: 400,
	    spaceBetween: 0,
		autoplay: 2500
	});
/*商家设置头部列表*/
var mySwiper = new Swiper('.j-sort_nav', {
    speed: 400,
    spaceBetween: 0
});

});
$(document).on("pageInit", ".page", function(e, pageId, $page) {
	var lesstime = 0;
	is_bind_ts=0;
	time($("#btn"));
	if ($('#phonenumer').val() == '') {
		$("#btn").addClass("noUseful").removeClass("isUseful");
	}
	
	/*手机号码正则验证*/
	
	if($("#phonenumer").length>0){
	    document.getElementById("phonenumer").oninput=function () {
	    	if(parseInt($("#btn").attr("lesstime"))==0){
	    		var reg = /^0?1[3|4|5|7|8][0-9]\d{8}$/;
	
	            var text=$(this).val();
	            if(reg.test(text)){
	                $(".j-sendBtn").addClass("isUseful").removeClass("noUseful");
	                $(".j-sendBtn").prop("disabled",false);
	                /*发送验证码倒计时*/
	                $(".j-sendBtn .isUseful").click(function () {
	                	do_send($("#btn"));
	                });
	            }
	            else {
	                $(".j-sendBtn").addClass("noUseful").removeClass("isUseful");
	                $(".j-sendBtn").prop("disabled", true);
	            }
	    	} 
	    };
	}
	//$("#btn").bind("click",function(){
		//alert("111");
	//	do_send($("#btn"));
	//});
	 
	$("#verify_image_box").find(".verify_close_btn").bind("click",function(){
        $("#verify_image_box").hide();
    });
});
var is_bind_ts=0;
function do_send(btn)
{
	if($.trim($("#phonenumer").val())=="")
	{
		$.toast("请输入手机号码");
		return false;
	}
	if(lesstime>0)return;
	var query = new Object();
	query.mobile = $("#phonenumer").val();
	query.act = "send_sms_code";
	query.unique = $(btn).attr("unique");
	query.verify_code = $(btn).attr("verify_code");
	$.ajax({
		url:AJAX_URL,
		data:query,
		type:"POST",
		dataType:"json",
		success:function(obj){
			if(obj.is_bind&&is_bind_ts==0){
				$.alert(obj.bind_ts,function(){
					is_bind_ts=1;
				});
			}
			if(obj.status==1)
			{
				$(btn).attr("lesstime",obj.lesstime);
				time($("#btn"));
				$.toast(obj.info);
				
			}
			else
			{
				if(obj.status==-1)
				{
					get_verification_code();
                    $("#verify_image_box").show();
                    if($(btn).attr("verify_code")&&$(btn).attr("verify_code")!=""){
    					$.alert(obj.info,function(){
    						$(btn).attr("verify_code","");
    					});
    				}
					
				}
				else
				{
					$.toast(obj.info);
				}
				
			}
		}
	});
}
function get_verification_code(){
	//刷新验证码
	$.ajax({
		url:VERIFICATION_CODE_URL,
		type:"POST",
		dataType:"json",
		success:function(obj){
			if(obj.status){
				$(".form-item").html(obj.html);
				$(".icon-list").click(function(){
					//选择验证码图标
					$(this).addClass('active').siblings().removeClass('active');
					var iconcode = $(this).find(".iconcode").attr("rel");
					$("input[name='verify_image']").val(iconcode);
					
				});
				$(".batch").click(function(){
					//选择验证码图标
					get_verification_code();
					
				});
				$("#verify_image_box").find("img").bind("click",function(){
					var rel = $(this).attr("rel");
					$(this).attr("src",rel+"&r="+Math.random());
				});
				$("#verify_image_box").find("input[name='confirm_btn']").unbind("click");
				$("#verify_image_box").find("input[name='confirm_btn']").bind("click",function(){
					var verify_code = $.trim($("#verify_image_box").find("input[name='verify_image']").val());
					if(verify_code==""){
						$.toast("请输入图形验证码");
					}else{
						$(btn).attr("verify_code",$("input[name='verify_image']").val());
						$("#verify_image_box .verify_form_box .form-item").html("");
                        $("#verify_image_box").hide();
                        do_send(btn);

					}
				});
			}
		}
	});
}
function time(obj) {
	wait=parseInt(obj.attr("lesstime"));
    if (wait == 0) {
        obj.prop("disabled",false);
        obj.addClass("isUseful").removeClass("noUseful");
        obj.val("发送验证码");
        obj.attr("lesstime",0);
        $(".j-sendBtn.isUseful").click(function () {
        	do_send($("#btn"));
        });
        $("#btn").attr("verify_code","");
        //wait = 60;
    } else {
        obj.prop("disabled", true);
        obj.addClass("noUseful").removeClass("isUseful");
        obj.val("重新发送(" + (wait-1) + ")");
        obj.attr("lesstime",wait-1);
        //wait--;
        setTimeout(function() {
                time(obj)
            }, 1000);
    }
}
$(document).on("pageInit", "#store", function(e, pageId, $page) {
	qrcode_box();
	$(".j-open-store-detail").click(function(){
		var con_height = $(".content").height();
		var top_height = $(".banner-con").height();
		var margin_height = parseInt($(".m-store-banner").css("margin-bottom").replace("px"));
		var height = parseInt(con_height) - parseInt(top_height) -margin_height;
		if($(".store-detail-info").height() == 0){
			$(".store-detail-info").height(height);
			$(this).addClass("isOver");
			setTimeout('$(".other-content").addClass("hide");',200);
			$(".store-detail-info").scroller('refresh');
			$(".content").scroller('refresh');
			$(".store-detail-info").scrollTop(0);
		}else{
			$(".store-detail-info").height(0);
			$(this).removeClass("isOver");
			$(".other-content").removeClass("hide");
			$(".store-detail-info").scroller('refresh');
		}
	});


	$(".youhui-item").bind("click",function(){
		var url=$(this).attr("url");
		$.ajax({
			url: url,
			dataType: "json",
			type: "POST",
			success: function(obj){
				if(obj.status==0){
					$.toast(obj.info);
					if(obj.jump){
						$.router.load(obj.jump, true);
					}
				}else if(obj.status==1){
					$.toast(obj.info);
				}
			},
			error:function()
			{
				$.toast("服务器提交错误");
			}
		});
	});



});
$(document).on("pageInit", "#stores", function(e, pageId, $page) {
	init_list_scroll_bottom();//下拉刷新加载
	//星星评分
	$(".stores-item").each(function(){
	    $(this).find(".start-num").css("width",$(this).find(".start-num").parent().parent().attr("data")+"%");
	});
	//隐藏数量为0的2级分类
	/*$(".goods-num").filter(function(index){
　　　　return $(this).text()=="0";
　　	}).parent().hide();*/
	screen_bar();
	if(address==""){
		position();
	}
	$(".address-info").click(function() {
		position();
	});
});

$(document).on("pageInit", "#store_imgs", function(e, pageId, $page) {
	//切换
    $(".j-list-choose").on('click', function() {

        var $me = $(this);
        var rel = parseInt($(this).attr("rel"));
        $(".j-list-choose").removeClass("active");
        $me.addClass('active');
        var _index = $me.index();
        $('.store-img').removeClass('active');
        $('.store-img').eq(_index).addClass('active');
        if ($me.hasClass("active")) {
            var ac_left = $(".j-list-choose.active span").offset().left;
            $('.list-nav-line').css("left", ac_left);
        }
    });
    var ac_left = $(".j-list-choose.active span").offset().left;
    var ac_width = $(".j-list-choose.active span").width();
    $('.list-nav-line').css({ "left": ac_left, "width": ac_width });

    
});



$(document).on("pageInit", "#store_pay_index", function(e, pageId, $page) {
    $("input[name='money']").val('');
    $("input[name='other_money']").val('');
    $('.discount_money .integer').text('0');
    $('.discount_money .point').text('00');
    $('.actual_pay .integer').text('0');
    $('.actual_pay .point').text('00');
	count_amount();
    init_money_change();
    order_submit();
});

// 监听输入金额的变动
function init_money_change(){

    $("input[name='money']").bind('input propertychange', function() {
        pre_check('money');
        count_amount();
    });

    $("input[name='other_money']").bind('input propertychange', function() {
        pre_check('other_money');
        count_amount();
    });
	$("input[name='all_score']").bind('change', function() {
		count_amount();
	});
}

function pre_check(type) {
    var money = $.trim($("input[name='"+type+"']").val());
    var match = money.match(/^(\d*)?(\.)?(\d{0,2})?/);
    var price = '';
    if (match) {
        price += match[1] ? match[1] : 0;
        if (match[2]) {
            price += match[2];
        }
        if (typeof match[3] !== 'undefined') {
            price += match[3];
        }
    }
    if (price.indexOf('.') === -1) {
        price = Number(price);
    }
    $("input[name='"+type+"']").val(price);
}


// 计算最终应支付的金额
function count_amount() {
    var final_pay = 0;
    var money = $.trim($("input[name='money']").val());
    var other_money = $.trim($("input[name='other_money']").val());
    /*var pattern = /^(\d+(\.\d{0,2})?)$/;
    if (money != '' && !pattern.test(money)) {
        $.toast('输入的金额格式错误');
        money = 0;
    }
    if (other_money != '' && !pattern.test(other_money)) {
        $.toast('输入的金额格式错误');
        other_money = 0;
    }*/
    // money = Number(money).toFixed(2);
    var pay_money = money - other_money;
    var discount = count_discount(pay_money);
    final_pay = money - discount;
	//积分抵现new
	if(pay_money>0){
		var query = new Object();
		query.pay_money=pay_money;
		query.final_pay=final_pay;
		if($('input[name="all_score"]:checked').length>0){
			var all_score=1;
		}else{
			var all_score=0;
		}
		query.all_score=all_score;
		query.act='score_purchase_count';
		$.ajax({ 
			url: custom_ajax_url,
			data:query,
			type: "POST",
			dataType: "json",
			success: function(data){
				if(data.score_purchase_switch==1&&data.exchange_money>0){
					$(".score_purchase").show();
					$(".score_purchase .u-score").text(data.user_score);
					$(".score_purchase .u-use-score").text(data.user_use_score);
					$(".score_purchase .u-money").text('¥'+data.exchange_money);
					if(all_score ==1){
						final_pay = final_pay - data.exchange_money;
					}
					count_amount_continuation(discount,final_pay);
				}else{
					$("input[name='all_score']").prop("checked",false);
					$(".score_purchase").hide();
					count_amount_continuation(discount,final_pay);
				}
			},
			error:function(ajaxobj)
			{
				$("input[name='all_score']").prop("checked",false);
				$(".score_purchase").hide();
				count_amount_continuation(discount,final_pay);
			}
		});
	}else{
		$("input[name='all_score']").prop("checked",false);
		$(".score_purchase").hide();
		count_amount_continuation(discount,final_pay);
	}//end
    
	
}
function count_amount_continuation(discount,final_pay) {
	var discount_integer, discount_point;
    discount = discount.toString();
    var i = discount.toString().indexOf('.');
    if (i == -1) {
        discount_integer = discount;
        discount_point = '00';
    } else {
        discount_integer = discount.substring(0, i);
        discount_point = discount.substring(i + 1);
    }
    var final_pay_integer, final_pay_point;
    final_pay_s = Math.round(final_pay * 100).toString();
    final_pay_point = final_pay_s.substr(-2);
    if (final_pay_point.length == 1) {
        final_pay_point = '0' + final_pay_point;
    }
    final_pay_integer = final_pay_s.substr(0, final_pay_s.length - 2);
    final_pay_integer = final_pay_integer ? final_pay_integer : 0;
    $('.discount_money .integer').text(discount_integer);
    $('.discount_money .point').text(discount_point);
    $('.actual_pay .integer').text(final_pay_integer);
    $('.actual_pay .point').text(final_pay_point);
}
// 计算支付金额的可优惠部分
function count_discount(pay_money) {
    var discount = 0;
    var limit = 0;
    $('.discount').each(function(index, domEle) {
        limit = $(domEle).find('.limit').text();
        if (limit <= pay_money) {
            discount += Number($(domEle).find('.amount').text());
        }
        
    });
    return discount.toFixed(2);
}

function order_submit(){
    $(".btn-con").bind("click",function(){
		if($('input[name="all_score"]:checked').length>0){
			var all_score=1;
		}else{
			var all_score=0;
		}
		var exchange_money= $(".score_purchase .u-money").text();
		
        var pay = $('.actual_pay .integer').text();
        var point = $('.actual_pay .point').text();
        if ((pay != 0 || point !=0)||(pay == 0 && point ==0 && all_score==1 && exchange_money>0)) {
            var query=$("#submit_dp").serialize();
            var url=$("#submit_dp").attr('action');
            $.ajax({ 
                url: url,
                data:query,
                type: "POST",
                dataType: "json",
                success: function(data){
                    if (data.user_login_status == 0) {
                        if (app_index == 'app') {
                            App.login_sdk();
                        } else {
                            $.router.load(data.jump, true);
                        }
                    } else {
                        if (data.status == 1) {
                            $.router.load(data.jump, true);
                        } else {
                            $.toast(data.info);
                            if (data.jump) {
                                setTimeout(function() {
                                    $.router.load(data.jump, true);
                                }, 2000);
                            }
                        }
                    }
                },
                error: function() {
                    $.toast('请求异常');
                }

            });
        } else if ($('input[name=money]').val() != '') {
            $.toast('输入的金额格式错误');
        } else {
            $.toast('请输入消费金额');
        }
        return false;

    });
}
/**
 * Created by Administrator on 2016/11/28.
 */
$(document).on("pageInit", "#store_payment_done", function(e, pageId, $page) {
    
    $('.deal-share').click(function() {
        // 
    })
});

// $(function(){
//     //init_payment_input();

//     init_pay_btn();

// });

$(document).on("pageInit", "#store_pay_check", function(e, pageId, $page) {
	$('.fee_count').hide();
	init_payment_input();
	init_pay_btn();
	

	function init_payment_input(){
		$("input[name='all_account_money']").live("change",function () {

			if($("#all_account_money").hasClass("active")){
				$("#all_account_money").removeClass("active");
			}else{
				$("#all_account_money").addClass("active");
				$("input[name='payment']").prop("checked",false);
			}
			//count_buy_total();
			$('.fee_count').hide();
			$('.fee_count .payment_fee').text(0);
			local_count()
		});
		
		
		$(".payment").live("click",function(){
			$("input[name='payment']").prop("checked",false);
			$(".payment").removeClass('active');
			$(this).siblings("input[name='payment']").prop("checked",true);
			$(this).addClass("active");

			$("#all_account_money").removeClass("active");
			$("input[name='all_account_money']").prop("checked",false);
			var fee = Number($('.active .fee_amount').text());
			if (fee > 0) {
				$('.fee_count .payment_fee').text(fee.toFixed(2));
				$('.fee_count').show();
			} else {
				$('.fee_count .payment_fee').text(0);
				$('.fee_count').hide();
			}
			local_count()
		});

	}

	function local_count() {
		var total= $('.total_count').text();
		if (total) {
			total = total.replace(",", "");
		}
		var payment_fee= $('.payment_fee').text();
		if (payment_fee) {
			payment_fee = payment_fee.replace(",","")
		}
		var discount= $('.discount').text();
		if (discount) {
			discount = discount.replace(",","")
		}
		var ready_pay = Number(total) - Number(discount) + Number(payment_fee);
		$('.ready_pay').text(ready_pay.toFixed(2));
	}

	function count_buy_total()
	{
		ajaxing = true;
		var query = new Object();
		
		//全额支付
		//if($("input[name='all_account_money']").attr("checked")) {
		if($("#all_account_money").hasClass("active")) {
			query.all_account_money = 1;
		} else {
			query.all_account_money = 0;
		}
		
		//支付方式
		var payment = $("input[name='payment']:checked").val();
		if(!payment) {
			payment = 0;
		}
		query.ajax = 1;
		query.payment = payment;
	    query.order_id = order_id;
		query.bank_id = $("input[name='payment']:checked").attr("value");


		if(!isNaN(order_id)&&order_id>0){
			query.act = "count_store_pay_total";
		} else {
			query.act = "check";
		}

		$.ajax({ 
			url: custom_ajax_url,
			data:query,
			type: "POST",
			dataType: "json",
			success: function(data){
				if(data.status == -1) {  //未登录，请先登录
					$.alert("未登录，请先登录",function(){location.href=login_url;});
					
				}
				if (data.info) {
					$.toast(data.info);
				}

		        $(".pay_info").html(data.html);
	                        
				ajaxing = false;
			}
		});
	        
	}
	function init_pay_btn(){
	    $(".u-sure-pay").bind("click",function(){
	        var payment = $("input[name='payment']:checked").val();
	        var bank_id=0;
	        if(payment>0 || $("input[name='all_account_money']").attr("checked")){

	        	var query = new Object();
	        	if($("input[name='all_account_money']").attr("checked")) {
	        		query.all_account_money = 1;
	        	} else {
	        		query.all_account_money = 0;
	        	}
	            query.order_id = order_id;
	            query.bank_id = bank_id;
	            query.payment = payment;
	            query.act = "done";
	            $.ajax({
	                url:custom_ajax_url,
	                data:query,
	                type:"POST",
	                dataType:"json",
	                success:function(data){	                	

	    				if(data.status==1){

	    					if(data.app_index=='wap' ){  //SKD支付做好后，用 App.pay_sdk支付
	    						if(data.pay_status==1){
	    							$.router.load(data.jump, true);
	    						}else{
	    							location.href=data.jump;
	    						}
	    					} else if( data.app_index=='app' && data.pay_status==1){  //APP余额支付
	    						 $.router.load(data.jump, true);

	    					} else if( data.app_index=='app' && data.pay_status==0){  //APP第三方支付
	    						if(data.online_pay==3){
	    							try {

	    								var str = pay_sdk_json(data.sdk_code);
	    								App.pay_sdk(str);
	    							} catch (ex) {
	    								$.toast(ex);
	    								$.loadPage(location.href);
	    							}
	    						}else{
	    							var pay_json = '{"open_url_type":"1","url":"'+data.jump+'","title":"'+data.title+'"}';

	    							try {
	    								App.open_type(pay_json);
	    								$.confirm('已支付完成？', function () {
	    									$.loadPage(location.href);

	    								},function(){

	    									$.loadPage(location.href);
	    								});
	    							} catch (ex) {
	    								$.toast(ex);
	    								$.loadPage(location.href);
	    							}
	    						}
	    					}



	    				}else{
	    					
	    					$.alert(data.info);
	    				}
	    			
	                }			
	            });
	        }else{
	            $.toast("请选择支付方式");
	        }
	    });
	}
});

$(document).on("pageInit", "#store_reviews", function(e, pageId, $page) {
	init_list_scroll_bottom();
});
$(document).on("pageInit", "#store_shop", function(e, pageId, $page) {
	$(document).on("click",".dropdown-navlist",function() {
		screen_bar_close();
	});
	$(".m-screen-bar").on("click",".screen-link",function() {
		screen_bar_close();
		$(".screen-link").removeClass('active');
		$(this).addClass('active');
	});
	//筛选
	//标签
	$(".m-screen-bar").on("click",".screen-item a",function(){
		$(".arrow-up").hide();
		$(".arrow-down").show();
		$(".m-screen-list").removeClass('active');
		$(".goods-type li").removeClass('active');
	});
	//全部
	function screen_open() {
		$(".content").css('overflow', 'hidden');
		$(".m-screen-list").addClass('active');
	}
	function screen_close() {
		$(".content").css('overflow', 'auto');
		$(".m-screen-list").removeClass('active');
	}
	$(".m-screen-bar").on("click",".screen-all",function() {
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
			screen_close();
			$("#all-goods").removeClass('active');
		} else {
			$(this).addClass('active');
			$(".screen-area").removeClass('active');
			$("#area-screen").removeClass('active');
			$(this).find('.arrow-down').hide();
			$(this).find('.arrow-up').show();
			screen_open();
			$("#all-goods").addClass('active');
			$("#all-goods .goods-type li").eq($(this).attr("data-cid")).addClass('active');
			$("#all-goods .type-detail ul").eq($(this).attr("data-cid")).show();
		}
	});
	$(".m-screen-list").on("click",".goods-type li",function() {
		$(".goods-type li").removeClass('active');
		$(this).addClass('active');
		$(".type-detail ul").hide();
		if ($(".goods-type li").hasClass('active')) {
			var type_id = $(this).attr('data-id');
			$(this).parent().parent().find(".type-detail ul").eq(type_id).show();
		}
	});
	$("#all-goods").on('click', '.type-detail li a', function() {
		$("#all-goods .type-detail li a").removeClass('active');
		$(this).addClass('active');
		$(".screen-all p").html($(this).find('p').html());
		$(".screen-all").attr('data-cid', $(this).parent().parent().attr("data-id"));
		$(".screen-link").removeClass('active');
	});
	$("#all-goods").on('click', '.type-detail li:first-child a', function() {
		var type_id = $(this).parent().parent().attr('data-id');
		$(".screen-all p").html($("#all-goods .goods-type li").eq(type_id).html());
	});
	//全城
	$(".m-screen-bar").on("click",".screen-area",function() {
		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
			screen_close();
			$("#area-screen").removeClass('active');
		} else {
			$(this).addClass('active');
			$(this).find('.arrow-down').hide();
			$(this).find('.arrow-up').show();
			$(".screen-all").removeClass('active');
			$("#all-goods").removeClass('active');
			screen_open();
			$("#area-screen").addClass('active');
			$(".goods-type li").removeClass('acitve');
			$("#area-screen .goods-type li").eq($(this).attr("data-qid")).addClass('active');
			$("#area-screen .type-detail ul").eq($(this).attr("data-qid")).show();
		}
	});
	$("#area-screen").on('click', '.type-detail li a', function() {
		$("#area-screen .type-detail li a").removeClass('active');
		$(this).addClass('active');
		$(".screen-area p").html($(this).find('p').html());
		$(".screen-area").attr('data-qid', $(this).parent().parent().attr("data-id"));
		$(".screen-link").removeClass('active');
	});
	$("#area-screen").on('click', '.type-detail li:first-child a', function() {
		var type_id = $(this).parent().parent().attr('data-id');
		$(".screen-area p").html($("#area-screen .goods-type li").eq(type_id).html());
	});


	$(document).off("click",".j-listchoose");
	$(document).on("click",".j-listchoose",function() {
		var url=$(this).attr("date-href");
		var nidate="<div class='tipimg no_data'>"+"没有数据啦"+"</div>";
		$.ajax({
			url:url,
			type:"POST",
			success:function(html)
			{
				$(".j-ajaxlist").html($(html).find(".j-ajaxlist").html());
				$(".j-pj").html($(html).find(".j-pj").html());
				$(".j-jg").html($(html).find(".j-jg").html());
				$(".j-zj").html($(html).find(".j-zj").html());
				$(".j-zx").html($(html).find(".j-zx").html());
				if ($(html).find(".j-ajaxlist").html()==null) {
					$(".j-ajaxlist").html(nidate);
				}else{
					init_list_scroll_bottom();
				};
				if ($("#type-cube").css('display')=='none') {
					$(".m-goods-list ul").addClass('type-list').removeClass('type-cube');
				}
				if ($("#type-list").css('display')=='none') {
					$(".m-goods-list ul").removeClass('type-list').addClass('type-cube');
				}
			},
			error:function()
			{
				$.toast("加载失败咯~");
			}
		});
		$.showIndicator();
		setTimeout(function () {
			$.hideIndicator();
		}, 800);
		screen_bar_close();
	});
});

$(document).on("pageInit", "#supplier_register_add", function (e, pageId, $page) {
    select_box($(".j-cate-select"), $(".j-cate-box"));
    $(".j-select-cate").on('click', function () {
        $(".supplier-bar .j-cate").html($(this).find('.j-cate').html());
        $("input[name=deal_cate_id]").val($(this).attr("value"));
    });
    function bind_select(){
        $(".j-open-address").on('click', function () {
            var $me = $(this);
            var region = '';
            var r2id = $('select[name="region_lv2"]').val(); // 获取地区的信息先定位地图
            if (r2id != 0) {
                region += $('option[value="' + r2id + '"]').html();
            } else {
                $.toast('请先选择省市区信息');
                return;
            }
            var r3id = $('select[name="region_lv3"]').val();
            if (r3id != 0) {
                region += $('option[value="' + r3id + '"]').html();
            } else {
                $.toast('请先选择省市区信息');
                return;
            }
            var r4id = $('select[name="region_lv4"]').val();
            if (r4id != 0) {
                region += $('option[value="' + r4id + '"]').html();
            }

            load_baidu_pick(region);
            $.popup('.address-popup');
        });
    }
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        window.HOST_TYPE = "2";
        window.BMap_loadScriptTime = (new Date).getTime();
        js.src = script_region_url;
        fjs.parentNode.insertBefore(js, fjs);
        js.onload=function(){
            bind_select();
        };
    }(document, 'script', 'script_region'));

    init_form_submit_wqx();

   init_supplier_register_add_region_ui_change();

    function init_form_submit_wqx(){
        $(".user_register_btn.active").bind("click",function(){
            $(this).removeClass("active");
            var $form=$("form[name=user_register_form]");
            var is_error = 1;
            var error_msg = '';
            if($("input[name=name]").val() == "") {
                error_msg = "商户名不能为空！";
            }else if(!$("input[name=h_license]").val()) {
                error_msg = "营业执照不能为空！";
            }else if(!$("input[name=h_supplier_logo]").val()) {
                error_msg = "商户图标不能为空！";
            }else if(!$("input[name=h_supplier_image]").val()) {
                error_msg = "门店图片不能为空！";
            }else if(!$("select[name=region_lv2]").val()){
                error_msg = "省份不能为空！";
            }else if(!$("select[name=region_lv3]").val()){
                error_msg = "城市不能为空！";
            }else if(!$("input[name=address]").val()){
                error_msg = "商户地址不能为空！";
            }else if($("#sms_verify").val()==""){
                error_msg = "验证码不能为空！";
            }else if($("input[name=name]").val()==""){
                error_msg = "商户名不能为空！";
            }else if($("input[name=deal_cate_id]").val()==""){
                error_msg = "所属分类不能为空！";
            }else if($("input[name=mobile]").val() == "") {
                error_msg = "请输入手机号！";
            }else if(!$("input[name=h_bank_name]").val()){
                error_msg = "请输入开户银行！";
            }else if(!$("input[name=h_bank_user]").val()){
                error_msg = "请输入银行卡开户人名称！";
            }else if(!$("input[name=h_bank_info]").val()){
                error_msg = "请输入银行卡号码！";
            }else{
                is_error=0;
            }

            if(is_error == 1) {
                $.toast(error_msg);
                return false;
            }
            var url = $form.attr("action");
            var query =$form.serialize();
            $.ajax({
                url : url,
                type : "POST",
                data : query,
                dataType : "json",
                success : function(data) {
                    if(data.status) {
                        $.toast(data.info);
                        setTimeout(function(){
                            if(data.jump){
                                $.router.load(data.jump, true);
                            }
                            $("#user_register_btn.active").addClass("active");
                        },1000);
                    } else {
                        $.toast(data.info);
                        setTimeout(function(){
                            if(data.jump){
                                $.router.load(data.jump, true);
                            }
                            $("#user_register_btn.active").addClass("active");
                        },1000);
                    }

                }
            });
        });
    }
    function load_baidu_pick(region) {

        // 百度地图API功能
        var map = new BMap.Map("baidu_allmap");
//        var orx = $('input[name="xpoint"]').val();
//        var ory = $('input[name="ypoint"]').val();
        var point = new BMap.Point(0, 0);
        map.centerAndZoom(point, 16);
        map.enableScrollWheelZoom(true);
        var myValue = '';

        var geoc = new BMap.Geocoder();


            myValue = region;
            setPlace();


        map.addEventListener('moveend', getLoc); // 移动结束检索地区
        function getLoc() {
            var p = map.getCenter();
            geoc.getLocation(p, function (rs) {
                var addComp = rs.addressComponents;
                var lstr = /*addComp.province + addComp.city + addComp.district +*/ addComp.street + addComp.streetNumber;
                var sstr = addComp.street ? addComp.street : addComp.district;
                var surrPois = rs.surroundingPois;
                var cx = rs.point.lng;
                var cy = rs.point.lat;
                var res = '<div class="r-loca">';
                res += '<div class="b-line baidu-select-address click-select-address selected close-popup" title="'+sstr+'" address="'+lstr+'" xpoint="'+cx+'" ypoint="'+cy+'" ><li class="loca-curr"><h3><i class="search-icon iconfont">&#xe62f;</i><em>[当前]</em>' + sstr + '</h3><p class="loca-curr">' + lstr + '</p></li></div>';
                if (surrPois) {
                    for (i in surrPois) {
                        var x = surrPois[i].point.lng;
                        var y = surrPois[i].point.lat;
                        res += '<div class="b-line baidu-select-address click-select-address close-popup" title="'+surrPois[i]['title']+'" address="'+surrPois[i]['address']+'" xpoint="'+x+'" ypoint="'+y+'"><li><h3><i class="search-icon iconfont">&#xe62f;</i>' + surrPois[i]['title'] + '</h3><p>' + surrPois[i]['address'] + '</p></li></div>';
                    }
                }
                res += '</div>'
                $('#baidu-m-result').html(res);
            });
        }
        $(".click-select-address").live("click",function(){
            if($(this).hasClass("baidu-select-address")){
                var $selected=$(this);
            }else{
                var $selected=$(".baidu-select-address.selected");
            }
            var addr=$selected.attr('address');
            var patt = /^([^(]*?省|)([^(]*?市|)([^(]*?(区|县)|)(.*)/;
            var mat = addr.match(patt);
            var addr1 = mat.pop();
            $('input[name="address"]').val(addr1);
            $('input[name="street"]').val($selected.attr("title"));
            $('input[name=xpoint]').val($selected.attr("xpoint"));
            $('input[name=ypoint]').val($selected.attr("ypoint"));
        });
//        $(".baidu-select-address").live("click",function(){
//            $(".baidu-select-address").removeClass("selected");
//            $(this).addClass("selected");
//            $(".close-popup").trigger("click");
//        });

        // 搜索方法
        var ac = new BMap.Autocomplete({'input': 'suggestId', 'location': map});
        ac.addEventListener('onhighlight', function (e) {
            var str = '';
            var _value = e.fromitem.value;
            var value = '';
            if (e.fromitem.index > -1) {
                value = _value.province + _value.city + _value.district + _value.street;
            }
            str = "FromItem<br />index = " + e.fromitem.index + "<br />value= " + value;

            value = "";
            if (e.toitem.index > -1) {
                _value = e.toitem.value;
                value = _value.province + _value.city + _value.district + _value.street + _value.business;
            }
            str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
            $("#baidu_searchResultPanel").html(str);
        });


        ac.addEventListener("onconfirm", function (e) {    //鼠标点击下拉列表后的事件
            var _value = e.item.value;
            myValue = _value.province + _value.city + _value.district + _value.street + _value.business;
            $("#baidu_searchResultPanel").html("onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue);
            setPlace();
        });

        function setPlace() {
            function myFun() {
                var pp = local.getResults().getPoi(0);    //获取第一个智能搜索的结果
                if (!pp) {
                    $.toast('地址查询错误');
                    setTimeout(function () {
                        // var pro = myValue.substr(0, myValue.indexOf('省'));
                        // console.log(pro);
                        map.centerAndZoom('北京', 12);
                    }, 2000);

                    return;
                }
                map.centerAndZoom(pp.point, 18);
            }

            var local = new BMap.LocalSearch(map, { //智能搜索
                onSearchComplete: myFun
            });
            // local.clearResults();
            local.search(myValue);
        }

        // 添加定位控件
        var geolocationControl = new BMap.GeolocationControl({
            // 靠左上角位置
            anchor: BMAP_ANCHOR_BOTTOM_LEFT,
            // 是否显示定位信息面板
            showAddressBar: false,
            // 启用显示定位
            enableGeolocation: true
        });
        geolocationControl.addEventListener("locationSuccess", function (e) {
            // 定位成功事件
            /*var address = '';
             address += e.addressComponent.province;
             address += e.addressComponent.city;
             address += e.addressComponent.district;
             address += e.addressComponent.street;
             address += e.addressComponent.streetNumber;
             alert("当前定位地址为：" + address);*/
        });
        geolocationControl.addEventListener("locationError", function (e) {
            // 定位失败事件
            alert(e.message);
        });
        map.addControl(geolocationControl);

    }
    // 上传图片。
    $('.upload-image').bind('change', function() {
        var $me=$(this);
        var upName=$me.attr('up-name');
        lrz(this.files[0], {width: 200})
            .then(function(rst) {
                // 处理上传到后端的逻辑
                rst.formData.append('fileLen', rst.fileLen);
                $.ajax({
                    url: UPLOAD_URL,
                    data: rst.formData,
                    processData: false,
                    contentType: false,
                    dataType:"json",
                    type: 'POST',
                    success: function(obj) {
                        var data = obj;
                        if (data.error == 1000) {
                            $.router.load(LOGIN_URL, true);
                        } else if (data.error == 2000) {
                            $.toast('图片上传发生错误,跟换浏览器重试');
                        } else if (data.error > 0) {
                            $.toast('图片上传发生错误');
                        } else {
                            $('img[up-name='+upName+']').attr('src',data.absolute_url);
                            $('input[name='+upName+']').val(data.url);
                            $.toast('图片上传成功');
                        }
                    },
                    error: function(msg) {
                        $.toast('网络被风吹走了～');
                    }
                })
            })
            .catch(function(err) {
                // 捕获错误
                $.toast('数据异常,请重试');
            })
            .always(function() {
                // 总是会发生。要发生什么
            });
    });
    $(".app-upload-image").bind("click",function () {
        var $me=$(this);
        var upName=$me.attr('up-name');
        try{
            App.UploadImg(upName);
        }catch(e){
            $.alert(JSON.stringify(e));
        }

    });
    function init_supplier_register_add_region_ui_change() {
        $("select[name='region_lv2']").bind("change", function () {
            var id = $(this).val();
            $.post(load_city_url,{id:id},function(data){
                $("select[name='region_lv3']").html(data);
                if($("select[name='region_lv3']").find("option").length<2){
                    $("select[name='region_lv3']").hide();
                    $("select[name='region_lv4']").hide();
                }else{
                    $("select[name='region_lv3']").show();
                    $("select[name='region_lv4']").html("<option value='0'>==选择区县==</option>");
                }
            })
        });
        $("select[name='region_lv3']").bind("change", function () {
            var id = $(this).val();
            $.post(load_area_url,{id:id},function(data){
                $("select[name='region_lv4']").html(data);
                if($("select[name='region_lv4']").find("option").length<2){
                    $("select[name='region_lv4']").hide();
                }else{
                    $("select[name='region_lv4']").show();
                }
            })
        });
    }
});
$(document).on("pageInit", "#supplier_register_edit", function (e, pageId, $page) {
    select_box($(".j-cate-select"), $(".j-cate-box"));
    $(".j-select-cate").on('click', function () {
        $(".supplier-bar .j-cate").html($(this).find('.j-cate').html());
        $("input[name=deal_cate_id]").val($(this).attr("value"));
    });
    function bind_select(){
        $(".j-open-address").on('click', function () {
            var $me = $(this);
            var region = '';
            var r2id = $('select[name="region_lv2"]').val(); // 获取地区的信息先定位地图
            if (r2id != 0) {
                region += $('option[value="' + r2id + '"]').html();
            } else {
                $.toast('请先选择省市区信息');
                return;
            }
            var r3id = $('select[name="region_lv3"]').val();
            if (r3id != 0) {
                region += $('option[value="' + r3id + '"]').html();
            } else {
                $.toast('请先选择省市区信息');
                return;
            }
            var r4id = $('select[name="region_lv4"]').val();
            if (r4id != 0) {
                region += $('option[value="' + r4id + '"]').html();
            }

                load_baidu_pick(region);



            $.popup('.address-popup');
        });
    }
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        window.HOST_TYPE = "2";
        window.BMap_loadScriptTime = (new Date).getTime();
        js.src = script_region_url;
        fjs.parentNode.insertBefore(js, fjs);
        js.onload=function(){
            bind_select();
        };
    }(document, 'script', 'script_region'));

    init_form_submit_wqx();
    init_supplier_register_add_region_ui_change();
    function init_form_submit_wqx(){
        $(".user_register_btn.active").bind("click",function(){
            $(this).removeClass("active");
            var $form=$("form[name=user_register_form]");
            var is_error = 1;
            var error_msg = '';
            if($("input[name=name]").val() == "") {
                error_msg = "商户名不能为空！";
            }else if(!$("input[name=h_license]").val()) {
                error_msg = "营业执照不能为空！";
            }else if(!$("input[name=h_supplier_logo]").val()) {
                error_msg = "商户图标不能为空！";
            }else if(!$("input[name=h_supplier_image]").val()) {
                error_msg = "门店图片不能为空！";
            }else if(!$("select[name=region_lv2]").val()){
                error_msg = "省份不能为空！";
            }else if(!$("select[name=region_lv3]").val()){
                error_msg = "城市不能为空！";
            }else if(!$("input[name=address]").val()){
                error_msg = "商户地址不能为空！";
            }else if($("#sms_verify").val()==""){
                error_msg = "验证码不能为空！";
            }else if($("input[name=name]").val()==""){
                error_msg = "商户名不能为空！";
            }else if($("input[name=deal_cate_id]").val()==""){
                error_msg = "所属分类不能为空！";
            }else if($("input[name=mobile]").val() == "") {
                error_msg = "请输入手机号！";
            }else if(!$("input[name=h_bank_name]").val()){
                error_msg = "请输入开户银行！";
            }else if(!$("input[name=h_bank_user]").val()){
                error_msg = "请输入银行卡开户人名称！";
            }else if(!$("input[name=h_bank_info]").val()){
                error_msg = "请输入银行卡号码！";
            }else{
                is_error=0;
            }

            if(is_error == 1) {
                $.toast(error_msg);
                return false;
            }
            var url = $form.attr("action");
            var query =$form.serialize();
            $.ajax({
                url : url,
                type : "POST",
                data : query,
                dataType : "json",
                success : function(data) {
                    if(data.status) {
                        $.toast(data.info);
                        setTimeout(function(){
                            if(data.jump){
                                $.router.load(data.jump, true);
                            }
                            $("#user_register_btn.active").addClass("active");
                        },1000);
                    } else {
                        $.toast(data.info);
                        setTimeout(function(){
                            if(data.jump){
                                $.router.load(data.jump, true);
                            }
                            $("#user_register_btn.active").addClass("active");
                        },1000);
                    }

                }
            });
        });
    }
    function load_baidu_pick(region) {

        // 百度地图API功能
        var map = new BMap.Map("baidu_allmap");

//        var orx = $('input[name="xpoint"]').val();
//        var ory = $('input[name="ypoint"]').val();
        var point = new BMap.Point(0, 0);
        map.centerAndZoom(point, 16);
        map.enableScrollWheelZoom(true);
        var myValue = '';

        var geoc = new BMap.Geocoder();

//        if (orx && ory) {
//            map.panTo(new BMap.Point(orx, ory));
//            getLoc();
//        } else {
            myValue = region;
            setPlace();
//        }

        map.addEventListener('moveend', getLoc); // 移动结束检索地区
        function getLoc() {
            var p = map.getCenter();
            geoc.getLocation(p, function (rs) {
                var addComp = rs.addressComponents;
                var lstr = /*addComp.province + addComp.city + addComp.district +*/ addComp.street + addComp.streetNumber;
                var sstr = addComp.street ? addComp.street : addComp.district;
                var surrPois = rs.surroundingPois;
                var cx = rs.point.lng;
                var cy = rs.point.lat;
                var res = '<div class="r-loca">';
                res += '<div class="b-line baidu-select-address click-select-address  selected close-popup" title="'+sstr+'" address="'+lstr+'" xpoint="'+cx+'" ypoint="'+cy+'" ><li class="loca-curr"><h3><i class="search-icon iconfont">&#xe62f;</i><em>[当前]</em>' + sstr + '</h3><p class="loca-curr">' + lstr + '</p></li></div>';
                if (surrPois) {
                    for (i in surrPois) {
                        var x = surrPois[i].point.lng;
                        var y = surrPois[i].point.lat;
                        res += '<div class="b-line baidu-select-address click-select-address close-popup" title="'+surrPois[i]['title']+'" address="'+surrPois[i]['address']+'" xpoint="'+x+'" ypoint="'+y+'"><li><h3><i class="search-icon iconfont">&#xe62f;</i>' + surrPois[i]['title'] + '</h3><p>' + surrPois[i]['address'] + '</p></li></div>';
                    }
                }
                res += '</div>'
                $('#baidu-m-result').html(res);
            });
        }
        $(".click-select-address").live("click",function(){
            if($(this).hasClass("baidu-select-address")){
                var $selected=$(this);
            }else{
                var $selected=$(".baidu-select-address.selected");
            }
            var addr=$selected.attr('address');
            var patt = /^([^(]*?省|)([^(]*?市|)([^(]*?(区|县)|)(.*)/;
            var mat = addr.match(patt);
            var addr1 = mat.pop();
            $('input[name="address"]').val(addr1);
            $('input[name="street"]').val($selected.attr("title"));
            $('input[name=xpoint]').val($selected.attr("xpoint"));
            $('input[name=ypoint]').val($selected.attr("ypoint"));
        });

        // 搜索方法
        var ac = new BMap.Autocomplete({'input': 'suggestId', 'location': map});
        ac.addEventListener('onhighlight', function (e) {
            var str = '';
            var _value = e.fromitem.value;
            var value = '';
            if (e.fromitem.index > -1) {
                value = _value.province + _value.city + _value.district + _value.street;
            }
            str = "FromItem<br />index = " + e.fromitem.index + "<br />value= " + value;

            value = "";
            if (e.toitem.index > -1) {
                _value = e.toitem.value;
                value = _value.province + _value.city + _value.district + _value.street + _value.business;
            }
            str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
            $("#baidu_searchResultPanel").html(str);
        });


        ac.addEventListener("onconfirm", function (e) {    //鼠标点击下拉列表后的事件
            var _value = e.item.value;
            myValue = _value.province + _value.city + _value.district + _value.street + _value.business;
            $("#baidu_searchResultPanel").html("onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue);
            setPlace();
        });

        function setPlace() {
            function myFun() {
                var pp = local.getResults().getPoi(0);    //获取第一个智能搜索的结果
                if (!pp) {
                    $.toast('地址查询错误');
                    setTimeout(function () {
                        // var pro = myValue.substr(0, myValue.indexOf('省'));
                        // console.log(pro);
                        map.centerAndZoom('北京', 12);
                    }, 2000);

                    return;
                }
                map.centerAndZoom(pp.point, 18);
            }

            var local = new BMap.LocalSearch(map, { //智能搜索
                onSearchComplete: myFun
            });
            // local.clearResults();
            local.search(myValue);
        }

        // 添加定位控件
        var geolocationControl = new BMap.GeolocationControl({
            // 靠左上角位置
            anchor: BMAP_ANCHOR_BOTTOM_LEFT,
            // 是否显示定位信息面板
            showAddressBar: false,
            // 启用显示定位
            enableGeolocation: true
        });
        geolocationControl.addEventListener("locationSuccess", function (e) {
            // 定位成功事件
            /*var address = '';
             address += e.addressComponent.province;
             address += e.addressComponent.city;
             address += e.addressComponent.district;
             address += e.addressComponent.street;
             address += e.addressComponent.streetNumber;
             alert("当前定位地址为：" + address);*/
        });
        geolocationControl.addEventListener("locationError", function (e) {
            // 定位失败事件
            alert(e.message);
        });
        map.addControl(geolocationControl);

    }
    // 上传图片。
    $('.upload-image').bind('change', function() {
        var $me=$(this);
        var upName=$me.attr('up-name');
        lrz(this.files[0], {width: 200})
            .then(function(rst) {
                // 处理上传到后端的逻辑
                rst.formData.append('fileLen', rst.fileLen);
                $.ajax({
                    url: UPLOAD_URL,
                    data: rst.formData,
                    processData: false,
                    contentType: false,
                    dataType:"json",
                    type: 'POST',
                    success: function(obj) {
                        var data = obj;
                        if (data.error == 1000) {
                            $.router.load(LOGIN_URL, true);
                        } else if (data.error == 2000) {
                            $.toast('图片上传发生错误,跟换浏览器重试');
                        } else if (data.error > 0) {
                            $.toast('图片上传发生错误');
                        } else {
                            $('img[up-name='+upName+']').attr('src',data.absolute_url);
                            $('input[name='+upName+']').val(data.url);
                            $.toast('图片上传成功');
                        }
                    },
                    error: function(msg) {
                        $.toast('网络被风吹走了～');
                    }
                })
            })
            .catch(function(err) {
                // 捕获错误
                $.toast('数据异常,请重试');
            })
            .always(function() {
                // 总是会发生。要发生什么
            });
    });
    $(".app-upload-image").bind("click",function () {
        var $me=$(this);
        var upName=$me.attr('up-name');
        App.UploadImg(upName);
    });
    function init_supplier_register_add_region_ui_change() {
        $("select[name='region_lv2']").bind("change", function () {
            var id = $(this).val();
            $.post(load_city_url,{id:id},function(data){
                $("select[name='region_lv3']").html(data);
                if($("select[name='region_lv3']").find("option").length<2){
                    $("select[name='region_lv3']").hide();
                    $("select[name='region_lv4']").hide();
                }else{
                    $("select[name='region_lv3']").show();
                    $("select[name='region_lv4']").html("<option value='0'>==选择区县==</option>");
                }
            })
        });
        $("select[name='region_lv3']").bind("change", function () {
            var id = $(this).val();
            $.post(load_area_url,{id:id},function(data){
                $("select[name='region_lv4']").html(data);
                if($("select[name='region_lv4']").find("option").length<2){
                    $("select[name='region_lv4']").hide();
                }else{
                    $("select[name='region_lv4']").show();
                }
            })
        });
    }

});

$(document).on("pageInit", "#tuan", function(e, pageId, $page) {
	screen_bar();
	init_list_scroll_bottom();//下拉刷新加载
	//
	//星星评分
	//$(".tuan-item").each(function(){
	//    $(this).find(".start-num").css("width",$(this).find(".start-num").parent().parent().attr("data")+"%");
	//});
	//隐藏数量为0的2级分类
	$(".goods-num").filter(function(index){
		if($(this).parent().attr("data-cid")=='0'&&$(this).parent().attr("data-tid")=='0')
			return false;
　　　　return $(this).text()=="0";
　　	}).parent().hide();

	//团购列表展开
	$(document).on("click",".tuan-list-more",function() {
		var height = $(this).parent().find('.tuan-list li').height();
		var num = $(this).parent().find('.tuan-list li').length;
		$(this).parent().find('.tuan-list').css('max-height', height*num);
		$(this).hide();
	});
	if(address==""){
		//if(navigator.geolocation)
		//{
			 //var geolocationOptions={timeout:10000,enableHighAccuracy:true,maximumAge:5000};
			 //navigator.geolocation.getCurrentPosition(getPositionSuccess, getPositionError, geolocationOptions);
			 
		//}
		position();
	}
	$(document).on("click",".address-info",function() {
		$(".refresh").addClass('rotate');
		//if(navigator.geolocation)
		//{
		//	 var geolocationOptions={timeout:10000,enableHighAccuracy:true,maximumAge:5000};
		//	 navigator.geolocation.getCurrentPosition(getPositionSuccess, getPositionError, geolocationOptions);
		//}
		position();
	});
	
	function getPositionSuccess(p){
		has_location = 1;//定位成功;
	    m_latitude = p.coords.latitude; //纬度
	    m_longitude = p.coords.longitude;
		userxypoint(m_latitude, m_longitude);
	}

	function getPositionError(error){
		switch(error.code){
		    case error.TIMEOUT:
		    	$(".address").html("<i class='iconfont'>&#xe62f;</i>定位连接超时，请重试");
		    	$(".refresh").removeClass('rotate');
		    	//setCookie("cancel_geo",0,1);
		        //alert("定位连接超时，请重试");
		        break;
		    case error.PERMISSION_DENIED:
		    	$(".address").html("<i class='iconfont'>&#xe62f;</i>您拒绝了使用位置共享服务，查询已取消");
		    	$(".refresh").removeClass('rotate');
		    	//setCookie("cancel_geo",0,1);
		        //alert("您拒绝了使用位置共享服务，查询已取消");
		        break;
		    default:
		    	$(".address").html("<i class='iconfont'>&#xe62f;</i>定位失败");
		    	$(".refresh").removeClass('rotate');
		    	//setCookie("cancel_geo",0,1);
		    	//alert("定位失败");
		}
	}
});


$(document).on("pageInit", "#uc_account", function(e, pageId, $page) {
	$(".progress-bar-inner").each(function() {
		var progress_width = $(this).attr('data-width');
		$(this).css('width', progress_width);
	});

	// 修改密码前先验证用户是否已绑定手机号
	$('.bindphone').bind('click', function() {
		if (($('input[name=phone]').val() != 1)) {
			$.toast('请先绑定手机号');
			$.router.load($(this).attr('phone-href'));
		} else {
			$.router.load($(this).attr('href-data'));
		}
	});
	//请求绑定微信，获得微信授权
	if(is_weixin_bind){
		js_weixin_login("",1);
	}
	//解绑微信
	$('.wx_unbind').bind('click', function () {
		
		var ajax_url = $(this).attr("action");
		var query = '';
		$.ajax({
			url:ajax_url,
			data:query,
			type:"POST",
			dataType:"json",
			success:function(obj){
				if(obj.status)
				{
					$.toast(obj.info);
					if(obj.jump){
						$.loadPage(REFRESH_URL);
						//location.href=REFRESH_URL;
						//$.router.load(obj.jump,true);
					}		
				}
				else
				{
					$.toast(obj.info);
					if(obj.jump){
						$.router.load(obj.jump,true);
					}
							
				}
			}
		});
		
		return false;
	});


	// 修改头像。
	$('#up_avatar').bind('change', function() {
		lrz(this.files[0], {width: 200})
			.then(function(rst) {
				// 处理上传到后端的逻辑
				rst.formData.append('fileLen', rst.fileLen);

				$.ajax({
					url: UPLOAD_URL,
					data: rst.formData,
					processData: false,
					contentType: false,
					type: 'POST',
					success: function(obj) {
						var data = JSON.parse(obj);
						if (data.error == 1000) {
							$.router.load(LOGIN_URL, true);
						} else if (data.error == 2000) {
							$.toast('图片上传发生错误,跟换浏览器重试');
						} else if (data.error > 0) {
							$.toast('图片上传发生错误');
						} else {
							$('#user_avatar').attr('src', rst.base64);
							$.toast('头像已修改');
						}
					},
					error: function(msg) {
						$.toast('网络被风吹走了～');
					}
				})
			})
			.catch(function(err) {
				// 捕获错误
				$.toast('数据异常,请重试');
			})
			.always(function() {
				// 总是会发生。要发生什么
			});
	});
	$("#app_up_avatar").on("click",function () {
		App.CutPhoto();
	});

});





$(document).on("pageInit", "#uc_account_phone", function(e, pageId, $page) {
	$('.userBtn').on('click', function(){

		$("form").submit( function () {
			return false;
		});
		
		var mobile = $('input[name=mobile]').val();
		var sms_verify = $('input[name=sms_verify]').val();

		if ($.trim(mobile) == '') {
			$.toast('请输入要绑定的手机号码');
			return false;
		}
		if ($.trim(sms_verify) == '') {
			$.toast('请输入收到的验证码');
			return false;
		}

		if (!/^[0-9]{6}$/.test(sms_verify)) {
			$.toast('验证码格式有误');
			return false;
		} else if (!/^1[34578][0-9]{9}/.test(mobile)) {
			$.toast('手机格式有误');
			return false;
		}

		var step = $('input[name=step]').val();
		if (!/^\d$/.test(step)) {
			$.alert('网络异常请刷新重试', function() {
				window.location.reload();
				return false;
			})
			
		}
		var is_luck = $('input[name=is_luck]').val();
		var query = new Object();
		query.mobile = mobile;
		query.sms_verify = sms_verify;
		var is_fx = $('input[name=is_fx]').val();
		query.is_fx = is_fx;
		query.step = step;
		if(step==2)
			query.is_luck = is_luck;
		query.act = 'bindPhone';
		$.ajax({
			url: bind_url,
			data: query,
			dataType: "json",
			type: "post",
			success: function(obj){
				if(obj.user_login_status==0){
					$.alert(obj.info,function(){
						$.router.load(obj.jump);
					});
				} else if(obj.status == 0) {
					$.toast(obj.info);
				} else {
					// 处理页面跳转逻辑
					if (step == 2) { // 绑定成功跳掉用户中心
						// $('.sendBtn').attr('lesstime', 0);
						// $.alert(obj.info, function() {
						// 	window.location.href = obj.jump;
						// });
						$.toast(obj.info);
						setTimeout(function() {
			                // $.router.load(obj.jump, true);
			                // 跳转回上一页
			                if (obj.jump) {
			                	$.router.load(obj.jump, true);
			                } else if (referer_url) {
			                	$.router.load(referer_url, true);
			                } else {
			                	$.router.back();
			                }
			            }, 2000);
					} else { // 绑定新的手机号码
						$('input[name=mobile]').attr('type','tel');
						$('input[name=mobile]').attr('value', '');
						$('input[name=format_mobile]').attr('type','hidden');
						
						$('input[name=mobile]').val('');
						$('input[name=mobile]').attr('placeholder', '请输入新的手机号码');
						$('input[name=sms_verify]').val('');
						$('.title').text(obj.page_title);
						$('input[name=step]').attr('value', 2);
						$('.sendBtn').removeClass("isUseful");
						$('.sendBtn').addClass("noUseful");
						$('.sendBtn').attr('lesstime', 0);
						$('input[name=is_luck]').attr('value', obj.is_luck);
						$('.sendBtn').attr('unique',4);

						$('.userBtn').val('确定');
					}
				}
				
			},
			error:function(ajaxobj) {
				$.toast('网络异常');
			}
		});
	})
})

$(document).on("pageInit", "#uc_banklist", function(e, pageId, $page) {
	
	$('.del').on('click', function () {
		var obj = $(this);
		var id = new Array();
		var id = obj.parents("li").attr("data-id");
//		alert(id);
		$.confirm('确定删除这张银行卡？', function () {
		  del_bank(id);
		  obj.parents("li").remove();
		});
	});

	function del_bank(id){
		var query = new Object();
		query.id = id;
			$.ajax({
				url: ajax_url,
				data: query,
				dataType: "json",
				type: "POST",
				success: function(obj){
					
					$.toast(obj.info);
		//			if(obj.status==0 && obj.user_login_status==0){
		//				$.alert(obj.info,function(){
		//					window.location.href=obj.jump;
		//				});
		//			}
		//			if(obj.status == 1){
		//				$.toast(obj.info);
		//				//setTimeout("location.reload()",1000);
		//				
		//			}
				},
				error:function(ajaxobj)
				{
					
		//			if(ajaxobj.responseText!='')
		//			alert(ajaxobj.responseText);
				}
		});
	}
});

$(document).on("pageInit", "#uc_charge", function(e, pageId, $page) {

	$("form[name='do_charge']").bind("submit",function(){

		var money = $("input[name='money']").val();
		var payment_id = $("input[name='payment_id']:checked").val();		

		if($.trim(payment_id)==""||isNaN(payment_id)||parseFloat(payment_id)<=0)
		{
			$.alert("请选择支付方式");
			return false;
		}
		
		if($.trim(money)==""||isNaN(money)||parseFloat(payment_id)<=0)
		{
			$.alert("请选择正确的充值金额");
			return false;
		}		
		
		
		var query = $(this).serialize();
		var action = $(this).attr("action");

		$.ajax({
			url:action,
			data:query,
			type:"POST",
			dataType:"json",
			success:function(data){
				if(data.status==1){

					if(data.app_index=='wap' ){  //SKD支付做好后，用 App.pay_sdk支付
						if(data.pay_status==1){
							$.router.load(data.jump, true);
						}else{
							location.href=data.jump;
						}
					} else if( data.app_index=='app' && data.pay_status==1){  //APP余额支付
						 $.router.load(data.jump, true);

					} else if( data.app_index=='app' && data.pay_status==0){  //APP第三方支付
						if(data.online_pay==3){
							try {

								var str = pay_sdk_json(data.sdk_code);
								App.pay_sdk(str);
							} catch (ex) {
								$.toast(ex);
								$.loadPage(location.href);
							}
						}else{
							var pay_json = '{"open_url_type":"1","url":"'+data.jump+'","title":"'+data.title+'"}';

							try {
								App.open_type(pay_json);
								$.confirm('已支付完成？', function () {
									$.loadPage(location.href);

								},function(){

									$.loadPage(location.href);
								});
							} catch (ex) {
								$.toast(ex);
								$.loadPage(location.href);
							}
						}
					}



				}else{
					
					$.alert(data.info);
				}
			
				return false;
			}
		});
		
		return false;

	});
	
	
	$(".select_num").bind("click",function(){
		$(".money_number").removeClass("selected");
		$(this).addClass("selected");
		$("input[name='money']").val($(this).attr('data'));
		calFee();
	});
    $(".first_number").trigger("click");
    if(money_number_array_other){
        $(".select_other").picker({
            toolbarTemplate: '<header class="bar bar-nav">\
          <button class="button button-link pull-right close-picker">确定</button>\
          <h1 class="title">请选择金额</h1>\
          </header>',
            cols: [
                {
                    textAlign: 'center',
                    values: money_number_array_other
                }
            ],
            onClose:function(){
                $(".money_number").removeClass("selected");
                $(".select_other").addClass("selected");
                $("input[name='money']").val(intval($(".select_other").val()));
            }
        });
    }
	$(".select_num1").focus(function(){
		$(".select_num").removeClass("selected");
	});
	$(".select_num1").blur(function(){
		//$(".select_num").removeClass("selected");
		$("input[name='money']").val($(this).val());
	});
    function intval(p){
        if(!p)return 0;
        if(typeof p=="number"){
            return parseInt(p);
        }else if(typeof p=="string"){
            return parseInt(p.replace(/[^0-9\.]*/ig,""));
        }
    }
	$(".pay_select").bind("click",function(){
		$(".pay_select .j-selected-icon").removeClass("checked");
		$(this).find(".j-selected-icon").addClass("checked");		
		$(".pay_select").find("input[name='payment_id']").prop("checked",false);
		$(this).find("input[name='payment_id']").prop("checked",true);
		calFee();
	});
	calFee();
	function calFee() {
		$('.fee-box').addClass('hide');
		var money = Number($('.select_num.selected').attr('data'));
		if (!money || money <= 0) {
			return;
		}
		var fee_type = Number($('.j-selected-icon.checked').parent().find('.fee_type').val());
		var fee_amount = Number($('.j-selected-icon.checked').parent().find('.fee_amount').val());
		var fee_money = 0;
		if (fee_type === 1) {
			fee_money = money * fee_amount;
		} else {
			fee_money = fee_amount;
		}
		fee_money = Math.round(fee_money * 100) / 100;
		if (fee_money > 0) {
			$('.fee-box .money').html(fee_money);
			$('.fee-box').removeClass('hide');
		}
	}
});

$(document).on("pageInit", "#uc_collect", function(e, pageId, $page) {
	refreshdata([".uc_collect_change"]);

/*
 *初始化tab的下划线
*/	
	init_listscroll(".j_ajaxlist_"+sc_status,".j_ajaxadd_"+sc_status);
	
	bottom_line(0);
	$(".m-collect-list").addClass("hide");
	$("#tb0").removeClass("hide");
	$(".j-tab-btn").removeClass("active");
	$(".j-tab-btn").eq(0).addClass("active");

/*
 *tab切换
 *参数说明：left  点击的tab距离左边的距离，width  点击的tab的宽度，
 *rel 对应的类别  0为商品团购 1为优惠券 2为活动 3为店铺，isload  标识出所选择的类别内容是否已经加载
*/

	$(".j-tab-btn").click(function(){
		var rel = $(this).attr("rel");
		
		var isload = $(this).attr("data-isload");
		var isEdit = $(this).parent(".m-tab-btn-list").attr("data-isedit");
		
		if (isEdit == 0) {
			$(document).off('infinite', '.infinite-scroll-bottom');
			 
			$(".j-tab-btn").removeClass("active");
			$(this).addClass("active");
			
			bottom_line(rel);
			
			$(".m-collect-list").addClass("hide");
			$("#tb"+rel).removeClass("hide");
			
			$('.content').scrollTop(1);
			if($.trim($("#tb"+rel).html()) == ""){
				var ajax_url =url[rel];
				$.ajax({
					url:ajax_url,
					type:"POST",
					success:function(html)
					{
						$(".content").append($(html).find(".content").html());
						init_listscroll(".j_ajaxlist_"+rel,".j_ajaxadd_"+rel);
					},
					error:function()
					{
						$(".j_ajaxlist_"+rel).find(".page-load span").removeClass("loading").addClass("loaded").html("网络被风吹走啦~");
					}
				});
			} else{
				if($(".content").scrollTop()>0){
					infinite(".j_ajaxlist_"+rel,".j_ajaxadd_"+rel);
				}
			}
			
			if (isload == 0) {
				//ajax加载内容
				console.log("ajax加载内容");
				$(this).attr("data-isload",1);
			}else{
				console.log("我加载完了····");
			}

			$(".j-edit").attr("rel",rel);
			$(".j-all-check").attr("rel",rel);
			$(".j-cancel").attr("rel",rel);
			now_sc = rel;
			console.log(now_sc);
		}else{
			console.log("编辑状态不能切换");
		}
	});


/*
 *编辑按钮
*/
	$(".j-edit").click(function(){
		var rel = $(this).attr("rel");
		var isEdit = $(this).attr("data-isedit");
		if(isEdit == 0){
			var item_length = $('.m-collect-list[rel = "'+rel+'"]').find(".collect-item").length;
			if (item_length > 0) {
				$('.m-collect-list[rel = "'+rel+'"]').addClass("isEdit");
				$('.m-collect-list[rel = "'+rel+'"]').find(".no-href").show();
				$(this).html("完成");
				$(this).attr("data-isedit",1);
				$(".m-operation").addClass("isShow");
				$(".m-tab-btn-list").attr("data-isedit",1);
			}else{
				$.toast("当前没有收藏！！");
			}
		}else{
			$('.m-collect-list[rel = "'+rel+'"]').removeClass("isEdit");
			$(".j-all-check").removeClass("isCheck");
			$('.m-collect-list[rel = "'+rel+'"]').find(".j-check-box").removeClass("isCheck");
			$(this).html("编辑");
			$(this).attr("data-isedit",0);
			$(".m-operation").removeClass("isShow");
			$(".m-tab-btn-list").attr("data-isedit",0);
			$('.m-collect-list[rel = "'+rel+'"]').children(".collect-item").children(".j-check-box").removeClass("isCheck");
			$('.m-collect-list[rel = "'+rel+'"]').find(".no-href").hide();
		}
	});

/*
 *勾选
*/
	$(".page").on("click",".j-check-box" , (function(){
		var isCheck = $(this).children(".iconfont").hasClass("isCheck");
			if(isCheck){
				$(this).children(".iconfont").removeClass("isCheck");
				$(".j-all-check").children(".iconfont").removeClass("isCheck");
			}else{
				$(this).children(".iconfont").addClass("isCheck");
				var rel = $(this).parents(".m-collect-list").attr("rel");
				var check_length = $('.m-collect-list[rel = "'+rel+'"]').children().find(".isCheck").length;
				var item_length = $('.m-collect-list[rel = "'+rel+'"]').children().find(".j-check-box").length;
				if (check_length == item_length) {
					$(".j-all-check").children(".iconfont").addClass("isCheck");
				}
			}
		})
	);

/*
 *全选
*/
	$(".j-all-check").click(function(){
		var isCheck = $(this).children(".iconfont").hasClass("isCheck");
		var rel = $(this).attr("rel");
		if(isCheck){
			$(this).children(".iconfont").removeClass("isCheck");
			$('.m-collect-list[rel = "'+rel+'"]').children().find(".j-check-box").children(".iconfont").removeClass("isCheck");
		}else{
			$(this).children(".iconfont").addClass("isCheck");
			$('.m-collect-list[rel = "'+rel+'"]').children().find(".j-check-box").children(".iconfont").addClass("isCheck");
		}
	});

/*
 *取消收藏
 *参数说明： data  数组  保存已选择的子项的id，type  保存已选择的子项类别
*/
	$(".j-cancel").on("click",function(){
		var rel = $(this).attr("rel");
		if($('.m-collect-list[rel = "'+rel+'"]').children().find(".isCheck").length != 0){
			var data = new Array();
			var type = $('.m-collect-list[rel = "'+rel+'"]').attr("data-type");
			$('.m-collect-list[rel = "'+rel+'"]').children().find(".isCheck").each(function(index){
				data[index] = $(this).parent(".j-check-box").attr("data-id");
			});
			var id=data.join(","); 
			uc_del_collect(type,id);
			console.log(type);
			console.log(data);
			//console.log(id);


			//还原页面到未编辑状态
			$('.m-collect-list[rel = "'+rel+'"]').children().find(".isCheck").parents(".collect-item").remove();
			$('.m-collect-list[rel = "'+rel+'"]').children().find(".isCheck").parents(".collect-item").attr("data-isdel",1);
			$('.m-collect-list[rel = "'+rel+'"]').removeClass("isEdit");
			$(".j-all-check").children(".iconfont").removeClass("isCheck");
			$('.m-collect-list[rel = "'+rel+'"]').find(".j-check-box").children(".iconfont").removeClass("isCheck");
			$(".j-edit").html("编辑");
			$(".j-edit").attr("data-isedit",0);
			$(".m-operation").removeClass("isShow");
			$(".m-tab-btn-list").attr("data-isedit",0);
			$('.m-collect-list[rel = "'+rel+'"]').children(".collect-item").children(".j-check-box").children(".iconfont").removeClass("isCheck");
			
			//判断是否全部删除，如果全部删除这显示无内容文本
			var del_length = 0;
			var item_length = $('.m-collect-list[rel = "'+rel+'"]').children().find(".collect-item").length;
			$('.m-collect-list[rel = "'+rel+'"]').children().find(".collect-item").each(function(){
				if ($(this).attr("data-isdel") == 1) {
					del_length++;
				}
			});
			if (del_length == item_length) {
				$('.m-collect-list[rel = "'+rel+'"]').append('<div class="tipimg no_data">暂无收藏</div>');
			}
		}else{
			$.toast("请选择要取消的收藏！！");
		}
		
	});
});/*页面结束初始化*/


/*
 *初始化tab的下划线
*/
function bottom_line(index){
	var left = $(".j-tab-btn").eq(index).children("em").offset().left;
	var width = $(".j-tab-btn").eq(index).children("em").width();
	$(".bottom-line").css({
		"left" : left,
		"width" : width
	});
}

function uc_del_collect(type,id){
	var query = new Object();
	query.id = id;
	query.type = type;
	//alert(ajax_url);
	$.ajax({
				url: ajax_url,
				data: query,
				dataType: "json",
				type: "POST",
				success: function(obj){
					if(obj.status==0 && obj.user_login_status==0){
						$.alert(obj.info,function(){
							window.location.href=obj.jump;
						});
					}
					if(obj.status == 1){
						$.toast(obj.info);
					}
				},
				error:function(ajaxobj)
				{
					
//					if(ajaxobj.responseText!='')
//					alert(ajaxobj.responseText);
				}
	});
}

/**
 * Created by lynn on 2016/11/17.
 * Update by YXM on 2016/11/28. 路由改版
 */
$(document).on("pageInit", "#uc_coupon", function(e, pageId, $page) {
	
	var eq=$(".content").find(".active").attr("rel");
   
    var item_width = $(".j-tab-link[rel='"+eq+"']").width();
	var item_left = $(".j-tab-link[rel='"+eq+"']").offset().left;
	$(".tab-line").css({
		width: item_width,
		left: item_left
	});
	
	$(".content").scrollTop(1);
	if($(".content").scrollTop()>0){
		init_listscroll(".j_ajaxlist_"+status,".j_ajaxadd_"+status);
	}
    
    $(".page").on('click',".j-tab-link",function(){
    	$(document).off('infinite', '.infinite-scroll-bottom');
		var rel = $(this).attr("rel");
		var item_width=$(this).width();
		var item_left=$(this).offset().left;
		$(".tab-line").css({
			width: item_width,
			left: item_left
		});
		if($.trim($("#tab"+rel).html()) == ""){
			var ajax_url =url[rel];
			$.ajax({
				url:ajax_url,
				type:"POST",
				success:function(html)
				{
					$(".tabs").find(".tab").removeClass("active");
					$(".tabs").append($(html).find(".tabs").html());
					$(".content").scrollTop(1);
					if($(".content").scrollTop()>0){
						init_listscroll(".j_ajaxlist_"+rel,".j_ajaxadd_"+rel);
					}
				},
				error:function()
				{
					$(".j_ajaxlist_"+rel).find(".page-load span").removeClass("loading").addClass("loaded").html("网络被风吹走啦~");
				}
			});
		} else{
			$(".content").scrollTop(1);
			if($(".content").scrollTop()>0){
				infinite(".j_ajaxlist_"+rel,".j_ajaxadd_"+rel);
			}
		}
	});
    
});
$(document).on("pageInit", "#uc_ecv", function(e, pageId, $page) {
	//alert(2);
	function tab_line() {
		var init_width=$(".uc-ecv-tab .active").width();
		var init_left=$(".uc-ecv-tab .active").offset().left;
		$(".ecv-tab-line").css({
			width: init_width,
			left: init_left
		});
	}
	init_listscroll(".j_ajaxlist_"+valid,".j_ajaxadd_"+valid);
	tab_line();
	
	$(".uc-ecv-tab a").click(function() {
		//alert(1);
		$(".uc-ecv-tab a").removeClass('active');
		$(this).addClass('active');
		tab_line();
		$(document).off('infinite', '.infinite-scroll-bottom');
		var rel = $(this).attr("rel");
		$(".m-ecv-list").removeClass('hide');
		if(rel==0)
		$("#tab1").addClass('hide');
		if(rel==1)
		$("#tab0").addClass('hide');
		$('.content').scrollTop(1);
		if($.trim($("#tab"+rel).html()) == "" && $("#tab"+rel).length==0 ){
			var ajax_url =url[rel];
			$.ajax({
				url:ajax_url,
				type:"POST",
				success:function(html)
				{
					$(".content").append($(html).find(".content").html());
					init_listscroll(".j_ajaxlist_"+rel,".j_ajaxadd_"+rel);
				},
				error:function()
				{
					$(".j_ajaxlist_"+rel).find(".page-load span").removeClass("loading").addClass("loaded").html("网络被风吹走啦~");
				}
			});
		} else{
			if($(".content").scrollTop()>0){
				infinite(".j_ajaxlist_"+rel,".j_ajaxadd_"+rel);
			}
		}
		
	});
	/*$(".can-use").click(function() {
		$(".m-ecv-list").removeClass('hide');
		$(".used-ecv").addClass('hide');
	});
	$(".cant-use").click(function() {
		$(".m-ecv-list").addClass('hide');
		$(".used-ecv").removeClass('hide');
	});*/

	$(".page").on('click',".j-open-ecv-exchange",function(){
		$(".pop-up").addClass("open");
		$(".pop-up").children(".img-box").addClass("open");
		$(".content").addClass("noscroll");
		$(".close-pop,.j-close-pop-btn").attr("rel","ecv");
	});

	$(".page").on('click',".j-ecv-exchange",function(){
		var sn = $(".input-ecv-exchange").val();
		if(sn.length < 1){
			$.toast("请输入红包兑换码");
		}else{
			var form = $("form[name='exchange_form']");
			var url=$(form).attr('action');
			var query = new Object();
			query.sn = sn;
			$.ajax({
				url:url,
				data:query,
				type:'post',
				dataType:'json',
				success:function(obj){
					if(obj.status==1){
						console.log(obj.info);
						$.toast(obj.info);
						$(".pop-up").children(".img-box").removeClass("open");
						$(".pop-up").removeClass("open");
						$(".input-ecv-exchange").val("");
					}else{
						$.toast(obj.info);
						$(".input-ecv-exchange").val("");
					}
					return false;
				}
			});
			
		}
		return false;
	});
});
$(document).on("pageInit", "#uc_ecv_exchange", function(e, pageId, $page) {
	$(".j-exchange-input").on("change keyup",function(){
		if($(this).val()){
			$(".j-exchange-btn").removeClass('disable');
		}else{
			$(".j-exchange-btn").addClass('disable');
		}
	});
	
	$(".j-exchange-btn").bind("click",function(){
		if(!$(this).hasClass('disable')){
			$("form[name='exchange_form']").submit();
		}
	});
	
	$("form[name='exchange_form']").bind('submit',function(){

		var sn = $(".j-exchange-input").val();
		if(sn==""){
			$.toast("口令不能为空");
			return false;
		}else{
			var form = $("form[name='exchange_form']");
			var url=$(form).attr('action');
			var query = new Object();
			query.sn = sn;
			$.ajax({
				url:url,
				data:query,
				type:'post',
				dataType:'json',
				success:function(obj){
					if(obj.status==1){
						console.log(obj.info);
						$.toast(obj.info);
						setTimeout(function(){
							window.location.reload();
						},1000); 
					}else{
						$.toast(obj.info);
						/*$("input[name='sn']").val("");*/
						if(obj.jump){
							setTimeout(function(){
								window.location.href=obj.jump;
							},1000);
						}
					}
					return false;
				}
			});
		}
		return false;
	});

	
	/*兑换红包功能*/	
	$(".j-receive").on('click',function(){
		var id = $(this).attr('data-id');
		
		var query = new Object();
		query.id = id;
		query.act = 'do_exchange';
		$.ajax({
			url:ajax_url,
			data:query,
			type:'post',
			dataType:'json',
			success:function(obj){
				console.log(obj);
				if(obj.status==1){
					$.toast(obj.info);
					setTimeout(function(){
						window.location.reload();
					},1000); 
				}else{
					$.toast(obj.info);
				}
				return false;
			}
		});

	});
});

$(document).on("pageInit", "#uc_fx", function(e, pageId, $page) {
	loadScript(jia_url);
	init_list_scroll_bottom();
	$(".j-openshare").click(function(){
		var id=$(this).attr("data_id");
		var img_url=deal_json[id]['icon'];
		var share_url=deal_json[id]['share_url'];
		var title=deal_json[id]['name'];
		jiathis_config = {
		    siteNum:6,
		    sm:"weixin,tssina,cqq,qzone,douban,copy",
		    url:share_url,
		    title:title,
		    pic:img_url
		}
	});
	$(".social_share").find(".flex-1").click(function(){
		$(".flippedout").removeClass("z-open").removeClass("showflipped");
		$(".box_share").removeClass("z-open");
	});
	
	$("#uc_fx").on("click",".j-app-share-btn",function(){
		
		var share_data={};
		share_data["share_content"]=$(this).attr("data-content");
		share_data["share_url"]=$(this).attr("data-url");;
		share_data["key"]='';
		share_data['sina_app_api']=1;
		share_data['qq_app_api']=1;
		share_data["share_imageUrl"]=$(this).attr("data-img");;
		share_data['share_title'] = $(this).attr("data-title");;
		share_data=JSON.stringify(share_data);
		try{
			App.sdk_share(share_data);
		}catch(e){

		}
	});
	
	$("#uc_fx").on('click',".goods-down",function(){
		var id=$(this).attr("data_id");
		
		var data_url=$(this).attr("data-url");
		var data_img=$(this).attr("data-img");
		var data_title=$(this).attr("data-title");
		
		var query = new Object();
		query.act="do_is_effect";
		query.deal_id = id;
		$.ajax({
			url: ajax_url,
			data:query,
			dataType: "json",
			type: "POST",
			success: function(obj){
				$.toast(obj.info);
				if(obj.status==1){
					$(".goods-down[data_id='"+id+"']").html("上架");
					
					if(APP_INDEX=="app"){
						$(".goods-down[data_id='"+id+"']").parent().find(".j-app-share-btn").remove();
					}else{
						$(".goods-down[data_id='"+id+"']").parent().find(".j-openshare").remove();
					}
					var $content=$("<a href='javascript:void(0)' class='fx-btn flex-1 cancle-fx' data_id='"+id+"' data-url='"+data_url+"' data-img='"+data_img+"' data-title='"+data_title+"'>取消"+fx_name+"</a>");
					$(".goods-down[data_id='"+id+"']").parent().append($content);
					$(".goods-down[data_id='"+id+"']").removeClass("goods-down").addClass("goods-up");
				}
			}
		});
	});
	
	$("#uc_fx").on('click',".goods-up",function(){
		var id=$(this).attr("data_id");
		var query = new Object();
		
		var data_url=$(this).attr("data-url");
		var data_img=$(this).attr("data-img");
		var data_title=$(this).attr("data-title");
		
		query.act="do_is_effect";
		query.deal_id = id;
		$.ajax({
			url: ajax_url,
			data:query,
			dataType: "json",
			type: "POST",
			success: function(obj){
				$.toast(obj.info);
				if(obj.status==1){
					$(".goods-up[data_id='"+id+"']").html("下架");
					$(".goods-up[data_id='"+id+"']").parent().find(".cancle-fx").remove();
					
					if(APP_INDEX=="app"){
						var $content=$("<a href='javascript:void(0)' class='fx-btn flex-1 share j-app-share-btn' data_id='"+id+"' data-url='"+data_url+"' data-img='"+data_img+"' data-title='"+data_title+"'>分享</a>");
					}else{
						var $content=$("<a href='javascript:void(0)' class='fx-btn flex-1 share j-openshare' data_id='"+id+"'>分享</a>");
					}
					$(".goods-up[data_id='"+id+"']").parent().append($content);
					$(".goods-up[data_id='"+id+"']").removeClass("goods-up").addClass("goods-down");
				}
			}
		});
	});
	
	$("#uc_fx").on("click",".cancle-fx",function(){
		var id=$(this).attr("data_id");
		var query = new Object();
		query.act="del_user_deal";
		query.deal_id = id;
		$.ajax({
			url: ajax_url,
			data:query,
			dataType: "json",
			type: "POST",
			success: function(obj){
				$.toast(obj.info);
				if(obj.status==1){
					$.toast(obj.info);
					if(obj.status==1){
						$(".fx-list").find("li[data_id='"+id+"']").remove();
					}
				}
			}
		});
	});
});
$(document).on("pageInit", "#uc_fxinvite", function(e, pageId, $page) {
	init_list_scroll_bottom();
});
$(document).on("pageInit", "#uc_fxwithdraw", function(e, pageId, $page) {
	/*$(".bank-select").click(function() {
		$(".select-bank").addClass('active');
	});*/
	init_blank();
	$(".mask").click(function() {
		$(".select-bank").removeClass('active');
	});
	$(".bank-list li").click(function() {
		$(".bank-list li .iconfont").removeClass('selected');
		$(this).find('.iconfont').addClass('selected');
		$(".bank-select .bank-info").html($(this).find('.bank-info').html());
		$(".select-bank").removeClass('active');
		$("input[name='bank_id']").val($(this).attr("bank_id"));
	});
	
	$(".select-bank .add-bank").click(function(){
		$(".select-bank").removeClass('active');
	});
	
	$(".select-bank .close-btn").click(function(){
		$(".select-bank").removeClass('active');
	});
	
	$("form[name='withdraw']").find("input[name='money']").change(function(){
		var money=parseFloat($(this).val());
		if(money>fx_money){
			$.toast("提现超额");
			$(this).val(fx_money);
		}
	});

	var wfeeObj = $('input.withdraw-rate');
	if (wfeeObj) {
		$('input[name=money]').on('input propertychange', function() {
			var money = parseFloat($('input[name="money"]').val());
			if (!money) {
				wfeeObj.val('');
				return false;
			}
			if (money > 0) {
				var rate = parseFloat(wfeeObj.attr('rate-data'));
				var fee = Math.ceil((money * rate) / 10) / 100;
				if (fee < 0) {
					fee = 0;
				}
				wfeeObj.val(fee);
			}
		});
	}

	
	$("form[name='withdraw']").bind("submit",function(){		
		var bank_id = $("form[name='withdraw']").find("input[name='bank_id']").val();
		var money = $("form[name='withdraw']").find("input[name='money']").val();

		if($.trim(bank_id)==""||isNaN(bank_id)||parseFloat(bank_id)<0)
		{
			$.toast("请选择提现账户");
			return false;
		}
		if($.trim(money)==""||isNaN(money)||parseFloat(money)<=0)
		{
			$.toast("请输入正确的提现金额");
			return false;
		}
		
		if(fx_money<parseFloat(money)){
			$.toast("提现超额");
			return false;
		}
		
		var ajax_url = $("form[name='withdraw']").attr("action");
		var query = $("form[name='withdraw']").serialize();
		$.ajax({
			url:ajax_url,
			data:query,
			dataType:"json",
			type:"POST",
			success:function(obj){
				init_blank();
				if(obj.status==1){
					$.toast("提现申请成功，请等待管理员审核");
					if(obj.url){
						setTimeout(function(){
							location.href = obj.url;
						},1000);
					}
				}else if(obj.status==0){
					if(obj.info)
					{
						$.toast(obj.info);
						if(obj.url){
							setTimeout(function(){
								location.href = obj.url;
							},1000);
						}
					}
					else
					{
						if(obj.url)location.href = obj.url;
					}
					
				}else{
					
				}
			}
		});		
		return false;
	});

	function init_bank(){
		var bank_name=$(".bank").find(".checked").attr("bank_name");
		var bank_id=$(".bank").find(".checked").attr("rel");
		$("input[name='bank_name']").val(bank_name);
		$("input[name='bank_id']").val(bank_id);
	}

	function init_blank() {
		$("input[name='money']").val('');
		$('.withdraw-rate').val('');
	}
});

$(document).on("pageInit", "#uc_fx_buy_check", function(e, pageId, $page) {
	$('.fee_count').hide();
	init_payment_input();
	//init_pay_btn();
	
	$(".u-sure-pay").bind("click",function(){
		var is_ajax = 1;
		var query = new Object();

		//全额支付
		if($("#all_account_money").hasClass("active"))
		{
			query.all_account_money = 1;
		}
		else
		{
			query.all_account_money = 0;
		}

		//支付方式
		var payment = $("input[name='payment']:checked").val();
		if(!payment)
		{
			payment = 0;
		}
		query.payment = payment;
		query.order_id = order_id;
		query.is_ajax = is_ajax;
		query.act = "pay_done";
		$.ajax({
			url: custom_ajax_url,
			data:query,
			type: "POST",
			dataType: "json",
			success: function(data){
				if(data.status==1){

					if(data.app_index=='wap' ){  //SKD支付做好后，用 App.pay_sdk支付
						if(data.pay_status==1){
							$.router.load(data.jump, true);
						}else{
							location.href=data.jump;
						}
					} else if( data.app_index=='app' && data.pay_status==1){  //APP余额支付
						 $.router.load(data.jump, true);

					} else if( data.app_index=='app' && data.pay_status==0){  //APP第三方支付
						if(data.online_pay==3){
							try {

								var str = pay_sdk_json(data.sdk_code);
								//console.log(str);
								//$.showErr(str);
								App.pay_sdk(str);
							} catch (ex) {

								$.toast(ex);
								//window.location.reload();
								$.loadPage(location.href);
							}
						}else{
							var pay_json = '{"open_url_type":"1","url":"'+data.jump+'","title":"'+data.title+'"}';

							try {
								App.open_type(pay_json);
								$.confirm('已支付完成？', function () {
//		   							$.showIndicator();
//			   					      setTimeout(function () {
//			   					      	  window.location.reload();
//			   					          $.hideIndicator();
//			   					    }, 500);
									$.loadPage(location.href);

								},function(){
//	   							$.showIndicator();
//		   					      setTimeout(function () {
//		   					      	  window.location.reload();
//		   					          $.hideIndicator();
//		   					    }, 500);
									$.loadPage(location.href);
									// $.toast('cancel');
								});
							} catch (ex) {
								$.toast(ex);
								$.loadPage(location.href);
								//window.location.reload();
							}
						}
					}



				}else{
					
					$.toast(data.info);
				}
			},
			error:function(ajaxobj)
			{

			}
		});
	});
	
});

function init_payment_input(){

	$("input[name='all_account_money']").live("change",function () {

		if($("#all_account_money").hasClass("active")){
			$("#all_account_money").removeClass("active");
		}else{
			$("#all_account_money").addClass("active");
			$("input[name='payment']").prop("checked",false);
		}
		//count_buy_total();
		$('.fee_count').hide();
		$('.fee_count .payment_fee').text(0);
		local_count()
	});
	
	
	$(".payment").live("click",function(){
		$("input[name='payment']").prop("checked",false);
		$(".payment").removeClass('active');
		$(this).siblings("input[name='payment']").prop("checked",true);
		$(this).addClass("active");

		$("#all_account_money").removeClass("active");
		$("input[name='all_account_money']").prop("checked",false);
		var fee = Number($('.active .fee_amount').text());
		if (fee > 0) {
			$('.fee_count .payment_fee').text(fee.toFixed(2));
			$('.fee_count').show();
		} else {
			$('.fee_count .payment_fee').text(0);
			$('.fee_count').hide();
		}
		local_count()
	});

}

function local_count() {
	var total= $('.total_count').text().replace(",","");
	var payment_fee= $('.payment_fee').text().replace(",","");
	var ready_pay = Number(total) + Number(payment_fee);
	$('.ready_pay').text(ready_pay.toFixed(2));
}
$(document).on("pageInit", "#uc_fx_deal", function(e, pageId, $page) {
	
	$(".goods-bd").on('click', '.j-dealed', function() {
		$.toast("您已经代理了此商品");
	});

	init_list_scroll_bottom();
	add_fx_deal();
	data_format_check();

	$('.search').bind('click', function() {
		var fx_search_key = $.trim($('input[name="fx_seach_key"]').val());
		if (fx_search_key == '') {
			$.toast('请输入要搜索的关键字');
			return;
		}
		var param = {
			act: 'deal_fx',
			fx_seach_key: fx_search_key
		};
		$.ajax({
			url: fx_ajax_url,
			data: param,
			success: function(html) {
				$('.j-ajaxlist').html($(html).find('.j-ajaxlist').html());
				init_list_scroll_bottom();
				add_fx_deal();
				data_format_check();
			},
			error: function(err) {
				console.log(err);
			}
		});
	});
	
});

function add_fx_deal() {
	$(".goods-bd").on('click', '.j-deal', function() {
		var that = this;
		var param = {
			act: 'add_user_fx_deal',
			deal_id: $(that).attr('data-id'),
		};

		$.ajax({
			url: fx_ajax_url,
			data: param,
			dataType: 'json',
			success: function(obj) {
				if (obj.status == 1) {
					$.toast(obj.info);
					$(that).unbind('click');
					$(that).addClass('j-dealed').removeClass('j-deal');
					$(that).text('已代理');
					$.toast('代理成功');
					setTimeout(function() {
						($(that).parents('.b-line')).remove();
						if($(".j-ajaxlist li").length==0)
						$(".j-ajaxlist").html('<div class="tipimg no_data">暂无数据</div>');
					}, 2000);
					data_format_check();
				} else if (obj.user_login_status == -1) {
					$.toast(obj.info);
					setTimeout(function() {
						$.router.load(obj.jump);
					}, 2000);
				} else {
					$.toast(obj.info);
				}
			},
			error: function(obj) {
				$.toast('网络异常');
			}
		});
	});
}

function data_format_check() {
	var nodata = '<div class="tipimg no_data">暂无数据</div>';
	var li_len = $('.deal-list').find('li').length;
	if (li_len == 0) {
		if ($('.fx-deal-list').find('.no_data').length == 0) {
			$('.fx-deal-list').html(nodata);
		}
		$('.fx-deal-list .page-load').remove();
	} else if (li_len < 4) {
		$('.fx-deal-list .page-load').remove();
	}
}

$(document).on("pageInit", "#uc_fx_mall", function(e, pageId, $page) {
	var rel = $('.mall-tab .active').attr('rel');
	init_listscroll(".j_ajaxlist_"+rel,".j_ajaxadd_"+rel);

	$(".mall-tab a").click(function() {
		$(".mall-tab-item").removeClass('active');
		$(this).addClass('active');
		$(document).off('infinite', '.infinite-scroll-bottom');
		var rel = Number($(this).attr("rel"));
		var hidetab = '#tab' + (rel ? 0 : 1);
		var showtab = '#tab' + rel;
		// console.log(hidetab + '' + showtab);
		$(showtab).removeClass('hide');
		$(hidetab).addClass('hide');
		$('.content').scrollTop(1);
		if(!$.trim($("#tab"+rel).html())){
			var param = {
				type: rel,
				act: 'mall'
			};
			$.ajax({
				url:ajax_url,
				data: param,
				type:"GET",
				success:function(html) {
					$('#item-content').append($(html).find('#item-content').html());
					// $('.content').append($(html).find('.content').html());
					init_listscroll(".j_ajaxlist_"+rel,".j_ajaxadd_"+rel);
				},
				error:function() {
					$(".j_ajaxlist_"+rel).find(".page-load span").removeClass("loading").addClass("loaded").html("网络被风吹走啦~");
				}
			});
		} else{
			if($(".content").scrollTop()>0){
				infinite(".j_ajaxlist_"+rel,".j_ajaxadd_"+rel);
			}
		}
	});
});
/**
 * Created by Administrator on 2016/11/28.
 */
$(document).on("pageInit", "#uc_fx_qrcode", function(e, pageId, $page) {	


    /*提交订单选择配送方式点击事件*/
    var _hei=$(".j-trans-way").height();
    var _rehei=$(".j-red-reward").height();
    $(".popup-box .j-trans-way").css({"bottom":-_hei});
    $(".popup-box .j-red-reward").css({"bottom":-_rehei});
    var _bhei=$(".pup-box-bg").height();


    $(document).on('click',".j-cancel",function () {
        
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },300);
    });


    $(document).on('click',".j-trans",function () {
    	var index = $(".j-trans").index($(this));
        $(".totop").addClass("vible");
        $(".popup-box .j-red-reward").css({"bottom":-_rehei});
        $(".popup-box").css({"transition":"all 0.3s linear","opacity":"1","z-index":"9999"});
        $(".popup-box .j-trans-way").eq(index).css({"transition":"bottom 0.3s linear","bottom":"0"});
        $(".popup-box .pup-box-bg").css({"transition":"opacity 0.3s linear","opacity":"0.6"});
    });
  //   $("#uc_fx_qrcode .j-reward").on('click',function () {
		// if($(".totop").hasClass("vible")){
		// 	
		// 	setTimeout(function () {
		// 		$(".totop").removeClass("vible");
  //               $(".popup-box").removeClass("active");
		// 	},300);
		// }else{
		// 	$(".totop").addClass("vible");
		// 	$(".popup-box .j-trans-way").css({"bottom":-_hei});
		// 	$(".popup-box").addClass("active");
		// }
  //   });
        select_box($(".j-reward"),$(".setting-box"));

	var is_luck=false;
    $(document).on('click',".j-reward-list li",function () {
		if(is_luck)return ;
		if($("input[name='qrcode_type']:checked").val()==$(this).find("input[name='qrcode_type']").val())return ;
		
		is_luck=true;
        var lue_name=$(this).find(".pay-way-name .j-company-name").text();
        var lue_momey=$(this).find(".pay-way-name .j-company-money").text();
        var lue_reward=$(this).find(".pay-way-name").text();
		var qrcode=$(this).find(".pay-way-name").attr("qrcode");
		var qrcode_urls=$(this).find(".pay-way-name").attr("qrcode_urls");

        $(this).parents("ul").find("input").prop("checked",false);
		
		$(this).find("input[name='qrcode_type']").prop("checked",true);
		var query = new Object();
		query.qrcode_type=$("input[name='qrcode_type']:checked").val();
		$.ajax({
            url: ajax_url,
            data:query,
            type: "POST",
            dataType: "json",
            success: function(obj){
				if(obj.status == 1){
					$.toast(obj.info);
					var query2 = new Object();
					query2.is_ajax=1;
					$.ajax({
						url:location.href,
						data:query2,
						type: "POST",
						dataType: "json",
						success:function(obj)
						{
							$(".qrcode img").attr('src',obj.share_mall_qrcode);
							$(".qrcode-info .j-app-share-btn,.qrcode-info .j-openshare").attr('data-share-url',obj.user_data.share_mall_url);
						},
						error:function()
						{
							$.toast('错误');
							//location.href=location.href;
						}
					 });
                    $(".m-mask").removeClass('active');
                    $(".setting-box").removeClass('active');
				}else{
					$.toast(obj.info);
				}
				setTimeout(function () {
					$(".totop").removeClass("vible");
				},500);
				
				is_luck=false;
				//location.href=location.href
			 }
		});
        //setTimeout(function () {
        //    $(".totop").removeClass("vible");
        //},500);
        //
        //count_buy_total();
    });
});
$(document).on("pageInit", "#uc_fx_vip_buy", function(e, pageId, $page) {
	
    $(".content").scroller('refresh');
	$(".fx_buy").click(function(){
		$.ajax({ 
            url: ajax_url,
            type: "POST",
            dataType: "json",
            success: function(data){
                if(data.status==1){
                    if(data.free){
                    	$.toast(data.info);
	                    setTimeout(function(){
	                    	$.router.load(data.jump, true);
	                    },1000);
                    }else{
                    	$.router.load(data.jump, true);
                    }
                }else{
                    $.toast(data.info);
                    if(data.jump){
	                    setTimeout(function(){
	                    	$.router.load(data.jump, true);
	                    },1000);
                    }
                }
            },
        });
	});
	
	$(document).on('click','.open-protocol', function () {
	    $.popup('.popup-protocol');
    });
});
$(document).on("pageInit", "#uc_home", function(e, pageId, $page) {

	init_list_scroll_bottom();

	_initform('', '');

    /*赞和评论弹出事件*/
    $(".reply-btn").click(function(){
		var act_item_box=$(this).parent().find(".act-item-box");

		var act_item=$(".act-box .act-item-box");

		act_item.each(function(){
            if(act_item.hasClass("trans_late")){
            	act_item.removeClass("trans_late");
            }
        });

        if(act_item_box.hasClass("trans_late")){
        	act_item_box.removeClass("trans_late");
        }else{
        	act_item_box.addClass("trans_late");
      	}
    });

    /*其他区域点击时，如果评论出现，则关闭*/
    $(document).click(function(e){

        if($(e.target).parents(".reply-btn").length==0){
            var act_item=$(".act-box .act-item-box");
            act_item.each(function(){
                if(act_item.hasClass("trans_late")){
                    act_item.removeClass("trans_late");
                }
            });
        };
        if($(e.target).parents(".reply-input-box").length==0){
            var reply_input_box=$(".reply-input-box");
            if(reply_input_box.hasClass("trans_reply")){
                reply_input_box.removeClass("trans_reply");
            }
        };
        if($(e.target).parents(".reply-act-box").length==0){
            var reply_act_box=$(".reply-act-box");
            if(reply_act_box.hasClass("trans_act")){
                reply_act_box.removeClass("trans_act");
            }
        };
        // _initform('', '');

    });


    /*点击回复事件*/
    $(".act-item-box .act-table .act-dp").click(function(e){
        e.stopPropagation();
        $(".reply-act-box").removeClass("trans_act");
        $(".reply-input-box").addClass("trans_reply");
        $(".act-box .act-item-box").removeClass("trans_late");

        var tid = $(this).parents('.item_box').attr('data_id');
        var rid = '';
        _initform(tid, rid);
    });

    /*点击赞事件*/
    $(".act-item-box .act-table .act-zan").click(function(){
        var tid = $(this).parents('.item_box').attr('data_id');
        do_fav_topic(tid);
    });

    /* 取消点赞 */
    $(".act-item-box .act-table .cancel-zan").click(function(){
        var tid = $(this).parents('.item_box').attr('data_id');
        do_cancel_fav(tid);
    });


    /*点击取消事件*/
    $(".r-input-btn-box .c_btn").click(function(){
        $(".reply-input-box").removeClass("trans_reply");

    });

    /*评论列表点击事件*/
    $(".reply-list .r-con").click(function(e){
        e.stopPropagation();
        // 回复对象名称
        var reply_name=$(this).parent().find(".name_link").text();
        var reply_act_box=$(".reply-act-box");
        // 主题ID
        var tid = $(this).parents('.item_box').attr('data_id');
        // 评论ID
        var rid = $(this).parent().attr('data-id');

        $(".act-box .act-item-box").removeClass("trans_late");

        if(reply_name == user_name){
            $(".reply-input-box").removeClass("trans_reply");
            reply_act_box.addClass("trans_act");
            reply_act_box.find('.del_r_data').off('click');
            reply_act_box.find('.del_r_data').on('click', function() {
            	del_reply(tid, rid);
            });
        }else{
            reply_act_box.removeClass("trans_act");
            $(".reply-input-box").addClass("trans_reply");
            $("input[name='reply_txt']").attr('placeholder', "回复@"+reply_name+":");
            _initform(tid, rid);
        }
    });

    /*取消按钮点击事件*/
    $(".r-act-item .cancel_act").click(function(){
        $(".reply-act-box").removeClass("trans_act");
    });

    // 没有回复对象的留言
    $("form[name='reply_form']").bind("submit",function(){
		var tid = $("input[name='reply_tid']").val();
		var rid = $("input[name='reply_rid']").val();
		var r_txt = $.trim($("input[name='reply_txt']").val());
		if(r_txt != ''){
			if (rid != '') {
				$("input[name='reply_txt']").val($("input[name='reply_txt']").attr('placeholder') + r_txt);
			}
			var url = $("form[name='reply_form']").attr('action');
			var query = $("form[name='reply_form']").serialize();
			$.ajax({
				url:url,
				data:query,
				type:"POST",
				dataType:"json",
				success:function(obj){
					if(obj.status) {
						$(".r_data_"+tid).append(obj.reply_html);
						if($(".r_data_"+tid).find(".r-item").length>0) {
							$(".r_data_"+tid).parent().show();
						}
						$(window).scrollTop($(".r_sub_data_id_"+obj.reply_data.reply_id).offset().top-($(window).height()/2));
					} else {
						$.toast(obj.info);
					}
				}
			});
		}
		$(".reply-input-box").removeClass("trans_reply");
		$("input[name=reply-txt]").val('');
		_initform('', '');
		return false;
	});

    var imglight2 = new Swiper ('.img-light', {
		onSlideChangeStart: function(swiper){
			var index = $(".img-light-box .swiper-slide-active").attr("rel");
			$(".light-index .now-index").html(index);
		}
	});

	/*
	 *评论图点击显示当前评论所有图片集
	*/
	$(".j_open_img").click(function(){
	    imglight2.removeAllSlides();
		$(".flippedout").addClass("z-open-black");
		$(".flippedout").addClass("showflipped");
		$(".light-txt").addClass("z-open");
		$(".j-flippedout-close").attr("rel","light_firend");
		$(".totop").addClass("vhide");//隐藏回到头部按钮
		var index = 0;
		$(this).parents(".images_box").find(".j_open_img").each(function(index){//动态为查看器添加内容
		console.log(0);
			var url = $(this).children("img").attr("data-lingtsrc");
			index = parseInt(index) + 1;
			imglight2.appendSlide('<div class="swiper-slide" rel="'+ index +'"><img class="j-slide-img2" src="'+ url +'" width="100%"></div>');
		});
		var index = parseInt($(this).attr("data"))-1;//获取点击的是第几张图片
		imglight2.slideTo(index,0);//设置查看器图片为点击的图片
		$(".light-index .light-count").html($(this).parent().children(".j_open_img").length); //设置图片索引总数
		$(".light-index .now-index").html($(this).attr("data"));//设置当前图片索引
	});

    $(".swiper-wrapper").on("click",".j-slide-img2",function(){
    		$(".flippedout").removeClass("z-open-black").removeClass("showflipped");
    		$(".light-txt").removeClass("z-open");
    		$(".img-light-box .j-flippedout-close").removeClass("showflipped");
    		imglight2.removeAllSlides();
    		$(".totop").removeClass("vhide");
    	});

    $(document).on("click",".j-flippedout-close",function(){
        var rel = $(this).attr("rel");
        $(".flippedout").removeClass("showflipped").removeClass("dropdowm-open").removeClass("z-open");
        		$(".cancel-shoucan").removeClass("z-open");
        		if(rel == "light_firend"){
        			//关闭图片查看器
        			$(".flippedout").removeClass("z-open-black");
        			$(".light-txt").removeClass("z-open");
        			$(".img-light-box .j-flippedout-close").removeClass("showflipped");
        			imglight2.removeAllSlides();
        }
    });
});

// 回复表单的主题ID和被回复ID设置
function _initform(tid, rid) {
	$('input[name=reply_tid]').attr('value', tid);
    $('input[name=reply_rid]').attr('value', rid);
    $('input[name=reply_txt]').val('');
}

// 评论点击事件
function _reply_click(rid, e) {
	e.stopPropagation();
	// 回复对象名称
	var objclass = '.r_sub_data_id_'+rid;
    var reply_name = $(objclass).find(".name_link").text();
    var reply_act_box = $(".reply-act-box");
    // 主题ID
    var tid = $(objclass).parents('.item_box').attr('data_id');
    // 评论ID
    // var rid = $(objclass).parent().attr('data-id');

    $(".act-box .act-item-box").removeClass("trans_late");

    if(reply_name == user_name){
        $(".reply-input-box").removeClass("trans_reply");
        reply_act_box.addClass("trans_act");
        reply_act_box.find('.del_r_data').off('click');
        reply_act_box.find('.del_r_data').on('click', function() {
        	del_reply(tid, rid);
        });
    }else{
        reply_act_box.removeClass("trans_act");
        $(".reply-input-box").addClass("trans_reply");
        $("input[name='reply_txt']").attr('placeholder', "回复@"+reply_name+":");
        _initform(tid, rid);
    }
}


// 点赞
function do_fav_topic(tid){
	var item_box_id = '.item_box_' + tid;
	var zan_list = $(item_box_id).find(".zan_list");
	var zan_status = $(item_box_id).find(".act-zan");
	
	var query = new Object();
	query.id = tid;
	query.act = "do_fav_topic";
	$.ajax({
		url:ajax_url,
		data:query,
		type:"POST",
		dataType:"json",
		success:function(obj){ 
			if (obj.status == -1) {
				// 未登录处理
				$.router.load($obj.jump, true);
				return false;
			} else if (obj.status) {
				if(zan_list.hasClass("zan_list_show")){
		            // 
		        }else{
		            zan_list.addClass("zan_list_show");
		        }
		        zan_list.append('<i class="iconfont">&#xe8ef;</i><span class="zan_name zan_name_'+obj.do_fav.id+'">'+obj.do_fav.user_name+'</span>');
		        zan_status.off('click');
		        zan_status.addClass('cancel-zan').removeClass('act-zan');
		        zan_status.attr('onclick', 'do_cancel_fav('+tid+');');
		        $(item_box_id).find('.zan_text').text('取消');
			}
			$('.act-item-box').css({'right':'-160px'});
		}
	});
}
// 取消赞
function do_cancel_fav(tid) {
	var item_box_id = '.item_box_' + tid;
	var zan_list = $(item_box_id).find(".zan_list");
	var zan_status = $(item_box_id).find(".cancel-zan");
	//console.log(zan_list);return false;
	var query = new Object();
	query.id = tid;
	query.act = "cancel_fav";
	$.ajax({
		url:ajax_url,
		data:query,
		type:"POST",
		dataType:"json",
		success:function(obj){ 
			if (obj.status == -1) {
				// 未登录处理
				$.router.load($obj.jump, true);
				return false;
			} else if (obj.status) {
				if (zan_list.find('i').length <= 1) {
					// 如果只有一个人赞
					zan_list.removeClass('zan_list_show');
				}
				var fav_id = '.zan_name_'+obj.do_fav.id;
		        zan_list.find(fav_id).prev().remove();
		        zan_list.find(fav_id).remove();
		        zan_status.off('click');
		        zan_status.removeClass('cancel-zan').addClass('act-zan');
		        zan_status.attr('onclick', 'do_fav_topic('+tid+');');
		        $(item_box_id).find('.zan_text').text('赞');
			}
			$('.act-item-box').css({'right':'-160px'});
		}
	});
}


function cancel_act(){
	var reply_act_box=$(".reply-act-box");
    if(reply_act_box.hasClass("trans_act")){
        reply_act_box.removeClass("trans_act");
    }
}

// 删除评论
function del_reply(id,reply_id){
	var query = new Object();
	query.act="del_reply";
	query.reply_id = reply_id;
	$.ajax({
		url:ajax_url,
		data:query,
		type:"POST",
		dataType:"json",
		success:function(obj){
			if(obj.status==1) {
				cancel_act();
				// $(".r_sub_data_id_"+reply_id).fadeOut();
				$(".r_sub_data_id_"+reply_id).remove();
				if($(".r_data_"+id).find(".r-item").length==0 && $('.r_data_'+id).find('.zan_name') == 0){
					$(".r_data_"+id).parent().hide();
				}
					
			}else if(obj.status==-1){
				$.toast(obj.info);
				setTimeout(function(){
					$.toast(obj.jump, true);
				}, 2000);
			}else{
				$.toast(obj.info);
				setTimeout(function(){
					console.log(id+':'+reply_id);
				}, 2000);
			}
		}
	});
}

// 关注和取消关注
function focus_user(uid,o)
{
	var query = new Object();
	query.act = "focus";
	query.uid = uid;
	$.ajax({ 
		url: AJAX_URL,
		data: query,
		dataType: "json",
		success: function(obj){	
			var tag = obj.tag;
			var html = obj.html;
			if(tag==1) { //取消关注
				$(o).html(html);
			}
			if(tag==2) { //关注TA
				$(o).html(html);
			} if(tag==3) {//不能关注自己
				$.toast(html);
			} if(tag==4) { // 未登录
				$.toast(obj.info);
				setTimeout(function() {
					$.router.load(obj.jump, true);
				}, 2000);
			}
				
		},
		error:function(ajaxobj) {
			$.toast('网络被风吹走了');
		}
	});	
}

// 做一个无限下拉的效果
function downTopic(uid, page) {
	var query = {
		act: 'downTopic',
		page: page,
		uid: uid, // 意义不明
	};
	$.ajax({
		url: ajax_url,
		data: query,
		dataType: 'json',
		success: function(obj) {
			console.log(obj.status);
			switch (obj.status) {
				case -1:
					$.toast(obj.info);
						setTimeout(function() {
							$.router.load(obj.jump);
						}, 2000);
					break;
				case 0: // 没有更多消息
					$.toast('no data');
					break;
				case 1:
					$(obj.html).appendTo($('.data_list'));
			}
		}
	});
}
$(document).on("pageInit", "#uc_home_show", function(e, pageId, $page) {

  _initform('', '');

    /*赞和评论弹出事件*/
    $(".reply-btn").click(function(){
    var act_item_box=$(this).parent().find(".act-item-box");

    var act_item=$(".act-box .act-item-box");

    act_item.each(function(){
            if(act_item.hasClass("trans_late")){
              act_item.removeClass("trans_late");
            }
        });

        if(act_item_box.hasClass("trans_late")){
          act_item_box.removeClass("trans_late");
        }else{
          act_item_box.addClass("trans_late");
        }
    });

    /*其他区域点击时，如果评论出现，则关闭*/
    $(document).click(function(e){
        if($(e.target).parents(".reply-btn").length==0){
            var act_item=$(".act-box .act-item-box");
            act_item.each(function(){
                if(act_item.hasClass("trans_late")){
                    act_item.removeClass("trans_late");
                }
            });
        };
        if($(e.target).parents(".reply-input-box").length==0){
            var reply_input_box=$(".reply-input-box");
            if(reply_input_box.hasClass("trans_reply")){
                reply_input_box.removeClass("trans_reply");
            }
        };
        if($(e.target).parents(".reply-act-box").length==0){
            var reply_act_box=$(".reply-act-box");
            if(reply_act_box.hasClass("trans_act")){
                reply_act_box.removeClass("trans_act");
            }
        };
        // _initform('', '');
    });


    /*点击回复事件*/
    $(".act-item-box .act-table .act-dp").click(function(e){
        e.stopPropagation();
        $(".reply-act-box").removeClass("trans_act");
        $(".reply-input-box").addClass("trans_reply");
        $(".act-box .act-item-box").removeClass("trans_late");

        var tid = $(this).parents('.item_box').attr('data_id');
        var rid = '';
        _initform(tid, rid);
    });

    /*点击赞事件*/
    $(".act-item-box .act-table .act-zan").click(function(){
        var tid = $(this).parents('.item_box').attr('data_id');
        do_fav_topic(tid);
    });

    /* 取消点赞 */
    $(".act-item-box .act-table .cancel-zan").click(function(){
        var tid = $(this).parents('.item_box').attr('data_id');
        do_cancel_fav(tid);
    });


    /*点击取消事件*/
    $(".r-input-btn-box .c_btn").click(function(){
        $(".reply-input-box").removeClass("trans_reply");

    });

    /*评论列表点击事件*/
    $(".reply-list .r-con").click(function(e){
        e.stopPropagation();
        // 回复对象名称
        var reply_name=$(this).parent().find(".name_link").text();
        var reply_act_box=$(".reply-act-box");
        // 主题ID
        var tid = $(this).parents('.item_box').attr('data_id');
        // 评论ID
        var rid = $(this).parent().attr('data-id');

        $(".act-box .act-item-box").removeClass("trans_late");

        if(reply_name == user_name){
            $(".reply-input-box").removeClass("trans_reply");
            reply_act_box.addClass("trans_act");
            reply_act_box.find('a').on('click', function() {
              del_reply(tid, rid);
            });
        }else{
            reply_act_box.removeClass("trans_act");
            $(".reply-input-box").addClass("trans_reply");
            $("input[name='reply_txt']").attr('placeholder', "回复@"+reply_name+":");
            _initform(tid, rid);
        }
    });

    /*取消按钮点击事件*/
    $(".r-act-item .cancel_act").click(function(){
        $(".reply-act-box").removeClass("trans_act");
    });

    // 回复留言
    $("form[name='reply_form']").bind("submit",function(){
        var tid = $("input[name='reply_tid']").val();
        var rid = $("input[name='reply_rid']").val();
        var r_txt = $.trim($("input[name='reply_txt']").val());
        if(r_txt != ''){
            if (rid != '') {
                $("input[name='reply_txt']").val($("input[name='reply_txt']").attr('placeholder') + r_txt);
            }
            var url = $("form[name='reply_form']").attr('action');
            var query = $("form[name='reply_form']").serialize();
            $.ajax({
                url:url,
                data:query,
                type:"POST",
                dataType:"json",
                success:function(obj){
                    if(obj.status) {
                        $(".r_data_"+tid).append(obj.reply_html);
                        if($(".r_data_"+tid).find(".r-item").length>0) {
                            $(".r_data_"+tid).parent().show();
                        }
                        $(window).scrollTop($(".r_sub_data_id_"+obj.reply_data.reply_id).offset().top-($(window).height()/2));
                    } else {
                        $.toast(obj.info);
                    }
                }
            });
        }
        $(".reply-input-box").removeClass("trans_reply");
        $("input[name=reply-txt]").val('');
        _initform('', '');
        return false;
    });

    var imglight2 = new Swiper ('.img-light', {
        onSlideChangeStart: function(swiper){
            var index = $(".img-light-box .swiper-slide-active").attr("rel");
            $(".light-index .now-index").html(index);
        }
    });

  /*
   *评论图点击显示当前评论所有图片集
  */
  $(".j_open_img").click(function(){
      imglight2.removeAllSlides();
    $(".flippedout").addClass("z-open-black");
    $(".flippedout").addClass("showflipped");
    $(".light-txt").addClass("z-open");
    $(".j-flippedout-close").attr("rel","light_firend");
    $(".totop").addClass("vhide");//隐藏回到头部按钮
    var index = 0;
    $(this).parents(".images_box").find(".j_open_img").each(function(index){//动态为查看器添加内容
    console.log(0);
      var url = $(this).children("img").attr("data-lingtsrc");
      index = parseInt(index) + 1;
      imglight2.appendSlide('<div class="swiper-slide" rel="'+ index +'"><img class="j-slide-img2" src="'+ url +'" width="100%"></div>');
    });
    var index = parseInt($(this).attr("data"))-1;//获取点击的是第几张图片
    imglight2.slideTo(index,0);//设置查看器图片为点击的图片
    $(".light-index .light-count").html($(this).parent().children(".j_open_img").length); //设置图片索引总数
    $(".light-index .now-index").html($(this).attr("data"));//设置当前图片索引
  });

    $(".swiper-wrapper").on("click",".j-slide-img2",function(){
        $(".flippedout").removeClass("z-open-black").removeClass("showflipped");
        $(".light-txt").removeClass("z-open");
        $(".img-light-box .j-flippedout-close").removeClass("showflipped");
        imglight2.removeAllSlides();
        $(".totop").removeClass("vhide");
      });

    $(document).on("click",".j-flippedout-close",function(){
        var rel = $(this).attr("rel");
        $(".flippedout").removeClass("showflipped").removeClass("dropdowm-open").removeClass("z-open");
            $(".cancel-shoucan").removeClass("z-open");
            if(rel == "light_firend"){
              //关闭图片查看器
              $(".flippedout").removeClass("z-open-black");
              $(".light-txt").removeClass("z-open");
              $(".img-light-box .j-flippedout-close").removeClass("showflipped");
              imglight2.removeAllSlides();
        }
    });

    /*加载更多操作*/
    var load_page = 2;
    $(".load-move").bind("click",function(){
      var id = $(this).attr("data-id");
      var query = new Object();
      query.id = id;
      query.page = load_page;
      query.act = "load_move_reply";
      $.ajax({
        url:ajax_url,
        data:query,
        type:"POST",
        dataType:"json",
        success:function(obj){
          if(obj.status==1) {
            $(".r_data_"+id).append(obj.reply_html);
            if($(".r_data_"+id).find(".r-item").length>0)
              $(".r_data_"+id).parent().show();
            
            if(obj.is_lock==1){
              $(".load-move").unbind();
              $(".load-move").css("background-color","#A6A6A6");
            }
            load_page++;
          } else if(obj.status==-1) {
            $.toast(obj.info);
            setTimeout(function() {
              $.router.load(obj.jump, true);
            }, 2000);
          }
        }
      });
    });
});




$(document).on("pageInit", "#uc_logistic", function(e, pageId, $page) {
	
	if($(".buttons-tab .tab-link").length>0){
	    var _width=$(".buttons-tab .tab-link.active").find("span").width();
	    var _left=$(".buttons-tab .tab-link.active").find("span").offset().left;
	
	    var btm_line=$(".buttons-tab .bottom_line");
	    btm_line.css({"width":_width+"px","left":_left+"px"});
	
	    var _tabs=$(".tabBox .tab_box");
	}
    $(".buttons-tab .tab-link").click(function () {
        var _wid=$(this).find("span").width();
        var _lef=$(this).find("span").offset().left;

        btm_line.css({"width":_wid+"px","left":_lef+"px"});
        var _index=$(this).index();

        $(this).addClass("active").siblings(".tab-link").removeClass("active");
        _tabs.eq(_index).addClass("active").siblings(".tab_box").removeClass("active");
        init_confirm_button();

    });
    
    if($(".no_delivery").hasClass("active") &&
	   $("input[type='checkbox']").length==$("input[disabled='disabled']").length
	){
		$("#uc_logistic nav.bar-tab .confirm_order").hide();
		$("#uc_logistic nav.bar-tab").addClass('line-white');
	}else{
		init_confirm_button();
	}

	$(".no_delivery_deal").click(function(){
    	if($("input[type='checkbox']").length==$("input[disabled='disabled']").length){
			$("#uc_logistic nav.bar-tab .confirm_order").hide();
			$("#uc_logistic nav.bar-tab").addClass('line-white');
		}else{
			$("#uc_logistic nav.bar-tab .confirm_order").show();
			$("#uc_logistic nav.bar-tab").removeClass('line-white');
		}
    });
	
	var is_confirm=0;
	$(this).find(".confirm_order").unbind("click");
	$(this).find(".confirm_order").bind("click",function(){
		if(is_confirm){
			$.toast("请勿重复点击！");
			return false;
		}
		is_confirm=1
		$.confirm('确认收货？', function() {
			var data_id = $(".tabBox .tab_box.active").attr("data_id");	
			var query = new Object();
			if(data_id){
				query.item_id = data_id;
				query.act = 'verify_delivery';
			}else{
				var order_ids=new Array();
				$(".tabBox .tab_box.active").find("input[name='my-radio']").each(function(){
					order_ids.push($(this).attr("data_id"));
				});
				query.order_ids=JSON.stringify(order_ids);
				query.act = 'verify_no_delivery';
			}
			$.ajax({
				url: order_url,
				data: query,
				dataType: "json",
				type: "POST",
				success: function(obj){
					if(obj.status==0){

						$.toast(obj.info);
						is_confirm=0;
					}else if(obj.status == 1){
						$.toast(obj.info);
						window.setTimeout(function(){
							$("#uc_logistic .tabBox .tab_box.active").attr("is_arrival",1);
							init_confirm_button();
							window.location.href=obj.jump;
						},1500);
					}
				},
				error:function(ajaxobj)
				{
					is_confirm=0;
					//if(ajaxobj.responseText!='')
					//alert(ajaxobj.responseText);
				}
						
			});
		},function() {is_confirm=0;})
		
	});
});

function init_confirm_button(){
	var status = $("#uc_logistic .tabBox .tab_box.active").attr("status");
	if(status==1){
		$("#uc_logistic nav.bar-tab .confirm_order").hide();
		$("#uc_logistic nav.bar-tab").addClass('line-white');
	}else{
		$("#uc_logistic nav.bar-tab .confirm_order").show();
		$("#uc_logistic nav.bar-tab").removeClass('line-white');
	}
}
$(document).on("pageInit", "#uc_lottery", function(e, pageId, $page) {
	$(".j-close-warning").click(function(){
		$(this).parent(".m-warning").height(0);
	});
});
/**
 * 
 */
$(document).on("pageInit", "#uc_money_index", function(e, pageId, $page) {
	refreshdata([".uc_money_change"]);
});

var lesstime = 0;
$(document).on("pageInit", "#uc_money_withdraw", function(e, pageId, $page) {
	$(".bank-select").click(function() {
		if(bank==1){
			$(".select-bank").addClass('active');
		}
	});
	$(".mask").click(function() {
		$(".select-bank").removeClass('active');
	});
	$(".bank-list li").click(function() {
		$(".bank-list li .iconfont").removeClass('selected');
		$(this).find('.iconfont').addClass('selected');
		$(".bank-select .bank-info").html($(this).find('.bank-info').html());
		$(".select-bank").removeClass('active');
		$("input[name='bank_id']").val($(this).attr("bank_id"));
	});
	
	$(".select-bank .add-bank").click(function(){
		$(".select-bank").removeClass('active');
	});
	
	$(".select-bank .close-btn").click(function(){
		$(".select-bank").removeClass('active');
	});
	
	$("form[name='withdraw']").find("input[name='money']").change(function(){
		var money=parseFloat($(this).val());
		if(money>all_money){
			$.toast("提现超额");
			$(this).val(all_money);
		}
	});

	// 绑定删除用户银行卡的事件
	$('.del_bank').bind('click', function() {
		var bank_id = $(this).attr('data-id');
		var ajax_url = $(this).attr('data-action');
		// if_confirm??
		$.ajax({
			url: ajax_url,
			data: {'bank_id':bank_id},
			dataType: 'json',
			success: function(obj) {
				if (obj.status == 1) {
					$.toast('删除成功');
					// 移除前台展示的DOM
				} else {
					$.toast(obj.info);
				}
			}
		});
		return false;
	});
	function init_bank(){
		var bank_name=$(".bank").find(".checked").attr("bank_name");
		var bank_id=$(".bank").find(".checked").attr("rel");
		$("input[name='bank_name']").val(bank_name);
		$("input[name='bank_id']").val(bank_id);
	}


	submit();
	
	function submit(){
		$(".withdraw_submit").bind("click",function(){	
			$(".withdraw_submit").attr('disabled',"true");
			setTimeout(function(){
				$(".withdraw_submit").removeAttr("disabled");
			},3000);
			var bank_id = $("form[name='withdraw']").find("input[name='bank_id']").val();
			var money = $("form[name='withdraw']").find("input[name='money']").val();


			if($.trim(bank_id)==""||isNaN(bank_id)||parseFloat(bank_id)<=0)
			{
				$.toast("请选择提现账户");
				setTimeout(function(){
					load_page($(".load_page"));
				},1000);
				return false;
			}
			if($.trim(money)==""||isNaN(money)||parseFloat(money)<=0)
			{
				$.toast("请输入正确的提现金额");
				return false;
			}
			
			var ajax_url = $("form[name='withdraw']").attr("action");
			var query = $("form[name='withdraw']").serialize();
			//console.log(query);
			$.ajax({
				url:ajax_url,
				data:query,
				dataType:"json",
				type:"POST",
				success:function(obj){
					if(obj.status==1){
						$.toast("提现申请成功，请等待管理员审核");
						$("form[name='withdraw']").find("input[name='money']").val('');
						if(obj.url){
							setTimeout(function(){
								location.href = obj.url;
							},1500);
						}
					}else if(obj.status==0){
						if(obj.info)
						{
							$.toast(obj.info);
							if(obj.url){
								setTimeout(function(){
									location.href = obj.url;
								},1500);
							}
						}
						else
						{
							if(obj.url)location.href = obj.url;
						}
						
					}
				}
			});		
			return false;
		});
	}

	wtime($("#uc_withdraw_btn"));
	$("#main1  #verify_image_box").find(".verify_close_btn").bind("click",function(){
		$("#main1 #verify_image_box").hide();
	});

	if ($('#mobile').val() == '') {
		$("#uc_withdraw_btn").addClass("noUseful").removeClass("isUseful");
	}
	/*手机号码正则验证*/

	if($("#mobile").length>0){
		document.getElementById("mobile").oninput=function () {
			if(parseInt($("#uc_withdraw_btn").attr("lesstime"))==0){
				var reg = /^0?1[3|4|5|7|8][0-9]\d{8}$/;

				var text=$(this).val();
				if(reg.test(text)){
					$(".j-mobilesendBtn").addClass("isUseful").removeClass("noUseful");
					$(".j-mobilesendBtn").prop("disabled",false);
					/*发送验证码倒计时*/
					$(".j-mobilesendBtn .isUseful").click(function () {
						do_withdraw_send($("#uc_withdraw_btn"));
					});
				}
				else {
					$(".j-mobilesendBtn").addClass("noUseful").removeClass("isUseful");
					$(".j-mobilesendBtn").prop("disabled", true);
				}
			}
		};
	}
	function wtime(obj) {
		wait=parseInt(obj.attr("lesstime"));
		if (wait == 0) {
			obj.prop("disabled",false);
			obj.addClass("isUseful").removeClass("noUseful");
			obj.val("发送验证码");
			obj.attr("lesstime",0);
			$(".j-mobilesendBtn.isUseful").click(function () {
				do_withdraw_send($("#uc_withdraw_btn"));
			});
			$("#uc_withdraw_btn").attr("verify_code","");
			//wait = 60;
		} else {
			obj.prop("disabled", true);
			obj.addClass("noUseful").removeClass("isUseful");
			obj.val("重新发送(" + (wait-1) + ")");
			obj.attr("lesstime",wait-1);
			//wait--;
			setTimeout(function() {
				wtime(obj)
			}, 1000);
		}
	}

	function do_withdraw_send(btn)
	{
		var account = $(btn).attr("account");
		if($.trim($("#mobile").val())=="" && account!=1)
		{
			$.toast("请输入手机号码");
			return false;
		}
		if(lesstime>0)return;
		var query = new Object();
		query.mobile = $("#mobile").val();
		query.act = "send_sms_code";
		query.unique = $(btn).attr("unique");
		query.account = account;
		query.verify_code = (btn).attr("verify_code");
		$.ajax({
			url:AJAX_URL,
			data:query,
			type:"POST",
			dataType:"json",
			success:function(obj){
				if(obj.status==1)
				{
					$(btn).attr("lesstime",obj.lesstime);
					wtime(btn);
					$.toast(obj.info);

				}
				else
				{
					if(obj.status==-1)
					{
						get_verification_code(btn);
						$(".page-current #main1 #verify_image_box").show();

						if($(btn).attr("verify_code")&&$(btn).attr("verify_code")!="")
						{
							$.alert(obj.info,function(){
								$(btn).attr("verify_code","")
							});
						}
					}
					else
					{
						$.toast(obj.info);
					}

				}
			}
		});
	}

	function get_verification_code(btn){
		//刷新验证码
		$.ajax({
			url:VERIFICATION_CODE_URL,
			type:"POST",
			dataType:"json",
			success:function(obj){
				if(obj.status){
					$(".form-item").html(obj.html);
					$(".icon-list").click(function(){
						//选择验证码图标
						$(this).addClass('active').siblings().removeClass('active');
						var iconcode = $(this).find(".iconcode").attr("rel");
						$("input[name='verify_image']").val(iconcode);
						
					});
					$(".batch").click(function(){
						//选择验证码图标
						get_verification_code();
						
					});
					$("#verify_image_box").find("img").bind("click",function(){
						var rel = $(this).attr("rel");
						$(this).attr("src",rel+"&r="+Math.random());
					});
					$("#main1 #verify_image_box").find("input[name='confirm_btn']").unbind("click");
					$("#main1 #verify_image_box").find("input[name='confirm_btn']").bind("click",function(){
						var verify_code = $.trim($("#verify_image_box").find("input[name='verify_image']").val());
						if(verify_code==""){
							$.toast("请输入图形验证码");
						}else{
							$(btn).attr("verify_code",$("input[name='verify_image']").val());
							$("#main1 #verify_image_box .verify_form_box .form-item").html("");
	                        $("#main1 #verify_image_box").hide();
	                        do_withdraw_send(btn);

						}
					});
				}
			}
		});
	}

});



$(document).on("pageInit", "#uc_msg_index", function(e, pageId, $page) {
 refreshdata([".uc_msg_change"]);
});



$(document).on("pageInit", "#uc_refund_list", function(e, pageId, $page) {

	init_list_scroll_bottom();

	$(document).on('click', '.refund_view', function() {
		$.router.load($(this).attr('data-src'));
	})
});
/**
 * Created by lynn on 2016/11/17.
 * Update by YXM on 2016/11/28. 路由改版
 */
$(document).on("pageInit", "#uc_review", function(e, pageId, $page) {
    $(".tab-link").click(function () {
         $('.content').scrollTop(1);
    });

  var item_width = $(".j-tab-link.active").width();
	var item_left = $(".j-tab-link.active").offset().left;
	$(".tab-line").css({
		width: item_width,
		left: item_left
	});
	
    init_listscroll(".j_ajaxlist_1",".j_ajaxadd_1");
    init_listscroll(".j_ajaxlist_2",".j_ajaxadd_2");
    
  $(".page").on('click',".j-tab-link",function(){
    $(document).off('infinite', '.infinite-scroll-bottom');
    $('.tab-link').removeClass('active');
    $(this).addClass('active');
		var rel = $(this).attr("rel");
		var item_width=$(this).width();
		var item_left=$(this).offset().left;
		$(".tab-line").css({
			width: item_width,
			left: item_left
		});
		if($.trim($("#tab"+rel).html()) == ""){
			var ajax_url =url[rel];
			$.ajax({
				url:ajax_url,
				type:"POST",
				success:function(html)
				{
					$(".tabs").find(".tab").removeClass("active");
					$(".tabs").append($(html).find(".tabs").html());
					init_listscroll(".j_ajaxlist_"+rel,".j_ajaxadd_"+rel);
				},
				error:function()
				{
					$(".j_ajaxlist_"+rel).find(".page-load span").removeClass("loading").addClass("loaded").html("网络被风吹走啦~");
				}
			});
		} else{
			if($(".content").scrollTop()>0){
				infinite(".j_ajaxlist_"+rel,".j_ajaxadd_"+rel);
			}
		}
	});
    
});
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 吴庆祥
// +----------------------------------------------------------------------
// | FileName: 
// +----------------------------------------------------------------------
// | DateTime: 2017-05-08 19:07
// +----------------------------------------------------------------------
$(document).on("pageInit", "#uc_score_buy_score", function (e, pageId, $page) {
    //支付金额点击绑定
    $(".select_num").bind("click", function () {
        var money = getMoney($(this));
        if (!judge_account_money(money, 1))return;
        $(".money_number").removeClass("selected");
        $(this).addClass("selected");
        setScore(money);
		calFee();
    });
    if (score_number_array_other) {
        $(".select_other").picker({
            toolbarTemplate: '<header class="bar bar-nav">\
          <button class="button button-link pull-right close-picker">确定</button>\
          <h1 class="title">请选择金额</h1>\
          </header>',
            cols: [
                {
                    textAlign: 'center',
                    values: score_number_array_other
                }
            ],
            onClose: function () {
                var money = getMoney($(".select_other"));
                if (!judge_account_money(money, 0)) {
                    $(".select_other").val("");
                    return;
                } else {
                    setScore(money);
                }
            },
            onOpen: function () {
                var money = getMoney($(".select_other"));
                if (!judge_account_money(money, 0)) {
                    $(".select_other").picker("close");
                    return;
                }
                ;
                $(".money_number").removeClass("selected");
                $(".select_other").addClass("selected");
                setScore(money);
            }
        });
    }

    //支付按钮绑定
    $("input[name='all_account_money']").unbind('change').bind("change", function () {
        if (!$("#all_account_money").hasClass("active")){
            $("input[name='payment_id']").prop("checked",false);
            var money = getMoney();
            if (!judge_account_money(money, 1)) {
                $("input[name='all_account_money']").prop("checked", false);
                $("#all_account_money").removeClass("active");
                calFee();
                return;
            } else {
                calFee();
                $("#all_account_money").addClass("active");
            }
        }
    });
    $(".payment").unbind("click").bind("click", function () {
        $("input[name='payment_id']").prop("checked", false);
        $(this).siblings("input[name='payment_id']").prop("checked", true);
        $("input[name='all_account_money']").prop("checked", false);
        $("#all_account_money").removeClass("active");
        calFee();
    });
    $("#submit").bind("click", function () {
        var $form = $("form[name=buy_score]");
        //判断数据
        if ($(".money_number.selected").length < 1) {
            $.toast("请选择充值金额!");
            return;
        }
        if (!$("input[name=all_account_money]:checked").val() && !$("input[name=payment_id]:checked").val()) {
            $.toast("请选择充值方式!");
            return;
        }
        var url = $form.attr("data-action");
        var data = $form.serialize();
        $.ajax({
            url: url,
            data: data,
            type: "POST",
            dataType: "json",
            success: function (data) {
                if (data.status == 1) {
                    if (data.app_index == 'wap') {  //SKD支付做好后，用 App.pay_sdk支付
                        if (data.pay_status == 1) {
                            $.router.load(data.jump, true);
                        } else {
                            location.href = data.jump;
                        }
                    } else if (data.app_index == 'app' && data.pay_status == 1) {  //APP余额支付
                        $.router.load(data.jump, true);

                    } else if (data.app_index == 'app' && data.pay_status == 0) {  //APP第三方支付
                        if (data.online_pay == 3) {
                            try {
                                var str = pay_sdk_json(data.sdk_code);
                                App.pay_sdk(str);
                            } catch (ex) {
                                $.toast(ex);
                                $.loadPage(location.href);
                            }
                        } else {
                            var pay_json = '{"open_url_type":"1","url":"' + data.jump + '","title":"' + data.title + '"}';
                            try {
                                App.open_type(pay_json);
                                $.confirm('已支付完成？', function () {
                                    $.loadPage(location.href);

                                }, function () {

                                    $.loadPage(location.href);
                                });
                            } catch (ex) {
                                $.toast(ex);
                                $.loadPage(location.href);
                            }
                        }
                    }
                } else {
                    $.alert(data.info);
                }
                return false;
            }, error: function () {
                $.showErr("服务器提交错误");
            }
        })

    });
    function intval(p) {
        if (!p)return 0;
        if (typeof p == "number") {
            return parseInt(p);
        } else if (typeof p == "string") {
            return parseInt(p.replace(/[^0-9\.]*/ig, ""));
        }
    }

    function getMoney($this) {
        if (!$this) {
            $this = $(".money_number.selected");
        }
        var money = 0;
        if ($this.hasClass("select_other")) {
            money = intval($this.val())
        } else {
            money = intval($this.attr("data-money"));
        }
        return money;
    }

    function setScore(val) {
        calFee();
        if (val) {
            $("input[name=money]").val(val);
            var usable = val * usable_score + "积分";
            var frozen = val * frozen_score + "积分";
        } else {
            $("input[name=money]").val(0);
            var usable = "请选择购买金额";
            var frozen = "请选择购买金额";
        }
        $(".usable").html(usable);
        $(".frozen").html(frozen);

    }

    function judge_account_money(money, money_number_selected) {
        if ($("input[name=all_account_money]:checked").val()) {
            if (intval($("input[name=all_account_money]:checked").val()) > money) {
                return 1;
            } else {
                $.toast("会员余额不足");
                if (!money_number_selected) {
                    setScore(0);
                }
                return 0;
            }
        } else {
            return 1;
        }
    }
    function calFee() {
        $('.fee-box').hide();
        var money = Number($("input[name=money]").val());
        var payment_id=Number($("input[name=payment_id]:checked").val());
        if(!payment_id || isNaN(payment_id) ||!money)return;

        var fee_type = Number($('#fee_type_'+payment_id).val());
        var fee_amount = Number($('#fee_amount_'+payment_id).val());

        var fee_money = 0;
        if (fee_type === 1) {
            fee_money = money * fee_amount;
        } else {
            fee_money = fee_amount;
        }
        fee_money = Math.round(fee_money * 100) / 100;
        if (fee_money > 0) {
            $('.fee-box .money').html(fee_money);
            $('.fee-box').show();
        }
    }
});

$(document).on("pageInit", "#uc_share", function(e, pageId, $page) {
	loadScript(jia_url);
	$(".content").scroller('refresh');
	$(".social_share").find(".flex-1").click(function(){
		$(".weixin-share-close").hide();
		$(".weixin-share-tip").hide();
		$(".flippedout").removeClass("z-open").removeClass("showflipped");
		$(".box_share").removeClass("z-open");
	});
	$(".j-weixin-share").on('click', function() {
		$(".weixin-share-close").show();
		$(".weixin-share-tip").show();
		$(".flippedout").addClass("z-open").addClass("showflipped");
	});
	$(".j-flippedout-close").on('click', function() {
		$(".weixin-share-close").hide();
		$(".weixin-share-tip").hide();
	});
});

$(document).on("pageInit", "#uc_store_pay_order", function(e, pageId, $page) {
	init_list_scroll_bottom();
});
$(document).on("pageInit", ".page", function(e, pageId, $page) {
	$(".page").on('click',".j-tab-link",function(){
		var rel = $(this).attr("rel");
		var con_width = $(this).parent().width();
		var item_width = $(this).width();
		var left = con_width - item_width;
		if(rel != 1){
			$(".float-line").css("left",left);
		}else{
			$(".float-line").css("left",0);
		}
	});

	$(".content").on('click',".j-show-more-quan",function(){
		var isOpen = $(this).hasClass("isOpen");
		if (isOpen) {
			$(this).removeClass("isOpen");
			var con_height = $(this).height();
			$(this).siblings(".quan-show").height(con_height);
			$.refreshScroller();
			$(".j-show-more-quan em").html("点击展开");

		} else {
			$(this).addClass("isOpen");
			var con_height = $(this).siblings(".quan-show").children(".quan-list").height();
			$(this).siblings(".quan-show").height(con_height);
			$.refreshScroller();
			$(".content").scroller('refresh');
			$(this).children("em").html("点击收起");

		}
	});

	$(".content").on('click',".j-open-quaninfo",function(){
		$(".pop-up").addClass("open");
		var src = $(this).attr("data");
		var id = $(this).attr("data-id");
		$(".pop-up").children(".img-box").addClass("open");
		$(".j-pop-img").attr("src",src);
		$(".j-quan-id").html(id);
		$(".content").addClass("noscroll");
	});

	$(".page").on('click',".close-pop,.j-close-pop-btn",function(){
		var rel = $(this).attr("rel");
		$(".pop-up").children(".img-box").removeClass("open");
		$(".pop-up").removeClass("open");
		if (rel == "ecv") {
			$(".input-ecv-exchange").val("");
		}else{
			$(".j-quan-id").html("");
			$(".content").removeClass("noscroll");
			setTimeout(function(){
				$(".j-pop-img").attr("src","");
			},300);
		}
	});
});
$(document).on("pageInit", "#uc_youhui", function(e, pageId, $page) {
	
	$(".content").scrollTop(1);
	if($(".content").scrollTop()>0){
		init_listscroll(".j-ajaxlist-"+type,".j-ajaxadd-"+type);
	}
	
	$(".page").on('click',".j-list-choose",function(){
    	$(document).off('infinite', '.infinite-scroll-bottom');
		var rel = $(this).attr("rel");
		$(".j-list-choose").removeClass('active');
	    $(this).addClass('active');
	    tab_line();
		if($.trim($(".j-ajaxlist-"+rel).html()) == ""){
			var ajax_url =url[rel];
			$.ajax({
				url:ajax_url,
				type:"POST",
				success:function(html)
				{
					$(".m-youhui-list").addClass("hide");
					$(".content").append($(html).find(".content").html());
					$(".content").scrollTop(1);
					if($(".content").scrollTop()>0){
						init_listscroll(".j-ajaxlist-"+rel,".j-ajaxadd-"+rel);
					}
				},
				error:function()
				{
					$(".j-ajaxlist-"+rel).find(".page-load span").removeClass("loading").addClass("loaded").html("网络被风吹走啦~");
				}
			});
		} else{
			$(".m-youhui-list").addClass("hide");
			$(".j-ajaxlist-"+rel).removeClass("hide");
			$(".content").scrollTop(1);
			if($(".content").scrollTop()>0){
				infinite(".j-ajaxlist-"+rel,".j-ajaxadd-"+rel);
			}
		}
	});
	
    function tab_line() {
	    var init_width=$(".j-list-choose.active span").width();
		var init_left=$(".j-list-choose.active span").offset().left;
		$(".list-nav-line").css({
		      width: init_width,
		      left: init_left
		    });
    }
	tab_line();
	    
	$(".j-youhui").on('click', function() {
	  $(".youhui-link").removeClass('hide');
	  $(".ecv-link").addClass('hide')
	});
	$(".j-ecv").on('click', function() {
	  $(".ecv-link").removeClass('hide');
	  $(".youhui-link").addClass('hide')
	});
	//打开弹层
	$("#uc_youhui").on('click', '.j-support-shop', function() {
	  $(".youhui-mask").addClass('active');
	  $(".support-shop-box").addClass('active');
	  var url=$(this).attr("ajax-url");
	  get_location(url);
	});
	$("#uc_youhui").on('click', '.j-qrcode', function() {
	  $(".youhui-mask").addClass('active');
	  $(".qrcode-box").addClass('active');
	  $(".qrcode-box").find(".youhui-code").html("券码："+$(this).attr("data-sn"));
	  $(".qrcode-box").find(".qrcode img").attr("src",$(this).attr("img-url"));
	  
	  var url=$(this).attr("ajax-url");
	  get_location(url);
	  
	});
	$("#uc_youhui").on('click', '.j-close-mask', function() {
	  $(".youhui-mask").removeClass('active');
	  $(".support-shop-box").removeClass('active');
	  $(".qrcode-box").removeClass('active');
	});
});
function get_location(url){
	$.ajax({
        url:url,
        type:"POST",
        dataType:"json",
        success:function(obj)
        {
        	$(".support-list").empty();
      
        	if(obj.location_info){
        		var length=obj.location_info.length;
        		$(".support-hd").html('本券限以下实体店到店消费使用');
        		var location_li="";
	        	for(var i=0;i<length;i++){
	        		location_li+="<li class='flex-box'>"
									+"<div class='shop-info flex-1 r-line'>"
									+"<a href='"+obj['location_info'][i]['jump']+"'><p class='shop-name'>"+obj['location_info'][i]['name']+"</p></a>"
									+"<p class='shop-address'>"+obj['location_info'][i]['address']+"</p>"
									+"</div><a href='tel:"+obj['location_info'][i]['tel']+"' class='iconfont'>&#xe618;</a></li>";
	        	}
	        	$(location_li).appendTo($(".support-list"));
        	}else{
        		$(".support-hd").html('');
        	}
        }
    });
}
/**
 * Created by Administrator on 2016/11/4.
 */

$(document).on("pageInit", "#user_center", function(e, pageId, $page) {

    refreshdata([".j-order-lamp .swiper-wrapper",".cenList"]);
    $(".u-prompt .pro_close_btn").click(function () {
        $(".u-prompt").addClass("u-trans");
    });
    
    
    var order_child=$(".j-order-lamp .orderShow").length;
    var _width=$(".cenList .list_href").width();
    
    if(order_child<6){
        $("#user_center .orderBox").addClass("orderthan");
    }

    var swiper = new Swiper('.j-order-lamp', {
        scrollbarHide: true,
        slidesPerView: 'auto',
        centeredSlides: false,
        grabCursor: true
    });

   /* $(".is_read").click(function(){
    	$(this).find(".s_number").remove();
    });*/
    $(".content").off("click", ".fun-check-login");
    $(".content").on("click", ".fun-check-login",function () {
        var data_url = $(this).attr("data-url");
        if(is_login==0){
            if(app_index=="app"){
                App.login_sdk();
            }else{
                $.router.load(login_url, true);
            }
        }else{

            $.router.load(data_url, true);
            //window.location = data_url;
            //window.location=data_url;
        }
    });
   //  $(".fun-check-login").off("click");
   // $(".fun-check-login").on("click",".content .commonBox",function () {
   //     alert(22);
   //     var data_url = $(this).attr("data-url");
   //     if(is_login==0){
   //         if(app_index=="app"){
   //             $.toast("清先登录");
   //             App.login_sdk();
   //         }else{
   //             $.router.load(login_url, true);
   //         }
   //     }else{
   //         $.loadPage(data_url);
   //         //window.location=data_url;
   //     }
   // });
});
function setTab(name,cursel,n){
	 for(i=1;i<=n;i++){
	  var menu=document.getElementById(name+i);
	  var con=document.getElementById("con_"+name+"_"+i);
	  menu.className=i==cursel?"hover":"";
	  con.style.display=i==cursel?"block":"none";
	 }
}

$(document).on("pageInit", "#user_login_old", function(e, pageId, $page) {
	$(document).on('click','.open-popup', function () {
	var url=$(".open-popup").attr("data-src");
	  $.ajax({
	    url:url,
	    type:"POST",
	    success:function(html)
	    {
	      //console.log("成功");

	      $(".popup-agreement .protocol").html($(html).find(".content .protocol").html());
	      $(".popup-agreement .title").html($(html).find(".title").html());
	    },
	    error:function()
	    {

	    	$(".popup-agreement").html("网络被风吹走啦~");
	      //console.log("加载失败");
	    }
	  });
	});
	$("#com_login_box").bind("submit",function(){

		var user_key = $.trim($(this).find("input[name='user_key']").val());
		var user_pwd = $.trim($(this).find("input[name='user_pwd']").val());
		if(user_key=="")
		{
			$.showErr("请输入登录帐号");
			return false;
		}
		if(user_pwd=="")
		{
			$.showErr("请输入密码");
			return false;
		}

		var query = $(this).serialize();
		var ajax_url = $(this).attr("action");
		$.ajax({
			url:ajax_url,
			data:query,
			type:"POST",
			dataType:"json",
			success:function(obj){
				if(obj.status)
				{
					$.showSuccess(obj.info,function(){
						location.href = obj.jump;
					});
				}
				else
				{
					$.showErr(obj.info);
				}
			}
		});

		return false;
	});
	$("#ph_login_box").bind("submit",function(){

		var mobile = $.trim($(this).find("input[name='mobile']").val());
		var sms_verify = $.trim($(this).find("input[name='sms_verify']").val());
		if(mobile=="")
		{
			$.showErr("请输入手机号");
			return false;
		}
		if(sms_verify=="")
		{
			$.showErr("请输入收到的验证码");
			return false;
		}

		var query = $(this).serialize();
		var ajax_url = $(this).attr("action");
		$.ajax({
			url:ajax_url,
			data:query,
			type:"POST",
			dataType:"json",
			success:function(obj){
				if(obj.status)
				{
					$.showSuccess(obj.info,function(){
						location.href = obj.jump;
					});
				}
				else
				{
					$.showErr(obj.info);
				}
			}
		});

		return false;
	});



});
$(document).on("pageInit", "#user_register", function(e, pageId, $page) {
	$(document).on('click','.open-popup', function () {
	var url=$(".open-popup").attr("data-src");
	  $.ajax({
	    url:url,
	    type:"POST",
	    success:function(html)
	    {
	      //console.log("成功");

	      $(".popup-agreement .protocol").html($(html).find(".content").html());
	      $(".popup-agreement .title").html($(html).find(".title").html());
	    },
	    error:function()
	    {

	    	$(".popup-agreement").html("网络被风吹走啦~");
	      //console.log("加载失败");
	    }
	  });
	});
	$("#register_box").bind("submit",function(){

		var email = $.trim($(this).find("input[name='email']").val());
		var user_name = $.trim($(this).find("input[name='user_name']").val());
		var user_pwd = $.trim($(this).find("input[name='user_pwd']").val());
		var cfm_user_pwd = $.trim($(this).find("input[name='cfm_user_pwd']").val());
		if(user_pwd=="")
		{
			$.showErr("请输入密码");
			return false;
		}
		if(user_pwd!=cfm_user_pwd)
		{
			$.showErr("密码输入不匹配，请确认");
			return false;
		}
		if(email=="")
		{
			$.showErr("请输入邮箱地址");
			return false;
		}
		if(user_name=="")
		{
			$.showErr("请输入用户名");
			return false;
		}
		
		var query = $(this).serialize();
		var ajax_url = $(this).attr("action");
		$.ajax({
			url:ajax_url,
			data:query,
			type:"POST",
			dataType:"json",
			success:function(obj){
				if(obj.status)
				{
					$.showSuccess(obj.info,function(){
						location.href = obj.jump;
					});					
				}
				else
				{
					$.showErr(obj.info);
				}
			}
		});
		
		return false;
	});
	
	
	
});
$(document).on("pageInit", "#visiting_service", function(e, pageId, $page) {
	init_auto_load_data();
	var mySwiper = new Swiper('.j-index-banner', {
		speed: 400,
		spaceBetween: 0,
		pagination: '.swiper-pagination',
		autoplay: 2500
	});
	var mySwiper = new Swiper('.j-index-lb', {
	    speed: 400,
	    spaceBetween: 0,
		autoplay: 2500
	});
/*商家设置头部列表*/
var mySwiper = new Swiper('.j-sort_nav', {
    speed: 400,
    spaceBetween: 0
});

});
$(document).on("pageInit", "#visiting_service_detail", function(e, pageId, $page) {
	//打开送货时间选择
	select_box($(".j-open-time"),$(".time-select"));
    
    //关闭送货时间选择
    $(".j-close-time").on('click', function() {
        $(".dc-mask").removeClass('active');
        $(".time-select").removeClass('active');
        $(".describe").removeClass('active');
    });
    //选择日期
    $(".j-day-item").on('click', function() {
        $(".time-select .select-time").removeClass("vs-show");
        $(".time-select .select-time").eq($(this).index()).addClass("vs-show");
        $(".select-day li").removeClass('active');
        $(this).addClass('active');
    });
    //选择时间
    $(".j-time-choose").on('click', function() {
        if ($(this).hasClass('no_click')) {
            return false;
        }
        $(".j-time-choose").removeClass('active');
        $(this).addClass('active');

        var day_item = $(".j-day-item").eq($(this).parent().index()-2);
        $(".j-close-box").removeClass('active');
        $(day_item).addClass('active');
        var day_obj = $(day_item).find('p');
        $(".j-send-day").html(day_obj.html());
        $(".j-send-time").html($(this).find('p').html());
        
        $('input[name="rs_date"]').val($(day_item).attr('long-date'));
        $('input[name="tid"]').val($(this).attr('data-id'));
    });
    //打开服务描述
    select_box($(".j-open-describe"),$(".describe"));
    //打开服务项目
    select_box($(".j-open-porject"),$(".m-porject"));
    $('.j-select-porject').on('click', function() {
        $('.j-select-porject').removeClass("active");
        $(this).addClass('active');
        $(".j-close-box").removeClass('active');
        $(".m-porject").removeClass('active');
        var _project = $(this).find('.porject-list-name').html();
       $('.porject-name').html(_project);
    });
    
	loadScript(jia_url);
	$(".j-activeopen").attr("style","");
	$('.content').scrollTop(0);
	//获得默认库存
	var defaultStock=$(".spec-goodstock").text();
	//收藏
	//二维码
	select_box($(".j-open-qrcode"),$(".m-qrcode-box"));

	/*轮播初始化*/
	var mySwiper = new Swiper ('.j-deal-content-banner', {

		autoplay: 3000,/*设置3秒自动播放*/
		spaceBetween: 10,/*图间间隔10px*/
		onSlideChangeStart: function(swiper){/*回调函数：开始变化*/
			slideIndex();
		}
	});


	/*
	 *初始化轮播分页器
	*/
	slideIndex();


	/*
	 *初始化商家标签区是否显示更多图标
	*/
	setFuliIcon();


	/*
	 *显示更多商家标签与商家优惠
	 *用户点击显示区域，下拉显示更多信息，再次点击收起更多信息
	 *区域标识，用于区分商家标签与商家优惠  1：商家优惠   2：商家标签
	*/
	$(".j-activeopen").click(function(){
		var rel = $(this).attr("rel");//区域标识

		if(rel == 1){
			var childlengh = $(this).children("li").length;
		}else if (rel == 2) {
			var allliwidth = 0;
			$(this).children("li").each(function(){
				allliwidth += (parseInt($(this).width()) + parseInt($(this).css("margin-right").replace("px","")));
			});

			var ulwidth = $(this).width();
			var childlengh = Math.ceil(allliwidth / ulwidth);
		}

		var thisheight = $(this).height();
		var childheight = $(this).children("li").height();
		var childmargin = parseInt($(this).children("li").css("margin-top").replace("px",""));
		if(childlengh > 1){
			if($(this).hasClass("isClick")){
				$(this).removeClass("isClick");
				$(this).height(childheight + childmargin * 2);
			}else{
				$(this).addClass("isClick");
				$(this).height((childheight * childlengh)  + (childmargin * (childlengh + 1)));
			}
		}
	});


	/*
	 *显示当前商家更多团购信息
	 *用户点击显示区域，下拉显示更多信息，再次点击收起更多信息
	*/

	$(".j-tuan-showMore").click(function(){
		var childheight = $(this).parent().children(".tuan-list").children("li").height();  //子项高度，用于计算更多高度
		var childlengh = $(this).parent().children(".tuan-list").children("li").length;     //子项个数，用于计算更多高度

		if (childlengh > 1) {
			if($(this).hasClass("isClick")){
				$("#other").html($("#other").attr("content"));
				$(this).removeClass("isClick");
				$(this).parent().children(".tuan-list").height(childheight);
			}else{
				$("#other").html("收起");
				$(this).addClass("isClick");
				$(this).parent().children(".tuan-list").height(childheight * childlengh);
			}
		}
	});

	/*
	 *tab切换时下划线跟随
	*/
	var t_height=$(".m-head-nav").height();
	var s_height=$(".deal-detail").offset().top;
	$(".j-tab-link").click(function(){
        var $me=$(this);
		var type = $(this).parent(".tab-list").attr("data-type");
		var rel = parseInt($(this).attr("rel"));
		if(rel == 0){
			$(".content").scrollTop(0);
            tab_lick_callback($me,type,rel);
        }
        else if (rel == 1) {
			$(".content").scrollTop(s_height-t_height);
            tab_lick_callback($me,type,rel);
        }
        else{
            tab_lick_callback($me,type,rel);
        }
        if ($me.hasClass("active")) {
			var ac_left = $(".j-tab-link.active").offset().left;
			$('.m-head-nav .tab-line').css("left",ac_left);
        }
	});
	var ac_left = $(".j-tab-link.active").offset().left;
	var ac_width = $(".j-tab-link.active").width();
	$('.m-head-nav .tab-line').css({"left":ac_left,"width":ac_width});
    /**
     * 异步加载点评列表
     */
    function ajax_load_tab3(){
        $.post(get_dp_detail_url,"",function(data){
           var $html=$(data);
           if($html.length){
               $("#tab3").html($html.find("#tab3").html());
               $("#dp_list_click").html($html.find("#dp_list_click").html());
           }
        });
    }
    ajax_load_tab3();

    function tab_lick_callback($me,type,rel){
        $(".j-tab-link").removeClass("active");
        $me.addClass("active");
        setTablineLeft($me.parent(),type,rel);
    }

	$(".j-detail").live("click",function(){
		var index = $(this).attr("data");
		var type = $(this).attr("data-type");
		$(".native-scroll").scrollTop(0);
		setTablineLeft($(".tab-list"),type,index);
		$(".tab-link").eq(index).addClass("active");
	});
    /**
     * 加载推荐列表
     */
    function load_recomend_data(){
        $.get(get_recommend_data_url,"",function(data){
            var html=$(data).html();
            if(html){
                $("#recommend_data").html(html);
            }
        });
    }
    load_recomend_data();
	/*倒计时*/
	leftTimeAct();
	
	var leftTimeObj = setInterval(leftTimeAct,1000);
	function leftTimeAct(){
		var leftTime = parseInt($(".AdvLeftTime").attr("data"));
		
		if(leftTime > 0)
		{
			var day  = parseInt(leftTime / 24 /3600);
			var hour = parseInt((leftTime % (24 *3600)) / 3600);
			var min  = parseInt((leftTime % 3600) / 60);
			var sec  = parseInt((leftTime % 3600) % 60);
			if(day<10){
				day="0"+day;
			}
			if(hour<10){
				hour="0"+hour;
			}
			if(min<10){
				min="0"+min;
			}
			if(sec<10){
				sec="0"+sec;
			}
			$(".AdvLeftTime").find(".day").html(day);
			$(".AdvLeftTime").find(".hour").html(hour);
			$(".AdvLeftTime").find(".min").html(min);
			$(".AdvLeftTime").find(".sec").html(sec);
			leftTime--;
			$(".AdvLeftTime").attr("data",leftTime);
		}
		else{
			$(".AdvLeftTime").html('团购已结束');			
			clearInterval(leftTimeObj);
		}
	}


	/*
	 *底部加入购物车按钮
	*/
	$(".j-addcart").click(function(){
		$(".j-flippedout-close").attr("rel","spec");
		$(".j-spec-choose-close").attr("rel","spec");
		$(".flippedout-spec").addClass("showflipped").addClass("z-open");
		$(".spec-choose").addClass("z-open");
		$(".spec-btn-list").addClass("isAddCart");
		$(".totop").addClass("vhide");//隐藏回到头部按钮
	});

	init_addcart();
	/*
	 *底部立即购买按钮
	 *如未在规格选择按钮选择完所有属性，将规格选择窗口关闭，再次点击购买按钮则会再次弹出规格选择窗口
	 *如果在规格选择窗口选择完所有属性，则进行购买操作，不再弹出规格选择窗口
	 */
	$(".j-nowbuy").click(function(){
		if(is_login==0){
			if(app_index=="app"){
				App.login_sdk();
			}else{
				$.router.load(login_url, true);
			}
			return false;
		}
		var data_num = $(".choose-list").length;//获取属性个数
			//  未选择完商品属性，执行弹出规格选择窗口
			$(".j-flippedout-close").attr("rel","spec");
			$(".j-spec-choose-close").attr("rel","spec");
			$(".flippedout-spec").addClass("showflipped").addClass("z-open");
			$(".spec-choose").addClass("z-open");
			$(".totop").addClass("vhide");//隐藏回到头部按钮
	});
	$(".nowbuy").click(function(){
		var data_num = $(".choose-list").length;//获取属性个数
		//var choose_num = $(".good-specifications span em").length; //获取已选属性个数
		var choose_num = $(".flippedout-spec .spec-goodspec em.choose_item").length; //获取已选属性个数
		if (choose_num < data_num) {
			//  未选择完商品属性，执行弹出规格选择窗口
			$.toast("请选择商品规格");
		}else{
			// 已经选择完商品属性，执行购买操作
			now_buy=1;
			$("#goods-form").submit();
		}
	});
	$(".isOk,a.joincart").click(function(){
		var data_num = $(".choose-list").length;//获取属性个数
		//var choose_num = $(".good-specifications span em").length; //获取已选属性个数
		var choose_num = $(".flippedout-spec .spec-goodspec em.choose_item").length; //获取已选属性个数
		if (choose_num < data_num) {
			//  未选择完商品属性，执行弹出规格选择窗口
			$.toast("请选择商品规格");
		}else{
			// 已经选择完商品属性，执行购买操作
			$("input[name='type']").val("1");
			now_buy=0;
			$("#goods-form").submit();
		}
	});

	/*
	 *规格选择窗口 加减按钮事件
	 */
	$(".flippedout-spec").on('click',".j-add-miuns",function(){
		fun_add_miuns($(this));

		var max=parseInt($(this).attr("max-num"));
		//alert($(".numplusminus").val());
		if(max>=0 && parseInt($(".numplusminus").val())>=max){
			$(this).attr("class","numadd add-miuns j-add-miuns j-add isUse");
			$(".numplusminus").val(max);
		}else{
			setSpecgood();
		}

	});
	$(".choose-list .j-choose").click(function(){
		if($(this).hasClass("active")){ //点击已选择属性，则取消选择
			$(this).removeClass("active");
			$(this).parent().siblings(".spec-tit").addClass("unchoose");
			setSpecgood();
		}else if(!$(this).hasClass("isOver")){
			//判断是否是无库存属性，
			//如果不是无库存则正常选择，无库存属性不做任何操作
			$(this).siblings(".j-choose").removeClass("active");
			$(this).addClass("active");
			$(this).parent().siblings(".spec-tit").removeClass("unchoose");
			setSpecgood();
		}
		var data_value= $(".j-choose.active").attr("data-value");
		var data_id= $(this).attr("data-id");
		$(this).parent().siblings("input.spec-data").val(data_id);
		var data_value = []; // 定义一个空数组
		var txt = $('.j-choose.active'); // 获取所有文本框
		for (var i = 0; i < txt.length; i++) {
			data_value.push(txt.eq(i).attr("data-value")); // 将文本框的值添加到数组中
		}

		if (txt.length == 0) {//非初始化状态时，未选择属性页面操作区内容同步规格选择窗口内容
			$(".good-specifications span").empty();
			$(".good-specifications span").removeClass("isChoose");
			$(".good-specifications span").html($(".spec-goodspec").html());
		}else{//将已选择属性显示在页面操作区
			$(".good-specifications span").empty();
			$(".good-specifications span").addClass("isChoose");
			$(".good-specifications span").append("<i class='gray'>已选规格：</i>");
			$.each(data_value,function(i){
				$(".good-specifications span").append("<em class='tochooseda'>" + data_value[i] + "</em>");
				//传值可以考虑更改这里
				//$(".spec-data").attr("data-id-str"+[i],data_value[i]);
			});
		}
	});





	setSpecgood();
	function setSpecgood() {
		if($(".unchoose").length != 0){
			$(".spec-goodspec").empty();
			$(".spec-goodspec").append("请选择");
			$(".spec-goodstock").text(defaultStock);
			$(".spec-goodprice").text("￥"+deal_price.toFixed(2));
			$("input[name='max_bought']").val("0");
			$(".spec-btn-list").removeClass("isNo");
			$(".spec-btn-list div.noStock").text("确定");
			$(".unchoose").each(function(){
				// 选择<em></em>
				$(".spec-goodspec").append("<em>&nbsp;&nbsp;" + $(this).html() + "</em>");
			});
		}else{
			$(".spec-goodspec").empty();
			$(".spec-goodspec").append("已选择");
			$(".j-choose.active").each(function(){
				$(".spec-goodspec").append("<em class='choose_item'>&nbsp;&nbsp;" + $(this).attr("data-value") + "</em>");
			});
			//开始计算属性库存
			//var pirce=parseFloat(deal_price);
			//$(".choose-list .active").each(function(){
			//	pirce+=parseFloat($(this).attr("pirce"));
			//	$(".spec-goodprice").text("￥"+pirce.toFixed(2));
			//});

			if($(".choose-list").length!=0)
			init_buy_ui();//检测库存
			init_submit_btn_status();
		}
	}

	//库存检测-更新面板-改变按钮状态
	function init_buy_ui(){
			var is_stock = true;      //库存是否满足
			var stock = deal_stock;   //无规格时的库存数
			var deal_show_price = deal_price;
			var deal_show_buy_count = deal_buy_count;
			var deal_remain_stock = -1;  //剩余库存 -1:无限

			var attr_checked_ids = []; // 定义一个空数组
			var txt = $('.j-choose.active'); // 获取所有选中对象
			for (var i = 0; i < txt.length; i++) {
				attr_checked_ids.push($('.j-choose.active').eq(i).attr("data-id")); // 将文本框的值添加到数组中
			}
			var attr_checked_ids = attr_checked_ids.sort(); //排序
			var attr_checked_ids_str = attr_checked_ids.join("_");//转字符串 _ 分割
			var attr_spec_stock_cfg = deal_attr_stock_json[attr_checked_ids_str];
			if(attr_spec_stock_cfg)
			{
				deal_show_buy_count = attr_spec_stock_cfg['buy_count'];
				stock = attr_spec_stock_cfg['stock_cfg'];
				$(".spec-goodprice").text("￥"+(parseFloat(deal_price)+parseFloat(attr_spec_stock_cfg['price'])).toFixed(2));
			}
			else
			{//单个属性库存
				var has_stock_attr = false;
				for(var k=0;k<attr_checked_ids.length;k++)
				{
					var key = attr_checked_ids[k];
					attr_spec_stock_cfg = deal_attr_stock_json[key];
					if(attr_spec_stock_cfg)
					{
						stock = attr_spec_stock_cfg['stock_cfg'];
						has_stock_attr = true;
						break;
					}
				}
				if(!has_stock_attr)
				stock = -1;
			}
			//判断库存是否大于0
			//更新库存显示
			//判断库存，并更新数量显示
			//判断库存是否小于最小购买量，表示库存不足
			if(stock>0){
				$(".spec-goodstock").text("库存:"+stock+"件");
				$(".j-add-miuns").attr("max-num",stock);
				var num=parseInt($(".numplusminus").val());
				//alert(num);
				if(num>stock){
					$(".numplusminus").val(stock);
				}else if(num==0){
					$(".numplusminus").val(1);
				}
			}else{
				if(stock==-1){
					$(".spec-goodstock").text("库存:不限");
					$(".j-add-miuns").attr("max-num",100);
				}
				else{
					$(".spec-goodstock").text("库存:0 件");
					$(".j-add-miuns").attr("max-num",0);
					$(".numplusminus").val(0);
				}
			}
			$("input[name='max_bought']").val(stock);


	}
	//初始化购物车等相关提交按钮状态
	function init_submit_btn_status(){

			var is_stock=true;
			var deal_remain_stock=parseInt($("input[name='max_bought']").val());
			var buy_num=parseInt($("input[name='num']").val());
			var str='';
			if(deal_remain_stock>=0)
			{
                   if(buy_num>deal_remain_stock)
				{
					is_stock = false;
					str="库存不足";
				}
				else if(deal_user_max_bought>0&&buy_num>deal_user_max_bought)
				{
					is_stock = false;
					str="每单最多购买"+deal_user_max_bought+"份";
				}
			}
			else
			{
                   if(deal_user_max_bought>0&&buy_num>deal_user_max_bought)
				{
					is_stock = false;
					str="每单最多购买"+deal_user_max_bought+"份";
				}
			}
			//alert(11);
			if(is_stock){
				$(".spec-btn-list").removeClass("isNo");
			}else{
				$(".spec-btn-list").addClass("isNo");
				$(".spec-btn-list div.noStock").text(str);
			}

	}


	/*
	 *底部收藏按钮
	 *如果已经收藏则执行以下操作，否则本阶段不执行操作
	 */
	 $(".j-collection").click(function(){
		var is_del = $(this).attr("data-isdel");
		if(is_del == 1){
			//打开取消框
			$(".flippedout").addClass("z-open");
			$(".flippedout").addClass("showflipped");
			$(".cancel-shoucan").addClass("z-open");
		}else{
			if(is_login==0){
				if(app_index=="app"){
					App.login_sdk();
				}else{
					$.router.load(login_url, true);
				}
			}else{
				deal_add_collect(deal_id);
			}
		}
	});

	$(".j-head-collect").on("click",function(){
		var is_del = $(this).attr("data-isdel");
		$(".cancel-shoucan").attr("data-ishead",1);
		if(is_del == 1){
		 	//打开取消框
			$(".cancel-shoucan").addClass("z-open");
		}else{
			if(is_login==0){
				if(app_index=="app"){
					App.login_sdk();
				}else{
					$.router.load(login_url, true);
				}
			}else{
				deal_add_collect(deal_id);
			}
		}
	});

	/*
	 *取消收藏按钮弹出后的取消
	*/

	$(".cancel-shoucan .j-cancel").click(function(){
		var is_head = $(".cancel-shoucan").attr("data-ishead");
		if(is_head != 1){
			$(".flippedout").removeClass("z-open");
			$(".flippedout").removeClass("showflipped");
			$(".cancel-shoucan").removeClass("z-open");
		}else{
			$(".cancel-shoucan").removeClass("z-open");
			$(".cancel-shoucan").attr("data-ishead",0);
		}
	});

	/*
	 *取消收藏按钮弹出后的确认
	*/

	$(".cancel-shoucan .j-yes").click(function(){
		var is_head = $(".cancel-shoucan").attr("data-ishead");
		deal_del_collect(deal_id);
		if(is_head != 1){
			$(".flippedout").removeClass("z-open");
			$(".flippedout").removeClass("showflipped");
			$(".cancel-shoucan").removeClass("z-open");
		}else{
			$(".cancel-shoucan").removeClass("z-open");
			$(".cancel-shoucan").attr("data-ishead",0);
			$(".flippedout").removeClass("showflipped").removeClass("dropdowm-open");
			$(".m-nav-dropdown").removeClass("showdropdown");
			$(".nav-dropdown-con").removeClass("dropdown-open");
		}
	});


	// 评价页滚动加载
	var stop=true;
	//var ajax_url=ajax_url;
	function ajax_dp_list(){
		var page=2;
		var page_total = 0;
		var pageload=$(".page-load");
		if (pageload.length==0) {
			var loadhtml="<div class='page-load hide'><span class='loading'>"+"</span></div>"
			$(".j-ajaxlist").append(loadhtml);
		};
		$(document).on('infinite',function() {

			if ($("#tab3").hasClass("active")) {
			$(".page-load").removeClass("hide");
			    if(stop==true){ 
			        stop=false; 
			        var query = new Object();
			        query.data_id = deal_id;
			        query.page = page;
			        query.act="ajax_dp_list";
			        query.dpajax = 1;
			        $.ajax({
		                url: ajax_url,
		                data: query,
		                type: "POST",
		                dataType: "json",
		                success: function (obj) {
		                	if (obj.html != '') {
		                		$(".page-load span").removeClass("loaded").addClass("loading").html("");
			                    $(".j-ajaxadd").append(obj.html);    
			                    stop=true;
			                    page++;
		                	} else {
		                		$(".page-load span").removeClass("loading").addClass("loaded").html("拉到底部啦~");
		                	}
		                },
		                error: function() {
		                    $(".page-load span").html("网络被风吹走啦~");
		                }
			        });
			    } else{
			    	$(".page-load span").removeClass("loading").addClass("loaded").html("拉到底部啦~");
			    }

			};
		});
	}

	if ($('.comment-tit').length == 2) {
		ajax_dp_list();
	}

	// 小能
	$('.xnOpenSdk').bind('click', function() {
		if (app_index != 'app') {
			return;
		}
		if(is_login==0){
			App.login_sdk();
			return false;
		}
		var xnOptionsObj = {
			goods_id:deal_id,
			goods_showURL:$(this).attr('goods_showURL'),
			goodsTitle: $(this).attr('goodsTitle'),
			goodsPrice: $(this).attr('goodsPrice'),
			goods_URL: $(this).attr('goods_URL'),
			settingid: $(this).attr('settingid'),
			appGoods_type: '3',
		};
		xnOptions = JSON.stringify(xnOptionsObj);
		try {
			App.xnOpenSdk(xnOptions);
		} catch (e) {
			$.toast(e);
		}
	})
});




function deal_del_collect(id){
		var query = new Object();
		query.id = id;
		query.act = "del_collect";
		$.ajax({
			url: ajax_url,
			data: query,
			dataType: "json",
			type: "post",
			success: function(obj){
				if(obj.status==0 && obj.user_login_status==0){
					$.alert(obj.info,function(){
						window.location.href=obj.jump;
					});
				}
				if(obj.status == 1){
					$.toast(obj.info);	
					$(".j-collection").attr("data-isdel",0);
					$(".j-head-collect").attr("data-isdel",0);
					$("i.icon-collection").removeClass("isCollection");
					if(obj.collect_count>0){
						$("div.is_Sc").html("<div class='shoucan isSc'><i class='iconfont'>&#xe615;</i><em>"+obj.collect_count+"</em></div>");
					}else{
						$("div.is_Sc").html('<i class="iconfont" id="is_Sc" style="font-size: 1.2rem;">&#xe615;</i>');
					}
				}
			},
			error:function(ajaxobj)
			{
//						if(ajaxobj.responseText!='')
//						alert(ajaxobj.responseText);
			}
		});
	}
	function deal_add_collect(id){
		var query = new Object();
		query.id = id;
		query.act = "add_collect";
		$.ajax({
			url: ajax_url,
			data: query,
			dataType: "json",
			type: "post",
			success: function(obj){
				if(obj.status==0 && obj.user_login_status==0){
					$.toast("请先登录");
					setTimeout(function(){
						window.location.href=obj.jump;
					},1000);
				}
				if(obj.status == 1){
					$(".j-collection").attr("data-isdel",1);
					$(".j-head-collect").attr("data-isdel",1);
					$("i.icon-collection").addClass("isCollection");
					$.toast(obj.info);	
					$("div.is_Sc").html("<div class='shoucan isSc'><i class='iconfont icon-noshoucan'>&#xe615;</i><i class='iconfont icon-shoucan'>&#xe63d;</i><em>"+obj.collect_count+"</em></div>");
					$(".flippedout").removeClass("showflipped").removeClass("dropdowm-open");
					$(".m-nav-dropdown").removeClass("showdropdown");
					$(".nav-dropdown-con").removeClass("dropdown-open");
				}
			},
			error:function(ajaxobj)
			{
//						if(ajaxobj.responseTexst!='')
//						alert(ajaxobj.responseText);
			}
		});
	}

/*
 *初始化商家标签区是否显示更多图标
 *循环遍历累加每个子项的宽度，如果大于内容区域大小则显示更多图标
*/
function setFuliIcon(){
	var ulwidth = $(".shop-fuli").children(".j-activeopen").width();//内容区域宽度
	var allliwidth = 0;//内容宽度，循环遍历累加每个子项的宽度
	$(".shop-fuli").children(".j-activeopen").children("li").each(function(){
		allliwidth += (parseInt($(this).width()) + parseInt($(this).css("margin-right").replace("px","")));
	});

	if(allliwidth < ulwidth){ //如果大于内容区域大小则显示更多图标
		$(".shop-fuli").children(".j-activeopen").children(".iconfont").hide();
	}
}


/*
 *自定义轮播分页器
*/
function slideIndex(){
	var index = $(".swiper-slide-active").attr("rel");
	$(".slideindex em").html(index);
}


/*
 *用于计算tab下划线移动距离
*/
function setTablineLeft(e,type,index){
	if (type == 0) {
		if(index == 1){
			var parentwidth = (e.width() / 3 * index) - 1;
		}else{
			var parentwidth = e.width() / 3 * index;
		}
	}else if (type == 1) {
		if(index > 0){
			var parentwidth = e.width() / index;
		}else{
			var parentwidth = 0;
		}
		
	}
	// $('.m-head-nav .buttons-tab .tab-line').css("left",parentwidth);
}

function init_addcart()
{
	var is_lock=false;
	$("#goods-form").bind("submit",function(){
		if(is_lock) return false;
		is_lock=true;
		var is_stock=true;
		var deal_remain_stock=parseInt($("input[name='max_bought']").val());
		var buy_num=parseInt($("input[name='num']").val());
		if(deal_remain_stock>=0)
		{
			if(buy_num>deal_remain_stock)
			{
				is_stock = false;
				$.toast("库存不足");
			}
			else if(deal_user_max_bought>0&&buy_num>deal_user_max_bought)
			{
				is_stock = false;
				$.toast("每单最多购买"+deal_user_max_bought+"份");
			}
		}
		else
		{
            if(deal_user_max_bought>0&&buy_num>deal_user_max_bought)
			{
				is_stock = false;
				$.toast("每单最多购买"+deal_user_max_bought+"份");
			}
		}
		if(is_stock){
			var query = $(this).serialize();
			var action = $(this).attr("action");
			$.ajax({
				url:action,
				data:query,
				type:"POST",
				dataType:"json",
				success:function(obj){
					if(obj.status==-1)
					{
						$.router.load(obj.jump, true);
					}
					else if(obj.status)
					{
						$(".cart-num").html(obj.cart_num);
						if(obj.in_cart==0){
							if(obj.jump!=""){
								
								$(".flippedout-spec").removeClass("z-open");
								$(".spec-choose").removeClass("z-open");
								$(".flippedout-spec").removeClass("showflipped");
								$(".spec-btn-list").removeClass("isAddCart");
								
								$.showIndicator();
							    setTimeout(function () {
							    	$.hideIndicator();
							    }, 2000);
								$.router.load(obj.jump, true);
							}else{
								is_lock=false;
							}
							
						}else{
							$.toast("加入购物车成功");
							$(".flippedout-spec").removeClass("z-open");
							$(".spec-choose").removeClass("z-open");
							$(".flippedout-spec").removeClass("showflipped");
							$(".spec-btn-list").removeClass("isAddCart");
							setTimeout("$('.flippedout').removeClass('showflipped')",300);
							$('.cart-num').removeClass('hide');
							if(now_buy==1){
								$.router.load(cart_url, true);
							}else{
								is_lock=false;
							}
						}
						
					}
					else
					{
						$.alert(obj.info);
						is_lock=false;
					}
				},
				error:function(o){
					$.alert(o.responseText);
					is_lock=false;
				}
			});
		}else{
			is_lock=false;
		}
		
		return false;
	});
}


$(document).on("pageInit", "#visiting_service_list", function(e, pageId, $page) {
	screen_bar();
	init_list_scroll_bottom();//下拉刷新加载
	//
	//星星评分
	//$(".tuan-item").each(function(){
	//    $(this).find(".start-num").css("width",$(this).find(".start-num").parent().parent().attr("data")+"%");
	//});
	//隐藏数量为0的2级分类
	$(".goods-num").filter(function(index){
		if($(this).parent().attr("data-cid")=='0'&&$(this).parent().attr("data-tid")=='0')
			return false;
　　　　return $(this).text()=="0";
　　	}).parent().hide();

	//团购列表展开
	$(document).on("click",".tuan-list-more",function() {
		var height = $(this).parent().find('.tuan-list li').height();
		var num = $(this).parent().find('.tuan-list li').length;
		$(this).parent().find('.tuan-list').css('max-height', height*num);
		$(this).hide();
	});
	if(address==""){
		//if(navigator.geolocation)
		//{
			 //var geolocationOptions={timeout:10000,enableHighAccuracy:true,maximumAge:5000};
			 //navigator.geolocation.getCurrentPosition(getPositionSuccess, getPositionError, geolocationOptions);
			 
		//}
		position();
	}
	$(document).on("click",".address-info",function() {
		$(".refresh").addClass('rotate');
		//if(navigator.geolocation)
		//{
		//	 var geolocationOptions={timeout:10000,enableHighAccuracy:true,maximumAge:5000};
		//	 navigator.geolocation.getCurrentPosition(getPositionSuccess, getPositionError, geolocationOptions);
		//}
		position();
	});
	
	function getPositionSuccess(p){
		has_location = 1;//定位成功;
	    m_latitude = p.coords.latitude; //纬度
	    m_longitude = p.coords.longitude;
		userxypoint(m_latitude, m_longitude);
	}

	function getPositionError(error){
		switch(error.code){
		    case error.TIMEOUT:
		    	$(".address").html("<i class='iconfont'>&#xe62f;</i>定位连接超时，请重试");
		    	$(".refresh").removeClass('rotate');
		    	//setCookie("cancel_geo",0,1);
		        //alert("定位连接超时，请重试");
		        break;
		    case error.PERMISSION_DENIED:
		    	$(".address").html("<i class='iconfont'>&#xe62f;</i>您拒绝了使用位置共享服务，查询已取消");
		    	$(".refresh").removeClass('rotate');
		    	//setCookie("cancel_geo",0,1);
		        //alert("您拒绝了使用位置共享服务，查询已取消");
		        break;
		    default:
		    	$(".address").html("<i class='iconfont'>&#xe62f;</i>定位失败");
		    	$(".refresh").removeClass('rotate');
		    	//setCookie("cancel_geo",0,1);
		    	//alert("定位失败");
		}
	}
});



$(document).on("pageInit", "#vs_cart", function(e, pageId, $page) {
    //打开送货时间选择
    $(".j-open-time").on('click', function() {
        $(".dc-mask").addClass('active');
        $(".time-select").addClass('active');
        /*var send_time=$(this).find('input').attr('value');
        $(".j-time-choose").each(function() {
            if ($(this).attr('value')==send_time) {
                $(this).addClass('active');
            }
        });*/
    });
    //关闭送货时间选择
    $(".j-close-time").on('click', function() {
        $(".dc-mask").removeClass('active');
        $(".time-select").removeClass('active');
    });
    //选择日期
    $(".j-day-item").on('click', function() {
        $(".time-select .select-time").removeClass("vs-show");
        $(".time-select .select-time").eq($(this).index()).addClass("vs-show");
    });
    //选择时间
    $(".j-time-choose").on('click', function() {
        if ($(this).hasClass('no_click')) {
            return false;
        }
        $(".j-time-choose").removeClass('active');
        $(this).addClass('active');

        var day_item = $(".j-day-item").eq($(this).parent().index()-2);
        $(".j-day-item").removeClass('active');
        $(day_item).addClass('active');
        var day_obj = $(day_item).find('p');
        $(".j-send-day").html(day_obj.html());
        $(".j-send-time").html($(this).find('p').html());
        
        $('input[name="rs_date"]').val($(day_item).attr('long-date'));
        $('input[name="tid"]').val($(this).attr('data-id'));
    });
    
    // 关闭弹层
    $(document).off('click', '.j-close-select');
    $(document).on('click', '.j-close-select', function() {
        $(".m-select-box").removeClass('active');
        $(".m-mask").removeClass('active');
    });

    var _close=false;
    $(document).on('click',"#vs_cart .remarkBox p.remarkTitle",function () {
    	var remarkArea = $(this).siblings('.remarkArea');
        if(_close==false){
            $(remarkArea).show();
            return _close=true;
        }
        if(_close==true){
            $(remarkArea).hide();
            return _close=false;
        }
    });

    $('#vs_cart .remarkBox .remarkArea textarea').on('input propertychange', function() {
        var that = $(this),
            _val = that.val();
        if (_val.length > 100) {
            that.val(_val.substring(0, 100));
        }
    });

    
    $(document).off('click', '.j-sure-cancel');
    $(document).on("click",".j-sure-cancel",function(){
        var _this=$(this);
        $(this).removeClass('j-sure-cancel');
        $.confirm('您确定要取消订单吗？', function () {
        	$(_this).addClass('j-sure-cancel');
        	
        	$.router.back();
        	
        	//$.router.load('#cart');
        },function(){
        	 $(_this).addClass('j-sure-cancel');
        });
    });

    /*listCli($(".j-reward-list li"));
    listCli($(".j-trans-list li"));*/

    $(document).on('click',".j-box-bg",function () {
        popupTransition();
        setTimeout(function () {
            $(".totop").removeClass("vible");
        },300);
    });


    //支付
    $(document).off('click', '.j-presell');
    $(".j-presell").on('click', function() {
        var consignee_id = $('input[name="consignee_id"]').val();
        if (!consignee_id) {
            $.toast('请选择一个地址');
            return false;
        }
        go_pay();
    });
    var pay_lock = false;
    function go_pay() {
        if (pay_lock) {
            return false;
        }
        pay_lock = true;

        $.showIndicator();
        var query = $("#pay_box").serialize();
        var url = $("#pay_box").attr("action");

        $.ajax({
            url: url,
            data:query,
            type: "POST",
            dataType: "json",
            success: function(data){
                $.hideIndicator();
                if(data.status==1) {
                    pay_lock = false;
                    $.router.load(data.jump, true);
                } else if (data.status == -2) {
                    $.toast(data.info);
                    setTimeout(function() {
                        pay_lock = false;
                        $.router.load(data.jump, true);
                    }, 2000);
                } else {
                    pay_lock = false;
                    $.alert(data.info);
                }
                ajaxing = false;
            },
            error:function(ajaxobj) {
                $.hideIndicator();

            }
        });
    }
 
});
/**
 * Created by Administrator on 2016/11/14.
 */

$(document).on("pageInit", "#vs_order", function(e, pageId, $page) {

    var _width=$(".buttons-tab .tab-link.active").find("span").width();
    var _left=$(".buttons-tab .tab-link.active").find("span").offset().left;

    var btm_line=$(".buttons-tab .bottom_line");
    btm_line.css({"width":_width+"px","left":_left+"px"});

    var _tabs=$(".tabBox .tab_box");
	var tab_link=new Array();
	tab_link[0] = true;
	tab_link[1] = true;
	tab_link[2] = true;
	tab_link[3] = true;
	tab_link[4] = true;
    $(".buttons-tab .tab-link").click(function () {
        $(document).off('infinite', '.infinite-scroll-bottom');
    	$(".content").scrollTop(1);
        var _wid=$(this).find("span").width();
        var _lef=$(this).find("span").offset().left;
        btm_line.css({"width":_wid+"px","left":_lef+"px"});
        var _index=$(this).index();
        //加载内容
        if($.trim($(".j_ajaxlist_"+_index).html())==""&&tab_link[_index]){
			tab_link[_index]=false;
            var ajax_url =url[_index];
            $.ajax({
                url:ajax_url,
                type:"POST",
                success:function(html)
                {
                    //alert($(html).find(".j_ajaxlist_"+_index).html());
                    $(".j_ajaxlist_"+_index).append($(html).find(".j_ajaxlist_"+_index).html());
                    manageOrder();

                    //$(ajaxlist).find(".pages").html($(html).find(ajaxlist).find(".pages").html());
                    //init_listscroll(".j_ajaxlist_"+_index,".j_ajaxadd_"+_index,"",manageOrder);
                	if($(".content").scrollTop()>0){
                		init_listscroll(".j_ajaxlist_"+_index,".j_ajaxadd_"+_index,"",manageOrder);
                	}
                },
                error:function()
                {
                    $(".j_ajaxlist_"+_index).find(".page-load span").removeClass("loading").addClass("loaded").html("网络被风吹走啦~");
                }
            });
        }else{
        	if($(".content").scrollTop()>0){
                infinite(".j_ajaxlist_"+_index,".j_ajaxadd_"+_index,"",manageOrder);
        	}
        }
        $(this).addClass("active").siblings(".tab-link").removeClass("active");
        _tabs.eq(_index).addClass("active").siblings(".tab_box").removeClass("active");

        var swiperBox=_tabs.eq(_index).find(".j-order-lamp");


        var swiper = new Swiper(swiperBox, {
            scrollbarHide: true,
            slidesPerView: 'auto',
            centeredSlides: false,
            observer:true,
            grabCursor: true
        });
    });
    function manageOrder(){
        $(".manage-order").unbind("click").bind("click",function(){
              var message=$(this).attr("message");
              var url=$(this).attr("ajaxUrl");
             $.confirm(message, function () {
                 $.showIndicator();
                 $.ajax({
                     url:url,
                     dataType:"json",
                     success:function(data){
                         if(data.status==0){
                             $.toast(data.info);
                         }else{
//                             $.alert(data.info,function(){
//                                 window.location.href=data.jump;
//                             })
                        	 $.toast(data.info);
                        	 window.setTimeout(function(){
                        		 window.location.href=data.jump;
         					},1500);
                         }
                     }
                 });
             });
        });
    }
    var swiperm = new Swiper(".j-order-lamp1", {
        scrollbarHide: true,
        slidesPerView: 'auto',
        centeredSlides: false,
        observer:true,
        grabCursor: true
    });
    init_listscroll(".j_ajaxlist_"+pay_status,".j_ajaxadd_"+pay_status,"",manageOrder);
    manageOrder();

    
});
/**
 * Created by Administrator on 2016/9/7.
 */

$(document).on("pageInit", "#vs_pay", function(e, pageId, $page) {
	count_order_total_change();
	count_order_total();
	function count_order_total_change(){

		var payment_id = $("input[name='payment']:checked").val();
		if (typeof payment_id == 'undefined') {
			if ($('.m-my-conut').length != 0) {
				$("input[name='payment']").prop("checked",false);
				$('.m-my-conut').find('input').prop('checked', true);
			}
		}

		$(".payment").unbind("click");
		$(".payment").bind("click",function(){
			$("input[name='payment']").prop("checked",false);
			$(this).siblings("input[name='payment']").prop("checked",true);
			count_order_total();
		});
		$(".j_pay_button").unbind("click");
		$(".j_pay_button").bind("click",function(){
			submit_order($(this));
		});
	}
	function count_order_total() {
		$('.fee-box').addClass('hide');
		var paymentElm = $('input[name="payment"]:checked').parents('.pay_line');
		var payFee = Number($(paymentElm).find('.payment_fee').html());
		payFee = Math.round(payFee * 100) / 100;
		if (payFee > 0) {
			$('.fee-box').find('i').html(format_fee(payFee));
			$('.fee-box').removeClass('hide');
		}
	}
	function format_fee(fee) {
		var intPart = Math.floor(fee);
		var decimalsPart = fee - intPart;
		decimalsPartToStr = (decimalsPart * 100 + 100).toString();
		return intPart + '.' + decimalsPartToStr.slice(1);
	}
	function submit_order(obj) {
		$(obj).removeClass('j_pay_button');
		var query = new Object();
		//支付方式
		var payment = $("input[name='payment']:checked").val();
		if(!payment) {
			payment = 0;
		}
		query.payment = payment;
		query.id = order_id;
		query.act = "do_pay";
		$.ajax({
			url: CART_URL,
			data:query,
			type: "POST",
			dataType: "json",
			success: function(data){
				if(data.status==1){
					if(data.app_index=='wap' ){  //SKD支付做好后，用 App.pay_sdk支付
						if(data.pay_status==1){
							$.router.load(data.jump, true);
						}else{
							location.href=data.jump;
						}
					} else if( data.app_index=='app' && data.pay_status==1){  //APP余额支付
						 $.router.load(data.jump, true);

					} else if( data.app_index=='app' && data.pay_status==0){  //APP第三方支付
						if(data.online_pay==3){
							try {
								var str = pay_sdk_json(data.sdk_code);
								App.pay_sdk(str);
								$(obj).addClass('j_pay_button');
							} catch (ex) {

								$.toast(ex);
								$.loadPage(location.href);
							}
						}else if(data.online_pay==2){
							var pay_json = '{"open_url_type":"1","url":"'+data.jump+'","title":"'+data.title+'"}';

							try {
								App.open_type(pay_json);
								$.confirm('已支付完成？', function () {
									$.loadPage(location.href);

								},function(){
									$.loadPage(location.href);

								});
							} catch (ex) {
								$.toast(ex);
								$.loadPage(location.href);
							}
						}
					}
				}else if(data.status==0){
					$.alert(data.info);
					$(obj).addClass('j_pay_button');
				}else{
					$(obj).addClass('j_pay_button');
				}
			},
			error:function(ajaxobj) {
				$(obj).addClass('j_pay_button');
			}
		});
	}
});


$(document).on("pageInit", "#youhui", function(e, pageId, $page) {
	
	loadScript(jia_url);
	/*倒计时*/

	var nowtime = parseInt($(".j-LeftTime").attr("nowtime"));
	var endtime = parseInt($(".j-LeftTime").attr("endtime"));
	// var leftTime = (endtime - nowtime) / 1000;
	var leftTime = endtime - nowtime;
	leftTimeAct();
	setInterval(leftTimeAct,1000);
	
	function leftTimeAct(){
		if(leftTime > 0)
		{
			var day  = parseInt(leftTime / 24 /3600);
			var hour = parseInt((leftTime % (24 *3600)) / 3600);
			var min  = parseInt((leftTime % 3600) / 60);
			var sec  = parseInt((leftTime % 3600) % 60);
			$(".j-LeftTime").find(".day").html(day);
			$(".j-LeftTime").find(".hour").html(hour);
			$(".j-LeftTime").find(".min").html(min);
			$(".j-LeftTime").find(".sec").html(sec);
			leftTime--;
		}
	}
	// 优惠券领取方法
	$('.isActive').click(function() {
		var ajax_url = $(this).attr("data-src");
		$.ajax({
			url:ajax_url,
			data:'',
			type:"POST",
			dataType:"json",
			success:function(obj){
				if(obj.user_login_status==0){
					$.toast(obj.info);
					setTimeout(function(){
						$.router.load(obj.jump, true);
					}, 2000);
				}
				if(obj.status) {
					$.toast(obj.info);			
				} else {
					$.toast(obj.info);
					$('.isActive').addClass('isOver').removeClass('.isActive');
					setTimeout(function() {
						window.location.reload();
					}, 2000);
				}
			}
		});
	});

	/*
	 *取消收藏按钮弹出后的确认
	 */
	$(".cancel-shoucan .j-yes").click(function(){
		youhui_del_collect(youhui_id);
		$(".cancel-shoucan").removeClass("z-open");
	});

	/*
	 *取消收藏按钮弹出后的取消
	 */
	$(".cancel-shoucan .j-cancel").click(function(){
		$(".cancel-shoucan").removeClass("z-open");
		$(".flippedout").removeClass("showflipped").removeClass("dropdowm-open");
		$(".m-nav-dropdown").removeClass("showdropdown");
		$(".nav-dropdown-con").removeClass("dropdown-open");
	});

	$(".j-head-collect").on("click",function(){
		var is_del = $(this).attr("data-isdel");
		if(is_del == 1){
		 	//打开取消框
			$(".cancel-shoucan").addClass("z-open");
		}else{
			if(is_login==0){
				if(app_index=="app"){
					App.login_sdk();
				}else{
					$.router.load(login_url, true);
				}
			}else{
				youhui_add_collect(youhui_id);
			}
		}
	});
});

// 收藏和取消收藏。。不确定是否需要
function youhui_add_collect(id){
	var query = new Object();
	query.data_id = id;
	query.act = "add_collect";
	$.ajax({
		url: ajax_url,
		data: query,
		dataType: "json",
		type: "post",
		success: function(obj){
			if (obj.user_login_status) {
				if(obj.status == 1){
					$("div.is_Sc").html("<div class='shoucan isSc'><i class='iconfont icon-noshoucan'>&#xe615;</i><i class='iconfont icon-shoucan'>&#xe63d;</i><em>"+obj.collect_count+"</em></div>");
					$.toast(obj.info);	
					$(".j-head-collect").attr("data-isdel",1);
					$(".flippedout").removeClass("showflipped").removeClass("dropdowm-open");
					$(".m-nav-dropdown").removeClass("showdropdown");
					$(".nav-dropdown-con").removeClass("dropdown-open");
				}else{
					$.toast(obj.info);
				}
			} else {
				$.toast("请先登录");
				setTimeout(function(){
					window.location.href=obj.jump;
				},1000);	
			}
		},
		error:function(ajaxobj) {
//					if(ajaxobj.responseText!='')
//					alert(ajaxobj.responseText);
		}
	});
}
function youhui_del_collect(id){
	var query = new Object();
	query.data_id = id;
	query.act = "del_collect";
	$.ajax({
		url: ajax_url,
		data: query,
		dataType: "json",
		type: "post",
		success: function(obj){
			if(obj.status == 1){
				$.toast(obj.info);
				if(obj.collect_count>0){
					$("div.is_Sc").html("<div class='shoucan isSc'><i class='iconfont'>&#xe615;</i><em>"+obj.collect_count+"</em></div>");
				}else{
					$("div.is_Sc").html('<i class="iconfont" id="is_Sc" style="font-size: 1.2rem;">&#xe615;</i>');
				}
				$(".j-head-collect").attr("data-isdel",0);
				$(".flippedout").removeClass("showflipped").removeClass("dropdowm-open");
				$(".m-nav-dropdown").removeClass("showdropdown");
				$(".nav-dropdown-con").removeClass("dropdown-open");
			} else{
				$.toast(obj.info);
			}
		},
		error:function(ajaxobj)
		{
//					if(ajaxobj.responseText!='')
//					alert(ajaxobj.responseText);
		}
	});
}


$(document).on("pageInit", "#youhuis", function(e, pageId, $page) {
	init_listscroll(".j_ajaxlist_"+cate_id,".j_ajaxadd_"+cate_id);//下拉刷新加载
	function tab_line() {
		var init_width=$(".m-events-tab .active").width();
		var init_left=$(".m-events-tab .active").offset().left+$(".m-events-tab").scrollLeft();
		$(".events-tab-line").css({
			width: init_width,
			left: init_left
		});
	}
	var tab_length =$(".m-events-tab li").length;
	if(tab_length<6){
		$(".m-events-tab ul").addClass('flex-box');
		$(".m-events-tab ul li").addClass('flex-1');
	}
	else{
		var w_width=$(window).width();
		var item_width=w_width/5.5;
		$(".m-events-tab li").css('width', item_width);
		$(".m-events-tab ul").css('width', item_width*tab_length);
		$(".m-events-tab ul li").addClass('tab-item');
	}
	tab_line();
    $(document).on('click','.j-choose-cate', function () {
    	$(".j-choose-cate").removeClass('active');
		$(this).addClass('active');
		tab_line();
    });


	$(".m-events-tab a").click(function() {
		$(document).off('infinite', '.infinite-scroll-bottom');
		$(".m-events-tab a").removeClass('active');
		$(this).addClass('active');
		$(".m-youhui-list").hide();
		var item_width=$(this).width();
		var item_left=$(this).offset().left+$(".m-events-tab").scrollLeft();
		$(".events-tab-line").css({
			width: item_width,
			left: item_left
		});
		var url=$(this).attr("data-src");
		var cate_id=$(this).attr("cate-id");
		$(".j_ajaxlist_"+cate_id).show();
		$(".content").scrollTop(1);
		if($(".j_ajaxlist_"+cate_id).html()==null){
			$.ajax({
				url:url,
				type:"POST",
				success:function(html)
				{
					//console.log("成功");
					$(".content").append($(html).find(".content").html());
					init_listscroll(".j_ajaxlist_"+cate_id,".j_ajaxadd_"+cate_id);
				},
				error:function()
				{
					$(".j_ajaxlist_"+cate_id).find(".page-load span").removeClass("loading").addClass("loaded").html("网络被风吹走啦~");
					//console.log("加载失败");
				}
			});
		}
		else{
			if( $(".content").scrollTop()>0 ){
				infinite(".j_ajaxlist_"+cate_id,".j_ajaxadd_"+cate_id);
			}
		}
	});


	var lock = false;
	if(!lock){
	$(document).on("click",".youhui-item",function(){
		if(is_login==0 && app_index=="app"){
            App.login_sdk();
            return false;
        }
		
			if(lock)return ;

			lock  = true;
		var data_id=$(this).attr("data-id");
			var url=$(this).attr("url");
		if(url){
			$.ajax({
				url: url,
				dataType: "json",
				type: "POST",
				success: function(obj){
					$.toast(obj.info);
					if(obj.status==0){
						if(obj.jump){
							$.router.load(obj.jump, true);
						}
					}else if(obj.status==8){
						if(obj.jump){
							$(".youhui-item[data-id='"+data_id+"']").html("立即使用");
							$(".youhui-item[data-id='"+data_id+"']").removeClass("youhui-item");
							$(".youhui-btn[data-id='"+data_id+"']").removeAttr("url");
							$(".youhui-btn[data-id='"+data_id+"']").attr("href",obj.jump);
						}
					}
				},
				error:function()
				{
					$.toast("服务器提交错误");
				}
			});
				lock = false;
		}
	});
	}

});
$(document).on("pageInit", "#youhui_detail", function(e, pageId, $page) {
	
	/*
	 *取消收藏按钮弹出后的确认
	 */
	$(".cancel-shoucan .j-yes").click(function(){
		youhui_detail_del_collect(youhui_id);
		$(".cancel-shoucan").removeClass("z-open");
		
	});

	/*
	 *取消收藏按钮弹出后的取消
	 */
	$(".cancel-shoucan .j-cancel").click(function(){
		$(".cancel-shoucan").removeClass("z-open");
		$(".flippedout").removeClass("showflipped").removeClass("dropdowm-open");
		$(".m-nav-dropdown").removeClass("showdropdown");
		$(".nav-dropdown-con").removeClass("dropdown-open");
	});

	$(".j-head-collect").on("click",function(){

		var is_del = $(this).attr("data-isdel");
		if(is_del == 1){
		 	//打开取消框
			$(".cancel-shoucan").addClass("z-open");
		}else{
			if(is_login==0){
				if(app_index=="app"){
					App.login_sdk();
				}else{
					$.router.load(login_url, true);
				}
			}else{
				youhui_detail_add_collect(youhui_id);
			}

		}
	});
});

// 收藏和取消收藏。。不确定是否需要
function youhui_detail_add_collect(id){
	var query = new Object();
	query.data_id = id;
	query.act = "add_collect";
	$.ajax({
		url: ajax_url,
		data: query,
		dataType: "json",
		type: "post",
		success: function(obj){
			if (obj.user_login_status) {
				if(obj.status == 1){
					$("div.is_Sc").html("<div class='shoucan isSc'><i class='iconfont icon-noshoucan'>&#xe615;</i><i class='iconfont icon-shoucan'>&#xe63d;</i><em>"+obj.collect_count+"</em></div>");
					$.toast(obj.info);	
					$(".j-head-collect").attr("data-isdel",1);
					$(".flippedout").removeClass("showflipped").removeClass("dropdowm-open");
					$(".m-nav-dropdown").removeClass("showdropdown");
					$(".nav-dropdown-con").removeClass("dropdown-open");
				}else{
					$.toast(obj.info);
				}
			} else {
				$.toast("请先登录");
				setTimeout(function(){
					window.location.href=obj.jump;
				},1000);	
			}
		},
		error:function(ajaxobj) {
//					if(ajaxobj.responseText!='')
//					alert(ajaxobj.responseText);
		}
	});
}
function youhui_detail_del_collect(id){
	var query = new Object();
	query.data_id = id;
	query.act = "del_collect";
	$.ajax({
		url: ajax_url,
		data: query,
		dataType: "json",
		type: "get",
		success: function(obj){
			if(obj.status == 1){
				$.toast(obj.info);
				if(obj.collect_count>0){
					$("div.is_Sc").html("<div class='shoucan isSc'><i class='iconfont'>&#xe615;</i><em>"+obj.collect_count+"</em></div>");
				}else{
					$("div.is_Sc").html('<i class="iconfont" id="is_Sc" style="font-size: 1.2rem;">&#xe615;</i>');
				}
				$(".j-head-collect").attr("data-isdel",0);
				$(".flippedout").removeClass("showflipped").removeClass("dropdowm-open");
				$(".m-nav-dropdown").removeClass("showdropdown");
				$(".nav-dropdown-con").removeClass("dropdown-open");
			} else{
				$.toast(obj.info);
			}
		},
		error:function(ajaxobj){
			$.toast('网络异常..')
		}
	});
}


