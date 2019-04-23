$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();

	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		$(this).attr("disabled", "disabled");
		// var index = $("table tbody tr:last-child").index();
        var row = '<tr>' +

        
            '<td class = "editableColumns courseID"> <div class="old-value"></div> <input type="text" class="form-control new-value"></td>' +
            '<td class = "editableColumns courseTitle"> <div class="old-value"></div> <input type="text" class="form-control new-value"></td>' +
			'<td>' + actions + '</td>' +
        '</tr>';
    	// $("table").append(row);		
		// $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
    	$("table tbody tr:first").before(row);		
		$("table tbody tr").eq(0).find(".add, .edit").toggle();
		$("table tbody tr:first td:first input:first").focus();
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
			var $oldCourseID = $(this).parents("tr")       		//Find parent row <tr>
			.find('.courseID').find('.old-value').text();   	//Get a child with class="courseID old-value"
			var $newCourseID = $(this).parents("tr")       		//Find parent row <tr>
			.find('.courseID').find('.new-value').val();   		//Get a child with class="courseID new-value"
			var $courseTitle = $(this).parents("tr")          	//Find parent row <tr>
			.find('.courseTitle').find('.new-value').val();  	//Get a child with class="courseTitle new-value"
			var $thisobj = $(this);
			
			// update of oldCourseID
			if($oldCourseID){
				//Post updateCourse
				$.ajax({
					type:"POST",
					url: "updateCourse.php",
					data: "&oldCourseID=" + $oldCourseID + "&newCourseID=" + $newCourseID
					+ "&courseTitle=" + $courseTitle ,
					success: function(data){
						data = data.trim();
						if(data == 'success' || data == 'updated'){
							alert("Successfully Updated");
							changeRow($thisobj, true);
						}else if(data == 'exist'){
							alert("Course already exists or is very similar to an existing one");
							changeRow($thisobj, false);
						}
					}
				}); // POST updateCourse end
			}
			// add of oldCourseID
			else{
				var $courseID = $(this).parents("tr")       		//Find parent row <tr>
				.find('.courseID').find('.new-value').val();   		//Get a child with class="courseID new-value"
				var $courseTitle = $(this).parents("tr")       		//Find parent row <tr>
				.find('.courseTitle').find('.new-value').val();   		//Get a child with class="courseID new-value"

				//Post addCourse
				$.ajax({
					type:"POST",
					url: "addCourse.php",
					data: "&courseID=" + $courseID
					+ "&courseTitle=" + $courseTitle ,
					success: function(data){
						data = data.trim();
						if(data == 'success' || data == 'updated'){
							alert("Successfully Inserted");
							changeRow($thisobj, true);
						}else if(data == 'exist'){
							alert("Course already exists or is very similar to an existing one");

							// remove row
							$thisobj.parents("tr").remove();
							$(".add-new").removeAttr("disabled");
						}
					}
				}); // POST addCourse end
				
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

		var $courseID = $(this).parents("tr")  	// Finds the parent row <tr> 
		.find(".courseID").text();      		// Gets a descendent with class="courseID"
		var $thisobj = $(this);

		if(confirm('Do you really wish to delete Course?')){

			// post deleteCourse
			$.ajax({
				type: "POST",
				url: "deleteCourse.php",
				data: "courseID=" + $courseID,
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

// new reminder if dependent on plain text of php responses do data = data.trim()