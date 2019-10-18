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
  left : 1030px;
  top : 105px;
  width : 250px;
  padding-left : 10px;
  padding-top : 20px;
  border-radius : 20px;
  border : .1px solid;
  border-color: #b4ccce #b3c0c8 #9eb9c2;
  box-shadow : 10px 10px 5px #aaa;
}
input[type=submit] {
  padding: 0 18px;
  height: 29px;
  font-size: 12px;
  font-weight: bold;
  color: #527881;
  text-shadow: 0 1px #e3f1f1;
  background: white;
  border: 2px solid;
  border-color: #b4ccce #b3c0c8 #9eb9c2;
  border-radius: 16px;
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
input
{
padding: 5px;
font-family : "Comic Sans MS", cursive, sans-serif;
border: 2px solid;
border-radius : 5px;
border-color : #b4ccce #b3c0c8 #9eb9c2;
}
.redmessage
{
color : red;
}
.dropdown
{
left : 900px;
}
.user
{
position : absolute;
left : 730px;
top : 30px;
font-family : "Comic Sans MS", cursive, sans-serif;
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
	    	<p class = "user"><?php 
				if(isset($_SESSION["username"])){
					$display = "none";
					echo "Hi ". $_SESSION["message"]; //check how it is viewed in diff. page
					
					//echo "	"."<a href=\"logout_process.php\">Log Out</a>";
					}else{
					$display = "block";
				}
	        ?></p>
		<ul id="drop-nav"  class = "dropdown">
							<li><?php 
				if(isset($_SESSION["username"])){
					$display = "none";
					//echo $_SESSION["message"]; //check how it is viewed in diff. page
					
					echo "	"."<a href=\"logout_process.php\">Log Out</a>";
					}else{
					$display = "block";
				}
			?></li>
			<li><a href="about.php">About Us</a></li>
			<li><a href="contact.php">Contact Us</a></li>
		</ul>
<!---------------------------------------------------------------------------------------->

<!--------------------------------------Divider-------------------------------------------->
<img src = "divider.jpg" class = "divider">
<!----------------------------------------------------------------------------------------->

<!--------------------------------------For the image slide slow-------------------------->
<div id="jssor_1" style="position: absolute; margin: 0 auto; top: 103px; left: 210px; width: 600px; height: 300px; overflow: hidden; visibility: hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 600px; height: 300px; overflow: hidden;">
            <div data-p="112.50" style="display: none;">
                <img data-u="image" src="img/01.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="image" src="img/02.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="image" src="img/03.jpg" />
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="image" src="img/04.jpg" />
            </div>
		    <div data-p="112.50" style="display: none;">
                <img data-u="image" src="img/05.jpg" />
            </div>
			<div data-p="112.50" style="display: none;">
                <img data-u="image" src="img/06.jpg" />
            </div>
            <a data-u="ad" href="http://www.jssor.com" style="display:none">Bootstrap Slider</a>
        
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
            <!-- bullet navigator item prototype -->
            <div data-u="prototype" style="width:16px;height:16px;"></div>
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora12l" style="top:0px;left:0px;width:30px;height:46px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora12r" style="top:0px;right:0px;width:30px;height:46px;" data-autocenter="2"></span>
    </div>
    <script>
        jssor_1_slider_init();
    </script>

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
				<a>
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
				<a href="explore.php">
					<strong>Explore Database</strong>
				</a>
			</li>
			
			<?php 
				if(isset($_SESSION["username"])){
					echo "<li> <a href=\"update.php\"><strong>Update Database</strong></a> </li>";
					
					echo "<li> <a href=\"which_crop_to_plant.php\"><strong>Which Crop To Plant</strong></a> </li>";
					echo "<li> <a href=\"view_graph.php\"><strong>View Graph</strong></a> </li>";
					
				}else{
				
					echo "<li> <a href=\"registration.php\"><strong>Registration</strong><small>To become a member</small></a> </li>";
				}
			
			?>
		</ul>
	</nav>
</div>
<!---------------------------------------------------------------------------------------->


<!--------------------------------For log in---------------------------------------------->
		
		<div class = "login" id="login_box" style="display:<?php echo $display ?>">
			<form action="login_process.php" method="post">				
				Username:
                <p><input type="text" name="username" value="" placeholder="Username or Email"></p>
				Password:
                <p><input type="password" name="password" value="" placeholder="Password"></p>
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
			<p>not a member <a href = "registration.php" style="text-decoration:none">sign up</a> here</p>
			<p>click here to login as <a href = "adlog.php" style="text-decoration:none">admin</a></p>
		</div>
		<!---------------------------------------------------------------------------------------->

<!--------------------------------Paragraph----------------------------------------------->
<p class = "paragraph">
Write something about our websitWrite something about our websitWrite something about our websitWrite something about our websitWrite something about our websit
Write something about our websitWriteWrite something about our websitWrite something about our websitWrite something about our websitWrite something about our websit
Write something about our websitWrite something about our websitWrite something about our websitWrite something about our websitWrite something about our websit
Write something about our websitWrite something about our websitWrite something about our websitWrite something about our websit
Write something about our websitWrite something about our websitWrite something about our websitWrite something about our websit
Write something about our websitWrite something about our websitWrite something about our websitWrite something about our websitWrite something about our websit
Write something about our websitWrite something about our websitWrite something about our websitWrite something about our websitWrite something about our websit
Write something about our websitWrite something about our websit
Write something about our websitWrite something about our websitWrite something about our websitWrite something about our websit</p>
<!---------------------------------------------------------------------------------------->


</body>
</html>