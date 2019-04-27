$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		$(this).attr("disabled", "disabled");
		var index = $("table tbody tr:last-child").index();
		var roomOptionObj = $("#room-id-options");
		var roomOptions = new Array();
		$("#room-id-options").find("option").each(function(){
			roomOptions.push($(this).val());
		});
        var row = '<tr>' +
            '<td><input type="text" class="form-control" name="firstname" id="first_name"></td>' +
            '<td><input type="text" class="form-control" name="middlename" id="middle_name"></td><td><select class="form-control new-value">' +
            '<option selected>'+ roomOptions[1] +'</option>';
            for(var i = 1;i<roomOptions.length;i++){
            	row = row + '<option>'+ roomOptions[i]+'</option>';
            }
        row = row + '</select></td>' +
			'<td>' + actions + '</td>' +
        '</tr>';
    	$("table").append(row);		
		$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
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
			
		if(!empty){	//update
			//alert('inside empty');
			$(this).parents("tr").find(".error").first().focus();
			$(this).parents("tr").find("td:nth-child(4)").find("select").each(function(){
				$(this).prop("disabled", true);
			});
			$(this).parents("tr").first().focus();
			input.each(function(){
				$(this).parent("td").html($(this).val());
			});	
			
		}
		else // add
		{
			alert('inside else');
			$(this).parents("tr").find(".error").first().focus();
			$(this).parents("tr").find("td:nth-child(3)").find("select").each(function(){
				$(this).prop("disabled", true);
			});
			$(this).parents("tr").first().focus();
			input.each(function(){
				$(this).parent("td").html($(this).val());
			});	
		}
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").prop("disabled", false);

	});
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){
		

		//all column except code		
        $(this).parents("tr").find("td:not(:last-child):not(:nth-child(4))").each(function(){
			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
		});		
		//code column
		$(this).parents("tr").find("td:nth-child(4)").find("select").each(function(){
			$(this).prop("disabled", false);
		});	
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
    });
	// Delete row on delete button click
	$(document).on("click", ".delete", function(){
		var $officeID = $(this).parents("tr").find('.officeID').text();   	//Get a child with class="RoomID old-value"
		var $thisobj = $(this);
		// alert($officeID);
		if(confirm('Do you really wish to delete this Office?')){
			// post deleteroom
			$.ajax({
				type: "POST",
				url: "php/deleteOffice.php",
				data: "officeID=" + $officeID,
				success: function(data) {
					data = data.trim();
					if(data){
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