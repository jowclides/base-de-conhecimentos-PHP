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
$know_base_delete = new know_base_delete();

// Run the page
$know_base_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$know_base_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fknow_basedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fknow_basedelete = currentForm = new ew.Form("fknow_basedelete", "delete");
	loadjs.done("fknow_basedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $know_base_delete->showPageHeader(); ?>
<?php
$know_base_delete->showMessage();
?>
<form name="fknow_basedelete" id="fknow_basedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="know_base">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($know_base_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($know_base_delete->id->Visible) { // id ?>
		<th class="<?php echo $know_base_delete->id->headerCellClass() ?>"><span id="elh_know_base_id" class="know_base_id"><?php echo $know_base_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($know_base_delete->titulo->Visible) { // titulo ?>
		<th class="<?php echo $know_base_delete->titulo->headerCellClass() ?>"><span id="elh_know_base_titulo" class="know_base_titulo"><?php echo $know_base_delete->titulo->caption() ?></span></th>
<?php } ?>
<?php if ($know_base_delete->categoria->Visible) { // categoria ?>
		<th class="<?php echo $know_base_delete->categoria->headerCellClass() ?>"><span id="elh_know_base_categoria" class="know_base_categoria"><?php echo $know_base_delete->categoria->caption() ?></span></th>
<?php } ?>
<?php if ($know_base_delete->updated_at->Visible) { // updated_at ?>
		<th class="<?php echo $know_base_delete->updated_at->headerCellClass() ?>"><span id="elh_know_base_updated_at" class="know_base_updated_at"><?php echo $know_base_delete->updated_at->caption() ?></span></th>
<?php } ?>
<?php if ($know_base_delete->file->Visible) { // file ?>
		<th class="<?php echo $know_base_delete->file->headerCellClass() ?>"><span id="elh_know_base_file" class="know_base_file"><?php echo $know_base_delete->file->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$know_base_delete->RecordCount = 0;
$i = 0;
while (!$know_base_delete->Recordset->EOF) {
	$know_base_delete->RecordCount++;
	$know_base_delete->RowCount++;

	// Set row properties
	$know_base->resetAttributes();
	$know_base->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$know_base_delete->loadRowValues($know_base_delete->Recordset);

	// Render row
	$know_base_delete->renderRow();
?>
	<tr <?php echo $know_base->rowAttributes() ?>>
<?php if ($know_base_delete->id->Visible) { // id ?>
		<td <?php echo $know_base_delete->id->cellAttributes() ?>>
<span id="el<?php echo $know_base_delete->RowCount ?>_know_base_id" class="know_base_id">
<span<?php echo $know_base_delete->id->viewAttributes() ?>><?php echo $know_base_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($know_base_delete->titulo->Visible) { // titulo ?>
		<td <?php echo $know_base_delete->titulo->cellAttributes() ?>>
<span id="el<?php echo $know_base_delete->RowCount ?>_know_base_titulo" class="know_base_titulo">
<span<?php echo $know_base_delete->titulo->viewAttributes() ?>><?php echo $know_base_delete->titulo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($know_base_delete->categoria->Visible) { // categoria ?>
		<td <?php echo $know_base_delete->categoria->cellAttributes() ?>>
<span id="el<?php echo $know_base_delete->RowCount ?>_know_base_categoria" class="know_base_categoria">
<span<?php echo $know_base_delete->categoria->viewAttributes() ?>><?php echo $know_base_delete->categoria->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($know_base_delete->updated_at->Visible) { // updated_at ?>
		<td <?php echo $know_base_delete->updated_at->cellAttributes() ?>>
<span id="el<?php echo $know_base_delete->RowCount ?>_know_base_updated_at" class="know_base_updated_at">
<span<?php echo $know_base_delete->updated_at->viewAttributes() ?>><?php echo $know_base_delete->updated_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($know_base_delete->file->Visible) { // file ?>
		<td <?php echo $know_base_delete->file->cellAttributes() ?>>
<span id="el<?php echo $know_base_delete->RowCount ?>_know_base_file" class="know_base_file">
<span<?php echo $know_base_delete->file->viewAttributes() ?>><?php echo GetFileViewTag($know_base_delete->file, $know_base_delete->file->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$know_base_delete->Recordset->moveNext();
}
$know_base_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $know_base_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$know_base_delete->showPageFooter();
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
$know_base_delete->terminate();
?>