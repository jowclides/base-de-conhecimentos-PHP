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
$usuarios_edit = new usuarios_edit();

// Run the page
$usuarios_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuarios_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusuariosedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fusuariosedit = currentForm = new ew.Form("fusuariosedit", "edit");

	// Validate form
	fusuariosedit.validate = function() {
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
			<?php if ($usuarios_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_edit->id->caption(), $usuarios_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuarios_edit->usuario->Required) { ?>
				elm = this.getElements("x" + infix + "_usuario");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_edit->usuario->caption(), $usuarios_edit->usuario->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuarios_edit->senha->Required) { ?>
				elm = this.getElements("x" + infix + "_senha");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_edit->senha->caption(), $usuarios_edit->senha->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuarios_edit->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_edit->_email->caption(), $usuarios_edit->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuarios_edit->ativado->Required) { ?>
				elm = this.getElements("x" + infix + "_ativado");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_edit->ativado->caption(), $usuarios_edit->ativado->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuarios_edit->userlevel->Required) { ?>
				elm = this.getElements("x" + infix + "_userlevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_edit->userlevel->caption(), $usuarios_edit->userlevel->RequiredErrorMessage)) ?>");
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
	fusuariosedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fusuariosedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fusuariosedit.lists["x_ativado"] = <?php echo $usuarios_edit->ativado->Lookup->toClientList($usuarios_edit) ?>;
	fusuariosedit.lists["x_ativado"].options = <?php echo JsonEncode($usuarios_edit->ativado->options(FALSE, TRUE)) ?>;
	fusuariosedit.lists["x_userlevel"] = <?php echo $usuarios_edit->userlevel->Lookup->toClientList($usuarios_edit) ?>;
	fusuariosedit.lists["x_userlevel"].options = <?php echo JsonEncode($usuarios_edit->userlevel->lookupOptions()) ?>;
	loadjs.done("fusuariosedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $usuarios_edit->showPageHeader(); ?>
<?php
$usuarios_edit->showMessage();
?>
<form name="fusuariosedit" id="fusuariosedit" class="<?php echo $usuarios_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuarios">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$usuarios_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($usuarios_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_usuarios_id" class="<?php echo $usuarios_edit->LeftColumnClass ?>"><?php echo $usuarios_edit->id->caption() ?><?php echo $usuarios_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_edit->RightColumnClass ?>"><div <?php echo $usuarios_edit->id->cellAttributes() ?>>
<span id="el_usuarios_id">
<span<?php echo $usuarios_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($usuarios_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="usuarios" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($usuarios_edit->id->CurrentValue) ?>">
<?php echo $usuarios_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_edit->usuario->Visible) { // usuario ?>
	<div id="r_usuario" class="form-group row">
		<label id="elh_usuarios_usuario" for="x_usuario" class="<?php echo $usuarios_edit->LeftColumnClass ?>"><?php echo $usuarios_edit->usuario->caption() ?><?php echo $usuarios_edit->usuario->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_edit->RightColumnClass ?>"><div <?php echo $usuarios_edit->usuario->cellAttributes() ?>>
<span id="el_usuarios_usuario">
<input type="text" data-table="usuarios" data-field="x_usuario" name="x_usuario" id="x_usuario" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($usuarios_edit->usuario->getPlaceHolder()) ?>" value="<?php echo $usuarios_edit->usuario->EditValue ?>"<?php echo $usuarios_edit->usuario->editAttributes() ?>>
</span>
<?php echo $usuarios_edit->usuario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_edit->senha->Visible) { // senha ?>
	<div id="r_senha" class="form-group row">
		<label id="elh_usuarios_senha" for="x_senha" class="<?php echo $usuarios_edit->LeftColumnClass ?>"><?php echo $usuarios_edit->senha->caption() ?><?php echo $usuarios_edit->senha->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_edit->RightColumnClass ?>"><div <?php echo $usuarios_edit->senha->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<?php if (SameString($usuarios->_email->CurrentValue, CurrentUserID())) { ?>
	<span id="el_usuarios_senha">
	<span<?php echo $usuarios_edit->senha->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($usuarios_edit->senha->EditValue)) ?>"></span>
	</span>
<input type="hidden" data-table="usuarios" data-field="x_senha" name="x_senha" id="x_senha" value="<?php echo HtmlEncode($usuarios_edit->senha->CurrentValue) ?>">
<?php } else { ?>
<span id="el_usuarios_senha">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="usuarios" data-field="x_senha" data-value-separator="<?php echo $usuarios_edit->senha->displayValueSeparatorAttribute() ?>" id="x_senha" name="x_senha"<?php echo $usuarios_edit->senha->editAttributes() ?>>
			<?php echo $usuarios_edit->senha->selectOptionListHtml("x_senha") ?>
		</select>
</div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el_usuarios_senha">
<div class="input-group"><input type="password" name="x_senha" id="x_senha" autocomplete="new-password" data-field="x_senha" value="<?php echo $usuarios_edit->senha->EditValue ?>" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($usuarios_edit->senha->getPlaceHolder()) ?>"<?php echo $usuarios_edit->senha->editAttributes() ?>><div class="input-group-append"><button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button></div></div>
</span>
<?php } ?>
<?php echo $usuarios_edit->senha->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_edit->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_usuarios__email" for="x__email" class="<?php echo $usuarios_edit->LeftColumnClass ?>"><?php echo $usuarios_edit->_email->caption() ?><?php echo $usuarios_edit->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_edit->RightColumnClass ?>"><div <?php echo $usuarios_edit->_email->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$usuarios->userIDAllow("edit")) { // Non system admin ?>
<span id="el_usuarios__email">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="usuarios" data-field="x__email" data-value-separator="<?php echo $usuarios_edit->_email->displayValueSeparatorAttribute() ?>" id="x__email" name="x__email"<?php echo $usuarios_edit->_email->editAttributes() ?>>
			<?php echo $usuarios_edit->_email->selectOptionListHtml("x__email") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el_usuarios__email">
<input type="text" data-table="usuarios" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($usuarios_edit->_email->getPlaceHolder()) ?>" value="<?php echo $usuarios_edit->_email->EditValue ?>"<?php echo $usuarios_edit->_email->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $usuarios_edit->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_edit->ativado->Visible) { // ativado ?>
	<div id="r_ativado" class="form-group row">
		<label id="elh_usuarios_ativado" class="<?php echo $usuarios_edit->LeftColumnClass ?>"><?php echo $usuarios_edit->ativado->caption() ?><?php echo $usuarios_edit->ativado->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_edit->RightColumnClass ?>"><div <?php echo $usuarios_edit->ativado->cellAttributes() ?>>
<span id="el_usuarios_ativado">
<div id="tp_x_ativado" class="ew-template"><input type="radio" class="custom-control-input" data-table="usuarios" data-field="x_ativado" data-value-separator="<?php echo $usuarios_edit->ativado->displayValueSeparatorAttribute() ?>" name="x_ativado" id="x_ativado" value="{value}"<?php echo $usuarios_edit->ativado->editAttributes() ?>></div>
<div id="dsl_x_ativado" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $usuarios_edit->ativado->radioButtonListHtml(FALSE, "x_ativado") ?>
</div></div>
</span>
<?php echo $usuarios_edit->ativado->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_edit->userlevel->Visible) { // userlevel ?>
	<div id="r_userlevel" class="form-group row">
		<label id="elh_usuarios_userlevel" for="x_userlevel" class="<?php echo $usuarios_edit->LeftColumnClass ?>"><?php echo $usuarios_edit->userlevel->caption() ?><?php echo $usuarios_edit->userlevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_edit->RightColumnClass ?>"><div <?php echo $usuarios_edit->userlevel->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_usuarios_userlevel">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($usuarios_edit->userlevel->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el_usuarios_userlevel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="usuarios" data-field="x_userlevel" data-value-separator="<?php echo $usuarios_edit->userlevel->displayValueSeparatorAttribute() ?>" id="x_userlevel" name="x_userlevel"<?php echo $usuarios_edit->userlevel->editAttributes() ?>>
			<?php echo $usuarios_edit->userlevel->selectOptionListHtml("x_userlevel") ?>
		</select>
</div>
<?php echo $usuarios_edit->userlevel->Lookup->getParamTag($usuarios_edit, "p_x_userlevel") ?>
</span>
<?php } ?>
<?php echo $usuarios_edit->userlevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$usuarios_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $usuarios_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $usuarios_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$usuarios_edit->showPageFooter();
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
$usuarios_edit->terminate();
?>