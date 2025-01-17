<?php
/**
 * Kunena Component
 * @package         Kunena.Template.BlueEagle5
 * @subpackage      Layout.Topic
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license         http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/
defined('_JEXEC') or die;
$topicStarter = $this->topic->first_post_userid == $this->message->userid;
$template     = KunenaTemplate::getInstance();
$direction    = $template->params->get('avatarPosition');
$sideProfile  = $this->profile->getSideProfile($this);
$quick        = $template->params->get('quick');
$config       = KunenaConfig::getInstance();

if ($config->ordering_system == 'mesid')
{
	$this->numLink = $this->location;
}
else
{
	$this->numLink = $this->message->replynum;
}
?>


<div class="kcontainer">
	<div class="kbody">

		<?php if ($direction === "left") : ?>
			<div class="kmsg-header kmsg-header-left">
				<h2>
					<span class="kmsgtitle kmsg-title-left">
						<?php echo $this->escape($this->message->subject) ?>
					</span>
					<span class="kmsgdate kmsgdate-left"
					      title="<?php echo KunenaDate::getInstance($this->message->time)->toKunena('config_post_dateformat_hover') ?>">
						<?php echo KunenaDate::getInstance($this->message->time)->toKunena('config_post_dateformat') ?>
					</span>
					<span class="kmsg-id-left">
						<a href="#<?php echo $this->message->id; ?>" id="<?php echo $this->message->id; ?>"
						   rel="canonical">#<?php echo $this->numLink; ?></a>
					</span>
				</h2>
			</div>
			<table class="kmsg">
				<tbody>
					<tr>
						<td class="kprofile-left" rowspan="2">
							<?php echo($sideProfile ? $sideProfile : $this->subLayout('User/Profile')->set('user', $this->profile)->setLayout('default')->set('topic_starter', $topicStarter)->set('category_id', $this->category->id)); ?>
						</td>
						<td class="kmessage-left">
							<?php echo $this->subLayout('Message/Item')->setProperties($this->getProperties()); ?>
							<?php echo $this->subLayout('Message/Edit')->set('message', $this->message)->set('captchaEnabled', $this->captchaEnabled)->setLayout('quickreply'); ?>
						</td>
					</tr>
					<tr>
						<td class="kbuttonbar-left">
							<?php echo $this->subRequest('Message/Item/Actions')->set('mesid', $this->message->id)->set('message', $this->message); ?>
						</td>
					</tr>
				</tbody>
			</table>
		<?php elseif ($direction === "right") : ?>
			<div class="row-fluid message">
				<div class="span10 message-<?php echo $this->message->getState(); ?>">
					<?php echo $this->subLayout('Message/Item')->setProperties($this->getProperties()); ?>
					<?php echo $this->subRequest('Message/Item/Actions')->set('mesid', $this->message->id); ?>
					<?php if ($quick != 2) : ?>
						<?php echo $this->subLayout('Message/Edit')->set('message', $this->message)->set('captchaEnabled', $this->captchaEnabled)->setLayout('quickreply'); ?>
					<?php endif; ?>
				</div>
				<div class="span2 hidden-phone">
					<?php echo($sideProfile ? $sideProfile : $this->subLayout('User/Profile')->set('user', $this->profile)->setLayout('default')->set('topic_starter', $topicStarter)->set('category_id', $this->category->id)); ?>
				</div>
			</div>
		<?php elseif ($direction === "top") : ?>
			<div class="row-fluid message message-<?php echo $this->message->getState(); ?>">
				<div class="span12" style="margin-left: 0;">
					<?php echo $this->subLayout('Message/Item/Top')->setProperties($this->getProperties()); ?>
					<?php echo $this->subRequest('Message/Item/Actions')->set('mesid', $this->message->id); ?>
					<?php if ($quick != 2) : ?>
						<?php echo $this->subLayout('Message/Edit')->set('message', $this->message)->set('captchaEnabled', $this->captchaEnabled)->setLayout('quickreply'); ?>
					<?php endif; ?>
				</div>
			</div>
		<?php elseif ($direction === "bottom") : ?>
			<div class="row-fluid message message-<?php echo $this->message->getState(); ?>">
				<div class="span12" style="margin-left: 0;">
					<?php echo $this->subLayout('Message/Item/Bottom')->setProperties($this->getProperties()); ?>
					<?php echo $this->subRequest('Message/Item/Actions')->set('mesid', $this->message->id); ?>
					<?php if ($quick != 2) : ?>
						<?php echo $this->subLayout('Message/Edit')->set('message', $this->message)->set('captchaEnabled', $this->captchaEnabled)->setLayout('quickreply'); ?>
					<?php endif; ?>
				</div>
			</div>

		<?php endif; ?>

		<?php echo $this->subLayout('Widget/Module')->set('position', 'kunena_msg_' . $this->message->replynum); ?>
	</div>
</div>
