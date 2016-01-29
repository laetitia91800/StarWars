$(document).ready(function() {

         $('#popup_name').hide();

          $("#btnPopUp").click(function(){
            $("#popup_name").show(1000);
            $("#popup_name").css({cursor: "pointer"});

        });


        $('#popup_name').on('click',function(){

            $("#popup_name").hide(1000);

        });




});