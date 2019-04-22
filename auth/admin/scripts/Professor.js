$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();

	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		$(this).attr("disabled", "disabled");
		// var index = $("table tbody tr:last-child").index();
        var row = '<tr>' +
        	'<td class = "hidden professorID"><input type="hidden" class = "old-value"/></td>' +
            '<td class = "editableColumns firstName"> <div class="old-value"></div> <input type="text" class="form-control new-value"></td>' +
            '<td class = "editableColumns middleName"> <div class="old-value"></div> <input type="text" class="form-control new-value"></td>' +
			'<td class = "editableColumns lastName"> <div class="old-value"></div> <input type="text" class="form-control new-value"></td>' +
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
		var input = $(this).parents("tr").find('input[type="text"]');
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
			var $professorID = $(this).parents("tr")       		//Find parent row <tr>
			.find('.professorID').find('.old-value').val();   	//Get a child with class="ProfessorID old-value"
			var $firstName = $(this).parents("tr")       		//Find parent row <tr>
			.find('.firstName').find('.new-value').val();   		//Get a child with class="ProfessorID new-value"
			var $middleName = $(this).parents("tr")       		//Find parent row <tr>
			.find('.middleName').find('.new-value').val();   		//Get a child with class="ProfessorID new-value"
			var $lastName = $(this).parents("tr")       		//Find parent row <tr>
			.find('.lastName').find('.new-value').val();   		//Get a child with class="ProfessorID new-value"
			var $thisobj = $(this);
			// update of oldProfessorID
			if($professorID){
				//Post updateProfessor
				$.ajax({
					type:"POST",
					url: "updateProfessor.php",
					data: "&professorID=" + $professorID + "&firstName=" + $firstName
					+ "&middleName=" + $middleName
					+  "&lastName=" + $lastName,
					success: function(data){
						data = data.trim();
						if(data == 'success' || data == 'updated'){
							alert("Successfully Updated");
							changeRow($thisobj, true);
						}else if(data == 'exist'){
							alert("Professor already exists");
							changeRow($thisobj, false);
						}
					}
				}); // POST updateProfessor end
			}
			// add of oldProfessorID
			else{
				// get Inputs
				var $firstName = $(this).parents("tr")       		//Find parent row <tr>
				.find('.firstName').find('.new-value').val();   		//Get a child with class="ProfessorID new-value"
				var $middleName = $(this).parents("tr")       		//Find parent row <tr>
				.find('.middleName').find('.new-value').val();   		//Get a child with class="ProfessorID new-value"
				var $lastName = $(this).parents("tr")       		//Find parent row <tr>
				.find('.lastName').find('.new-value').val();   		//Get a child with class="ProfessorID new-value"
				var $thisobj = $(this);
				var $professorIDobj = $thisobj.parents("tr")       		//Find parent row <tr>
				.find('.professorID').find('.old-value');


				//Post addProfessor
				$.ajax({
					type:"POST",
					url: "addProfessor.php",
					data: "&firstName=" + $firstName
					+ "&middleName=" + $middleName
					+  "&lastName=" + $lastName ,
					success: function(data){
						$professorID = data.trim();
						alert("Successfully Inserted");
						$professorIDobj.attr('value',$professorID);
						// change blank professorID on row
						changeRow($thisobj, true);
						
					}
				}); // POST addProfessor end
				
				
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
        var $professorID = $(this).parents("tr")       		//Find parent row <tr>
			.find('.hidden').find('.old-value').val();   	//Get a child with class="ProfessorID old-value"
		var $thisobj = $(this);

		if(confirm('Do you really wish to delete Professor?')){

			// post deleteProfessor
			$.ajax({
				type: "POST",
				url: "deleteProfessor.php",
				data: "professorID=" + $professorID,
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