function mysql_dt_to_js_date(e){var t=e.split(/[- :]/);return new Date(t[0],t[1]-1,t[2],t[3],t[4],t[5])}function js_date_to_mysql_dt(e){return e.getUTCFullYear()+"-"+(1+e.getUTCMonth()).padZero(2)+"-"+e.getUTCDate().padZero(2)+" "+e.getUTCHours().padZero(2)+":"+e.getUTCMinutes().padZero(2)+":"+e.getUTCSeconds().padZero(2)}function get_screen_size(){return $("#screen-size div:visible:first").attr("data-size")}function on_window_resize(){window_w=$("body").width(),window_h=$("body").height(),screen_size=get_screen_size(),all_match_col_h()}function cookie_views(){var e=$("body").attr("class"),t=e.split(" "),n=[];for(var r in t)t[r].startsWith("board-view-")&&n.push(t[r]);Cookies.set("view",n.join(" "))}function all_match_col_h(){for(var e in boards){var t=boards[e];t.match_col_h()}}function build_url(){var e=window.location.href,t=e.split("?"),n=t[0]+"?"+decodeURIComponent($.param(kanban.url_params));return n}function update_url(){var e=build_url();window.history.replaceState("","",e),update_page_title()}function update_page_title(){if("undefined"!=typeof kanban.url_params.board_id){var e=boards[kanban.url_params.board_id];if("undefined"==typeof e)return!1;document.title="{0} | {1}".sprintf(e.record.title(),kanban.text.kanban)}}function usurp(e){for(var t=e,n=e.childNodes.length-1;n>=0;n--){var r=e.removeChild(e.childNodes[n]);e.parentNode.insertBefore(r,t),t=r}try{e.parentNode.removeChild(e)}catch(e){}}function strip_tags(e,t){"undefined"==typeof t&&(allowed_tag=["B","I","STRONG","EM","BR"]),$("*",e).each(function(){allowed_tag.indexOf(this.nodeName)===-1&&usurp(this)})}function remove_attributes_from_tags(e){$("*",e).each(function(){for(var e=this.attributes,t=e.length;t--;)this.removeAttributeNode(e[t])})}function sanitize(e){strip_tags(e),remove_attributes_from_tags(e)}function encode_emails(e){if("undefined"==typeof e||""===e||null===e)return e;var t=/(<a href(?:(?!<\/a\s*>).)*)?([\w.-]+@[\w.-]+\.[\w.-]+)/gi;return e.replace(t,function(e,t){return t?e:'<a href="mailto:'+e+'"  contenteditable="false">'+e+"</a>"})}function encode_urls(e){if("undefined"==typeof e||""===e||null===e)return e;var t=/(<a href(?:(?!<\/a\s*>).)*)?(http[^\s\<]+)/gi;return e.replace(t,function(e,t){return e=e.replace("&nbsp;",""),t?e:'<a href="'+$.trim(e)+'"  contenteditable="false" target="_blank">'+$.trim(e)+"</a>"})}function encode_urls_emails(e){e.html(encode_emails(e.html())),e.html(encode_urls(e.html()))}function placeCaretAtEnd(e){if(e.focus(),"undefined"!=typeof window.getSelection&&"undefined"!=typeof document.createRange){var t=document.createRange();t.selectNodeContents(e),t.collapse(!1);var n=window.getSelection();n.removeAllRanges(),n.addRange(t)}else if("undefined"!=typeof document.body.createTextRange){var r=document.body.createTextRange();r.moveToElementText(e),r.collapse(!1),r.select()}}function onErrorNotification(e){growl(e)}function onPermissionGranted(e){doNotification(e)}function onPermissionDenied(e){growl(e)}function doNotification(e){var t=new Notify("Kanban for WordPress",{body:e,tag:"kanban notification",icon:kanban.favicon,notifyError:function(){onErrorNotification(e)},timeout:5});t.show()}function notify(e){return"undefined"!=typeof e&&""!==e&&null!==e&&void(Notify.needsPermission?Notify.isSupported()&&Notify.requestPermission(function(){onPermissionGranted(e)},function(){onPermissionDenied(e)}):doNotification(e))}function growl_response_message(e){try{notify(e.data.message)}catch(e){}}function growl(e,t){return"undefined"!=typeof e&&""!==e&&("undefined"==typeof t&&(t="info"),void $.bootstrapGrowl(e,{type:t,allow_dismiss:!0}))}function format_hours(e){if(e<=0)return"0 <sub>h</sub> ";var t=Math.round(60*e),n=Math.floor(t/480),r=t%480,o=Math.floor(r/60),i=r%60,a=Math.floor(i),s="";return n>0&&(s+="{0} <sub>d</sub> ".sprintf(n)),o>0&&(s+="{0} <sub>h</sub> ".sprintf(o)),a>0&&(s+="{0} <sub>m</sub> ".sprintf(a)),""===s&&(s=format_hours(0)),s}function obj_order_by_key(e,t){if("undefined"==typeof e)return!1;"undefined"==typeof t&&(t=!1);var n=Object.keys(e);n.sort(function(e,t){return e=parseInt(e),t=parseInt(t),e<t?-1:e>t?1:0});var r=[];for(var o in n)r[n[o]]=e[n[o]];return t&&r.reverse(),r}function obj_order_by_prop(e,t,n){"undefined"==typeof n&&(n=!1);var r=$.map(e,function(e){return[e]});return r.sort(function(e,n){return e[t]-n[t]}),n&&r.reverse(),r}String.prototype.sprintf=function(){var e=this;for(var t in arguments)e=e.replace("{"+t+"}",arguments[t]);return e},Object.size=function(e){var t=0,n;for(n in e)e.hasOwnProperty(n)&&t++;return t},String.prototype.stripslashes=function(){return(this+"").replace(/\\(.?)/g,function(e,t){switch(t){case"\\":return"\\";case"0":return"\0";case"":return"";default:return t}})},Number.prototype.padZero=function(e){var t=String(this),n="0";for(e=e||2;t.length<e;)t=n+t;return t};var Notify=window.Notify.default;