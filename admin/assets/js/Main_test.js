$(document).ready(function () {
    var objResolutions = GetResolution();    
    console.log(objResolutions.textWidth + " -> " + objResolutions.widthMain + 'x' + objResolutions.heightMain);
    //use - > <div id="msgToCONF"></div>
    $("#msgToCONF").html(objResolutions.textWidth + " -> " + objResolutions.widthMain + 'x' + objResolutions.heightMain);
});
