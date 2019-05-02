$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();
	var officename;
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		$(this).attr("disabled", "disabled");
		var index = $("table tbody tr:last-child").index();
        var row = '<tr>' +
            '<td><input type="text" class="form-control" name="subjectid" id="subject_id"></td>' +
            '<td><input type="text" class="form-control" name="subjecttitle" id="subject_title"></td>' +
			'<td>' + actions + '</td>' +
        '</tr>';
    	$("table").append(row);		
		$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
	});
	
	$(".edit").click(function(){
		
		$(this).prop("disabled", true);
		$(".cancel").prop("disabled", false);
		$(".reset").prop("disabled", false);
		$(".update").prop("disabled", false);
		$(".office").prop("disabled", false);
		$(".add-prof").prop("disabled", true);
	});
	$(".cancel").click(function(){
		
		$(".edit").prop("disabled", false);
		$(this).prop("disabled", true);
		$(".reset").prop("disabled", true);
		$(".update").prop("disabled", true);
		$(".office").prop("disabled", true);
		// $(".add-prof").prop("disabled", false);

	});
	$(".update").click(function(){
		
		$(".edit").prop("disabled", true);
		$(".cancel").prop("disabled", false);
		$(".reset").prop("disabled", false);
		$(this).prop("disabled", false);
		$(".office").prop("disabled", false);
		$(".add-prof").prop("disabled", false);
    });
	// Add row on add button click
	$(document).on("click", ".add", function(){
		var empty = false;
		var input = $(this).parents("tr").find('select');
		// var input = $(this).parents("tr").find('select:options[indexselect].value');
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
			input.each(function(){
				$(this).parent("td").html($(this).val());
				officename = $(this).val();
			});	
			document.location.href="/pupwebdev/auth/admin/php/AddEditTransaction.php?officename=" + officename+ "&username=" + text1;					
			$(this).parents("tr").find(".add, .edit").toggle();
			$(".add-new").removeAttr("disabled");
		}		
    });
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){		
        $(this).parents("tr").find("td:nth-child(4)").each(function(){
			// $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
			$(this).html('<select id="room-type-options" class="col form-control" name="office"><option value="' + $(this).text() + '">'+ $(this).text() +'</option><option value="lolol">lolol</option></select>');
		});		
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
    });
	// Delete row on delete button click
	// $(document).on("click", ".delete", function(){
    //     $(this).parents("tr").remove();
	// 	$(".add-new").removeAttr("disabled");
    // });
});