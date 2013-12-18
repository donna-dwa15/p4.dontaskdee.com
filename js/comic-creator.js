/*-------------------------------------------------------------------------------------------------
Setup Tabbed Tools Menu For Comic Strip Creation
-------------------------------------------------------------------------------------------------*/
$( "#tab-menu" ).tabs();

//set the default height of the content panels for tab menu
$( "#tab-menu" ).tabs( "option", "heightStyle", "250" );
//set the title tab to be the default active tab
$( "#tab-menu" ).tabs( "option", "active", 0 );

/*-------------------------------------------------------------------------------------------------
Initialize Event Handling for Various Tools
-------------------------------------------------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------
Title Tab menu events
-------------------------------------------------------------------------------------------------*/
//Detect changes and update comic strip Title
$('#title-text').keyup(function(){
	//replace certain characters so we have clean output - no funny script insertions
	var title_text = $(this).val().replace(/</g,"&#60;");
	$('#title').html(title_text);
});

//Detect changes and update comic strip author info
$('#author-text').keyup(function(){
	//replace certain characters so we have clean output - no funny script insertions
	var author_text = $(this).val().replace(/</g,"&#60;");
	$('#author').html(author_text);
});

/*-------------------------------------------------------------------------------------------------
Background Tab menu events
-------------------------------------------------------------------------------------------------*/
//Update comic strip panels based on which "panels" radio button is selected and which background was clicked
$('.backgrounds').click(function(){
	var chosen_background = $(this).css('background-image');
	var selected_panel = $('input:radio[name="panels"]:checked').val();
	$('#'+selected_panel).css('background-image', chosen_background);
});

/*-------------------------------------------------------------------------------------------------
Character Tab menu events
-------------------------------------------------------------------------------------------------*/
//Global counter of characters per panel
var character_count = new Array();
character_count['panel-1'] = 0;
character_count['panel-2'] = 0;
character_count['panel-3'] = 0;

//Global counter of text balloons per panel
var balloon_count = new Array();
balloon_count['panel-1'] = 0;
balloon_count['panel-2'] = 0;
balloon_count['panel-3'] = 0;

var max_characters = 2;
var max_balloons = 3;

//Add click event to selectable characters.  On click, the selected character will display in the preview area
$('.selectable-characters').click(function(){
	var chosen_character = $(this).attr("id");
	var preview_character = "";

	// Figure out which new character should be used
	if(chosen_character == "character-icon-1")
		preview_character = "character-1";
	else if(chosen_character == "character-icon-2")
		preview_character = "character-2";
	else if(chosen_character == "character-icon-3")
		preview_character = "character-3";
	else if(chosen_character == "character-icon-4")
		preview_character = "character-4";
	else if(chosen_character == "character-icon-5")
		preview_character = "character-5";
			
	$('#character-preview-area').show();
	$('#character-preview').removeClass().addClass('characters').addClass(preview_character);
	$('#character-header-3').show();
});

//make characters resizable
$('#character-preview').resizable(
		{ aspectRatio:true },
		{ containment:"parent"},
		{ minHeight:100 },
		{ maxHeight:200 },
		{ autoHide:true}
);

//make characters draggable
$( ".characters" ).draggable(
	{ revert:"invalid" },
	{ helper:"clone" },
	{ opacity:0.35 }
);

//Allow comic strip panels to accept characters and text balloons to be dragged over.
//Also copy the character/balloon that are also draggable within the panel
$(".comic-panels").droppable(
	{ accept: '.characters, .bubble-preview-span'}, 
	{drop: function(event,ui) { 
		var this_panel = $(this).attr('id');
		
		//Character max has already been reached for the panel, ignore new drop
		if(character_count[this_panel] == max_characters && ui.draggable.hasClass('characters'))
				return;
		//Text balloon max has already been reached for the panel, ignore new drop
		if(balloon_count[this_panel] == max_balloons && ui.draggable.hasClass('bubble-preview-span'))
				return;
				
		var new_clone = ui.draggable.clone();
		
		if(new_clone.hasClass('characters'))
		{
			new_clone.removeClass('characters').addClass('characters-clone').appendTo($(this));
			character_count[this_panel]++;
		}
		if(new_clone.hasClass('bubble-preview-span'))
		{	
			new_clone.removeClass('bubble-preview-span').addClass('bubble-clone').appendTo($(this));
			balloon_count[this_panel]++;
		}
		new_clone.draggable( { opacity:0.35 } );
		
		//Allow deletion/destroying of new draggable clone item on double-click
		//Decrement counter if deleted
		new_clone.dblclick(function() {
			new_clone.remove();
			if(new_clone.hasClass('characters-clone'))
				character_count[this_panel]--;
			else
				balloon_count[this_panel]--;
		});	
	}
});

//Flip character horizontally
$('#flip-character').click(function(){
	//Check if flip is already in effect, remove if it is
	if($('#character-preview').hasClass('flip')){
		$('#character-preview').removeClass('flip');
	}
	else {
		$('#character-preview').addClass('flip');
	}
});

/*-------------------------------------------------------------------------------------------------
Text Tab menu events
Note: panel droppable code is above in the "Character Tab menu events" section
-------------------------------------------------------------------------------------------------*/
//Make thought/speech/caption balloons draggable
$( ".bubble-preview-span" ).draggable(
	{ revert:"invalid" },
	{ helper: "clone" },
	{ opacity: 0.35}
);

//Add click event to selectable text balloons.  On click, the selected balloon will display in the preview area
$('.balloons').click(function(){
	var chosen_balloon = $(this).attr("id");
	var preview_balloon = "";

	// Balloon type is the same as current, so do nothing
	if(chosen_balloon == "thought_icon" && $('#bubble-preview').hasClass('thought-bubble'))
		return;
	if(chosen_balloon == "speech-icon" && $('#bubble-preview').hasClass('bubble'))
		return;
	if(chosen_balloon == "caption-icon" && $('#bubble-preview').hasClass('caption-box'))
		return;

	// Figure out which new balloon style should be used
	if(chosen_balloon == "thought-icon")
		preview_balloon = "thought-bubble";
	else if(chosen_balloon == "speech-icon")
		preview_balloon = "bubble";
	else if(chosen_balloon == "caption-icon")
		preview_balloon = "caption-box";

	// Reset any current text in the preview box - both textarea and balloon
	$('#caption').val("");
	$('#bubble-text').html("");

	$('#preview-area').show();
	$('#bubble-text').removeClass();
	
	if(preview_balloon == "caption-box")
		$('#bubble-text').addClass('caption-box-text');
	
	$('#bubble-preview').removeClass().addClass(preview_balloon);
	$('#balloon-header-3').show();
});

//Flip Text Balloon horizontally
$('#flip-bubble').click(function(){
	//Check if flip is already in effect, remove if it is
	if($('#bubble-preview').hasClass('flip')){
		$('#bubble-preview').removeClass('flip');
		$('#bubble-text').removeClass('flip');
	}
	else {
		$('#bubble-preview').addClass('flip');
		$('#bubble-text').addClass('flip');
	}
});

//Update text in chosen text ballon in preview area
$('#caption').keyup(function(){
	//replace certain characters so we have clean output - no funny script insertions
	var balloon_text = $(this).val().replace(/</g,"&#60;");

	$('#bubble-text').html(balloon_text);
});

/*-------------------------------------------------------------------------------------------------
Print Tab menu event
-------------------------------------------------------------------------------------------------*/

//Print button functionality
$('#print-btn').click(function() {
	// Make a copy of the current comic strip to prepare for the new printable browser tab
	var canvas_clone = $('#comic-strip').clone();        
	var canvas = canvas_clone.prop('outerHTML');

	// For the new tab, reconstruct all the pieces we need for any HTML page starting with a start <html> tag.
	var new_tab_contents  = '<html>';

	// Append the rest of the contents including current stylings and font
	new_tab_contents += '<head>';
	new_tab_contents += '<title>The Cat\'s Meow Comic Creator</title>';
	new_tab_contents += '<link rel="stylesheet" href="/css/comic-main.css" type="text/css">';
	new_tab_contents += '<link href="http://fonts.googleapis.com/css?family=Walter+Turncoat" rel="stylesheet" type="text/css">';
	new_tab_contents += '</head>';
	new_tab_contents += '<body>'; 
	new_tab_contents += canvas;
	new_tab_contents += '</body></html>';

	// Open the new tab
	var new_tab =  window.open();
	new_tab.document.open();
	new_tab.document.write(new_tab_contents);  
	// Close the tab
	new_tab.document.close();		
});

//Save button functionality
$('#save').click(function() {
	var canvas_clone = $('#comic-strip').clone();
	var canvas = canvas_clone.prop('outerHTML');
	var status = $('#status:checked').val();
	
	if(!status)
		status = "private";
		
	$.ajax({
        type: 'POST',
        url: 'p_create',
		beforeSend: function() {
			// Display a loading message while waiting for the ajax call to complete
			$('#processing').html("Saving...");
		},
        success: function(response) { 
            // Enject the results received from process.php into the results div
            $('#processing').html(response);
        },
        data: {
            comic_html: canvas,
			status: status,
        },
    }); // end ajax setup
});
