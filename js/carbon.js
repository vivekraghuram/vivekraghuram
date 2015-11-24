$(document).ready(function(){
  $("#calculate-carbon").on("click", function(e){
    var ph = parseFloat($("#ph").val());
    var pco2 = parseFloat($("#pco2").val());

    if(!$.isNumeric(ph) || !$.isNumeric(pco2)) {
      $("#output-three").text("Inputs must be numbers");
      return;
    }

    if(pco2 < 0) {
      $("#output-three").text("pCO2 needs to be positive");
      return;
    }
    if(ph < 0 || ph > 14) {
      $("#output-three").text("pH needs to be between 0 and 14");
      return;
    }

    var carbonicAcid;
    var bicarbonate;
    var carbonate;
    var dic;

    var kh = Math.pow(10, -1.5);
    var k1 = Math.pow(10, -5.9);
    var k2 = Math.pow(10, -9.0);
    var hIons = Math.pow(10, -1 * ph);

    carbonicAcid = kh * pco2;
    bicarbonate = k1 / hIons * carbonicAcid;
    carbonate = k2 / hIons * bicarbonate;
    dic = carbonicAcid + bicarbonate + carbonate;

    var result = "H<sub>2</sub>CO<sub>3</sub>: " + Math.round(carbonicAcid * 100) / 100 + "M, ";
    result += "HCO<sub>3</sub><sup>-</sup>: " + Math.round(bicarbonate * 100) / 100 + "M, ";
    result += "CO<sub>3</sub><sup>2-</sup>: " + Math.round(carbonate * 100) / 100 + "M<br>";
    result += "DIC: " + Math.round(dic * 100) / 100 + "M";

    $("#output-three").html(result);
  });
});
