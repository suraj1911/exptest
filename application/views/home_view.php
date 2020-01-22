<html>
    <head>
        <title>Exceptionaire Test</title>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    </head>
    <body>        
       <div class="container">
        <table id="example" class="display" style="width:100%;">
	        <thead>
	            <tr>
	                <th>ID</th>
	                <th>Username</th>
	                <th>First Name</th>
	                <th>Last Name</th>
	                <th>Gender</th>
	                <th>Password</th>
	            </tr>
	        </thead>
    	</table>
    </div>

	<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

	<script>
	$(document).ready(function () {
        $('#example').DataTable({
           "order": [[0,"desc"]],
           "columnDefs":[
           		{"orderable" : false, "target":"no-sort"}
           ],
           "processing":true,
           "serverSide":true,
           "dom": "Blfrtip",
           "buttons": [
                'excelHtml5'
            ],
           "ajax" : {
           			"url": "<?php echo base_url('home/fetchData'); ?>",
	                "dataType": "json",
	                "type": "POST"
           },

            "columns": [
                {data: "user_id"},
                {data: "username"},
                {data: "first_name"},
                {data: "last_name"},
                {data: "gender"},
                {data: "password"}
            ],
           "lengthMenu": [[10,50,100, 250, 500, "All"], [10,50,100, 250, 500, "All"]]
           	
        });
    });
		</script>
    </body>
</html>

           

