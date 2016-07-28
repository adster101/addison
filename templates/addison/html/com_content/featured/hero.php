<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');
// If the page class is defined, add to class as suffix.
// It will be a separate class if the user starts it with a space
?>
    <?php if ($this->params->get('show_page_heading') != 0) : ?>
      <div class="page-header">
        <h1>
          <?php echo $this->escape($this->params->get('page_heading')); ?>
        </h1>
      </div>
    <?php endif; ?>
    <?php $leadingcount = 0; ?>
    <?php if (!empty($this->lead_items)) : ?>
      <div id="hero" class="hero"><!-- Carousel items -->
          <?php foreach ($this->lead_items as &$item) : ?>
            <?php
            $this->item = &$item;
            $this->item_number = $leadingcount;
            echo $this->loadTemplate('item');
            $leadingcount++;
            ?>
          <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php
    	$introcount = (count($this->intro_items));
    	$counter = 0;
    ?>
    <?php if (!empty($this->intro_items)) : ?>
      <div class="layout">
    	<?php foreach ($this->intro_items as $key => &$item) : ?>
    		<?php
          // Set up basic layout for the intro items
          $desk = 'u-1/' . $this->columns . '-desk';
          $lap = 'u-1/' . $this->columns . '-lap';
        ?>

    		  <div class="layout__item <?php echo $desk . ' ' . $lap ?>">
    			<div class="desk-p+ lap-p+ palm-p" itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
    			<?php
    					$this->item = &$item;
    					echo $this->loadTemplate('intro_item');
    			?>
    			</div>
    			</div>
    	<?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if (!empty($this->link_items)) : ?>
    	<div class="items-more">
    	<?php echo $this->loadTemplate('links'); ?>
    	</div>
    <?php endif; ?>

    <?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->pagesTotal > 1)) : ?>
    	<div class="pagination">

    		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
    			<p class="counter pull-right">
    				<?php echo $this->pagination->getPagesCounter(); ?>
    			</p>
    		<?php  endif; ?>
    				<?php echo $this->pagination->getPagesLinks(); ?>
    	</div>
    <?php endif; ?>
