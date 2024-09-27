        <?php include "navbar.php"?>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script>
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
            const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

            function search(){ 
                let search = document.getElementById('search_input').value;

                location.href = `/view-task?s=${search}`;
            }	
        </script>
    </body>
</html>