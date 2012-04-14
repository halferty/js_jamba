<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
define( 'YOURBASEPATH', dirname(__FILE__) );
require(YOURBASEPATH .DS."/styleswitcher.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
<jdoc:include type="head" />

<?php
	$headerstyle      = $this->params->get("headerstyle", "graphic");
	$headline     	  = $this->params->get("headline", "Jamba");
	$slogan			  = $this->params->get("slogan", "A Free Template From Joomlashack");
	$themecolor		  = $this->params->get("themecolor", "style1");
	require( YOURBASEPATH.DS."/themesaver.php");
	require( YOURBASEPATH.DS."/js/template.css.php");
	function getColumns ($left, $right){
	if ($left && !$right) {$style = "-left-only";}
	if ($right && !$left) $style = "-right-only";
	if (!$left && !$right) $style = "-wide";
	if ($left && $right) $style = "-both";
	return $style;
	}
	$style = getColumns($this->countModules( 'left' ),$this->countModules( 'right' ));
?>
<link rel="shortcut icon" href="images/favicon.ico" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />

<link href="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/css/template_css.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/css/nav.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/css/<?php echo $scheme;?>.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/css/j15.css" rel="stylesheet" type="text/css" media="screen" />

<!--[if IE]>
<link href="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/css/ie.css" rel="stylesheet" type="text/css" media="screen" />
<![endif]-->

</head>
<body>
<div id="header-wrap">		
	<div id="header_<?php echo $headerstyle; ?>">
		<?php if ($headerstyle=='graphic') { ?>
			<a href="<?php echo JURI::base(); ?>" title="<?php echo $headline; ?>">
			<img src="<?php echo $this->baseurl;?>/templates/<?php echo $this->template;?>/images/<?php echo $scheme;?>/logo.png" title="<?php echo $headline; ?>" alt="<?php echo $slogan; ?>"/></a>

		<?php } ?>
		<?php if ($headerstyle=='text') { ?>
			<a href="<?php echo JURI::base(); ?>" title="<?php echo $headline; ?>"><?php echo $headline;?></a>
		<?php } ?>
	</div>
</div>
	<div id="main-wrapper">		
		<div class="main-top<?php echo $style; ?>"></div>
			<div id="mainbody<?php echo $style; ?>">
				<?php if ($this->countModules( 'left' )) : ?>
					<div id="leftcol">
						<div class="left-inside">
							<jdoc:include type="modules" name="left" style="rounded" />
						</div>
					</div>
				<?php endif; ?>
				<?php if ($this->countModules( 'right' )) : ?>
					<div id="rightcol">
						<div class="right-inside">
							<jdoc:include type="modules" name="right" style="rounded" />
						</div>
					</div>
				<?php endif; ?>
				<div class="main<?php echo $style; ?>">
						<table border="0" cellspacing="0" cellpadding="0" width="100%">
						  <tr>
						    <td valign="top" width="100%">
							
						<jdoc:include type="message" />
						<jdoc:include type="component" />
						</td>
						  </tr>
						</table>
				</div>
				<div class="clear"></div><!--Updated in v1.6.1-->
				</div>
		<div class="bottom<?php echo $style; ?>"></div>
		<?php if ($this->countModules( 'footer' )) : ?>
		<div class="main-top-wide"></div>
		<div class="mainbody-wide">
			<div class="footer">
				<jdoc:include type="modules" name="footer" style="raw" />
			</div>
			<div class="clear"></div>
			</div>
		<div class="bottom-wide">&nbsp;</div>
		<?php endif; ?>
	</div>
</body>
</html>