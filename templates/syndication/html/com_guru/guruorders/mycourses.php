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
	padding:0!important;
}
.uk-table th{
	padding:15px 0!important;
}
.lname {
	width:300px;
	border-right:1px solid #ddd;
	float:left;
	padding-top:7px;
	padding-bottom:7px;
	
}
.modname {
	width:360px;
	border-right:1px solid #ddd;
	float:left;
	padding-top:7px;
	padding-bottom:7px;
}
.lview{
	width:150px;
	float:left;
	padding-top:7px;
	padding-bottom:7px;	
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
	$user_id = $user->id;
?>

<br /><br />
<table class="uk-table uk-table-striped course-table" border="1">
            <tr>
                <th class="g_cell_1" style="width:360px;">Topic Name<?php //echo $cname; ?></th>
                <th class="g_cell_2 hidden-phone" style="width:360px;">Module Name<?php //echo JText::_("GURU_COURSE_PROGRESS"); ?></th>
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
                        <a href="<?php echo JRoute::_("index.php?option=com_guru&view=guruPrograms&task=view&cid=".$id."-".$alias."&Itemid=".$Itemid); ?>"><?php echo $course->course_name; ?></a>
               
            </td>
                        <td colspan="3" class="g_cell_2 hidden-phone" style="vertical-align:middle!important;">
                            	<?php 
								///get all lessons
								$progid = $id;
								$db->setQuery("select id from #__guru_days where pid='$progid'");
								$modn = $db->loadColumn();
								$modid = $db->loadResult();
								
								$modctr = count($modn)-1;
								$lesson_name = '';
								
								
						for($mn=0;$mn<=$modctr;$mn++){
								$modshow = 0;
								$modid = $modn[$mn];

								//get module name
								$db->setQuery("select title from #__guru_days where id='$modid'");
								$mod_name = $db->loadResult();
								
								////////////////////

								$db->setQuery("select distinct(media_id) from #__guru_mediarel where type_id='$modid' and type='dtask' order by id desc");
								$dlesson = $db->loadColumn();
								$less_ctr = count($dlesson)-1;

							for($i=0;$i<=$less_ctr;$i++){
								$lid = $dlesson[$i];
								$db->setQuery("select name from #__guru_task where id='$lid'");
								$lesson_name = $db->loadResult();
								
								//check if viewed
								$db->setQuery("select id from #__guru_viewed_lesson where user_id='$user_id' and pid='$progid' and lesson_id like '%|$lid%'");
								$vid = $db->loadResult();
								$vstat = 'Not Viewed';
								
								if($vid>0){
									$vstat = 'Viewed';	
								}
								$modshow = 1;
								echo '<div class="modname">'.$mod_name.'</div>';
								echo '<div class="lname">'.$lesson_name.'</div><div class="lview">'.$vstat.'</div>';
								if($i<$less_ctr){
									echo '<div style="border-top:#e7e8e9 1px solid;margin-bottom:5px;margin-top:5px;clear:both"></div>';
								}
							}//end for
							if($mn<$modctr && strlen($lesson_name) > 0){
							echo '<div style="border-top:#e7e8e9 1px solid;margin-bottom:5px;margin-top:5px;clear:both"></div>';	
							}
							
							if($modshow==0){
							echo '<div class="modname">'.$mod_name.'</div>';
							echo '<div class="lname">&nbsp;</div><div class="lview">&nbsp;</div>';
							}
							
						}//end for mn

							/*	
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
									}*/
								?>                  </td>
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