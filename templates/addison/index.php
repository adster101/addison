<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
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
$menu = $app->getMenu();
$active = $menu->getActive();
$sitehome = ($active == $menu->getDefault('en-GB')) ? true : false;
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
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/main.css');

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
if ($this->countModules('position-7'))
{
	$span = "layout__item u-2/3-lap u-2/3-desk";
}
else
{
	$span = "";
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
</head>

<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
	echo ($this->direction == 'rtl' ? ' rtl' : '');
?>">

<?php require( __DIR__ . '../../../images/symbol-defs.svg'); ?>

	<!-- Body -->
	<div class="wrapper">
		<div class="contact lap-ph- lap-pv-- palm-ph-- palm-pv-- desk-ph desk-pv--">
		  <div class="layout">
		    <div class="layout__item u-1/3-palm u-3/5-lap u-3/4-desk">
					<jdoc:include type="modules" name="position-0" style="none" />
				</div><!--
		--><div class="layout__item  u-2/3-palm u-2/5-lap u-1/4-desk">
		  <a href="/donation-request-form" class="btn btn--small btn--funding-request" style="float:right">Funding request</a>
		</div>
	</div>
		</div>
			<!-- Header -->
			<header class="">
			  <div class="site-nav">
			    <div class="layout">
			      <!-- Navigation. We hide it in small screens. -->
			      <div class="layout__item u-2/5-desk u-2/5-lap u-4/5-palm">
							<a class="" href="<?php echo $this->baseurl; ?>/">
			        	<img class="lap-ph- lap-pv- palm-ph-- palm-pv-- desk-ph desk-pv-" src="/images/round-table-small-logo.png" />
							</a>
			        	<span><?php echo htmlspecialchars($sitename); ?></span>
			      </div><!--
			--><div class="layout__item u-3/5-desk u-3/5-lap  u-1/5-palm">
						<?php if ($this->countModules('position-1')) : ?>
							<nav>
								<jdoc:include type="modules" name="position-1" style="xhtml" />
							</nav>
						<?php endif; ?>
			        <div class="menu-toggle palm-mt--">
			          <button id="menu-toggle" class="menu-toggle__button" type="button">
			             <span class="menu-toggle__icon--bar"></span>
			             <span class="menu-toggle__icon--bar"></span>
			             <span class="menu-toggle__icon--bar"></span>
			           </button>
			        </div>
			      </div>
			    </div>
			  </div>
			</header>
			<?php if (!$sitehome) : ?>
				<div class="desk-p lap-p- palm-p--">
			<?php endif; ?>
			<jdoc:include type="message" />

				<?php if ($this->countModules('position-7')) : ?>
					<div class="layout">
						<div class="layout__item u-2/3-lap u-2/3-desk">
				<?php endif; ?>
					<main id="content" role="main">
					<!-- Begin Content -->
					<jdoc:include type="modules" name="position-3" style="xhtml" />

					<jdoc:include type="component" />

					<!-- After main content -->
					<jdoc:include type="modules" name="position-8" style="none" />

					<!-- End Content -->
				</main>
					<?php if ($this->countModules('position-7')) : ?>
				</div><!--
			<?php endif; ?>
				<?php if ($this->countModules('position-7')) : ?>
				--><div id="aside" class="layout__item u-1/3-lap u-1/3-desk">
						<!-- Begin Right Sidebar -->

						<jdoc:include type="modules" name="position-7" style="well" />
						<!-- End Right Sidebar -->
					</div>
				</div>
				<!-- After main content and sidebar -->
				<?php endif; ?>
				<?php if (!$sitehome) : ?>
				</div>
				<?php endif; ?>
				<jdoc:include type="modules" name="position-2" style="none" />
	<!-- Footer -->
	<footer class="footer" role="contentinfo">
		<div class="palm-p lap-p- desk-p">
		    <div class="">© <?php echo $sitename ?></div>
		    <svg class="icon icon-facebook">
		      <use xlink:href="#icon-facebook"></use>
		    </svg>
		    <svg class="icon icon-twitter">
		      <use xlink:href="#icon-twitter"></use>
		    </svg>
		  </div>
	</footer>
</div>
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
