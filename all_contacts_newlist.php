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
$all_contacts_new_list = new all_contacts_new_list();

// Run the page
$all_contacts_new_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$all_contacts_new_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$all_contacts_new_list->isExport()) { ?>
<script>
var fall_contacts_newlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fall_contacts_newlist = currentForm = new ew.Form("fall_contacts_newlist", "list");
	fall_contacts_newlist.formKeyCountName = '<?php echo $all_contacts_new_list->FormKeyCountName ?>';
	loadjs.done("fall_contacts_newlist");
});
var fall_contacts_newlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fall_contacts_newlistsrch = currentSearchForm = new ew.Form("fall_contacts_newlistsrch");

	// Dynamic selection lists
	// Filters

	fall_contacts_newlistsrch.filterList = <?php echo $all_contacts_new_list->getFilterList() ?>;
	loadjs.done("fall_contacts_newlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$all_contacts_new_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($all_contacts_new_list->TotalRecords > 0 && $all_contacts_new_list->ExportOptions->visible()) { ?>
<?php $all_contacts_new_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($all_contacts_new_list->ImportOptions->visible()) { ?>
<?php $all_contacts_new_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($all_contacts_new_list->SearchOptions->visible()) { ?>
<?php $all_contacts_new_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($all_contacts_new_list->FilterOptions->visible()) { ?>
<?php $all_contacts_new_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$all_contacts_new_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$all_contacts_new_list->isExport() && !$all_contacts_new->CurrentAction) { ?>
<form name="fall_contacts_newlistsrch" id="fall_contacts_newlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fall_contacts_newlistsrch-search-panel" class="<?php echo $all_contacts_new_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="all_contacts_new">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $all_contacts_new_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($all_contacts_new_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($all_contacts_new_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $all_contacts_new_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($all_contacts_new_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($all_contacts_new_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($all_contacts_new_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($all_contacts_new_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $all_contacts_new_list->showPageHeader(); ?>
<?php
$all_contacts_new_list->showMessage();
?>
<?php if ($all_contacts_new_list->TotalRecords > 0 || $all_contacts_new->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($all_contacts_new_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> all_contacts_new">
<?php if (!$all_contacts_new_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$all_contacts_new_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $all_contacts_new_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $all_contacts_new_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fall_contacts_newlist" id="fall_contacts_newlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="all_contacts_new">
<div id="gmp_all_contacts_new" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($all_contacts_new_list->TotalRecords > 0 || $all_contacts_new_list->isGridEdit()) { ?>
<table id="tbl_all_contacts_newlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$all_contacts_new->RowType = ROWTYPE_HEADER;

// Render list options
$all_contacts_new_list->renderListOptions();

// Render list options (header, left)
$all_contacts_new_list->ListOptions->render("header", "left");
?>
<?php if ($all_contacts_new_list->id->Visible) { // id ?>
	<?php if ($all_contacts_new_list->SortUrl($all_contacts_new_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $all_contacts_new_list->id->headerCellClass() ?>"><div id="elh_all_contacts_new_id" class="all_contacts_new_id"><div class="ew-table-header-caption"><?php echo $all_contacts_new_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $all_contacts_new_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $all_contacts_new_list->SortUrl($all_contacts_new_list->id) ?>', 1);"><div id="elh_all_contacts_new_id" class="all_contacts_new_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $all_contacts_new_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($all_contacts_new_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($all_contacts_new_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($all_contacts_new_list->avatar->Visible) { // avatar ?>
	<?php if ($all_contacts_new_list->SortUrl($all_contacts_new_list->avatar) == "") { ?>
		<th data-name="avatar" class="<?php echo $all_contacts_new_list->avatar->headerCellClass() ?>"><div id="elh_all_contacts_new_avatar" class="all_contacts_new_avatar"><div class="ew-table-header-caption"><?php echo $all_contacts_new_list->avatar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="avatar" class="<?php echo $all_contacts_new_list->avatar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $all_contacts_new_list->SortUrl($all_contacts_new_list->avatar) ?>', 1);"><div id="elh_all_contacts_new_avatar" class="all_contacts_new_avatar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $all_contacts_new_list->avatar->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($all_contacts_new_list->avatar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($all_contacts_new_list->avatar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($all_contacts_new_list->nome_completo->Visible) { // nome_completo ?>
	<?php if ($all_contacts_new_list->SortUrl($all_contacts_new_list->nome_completo) == "") { ?>
		<th data-name="nome_completo" class="<?php echo $all_contacts_new_list->nome_completo->headerCellClass() ?>"><div id="elh_all_contacts_new_nome_completo" class="all_contacts_new_nome_completo"><div class="ew-table-header-caption"><?php echo $all_contacts_new_list->nome_completo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome_completo" class="<?php echo $all_contacts_new_list->nome_completo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $all_contacts_new_list->SortUrl($all_contacts_new_list->nome_completo) ?>', 1);"><div id="elh_all_contacts_new_nome_completo" class="all_contacts_new_nome_completo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $all_contacts_new_list->nome_completo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($all_contacts_new_list->nome_completo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($all_contacts_new_list->nome_completo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($all_contacts_new_list->_email->Visible) { // email ?>
	<?php if ($all_contacts_new_list->SortUrl($all_contacts_new_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $all_contacts_new_list->_email->headerCellClass() ?>"><div id="elh_all_contacts_new__email" class="all_contacts_new__email"><div class="ew-table-header-caption"><?php echo $all_contacts_new_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $all_contacts_new_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $all_contacts_new_list->SortUrl($all_contacts_new_list->_email) ?>', 1);"><div id="elh_all_contacts_new__email" class="all_contacts_new__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $all_contacts_new_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($all_contacts_new_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($all_contacts_new_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($all_contacts_new_list->telefone->Visible) { // telefone ?>
	<?php if ($all_contacts_new_list->SortUrl($all_contacts_new_list->telefone) == "") { ?>
		<th data-name="telefone" class="<?php echo $all_contacts_new_list->telefone->headerCellClass() ?>"><div id="elh_all_contacts_new_telefone" class="all_contacts_new_telefone"><div class="ew-table-header-caption"><?php echo $all_contacts_new_list->telefone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefone" class="<?php echo $all_contacts_new_list->telefone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $all_contacts_new_list->SortUrl($all_contacts_new_list->telefone) ?>', 1);"><div id="elh_all_contacts_new_telefone" class="all_contacts_new_telefone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $all_contacts_new_list->telefone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($all_contacts_new_list->telefone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($all_contacts_new_list->telefone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($all_contacts_new_list->celular->Visible) { // celular ?>
	<?php if ($all_contacts_new_list->SortUrl($all_contacts_new_list->celular) == "") { ?>
		<th data-name="celular" class="<?php echo $all_contacts_new_list->celular->headerCellClass() ?>"><div id="elh_all_contacts_new_celular" class="all_contacts_new_celular"><div class="ew-table-header-caption"><?php echo $all_contacts_new_list->celular->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="celular" class="<?php echo $all_contacts_new_list->celular->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $all_contacts_new_list->SortUrl($all_contacts_new_list->celular) ?>', 1);"><div id="elh_all_contacts_new_celular" class="all_contacts_new_celular">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $all_contacts_new_list->celular->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($all_contacts_new_list->celular->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($all_contacts_new_list->celular->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($all_contacts_new_list->empresa->Visible) { // empresa ?>
	<?php if ($all_contacts_new_list->SortUrl($all_contacts_new_list->empresa) == "") { ?>
		<th data-name="empresa" class="<?php echo $all_contacts_new_list->empresa->headerCellClass() ?>"><div id="elh_all_contacts_new_empresa" class="all_contacts_new_empresa"><div class="ew-table-header-caption"><?php echo $all_contacts_new_list->empresa->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="empresa" class="<?php echo $all_contacts_new_list->empresa->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $all_contacts_new_list->SortUrl($all_contacts_new_list->empresa) ?>', 1);"><div id="elh_all_contacts_new_empresa" class="all_contacts_new_empresa">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $all_contacts_new_list->empresa->caption() ?></span><span class="ew-table-header-sort"><?php if ($all_contacts_new_list->empresa->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($all_contacts_new_list->empresa->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($all_contacts_new_list->cargo->Visible) { // cargo ?>
	<?php if ($all_contacts_new_list->SortUrl($all_contacts_new_list->cargo) == "") { ?>
		<th data-name="cargo" class="<?php echo $all_contacts_new_list->cargo->headerCellClass() ?>"><div id="elh_all_contacts_new_cargo" class="all_contacts_new_cargo"><div class="ew-table-header-caption"><?php echo $all_contacts_new_list->cargo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cargo" class="<?php echo $all_contacts_new_list->cargo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $all_contacts_new_list->SortUrl($all_contacts_new_list->cargo) ?>', 1);"><div id="elh_all_contacts_new_cargo" class="all_contacts_new_cargo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $all_contacts_new_list->cargo->caption() ?></span><span class="ew-table-header-sort"><?php if ($all_contacts_new_list->cargo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($all_contacts_new_list->cargo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($all_contacts_new_list->responsabilidades->Visible) { // responsabilidades ?>
	<?php if ($all_contacts_new_list->SortUrl($all_contacts_new_list->responsabilidades) == "") { ?>
		<th data-name="responsabilidades" class="<?php echo $all_contacts_new_list->responsabilidades->headerCellClass() ?>"><div id="elh_all_contacts_new_responsabilidades" class="all_contacts_new_responsabilidades"><div class="ew-table-header-caption"><?php echo $all_contacts_new_list->responsabilidades->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="responsabilidades" class="<?php echo $all_contacts_new_list->responsabilidades->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $all_contacts_new_list->SortUrl($all_contacts_new_list->responsabilidades) ?>', 1);"><div id="elh_all_contacts_new_responsabilidades" class="all_contacts_new_responsabilidades">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $all_contacts_new_list->responsabilidades->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($all_contacts_new_list->responsabilidades->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($all_contacts_new_list->responsabilidades->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($all_contacts_new_list->obs->Visible) { // obs ?>
	<?php if ($all_contacts_new_list->SortUrl($all_contacts_new_list->obs) == "") { ?>
		<th data-name="obs" class="<?php echo $all_contacts_new_list->obs->headerCellClass() ?>"><div id="elh_all_contacts_new_obs" class="all_contacts_new_obs"><div class="ew-table-header-caption"><?php echo $all_contacts_new_list->obs->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="obs" class="<?php echo $all_contacts_new_list->obs->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $all_contacts_new_list->SortUrl($all_contacts_new_list->obs) ?>', 1);"><div id="elh_all_contacts_new_obs" class="all_contacts_new_obs">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $all_contacts_new_list->obs->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($all_contacts_new_list->obs->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($all_contacts_new_list->obs->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$all_contacts_new_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($all_contacts_new_list->ExportAll && $all_contacts_new_list->isExport()) {
	$all_contacts_new_list->StopRecord = $all_contacts_new_list->TotalRecords;
} else {

	// Set the last record to display
	if ($all_contacts_new_list->TotalRecords > $all_contacts_new_list->StartRecord + $all_contacts_new_list->DisplayRecords - 1)
		$all_contacts_new_list->StopRecord = $all_contacts_new_list->StartRecord + $all_contacts_new_list->DisplayRecords - 1;
	else
		$all_contacts_new_list->StopRecord = $all_contacts_new_list->TotalRecords;
}
$all_contacts_new_list->RecordCount = $all_contacts_new_list->StartRecord - 1;
if ($all_contacts_new_list->Recordset && !$all_contacts_new_list->Recordset->EOF) {
	$all_contacts_new_list->Recordset->moveFirst();
	$selectLimit = $all_contacts_new_list->UseSelectLimit;
	if (!$selectLimit && $all_contacts_new_list->StartRecord > 1)
		$all_contacts_new_list->Recordset->move($all_contacts_new_list->StartRecord - 1);
} elseif (!$all_contacts_new->AllowAddDeleteRow && $all_contacts_new_list->StopRecord == 0) {
	$all_contacts_new_list->StopRecord = $all_contacts_new->GridAddRowCount;
}

// Initialize aggregate
$all_contacts_new->RowType = ROWTYPE_AGGREGATEINIT;
$all_contacts_new->resetAttributes();
$all_contacts_new_list->renderRow();
while ($all_contacts_new_list->RecordCount < $all_contacts_new_list->StopRecord) {
	$all_contacts_new_list->RecordCount++;
	if ($all_contacts_new_list->RecordCount >= $all_contacts_new_list->StartRecord) {
		$all_contacts_new_list->RowCount++;

		// Set up key count
		$all_contacts_new_list->KeyCount = $all_contacts_new_list->RowIndex;

		// Init row class and style
		$all_contacts_new->resetAttributes();
		$all_contacts_new->CssClass = "";
		if ($all_contacts_new_list->isGridAdd()) {
		} else {
			$all_contacts_new_list->loadRowValues($all_contacts_new_list->Recordset); // Load row values
		}
		$all_contacts_new->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$all_contacts_new->RowAttrs->merge(["data-rowindex" => $all_contacts_new_list->RowCount, "id" => "r" . $all_contacts_new_list->RowCount . "_all_contacts_new", "data-rowtype" => $all_contacts_new->RowType]);

		// Render row
		$all_contacts_new_list->renderRow();

		// Render list options
		$all_contacts_new_list->renderListOptions();
?>
	<tr <?php echo $all_contacts_new->rowAttributes() ?>>
<?php

// Render list options (body, left)
$all_contacts_new_list->ListOptions->render("body", "left", $all_contacts_new_list->RowCount);
?>
	<?php if ($all_contacts_new_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $all_contacts_new_list->id->cellAttributes() ?>>
<span id="el<?php echo $all_contacts_new_list->RowCount ?>_all_contacts_new_id">
<span<?php echo $all_contacts_new_list->id->viewAttributes() ?>><?php echo $all_contacts_new_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($all_contacts_new_list->avatar->Visible) { // avatar ?>
		<td data-name="avatar" <?php echo $all_contacts_new_list->avatar->cellAttributes() ?>>
<span id="el<?php echo $all_contacts_new_list->RowCount ?>_all_contacts_new_avatar">
<span<?php echo $all_contacts_new_list->avatar->viewAttributes() ?>><?php echo $all_contacts_new_list->avatar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($all_contacts_new_list->nome_completo->Visible) { // nome_completo ?>
		<td data-name="nome_completo" <?php echo $all_contacts_new_list->nome_completo->cellAttributes() ?>>
<span id="el<?php echo $all_contacts_new_list->RowCount ?>_all_contacts_new_nome_completo">
<span<?php echo $all_contacts_new_list->nome_completo->viewAttributes() ?>><?php echo $all_contacts_new_list->nome_completo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($all_contacts_new_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $all_contacts_new_list->_email->cellAttributes() ?>>
<span id="el<?php echo $all_contacts_new_list->RowCount ?>_all_contacts_new__email">
<span<?php echo $all_contacts_new_list->_email->viewAttributes() ?>><?php echo $all_contacts_new_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($all_contacts_new_list->telefone->Visible) { // telefone ?>
		<td data-name="telefone" <?php echo $all_contacts_new_list->telefone->cellAttributes() ?>>
<span id="el<?php echo $all_contacts_new_list->RowCount ?>_all_contacts_new_telefone">
<span<?php echo $all_contacts_new_list->telefone->viewAttributes() ?>><?php echo $all_contacts_new_list->telefone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($all_contacts_new_list->celular->Visible) { // celular ?>
		<td data-name="celular" <?php echo $all_contacts_new_list->celular->cellAttributes() ?>>
<span id="el<?php echo $all_contacts_new_list->RowCount ?>_all_contacts_new_celular">
<span<?php echo $all_contacts_new_list->celular->viewAttributes() ?>><?php echo $all_contacts_new_list->celular->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($all_contacts_new_list->empresa->Visible) { // empresa ?>
		<td data-name="empresa" <?php echo $all_contacts_new_list->empresa->cellAttributes() ?>>
<span id="el<?php echo $all_contacts_new_list->RowCount ?>_all_contacts_new_empresa">
<span<?php echo $all_contacts_new_list->empresa->viewAttributes() ?>><?php echo $all_contacts_new_list->empresa->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($all_contacts_new_list->cargo->Visible) { // cargo ?>
		<td data-name="cargo" <?php echo $all_contacts_new_list->cargo->cellAttributes() ?>>
<span id="el<?php echo $all_contacts_new_list->RowCount ?>_all_contacts_new_cargo">
<span<?php echo $all_contacts_new_list->cargo->viewAttributes() ?>><?php echo $all_contacts_new_list->cargo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($all_contacts_new_list->responsabilidades->Visible) { // responsabilidades ?>
		<td data-name="responsabilidades" <?php echo $all_contacts_new_list->responsabilidades->cellAttributes() ?>>
<span id="el<?php echo $all_contacts_new_list->RowCount ?>_all_contacts_new_responsabilidades">
<span<?php echo $all_contacts_new_list->responsabilidades->viewAttributes() ?>><?php echo $all_contacts_new_list->responsabilidades->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($all_contacts_new_list->obs->Visible) { // obs ?>
		<td data-name="obs" <?php echo $all_contacts_new_list->obs->cellAttributes() ?>>
<span id="el<?php echo $all_contacts_new_list->RowCount ?>_all_contacts_new_obs">
<span<?php echo $all_contacts_new_list->obs->viewAttributes() ?>><?php echo $all_contacts_new_list->obs->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$all_contacts_new_list->ListOptions->render("body", "right", $all_contacts_new_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$all_contacts_new_list->isGridAdd())
		$all_contacts_new_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$all_contacts_new->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($all_contacts_new_list->Recordset)
	$all_contacts_new_list->Recordset->Close();
?>
<?php if (!$all_contacts_new_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$all_contacts_new_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $all_contacts_new_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $all_contacts_new_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($all_contacts_new_list->TotalRecords == 0 && !$all_contacts_new->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $all_contacts_new_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$all_contacts_new_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$all_contacts_new_list->isExport()) { ?>
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
$all_contacts_new_list->terminate();
?>