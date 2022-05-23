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
$view2_list = new view2_list();

// Run the page
$view2_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$view2_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$view2_list->isExport()) { ?>
<script>
var fview2list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fview2list = currentForm = new ew.Form("fview2list", "list");
	fview2list.formKeyCountName = '<?php echo $view2_list->FormKeyCountName ?>';
	loadjs.done("fview2list");
});
var fview2listsrch;
loadjs.ready("head", function() {

	// Form object for search
	fview2listsrch = currentSearchForm = new ew.Form("fview2listsrch");

	// Dynamic selection lists
	// Filters

	fview2listsrch.filterList = <?php echo $view2_list->getFilterList() ?>;
	loadjs.done("fview2listsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$view2_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($view2_list->TotalRecords > 0 && $view2_list->ExportOptions->visible()) { ?>
<?php $view2_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($view2_list->ImportOptions->visible()) { ?>
<?php $view2_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($view2_list->SearchOptions->visible()) { ?>
<?php $view2_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($view2_list->FilterOptions->visible()) { ?>
<?php $view2_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$view2_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$view2_list->isExport() && !$view2->CurrentAction) { ?>
<form name="fview2listsrch" id="fview2listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fview2listsrch-search-panel" class="<?php echo $view2_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="view2">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $view2_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($view2_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($view2_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $view2_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($view2_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($view2_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($view2_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($view2_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $view2_list->showPageHeader(); ?>
<?php
$view2_list->showMessage();
?>
<?php if ($view2_list->TotalRecords > 0 || $view2->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($view2_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> view2">
<?php if (!$view2_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$view2_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $view2_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $view2_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fview2list" id="fview2list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="view2">
<div id="gmp_view2" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($view2_list->TotalRecords > 0 || $view2_list->isGridEdit()) { ?>
<table id="tbl_view2list" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$view2->RowType = ROWTYPE_HEADER;

// Render list options
$view2_list->renderListOptions();

// Render list options (header, left)
$view2_list->ListOptions->render("header", "left");
?>
<?php if ($view2_list->id->Visible) { // id ?>
	<?php if ($view2_list->SortUrl($view2_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $view2_list->id->headerCellClass() ?>"><div id="elh_view2_id" class="view2_id"><div class="ew-table-header-caption"><?php echo $view2_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $view2_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view2_list->SortUrl($view2_list->id) ?>', 1);"><div id="elh_view2_id" class="view2_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view2_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($view2_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view2_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view2_list->nome_completo->Visible) { // nome_completo ?>
	<?php if ($view2_list->SortUrl($view2_list->nome_completo) == "") { ?>
		<th data-name="nome_completo" class="<?php echo $view2_list->nome_completo->headerCellClass() ?>"><div id="elh_view2_nome_completo" class="view2_nome_completo"><div class="ew-table-header-caption"><?php echo $view2_list->nome_completo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome_completo" class="<?php echo $view2_list->nome_completo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view2_list->SortUrl($view2_list->nome_completo) ?>', 1);"><div id="elh_view2_nome_completo" class="view2_nome_completo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view2_list->nome_completo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view2_list->nome_completo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view2_list->nome_completo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view2_list->_email->Visible) { // email ?>
	<?php if ($view2_list->SortUrl($view2_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $view2_list->_email->headerCellClass() ?>"><div id="elh_view2__email" class="view2__email"><div class="ew-table-header-caption"><?php echo $view2_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $view2_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view2_list->SortUrl($view2_list->_email) ?>', 1);"><div id="elh_view2__email" class="view2__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view2_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view2_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view2_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view2_list->telefone->Visible) { // telefone ?>
	<?php if ($view2_list->SortUrl($view2_list->telefone) == "") { ?>
		<th data-name="telefone" class="<?php echo $view2_list->telefone->headerCellClass() ?>"><div id="elh_view2_telefone" class="view2_telefone"><div class="ew-table-header-caption"><?php echo $view2_list->telefone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefone" class="<?php echo $view2_list->telefone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view2_list->SortUrl($view2_list->telefone) ?>', 1);"><div id="elh_view2_telefone" class="view2_telefone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view2_list->telefone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view2_list->telefone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view2_list->telefone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view2_list->celular->Visible) { // celular ?>
	<?php if ($view2_list->SortUrl($view2_list->celular) == "") { ?>
		<th data-name="celular" class="<?php echo $view2_list->celular->headerCellClass() ?>"><div id="elh_view2_celular" class="view2_celular"><div class="ew-table-header-caption"><?php echo $view2_list->celular->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="celular" class="<?php echo $view2_list->celular->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view2_list->SortUrl($view2_list->celular) ?>', 1);"><div id="elh_view2_celular" class="view2_celular">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view2_list->celular->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view2_list->celular->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view2_list->celular->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view2_list->nome_empreasa->Visible) { // nome_empreasa ?>
	<?php if ($view2_list->SortUrl($view2_list->nome_empreasa) == "") { ?>
		<th data-name="nome_empreasa" class="<?php echo $view2_list->nome_empreasa->headerCellClass() ?>"><div id="elh_view2_nome_empreasa" class="view2_nome_empreasa"><div class="ew-table-header-caption"><?php echo $view2_list->nome_empreasa->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome_empreasa" class="<?php echo $view2_list->nome_empreasa->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view2_list->SortUrl($view2_list->nome_empreasa) ?>', 1);"><div id="elh_view2_nome_empreasa" class="view2_nome_empreasa">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view2_list->nome_empreasa->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view2_list->nome_empreasa->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view2_list->nome_empreasa->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view2_list->nome_cargo->Visible) { // nome_cargo ?>
	<?php if ($view2_list->SortUrl($view2_list->nome_cargo) == "") { ?>
		<th data-name="nome_cargo" class="<?php echo $view2_list->nome_cargo->headerCellClass() ?>"><div id="elh_view2_nome_cargo" class="view2_nome_cargo"><div class="ew-table-header-caption"><?php echo $view2_list->nome_cargo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome_cargo" class="<?php echo $view2_list->nome_cargo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view2_list->SortUrl($view2_list->nome_cargo) ?>', 1);"><div id="elh_view2_nome_cargo" class="view2_nome_cargo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view2_list->nome_cargo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view2_list->nome_cargo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view2_list->nome_cargo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view2_list->responsabilidades->Visible) { // responsabilidades ?>
	<?php if ($view2_list->SortUrl($view2_list->responsabilidades) == "") { ?>
		<th data-name="responsabilidades" class="<?php echo $view2_list->responsabilidades->headerCellClass() ?>"><div id="elh_view2_responsabilidades" class="view2_responsabilidades"><div class="ew-table-header-caption"><?php echo $view2_list->responsabilidades->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="responsabilidades" class="<?php echo $view2_list->responsabilidades->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view2_list->SortUrl($view2_list->responsabilidades) ?>', 1);"><div id="elh_view2_responsabilidades" class="view2_responsabilidades">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view2_list->responsabilidades->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view2_list->responsabilidades->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view2_list->responsabilidades->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$view2_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($view2_list->ExportAll && $view2_list->isExport()) {
	$view2_list->StopRecord = $view2_list->TotalRecords;
} else {

	// Set the last record to display
	if ($view2_list->TotalRecords > $view2_list->StartRecord + $view2_list->DisplayRecords - 1)
		$view2_list->StopRecord = $view2_list->StartRecord + $view2_list->DisplayRecords - 1;
	else
		$view2_list->StopRecord = $view2_list->TotalRecords;
}
$view2_list->RecordCount = $view2_list->StartRecord - 1;
if ($view2_list->Recordset && !$view2_list->Recordset->EOF) {
	$view2_list->Recordset->moveFirst();
	$selectLimit = $view2_list->UseSelectLimit;
	if (!$selectLimit && $view2_list->StartRecord > 1)
		$view2_list->Recordset->move($view2_list->StartRecord - 1);
} elseif (!$view2->AllowAddDeleteRow && $view2_list->StopRecord == 0) {
	$view2_list->StopRecord = $view2->GridAddRowCount;
}

// Initialize aggregate
$view2->RowType = ROWTYPE_AGGREGATEINIT;
$view2->resetAttributes();
$view2_list->renderRow();
while ($view2_list->RecordCount < $view2_list->StopRecord) {
	$view2_list->RecordCount++;
	if ($view2_list->RecordCount >= $view2_list->StartRecord) {
		$view2_list->RowCount++;

		// Set up key count
		$view2_list->KeyCount = $view2_list->RowIndex;

		// Init row class and style
		$view2->resetAttributes();
		$view2->CssClass = "";
		if ($view2_list->isGridAdd()) {
		} else {
			$view2_list->loadRowValues($view2_list->Recordset); // Load row values
		}
		$view2->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$view2->RowAttrs->merge(["data-rowindex" => $view2_list->RowCount, "id" => "r" . $view2_list->RowCount . "_view2", "data-rowtype" => $view2->RowType]);

		// Render row
		$view2_list->renderRow();

		// Render list options
		$view2_list->renderListOptions();
?>
	<tr <?php echo $view2->rowAttributes() ?>>
<?php

// Render list options (body, left)
$view2_list->ListOptions->render("body", "left", $view2_list->RowCount);
?>
	<?php if ($view2_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $view2_list->id->cellAttributes() ?>>
<span id="el<?php echo $view2_list->RowCount ?>_view2_id">
<span<?php echo $view2_list->id->viewAttributes() ?>><?php echo $view2_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view2_list->nome_completo->Visible) { // nome_completo ?>
		<td data-name="nome_completo" <?php echo $view2_list->nome_completo->cellAttributes() ?>>
<span id="el<?php echo $view2_list->RowCount ?>_view2_nome_completo">
<span<?php echo $view2_list->nome_completo->viewAttributes() ?>><?php echo $view2_list->nome_completo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view2_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $view2_list->_email->cellAttributes() ?>>
<span id="el<?php echo $view2_list->RowCount ?>_view2__email">
<span<?php echo $view2_list->_email->viewAttributes() ?>><?php echo $view2_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view2_list->telefone->Visible) { // telefone ?>
		<td data-name="telefone" <?php echo $view2_list->telefone->cellAttributes() ?>>
<span id="el<?php echo $view2_list->RowCount ?>_view2_telefone">
<span<?php echo $view2_list->telefone->viewAttributes() ?>><?php echo $view2_list->telefone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view2_list->celular->Visible) { // celular ?>
		<td data-name="celular" <?php echo $view2_list->celular->cellAttributes() ?>>
<span id="el<?php echo $view2_list->RowCount ?>_view2_celular">
<span<?php echo $view2_list->celular->viewAttributes() ?>><?php echo $view2_list->celular->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view2_list->nome_empreasa->Visible) { // nome_empreasa ?>
		<td data-name="nome_empreasa" <?php echo $view2_list->nome_empreasa->cellAttributes() ?>>
<span id="el<?php echo $view2_list->RowCount ?>_view2_nome_empreasa">
<span<?php echo $view2_list->nome_empreasa->viewAttributes() ?>><?php echo $view2_list->nome_empreasa->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view2_list->nome_cargo->Visible) { // nome_cargo ?>
		<td data-name="nome_cargo" <?php echo $view2_list->nome_cargo->cellAttributes() ?>>
<span id="el<?php echo $view2_list->RowCount ?>_view2_nome_cargo">
<span<?php echo $view2_list->nome_cargo->viewAttributes() ?>><?php echo $view2_list->nome_cargo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view2_list->responsabilidades->Visible) { // responsabilidades ?>
		<td data-name="responsabilidades" <?php echo $view2_list->responsabilidades->cellAttributes() ?>>
<span id="el<?php echo $view2_list->RowCount ?>_view2_responsabilidades">
<span<?php echo $view2_list->responsabilidades->viewAttributes() ?>><?php echo $view2_list->responsabilidades->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$view2_list->ListOptions->render("body", "right", $view2_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$view2_list->isGridAdd())
		$view2_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$view2->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($view2_list->Recordset)
	$view2_list->Recordset->Close();
?>
<?php if (!$view2_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$view2_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $view2_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $view2_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($view2_list->TotalRecords == 0 && !$view2->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $view2_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$view2_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$view2_list->isExport()) { ?>
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
$view2_list->terminate();
?>