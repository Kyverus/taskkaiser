<?php 
$PageTitle = "Edit Tag"; 
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
	</div>
    <div class = "container position-fixed fixed-center">
		<div class="card border-0 shadow-sm" style="margin:auto;">
			<div class="card-body">
			<form action="" method="post" autocomplete="off">
				<div class="form-group">
					<label class="form-label" >Tag Name:</label> <br>
					<input class="form-control" type="text" value="<?=$tag_name?>" name="tag_name" > <br>
				</div>
				
				<div class="form-group">
					<label class="form-label" >Description:</label> <br>
					<textarea class="form-control" type="text" name="tag_description" placeholder="Enter Description"><?=$tag_description?></textarea> <br>
				</div>
				
				<div class="form-group">
					<label class="form-label" for="type">Color:</label> <br>
					<select class="form-select" aria-label="Type" name="tag_color" id="tag_color">
						<?php if ($colors): ?>
							<?php foreach($colors as $color): ?>
                                <?php if($color['id'] == $tag_color): ?>
                                    <option value="<?=$color['id']?>" style="background-color:<?=$color['name']?>" selected><?=$color['display_name']?></option>
                                <?php else:	?>
								    <option value="<?=$color['id']?>" style="background-color:<?=$color['name']?>"><?=$color['display_name']?></option>
                                <?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>
					</select> 
					<br>
				</div>

				<div class="d-grid col-12" style="margin-top: 20px">
                    <input type="hidden" name="tag_id" value="<?=$tag_id; ?>">
					<button class="btn btn-success" type="Submit" value="tag_update" name="tag_update">Save Changes</button>
				</div>
			</form>
			</div>
		</div>	
	</div>
</div>


<?php include "templates/footer.php" ?>