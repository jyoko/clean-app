// appIzer
// version: alpha
// jQuery(UI) Plugin

;(function( $,window,document,undefined ) {
    
}(jQuery,window,document));

// on DOMready, initialize everything
// TODO: Make this fit with paging, add device-specific features
$(function() {

    // Testing plugin
    $('#truck').appIzer();

    // Loop over FORMs
    //   element.makePretty()
    //   element.eventListeners()
    //   --leave hooks for customization

	// Turn on calendar selector and behavior when a date is selected
	$("#date").datepicker();
	$("#date").change(function(){ 

            var qDate = $("#date").val(); // TODO: Sanitize
            // Fill following fields
            fillField('#truck',qDate);

        }
    );

    // Magic 'Add New' option for SELECTs
    makePrettySelect('techs', 'Add new technician');

    // Update techs when truck changes
    $("#truck").change(function(){
        fillField('#techs',$("#truck").val());
    });

});

// Creates pretty, editable multiselects
// Takes the SELECT field ID and optional replacement for the add new text
// TODO: make every value editable
function makePrettySelect(selectID,msg) {

    msg = msg || 'Add new value';
    var counter = 0;
    var divID = 'div'+selectID;
    var spanID = 'span'+selectID;

    // Prepend with newDIV
    $('#'+selectID).before('<div class="multiSelect" id="'+divID+'"></div>');
    // Loop OPTIONs, load into newDIV->SPANs
    $('#'+selectID+'  option').each(function() {
        var uspanID = spanID+counter;
        $('#'+divID).append('<span class="multiSval" id="'+uspanID+'">'+$(this).val()+'</span>');
        counter++;
    });
    $('#'+selectID).hide();

    addNewSelect(divID,selectID,msg,counter);

}

// Creates a clickable 'Add New' option to multiselect DIV
// subroutine of makePrettySelect, don't use directly
// Needs DIV and SELECT ids, msg to show for add text, counter for recursive use
function addNewSelect(divID,selectID,msg,counter) {

    counter = counter || 0;
    var newSpan = 'span'+divID+counter;
    var newText = 'text'+selectID+counter;

    // Add new option to DIV with handlers
    $('#'+divID).append('<span class="multiAdd" id="'+newSpan+'">'+msg+'</span>');
    $('#'+divID).append('<input type="text" class="magicBox" name="'+newText+'" id="'+newText+'">');
    $('#'+newText).hide();
    $('#'+newSpan).click(function() {
        $(this).off('click');
        $(this).hide();
        $('#'+newText).show().focus();
    });
    $('#'+newText).blur(function() {
        var newValue = $('#'+newText).val();
        $('#'+newSpan).html(newValue);
        $('#'+selectID).append('<option selected value="'+newValue+'">'+newValue+'</option>');
        $('#'+newText).hide();
        $('#'+newSpan).show();
        addNewSelect(divID,selectID,msg,++counter);
    });

}

// Propogate changes forward
function fillField( element, query ) {

    // push data into fields
    $(element).load('./backend/header.php?d='+query);

}
