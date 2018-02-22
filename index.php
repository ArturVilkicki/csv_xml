<?php
if(file_exists('catalog.xml')){
	$xml = simplexml_load_file('catalog.xml');
	//print_r($xml);
}else {
	exit('Failed to open catalog.xml.');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>CSV, HTML</title>
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
	<script type="text/javascript">
		$(document).ready( function () {
			$('#example').DataTable();
		} );
	</script>

</head>
<body>
	<table  id="example" class="display" cellspacing="0" width="100%">
		<thead>
            <tr>
                <th>Author</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Price</th>
                <th>publish_date</th>
                <th>Actions</th>
            </tr>
        </thead>
		<tbody>
		<?php
        	foreach ($xml as $book) {
        		echo "<tr>
        		<td>" .$book->author ."</td>
        		<td>" .$book->title ."</td>
        		<td>" .$book->genre ."</td>
        		<td>" .$book->price ."</td>
        		<td>" .$book->publish_date ."</td>
        		<td><button class='mygtukas1' data-status = 'hidden' data-desc ='" .$book->description ."'>" ."Show description"  ."</td></tr>";
        	}

       	?>
    	</tbody>
	</table>
	<form method="POST">
		ID:
		<input type="text"><br>
		Author:
		<input type="text"><br>
		Title:
		<input type="text"><br>
		Genre:
		<input type="text"><br>
		Price:
		<input type="text"><br>
		Publish date:
		<input type="text"><br>
		Description:
		<input type="textarea"><br>
		<button>Submit</button>
	</form>


<script>
	$(document).ready(function(){
		$('#example').DataTable({
        responsive: {
            details: {
                type: 'column',
                target: 'tr.main'
            }
        },
        //sita funkcija ivykdoma kiekviena karta, kai datatable perpiesiama nes....
        drawCallback: function( settings ) {
            $('button').each(function(){
                if ($(this).attr('data-status') == 'shown') {
                    $(this).attr('data-status', 'hidden');
                    $(this).html('show description');
                }
            });
        }
    	});
		$('button').on('click', function(){
			if($(this).attr('data-status') == 'hidden'){
				$(this).html('hide description');
            	$(this).attr('data-status', 'shown');
            	$(this).parent().parent().after('<tr><td colspan="6">Description: ' + $(this).attr('data-desc') + '</td></tr>');
			} else {
				$(this).attr('data-status', 'hidden');
            	$(this).parent().parent().next().remove();
            	$(this).html('show description');
			}
		});
		/*$('body').on('click', function(){
			$('#mygtukas1').val("Show description");
		});*/
	});
	
</script>
</body>
</html>