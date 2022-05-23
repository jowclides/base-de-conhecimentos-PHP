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
$know_base_categorias_delete = new know_base_categorias_delete();

// Run the page
$know_base_categorias_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$know_base_categorias_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fknow_base_categoriasdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fknow_base_categoriasdelete = currentForm = new ew.Form("fknow_base_categoriasdelete", "delete");
	loadjs.done("fknow_base_categoriasdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $know_base_categorias_delete->showPageHeader(); ?>
<?php
$know_base_categorias_delete->showMessage();
?>
<form name="fknow_base_categoriasdelete" id="fknow_base_categoriasdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="know_base_categorias">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($know_base_categorias_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($know_base_categorias_delete->id->Visible) { // id ?>
		<th class="<?php echo $know_base_categorias_delete->id->headerCellClass() ?>"><span id="elh_know_base_categorias_id" class="know_base_categorias_id"><?php echo $know_base_categorias_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($know_base_categorias_delete->nome_categoria->Visible) { // nome_categoria ?>
		<th class="<?php echo $know_base_categorias_delete->nome_categoria->headerCellClass() ?>"><span id="elh_know_base_categorias_nome_categoria" class="know_base_categorias_nome_categoria"><?php echo $know_base_categorias_delete->nome_categoria->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$know_base_categorias_delete->RecordCount = 0;
$i = 0;
while (!$know_base_categorias_delete->Recordset->EOF) {
	$know_base_categorias_delete->RecordCount++;
	$know_base_categorias_delete->RowCount++;

	// Set row properties
	$know_base_categorias->resetAttributes();
	$know_base_categorias->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$know_base_categorias_delete->loadRowValues($know_base_categorias_delete->Recordset);

	// Render row
	$know_base_categorias_delete->renderRow();
?>
	<tr <?php echo $know_base_categorias->rowAttributes() ?>>
<?php if ($know_base_categorias_delete->id->Visible) { // id ?>
		<td <?php echo $know_base_categorias_delete->id->cellAttributes() ?>>
<span id="el<?php echo $know_base_categorias_delete->RowCount ?>_know_base_categorias_id" class="know_base_categorias_id">
<span<?php echo $know_base_categorias_delete->id->viewAttributes() ?>><?php echo $know_base_categorias_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($know_base_categorias_delete->nome_categoria->Visible) { // nome_categoria ?>
		<td <?php echo $know_base_categorias_delete->nome_categoria->cellAttributes() ?>>
<span id="el<?php echo $know_base_categorias_delete->RowCount ?>_know_base_categorias_nome_categoria" class="know_base_categorias_nome_categoria">
<span<?php echo $know_base_categorias_delete->nome_categoria->viewAttributes() ?>><?php echo $know_base_categorias_delete->nome_categoria->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$know_base_categorias_delete->Recordset->moveNext();
}
$know_base_categorias_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $know_base_categorias_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$know_base_categorias_delete->showPageFooter();
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
$know_base_categorias_delete->terminate();
?>