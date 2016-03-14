/*Copyright (c), 2011 Sanford, L.P. All Rights Reserved.*/(function() {function i(a){throw a;}var k=true,m=null,n=false;function aa(a){return function(){return this[a]}}var o,p=this;function r(a,b,c){a=a.split(".");c=c||p;!(a[0]in c)&&c.execScript&&c.execScript("var "+a[0]);for(var d;a.length&&(d=a.shift());)if(!a.length&&b!==undefined)c[d]=b;else c=c[d]?c[d]:c[d]={}}function ba(a,b){for(var c=a.split("."),d=b||p,e;e=c.shift();)if(d[e])d=d[e];else return m;return d}function ca(){}
function da(a){var b=typeof a;if(b=="object")if(a){if(a instanceof Array||!(a instanceof Object)&&Object.prototype.toString.call(a)=="[object Array]"||typeof a.length=="number"&&typeof a.splice!="undefined"&&typeof a.propertyIsEnumerable!="undefined"&&!a.propertyIsEnumerable("splice"))return"array";if(!(a instanceof Object)&&(Object.prototype.toString.call(a)=="[object Function]"||typeof a.call!="undefined"&&typeof a.propertyIsEnumerable!="undefined"&&!a.propertyIsEnumerable("call")))return"function"}else return"null";
else if(b=="function"&&typeof a.call=="undefined")return"object";return b}function s(a){return da(a)=="array"}function t(a){var b=da(a);return b=="array"||b=="object"&&typeof a.length=="number"}function w(a){return typeof a=="string"}function x(a){return da(a)=="function"}function ea(a){a=da(a);return a=="object"||a=="array"||a=="function"}function y(a){return a[fa]||(a[fa]=++ga)}var fa="closure_uid_"+Math.floor(Math.random()*2147483648).toString(36),ga=0;
function ha(a,b){var c=b||p;if(arguments.length>2){var d=Array.prototype.slice.call(arguments,2);return function(){var e=Array.prototype.slice.call(arguments);Array.prototype.unshift.apply(e,d);return a.apply(c,e)}}else return function(){return a.apply(c,arguments)}}var ia=Date.now||function(){return+new Date};function z(a,b){function c(){}c.prototype=b.prototype;a.U=b.prototype;a.prototype=new c};function ja(a){this.stack=Error().stack||"";if(a)this.message=String(a)}z(ja,Error);ja.prototype.name="CustomError";function ka(a){for(var b=1;b<arguments.length;b++){var c=String(arguments[b]).replace(/\$/g,"$$$$");a=a.replace(/\%s/,c)}return a}var la=/^[a-zA-Z0-9\-_.!~*'()]*$/;function ma(a){a=String(a);if(!la.test(a))return encodeURIComponent(a);return a}
function na(a,b){if(b)return a.replace(oa,"&amp;").replace(pa,"&lt;").replace(qa,"&gt;").replace(ra,"&quot;");else{if(!sa.test(a))return a;if(a.indexOf("&")!=-1)a=a.replace(oa,"&amp;");if(a.indexOf("<")!=-1)a=a.replace(pa,"&lt;");if(a.indexOf(">")!=-1)a=a.replace(qa,"&gt;");if(a.indexOf('"')!=-1)a=a.replace(ra,"&quot;");return a}}var oa=/&/g,pa=/</g,qa=/>/g,ra=/\"/g,sa=/[&<>\"]/;function ta(){return Array.prototype.join.call(arguments,"")}
function ua(a,b){for(var c=0,d=String(a).replace(/^[\s\xa0]+|[\s\xa0]+$/g,"").split("."),e=String(b).replace(/^[\s\xa0]+|[\s\xa0]+$/g,"").split("."),f=Math.max(d.length,e.length),g=0;c==0&&g<f;g++){var h=d[g]||"",j=e[g]||"",l=RegExp("(\\d*)(\\D*)","g"),q=RegExp("(\\d*)(\\D*)","g");do{var u=l.exec(h)||["","",""],v=q.exec(j)||["","",""];if(u[0].length==0&&v[0].length==0)break;c=va(u[1].length==0?0:parseInt(u[1],10),v[1].length==0?0:parseInt(v[1],10))||va(u[2].length==0,v[2].length==0)||va(u[2],v[2])}while(c==
0)}return c}function va(a,b){if(a<b)return-1;else if(a>b)return 1;return 0};function wa(a,b){b.unshift(a);ja.call(this,ka.apply(m,b));b.shift();this.lc=a}z(wa,ja);wa.prototype.name="AssertionError";function xa(a,b){if(!a){var c=Array.prototype.slice.call(arguments,2),d="Assertion failed";if(b){d+=": "+b;var e=c}i(new wa(""+d,e||[]))}return a}function ya(a){i(new wa("Failure"+(a?": "+a:""),Array.prototype.slice.call(arguments,1)))};function za(a,b,c){for(var d in a)b.call(c,a[d],d,a)}function Aa(a){var b=[],c=0,d;for(d in a)b[c++]=a[d];return b}function Ba(a){var b=[],c=0,d;for(d in a)b[c++]=d;return b}var Ca=["constructor","hasOwnProperty","isPrototypeOf","propertyIsEnumerable","toLocaleString","toString","valueOf"];function Da(a){for(var b,c,d=1;d<arguments.length;d++){c=arguments[d];for(b in c)a[b]=c[b];for(var e=0;e<Ca.length;e++){b=Ca[e];if(Object.prototype.hasOwnProperty.call(c,b))a[b]=c[b]}}};var A=Array.prototype,Ea=A.indexOf?function(a,b,c){xa(a.length!=m);return A.indexOf.call(a,b,c)}:function(a,b,c){c=c==m?0:c<0?Math.max(0,a.length+c):c;if(w(a)){if(!w(b)||b.length!=1)return-1;return a.indexOf(b,c)}for(c=c;c<a.length;c++)if(c in a&&a[c]===b)return c;return-1},Fa=A.forEach?function(a,b,c){xa(a.length!=m);A.forEach.call(a,b,c)}:function(a,b,c){for(var d=a.length,e=w(a)?a.split(""):a,f=0;f<d;f++)f in e&&b.call(c,e[f],f,a)};
function Ga(a,b,c,d){if(a.reduce)return d?a.reduce(ha(b,d),c):a.reduce(b,c);var e=c;Fa(a,function(f,g){e=b.call(d,e,f,g,a)});return e}function Ha(a,b){xa(a.length!=m);return A.splice.call(a,b,1).length==1}function Ia(){return A.concat.apply(A,arguments)}function Ja(a){if(s(a))return Ia(a);else{for(var b=[],c=0,d=a.length;c<d;c++)b[c]=a[c];return b}}
function Ka(a){for(var b=1;b<arguments.length;b++){var c=arguments[b],d;if(s(c)||(d=t(c))&&c.hasOwnProperty("callee"))a.push.apply(a,c);else if(d)for(var e=a.length,f=c.length,g=0;g<f;g++)a[e+g]=c[g];else a.push(c)}}function La(a,b,c){xa(a.length!=m);return arguments.length<=2?A.slice.call(a,b):A.slice.call(a,b,c)};function B(){}B.prototype.Ua=n;B.prototype.B=function(){if(!this.Ua){this.Ua=k;this.l()}};B.prototype.l=function(){};function Ma(a){if(typeof a.L=="function")return a.L();if(w(a))return a.split("");if(t(a)){for(var b=[],c=a.length,d=0;d<c;d++)b.push(a[d]);return b}return Aa(a)}function Na(a,b,c){if(typeof a.forEach=="function")a.forEach(b,c);else if(t(a)||w(a))Fa(a,b,c);else{var d;if(typeof a.D=="function")d=a.D();else if(typeof a.L!="function")if(t(a)||w(a)){d=[];for(var e=a.length,f=0;f<e;f++)d.push(f);d=d}else d=Ba(a);else d=void 0;e=Ma(a);f=e.length;for(var g=0;g<f;g++)b.call(c,e[g],d&&d[g],a)}};var Oa="StopIteration"in p?p.StopIteration:Error("StopIteration");function Pa(){}Pa.prototype.next=function(){i(Oa)};Pa.prototype.qa=function(){return this};function Qa(a){if(a instanceof Pa)return a;if(typeof a.qa=="function")return a.qa(n);if(t(a)){var b=0,c=new Pa;c.next=function(){for(;;){if(b>=a.length)i(Oa);if(b in a)return a[b++];else b++}};return c}i(Error("Not implemented"))}
function Ra(a,b,c){if(t(a))try{Fa(a,b,c)}catch(d){if(d!==Oa)i(d)}else{a=Qa(a);try{for(;;)b.call(c,a.next(),undefined,a)}catch(e){if(e!==Oa)i(e)}}};function Sa(a){this.n={};this.i=[];var b=arguments.length;if(b>1){if(b%2)i(Error("Uneven number of arguments"));for(var c=0;c<b;c+=2)this.H(arguments[c],arguments[c+1])}else if(a){if(a instanceof Sa){b=a.D();c=a.L()}else{b=Ba(a);c=Aa(a)}for(var d=0;d<b.length;d++)this.H(b[d],c[d])}}o=Sa.prototype;o.c=0;o.ga=0;o.ab=aa("c");o.L=function(){Ta(this);for(var a=[],b=0;b<this.i.length;b++)a.push(this.n[this.i[b]]);return a};o.D=function(){Ta(this);return this.i.concat()};
o.A=function(a){return Ua(this.n,a)};o.clear=function(){this.n={};this.ga=this.c=this.i.length=0};o.remove=function(a){if(Ua(this.n,a)){delete this.n[a];this.c--;this.ga++;this.i.length>2*this.c&&Ta(this);return k}return n};function Ta(a){if(a.c!=a.i.length){for(var b=0,c=0;b<a.i.length;){var d=a.i[b];if(Ua(a.n,d))a.i[c++]=d;b++}a.i.length=c}if(a.c!=a.i.length){var e={};for(c=b=0;b<a.i.length;){d=a.i[b];if(!Ua(e,d)){a.i[c++]=d;e[d]=1}b++}a.i.length=c}}
o.s=function(a,b){if(Ua(this.n,a))return this.n[a];return b};o.H=function(a,b){if(!Ua(this.n,a)){this.c++;this.i.push(a);this.ga++}this.n[a]=b};o.w=function(){return new Sa(this)};o.qa=function(a){Ta(this);var b=0,c=this.i,d=this.n,e=this.ga,f=this,g=new Pa;g.next=function(){for(;;){if(e!=f.ga)i(Error("The map has changed since the iterator was created"));if(b>=c.length)i(Oa);var h=c[b++];return a?h:d[h]}};return g};function Ua(a,b){return Object.prototype.hasOwnProperty.call(a,b)};function C(a,b){this.fb=b;this.K=[];if(a>this.fb)i(Error("[goog.structs.SimplePool] Initial cannot be greater than max"));for(var c=0;c<a;c++)this.K.push(this.W())}z(C,B);o=C.prototype;o.I=m;o.Ta=m;function Va(a){if(a.K.length)return a.K.pop();return a.W()}function D(a,b){a.K.length<a.fb?a.K.push(b):a.wa(b)}o.W=function(){return this.I?this.I():{}};o.wa=function(a){if(this.Ta)this.Ta(a);else if(ea(a))if(x(a.B))a.B();else for(var b in a)delete a[b]};
o.l=function(){C.U.l.call(this);for(var a=this.K;a.length;)this.wa(a.pop());delete this.K};function Wa(a,b){try{var c,d=ba("window.location.href");c=typeof a=="string"?{message:a,name:"Unknown error",lineNumber:"Not available",fileName:d,stack:"Not available"}:!a.lineNumber||!a.fileName||!a.stack?{message:a.message,name:a.name,lineNumber:a.lineNumber||a.jc||"Not available",fileName:a.fileName||a.filename||a.sourceURL||d,stack:a.stack||"Not available"}:a;return"Message: "+na(c.message)+'\nUrl: <a href="view-source:'+c.fileName+'" target="_new">'+c.fileName+"</a>\nLine: "+c.lineNumber+"\n\nBrowser stack:\n"+
na(c.stack+"-> ")+"[end]\n\nJS stack traversal:\n"+na(Xa(b)+"-> ")}catch(e){return"Exception trying to expose exception! You win, we lose. "+e}}function Xa(a){return Ya(a||arguments.callee.caller,[])}
function Ya(a,b){var c=[];if(Ea(b,a)>=0)c.push("[...circular reference...]");else if(a&&b.length<50){c.push(Za(a)+"(");for(var d=a.arguments,e=0;e<d.length;e++){e>0&&c.push(", ");var f;f=d[e];switch(typeof f){case "object":f=f?"object":"null";break;case "string":f=f;break;case "number":f=String(f);break;case "boolean":f=f?"true":"false";break;case "function":f=(f=Za(f))?f:"[fn]";break;default:f=typeof f}if(f.length>40)f=f.substr(0,40)+"...";c.push(f)}b.push(a);c.push(")\n");try{c.push(Ya(a.caller,
b))}catch(g){c.push("[exception trying to get caller]\n")}}else a?c.push("[...long stack...]"):c.push("[end]");return c.join("")}function Za(a){a=String(a);if(!$a[a]){var b=/function ([^\(]+)/.exec(a);$a[a]=b?b[1]:"[Anonymous]"}return $a[a]}var $a={};var ab=RegExp("^(?:([^:/?#.]+):)?(?://(?:([^/?#]*)@)?([\\w\\d\\-\\u0100-\\uffff.%]*)(?::([0-9]+))?)?([^?#]+)?(?:\\?([^#]*))?(?:#(.*))?$");function bb(a,b){if(a.indexOf("#")>=0||a.indexOf("?")>=0)i(Error("goog.uri.utils: Fragment or query identifiers are not supported: ["+a+"]"));var c=a.length-1;if(c>=0&&a.indexOf("/",c)==c)a=a.substr(0,a.length-1);if(b.lastIndexOf("/",0)==0)b=b.substr(1);return ta(a,"/",b)};function E(a,b){var c;if(a instanceof E){this.T(b==m?a.t:b);cb(this,a.u);db(this,a.N);eb(this,a.q);fb(this,a.G);gb(this,a.o);hb(this,a.j.w());ib(this,a.J)}else if(a&&(c=String(a).match(ab))){this.T(!!b);cb(this,c[1]||"",k);db(this,c[2]||"",k);eb(this,c[3]||"",k);fb(this,c[4]);gb(this,c[5]||"",k);hb(this,c[6]||"",k);ib(this,c[7]||"",k)}else{this.T(!!b);this.j=new jb(m,this,this.t)}}o=E.prototype;o.u="";o.N="";o.q="";o.G=m;o.o="";o.J="";o.Qb=n;o.t=n;
o.toString=function(){if(this.k)return this.k;var a=[];this.u&&a.push(kb(this.u,lb),":");if(this.q){a.push("//");this.N&&a.push(kb(this.N,lb),"@");var b;b=this.q;b=w(b)?encodeURIComponent(b):m;a.push(b);this.G!=m&&a.push(":",String(this.G))}if(this.o){this.q&&this.o.charAt(0)!="/"&&a.push("/");a.push(kb(this.o,mb))}(b=String(this.j))&&a.push("?",b);this.J&&a.push("#",kb(this.J,nb));return this.k=a.join("")};
o.w=function(){var a=this.u,b=this.N,c=this.q,d=this.G,e=this.o,f=this.j.w(),g=this.J,h=new E(m,this.t);a&&cb(h,a);b&&db(h,b);c&&eb(h,c);d&&fb(h,d);e&&gb(h,e);f&&hb(h,f);g&&ib(h,g);return h};function cb(a,b,c){F(a);delete a.k;a.u=c?ob(b):b;if(a.u)a.u=a.u.replace(/:$/,"");return a}function db(a,b,c){F(a);delete a.k;a.N=c?ob(b):b;return a}function eb(a,b,c){F(a);delete a.k;a.q=c?ob(b):b;return a}
function fb(a,b){F(a);delete a.k;if(b){b=Number(b);if(isNaN(b)||b<0)i(Error("Bad port number "+b));a.G=b}else a.G=m;return a}function gb(a,b,c){F(a);delete a.k;a.o=c?ob(b):b;return a}function hb(a,b,c){F(a);delete a.k;if(b instanceof jb){a.j=b;a.j.fa=a;a.j.T(a.t)}else{c||(b=kb(b,pb));a.j=new jb(b,a,a.t)}return a}
function qb(a,b,c){F(a);delete a.k;s(c)||(c=[String(c)]);var d=a.j;b=b;c=c;H(d);rb(d);b=I(d,b);if(d.A(b)){var e=d.d.s(b);if(s(e))d.c-=e.length;else d.c--}if(c.length>0){d.d.H(b,c);d.c+=c.length}return a}function ib(a,b,c){F(a);delete a.k;a.J=c?ob(b):b;return a}function F(a){if(a.Qb)i(Error("Tried to modify a read-only Uri"))}o.T=function(a){this.t=a;this.j&&this.j.T(a)};
function sb(a,b){a instanceof E||(a=a instanceof E?a.w():new E(a,void 0));b instanceof E||(b=b instanceof E?b.w():new E(b,void 0));var c=a,d=b,e=c.w(),f=!!d.u;if(f)cb(e,d.u);else f=!!d.N;if(f)db(e,d.N);else f=!!d.q;if(f)eb(e,d.q);else f=d.G!=m;var g=d.o;if(f)fb(e,d.G);else if(f=!!d.o){if(g.charAt(0)!="/")if(c.q&&!c.o)g="/"+g;else{c=e.o.lastIndexOf("/");if(c!=-1)g=e.o.substr(0,c+1)+g}if(g==".."||g==".")g="";else if(!(g.indexOf("./")==-1&&g.indexOf("/.")==-1)){c=g.lastIndexOf("/",0)==0;g=g.split("/");
for(var h=[],j=0;j<g.length;){var l=g[j++];if(l==".")c&&j==g.length&&h.push("");else if(l==".."){if(h.length>1||h.length==1&&h[0]!="")h.pop();c&&j==g.length&&h.push("")}else{h.push(l);c=k}}g=h.join("/")}}if(f)gb(e,g);else f=d.j.toString()!=="";if(f){c=d.j;if(!c.O)c.O=ob(c.toString());hb(e,c.O,void 0)}else f=!!d.J;f&&ib(e,d.J);return e}function ob(a){return a?decodeURIComponent(a):""}var tb=/^[a-zA-Z0-9\-_.!~*'():\/;?]*$/;
function kb(a,b){var c=m;if(w(a)){c=a;tb.test(c)||(c=encodeURI(a));if(c.search(b)>=0)c=c.replace(b,ub)}return c}function ub(a){a=a.charCodeAt(0);return"%"+(a>>4&15).toString(16)+(a&15).toString(16)}var lb=/[#\/\?@]/g,mb=/[\#\?]/g,pb=/[\#\?@]/g,nb=/#/g;function jb(a,b,c){this.z=a||m;this.fa=b||m;this.t=!!c}
function H(a){if(!a.d){a.d=new Sa;if(a.z)for(var b=a.z.split("&"),c=0;c<b.length;c++){var d=b[c].indexOf("="),e=m,f=m;if(d>=0){e=b[c].substring(0,d);f=b[c].substring(d+1)}else e=b[c];e=decodeURIComponent(e.replace(/\+/g," "));e=I(a,e);a.add(e,f?decodeURIComponent(f.replace(/\+/g," ")):"")}}}o=jb.prototype;o.d=m;o.c=m;o.ab=function(){H(this);return this.c};o.add=function(a,b){H(this);rb(this);a=I(this,a);if(this.A(a)){var c=this.d.s(a);s(c)?c.push(b):this.d.H(a,[c,b])}else this.d.H(a,b);this.c++;return this};
o.remove=function(a){H(this);a=I(this,a);if(this.d.A(a)){rb(this);var b=this.d.s(a);if(s(b))this.c-=b.length;else this.c--;return this.d.remove(a)}return n};o.clear=function(){rb(this);this.d&&this.d.clear();this.c=0};o.A=function(a){H(this);a=I(this,a);return this.d.A(a)};o.D=function(){H(this);for(var a=this.d.L(),b=this.d.D(),c=[],d=0;d<b.length;d++){var e=a[d];if(s(e))for(var f=0;f<e.length;f++)c.push(b[d]);else c.push(b[d])}return c};
o.L=function(a){H(this);if(a){a=I(this,a);if(this.A(a)){var b=this.d.s(a);if(s(b))return b;else{a=[];a.push(b)}}else a=[]}else{b=this.d.L();a=[];for(var c=0;c<b.length;c++){var d=b[c];s(d)?Ka(a,d):a.push(d)}}return a};o.H=function(a,b){H(this);rb(this);a=I(this,a);if(this.A(a)){var c=this.d.s(a);if(s(c))this.c-=c.length;else this.c--}this.d.H(a,b);this.c++;return this};o.s=function(a,b){H(this);a=I(this,a);if(this.A(a)){var c=this.d.s(a);return s(c)?c[0]:c}else return b};
o.toString=function(){if(this.z)return this.z;if(!this.d)return"";for(var a=[],b=0,c=this.d.D(),d=0;d<c.length;d++){var e=c[d],f=ma(e);e=this.d.s(e);if(s(e))for(var g=0;g<e.length;g++){b>0&&a.push("&");a.push(f);e[g]!==""&&a.push("=",ma(e[g]));b++}else{b>0&&a.push("&");a.push(f);e!==""&&a.push("=",ma(e));b++}}return this.z=a.join("")};function rb(a){delete a.O;delete a.z;a.fa&&delete a.fa.k}o.w=function(){var a=new jb;if(this.O)a.O=this.O;if(this.z)a.z=this.z;if(this.d)a.d=this.d.w();return a};
function I(a,b){var c=String(b);if(a.t)c=c.toLowerCase();return c}o.T=function(a){if(a&&!this.t){H(this);rb(this);Na(this.d,function(b,c){var d=c.toLowerCase();if(c!=d){this.remove(c);this.add(d,b)}},this)}this.t=a};function vb(a){var b;b=(b=a.className)&&typeof b.split=="function"?b.split(/\s+/):[];var c;c=La(arguments,1);for(var d=0,e=0;e<c.length;e++)if(!(Ea(b,c[e])>=0)){b.push(c[e]);d++}c=d==c.length;a.className=b.join(" ");return c};var wb,xb,yb,zb;function Ab(){return p.navigator?p.navigator.userAgent:m}zb=yb=xb=wb=n;var Bb;if(Bb=Ab()){var Cb=p.navigator;wb=Bb.indexOf("Opera")==0;xb=!wb&&Bb.indexOf("MSIE")!=-1;yb=!wb&&Bb.indexOf("WebKit")!=-1;zb=!wb&&!yb&&Cb.product=="Gecko"}var Db=wb,J=xb,Eb=zb,Fb=yb,Gb=p.navigator,Hb=(Gb&&Gb.platform||"").indexOf("Mac")!=-1,Ib;
a:{var Jb="",Kb;if(Db&&p.opera){var Lb=p.opera.version;Jb=typeof Lb=="function"?Lb():Lb}else{if(Eb)Kb=/rv\:([^\);]+)(\)|;)/;else if(J)Kb=/MSIE\s+([^\);]+)(\)|;)/;else if(Fb)Kb=/WebKit\/(\S+)/;if(Kb){var Mb=Kb.exec(Ab());Jb=Mb?Mb[1]:""}}if(J){var Nb,Ob=p.document;Nb=Ob?Ob.documentMode:undefined;if(Nb>parseFloat(Jb)){Ib=String(Nb);break a}}Ib=Jb}var Pb={};function Qb(a){return Pb[a]||(Pb[a]=ua(Ib,a)>=0)};var Rb=!J||Qb("9"),Sb=J&&!Qb("9");function Tb(a,b){za(b,function(c,d){if(d=="style")a.style.cssText=c;else if(d=="class")a.className=c;else if(d=="for")a.htmlFor=c;else if(d in Ub)a.setAttribute(Ub[d],c);else a[d]=c})}var Ub={cellpadding:"cellPadding",cellspacing:"cellSpacing",colspan:"colSpan",rowspan:"rowSpan",valign:"vAlign",height:"height",width:"width",usemap:"useMap",frameborder:"frameBorder",type:"type"};
function Vb(){var a=arguments,b=a[0],c=a[1];if(!Rb&&c&&(c.name||c.type)){b=["<",b];c.name&&b.push(' name="',na(c.name),'"');if(c.type){b.push(' type="',na(c.type),'"');var d={};Da(d,c);c=d;delete c.type}b.push(">");b=b.join("")}b=document.createElement(b);if(c)if(w(c))b.className=c;else s(c)?vb.apply(m,[b].concat(c)):Tb(b,c);a.length>2&&Wb(document,b,a,2);return b}
function Wb(a,b,c,d){function e(g){if(g)b.appendChild(w(g)?a.createTextNode(g):g)}for(d=d;d<c.length;d++){var f=c[d];t(f)&&!(ea(f)&&f.nodeType>0)?Fa(Xb(f)?Ja(f):f,e):e(f)}}function Yb(a){for(var b;b=a.firstChild;)a.removeChild(b)}function Zb(a){return Fb?a.document||a.contentWindow.document:a.contentDocument||a.contentWindow.document}function $b(a,b){var c=[];ac(a,b,c,n);return c}
function ac(a,b,c,d){if(a!=m)for(var e=0,f;f=a.childNodes[e];e++){if(b(f)){c.push(f);if(d)return k}if(ac(f,b,c,d))return k}return n}var bc={SCRIPT:1,STYLE:1,HEAD:1,IFRAME:1,OBJECT:1},cc={IMG:" ",BR:"\n"};function dc(a,b,c){if(!(a.nodeName in bc))if(a.nodeType==3)c?b.push(String(a.nodeValue).replace(/(\r\n|\r|\n)/g,"")):b.push(a.nodeValue);else if(a.nodeName in cc)b.push(cc[a.nodeName]);else for(a=a.firstChild;a;){dc(a,b,c);a=a.nextSibling}}
function Xb(a){if(a&&typeof a.length=="number")if(ea(a))return typeof a.item=="function"||typeof a.item=="string";else if(x(a))return typeof a.item=="function";return n};function K(a){if(typeof DOMParser!="undefined")return(new DOMParser).parseFromString(a,"application/xml");else if(typeof ActiveXObject!="undefined"){var b=new ActiveXObject("MSXML2.DOMDocument");if(b){b.resolveExternals=n;b.validateOnParse=n;try{b.setProperty("ProhibitDTD",k);b.setProperty("MaxXMLSize",2048);b.setProperty("MaxElementDepth",256)}catch(c){}}b.loadXML(a);return b}i(Error("Your browser does not support loading xml documents"))}
function ec(a){if(typeof XMLSerializer!="undefined")return(new XMLSerializer).serializeToString(a);if(a=a.xml)return a;i(Error("Your browser does not support serializing XML documents"))};function fc(a,b){this.fa=new E(a);this.Cb=b?b:"callback";this.Na=5E3}var gc=0;
fc.prototype.send=function(a,b,c,d){if(!document.documentElement.firstChild){c&&c(a);return m}d=d||"_"+(gc++).toString(36)+ia().toString(36);p._callbacks_||(p._callbacks_={});var e=document.createElement("script"),f=m;if(this.Na>0)f=p.setTimeout(hc(d,e,a,c),this.Na);c=this.fa.w();for(var g in a)if(!a.hasOwnProperty||a.hasOwnProperty(g))qb(c,g,a[g]);if(b){p._callbacks_[d]=ic(d,e,b,f);qb(c,this.Cb,"_callbacks_."+d)}Tb(e,{type:"text/javascript",id:d,charset:"UTF-8",src:c.toString()});document.getElementsByTagName("head")[0].appendChild(e);
return{Q:d,Na:f}};function hc(a,b,c,d){return function(){jc(a,b,n);d&&d(c)}}function ic(a,b,c,d){return function(){p.clearTimeout(d);jc(a,b,k);c.apply(undefined,arguments)}}function jc(a,b,c){p.setTimeout(function(){b&&b.parentNode&&b.parentNode.removeChild(b)},0);if(p._callbacks_[a])if(c)delete p._callbacks_[a];else p._callbacks_[a]=ca};function kc(a,b,c,d,e){this.reset(a,b,c,d,e)}kc.prototype.ac=0;kc.prototype.Za=m;kc.prototype.Ya=m;var lc=0;kc.prototype.reset=function(a,b,c,d,e){this.ac=typeof e=="number"?e:lc++;this.oc=d||ia();this.ba=a;this.mc=b;this.kc=c;delete this.Za;delete this.Ya};kc.prototype.ib=function(a){this.ba=a};function L(a){this.da=a}L.prototype.ma=m;L.prototype.ba=m;L.prototype.sa=m;L.prototype.cb=m;function mc(a,b){this.name=a;this.value=b}mc.prototype.toString=aa("name");var nc=new mc("SEVERE",1E3),oc=new mc("INFO",800),pc=new mc("CONFIG",700),M=new mc("FINE",500),qc=new mc("FINER",400),rc=new mc("FINEST",300);L.prototype.ib=function(a){this.ba=a};function sc(a){if(a.ba)return a.ba;if(a.ma)return sc(a.ma);ya("Root logger has no level set.");return m}
L.prototype.log=function(a,b,c){if(a.value>=sc(this).value){a=this.Lb(a,b,c);for(b=this;b;){c=b;var d=a;if(c.cb)for(var e=0,f=void 0;f=c.cb[e];e++)f(d);b=b.ma}}};L.prototype.Lb=function(a,b,c){var d=new kc(a,String(b),this.da);if(c){d.Za=c;var e=Wa(c,arguments.callee.caller);d.Ya=e}return d};L.prototype.info=function(a,b){this.log(oc,a,b)};var tc={},uc=m;
function vc(a){if(!uc){uc=new L("");tc[""]=uc;uc.ib(pc)}var b;if(!(b=tc[a])){b=new L(a);var c=a.lastIndexOf("."),d=a.substr(c+1);c=vc(a.substr(0,c));if(!c.sa)c.sa={};c.sa[d]=b;b.ma=c;b=tc[a]=b}return b};function wc(){this.X=[];this.Ka=new Sa;this.pb=this.qb=this.rb=this.kb=0;this.ea=new Sa;this.Ra=this.ob=0;this.Tb=1;this.za=new C(0,4E3);this.za.W=function(){return new xc};this.lb=new C(0,50);this.lb.W=function(){return new yc};var a=this;this.Ea=new C(0,2E3);this.Ea.W=function(){return String(a.Tb++)};this.Ea.wa=function(){};this.Fb=3}wc.prototype.e=vc("goog.debug.Trace");function yc(){this.Oa=this.nb=this.ua=0}
yc.prototype.toString=function(){var a=[];a.push(this.type," ",this.ua," (",Math.round(this.nb*10)/10," ms)");this.Oa&&a.push(" [VarAlloc = ",this.Oa,"]");return a.join("")};function xc(){}function zc(a,b,c,d){var e=[];c==-1?e.push("    "):e.push(Ac(a.Wa-c));e.push(" ",Bc(a.Wa-b));if(a.Aa==0)e.push(" Start        ");else if(a.Aa==1){e.push(" Done ");e.push(Ac(a.nc-a.startTime)," ms ")}else e.push(" Comment      ");e.push(d,a);a.hc>0&&e.push("[VarAlloc ",a.hc,"] ");return e.join("")}
xc.prototype.toString=function(){return this.type==m?this.Eb:"["+this.type+"] "+this.Eb};wc.prototype.reset=function(a){this.Fb=a;for(a=0;a<this.X.length;a++){var b=this.za.id;b&&D(this.Ea,b);D(this.za,this.X[a])}this.X.length=0;this.Ka.clear();this.kb=ia();this.Ra=this.ob=this.pb=this.qb=this.rb=0;b=this.ea.D();for(a=0;a<b.length;a++){var c=this.ea.s(b[a]);c.ua=0;c.nb=0;c.Oa=0;D(this.lb,c)}this.ea.clear()};
wc.prototype.toString=function(){for(var a=[],b=-1,c=[],d=0;d<this.X.length;d++){var e=this.X[d];e.Aa==1&&c.pop();a.push(" ",zc(e,this.kb,b,c.join("")));b=e.Wa;a.push("\n");e.Aa==0&&c.push("|  ")}if(this.Ka.ab()!=0){var f=ia();a.push(" Unstopped timers:\n");Ra(this.Ka,function(g){a.push("  ",g," (",f-g.startTime," ms, started at ",Bc(g.startTime),")\n")})}b=this.ea.D();for(d=0;d<b.length;d++){c=this.ea.s(b[d]);c.ua>1&&a.push(" TOTAL ",c,"\n")}a.push("Total tracers created ",this.ob,"\n","Total comments created ",
this.Ra,"\n","Overhead start: ",this.rb," ms\n","Overhead end: ",this.qb," ms\n","Overhead comment: ",this.pb," ms\n");return a.join("")};function Ac(a){a=Math.round(a);var b="";if(a<1E3)b=" ";if(a<100)b="  ";if(a<10)b="   ";return b+a}function Bc(a){a=Math.round(a);return String(100+a/1E3%60).substring(1,3)+"."+String(1E3+a%1E3).substring(1,4)}new wc;var Cc;function N(a,b){this.type=a;this.currentTarget=this.target=b}z(N,B);N.prototype.l=function(){delete this.type;delete this.target;delete this.currentTarget};N.prototype.R=n;N.prototype.na=k;!J||Qb("9");J&&Qb("8");function Dc(a,b){a&&this.ja(a,b)}z(Dc,N);o=Dc.prototype;o.target=m;o.relatedTarget=m;o.offsetX=0;o.offsetY=0;o.clientX=0;o.clientY=0;o.screenX=0;o.screenY=0;o.button=0;o.keyCode=0;o.charCode=0;o.ctrlKey=n;o.altKey=n;o.shiftKey=n;o.metaKey=n;o.Vb=n;o.Xa=m;
o.ja=function(a,b){var c=this.type=a.type;this.target=a.target||a.srcElement;this.currentTarget=b;var d=a.relatedTarget;if(d){if(Eb)try{d=d.nodeName&&d}catch(e){d=m}}else if(c=="mouseover")d=a.fromElement;else if(c=="mouseout")d=a.toElement;this.relatedTarget=d;this.offsetX=a.offsetX!==undefined?a.offsetX:a.layerX;this.offsetY=a.offsetY!==undefined?a.offsetY:a.layerY;this.clientX=a.clientX!==undefined?a.clientX:a.pageX;this.clientY=a.clientY!==undefined?a.clientY:a.pageY;this.screenX=a.screenX||0;
this.screenY=a.screenY||0;this.button=a.button;this.keyCode=a.keyCode||0;this.charCode=a.charCode||(c=="keypress"?a.keyCode:0);this.ctrlKey=a.ctrlKey;this.altKey=a.altKey;this.shiftKey=a.shiftKey;this.metaKey=a.metaKey;this.Vb=Hb?a.metaKey:a.ctrlKey;this.state=a.state;this.Xa=a;delete this.na;delete this.R};o.l=function(){Dc.U.l.call(this);this.relatedTarget=this.currentTarget=this.target=this.Xa=m};function Ec(){}var Fc=0;o=Ec.prototype;o.key=0;o.S=n;o.Qa=n;o.ja=function(a,b,c,d,e,f){if(x(a))this.eb=k;else if(a&&a.handleEvent&&x(a.handleEvent))this.eb=n;else i(Error("Invalid listener argument"));this.ca=a;this.hb=b;this.src=c;this.type=d;this.capture=!!e;this.Da=f;this.Qa=n;this.key=++Fc;this.S=n};o.handleEvent=function(a){if(this.eb)return this.ca.call(this.Da||this.src,a);return this.ca.handleEvent.call(this.ca,a)};var Gc;var Hc=(Gc="ScriptEngine"in p&&p.ScriptEngine()=="JScript")?p.ScriptEngineMajorVersion()+"."+p.ScriptEngineMinorVersion()+"."+p.ScriptEngineBuildVersion():"0";var Ic,Jc,Kc,Lc,Mc,Nc,Oc,Pc,Qc,Rc,Sc;
(function(){function a(){return{c:0,p:0}}function b(){return[]}function c(){function v(G){return g.call(v.src,v.key,G)}return v}function d(){return new Ec}function e(){return new Dc}var f=Gc&&!(ua(Hc,"5.7")>=0),g;Nc=function(v){g=v};if(f){Ic=function(){return Va(h)};Jc=function(v){D(h,v)};Kc=function(){return Va(j)};Lc=function(v){D(j,v)};Mc=function(){return Va(l)};Oc=function(){D(l,c())};Pc=function(){return Va(q)};Qc=function(v){D(q,v)};Rc=function(){return Va(u)};Sc=function(v){D(u,v)};var h=
new C(0,600);h.I=a;var j=new C(0,600);j.I=b;var l=new C(0,600);l.I=c;var q=new C(0,600);q.I=d;var u=new C(0,600);u.I=e}else{Ic=a;Jc=ca;Kc=b;Lc=ca;Mc=c;Oc=ca;Pc=d;Qc=ca;Rc=e;Sc=ca}})();var Tc={},O={},P={},Uc={};
function Vc(a,b,c,d,e){if(b)if(s(b)){for(var f=0;f<b.length;f++)Vc(a,b[f],c,d,e);return m}else{d=!!d;var g=O;b in g||(g[b]=Ic());g=g[b];if(!(d in g)){g[d]=Ic();g.c++}g=g[d];var h=y(a),j;g.p++;if(g[h]){j=g[h];for(f=0;f<j.length;f++){g=j[f];if(g.ca==c&&g.Da==e){if(g.S)break;return j[f].key}}}else{j=g[h]=Kc();g.c++}f=Mc();f.src=a;g=Pc();g.ja(c,f,a,b,d,e);c=g.key;f.key=c;j.push(g);Tc[c]=g;P[h]||(P[h]=Kc());P[h].push(g);if(a.addEventListener){if(a==p||!a.Sa)a.addEventListener(b,f,d)}else a.attachEvent(Wc(b),
f);return c}else i(Error("Invalid event type"))}function Xc(a,b,c,d,e){if(s(b)){for(var f=0;f<b.length;f++)Xc(a,b[f],c,d,e);return m}d=!!d;a:{f=O;if(b in f){f=f[b];if(d in f){f=f[d];a=y(a);if(f[a]){a=f[a];break a}}}a=m}if(!a)return n;for(f=0;f<a.length;f++)if(a[f].ca==c&&a[f].capture==d&&a[f].Da==e)return Yc(a[f].key);return n}
function Yc(a){if(!Tc[a])return n;var b=Tc[a];if(b.S)return n;var c=b.src,d=b.type,e=b.hb,f=b.capture;if(c.removeEventListener){if(c==p||!c.Sa)c.removeEventListener(d,e,f)}else c.detachEvent&&c.detachEvent(Wc(d),e);c=y(c);e=O[d][f][c];if(P[c]){var g=P[c],h=Ea(g,b);h>=0&&Ha(g,h);g.length==0&&delete P[c]}b.S=k;e.gb=k;Zc(d,f,c,e);delete Tc[a];return k}
function Zc(a,b,c,d){if(!d.ka)if(d.gb){for(var e=0,f=0;e<d.length;e++)if(d[e].S){var g=d[e].hb;g.src=m;Oc(g);Qc(d[e])}else{if(e!=f)d[f]=d[e];f++}d.length=f;d.gb=n;if(f==0){Lc(d);delete O[a][b][c];O[a][b].c--;if(O[a][b].c==0){Jc(O[a][b]);delete O[a][b];O[a].c--}if(O[a].c==0){Jc(O[a]);delete O[a]}}}}
function $c(a,b,c){var d=0,e=b==m,f=c==m;c=!!c;if(a==m)za(P,function(j){for(var l=j.length-1;l>=0;l--){var q=j[l];if((e||b==q.type)&&(f||c==q.capture)){Yc(q.key);d++}}});else{a=y(a);if(P[a]){a=P[a];for(var g=a.length-1;g>=0;g--){var h=a[g];if((e||b==h.type)&&(f||c==h.capture)){Yc(h.key);d++}}}}return d}function Wc(a){if(a in Uc)return Uc[a];return Uc[a]="on"+a}
function ad(a,b,c,d,e){var f=1;b=y(b);if(a[b]){a.p--;a=a[b];if(a.ka)a.ka++;else a.ka=1;try{for(var g=a.length,h=0;h<g;h++){var j=a[h];if(j&&!j.S)f&=bd(j,e)!==n}}finally{a.ka--;Zc(c,d,b,a)}}return Boolean(f)}function bd(a,b){var c=a.handleEvent(b);a.Qa&&Yc(a.key);return c}
Nc(function(a,b){if(!Tc[a])return k;var c=Tc[a],d=c.type,e=O;if(!(d in e))return k;e=e[d];var f,g;if(Cc===undefined)Cc=J&&!p.addEventListener;if(Cc){f=b||ba("window.event");var h=k in e,j=n in e;if(h){if(f.keyCode<0||f.returnValue!=undefined)return k;a:{var l=n;if(f.keyCode==0)try{f.keyCode=-1;break a}catch(q){l=k}if(l||f.returnValue==undefined)f.returnValue=k}}l=Rc();l.ja(f,this);f=k;try{if(h){for(var u=Kc(),v=l.currentTarget;v;v=v.parentNode)u.push(v);g=e[k];g.p=g.c;for(var G=u.length-1;!l.R&&G>=
0&&g.p;G--){l.currentTarget=u[G];f&=ad(g,u[G],d,k,l)}if(j){g=e[n];g.p=g.c;for(G=0;!l.R&&G<u.length&&g.p;G++){l.currentTarget=u[G];f&=ad(g,u[G],d,n,l)}}}else f=bd(c,l)}finally{if(u){u.length=0;Lc(u)}l.B();Sc(l)}return f}d=new Dc(b,this);try{f=bd(c,d)}finally{d.B()}return f});function cd(){}z(cd,B);o=cd.prototype;o.Sa=k;o.La=m;o.addEventListener=function(a,b,c,d){Vc(this,a,b,c,d)};o.removeEventListener=function(a,b,c,d){Xc(this,a,b,c,d)};
o.dispatchEvent=function(a){a=a;if(w(a))a=new N(a,this);else if(a instanceof N)a.target=a.target||this;else{var b=a;a=new N(a.type,this);Da(a,b)}b=1;var c,d=a.type,e=O;if(d in e){e=e[d];d=k in e;var f;if(d){c=[];for(f=this;f;f=f.La)c.push(f);f=e[k];f.p=f.c;for(var g=c.length-1;!a.R&&g>=0&&f.p;g--){a.currentTarget=c[g];b&=ad(f,c[g],a.type,k,a)&&a.na!=n}}if(n in e){f=e[n];f.p=f.c;if(d)for(g=0;!a.R&&g<c.length&&f.p;g++){a.currentTarget=c[g];b&=ad(f,c[g],a.type,n,a)&&a.na!=n}else for(c=this;!a.R&&c&&
f.p;c=c.La){a.currentTarget=c;b&=ad(f,c,a.type,n,a)&&a.na!=n}}a=Boolean(b)}else a=k;return a};o.l=function(){cd.U.l.call(this);$c(this);this.La=m};var dd=p.window;function ed(a,b,c){if(x(a)){if(c)a=ha(a,c)}else if(a&&typeof a.handleEvent=="function")a=ha(a.handleEvent,a);else i(Error("Invalid listener argument"));return b>2147483647?-1:dd.setTimeout(a,b||0)};function fd(a,b,c){this.Ha=a;this.Pb=b||0;this.bb=c;this.Db=ha(this.Gb,this)}z(fd,B);o=fd.prototype;o.Q=0;o.l=function(){fd.U.l.call(this);this.stop();delete this.Ha;delete this.bb};o.start=function(a){this.stop();this.Q=ed(this.Db,a!==undefined?a:this.Pb)};o.stop=function(){this.db()&&dd.clearTimeout(this.Q);this.Q=0};o.db=function(){return this.Q!=0};o.Gb=function(){this.Q=0;this.Ha&&this.Ha.call(this.bb)};function gd(){if(Eb){this.ta={};this.sb={};this.jb=[]}}gd.prototype.e=vc("goog.net.xhrMonitor");gd.prototype.xa=Eb;function hd(a,b){if(a.xa){var c=w(b)?b:ea(b)?y(b):"";a.e.log(rc,"Pushing context: "+b+" ("+c+")",void 0);a.jb.push(c)}}function id(a){if(a.xa){var b=a.jb.pop();a.e.log(rc,"Popping context: "+b,void 0);jd(a,b)}}
function jd(a,b){var c=a.sb[b],d=a.ta[b];if(c&&d){a.e.log(rc,"Updating dependent contexts",void 0);Fa(c,function(e){Fa(d,function(f){var g=this.ta;g[e]||(g[e]=[]);Ea(g[e],f)>=0||g[e].push(f);g=this.sb;g[f]||(g[f]=[]);Ea(g[f],e)>=0||g[f].push(e)},this)},a)}}var kd=new gd;function ld(){this.da="closure_frame"+md++;this.Y=[];nd[this.da]=this}var od;z(ld,cd);var nd={},md=0;function pd(a,b,c,d,e){var f=new ld;Vc(f,"ready",f.B,n,f);b&&Vc(f,"complete",b);f.send(a,c,d,e)}function qd(a,b){Na(b,function(c,d){var e=Vb("input",{type:"hidden",name:d,value:c});a.appendChild(e)})}o=ld.prototype;o.e=vc("goog.net.IframeIo");o.h=m;o.f=m;o.M=m;o.Ub=0;o.v=n;o.ia=n;o.Ma=n;o.Ga=m;o.Fa=m;o.aa=0;o.$a=m;o.F=m;
o.send=function(a,b,c,d){if(this.v)i(Error("[goog.net.IframeIo] Unable to send, already active."));this.Ga=a=new E(a);b=b?b.toUpperCase():"GET";if(c){F(a);c=Math.floor(Math.random()*2147483648).toString(36)+(Math.floor(Math.random()*2147483648)^ia()).toString(36);F(a);delete a.k;a.j.H("zx",c)}this.e.info("Sending iframe request: "+a+" ["+b+"]");if(!od){od=Vb("form");od.acceptCharset="utf-8";c=od.style;c.position="absolute";c.visibility="hidden";c.top=c.left="-10px";c.width=c.height="10px";c.overflow=
"hidden";document.body.appendChild(od)}this.h=od;Yb(this.h);b=="GET"&&qd(this.h,a.j);d&&qd(this.h,d);this.h.action=a.toString();this.h.method=b;this.v=k;this.ia=n;this.aa=0;this.e.log(M,"Creating iframe",void 0);this.M=this.da+"_"+(this.Ub++).toString(36);d={name:this.M,id:this.M};if(J&&Ib<7)d.src='javascript:""';this.f=Vb("iframe",d);d=this.f.style;d.visibility="hidden";d.width=d.height="10px";if(Fb)d.marginTop=d.marginLeft="-10px";else{d.position="absolute";d.top=d.left="-10px"}if(J){this.h.target=
this.M||"";document.body.appendChild(this.f);Vc(this.f,"readystatechange",this.Ia,n,this);try{this.ya=n;this.h.submit()}catch(e){Xc(this.f,"readystatechange",this.Ia,n,this);rd(this,1)}}else{this.e.log(M,"Setting up iframes and cloning form",void 0);document.body.appendChild(this.f);d=this.M+"_inner";a=Zb(this.f);c="<body><iframe id="+d+" name="+d+"></iframe>";if(Db)a.documentElement.innerHTML=c;else a.write(c);Vc(a.getElementById(d),"load",this.Ja,n,this);var f=this.h.getElementsByTagName("textarea");
c=0;for(b=f.length;c<b;c++){var g=f[c],h=void 0;if(Sb&&"innerText"in g)h=g.innerText.replace(/(\r\n|\r|\n)/g,"\n");else{h=[];dc(g,h,k);h=h.join("")}h=h.replace(/ \xAD /g," ").replace(/\xAD/g,"");J||(h=h.replace(/ +/g," "));if(h!=" ")h=h.replace(/^\s*/,"");if(h!=f[c].value){g=f[c];h=f[c].value;if("textContent"in g)g.textContent=h;else if(g.firstChild&&g.firstChild.nodeType==3){for(;g.lastChild!=g.firstChild;)g.removeChild(g.lastChild);g.firstChild.data=h}else{Yb(g);g.appendChild((g.nodeType==9?g:g.ownerDocument||
g.document).createTextNode(h))}}}f=a.importNode(this.h,k);f.target=d;a.body.appendChild(f);g=this.h.getElementsByTagName("select");h=f.getElementsByTagName("select");c=0;for(b=g.length;c<b;c++)h[c].selectedIndex=g[c].selectedIndex;g=this.h.getElementsByTagName("input");h=f.getElementsByTagName("input");c=0;for(b=g.length;c<b;c++)if(g[c].type=="file")if(g[c].value!=h[c].value){this.e.log(M,"File input value not cloned properly.  Will submit using original form.",void 0);this.h.target=d;f=this.h;break}this.e.log(M,
"Submitting form",void 0);try{this.ya=n;f.submit();a.close();if(Eb)this.$a=ed(this.mb,250,this)}catch(j){c="Error when submitting form: "+Wa(j);this.e.log(nc,c,void 0);Xc(a.getElementById(d),"load",this.Ja,n,this);a.close();rd(this,2)}}};o.abort=function(a){if(this.v){this.e.info("Request aborted");$c(sd(this));this.Ma=this.v=this.ia=n;this.aa=a||7;this.dispatchEvent("abort");td(this)}};
o.l=function(){this.e.log(M,"Disposing iframeIo instance",void 0);if(this.v){this.e.log(M,"Aborting active request",void 0);this.abort()}ld.U.l.call(this);this.f&&ud(this);vd(this);delete this.Va;this.Ga=this.Sb=this.Fa=this.Rb=this.h=m;this.aa=0;delete nd[this.da]};o.db=aa("v");o.dispatchEvent=function(a){this.f&&hd(kd,this.f);try{return ld.U.dispatchEvent.call(this,a)}finally{this.f&&id(kd);return k}};
o.Ia=function(){if(this.f.readyState=="complete"){Xc(this.f,"readystatechange",this.Ia,n,this);var a;try{a=Zb(this.f);if(J&&a.location=="about:blank"&&!navigator.onLine){rd(this,9);return}}catch(b){rd(this,1);return}wd(this,a)}};o.Ja=function(){if(!(Db&&xd(this).location=="about:blank")){Xc(sd(this),"load",this.Ja,n,this);wd(this,xd(this))}};
function wd(a,b){a.e.log(M,"Iframe loaded",void 0);a.ia=k;a.v=n;var c;try{var d=b.body;a.Fa=d.textContent||d.innerText;a.Rb=d.innerHTML}catch(e){c=1}var f;if(!c&&typeof a.Va=="function")if(f=a.Va(b))c=4;a.e.log(qc,"Last content: "+a.Fa,void 0);a.e.log(qc,"Last uri: "+a.Ga,void 0);if(c){a.e.log(M,"Load event occurred but failed",void 0);rd(a,c,f)}else{a.e.log(M,"Load succeeded",void 0);a.Ma=k;a.aa=0;a.dispatchEvent("complete");a.dispatchEvent("success");td(a)}}
function rd(a,b,c){if(!a.ya){a.Ma=n;a.v=n;a.ia=k;a.aa=b;if(b==4)a.Sb=c;a.dispatchEvent("complete");a.dispatchEvent("error");td(a);a.ya=k}}function td(a){a.e.info("Ready for new requests");var b=a.f;ud(a);vd(a);hd(kd,b);try{a.dispatchEvent("ready")}finally{id(kd)}}function ud(a){var b=a.f;if(b){b.onreadystatechange=m;b.onload=m;b.onerror=m;a.Y.push(b)}if(a.F){dd.clearTimeout(a.F);a.F=m}if(Eb||Db)a.F=ed(a.va,2E3,a);else a.va();a.f=m;a.M=m}
o.va=function(){if(this.F){dd.clearTimeout(this.F);this.F=m}for(var a=0;a<this.Y.length;){var b=this.Y[a],c;c=kd;var d=b;if(c.xa){var e=c.ta[w(d)?d:ea(d)?y(d):""];c.e.log(M,"Context is safe : "+d+" - "+e,void 0);c=!e}else c=k;if(c){this.e.info("Disposing iframe");Ha(this.Y,a);b&&b.parentNode&&b.parentNode.removeChild(b)}else a++}if(this.Y.length!=0){this.e.info("Requests outstanding, waiting to dispose");this.F=ed(this.va,2E3,this)}};function vd(a){a.h&&a.h==od&&Yb(a.h);a.h=m}
function xd(a){if(a.f)return Zb(sd(a));return m}function sd(a){if(a.f)return J?a.f:Zb(a.f).getElementById(a.M+"_inner");return m}o.mb=function(){if(this.v)this.$a=ed(this.mb,250,this)};function yd(){}
(function(){function a(h){var j=e;return j[h[0]]+j[h[1]]+j[h[2]]+j[h[3]]+"-"+j[h[4]]+j[h[5]]+"-"+j[h[6]]+j[h[7]]+"-"+j[h[8]]+j[h[9]]+"-"+j[h[10]]+j[h[11]]+j[h[12]]+j[h[13]]+j[h[14]]+j[h[15]]}function b(h,j,l){var q=h!="binary"?d:j?j:new c(16);j=j&&l||0;l=Math.random()*4294967296;q[j++]=l&255;q[j++]=(l>>>=8)&255;q[j++]=(l>>>=8)&255;q[j++]=l>>>8&255;l=Math.random()*4294967296;q[j++]=l&255;q[j++]=(l>>>=8)&255;q[j++]=(l>>>=8)&15|64;q[j++]=l>>>8&255;l=Math.random()*4294967296;q[j++]=l&63|128;q[j++]=(l>>>=
8)&255;q[j++]=(l>>>=8)&255;q[j++]=l>>>8&255;l=Math.random()*4294967296;q[j++]=l&255;q[j++]=(l>>>=8)&255;q[j++]=(l>>>=8)&255;q[j++]=l>>>8&255;return h===undefined?a(q):q}for(var c=Array,d=new c(16),e=[],f={},g=0;g<256;g++){e[g]=(g+256).toString(16).substr(1).toUpperCase();f[e[g]]=g}b.parse=function(h){var j=new c(16),l=0;h.toUpperCase().replace(/[0-9A-F][0-9A-F]/g,function(q){j[l++]=f[q]});return j};b.pc=a;b.ic=c;yd=b})();var zd={};r("dymo.label.framework.FlowDirection",zd,void 0);zd.LeftToRight="LeftToRight";zd.RightToLeft="RightToLeft";var Ad={};r("dymo.label.framework.LabelWriterPrintQuality",Ad,void 0);Ad.Auto="Auto";Ad.Text="Text";Ad.BarcodeAndGraphics="BarcodeAndGraphics";var Bd={};r("dymo.label.framework.TwinTurboRoll",Bd,void 0);Bd.Auto="Auto";Bd.Left="Left";Bd.Right="Right";var Cd={};r("dymo.label.framework.TapeAlignment",Cd,void 0);Cd.Center="Center";Cd.Left="Left";Cd.Right="Right";var Dd={};
r("dymo.label.framework.TapeCutMode",Dd,void 0);Dd.AutoCut="AutoCut";Dd.ChainMarks="ChainMarks";var Ed={};r("dymo.label.framework.AddressBarcodePosition",Ed,void 0);Ed.AboveAddress="AboveAddress";Ed.BelowAddress="BelowAddress";Ed.Suppress="Suppress";var Q={};r("dymo.label.framework.PrintJobStatus",Q,void 0);Q.pa=0;Q.Unknown=Q.pa;Q.Ab=1;Q.Printing=Q.Ab;Q.ub=2;Q.Finished=Q.ub;Q.tb=3;Q.Error=Q.tb;Q.yb=4;Q.PaperOut=Q.yb;Q.vb=5;Q.InQueue=Q.vb;Q.oa=-1;Q.ProcessingError=Q.oa;Q.zb=-2;Q.PrinterBusy=Q.zb;
Q.wb=-3;Q.InvalidJobId=Q.wb;Q.xb=-4;Q.NotSpooled=Q.xb;function R(a,b,c,d){b=a.ownerDocument.createElement(b);c&&b.appendChild(a.ownerDocument.createTextNode(c));if(d)for(var e in d)b.setAttribute(e,d[e]);a.appendChild(b);return b}function S(a){if(!a)return"";var b=[];dc(a,b,n);return b.join("")}function T(a,b){var c=a.getElementsByTagName(b);if(c.length>0)return c[0]}function U(a,b){Fd(a);a.appendChild(a.ownerDocument.createTextNode(b))}function Fd(a){for(;a.firstChild;)a.removeChild(a.firstChild)};function Gd(a,b,c,d){this.printerName=a;this.jobId=b;this.status=c;this.statusMessage=d}function Hd(a){var b={};a=a.split(" ");if(a.length>=1)b.status=parseInt(a[0],10);b.statusMessage=a.slice(1).join(" ");return b}
function Id(){if(!document.getElementById("_DymoLabelFrameworkJslSafariPlugin")){var a=document.createElement("embed");a.type="application/x-dymolabel";a.id="_DymoLabelFrameworkJslSafariPlugin";a.width=1;a.height=1;a.hidden=k;document.body.appendChild(a)}return window._DymoLabelFrameworkJslSafariPlugin}
function Jd(){if(!document.getElementById("_DymoLabelFrameworkJslPlugin")){var a=document.createElement("embed");a.type="application/x-dymolabel";a.id="_DymoLabelFrameworkJslPlugin";a.width=1;a.height=1;a.hidden=k;document.body.appendChild(a)}return document.getElementById("_DymoLabelFrameworkJslPlugin")}
function Kd(){if(!document.getElementById("_DymoLabelFrameworkJslPlugin")){var a=document.createElement("embed");a.type="application/x-npapi-dymolabel";a.id="_DymoLabelFrameworkJslPlugin";a.width=1;a.height=1;a.hidden=k;document.body.appendChild(a)}return document.getElementById("_DymoLabelFrameworkJslPlugin")}
function Ld(){var a=new ActiveXObject("DYMOLabelFrameworkIEPlugin.Plugin");if(typeof a!="object")i(Error("createFramework(): unable to create DYMO.Label.Framework object. Check DYMO Label Framework is installed"));return a}var V;
function W(){if(!V){var a=Md();if(a.errorDetails!="")i(Error(a.errorDetails));if(typeof ActiveXObject!="undefined"){V={};var b=Ld();V.getPrinters=function(){return b.GetPrinters()};V.openLabelFile=function(e){return b.OpenLabelFile(e)};V.printLabel=function(e,f,g,h){b.PrintLabel(e,f,g,h)};V.renderLabel=function(e,f,g){return b.RenderLabel(e,f,g)};V.loadImageAsPngBase64=function(e){return b.LoadImageAsPngBase64(e)};V.printLabel2=function(e,f,g,h){return b.PrintLabel2(e,f,g,h).toString()};V.getJobStatus=
function(e,f){var g=Hd(b.GetJobStatus(e,parseInt(f,10)));return new Gd(e,f,g.status,g.statusMessage)}}else if(navigator.platform.indexOf("Win")!=-1){var c=Jd();if(c){V={};V.getPrinters=function(){return c.getPrinters()};V.openLabelFile=function(e){return c.openLabelFile(e)};V.printLabel=function(e,f,g,h){c.printLabel(e,f,g,h)};V.renderLabel=function(e,f,g){return c.renderLabel(e,f,g)};V.loadImageAsPngBase64=function(e){return c.loadImageAsPngBase64(e)};V.printLabel2=function(e,f,g,h){if(x(c.printLabel2))return c.printLabel2(e,
f,g,h).toString();c.printLabel(e,f,g,h)};V.getJobStatus=function(e,f){var g;g=x(c.getJobStatus)?Hd(c.getJobStatus(e,parseInt(f,10))):{status:Q.pa,statusMessage:"not implemented"};return new Gd(e,f,g.status,g.statusMessage)}}else i(Error("DYMO Label Framework is not installed"))}else{var d;if(d=navigator.userAgent.indexOf("Safari")!=-1&&navigator.vendor.indexOf("Apple")!=-1?Id():Kd()){V={};V.getPrinters=function(){return d.getPrinters()};V.openLabelFile=function(e){var f=d.openLabelFile(e);if(!f)i(Error("Unable to open label file '"+
e+"'"));return f};V.printLabel=function(e,f,g,h){d.printLabel(g,e,f,h)};V.renderLabel=function(e,f,g){return d.renderLabel(e,f,g)};V.loadImageAsPngBase64=function(e){var f=d.loadImageAsPngBase64(e);if(!f)i(Error("Unable to load image from uri '"+e+"'"));return f};V.printLabel2=function(e,f,g,h){if(x(d.printLabel2))return d.printLabel2(g,e,f,h).toString();d.printLabel(g,e,f,h)};V.getJobStatus=function(e,f){var g;g=x(d.getJobStatus)?Hd(d.getJobStatus(e,parseInt(f,10))):{status:Q.pa,statusMessage:"not implemented"};
return new Gd(e,f,g.status,g.statusMessage)}}else i(Error("DYMO Label Framework is not installed"))}}return V};function Nd(a,b,c,d,e){this.printerType=a;this.name=b;this.modelName=c;this.isConnected=d;this.isLocal=e;this.la=this.m=""}function Od(a,b,c,d,e){Nd.call(this,"LabelWriterPrinter",a,b,c,d);this.isTwinTurbo=e}z(Od,Nd);function Pd(a,b,c,d,e){Nd.call(this,"TapePrinter",a,b,c,d);this.isAutoCutSupported=e}z(Pd,Nd);function X(a,b){this.V=a;this.ha=b}X.prototype.Ba=function(){return this.V.name};X.prototype.getPrinterName=X.prototype.Ba;X.prototype.Kb=aa("ha");X.prototype.getJobId=X.prototype.Kb;X.prototype.Ca=function(a){if(this.V.m!="")Qd(this,a);else{var b;try{b=W().getJobStatus(this.V.name,this.ha)}catch(c){b=new Gd(this.Ba(),this.ha,Q.oa,c.message||c)}a(b)}};X.prototype.getStatus=X.prototype.Ca;
function Qd(a,b){var c=a.Ba(),d=a.ha,e=a.V.m;(new fc(sb(e,"getPrintJobStatus"),"callback")).send({jobId:d,printerName:a.V.la},function(f){b(new Gd(c,d,f.status,f.statusMessage))},function(){b(new Gd(c,d,Q.oa,'Error processing getPrintJobStatus(): Unable to contact "'+e+'"'))})};function Y(){this.ra=[]}r("dymo.label.framework.LabelSetBuilder",Y,void 0);Y.prototype.Ob=aa("ra");Y.prototype.getRecords=Y.prototype.Ob;Y.prototype.Bb=function(){var a=new Z;this.ra.push(a);return a};Y.prototype.addRecord=Y.prototype.Bb;
function Rd(a){for(var b=K("<LabelSet/>"),c=b.documentElement,d=0;d<a.length;d++){var e=a[d],f=b.createElement("LabelRecord"),g;for(g in e){var h=e[g];if(typeof h!="function"){h=h.toString();var j=b.createElement("ObjectData");j.setAttribute("Name",g);if(h.indexOf("<TextMarkup>")==0){h=K(h);j.appendChild(h.documentElement.cloneNode(k))}else j.appendChild(b.createTextNode(h));f.appendChild(j)}}c.appendChild(f)}return ec(b)}Y.toXml=Rd;Y.prototype.toString=function(){return Rd(this.ra)};
function Z(){}Z.prototype.gc=function(a,b){b=b.toString();if(b.indexOf("<TextMarkup>")!=0)b="<TextMarkup>"+b+"</TextMarkup>";this[a]=b;return this};Z.prototype.setTextMarkup=Z.prototype.gc;Z.prototype.fc=function(a,b){this[a]=b;return this};Z.prototype.setText=Z.prototype.fc;Z.prototype.dc=function(a,b){this[a]=b;return this};Z.prototype.setBase64Image=Z.prototype.dc;function $(a){this.Pa=K(a)}$.prototype.P=function(){return ec(this.Pa)};$.prototype.getLabelXml=$.prototype.P;$.prototype.$b=function(a,b){return Sd(this.P(),a,b)};$.prototype.render=$.prototype.$b;$.prototype.print=function(a,b,c){Td(a,b,this.P(),c)};$.prototype.print=$.prototype.print;$.prototype.Wb=function(a,b,c){return Ud(a,b,this.P(),c)};$.prototype.print2=$.prototype.Wb;$.prototype.Xb=function(a,b,c,d,e){return Vd(a,b,this.P(),c,d,e)};$.prototype.printAndPollStatus=$.prototype.Xb;
var Wd=["AddressObject","TextObject","BarcodeObject","ShapeObject","CounterObject","ImageObject","CircularTextObject","DateTimeObject"];function Xd(a,b){var c=b||Wd;return $b(a.Pa.documentElement,function(d){return d.nodeType==1&&Ea(c,d.tagName)>=0})}$.prototype.Mb=function(){for(var a=Xd(this),b=[],c=0;c<a.length;c++)b.push(S(T(a[c],"Name")));return b};$.prototype.getObjectNames=$.prototype.Mb;function Yd(a){return Xd(a,["AddressObject"])}$.prototype.Ib=function(){return Yd(this).length};
$.prototype.getAddressObjectCount=$.prototype.Ib;$.prototype.Hb=function(a){return S(T(Yd(this)[a],"BarcodePosition"))};$.prototype.getAddressBarcodePosition=$.prototype.Hb;$.prototype.bc=function(a,b){if(!(b=="AboveAddress"||b=="BelowAddress"||b=="Suppress"))i(Error("verifyAddressBarcodePosition(): barcode position '"+b+"' is invalid value"));U(T(Yd(this)[a],"BarcodePosition"),b);return this};$.prototype.setAddressBarcodePosition=$.prototype.bc;$.prototype.Jb=function(a){return Zd(this,Yd(this)[a])};
$.prototype.getAddressText=$.prototype.Jb;$.prototype.cc=function(a,b){return $d(this,Yd(this)[a],b)};$.prototype.setAddressText=$.prototype.cc;function ae(a,b){for(var c=Xd(a),d=0;d<c.length;d++){var e=c[d];if(S(T(e,"Name"))==b)return e}i(Error("getObjectByNameElement(): no object with name '"+b+"' was found"))}function Zd(a,b){return Ga(T(b,"StyledText").getElementsByTagName("String"),function(c,d){return c+S(d)},"")}
$.prototype.Nb=function(a){a=ae(this,a);switch(a.tagName){case "AddressObject":case "TextObject":return Zd(this,a);case "BarcodeObject":return S(T(a,"Text"));case "ImageObject":if(a=T(a,"Image"))return S(a);else break;case "CircularTextObject":return S(T(a,"Text"))}return""};$.prototype.getObjectText=$.prototype.Nb;
function $d(a,b,c){for(var d=T(b,"StyledText"),e=[],f=d.getElementsByTagName("Element"),g=0;g<f.length;g++){var h=f[g],j=S(T(h,"String")).split("\n").length;g>0&&j--;h=T(h,"Attributes");for(var l=0;l<j;l++)e.push(h)}b=T(b,"LineFonts").getElementsByTagName("Font");var q;if(b.length==0)q=K('<Font Family="Arial" Size="12" Bold="False" Italic="False" Underline="False" Strikeout="False" />').documentElement;f=K('<ForeColor Alpha="255" Red="0" Green="0" Blue="0" />').documentElement;Fd(d);c=c.split("\n");
for(g=0;g<c.length;g++){var u=c[g].replace("\r","");if(g<c.length-1)u+="\n";j=q;if(g<b.length)j=b[g];else if(b.length>0)j=b[b.length-1];h=f;if(g<e.length)h=T(e[g],"ForeColor");l=d.ownerDocument.createElement("Element");var v=d.ownerDocument.createElement("String");U(v,u);u=d.ownerDocument.createElement("Attributes");u.appendChild(j.cloneNode(k));u.appendChild(h.cloneNode(k));l.appendChild(v);l.appendChild(u);d.appendChild(l)}return a}
$.prototype.ec=function(a,b){var c=ae(this,a);switch(c.tagName){case "AddressObject":$d(this,c,b);break;case "TextObject":c=T(c,"StyledText");var d=T(c,"Element");if(d){Fd(c);U(T(d,"String"),b);c.appendChild(d)}else{d=K("<Element><String>"+b+'</String>                    <Attributes>                        <Font Family="Arial" Size="12" Bold="False" Italic="False" Underline="False" Strikeout="False" />                        <ForeColor Alpha="255" Red="0" Green="0" Blue="0" />                    </Attributes></Element>');
c.appendChild(d.documentElement.cloneNode(k))}break;case "BarcodeObject":U(T(c,"Text"),b);break;case "ImageObject":if(d=T(c,"Image"))U(d,b);else{var e=T(c,"ImageLocation");if(!e)i(Error("setObjectText(): <ImageLocation> is expected but not found: "+ec(d)));d=e.ownerDocument.createElement("Image");U(d,b);c.replaceChild(d,e)}break;case "CircularTextObject":U(T(c,"Text"),b);break;case "DateTimeObject":U(T(c,"PreText"),b);break;case "CounterObject":U(T(c,"PreText"),b)}return this};
$.prototype.setObjectText=$.prototype.ec;$.prototype.toString=function(){return this.P()};r("dymo.label.framework.VERSION","1.5",void 0);function be(a,b,c){this.isBrowserSupported=a;this.isFrameworkInstalled=b;this.errorDetails=c}
function Md(){var a={Z:n,$:n,C:""},b=window.navigator.platform;if(b.indexOf("Win")!=-1)if(typeof ActiveXObject!="undefined"){a.Z=k;try{if(typeof new ActiveXObject("DYMOLabelFrameworkIEPlugin.Plugin")!="object")a.C="Unable to create DYMO.Label.Framework ActiveX object. Check that DYMO.Label.Framework is installed";else a.$=k}catch(c){a.C="Unable to create DYMO.Label.Framework ActiveX object. Check that DYMO.Label.Framework is installed. Exception details: "+c}}else{a.Z=k;b=n;for(var d=0;d<navigator.plugins.length;++d){for(var e=
navigator.plugins[d],f=0;f<e.length;++f)if(e[f].type=="application/x-dymolabel"){b=k;break}if(b)break}if(b)a.$=k;else a.C="DYMO Label Framework Plugin is not installed"}else if(b.indexOf("Mac")!=-1)if(navigator.userAgent.indexOf("Safari")!=-1&&navigator.vendor.indexOf("Apple")!=-1){a.Z=k;b=n;for(d=0;d<navigator.plugins.length;++d){e=navigator.plugins[d];for(f=0;f<e.length;++f)if(e[f].type=="application/x-dymolabel"){b=k;break}if(b)break}if(b)if(Id().GetAPIVersion()>="2.0")a.$=k;else a.C="DYMO Label Safari Plugin is installed but outdated. Install latest version.";
else a.C="DYMO Label Safari Plugin is not installed"}else{a.Z=k;b=n;for(d=0;d<navigator.plugins.length;++d){e=navigator.plugins[d];for(f=0;f<e.length;++f)if(e[f].type=="application/x-npapi-dymolabel"){b=k;break}if(b)break}if(b)a.$=k;else a.C="DYMO Label NPAPI Plugin is not installed"}else a.C="The operating system is not supported";return new be(a.Z,a.$,a.C)}r("dymo.label.framework.checkEnvironment",Md,void 0);var ce={};function de(a,b,c){this.m=a;this.Yb=b;this.Zb=c}
de.prototype.getPrinters=function(){var a=ee(this.Zb),b=new E(this.m),c=this.Yb;if(c=="")c=b.q;for(b=0;b<a.length;++b){var d=a[b],e=d.name;d.name=e+" @ "+c;d.m=this.m;d.la=e}return a};r("dymo.label.framework.addPrinterUri",function(a,b,c,d){var e=b||"";w(e)||(e=e.toString());b=m;if(d)b=function(){d(a)};var f=bb(a,"getPrinters");(new fc(f,"callback")).send(m,function(g){ce[a]=new de(a,e,g);c&&c(a)},b)},void 0);r("dymo.label.framework.removePrinterUri",function(a){delete ce[a]},void 0);
r("dymo.label.framework.removeAllPrinterUri",function(){ce={}},void 0);
function ee(a){var b=K(a);a=[];var c=T(b,"Printers");b=c.getElementsByTagName("LabelWriterPrinter");for(var d=0;d<b.length;d++){var e=S(T(b[d],"Name")),f=S(T(b[d],"ModelName")),g=S(T(b[d],"IsConnected"))=="True",h=S(T(b[d],"IsLocal"))=="True",j=S(T(b[d],"IsTwinTurbo"))=="True";e=new Od(e,f,g,h,j);a[d]=e;a[e.name]=e}c=c.getElementsByTagName("TapePrinter");for(d=0;d<c.length;d++){e=S(T(c[d],"Name"));f=S(T(c[d],"ModelName"));g=S(T(c[d],"IsConnected"))=="True";h=S(T(c[d],"IsLocal"))=="True";j=S(T(c[d],
"IsAutoCutSupported"))=="True";e=new Pd(e,f,g,h,j);a[d+b.length]=e;a[e.name]=e}return a}function fe(){var a=[];try{var b=W().getPrinters();a=ee(b)}catch(c){}for(var d in ce){b=ce[d].getPrinters();for(var e=0;e<b.length;++e){var f=b[e];a.push(f);a[f.name]=f}}return a}r("dymo.label.framework.getPrinters",fe,void 0);function ge(a){for(var b=[],c=fe(),d=0;d<c.length;d++){var e=c[d];e.printerType==a&&b.push(e)}return b}
r("dymo.label.framework.getLabelWriterPrinters",function(){return ge("LabelWriterPrinter")},void 0);r("dymo.label.framework.getTapePrinters",function(){return ge("TapePrinter")},void 0);r("dymo.label.framework.openLabelFile",function(a){return new $(W().openLabelFile(a))},void 0);r("dymo.label.framework.openLabelXml",function(a){return new $(a)},void 0);
function Td(a,b,c,d){b=b||"";d=d||"";if(typeof d!="string")d=d.toString();if(typeof c=="undefined")i(Error("printLabel(): labelXml parameter should be specified"));if(typeof c!="string")c=c.toString();var e=fe()[a];if(e!=m)e.m!=""?he(e,b,c,d):W().printLabel(e.name,b,c,d);else i(Error("printLabel(): unknown printer '"+a+"'"))}r("dymo.label.framework.printLabel",Td,void 0);
function Ud(a,b,c,d){b=b||"";d=d||"";if(typeof d!="string")d=d.toString();if(typeof c=="undefined")i(Error("printLabel2(): labelXml parameter should be specified"));if(typeof c!="string")c=c.toString();var e=fe()[a];if(e!=m)return e.m!=""?he(e,b,c,d):new X(e,W().printLabel2(a,b,c,d));else i(Error("printLabel(): unknown printer '"+a+"'"))}r("dymo.label.framework.printLabel2",Ud,void 0);
function he(a,b,c,d){var e=yd();pd(sb(a.m,"printLabel"),m,"POST",k,{jobId:e,printerName:a.la,labelXml:c,printParamsXml:b,labelSetXml:d});return new X(a,e)}function Vd(a,b,c,d,e,f){function g(j){if(e(h,j)){var l=new fd(function(){h.Ca(g);l.B()},f);l.start()}}var h=Ud(a,b,c,d);h.Ca(g);return h}r("dymo.label.framework.printLabelAndPollStatus",Vd,void 0);
function Sd(a,b,c){if(typeof a=="undefined")i(Error("renderLabel(): labelXml parameter should be specified"));if(typeof a!="string")a=a.toString();return W().renderLabel(a,b||"",c||"")}r("dymo.label.framework.renderLabel",Sd,void 0);function ie(a,b,c,d){var e={};e.requestId=a;e.imageData=d;e.statusId=b;e.statusMessage=c;return e}
r("dymo.label.framework.renderLabelAsync",function(a,b,c,d){if(typeof a=="undefined")i(Error("renderLabelAsync(): labelXml parameter should be specified"));if(!b)i(Error("renderLabelAsync(): callback parameter should be specified"));if(typeof a!="string")a=a.toString();c=c||"";d=d||"";var e=fe()[d];if(d==m||e!=m&&e.m==""){var f;try{var g=W().renderLabel(a,c,d);f=ie("","Ready","",g)}catch(h){f=ie("","Error",h.message||h,"")}b(f)}else{if(e==m)i(Error("printLabel(): unknown printer '"+d+"'"));var j=
yd();pd(sb(e.m,"renderLabel"),m,"POST",k,{requestId:j,printerName:e.la,labelXml:a,renderParamsXml:c});var l,q=(new Date).getTime();l=new fd(function(){if((new Date).getTime()-q>3E4){l.B();l=m;b(ie(j,"Timeout","",""))}else(new fc(sb(e.m,"getRenderLabelStatus"),"callback")).send({requestId:j},function(u){var v=u.statusId;if(v=="NotStarted"||v=="Processing"){l.stop();l.start(1E3)}else{l.B();l=m;b(u)}},function(){l.start(1E3)})},500);l.start()}},void 0);
r("dymo.label.framework.loadImageAsPngBase64",function(a){return W().loadImageAsPngBase64(a)},void 0);r("dymo.label.framework.createLabelWriterPrintParamsXml",function(a){if(!a)return"";var b=K("<LabelWriterPrintParams/>"),c=b.documentElement;a.copies&&R(c,"Copies",a.copies.toString());a.jobTitle&&R(c,"JobTitle",a.jobTitle);a.flowDirection&&R(c,"FlowDirection",a.flowDirection);a.printQuality&&R(c,"PrintQuality",a.printQuality);a.twinTurboRoll&&R(c,"TwinTurboRoll",a.twinTurboRoll);return ec(b)},void 0);
r("dymo.label.framework.createTapePrintParamsXml",function(a){if(!a)return"";var b=K("<TapePrintParams/>"),c=b.documentElement;a.copies&&R(c,"Copies",a.copies.toString());a.jobTitle&&R(c,"JobTitle",a.jobTitle);a.flowDirection&&R(c,"FlowDirection",a.flowDirection);a.alignment&&R(c,"Alignment",a.alignment);a.cutMode&&R(c,"CutMode",a.cutMode);return ec(b)},void 0);
r("dymo.label.framework.createLabelRenderParamsXml",function(a){function b(e,f){R(d,e,undefined,{Alpha:f.a||f.alpha||255,Red:f.r||f.red||0,Green:f.g||f.green||0,Blue:f.b||f.blue||0})}if(!a)return"";var c=K("<LabelRenderParams/>"),d=c.documentElement;a.labelColor&&b("LabelColor",a.labelColor);a.shadowColor&&b("ShadowColor",a.shadowColor);typeof a.shadowDepth!="undefined"&&R(d,"ShadowDepth",a.shadowDepth.toString());a.flowDirection&&R(d,"FlowDirection",a.flowDirection);if(typeof a.pngUseDisplayResolution!=
"undefined")R(d,"PngUseDisplayResolution",a.pngUseDisplayResolution?"True":"False");return ec(c)},void 0);})();
//----------------------------------------------------------------------------
//
//  $Id: PrintMeThatLabel.js 14858 2011-03-25 00:10:21Z vbuzuev $ 
//
// Project -------------------------------------------------------------------
//
//  DYMO Label Framework
//
// Content -------------------------------------------------------------------
//
//  Web SDK print label sample
//
//----------------------------------------------------------------------------
//
//  Copyright (c), 2011, Sanford, L.P. All Rights Reserved.
//
//----------------------------------------------------------------------------
(function () {
    // utility functions from goog.dom
    /**
     * Enumeration for DOM node types (for reference)
     * @enum {number}
     */
    var NodeType = {
        ELEMENT: 1,
        ATTRIBUTE: 2,
        TEXT: 3,
        CDATA_SECTION: 4,
        ENTITY_REFERENCE: 5,
        ENTITY: 6,
        PROCESSING_INSTRUCTION: 7,
        COMMENT: 8,
        DOCUMENT: 9,
        DOCUMENT_TYPE: 10,
        DOCUMENT_FRAGMENT: 11,
        NOTATION: 12
    };
    /**
     * Removes all the child nodes on a DOM node.
     * @param {Node} node Node to remove children from.
     */
    var removeChildren = function (node) {
        // Note: Iterations over live collections can be slow, this is the fastest
        // we could find. The double parenthesis are used to prevent JsCompiler and
        // strict warnings.
        var child;
        while ((child = node.firstChild)) {
            node.removeChild(child);
        }
    };
    /**
     * Returns the owner document for a node.
     * @param {Node|Window} node The node to get the document for.
     * @return {!Document} The document owning the node.
     */
    var getOwnerDocument = function (node) {
        // TODO(user): Remove IE5 code.
        // IE5 uses document instead of ownerDocument
        return /** @type {!Document} */ (
            node.nodeType == NodeType.DOCUMENT ? node :
            node.ownerDocument || node.document);
    };
    /**
     * Cross-browser function for setting the text content of an element.
     * @param {Element} element The element to change the text content of.
     * @param {string} text The string that should replace the current element
     *     content.
     */
    var setTextContent = function (element, text) {
        if ('textContent' in element) {
            element.textContent = text;
        } else if (element.firstChild &&
            element.firstChild.nodeType == NodeType.TEXT) {
            // If the first child is a text node we just change its data and remove the
            // rest of the children.
            while (element.lastChild != element.firstChild) {
                element.removeChild(element.lastChild);
            }
            element.firstChild.data = text;
        } else {
            removeChildren(element);
            var doc = getOwnerDocument(element);
            element.appendChild(doc.createTextNode(text));
        }
    };
    // app settings stored between sessions
    var Settings = function () {
        this.currentPrinterName = "";
        this.printerUris = [];
    }
    // loads settings
    Settings.prototype.load = function () {
        var currentPrinterName = Cookie.get('currentPrinterName');
        var printerUris = Cookie.get('printerUris');
        if (currentPrinterName)
            this.currentPrinterName = currentPrinterName;
        if (printerUris)
            this.printerUris = printerUris.split('|');
    }
    Settings.prototype.save = function () {
        Cookie.set('currentPrinterName', this.currentPrinterName, 24 * 365);
        Cookie.set('printerUris', this.printerUris.join('|'), 24 * 365);
    }
    // called when the document completly loaded
    function onload() {
        var printButton = document.getElementById('printButton');
        var printerSettingsButton = document.getElementById('printerSettingsButton');
        //var labelSettingsDiv = document.getElementById('labelSettingsDiv');
        var printerSettingsDiv = document.getElementById('printerSettingsDiv');
        var printerUriTextBox = document.getElementById('printerUriTextBox');
        var addPrinterUriButton = document.getElementById('addPrinterUriButton');
        var clearPrinterUriButton = document.getElementById('clearPrinterUriButton');
        var printersComboBox = document.getElementById('printersComboBox');
        var jobStatusMessageSpan = document.getElementById('jobStatusMessageSpan');
        var settings = new Settings();
        // save settings to cookies
        function saveSettings() {
            settings.currentPrinterName = "DYMO LabelWriter 450 Twin Turbo @ terminal.adventsys.com";
            //settings.save();
        }

        // caches a list of printers
        var printers = [];
        // loads all supported printers into a combo box
        function updatePrinters() {
            // clear first
            //removeChildren(printersComboBox);
            //while (printersComboBox.firstChild) 
            //    printersComboBox.removeChild(printersComboBox.firstChild);
            printers = dymo.label.framework.getPrinters();
            //if (printers.length == 0)
            //{
            //    alert("No DYMO printers are installed. Install DYMO printers.");
            //    return;
            //}
            //for (var i = 0; i < printers.length; i++)
            //{
            //    var printerName = printers[i].name;
            //
            //    var option = document.createElement('option');
            //    option.value = printerName;
            //    option.appendChild(document.createTextNode(printerName));
            //    printersComboBox.appendChild(option);
            //
            //    if (printerName == settings.currentPrinterName)
            //        printersComboBox.selectedIndex = i;
            //}
            //printerSettingsDiv.style.display= printers.length == 0 ? 'block' : 'none';
        }

        var addressLabel = null;
        var tapeLabel = null;
        // load labels from the server
        function loadLabels() {
            $.get("../Address.label", function (labelXml) {
                addressLabel = dymo.label.framework.openLabelXml(labelXml);
            }, "text");
        }

        // load settings from cookies
        function loadSettings() {
            settings.load();
            // update printer uris
            for (var i = 0; i < settings.printerUris.length; ++i) {
                var printerUri = settings.printerUris[i];
                dymo.label.framework.addPrinterUri(printerUri, '',
                    updatePrinters,
                    function () {
                        alert('Unable to contact "' + printerUri + '"');
                    });
            }
            //fixedLabelLengthCheckBox.checked = settings.isFixedLabelLength;
            //fixedLabelLengthTextBox.value = settings.fixedLabelLength;
            //fixedLabelLengthTextBox.disabled = !settings.isFixedLabelLength;
            //printerIpAddressTextBox.value = settings.printerIpAddress;
        }

        /*
         fixedLabelLengthCheckBox.onclick = function()
         {
         fixedLabelLengthTextBox.disabled = !fixedLabelLengthCheckBox.checked;
         }

         labelSettingsButton.onclick = function()
         {
         if (labelSettingsDiv.style.display == 'none')
         labelSettingsDiv.style.display = 'block';
         else
         labelSettingsDiv.style.display = 'none';
         }
         */
        //printerSettingsButton.onclick = function()
        //{
        //    if (printerSettingsDiv.style.display == 'none')
        //        printerSettingsDiv.style.display = 'block';
        //    else
        //        printerSettingsDiv.style.display = 'none';
        //}
        printButton.onclick = function () {
            try {
                printButton.disabled = true;
                //settings.currentPrinterName = printersComboBox.value;
                //settings.currentPrinterName = "\\\\terminal\\DYMO LabelWriter 450 Twin Turbo";
                settings.currentPrinterName = "DYMO LabelWriter 450 Twin Turbo @ terminal.adventsys.com";
                var text = document.getElementById('labelTextArea').value;
                var printer = printers[settings.currentPrinterName];
                if (!printer)
                    throw new Error("Select printer");
                // determine what label to print based on printer type
                var label = null;
                var objName = "";
                if (printer.printerType == "LabelWriterPrinter") {
                    label = addressLabel;
                    objName = "Address";
                }
                else {
                    label = tapeLabel;
                    objName = "Text";
                }
                if (!label)
                    throw new Error("Label is not loaded. Wait until is loaded or reload the page");
                // set data
                // Because Android does not support XPath (that is needed for setObjectText)
                // we will use LabelSet instead
                //label.setObjectText(objName, text);
                var labelSet = new dymo.label.framework.LabelSetBuilder();
                labelSet.addRecord().setText(objName, text);
                var printparams;
                printparams = dymo.label.framework.createLabelWriterPrintParamsXml({twinTurboRoll: dymo.label.framework.TwinTurboRoll.Left});
                // print
                //label.print(printer.name, null, labelSet.toString());
                // print and get status
                var printJob = label.printAndPollStatus(printer.name, printparams, labelSet.toString(), function (printJob, printJobStatus) {
                    // output status
                    var statusStr = 'Job Status: ' + printJobStatus.statusMessage;
                    var result = (printJobStatus.status != dymo.label.framework.PrintJobStatus.ProcessingError
                    && printJobStatus.status != dymo.label.framework.PrintJobStatus.Finished);
                    // reenable when the job is done (either success or fail)
                    printButton.disabled = result;
                    //if (!result)
                    //    statusStr = '';
                    setTextContent(jobStatusMessageSpan, statusStr);
                    return result;
                }, 1000);
                saveSettings();
            }
            catch (e) {
                printButton.disabled = false;
                alert(e.message || e);
            }
        };
        var printerUri = 'http://terminal.adventsys.com:8631';
        if (!printerUri)
            throw new Error("Specify printer Url");
        dymo.label.framework.addPrinterUri(printerUri, '',
            function () {
                settings.printerUris.push(printerUri);
                settings.currentPrinterName = "DYMO LabelWriter 450 Twin Turbo @ terminal.adventsys.com";
                printers = dymo.label.framework.getPrinters();
                if(printers[settings.currentPrinterName].isConnected == true)
                    setTextContent(jobStatusMessageSpan, "Dymo Status: Ready");
                else
                    setTextContent(jobStatusMessageSpan, "Dymo Status: Not connected");
                //console.log(printers);
            },
            function () {
                setTextContent(jobStatusMessageSpan, "Dymo Status: Unable to connect to " + printerUri);
            }
        );
        //clearPrinterUriButton.onclick = function()
        //{
        //    dymo.label.framework.removeAllPrinterUri();
        //    settings.printerUris = [];
        //    saveSettings();
        //    updatePrinters();
        //}
        // setup controls
        loadLabels();
        //loadSettings();
        //updatePrinters();  // for local printers
        //fixedLabelLengthCheckBox.isChecked = false;
        //fixedLabelLengthTextBox.disabled = true;
        //labelSettingsDiv.style.display='none';
        //printerSettingsDiv.style.display= !settings.printerIpAddress ? 'block' : 'none';
    };
    // register onload event
    if (window.addEventListener)
        window.addEventListener("load", onload, false);
    else if (window.attachEvent)
        window.attachEvent("onload", onload);
    else
        window.onload = onload;
}());

//# sourceMappingURL=dymo.js.map
