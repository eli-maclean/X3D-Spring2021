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
														<td class=wrf><a class=wrf title="" href=brain.php>Previous</a></td>
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
														<td class=wrf><a class=wrf title="" href="">Next</a></td>
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
								<div class="center2">
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
													<Inline nameSpaceName="Skull" mapDEFToID="true" url="x3d/Skull/skullAssembly_noscript.x3d"></Inline>
												</scene>
											</x3d>
										</div>
									</div>
									<div class="sidebar2">
										<h5>SKULL (anterior aspect):</h5>
										<center><input type="button" id="explode" onclick="modAll(100, false)" value="Explode All"><input type="button" id="reset" onclick="modAll(0, true)" value="Reset All"><input type="button" id="reset" onclick="disableAll(-1)" value="Disable All"></center>
										<h5>Frontal</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="frontalBoolean" onchange="updateFrontal()" value="enabled" checked>
											<label for="frontalBoolean">Enabled</label>
											<input type="button" id="frontalInverse" onclick="disableAll(0)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range" name="slider" min="0" max="100" value="0" class="slider" id="frontalSlider" onchange="updateFrontal()" class="slider">
											<label id="frontalPercentage" class="percentage">0%</label>
										</div>
										<h5>Parietal (Left)</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="parietalLBoolean" onchange="updateParietalL()" value="enabled" checked>
											<label for="parietalLBoolean">Enabled</label>
											<input type="button" id="parietalLInverse" onclick="disableAll(1)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range"  name="slider" min="0" max="100" value="0" class="slider" id="parietalLSlider" onchange="updateParietalL()" class="slider">
											<label id="parietalLPercentage" class="percentage">0%</label>
										</div>
										<h5>Parietal (Right)</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="parietalRBoolean" onchange="updateParietalR()" value="enabled" checked>
											<label for="parietalRBoolean">Enabled</label>
											<input type="button" id="parietalRInverse" onclick="disableAll(2)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range"  name="slider" min="0" max="100" value="0" class="slider" id="parietalRSlider" onchange="updateParietalR()" class="slider">
											<label id="parietalRPercentage" class="percentage">0%</label>
										</div>
										<h5>Mandible</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="mandibleBoolean" onchange="updateMandible()" value="enabled" checked>
											<label for="mandibleBoolean">Enabled</label>
											<input type="button" id="mandibleInverse" onclick="disableAll(3)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range"  name="slider" min="0" max="100" value="0" class="slider" id="mandibleSlider" onchange="updateMandible()" class="slider">
											<label id="mandiblePercentage" class="percentage">0%</label>
										</div>
										<h5>Maxilla</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="maxillaBoolean" onchange="updateMaxilla()" value="enabled" checked>
											<label for="maxillaBoolean">Enabled</label>
											<input type="button" id="maxillaInverse" onclick="disableAll(4)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range"  name="slider" min="0" max="100" value="0" class="slider" id="maxillaSlider" onchange="updateMaxilla()" class="slider">
											<label id="maxillaPercentage" class="percentage">0%</label>
										</div>
										<h5>Zygomatic (Left)</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="zygomaticLBoolean" onchange="updateZygomaticL()" value="enabled" checked>
											<label for="zygomaticLBoolean">Enabled</label>
											<input type="button" id="zygomaticLInverse" onclick="disableAll(5)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range"  name="slider" min="0" max="100" value="0" class="slider" id="zygomaticLSlider" onchange="updateZygomaticL()" class="slider">
											<label id="zygomaticLPercentage" class="percentage">0%</label>
										</div>
										<h5>Zygomatic (Right)</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="zygomaticRBoolean" onchange="updateZygomaticR()" value="enabled" checked>
											<label for="zygomaticRBoolean">Enabled</label>
											<input type="button" id="zygomaticRInverse" onclick="disableAll(6)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range"  name="slider" min="0" max="100" value="0" class="slider" id="zygomaticRSlider" onchange="updateZygomaticR()" class="slider">
											<label id="zygomaticRPercentage" class="percentage">0%</label>
										</div>
										<h5>Temporal (Left)</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="temporalLBoolean" onchange="updateTemporalL()" value="enabled" checked>
											<label for="temporalLBoolean">Enabled</label>
											<input type="button" id="temporalLInverse" onclick="disableAll(7)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range"  name="slider" min="0" max="100" value="0" class="slider" id="temporalLSlider" onchange="updateTemporalL()" class="slider">
											<label id="temporalLPercentage" class="percentage">0%</label>
										</div>
										<h5>Temporal (Right)</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="temporalRBoolean" onchange="updateTemporalR()" value="enabled" checked>
											<label for="temporalRBoolean">Enabled</label>
											<input type="button" id="temporalRInverse" onclick="disableAll(8)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range"  name="slider" min="0" max="100" value="0" class="slider" id="temporalRSlider" onchange="updateTemporalR()" class="slider">
											<label id="temporalRPercentage" class="percentage">0%</label>
										</div>
										<h5>Occipital</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="occipitalBoolean" onchange="updateOccipital()" value="enabled" checked>
											<label for="occipitalBoolean">Enabled</label>
											<input type="button" id="occipitalInverse" onclick="disableAll(9)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range"  name="slider" min="0" max="100" value="0" class="slider" id="occipitalSlider" onchange="updateOccipital()" class="slider">
											<label id="occipitalPercentage" class="percentage">0%</label>
										</div>
										<h5>NotLabeled??(1)</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="slider2Boolean" onchange="updateSlider2()" value="enabled" checked>
											<label for="slider2Boolean">Enabled</label>
											<input type="button" id="slider2Inverse" onclick="disableAll(10)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range"  name="slider" min="0" max="100" value="0" class="slider" id="slider2Slider" onchange="updateSlider2()" class="slider">
											<label id="slider2Percentage" class="percentage">0%</label>
										</div>
										<h5>NotLabeled??(2)</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="slider22Boolean" onchange="updateSlider22()" value="enabled" checked>
											<label for="slider22Boolean">Enabled</label>
											<input type="button" id="slider22Inverse" onclick="disableAll(11)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range"  name="slider" min="0" max="100" value="0" class="slider" id="slider22Slider" onchange="updateSlider22()" class="slider">
											<label id="slider22Percentage" class="percentage">0%</label>
										</div>
										<h5>NotLabeled??(3)</h5>
										<div class="ctGuts">
											<input type="checkbox" name="enabler" id="slider21Boolean" onchange="updateSlider21()" value="enabled" checked>
											<label for="slider21Boolean">Enabled</label>
											<input type="button" id="slider21Inverse" onclick="disableAll(12)" style="float: right;" value="Disable All Other Parts">
											<br>
											<input type="range"  name="slider" min="0" max="100" value="0" class="slider" id="slider21Slider" onchange="updateSlider21()" class="slider">
											<label id="slider21Percentage" class="percentage">0%</label>
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
			document.getElementById("Skull__Sphenoid").setAttribute('render', true);
		}
		function updateAll()
		{
			// Updates all Parts in X3D
			updateZygomaticL();
			updateZygomaticR();
			updateTemporalL();
			updateTemporalR();
			updateOccipital();
			updateMaxilla();
			updateMandible();
			updateParietalR();
			updateParietalL();
			updateFrontal();
			updateSlider2();
			updateSlider21();
			updateSlider22();
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
					document.getElementById("frontalBoolean").checked = true;
					break;
				case 1:
					document.getElementById("parietalLBoolean").checked = true;
					break;
				case 2:
					document.getElementById("parietalRBoolean").checked = true;
					break;
				case 3:
					document.getElementById("mandibleBoolean").checked = true;
					break;
				case 4:
					document.getElementById("maxillaBoolean").checked = true;
					break;
				case 5:
					document.getElementById("zygomaticLBoolean").checked = true;
					break;
				case 6:
					document.getElementById("zygomaticRBoolean").checked = true;
					break;
				case 7:
					document.getElementById("temporalLBoolean").checked = true;
					break;
				case 8:
					document.getElementById("temporalRBoolean").checked = true;
					break;
				case 9:
					document.getElementById("occipitalBoolean").checked = true;
					break;
				case 10:
					document.getElementById("slider2Boolean").checked = true;
					break;
				case 11:
					document.getElementById("slider21Boolean").checked = true;
					break;
				case 12:
					document.getElementById("slider22Boolean").checked = true;
					break;
				default:
			} 
			// Checks to see what checkboxes are checked to disable all but supplied argument
			updateAll();
			document.getElementById("Skull__Sphenoid").setAttribute('render', false);
		}
		// Update Functions foreach Part
		function updateFrontal()
		{
			var c = document.getElementById("frontalBoolean");
			var p = document.getElementById("frontalPercentage");
			var s = document.getElementById("frontalSlider");
			var xt = document.getElementById("Skull__Frontal");
			var xs = document.getElementById("Skull__Slider_Move_74");
			
			updatePart(c, p, s, xt, xs, mf);
		}
		function updateParietalL()
		{
			var c = document.getElementById("parietalLBoolean");
			var p = document.getElementById("parietalLPercentage");
			var s = document.getElementById("parietalLSlider");
			var xt = document.getElementById("Skull__Parietal_L");
			var xs = document.getElementById("Skull__Slider_Move_64");
			
			updatePart(c, p, s, xt, xs, mf);
		}
		function updateParietalR()
		{
			var c = document.getElementById("parietalRBoolean");
			var p = document.getElementById("parietalRPercentage");
			var s = document.getElementById("parietalRSlider");
			var xt = document.getElementById("Skull__Slider_parietalR");
			var xs = document.getElementById("Skull__Slider_Move_86");
			
			updatePart(c, p, s, xt, xs, mf);
		}
		function updateMandible()
		{
			var c = document.getElementById("mandibleBoolean");
			var p = document.getElementById("mandiblePercentage");
			var s = document.getElementById("mandibleSlider");
			var xt = document.getElementById("Skull__Slider_mandible");
			var xs = document.getElementById("Skull__Slider_Move_127");
			
			updatePart(c, p, s, xt, xs, mf);
		}
		function updateMaxilla()
		{
			var c = document.getElementById("maxillaBoolean");
			var p = document.getElementById("maxillaPercentage");
			var s = document.getElementById("maxillaSlider");
			var xt = document.getElementById("Skull__Slider_maxilla");
			var xs = document.getElementById("Skull__Slider_Move_153");
			
			updatePart(c, p, s, xt, xs, mf);
		}
		function updateZygomaticL()
		{
			var c = document.getElementById("zygomaticLBoolean");
			var p = document.getElementById("zygomaticLPercentage");
			var s = document.getElementById("zygomaticLSlider");
			var xt = document.getElementById("Skull__Slider_zygomaticL");
			var xs = document.getElementById("Skull__Slider_Move_122");
			
			updatePart(c, p, s, xt, xs, mf);
		}
		function updateZygomaticR()
		{
			var c = document.getElementById("zygomaticRBoolean");
			var p = document.getElementById("zygomaticRPercentage");
			var s = document.getElementById("zygomaticRSlider");
			var xt = document.getElementById("Skull__Slider_zygomaticR");
			var xs = document.getElementById("Skull__Slider_Move_149");
			
			updatePart(c, p, s, xt, xs, mf);
		}
		function updateTemporalL()
		{
			var c = document.getElementById("temporalLBoolean");
			var p = document.getElementById("temporalLPercentage");
			var s = document.getElementById("temporalLSlider");
			var xt = document.getElementById("Skull__Temporal_L");
			var xs = document.getElementById("Skull__Slider_Move_112");
			
			updatePart(c, p, s, xt, xs, mf);
		}
		function updateTemporalR()
		{
			var c = document.getElementById("temporalRBoolean");
			var p = document.getElementById("temporalRPercentage");
			var s = document.getElementById("temporalRSlider");
			var xt = document.getElementById("Skull__Temporal_R");
			var xs = document.getElementById("Skull__Slider_Move_101");
			
			updatePart(c, p, s, xt, xs, mf);
		}
		function updateOccipital()
		{
			var c = document.getElementById("occipitalBoolean");
			var p = document.getElementById("occipitalPercentage");
			var s = document.getElementById("occipitalSlider");
			var xt = document.getElementById("Skull__Slider_occipital");
			var xs = document.getElementById("Skull__Slider_Move_93");
			
			updatePart(c, p, s, xt, xs, mf);
		}
		function updateSlider2()
		{
			var c = document.getElementById("slider2Boolean");
			var p = document.getElementById("slider2Percentage");
			var s = document.getElementById("slider2Slider");
			var xt = document.getElementById("Skull__Slider2");
			var xs = document.getElementById("Skull__Slider_Move_27");
			
			updatePart(c, p, s, xt, xs, mf);
		}
		function updateSlider21()
		{
			var c = document.getElementById("slider21Boolean");
			var p = document.getElementById("slider21Percentage");
			var s = document.getElementById("slider21Slider");
			var xt = document.getElementById("Skull__Slider2_1");
			var xs = document.getElementById("Skull__Slider_Move_36");
			
			updatePart(c, p, s, xt, xs, mf);
		}
		function updateSlider22()
		{
			var c = document.getElementById("slider22Boolean");
			var p = document.getElementById("slider22Percentage");
			var s = document.getElementById("slider22Slider");
			var xt = document.getElementById("Skull__Slider2_2");
			var xs = document.getElementById("Skull__Slider_Move_45");
			
			updatePart(c, p, s, xt, xs, mf);
		}
		
		function updatePart(c, p, s, xt, xs, mf) {
			var af = s.value;
			af = (mf/100)*af;
			p.innerHTML = (s.value) + '%';
			xs.setAttribute('translation', "0 " + af + " 0");
			if (c.checked == true) {
				xt.setAttribute('render', true);
			}
			else {
				xt.setAttribute('render', false);
			}
		}
	</script>
</html>