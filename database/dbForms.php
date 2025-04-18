<?php
/*
*
*	Form helper for StepVA 2025
*	Percy Miltier
*	
*/

include_once('dbinfo.php');
include_once('dbPersons.php');


// Pulls all created forms in numerical array format
function getForms() {
	
    $con=connect();
	
	$query = "SELECT formnameclean FROM formmanager;";
	
    $result = mysqli_query($con,$query);
	if (!(mysqli_num_rows($result) === 0)) {
		return mysqli_fetch_array($result, MYSQLI_NUM);
	} else {
		return 0;
	}
	
	mysqli_close($con);
	
	return $reason;
}

// Returns the originally formatted formname
function getFormName($formnameclean) {
	
    $con=connect();
	
	$query = "SELECT formname FROM " . $formnameclean . ";";
	
    $result = mysqli_query($con,$query);
	$names = mysqli_fetch_array($result, MYSQLI_NUM);
	
	return $names[0];
}

// Returns the number of questions in the form
function getNumQuestions($formnameclean) {
	
    $con=connect();
	
	$query = "SELECT count(*) as No_of_Column FROM information_schema.columns WHERE table_name ='" . $formnameclean ."'";
	
    $result = mysqli_query($con,$query);
	$num = mysqli_fetch_array($result, MYSQLI_NUM);
	$num = $num[0] - 1;
	
	return $num;
}

// Adds an empty form to the database that can be populated with questions
function addForm($formnameclean, $formname) {
	
    $con=connect();
	
	$query = "
		CREATE TABLE " . $formnameclean . " (
		  `formname` varchar(50)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	";
	
	if (!mysqli_query($con,$query)) {
		return ["error", "Error creating table."];
	} else {
		// insert other values
		$query = "
			INSERT INTO " . $formnameclean . "
			(formname) VALUES ('" . $formname . "');
		";
		
		if (!mysqli_query($con,$query)) {
			return ["error", "Error storing form name."];
		} else {
			$query = "
				INSERT INTO formmanager (formnameclean, isopen) VALUES ('"
				. $formnameclean . "'
				, '1');
			";
			
			if (!mysqli_query($con,$query)) {
				return ["error", "Error storing form in form manager."];
			} else {
				return ["happy", "Form created successfully."];
			}
		}
	}
}

// Deletes a form from the database
function dropForm($formnameclean) {
	
    $con=connect();
	
	$query = "DROP TABLE " . $formnameclean . ";";
	
	if (!mysqli_query($con,$query)) {
		return ["error", "Error deleting form."];
	} else {
		$query = "DELETE FROM formmanager WHERE formnameclean = '" . $formnameclean . "';";
		if (!mysqli_query($con,$query)) {
			return ["error", "Error deleting form."];
		} else {
			return ["error", "Form deleted successfully."];
		}
	}
}

// Adds questions to a Form
function addQuestion($formnameclean, $questionnum, $question) {
	
    $con=connect();
	
	$query = "SELECT formname FROM " . $formnameclean . ";";
    $result = mysqli_query($con,$query);
	$formname = mysqli_fetch_array($result, MYSQLI_NUM);
	$formname = $formname[0];
	
	$query = "
		ALTER TABLE " . $formnameclean . "
		  ADD `" . $questionnum . "` varchar(350);
	";
	
	if (!mysqli_query($con,$query)) {
		return ["error", "Error creating question."];
	} else {
		// store question
		$query = "
			UPDATE " . $formnameclean . "
			SET `" . $questionnum . "` = '" . $question . "'
			WHERE formname = ' . $formname . ';
		";
		
		if (!mysqli_query($con,$query)) {
			return ["error", "Error storing question."];
		} else {
			return ["happy", "Question edited successfully."];
		}
	}
}

// returns a question from a number
function getQuestion($formnameclean, $questionnum) {
	
    $con=connect();
	
	$query = "SELECT `" . $questionnum . "` FROM " . $formnameclean . ";";
	
	if (!mysqli_query($con,$query)) {
		return ["error", "Question not found."];
	} else {
		return ["happy", "Question returned."];
	}
}

// Drops a question from a form
function dropQuestion($formname, $question) {
	
    $con=connect();
	
	$query = "
		ALTER TABLE " . $formname . "
		  DROP COLUMN " . $question . ";
	";
	
	if (!mysqli_query($con,$query)) {
		return ["error", "Error deleting question."];
	} else {
		return ["happy", "Question deleted successfully."];
	}
}

// Edits a question in a form
function editQuestion($formname, $oldquestion, $newquestion) {
	
    $con=connect();
	
	$query = "
		ALTER TABLE " . $formname . "
		  RENAME COLUMN " . $oldquestion . " TO " . $newquestion . ";
	";
	
	if (!mysqli_query($con,$query)) {
		return ["error", "Error editing question."];
	} else {
		return ["happy", "Question edited successfully."];
	}
}

?>