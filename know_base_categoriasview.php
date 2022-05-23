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
$know_base_categorias_view = new know_base_categorias_view();

// Run the page
$know_base_categorias_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$know_base_categorias_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$know_base_categorias_view->isExport()) { ?>
<script>
var fknow_base_categoriasview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fknow_base_categoriasview = currentForm = new ew.Form("fknow_base_categoriasview", "view");
	loadjs.done("fknow_base_categoriasview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$know_base_categorias_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $know_base_categorias_view->ExportOptions->render("body") ?>
<?php $know_base_categorias_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $know_base_categorias_view->showPageHeader(); ?>
<?php
$know_base_categorias_view->showMessage();
?>
<?php if (!$know_base_categorias_view->IsModal) { ?>
<?php if (!$know_base_categorias_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $know_base_categorias_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fknow_base_categoriasview" id="fknow_base_categoriasview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="know_base_categorias">
<input type="hidden" name="modal" value="<?php echo (int)$know_base_categorias_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($know_base_categorias_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $know_base_categorias_view->TableLeftColumnClass ?>"><span id="elh_know_base_categorias_id"><?php echo $know_base_categorias_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $know_base_categorias_view->id->cellAttributes() ?>>
<span id="el_know_base_categorias_id">
<span<?php echo $know_base_categorias_view->id->viewAttributes() ?>><?php echo $know_base_categorias_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($know_base_categorias_view->nome_categoria->Visible) { // nome_categoria ?>
	<tr id="r_nome_categoria">
		<td class="<?php echo $know_base_categorias_view->TableLeftColumnClass ?>"><span id="elh_know_base_categorias_nome_categoria"><?php echo $know_base_categorias_view->nome_categoria->caption() ?></span></td>
		<td data-name="nome_categoria" <?php echo $know_base_categorias_view->nome_categoria->cellAttributes() ?>>
<span id="el_know_base_categorias_nome_categoria">
<span<?php echo $know_base_categorias_view->nome_categoria->viewAttributes() ?>><?php echo $know_base_categorias_view->nome_categoria->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$know_base_categorias_view->IsModal) { ?>
<?php if (!$know_base_categorias_view->isExport()) { ?>
<?php echo $know_base_categorias_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$know_base_categorias_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$know_base_categorias_view->isExport()) { ?>
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
$know_base_categorias_view->terminate();
?>