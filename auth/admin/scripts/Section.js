$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();
	
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		$(this).attr("disabled", "disabled");
		// var index = $("table tbody tr:last-child").index();
		var courseOptionObj = $("#course-id-options");
		var courseOptions = new Array();
		$("#course-id-options").find("option").each(function(){
			courseOptions.push($(this).val());
		});
		
        var row = '<tr>' +
            '<td class = "editableColumns sectionID"> <div class="old-value"></div> <input type="text" class="form-control new-value"></td>' +
            '<td class = "editableColumns courseID"> <div class="old-value"></div> <select class="form-control new-value"> ' +
            '<option selected>'+ courseOptions[1] +'</option>';
            for(var i = 1;i<courseOptions.length;i++){
            	row = row + '<option>'+ courseOptions[i]+'</option>';
            }
        row = row + '</select></td>' +
			'<td class = "editableColumns yearLevel"> <div class="old-value"></div> <input type="number" class="form-control new-value" min=1 max=5 maxlength="1"></td>' +
			'<td>' + actions + '</td>' +
        '</tr>';
    	$("table tbody tr:first").before(row);		
		// $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
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
			var $oldSectionID = $(this).parents("tr")       		//Find parent row <tr>
			.find('.sectionID').find('.old-value').text();   	//Get a child with class="SectionID old-value"
			var $newSectionID = $(this).parents("tr")       		//Find parent row <tr>
			.find('.sectionID').find('.new-value').val();   		//Get a child with class="SectionID new-value"
			var $courseID = $(this).parents("tr")          	//Find parent row <tr>
			.find('.courseID').find('.new-value').val();  	//Get a child with class="SectionTitle new-value"
			var $yearLevel = $(this).parents("tr")          	//Find parent row <tr>
			.find('.yearLevel').find('.new-value').val();  	//Get a child with class="SectionTitle new-value"
			var $thisobj = $(this);

			// update of oldSectionID
			if($oldSectionID){
				//Post updateSection
				$.ajax({
					type:"POST",
					url: "updateSection.php",
					data: "&oldSectionID=" + $oldSectionID + "&newSectionID=" + $newSectionID
					+ "&courseID=" + $courseID + "&yearLevel=" + $yearLevel ,
					success: function(data){
						data = data.trim();
						if(data == 'success' || data == 'updated'){
							alert("Successfully Updated");
							changeRow($thisobj, true);
						}else if(data == 'exist'){
							alert("Section already exists or is very similar to an existing one");
							changeRow($thisobj, false);
						}else if(data == 'invalid'){
							alert("Invalid Course");
							changeRow($thisobj, false);
						}else if(data == 'year invalid'){
							alert("Invalid Year");
							changeRow($thisobj, false);
						}
					}
				}); // POST updateSection end
			}
			// add of oldSectionID
			else{
				var $sectionID = $(this).parents("tr")       		//Find parent row <tr>
				.find('.sectionID').find('.new-value').val();   		//Get a child with class="SectionID new-value"
				var $courseID = $(this).parents("tr")       		//Find parent row <tr>
				.find('.courseID').find('.new-value').val();   		//Get a child with class="SectionID new-value"
				var $yearLevel = $(this).parents("tr")       		//Find parent row <tr>
				.find('.yearLevel').find('.new-value').val();   		//Get a child with class="SectionID new-value"

				//Post addSection
				$.ajax({
					type:"POST",
					url: "addSection.php",
					data: "&sectionID=" + $sectionID
					+ "&courseID=" + $courseID + "&yearLevel=" + $yearLevel ,
					success: function(data){
						data = data.trim();
						if(data == 'success' || data == 'updated'){
							alert("Successfully Inserted");
							changeRow($thisobj, true);
						}else if(data == 'exist'){
							alert("Section already exists or is very similar to an existing one");

							// remove row
							$thisobj.parents("tr").remove();
							$(".add-new").removeAttr("disabled");
						}else if(data == 'invalid'){
							alert("Course invalid");

							// remove row
							$thisobj.parents("tr").remove();
							$(".add-new").removeAttr("disabled");
						}else if(data == 'year invalid'){
							alert("Invalid Year");

							// remove row
							$thisobj.parents("tr").remove();
							$(".add-new").removeAttr("disabled");
						}
					}
				}); // POST addSection end
				
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
	   	var $sectionID = $(this).parents("tr")       		//Find parent row <tr>
			.find('.sectionID').find('.old-value').text();   	//Get a child with class="RoomID old-value"
		var $thisobj = $(this);
		if(confirm('Do you really wish to delete Section?')){

			// post deleteroom
			$.ajax({
				type: "POST",
				url: "deleteSection.php",
				data: "sectionID=" + $sectionID,
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

    // Change table on change selector
	$(document).on("change",".selector", function(){
		var $courseSelector = $("#course-id-options").val();
		var $yearSelector = $("#year-level-options").val();

		//convert
		if($yearSelector == "1st Year"){
			$yearSelector = 1;
		}else if($yearSelector == "2nd Year"){
			$yearSelector = 2;
		}else if($yearSelector == "3rd Year"){
			$yearSelector = 3;
		}else if($yearSelector == "4th Year"){
			$yearSelector = 4;
		}else if($yearSelector == "5th Year"){
			$yearSelector = 5;
		}
		// show all first
		$("#table").find("tr").find(".courseID").find(".old-value").each(function(){
				if($(this).text()){
					$(this).parents("tr").show();
				}
			});

		// then sort out
		if($courseSelector == "All"){
			

		}else{
			$("#table").find("tr").find(".courseID").find(".old-value").each(function(){
				if($(this).text() != $courseSelector){
					$(this).parents("tr").hide();
				}
			});

		}

		if($yearSelector == "All"){
			

		}else{
			$("#table").find("tr").find(".yearLevel").find(".old-value").each(function(){
				if($(this).text() != $yearSelector){
					$(this).parents("tr").hide();
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