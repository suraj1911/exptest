<html>
    <head>
        <title>Exceptionaire Test</title>

        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    </head>
    <body>
        	
    <div class="container">
	<div class="btn">
       <form class="excel-upl" id="excel-upl" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <button type="button" name="import" id="download_excel" class="btn btn-primary center-block mt-2">Download As Excel Sheet</button>
    	</form>
    
    </div>
    <span id="message"></span>
    <div class="form-group" id="process" style="display:none;">
        <div class="progress">
         <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
          <span id="process_data">0</span> - <span id="total_data">0</span>
         </div>
        </div>
       </div>
    <?php
    if (!empty($users)) {
        ?>
        <table id="tab" class="table table-container table-bordered">
            <thead>
                <tr>
                    <th># Sr.no</th>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i=1;
        	foreach ($users as $key => $value) {
            ?>   
                <tr>
                	<td><?php echo $i; ?></td>
                    <td><?php echo $users[$key]["username"]; ?></td>
                    <td><?php echo $users[$key]["first_name"]; ?></td>
                    <td><?php echo $users[$key]["last_name"]; ?></td>
                    <td><?php echo $users[$key]["gender"]; ?></td>
                    <td><?php echo $users[$key]["password"]; ?></td>
                </tr>
            <?php
        		$i++;
        	}
        ?>
            </tbody>
        </table>
    <?php
    }
    else
    {
    ?>
    <div class="empty-table">
    <div class="svg-icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"><circle cx="12" cy="19" r="2"/><path d="M10 3h4v12h-4z"/><path fill="none" d="M0 0h24v24H0z"/></svg>
    </div>
    No records found</div>
    <?php 
    }
    ?>
    </div>

	<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" type="text/javascript"></script>

	<script type="text/javascript">
		$("#download_excel").on("click",function(){

			$.ajax({
			        url: '<?php echo site_url(); ?>home/export',
			        type: 'POST',
			        accepts: "charset=utf-8",
			        contentType: 'multipart/form-data',
			        success: function (response) {
			        	window.open('<?php echo base_url();?>home/export','_blank');  
			        	alert("Download Successfully");
			        },
			        error: function() {
			            alert("error");
			        }
    			});
    			
		});
			
	</script>

    </body>
</html>

           

