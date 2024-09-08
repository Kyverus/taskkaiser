    <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-warning" href="/">TASꓘKAISER</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Summary</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">View Tasks</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/view-task?status=0">Ongoing Tasks</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/view-task?status=1">Completed Tasks</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/view-task?status=2">Overdue Tasks</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Create</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/create-task">Create Tasks</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/create-tag">Create Tags</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex" role="search">
                    <input class="form-control me-2" type="search" id="search_input" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" onclick="search()">Search</button>
                </div>
            </div>
        </div>
    </nav>

    <script>
		function search(){
            let search = document.getElementById('search_input').value;

            location.href = `/view-task?s=${search}`;
		}	
	</script>