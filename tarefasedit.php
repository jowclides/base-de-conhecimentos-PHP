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
$tarefas_edit = new tarefas_edit();

// Run the page
$tarefas_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tarefas_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftarefasedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftarefasedit = currentForm = new ew.Form("ftarefasedit", "edit");

	// Validate form
	ftarefasedit.validate = function() {
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
			<?php if ($tarefas_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tarefas_edit->id->caption(), $tarefas_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tarefas_edit->titulo->Required) { ?>
				elm = this.getElements("x" + infix + "_titulo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tarefas_edit->titulo->caption(), $tarefas_edit->titulo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tarefas_edit->criticidade_id->Required) { ?>
				elm = this.getElements("x" + infix + "_criticidade_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tarefas_edit->criticidade_id->caption(), $tarefas_edit->criticidade_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tarefas_edit->owner->Required) { ?>
				elm = this.getElements("x" + infix + "_owner");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tarefas_edit->owner->caption(), $tarefas_edit->owner->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tarefas_edit->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tarefas_edit->status->caption(), $tarefas_edit->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tarefas_edit->prazo_entrega->Required) { ?>
				elm = this.getElements("x" + infix + "_prazo_entrega");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tarefas_edit->prazo_entrega->caption(), $tarefas_edit->prazo_entrega->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_prazo_entrega");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tarefas_edit->prazo_entrega->errorMessage()) ?>");
			<?php if ($tarefas_edit->memo->Required) { ?>
				elm = this.getElements("x" + infix + "_memo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tarefas_edit->memo->caption(), $tarefas_edit->memo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tarefas_edit->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tarefas_edit->updated_at->caption(), $tarefas_edit->updated_at->RequiredErrorMessage)) ?>");
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
	ftarefasedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftarefasedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftarefasedit.lists["x_criticidade_id"] = <?php echo $tarefas_edit->criticidade_id->Lookup->toClientList($tarefas_edit) ?>;
	ftarefasedit.lists["x_criticidade_id"].options = <?php echo JsonEncode($tarefas_edit->criticidade_id->lookupOptions()) ?>;
	ftarefasedit.lists["x_status"] = <?php echo $tarefas_edit->status->Lookup->toClientList($tarefas_edit) ?>;
	ftarefasedit.lists["x_status"].options = <?php echo JsonEncode($tarefas_edit->status->lookupOptions()) ?>;
	loadjs.done("ftarefasedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tarefas_edit->showPageHeader(); ?>
<?php
$tarefas_edit->showMessage();
?>
<form name="ftarefasedit" id="ftarefasedit" class="<?php echo $tarefas_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tarefas">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tarefas_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tarefas_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_tarefas_id" class="<?php echo $tarefas_edit->LeftColumnClass ?>"><?php echo $tarefas_edit->id->caption() ?><?php echo $tarefas_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tarefas_edit->RightColumnClass ?>"><div <?php echo $tarefas_edit->id->cellAttributes() ?>>
<span id="el_tarefas_id">
<span<?php echo $tarefas_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tarefas_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="tarefas" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($tarefas_edit->id->CurrentValue) ?>">
<?php echo $tarefas_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tarefas_edit->titulo->Visible) { // titulo ?>
	<div id="r_titulo" class="form-group row">
		<label id="elh_tarefas_titulo" for="x_titulo" class="<?php echo $tarefas_edit->LeftColumnClass ?>"><?php echo $tarefas_edit->titulo->caption() ?><?php echo $tarefas_edit->titulo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tarefas_edit->RightColumnClass ?>"><div <?php echo $tarefas_edit->titulo->cellAttributes() ?>>
<span id="el_tarefas_titulo">
<input type="text" data-table="tarefas" data-field="x_titulo" name="x_titulo" id="x_titulo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tarefas_edit->titulo->getPlaceHolder()) ?>" value="<?php echo $tarefas_edit->titulo->EditValue ?>"<?php echo $tarefas_edit->titulo->editAttributes() ?>>
</span>
<?php echo $tarefas_edit->titulo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tarefas_edit->criticidade_id->Visible) { // criticidade_id ?>
	<div id="r_criticidade_id" class="form-group row">
		<label id="elh_tarefas_criticidade_id" for="x_criticidade_id" class="<?php echo $tarefas_edit->LeftColumnClass ?>"><?php echo $tarefas_edit->criticidade_id->caption() ?><?php echo $tarefas_edit->criticidade_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tarefas_edit->RightColumnClass ?>"><div <?php echo $tarefas_edit->criticidade_id->cellAttributes() ?>>
<span id="el_tarefas_criticidade_id">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($tarefas_edit->criticidade_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $tarefas_edit->criticidade_id->ViewValue ?></button>
		<div id="dsl_x_criticidade_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $tarefas_edit->criticidade_id->radioButtonListHtml(TRUE, "x_criticidade_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_criticidade_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="tarefas" data-field="x_criticidade_id" data-value-separator="<?php echo $tarefas_edit->criticidade_id->displayValueSeparatorAttribute() ?>" name="x_criticidade_id" id="x_criticidade_id" value="{value}"<?php echo $tarefas_edit->criticidade_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$tarefas_edit->criticidade_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $tarefas_edit->criticidade_id->Lookup->getParamTag($tarefas_edit, "p_x_criticidade_id") ?>
</span>
<?php echo $tarefas_edit->criticidade_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tarefas_edit->owner->Visible) { // owner ?>
	<div id="r_owner" class="form-group row">
		<label id="elh_tarefas_owner" for="x_owner" class="<?php echo $tarefas_edit->LeftColumnClass ?>"><?php echo $tarefas_edit->owner->caption() ?><?php echo $tarefas_edit->owner->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tarefas_edit->RightColumnClass ?>"><div <?php echo $tarefas_edit->owner->cellAttributes() ?>>
<span id="el_tarefas_owner">
<input type="text" data-table="tarefas" data-field="x_owner" name="x_owner" id="x_owner" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tarefas_edit->owner->getPlaceHolder()) ?>" value="<?php echo $tarefas_edit->owner->EditValue ?>"<?php echo $tarefas_edit->owner->editAttributes() ?>>
</span>
<?php echo $tarefas_edit->owner->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tarefas_edit->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_tarefas_status" for="x_status" class="<?php echo $tarefas_edit->LeftColumnClass ?>"><?php echo $tarefas_edit->status->caption() ?><?php echo $tarefas_edit->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tarefas_edit->RightColumnClass ?>"><div <?php echo $tarefas_edit->status->cellAttributes() ?>>
<span id="el_tarefas_status">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($tarefas_edit->status->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $tarefas_edit->status->ViewValue ?></button>
		<div id="dsl_x_status" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $tarefas_edit->status->radioButtonListHtml(TRUE, "x_status") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_status" class="ew-template"><input type="radio" class="custom-control-input" data-table="tarefas" data-field="x_status" data-value-separator="<?php echo $tarefas_edit->status->displayValueSeparatorAttribute() ?>" name="x_status" id="x_status" value="{value}"<?php echo $tarefas_edit->status->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$tarefas_edit->status->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $tarefas_edit->status->Lookup->getParamTag($tarefas_edit, "p_x_status") ?>
</span>
<?php echo $tarefas_edit->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tarefas_edit->prazo_entrega->Visible) { // prazo_entrega ?>
	<div id="r_prazo_entrega" class="form-group row">
		<label id="elh_tarefas_prazo_entrega" for="x_prazo_entrega" class="<?php echo $tarefas_edit->LeftColumnClass ?>"><?php echo $tarefas_edit->prazo_entrega->caption() ?><?php echo $tarefas_edit->prazo_entrega->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tarefas_edit->RightColumnClass ?>"><div <?php echo $tarefas_edit->prazo_entrega->cellAttributes() ?>>
<span id="el_tarefas_prazo_entrega">
<input type="text" data-table="tarefas" data-field="x_prazo_entrega" name="x_prazo_entrega" id="x_prazo_entrega" maxlength="19" placeholder="<?php echo HtmlEncode($tarefas_edit->prazo_entrega->getPlaceHolder()) ?>" value="<?php echo $tarefas_edit->prazo_entrega->EditValue ?>"<?php echo $tarefas_edit->prazo_entrega->editAttributes() ?>>
<?php if (!$tarefas_edit->prazo_entrega->ReadOnly && !$tarefas_edit->prazo_entrega->Disabled && !isset($tarefas_edit->prazo_entrega->EditAttrs["readonly"]) && !isset($tarefas_edit->prazo_entrega->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftarefasedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ftarefasedit", "x_prazo_entrega", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $tarefas_edit->prazo_entrega->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tarefas_edit->memo->Visible) { // memo ?>
	<div id="r_memo" class="form-group row">
		<label id="elh_tarefas_memo" class="<?php echo $tarefas_edit->LeftColumnClass ?>"><?php echo $tarefas_edit->memo->caption() ?><?php echo $tarefas_edit->memo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tarefas_edit->RightColumnClass ?>"><div <?php echo $tarefas_edit->memo->cellAttributes() ?>>
<span id="el_tarefas_memo">
<?php $tarefas_edit->memo->EditAttrs->appendClass("editor"); ?>
<textarea data-table="tarefas" data-field="x_memo" name="x_memo" id="x_memo" cols="35" rows="4" placeholder="<?php echo HtmlEncode($tarefas_edit->memo->getPlaceHolder()) ?>"<?php echo $tarefas_edit->memo->editAttributes() ?>><?php echo $tarefas_edit->memo->EditValue ?></textarea>
<script>
loadjs.ready(["ftarefasedit", "editor"], function() {
	ew.createEditor("ftarefasedit", "x_memo", 35, 4, <?php echo $tarefas_edit->memo->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $tarefas_edit->memo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tarefas_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tarefas_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tarefas_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tarefas_edit->showPageFooter();
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
$tarefas_edit->terminate();
?>