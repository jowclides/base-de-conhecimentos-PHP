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
$cargos_edit = new cargos_edit();

// Run the page
$cargos_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cargos_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcargosedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcargosedit = currentForm = new ew.Form("fcargosedit", "edit");

	// Validate form
	fcargosedit.validate = function() {
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
			<?php if ($cargos_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cargos_edit->id->caption(), $cargos_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cargos_edit->nome_cargo->Required) { ?>
				elm = this.getElements("x" + infix + "_nome_cargo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cargos_edit->nome_cargo->caption(), $cargos_edit->nome_cargo->RequiredErrorMessage)) ?>");
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
	fcargosedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcargosedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcargosedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cargos_edit->showPageHeader(); ?>
<?php
$cargos_edit->showMessage();
?>
<form name="fcargosedit" id="fcargosedit" class="<?php echo $cargos_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cargos">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$cargos_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($cargos_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_cargos_id" class="<?php echo $cargos_edit->LeftColumnClass ?>"><?php echo $cargos_edit->id->caption() ?><?php echo $cargos_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cargos_edit->RightColumnClass ?>"><div <?php echo $cargos_edit->id->cellAttributes() ?>>
<span id="el_cargos_id">
<span<?php echo $cargos_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cargos_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="cargos" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($cargos_edit->id->CurrentValue) ?>">
<?php echo $cargos_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cargos_edit->nome_cargo->Visible) { // nome_cargo ?>
	<div id="r_nome_cargo" class="form-group row">
		<label id="elh_cargos_nome_cargo" for="x_nome_cargo" class="<?php echo $cargos_edit->LeftColumnClass ?>"><?php echo $cargos_edit->nome_cargo->caption() ?><?php echo $cargos_edit->nome_cargo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cargos_edit->RightColumnClass ?>"><div <?php echo $cargos_edit->nome_cargo->cellAttributes() ?>>
<span id="el_cargos_nome_cargo">
<input type="text" data-table="cargos" data-field="x_nome_cargo" name="x_nome_cargo" id="x_nome_cargo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($cargos_edit->nome_cargo->getPlaceHolder()) ?>" value="<?php echo $cargos_edit->nome_cargo->EditValue ?>"<?php echo $cargos_edit->nome_cargo->editAttributes() ?>>
</span>
<?php echo $cargos_edit->nome_cargo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cargos_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cargos_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cargos_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cargos_edit->showPageFooter();
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
$cargos_edit->terminate();
?>