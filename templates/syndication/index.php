<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.Syndication Mentoring Club	
 *
 * @copyright   Copyright (C) 2005 - 2016 Moore Tech Solutions, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;
// Getting params from template
$params = $app->getTemplate(true)->params;
// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');
// Output as HTML5
$doc->setHtml5(true);
if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}
// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/template.js');
// Add Stylesheets
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template.css');
$doc->addStyleSheet('templates/'.$this->template.'/css/syndication.css');
$doc->addStyleSheet('templates/'.$this->template.'/css/offcanvas.css');
$doc->addStyleSheet('templates/'.$this->template.'/css/responsive.css');
// Check for a custom CSS file
$userCss = JPATH_SITE . '/templates/' . $this->template . '/css/user.css';
if (file_exists($userCss) && filesize($userCss) > 0)
{
	$doc->addStyleSheetVersion('templates/' . $this->template . '/css/user.css');
}
// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);
// Adjusting content width
if ($this->countModules('right') && $this->countModules('left'))
{
	$span = "span6";
}
elseif ($this->countModules('right') && !$this->countModules('left'))
{
	$span = "span9";
}
elseif (!$this->countModules('right') && $this->countModules('left'))
{
	$span = "span9";
}
else
{
	$span = "span12";
}
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
	<?php
$this->setTitle( $this->getTitle() . ' | ' . $app->getCfg( 'sitename' ) );
?>
	<!--[if lt IE 9]>
		<script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
	<![endif]-->   
	
	<!--Google Font goes here -->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
<!--GA Code goes here -->
</head>
<?php
  $app = JFactory::getApplication();
  $menu = $app->getMenu()->getActive();
  $pageclass = '';
 
  if (is_object($menu))
    $pageclass = $menu->params->get('pageclass_sfx');
	
	
///get usergroup
$user = JFactory::getUser();
$db     = JFactory::getDBO();
$authorize = 0;

	foreach($user->groups as $group){
		$query  = 'SELECT title FROM #__usergroups';
		$query .= ' WHERE id = ' . $group;
		$db->setQuery( $query );
		$utype = $db->loadResult();
		//echo $utype.' - ';
		if($utype=='Inner Circle'){
				$authorize = 1;	
		}
	}

?>
<?php if($authorize==1){
?>
<style>
.show-inner{display:block;}
.show-reg{display:none;}
.gray{opacity:1;}
</style>
<?php }else{ ?>
<style>
.show-inner{display:none;}
.show-reg{display:block;}
</style>
<?php } ?>
<body id="<?php echo $pageclass ? htmlspecialchars($pageclass) : 'default'; ?>" class="site">

<!-- OFF CANVASS Panel -->
<div id="slide-menu">
    <ul class="navigation1">
		<li id="close"><a href="javascript:void(0)">Close</a></li>
    </ul>
	<?php if ($this->countModules('canvass')) : ?>
	<div class="span3 canvass">
		<div class="canvass">
			<jdoc:include type="modules" name="canvass" style="xhtml" />
		</div>
	</div>		
	<?php endif; ?>
    
</div>
<!-- Header -->
	<header role="banner" class="header">	
		<!--Mobile Nav includes logo and mobile navigation button/menu-visible only on phones-->
		<?php //if ($this->countModules('mobile-top')): ?>
    <div class="row-fluid top-wrap visible-phone">			    
     <div class="container">	   
		<div class="visible-phone">
			<div class="logo mobile">
				<a class="brand" href="<?php echo $this->baseurl; ?>">
					<jdoc:include type="modules" name="logo" style="none" /> 
				</a>
			</div>
            <div class="toolbar-r mobile">
					<jdoc:include type="modules" name="toolbar-r" style="xhtml" />
				</div>	
			<div class="top-phone">
				<jdoc:include type="modules" name="mobile-top" style="none" />
			</div>
            <div class="clear"></div>
			<!-- CANVASS Mobile BUTTON-->
			<div class="menu-button">	
				<a id="push">
					<span class="menu-btn"><span class="icon-menu-3"></span>MENU</span><br />	
				</a>
			</div>
			</div>
         </div>
        </div>
			<?php //endif; ?>
            
        			<!-- Logo Nav hidden on phones-->			
        <div class="row-fluid logo-wrap hidden-phone">
         <div class="container">   
		<div class="nav-logo">
			<div class="span4 logo">
				<a class="brand" href="<?php echo $this->baseurl; ?>">
					<jdoc:include type="modules" name="logo" style="none" /> 
				</a>
             <div class="logo-logged">				
					<jdoc:include type="modules" name="logo-logged" style="none" /> 				
			</div>   
		</div>           
      <!-- Toolbar -->
		<?php if (($this->countModules('toolbar-r'))) : ?>
			<div class="toolbar">								
				<div class="span8 pull-right toolbar-r">
					<jdoc:include type="modules" name="toolbar-r" style="xhtml" />
				</div>				
				<div class="clear"></div>
			</div>
		<?php endif; ?>
        </div>
        </div>
        </div>
			<!-- end of Logo Nav hidden on phones-->	
       <div class="clear"></div>                 
    <!-- Menu - Remove this if only using Canvass Menu button-->

    <div class="row-fluid nav-wrap hidden-phone">
      <div class="container">
	  <div class="span9 navigation">
        <div class="navbar">
          <div class="nav">
            <jdoc:include type="modules" name="navigation" style="xhtml" />
          </div>
        </div>
	  </div>
	  <div class="span3">
		<!-- Search -->
		<div class="search">
			<jdoc:include type="modules" name="search" style="xhtml" />
		</div>
	  </div>
		</div>
		<div class="clear"></div> 
    </div>
           
</header>	
	<!-- Begin SHOWCASE -->
	<?php if ($this->countModules('showcase')) : ?>
		<div class="showcase row-fluid">
			<jdoc:include type="modules" name="showcase" style="xhtml" />
		</div> 
	<?php endif; ?>
	<!-- Begin BANNER -->
	<?php if (($this->countModules('banner-1'))||($this->countModules('banner-2'))||($this->countModules('banner-3'))) : ?>
		<div class="banner row-fluid">
			<div class="container">
				<div class="span4 banner-1"><jdoc:include type="modules" name="banner-1" style="xhtml" /></div>
				<div class="span4 bnner-2"><jdoc:include type="modules" name="banner-2" style="xhtml" /></div>
				<div class="span4 banner-3"><jdoc:include type="modules" name="banner-3" style="xhtml" /></div>			
			</div>
		</div>
	<?php endif; ?>
	
	<!-- Body -->

	<div class="row-fluid body">
		<div class="container">
			<div class="row-fluid">
			
			<!-- Left Sidebar -->
				<?php if ($this->countModules('left')) : ?>
				<aside role="complementary">				
				<div id="sidebar" class="span3">
					<div class="sidebar-nav">
						<jdoc:include type="modules" name="left" style="xhtml" />
					</div>
				</div>
				</aside>
				<?php endif; ?>
				
				<!-- Begin Content -->
				<main id="content" role="main" class="<?php echo $span;?>">
					
					<!-- Content Top -->
					<?php if ($this->countModules('content-top')) : ?>
					<jdoc:include type="modules" name="content-top" style="xhtml" />
					<?php endif; ?>
					
					<!-- System Messages -->
					<jdoc:include type="message" />
					
					<!-- Breadcrumbs -->
					<?php if ($this->countModules('breadcrumbs')) : ?>
					<div class="breadcrumbs">
						<jdoc:include type="modules" name="breadcrumbs" style="xhtml" />
					</div>
					<?php endif; ?>
					
					<!-- Joomla Component -->
					<jdoc:include type="component" />
					
					<!-- Content Bottom -->
					<?php if ($this->countModules('content-bottom')) : ?>
					<jdoc:include type="modules" name="content-bottom" style="xhtml" />
					<?php endif; ?>
				</main>
				
				<!-- Right Sidebar -->
				<?php if ($this->countModules('right')) : ?>
				<aside role="complementary">
				<div id="aside" class="span3">
					<!-- Begin Right Sidebar -->
					<jdoc:include type="modules" name="right" style="xhtml" />
					<!-- End Right Sidebar -->
				</div>
				</aside>
				<?php endif; ?>
			</div>
			<!-- End Content -->
			
			<!-- BOTTOM GRID -->
			<?php if (($this->countModules('grid1'))||($this->countModules('grid2'))||($this->countModules('grid3'))||($this->countModules('grid4'))) : ?>
			<div class="bottom-grid">
				<?php if ($this->countModules('grid1')) : ?>
				<div class="span3 grid1">
					<div class="grid">
						<jdoc:include type="modules" name="grid1" style="xhtml" />	
					</div>
				</div>
				<?php endif; ?>
				
				<?php if ($this->countModules('grid2')) : ?>
				<div class="span3 grid2">
					<div class="grid">
						<jdoc:include type="modules" name="grid2" style="xhtml" />
					</div>
				</div>
				<?php endif; ?>
				
				<?php if ($this->countModules('grid3')) : ?>
				<div class="span3 grid3">
					<div class="grid">
						<jdoc:include type="modules" name="grid3" style="xhtml" />
					</div>
				</div>
				<?php endif; ?>
				
				<?php if ($this->countModules('grid4')) : ?>
				<div class="span3 grid4">
					<div class="grid">
						<jdoc:include type="modules" name="grid4" style="xhtml" />
					</div>
				</div>
				<?php endif; ?>
				
			<div class="clear"></div>
			</div>
			<?php endif; ?>
			
			<!-- BOTTOM NAV -->
			<?php if ($this->countModules('bottom-nav')) : ?>
			<div class="bottom-nav">
					<jdoc:include type="modules" name="bottom-nav" style="none" />
			<?php endif; ?>
			</div>
		</div>
	</div>
	
	<!-- Footer-->
	<footer class="footer row-fluid" role="contentinfo">
	<div class="container">
    
    <?php if ($this->countModules('footer-main')) : ?>    
			<div class="footer-main">
					<jdoc:include type="modules" name="footer-main" style="none" />
            </div>            
	<?php endif; ?>
    
    
	
		<?php if (($this->countModules('footer1'))||($this->countModules('footer2'))||($this->countModules('footer3'))) : ?>
		<div class="row-fluid">
		
		<?php if ($this->countModules('footer1')) : ?>
		<div class="span4 footer1">
			<div class="foot-blk">
				<jdoc:include type="modules" name="footer1" style="xhtml" />	
			</div>
		</div>
		<?php endif; ?>
		
		<?php if ($this->countModules('footer2')) : ?>
		<div class="span4 footer2">
			<div class="foot-blk">
				<jdoc:include type="modules" name="footer2" style="xhtml" />
			</div>
		</div>
		<?php endif; ?>
		
		<?php if ($this->countModules('footer3')) : ?>
		<div class="span4 footer3">
			<div class="foot-blk">
				<jdoc:include type="modules" name="footer3" style="xhtml" />
			</div>
		</div>
		<?php endif; ?>
		
		<div class="clear"></div>
		</div>
		<?php endif; ?>
        </div>
		
		<!-- FooterL and R -->
   		     
		<?php if (($this->countModules('footer-l'))||($this->countModules('footer-r'))) : ?>
		<div class="row-fluid copy">
        <div class="container">
		<?php if ($this->countModules('footer-l')) : ?>
		<div class="span6 footer-l">
			<div class="foot">
				<jdoc:include type="modules" name="footer-l" style="xhtml" />	
			</div>
		</div>
		<?php endif; ?>
		
		<?php if ($this->countModules('footer-r')) : ?>
		<div class="span6 footer-r pull-right">
			<div class="foot">
				<jdoc:include type="modules" name="footer-r" style="xhtml" />
			</div>
		</div>
		<?php endif; ?>
		
		<div class="clear"></div>
		</div>
        </div>
		<?php endif; ?>
		
	<!-- </div>	-->
	</footer>	
	
	<!-- Joomla Debug -->
	<jdoc:include type="modules" name="debug" style="none" />
	
	<script>
				jQuery(document).ready(function () {
				
				jQuery('#push, #close').click(function () {										
						var $navigacia = jQuery('#slide-menu'),
						val = $navigacia.css('left') === '300px' ? '0px' : '300px';
						$navigacia.animate({
								left: val
						}, 300)
						
						var $navigacia = jQuery('body'),
						val = $navigacia.css('left') === '0px' ? '0px' : '0px';
						$navigacia.animate({
								left: val
						}, 300)						
						
				});		
				
		});
</script>     
</body>
</html>
