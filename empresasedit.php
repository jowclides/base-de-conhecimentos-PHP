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
$empresas_edit = new empresas_edit();

// Run the page
$empresas_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$empresas_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fempresasedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fempresasedit = currentForm = new ew.Form("fempresasedit", "edit");

	// Validate form
	fempresasedit.validate = function() {
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
			<?php if ($empresas_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $empresas_edit->id->caption(), $empresas_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($empresas_edit->nome_empreasa->Required) { ?>
				elm = this.getElements("x" + infix + "_nome_empreasa");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $empresas_edit->nome_empreasa->caption(), $empresas_edit->nome_empreasa->RequiredErrorMessage)) ?>");
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
	fempresasedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fempresasedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fempresasedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $empresas_edit->showPageHeader(); ?>
<?php
$empresas_edit->showMessage();
?>
<form name="fempresasedit" id="fempresasedit" class="<?php echo $empresas_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="empresas">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$empresas_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($empresas_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_empresas_id" class="<?php echo $empresas_edit->LeftColumnClass ?>"><?php echo $empresas_edit->id->caption() ?><?php echo $empresas_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $empresas_edit->RightColumnClass ?>"><div <?php echo $empresas_edit->id->cellAttributes() ?>>
<span id="el_empresas_id">
<span<?php echo $empresas_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($empresas_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="empresas" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($empresas_edit->id->CurrentValue) ?>">
<?php echo $empresas_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($empresas_edit->nome_empreasa->Visible) { // nome_empreasa ?>
	<div id="r_nome_empreasa" class="form-group row">
		<label id="elh_empresas_nome_empreasa" for="x_nome_empreasa" class="<?php echo $empresas_edit->LeftColumnClass ?>"><?php echo $empresas_edit->nome_empreasa->caption() ?><?php echo $empresas_edit->nome_empreasa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $empresas_edit->RightColumnClass ?>"><div <?php echo $empresas_edit->nome_empreasa->cellAttributes() ?>>
<span id="el_empresas_nome_empreasa">
<input type="text" data-table="empresas" data-field="x_nome_empreasa" name="x_nome_empreasa" id="x_nome_empreasa" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($empresas_edit->nome_empreasa->getPlaceHolder()) ?>" value="<?php echo $empresas_edit->nome_empreasa->EditValue ?>"<?php echo $empresas_edit->nome_empreasa->editAttributes() ?>>
</span>
<?php echo $empresas_edit->nome_empreasa->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$empresas_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $empresas_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $empresas_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$empresas_edit->showPageFooter();
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
$empresas_edit->terminate();
?>