<?php 
$PageTitle = "Create Tag"; 
include "templates/header.php" ?>

	<div class = "container">
		<div class="card" style="width: 500px; margin-left: auto; margin-right: auto; margin-top:20px;">
			<div class="card-body">
			<form action="" method="post">
				<div class="form-group">
					<label class="form-label" >Tag Name:</label> <br>
					<input class="form-control" type="text" name="name"> <br>
				</div>
				
				<div class="form-group">
					<label class="form-label" >Tag Description:</label> <br>
					<textarea class="form-control" type="text" name="description" placeholder="Enter Description"></textarea> <br>
				</div>
				
				<div class="form-group">
					<label class="form-label" for="type">Tag Color:</label> <br>
					<input class="form-control" type="text" name ="type"> <br>
				</div>

				<div class="d-grid col-12" style="margin-top: 20px">
					<button class="btn btn-success" type="Submit">Submit</button>
				</div>
			</form>
			</div>
		</div>	
	</div>
   
<?php include "templates/footer.php" ?>
