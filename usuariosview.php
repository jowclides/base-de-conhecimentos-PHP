<?php
namespace PHPMaker2020\PHPMAKER_Contatos;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$usuarios_view = new usuarios_view();

// Run the page
$usuarios_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuarios_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$usuarios_view->isExport()) { ?>
<script>
var fusuariosview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fusuariosview = currentForm = new ew.Form("fusuariosview", "view");
	loadjs.done("fusuariosview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$usuarios_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $usuarios_view->ExportOptions->render("body") ?>
<?php $usuarios_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $usuarios_view->showPageHeader(); ?>
<?php
$usuarios_view->showMessage();
?>
<?php if (!$usuarios_view->IsModal) { ?>
<?php if (!$usuarios_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $usuarios_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fusuariosview" id="fusuariosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuarios">
<input type="hidden" name="modal" value="<?php echo (int)$usuarios_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($usuarios_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_id"><?php echo $usuarios_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $usuarios_view->id->cellAttributes() ?>>
<span id="el_usuarios_id">
<span<?php echo $usuarios_view->id->viewAttributes() ?>><?php echo $usuarios_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuarios_view->usuario->Visible) { // usuario ?>
	<tr id="r_usuario">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_usuario"><?php echo $usuarios_view->usuario->caption() ?></span></td>
		<td data-name="usuario" <?php echo $usuarios_view->usuario->cellAttributes() ?>>
<span id="el_usuarios_usuario">
<span<?php echo $usuarios_view->usuario->viewAttributes() ?>><?php echo $usuarios_view->usuario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuarios_view->senha->Visible) { // senha ?>
	<tr id="r_senha">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_senha"><?php echo $usuarios_view->senha->caption() ?></span></td>
		<td data-name="senha" <?php echo $usuarios_view->senha->cellAttributes() ?>>
<span id="el_usuarios_senha">
<span<?php echo $usuarios_view->senha->viewAttributes() ?>><?php echo $usuarios_view->senha->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuarios_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios__email"><?php echo $usuarios_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $usuarios_view->_email->cellAttributes() ?>>
<span id="el_usuarios__email">
<span<?php echo $usuarios_view->_email->viewAttributes() ?>><?php echo $usuarios_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuarios_view->ativado->Visible) { // ativado ?>
	<tr id="r_ativado">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_ativado"><?php echo $usuarios_view->ativado->caption() ?></span></td>
		<td data-name="ativado" <?php echo $usuarios_view->ativado->cellAttributes() ?>>
<span id="el_usuarios_ativado">
<span<?php echo $usuarios_view->ativado->viewAttributes() ?>><?php echo $usuarios_view->ativado->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuarios_view->userlevel->Visible) { // userlevel ?>
	<tr id="r_userlevel">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_userlevel"><?php echo $usuarios_view->userlevel->caption() ?></span></td>
		<td data-name="userlevel" <?php echo $usuarios_view->userlevel->cellAttributes() ?>>
<span id="el_usuarios_userlevel">
<span<?php echo $usuarios_view->userlevel->viewAttributes() ?>><?php echo $usuarios_view->userlevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$usuarios_view->IsModal) { ?>
<?php if (!$usuarios_view->isExport()) { ?>
<?php echo $usuarios_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$usuarios_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$usuarios_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$usuarios_view->terminate();
?>