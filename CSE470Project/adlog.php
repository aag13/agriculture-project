<?php 
	
	session_start();
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
Home Page
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href = "dropdown_for_all.css" rel = "stylesheet" type = "text/css">
<link href = "dropdown_for_index.css" rel = "stylesheet" type = "text/css"> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type = "text/css">
/*Divider class*/
.divider
{
position : absolute;
top : 90px;
width : 1320px;
}
/*End of divider class*/

/*For image slider*/

.jssorb05
{
position: absolute;
}
.jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
position: absolute;
width: 16px;
height: 16px;
background: url('img/b05.png') no-repeat;
overflow: hidden;
cursor: pointer;
}
.jssorb05 div { background-position: -7px -7px; }
.jssorb05 div:hover, .jssorb05 .av:hover { background-position: -37px -7px; }
.jssorb05 .av { background-position: -67px -7px; }
.jssorb05 .dn, .jssorb05 .dn:hover { background-position: -97px -7px; }
.jssora12l, .jssora12r {
display: block;
position: absolute;
width: 30px;
height: 46px;
cursor: pointer;
background: url('img/a12.png') no-repeat;
overflow: hidden;
}
.jssora12l { background-position: -16px -37px; }
.jssora12r { background-position: -75px -37px; }
.jssora12l:hover { background-position: -136px -37px; }
.jssora12r:hover { background-position: -195px -37px; }
.jssora12l.jssora12ldn { background-position: -256px -37px; }
.jssora12r.jssora12rdn { background-position: -315px -37px; }

/*End of image slider CSS code*/

/*For log in*/
.login
{
  background-color : white;
  position : absolute;
  font-size : 20px;
  left : 200px;
  top : 105px;
  width : 300px;
  padding-left : 25px;
  padding-top : 30px;
  border-radius : 20px;
  border : .1px solid;
  border-color: #b4ccce #b3c0c8 #9eb9c2;
  box-shadow : 10px 10px 5px #aaa;
}
input[type=submit] {
  padding: 0 18px;
  height: 29px;
  font-size: 15px;
  font-weight: bold;
  color: #527881;
  text-shadow: 0 1px #e3f1f1;
  background: white;
  border: 2px solid;
  border-color: #b4ccce #b3c0c8 #9eb9c2;
  border-radius: 16px;
}
input
{
padding: 5px;
font-family : "Comic Sans MS", cursive, sans-serif;
border: 2px solid;
border-radius : 5px;
border-color : #b4ccce #b3c0c8 #9eb9c2;
}
/*End of log in*/

/*For the paragraph*/
.paragraph
{
position : relative;
top : 500px;
left : 210px;
width : 1000px;
text-align : justify;
font-size : 14px;
font-family : tahoma;
}
/*End of paragraph*/
.redmessage
{
color : red;
}
</style>

<script type="text/javascript" src="js/jssor.slider.min.js"></script>
    <!-- use jssor.slider.debug.js instead for debug -->
    <script>
        jssor_1_slider_init = function() {
            
            var jssor_1_SlideshowTransitions = [
              {$Duration:1200,$Opacity:2}
            ];
            
            var jssor_1_options = {
              $AutoPlay: true,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };
            
            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 800);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            //responsive code end
        };
    </script>

</head>
<body background = "back.jpg" class = "bodyboxing">

<!--------------------------------------DROP DOWN MENU BAR-------------------------------->
    <a href="index.php" class = "sitename">agroSOFT</a>
    <ul id="drop-nav"  class = "dropdown">
	<li><?php 
				if(isset($_SESSION["username"])){
					
					echo $_SESSION["message"]; //check how it is viewed in diff. page
					echo "	"."<a href=\"logout_process.php\">Log Out</a>";
				}
?></li>
    <li><a href = "about.php">About Us</a></li>
    <li><a href = "contact.php">Contact Us</a></li>
    </ul>
<!---------------------------------------------------------------------------------------->

<!--------------------------------------Divider-------------------------------------------->
<img src = "divider.jpg" class = "divider">
<!----------------------------------------------------------------------------------------->


<!---------------------------------------------------------------------------------------->

<!--------------------------------For log in---------------------------------------------->
<div class = "login" id="login_box" style="display:<?php echo $display ?>">
			<form action="admin_login_process.php" method="post">
				Admin Email:
                <p><input type="text" name="username" value="" placeholder="Username or Email" size = "25px"></p>
				Password:
                <p><input type="password" name="password" value="" placeholder="Password" size = "25px"></p>
				<p class="submit"><input type="submit" name="submit" value="Login"></p>
				<p class = "redmessage">
				<?php 
					
					if(!isset($_SESSION["username"]) && isset($_SESSION["message"])){
						echo $_SESSION["message"];
						unset($_SESSION["message"]);
					}
				?>
				</p>
			</form>
		</div>
		<!---------------------------------------------------------------------------------------->


<!--------------------------------Container Class----------------------------------------->
<div class="container">
<nav>
		<ul class="mcd-menu">
			<li>
				<a href="index.php" class="active">
					<strong>Home</strong>
					<small>agroSOFT</small>
				</a>
			</li>
			<li>
				<a href="#">
					<strong>Division</strong>
					<small>Select division</small>
				</a>
				<ul>
					<li><a href="dhaka.php">Dhaka</a></li>
					<li><a href="chittagong.php">Chittagong</a></li>
					<li><a href="rajshahi.php">Rajshahi</a></li>
					<li><a href="khulna.php">Khulna</a></li>
					<li><a href="barisal.php">Barisal</a></li>
					<li><a href="rangpur.php">Rangpur</a></li>
					<li><a href="sylhet.php">Sylhet</a></li>
					<li><a href="mymensingh.php">Mymensingh</a></li>
				</ul>
			</li>
			<li>
				<a href="bangladesh.php">
					<strong>Bangladesh</strong>
					<small>Total production</small>
				</a>
			</li>
			<li>
				<a href="registration.php">
					<strong>Registration</strong>
					<small>To become a member</small>
				</a>
			</li>
		</ul>
	</nav>
</div>
<!---------------------------------------------------------------------------------------->

<div class = "end">
<p>type something to fill up this section </p>
</div><!--end of end-->

</body>
</html>