<?
require_once("Database/QueryCommands.php");
// Print html header with bootstrap css and page title
function print_html_header($title,$hasNavBar=true,$stylesSheets=array("./css/stylesheet.css")) {
    echo '
	   <!DOCTYPE html>
       <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <title>'.$title.'</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">';
    foreach($stylesSheets as $sheets){
        echo        '<link rel="stylesheet" href="'.$sheets.'">';
    }

    echo'        </head>
                 <body>';
    $menu="";
    if($hasNavBar){
        $items=getPriNavBarArray();        
	    $active="";
        foreach($items as $key=>$value){
            if($value==$title){
                $active="active";
            }else{
                $active="";
            }
		    $menu=$menu.'<li class="nav-item">
                            <a class="nav-link '.$active.'" href="'.$key.'">'.$value.'</a>
                         </li>';
        }
     }
     echo'
		  <div class="container">		
              <ul class="nav nav-pills">'.$menu.'</ul>
              <h2>'.$title.'</h2>';
}



// Print html footer with bootstrap js
function print_html_footer() {
	echo '
		</div> <!-- /container -->	
		<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
	</body>
</html>
	';
}

// Print the question table
function print_question_table($mysqli) {
	// First, print the columns, i.e, field names
	$result = $mysqli->query("SHOW COLUMNS FROM Questions9017");
	echo '<table class="table table-striped">';
	echo '<thead class="thead-inverse">';
	echo '<tr>';
	while ($row = $result->fetch_row()) {
		echo '<th>'.$row[0]."</th>";
	}
	echo '</tr>';
	echo '<thead>';
	$result->close();
	
	// Second, print all the rows
	$result = $mysqli->query("SELECT * FROM Questions9017 ORDER BY id DESC");
	echo '<tbody>';
	while ($row = $result->fetch_row()) {
		echo '<tr>';
		foreach ($row as $value) {
			echo '<td>'.$value.'</td>';
		}
		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
	$result->close();
}

// Print the insert question form 
function print_insert_question_form($error, $q, $a) {

	if ($error) 
		$message = "All fields must be filled out";

	echo '		
  <form method="post" action="insert_question.php">
  	
		<label>Question<br>
		<textarea name="question" rows="3">'.$q[0].'</textarea>
		</label><br>
		
		<label>Choice 1
		<br>
		<input type="text" name="choice1" size="50" value="'.$q[1].'">
		</label>
		<input type="radio" name="answer" value="1" '.$a[1].'>
		<br>
		
		<label>Choice 2
		<br>
		<input type="text" name="choice2" size="50" value="'.$q[2].'">
		</label>
		<input type="radio" name="answer" value="2" '.$a[2].'>
		<br>
		
		<label>Choice 3
		<br>
		<input type="text" name="choice3" size="50" value="'.$q[3].'">
		</label>
		<input type="radio" name="answer" value="3" '.$a[3].'>
		<br>
		
		<label>Choice 4
		<br>
		<input type="text" name="choice4" size="50" value="'.$q[4].'">
		</label>
		<input type="radio" name="answer" value="4" '.$a[4].'>
		<br>
					
		<input type="submit" name="action" value="Insert">
		'.$message.'
	</form>
	';
}
	
?>