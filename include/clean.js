// Wrangling all JS logic in here
// Obviously heavy dependence on jQuery here

// on DOMready
// Apply events and 'app' behavior top-down,
// filling as we go

// TODO: Make this fit with paging
// TODO: Get rid of the specific IDs, loop the form? Maybe new branch
$(function() {

	// Turn on calendar selector and behavior when a date is selected
	$("#date").datepicker();
	$("#date").change(function(){ 

            var qDate = $("#date").val(); // TODO: Sanitize
            // Fill following fields
            fillField('#truck',qDate);

        }
    );

    // Magic 'Add New' option in technician select
    $("#techs").change(function(){
        if ( !document.getElementById('newTech') ) {
            $("#techs").append('<option id="newTech">Add new tech</option>');
        }
    });
    $("#newTech").focus(function(){
        $("#newTechBox").show().focus();
    });
    $("#newTechBox").blur(function(){
        var newTech = $("#newTechBox").val();
        $("#newTech").remove();
        $("#techs").append('<option name="'+newTech+'">'+newTech+'</option>');
        $("#newTechBox").hide();
    });


    // Update techs when truck changes
    $("#truck").change(function(){
        fillField('#techs',$("#truck").val());
    });

});


// Propogate changes forward
function fillField( element, query ) {

    // push data into fields
    $(element).load('include/header.php?d='+query);

}
