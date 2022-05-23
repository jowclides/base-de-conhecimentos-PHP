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
$know_base_list = new know_base_list();

// Run the page
$know_base_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$know_base_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$know_base_list->isExport()) { ?>
<script>
var fknow_baselist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fknow_baselist = currentForm = new ew.Form("fknow_baselist", "list");
	fknow_baselist.formKeyCountName = '<?php echo $know_base_list->FormKeyCountName ?>';
	loadjs.done("fknow_baselist");
});
var fknow_baselistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fknow_baselistsrch = currentSearchForm = new ew.Form("fknow_baselistsrch");

	// Validate function for search
	fknow_baselistsrch.validate = function(fobj) {
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
	fknow_baselistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fknow_baselistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fknow_baselistsrch.lists["x_categoria"] = <?php echo $know_base_list->categoria->Lookup->toClientList($know_base_list) ?>;
	fknow_baselistsrch.lists["x_categoria"].options = <?php echo JsonEncode($know_base_list->categoria->lookupOptions()) ?>;

	// Filters
	fknow_baselistsrch.filterList = <?php echo $know_base_list->getFilterList() ?>;
	loadjs.done("fknow_baselistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$know_base_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($know_base_list->TotalRecords > 0 && $know_base_list->ExportOptions->visible()) { ?>
<?php $know_base_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($know_base_list->ImportOptions->visible()) { ?>
<?php $know_base_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($know_base_list->SearchOptions->visible()) { ?>
<?php $know_base_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($know_base_list->FilterOptions->visible()) { ?>
<?php $know_base_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$know_base_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$know_base_list->isExport() && !$know_base->CurrentAction) { ?>
<form name="fknow_baselistsrch" id="fknow_baselistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fknow_baselistsrch-search-panel" class="<?php echo $know_base_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="know_base">
	<div class="ew-extended-search">
<?php

// Render search row
$know_base->RowType = ROWTYPE_SEARCH;
$know_base->resetAttributes();
$know_base_list->renderRow();
?>
<?php if ($know_base_list->categoria->Visible) { // categoria ?>
	<?php
		$know_base_list->SearchColumnCount++;
		if (($know_base_list->SearchColumnCount - 1) % $know_base_list->SearchFieldsPerRow == 0) {
			$know_base_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $know_base_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_categoria" class="ew-cell form-group">
		<label for="x_categoria" class="ew-search-caption ew-label"><?php echo $know_base_list->categoria->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_categoria" id="z_categoria" value="=">
</span>
		<span id="el_know_base_categoria" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_categoria"><?php echo EmptyValue(strval($know_base_list->categoria->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $know_base_list->categoria->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($know_base_list->categoria->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($know_base_list->categoria->ReadOnly || $know_base_list->categoria->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_categoria',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $know_base_list->categoria->Lookup->getParamTag($know_base_list, "p_x_categoria") ?>
<input type="hidden" data-table="know_base" data-field="x_categoria" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $know_base_list->categoria->displayValueSeparatorAttribute() ?>" name="x_categoria" id="x_categoria" value="<?php echo $know_base_list->categoria->AdvancedSearch->SearchValue ?>"<?php echo $know_base_list->categoria->editAttributes() ?>>
</span>
	</div>
	<?php if ($know_base_list->SearchColumnCount % $know_base_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($know_base_list->SearchColumnCount % $know_base_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $know_base_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($know_base_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($know_base_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $know_base_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($know_base_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($know_base_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($know_base_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($know_base_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $know_base_list->showPageHeader(); ?>
<?php
$know_base_list->showMessage();
?>
<?php if ($know_base_list->TotalRecords > 0 || $know_base->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($know_base_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> know_base">
<?php if (!$know_base_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$know_base_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $know_base_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $know_base_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fknow_baselist" id="fknow_baselist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="know_base">
<div id="gmp_know_base" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($know_base_list->TotalRecords > 0 || $know_base_list->isGridEdit()) { ?>
<table id="tbl_know_baselist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$know_base->RowType = ROWTYPE_HEADER;

// Render list options
$know_base_list->renderListOptions();

// Render list options (header, left)
$know_base_list->ListOptions->render("header", "left");
?>
<?php if ($know_base_list->id->Visible) { // id ?>
	<?php if ($know_base_list->SortUrl($know_base_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $know_base_list->id->headerCellClass() ?>"><div id="elh_know_base_id" class="know_base_id"><div class="ew-table-header-caption"><?php echo $know_base_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $know_base_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $know_base_list->SortUrl($know_base_list->id) ?>', 1);"><div id="elh_know_base_id" class="know_base_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $know_base_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($know_base_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($know_base_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($know_base_list->titulo->Visible) { // titulo ?>
	<?php if ($know_base_list->SortUrl($know_base_list->titulo) == "") { ?>
		<th data-name="titulo" class="<?php echo $know_base_list->titulo->headerCellClass() ?>"><div id="elh_know_base_titulo" class="know_base_titulo"><div class="ew-table-header-caption"><?php echo $know_base_list->titulo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="titulo" class="<?php echo $know_base_list->titulo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $know_base_list->SortUrl($know_base_list->titulo) ?>', 1);"><div id="elh_know_base_titulo" class="know_base_titulo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $know_base_list->titulo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($know_base_list->titulo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($know_base_list->titulo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($know_base_list->categoria->Visible) { // categoria ?>
	<?php if ($know_base_list->SortUrl($know_base_list->categoria) == "") { ?>
		<th data-name="categoria" class="<?php echo $know_base_list->categoria->headerCellClass() ?>"><div id="elh_know_base_categoria" class="know_base_categoria"><div class="ew-table-header-caption"><?php echo $know_base_list->categoria->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="categoria" class="<?php echo $know_base_list->categoria->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $know_base_list->SortUrl($know_base_list->categoria) ?>', 1);"><div id="elh_know_base_categoria" class="know_base_categoria">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $know_base_list->categoria->caption() ?></span><span class="ew-table-header-sort"><?php if ($know_base_list->categoria->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($know_base_list->categoria->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($know_base_list->updated_at->Visible) { // updated_at ?>
	<?php if ($know_base_list->SortUrl($know_base_list->updated_at) == "") { ?>
		<th data-name="updated_at" class="<?php echo $know_base_list->updated_at->headerCellClass() ?>"><div id="elh_know_base_updated_at" class="know_base_updated_at"><div class="ew-table-header-caption"><?php echo $know_base_list->updated_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updated_at" class="<?php echo $know_base_list->updated_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $know_base_list->SortUrl($know_base_list->updated_at) ?>', 1);"><div id="elh_know_base_updated_at" class="know_base_updated_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $know_base_list->updated_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($know_base_list->updated_at->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($know_base_list->updated_at->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($know_base_list->file->Visible) { // file ?>
	<?php if ($know_base_list->SortUrl($know_base_list->file) == "") { ?>
		<th data-name="file" class="<?php echo $know_base_list->file->headerCellClass() ?>"><div id="elh_know_base_file" class="know_base_file"><div class="ew-table-header-caption"><?php echo $know_base_list->file->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="file" class="<?php echo $know_base_list->file->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $know_base_list->SortUrl($know_base_list->file) ?>', 1);"><div id="elh_know_base_file" class="know_base_file">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $know_base_list->file->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($know_base_list->file->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($know_base_list->file->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$know_base_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($know_base_list->ExportAll && $know_base_list->isExport()) {
	$know_base_list->StopRecord = $know_base_list->TotalRecords;
} else {

	// Set the last record to display
	if ($know_base_list->TotalRecords > $know_base_list->StartRecord + $know_base_list->DisplayRecords - 1)
		$know_base_list->StopRecord = $know_base_list->StartRecord + $know_base_list->DisplayRecords - 1;
	else
		$know_base_list->StopRecord = $know_base_list->TotalRecords;
}
$know_base_list->RecordCount = $know_base_list->StartRecord - 1;
if ($know_base_list->Recordset && !$know_base_list->Recordset->EOF) {
	$know_base_list->Recordset->moveFirst();
	$selectLimit = $know_base_list->UseSelectLimit;
	if (!$selectLimit && $know_base_list->StartRecord > 1)
		$know_base_list->Recordset->move($know_base_list->StartRecord - 1);
} elseif (!$know_base->AllowAddDeleteRow && $know_base_list->StopRecord == 0) {
	$know_base_list->StopRecord = $know_base->GridAddRowCount;
}

// Initialize aggregate
$know_base->RowType = ROWTYPE_AGGREGATEINIT;
$know_base->resetAttributes();
$know_base_list->renderRow();
while ($know_base_list->RecordCount < $know_base_list->StopRecord) {
	$know_base_list->RecordCount++;
	if ($know_base_list->RecordCount >= $know_base_list->StartRecord) {
		$know_base_list->RowCount++;

		// Set up key count
		$know_base_list->KeyCount = $know_base_list->RowIndex;

		// Init row class and style
		$know_base->resetAttributes();
		$know_base->CssClass = "";
		if ($know_base_list->isGridAdd()) {
		} else {
			$know_base_list->loadRowValues($know_base_list->Recordset); // Load row values
		}
		$know_base->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$know_base->RowAttrs->merge(["data-rowindex" => $know_base_list->RowCount, "id" => "r" . $know_base_list->RowCount . "_know_base", "data-rowtype" => $know_base->RowType]);

		// Render row
		$know_base_list->renderRow();

		// Render list options
		$know_base_list->renderListOptions();
?>
	<tr <?php echo $know_base->rowAttributes() ?>>
<?php

// Render list options (body, left)
$know_base_list->ListOptions->render("body", "left", $know_base_list->RowCount);
?>
	<?php if ($know_base_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $know_base_list->id->cellAttributes() ?>>
<span id="el<?php echo $know_base_list->RowCount ?>_know_base_id">
<span<?php echo $know_base_list->id->viewAttributes() ?>><?php echo $know_base_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($know_base_list->titulo->Visible) { // titulo ?>
		<td data-name="titulo" <?php echo $know_base_list->titulo->cellAttributes() ?>>
<span id="el<?php echo $know_base_list->RowCount ?>_know_base_titulo">
<span<?php echo $know_base_list->titulo->viewAttributes() ?>><?php echo $know_base_list->titulo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($know_base_list->categoria->Visible) { // categoria ?>
		<td data-name="categoria" <?php echo $know_base_list->categoria->cellAttributes() ?>>
<span id="el<?php echo $know_base_list->RowCount ?>_know_base_categoria">
<span<?php echo $know_base_list->categoria->viewAttributes() ?>><?php echo $know_base_list->categoria->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($know_base_list->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at" <?php echo $know_base_list->updated_at->cellAttributes() ?>>
<span id="el<?php echo $know_base_list->RowCount ?>_know_base_updated_at">
<span<?php echo $know_base_list->updated_at->viewAttributes() ?>><?php echo $know_base_list->updated_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($know_base_list->file->Visible) { // file ?>
		<td data-name="file" <?php echo $know_base_list->file->cellAttributes() ?>>
<span id="el<?php echo $know_base_list->RowCount ?>_know_base_file">
<span<?php echo $know_base_list->file->viewAttributes() ?>><?php echo GetFileViewTag($know_base_list->file, $know_base_list->file->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$know_base_list->ListOptions->render("body", "right", $know_base_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$know_base_list->isGridAdd())
		$know_base_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$know_base->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($know_base_list->Recordset)
	$know_base_list->Recordset->Close();
?>
<?php if (!$know_base_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$know_base_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $know_base_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $know_base_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($know_base_list->TotalRecords == 0 && !$know_base->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $know_base_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$know_base_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$know_base_list->isExport()) { ?>
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
$know_base_list->terminate();
?>