<?php
	session_start();
	$user_data = JSON_DECODE($_SESSION['user_data']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='stylesheet' href='abet.css'>
    <title>UTK ABET</title>
</head>
<body>
    <header>
        <h4>UTK ABET</h4>
        <div style="position: relative;">
            <figure id="active-user-menu">
                <!-- Yeah, I know this isn't how svg's shouldn't be displayed. Bite me. -->
                <svg class="bi bi-person-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="#2074b0" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                </svg> 
                <svg class="bi bi-caret-down-fill" width="0.6em" height="0.6em" viewBox="0 0 16 16" fill="#2074b0" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 01.753 1.659l-4.796 5.48a1 1 0 01-1.506 0z"/>
                </svg>
            </figure>
            <nav class="user-menu hidden-menu">
				<input type="submit" id="logout" class="btn btn--red" value="Log Out" >
				<input type="text" id="newPassword" placeholder="New Password">
				<input type="text" id="confirmPassword" placeholder="Confirm Password">
				<input type="submit" id="changePassword" class="btn btn--green" value="Change Password" >
            </nav>
        </div>
    </header>
    <section class="wrapper">
        <nav class="main-nav">
            <h4 data-id="" class="sectionLabel">Section:</h4>
            <select name="section" id="sectionMenu">
				<?php
					$ind = 1;
					foreach($user_data as $row){
						echo '<option value="section'.$ind++.'"';
						echo 'data-major="'.$row->major.'"';
						echo 'data-sectionid="'.$row->sectionId.'"';
						echo '>';
						echo $row->courseId.' ';
						echo $row->semester.' ';
						echo $row->year.' ';
						echo $row->major;
						echo '</option>';
					}
				?>
            </select>
        </nav>
        <main>
            <section class="results panel">
                <h2>Results</h2>
                <p class="description">
                    Please enter the number of students who do not meet expectations, meet expectations, and exceed expectations. You can type directly into the boxes--you do not need to use the arrows.
                </p>
                <section class="example">
                    <p> 
                    </p>
                </section>
                <section class="expectations">
                    <div class="labels">
                            <label for="bad">Not Meets Expectations</label>
                            <label for="ok">Meets Expectations</label>
                            <label for="good">Exceeds Expectations</label>
                            <p class="totalValue label">Total</p>
                    </div>
                    <div class="filters">
                        <input type="number" name="bad" id="notMeetsExpectations" value="0" min="0">
                        <input type="number" name="ok" id="meetsExpectations" value="0" min="0">
                        <input type="number" name="good" id="exceedsExpectations" value="0" min="0">
                        <p class="totalValue value">0</p>
                        </div>
                    </div>
                    <button id="saveResults" class="btn btn--blue" type="submit">Save Results</button>
					<p id="resultsSuccess" class="hidden success resultsResponce">Results successfully saved</p>
					<p id="resultsFail" class="hidden fail resultsResponce">Results unsuccessfully saved</p>
                </section>
            </section>
            <section class="ass-plan panel">
                <h2>Assessment Plan</h2>
                <ol>
                    <li>Please enter your assessment plan for each outcome. The weights are percentages from 0-100 and the weights should add up to 100%.</li>
                    <li>Always press "Save Assessments" when finished, even if you removed an assessment. The trash can only removes an assessments from this screen-it does not remove it from database until you press "Save Assessments".</li>
                </ol>
                <div class="labels">
                    <p class="weight">Weight (%)</p>
                    <p class="desc">Description</p>
                    <p class="remove">Remove</p>
                </div>
				<div class="inputsWrapper">

				</div>
                <button id="newAssessment" class="btn btn--green">+ New</button>
                <button id="saveAssessments" class="btn btn--blue">Save Assessments</button>
				<p id="assessmentsSuccess" class="hidden success assessmentsResponce">Assessment Plan successfully saved</p>
				<p id="assessmentsFail" class="hidden fail assessmentsResponce">Assessment Plan unsuccessfully saved</p>
				<p id="weightsNot100" class="hidden fail">assessment weights must add to 100</p>
            </section>
            
            <section class="summary panel">
                <h2>Narrative Summary</h2>
                <p>Please enter your narrative for each outcome, including the student strengths for the outcome, student weaknesses for the outcomes, and suggested actions for improving student attainment of each outcome.</p>
                <p class='label'>Strengths</p>
                <textarea name="strengths" id="strengths" cols="60" rows="10" maxlength="2000" placeholder="None"></textarea>
                <p class='label'>Weaknesses</p>
                <textarea name="weaknesses" id="weaknesses" cols="60" rows="10" maxlength="2000" placeholder="None"></textarea>
                <p class='label'>Actions</p>
                <textarea name="actions" id="actions" cols="60" rows="10" maxlength="2000" placeholder="None"></textarea>
                <button id="saveNarrative" class="btn btn--blue">Save Narrative</button>
				<p id="narrativeSuccess" class="hidden success narrativesResponce">Narrative successfully saved</p>
				<p id="narrativeFail" class="hidden fail narrativesResponce">Narrative unsuccessfully saved</p>
            </section>
        </main>
    </section>
    <script src="client.js"></script>
	<script src='results.js'> </script>
	<script src='assessments.js'> </script>
	<script src='narratives.js'> </script>
	<script src='outcomes.js'> </script>
	<script src='section.js'> </script>
</body>
</html>
