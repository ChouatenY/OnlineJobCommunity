<?php

include_once("../config.php");
$keyword= $_GET['key'];
if($keyword==""){
    echo " <div class='alert alert-danger alert-dismissible' role='alert'>
            <button type='button' class='close'  data-dismiss='alert' aria-label='Close'><span
                    aria-hidden='true'>&times;</span></button>
           <p style='font-size: 20px'><strong>Oops!</strong> Please enter a search term</p>
        </div>";

}

else{
$query = "select * from jobs  join employer  on jobs.eid = employer.eid  where title LIKE '%" . $keyword . "%' or employer.ename LIKE '%".$keyword."%' or employer.profile LIKE '%" . $keyword . "%'" ;
$result = mysqli_query($db1, $query);

if (mysqli_num_rows($result) == 0)
{
    echo " <div class='alert alert-danger alert-dismissible' role='alert'>
            <button type='button' class='close'  data-dismiss='alert' aria-label='Close'><span
                    aria-hidden='true'>&times;</span></button>
           <p style='font-size: 20px'><strong>Sorry!</strong> No jobs found matching your search, try something else</p>
        </div>";
}
else {
?>

<html>
    <style type="text/css">
    #searchthumb {
    background: snow;
    padding: 0 0 15px 0;
    border: none;
    border-radius: 0;
}

    </style>
<!--- <table class="table table-striped">
    <th>Company</th>
    <th>Position</th>
    <th>Post Date</th>
    <th>Candidate Profile</th> -->
    <?php
     
  /*  echo "<h3 style='color:green'> Search Results Matching: " . $keyword . "</h3>
     <div class='page-header' style='background:skyblue'></div> ";

    while ($row = mysqli_fetch_array($result)) {
        //$query2 = mysqli_query($db1, "select * from employer where eid = '$row[eid]'");
        //$r2 = mysqli_fetch_array($query2);

        echo " <tr> ";
        echo "<td><a style='color: green;' href='view_emp.php?id=".$row['eid']."'>". $row['ename'] . "</td>";
        echo "<td><a style='color: blue;'  href='view_jobs.php?jid=".$row['jobid']."'>" . $row['title'] . "</a></td>";
        echo "<td>" . $row['postdate'] . "</td>";
        echo "<td>" . substr($row['jprofile'],0,120) . "......</td>";    
        echo "</tr>";
    }
   
    }
*/
echo "<h3 style='color:green'> Search Results Matching: " . $keyword . "</h3>";
echo "<div class='page-header' style='background:dodgerblue'></div><br/>";
echo "<div class='row'>";
			
					while ($row = mysqli_fetch_array($result)){
						echo   "<div class='col-sm-3'>";
						echo     "<div class='thumbnail' id='searchthumb'>";
                        if($row['logo']!="") {
                    echo     "<img class='img-square img-responsive' style='min-height:50px;height:70px;' src='../uploads/logo/".$row['logo']."'/> ";
                }else echo" <img style='min-height:50px;height:70px;' src='../images/fallbacklogo.jpg'>";	
						echo     	"<div class='caption'>";
						echo 			"<h4><a style='color: green;' href='view_emp.php?id=".$row['eid']."'>". $row['ename']."</a></h4>";
						echo 			"<p><a style='color: blue;'  href='view_jobs.php?jid=".$row['jobid']."'>" . $row['title'] . "</a></p>";
						echo 			"<p>Posted on: ".$row['postdate']."</p>";
						echo 			"<p>". substr($row['jprofile'],0,50) . "......</p>";
						echo 		"</div>";
						echo 	 "</div>";
						echo   "</div>";
					
				}
	echo "</div>";	
    }   
} 
     ?>
</table>
</html>
