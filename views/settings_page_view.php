<?php 
$PageTitle = "Index";
include "templates/header.php";
?>
<div class="alert-display">
    <?php if($success): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success: </strong> <?=$success?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
	<?php if($errors): ?>
		<?php foreach($errors as $error):?>
			<div class="alert alert-danger alert-dismissible fade show" role= "alert">
				<strong>Error: </strong> <?=$error?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>

<div class="container">
    <div class="slider px-2 rounded-4 shadow-sm" id="settings-list">
        <form method="post">
        <input type="hidden" name="settings_language" value="<?=$settings['language']; ?>">
        <div class="d-flex align-items-center">
            <div class="w-50 d-flex flex-column">
                <label class="settings-title">Theme</label>
                <label>&#40;Change app theme to light or dark mode&#41;<label>
            </div>
            <div class="w-50">
                <input type="hidden" name="settings_theme" value="<?=$settings['theme']; ?>">
                <input type="submit" name="toggle_theme" value="toggle_theme" id="btn-theme" class="settings-action"/>
            </div>
        </div>
        <hr/>
        <div class="d-flex align-items-center">
            <div class="w-50 d-flex flex-column">
                <label class="settings-title">Auto Delete</label>
                <label>&#40;Delete overdue and completed tasks that exceeds 30 days &#41;<label>
            </div>
            <div class="w-50">
                <input type="hidden" name="settings_autodelete" value="<?=$settings['autodelete']; ?>">
                <input type="submit" name="auto_delete" value="auto_delete" id="btn-auto-delete" class="settings-action"/>
            </div>
        </div>
        <hr/>
        </form>
        <div class="d-flex flex-column">
            <span><a href="/create-tag" class="settings-action">Create Tag </a></span>
            <span class="settings-title">Tags</span>
            <?php if($tags): ?>
                <?php foreach($tags as $tag): ?>
                    <div class="d-flex px-5">
                        <div class="w-50"><?= $tag["name"] ?></div>
                        <form method="post" class="w-50">
                            <input type="hidden" name="tag_id" value="<?=$tag['id']; ?>">
                            <a class="mr-3 settings-link" href="/edit-tag?id=<?php echo $tag['id']; ?>" id="btn-edit-tag">Edit</a>
                            <button class="mr-3 settings-link" type="submit" name="tag_delete" id="btn-delete-tag"> Delete </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <hr/>
        <div class="d-flex flex-column">
            <span class="settings-title">About</span>
            <span class="settings-title">Help</span>
        </div>
    </div>
</div>

<script>
    const tags = <?php echo json_encode($tags) ?>;
    console.log(tags);
    const settings = <?php echo json_encode($settings) ?>;
    const themeBtn = document.getElementById('btn-theme').value = (settings.theme.charAt(0).toUpperCase() + settings.theme.slice(1));
    const autoDeleteBtn = document.getElementById('btn-auto-delete').value = ((settings.autodelete) ? "On" : "Off");
</script>
<?php
include "templates/footer.php" 
?>