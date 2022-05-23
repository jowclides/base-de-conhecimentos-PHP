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
$contatos_add = new contatos_add();

// Run the page
$contatos_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contatos_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontatosadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcontatosadd = currentForm = new ew.Form("fcontatosadd", "add");

	// Validate form
	fcontatosadd.validate = function() {
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
			<?php if ($contatos_add->avatar->Required) { ?>
				felm = this.getElements("x" + infix + "_avatar");
				elm = this.getElements("fn_x" + infix + "_avatar");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $contatos_add->avatar->caption(), $contatos_add->avatar->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contatos_add->nome_completo->Required) { ?>
				elm = this.getElements("x" + infix + "_nome_completo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contatos_add->nome_completo->caption(), $contatos_add->nome_completo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contatos_add->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contatos_add->_email->caption(), $contatos_add->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contatos_add->telefone->Required) { ?>
				elm = this.getElements("x" + infix + "_telefone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contatos_add->telefone->caption(), $contatos_add->telefone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contatos_add->celular->Required) { ?>
				elm = this.getElements("x" + infix + "_celular");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contatos_add->celular->caption(), $contatos_add->celular->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contatos_add->empresa->Required) { ?>
				elm = this.getElements("x" + infix + "_empresa");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contatos_add->empresa->caption(), $contatos_add->empresa->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contatos_add->cargo->Required) { ?>
				elm = this.getElements("x" + infix + "_cargo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contatos_add->cargo->caption(), $contatos_add->cargo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contatos_add->responsabilidades->Required) { ?>
				elm = this.getElements("x" + infix + "_responsabilidades");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contatos_add->responsabilidades->caption(), $contatos_add->responsabilidades->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contatos_add->obs->Required) { ?>
				elm = this.getElements("x" + infix + "_obs");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contatos_add->obs->caption(), $contatos_add->obs->RequiredErrorMessage)) ?>");
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
	fcontatosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontatosadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcontatosadd.lists["x_empresa"] = <?php echo $contatos_add->empresa->Lookup->toClientList($contatos_add) ?>;
	fcontatosadd.lists["x_empresa"].options = <?php echo JsonEncode($contatos_add->empresa->lookupOptions()) ?>;
	fcontatosadd.lists["x_cargo"] = <?php echo $contatos_add->cargo->Lookup->toClientList($contatos_add) ?>;
	fcontatosadd.lists["x_cargo"].options = <?php echo JsonEncode($contatos_add->cargo->lookupOptions()) ?>;
	loadjs.done("fcontatosadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contatos_add->showPageHeader(); ?>
<?php
$contatos_add->showMessage();
?>
<form name="fcontatosadd" id="fcontatosadd" class="<?php echo $contatos_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contatos">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$contatos_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($contatos_add->avatar->Visible) { // avatar ?>
	<div id="r_avatar" class="form-group row">
		<label id="elh_contatos_avatar" class="<?php echo $contatos_add->LeftColumnClass ?>"><?php echo $contatos_add->avatar->caption() ?><?php echo $contatos_add->avatar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contatos_add->RightColumnClass ?>"><div <?php echo $contatos_add->avatar->cellAttributes() ?>>
<span id="el_contatos_avatar">
<div id="fd_x_avatar">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $contatos_add->avatar->title() ?>" data-table="contatos" data-field="x_avatar" name="x_avatar" id="x_avatar" lang="<?php echo CurrentLanguageID() ?>"<?php echo $contatos_add->avatar->editAttributes() ?><?php if ($contatos_add->avatar->ReadOnly || $contatos_add->avatar->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_avatar"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_avatar" id= "fn_x_avatar" value="<?php echo $contatos_add->avatar->Upload->FileName ?>">
<input type="hidden" name="fa_x_avatar" id= "fa_x_avatar" value="0">
<input type="hidden" name="fs_x_avatar" id= "fs_x_avatar" value="255">
<input type="hidden" name="fx_x_avatar" id= "fx_x_avatar" value="<?php echo $contatos_add->avatar->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_avatar" id= "fm_x_avatar" value="<?php echo $contatos_add->avatar->UploadMaxFileSize ?>">
</div>
<table id="ft_x_avatar" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $contatos_add->avatar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contatos_add->nome_completo->Visible) { // nome_completo ?>
	<div id="r_nome_completo" class="form-group row">
		<label id="elh_contatos_nome_completo" for="x_nome_completo" class="<?php echo $contatos_add->LeftColumnClass ?>"><?php echo $contatos_add->nome_completo->caption() ?><?php echo $contatos_add->nome_completo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contatos_add->RightColumnClass ?>"><div <?php echo $contatos_add->nome_completo->cellAttributes() ?>>
<span id="el_contatos_nome_completo">
<input type="text" data-table="contatos" data-field="x_nome_completo" name="x_nome_completo" id="x_nome_completo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contatos_add->nome_completo->getPlaceHolder()) ?>" value="<?php echo $contatos_add->nome_completo->EditValue ?>"<?php echo $contatos_add->nome_completo->editAttributes() ?>>
</span>
<?php echo $contatos_add->nome_completo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contatos_add->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_contatos__email" for="x__email" class="<?php echo $contatos_add->LeftColumnClass ?>"><?php echo $contatos_add->_email->caption() ?><?php echo $contatos_add->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contatos_add->RightColumnClass ?>"><div <?php echo $contatos_add->_email->cellAttributes() ?>>
<span id="el_contatos__email">
<input type="text" data-table="contatos" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contatos_add->_email->getPlaceHolder()) ?>" value="<?php echo $contatos_add->_email->EditValue ?>"<?php echo $contatos_add->_email->editAttributes() ?>>
</span>
<?php echo $contatos_add->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contatos_add->telefone->Visible) { // telefone ?>
	<div id="r_telefone" class="form-group row">
		<label id="elh_contatos_telefone" for="x_telefone" class="<?php echo $contatos_add->LeftColumnClass ?>"><?php echo $contatos_add->telefone->caption() ?><?php echo $contatos_add->telefone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contatos_add->RightColumnClass ?>"><div <?php echo $contatos_add->telefone->cellAttributes() ?>>
<span id="el_contatos_telefone">
<input type="text" data-table="contatos" data-field="x_telefone" name="x_telefone" id="x_telefone" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($contatos_add->telefone->getPlaceHolder()) ?>" value="<?php echo $contatos_add->telefone->EditValue ?>"<?php echo $contatos_add->telefone->editAttributes() ?>>
</span>
<?php echo $contatos_add->telefone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contatos_add->celular->Visible) { // celular ?>
	<div id="r_celular" class="form-group row">
		<label id="elh_contatos_celular" for="x_celular" class="<?php echo $contatos_add->LeftColumnClass ?>"><?php echo $contatos_add->celular->caption() ?><?php echo $contatos_add->celular->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contatos_add->RightColumnClass ?>"><div <?php echo $contatos_add->celular->cellAttributes() ?>>
<span id="el_contatos_celular">
<input type="text" data-table="contatos" data-field="x_celular" name="x_celular" id="x_celular" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($contatos_add->celular->getPlaceHolder()) ?>" value="<?php echo $contatos_add->celular->EditValue ?>"<?php echo $contatos_add->celular->editAttributes() ?>>
</span>
<?php echo $contatos_add->celular->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contatos_add->empresa->Visible) { // empresa ?>
	<div id="r_empresa" class="form-group row">
		<label id="elh_contatos_empresa" for="x_empresa" class="<?php echo $contatos_add->LeftColumnClass ?>"><?php echo $contatos_add->empresa->caption() ?><?php echo $contatos_add->empresa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contatos_add->RightColumnClass ?>"><div <?php echo $contatos_add->empresa->cellAttributes() ?>>
<span id="el_contatos_empresa">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($contatos_add->empresa->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $contatos_add->empresa->ViewValue ?></button>
		<div id="dsl_x_empresa" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $contatos_add->empresa->radioButtonListHtml(TRUE, "x_empresa") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_empresa" class="ew-template"><input type="radio" class="custom-control-input" data-table="contatos" data-field="x_empresa" data-value-separator="<?php echo $contatos_add->empresa->displayValueSeparatorAttribute() ?>" name="x_empresa" id="x_empresa" value="{value}"<?php echo $contatos_add->empresa->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$contatos_add->empresa->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $contatos_add->empresa->Lookup->getParamTag($contatos_add, "p_x_empresa") ?>
</span>
<?php echo $contatos_add->empresa->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contatos_add->cargo->Visible) { // cargo ?>
	<div id="r_cargo" class="form-group row">
		<label id="elh_contatos_cargo" for="x_cargo" class="<?php echo $contatos_add->LeftColumnClass ?>"><?php echo $contatos_add->cargo->caption() ?><?php echo $contatos_add->cargo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contatos_add->RightColumnClass ?>"><div <?php echo $contatos_add->cargo->cellAttributes() ?>>
<span id="el_contatos_cargo">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_cargo"><?php echo EmptyValue(strval($contatos_add->cargo->ViewValue)) ? $Language->phrase("PleaseSelect") : $contatos_add->cargo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contatos_add->cargo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contatos_add->cargo->ReadOnly || $contatos_add->cargo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_cargo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contatos_add->cargo->Lookup->getParamTag($contatos_add, "p_x_cargo") ?>
<input type="hidden" data-table="contatos" data-field="x_cargo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contatos_add->cargo->displayValueSeparatorAttribute() ?>" name="x_cargo" id="x_cargo" value="<?php echo $contatos_add->cargo->CurrentValue ?>"<?php echo $contatos_add->cargo->editAttributes() ?>>
</span>
<?php echo $contatos_add->cargo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contatos_add->responsabilidades->Visible) { // responsabilidades ?>
	<div id="r_responsabilidades" class="form-group row">
		<label id="elh_contatos_responsabilidades" for="x_responsabilidades" class="<?php echo $contatos_add->LeftColumnClass ?>"><?php echo $contatos_add->responsabilidades->caption() ?><?php echo $contatos_add->responsabilidades->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contatos_add->RightColumnClass ?>"><div <?php echo $contatos_add->responsabilidades->cellAttributes() ?>>
<span id="el_contatos_responsabilidades">
<input type="text" data-table="contatos" data-field="x_responsabilidades" name="x_responsabilidades" id="x_responsabilidades" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contatos_add->responsabilidades->getPlaceHolder()) ?>" value="<?php echo $contatos_add->responsabilidades->EditValue ?>"<?php echo $contatos_add->responsabilidades->editAttributes() ?>>
</span>
<?php echo $contatos_add->responsabilidades->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contatos_add->obs->Visible) { // obs ?>
	<div id="r_obs" class="form-group row">
		<label id="elh_contatos_obs" for="x_obs" class="<?php echo $contatos_add->LeftColumnClass ?>"><?php echo $contatos_add->obs->caption() ?><?php echo $contatos_add->obs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contatos_add->RightColumnClass ?>"><div <?php echo $contatos_add->obs->cellAttributes() ?>>
<span id="el_contatos_obs">
<input type="text" data-table="contatos" data-field="x_obs" name="x_obs" id="x_obs" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contatos_add->obs->getPlaceHolder()) ?>" value="<?php echo $contatos_add->obs->EditValue ?>"<?php echo $contatos_add->obs->editAttributes() ?>>
</span>
<?php echo $contatos_add->obs->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$contatos_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contatos_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contatos_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$contatos_add->showPageFooter();
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
$contatos_add->terminate();
?>