(function($) {
    var instaSearch = $('#insta-search');

    var objectToSend={
        action : 'insta_search',
        txtKeyword : "",
        optMonth : 0,
        optYear : 2017,
        optPerPage : 10,
        optPage :1, 
        offset : 11
    };


//Metodos
   function listarDocumentos(objectToSend) {
       $.ajax({
           url: ajax_url,
           data: objectToSend,
           success : function (response) {
               instaSearch.find("ul").empty();

               for (var i = 0; i < response.length; i++){
                   var html = '<li><a href="' + response[i].permalink  + '">' + response[i].title + '</a></li>';
                   var html2 = '<a href="' + response[i].id  + '">' + response[i].id + '</a>';

                   instaSearch.find("ul").append(html);
                   instaSearch.find(".wp-pagenavi").append(html2);
               }
               console.log(response);
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

    $("#optPage").change(function () {
        objectToSend.optPage=$("#optPage").val();
        objectToSend.offset=( $("#optPage").val() * $("#optPerPage").val() ) + 1;
        listarDocumentos(objectToSend);
    });

    $("#btnDocumento").click(function (e) {
        e.preventDefault();
        listarDocumentos(objectToSend);
    });

    $(".wp-pagenavi a.page").click(function (e) {
        e.preventDefault();
        listarDocumentos(objectToSend);
    });

})(jQuery); // Fully reference jQuery after this point.