<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd"> 
 
<html> 
    <head> 
        <meta name="generator" content="HTML Tidy, see www.w3.org"> 
        <meta http-equiv="Content-Type" content=
        "text/html; charset=iso-8859-1"> 
 
        <title>Drag and Drop Example: Permission Form</title> 
        <link href="css/permission.css" rel="stylesheet" type=
        "text/css"> 
		
 
		<script type="text/javascript" src="js/EventHelpers.js"></script> 
		<script type="text/javascript" src="js/DragDropHelpers.js"></script> 
		<script type="text/javascript" src="js/permissionForm.js"></script> 
    </head> 
 
    <body> 
        <form> 
            <fieldset> 
                <legend>Deployment Workflows</legend> 
 
                <p>A deployment workflow is a collection of deploy objects places in a specific linear order. (bi-linear workflow execution is explained in the documentation.) A deploy object is usually shell script or a transfer object. A transfer object is just that. a single file with four properties.  Source path, Source user, Destination path, Destination user.<br><br>Below are three containers that will hold the deploy objects.  The first container is your libarary of deploy objects. The second container hold the objects to be executed durring the 'Pre-flight' phase of a deployment workflow.  The third container hold the objects that are used in the 'Cut-over' phase of the deployment workflow.  
                </p> 
 
                <table class="userTable"> 
                    <thead> 
                        <tr> 
                            <th>Workflow Objects</th> 
 
                            <th>Pre-flight</th> 
 
                            <th>Cut-over</th> 
                        </tr> 
                    </thead> 
 
                    <tbody> 

                        <tr>
<td id="unassignedUsers" class="userList">
<?
$d = dir("objects");
while (false !== ($entry = $d->read())) {
	if ( "$entry" != "." and "$entry" != ".." ) {
   		echo "<a href=# draggable=true>$entry</a>";
	}
}
$d->close(); 
?>
							</td> 
 
                            <td id="restrictedUsers" class="userList"> 
                            </td> 
 
                            <td id="powerUsers" class="userList"> 
                            </td> 
                        </tr> 
                    </tbody> 
					<tfoot> 
						<td id="SunassignedUsersHelp"><input type=button value='Add Objects'></td> 
						<td id="restrictedUsersHelp"></td> 
						<td align=right id="powerUsersHelp" ><input type=text><input type=button value="Save Workflow"></td> 
					</tfoot> 
                </table> 
            </fieldset> 
        </form> 
		<br /> 
<? include("server_footer.php"); ?>
    </body> 
</html> 
 
