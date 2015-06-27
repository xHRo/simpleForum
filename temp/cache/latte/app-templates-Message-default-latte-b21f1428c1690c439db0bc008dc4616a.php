<?php
// source: C:\wamp\www\rocnikovy_projekt\app/templates/Message/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3954269109', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb16477df45d_content')) { function _lb16477df45d_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h2>Sent Messages</h2>
<?php $iterations = 0; foreach ($sentMessages as $message) { ?>
    <hr>
    <h4><?php echo Latte\Runtime\Filters::escapeHtml($message['title'], ENT_NOQUOTES) ?></h4>
    <?php echo Latte\Runtime\Filters::escapeHtml($message['message'], ENT_NOQUOTES) ?>

<?php $iterations++; } ?>

<h2>Received Messages</h2>
<?php $iterations = 0; foreach ($recievedMessages as $message) { ?>
    <hr>
    <h4><?php echo Latte\Runtime\Filters::escapeHtml($message['title'], ENT_NOQUOTES) ?></h4>
    <?php echo Latte\Runtime\Filters::escapeHtml($message['message'], ENT_NOQUOTES) ?>

<?php $iterations++; } ?>

<?php $_l->tmp = $_control->getComponent("createMessageForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 