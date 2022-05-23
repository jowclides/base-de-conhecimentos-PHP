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
$tarefas_delete = new tarefas_delete();

// Run the page
$tarefas_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tarefas_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftarefasdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftarefasdelete = currentForm = new ew.Form("ftarefasdelete", "delete");
	loadjs.done("ftarefasdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tarefas_delete->showPageHeader(); ?>
<?php
$tarefas_delete->showMessage();
?>
<form name="ftarefasdelete" id="ftarefasdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tarefas">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tarefas_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tarefas_delete->id->Visible) { // id ?>
		<th class="<?php echo $tarefas_delete->id->headerCellClass() ?>"><span id="elh_tarefas_id" class="tarefas_id"><?php echo $tarefas_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($tarefas_delete->titulo->Visible) { // titulo ?>
		<th class="<?php echo $tarefas_delete->titulo->headerCellClass() ?>"><span id="elh_tarefas_titulo" class="tarefas_titulo"><?php echo $tarefas_delete->titulo->caption() ?></span></th>
<?php } ?>
<?php if ($tarefas_delete->criticidade_id->Visible) { // criticidade_id ?>
		<th class="<?php echo $tarefas_delete->criticidade_id->headerCellClass() ?>"><span id="elh_tarefas_criticidade_id" class="tarefas_criticidade_id"><?php echo $tarefas_delete->criticidade_id->caption() ?></span></th>
<?php } ?>
<?php if ($tarefas_delete->owner->Visible) { // owner ?>
		<th class="<?php echo $tarefas_delete->owner->headerCellClass() ?>"><span id="elh_tarefas_owner" class="tarefas_owner"><?php echo $tarefas_delete->owner->caption() ?></span></th>
<?php } ?>
<?php if ($tarefas_delete->status->Visible) { // status ?>
		<th class="<?php echo $tarefas_delete->status->headerCellClass() ?>"><span id="elh_tarefas_status" class="tarefas_status"><?php echo $tarefas_delete->status->caption() ?></span></th>
<?php } ?>
<?php if ($tarefas_delete->prazo_entrega->Visible) { // prazo_entrega ?>
		<th class="<?php echo $tarefas_delete->prazo_entrega->headerCellClass() ?>"><span id="elh_tarefas_prazo_entrega" class="tarefas_prazo_entrega"><?php echo $tarefas_delete->prazo_entrega->caption() ?></span></th>
<?php } ?>
<?php if ($tarefas_delete->updated_at->Visible) { // updated_at ?>
		<th class="<?php echo $tarefas_delete->updated_at->headerCellClass() ?>"><span id="elh_tarefas_updated_at" class="tarefas_updated_at"><?php echo $tarefas_delete->updated_at->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tarefas_delete->RecordCount = 0;
$i = 0;
while (!$tarefas_delete->Recordset->EOF) {
	$tarefas_delete->RecordCount++;
	$tarefas_delete->RowCount++;

	// Set row properties
	$tarefas->resetAttributes();
	$tarefas->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tarefas_delete->loadRowValues($tarefas_delete->Recordset);

	// Render row
	$tarefas_delete->renderRow();
?>
	<tr <?php echo $tarefas->rowAttributes() ?>>
<?php if ($tarefas_delete->id->Visible) { // id ?>
		<td <?php echo $tarefas_delete->id->cellAttributes() ?>>
<span id="el<?php echo $tarefas_delete->RowCount ?>_tarefas_id" class="tarefas_id">
<span<?php echo $tarefas_delete->id->viewAttributes() ?>><?php echo $tarefas_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tarefas_delete->titulo->Visible) { // titulo ?>
		<td <?php echo $tarefas_delete->titulo->cellAttributes() ?>>
<span id="el<?php echo $tarefas_delete->RowCount ?>_tarefas_titulo" class="tarefas_titulo">
<span<?php echo $tarefas_delete->titulo->viewAttributes() ?>><?php echo $tarefas_delete->titulo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tarefas_delete->criticidade_id->Visible) { // criticidade_id ?>
		<td <?php echo $tarefas_delete->criticidade_id->cellAttributes() ?>>
<span id="el<?php echo $tarefas_delete->RowCount ?>_tarefas_criticidade_id" class="tarefas_criticidade_id">
<span<?php echo $tarefas_delete->criticidade_id->viewAttributes() ?>><?php echo $tarefas_delete->criticidade_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tarefas_delete->owner->Visible) { // owner ?>
		<td <?php echo $tarefas_delete->owner->cellAttributes() ?>>
<span id="el<?php echo $tarefas_delete->RowCount ?>_tarefas_owner" class="tarefas_owner">
<span<?php echo $tarefas_delete->owner->viewAttributes() ?>><?php echo $tarefas_delete->owner->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tarefas_delete->status->Visible) { // status ?>
		<td <?php echo $tarefas_delete->status->cellAttributes() ?>>
<span id="el<?php echo $tarefas_delete->RowCount ?>_tarefas_status" class="tarefas_status">
<span<?php echo $tarefas_delete->status->viewAttributes() ?>><?php echo $tarefas_delete->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tarefas_delete->prazo_entrega->Visible) { // prazo_entrega ?>
		<td <?php echo $tarefas_delete->prazo_entrega->cellAttributes() ?>>
<span id="el<?php echo $tarefas_delete->RowCount ?>_tarefas_prazo_entrega" class="tarefas_prazo_entrega">
<span<?php echo $tarefas_delete->prazo_entrega->viewAttributes() ?>><?php echo $tarefas_delete->prazo_entrega->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tarefas_delete->updated_at->Visible) { // updated_at ?>
		<td <?php echo $tarefas_delete->updated_at->cellAttributes() ?>>
<span id="el<?php echo $tarefas_delete->RowCount ?>_tarefas_updated_at" class="tarefas_updated_at">
<span<?php echo $tarefas_delete->updated_at->viewAttributes() ?>><?php echo $tarefas_delete->updated_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tarefas_delete->Recordset->moveNext();
}
$tarefas_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tarefas_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tarefas_delete->showPageFooter();
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
$tarefas_delete->terminate();
?>