(function($) {
    var instaSearch = $('#insta-search');
    var termPath = '';
    var customPostTitle = '';
    var customPostContent = '';
    var isPublished = '';

    var objectToSend={
        action : 'insta_search',
        postType  : '',
        postTax : '',
        postTerm  : '',
        txtKeyword : "",
        optMonth : 0,
        optYear : (new Date()).getFullYear(),
        optPerPage : 20,
        max_num_pages: 0,
        response : [],
        bError : false,
        vMensaje: '',
        paged: 1
    };

    objectToSend.postType = ajax_is.pt === '1' ? 'documentos' : 'post';
    objectToSend.postTax = ajax_is.term ? ajax_is.term.taxonomy : 'category';
    objectToSend.postTerm = ajax_is.term ? ajax_is.term.name : 'AGRO RURAL';

    var docPath = '/transparencia/documentos/';

    function listarDocumentos(objectToSend) {
      $.ajax({
        url: ajax_is.ajax_url,
        data: objectToSend,
        beforeSend: function() {
          $('#optMonth').prop('disabled', true);
          $('#optYear').prop('disabled', true);
          $('#optPerPage').prop('disabled', true);
          $("#btnDocumento").button('loading');
          $("#btnLimpiar").button('loading');

          // Preloading
          instaSearch.find('.preloaded').removeClass('hidden');
          instaSearch.find('.hentry').addClass('hidden');
        },
        complete: function(){
          $('#optMonth').prop('disabled', false);
          $('#optYear').prop('disabled', false);
          $('#optPerPage').prop('disabled', false);
          $("#btnDocumento").button('reset');
          $("#btnLimpiar").button('reset');
          //debugger;

          //Highlight
          var hentryHTML = $('.hentry').html();
          var termino = objectToSend.txtKeyword;
          
          termino = termino.replace(/(\s+)/,"(<[^>]+>)*$1(<[^>]+>)*");

          var pattern = new RegExp("("+termino+")", "gi");

          hentryHTML = hentryHTML.replace(pattern, "<mark>$1</mark>");
          hentryHTML = hentryHTML.replace(/(<mark>[^<>]*)((<[^>]+>)+)([^<>]*<\/mark>)/,"$1</mark>$2<mark>$4");
          
          if (termino.length > 3) {
            $('.hentry').html(hentryHTML);
          }
          
          // Preloading
          instaSearch.find('.preloaded').addClass('hidden');
          instaSearch.find('.hentry').removeClass('hidden');
        },
         success : function (response) {
            objectToSend = response;

            instaSearch.find(".search-result").empty();
            instaSearch.find(".wp-pagenavi").empty();

            if (objectToSend.bError) {
              var html3 = '';
                html3 = '<article class="hentry hidden">';
                  html3 += '<div class="entry-container">';
                    html3 += '<div class="entry-body">';
                      html3 += '<h2 class="entry-title">'; 
                        html3 += objectToSend.vMensaje;
                      html3 += '</h2>';
                      html3 += '<p>Intente con otros parámetros de búsqueda...</p>'; 
                    html3 += '</div>';
                  html3 += '</div>';
                html3 += '</article>';
                instaSearch.find(".wp-pagenavi").addClass('hidden');
                instaSearch.find(".search-result").append(html3);
            }else{

              for (var i = 0; i < objectToSend.response.length; i++){
                var html = ''; 

                html += '<article class="post-' + objectToSend.response[i].id + ' status-publish hentry tipos-rde documentos hidden">';
                  html += '<div class="entry-container">';
                    html += '<div class="entry-body ">';
                      customPostTitle = objectToSend.postTerm === 'Directivas' || objectToSend.postTerm === 'PAC' ? objectToSend.response[i].doc_ane__nom : customPostTitle = objectToSend.response[i].title;
                      customPostContent= objectToSend.postTerm === 'Directivas' || objectToSend.postTerm === 'PAC' ? objectToSend.response[i].doc_ane__desc: customPostContent = objectToSend.response[i].content;

                      html += '<h2 class="entry-title">';
                        html += '<a href="' + objectToSend.response[i].permalink  + '">' + customPostTitle + '</a>';
                      html += '</h2>';
                      
                      html += '<div class="entry-content">' + customPostContent + '</div>';
                      html += '<div class="post-meta">';
                        html += '<div class="post-date">';
                          html += '<time class="updated">' + objectToSend.response[i].date + '</time>';
                        html += '</div>';
                        html += '<div class="post-comments">';

                          termPath = objectToSend.postTerm === 'Directivas' ? 'RDE' :
                                     objectToSend.postTerm === 'PAC' ? 'RDA' :
                                     objectToSend.postTerm;

                          //objectToSend.response[i].doc_link = 'No disponible';

                          if ( objectToSend.response[i].doc_link === 'Publicado' ) {
                            html += '<a href="' + ajax_is.upload_dir.baseurl + docPath + termPath.toLowerCase() + '/' + objectToSend.response[i].slug.toUpperCase() + '.PDF" target="_blank"><i class="fa fa-file-pdf-o"></i> Descargar</a>';
                          }else{
                            html += 'No disponible';
                          }

                        html += '</div>';
                      html += '</div>';
                    html += '</div>';
                  html += '</div>';
                html += '</article>';
                

                instaSearch.find(".search-result").append(html);

                if (instaSearch.find(".wp-pagenavi").hasClass('hidden')){
                   instaSearch.find(".wp-pagenavi").removeClass('hidden');
                }
                
             }

             for (var j = 1; j <= objectToSend.max_num_pages; j++) {
              var html2 = '<a href="page/' + j + '" class="page navi" data-id="' + j + '">' + j + '</a>';
              
              if(objectToSend.paged === j){
                html2 = '<span class="current">' + j + '</span>';
              }
               
               instaSearch.find(".wp-pagenavi").append(html2);
             }

            }

             console.log(response);
         }, 
         error: function(error){
          console.log('Error inesperado');
         }
      });
    }

    function limpiarDocumentos(objectToSend){
        instaSearch.find('form').trigger("reset");
        objectToSend.txtKeyword  = "";
        objectToSend.optMonth  = 0;
        objectToSend.optYear  = (new Date()).getFullYear();
        objectToSend.optPerPage  = 20;
        objectToSend.max_num_pages = 0;
        objectToSend.paged = 1;

        listarDocumentos(objectToSend);
    }

    listarDocumentos(objectToSend);

    $("#txtKeyword").keypress(function (e) {
      if(e.which === 13) {
        objectToSend.txtKeyword = $(this).val();
        objectToSend.paged = 1;

        listarDocumentos(objectToSend);
      }
    });

    $("#optMonth").change(function () {
        objectToSend.txtKeyword = $("#txtKeyword").val();
        objectToSend.optMonth = $("#optMonth").val();
        objectToSend.paged = 1;

        listarDocumentos(objectToSend);
    });

    $("#optYear").change(function () {
        objectToSend.txtKeyword = $("#txtKeyword").val();
        objectToSend.optYear=$("#optYear").val();
        objectToSend.paged = 1;

        listarDocumentos(objectToSend);
    });

    $("#optPerPage").change(function () {
        objectToSend.txtKeyword = $("#txtKeyword").val();
        objectToSend.optPerPage = $("#optPerPage").val(); 

        listarDocumentos(objectToSend);
    });

    $("#btnDocumento").click(function (e) {
        e.preventDefault();

        objectToSend.txtKeyword = $("#txtKeyword").val();
        objectToSend.paged = 1;

        listarDocumentos(objectToSend);
    });

    $("#btnLimpiar").click(function (e) {
        e.preventDefault();
        limpiarDocumentos(objectToSend);
    });

  $(document).on('click', '.navi', function (e) {
    e.preventDefault();

    var page = $(this).data("id");
    objectToSend.paged = page;
    listarDocumentos(objectToSend);
  });
})(jQuery); // Fully reference jQuery after this point.