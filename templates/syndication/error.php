<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

?>

<?php  
$document = JFactory::getDocument();
$renderer = $document->loadRenderer('modules');
//$position = array("navigation","404-not-found","footer-main");
$position = "navigation" or "404-not-found" or "footer-main";
//$position2 = "404-not-found";
$options = array('style' => 'raw');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Page Not Found!</title>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css"/>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/syndication.css"/>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/responsive.css"/>
<style>
.error .custom.social-links {
    display: none;
}
</style>
</head>

<body>

<div class="row-fluid nav-wrap">
  <div class="container">
     <div class="navbar navbar">
          <div class="nav">
    <div class="moduletable nav-pills"> 
	<?php echo $renderer->render($position="navigation", $options, null); ?> 
    </div>
  </div>
</div>
</div>
</div>
<!--
<a class="brand" href="<?php echo $this->baseurl; ?>">
<img src="<?php echo $this->baseurl; ?>/images/logo-mts.jpg" />
</a>
-->
<div style="text-align:center; margin-top:100px;">
<p>Please use the navigation above or search here.</p>
	<?php /* search-field*/ echo $renderer->render($position = "404-not-found", $options, null); ?>
</div>

<?php  if ($this->error->getCode() == '404') { ?>
<div style="height:auto; min-height:100%; ">
  <div style="margin: 66px 0; position: relative;text-align: center;">
    <h1 style="margin:0; font-size:150px; line-height:150px; font-weight:bold;">404</h1>
    <h2 style="margin-top:20px;font-size: 30px;">Not Found </h2>
    <p>The resource requested could not be found on this server!</p>
  </div>
</div>
<?php } ?>

<!-- Footer-->
	<footer class="footer row-fluid" role="contentinfo">
	<div class="container">
			<div class="footer-main error">
					<?php echo $renderer->render($position = "footer-main", $options, null); ?> 
            </div>         
    </div>
    </footer>

</body>
</html>
