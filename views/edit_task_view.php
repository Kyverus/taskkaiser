<?php 
$PageTitle = "Edit Task"; 
include "templates/header.php" ?>

<div class="alert-display">
	<?php
		if($errors){
			foreach($errors as $error){ 
	?>
				<div class="alert alert-danger alert-dismissible fade show" role= "alert">
					<strong>Error: </strong> <?=$error?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
	<?php
			}
		}
	?>
</div>

<div class = "container">
		<div class="card bg-dark text-white border-0" style="margin:auto; margin-top:30px;">
			<div class="card-body">
			<form action="" method="post" autocomplete="off">
				<div class="form-group">
					<label class="form-label" >Task Name:</label> <br>
					<input class="form-control" type="text" value="<?= $task_name?>" name="name"> <br>
				</div>
				
				<div class="form-group">
					<label class="form-label" >Description:</label> <br>
					<textarea class="form-control" type="text" name="description" placeholder="Enter Description"><?=$task_description?></textarea> <br>
				</div>
				
				<div class="form-group row">
					<div class="form-group w-50">
						<label class="form-label" for="type">Type:</label> <br>
						<select class="form-select" aria-label="Type" value="<?=$task_type?>" name ="type" id="type">
							<option value="0">No Deadline</option>
							<option value="1">With Deadline</option>
						</select> <br>
					</div>

					<div class="form-group w-50" id="form-group-deadline" style="display:none">
						<label class="form-label" for="deadline">Deadline:</label> <br>
						<input class="form-control" type="date" value="<?=$task_deadline?>" name ="deadline"> <br>
					</div>
				</div>

				<div class="form-group row">
					<div class="form-group w-50">
						<label class="form-label" for="main_tag">Main Tag:</label> <br>
						<select class="form-select" aria-label="Main Tag" value="<?=$task_main_tag?>" name ="main_tag">
							<option value="0">Personal</option>
							<option value="1">Work</option>
							<option value="2">Other</option>
						</select>
					</div>

					<div class="form-group w-50">
						<label class="form-label" for="sub_tag">Sub Tag:</label> <br>
						<select class="form-select" aria-label="Main Tag" name ="sub_tag">
							<option value="0">Personal</option>
							<option value="1">Work</option>
							<option value="2">Other</option>
						</select>
					</div>
				</div>
				
				<div class="d-grid col-12" style="margin-top: 30px">
					<input type="hidden" name="id" value="<?=$task_id; ?>">
					<button class="btn btn-success" type="Submit" value="Update" name="update">Submit</button>
				</div>
			</form>
			</div>
		</div>	
	</div>

	<script>
		let type = document.getElementById('type');
		type.addEventListener('click', display);

		let div = document.getElementById('form-group-deadline');

		function display(){
			if(type.options[type.selectedIndex].value == 1) {
				div.style.display = "block";
			}else{
				div.style.display = "none";
			}
		}

	</script>

<?php include "templates/footer.php" ?>