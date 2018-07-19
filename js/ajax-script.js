$(document).ready(function(){
  $("a").click(function(){

    var car_model_id = this.id;
    var count = $("#count"+car_model_id).html();

    var request = $.ajax({
      url: "script.php",
      type: "POST",
      data: {car_model_id : car_model_id},
      dataType: "html"
    });

    request.done(function(msg) {

      // decrement count value
      if(count  > 1 ){
        $("#count"+car_model_id).text(--count);
      }
      // remove a row if count < 1
      else
        $("#tr"+car_model_id).remove();
    });


    request.fail(function(jqXHR, textStatus) {
      alert( "Request failed: " + textStatus );
    });
  });
});


