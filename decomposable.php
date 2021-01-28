<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
?>
<html>
	<head>
		<script type="text/javascript" src="//code.jquery.com/jquery-1.7.1.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>
						<link rel='stylesheet' type='text/css' href='modelpages/css/main.css'/>
		<title>3D Models</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
<center>
            <table class=mpf>
                <tr>
                    <td style="border: 0px solid #FFFFFF;">
                        <center>
                            <table class="title" cellpadding="20">
                                <tr>
                                    <td>
                                        <center><h1>X3D Based Systems for Neuroanatomy Exploration and Medical Training</h1></center><h4 >Ver. 1.1</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <center>
                                            <table class=wrt>
                                                <tr>
                                                    <td class=wrf><a class=wrf href=3dmodels.php>Model Types</a></td>
                                                    <td class=wrf><a class=wrf href=basic.php>Basic 3D Models</a></td>
                                                    <td class=wrf><a class=wrf href=decomposable.php>Decomposable 3D Models</a></td>
                                                    <td class=wrf><a class=wrf href=volume.php>Volumetric 3D Models</a></td>
                                                </tr>
                                            </table>
                                        </center>
                                    </td>
                                </tr>
                            </table>
							
              <center>
                        <h2 style="color: white;">Decomposable 3D Models</h2>
                        <hr>
                        <table style="width:80%"> <!--model grid-->
                                    <tr>
                                        <center><h3 style="color: white;"><i>Click on a model to view</i></h3><center>
                                        <div class="allcategories">
                                            <?php $product_array = $db_handle->runQuery("SELECT * FROM models where type = 'decomposable'");
                                                if (!empty($product_array)) {
                                                    foreach($product_array as $key=>$value){
                                                        
                                                            ?><div class="cell">
                                                                <div class="thumbnail">
                                                                    <img src="<?php echo $product_array[$key]["thumbnail"]; ?>">
                                                                </div>
                                                                <div class="titlename">
                                                                    <form action= <?php echo $product_array[$key]["adr"]; ?> method = "get">
                                                                        <input type="hidden" name="x3d-loc"  value="<?php echo $product_array[$key]["x3d-loc"]; ?>">
                                                                        <input type="hidden" name="name"  value="<?php echo $product_array[$key]["name"]; ?>">
                                                                        <input type="hidden" name="type"  value="<?php echo $product_array[$key]["type"]; ?>">
                                                                        <input type="submit" value="<?php echo $product_array[$key]["name"]; ?>">
                                                                    </form>
                                                                </div>
                                                            </div>
                                            <?php
                                                        
                                                    }
                                                }
                                            ?>
                                        </div>

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
                                                    <img style="position: relative; top: 6.5px;" src=thumbnails/team/gslo.png></img>
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