<?php  

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<html>
	<body>
		<p>Hi,</p>

		<p>You are receiving this email because you are administering the topic, <?php echo $item->name; ?> at <?php echo $website_name; ?>. This topic has received a reply.</p>

		<p>Quote: "<?php echo $comment->content; ?>"</p>

		<p>If you want to view the post made, click the following link: <a href="<?php echo $comment_link; ?>"><?php echo $comment_link; ?></a></p>

		<p>If you want to view the topic, click the following link: <a href="<?php echo $item_link; ?>"><?php echo $item_link; ?></a></p>

		<p>If you want to view the website, click on the following link: <a href="<?php echo $website_link; ?>"><?php echo $website_link; ?></a></p>
	</body>
</html>
