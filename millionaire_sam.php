<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="bootstrap.css">
        <link rel="stylesheet" type="text/css" href="millionaire.css">
    </head>
    <body>
        <center>
        <div class="game">
		<?php 
		//for($q_no = 0; $q_no < 15; $q_no++){ 
		$q_no = 0;
            echo'<div class="top">';
                echo'<div class="tools">';
                    echo'<button href="#"> 50 </button>';
                    echo'<button href="#"> call </button>';
                    echo'<button href="#"> friends </button>';
                echo'</div>';
                echo'<div class="judges">';
                    echo'<img src="tonychan-cartoon2_300.png" width="230">';
                echo'</div>';
                echo'<div class="question">';
				
					$questions = array("Question 1. What is the full name of HKUST?",
								"Question 2. How many LGs are there in the campus?",
								"Question 3. Which of the schools does not belong to HKUST?",
								"Question 4. How many storeys are there in the Library?",
								"Question 5. What is the location of Golden Rice Bowl?",
								"Question 6. Where is the location of Barn D?",
								"Question 7. What is my name?",
								"Question 8. Where should I go if I want to go to Clear Water Bay by bus?",
								"Question 9. What is the official name of the sundial located at the entrance?",
								"Question 10. How many lectures theatres are there in campus?",
								"Question 11. What is the year of establishment of HKUST?",
								"Question 12. What is the name of the Student Association of UG HALL I?",
								"Question 13. Which of the facilities is not included in the Atrium?",
								"Question 14. What is the approximate amount of print volumes in the Library?",
								"Question 15. What is the full name of this course COMP2021?");
					echo $questions[$q_no];
				
                echo'</div>';
            echo'</div>';
            echo'<div class="bottom">';
                echo'<div class="progress">';
                    echo'GPA score bar';
                echo'</div>';
				
					$choiceA = array("Hong Kong University of Stress and Tension",
					"3",
					"School of Business and Management",
					"4",
					"LG1",
					"Lee Shau Kee Business Building",
					"Lee Shau Kee",
					"North Gate",
					"Turkey",
					"10",
					"1998",
					"House One",
					"Hair Salon",
					"940000",
					"Unix Programming");
					$choiceB = array("Hong Kong University of So and That",
					"4",
					"School of Laws",
					"5",
					"LG4",
					"Tang Shiu Kin Computational Laboratory",
					"Lo Ka Chung",
					"East Gate",
					"Redbird",
					"8",
					"1995",
					"Vista",
					"Lift 15",
					"710000",
					"Unix and Script Programming");
					$choiceC = array("Hong Kong University of Science and Technology",
					"6",
					"School of Humanities and Social Science",
					"6",
					"LG5",
					"Room 4402-4404",
					"Cheng Yu Tung",
					"South Gate",
					"Phoenix",
					"12",
					"1991",
					"Endeavour",
					"Souvenir Shop",
					"620000",
					"Unix and Perl Programming");
					$choiceD = array("Hong Kong University of Single and Toxic",
					"7",
					"School of Engineering",
					"7",
					"LG7",
					"Room 4578-4580",
					"Chan Fan Cheong",
					"West Gate",
					"Chicken",
					"9",
					"1989",
					"Glacier",
					"Lecture Theatre K",
					"830000",
					"Younext and Shecrip Programming");
					
					$answer = array($choiceC[0],$choiceD[1],$choiceB[2],$choiceB[3],$choiceD[4],
					$choiceA[5],$choiceD[6],$choiceA[7],$choiceB[8],$choiceA[9],
					$choiceC[10],$choiceA[11],$choiceD[12],$choiceB[13],$choiceB[14]);
					
					echo"<input class=\"choice\" type=\"button\" value=\"$choiceA[$q_no]\" name=\"A\" onclick=\"checkans()\">";
					echo'<br>';
					echo"<input class=\"choice\" type=\"button\" value=\"$choiceB[$q_no]\" name=\"A\" onclick=\"checkans()\">";
					echo'<br>';
					echo"<input class=\"choice\" type=\"button\" value=\"$choiceC[$q_no]\" name=\"A\" onclick=\"checkans()\">";
					echo'<br>';
					echo"<input class=\"choice\" type=\"button\" value=\"$choiceD[$q_no]\" name=\"A\" onclick=\"checkans()\">";
					echo'<br>';
					
				if (!function_exists('checkans'))   {
				function checkans()
				{
					$finalchoice = $_POST["A"];
					/*
					if (!empty($_POST["choice"])) {
						$finalchoice = test_input($_POST["choice"]);
					}
					function test_input($data) {
					$data = trim($data);
					$data = stripslashes($data);
					$data = htmlspecialchars($data);
					return $data;}			
					*/
				if($finalchoice == $answer[$q_no]){echo "correct";/*continue;*/}
				else{echo "incorrect"; /*break;*/}
				}
				}
            echo'</div>';
		//}
		?>
        </div>
        </center>
    </body>
</html>