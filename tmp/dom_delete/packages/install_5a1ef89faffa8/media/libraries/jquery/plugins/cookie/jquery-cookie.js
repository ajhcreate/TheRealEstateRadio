!function(e){e.cookie=function(t,n,o){if(arguments.length>1&&(!/Object/.test(Object.prototype.toString.call(n))||null===n||void 0===n)){if(o=e.extend({},o),null!==n&&void 0!==n||(o.expires=-1),"number"==typeof o.expires){var r=o.expires,i=o.expires=new Date;i.setDate(i.getDate()+r)}return n=String(n),document.cookie=[encodeURIComponent(t),"=",o.raw?n:encodeURIComponent(n),o.expires?"; expires="+o.expires.toUTCString():"",o.path?"; path="+o.path:"",o.domain?"; domain="+o.domain:"",o.secure?"; secure":""].join("")}o=n||{};for(var p,c=o.raw?function(e){return e}:decodeURIComponent,u=document.cookie.split("; "),a=0;p=u[a]&&u[a].split("=");a++)if(c(p[0])===t)return c(p[1]||"");return null}}(jQuery);