<?php
// source: C:\wamp\www\rocnikovy_projekt\app/templates/ViewCategory/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('5815853979', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbed0b87f498_content')) { function _lbed0b87f498_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><!-- CONTENT -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mainContent">
            
<?php if ($user->isLoggedIn() && !($user->getIdentity()->user_in_role != 'newbie ')) { ?>
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("CreateTopic:default"), ENT_COMPAT) ?>" class="btn btn-primary btn-lg" role="button">
                Create New Topic
            </a>
<?php } ?>
            
            <div class="title-content">
                <h1>All Topics in <?php echo Latte\Runtime\Filters::escapeHtml($categoryName, ENT_NOQUOTES) ?> Category</h1>
            </div>
            <div class="mainContent-text">
                <table id="customers">
                    <tr>
                        <th>Topic</th>
                        <th>Replies Count</th>
                        <th>Last Reply</th>
                    </tr>
<?php $iterations = 0; foreach ($topicsInCategory as $topic) { ?>
                        <tr>
                            <td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("ViewTopic:show", array($topic->id)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($topic->title, ENT_NOQUOTES) ?></a></td>
                            <td><p class="stats"><?php echo Latte\Runtime\Filters::escapeHtml($numReplies[$topic['id']], ENT_NOQUOTES) ?></p></td>
                            <td><?php echo Latte\Runtime\Filters::escapeHtml($lastActivity[$topic['id']], ENT_NOQUOTES) ?></td>
                        </tr>
<?php $iterations++; } ?>
                </table>
            </div>

 
        
        </div>

    </div>

</div><?php
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