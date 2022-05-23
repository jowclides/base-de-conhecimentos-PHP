<?php
namespace PHPMaker2020\PHPMAKER_Contatos;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$all_contacts_list = new all_contacts_list();

// Run the page
$all_contacts_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$all_contacts_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$all_contacts_list->isExport()) { ?>
<script>
var fall_contactslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fall_contactslist = currentForm = new ew.Form("fall_contactslist", "list");
	fall_contactslist.formKeyCountName = '<?php echo $all_contacts_list->FormKeyCountName ?>';
	loadjs.done("fall_contactslist");
});
var fall_contactslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fall_contactslistsrch = currentSearchForm = new ew.Form("fall_contactslistsrch");

	// Dynamic selection lists
	// Filters

	fall_contactslistsrch.filterList = <?php echo $all_contacts_list->getFilterList() ?>;
	loadjs.done("fall_contactslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$all_contacts_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($all_contacts_list->TotalRecords > 0 && $all_contacts_list->ExportOptions->visible()) { ?>
<?php $all_contacts_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($all_contacts_list->ImportOptions->visible()) { ?>
<?php $all_contacts_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($all_contacts_list->SearchOptions->visible()) { ?>
<?php $all_contacts_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($all_contacts_list->FilterOptions->visible()) { ?>
<?php $all_contacts_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$all_contacts_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$all_contacts_list->isExport() && !$all_contacts->CurrentAction) { ?>
<form name="fall_contactslistsrch" id="fall_contactslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fall_contactslistsrch-search-panel" class="<?php echo $all_contacts_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="all_contacts">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $all_contacts_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($all_contacts_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($all_contacts_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $all_contacts_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($all_contacts_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($all_contacts_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($all_contacts_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($all_contacts_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $all_contacts_list->showPageHeader(); ?>
<?php
$all_contacts_list->showMessage();
?>
<?php if ($all_contacts_list->TotalRecords > 0 || $all_contacts->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($all_contacts_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> all_contacts">
<?php if (!$all_contacts_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$all_contacts_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $all_contacts_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $all_contacts_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fall_contactslist" id="fall_contactslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="all_contacts">
<div id="gmp_all_contacts" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($all_contacts_list->TotalRecords > 0 || $all_contacts_list->isGridEdit()) { ?>
<table id="tbl_all_contactslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$all_contacts->RowType = ROWTYPE_HEADER;

// Render list options
$all_contacts_list->renderListOptions();

// Render list options (header, left)
$all_contacts_list->ListOptions->render("header", "left");
?>
<?php if ($all_contacts_list->id->Visible) { // id ?>
	<?php if ($all_contacts_list->SortUrl($all_contacts_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $all_contacts_list->id->headerCellClass() ?>"><div id="elh_all_contacts_id" class="all_contacts_id"><div class="ew-table-header-caption"><?php echo $all_contacts_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $all_contacts_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $all_contacts_list->SortUrl($all_contacts_list->id) ?>', 1);"><div id="elh_all_contacts_id" class="all_contacts_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $all_contacts_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($all_contacts_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($all_contacts_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($all_contacts_list->nome_completo->Visible) { // nome_completo ?>
	<?php if ($all_contacts_list->SortUrl($all_contacts_list->nome_completo) == "") { ?>
		<th data-name="nome_completo" class="<?php echo $all_contacts_list->nome_completo->headerCellClass() ?>"><div id="elh_all_contacts_nome_completo" class="all_contacts_nome_completo"><div class="ew-table-header-caption"><?php echo $all_contacts_list->nome_completo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome_completo" class="<?php echo $all_contacts_list->nome_completo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $all_contacts_list->SortUrl($all_contacts_list->nome_completo) ?>', 1);"><div id="elh_all_contacts_nome_completo" class="all_contacts_nome_completo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $all_contacts_list->nome_completo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($all_contacts_list->nome_completo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($all_contacts_list->nome_completo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($all_contacts_list->_email->Visible) { // email ?>
	<?php if ($all_contacts_list->SortUrl($all_contacts_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $all_contacts_list->_email->headerCellClass() ?>"><div id="elh_all_contacts__email" class="all_contacts__email"><div class="ew-table-header-caption"><?php echo $all_contacts_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $all_contacts_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $all_contacts_list->SortUrl($all_contacts_list->_email) ?>', 1);"><div id="elh_all_contacts__email" class="all_contacts__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $all_contacts_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($all_contacts_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($all_contacts_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($all_contacts_list->telefone->Visible) { // telefone ?>
	<?php if ($all_contacts_list->SortUrl($all_contacts_list->telefone) == "") { ?>
		<th data-name="telefone" class="<?php echo $all_contacts_list->telefone->headerCellClass() ?>"><div id="elh_all_contacts_telefone" class="all_contacts_telefone"><div class="ew-table-header-caption"><?php echo $all_contacts_list->telefone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefone" class="<?php echo $all_contacts_list->telefone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $all_contacts_list->SortUrl($all_contacts_list->telefone) ?>', 1);"><div id="elh_all_contacts_telefone" class="all_contacts_telefone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $all_contacts_list->telefone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($all_contacts_list->telefone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($all_contacts_list->telefone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($all_contacts_list->celular->Visible) { // celular ?>
	<?php if ($all_contacts_list->SortUrl($all_contacts_list->celular) == "") { ?>
		<th data-name="celular" class="<?php echo $all_contacts_list->celular->headerCellClass() ?>"><div id="elh_all_contacts_celular" class="all_contacts_celular"><div class="ew-table-header-caption"><?php echo $all_contacts_list->celular->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="celular" class="<?php echo $all_contacts_list->celular->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $all_contacts_list->SortUrl($all_contacts_list->celular) ?>', 1);"><div id="elh_all_contacts_celular" class="all_contacts_celular">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $all_contacts_list->celular->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($all_contacts_list->celular->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($all_contacts_list->celular->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($all_contacts_list->nome_cargo->Visible) { // nome_cargo ?>
	<?php if ($all_contacts_list->SortUrl($all_contacts_list->nome_cargo) == "") { ?>
		<th data-name="nome_cargo" class="<?php echo $all_contacts_list->nome_cargo->headerCellClass() ?>"><div id="elh_all_contacts_nome_cargo" class="all_contacts_nome_cargo"><div class="ew-table-header-caption"><?php echo $all_contacts_list->nome_cargo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome_cargo" class="<?php echo $all_contacts_list->nome_cargo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $all_contacts_list->SortUrl($all_contacts_list->nome_cargo) ?>', 1);"><div id="elh_all_contacts_nome_cargo" class="all_contacts_nome_cargo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $all_contacts_list->nome_cargo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($all_contacts_list->nome_cargo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($all_contacts_list->nome_cargo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($all_contacts_list->nome_empreasa->Visible) { // nome_empreasa ?>
	<?php if ($all_contacts_list->SortUrl($all_contacts_list->nome_empreasa) == "") { ?>
		<th data-name="nome_empreasa" class="<?php echo $all_contacts_list->nome_empreasa->headerCellClass() ?>"><div id="elh_all_contacts_nome_empreasa" class="all_contacts_nome_empreasa"><div class="ew-table-header-caption"><?php echo $all_contacts_list->nome_empreasa->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome_empreasa" class="<?php echo $all_contacts_list->nome_empreasa->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $all_contacts_list->SortUrl($all_contacts_list->nome_empreasa) ?>', 1);"><div id="elh_all_contacts_nome_empreasa" class="all_contacts_nome_empreasa">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $all_contacts_list->nome_empreasa->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($all_contacts_list->nome_empreasa->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($all_contacts_list->nome_empreasa->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($all_contacts_list->responsabilidades->Visible) { // responsabilidades ?>
	<?php if ($all_contacts_list->SortUrl($all_contacts_list->responsabilidades) == "") { ?>
		<th data-name="responsabilidades" class="<?php echo $all_contacts_list->responsabilidades->headerCellClass() ?>"><div id="elh_all_contacts_responsabilidades" class="all_contacts_responsabilidades"><div class="ew-table-header-caption"><?php echo $all_contacts_list->responsabilidades->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="responsabilidades" class="<?php echo $all_contacts_list->responsabilidades->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $all_contacts_list->SortUrl($all_contacts_list->responsabilidades) ?>', 1);"><div id="elh_all_contacts_responsabilidades" class="all_contacts_responsabilidades">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $all_contacts_list->responsabilidades->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($all_contacts_list->responsabilidades->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($all_contacts_list->responsabilidades->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$all_contacts_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($all_contacts_list->ExportAll && $all_contacts_list->isExport()) {
	$all_contacts_list->StopRecord = $all_contacts_list->TotalRecords;
} else {

	// Set the last record to display
	if ($all_contacts_list->TotalRecords > $all_contacts_list->StartRecord + $all_contacts_list->DisplayRecords - 1)
		$all_contacts_list->StopRecord = $all_contacts_list->StartRecord + $all_contacts_list->DisplayRecords - 1;
	else
		$all_contacts_list->StopRecord = $all_contacts_list->TotalRecords;
}
$all_contacts_list->RecordCount = $all_contacts_list->StartRecord - 1;
if ($all_contacts_list->Recordset && !$all_contacts_list->Recordset->EOF) {
	$all_contacts_list->Recordset->moveFirst();
	$selectLimit = $all_contacts_list->UseSelectLimit;
	if (!$selectLimit && $all_contacts_list->StartRecord > 1)
		$all_contacts_list->Recordset->move($all_contacts_list->StartRecord - 1);
} elseif (!$all_contacts->AllowAddDeleteRow && $all_contacts_list->StopRecord == 0) {
	$all_contacts_list->StopRecord = $all_contacts->GridAddRowCount;
}

// Initialize aggregate
$all_contacts->RowType = ROWTYPE_AGGREGATEINIT;
$all_contacts->resetAttributes();
$all_contacts_list->renderRow();
while ($all_contacts_list->RecordCount < $all_contacts_list->StopRecord) {
	$all_contacts_list->RecordCount++;
	if ($all_contacts_list->RecordCount >= $all_contacts_list->StartRecord) {
		$all_contacts_list->RowCount++;

		// Set up key count
		$all_contacts_list->KeyCount = $all_contacts_list->RowIndex;

		// Init row class and style
		$all_contacts->resetAttributes();
		$all_contacts->CssClass = "";
		if ($all_contacts_list->isGridAdd()) {
		} else {
			$all_contacts_list->loadRowValues($all_contacts_list->Recordset); // Load row values
		}
		$all_contacts->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$all_contacts->RowAttrs->merge(["data-rowindex" => $all_contacts_list->RowCount, "id" => "r" . $all_contacts_list->RowCount . "_all_contacts", "data-rowtype" => $all_contacts->RowType]);

		// Render row
		$all_contacts_list->renderRow();

		// Render list options
		$all_contacts_list->renderListOptions();
?>
	<tr <?php echo $all_contacts->rowAttributes() ?>>
<?php

// Render list options (body, left)
$all_contacts_list->ListOptions->render("body", "left", $all_contacts_list->RowCount);
?>
	<?php if ($all_contacts_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $all_contacts_list->id->cellAttributes() ?>>
<span id="el<?php echo $all_contacts_list->RowCount ?>_all_contacts_id">
<span<?php echo $all_contacts_list->id->viewAttributes() ?>><?php echo $all_contacts_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($all_contacts_list->nome_completo->Visible) { // nome_completo ?>
		<td data-name="nome_completo" <?php echo $all_contacts_list->nome_completo->cellAttributes() ?>>
<span id="el<?php echo $all_contacts_list->RowCount ?>_all_contacts_nome_completo">
<span<?php echo $all_contacts_list->nome_completo->viewAttributes() ?>><?php echo $all_contacts_list->nome_completo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($all_contacts_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $all_contacts_list->_email->cellAttributes() ?>>
<span id="el<?php echo $all_contacts_list->RowCount ?>_all_contacts__email">
<span<?php echo $all_contacts_list->_email->viewAttributes() ?>><?php echo $all_contacts_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($all_contacts_list->telefone->Visible) { // telefone ?>
		<td data-name="telefone" <?php echo $all_contacts_list->telefone->cellAttributes() ?>>
<span id="el<?php echo $all_contacts_list->RowCount ?>_all_contacts_telefone">
<span<?php echo $all_contacts_list->telefone->viewAttributes() ?>><?php echo $all_contacts_list->telefone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($all_contacts_list->celular->Visible) { // celular ?>
		<td data-name="celular" <?php echo $all_contacts_list->celular->cellAttributes() ?>>
<span id="el<?php echo $all_contacts_list->RowCount ?>_all_contacts_celular">
<span<?php echo $all_contacts_list->celular->viewAttributes() ?>><?php echo $all_contacts_list->celular->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($all_contacts_list->nome_cargo->Visible) { // nome_cargo ?>
		<td data-name="nome_cargo" <?php echo $all_contacts_list->nome_cargo->cellAttributes() ?>>
<span id="el<?php echo $all_contacts_list->RowCount ?>_all_contacts_nome_cargo">
<span<?php echo $all_contacts_list->nome_cargo->viewAttributes() ?>><?php echo $all_contacts_list->nome_cargo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($all_contacts_list->nome_empreasa->Visible) { // nome_empreasa ?>
		<td data-name="nome_empreasa" <?php echo $all_contacts_list->nome_empreasa->cellAttributes() ?>>
<span id="el<?php echo $all_contacts_list->RowCount ?>_all_contacts_nome_empreasa">
<span<?php echo $all_contacts_list->nome_empreasa->viewAttributes() ?>><?php echo $all_contacts_list->nome_empreasa->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($all_contacts_list->responsabilidades->Visible) { // responsabilidades ?>
		<td data-name="responsabilidades" <?php echo $all_contacts_list->responsabilidades->cellAttributes() ?>>
<span id="el<?php echo $all_contacts_list->RowCount ?>_all_contacts_responsabilidades">
<span<?php echo $all_contacts_list->responsabilidades->viewAttributes() ?>><?php echo $all_contacts_list->responsabilidades->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$all_contacts_list->ListOptions->render("body", "right", $all_contacts_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$all_contacts_list->isGridAdd())
		$all_contacts_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$all_contacts->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($all_contacts_list->Recordset)
	$all_contacts_list->Recordset->Close();
?>
<?php if (!$all_contacts_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$all_contacts_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $all_contacts_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $all_contacts_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($all_contacts_list->TotalRecords == 0 && !$all_contacts->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $all_contacts_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$all_contacts_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$all_contacts_list->isExport()) { ?>
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
$all_contacts_list->terminate();
?>