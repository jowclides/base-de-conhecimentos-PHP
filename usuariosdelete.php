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
$usuarios_delete = new usuarios_delete();

// Run the page
$usuarios_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuarios_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusuariosdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fusuariosdelete = currentForm = new ew.Form("fusuariosdelete", "delete");
	loadjs.done("fusuariosdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $usuarios_delete->showPageHeader(); ?>
<?php
$usuarios_delete->showMessage();
?>
<form name="fusuariosdelete" id="fusuariosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuarios">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($usuarios_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($usuarios_delete->id->Visible) { // id ?>
		<th class="<?php echo $usuarios_delete->id->headerCellClass() ?>"><span id="elh_usuarios_id" class="usuarios_id"><?php echo $usuarios_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($usuarios_delete->usuario->Visible) { // usuario ?>
		<th class="<?php echo $usuarios_delete->usuario->headerCellClass() ?>"><span id="elh_usuarios_usuario" class="usuarios_usuario"><?php echo $usuarios_delete->usuario->caption() ?></span></th>
<?php } ?>
<?php if ($usuarios_delete->senha->Visible) { // senha ?>
		<th class="<?php echo $usuarios_delete->senha->headerCellClass() ?>"><span id="elh_usuarios_senha" class="usuarios_senha"><?php echo $usuarios_delete->senha->caption() ?></span></th>
<?php } ?>
<?php if ($usuarios_delete->_email->Visible) { // email ?>
		<th class="<?php echo $usuarios_delete->_email->headerCellClass() ?>"><span id="elh_usuarios__email" class="usuarios__email"><?php echo $usuarios_delete->_email->caption() ?></span></th>
<?php } ?>
<?php if ($usuarios_delete->ativado->Visible) { // ativado ?>
		<th class="<?php echo $usuarios_delete->ativado->headerCellClass() ?>"><span id="elh_usuarios_ativado" class="usuarios_ativado"><?php echo $usuarios_delete->ativado->caption() ?></span></th>
<?php } ?>
<?php if ($usuarios_delete->userlevel->Visible) { // userlevel ?>
		<th class="<?php echo $usuarios_delete->userlevel->headerCellClass() ?>"><span id="elh_usuarios_userlevel" class="usuarios_userlevel"><?php echo $usuarios_delete->userlevel->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$usuarios_delete->RecordCount = 0;
$i = 0;
while (!$usuarios_delete->Recordset->EOF) {
	$usuarios_delete->RecordCount++;
	$usuarios_delete->RowCount++;

	// Set row properties
	$usuarios->resetAttributes();
	$usuarios->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$usuarios_delete->loadRowValues($usuarios_delete->Recordset);

	// Render row
	$usuarios_delete->renderRow();
?>
	<tr <?php echo $usuarios->rowAttributes() ?>>
<?php if ($usuarios_delete->id->Visible) { // id ?>
		<td <?php echo $usuarios_delete->id->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCount ?>_usuarios_id" class="usuarios_id">
<span<?php echo $usuarios_delete->id->viewAttributes() ?>><?php echo $usuarios_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuarios_delete->usuario->Visible) { // usuario ?>
		<td <?php echo $usuarios_delete->usuario->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCount ?>_usuarios_usuario" class="usuarios_usuario">
<span<?php echo $usuarios_delete->usuario->viewAttributes() ?>><?php echo $usuarios_delete->usuario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuarios_delete->senha->Visible) { // senha ?>
		<td <?php echo $usuarios_delete->senha->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCount ?>_usuarios_senha" class="usuarios_senha">
<span<?php echo $usuarios_delete->senha->viewAttributes() ?>><?php echo $usuarios_delete->senha->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuarios_delete->_email->Visible) { // email ?>
		<td <?php echo $usuarios_delete->_email->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCount ?>_usuarios__email" class="usuarios__email">
<span<?php echo $usuarios_delete->_email->viewAttributes() ?>><?php echo $usuarios_delete->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuarios_delete->ativado->Visible) { // ativado ?>
		<td <?php echo $usuarios_delete->ativado->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCount ?>_usuarios_ativado" class="usuarios_ativado">
<span<?php echo $usuarios_delete->ativado->viewAttributes() ?>><?php echo $usuarios_delete->ativado->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuarios_delete->userlevel->Visible) { // userlevel ?>
		<td <?php echo $usuarios_delete->userlevel->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCount ?>_usuarios_userlevel" class="usuarios_userlevel">
<span<?php echo $usuarios_delete->userlevel->viewAttributes() ?>><?php echo $usuarios_delete->userlevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$usuarios_delete->Recordset->moveNext();
}
$usuarios_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $usuarios_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$usuarios_delete->showPageFooter();
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
$usuarios_delete->terminate();
?>