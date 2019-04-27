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
		var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
			if(!$(this).val()){
				$(this).addClass("error");
				empty = true;
			} else{
                $(this).removeClass("error");
            }
		});
		$(this).parents("tr").find("td:nth-child(4)").find("select").each(function(){
			$(this).prop("disabled", true);
		});
		$(this).parents("tr").first().focus();
		input.each(function(){
			$(this).parent("td").html($(this).val());
		});			
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").removeAttr("disabled");	
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
        $(this).parents("tr").remove();
		$(".add-new").removeAttr("disabled");
    });
});