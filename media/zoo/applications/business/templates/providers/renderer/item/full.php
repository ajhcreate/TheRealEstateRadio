<?php
/**
 * @package   com_zoo
 * @author    YOOtheme http://www.yootheme.com
 * @copyright Copyright (C) YOOtheme GmbH
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
?>

<style>
    .resourcesH2 {
        font-size: 22px!important;
        line-height: 24px!important;
        margin: 12px 0!important;
        font-family: inherit!important;
        font-weight: bold!important;
        color: inherit!important;
        text-rendering: optimizelegibility!important;
    }
</style>


<?php if ($this->checkPosition('top')) : ?>
    <div class="pos-top">
        <?php echo $this->renderPosition('top', array('style' => 'block')); ?>
    </div>
<?php endif; ?>

<div class="floatbox">

    <?php if ($this->checkPosition('sidebar')) : ?>
        <div class="pos-sidebar <?php echo 'sidebar-' . $view->params->get('template.item_sidebar_alignment'); ?>">
            <?php echo $this->renderPosition('sidebar', array('style' => 'block')); ?>
        </div>
    <?php endif; ?>


    <?php if ($this->checkPosition('title')) : ?>
        <div class="page-header">
            <h2 class="resourcesH2" itemprop="headline"><?php echo $this->renderPosition('title'); ?></h2>
        </div>
    <?php endif; ?>

    <?php if ($this->checkPosition('subtitle')) : ?>
        <p class="pos-subtitle">
            <?php echo $this->renderPosition('subtitle', array('style' => 'comma')); ?>
        </p>
    <?php endif; ?>

    <?php if ($this->checkPosition('description')) : ?>
        <div class="pos-description">
            <?php echo $this->renderPosition('description', array('style' => 'block')); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->checkPosition('address') || $this->checkPosition('contact')) : ?>
        <div class="address">

            <?php if ($this->checkPosition('address')) : ?>
                <div class="pos-address">
                    <h3><?php echo JText::_('Address'); ?></h3>
                    <ul>
                        <?php echo $this->renderPosition('address', array('style' => 'list')); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ($this->checkPosition('contact')) : ?>
                <div class="pos-contact">
                    <h3><?php echo JText::_('Contact'); ?></h3>
                    <ul>
                        <?php echo $this->renderPosition('contact', array('style' => 'list')); ?>
                    </ul>
                </div>
            <?php endif; ?>

        </div>
    <?php endif; ?>

    <?php if ($this->checkPosition('employee')) : ?>
        <div class="pos-employee">
            <?php echo $this->renderPosition('employee', array('style' => 'block')); ?>
        </div>
    <?php endif; ?>

</div>

<?php if ($this->checkPosition('bottom')) : ?>
    <div class="pos-bottom">
        <?php echo $this->renderPosition('bottom', array('style' => 'block')); ?>
    </div>
    <?php








     endif;