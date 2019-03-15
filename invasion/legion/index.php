<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>군단 침공 시간표</title>
 </head>
 <body>
<?
/*
순서:
1. 아즈스나 -> 2. 발샤라 -> 3. 스톰하임 -> 4. 아즈스나 -> 5. 높은산 -> 6. 스톰하임 -> 7. 높은산 -> 8. 발샤라 -> 9. 아즈스나 -> 10. 스톰하임 -> 11. 발샤라 -> 12. 높은산

지속시간: 6시간
쿨타임: 18시간 30분
*/

//기본 로테이션 Array

$location = array(
	1 => "아즈스나",
	2 => "발샤라",
	3 => "스톰하임",
	4 => "아즈스나",
	5 => "높은산",
	6 => "스톰하임",
	7 => "높은산",
	8 => "발샤라",
	9 => "아즈스나",
	10 => "스톰하임",
	11 => "발샤라",
	12 => "높은산",
	);

// 기준 시작시간

$seedDateTimeStr = "2019-01-01 12:00:00";
$seedIndex = 10;

$termHours = "6 hours";
$coolTimeHours = $termHours + 12 . " hours 30 minutes";

$currYear = date('Y',strtotime($seedDateTimeStr));
$currMonth = date('m',strtotime($seedDateTimeStr));

$nowYear = date('Y');
$nowMonth = date('m');
$nowDay = date('d');

$week = array("일","월","화","수","목","금","토");

echo "<h1>&quot;군단&quot; &lt;침공&gt; 시간표</h1>";
echo "<h4>6시간 지속, 12시간 30분 후 팝업</h4>";
echo "<h5>1. 아즈스나 -> 2. 발샤라 -> 3. 스톰하임 -> 4. 아즈스나 -> 5. 높은산 -> 6. 스톰하임 -> 7. 높은산 -> 8. 발샤라 -> 9. 아즈스나 -> 10. 스톰하임 -> 11. 발샤라 -> 12. 높은산</h5>";

// 1000 건 루프

for($i = 0; $i < 1000; $i++) {
	if(empty($startDateTime)) {
		$startDateTime = new DateTime($seedDateTimeStr, timezone_open("Asia/Seoul"));
		$endDateTime = new DateTime($seedDateTimeStr, timezone_open("Asia/Seoul"));

		$nextSeedTime = new DateTime($seedDateTimeStr, timezone_open("Asia/Seoul"));

	} else {
		$startDateTime = new DateTime($nextSeedDateTimeStr, timezone_open("Asia/Seoul"));
		$endDateTime = new DateTime($nextSeedDateTimeStr, timezone_open("Asia/Seoul"));

		$nextSeedTime = new DateTime($nextSeedDateTimeStr, timezone_open("Asia/Seoul"));

	}

	if($beforeYear . $beforeMonth != $currYear . $currMonth){
		if($nowYear . $nowMonth != $currYear . $currMonth){
			echo sprintf("<br /><b>[[ %s년 %s월 ]]</b><br />", $currYear, $currMonth);
		} else {
			echo sprintf("<br /><b><font style='color:#CD2714'>[[ %s년 %s월 ]]</font></b><br />", $currYear, $currMonth);
		}
	}

	$beforeYear = date('Y',strtotime(date_format($startDateTime, "Y-m-d H:i:s")));
	$beforeMonth = date('m',strtotime(date_format($startDateTime, "Y-m-d H:i:s")));
	$beforeDay = date('d',strtotime(date_format($startDateTime, "Y-m-d H:i:s")));

	$endDateTime->modify("+{$termHours}");

	$startWeek = $week[date('w',strtotime(date_format($startDateTime, "Y-m-d H:i:s")))];
	$endWeek = $week[date('w',strtotime(date_format($endDateTime, "Y-m-d H:i:s")))];

	if($beforeYear . $beforeMonth . $beforeDay != $nowYear . $nowMonth . $nowDay){
		echo sprintf("%s(%s) ~ %s(%s) [%s]<br />", date_format($startDateTime, "Y-m-d H:i:s"), $startWeek, date_format($endDateTime, "Y-m-d H:i:s"), $endWeek, $location[$seedIndex]);
	} else {
		echo sprintf("<b><font style='color:#CD2714'>%s(%s) ~ %s(%s) [%s]</font></b><br />", date_format($startDateTime, "Y-m-d H:i:s"), $startWeek, date_format($endDateTime, "Y-m-d H:i:s"), $endWeek, $location[$seedIndex]);
	}

	$seedIndex++;

	if($seedIndex > count($location)) {
		$seedIndex = 1;
	}

	$nextSeedTime->modify("+{$coolTimeHours}");

	$nextSeedDateTimeStr = date_format($nextSeedTime, "Y-m-d H:i:s");

	$currYear = date('Y',strtotime($nextSeedDateTimeStr));
	$currMonth = date('m',strtotime($nextSeedDateTimeStr));

}
?>
 </body>
</html>