<?php 
$PageTitle = "Create Task"; 
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

		<?php
			if($success){
		?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Success: </strong> <?=$success?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php
			}
			
		?>
	</div>

	<div class = "container">
		<div class="card bg-dark text-white border-0" style="margin:auto;">
			<div class="card-body">
			<form action="" method="post" autocomplete="off">
				<div class="form-group">
					<label class="form-label" >Task Name:</label> <br>
					<input class="form-control" type="text" name="task_name"> <br>
				</div>
				
				<div class="form-group">
					<label class="form-label" >Description:</label> <br>
					<textarea class="form-control" type="text" name="task_description" placeholder="Enter Description"></textarea> <br>
				</div>
				
				<div class="form-group row">
					<div class="form-group w-50">
						<label class="form-label" for="type">Type:</label> <br>
						<select class="form-select" aria-label="Type" name="task_type" id="task_type">
						<?php
						if ($types) {
							foreach($types as $type){ 
						?>	
								<option value="<?=$type['id']?>"><?=$type['name']?></option>
						<?php
							}
						}
						?>
						</select> <br>
					</div>

					<div class="form-group w-50" id="form-group-deadline" style="display:none">
						<label class="form-label" for="deadline">Deadline:</label> <br>
						<input class="form-control" type="date" name="task_deadline" id="task_deadline"> <br>
					</div>
				</div>


				<div class="form-group">
					<label class="form-label" for="main_tag">Main Tag:</label> <br>
					<select class="form-select" aria-label="Main Tag" name="task_main_tag">
					<?php
						if ($tags) {
							foreach($tags as $tag){ 
						?>	
								<option value="<?=$tag['id']?>" style="color:<?=$tag['color']?>"><?=$tag['name']?></option>
						<?php
							}
						}
						?>
					</select>
				</div>
			
				<div class="d-grid col-12" style="margin-top: 30px">
					<button class="btn btn-success" type="Submit">Submit</button>
				</div>
			</form>
			</div>
		</div>	
	</div>

	<script>
		let type = document.getElementById('task_type');
		type.addEventListener('click', display);

		let div = document.getElementById('form-group-deadline');

		function display(){
			if(type.options[type.selectedIndex].value == 2) {
				div.style.display = "block";
			}else{
				div.style.display = "none";
				document.getElementById("task_deadline").value = "";
			}
		}

	</script>
   
<?php include "templates/footer.php" ?>
