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
$know_base_categorias_add = new know_base_categorias_add();

// Run the page
$know_base_categorias_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$know_base_categorias_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fknow_base_categoriasadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fknow_base_categoriasadd = currentForm = new ew.Form("fknow_base_categoriasadd", "add");

	// Validate form
	fknow_base_categoriasadd.validate = function() {
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
			<?php if ($know_base_categorias_add->nome_categoria->Required) { ?>
				elm = this.getElements("x" + infix + "_nome_categoria");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $know_base_categorias_add->nome_categoria->caption(), $know_base_categorias_add->nome_categoria->RequiredErrorMessage)) ?>");
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
	fknow_base_categoriasadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fknow_base_categoriasadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fknow_base_categoriasadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $know_base_categorias_add->showPageHeader(); ?>
<?php
$know_base_categorias_add->showMessage();
?>
<form name="fknow_base_categoriasadd" id="fknow_base_categoriasadd" class="<?php echo $know_base_categorias_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="know_base_categorias">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$know_base_categorias_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($know_base_categorias_add->nome_categoria->Visible) { // nome_categoria ?>
	<div id="r_nome_categoria" class="form-group row">
		<label id="elh_know_base_categorias_nome_categoria" for="x_nome_categoria" class="<?php echo $know_base_categorias_add->LeftColumnClass ?>"><?php echo $know_base_categorias_add->nome_categoria->caption() ?><?php echo $know_base_categorias_add->nome_categoria->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $know_base_categorias_add->RightColumnClass ?>"><div <?php echo $know_base_categorias_add->nome_categoria->cellAttributes() ?>>
<span id="el_know_base_categorias_nome_categoria">
<input type="text" data-table="know_base_categorias" data-field="x_nome_categoria" name="x_nome_categoria" id="x_nome_categoria" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($know_base_categorias_add->nome_categoria->getPlaceHolder()) ?>" value="<?php echo $know_base_categorias_add->nome_categoria->EditValue ?>"<?php echo $know_base_categorias_add->nome_categoria->editAttributes() ?>>
</span>
<?php echo $know_base_categorias_add->nome_categoria->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$know_base_categorias_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $know_base_categorias_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $know_base_categorias_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$know_base_categorias_add->showPageFooter();
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
$know_base_categorias_add->terminate();
?>