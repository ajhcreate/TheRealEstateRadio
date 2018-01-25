<?php
/*------------------------------------------------------------------------
# com_guru
# ------------------------------------------------------------------------
# author    iJoomla
# copyright Copyright (C) 2013 ijoomla.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.ijoomla.com
# Technical Support:  Forum - http://www.ijoomla.com.com/forum/index/
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('behavior.modal');

	$document = JFactory::getDocument();


	$document->setTitle(trim(JText::_('GURU_MYCOURSES')));
	$document->setMetaData( 'viewport', 'width=device-width, initial-scale=1.0' );
	$data_post = JFactory::getApplication()->input->post->getArray();
	
	require_once(JPATH_SITE.DIRECTORY_SEPARATOR."components".DIRECTORY_SEPARATOR."com_guru".DIRECTORY_SEPARATOR."helpers".DIRECTORY_SEPARATOR."generate_display.php");
	require_once(JPATH_BASE . "/components/com_guru/helpers/Mobile_Detect.php");
	$guruModelguruOrder = new guruModelguruOrder();
	
	function get_time_difference($start, $end){
		$uts['start'] = $start;
		$uts['end'] = $end;
		if( $uts['start'] !== -1 && $uts['end'] !== -1){
			if($uts['end'] >= $uts['start']){
				$diff = $uts['end'] - $uts['start'];
				if($days=intval((floor($diff/86400)))){
					$diff = $diff % 86400;
				}
					
				if($hours=intval((floor($diff/3600)))){
					$diff = $diff % 3600;
				}	
				
				if($minutes=intval((floor($diff/60)))){
					$diff = $diff % 60;
				}	
				$diff = intval($diff);
				return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff));
			}
			else{
				return false;
			}
		}
		return false;
	}
		
	$document = JFactory::getDocument();
	$document->addScript("components/com_guru/js/programs.js");
	$db = JFactory::getDBO();
	$user = JFactory::getUser();
	$my_courses = $this->my_courses;
	$Itemid = JFactory::getApplication()->input->get("Itemid", "0", "raw");
	$search = JFactory::getApplication()->input->get("search_course", "");
	$config = $this->getConfigSettings();
	
	$helper = new guruHelper();
	$itemid_seo = $helper->getSeoItemid();
	$itemid_seo = @$itemid_seo["guruorders"];
	
	if(intval($itemid_seo) > 0){
		$Itemid = intval($itemid_seo);
			
		$sql = "select `access` from #__menu where `id`=".intval($Itemid);
		$db->setQuery($sql);
		$db->query();
		$access = $db->loadColumn();
		$access = @$access["0"];
		
		if(intval($access) == 3){
			// special
			$user_groups = $user->get("groups");
			if(!in_array(8, $user_groups)){
				$Itemid = JFactory::getApplication()->input->get("Itemid", "0", "raw");
			}
		}
	}
	
	$sql = "Select datetype FROM #__guru_config where id=1 ";
	$db->setQuery($sql);
	$format_date = $db->loadResult();
	

	$detect = new Mobile_Detect;
	$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');	
	if($deviceType !='phone'){
		$cname= JText::_("GURU_COURSES_DETAILS");
		$class_title = 'class="guruml20"';

	}
	else{
		$cname= JText::_("GURU_DAYS_NAME");
		$class_title = 'class="guruml0"';

	}
	
	?>
    
<script type="text/javascript" language="javascript">
	document.body.className = document.body.className.replace("modal", "");
</script>
    
<script language="javascript">
	function showContentVideo(href){
		jQuery('#myModal .modal-body iframe').attr('src', href);
	}
	
	jQuery('#myModal').on('hide', function () {
		 jQuery('#myModal .modal-body iframe').attr('src', '');
	});
</script>
    <?php
	$return_url = base64_encode("index.php?option=com_guru&view=guruorders&layout=mycourses&Itemid=".intval($Itemid));
	
	if($config->gurujomsocialprofilestudent == 1){
		$link = "index.php?option=com_community&view=profile&task=edit&Itemid=".$Itemid;
	}
	else{
		$helper = new guruHelper();
		$itemid_seo = $helper->getSeoItemid();
		$itemid_seo = @$itemid_seo["guruprofile"];
		
		if(intval($itemid_seo) > 0){
			$Itemid = intval($itemid_seo);
			
			$Itemid = intval($itemid_seo);
			
			$sql = "select `access` from #__menu where `id`=".intval($Itemid);
			$db->setQuery($sql);
			$db->query();
			$access = $db->loadColumn();
			$access = @$access["0"];
			
			if(intval($access) == 3){
				// special
				$user_groups = $user->get("groups");
				if(!in_array(8, $user_groups)){
					$Itemid = JFactory::getApplication()->input->get("Itemid", "0", "raw");
				}
			}
		}
	
		$link = "index.php?option=com_guru&view=guruProfile&task=edit&Itemid=".$Itemid;
	}
	
	include_once(JPATH_SITE.DIRECTORY_SEPARATOR."components".DIRECTORY_SEPARATOR."com_guru".DIRECTORY_SEPARATOR."helpers".DIRECTORY_SEPARATOR."helper.php");
	$helper = new guruHelper();
	$div_menu = $helper->createStudentMenu();
	$page_title_cart = $helper->createPageTitleAndCart();
	
?>
<style>
.course-table{
	border:#e7e8e9 1px solid;
}

th{
	background:#21409a;
	color:#FFF;
	text-align:center!important;
	padding:15px 8px!important;
}
.uk-table td{
	text-align:center!important;
}
.guru_product_name{
		vertical-align:top!important;
}
.uk-table td, .uk-table th{
	padding:8px 0!important;
}
</style>
<div id="myModal" class="modal hide g_modal" style="display:none !important;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">
    <iframe id="g_my_course_pop" style="width:100%; height:100%; border:none;"></iframe>
    </div>
</div>

<div>
    <form action="index.php" name="adminForm" method="post">
        <?php
            echo $div_menu;
            echo $page_title_cart;
        ?>
        
        <div class="gru-page-filters">
        	<div class="gru-filter-item">
                <input type="text" class="form-control"  placeholder="<?php echo JText::_("GURU_SEARCH"); ?>" style="margin:0px;" name="search_course" value="<?php if(isset($data_post['search_course'])) echo $data_post['search_course'];?>" >
				<button class="uk-button uk-button-primary" type="submit"><?php echo JText::_("GURU_SEARCH"); ?></button>
			</div>
        </div>


<?php
	$uid = $user->id;
/*	$db->setQuery("select courses from #__guru_order where userid='$uid' and status='Paid' order by id desc");
	$cid = $db->loadColumn();
	$ctr = count($cid)-1;
	for($x=0;$x<=$ctr;$x++){
		$cID = str_replace("-0-1","",$cid[$x]);	
		$db->setQuery("select name from #__guru_program where id='$cID'");
		$topic_name = $db->loadResult();
		echo $topic_name.'<br>';
	}
	*/
?>
<table class="uk-table uk-table-striped course-table" border="1">
            <tr>
                <th class="g_cell_1">Topic Name<?php //echo $cname; ?></th>
                <th class="g_cell_2 hidden-phone">Module Name<?php //echo JText::_("GURU_COURSE_PROGRESS"); ?></th>
                <th class="g_cell_3 hidden-phone" width="300">Lesson Name<?php //echo JText::_("GURU_LAST_VISIT"); ?></th>
                <th class="g_cell_4 hidden-phone">Last Viewed<?php //echo JText::_("GURU_LAST_VISIT"); ?></th>
                <!--<th class="g_cell_5"><?php echo JText::_("GURU_RENEW"); ?></th>-->
            </tr>
            <style>
                  div.guru-content .btn_renew{
                    height:25px;!important; 
                  }
            </style>
            <?php
            $k = 0;
            $already_edited = array();
            
            foreach($my_courses as $key=>$course){
                $bool_expired = false;
                $jnow = new JDate('now');
                $date_current = $jnow->toSQL();									
                $int_current_date = strtotime($date_current);
                $no_renew = false;
                $course = (object)$course;
                
                $id = $course->course_id;
                $alias = isset($course->alias) ? trim($course->alias) : JFilterOutput::stringURLSafe($course->course_name);
                
                if(!in_array($id, $already_edited)){
                    $already_edited[] = $id;
        ?>
        <?php
			//count lessons			
			$db->setQuery("select lesson_id from #__guru_viewed_lesson where user_id='$uid' and pid='$id'");
			$less = $db->loadResult();
			$lessons = explode("|",$less);
			$lctr = count($lessons)-2;			
		?>
                <tr class="guru_row">	
                        <td class="guru_product_name g_cell_1" style="vertical-align:middle!important;">
             <?php 
			 if($lctr>=1){
				 
			 	for($z=0;$z<=$lctr;$z++){ 
					$lid = $lessons[$z];
					if($lid>0){
			 ?>           
                        <a href="<?php echo JRoute::_("index.php?option=com_guru&view=guruPrograms&task=view&cid=".$id."-".$alias."&Itemid=".$Itemid); ?>"><?php echo $course->course_name; ?></a>
                       
              <?php 
				if($z>=0 && $z!=$lctr){
					echo ' <div style="border-top:#e7e8e9 1px solid;margin-bottom:5px;margin-top:5px;height:1px;width:100%;"></div>';
				}	
				
					}//end if lid
				
			  } //end for
		}//end if >1
		else{
			  ?>          
  <a href="<?php echo JRoute::_("index.php?option=com_guru&view=guruPrograms&task=view&cid=".$id."-".$alias."&Itemid=".$Itemid); ?>"><?php echo $course->course_name; ?></a>              
        <?php } ?>      
                        
                        <?php								
                            $expire = JText::_("GURU_EXPIRES");
                            if($course->plan_name == "Unlimited" || $course->expired_date == "0000-00-00 00:00:00"){
                                $date = '<span class="guru_active">'.JText::_("GURU_UNLIMITED_PLAN").'</span>';
                                $no_renew = true;
                            }
                            else{
                                $jnow = new JDate('now');
                                $date_current = $jnow->toSQL();									
                                $int_current_date = strtotime($date_current);
                                $bool_expired = false;
                                $date_string = "";
                                if($int_current_date > strtotime($course->expired_date)){ //expired
                                    $bool_expired = true;
                                    $expire = JText::_("GURU_EXPIRED");
                                    $date_int = strtotime($course->expired_date);
                                    $date_string = "";
                                    if($config->hour_format == 24){
                                        $date_string = JHTML::_('date', $date_int, 'Y-m-d H:M:S');
                                    }
                                    elseif($config->hour_format == 12){
                                        $date_string = JHTML::_('date', $date_int, 'Y-m-d l:M:S p');
                                    }
                                    //---------------------------
                                    $difference_int = get_time_difference($date_int, $int_current_date);
                                    $difference = $difference_int["days"]." ".JText::_("GURU_REAL_DAYS");
                                    if($difference_int["days"] == 0){
                                        if($difference_int["hours"] == 0){
                                            if($difference_int["minutes"] == 0){
                                                $difference = "0";
                                            }
                                            else{
                                                $difference = $difference_int["minutes"]." ".JText::_("GURU_REAL_MINUTES")." ".JText::_("GURU_AGO");
                                            }
                                        }
                                        else{
                                            $difference = $difference_int["hours"]." ".JText::_("GURU_REAL_HOURS").", ".
                                                          $difference_int["minutes"]." ".JText::_("GURU_REAL_MINUTES")." ".JText::_("GURU_AGO");
                                        }
                                    }
                                    else{
                                        $difference = $difference_int["days"]." ".JText::_("GURU_REAL_DAYS").", ".
                                                      $difference = $difference_int["hours"]." ".JText::_("GURU_REAL_HOURS").", ".
                                                      $difference_int["minutes"]." ".JText::_("GURU_REAL_MINUTES")." ".JText::_("GURU_AGO");
                                    }
                                    $date = '<span class="guru_expired">'.$difference." (".JHTML::_('date', $date_int, 'm-d-Y').")".'</span>';
                                    //---------------------------
                                }
                                else{
                                    $bool_expired = false;
                                    $expire = JText::_("GURU_EXPIRES");
                                    $date_int = strtotime($course->expired_date);
                                    $date_string = "";
                                    if($config->hour_format == 24){
                                        $date_string = JHTML::_('date', $date_int, 'Y-m-d H:M:S');
                                    }
                                    elseif($config->hour_format == 12){
                                        $date_string = JHTML::_('date', $date_int, 'Y-m-d l:M:S p');
                                    }
                                    //---------------------------
                                    $difference_int = get_time_difference($int_current_date, $date_int);
                                    $difference = $difference_int["days"]." ".JText::_("GURU_REAL_DAYS");
                                    if($difference_int["days"] == 0){
                                        if($difference_int["hours"] == 0){
                                            if($difference_int["minutes"] == 0){
                                                $difference = "0";
                                            }
                                            else{
                                                $difference = JText::_("GURU_IN")." ".$difference_int["minutes"]." ".JText::_("GURU_REAL_MINUTES");
                                            }
                                        }
                                        else{
                                            $difference = JText::_("GURU_IN")." ".$difference_int["hours"]." ".JText::_("GURU_REAL_HOURS").", ".
                                                          $difference_int["minutes"]." ".JText::_("GURU_REAL_MINUTES");
                                        }
                                    }
                                    else{
                                        $difference = JText::_("GURU_IN")." ".$difference_int["days"]." ".JText::_("GURU_REAL_DAYS").", ".
                                                      $difference = $difference_int["hours"]." ".JText::_("GURU_REAL_HOURS").", ".
                                                      $difference_int["minutes"]." ".JText::_("GURU_REAL_MINUTES");
                                    }
                                    $date = '<span class="guru_active">'.$difference.'</span>';
                                    //---------------------------
                                }
                            }
                            $nr_orders = $this->countCourseOrders($id);
                        ?>						
                        <!--<br/><?php echo $expire; ?>:<?php echo $date; ?>-->
                        <?php if ($nr_orders > 0) {
                        ?>
                        <!--<br /><a href="index.php?option=com_guru&view=guruorders&layout=myorders&Itemid=<?php echo $Itemid; ?>&course=<?php echo $id; ?>"><?php echo JText::_("GURU_VIEW_ORDERS")." (".$nr_orders.")"; ?></a>-->
                        <?php
                                } else {}?>
                        </td>
                        <td class="g_cell_2 hidden-phone" style="vertical-align:middle!important;"> 
                            <?php
                                $user = JFactory::getUser();
                                $user_id = $user->id;
                                $completed_progress = $guruModelguruOrder->courseCompleted($user_id,$id);
                                $date_completed = $guruModelguruOrder->dateCourseCompleted($user_id, $id);
                                $date_completed = date("".$format_date."", strtotime($date_completed));
                        
                                $style_color = "";
                                if($completed_progress == true){
                                    if($deviceType !="phone"){
                                        $var_lang = JText::_('GURU_COMPLETED');
                                        //$lesson_module_progress =  $var_lang." ". "(".$date_completed.")" ;	
										$lesson_module_progress ="";
                                        $style_color = 'style="color:#669900"';
										
                                    }
                                    else{
                                        $var_lang = JText::_('GURU_COMPLETED');
										$lesson_module_progress ="";
                                        //$lesson_module_progress = $var_lang;
                                    }
                                }
                                else{
                                    $lesson_module_progress = $guruModelguruOrder->getLastViewedLessandMod($user_id, $id);	
                                }
                                
								//$lesson_module = $guruModelguruOrder->getLastViewedLessandMod($user_id, $id);	
								
                                if(isset($lesson_module_progress)){
									$les = explode("Lesson",$lesson_module_progress);
									$lesson = $les[1];
									$mod = $les[0];
									if($mod){
									//	echo $mod;	
									}else{
									
                                    // echo $lesson_module_progress; 		
									 
									}
                                } 
                                else{
                                    echo "";
                                }	

							//////jul get modules viewed
							$db->setQuery("select module_id from #__guru_viewed_lesson where user_id='$user_id' and pid='$id'");
							$modules = $db->loadResult();
							$mods = explode("|",$modules);
							$mctr = count($mods);
							$mod_name = '';
							
							///get module name
			 if($lctr>=1){
				 
			 	for($z=0;$z<=$lctr;$z++){ 
					$lid = $lessons[$z];
					if($lid>0){			 
			 							
								$mid = $mods[1];
								$db->setQuery("select title from #__guru_days where id='$mid'");
								$mod_name = $db->loadResult();
								echo $mod_name;
				if($z>=0 && $z!=$lctr){
					echo ' <div style="border-top:#e7e8e9 1px solid;margin-bottom:5px;margin-top:5px;height:1px;width:100%;"></div>';
				}	
				
					}//end if lid
				
			  } //end for
		}//end if >1
					
			else{
				echo $mod_name;
				
			}
                            ?>								
        </td>
                            <?php
                                $date_last_visit = $guruModelguruOrder->dateLastVisit($user_id, $id);
								$format_date = str_replace(" H:i:s", "", $format_date);
								
                                if($date_last_visit !="0000-00-00" && $date_last_visit !=NULL ){
                                    $date_last_visit = date("".$format_date."", strtotime($date_last_visit));
                                }
                                else{
                                    $date_last_visit = "";
                                }
                                $count_quizz_taken = $guruModelguruOrder->countQuizzTakenF($user_id, $id);
                                
                            ?>                            
                            <td class="g_cell_5">
                            	<?php 
								///get lesson
							$db->setQuery("select lesson_id from #__guru_viewed_lesson where user_id='$user_id' and pid='$id'");
							$less = $db->loadResult();
							$lessons = explode("|",$less);
							$lctr = count($lessons)-2;														
							
							///list lessons viewed
							for($i=1;$i<=$lctr;$i++){
								$lid = $lessons[$i];
								$db->setQuery("select name from #__guru_task where id='$lid'");
								$lesson_name = $db->loadResult();
								echo $lesson_name;
								if($i>=1 && $lid>0 && $i!=$lctr){
									echo '<div style="border-top:#e7e8e9 1px solid;margin-bottom:5px;margin-top:5px;"></div>';
								}
							}
								
								
									if($lesson){
										//echo 'Lesson '.$lesson;
									}
								?>
                                <?php
                                 /*   if($bool_expired == 0){ // not expired
                                        $date_int = strtotime($course->expired_date);
                                        $difference_int = get_time_difference($int_current_date, $date_int);		
                                        $difference = $difference_int["days"]." ".JText::_("GURU_REAL_DAYS");
                                        if($difference_int["days"] == 0){
                                            if($difference_int["hours"] == 0){
                                                if($difference_int["minutes"] == 0){
                                                    $difference = "0";
                                                }
                                                else{
                                                    $difference = $difference_int["minutes"]." ".JText::_("GURU_REAL_MINUTES");
                                                }
                                            }
                                            else{
                                                $difference = $difference_int["hours"]." ".JText::_("GURU_REAL_HOURS");
                                            }
                                        }
                                    
                                        $comfirm_text = JText::_("GURU_STILL_HAVE")." ".$difference." ".JText::_("GURU_AVAILABLE_COURSE")." ".JText::_("GURU_YES")." ".JText::_("GURU_ADD_TIME")." ".JText::_("GURU_CANCEL")." ".JText::_("GURU_GO_TO_COURSE_PAGE");
                                        if(!$no_renew){
                                ?>
                                        <input type="button" class=" btn btn-warning btn_renew" onclick="javascript:renewCourse(&quot;<?php echo $comfirm_text; ?>&quot;, <?php echo $id; ?> , &quot;<?php echo JURI::root(); ?>&quot;);" value="<?php echo JText::_("GURU_RENEW"); ?>">
                                <?php
                                        }
                                    }
                                    else{// expired
                                        if(!$no_renew){
                                ?>
                                        <input type="button" class="btn btn-warning btn_renew" onclick="document.adminForm.task.value='renew'; document.adminForm.order_id.value=<?php echo $course->order_id; ?>; document.adminForm.course_id.value=<?php echo $id; ?>;  document.adminForm.submit();" value="<?php echo JText::_("GURU_RENEW"); ?>">
                                <?php
                                        }
                                    }
                                */?>		
                            </td>
							<td class="g_cell_3 hidden-phone" style="vertical-align:middle!important;"><?php echo $date_last_visit;  ?></td>                            
                        </tr>
                    
        <?php
                }
            }
        ?>
            </table>
        
        <input type="hidden" name="option" value="com_guru" />
        <input type="hidden" name="controller" value="guruOrders" />
        <input type="hidden" name="task" value="mycourses" />
        <input type="hidden" name="order_id" value="" />
        <input type="hidden" name="course_id" value="" />
    </form>
</div>