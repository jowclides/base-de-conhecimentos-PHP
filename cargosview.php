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
$cargos_view = new cargos_view();

// Run the page
$cargos_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cargos_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cargos_view->isExport()) { ?>
<script>
var fcargosview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcargosview = currentForm = new ew.Form("fcargosview", "view");
	loadjs.done("fcargosview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cargos_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $cargos_view->ExportOptions->render("body") ?>
<?php $cargos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $cargos_view->showPageHeader(); ?>
<?php
$cargos_view->showMessage();
?>
<?php if (!$cargos_view->IsModal) { ?>
<?php if (!$cargos_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cargos_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcargosview" id="fcargosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cargos">
<input type="hidden" name="modal" value="<?php echo (int)$cargos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($cargos_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $cargos_view->TableLeftColumnClass ?>"><span id="elh_cargos_id"><?php echo $cargos_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $cargos_view->id->cellAttributes() ?>>
<span id="el_cargos_id">
<span<?php echo $cargos_view->id->viewAttributes() ?>><?php echo $cargos_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cargos_view->nome_cargo->Visible) { // nome_cargo ?>
	<tr id="r_nome_cargo">
		<td class="<?php echo $cargos_view->TableLeftColumnClass ?>"><span id="elh_cargos_nome_cargo"><?php echo $cargos_view->nome_cargo->caption() ?></span></td>
		<td data-name="nome_cargo" <?php echo $cargos_view->nome_cargo->cellAttributes() ?>>
<span id="el_cargos_nome_cargo">
<span<?php echo $cargos_view->nome_cargo->viewAttributes() ?>><?php echo $cargos_view->nome_cargo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$cargos_view->IsModal) { ?>
<?php if (!$cargos_view->isExport()) { ?>
<?php echo $cargos_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$cargos_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cargos_view->isExport()) { ?>
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
$cargos_view->terminate();
?>