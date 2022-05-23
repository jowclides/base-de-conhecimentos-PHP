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
$know_base_add = new know_base_add();

// Run the page
$know_base_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$know_base_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fknow_baseadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fknow_baseadd = currentForm = new ew.Form("fknow_baseadd", "add");

	// Validate form
	fknow_baseadd.validate = function() {
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
			<?php if ($know_base_add->titulo->Required) { ?>
				elm = this.getElements("x" + infix + "_titulo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $know_base_add->titulo->caption(), $know_base_add->titulo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($know_base_add->procedimento->Required) { ?>
				elm = this.getElements("x" + infix + "_procedimento");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $know_base_add->procedimento->caption(), $know_base_add->procedimento->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($know_base_add->categoria->Required) { ?>
				elm = this.getElements("x" + infix + "_categoria");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $know_base_add->categoria->caption(), $know_base_add->categoria->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($know_base_add->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $know_base_add->updated_at->caption(), $know_base_add->updated_at->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($know_base_add->file->Required) { ?>
				felm = this.getElements("x" + infix + "_file");
				elm = this.getElements("fn_x" + infix + "_file");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $know_base_add->file->caption(), $know_base_add->file->RequiredErrorMessage)) ?>");
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
	fknow_baseadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fknow_baseadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fknow_baseadd.lists["x_categoria"] = <?php echo $know_base_add->categoria->Lookup->toClientList($know_base_add) ?>;
	fknow_baseadd.lists["x_categoria"].options = <?php echo JsonEncode($know_base_add->categoria->lookupOptions()) ?>;
	loadjs.done("fknow_baseadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $know_base_add->showPageHeader(); ?>
<?php
$know_base_add->showMessage();
?>
<form name="fknow_baseadd" id="fknow_baseadd" class="<?php echo $know_base_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="know_base">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$know_base_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($know_base_add->titulo->Visible) { // titulo ?>
	<div id="r_titulo" class="form-group row">
		<label id="elh_know_base_titulo" for="x_titulo" class="<?php echo $know_base_add->LeftColumnClass ?>"><?php echo $know_base_add->titulo->caption() ?><?php echo $know_base_add->titulo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $know_base_add->RightColumnClass ?>"><div <?php echo $know_base_add->titulo->cellAttributes() ?>>
<span id="el_know_base_titulo">
<input type="text" data-table="know_base" data-field="x_titulo" name="x_titulo" id="x_titulo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($know_base_add->titulo->getPlaceHolder()) ?>" value="<?php echo $know_base_add->titulo->EditValue ?>"<?php echo $know_base_add->titulo->editAttributes() ?>>
</span>
<?php echo $know_base_add->titulo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($know_base_add->procedimento->Visible) { // procedimento ?>
	<div id="r_procedimento" class="form-group row">
		<label id="elh_know_base_procedimento" class="<?php echo $know_base_add->LeftColumnClass ?>"><?php echo $know_base_add->procedimento->caption() ?><?php echo $know_base_add->procedimento->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $know_base_add->RightColumnClass ?>"><div <?php echo $know_base_add->procedimento->cellAttributes() ?>>
<span id="el_know_base_procedimento">
<?php $know_base_add->procedimento->EditAttrs->appendClass("editor"); ?>
<textarea data-table="know_base" data-field="x_procedimento" name="x_procedimento" id="x_procedimento" cols="35" rows="4" placeholder="<?php echo HtmlEncode($know_base_add->procedimento->getPlaceHolder()) ?>"<?php echo $know_base_add->procedimento->editAttributes() ?>><?php echo $know_base_add->procedimento->EditValue ?></textarea>
<script>
loadjs.ready(["fknow_baseadd", "editor"], function() {
	ew.createEditor("fknow_baseadd", "x_procedimento", 35, 4, <?php echo $know_base_add->procedimento->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $know_base_add->procedimento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($know_base_add->categoria->Visible) { // categoria ?>
	<div id="r_categoria" class="form-group row">
		<label id="elh_know_base_categoria" for="x_categoria" class="<?php echo $know_base_add->LeftColumnClass ?>"><?php echo $know_base_add->categoria->caption() ?><?php echo $know_base_add->categoria->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $know_base_add->RightColumnClass ?>"><div <?php echo $know_base_add->categoria->cellAttributes() ?>>
<span id="el_know_base_categoria">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_categoria"><?php echo EmptyValue(strval($know_base_add->categoria->ViewValue)) ? $Language->phrase("PleaseSelect") : $know_base_add->categoria->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($know_base_add->categoria->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($know_base_add->categoria->ReadOnly || $know_base_add->categoria->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_categoria',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $know_base_add->categoria->Lookup->getParamTag($know_base_add, "p_x_categoria") ?>
<input type="hidden" data-table="know_base" data-field="x_categoria" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $know_base_add->categoria->displayValueSeparatorAttribute() ?>" name="x_categoria" id="x_categoria" value="<?php echo $know_base_add->categoria->CurrentValue ?>"<?php echo $know_base_add->categoria->editAttributes() ?>>
</span>
<?php echo $know_base_add->categoria->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($know_base_add->file->Visible) { // file ?>
	<div id="r_file" class="form-group row">
		<label id="elh_know_base_file" class="<?php echo $know_base_add->LeftColumnClass ?>"><?php echo $know_base_add->file->caption() ?><?php echo $know_base_add->file->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $know_base_add->RightColumnClass ?>"><div <?php echo $know_base_add->file->cellAttributes() ?>>
<span id="el_know_base_file">
<div id="fd_x_file">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $know_base_add->file->title() ?>" data-table="know_base" data-field="x_file" name="x_file" id="x_file" lang="<?php echo CurrentLanguageID() ?>" multiple="multiple"<?php echo $know_base_add->file->editAttributes() ?><?php if ($know_base_add->file->ReadOnly || $know_base_add->file->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_file"><?php echo $Language->phrase("ChooseFiles") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_file" id= "fn_x_file" value="<?php echo $know_base_add->file->Upload->FileName ?>">
<input type="hidden" name="fa_x_file" id= "fa_x_file" value="0">
<input type="hidden" name="fs_x_file" id= "fs_x_file" value="255">
<input type="hidden" name="fx_x_file" id= "fx_x_file" value="<?php echo $know_base_add->file->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_file" id= "fm_x_file" value="<?php echo $know_base_add->file->UploadMaxFileSize ?>">
<input type="hidden" name="fc_x_file" id= "fc_x_file" value="<?php echo $know_base_add->file->UploadMaxFileCount ?>">
</div>
<table id="ft_x_file" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $know_base_add->file->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$know_base_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $know_base_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $know_base_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$know_base_add->showPageFooter();
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
$know_base_add->terminate();
?>