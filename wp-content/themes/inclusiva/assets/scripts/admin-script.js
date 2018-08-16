document.addEventListener('DOMContentLoaded', function() {
  var unregisteredBanner = document.querySelector('img[src="https://gravityforms.s3.amazonaws.com/banners/gravity-forms-unregistered.svg"]');
  if(unregisteredBanner){
    unregisteredBanner.parentNode.parentNode.remove();
  }

  //console.log(unregisteredBanner);
  
  var formId = document.getElementsByClassName("gf_admin_page_formid")[0];
  //console.log(formId[0] == null);
  if(formId != null){
    //var formContent = formId.textContent;

    //if(formContent === "ID: 12") {
      var mayorActions = document.querySelector('.formularios_page_gf_entries #major-publishing-actions');

      if(mayorActions){
        mayorActions.remove();
      }
    //}

    //console.log(formContent);
  }
});

// console.log("Pero aqui estoy");

// jQuery(function() {
//   console.log( "ready!" );
// });