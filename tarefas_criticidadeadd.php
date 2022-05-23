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
$tarefas_criticidade_add = new tarefas_criticidade_add();

// Run the page
$tarefas_criticidade_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tarefas_criticidade_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftarefas_criticidadeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ftarefas_criticidadeadd = currentForm = new ew.Form("ftarefas_criticidadeadd", "add");

	// Validate form
	ftarefas_criticidadeadd.validate = function() {
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
			<?php if ($tarefas_criticidade_add->criticidade->Required) { ?>
				elm = this.getElements("x" + infix + "_criticidade");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tarefas_criticidade_add->criticidade->caption(), $tarefas_criticidade_add->criticidade->RequiredErrorMessage)) ?>");
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
	ftarefas_criticidadeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftarefas_criticidadeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftarefas_criticidadeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tarefas_criticidade_add->showPageHeader(); ?>
<?php
$tarefas_criticidade_add->showMessage();
?>
<form name="ftarefas_criticidadeadd" id="ftarefas_criticidadeadd" class="<?php echo $tarefas_criticidade_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tarefas_criticidade">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tarefas_criticidade_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tarefas_criticidade_add->criticidade->Visible) { // criticidade ?>
	<div id="r_criticidade" class="form-group row">
		<label id="elh_tarefas_criticidade_criticidade" for="x_criticidade" class="<?php echo $tarefas_criticidade_add->LeftColumnClass ?>"><?php echo $tarefas_criticidade_add->criticidade->caption() ?><?php echo $tarefas_criticidade_add->criticidade->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tarefas_criticidade_add->RightColumnClass ?>"><div <?php echo $tarefas_criticidade_add->criticidade->cellAttributes() ?>>
<span id="el_tarefas_criticidade_criticidade">
<input type="text" data-table="tarefas_criticidade" data-field="x_criticidade" name="x_criticidade" id="x_criticidade" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($tarefas_criticidade_add->criticidade->getPlaceHolder()) ?>" value="<?php echo $tarefas_criticidade_add->criticidade->EditValue ?>"<?php echo $tarefas_criticidade_add->criticidade->editAttributes() ?>>
</span>
<?php echo $tarefas_criticidade_add->criticidade->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tarefas_criticidade_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tarefas_criticidade_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tarefas_criticidade_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tarefas_criticidade_add->showPageFooter();
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
$tarefas_criticidade_add->terminate();
?>