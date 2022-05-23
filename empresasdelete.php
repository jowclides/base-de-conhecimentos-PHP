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
$empresas_delete = new empresas_delete();

// Run the page
$empresas_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$empresas_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fempresasdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fempresasdelete = currentForm = new ew.Form("fempresasdelete", "delete");
	loadjs.done("fempresasdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $empresas_delete->showPageHeader(); ?>
<?php
$empresas_delete->showMessage();
?>
<form name="fempresasdelete" id="fempresasdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="empresas">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($empresas_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($empresas_delete->id->Visible) { // id ?>
		<th class="<?php echo $empresas_delete->id->headerCellClass() ?>"><span id="elh_empresas_id" class="empresas_id"><?php echo $empresas_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($empresas_delete->nome_empreasa->Visible) { // nome_empreasa ?>
		<th class="<?php echo $empresas_delete->nome_empreasa->headerCellClass() ?>"><span id="elh_empresas_nome_empreasa" class="empresas_nome_empreasa"><?php echo $empresas_delete->nome_empreasa->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$empresas_delete->RecordCount = 0;
$i = 0;
while (!$empresas_delete->Recordset->EOF) {
	$empresas_delete->RecordCount++;
	$empresas_delete->RowCount++;

	// Set row properties
	$empresas->resetAttributes();
	$empresas->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$empresas_delete->loadRowValues($empresas_delete->Recordset);

	// Render row
	$empresas_delete->renderRow();
?>
	<tr <?php echo $empresas->rowAttributes() ?>>
<?php if ($empresas_delete->id->Visible) { // id ?>
		<td <?php echo $empresas_delete->id->cellAttributes() ?>>
<span id="el<?php echo $empresas_delete->RowCount ?>_empresas_id" class="empresas_id">
<span<?php echo $empresas_delete->id->viewAttributes() ?>><?php echo $empresas_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($empresas_delete->nome_empreasa->Visible) { // nome_empreasa ?>
		<td <?php echo $empresas_delete->nome_empreasa->cellAttributes() ?>>
<span id="el<?php echo $empresas_delete->RowCount ?>_empresas_nome_empreasa" class="empresas_nome_empreasa">
<span<?php echo $empresas_delete->nome_empreasa->viewAttributes() ?>><?php echo $empresas_delete->nome_empreasa->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$empresas_delete->Recordset->moveNext();
}
$empresas_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $empresas_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$empresas_delete->showPageFooter();
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
$empresas_delete->terminate();
?>