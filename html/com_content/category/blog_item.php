<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Create a shortcut for params.
$params = &$this->item->params;
$images = json_decode($this->item->images);
$canEdit	= $this->item->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::core();
?>

<?php if ($this->item->state == 0) : ?>
<div class="system-unpublished">
<?php endif; ?>

<table class="contentpaneopen">
<?php if ($params->get('show_title')) : ?>
	<tr>
	<td class="contentheading" width="100%">
	<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
		<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
		<?php echo $this->escape($this->item->title); ?></a>
	<?php else : ?>
		<?php echo $this->escape($this->item->title); ?>
	<?php endif; ?>
	</td>
	<?php if ($canEdit) : ?>
		<td align="right" width="100%" class="buttonheading">
		<?php echo JHtml::_('icon.edit', $this->item, $params); ?>
		</td>
	<?php endif; ?>
</tr>
<?php endif; ?>
</table>

<table class="contentpaneopen">
<?php if ($params->get('show_category')) : ?>
	<?php $title = $this->escape($this->item->category_title);
		$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catid)) . '">' . $title . '</a>'; ?>
	<tr><td valign="top" colspan="2"><span class="small">
	<?php if ($params->get('link_category')) : ?>
		<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
	<?php else : ?>
		<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
	<?php endif; ?>
	</span>&nbsp;&nbsp;</td></tr>
<?php endif; ?>
<?php if ($params->get('show_create_date')) : ?>
	<tr><td valign="top" colspan="2"><span class="small">
		<?php echo JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC')); ?>
	</span>&nbsp;&nbsp;</td></tr>
<?php endif; ?>
<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
	<?php $author =  $this->item->author; ?>
	<?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>
	<tr><td valign="top" colspan="2"><span class="small">
	<?php if (!empty($this->item->contactid ) &&  $params->get('link_author') == true):?>
		<?php 	echo JText::sprintf('COM_CONTENT_WRITTEN_BY' ,
			JHtml::_('link', JRoute::_('index.php?option=com_contact&view=contact&id='.$this->item->contactid), $author)); ?>
	<?php else :?>
		<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
	<?php endif; ?>
	</span>&nbsp;&nbsp;</td></tr>
<?php endif; ?>
<tr>
<td valign="top" colspan="2">
<br />
<?php echo $this->item->introtext; ?>
<?php if ($params->get('show_readmore') && $this->item->readmore) :
	if ($params->get('access-view')) :
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
	else :
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
		$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
		$link = new JURI($link1);
		$link->setVar('return', base64_encode($returnURL));
	endif;
?>
	<p class="readmore">
	<a href="<?php echo $link; ?>">
	<?php if (!$params->get('access-view')) :
		echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
	elseif ($readmore = $this->item->alternative_readmore) :
		echo $readmore;
		if ($params->get('show_readmore_title', 0) != 0) :
		    echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
		endif;
	elseif ($params->get('show_readmore_title', 0) == 0) :
		echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
	else :
		echo JText::_('COM_CONTENT_READ_MORE');
		echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
	endif; ?></a>
	</p>
<?php endif; ?></td>
</tr>

<?php if ($params->get('show_modify_date') && ($this->item->modified != $this->item->created)) : ?>
	<tr><td valign="top" colspan="2"><span class="small">
		<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
	</span>&nbsp;&nbsp;</td></tr>
<?php endif; ?>

</table>
<span class="article_separator">&nbsp;</span>
</div>
<div>
<?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>

<div class="item-separator"></div>
<?php echo $this->item->event->afterDisplayContent; ?>
