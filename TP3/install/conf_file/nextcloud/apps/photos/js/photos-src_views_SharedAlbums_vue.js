"use strict";(self.webpackChunkphotos=self.webpackChunkphotos||[]).push([["src_views_SharedAlbums_vue"],{84978:(n,t,e)=>{e.d(t,{Z:()=>i});var o=e(87537),s=e.n(o),a=e(23645),l=e.n(a)()(s());l.push([n.id,".albums-list[data-v-cca18204]{display:flex;flex-direction:column}.albums-list .album__name[data-v-cca18204]{font-weight:normal;overflow:hidden;white-space:nowrap;text-overflow:ellipsis}","",{version:3,sources:["webpack://./src/views/SharedAlbums.vue"],names:[],mappings:"AAsGA,8BACC,YAAA,CACA,qBAAA,CAEA,2CACC,kBAAA,CACA,eAAA,CACA,kBAAA,CACA,sBAAA",sourcesContent:['$sizes: ("400": ("count": 3, "marginTop": 66, "marginW": 8), "700": ("count": 4, "marginTop": 66, "marginW": 8), "1024": ("count": 5, "marginTop": 66, "marginW": 44), "1280": ("count": 4, "marginTop": 66, "marginW": 44), "1440": ("count": 5, "marginTop": 88, "marginW": 66), "1600": ("count": 6, "marginTop": 88, "marginW": 66), "2048": ("count": 7, "marginTop": 88, "marginW": 66), "2560": ("count": 8, "marginTop": 88, "marginW": 88), "3440": ("count": 9, "marginTop": 88, "marginW": 88), "max": ("count": 10, "marginTop": 88, "marginW": 88));\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n.albums-list {\n\tdisplay: flex;\n\tflex-direction: column;\n\n\t.album__name {\n\t\tfont-weight: normal;\n\t\toverflow: hidden;\n\t\twhite-space: nowrap;\n\t\ttext-overflow: ellipsis;\n\t}\n}\n'],sourceRoot:""}]);const i=l},92427:(n,t,e)=>{e.r(t),e.d(t,{default:()=>k});var o=e(65322),s=e(79753),a=e(33476),l=e(49723),i=e(39981),r=e(88843),m=e(27248);const c={name:"SharedAlbums",components:{FolderMultipleImage:o.Z,NcEmptyContent:a.NcEmptyContent,CollectionsList:i.Z,CollectionCover:r.Z,HeaderNavigation:m.Z},filters:{coverUrl:function(n){return-1===n?"":(0,s.generateUrl)("/apps/photos/api/v1/preview/".concat(n,"?x=",512,"&y=",512))}},mixins:[l.Z],methods:{onRefresh:function(){this.fetchAlbums()}}};var u=e(93379),p=e.n(u),h=e(7795),d=e.n(h),A=e(90569),b=e.n(A),g=e(3565),v=e.n(g),C=e(19216),f=e.n(C),_=e(44589),w=e.n(_),y=e(84978),T={};T.styleTagTransform=w(),T.setAttributes=v(),T.insert=b().bind(null,"head"),T.domAPI=d(),T.insertStyleElement=f();p()(y.Z,T);y.Z&&y.Z.locals&&y.Z.locals;const k=(0,e(51900).Z)(c,(function(){var n=this,t=n.$createElement,e=n._self._c||t;return e("CollectionsList",{staticClass:"albums-list",attrs:{collections:n.sharedAlbums,loading:n.loadingAlbums,"collection-title":n.t("photos","Shared albums"),"collection-root":n.t("photos","Shared albums"),error:n.errorFetchingAlbums},scopedSlots:n._u([{key:"default",fn:function(t){var o=t.collection;return e("CollectionCover",{key:o.basename,attrs:{link:"/sharedalbums/"+o.basename,"alt-img":n.t("photos","Cover photo for shared album {albumName}.",{albumName:o.basename}),"cover-url":n._f("coverUrl")(o.lastPhoto)}},[e("h2",{staticClass:"album__name"},[n._v("\n\t\t\t"+n._s(o.basename)+"\n\t\t")]),n._v(" "),e("div",{staticClass:"album__details",attrs:{slot:"subtitle"},slot:"subtitle"},[n._v("\n\t\t\t"+n._s(o.date)+" ⸱ "+n._s(n.n("photos","%n item","%n photos and videos",o.nbItems))+"\n\t\t")])])}}])},[e("HeaderNavigation",{key:"navigation",attrs:{slot:"header",loading:n.loadingAlbums,title:n.t("photos","Shared albums"),"root-title":n.t("photos","Shared albums")},on:{refresh:n.onRefresh},slot:"header"}),n._v(" "),n._v(" "),e("NcEmptyContent",{attrs:{slot:"empty-collections-list",title:n.t("photos","There is no album yet!")},slot:"empty-collections-list"},[e("FolderMultipleImage",{attrs:{slot:"icon"},slot:"icon"})],1)],1)}),[],!1,null,"cca18204",null).exports}}]);
//# sourceMappingURL=photos-src_views_SharedAlbums_vue.js.map?v=9d9d9aaecc4756009735