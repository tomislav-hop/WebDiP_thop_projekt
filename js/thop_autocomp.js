$(document).ready(function() {
    $(function() {
        
        $.ajax({
            url: "http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/gradovi_auto.xml",
            type: "GET",
            dataType: "xml",
            success: function(gradovi) {
                
                $(gradovi).find("gradovi").each(function() {
                    $(this).find("grad").each(function() {
                        
                        
                        $red = "<option value=" + $(this).attr("naziv") + ">" + $(this).attr("naziv") + "</option>";
                        $("#gradovi").append($red);
                    });
                });
                
            }
        });
    });
});