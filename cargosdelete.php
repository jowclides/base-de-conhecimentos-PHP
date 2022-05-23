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
$cargos_delete = new cargos_delete();

// Run the page
$cargos_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cargos_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcargosdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcargosdelete = currentForm = new ew.Form("fcargosdelete", "delete");
	loadjs.done("fcargosdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cargos_delete->showPageHeader(); ?>
<?php
$cargos_delete->showMessage();
?>
<form name="fcargosdelete" id="fcargosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cargos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($cargos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($cargos_delete->id->Visible) { // id ?>
		<th class="<?php echo $cargos_delete->id->headerCellClass() ?>"><span id="elh_cargos_id" class="cargos_id"><?php echo $cargos_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($cargos_delete->nome_cargo->Visible) { // nome_cargo ?>
		<th class="<?php echo $cargos_delete->nome_cargo->headerCellClass() ?>"><span id="elh_cargos_nome_cargo" class="cargos_nome_cargo"><?php echo $cargos_delete->nome_cargo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$cargos_delete->RecordCount = 0;
$i = 0;
while (!$cargos_delete->Recordset->EOF) {
	$cargos_delete->RecordCount++;
	$cargos_delete->RowCount++;

	// Set row properties
	$cargos->resetAttributes();
	$cargos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$cargos_delete->loadRowValues($cargos_delete->Recordset);

	// Render row
	$cargos_delete->renderRow();
?>
	<tr <?php echo $cargos->rowAttributes() ?>>
<?php if ($cargos_delete->id->Visible) { // id ?>
		<td <?php echo $cargos_delete->id->cellAttributes() ?>>
<span id="el<?php echo $cargos_delete->RowCount ?>_cargos_id" class="cargos_id">
<span<?php echo $cargos_delete->id->viewAttributes() ?>><?php echo $cargos_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cargos_delete->nome_cargo->Visible) { // nome_cargo ?>
		<td <?php echo $cargos_delete->nome_cargo->cellAttributes() ?>>
<span id="el<?php echo $cargos_delete->RowCount ?>_cargos_nome_cargo" class="cargos_nome_cargo">
<span<?php echo $cargos_delete->nome_cargo->viewAttributes() ?>><?php echo $cargos_delete->nome_cargo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$cargos_delete->Recordset->moveNext();
}
$cargos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cargos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$cargos_delete->showPageFooter();
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
$cargos_delete->terminate();
?>