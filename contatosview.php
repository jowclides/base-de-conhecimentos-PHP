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
$contatos_view = new contatos_view();

// Run the page
$contatos_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contatos_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$contatos_view->isExport()) { ?>
<script>
var fcontatosview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcontatosview = currentForm = new ew.Form("fcontatosview", "view");
	loadjs.done("fcontatosview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$contatos_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $contatos_view->ExportOptions->render("body") ?>
<?php $contatos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $contatos_view->showPageHeader(); ?>
<?php
$contatos_view->showMessage();
?>
<?php if (!$contatos_view->IsModal) { ?>
<?php if (!$contatos_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contatos_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcontatosview" id="fcontatosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contatos">
<input type="hidden" name="modal" value="<?php echo (int)$contatos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($contatos_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $contatos_view->TableLeftColumnClass ?>"><span id="elh_contatos_id"><?php echo $contatos_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $contatos_view->id->cellAttributes() ?>>
<span id="el_contatos_id">
<span<?php echo $contatos_view->id->viewAttributes() ?>><?php echo $contatos_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contatos_view->avatar->Visible) { // avatar ?>
	<tr id="r_avatar">
		<td class="<?php echo $contatos_view->TableLeftColumnClass ?>"><span id="elh_contatos_avatar"><?php echo $contatos_view->avatar->caption() ?></span></td>
		<td data-name="avatar" <?php echo $contatos_view->avatar->cellAttributes() ?>>
<span id="el_contatos_avatar">
<span<?php echo $contatos_view->avatar->viewAttributes() ?>><?php echo GetFileViewTag($contatos_view->avatar, $contatos_view->avatar->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contatos_view->nome_completo->Visible) { // nome_completo ?>
	<tr id="r_nome_completo">
		<td class="<?php echo $contatos_view->TableLeftColumnClass ?>"><span id="elh_contatos_nome_completo"><?php echo $contatos_view->nome_completo->caption() ?></span></td>
		<td data-name="nome_completo" <?php echo $contatos_view->nome_completo->cellAttributes() ?>>
<span id="el_contatos_nome_completo">
<span<?php echo $contatos_view->nome_completo->viewAttributes() ?>><?php echo $contatos_view->nome_completo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contatos_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $contatos_view->TableLeftColumnClass ?>"><span id="elh_contatos__email"><?php echo $contatos_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $contatos_view->_email->cellAttributes() ?>>
<span id="el_contatos__email">
<span<?php echo $contatos_view->_email->viewAttributes() ?>><?php echo $contatos_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contatos_view->telefone->Visible) { // telefone ?>
	<tr id="r_telefone">
		<td class="<?php echo $contatos_view->TableLeftColumnClass ?>"><span id="elh_contatos_telefone"><?php echo $contatos_view->telefone->caption() ?></span></td>
		<td data-name="telefone" <?php echo $contatos_view->telefone->cellAttributes() ?>>
<span id="el_contatos_telefone">
<span<?php echo $contatos_view->telefone->viewAttributes() ?>><?php echo $contatos_view->telefone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contatos_view->celular->Visible) { // celular ?>
	<tr id="r_celular">
		<td class="<?php echo $contatos_view->TableLeftColumnClass ?>"><span id="elh_contatos_celular"><?php echo $contatos_view->celular->caption() ?></span></td>
		<td data-name="celular" <?php echo $contatos_view->celular->cellAttributes() ?>>
<span id="el_contatos_celular">
<span<?php echo $contatos_view->celular->viewAttributes() ?>><?php echo $contatos_view->celular->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contatos_view->empresa->Visible) { // empresa ?>
	<tr id="r_empresa">
		<td class="<?php echo $contatos_view->TableLeftColumnClass ?>"><span id="elh_contatos_empresa"><?php echo $contatos_view->empresa->caption() ?></span></td>
		<td data-name="empresa" <?php echo $contatos_view->empresa->cellAttributes() ?>>
<span id="el_contatos_empresa">
<span<?php echo $contatos_view->empresa->viewAttributes() ?>><?php echo $contatos_view->empresa->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contatos_view->cargo->Visible) { // cargo ?>
	<tr id="r_cargo">
		<td class="<?php echo $contatos_view->TableLeftColumnClass ?>"><span id="elh_contatos_cargo"><?php echo $contatos_view->cargo->caption() ?></span></td>
		<td data-name="cargo" <?php echo $contatos_view->cargo->cellAttributes() ?>>
<span id="el_contatos_cargo">
<span<?php echo $contatos_view->cargo->viewAttributes() ?>><?php echo $contatos_view->cargo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contatos_view->responsabilidades->Visible) { // responsabilidades ?>
	<tr id="r_responsabilidades">
		<td class="<?php echo $contatos_view->TableLeftColumnClass ?>"><span id="elh_contatos_responsabilidades"><?php echo $contatos_view->responsabilidades->caption() ?></span></td>
		<td data-name="responsabilidades" <?php echo $contatos_view->responsabilidades->cellAttributes() ?>>
<span id="el_contatos_responsabilidades">
<span<?php echo $contatos_view->responsabilidades->viewAttributes() ?>><?php echo $contatos_view->responsabilidades->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contatos_view->obs->Visible) { // obs ?>
	<tr id="r_obs">
		<td class="<?php echo $contatos_view->TableLeftColumnClass ?>"><span id="elh_contatos_obs"><?php echo $contatos_view->obs->caption() ?></span></td>
		<td data-name="obs" <?php echo $contatos_view->obs->cellAttributes() ?>>
<span id="el_contatos_obs">
<span<?php echo $contatos_view->obs->viewAttributes() ?>><?php echo $contatos_view->obs->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$contatos_view->IsModal) { ?>
<?php if (!$contatos_view->isExport()) { ?>
<?php echo $contatos_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$contatos_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$contatos_view->isExport()) { ?>
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
$contatos_view->terminate();
?>