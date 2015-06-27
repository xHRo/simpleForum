<?php
// source: C:\wamp\www\rocnikovy_projekt\app/templates/ViewTopic/show.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6117745669', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbd8d7cc3beb_content')) { function _lbd8d7cc3beb_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <!-- CONTENT -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 mainContent">
                
<?php if ($user->isLoggedIn() && ($user->getIdentity()->user_in_role != 'newbie ')) { ?>
                    
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("CreateTopic:default"), ENT_COMPAT) ?>" class="btn btn-primary btn-lg" role="button">
                Create New Topic
            </a>
<?php if ($user->getIdentity()->user_in_role == "admin" && $isLocked == 0) { ?>
            <a class="btn btn-danger btn-lg" role="button" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("lockTopic!"), ENT_COMPAT) ?>
">
                Lock Topic
            </a>
<?php } ?>
            
            
<?php } ?>
                <div class="title-content">
                    <h1><?php echo Latte\Runtime\Filters::escapeHtml($topic->title, ENT_NOQUOTES) ?></h1>
                        
                </div>
                
                    <li id="main-topic" class="topic topic">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="user-info">
                                    <img class="avatar pull-left" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUrl), ENT_COMPAT) ?>
/www/images/avatars/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($usernameTable->avatar), ENT_COMPAT) ?>">
                                    <ul>
                                        <li><strong><?php echo Latte\Runtime\Filters::escapeHtml($usernameTable->username, ENT_NOQUOTES) ?></strong></li>
                                        <li><?php echo Latte\Runtime\Filters::escapeHtml($usernameTable->numPosts, ENT_NOQUOTES) ?> Posts</li>
                                       
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="topic-content pull right">
                                    <div class="content pull right">
                                        <?php echo Latte\Runtime\Filters::escapeHtml($topic->body, ENT_NOQUOTES) ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                
                
   
                    
<?php $iterations = 0; foreach ($replies as $reply) { ?>
                    <li class="topic topic">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="user-info">
                                    <img class="avatar pull-left" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUrl), ENT_COMPAT) ?>
/www/images/avatars/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($userInfo[$reply->id]->avatar), ENT_COMPAT) ?>">
                                    <ul>
                                        <li><strong><?php echo Latte\Runtime\Filters::escapeHtml($userInfo[$reply->id]->name, ENT_NOQUOTES) ?></strong></li>
                                        <li><?php echo Latte\Runtime\Filters::escapeHtml($userInfo[$reply->id]->numPosts, ENT_NOQUOTES) ?> Posts</li>
                                        <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("decreaseKarma!", array($reply->id)), ENT_COMPAT) ?>
"><button>-</button></a>Karma: <?php echo Latte\Runtime\Filters::escapeHtml($replyInfo[$reply->id], ENT_NOQUOTES) ?>
<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("increaseKarma!", array($reply->id)), ENT_COMPAT) ?>
"><button>+</button></a></li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="col-md-9">
                                <div class="topic-content pull right">
                                    <div class="content pull right">
                                        <?php echo Latte\Runtime\Filters::escapeHtml($reply->body, ENT_NOQUOTES) ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>        
<?php $iterations++; } ?>
                    
                    <div style="text-align: center">
                        <ul class="pagination" style="margin: 0 0 15px;">
                            <li <?php if ($paginator->first) { ?>class="disabled"<?php } ?>
><a <?php if ($paginator->first == false) { ?>href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("ViewTopic:show", array($topicId, 1)), ENT_COMPAT) ?>
"<?php } ?>>&laquo;</a></li>
                            <?php for ($i = 1; $i <= $paginator->pageCount; $i++) { ?>
<li <?php if ($paginator->getPage() == $i) { ?>class="active"<?php } ?>><!--PAGE--><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("ViewTopic:show", array($topicId, $i)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($i, ENT_NOQUOTES) ?></a></li><?php } ?>

                            <li <?php if ($paginator->last) { ?>class="disabled"<?php } ?>
><a <?php if ($paginator->last == false) { ?>href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("ViewTopic:show", array($topicId, $paginator->pageCount)), ENT_COMPAT) ?>
"<?php } ?>>&raquo;</a></li>
                        </ul>
                    </div>                     
                        
                    
<?php if ($user->isLoggedIn() && $isLocked == 0) { $_l->tmp = $_control->getComponent("replyForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;} ?>
            </div>
            
            
        <div class="col-md-3 background-sidebar">
            <div class="title-sidebar">
                <h1>Last Topics</h1>
            </div>
            <div class="sidebarContent">

                <table id="hotTopics">
                    <tr>
                        <th>Topic</th>
                        <th>Last Post By</th>
                    </tr>
                    <tr>
                        <td>Some Topic</td>
                        <td>Andrew</td>
                    </tr>
                    <tr>
                        <td>Some Topic</td>
                        <td>John</td>
                    </tr>
                    <tr>
                        <td>Some Topic</td>
                        <td>James</td>
                    </tr>


                </table>
            </div>


            <div class="title-sidebar">
                <h1>Recent Replies</h1>
            </div>
            <div class="sidebarContent">
                <table id="hotTopics">
                    <tr>
                        <th>Topic</th>
                        <th>Last Post By</th>
                    </tr>
                    <tr>
                        <td>Some Topic</td>
                        <td>Andrew</td>
                    </tr>
                    <tr>
                        <td>Some Topic</td>
                        <td>John</td>
                    </tr>
                    <tr>
                        <td>Some Topic</td>
                        <td>James</td>
                    </tr>


                </table>
            </div>


            <div class="title-sidebar">
                <h1>Best Users</h1>
            </div>
            <div class="sidebarContent">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Topic</th>
                            <th>Replies</th>
                            <th>Last Post By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tanmay</td>
                            <td>Bangalore</td>
                            <td>560001</td>
                        </tr>
                        <tr>
                            <td>Sachin</td>
                            <td>Mumbai</td>
                            <td>400003</td>
                        </tr>
                        <tr>
                            <td>Uma</td>
                            <td>Pune</td>
                            <td>411027</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>  
        </div>
   
    </div>
<?php
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
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ?>
    