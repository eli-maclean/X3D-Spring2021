<?php 
session_start();
require_once("../dbcontroller.php");
$db_handle = new DBController();
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Brain Assembly X3D Model</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script type='text/javascript' src='https://www.x3dom.org/download/x3dom.js'></script>
		<link rel='stylesheet' type='text/css' href='css/main.css'/>
		<link rel='stylesheet' type='text/css' href='https://www.x3dom.org/download/x3dom.css'/>
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
														<td class=wrf><a class=wrf title="" href="">Previous</a></td>
														<td class=wrf><a class=wrf title="" href="../decomposable.php"> Decomposable Home </a></td>
														<td class=wrf> <div class="dropdown"> <a class=wrt href=../decomposable.php> Decomposable Models</a> 
																				<div class="dropdown-content">
                                                                                <?php $product_array = $db_handle->runQuery("SELECT * FROM models where type = 'decomposable'");
                                                                    if (!empty($product_array)) {
                                                                                //foreach($product_array as $key=>$value){ <--uncomment this to iterate through product_array
                                                                                        ?>
																							<!--change $product_array[0]["x3d-loc"] back to $product_array[$key]["x3d-loc"]...-->
                                                                                            <div class="titlename">
                                                                                                <form action="brain.php" method = "get">
                                                                                                    <input type="hidden" name="x3d-loc"  value="<?php echo $product_array[0]["x3d-loc"]; ?>">
                                                                                                    <input type="hidden" name="name"  value="<?php echo $product_array[0]["name"]; ?>">
                                                                                                    <input type="submit" value="<?php echo $product_array[0]["name"]; ?>">
                                                                                                </form>
																							</div>
																							<!--the following section needs to be deleted once this page is set up to dynamically generate like basic and volumetric-->
																							<div class="titlename">
                                                                                                <form action="skull.php" method = "get">
                                                                                                    <input type="hidden" name="x3d-loc"  value="<?php echo $product_array[1]["x3d-loc"]; ?>">
                                                                                                    <input type="hidden" name="name"  value="<?php echo $product_array[1]["name"]; ?>">
                                                                                                    <input type="submit" value="<?php echo $product_array[1]["name"]; ?>">
                                                                                                </form>
                                                                                            </div><?php
                                                                                                                    //}
                                                                                                                }?>
                                                                                </div>
                                                                        </div>
																		</td>
																		<td class=wrf><a class=wrf title="" href="skull.php">Next</a></td>
																	</tr>
																</table>
															</center>
														</td>
													</tr>
												</table>
										
				<center>
				<h2 style="color: white;"><?php echo $_GET["name"];?></h2>
				<hr>
				<table class=mouseTable> 
					<table class=mouseTable> 
						<tr>
							<td>
								<div class="center">
									<div class="topbar2">
										<h4 style>Mouse Controls:</h4>
											<table class=mouseTable>
											<tr> <td class=mouseTable> <img src="MouseImages/Mouse_Left.png"></img>Rotate</td>
											<td class=mouseTable> <img src="MouseImages/Mouse_Right.png"></img>Zoom</td>
											<td class=mouseTable> <img src="MouseImages/Mouse_Wheel_Scroll.png"></img>Zoom</td>
											<td class=mouseTable> <img src="MouseImages/Mouse_Wheel_Press.png"></img>Pan</td></tr>
										</table>
									</div>
									<div class="maxwrap">
										<div class="x3d">
											<x3d id="decomposableScene">
												<scene onload="onLoad()">
													<Background skyColor='(.067,.067,.067)'></Background>
													<Inline nameSpaceName="Brain" mapDEFToID="true" url="x3d/Brain/Brain_nocompression.x3d"></Inline>
												</scene>
											</x3d>
										</div>  
									</div>
									<div class="sidebar">
										<h5>Brain (Anterior Aspect):</h5>
										<p>Explode all button and sliders not working(Work-in-Progress)</p>
										<center><input type="button" id="explode" onclick="modAll(100, false)" value="Explode All"><input type="button" id="reset" onclick="modAll(0, true)" value="Reset All"><input type="button" id="reset" onclick="disableAll(-1)" value="Disable All"></center>
										<h5>Frontal (Left)</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="frontalLBoolean" onchange="updateFrontalL()" value="enabled" checked>
											<label for="frontalLBoolean">Enabled</label>
											<input type="button" id="frontalLInverse" onclick="disableAll(0)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range" name="slider" min="0" max="100" value="0" class="slider" id="frontalLSlider" onchange="updateFrontalL()" class="slider">
											<label id="frontalLPercentage" class="percentage">0%</label>
										</div>
										<h5>Frontal (Right)</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="frontalRBoolean" onchange="updateFrontalR()" value="enabled" checked>
											<label for="frontalRBoolean">Enabled</label>
											<input type="button" id="frontalRInverse" onclick="disableAll(1)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range" name="slider" min="0" max="100" value="0" class="slider" id="frontalRSlider" onchange="updateFrontalR()" class="slider">
											<label id="frontalRPercentage" class="percentage">0%</label>
										</div>
										<h5>Parietal (Left)</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="parietalLBoolean" onchange="updateParietalL()" value="enabled" checked>
											<label for="parietalLBoolean">Enabled</label>
											<input type="button" id="parietalLInverse" onclick="disableAll(2)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range"  name="slider" min="0" max="100" value="0" class="slider" id="parietalLSlider" onchange="updateParietalL()" class="slider">
											<label id="parietalLPercentage" class="percentage">0%</label>
										</div>
										<h5>Parietal (Right)</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="parietalRBoolean" onchange="updateParietalR()" value="enabled" checked>
											<label for="parietalRBoolean">Enabled</label>
											<input type="button" id="parietalRInverse" onclick="disableAll(3)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range"  name="slider" min="0" max="100" value="0" class="slider" id="parietalRSlider" onchange="updateParietalR()" class="slider">
											<label id="parietalRPercentage" class="percentage">0%</label>
										</div>
										<h5>Cerebral</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="cerebralBoolean" onchange="updateCerebral()" value="enabled" checked>
											<label for="cerebralBoolean">Enabled</label>
											<input type="button" id="cerebralInverse" onclick="disableAll(4)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range"  name="slider" min="0" max="100" value="0" class="slider" id="cerebralSlider" onchange="updateCerebral()" class="slider">
											<label id="cerebralPercentage" class="percentage">0%</label>
										</div>
										<h5>Stem</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="stemBoolean" onchange="updateStem()" value="enabled" checked>
											<label for="stemBoolean">Enabled</label>
											<input type="button" id="stemInverse" onclick="disableAll(5)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range"  name="slider" min="0" max="100" value="0" class="slider" id="stemSlider" onchange="updateStem()" class="slider">
											<label id="stemPercentage" class="percentage">0%</label>
										</div>
										<h5>Temporal (Left)</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="temporalLBoolean" onchange="updateTemporalL()" value="enabled" checked>
											<label for="temporalLBoolean">Enabled</label>
											<input type="button" id="temporalLInverse" onclick="disableAll(6)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range"  name="slider" min="0" max="100" value="0" class="slider" id="temporalLSlider" onchange="updateTemporalL()" class="slider">
											<label id="temporalLPercentage" class="percentage">0%</label>
										</div>
										<h5>Temporal (Right)</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="temporalRBoolean" onchange="updateTemporalR()" value="enabled" checked>
											<label for="temporalRBoolean">Enabled</label>
											<input type="button" id="temporalRInverse" onclick="disableAll(7)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range"  name="slider" min="0" max="100" value="0" class="slider" id="temporalRSlider" onchange="updateTemporalR()" class="slider">
											<label id="temporalRPercentage" class="percentage">0%</label>
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
	<script>
		var mf = 0.18;
		
		function modAll(val, flag)
		{
			// Combined reset and explode function
			var a = document.getElementsByName("enabler");
			var b = document.getElementsByName("slider");
			var i;
			for (i = 0; i < a.length; i++) {
				if (flag)
					a[i].checked = true;
				b[i].value = val;
			} 
			updateAll();
		}
		function updateAll()
		{
			// Updates all Parts in X3D
			updateTemporalL();
			updateTemporalR();
			updateParietalR();
			updateParietalL();
			updateFrontalL();
			updateFrontalR();
			updateCerebral();
			updateStem();
			
		}
		function disableAll(exception)
		{
			// Disables all checkboxes
			var a = document.getElementsByName("enabler");
			for (i = 0; i < a.length; i++) {
				a[i].checked = false;
			}
			
			// Checks to see if any checkboxes should be renabled based on argument
			switch(exception) {
				case 0:
					document.getElementById("frontalLBoolean").checked = true;
					break;
				case 1:
					document.getElementById("frontalRBoolean").checked = true;
					break;
				case 2:
					document.getElementById("parietalLBoolean").checked = true;
					break;
				case 3:
					document.getElementById("parietalRBoolean").checked = true;
					break;
				case 4:
					document.getElementById("cerebralBoolean").checked = true;
					break;
				case 5:
					document.getElementById("stemBoolean").checked = true;
					break;
				case 6:
					document.getElementById("temporalLBoolean").checked = true;
					break;
				case 7:
					document.getElementById("temporalRBoolean").checked = true;
					break;
				default:
			} 
			// Checks to see what checkboxes are checked to disable all but supplied argument
			updateAll();
		}
		// Update Functions foreach Part
		function updateFrontalR()
		{
			var c = document.getElementById("frontalRBoolean");
			var p = document.getElementById("frontalRPercentage");
			var s = document.getElementById("frontalRSlider");
			var xt = document.getElementById("Brain__Frontal_R_0");
			//var xs = document.getElementById("Skull__Slider_Move_74");
			
			updatePart(c, p, s, xt, mf);
		}
		function updateFrontalL()
		{
			var c = document.getElementById("frontalLBoolean");
			var p = document.getElementById("frontalLPercentage");
			var s = document.getElementById("frontalLSlider");
			var xt = document.getElementById("Brain__Frontal");
			//var xs = document.getElementById("Skull__Slider_Move_74");
			
			updatePart(c, p, s, xt, mf);
		}
		function updateParietalL()
		{
			var c = document.getElementById("parietalLBoolean");
			var p = document.getElementById("parietalLPercentage");
			var s = document.getElementById("parietalLSlider");
			var xt = document.getElementById("Brain__Pariet");
			//var xs = document.getElementById("Skull__Slider_Move_64");
			
			updatePart(c, p, s, xt, mf);
		}
		function updateParietalR()
		{
			var c = document.getElementById("parietalRBoolean");
			var p = document.getElementById("parietalRPercentage");
			var s = document.getElementById("parietalRSlider");
			var xt = document.getElementById("Brain__Pariet_L");
			//var xs = document.getElementById("Skull__Slider_Move_86");
			
			updatePart(c, p, s, xt, mf);
		}
		function updateCerebral()
		{
			var c = document.getElementById("cerebralBoolean");
			var p = document.getElementById("cerebralPercentage");
			var s = document.getElementById("cerebralSlider");
			var xt = document.getElementById("Brain__Cereb");
			//var xs = document.getElementById("Skull__Slider_Move_127");
			
			updatePart(c, p, s, xt, mf);
		}
		function updateStem()
		{
			var c = document.getElementById("stemBoolean");
			var p = document.getElementById("stemPercentage");
			var s = document.getElementById("stemSlider");
			var xt = document.getElementById("Brain__Stem");
			//var xs = document.getElementById("Skull__Slider_Move_153");
			
			updatePart(c, p, s, xt, mf);
		}
		function updateTemporalL()
		{
			var c = document.getElementById("temporalLBoolean");
			var p = document.getElementById("temporalLPercentage");
			var s = document.getElementById("temporalLSlider");
			var xt = document.getElementById("Brain__Temp");
			//var xs = document.getElementById("Skull__Slider_Move_112");
			
			updatePart(c, p, s, xt, mf);
		}
		function updateTemporalR()
		{
			var c = document.getElementById("temporalRBoolean");
			var p = document.getElementById("temporalRPercentage");
			var s = document.getElementById("temporalRSlider");
			var xt = document.getElementById("Brain__Temp_R");
			//var xs = document.getElementById("Skull__Slider_Move_101");
			
			updatePart(c, p, s, xt, mf);
		}
		function updatePart(c, p, s, xt, mf) {
            var af = s.value;
            af = (mf/100)*af;
            p.innerHTML = (s.value) + '%';
            if (c.checked == true) {
                xt.setAttribute('render', true);
            }
            else {
                xt.setAttribute('render', false);
            }
        }
		//function updatePart(c, p, s, xt, xs, mf) {
			//var af = s.value;
			//af = (mf/100)*af;
			//p.innerHTML = (s.value) + '%';
			//xs.setAttribute('translation', "0 " + af + " 0");
			//if (c.checked == true) {
			//	xt.setAttribute('render', true);
			//}
			//else {
			//	xt.setAttribute('render', false);
			//}
		//}
	</script>
</html>