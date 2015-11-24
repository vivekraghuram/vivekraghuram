$(document).ready(function(){
  $("#calculate-distance").on("click", function(e){
    var sLong = parseFloat($("#source-longitude").val());
    var sLongDir = $("input:radio[name=slong-direction]:checked").val();
    var dLong = parseFloat($("#destination-longitude").val());
    var dLongDir = $("input:radio[name=dlong-direction]:checked").val();
    var lat = parseFloat($("#latitude").val());
    var latDir = $("input:radio[name=lat-direction]:checked").val();

    if(!$.isNumeric(sLong) || !$.isNumeric(dLong) || !$.isNumeric(lat)) {
      $("#output-two").text("Inputs must be numbers");
      return;
    }
    if(sLong > 180 || dLong > 180) {
      $("#output-two").text("Longitude must be less than or equal to 180");
      return;
    }
    if(sLong < 0 || dLong < 0) {
      $("#output-two").text("Longitude must be greater than or equal to 0");
      return;
    }
    if(lat < 0) {
      $("#output-two").text("Latitude must be greater than or equal to 0");
      return;
    }
    if(lat > 90) {
      $("#output-two").text("Latitude must be less than or equal to 90");
      return;
    }

    //sLong = sLong / 180 * Math.pi;
    //dLong = dLong / 180 * Math.pi;
    lat = lat / 180 * Math.PI;
    var longDist = 110 * Math.cos(lat);
    console.log(longDist);
    var dist;

    if (sLongDir == dLongDir) {
      dist = longDist * Math.abs(sLong - dLong);
    } else if (sLong + dLong < 180) {
      dist = longDist * (sLong + dLong);
    } else if (sLong + dLong >= 180) {
      dist = longDist * ((180 - sLong) + (180 - dLong));
    } else {
      $("#output-two").text("Something went wrong!");
      return;
    }

    $("#output-two").text("The distance is " + Math.round(dist * 100) / 100 + " kilometers!");
  });
});
