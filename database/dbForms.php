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
	
	$query = "SELECT `formnameclean` FROM `formmanager`;";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	return $result;
}

// Returns the originally formatted formname
function getFormName($formnameclean) {
	
    $con=connect();
	
	$query = "SELECT formname FROM " . $formnameclean . ";";
	
    $result = mysqli_query($con,$query);
	$names = mysqli_fetch_array($result, MYSQLI_NUM);
	
	mysqli_close($con);
	
	return $names[0];
}

// Checks if a form exists, returns a boolean
function checkForm($formnameclean) {
	
    $con=connect();
	
	$query = "SELECT formnameclean FROM formmanager WHERE formnameclean='" . $formnameclean ."';";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	if (mysqli_num_rows($result) == 0) {
		return false;
	} else {
		return true;
	}
}

// Returns the number of questions in a given form (Returns 0 if form doesn't exist)
function getNumQuestions($formnameclean) {
	
    $con=connect();
	
	$query = "SELECT numquestions FROM formmanager WHERE formnameclean='" . $formnameclean ."';";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	if (mysqli_num_rows($result) != 0) {
		$row = mysqli_fetch_array($result, MYSQLI_NUM);
		return $row[0];
	} else {
		return 0;
	}
}

// Returns if the form is open or not as a boolean (always returns a 0 if form doesn't exist)
function getOpen($formnameclean) {
	
    $con=connect();
	
	$query = "SELECT isopen FROM formmanager WHERE formnameclean='" . $formnameclean ."';";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	$row = mysqli_fetch_array($result, MYSQLI_NUM);
	if ($row[0] == 0) {
		return false;
	} else {
		return true;
	}
}

// Adds an empty form to the database that can be populated with questions
function addForm($formnameclean, $formname, $numquestions, $isopen) {
	
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
				INSERT INTO formmanager (formnameclean, numquestions, isopen) VALUES ('"
				. $formnameclean . "'
				, '" . $numquestions . "'
				, '" . $isopen . "');
			";
			
			if (!mysqli_query($con,$query)) {
				return ["error", "Error storing form in form manager."];
			} else {
				return ["happy", "Form created successfully."];
			}
		}
	}
}

function createAnswerTable($formnameclean, $numquestions) {
	
    $con=connect();
	
	$query = "
		CREATE TABLE " . $formnameclean . "responses (
		`answerid` int AUTO_INCREMENT,
		`id` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
		
		PRIMARY KEY (answerid)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
	";
	
	if (!mysqli_query($con,$query)) {
		return ["error", "Error creating answer table."];
	} else {
		for ($i = 1; $i <= $numquestions; $i++) {
			$query = "
				ALTER TABLE " . $formnameclean . "responses
				  ADD `" . $i . "` varchar(350);
			";
			$result = mysqli_query($con,$query);
			if (!$result) {
				return ["error", "Error formatting answer table."];
			}
		}
	}
	
	return ["happy", "Form deleted successfully."];
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
			$query = "DROP TABLE " . $formnameclean . "responses;";
			if (!mysqli_query($con,$query)) {
				return ["error", "Error deleting form."];
			} else {
				return ["happy", "Form deleted successfully."];
			}
		}
	}
}

// Adds questions to a Form
function addQuestion($formnameclean, $formname, $questionnum, $question) {
	
    $con=connect();
	
	$query = "SELECT formname FROM " . $formnameclean . ";";
    $result = mysqli_query($con,$query);
	
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
			SET `" . $questionnum . "`='" . $question . "'
			WHERE formname = '" . $formname . "';
		";
		
		if (!mysqli_query($con,$query)) {
			return ["error", "Error storing question."];
		} else {
			return ["happy", "Question edited successfully."];
		}
	}
}

// returns a question from a number
function getQuestion($formnameclean, $numquestions) {
	
    $con=connect();
	
	$query = "SELECT `" . $numquestions . "` FROM " . $formnameclean . ";";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	if (mysqli_num_rows($result) != 0) {
		$row = mysqli_fetch_array($result, MYSQLI_NUM);
		return $row[0];
	} else {
		return "";
	}
}

// Drops a question from a form
function dropQuestion($formnameclean, $question) {
	
    $con=connect();
	
	$query = "
		ALTER TABLE " . $formnameclean . "
		  DROP COLUMN " . $question . ";
	";
	
	if (!mysqli_query($con,$query)) {
		return ["error", "Error deleting question."];
	} else {
		return ["happy", "Question deleted successfully."];
	}
}

// Edits a question in a form
function editQuestion($formnameclean, $formname, $questionnum, $question) {
	
    $con=connect();
	
	$query = "
		UPDATE " . $formnameclean . "
		SET `" . $questionnum . "`='" . $question . "'
		WHERE formname = '" . $formname . "';
	";
	
	if (!mysqli_query($con,$query)) {
		return ["error", "Error editing question."];
	} else {
		return ["happy", "Question edited successfully."];
	}
}

// Edits a question in a form
function editOpen($formnameclean, $isopen) {
	
    $con=connect();
	
	$query = "
		UPDATE formmanager
		SET isopen=" . $isopen . "
		WHERE formnameclean = '" . $formnameclean . "';
	";
	
	if (!mysqli_query($con,$query)) {
		return ["error", "Error updating submission status."];
	} else {
		return ["happy", "Updated submission status successfully."];
	}
}

?>