$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();

	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		$(this).attr("disabled", "disabled");
		// var index = $("table tbody tr:last-child").index();
        var row = '<tr>' +
            '<td class = "editableColumns roomID"> <div class="old-value"></div> <input type="text" class="form-control new-value" maxlength="10" ></td>' +
            '<td class = "editableColumns roomType"> <div class="old-value"></div> <select class="form-control new-value">' +
                                    '<option selected>office</option>' +
                                    '<option>office</option>' +
                                    '<option>class</option>' +                                    
                                '</select></td>' +
			'<td>' + actions + '</td>' +
        '</tr>';
    	$("table tbody tr:first").before(row);		
		// $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
		$("table tbody tr").eq(0).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
    });

	// Add row on add button click
	$(document).on("click", ".add", function(){
		var empty = false;
		var input = $(this).parents("tr").find('input');
        input.each(function(){
			if(!$(this).val()){
				$(this).addClass("error");
				empty = true;
			} else{
                $(this).removeClass("error");
            }
		});
		$(this).parents("tr").find(".error").first().focus();
		if(!empty){

			// get Inputs
			var $oldRoomID = $(this).parents("tr")       		//Find parent row <tr>
			.find('.roomID').find('.old-value').text();   	//Get a child with class="RoomID old-value"
			var $newRoomID = $(this).parents("tr")       		//Find parent row <tr>
			.find('.roomID').find('.new-value').val();   		//Get a child with class="RoomID new-value"
			var $roomType = $(this).parents("tr")          	//Find parent row <tr>
			.find('.roomType').find('.new-value').val();  	//Get a child with class="roomType new-value"
			alert($roomType);
			var $thisobj = $(this);
			
			// update of oldRoomID
			if($oldRoomID){
				//Post updateRoom
				$.ajax({
					type:"POST",
					url: "updateRoom.php",
					data: "&oldRoomID=" + $oldRoomID + "&newRoomID=" + $newRoomID
					+ "&roomType=" + $roomType ,
					success: function(data){
						data = data.trim();
						if(data == 'success' || data == 'updated'){
							alert($roomType);
							changeRow($thisobj, true);
						}else if(data == 'exist'){
							alert("Room already exists");
							changeRow($thisobj, false);
						}
					}
				}); // POST updateRoom end
			}
			// add of oldRoomID
			else{
				var $roomID = $(this).parents("tr")       		//Find parent row <tr>
				.find('.roomID').find('.new-value').val();   		//Get a child with class="RoomID new-value"
				var $roomType = $(this).parents("tr")       		//Find parent row <tr>
				.find('.roomType').find('.new-value').val();   		//Get a child with class="RoomID new-value"

				//Post addRoom
				$.ajax({
					type:"POST",
					url: "addRoom.php",
					data: "&roomID=" + $roomID
					+ "&roomType=" + $roomType ,
					success: function(data){
						data = data.trim();
						if(data == 'success' || data == 'updated'){
							alert("Successfully Inserted");
							changeRow($thisobj, true);
							console.log('sucess.');
						}else if(data == 'exist'){
							alert("Room already exists");

							// remove row
							$thisobj.parents("tr").remove();
							$(".add-new").removeAttr("disabled");
						}
					}
				}); // POST addRoom end
				
			}	

			$(this).parents("tr").find(".add, .edit").toggle();
			$(".add-new").removeAttr("disabled");
		}		
    });
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){		
        $(this).parents("tr").find("td").each(function(){
			var $oldvalue = $(this).find('.old-value');
			var $newvalue = $(this).find('.new-value');
			$oldvalue.addClass("hidden");
			$newvalue.val($oldvalue.text());
			$newvalue.removeClass("hidden");
		});			
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
    });
	// Delete row on delete button click
	$(document).on("click", ".delete", function(){
        var $roomID = $(this).parents("tr")       		//Find parent row <tr>
			.find('.roomID').find('.old-value').text();   	//Get a child with class="RoomID old-value"
		var $thisobj = $(this);

		if(confirm('Do you really wish to delete Room?')){

			// post deleteroom
			$.ajax({
				type: "POST",
				url: "deleteRoom.php",
				data: "roomID=" + $roomID,
				success: function(data) {
					data = data.trim();
					if(data){
						// alert for errors
						alert(data);
					}
					else{
						$thisobj.parents("tr").remove();
						$(".add-new").removeAttr("disabled");
					}
				}
			}); 
		} 
    });
});

function changeRow( object ,istrue){
	// hide editables as is
	object.parents('tr').find('td').each(function() {
		var $oldvalue = $(this).find('.old-value');
		var $newvalue = $(this).find('.new-value');
		$oldvalue.removeClass("hidden");
		if(istrue){
			$oldvalue.text($newvalue.val());
		}
		$newvalue.addClass("hidden");
	});
}