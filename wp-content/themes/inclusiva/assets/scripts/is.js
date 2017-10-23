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
    objectToSend.postTerm = ajax_is.term ? ajax_is.term.slug : 'agro-rural';

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
        complete: function(response){
          $('#optMonth').prop('disabled', false);
          $('#optYear').prop('disabled', false);
          $('#optPerPage').prop('disabled', false);
          $("#btnDocumento").button('reset');
          $("#btnLimpiar").button('reset');
          
          // Preloading
          instaSearch.find('.preloaded').addClass('hidden');
          instaSearch.find('.hentry').removeClass('hidden');
        },
         success : function (response) {
            objectToSend = response;

            instaSearch.find(".search-result").empty();
            instaSearch.find(".wp-pagenavi").empty();

            var errorMessage = objectToSend.vMensaje;

            if (objectToSend.bError) {
            objectToSend.vMensaje = '';

                objectToSend.vMensaje = '<article class="hentry documentos hidden">';
                  objectToSend.vMensaje += '<div class="entry-container">';
                    objectToSend.vMensaje += '<div class="entry-body">';
                    
 
                        objectToSend.vMensaje += '<h2 class="entry-title">'; 
                          objectToSend.vMensaje += errorMessage;
                        objectToSend.vMensaje += '</h2>';
                        objectToSend.vMensaje += '<div class="entry-content">';
                          objectToSend.vMensaje += '<p>Intente con otros parámetros de búsqueda...</p>'; 
                        objectToSend.vMensaje += '</div>';


                    objectToSend.vMensaje += '</div>';
                  objectToSend.vMensaje += '</div>';
                objectToSend.vMensaje += '</article>';
                instaSearch.find(".wp-pagenavi").addClass('hidden');
                instaSearch.find(".search-result").append(objectToSend.vMensaje);
            }else{

              for (var i = 0; i < objectToSend.response.length; i++){

                objectToSend.response[i].html = '';
                objectToSend.response[i].html += '<article class="post-' + objectToSend.response[i].id + ' status-publish hentry tipos-rde documentos hidden">';
                  objectToSend.response[i].html += '<div class="entry-container">';
                    objectToSend.response[i].html += '<div class="entry-body ">';
                      customPostTitle = objectToSend.postTerm === 'directivas' || objectToSend.postTerm === 'pac' ? objectToSend.response[i].doc_ane__nom : customPostTitle = objectToSend.response[i].title;
                      customPostContent= objectToSend.postTerm === 'directivas' || objectToSend.postTerm === 'pac' ? objectToSend.response[i].doc_ane__desc: customPostContent = objectToSend.response[i].content;

                        objectToSend.response[i].html += '<h2 class="entry-title">';
                          objectToSend.response[i].html += '<a href="' + objectToSend.response[i].permalink  + '">';
                          objectToSend.response[i].html += objectToSend.txtKeyword.length >= 1 ? (customPostTitle.replace(new RegExp("("+ objectToSend.txtKeyword.replace(/(\s+)/,"(<[^>]+>)*$1(<[^>]+>)*") +")", "gi"), "<mark>$1</mark>")).replace(/(<mark>[^<>]*)((<[^>]+>)+)([^<>]*<\/mark>)/,"$1</mark>$2<mark>$4") : customPostTitle; 
                           objectToSend.response[i].html += '</a>';
                        objectToSend.response[i].html += '</h2>';
                        
                        objectToSend.response[i].html += '<div class="entry-content">';
                          objectToSend.response[i].html += objectToSend.txtKeyword.length >= 1 ? (customPostContent.replace(new RegExp("("+ objectToSend.txtKeyword.replace(/(\s+)/,"(<[^>]+>)*$1(<[^>]+>)*") +")", "gi"), "<mark>$1</mark>")).replace(/(<mark>[^<>]*)((<[^>]+>)+)([^<>]*<\/mark>)/,"$1</mark>$2<mark>$4") : customPostContent; 
                        objectToSend.response[i].html += '</div>';


                      objectToSend.response[i].html += '<div class="post-meta">';
                        objectToSend.response[i].html += '<div class="post-date">';
                          objectToSend.response[i].html += '<time class="updated">' + objectToSend.response[i].date + '</time>';
                        objectToSend.response[i].html += '</div>';
                        objectToSend.response[i].html += '<div class="post-comments">';

                          termPath = objectToSend.postTerm === 'directivas' ? 'rde' :
                                     objectToSend.postTerm === 'ado' ? 'rde' :
                                     objectToSend.postTerm === 'pac' ? 'rda' :
                                     objectToSend.postTerm === 'cds' ? 'rda' :
                                     objectToSend.postTerm;
                          

                          if ( objectToSend.response[i].doc_link === 'Publicado' ) {
                            objectToSend.response[i].html += '<a href="' + ajax_is.upload_dir.baseurl + docPath + termPath.toLowerCase() + '/' + objectToSend.response[i].slug.toUpperCase() + '.PDF" target="_blank"><i class="fa fa-file-pdf-o"></i> Descargar</a>';
                          }else{
                            objectToSend.response[i].html += 'No disponible';
                          }

                        objectToSend.response[i].html += '</div>';
                      objectToSend.response[i].html += '</div>';
                    objectToSend.response[i].html += '</div>';
                  objectToSend.response[i].html += '</div>';
                objectToSend.response[i].html += '</article>';
                

                instaSearch.find(".search-result").append(objectToSend.response[i].html);

                if (instaSearch.find(".wp-pagenavi").hasClass('hidden')){
                   instaSearch.find(".wp-pagenavi").removeClass('hidden');
                }
                
             }

             for (var j = 1; j <= objectToSend.max_num_pages; j++) {
              var html = '<a href="page/' + j + '" class="page navi" data-id="' + j + '">' + j + '</a>';
              
              if(objectToSend.paged === j){
                html = '<span class="current">' + j + '</span>';
              }
               
               instaSearch.find(".wp-pagenavi").append(html);
             }

            }

             //console.log(response);
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
        objectToSend.paged = 1; 

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