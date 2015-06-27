<?php
// source: C:\wamp\www\rocnikovy_projekt\app/templates/@layout.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2953809710', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb6bcb1e3f99_head')) { function _lb6bcb1e3f99_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lbaf0833481a_scripts')) { function _lbaf0833481a_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/jquery.js"></script>
        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/netteForms.js"></script>
        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/main.js"></script>
        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/bootstrap.js"></script>
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
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php if (isset($_b->blocks["title"])) { ob_start(); Latte\Macros\BlockMacros::callBlock($_b, 'title', $template->getParameters()); echo $template->striptags(ob_get_clean()) ?>
 | <?php } ?>CodeIt Forum</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" media="screen,projection,tv" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/bootstrap.css">
        <link rel="stylesheet" media="screen,projection,tv" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/screen.css">

        <link rel="shortcut icon" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/favicon.ico">
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars())  ?>


        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
          <script src="../bower_components/respond/dest/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>    
        <script> document.documentElement.className += ' js'</script>
<?php $iterations = 0; foreach ($flashes as $flash) { ?>        <div class="flash <?php echo Latte\Runtime\Filters::escapeHtml($flash->type, ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>

        <!-- NAVIGATION -->
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="../" class="navbar-brand">CodeIt Forum / logo</a>

                </div>
                <div class="navbar-collapse collapse" id="navbar-main">
                    <ul class="nav navbar-nav">
                        <li><a href="#aboutModal" role="button" data-toggle="modal">About</a></li>
                    </ul>
                    <div class="navbar-collapse collapse">


<?php if (!$user->isLoggedIn()) { ?>
                            <?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["loginForm"], array('class'=>'navbar-form navbar-right')) ?>

                                <div class="form-group"><?php echo $_form["username"]->getControl()->addAttributes(array('class'=>'form-control','placeholder'=>'Username')) ?></div>
                                <div class="form-group"><?php echo $_form["password"]->getControl()->addAttributes(array('class'=>'form-control','placeholder'=>'Heslo')) ?></div>
                                <?php echo $_form["send"]->getControl()->addAttributes(array('class'=>'btn btn-success')) ?>

                                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("SignUp:default"), ENT_COMPAT) ?>" class="btn btn-danger" role="button">
                                    Sign Up
                                </a>
                            <?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>

<?php } else { ?>
                            <ul class="nav navbar-nav navbar-right">
                                <?php if ($user->isInRole('admin')) { ?>                                     <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Admin:"), ENT_COMPAT) ?>
">Administrace</a></li>
<?php } ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo Latte\Runtime\Filters::escapeHtml($user->identity->email, ENT_NOQUOTES) ?><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("EditProfile:default"), ENT_COMPAT) ?>">Edit Profile</a></li>
                                        <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Message:"), ENT_COMPAT) ?>
">Messages</a></li>
                                        <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("logout!"), ENT_COMPAT) ?>
">Odhlásit</a></li>
                                    </ul>
                                </li>

                            </ul>
<?php } ?>

                    </div>

                </div>
            </div>
        </div>
        <!-- END OF NAVIGATION -->

        <!--ABOUT FORUM -->
        <div id="aboutModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="text-center">About this forum</h2>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 text-center">
                            The purpose of this forum is the mutual assistance between programmers.
                            <hr>
                            <ul>
                                <b>What's new?</b>
                                <li>The directory layout</li>
                                <li>Nette Framework is installed</li>
                                <li>.htaccess files are configured</li>
                                <li>Basic design is completed</li>
                                <li>Database is created</li>
                            </ul>


                            <hr>
                            Actual version of CodeIt Forum: 0.1 (First Phase)<br>
                            Created by: Martin Fiala
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">OK</button>
                    </div>
                </div>
            </div>
        </div>

<?php Latte\Macros\BlockMacros::callBlock($_b, 'content', $template->getParameters()) ?>

        <!-- END OF CONTENT -->                
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 myFooter">
                    2014/2015 - Copyright c Martin Fiala.
                </div>
            </div>
        </div>




<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars())  ?>

    </body>
</html>
