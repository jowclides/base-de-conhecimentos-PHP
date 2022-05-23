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
$know_base_categorias_edit = new know_base_categorias_edit();

// Run the page
$know_base_categorias_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$know_base_categorias_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fknow_base_categoriasedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fknow_base_categoriasedit = currentForm = new ew.Form("fknow_base_categoriasedit", "edit");

	// Validate form
	fknow_base_categoriasedit.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($know_base_categorias_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $know_base_categorias_edit->id->caption(), $know_base_categorias_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($know_base_categorias_edit->nome_categoria->Required) { ?>
				elm = this.getElements("x" + infix + "_nome_categoria");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $know_base_categorias_edit->nome_categoria->caption(), $know_base_categorias_edit->nome_categoria->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fknow_base_categoriasedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fknow_base_categoriasedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fknow_base_categoriasedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $know_base_categorias_edit->showPageHeader(); ?>
<?php
$know_base_categorias_edit->showMessage();
?>
<form name="fknow_base_categoriasedit" id="fknow_base_categoriasedit" class="<?php echo $know_base_categorias_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="know_base_categorias">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$know_base_categorias_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($know_base_categorias_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_know_base_categorias_id" class="<?php echo $know_base_categorias_edit->LeftColumnClass ?>"><?php echo $know_base_categorias_edit->id->caption() ?><?php echo $know_base_categorias_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $know_base_categorias_edit->RightColumnClass ?>"><div <?php echo $know_base_categorias_edit->id->cellAttributes() ?>>
<span id="el_know_base_categorias_id">
<span<?php echo $know_base_categorias_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($know_base_categorias_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="know_base_categorias" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($know_base_categorias_edit->id->CurrentValue) ?>">
<?php echo $know_base_categorias_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($know_base_categorias_edit->nome_categoria->Visible) { // nome_categoria ?>
	<div id="r_nome_categoria" class="form-group row">
		<label id="elh_know_base_categorias_nome_categoria" for="x_nome_categoria" class="<?php echo $know_base_categorias_edit->LeftColumnClass ?>"><?php echo $know_base_categorias_edit->nome_categoria->caption() ?><?php echo $know_base_categorias_edit->nome_categoria->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $know_base_categorias_edit->RightColumnClass ?>"><div <?php echo $know_base_categorias_edit->nome_categoria->cellAttributes() ?>>
<span id="el_know_base_categorias_nome_categoria">
<input type="text" data-table="know_base_categorias" data-field="x_nome_categoria" name="x_nome_categoria" id="x_nome_categoria" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($know_base_categorias_edit->nome_categoria->getPlaceHolder()) ?>" value="<?php echo $know_base_categorias_edit->nome_categoria->EditValue ?>"<?php echo $know_base_categorias_edit->nome_categoria->editAttributes() ?>>
</span>
<?php echo $know_base_categorias_edit->nome_categoria->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$know_base_categorias_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $know_base_categorias_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $know_base_categorias_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$know_base_categorias_edit->showPageFooter();
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
$know_base_categorias_edit->terminate();
?>