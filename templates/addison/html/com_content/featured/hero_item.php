<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

// Create a shortcut for params.
$params = &$this->item->params;
$images = json_decode($this->item->images);
$canEdit = $this->item->params->get('access-edit');
$info = $this->item->params->get('info_block_position', 0);
?>
  <?php if (isset($images->image_slider) && !empty($images->image_slider)) : ?>
    <img title="<?php echo JHtml::_('string.truncate', (strip_tags($this->item->text)), $params->get('readmore_limit')); ?>" class="hero__image" src="<?php echo htmlspecialchars($images->image_slider); ?>" alt="<?php echo htmlspecialchars($images->image_slider_alt); ?>"/>
  <?php endif; ?>
  <div class="hero__content desk-p lap-p- palm-p--">
    <h1 class="hero__title">
      <?php echo $this->escape($images->image_slider_caption); ?>
    </h1>
    <?php if ($this->item->state == 0) : ?>
      <span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
    <?php endif; ?>

    <?php
    if ($params->get('show_readmore') && $this->item->readmore) :
      if ($params->get('access-view')) :
        $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
      else :
        $menu = JFactory::getApplication()->getMenu();
        $active = $menu->getActive();
        $itemId = $active->id;
        $link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
        $returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
        $link = new JUri($link1);
        $link->setVar('return', base64_encode($returnURL));
      endif;
      ?>
      <?php if ($params->get('show_readmore') && $this->item->readmore) : ?>
      <p class="white">
        <?php
        echo JHtml::_('string.truncate', (strip_tags($this->item->text)), $params->get('readmore_limit')); 
        echo JLayoutHelper::render('joomla.content.readmore', array('item' => $this->item, 'params' => $params, 'link' => $link)); ?>
      </p>
    <?php endif; ?>


    <?php endif; ?>
  </div>
