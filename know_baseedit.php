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
$know_base_edit = new know_base_edit();

// Run the page
$know_base_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$know_base_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fknow_baseedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fknow_baseedit = currentForm = new ew.Form("fknow_baseedit", "edit");

	// Validate form
	fknow_baseedit.validate = function() {
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
			<?php if ($know_base_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $know_base_edit->id->caption(), $know_base_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($know_base_edit->titulo->Required) { ?>
				elm = this.getElements("x" + infix + "_titulo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $know_base_edit->titulo->caption(), $know_base_edit->titulo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($know_base_edit->procedimento->Required) { ?>
				elm = this.getElements("x" + infix + "_procedimento");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $know_base_edit->procedimento->caption(), $know_base_edit->procedimento->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($know_base_edit->categoria->Required) { ?>
				elm = this.getElements("x" + infix + "_categoria");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $know_base_edit->categoria->caption(), $know_base_edit->categoria->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($know_base_edit->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $know_base_edit->updated_at->caption(), $know_base_edit->updated_at->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($know_base_edit->file->Required) { ?>
				felm = this.getElements("x" + infix + "_file");
				elm = this.getElements("fn_x" + infix + "_file");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $know_base_edit->file->caption(), $know_base_edit->file->RequiredErrorMessage)) ?>");
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
	fknow_baseedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fknow_baseedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fknow_baseedit.lists["x_categoria"] = <?php echo $know_base_edit->categoria->Lookup->toClientList($know_base_edit) ?>;
	fknow_baseedit.lists["x_categoria"].options = <?php echo JsonEncode($know_base_edit->categoria->lookupOptions()) ?>;
	loadjs.done("fknow_baseedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $know_base_edit->showPageHeader(); ?>
<?php
$know_base_edit->showMessage();
?>
<form name="fknow_baseedit" id="fknow_baseedit" class="<?php echo $know_base_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="know_base">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$know_base_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($know_base_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_know_base_id" class="<?php echo $know_base_edit->LeftColumnClass ?>"><?php echo $know_base_edit->id->caption() ?><?php echo $know_base_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $know_base_edit->RightColumnClass ?>"><div <?php echo $know_base_edit->id->cellAttributes() ?>>
<span id="el_know_base_id">
<span<?php echo $know_base_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($know_base_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="know_base" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($know_base_edit->id->CurrentValue) ?>">
<?php echo $know_base_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($know_base_edit->titulo->Visible) { // titulo ?>
	<div id="r_titulo" class="form-group row">
		<label id="elh_know_base_titulo" for="x_titulo" class="<?php echo $know_base_edit->LeftColumnClass ?>"><?php echo $know_base_edit->titulo->caption() ?><?php echo $know_base_edit->titulo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $know_base_edit->RightColumnClass ?>"><div <?php echo $know_base_edit->titulo->cellAttributes() ?>>
<span id="el_know_base_titulo">
<input type="text" data-table="know_base" data-field="x_titulo" name="x_titulo" id="x_titulo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($know_base_edit->titulo->getPlaceHolder()) ?>" value="<?php echo $know_base_edit->titulo->EditValue ?>"<?php echo $know_base_edit->titulo->editAttributes() ?>>
</span>
<?php echo $know_base_edit->titulo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($know_base_edit->procedimento->Visible) { // procedimento ?>
	<div id="r_procedimento" class="form-group row">
		<label id="elh_know_base_procedimento" class="<?php echo $know_base_edit->LeftColumnClass ?>"><?php echo $know_base_edit->procedimento->caption() ?><?php echo $know_base_edit->procedimento->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $know_base_edit->RightColumnClass ?>"><div <?php echo $know_base_edit->procedimento->cellAttributes() ?>>
<span id="el_know_base_procedimento">
<?php $know_base_edit->procedimento->EditAttrs->appendClass("editor"); ?>
<textarea data-table="know_base" data-field="x_procedimento" name="x_procedimento" id="x_procedimento" cols="35" rows="4" placeholder="<?php echo HtmlEncode($know_base_edit->procedimento->getPlaceHolder()) ?>"<?php echo $know_base_edit->procedimento->editAttributes() ?>><?php echo $know_base_edit->procedimento->EditValue ?></textarea>
<script>
loadjs.ready(["fknow_baseedit", "editor"], function() {
	ew.createEditor("fknow_baseedit", "x_procedimento", 35, 4, <?php echo $know_base_edit->procedimento->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $know_base_edit->procedimento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($know_base_edit->categoria->Visible) { // categoria ?>
	<div id="r_categoria" class="form-group row">
		<label id="elh_know_base_categoria" for="x_categoria" class="<?php echo $know_base_edit->LeftColumnClass ?>"><?php echo $know_base_edit->categoria->caption() ?><?php echo $know_base_edit->categoria->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $know_base_edit->RightColumnClass ?>"><div <?php echo $know_base_edit->categoria->cellAttributes() ?>>
<span id="el_know_base_categoria">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_categoria"><?php echo EmptyValue(strval($know_base_edit->categoria->ViewValue)) ? $Language->phrase("PleaseSelect") : $know_base_edit->categoria->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($know_base_edit->categoria->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($know_base_edit->categoria->ReadOnly || $know_base_edit->categoria->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_categoria',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $know_base_edit->categoria->Lookup->getParamTag($know_base_edit, "p_x_categoria") ?>
<input type="hidden" data-table="know_base" data-field="x_categoria" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $know_base_edit->categoria->displayValueSeparatorAttribute() ?>" name="x_categoria" id="x_categoria" value="<?php echo $know_base_edit->categoria->CurrentValue ?>"<?php echo $know_base_edit->categoria->editAttributes() ?>>
</span>
<?php echo $know_base_edit->categoria->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($know_base_edit->file->Visible) { // file ?>
	<div id="r_file" class="form-group row">
		<label id="elh_know_base_file" class="<?php echo $know_base_edit->LeftColumnClass ?>"><?php echo $know_base_edit->file->caption() ?><?php echo $know_base_edit->file->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $know_base_edit->RightColumnClass ?>"><div <?php echo $know_base_edit->file->cellAttributes() ?>>
<span id="el_know_base_file">
<div id="fd_x_file">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $know_base_edit->file->title() ?>" data-table="know_base" data-field="x_file" name="x_file" id="x_file" lang="<?php echo CurrentLanguageID() ?>" multiple="multiple"<?php echo $know_base_edit->file->editAttributes() ?><?php if ($know_base_edit->file->ReadOnly || $know_base_edit->file->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_file"><?php echo $Language->phrase("ChooseFiles") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_file" id= "fn_x_file" value="<?php echo $know_base_edit->file->Upload->FileName ?>">
<input type="hidden" name="fa_x_file" id= "fa_x_file" value="<?php echo (Post("fa_x_file") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_file" id= "fs_x_file" value="255">
<input type="hidden" name="fx_x_file" id= "fx_x_file" value="<?php echo $know_base_edit->file->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_file" id= "fm_x_file" value="<?php echo $know_base_edit->file->UploadMaxFileSize ?>">
<input type="hidden" name="fc_x_file" id= "fc_x_file" value="<?php echo $know_base_edit->file->UploadMaxFileCount ?>">
</div>
<table id="ft_x_file" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $know_base_edit->file->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$know_base_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $know_base_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $know_base_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$know_base_edit->showPageFooter();
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
$know_base_edit->terminate();
?>