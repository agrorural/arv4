!function(e){function a(a){e.ajax({url:ajax_is.ajax_url,data:a,beforeSend:function(){e("#optMonth").prop("disabled",!0),e("#optYear").prop("disabled",!0),e("#optPerPage").prop("disabled",!0),e("#btnDocumento").button("loading"),e("#btnLimpiar").button("loading"),o.find(".preloaded").removeClass("hidden"),o.find(".hentry").addClass("hidden")},complete:function(){e("#optMonth").prop("disabled",!1),e("#optYear").prop("disabled",!1),e("#optPerPage").prop("disabled",!1),e("#btnDocumento").button("reset"),e("#btnLimpiar").button("reset"),o.find(".preloaded").addClass("hidden"),o.find(".hentry").removeClass("hidden")},success:function(e){if(a=e,o.find(".search-result").empty(),o.find(".wp-pagenavi").empty(),a.bError){var t="";t='<article class="hentry documentos hidden">',t+='<div class="entry-container">',t+='<div class="entry-body">',t+='<h2 class="entry-title">',t+=a.vMensaje,t+="</h2>",t+='<div class="entry-content">',t+="<p>Intente con otros parámetros de búsqueda...</p>",t+="</div>",t+="</div>",t+="</div>",t+="</article>",o.find(".wp-pagenavi").addClass("hidden"),o.find(".search-result").append(t)}else{for(var d=0;d<a.response.length;d++){var p="";p+='<article class="post-'+a.response[d].id+' status-publish hentry tipos-rde documentos hidden">',p+='<div class="entry-container">',p+='<div class="entry-body ">',s="Directivas"===a.postTerm||"PAC"===a.postTerm?a.response[d].doc_ane__nom:s=a.response[d].title,r="Directivas"===a.postTerm||"PAC"===a.postTerm?a.response[d].doc_ane__desc:r=a.response[d].content,p+='<h2 class="entry-title">',p+='<a href="'+a.response[d].permalink+'">'+s+"</a>",p+="</h2>",p+='<div class="entry-content">'+r+"</div>",p+='<div class="post-meta">',p+='<div class="post-date">',p+='<time class="updated">'+a.response[d].date+"</time>",p+="</div>",p+='<div class="post-comments">',n="Directivas"===a.postTerm?"RDE":"PAC"===a.postTerm?"RDA":a.postTerm,p+="Publicado"===a.response[d].doc_link?'<a href="'+ajax_is.upload_dir.baseurl+i+n.toLowerCase()+"/"+a.response[d].slug.toUpperCase()+'.PDF" target="_blank"><i class="fa fa-file-pdf-o"></i> Descargar</a>':"No disponible",p+="</div>",p+="</div>",p+="</div>",p+="</div>",p+="</article>",o.find(".search-result").append(p),o.find(".wp-pagenavi").hasClass("hidden")&&o.find(".wp-pagenavi").removeClass("hidden")}for(var c=1;c<=a.max_num_pages;c++){var l='<a href="page/'+c+'" class="page navi" data-id="'+c+'">'+c+"</a>";a.paged===c&&(l='<span class="current">'+c+"</span>"),o.find(".wp-pagenavi").append(l)}}console.log(e)},error:function(e){console.log("Error inesperado")}})}function t(e){o.find("form").trigger("reset"),e.txtKeyword="",e.optMonth=0,e.optYear=(new Date).getFullYear(),e.optPerPage=20,e.max_num_pages=0,e.paged=1,a(e)}var o=e("#insta-search"),n="",s="",r="",d={action:"insta_search",postType:"",postTax:"",postTerm:"",txtKeyword:"",optMonth:0,optYear:(new Date).getFullYear(),optPerPage:20,max_num_pages:0,response:[],bError:!1,vMensaje:"",paged:1};d.postType="1"===ajax_is.pt?"documentos":"post",d.postTax=ajax_is.term?ajax_is.term.taxonomy:"category",d.postTerm=ajax_is.term?ajax_is.term.slug:"agro-rural";var i="/transparencia/documentos/";a(d),e("#txtKeyword").keypress(function(t){13===t.which&&(d.txtKeyword=e(this).val(),d.paged=1,a(d))}),e("#optMonth").change(function(){d.txtKeyword=e("#txtKeyword").val(),d.optMonth=e("#optMonth").val(),d.paged=1,a(d)}),e("#optYear").change(function(){d.txtKeyword=e("#txtKeyword").val(),d.optYear=e("#optYear").val(),d.paged=1,a(d)}),e("#optPerPage").change(function(){d.txtKeyword=e("#txtKeyword").val(),d.optPerPage=e("#optPerPage").val(),d.paged=1,a(d)}),e("#btnDocumento").click(function(t){t.preventDefault(),d.txtKeyword=e("#txtKeyword").val(),d.paged=1,a(d)}),e("#btnLimpiar").click(function(e){e.preventDefault(),t(d)}),e(document).on("click",".navi",function(t){t.preventDefault();var o=e(this).data("id");d.paged=o,a(d)})}(jQuery);