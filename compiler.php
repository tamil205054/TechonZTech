<?php
if(isset($_POST['code']))
{
	$code=$_POST['code'];
	$lang=$_POST['lang'];
	if($lang=="java")
	{
		$array=array();
		$result='';
		$myfile = fopen("Main.java", "w");
		fwrite($myfile, $code);
		fclose($myfile);
		exec("javac Main.java");
		exec("java Main",$array,$out);
		// exec(2,$array,$out);
		// echo $out;
		echo json_encode($array);
		// unlink("Main.java");
		// unlink("Main.class");
	}
	elseif($lang=="python")
	{
		$myfile=fopen("Main.py","w");
		fwrite($myfile,$code);
		fclose($myfile);
		$result=exec("python Main.py");
		echo json_encode($result);
		unlink("Main.py");
	}
}
?>