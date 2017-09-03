<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!--Bootstrap-->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link data-require="bootstrap-css@3.2.0" data-semver="3.2.0" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!--css,js-->
    <script src="js\jquery-1.11.2.min.js"></script>
    <script src="js\jquery.bxslider.min.js"></script>
    <script>
        $( function () {
            var mySlider = $( '#slide_banner' ).bxSlider( {
                mode: 'horizontal',// 가로 방향 수평 슬라이드
                speed: 500,        // 이동 속도를 설정
                pager: false,      // 현재 위치 페이징 표시 여부 설정
                moveSlides: 1,     // 슬라이드 이동시 개수
                minSlides: 1,      // 최소 노출 개수
                maxSlides: 1,      // 최대 노출 개수
                slideMargin: 5,    // 슬라이드간의 간격
                auto: true,        // 자동 실행 여부
                autoHover: true,   // 마우스 호버시 정지 여부
                controls: false    // 이전 다음 버튼 노출 여부
            } );

           //이전 버튼을 클릭하면 이전 슬라이드로 전환
            $( '#prevBtn' ).on( 'click', function () {
                mySlider.goToPrevSlide();  //이전 슬라이드 배너로 이동
                return false;              //<a>에 링크 차단
            } );

           //다음 버튼을 클릭하면 다음 슬라이드로 전환
            $( '#nextBtn' ).on( 'click', function () {
                mySlider.goToNextSlide();  //다음 슬라이드 배너로 이동
                return false;
            } );
        } );
    </script>
    <script  type="text/javascript">
    function asdfclick(ele) {
      var form = document.createElement("form");
      var type = document.createElement("input");
      var date = document.createElement("input");
      var classroom = document.createElement("input");
      var classtime = document.createElement("input");

      var url = window.location.href.replace("#info_classroom","") + "#info_classroom";

      form.method = "POST";
      form.action = url;

      type.value=ele.dataset.type;
      type.name="type";
      form.appendChild(type);

      date.value=ele.dataset.date;
      date.name="date";
      form.appendChild(date);

      classroom.value=ele.dataset.classroom;
      classroom.name="classroom";
      form.appendChild(classroom);

      classtime.value=ele.dataset.classtime;
      classtime.name="classtime";
      form.appendChild(classtime);

      document.body.appendChild(form);

      form.submit();
    }
    </script>

    <style type="text/css">

            .wrapper::after {
                content: "";
                display: block;
                clear: both;
            }
            h3.title3 {
                color: #555;
                font-family: sans-serif;
                margin-left: 40px;
                margin-top: 20px;
                position: relative;
            }
            h3.title4 {
                color: #555;
                font-family: sans-serif;
                margin-left: 30px;
                margin-top: 20px;
                position: relative;
            }
            h3.title3:after {
                width: 96%;
                height: 2px;
                content: " ";
                bottom: -10px;
                background: #555;
                position: absolute;
                margin-left: 0px;
                margin-right: 20px;
                align-items: stretch;
            }
            h3.title4:after {
                width: 92%;
                height: 2px;
                content: " ";
                bottom: -10px;
                background: #555;
                position: absolute;
                margin-left: -100px;
                margin-right: 20px;
            }
            .tb1 {table-layout: fixed; border-collapse: collapse; margin-left: 20px; margin-top: 20px; font-family: sans-serif; font-weight: bold; font-style: #555; text-align: center;}
            .tb1 tr, .tb1 td {border: 1px #555 solid; width: 50px; height: 30px}
            .table-responsive {padding: 35px;}
            .hoverTable:hover {background-color: #98DDFF;}

            .box3 {float: left; width: 65%;}
            .box4 {float: right; width: 25%;}

        @media screen and (max-width: 1000px) {
          #left_box, #right_box {float: none; width: 100%;}
        }
    </style>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	 <script>
		$( function() {
			$( "#datepicker" ).datepicker();
		} );
	  </script>
</head>
<body>
    <div class="wrapper">
        <div class="box0" style="height: 115px;">
            <div class="logo">
                <img src="logo.png" style="width: auto; height: 80px; margin-top: 20px; margin-left: 45px">
            </div>
        </div>
        <div class="box1">
            <div class="bx-wrapper" style="max-width: 100%; margin: 0px auto;">
               <div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height:500px;">
                   <ul id="slide_banner">
                       <li><img src="6-05-01.jpg"></li>
                       <li><img src="6-05-02.jpg" alt=""></li>
                       <li><img src="6-05-03.jpg" alt=""></li>
                       <li><img src="6-05-04.jpg" alt=""></li>
                   </ul>
                   <a href='#' class='slider_nav prev'></a>
                   <a href='#' class='slider_nav next'></a>
               </div>
            </div>
        </div>
        <div class="box2" style="min-height: 60px;">
        </div>

        <div class="box3" id="left_box" style="border: solid 8px #555; margin-left: 45px; margin-bottom: 40px;">
            <h3 class="title3">
				<form action="http://www.naver.com">
					예약 현황&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="text" id="datepicker"/>
					<input type="submit" value="이동">
				</form>
			</h3>
            <div style="overflow: auto;">
                <div style="overflow-x: auto; white-space: nowrap;">
<?php
  // include_once('json.php');

  $conn = mysqli_connect("db.noverish.me","noverish","1q2w3e4r!!","dbnoverish");

  if(mysqli_connect_errno()) {
    echo("Failed to connect MySQL: ".mysqli_connect_error());
  }

  mysqli_query($conn, "SET CHARACTER SET utf8");

  $now = new DateTime();

  for($i = 0; $i < 7; $i++, $now->add(new DateInterval('P1D'))) {
    if(date("w", $now->getTimestamp()) % 7 == 0)
      continue;

    echo("<div style=\"display: inline-block; min-height: 506px;\">");
    echo("<table class=\"tb1\">");

    $sql="SELECT * FROM Classtime ORDER BY time ASC";
    $result=mysqli_query($conn, $sql);
    if(!$result) {
      echo(mysql_error());
      die();
    }
    $classtimeNum = mysqli_num_rows($result);

    echo("<tr style=\"background-color: #555; color: white;\" ><td colspan=\"".($classtimeNum+1)."\">".$now->format('Y-m-d')."</td></tr>");
    echo("<tr><td></td>");

    while($row = mysqli_fetch_assoc($result)) {
      echo("<td>".$row["Time"]."교시</td>");
    }

    echo("</tr>");

    $sql2="SELECT * FROM Classroom ORDER BY Classroom ASC";
    $result2=mysqli_query($conn, $sql2);
    if(!$result2) {
      echo(mysql_error());
      die();
    }
    $classroomNum = mysqli_num_rows($result2);

    $order = 0;
    $rowToClassroom = array();
    $classroomToRow = array();
    while($row = mysqli_fetch_assoc($result2)) {
      $rowToClassroom[$order] = $row["Classroom"];
      $classroomToRow[$row["Classroom"]] = $order;
      $order++;
    }

    $status = array();
    for($a = 0; $a < $classroomNum; $a++) {
      $status[$a] = array();
      for($b = 0; $b < $classtimeNum; $b++) {
        $status[$a][$b] = 0;
      }
    }

    $sql1="SELECT * FROM Status WHERE (date(Date) = date('".$now->format('Y-m-d')."'))";
    $result1=mysqli_query($conn,$sql1);
    if(!$result1) {
      echo(mysql_error());
      die();
    }

    while($row = mysqli_fetch_assoc($result1)) {
      $type = $row["Type"] + 1;
      $a = $classroomToRow[$row["Classroom"]];
      $b = $row["Classtime"] - 1;
      try {
        $status[$a][$b] = $type;
      } catch (Exception $e) {
        echo($a." ".$b." ".$c);
      }
    }

    for($a = 0; $a < $classroomNum; $a++) {
      echo("<tr>");
      echo("<td>".$rowToClassroom[$a]."</td>");
      for($b = 0; $b < $classtimeNum; $b++) {
        if($status[$a][$b] == 0) {
          echo("<td class=\"hoverTable\" bgcolor=\"#FFFFFF\"></td>");
        } else if($status[$a][$b] == 1) {
          echo("<td class=\"hoverTable\" bgcolor=\"#7A929E\" data-type=\"0\" data-classroom=\"$rowToClassroom[$a]\" data-classtime=\"".($b+1)."\" data-date=\"".$now->format('Y-m-d')."\" onclick=\"asdfclick(this)\"></td>");
        } else if($status[$a][$b] == 2) {
          echo("<td class=\"hoverTable\" bgcolor=\"#CD5C5C\" data-type=\"1\" data-classroom=\"$rowToClassroom[$a]\" data-classtime=\"".($b+1)."\" data-date=\"".$now->format('Y-m-d')."\" onclick=\"asdfclick(this)\"></td>");
        }
      }
      echo("</tr>");
    }


    echo("</table>");
    echo("</div>");
  }
?>
                </div>
            </div>
        </div>
        <div class="box4" id="right_box"  style="border: solid 8px #555; min-height: 600px; margin-right: 45px; margin-bottom: 40px;">
            <h3 class="title4">대관 정보</h3>
            <div class="table-responsive">
                <table class="table table-inverse">
                    <tbody>
                        <tr>
                            <th>이름</th>
                            <td id="info_name">
                            <?php
                              $type = $_POST["type"];
                              $date = $_POST["date"];
                              $classroom = $_POST["classroom"];
                              $classtime = $_POST["classtime"];

                              $sql = "SELECT * FROM Status WHERE (Type='$type') AND (date(Date) = date('$date')) AND (Classroom='$classroom') AND (Classtime='$classtime')";
                              $result = mysqli_query($conn, $sql);
                              if($result)
                                $row = mysqli_fetch_assoc($result);

                              if($result)
                                echo($row["UserName"]);
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <th>연락처</th>
                            <td id="info_contact"><?php if($result) echo($row["Contact"]) ?></td>
                        </tr>
                        <tr>
                            <th>예약 내용</th>
                            <td id="info_content"><?php if($result) echo($row["Content"]) ?></td>
                        </tr>
                        <tr>
                            <th>날짜</th>
                            <td id="info_date"><?php if($result) echo($row["Date"]) ?></td>
                        </tr>
                        <tr>
                            <th>강의실</th>
                            <td id="info_classroom"><?php if($result) echo($row["Classroom"]) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
