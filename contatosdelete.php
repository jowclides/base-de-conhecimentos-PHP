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
$contatos_delete = new contatos_delete();

// Run the page
$contatos_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contatos_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontatosdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcontatosdelete = currentForm = new ew.Form("fcontatosdelete", "delete");
	loadjs.done("fcontatosdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contatos_delete->showPageHeader(); ?>
<?php
$contatos_delete->showMessage();
?>
<form name="fcontatosdelete" id="fcontatosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contatos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($contatos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($contatos_delete->id->Visible) { // id ?>
		<th class="<?php echo $contatos_delete->id->headerCellClass() ?>"><span id="elh_contatos_id" class="contatos_id"><?php echo $contatos_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($contatos_delete->nome_completo->Visible) { // nome_completo ?>
		<th class="<?php echo $contatos_delete->nome_completo->headerCellClass() ?>"><span id="elh_contatos_nome_completo" class="contatos_nome_completo"><?php echo $contatos_delete->nome_completo->caption() ?></span></th>
<?php } ?>
<?php if ($contatos_delete->_email->Visible) { // email ?>
		<th class="<?php echo $contatos_delete->_email->headerCellClass() ?>"><span id="elh_contatos__email" class="contatos__email"><?php echo $contatos_delete->_email->caption() ?></span></th>
<?php } ?>
<?php if ($contatos_delete->telefone->Visible) { // telefone ?>
		<th class="<?php echo $contatos_delete->telefone->headerCellClass() ?>"><span id="elh_contatos_telefone" class="contatos_telefone"><?php echo $contatos_delete->telefone->caption() ?></span></th>
<?php } ?>
<?php if ($contatos_delete->celular->Visible) { // celular ?>
		<th class="<?php echo $contatos_delete->celular->headerCellClass() ?>"><span id="elh_contatos_celular" class="contatos_celular"><?php echo $contatos_delete->celular->caption() ?></span></th>
<?php } ?>
<?php if ($contatos_delete->empresa->Visible) { // empresa ?>
		<th class="<?php echo $contatos_delete->empresa->headerCellClass() ?>"><span id="elh_contatos_empresa" class="contatos_empresa"><?php echo $contatos_delete->empresa->caption() ?></span></th>
<?php } ?>
<?php if ($contatos_delete->cargo->Visible) { // cargo ?>
		<th class="<?php echo $contatos_delete->cargo->headerCellClass() ?>"><span id="elh_contatos_cargo" class="contatos_cargo"><?php echo $contatos_delete->cargo->caption() ?></span></th>
<?php } ?>
<?php if ($contatos_delete->responsabilidades->Visible) { // responsabilidades ?>
		<th class="<?php echo $contatos_delete->responsabilidades->headerCellClass() ?>"><span id="elh_contatos_responsabilidades" class="contatos_responsabilidades"><?php echo $contatos_delete->responsabilidades->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$contatos_delete->RecordCount = 0;
$i = 0;
while (!$contatos_delete->Recordset->EOF) {
	$contatos_delete->RecordCount++;
	$contatos_delete->RowCount++;

	// Set row properties
	$contatos->resetAttributes();
	$contatos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$contatos_delete->loadRowValues($contatos_delete->Recordset);

	// Render row
	$contatos_delete->renderRow();
?>
	<tr <?php echo $contatos->rowAttributes() ?>>
<?php if ($contatos_delete->id->Visible) { // id ?>
		<td <?php echo $contatos_delete->id->cellAttributes() ?>>
<span id="el<?php echo $contatos_delete->RowCount ?>_contatos_id" class="contatos_id">
<span<?php echo $contatos_delete->id->viewAttributes() ?>><?php echo $contatos_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contatos_delete->nome_completo->Visible) { // nome_completo ?>
		<td <?php echo $contatos_delete->nome_completo->cellAttributes() ?>>
<span id="el<?php echo $contatos_delete->RowCount ?>_contatos_nome_completo" class="contatos_nome_completo">
<span<?php echo $contatos_delete->nome_completo->viewAttributes() ?>><?php echo $contatos_delete->nome_completo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contatos_delete->_email->Visible) { // email ?>
		<td <?php echo $contatos_delete->_email->cellAttributes() ?>>
<span id="el<?php echo $contatos_delete->RowCount ?>_contatos__email" class="contatos__email">
<span<?php echo $contatos_delete->_email->viewAttributes() ?>><?php echo $contatos_delete->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contatos_delete->telefone->Visible) { // telefone ?>
		<td <?php echo $contatos_delete->telefone->cellAttributes() ?>>
<span id="el<?php echo $contatos_delete->RowCount ?>_contatos_telefone" class="contatos_telefone">
<span<?php echo $contatos_delete->telefone->viewAttributes() ?>><?php echo $contatos_delete->telefone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contatos_delete->celular->Visible) { // celular ?>
		<td <?php echo $contatos_delete->celular->cellAttributes() ?>>
<span id="el<?php echo $contatos_delete->RowCount ?>_contatos_celular" class="contatos_celular">
<span<?php echo $contatos_delete->celular->viewAttributes() ?>><?php echo $contatos_delete->celular->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contatos_delete->empresa->Visible) { // empresa ?>
		<td <?php echo $contatos_delete->empresa->cellAttributes() ?>>
<span id="el<?php echo $contatos_delete->RowCount ?>_contatos_empresa" class="contatos_empresa">
<span<?php echo $contatos_delete->empresa->viewAttributes() ?>><?php echo $contatos_delete->empresa->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contatos_delete->cargo->Visible) { // cargo ?>
		<td <?php echo $contatos_delete->cargo->cellAttributes() ?>>
<span id="el<?php echo $contatos_delete->RowCount ?>_contatos_cargo" class="contatos_cargo">
<span<?php echo $contatos_delete->cargo->viewAttributes() ?>><?php echo $contatos_delete->cargo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contatos_delete->responsabilidades->Visible) { // responsabilidades ?>
		<td <?php echo $contatos_delete->responsabilidades->cellAttributes() ?>>
<span id="el<?php echo $contatos_delete->RowCount ?>_contatos_responsabilidades" class="contatos_responsabilidades">
<span<?php echo $contatos_delete->responsabilidades->viewAttributes() ?>><?php echo $contatos_delete->responsabilidades->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$contatos_delete->Recordset->moveNext();
}
$contatos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contatos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$contatos_delete->showPageFooter();
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
$contatos_delete->terminate();
?>