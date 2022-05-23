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
$empresas_view = new empresas_view();

// Run the page
$empresas_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$empresas_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$empresas_view->isExport()) { ?>
<script>
var fempresasview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fempresasview = currentForm = new ew.Form("fempresasview", "view");
	loadjs.done("fempresasview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$empresas_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $empresas_view->ExportOptions->render("body") ?>
<?php $empresas_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $empresas_view->showPageHeader(); ?>
<?php
$empresas_view->showMessage();
?>
<?php if (!$empresas_view->IsModal) { ?>
<?php if (!$empresas_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $empresas_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fempresasview" id="fempresasview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="empresas">
<input type="hidden" name="modal" value="<?php echo (int)$empresas_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($empresas_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $empresas_view->TableLeftColumnClass ?>"><span id="elh_empresas_id"><?php echo $empresas_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $empresas_view->id->cellAttributes() ?>>
<span id="el_empresas_id">
<span<?php echo $empresas_view->id->viewAttributes() ?>><?php echo $empresas_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($empresas_view->nome_empreasa->Visible) { // nome_empreasa ?>
	<tr id="r_nome_empreasa">
		<td class="<?php echo $empresas_view->TableLeftColumnClass ?>"><span id="elh_empresas_nome_empreasa"><?php echo $empresas_view->nome_empreasa->caption() ?></span></td>
		<td data-name="nome_empreasa" <?php echo $empresas_view->nome_empreasa->cellAttributes() ?>>
<span id="el_empresas_nome_empreasa">
<span<?php echo $empresas_view->nome_empreasa->viewAttributes() ?>><?php echo $empresas_view->nome_empreasa->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$empresas_view->IsModal) { ?>
<?php if (!$empresas_view->isExport()) { ?>
<?php echo $empresas_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$empresas_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$empresas_view->isExport()) { ?>
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
$empresas_view->terminate();
?>