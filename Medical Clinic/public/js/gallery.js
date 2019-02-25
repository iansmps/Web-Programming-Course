
 $(document).ready(function () {
     $(".imgShow").each(function(i) {
       $(this).delay(200*i).fadeIn(700);
      });  
    });
function redBorder(item) {
  item.style.border = "2px solid rgb(255, 0, 0)";
}

function cleanBorder(item) {
  item.style.border = "2px solid rgb(255, 255, 255)";
}
