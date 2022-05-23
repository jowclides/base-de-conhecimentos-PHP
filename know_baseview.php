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
$know_base_view = new know_base_view();

// Run the page
$know_base_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$know_base_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$know_base_view->isExport()) { ?>
<script>
var fknow_baseview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fknow_baseview = currentForm = new ew.Form("fknow_baseview", "view");
	loadjs.done("fknow_baseview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$know_base_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $know_base_view->ExportOptions->render("body") ?>
<?php $know_base_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $know_base_view->showPageHeader(); ?>
<?php
$know_base_view->showMessage();
?>
<?php if (!$know_base_view->IsModal) { ?>
<?php if (!$know_base_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $know_base_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fknow_baseview" id="fknow_baseview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="know_base">
<input type="hidden" name="modal" value="<?php echo (int)$know_base_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($know_base_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $know_base_view->TableLeftColumnClass ?>"><span id="elh_know_base_id"><?php echo $know_base_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $know_base_view->id->cellAttributes() ?>>
<span id="el_know_base_id">
<span<?php echo $know_base_view->id->viewAttributes() ?>><?php echo $know_base_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($know_base_view->titulo->Visible) { // titulo ?>
	<tr id="r_titulo">
		<td class="<?php echo $know_base_view->TableLeftColumnClass ?>"><span id="elh_know_base_titulo"><?php echo $know_base_view->titulo->caption() ?></span></td>
		<td data-name="titulo" <?php echo $know_base_view->titulo->cellAttributes() ?>>
<span id="el_know_base_titulo">
<span<?php echo $know_base_view->titulo->viewAttributes() ?>><?php echo $know_base_view->titulo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($know_base_view->procedimento->Visible) { // procedimento ?>
	<tr id="r_procedimento">
		<td class="<?php echo $know_base_view->TableLeftColumnClass ?>"><span id="elh_know_base_procedimento"><?php echo $know_base_view->procedimento->caption() ?></span></td>
		<td data-name="procedimento" <?php echo $know_base_view->procedimento->cellAttributes() ?>>
<span id="el_know_base_procedimento">
<span<?php echo $know_base_view->procedimento->viewAttributes() ?>><?php echo $know_base_view->procedimento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($know_base_view->categoria->Visible) { // categoria ?>
	<tr id="r_categoria">
		<td class="<?php echo $know_base_view->TableLeftColumnClass ?>"><span id="elh_know_base_categoria"><?php echo $know_base_view->categoria->caption() ?></span></td>
		<td data-name="categoria" <?php echo $know_base_view->categoria->cellAttributes() ?>>
<span id="el_know_base_categoria">
<span<?php echo $know_base_view->categoria->viewAttributes() ?>><?php echo $know_base_view->categoria->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($know_base_view->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $know_base_view->TableLeftColumnClass ?>"><span id="elh_know_base_updated_at"><?php echo $know_base_view->updated_at->caption() ?></span></td>
		<td data-name="updated_at" <?php echo $know_base_view->updated_at->cellAttributes() ?>>
<span id="el_know_base_updated_at">
<span<?php echo $know_base_view->updated_at->viewAttributes() ?>><?php echo $know_base_view->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($know_base_view->file->Visible) { // file ?>
	<tr id="r_file">
		<td class="<?php echo $know_base_view->TableLeftColumnClass ?>"><span id="elh_know_base_file"><?php echo $know_base_view->file->caption() ?></span></td>
		<td data-name="file" <?php echo $know_base_view->file->cellAttributes() ?>>
<span id="el_know_base_file">
<span<?php echo $know_base_view->file->viewAttributes() ?>><?php echo GetFileViewTag($know_base_view->file, $know_base_view->file->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$know_base_view->IsModal) { ?>
<?php if (!$know_base_view->isExport()) { ?>
<?php echo $know_base_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$know_base_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$know_base_view->isExport()) { ?>
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
$know_base_view->terminate();
?>