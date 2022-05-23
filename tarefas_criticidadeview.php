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
$tarefas_criticidade_view = new tarefas_criticidade_view();

// Run the page
$tarefas_criticidade_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tarefas_criticidade_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tarefas_criticidade_view->isExport()) { ?>
<script>
var ftarefas_criticidadeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftarefas_criticidadeview = currentForm = new ew.Form("ftarefas_criticidadeview", "view");
	loadjs.done("ftarefas_criticidadeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tarefas_criticidade_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tarefas_criticidade_view->ExportOptions->render("body") ?>
<?php $tarefas_criticidade_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tarefas_criticidade_view->showPageHeader(); ?>
<?php
$tarefas_criticidade_view->showMessage();
?>
<?php if (!$tarefas_criticidade_view->IsModal) { ?>
<?php if (!$tarefas_criticidade_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tarefas_criticidade_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="ftarefas_criticidadeview" id="ftarefas_criticidadeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tarefas_criticidade">
<input type="hidden" name="modal" value="<?php echo (int)$tarefas_criticidade_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tarefas_criticidade_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $tarefas_criticidade_view->TableLeftColumnClass ?>"><span id="elh_tarefas_criticidade_id"><?php echo $tarefas_criticidade_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $tarefas_criticidade_view->id->cellAttributes() ?>>
<span id="el_tarefas_criticidade_id">
<span<?php echo $tarefas_criticidade_view->id->viewAttributes() ?>><?php echo $tarefas_criticidade_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tarefas_criticidade_view->criticidade->Visible) { // criticidade ?>
	<tr id="r_criticidade">
		<td class="<?php echo $tarefas_criticidade_view->TableLeftColumnClass ?>"><span id="elh_tarefas_criticidade_criticidade"><?php echo $tarefas_criticidade_view->criticidade->caption() ?></span></td>
		<td data-name="criticidade" <?php echo $tarefas_criticidade_view->criticidade->cellAttributes() ?>>
<span id="el_tarefas_criticidade_criticidade">
<span<?php echo $tarefas_criticidade_view->criticidade->viewAttributes() ?>><?php echo $tarefas_criticidade_view->criticidade->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$tarefas_criticidade_view->IsModal) { ?>
<?php if (!$tarefas_criticidade_view->isExport()) { ?>
<?php echo $tarefas_criticidade_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$tarefas_criticidade_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tarefas_criticidade_view->isExport()) { ?>
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
$tarefas_criticidade_view->terminate();
?>