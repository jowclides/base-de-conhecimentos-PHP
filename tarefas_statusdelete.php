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
$tarefas_status_delete = new tarefas_status_delete();

// Run the page
$tarefas_status_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tarefas_status_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftarefas_statusdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftarefas_statusdelete = currentForm = new ew.Form("ftarefas_statusdelete", "delete");
	loadjs.done("ftarefas_statusdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tarefas_status_delete->showPageHeader(); ?>
<?php
$tarefas_status_delete->showMessage();
?>
<form name="ftarefas_statusdelete" id="ftarefas_statusdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tarefas_status">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tarefas_status_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tarefas_status_delete->id->Visible) { // id ?>
		<th class="<?php echo $tarefas_status_delete->id->headerCellClass() ?>"><span id="elh_tarefas_status_id" class="tarefas_status_id"><?php echo $tarefas_status_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($tarefas_status_delete->status->Visible) { // status ?>
		<th class="<?php echo $tarefas_status_delete->status->headerCellClass() ?>"><span id="elh_tarefas_status_status" class="tarefas_status_status"><?php echo $tarefas_status_delete->status->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tarefas_status_delete->RecordCount = 0;
$i = 0;
while (!$tarefas_status_delete->Recordset->EOF) {
	$tarefas_status_delete->RecordCount++;
	$tarefas_status_delete->RowCount++;

	// Set row properties
	$tarefas_status->resetAttributes();
	$tarefas_status->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tarefas_status_delete->loadRowValues($tarefas_status_delete->Recordset);

	// Render row
	$tarefas_status_delete->renderRow();
?>
	<tr <?php echo $tarefas_status->rowAttributes() ?>>
<?php if ($tarefas_status_delete->id->Visible) { // id ?>
		<td <?php echo $tarefas_status_delete->id->cellAttributes() ?>>
<span id="el<?php echo $tarefas_status_delete->RowCount ?>_tarefas_status_id" class="tarefas_status_id">
<span<?php echo $tarefas_status_delete->id->viewAttributes() ?>><?php echo $tarefas_status_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tarefas_status_delete->status->Visible) { // status ?>
		<td <?php echo $tarefas_status_delete->status->cellAttributes() ?>>
<span id="el<?php echo $tarefas_status_delete->RowCount ?>_tarefas_status_status" class="tarefas_status_status">
<span<?php echo $tarefas_status_delete->status->viewAttributes() ?>><?php echo $tarefas_status_delete->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tarefas_status_delete->Recordset->moveNext();
}
$tarefas_status_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tarefas_status_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tarefas_status_delete->showPageFooter();
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
$tarefas_status_delete->terminate();
?>