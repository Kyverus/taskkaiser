<?php 
$PageTitle = "View Tasks"; 
include "templates/header.php" ?>

<div id="task-page">
    <nav id="task-nav" class="fixed-top bg-dark bg-body-tertiary " data-bs-theme="dark">
        <div class="container-fluid">
            <div class="d-flex flex-grow-1 py-2 position-relative justify-content-center" role="group">
                <a class="menu-link" href="/view-task?status=1">Completed</a>
                <a class="menu-link" href="/view-task?status=0">Ongoing</a>
                <a class="menu-link" href="/view-task?status=2">Overdue</a>
                <a class="position-absolute end-0 top-0" type="button" data-bs-toggle="collapse" data-bs-target="#search-collapse" aria-controls="search-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <img class="menu-icon d-inline-block align-middle mt-3 me-1" src="assets/icons/menu/search.svg"/>
                </a>
            </div>
            <div class="collapse w-100 block" id="search-collapse">
                <div class="d-flex pt-2 pb-3" role="search">
                    <input class="form-control me-2" id="search_input" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn" id="search-button" onclick="search()">Search</button>
                </div>
            </div>
        </div>
    </nav>

    <div class="floating-button rounded-circle">
        <a href="/create-task">
            <img class="floating-button-icon align-middle m-2" src="assets/icons/tasks/task-list-add.svg"/>
        </a>
    </div>


    <div class="alert-display">
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
            if($empty_message){
        ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>Message: </strong> <?=$empty_message?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            }
        ?>
    </div>

    <div class="container">
    <?php if ($tasks): ?>
        <div class="task-list" id="task-list">
        <?php foreach($tasks as $task): 
            $task_border = "";
            $deadline_bg = "";
    
            if($task['status'] == 1){
                $task_border = " border border-2 border-success";
                $deadline_bg = " bg-success";
            }
            
            if($task['status'] == 2){
                $task_border = " border border-2 border-danger";
                $deadline_bg = " bg-danger";
            }
        ?>
            <div class="<?='task-item d-flex w-100 px-2 py-3 my-4 rounded-4'.$task_border ?>" key="<?=$task['id']?>">
                <div class="d-flex ps-2 pe-4 align-items-center">
                    <span class="btn border-2 btn-outline-info rounded-pill" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-title="<?='Type: '.$task["type_name"]?>" data-bs-placement="left" data-bs-content="<?=$task['description']?>"> 
                        <?php if($task['type'] == 1): ?>
                            <img class="task-icon d-inline-block align-middle" src="assets/icons/tasks/clipboard2-check.svg"/>
                        <?php elseif($task['type'] == 2): ?>
                            <img class="task-icon d-inline-block align-middle" src="assets/icons/tasks/clock.svg"/>
                        <?php elseif($task['type'] == 3): ?>
                            <img class="task-icon d-inline-block align-middle" src="assets/icons/tasks/repeat.svg"/> 
                        <?php elseif($task['type'] == 4): ?>
                            <img class="task-icon d-inline-block align-middle" src="assets/icons/tasks/calendar-check.svg"/>
                        <? endif; ?>
                    </span>  
                </div>
                <div class="flex-grow-1 text-white">
                    <div>
                        <span class="me-2"> <?= $task['name']; ?> <span> 
                    </div>
                    <div>
                        <span class="badge rounded-pill" style="background-color:<?=$task["tag_color"]['name']?>"><?=$task["task_tag"]['name']; ?></span> 
                        <?php if($task['deadline'] != ""): ?>
                            <span class="<?='px-2 text-center'.$deadline_bg?>"><?= $task['deadline'] ?></span> 
                        <?php endif; ?>
                    </div>
                </div>
                <form method="post" class="d-flex align-items-center">
                    <input type="hidden" name="task_id" value="<?=$task['id']; ?>">

                    <span class="mx-1 btn border-2 btn-outline-info" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-title="Task Description" data-bs-content="<?=$task['description']?>"> 
                        <img class="task-icon d-inline-block align-middle" src="assets/icons/tasks/info-circle.svg"/> 
                    </span>   

                    <?php if($task['status'] == 0): ?>
                        <button class="mx-1 btn border-2 btn-outline-success" href="#" type="submit" value="task_complete" name="task_complete">
                            <img class="task-icon d-inline-block align-middle" src="assets/icons/tasks/check-circle.svg"/> 
                            <!-- Complete -->
                        </button>
                    <?php elseif($task['status'] == 0): ?>
                        <button class="mx-1 btn border-2 btn-outline-warning" href="#" type="submit" value="task_revert" name="task_revert"> 
                            <img class="task-icon d-inline-block align-middle" src="assets/icons/tasks/x-circle.svg"/> 
                            <!-- Revert -->
                        </button>
                    <?php endif; ?>
                    <a class="mx-1 btn border-2 btn-outline-warning" href="/edit-task?id=<?php echo $task['id']; ?>">
                        <img class="task-icon d-inline-block align-middle" src="assets/icons/tasks/pencil-square.svg"/> 
                        <!-- Edit -->
                    </a>

                    <button class="mx-1 btn border-2 btn-outline-danger" href="#" type="submit" value="task_delete" name="task_delete">
                        <img class="task-icon d-inline-block align-middle" src="assets/icons/tasks/trash.svg"/>
                        <!-- Delete -->
                    </button>
                </form>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
    <script>
        let mouseDown = false;
        let startY, scrollTop;
        const slider = document.getElementById('task-list');

        const startDragging = (e) => {
        mouseDown = true;
        startY = e.pageY - slider.offsetTop;
        scrollTop = slider.scrollTop;
        console.log("dragging");
        slider.classList.remove("scroll-slide");
        }

        const stopDragging = (e) => {
        mouseDown = false;
        console.log("dragging stopped");
        slider.classList.add("scroll-slide");
        }

        const move = (e) => {
        e.preventDefault();
        if(!mouseDown) { return; }
        const y = e.pageY - slider.offsetTop;
        const scroll = y - startY;
        slider.scrollTop = scrollTop - scroll;
        console.log("moving");
        }

        // Add the event listeners
        slider.addEventListener('mousemove', move, false);
        slider.addEventListener('mousedown', startDragging, false);
        slider.addEventListener('mouseup', stopDragging, false);
        slider.addEventListener('mouseleave', stopDragging, false);
    </script>
<?php include "templates/footer.php" ?>

