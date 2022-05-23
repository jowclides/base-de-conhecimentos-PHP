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
$tarefas_criticidade_delete = new tarefas_criticidade_delete();

// Run the page
$tarefas_criticidade_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tarefas_criticidade_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftarefas_criticidadedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftarefas_criticidadedelete = currentForm = new ew.Form("ftarefas_criticidadedelete", "delete");
	loadjs.done("ftarefas_criticidadedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tarefas_criticidade_delete->showPageHeader(); ?>
<?php
$tarefas_criticidade_delete->showMessage();
?>
<form name="ftarefas_criticidadedelete" id="ftarefas_criticidadedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tarefas_criticidade">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tarefas_criticidade_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tarefas_criticidade_delete->id->Visible) { // id ?>
		<th class="<?php echo $tarefas_criticidade_delete->id->headerCellClass() ?>"><span id="elh_tarefas_criticidade_id" class="tarefas_criticidade_id"><?php echo $tarefas_criticidade_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($tarefas_criticidade_delete->criticidade->Visible) { // criticidade ?>
		<th class="<?php echo $tarefas_criticidade_delete->criticidade->headerCellClass() ?>"><span id="elh_tarefas_criticidade_criticidade" class="tarefas_criticidade_criticidade"><?php echo $tarefas_criticidade_delete->criticidade->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tarefas_criticidade_delete->RecordCount = 0;
$i = 0;
while (!$tarefas_criticidade_delete->Recordset->EOF) {
	$tarefas_criticidade_delete->RecordCount++;
	$tarefas_criticidade_delete->RowCount++;

	// Set row properties
	$tarefas_criticidade->resetAttributes();
	$tarefas_criticidade->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tarefas_criticidade_delete->loadRowValues($tarefas_criticidade_delete->Recordset);

	// Render row
	$tarefas_criticidade_delete->renderRow();
?>
	<tr <?php echo $tarefas_criticidade->rowAttributes() ?>>
<?php if ($tarefas_criticidade_delete->id->Visible) { // id ?>
		<td <?php echo $tarefas_criticidade_delete->id->cellAttributes() ?>>
<span id="el<?php echo $tarefas_criticidade_delete->RowCount ?>_tarefas_criticidade_id" class="tarefas_criticidade_id">
<span<?php echo $tarefas_criticidade_delete->id->viewAttributes() ?>><?php echo $tarefas_criticidade_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tarefas_criticidade_delete->criticidade->Visible) { // criticidade ?>
		<td <?php echo $tarefas_criticidade_delete->criticidade->cellAttributes() ?>>
<span id="el<?php echo $tarefas_criticidade_delete->RowCount ?>_tarefas_criticidade_criticidade" class="tarefas_criticidade_criticidade">
<span<?php echo $tarefas_criticidade_delete->criticidade->viewAttributes() ?>><?php echo $tarefas_criticidade_delete->criticidade->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tarefas_criticidade_delete->Recordset->moveNext();
}
$tarefas_criticidade_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tarefas_criticidade_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tarefas_criticidade_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$tarefas_criticidade_delete->terminate();
?>