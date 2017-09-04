(function($) {
    var instaSearch = $('#insta-search');

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
          $('#loader').show();
          //$('#txtKeyword').prop('disabled', true);
          $('#optMonth').prop('disabled', true);
          $('#optYear').prop('disabled', true);
          $('#optPerPage').prop('disabled', true);
          $("#btnDocumento").button('loading');
        },
        complete: function(){
          $('#loader').hide();
          //$('#txtKeyword').prop('disabled', false);
          $('#optMonth').prop('disabled', false);
          $('#optYear').prop('disabled', false);
          $('#optPerPage').prop('disabled', false);
          $("#btnDocumento").button('reset');
        },
         success : function (response) {
            objectToSend = response;
            instaSearch.find(".search-result").empty();
            instaSearch.find(".wp-pagenavi").empty();
            if (objectToSend.bError) {
              var html3 = '';
                html3 = '<article>';
                  html3 += '<div class="entry-container">';
                    html3 += '<div class="entry-body ">';
                      html3 += '<h2 class="entry-title">'; 
                        html3 += objectToSend.vMensaje;
                      html3 += '</h2>';
                      html3 += '<p>Intente con otros parámetros de búsqueda...</p>'; 
                    html3 += '</div>';
                  html3 += '</div>';
                html3 += '</article>';
              instaSearch.find(".search-result").append(html3);
            }else{
              for (var i = 0; i < objectToSend.response.length; i++){
                var html = ''; 

                html += '<article class="post-' + objectToSend.response[i].id + ' status-publish hentry tipos-rde documentos">';
                  html += '<div class="entry-container">';
                    html += '<div class="entry-body ">'; 
                      html += '<h2 class="entry-title">';
                        html += '<a href="' + objectToSend.response[i].permalink  + '">' + objectToSend.response[i].title + '</a>';
                      html += '</h2>';
                      
                      //html += '<p>' + objectToSend.response[i].content + '</p>';
                      html += '<div class="post-meta">';
                        html += '<div class="post-date">';
                          html += '<time class="updated">' + objectToSend.response[i].date + '</time>';
                        html += '</div>';
                        html += '<div class="post-comments">';
                          html += '<a href="' + ajax_is.upload_dir.baseurl + docPath + objectToSend.postTerm.toLowerCase() + '/' + objectToSend.response[i].slug.toUpperCase() + '.PDF" target="_blank"><i class="fa fa-file-pdf-o"></i> Descargar</a>';
                        html += '</div>';
                      html += '</div>';
                    html += '</div>';
                  html += '</div>';
                html += '</article>';
                
                instaSearch.find(".search-result").append(html);
             }

             for (var j = 1; j <= objectToSend.max_num_pages; j++) {
              var html2 = '<a href="#' + j + '" class="page navi" data-id="' + j + '">' + j + '</a>';
              
              if(objectToSend.paged === j){
                html2 = '<span class="current">' + j + '</span>';
              }
               
               instaSearch.find(".wp-pagenavi").append(html2);
             }
             //console.log(objectToSend.found_posts);

            }

             console.log(response);
         }, 
         error: function(error){
          console.log('Error inesperado');
         }
      });
    }

    listarDocumentos(objectToSend);

    $("#txtKeyword").keyup(function () {
        objectToSend.txtKeyword=$("#txtKeyword").val();
        listarDocumentos(objectToSend);
    });

    $("#optMonth").change(function () {
        objectToSend.optMonth=$("#optMonth").val();
        listarDocumentos(objectToSend);
    });

    $("#optYear").change(function () {
        objectToSend.optYear=$("#optYear").val();
        listarDocumentos(objectToSend);
    });

    $("#optPerPage").change(function () {
        objectToSend.optPerPage=$("#optPerPage").val();
        listarDocumentos(objectToSend);
    });

    $("#btnDocumento").click(function (e) {
        e.preventDefault();
        listarDocumentos(objectToSend);
    });

  $(document).on('click', '.navi', function () {
    var page = $(this).data("id");
    objectToSend.paged = page;
    listarDocumentos(objectToSend);
  });
})(jQuery); // Fully reference jQuery after this point.