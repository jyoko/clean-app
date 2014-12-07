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

            var qDate = $("#date").val(); // TODO: check this input

            $.get("header.php?d="+qDate, function( data ) {
                alert(data);
            });

            //var queryData = ''; // Empty if no saved values

            // Fill following fields, loads defaults if no data
            fillFields(queryData);

        }
    );

});


// Propogate changes forward
function fillFields( queryData ) {

    if ( !queryData ) {
        // Assume new sheet, no action for now
        // TODO: Load default
    } else {
        // push data into fields
    }

}
