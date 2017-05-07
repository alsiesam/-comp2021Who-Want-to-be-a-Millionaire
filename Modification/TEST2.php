#!/usr/local/bin/php
<!DOCTYPE html>
<html>
<?php           //prepare information for question
$chance=0;
$question = array();
$answer =  array();
$choiceA = array();
$choiceB = array();
$choiceC = array();
$choiceD = array();
$myfile = fopen("question.txt", "r") or die("Unable to open file!");
while(!feof($myfile)) {
    array_push($question,trim(fgets($myfile)));
}
fclose($myfile);
$myfile = fopen("Ans.txt", "r") or die("Unable to open file!");
while(!feof($myfile)) {
    array_push($answer,trim(fgets($myfile)));
}
fclose($myfile);
$myfile = fopen("choiceA.txt", "r") or die("Unable to open file!");
while(!feof($myfile)) {
    array_push($choiceA,trim(fgets($myfile)));
}
fclose($myfile);
$myfile = fopen("choiceB.txt", "r") or die("Unable to open file!");
while(!feof($myfile)) {
    array_push($choiceB,trim(fgets($myfile)));
}
fclose($myfile);
$myfile = fopen("choiceC.txt", "r") or die("Unable to open file!");
while(!feof($myfile)) {
    array_push($choiceC,trim(fgets($myfile)));
}
fclose($myfile);
$myfile = fopen("choiceD.txt", "r") or die("Unable to open file!");
while(!feof($myfile)) {
    array_push($choiceD,trim(fgets($myfile)));
}
fclose($myfile);
?>
<?php
if(!isset($_COOKIE[score])){
setcookie(score, 0, time() + (86400 * 30), "/");
}
?>
<?php               //answer validation 
    if (isset($_POST['end'])){
        setcookie(score, 0, time() + (86400 * 30), "/");
        header("Refresh:0");
    }
    if(isset($_POST['btn'])){
        //echo "Your answer is ".$answer[$_COOKIE['score']]."<br>";
        //echo "Post is ".$_POST['btn']."<br>";
        $ans = $answer[$_COOKIE['score']];
        $post = $_POST['btn'];
        $size = count($answer)-1;
     if (!($_COOKIE['score']<$size)){
         echo "
            <script type=\"text/javascript\">
            alert(\"Done\");
            </script>
        ";
         header("Location: finish.html");
        exit;
        }
      if ($ans == $post){
          //echo "post0 is" . $_POST['btn'];
        setcookie(score, $_COOKIE['score']+1, time() + (86400 * 30), "/");
        if ($_COOKIE[score]==$size){
            setcookie(score, 0, time() + (86400 * 30), "/");
          echo "
            <script type=\"text/javascript\">
            alert(\"DoneDONE\");
            </script>
        ";
        header("Refresh:0");
        }
        $_POST['btn']='';
        //echo "post is" . $_POST['btn'];
        header("Refresh:0");
      }else {
          setcookie(score, 0, time() + (86400 * 30), "/");
          echo "
            <script type=\"text/javascript\">
            alert(\"Game overrrr\");
            </script>
        ";
        header("Refresh:0");
      }
     }
  ?>
  <?php
  if(isset($_POST['50'])){ 
      $msg = "The answer are ";
      $a=0; $b=0;$c=0;$d=0;
      if ($choiceA[$_COOKIE[score]]==$answer[$_COOKIE['score']]){
          $a=1;
      }
      if ($choiceB[$_COOKIE[score]]==$answer[$_COOKIE['score']]){
          $b=1;
      }
      if ($choiceC[$_COOKIE[score]]==$answer[$_COOKIE['score']]){
          $c=1;
      }
      if ($choiceD[$_COOKIE[score]]==$answer[$_COOKIE['score']]){
          $d=1;
      }
		$choice = array("A","B","C","D");
		echo "<script> alert(\"There are two possible answer left.\\n\")</script>";
	  	if($a=1)
		{
		array_splice($choice,0,1);
		$random = rand(0,count($choice)-1);
		$random_choice = $choice[$random];
		switch($random_choice)
		{
			case "B": echo "<script> alert(\"A: ".$choiceA[$_COOKIE[score]]."\\nB: ".$choiceB[$_COOKIE[score]]."\")</script>"; break;
			case "C": echo "<script> alert(\"A: ".$choiceA[$_COOKIE[score]]."\\nC: ".$choiceC[$_COOKIE[score]]."\")</script>"; break;
			case "D": echo "<script> alert(\"A: ".$choiceA[$_COOKIE[score]]."\\nD: ".$choiceD[$_COOKIE[score]]."\")</script>"; break;
		}
		}
		if($b=1)
		{
		array_splice($choice,1,1);
		$random = rand(0,count($choice)-1);
		$random_choice = $choice[$random];
		switch($random_choice)
		{
			case "A": echo "<script> alert(\"A: ".$choiceA[$_COOKIE[score]]."\\nB: ".$choiceB[$_COOKIE[score]]."\")</script>"; break;
			case "C": echo "<script> alert(\"B: ".$choiceB[$_COOKIE[score]]."\\nC: ".$choiceC[$_COOKIE[score]]."\")</script>"; break;
			case "D": echo "<script> alert(\"B: ".$choiceB[$_COOKIE[score]]."\\nD: ".$choiceD[$_COOKIE[score]]."\")</script>"; break;
		}
		}
		if($c=1)
		{
		array_splice($choice,2,1);
		$random = rand(0,count($choice)-1);
		$random_choice = $choice[$random];
		switch($random_choice)
		{
			case "A": echo "<script> alert(\"A: ".$choiceA[$_COOKIE[score]]."\\nC: ".$choiceC[$_COOKIE[score]]."\")</script>"; break;
			case "B": echo "<script> alert(\"B: ".$choiceB[$_COOKIE[score]]."\\nC: ".$choiceC[$_COOKIE[score]]."\")</script>"; break;
			case "D": echo "<script> alert(\"C: ".$choiceC[$_COOKIE[score]]."\\nD: ".$choiceD[$_COOKIE[score]]."\")</script>"; break;
		}
		}
		if($d=1)
		{
		array_splice($choice,3,1);
		$random = rand(0,count($choice)-1);
		$random_choice = $choice[$random];
		switch($random_choice)
		{
			case "A": echo "<script> alert(\"A: ".$choiceA[$_COOKIE[score]]."\\nD: ".$choiceD[$_COOKIE[score]]."\")</script>"; break;
			case "B": echo "<script> alert(\"B: ".$choiceB[$_COOKIE[score]]."\\nD: ".$choiceD[$_COOKIE[score]]."\")</script>"; break;
			case "C": echo "<script> alert(\"C: ".$choiceC[$_COOKIE[score]]."\\nD: ".$choiceD[$_COOKIE[score]]."\")</script>"; break;
		}
		}
	
  }
  ?>
  <?php
  		$random_prob = rand(30,100);
		$choice = array("A","B","C","D");
		if($random_prob > 50){
			$random2=rand(50,100);
			if(isset($_POST['friends'])){ 
			if ($choiceA[$_COOKIE[score]]==$answer[$_COOKIE['score']]){
			echo "<script>alert(\"Friend: I think the answer is A. \\nI am ".$random2."% sure about that.\")</script>";
			}
			if ($choiceB[$_COOKIE[score]]==$answer[$_COOKIE['score']]){
			echo "<script>alert(\"Friend: I think the answer is B. \\nI am ".$random2."% sure about that.\")</script>";
			}
			if ($choiceC[$_COOKIE[score]]==$answer[$_COOKIE['score']]){
			echo "<script>alert(\"Friend: I think the answer is C. \\nI am ".$random2."% sure about that.\")</script>";
			}
			if ($choiceD[$_COOKIE[score]]==$answer[$_COOKIE['score']]){
			echo "<script>alert(\"Friend: I think the answer is D. \\nI am ".$random2."% sure about that.\")</script>";
			}
			}
		}
		else{
			$random2=rand(1,50);
			if ($choiceA[$_COOKIE[score]]==$answer[$_COOKIE['score']]){
			array_splice($choice,0,1);
			}
			if ($choiceB[$_COOKIE[score]]==$answer[$_COOKIE['score']]){
			array_splice($choice,1,1);
			}
			if ($choiceC[$_COOKIE[score]]==$answer[$_COOKIE['score']]){
			array_splice($choice,2,1);
			}
			if ($choiceD[$_COOKIE[score]]==$answer[$_COOKIE['score']]){
			array_splice($choice,3,1);
			}
			$random = rand(0,count($choice)-1);
			echo "<script>alert(\"Friend: I think the answer is ".$choice[$random].". \\nI am ".$random2."% sure about that.\")</script>";
		}
  ?>
  <?php
  if(isset($_POST['call'])){ 
  echo "<script> alert(\"According to the statistics from the results of the voting system,\\nthe audiences think the answer would be like this.\")</script>";
    $ans_prob = 50+rand(0,30);
	$notans1_prob = round((100-$ans_prob)*lcg_value());
	$notans2_prob = round((100-$ans_prob-$notans1_prob)*lcg_value());
	$notans3_prob = 100-$ans_prob-$notans1_prob-$notans2_prob;
	$probs = array($notans1_prob,$notans2_prob,$notans3_prob);
      if ($choiceA[$_COOKIE[score]]==$answer[$_COOKIE['score']]){
          echo "<script> alert(\"A: ".$choiceA[$_COOKIE[score]]." ".$ans_prob."%\")</script>";
      }else{
		$random3=rand(0,count($probs)-1);
		$notanswer_prob=$probs[$random3];
        echo "<script> alert(\"A: ".$choiceA[$_COOKIE[score]]." ".$notanswer_prob."%\")</script>";
		array_splice($probs,$random3,1);
      }
      if ($choiceB[$_COOKIE[score]]==$answer[$_COOKIE['score']]){
        echo "<script> alert(\"B: ".$choiceB[$_COOKIE[score]]." ".$ans_prob."%\")</script>";
      }else{
		$random3=rand(0,count($probs)-1);
		$notanswer_prob=$probs[$random3];
        echo "<script> alert(\"B: ".$choiceB[$_COOKIE[score]]." ".$notanswer_prob."%\")</script>";
		array_splice($probs,$random3,1);
      }
      if ($choiceC[$_COOKIE[score]]==$answer[$_COOKIE['score']]){
        echo "<script> alert(\"C: ".$choiceC[$_COOKIE[score]]." ".$ans_prob."%\")</script>";
      }else{
		$random3=rand(0,count($probs)-1);
		$notanswer_prob=$probs[$random3];
        echo "<script> alert(\"C: ".$choiceC[$_COOKIE[score]]." ".$notanswer_prob."%\")</script>";
		array_splice($probs,$random3,1);
      }if ($choiceD[$_COOKIE[score]]==$answer[$_COOKIE['score']]){
        echo "<script> alert(\"D: ".$choiceD[$_COOKIE[score]]." ".$ans_prob."%\")</script>";
      }else{
		$random3=rand(0,count($probs)-1);
		$notanswer_prob=$probs[$random3];
        echo "<script> alert(\"D: ".$choiceD[$_COOKIE[score]]." ".$notanswer_prob."%\")</script>";
		array_splice($probs,$random3,1);
      }
  }
  ?>
  <head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/test.css">
  </head>
  <body>
  <div class="container">
  <h1>Who wants to be a XUE BA?</h1>
  </div>
  
  <div class="container" style="width:500px;">
  <center>
        <div class="game">
            <div class="top">
            <div class="tools">
            <center>
           
           <form name="tool" id="t"  method="POST"  >
                    <input class="choice2" type="submit" name="50" value="50"autofocus  onclick="return true"/>
                    <input type="submit" name="call" class="choice2"  value="CALL"autofocus  onclick="return true"/>
                    <input type="submit" name="friends" class="choice2"  value="FRIEND"autofocus  onclick="return true"/>
                    </form>
                    </center>
                </div>
            <div class="question">
                    <?php echo $question[$_COOKIE['score']];?>
                </div>
                
                <!--<div class="judges">
                    <img src="tonychan-cartoon2_300.png" width="230">
                </div>-->
                
            </div>
            <div class="bottom">
                <div class="progress">
                   GPA: <?php echo $_COOKIE['score']*4.3/count($answer);?>
                </div>
                <form name="testForm" id="testForm"  method="POST"  >
     <input class="choice" id ="A" type="submit" name="btn" value="<?php echo $choiceA[$_COOKIE['score']]?>" autofocus  onclick="return true;"/>
     <input class="choice" id ="B" type="submit" name="btn" value="<?php echo $choiceB[$_COOKIE['score']]?>" autofocus  onclick="return true;"/>
     <input class="choice" id ="C" type="submit" name="btn" value="<?php echo $choiceC[$_COOKIE['score']]?>" autofocus  onclick="return true;"/>
    <input class="choice" id ="D" type="submit" name="btn" value="<?php echo $choiceD[$_COOKIE['score']]?>" autofocus  onclick="return true;"/>
    <!-- <input class="choice" type="submit" name="end"  autofocus  onclick="return true;"/>-->
 </form>
                <!--<button class="choice">A</button>
                <button class="choice" onclick="myFunction()">B</button>
                <button class="choice">C</button>
                <button class="choice">D</button>-->
                </form>
            </div>
        </div>
    </center>
                
  </div>
  </body>
  </html>