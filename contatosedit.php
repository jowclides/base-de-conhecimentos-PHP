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
$contatos_edit = new contatos_edit();

// Run the page
$contatos_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contatos_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontatosedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcontatosedit = currentForm = new ew.Form("fcontatosedit", "edit");

	// Validate form
	fcontatosedit.validate = function() {
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
			<?php if ($contatos_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contatos_edit->id->caption(), $contatos_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contatos_edit->avatar->Required) { ?>
				felm = this.getElements("x" + infix + "_avatar");
				elm = this.getElements("fn_x" + infix + "_avatar");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $contatos_edit->avatar->caption(), $contatos_edit->avatar->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contatos_edit->nome_completo->Required) { ?>
				elm = this.getElements("x" + infix + "_nome_completo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contatos_edit->nome_completo->caption(), $contatos_edit->nome_completo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contatos_edit->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contatos_edit->_email->caption(), $contatos_edit->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contatos_edit->telefone->Required) { ?>
				elm = this.getElements("x" + infix + "_telefone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contatos_edit->telefone->caption(), $contatos_edit->telefone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contatos_edit->celular->Required) { ?>
				elm = this.getElements("x" + infix + "_celular");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contatos_edit->celular->caption(), $contatos_edit->celular->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contatos_edit->empresa->Required) { ?>
				elm = this.getElements("x" + infix + "_empresa");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contatos_edit->empresa->caption(), $contatos_edit->empresa->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contatos_edit->cargo->Required) { ?>
				elm = this.getElements("x" + infix + "_cargo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contatos_edit->cargo->caption(), $contatos_edit->cargo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contatos_edit->responsabilidades->Required) { ?>
				elm = this.getElements("x" + infix + "_responsabilidades");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contatos_edit->responsabilidades->caption(), $contatos_edit->responsabilidades->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contatos_edit->obs->Required) { ?>
				elm = this.getElements("x" + infix + "_obs");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contatos_edit->obs->caption(), $contatos_edit->obs->RequiredErrorMessage)) ?>");
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
	fcontatosedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontatosedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcontatosedit.lists["x_empresa"] = <?php echo $contatos_edit->empresa->Lookup->toClientList($contatos_edit) ?>;
	fcontatosedit.lists["x_empresa"].options = <?php echo JsonEncode($contatos_edit->empresa->lookupOptions()) ?>;
	fcontatosedit.lists["x_cargo"] = <?php echo $contatos_edit->cargo->Lookup->toClientList($contatos_edit) ?>;
	fcontatosedit.lists["x_cargo"].options = <?php echo JsonEncode($contatos_edit->cargo->lookupOptions()) ?>;
	loadjs.done("fcontatosedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contatos_edit->showPageHeader(); ?>
<?php
$contatos_edit->showMessage();
?>
<form name="fcontatosedit" id="fcontatosedit" class="<?php echo $contatos_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contatos">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$contatos_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($contatos_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_contatos_id" class="<?php echo $contatos_edit->LeftColumnClass ?>"><?php echo $contatos_edit->id->caption() ?><?php echo $contatos_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contatos_edit->RightColumnClass ?>"><div <?php echo $contatos_edit->id->cellAttributes() ?>>
<span id="el_contatos_id">
<span<?php echo $contatos_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contatos_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="contatos" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($contatos_edit->id->CurrentValue) ?>">
<?php echo $contatos_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contatos_edit->avatar->Visible) { // avatar ?>
	<div id="r_avatar" class="form-group row">
		<label id="elh_contatos_avatar" class="<?php echo $contatos_edit->LeftColumnClass ?>"><?php echo $contatos_edit->avatar->caption() ?><?php echo $contatos_edit->avatar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contatos_edit->RightColumnClass ?>"><div <?php echo $contatos_edit->avatar->cellAttributes() ?>>
<span id="el_contatos_avatar">
<div id="fd_x_avatar">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $contatos_edit->avatar->title() ?>" data-table="contatos" data-field="x_avatar" name="x_avatar" id="x_avatar" lang="<?php echo CurrentLanguageID() ?>"<?php echo $contatos_edit->avatar->editAttributes() ?><?php if ($contatos_edit->avatar->ReadOnly || $contatos_edit->avatar->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_avatar"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_avatar" id= "fn_x_avatar" value="<?php echo $contatos_edit->avatar->Upload->FileName ?>">
<input type="hidden" name="fa_x_avatar" id= "fa_x_avatar" value="<?php echo (Post("fa_x_avatar") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_avatar" id= "fs_x_avatar" value="255">
<input type="hidden" name="fx_x_avatar" id= "fx_x_avatar" value="<?php echo $contatos_edit->avatar->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_avatar" id= "fm_x_avatar" value="<?php echo $contatos_edit->avatar->UploadMaxFileSize ?>">
</div>
<table id="ft_x_avatar" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $contatos_edit->avatar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contatos_edit->nome_completo->Visible) { // nome_completo ?>
	<div id="r_nome_completo" class="form-group row">
		<label id="elh_contatos_nome_completo" for="x_nome_completo" class="<?php echo $contatos_edit->LeftColumnClass ?>"><?php echo $contatos_edit->nome_completo->caption() ?><?php echo $contatos_edit->nome_completo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contatos_edit->RightColumnClass ?>"><div <?php echo $contatos_edit->nome_completo->cellAttributes() ?>>
<span id="el_contatos_nome_completo">
<input type="text" data-table="contatos" data-field="x_nome_completo" name="x_nome_completo" id="x_nome_completo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contatos_edit->nome_completo->getPlaceHolder()) ?>" value="<?php echo $contatos_edit->nome_completo->EditValue ?>"<?php echo $contatos_edit->nome_completo->editAttributes() ?>>
</span>
<?php echo $contatos_edit->nome_completo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contatos_edit->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_contatos__email" for="x__email" class="<?php echo $contatos_edit->LeftColumnClass ?>"><?php echo $contatos_edit->_email->caption() ?><?php echo $contatos_edit->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contatos_edit->RightColumnClass ?>"><div <?php echo $contatos_edit->_email->cellAttributes() ?>>
<span id="el_contatos__email">
<input type="text" data-table="contatos" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contatos_edit->_email->getPlaceHolder()) ?>" value="<?php echo $contatos_edit->_email->EditValue ?>"<?php echo $contatos_edit->_email->editAttributes() ?>>
</span>
<?php echo $contatos_edit->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contatos_edit->telefone->Visible) { // telefone ?>
	<div id="r_telefone" class="form-group row">
		<label id="elh_contatos_telefone" for="x_telefone" class="<?php echo $contatos_edit->LeftColumnClass ?>"><?php echo $contatos_edit->telefone->caption() ?><?php echo $contatos_edit->telefone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contatos_edit->RightColumnClass ?>"><div <?php echo $contatos_edit->telefone->cellAttributes() ?>>
<span id="el_contatos_telefone">
<input type="text" data-table="contatos" data-field="x_telefone" name="x_telefone" id="x_telefone" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($contatos_edit->telefone->getPlaceHolder()) ?>" value="<?php echo $contatos_edit->telefone->EditValue ?>"<?php echo $contatos_edit->telefone->editAttributes() ?>>
</span>
<?php echo $contatos_edit->telefone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contatos_edit->celular->Visible) { // celular ?>
	<div id="r_celular" class="form-group row">
		<label id="elh_contatos_celular" for="x_celular" class="<?php echo $contatos_edit->LeftColumnClass ?>"><?php echo $contatos_edit->celular->caption() ?><?php echo $contatos_edit->celular->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contatos_edit->RightColumnClass ?>"><div <?php echo $contatos_edit->celular->cellAttributes() ?>>
<span id="el_contatos_celular">
<input type="text" data-table="contatos" data-field="x_celular" name="x_celular" id="x_celular" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($contatos_edit->celular->getPlaceHolder()) ?>" value="<?php echo $contatos_edit->celular->EditValue ?>"<?php echo $contatos_edit->celular->editAttributes() ?>>
</span>
<?php echo $contatos_edit->celular->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contatos_edit->empresa->Visible) { // empresa ?>
	<div id="r_empresa" class="form-group row">
		<label id="elh_contatos_empresa" for="x_empresa" class="<?php echo $contatos_edit->LeftColumnClass ?>"><?php echo $contatos_edit->empresa->caption() ?><?php echo $contatos_edit->empresa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contatos_edit->RightColumnClass ?>"><div <?php echo $contatos_edit->empresa->cellAttributes() ?>>
<span id="el_contatos_empresa">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($contatos_edit->empresa->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $contatos_edit->empresa->ViewValue ?></button>
		<div id="dsl_x_empresa" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $contatos_edit->empresa->radioButtonListHtml(TRUE, "x_empresa") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_empresa" class="ew-template"><input type="radio" class="custom-control-input" data-table="contatos" data-field="x_empresa" data-value-separator="<?php echo $contatos_edit->empresa->displayValueSeparatorAttribute() ?>" name="x_empresa" id="x_empresa" value="{value}"<?php echo $contatos_edit->empresa->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$contatos_edit->empresa->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $contatos_edit->empresa->Lookup->getParamTag($contatos_edit, "p_x_empresa") ?>
</span>
<?php echo $contatos_edit->empresa->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contatos_edit->cargo->Visible) { // cargo ?>
	<div id="r_cargo" class="form-group row">
		<label id="elh_contatos_cargo" for="x_cargo" class="<?php echo $contatos_edit->LeftColumnClass ?>"><?php echo $contatos_edit->cargo->caption() ?><?php echo $contatos_edit->cargo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contatos_edit->RightColumnClass ?>"><div <?php echo $contatos_edit->cargo->cellAttributes() ?>>
<span id="el_contatos_cargo">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_cargo"><?php echo EmptyValue(strval($contatos_edit->cargo->ViewValue)) ? $Language->phrase("PleaseSelect") : $contatos_edit->cargo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contatos_edit->cargo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contatos_edit->cargo->ReadOnly || $contatos_edit->cargo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_cargo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contatos_edit->cargo->Lookup->getParamTag($contatos_edit, "p_x_cargo") ?>
<input type="hidden" data-table="contatos" data-field="x_cargo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contatos_edit->cargo->displayValueSeparatorAttribute() ?>" name="x_cargo" id="x_cargo" value="<?php echo $contatos_edit->cargo->CurrentValue ?>"<?php echo $contatos_edit->cargo->editAttributes() ?>>
</span>
<?php echo $contatos_edit->cargo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contatos_edit->responsabilidades->Visible) { // responsabilidades ?>
	<div id="r_responsabilidades" class="form-group row">
		<label id="elh_contatos_responsabilidades" for="x_responsabilidades" class="<?php echo $contatos_edit->LeftColumnClass ?>"><?php echo $contatos_edit->responsabilidades->caption() ?><?php echo $contatos_edit->responsabilidades->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contatos_edit->RightColumnClass ?>"><div <?php echo $contatos_edit->responsabilidades->cellAttributes() ?>>
<span id="el_contatos_responsabilidades">
<input type="text" data-table="contatos" data-field="x_responsabilidades" name="x_responsabilidades" id="x_responsabilidades" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contatos_edit->responsabilidades->getPlaceHolder()) ?>" value="<?php echo $contatos_edit->responsabilidades->EditValue ?>"<?php echo $contatos_edit->responsabilidades->editAttributes() ?>>
</span>
<?php echo $contatos_edit->responsabilidades->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contatos_edit->obs->Visible) { // obs ?>
	<div id="r_obs" class="form-group row">
		<label id="elh_contatos_obs" for="x_obs" class="<?php echo $contatos_edit->LeftColumnClass ?>"><?php echo $contatos_edit->obs->caption() ?><?php echo $contatos_edit->obs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contatos_edit->RightColumnClass ?>"><div <?php echo $contatos_edit->obs->cellAttributes() ?>>
<span id="el_contatos_obs">
<input type="text" data-table="contatos" data-field="x_obs" name="x_obs" id="x_obs" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contatos_edit->obs->getPlaceHolder()) ?>" value="<?php echo $contatos_edit->obs->EditValue ?>"<?php echo $contatos_edit->obs->editAttributes() ?>>
</span>
<?php echo $contatos_edit->obs->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$contatos_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contatos_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contatos_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$contatos_edit->showPageFooter();
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
$contatos_edit->terminate();
?>