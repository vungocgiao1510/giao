  $(document).ready(function(){
    $("#lang").change(function(){
      var lang = $("#lang").val();
      $.ajax({
        "type":"POST",
        // "url":baseUrl+"home/checklang",
        "data":"lang="+lang,
        "async":true,
        "success":function(result){
          window.location=baseUrl+lang;
        }
      })
    })
  })