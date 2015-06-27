<?php
// source: C:\wamp\www\rocnikovy_projekt\app/templates/Homepage/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7887360691', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb782bdf4294_content')) { function _lb782bdf4294_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><!-- CONTENT -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9 mainContent">
            <div class="title-content">
                <h1>Hot Topics</h1>
            </div>
            <div class="mainContent-text">
                <table id="hotTopics">
                    <tr>
                        <th>Topic</th>
                        <th>Category</th>
                        <th>Last Post By</th>
                    </tr>
                    <tr>
                        <td>Some Topic</td>
                        <td>C/C++</td>
                        <td>Andrew</td>
                    </tr>
                    <tr>
                        <td>Some Topic</td>
                        <td>Python</td>
                        <td>John</td>
                    </tr>
                    <tr>
                        <td>Some Topic</td>
                        <td>Java</td>
                        <td>James</td>
                    </tr>
                </table>
            </div>



            <div class="title-content">
                <h1>Categories</h1>
            </div>
            <div class="mainContent-text">

                <table id="customers">
                    <tr>
                        <th>Category</th>
                        <th>Number of Topics</th>
                        <th>Number of Replies</th>
                    </tr>
<?php $iterations = 0; foreach ($categories as $category) { ?>
                        <tr>
                            <td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("ViewCategory:default", array($category->id)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($category->name, ENT_NOQUOTES) ?></a>
                                <p class="tfooter"><?php echo Latte\Runtime\Filters::escapeHtml($category->description, ENT_NOQUOTES) ?></p></td>
                            <td><p class="stats"><?php echo Latte\Runtime\Filters::escapeHtml($numTopics[$category['id']], ENT_NOQUOTES) ?></p></td>
                            <td><?php echo Latte\Runtime\Filters::escapeHtml($numReplies[$category['id']], ENT_NOQUOTES) ?></td>
<?php $iterations++; } ?>
                </table>

            </div>               


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
                <h1>Best Users</h1>
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