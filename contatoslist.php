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
$contatos_list = new contatos_list();

// Run the page
$contatos_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contatos_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$contatos_list->isExport()) { ?>
<script>
var fcontatoslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcontatoslist = currentForm = new ew.Form("fcontatoslist", "list");
	fcontatoslist.formKeyCountName = '<?php echo $contatos_list->FormKeyCountName ?>';
	loadjs.done("fcontatoslist");
});
var fcontatoslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcontatoslistsrch = currentSearchForm = new ew.Form("fcontatoslistsrch");

	// Validate function for search
	fcontatoslistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fcontatoslistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontatoslistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcontatoslistsrch.lists["x_empresa"] = <?php echo $contatos_list->empresa->Lookup->toClientList($contatos_list) ?>;
	fcontatoslistsrch.lists["x_empresa"].options = <?php echo JsonEncode($contatos_list->empresa->lookupOptions()) ?>;
	fcontatoslistsrch.lists["x_cargo"] = <?php echo $contatos_list->cargo->Lookup->toClientList($contatos_list) ?>;
	fcontatoslistsrch.lists["x_cargo"].options = <?php echo JsonEncode($contatos_list->cargo->lookupOptions()) ?>;

	// Filters
	fcontatoslistsrch.filterList = <?php echo $contatos_list->getFilterList() ?>;
	loadjs.done("fcontatoslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$contatos_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($contatos_list->TotalRecords > 0 && $contatos_list->ExportOptions->visible()) { ?>
<?php $contatos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($contatos_list->ImportOptions->visible()) { ?>
<?php $contatos_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($contatos_list->SearchOptions->visible()) { ?>
<?php $contatos_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($contatos_list->FilterOptions->visible()) { ?>
<?php $contatos_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$contatos_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$contatos_list->isExport() && !$contatos->CurrentAction) { ?>
<form name="fcontatoslistsrch" id="fcontatoslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcontatoslistsrch-search-panel" class="<?php echo $contatos_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="contatos">
	<div class="ew-extended-search">
<?php

// Render search row
$contatos->RowType = ROWTYPE_SEARCH;
$contatos->resetAttributes();
$contatos_list->renderRow();
?>
<?php if ($contatos_list->empresa->Visible) { // empresa ?>
	<?php
		$contatos_list->SearchColumnCount++;
		if (($contatos_list->SearchColumnCount - 1) % $contatos_list->SearchFieldsPerRow == 0) {
			$contatos_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $contatos_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_empresa" class="ew-cell form-group">
		<label for="x_empresa" class="ew-search-caption ew-label"><?php echo $contatos_list->empresa->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_empresa" id="z_empresa" value="=">
</span>
		<span id="el_contatos_empresa" class="ew-search-field">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($contatos_list->empresa->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $contatos_list->empresa->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_empresa" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $contatos_list->empresa->radioButtonListHtml(TRUE, "x_empresa") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_empresa" class="ew-template"><input type="radio" class="custom-control-input" data-table="contatos" data-field="x_empresa" data-value-separator="<?php echo $contatos_list->empresa->displayValueSeparatorAttribute() ?>" name="x_empresa" id="x_empresa" value="{value}"<?php echo $contatos_list->empresa->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$contatos_list->empresa->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $contatos_list->empresa->Lookup->getParamTag($contatos_list, "p_x_empresa") ?>
</span>
	</div>
	<?php if ($contatos_list->SearchColumnCount % $contatos_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($contatos_list->cargo->Visible) { // cargo ?>
	<?php
		$contatos_list->SearchColumnCount++;
		if (($contatos_list->SearchColumnCount - 1) % $contatos_list->SearchFieldsPerRow == 0) {
			$contatos_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $contatos_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_cargo" class="ew-cell form-group">
		<label for="x_cargo" class="ew-search-caption ew-label"><?php echo $contatos_list->cargo->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_cargo" id="z_cargo" value="=">
</span>
		<span id="el_contatos_cargo" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_cargo"><?php echo EmptyValue(strval($contatos_list->cargo->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $contatos_list->cargo->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contatos_list->cargo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contatos_list->cargo->ReadOnly || $contatos_list->cargo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_cargo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contatos_list->cargo->Lookup->getParamTag($contatos_list, "p_x_cargo") ?>
<input type="hidden" data-table="contatos" data-field="x_cargo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contatos_list->cargo->displayValueSeparatorAttribute() ?>" name="x_cargo" id="x_cargo" value="<?php echo $contatos_list->cargo->AdvancedSearch->SearchValue ?>"<?php echo $contatos_list->cargo->editAttributes() ?>>
</span>
	</div>
	<?php if ($contatos_list->SearchColumnCount % $contatos_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($contatos_list->SearchColumnCount % $contatos_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $contatos_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($contatos_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($contatos_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $contatos_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($contatos_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($contatos_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($contatos_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($contatos_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $contatos_list->showPageHeader(); ?>
<?php
$contatos_list->showMessage();
?>
<?php if ($contatos_list->TotalRecords > 0 || $contatos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($contatos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> contatos">
<?php if (!$contatos_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$contatos_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contatos_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contatos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcontatoslist" id="fcontatoslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contatos">
<div id="gmp_contatos" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($contatos_list->TotalRecords > 0 || $contatos_list->isGridEdit()) { ?>
<table id="tbl_contatoslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$contatos->RowType = ROWTYPE_HEADER;

// Render list options
$contatos_list->renderListOptions();

// Render list options (header, left)
$contatos_list->ListOptions->render("header", "left");
?>
<?php if ($contatos_list->id->Visible) { // id ?>
	<?php if ($contatos_list->SortUrl($contatos_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $contatos_list->id->headerCellClass() ?>"><div id="elh_contatos_id" class="contatos_id"><div class="ew-table-header-caption"><?php echo $contatos_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $contatos_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contatos_list->SortUrl($contatos_list->id) ?>', 1);"><div id="elh_contatos_id" class="contatos_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contatos_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($contatos_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contatos_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contatos_list->nome_completo->Visible) { // nome_completo ?>
	<?php if ($contatos_list->SortUrl($contatos_list->nome_completo) == "") { ?>
		<th data-name="nome_completo" class="<?php echo $contatos_list->nome_completo->headerCellClass() ?>"><div id="elh_contatos_nome_completo" class="contatos_nome_completo"><div class="ew-table-header-caption"><?php echo $contatos_list->nome_completo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome_completo" class="<?php echo $contatos_list->nome_completo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contatos_list->SortUrl($contatos_list->nome_completo) ?>', 1);"><div id="elh_contatos_nome_completo" class="contatos_nome_completo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contatos_list->nome_completo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contatos_list->nome_completo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contatos_list->nome_completo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contatos_list->_email->Visible) { // email ?>
	<?php if ($contatos_list->SortUrl($contatos_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $contatos_list->_email->headerCellClass() ?>"><div id="elh_contatos__email" class="contatos__email"><div class="ew-table-header-caption"><?php echo $contatos_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $contatos_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contatos_list->SortUrl($contatos_list->_email) ?>', 1);"><div id="elh_contatos__email" class="contatos__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contatos_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contatos_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contatos_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contatos_list->telefone->Visible) { // telefone ?>
	<?php if ($contatos_list->SortUrl($contatos_list->telefone) == "") { ?>
		<th data-name="telefone" class="<?php echo $contatos_list->telefone->headerCellClass() ?>"><div id="elh_contatos_telefone" class="contatos_telefone"><div class="ew-table-header-caption"><?php echo $contatos_list->telefone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefone" class="<?php echo $contatos_list->telefone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contatos_list->SortUrl($contatos_list->telefone) ?>', 1);"><div id="elh_contatos_telefone" class="contatos_telefone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contatos_list->telefone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contatos_list->telefone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contatos_list->telefone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contatos_list->celular->Visible) { // celular ?>
	<?php if ($contatos_list->SortUrl($contatos_list->celular) == "") { ?>
		<th data-name="celular" class="<?php echo $contatos_list->celular->headerCellClass() ?>"><div id="elh_contatos_celular" class="contatos_celular"><div class="ew-table-header-caption"><?php echo $contatos_list->celular->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="celular" class="<?php echo $contatos_list->celular->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contatos_list->SortUrl($contatos_list->celular) ?>', 1);"><div id="elh_contatos_celular" class="contatos_celular">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contatos_list->celular->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contatos_list->celular->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contatos_list->celular->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contatos_list->empresa->Visible) { // empresa ?>
	<?php if ($contatos_list->SortUrl($contatos_list->empresa) == "") { ?>
		<th data-name="empresa" class="<?php echo $contatos_list->empresa->headerCellClass() ?>"><div id="elh_contatos_empresa" class="contatos_empresa"><div class="ew-table-header-caption"><?php echo $contatos_list->empresa->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="empresa" class="<?php echo $contatos_list->empresa->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contatos_list->SortUrl($contatos_list->empresa) ?>', 1);"><div id="elh_contatos_empresa" class="contatos_empresa">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contatos_list->empresa->caption() ?></span><span class="ew-table-header-sort"><?php if ($contatos_list->empresa->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contatos_list->empresa->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contatos_list->cargo->Visible) { // cargo ?>
	<?php if ($contatos_list->SortUrl($contatos_list->cargo) == "") { ?>
		<th data-name="cargo" class="<?php echo $contatos_list->cargo->headerCellClass() ?>"><div id="elh_contatos_cargo" class="contatos_cargo"><div class="ew-table-header-caption"><?php echo $contatos_list->cargo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cargo" class="<?php echo $contatos_list->cargo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contatos_list->SortUrl($contatos_list->cargo) ?>', 1);"><div id="elh_contatos_cargo" class="contatos_cargo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contatos_list->cargo->caption() ?></span><span class="ew-table-header-sort"><?php if ($contatos_list->cargo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contatos_list->cargo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contatos_list->responsabilidades->Visible) { // responsabilidades ?>
	<?php if ($contatos_list->SortUrl($contatos_list->responsabilidades) == "") { ?>
		<th data-name="responsabilidades" class="<?php echo $contatos_list->responsabilidades->headerCellClass() ?>"><div id="elh_contatos_responsabilidades" class="contatos_responsabilidades"><div class="ew-table-header-caption"><?php echo $contatos_list->responsabilidades->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="responsabilidades" class="<?php echo $contatos_list->responsabilidades->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contatos_list->SortUrl($contatos_list->responsabilidades) ?>', 1);"><div id="elh_contatos_responsabilidades" class="contatos_responsabilidades">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contatos_list->responsabilidades->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contatos_list->responsabilidades->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contatos_list->responsabilidades->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$contatos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($contatos_list->ExportAll && $contatos_list->isExport()) {
	$contatos_list->StopRecord = $contatos_list->TotalRecords;
} else {

	// Set the last record to display
	if ($contatos_list->TotalRecords > $contatos_list->StartRecord + $contatos_list->DisplayRecords - 1)
		$contatos_list->StopRecord = $contatos_list->StartRecord + $contatos_list->DisplayRecords - 1;
	else
		$contatos_list->StopRecord = $contatos_list->TotalRecords;
}
$contatos_list->RecordCount = $contatos_list->StartRecord - 1;
if ($contatos_list->Recordset && !$contatos_list->Recordset->EOF) {
	$contatos_list->Recordset->moveFirst();
	$selectLimit = $contatos_list->UseSelectLimit;
	if (!$selectLimit && $contatos_list->StartRecord > 1)
		$contatos_list->Recordset->move($contatos_list->StartRecord - 1);
} elseif (!$contatos->AllowAddDeleteRow && $contatos_list->StopRecord == 0) {
	$contatos_list->StopRecord = $contatos->GridAddRowCount;
}

// Initialize aggregate
$contatos->RowType = ROWTYPE_AGGREGATEINIT;
$contatos->resetAttributes();
$contatos_list->renderRow();
while ($contatos_list->RecordCount < $contatos_list->StopRecord) {
	$contatos_list->RecordCount++;
	if ($contatos_list->RecordCount >= $contatos_list->StartRecord) {
		$contatos_list->RowCount++;

		// Set up key count
		$contatos_list->KeyCount = $contatos_list->RowIndex;

		// Init row class and style
		$contatos->resetAttributes();
		$contatos->CssClass = "";
		if ($contatos_list->isGridAdd()) {
		} else {
			$contatos_list->loadRowValues($contatos_list->Recordset); // Load row values
		}
		$contatos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$contatos->RowAttrs->merge(["data-rowindex" => $contatos_list->RowCount, "id" => "r" . $contatos_list->RowCount . "_contatos", "data-rowtype" => $contatos->RowType]);

		// Render row
		$contatos_list->renderRow();

		// Render list options
		$contatos_list->renderListOptions();
?>
	<tr <?php echo $contatos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$contatos_list->ListOptions->render("body", "left", $contatos_list->RowCount);
?>
	<?php if ($contatos_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $contatos_list->id->cellAttributes() ?>>
<span id="el<?php echo $contatos_list->RowCount ?>_contatos_id">
<span<?php echo $contatos_list->id->viewAttributes() ?>><?php echo $contatos_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contatos_list->nome_completo->Visible) { // nome_completo ?>
		<td data-name="nome_completo" <?php echo $contatos_list->nome_completo->cellAttributes() ?>>
<span id="el<?php echo $contatos_list->RowCount ?>_contatos_nome_completo">
<span<?php echo $contatos_list->nome_completo->viewAttributes() ?>><?php echo $contatos_list->nome_completo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contatos_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $contatos_list->_email->cellAttributes() ?>>
<span id="el<?php echo $contatos_list->RowCount ?>_contatos__email">
<span<?php echo $contatos_list->_email->viewAttributes() ?>><?php echo $contatos_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contatos_list->telefone->Visible) { // telefone ?>
		<td data-name="telefone" <?php echo $contatos_list->telefone->cellAttributes() ?>>
<span id="el<?php echo $contatos_list->RowCount ?>_contatos_telefone">
<span<?php echo $contatos_list->telefone->viewAttributes() ?>><?php echo $contatos_list->telefone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contatos_list->celular->Visible) { // celular ?>
		<td data-name="celular" <?php echo $contatos_list->celular->cellAttributes() ?>>
<span id="el<?php echo $contatos_list->RowCount ?>_contatos_celular">
<span<?php echo $contatos_list->celular->viewAttributes() ?>><?php echo $contatos_list->celular->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contatos_list->empresa->Visible) { // empresa ?>
		<td data-name="empresa" <?php echo $contatos_list->empresa->cellAttributes() ?>>
<span id="el<?php echo $contatos_list->RowCount ?>_contatos_empresa">
<span<?php echo $contatos_list->empresa->viewAttributes() ?>><?php echo $contatos_list->empresa->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contatos_list->cargo->Visible) { // cargo ?>
		<td data-name="cargo" <?php echo $contatos_list->cargo->cellAttributes() ?>>
<span id="el<?php echo $contatos_list->RowCount ?>_contatos_cargo">
<span<?php echo $contatos_list->cargo->viewAttributes() ?>><?php echo $contatos_list->cargo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contatos_list->responsabilidades->Visible) { // responsabilidades ?>
		<td data-name="responsabilidades" <?php echo $contatos_list->responsabilidades->cellAttributes() ?>>
<span id="el<?php echo $contatos_list->RowCount ?>_contatos_responsabilidades">
<span<?php echo $contatos_list->responsabilidades->viewAttributes() ?>><?php echo $contatos_list->responsabilidades->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$contatos_list->ListOptions->render("body", "right", $contatos_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$contatos_list->isGridAdd())
		$contatos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$contatos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($contatos_list->Recordset)
	$contatos_list->Recordset->Close();
?>
<?php if (!$contatos_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$contatos_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contatos_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contatos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($contatos_list->TotalRecords == 0 && !$contatos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $contatos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$contatos_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$contatos_list->isExport()) { ?>
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
$contatos_list->terminate();
?>