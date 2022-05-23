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
$contatos_search = new contatos_search();

// Run the page
$contatos_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contatos_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontatossearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($contatos_search->IsModal) { ?>
	fcontatossearch = currentAdvancedSearchForm = new ew.Form("fcontatossearch", "search");
	<?php } else { ?>
	fcontatossearch = currentForm = new ew.Form("fcontatossearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fcontatossearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($contatos_search->id->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fcontatossearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontatossearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcontatossearch.lists["x_empresa"] = <?php echo $contatos_search->empresa->Lookup->toClientList($contatos_search) ?>;
	fcontatossearch.lists["x_empresa"].options = <?php echo JsonEncode($contatos_search->empresa->lookupOptions()) ?>;
	fcontatossearch.lists["x_cargo"] = <?php echo $contatos_search->cargo->Lookup->toClientList($contatos_search) ?>;
	fcontatossearch.lists["x_cargo"].options = <?php echo JsonEncode($contatos_search->cargo->lookupOptions()) ?>;
	loadjs.done("fcontatossearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contatos_search->showPageHeader(); ?>
<?php
$contatos_search->showMessage();
?>
<form name="fcontatossearch" id="fcontatossearch" class="<?php echo $contatos_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contatos">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$contatos_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($contatos_search->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label for="x_id" class="<?php echo $contatos_search->LeftColumnClass ?>"><span id="elh_contatos_id"><?php echo $contatos_search->id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
		</label>
		<div class="<?php echo $contatos_search->RightColumnClass ?>"><div <?php echo $contatos_search->id->cellAttributes() ?>>
			<span id="el_contatos_id" class="ew-search-field">
<input type="text" data-table="contatos" data-field="x_id" name="x_id" id="x_id" maxlength="11" placeholder="<?php echo HtmlEncode($contatos_search->id->getPlaceHolder()) ?>" value="<?php echo $contatos_search->id->EditValue ?>"<?php echo $contatos_search->id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contatos_search->avatar->Visible) { // avatar ?>
	<div id="r_avatar" class="form-group row">
		<label class="<?php echo $contatos_search->LeftColumnClass ?>"><span id="elh_contatos_avatar"><?php echo $contatos_search->avatar->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_avatar" id="z_avatar" value="LIKE">
</span>
		</label>
		<div class="<?php echo $contatos_search->RightColumnClass ?>"><div <?php echo $contatos_search->avatar->cellAttributes() ?>>
			<span id="el_contatos_avatar" class="ew-search-field">
<input type="text" data-table="contatos" data-field="x_avatar" name="x_avatar" id="x_avatar" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contatos_search->avatar->getPlaceHolder()) ?>" value="<?php echo $contatos_search->avatar->EditValue ?>"<?php echo $contatos_search->avatar->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contatos_search->nome_completo->Visible) { // nome_completo ?>
	<div id="r_nome_completo" class="form-group row">
		<label for="x_nome_completo" class="<?php echo $contatos_search->LeftColumnClass ?>"><span id="elh_contatos_nome_completo"><?php echo $contatos_search->nome_completo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nome_completo" id="z_nome_completo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $contatos_search->RightColumnClass ?>"><div <?php echo $contatos_search->nome_completo->cellAttributes() ?>>
			<span id="el_contatos_nome_completo" class="ew-search-field">
<input type="text" data-table="contatos" data-field="x_nome_completo" name="x_nome_completo" id="x_nome_completo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contatos_search->nome_completo->getPlaceHolder()) ?>" value="<?php echo $contatos_search->nome_completo->EditValue ?>"<?php echo $contatos_search->nome_completo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contatos_search->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label for="x__email" class="<?php echo $contatos_search->LeftColumnClass ?>"><span id="elh_contatos__email"><?php echo $contatos_search->_email->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z__email" id="z__email" value="LIKE">
</span>
		</label>
		<div class="<?php echo $contatos_search->RightColumnClass ?>"><div <?php echo $contatos_search->_email->cellAttributes() ?>>
			<span id="el_contatos__email" class="ew-search-field">
<input type="text" data-table="contatos" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contatos_search->_email->getPlaceHolder()) ?>" value="<?php echo $contatos_search->_email->EditValue ?>"<?php echo $contatos_search->_email->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contatos_search->telefone->Visible) { // telefone ?>
	<div id="r_telefone" class="form-group row">
		<label for="x_telefone" class="<?php echo $contatos_search->LeftColumnClass ?>"><span id="elh_contatos_telefone"><?php echo $contatos_search->telefone->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_telefone" id="z_telefone" value="LIKE">
</span>
		</label>
		<div class="<?php echo $contatos_search->RightColumnClass ?>"><div <?php echo $contatos_search->telefone->cellAttributes() ?>>
			<span id="el_contatos_telefone" class="ew-search-field">
<input type="text" data-table="contatos" data-field="x_telefone" name="x_telefone" id="x_telefone" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($contatos_search->telefone->getPlaceHolder()) ?>" value="<?php echo $contatos_search->telefone->EditValue ?>"<?php echo $contatos_search->telefone->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contatos_search->celular->Visible) { // celular ?>
	<div id="r_celular" class="form-group row">
		<label for="x_celular" class="<?php echo $contatos_search->LeftColumnClass ?>"><span id="elh_contatos_celular"><?php echo $contatos_search->celular->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_celular" id="z_celular" value="LIKE">
</span>
		</label>
		<div class="<?php echo $contatos_search->RightColumnClass ?>"><div <?php echo $contatos_search->celular->cellAttributes() ?>>
			<span id="el_contatos_celular" class="ew-search-field">
<input type="text" data-table="contatos" data-field="x_celular" name="x_celular" id="x_celular" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($contatos_search->celular->getPlaceHolder()) ?>" value="<?php echo $contatos_search->celular->EditValue ?>"<?php echo $contatos_search->celular->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contatos_search->empresa->Visible) { // empresa ?>
	<div id="r_empresa" class="form-group row">
		<label for="x_empresa" class="<?php echo $contatos_search->LeftColumnClass ?>"><span id="elh_contatos_empresa"><?php echo $contatos_search->empresa->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_empresa" id="z_empresa" value="=">
</span>
		</label>
		<div class="<?php echo $contatos_search->RightColumnClass ?>"><div <?php echo $contatos_search->empresa->cellAttributes() ?>>
			<span id="el_contatos_empresa" class="ew-search-field">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($contatos_search->empresa->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $contatos_search->empresa->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_empresa" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $contatos_search->empresa->radioButtonListHtml(TRUE, "x_empresa") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_empresa" class="ew-template"><input type="radio" class="custom-control-input" data-table="contatos" data-field="x_empresa" data-value-separator="<?php echo $contatos_search->empresa->displayValueSeparatorAttribute() ?>" name="x_empresa" id="x_empresa" value="{value}"<?php echo $contatos_search->empresa->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$contatos_search->empresa->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $contatos_search->empresa->Lookup->getParamTag($contatos_search, "p_x_empresa") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contatos_search->cargo->Visible) { // cargo ?>
	<div id="r_cargo" class="form-group row">
		<label for="x_cargo" class="<?php echo $contatos_search->LeftColumnClass ?>"><span id="elh_contatos_cargo"><?php echo $contatos_search->cargo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_cargo" id="z_cargo" value="=">
</span>
		</label>
		<div class="<?php echo $contatos_search->RightColumnClass ?>"><div <?php echo $contatos_search->cargo->cellAttributes() ?>>
			<span id="el_contatos_cargo" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_cargo"><?php echo EmptyValue(strval($contatos_search->cargo->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $contatos_search->cargo->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contatos_search->cargo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contatos_search->cargo->ReadOnly || $contatos_search->cargo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_cargo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contatos_search->cargo->Lookup->getParamTag($contatos_search, "p_x_cargo") ?>
<input type="hidden" data-table="contatos" data-field="x_cargo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contatos_search->cargo->displayValueSeparatorAttribute() ?>" name="x_cargo" id="x_cargo" value="<?php echo $contatos_search->cargo->AdvancedSearch->SearchValue ?>"<?php echo $contatos_search->cargo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contatos_search->responsabilidades->Visible) { // responsabilidades ?>
	<div id="r_responsabilidades" class="form-group row">
		<label for="x_responsabilidades" class="<?php echo $contatos_search->LeftColumnClass ?>"><span id="elh_contatos_responsabilidades"><?php echo $contatos_search->responsabilidades->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_responsabilidades" id="z_responsabilidades" value="LIKE">
</span>
		</label>
		<div class="<?php echo $contatos_search->RightColumnClass ?>"><div <?php echo $contatos_search->responsabilidades->cellAttributes() ?>>
			<span id="el_contatos_responsabilidades" class="ew-search-field">
<input type="text" data-table="contatos" data-field="x_responsabilidades" name="x_responsabilidades" id="x_responsabilidades" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contatos_search->responsabilidades->getPlaceHolder()) ?>" value="<?php echo $contatos_search->responsabilidades->EditValue ?>"<?php echo $contatos_search->responsabilidades->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($contatos_search->obs->Visible) { // obs ?>
	<div id="r_obs" class="form-group row">
		<label for="x_obs" class="<?php echo $contatos_search->LeftColumnClass ?>"><span id="elh_contatos_obs"><?php echo $contatos_search->obs->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_obs" id="z_obs" value="LIKE">
</span>
		</label>
		<div class="<?php echo $contatos_search->RightColumnClass ?>"><div <?php echo $contatos_search->obs->cellAttributes() ?>>
			<span id="el_contatos_obs" class="ew-search-field">
<input type="text" data-table="contatos" data-field="x_obs" name="x_obs" id="x_obs" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contatos_search->obs->getPlaceHolder()) ?>" value="<?php echo $contatos_search->obs->EditValue ?>"<?php echo $contatos_search->obs->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$contatos_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contatos_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$contatos_search->showPageFooter();
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
$contatos_search->terminate();
?>