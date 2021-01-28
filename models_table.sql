--create table statement
CREATE TABLE `models` (
  `id` int(10) NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `thumbnail` varchar(100) DEFAULT NULL,
  `adr` varchar(100) DEFAULT NULL,
  `x3d-loc` varchar(100) DEFAULT NULL,
  `type` varchar(12) DEFAULT NULL,
  `disabled` varchar(6) NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--dump table data
--changes to id numbers on this page must be applied to sources_table.sql as well 
INSERT INTO `models` (`id`,`name`,`thumbnail`,`adr`,`x3d-loc`,`type`) VALUES
 (0,"Brain","thumbnails/brain.png","modelpages/brain.php","x3d/Brain/Brain_nocompression.x3d","decomposable"),
 (1,"Skull","thumbnails/skull.png","modelpages/skull.php","x3d/Skull/skullAssembly_noscript.x3d","decomposable"),
 (2,"Body Skin","thumbnails/bodyskin.png","","x3d/BodySkin/BodySkinIndexedFaceSetNIST.x3d","basic"),
 (3,"Chest","thumbnails/chest.png","","x3d/Chest/BonesChest.x3d","basic"),
 (4,"Left Femur","thumbnails/femurleft.png","","x3d/FemurLeft/BonesLeftFemur.x3d","basic"),
 (5,"Right Femur","thumbnails/femurright.png","","x3d/FemurRight/BonesRightFemur.x3d","basic"),
 (6,"Left Foot","thumbnails/footleft.png","","x3d/FootLeft/BonesLeftFoot.x3d","basic"),
 (7,"Right Foot","thumbnails/footright.png","","x3d/FootRight/BonesRightFoot.x3d","basic"),
 (8,"Girdle","thumbnails/girdle.png","","x3d/Girdle/BonesGirdle.x3d","basic"),
 (9,"Left Hand","thumbnails/handleft.png","","x3d/HandLeft/BonesLeftHand.x3d","basic"),
 (10,"Right Hand","thumbnails/handright.png","","x3d/HandRight/BonesRightHand.x3d","basic"),
 (11,"Head","thumbnails/head.png","","x3d/Head/BonesHead.x3d","basic"),
 (12,"Left Humerus","thumbnails/humerusleft.png","","x3d/HumerusLeft/BonesLeftHumerus.x3d","basic"),
 (13,"Right Humerus","thumbnails/humerusright.png","","x3d/HumerusRight/BonesRightHumerus.x3d","basic"),
 (14,"Left Radius/Ulna","thumbnails/radiusulnaleft.png","","x3d/RadiusUlnaLeft/BonesLeftRadiusUlna.x3d","basic"),
 (15,"Right Radius/Ulna","thumbnails/radiusulnaright.png","","x3d/RadiusUlnaRight/BonesRightRadiusUlna.x3d","basic"),
 (16,"Skeleton","thumbnails/skeleton.png","","x3d/Skeleton/BonesAllSkeleton.x3d","basic"),
 (17,"Top Teeth","thumbnails/teethupper.jpg","","x3d/TeethTop/BonesTeethTop.x3d","basic"),
 (18,"Bottom Teeth","thumbnails/teethlower.jpg","","x3d/TeethBottom/BonesTeethBottom.x3d","basic"),
 (19,"Left Tibia/Fibula","thumbnails/tibiafibulaleft.png","","x3d/TibiaFibulaLeft/BonesLeftTibiaFibula.x3d","basic"),
 (20,"Right Tibia/Fibula","thumbnails/tibiafibularight.png","","x3d/TibiaFibulaRight/BonesRightTibiaFibula.x3d","basic"),
 (21,"Maxillary","thumbnails/Maxillary.png","","x3d/Maxillary/Maxillary.x3d","basic"),
 (22,"Heart and Kidney","thumbnails/heartkidney.png","","x3d/Heartkidney/HeartKidney.x3d","basic"),
 (23,"Mandibular","thumbnails/mandibular.png","","x3d/Mandibular/Mandibular.x3d","basic"),
 (24,"Mandible","thumbnails/mandable.png","","x3d/Mandible/BonesMandible.x3d","basic"),
 (25,"Spine","thumbnails/spine.png","","x3d/Spine/BonesSpine.x3d","basic"),
 (26,"Aorta Aneurism","thumbnails/aortaaneurism.png","","x3d/Aneurism of Ascending Aort/Ascending_Aort_Aneurism_Nevit_Dilmen.x3d","basic"),
 (27,"Covid 19","thumbnails/covid19.png","","x3d/Covid 19/Covid 19.x3d","basic"),
 (28,"Horseshoe Kidney","thumbnails/horseshoekidney.png","","x3d/Horseshoe Kidney/Horseshoe Kidney.x3d","basic"),
 (29,"Pulmonary Atresia","thumbnails/pulmonaryatresia.png","","x3d/Pulmonary atresia with ventricular septal defect/CM0024_BP_0.x3d","basic"),
 (30,"Kypho-Scoliosis","thumbnails/kypho-scoliosis.png","","x3d/Severe congenital kypho-scoliosis/V2_Spinal Lumbar_T10_L2.x3d","basic"),
 (31,"Skull and Neck","thumbnails/skullandneck.png","","x3d/Skull and Neck/ALM0019.x3d","basic"),
 (32,"Respiratory System","thumbnails/respiratorysystem.png","","x3d/RespiratorySystem/RespiratorySystem.x3d","basic"),
 (33,"Volumetric Abdomen","thumbnails/abdomenvol.png","","x3d/abdomen_volume/BasicAbdomen.x3d","volume"),
 (34,"Volumetric Body","thumbnails/bodyvol.png","","x3d/body_volume/BasicBody.x3d","volume"),
 (35,"Volumetric Brain","thumbnails/brainvol.png","","x3d/brain_volume/BasicBrain.x3d","volume"),
 (36,"Volumetric Skull","thumbnails/skullvol.png","","x3d/skull_volume/BasicSkull.x3d","volume");