<?php 
session_start();
require_once("../dbcontroller.php");
$db_handle = new DBController();
$id = $_GET["id"];
$model_row = $db_handle->runQuery("SELECT * FROM models where id = $id");
$mysqli = $db_handle->connectDB();
?>
<html>
	
	<head>
		<meta charset="utf-8">
		<title>Abdomen Volumetric Render</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<!-- <script type='text/javascript' src='https://www.x3dom.org/download/x3dom.js'></script>-->
		<link rel='stylesheet' type='text/css' href='css/main.css'/>
		<!-- <link rel='stylesheet' type='text/css' href='https://www.x3dom.org/download/x3dom.css'/>-->

	    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge"/>
	    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
	    <meta charset="utf-8"/>
	    <meta name="author" content="Don Brutzman"/>
	    <meta name="generator"
	            content="https://www.web3d.org/x3d/tools/CreateContentCatalog/CreateContentCatalogPages.xslt"/>
	    <meta name="modified" content="2020-01-07-08:00"/>
	    <!-- X_ITE developer site: https://create3000.de/x_ite -->
	    <link rel="stylesheet" type="text/css" href="https://code.create3000.de/x_ite/latest/dist/x_ite.css"/>
	    <script type="text/javascript" src="https://code.create3000.de/x_ite/latest/dist/x_ite.min.js"></script>
	</head>
	<body>
	<center>
		<table class=mpg>
            <tr>
                <td style="border: 0px solid #FFFFFF;">
                    <center>
                        <table class="title" cellpadding="20">
                            <tr>
                                <td>
                                    <center>
                                        <table class=wrt>
                                            <tr>
													<td class=wrf><?php                                 // Back button 
                                                        $back = mysqli_query($mysqli,"SELECT * FROM models WHERE id<$id AND type = 'volume' order by id DESC");
                                                        if($row = mysqli_fetch_array($back))
                                                            {
                                                                echo '<a class=wrf title="" href="volume2.php?id='.$row['id'].'">Back</a>';  
                                                            } else {
                                                                echo '<a class=wrf title="" href="">Back</a>';
                                                            }
                                                    ?></td>
                                                    <td class=wrf><a class=wrf title="" href="../volume.php"> Volumetric Home </a></td>
                                                    <td class=wrf> 
                                                        <div class="dropdown"> 
                                                            <a class=wrt href=../volume.php> Volumetric Models</a>
                                                            <div class="dropdown-content">
                                                                <?php $dd_list = $db_handle->runQuery("SELECT * FROM models where type = 'volume'");
                                                                    if (!empty($dd_list)) {
                                                                        foreach($dd_list as $key=>$value){
                                                                             ?>
                                                                                <div class="titlename">
                                                                                    <form action="volume2.php" method = "get">
                                                                                        <input type="hidden" name="id"  value="<?php echo $dd_list[$key]["id"]; ?>">
                                                                                        <input type="submit" value="<?php echo $dd_list[$key]["name"]; ?>">
                                                                                    </form>
                                                                                </div>
                                                                <?php
                                                                            
                                                                        }
                                                                    } 
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </td>
													<td class=wrf><?php                                 // Next button 
                                                        $next = mysqli_query($mysqli,"SELECT * FROM models WHERE id>$id AND type = 'volume' order by id ASC");
                                                        if($row = mysqli_fetch_array($next))
                                                            {
                                                                echo '<a class=wrf title="" href="volume2.php?id='.$row['id'].'">Next</a>';  
                                                            } else {
                                                                echo '<a class=wrf title="" href="">Next</a>';
                                                            }
                                                    ?></td>
                                            </tr>
                                        </table>
                                    </center>
                                </td>
                            </tr>
                        </table>
                
                        <center>
                        <h2 style="color: white;"><?php echo $model_row[0]["name"];?></h2>
                        <hr>
                        <table class=mouseTable> 
                            <table class=mouseTable> 
                                <tr>
                                    <td>
										<div class="center">
                                        <div class="desktop-topbar" id=”content-desktop”>
												<h4 style>Mouse Controls:</h4>
													<table class=mouseTable>
													<tr> <td class=mouseTable> <img src="MouseImages/Mouse_Left.png"></img>Rotate</td>
													<td class=mouseTable> <img src="MouseImages/Mouse_Right.png"></img>Menu</td>
													<td class=mouseTable> <img src="MouseImages/Mouse_Wheel_Scroll.png"></img>Zoom</td>
													<td class=mouseTable> <img src="MouseImages/Mouse_Wheel_Press.png"></img>Pan</td></tr>
												</table>
                                            </div>
                                            <div class="mobile-topbar" id=”content-mobile”>
                                                <h2>Touch Controls:</h2>
                                                <table class=fingerTable id="fingerTable">
                                                    <tr> 
                                                        <td class=fingerTable> <img src="FingerImages/zoomin.jpg"></img>Zoom in</td>
                                                        <td class=fingerTable> <img src="FingerImages/zoomout.jpg"></img>Zoom out</td>
                                                        <td class=fingerTable> <img src="FingerImages/onefinger.jpg"></img>Rotate</td>
                                                        <td class=fingerTable> <img src="FingerImages/twofinger.jpg"></img>Pan</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="maxwrap">
                                                <div class="x3dbasic">
                                                    <X3DCanvas id="x3dScene" src="<?php echo $model_row[0]["x3d-loc"];?>">
                                                        <p>Your browser may not support all features required by X_ITE.
                                                        For a better experience, keep your browser up to date.
                                                        <a href="http://outdatedbrowser.com">Check here for latest versions.</a></p>
                                                    </X3DCanvas>
                                                </div>  
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </center>
                        <br/>
                        <center>
                            <table class=title>
                                <tr>
                                    <td style="border: 5px solid #FFFFFF;">
                                        <center>
                                            <i>
                                                <div style="margin-bottom: 12px">@ 2020 Prof. Felix G. Hamza-Lup</i>
                                                    <img style="position: relative; top: 6.5px;" src=../thumbnails/team/gslo.png></img>
                                                </div>
                                        </center>
                                    </td>
                                </tr>
                            </table>
                        </center>    
                        <br/>
                    </center>
                </td>
            </tr>
        </table>
    </center>
    <br/>
	</body>
</html>
