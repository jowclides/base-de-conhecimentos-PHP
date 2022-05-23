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
$tarefas_list = new tarefas_list();

// Run the page
$tarefas_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tarefas_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tarefas_list->isExport()) { ?>
<script>
var ftarefaslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftarefaslist = currentForm = new ew.Form("ftarefaslist", "list");
	ftarefaslist.formKeyCountName = '<?php echo $tarefas_list->FormKeyCountName ?>';
	loadjs.done("ftarefaslist");
});
var ftarefaslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftarefaslistsrch = currentSearchForm = new ew.Form("ftarefaslistsrch");

	// Validate function for search
	ftarefaslistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_prazo_entrega");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($tarefas_list->prazo_entrega->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	ftarefaslistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftarefaslistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftarefaslistsrch.lists["x_criticidade_id"] = <?php echo $tarefas_list->criticidade_id->Lookup->toClientList($tarefas_list) ?>;
	ftarefaslistsrch.lists["x_criticidade_id"].options = <?php echo JsonEncode($tarefas_list->criticidade_id->lookupOptions()) ?>;
	ftarefaslistsrch.lists["x_status"] = <?php echo $tarefas_list->status->Lookup->toClientList($tarefas_list) ?>;
	ftarefaslistsrch.lists["x_status"].options = <?php echo JsonEncode($tarefas_list->status->lookupOptions()) ?>;

	// Filters
	ftarefaslistsrch.filterList = <?php echo $tarefas_list->getFilterList() ?>;
	loadjs.done("ftarefaslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tarefas_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tarefas_list->TotalRecords > 0 && $tarefas_list->ExportOptions->visible()) { ?>
<?php $tarefas_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tarefas_list->ImportOptions->visible()) { ?>
<?php $tarefas_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tarefas_list->SearchOptions->visible()) { ?>
<?php $tarefas_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tarefas_list->FilterOptions->visible()) { ?>
<?php $tarefas_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tarefas_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tarefas_list->isExport() && !$tarefas->CurrentAction) { ?>
<form name="ftarefaslistsrch" id="ftarefaslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftarefaslistsrch-search-panel" class="<?php echo $tarefas_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tarefas">
	<div class="ew-extended-search">
<?php

// Render search row
$tarefas->RowType = ROWTYPE_SEARCH;
$tarefas->resetAttributes();
$tarefas_list->renderRow();
?>
<?php if ($tarefas_list->criticidade_id->Visible) { // criticidade_id ?>
	<?php
		$tarefas_list->SearchColumnCount++;
		if (($tarefas_list->SearchColumnCount - 1) % $tarefas_list->SearchFieldsPerRow == 0) {
			$tarefas_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $tarefas_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_criticidade_id" class="ew-cell form-group">
		<label for="x_criticidade_id" class="ew-search-caption ew-label"><?php echo $tarefas_list->criticidade_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_criticidade_id" id="z_criticidade_id" value="=">
</span>
		<span id="el_tarefas_criticidade_id" class="ew-search-field">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($tarefas_list->criticidade_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $tarefas_list->criticidade_id->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_criticidade_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $tarefas_list->criticidade_id->radioButtonListHtml(TRUE, "x_criticidade_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_criticidade_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="tarefas" data-field="x_criticidade_id" data-value-separator="<?php echo $tarefas_list->criticidade_id->displayValueSeparatorAttribute() ?>" name="x_criticidade_id" id="x_criticidade_id" value="{value}"<?php echo $tarefas_list->criticidade_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$tarefas_list->criticidade_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $tarefas_list->criticidade_id->Lookup->getParamTag($tarefas_list, "p_x_criticidade_id") ?>
</span>
	</div>
	<?php if ($tarefas_list->SearchColumnCount % $tarefas_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($tarefas_list->status->Visible) { // status ?>
	<?php
		$tarefas_list->SearchColumnCount++;
		if (($tarefas_list->SearchColumnCount - 1) % $tarefas_list->SearchFieldsPerRow == 0) {
			$tarefas_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $tarefas_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_status" class="ew-cell form-group">
		<label for="x_status" class="ew-search-caption ew-label"><?php echo $tarefas_list->status->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_status" id="z_status" value="=">
</span>
		<span id="el_tarefas_status" class="ew-search-field">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($tarefas_list->status->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $tarefas_list->status->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_status" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $tarefas_list->status->radioButtonListHtml(TRUE, "x_status") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_status" class="ew-template"><input type="radio" class="custom-control-input" data-table="tarefas" data-field="x_status" data-value-separator="<?php echo $tarefas_list->status->displayValueSeparatorAttribute() ?>" name="x_status" id="x_status" value="{value}"<?php echo $tarefas_list->status->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$tarefas_list->status->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $tarefas_list->status->Lookup->getParamTag($tarefas_list, "p_x_status") ?>
</span>
	</div>
	<?php if ($tarefas_list->SearchColumnCount % $tarefas_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($tarefas_list->prazo_entrega->Visible) { // prazo_entrega ?>
	<?php
		$tarefas_list->SearchColumnCount++;
		if (($tarefas_list->SearchColumnCount - 1) % $tarefas_list->SearchFieldsPerRow == 0) {
			$tarefas_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $tarefas_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_prazo_entrega" class="ew-cell form-group">
		<label for="x_prazo_entrega" class="ew-search-caption ew-label"><?php echo $tarefas_list->prazo_entrega->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_prazo_entrega" id="z_prazo_entrega" value="=">
</span>
		<span id="el_tarefas_prazo_entrega" class="ew-search-field">
<input type="text" data-table="tarefas" data-field="x_prazo_entrega" name="x_prazo_entrega" id="x_prazo_entrega" maxlength="19" placeholder="<?php echo HtmlEncode($tarefas_list->prazo_entrega->getPlaceHolder()) ?>" value="<?php echo $tarefas_list->prazo_entrega->EditValue ?>"<?php echo $tarefas_list->prazo_entrega->editAttributes() ?>>
<?php if (!$tarefas_list->prazo_entrega->ReadOnly && !$tarefas_list->prazo_entrega->Disabled && !isset($tarefas_list->prazo_entrega->EditAttrs["readonly"]) && !isset($tarefas_list->prazo_entrega->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftarefaslistsrch", "datetimepicker"], function() {
	ew.createDateTimePicker("ftarefaslistsrch", "x_prazo_entrega", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
	</div>
	<?php if ($tarefas_list->SearchColumnCount % $tarefas_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($tarefas_list->SearchColumnCount % $tarefas_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $tarefas_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tarefas_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tarefas_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tarefas_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tarefas_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tarefas_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tarefas_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tarefas_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tarefas_list->showPageHeader(); ?>
<?php
$tarefas_list->showMessage();
?>
<?php if ($tarefas_list->TotalRecords > 0 || $tarefas->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tarefas_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tarefas">
<?php if (!$tarefas_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tarefas_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tarefas_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tarefas_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftarefaslist" id="ftarefaslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tarefas">
<div id="gmp_tarefas" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tarefas_list->TotalRecords > 0 || $tarefas_list->isGridEdit()) { ?>
<table id="tbl_tarefaslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tarefas->RowType = ROWTYPE_HEADER;

// Render list options
$tarefas_list->renderListOptions();

// Render list options (header, left)
$tarefas_list->ListOptions->render("header", "left");
?>
<?php if ($tarefas_list->id->Visible) { // id ?>
	<?php if ($tarefas_list->SortUrl($tarefas_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $tarefas_list->id->headerCellClass() ?>"><div id="elh_tarefas_id" class="tarefas_id"><div class="ew-table-header-caption"><?php echo $tarefas_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $tarefas_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tarefas_list->SortUrl($tarefas_list->id) ?>', 1);"><div id="elh_tarefas_id" class="tarefas_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tarefas_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tarefas_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tarefas_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tarefas_list->titulo->Visible) { // titulo ?>
	<?php if ($tarefas_list->SortUrl($tarefas_list->titulo) == "") { ?>
		<th data-name="titulo" class="<?php echo $tarefas_list->titulo->headerCellClass() ?>"><div id="elh_tarefas_titulo" class="tarefas_titulo"><div class="ew-table-header-caption"><?php echo $tarefas_list->titulo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="titulo" class="<?php echo $tarefas_list->titulo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tarefas_list->SortUrl($tarefas_list->titulo) ?>', 1);"><div id="elh_tarefas_titulo" class="tarefas_titulo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tarefas_list->titulo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tarefas_list->titulo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tarefas_list->titulo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tarefas_list->criticidade_id->Visible) { // criticidade_id ?>
	<?php if ($tarefas_list->SortUrl($tarefas_list->criticidade_id) == "") { ?>
		<th data-name="criticidade_id" class="<?php echo $tarefas_list->criticidade_id->headerCellClass() ?>"><div id="elh_tarefas_criticidade_id" class="tarefas_criticidade_id"><div class="ew-table-header-caption"><?php echo $tarefas_list->criticidade_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="criticidade_id" class="<?php echo $tarefas_list->criticidade_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tarefas_list->SortUrl($tarefas_list->criticidade_id) ?>', 1);"><div id="elh_tarefas_criticidade_id" class="tarefas_criticidade_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tarefas_list->criticidade_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tarefas_list->criticidade_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tarefas_list->criticidade_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tarefas_list->owner->Visible) { // owner ?>
	<?php if ($tarefas_list->SortUrl($tarefas_list->owner) == "") { ?>
		<th data-name="owner" class="<?php echo $tarefas_list->owner->headerCellClass() ?>"><div id="elh_tarefas_owner" class="tarefas_owner"><div class="ew-table-header-caption"><?php echo $tarefas_list->owner->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="owner" class="<?php echo $tarefas_list->owner->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tarefas_list->SortUrl($tarefas_list->owner) ?>', 1);"><div id="elh_tarefas_owner" class="tarefas_owner">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tarefas_list->owner->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tarefas_list->owner->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tarefas_list->owner->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tarefas_list->status->Visible) { // status ?>
	<?php if ($tarefas_list->SortUrl($tarefas_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $tarefas_list->status->headerCellClass() ?>"><div id="elh_tarefas_status" class="tarefas_status"><div class="ew-table-header-caption"><?php echo $tarefas_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $tarefas_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tarefas_list->SortUrl($tarefas_list->status) ?>', 1);"><div id="elh_tarefas_status" class="tarefas_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tarefas_list->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($tarefas_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tarefas_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tarefas_list->prazo_entrega->Visible) { // prazo_entrega ?>
	<?php if ($tarefas_list->SortUrl($tarefas_list->prazo_entrega) == "") { ?>
		<th data-name="prazo_entrega" class="<?php echo $tarefas_list->prazo_entrega->headerCellClass() ?>"><div id="elh_tarefas_prazo_entrega" class="tarefas_prazo_entrega"><div class="ew-table-header-caption"><?php echo $tarefas_list->prazo_entrega->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="prazo_entrega" class="<?php echo $tarefas_list->prazo_entrega->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tarefas_list->SortUrl($tarefas_list->prazo_entrega) ?>', 1);"><div id="elh_tarefas_prazo_entrega" class="tarefas_prazo_entrega">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tarefas_list->prazo_entrega->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tarefas_list->prazo_entrega->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tarefas_list->prazo_entrega->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tarefas_list->updated_at->Visible) { // updated_at ?>
	<?php if ($tarefas_list->SortUrl($tarefas_list->updated_at) == "") { ?>
		<th data-name="updated_at" class="<?php echo $tarefas_list->updated_at->headerCellClass() ?>"><div id="elh_tarefas_updated_at" class="tarefas_updated_at"><div class="ew-table-header-caption"><?php echo $tarefas_list->updated_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updated_at" class="<?php echo $tarefas_list->updated_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tarefas_list->SortUrl($tarefas_list->updated_at) ?>', 1);"><div id="elh_tarefas_updated_at" class="tarefas_updated_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tarefas_list->updated_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($tarefas_list->updated_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tarefas_list->updated_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tarefas_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tarefas_list->ExportAll && $tarefas_list->isExport()) {
	$tarefas_list->StopRecord = $tarefas_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tarefas_list->TotalRecords > $tarefas_list->StartRecord + $tarefas_list->DisplayRecords - 1)
		$tarefas_list->StopRecord = $tarefas_list->StartRecord + $tarefas_list->DisplayRecords - 1;
	else
		$tarefas_list->StopRecord = $tarefas_list->TotalRecords;
}
$tarefas_list->RecordCount = $tarefas_list->StartRecord - 1;
if ($tarefas_list->Recordset && !$tarefas_list->Recordset->EOF) {
	$tarefas_list->Recordset->moveFirst();
	$selectLimit = $tarefas_list->UseSelectLimit;
	if (!$selectLimit && $tarefas_list->StartRecord > 1)
		$tarefas_list->Recordset->move($tarefas_list->StartRecord - 1);
} elseif (!$tarefas->AllowAddDeleteRow && $tarefas_list->StopRecord == 0) {
	$tarefas_list->StopRecord = $tarefas->GridAddRowCount;
}

// Initialize aggregate
$tarefas->RowType = ROWTYPE_AGGREGATEINIT;
$tarefas->resetAttributes();
$tarefas_list->renderRow();
while ($tarefas_list->RecordCount < $tarefas_list->StopRecord) {
	$tarefas_list->RecordCount++;
	if ($tarefas_list->RecordCount >= $tarefas_list->StartRecord) {
		$tarefas_list->RowCount++;

		// Set up key count
		$tarefas_list->KeyCount = $tarefas_list->RowIndex;

		// Init row class and style
		$tarefas->resetAttributes();
		$tarefas->CssClass = "";
		if ($tarefas_list->isGridAdd()) {
		} else {
			$tarefas_list->loadRowValues($tarefas_list->Recordset); // Load row values
		}
		$tarefas->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tarefas->RowAttrs->merge(["data-rowindex" => $tarefas_list->RowCount, "id" => "r" . $tarefas_list->RowCount . "_tarefas", "data-rowtype" => $tarefas->RowType]);

		// Render row
		$tarefas_list->renderRow();

		// Render list options
		$tarefas_list->renderListOptions();
?>
	<tr <?php echo $tarefas->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tarefas_list->ListOptions->render("body", "left", $tarefas_list->RowCount);
?>
	<?php if ($tarefas_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $tarefas_list->id->cellAttributes() ?>>
<span id="el<?php echo $tarefas_list->RowCount ?>_tarefas_id">
<span<?php echo $tarefas_list->id->viewAttributes() ?>><?php echo $tarefas_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tarefas_list->titulo->Visible) { // titulo ?>
		<td data-name="titulo" <?php echo $tarefas_list->titulo->cellAttributes() ?>>
<span id="el<?php echo $tarefas_list->RowCount ?>_tarefas_titulo">
<span<?php echo $tarefas_list->titulo->viewAttributes() ?>><?php echo $tarefas_list->titulo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tarefas_list->criticidade_id->Visible) { // criticidade_id ?>
		<td data-name="criticidade_id" <?php echo $tarefas_list->criticidade_id->cellAttributes() ?>>
<span id="el<?php echo $tarefas_list->RowCount ?>_tarefas_criticidade_id">
<span<?php echo $tarefas_list->criticidade_id->viewAttributes() ?>><?php echo $tarefas_list->criticidade_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tarefas_list->owner->Visible) { // owner ?>
		<td data-name="owner" <?php echo $tarefas_list->owner->cellAttributes() ?>>
<span id="el<?php echo $tarefas_list->RowCount ?>_tarefas_owner">
<span<?php echo $tarefas_list->owner->viewAttributes() ?>><?php echo $tarefas_list->owner->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tarefas_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $tarefas_list->status->cellAttributes() ?>>
<span id="el<?php echo $tarefas_list->RowCount ?>_tarefas_status">
<span<?php echo $tarefas_list->status->viewAttributes() ?>><?php echo $tarefas_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tarefas_list->prazo_entrega->Visible) { // prazo_entrega ?>
		<td data-name="prazo_entrega" <?php echo $tarefas_list->prazo_entrega->cellAttributes() ?>>
<span id="el<?php echo $tarefas_list->RowCount ?>_tarefas_prazo_entrega">
<span<?php echo $tarefas_list->prazo_entrega->viewAttributes() ?>><?php echo $tarefas_list->prazo_entrega->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tarefas_list->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at" <?php echo $tarefas_list->updated_at->cellAttributes() ?>>
<span id="el<?php echo $tarefas_list->RowCount ?>_tarefas_updated_at">
<span<?php echo $tarefas_list->updated_at->viewAttributes() ?>><?php echo $tarefas_list->updated_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tarefas_list->ListOptions->render("body", "right", $tarefas_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tarefas_list->isGridAdd())
		$tarefas_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tarefas->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tarefas_list->Recordset)
	$tarefas_list->Recordset->Close();
?>
<?php if (!$tarefas_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tarefas_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tarefas_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tarefas_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tarefas_list->TotalRecords == 0 && !$tarefas->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tarefas_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tarefas_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tarefas_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$tarefas_list->terminate();
?>