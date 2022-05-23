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
$tarefas_view = new tarefas_view();

// Run the page
$tarefas_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tarefas_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tarefas_view->isExport()) { ?>
<script>
var ftarefasview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftarefasview = currentForm = new ew.Form("ftarefasview", "view");
	loadjs.done("ftarefasview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tarefas_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tarefas_view->ExportOptions->render("body") ?>
<?php $tarefas_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tarefas_view->showPageHeader(); ?>
<?php
$tarefas_view->showMessage();
?>
<?php if (!$tarefas_view->IsModal) { ?>
<?php if (!$tarefas_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tarefas_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="ftarefasview" id="ftarefasview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tarefas">
<input type="hidden" name="modal" value="<?php echo (int)$tarefas_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tarefas_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $tarefas_view->TableLeftColumnClass ?>"><span id="elh_tarefas_id"><?php echo $tarefas_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $tarefas_view->id->cellAttributes() ?>>
<span id="el_tarefas_id">
<span<?php echo $tarefas_view->id->viewAttributes() ?>><?php echo $tarefas_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tarefas_view->titulo->Visible) { // titulo ?>
	<tr id="r_titulo">
		<td class="<?php echo $tarefas_view->TableLeftColumnClass ?>"><span id="elh_tarefas_titulo"><?php echo $tarefas_view->titulo->caption() ?></span></td>
		<td data-name="titulo" <?php echo $tarefas_view->titulo->cellAttributes() ?>>
<span id="el_tarefas_titulo">
<span<?php echo $tarefas_view->titulo->viewAttributes() ?>><?php echo $tarefas_view->titulo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tarefas_view->criticidade_id->Visible) { // criticidade_id ?>
	<tr id="r_criticidade_id">
		<td class="<?php echo $tarefas_view->TableLeftColumnClass ?>"><span id="elh_tarefas_criticidade_id"><?php echo $tarefas_view->criticidade_id->caption() ?></span></td>
		<td data-name="criticidade_id" <?php echo $tarefas_view->criticidade_id->cellAttributes() ?>>
<span id="el_tarefas_criticidade_id">
<span<?php echo $tarefas_view->criticidade_id->viewAttributes() ?>><?php echo $tarefas_view->criticidade_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tarefas_view->owner->Visible) { // owner ?>
	<tr id="r_owner">
		<td class="<?php echo $tarefas_view->TableLeftColumnClass ?>"><span id="elh_tarefas_owner"><?php echo $tarefas_view->owner->caption() ?></span></td>
		<td data-name="owner" <?php echo $tarefas_view->owner->cellAttributes() ?>>
<span id="el_tarefas_owner">
<span<?php echo $tarefas_view->owner->viewAttributes() ?>><?php echo $tarefas_view->owner->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tarefas_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $tarefas_view->TableLeftColumnClass ?>"><span id="elh_tarefas_status"><?php echo $tarefas_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $tarefas_view->status->cellAttributes() ?>>
<span id="el_tarefas_status">
<span<?php echo $tarefas_view->status->viewAttributes() ?>><?php echo $tarefas_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tarefas_view->prazo_entrega->Visible) { // prazo_entrega ?>
	<tr id="r_prazo_entrega">
		<td class="<?php echo $tarefas_view->TableLeftColumnClass ?>"><span id="elh_tarefas_prazo_entrega"><?php echo $tarefas_view->prazo_entrega->caption() ?></span></td>
		<td data-name="prazo_entrega" <?php echo $tarefas_view->prazo_entrega->cellAttributes() ?>>
<span id="el_tarefas_prazo_entrega">
<span<?php echo $tarefas_view->prazo_entrega->viewAttributes() ?>><?php echo $tarefas_view->prazo_entrega->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tarefas_view->memo->Visible) { // memo ?>
	<tr id="r_memo">
		<td class="<?php echo $tarefas_view->TableLeftColumnClass ?>"><span id="elh_tarefas_memo"><?php echo $tarefas_view->memo->caption() ?></span></td>
		<td data-name="memo" <?php echo $tarefas_view->memo->cellAttributes() ?>>
<span id="el_tarefas_memo">
<span<?php echo $tarefas_view->memo->viewAttributes() ?>><?php echo $tarefas_view->memo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tarefas_view->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $tarefas_view->TableLeftColumnClass ?>"><span id="elh_tarefas_updated_at"><?php echo $tarefas_view->updated_at->caption() ?></span></td>
		<td data-name="updated_at" <?php echo $tarefas_view->updated_at->cellAttributes() ?>>
<span id="el_tarefas_updated_at">
<span<?php echo $tarefas_view->updated_at->viewAttributes() ?>><?php echo $tarefas_view->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$tarefas_view->IsModal) { ?>
<?php if (!$tarefas_view->isExport()) { ?>
<?php echo $tarefas_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$tarefas_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tarefas_view->isExport()) { ?>
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
$tarefas_view->terminate();
?>