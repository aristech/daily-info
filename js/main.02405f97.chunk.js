(window.webpackJsonp=window.webpackJsonp||[]).push([[0],{173:function(e,t,n){"use strict";n.r(t);var a=n(2),c=n.n(a),r=n(61),s=n.n(r),o=n(24),i=n.n(o),u=n(62),f=n(63),l=n(1),d=window.wpApiDailyInfo;var p=function(){var e=Object(a.useState)(null),t=Object(f.a)(e,2),n=t[0],r=t[1];Object(a.useEffect)(function(){s()},[]);var s=function(){var e=Object(u.a)(i.a.mark(function e(){var t,n,a;return i.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return t=Object(l.getDay)(new Date),e.next=3,fetch("".concat(d.siteUrl,"/wp-json/rest_aristech/dailyInfo?day=").concat(t));case 3:return n=e.sent,e.next=6,n.json();case 6:a=e.sent,r(a);case 8:case"end":return e.stop()}},e)}));return function(){return e.apply(this,arguments)}}(),o=function(){switch(Object(l.getDay)(new Date)){case 1:return"monday";case 2:return"tuesday";case 3:return"wednesday";case 4:return"thursday";case 5:return"friday";case 6:return"saturday";case 0:return"sunday"}};return c.a.createElement("div",{className:"App"},n&&n.map(function(e,t){return function(e){Object(l.getDay)(new Date);var t=Object(l.format)(new Date,"YYYY-MM-DD"),n=Object(l.getTime)(new Date),a="aristech_".concat(o(),"_start"),r="aristech_".concat(o(),"_end"),s="aristech_".concat(o(),"_text");return Object.values(e).map(function(e){var o=Object(l.getTime)(Object(l.parse)("".concat(t,"T").concat(e[0][a],":00"))),i=Object(l.getTime)(Object(l.parse)("".concat(t,"T").concat(e[1][r],":00")));return n>o&&n<i&&c.a.createElement("div",{className:"daily-info-box",style:{backgroundColor:"#22c777",alignSelf:"center",color:"#fff",textAlign:"center",margin:5}},c.a.createElement("h3",{className:"daily-info-text",style:{color:"#fff",textAlign:"center",padding:20}}," ",e[2][s]))})}(e)}))};s.a.render(c.a.createElement(p,null),document.getElementById("dailyInfo"))},64:function(e,t,n){e.exports=n(173)}},[[64,1,2]]]);
//# sourceMappingURL=main.02405f97.chunk.js.map