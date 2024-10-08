<?php 
$PageTitle = "Create Task"; 
include "templates/header.php" ?>

<div>
	<div class="alert-display">
		<?php if($errors): ?>
			<?php foreach($errors as $error):?>
				<div class="alert alert-danger alert-dismissible fade show" role= "alert">
					<strong>Error: </strong> <?=$error?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>

		<?php if($success): ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Success: </strong> <?=$success?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php endif; ?>
	</div>

	<div class = "container position-fixed fixed-center">
		<div class="card bg-dark border-0 shadow-sm" style="margin:auto;">
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
						<select class="form-select d-inline-block" style="width:90%;" aria-label="Type" name="task_type" id="task_type">

						<?php if ($types): ?>
							<?php foreach($types as $type): ?>	
								<option value="<?=$type['id']?>">
									<?=$type['name']?>
								</option>
							<?php endforeach; ?>
						<?php endif; ?>
						</select> 

						<div class="d-inline-block text-center" style="width:9%;" id="tag_description" 
							data-bs-toggle="popover" 
							data-bs-trigger="hover" 
							data-bs-title="Description" 
							data-bs-content="<?=$types[0]['description']?>" 
							data-bs-placement="right">
							<img src="assets/icons/tasks/info-circle.svg"/>
						</div>
					</div>

					<div class="form-group w-50" id="form-group-deadline" style="display:none">
						<label class="form-label" for="deadline">Deadline:</label> <br>
						<input class="form-control" type="date" name="task_deadline" id="task_deadline">
					</div>
				</div>
				<br>
				<div class="form-group">
					<label class="form-label" for="main_tag">Main Tag:</label> <br>
					<select class="form-select" aria-label="Main Tag" name="task_main_tag">
					<?php if ($tags): ?>
						<?php foreach($tags as $tag): ?>	
							<option value="<?=$tag['id']?>" style="color:<?=$tag['color']?>"><?=$tag['name']?></option>
						<?php endforeach; ?>
					<?php endif; ?>
					</select>
				</div>
			
				<div class="d-grid col-12" style="margin-top: 30px">
					<button class="btn btn-success" type="Submit">Create Task</button>
				</div>
			</form>
			</div>
		</div>	
	</div>
</div>

<script>
	let type = document.getElementById('task_type');
	type.addEventListener('click', display);
	type.addEventListener('change', onChangeType);

	let deadlineFormGroup = document.getElementById('form-group-deadline');

	function display(){
		if(type.options[type.selectedIndex].value == 2) {
			deadlineFormGroup.style.display = "block";
		}else{
			deadlineFormGroup.style.display = "none";
			document.getElementById("task_deadline").value = "";
		}
	}

	function onChangeType(){
		let tag_description = document.getElementById('tag_description');
		let types = <?php echo json_encode($types)?>;
		let description = "not set";

		types.forEach((task_type) => {
			if(task_type['id'] === type.options[type.selectedIndex].value){
				description = task_type['description'];
			}
		});
		
		const popover = new bootstrap.Popover(tag_description, {
			content: description
		});
	}
</script>
   
<?php include "templates/footer.php" ?>
