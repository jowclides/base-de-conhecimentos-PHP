<?php namespace PHPMaker2020\PHPMAKER_Contatos; ?>
<?php

/**
 * Table class for view2
 */
class view2 extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $id;
	public $avatar;
	public $nome_completo;
	public $_email;
	public $telefone;
	public $celular;
	public $nome_empreasa;
	public $nome_cargo;
	public $responsabilidades;
	public $obs;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'view2';
		$this->TableName = 'view2';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`view2`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id
		$this->id = new DbField('view2', 'view2', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// avatar
		$this->avatar = new DbField('view2', 'view2', 'x_avatar', 'avatar', '`avatar`', '`avatar`', 200, 255, -1, TRUE, '`avatar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->avatar->Sortable = TRUE; // Allow sort
		$this->avatar->UploadAllowedFileExt = "gif,jpg,jpeg,bmp,png";
		$this->fields['avatar'] = &$this->avatar;

		// nome_completo
		$this->nome_completo = new DbField('view2', 'view2', 'x_nome_completo', 'nome_completo', '`nome_completo`', '`nome_completo`', 200, 255, -1, FALSE, '`nome_completo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nome_completo->Nullable = FALSE; // NOT NULL field
		$this->nome_completo->Required = TRUE; // Required field
		$this->nome_completo->Sortable = TRUE; // Allow sort
		$this->fields['nome_completo'] = &$this->nome_completo;

		// email
		$this->_email = new DbField('view2', 'view2', 'x__email', 'email', '`email`', '`email`', 200, 255, -1, FALSE, '`email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_email->Sortable = TRUE; // Allow sort
		$this->fields['email'] = &$this->_email;

		// telefone
		$this->telefone = new DbField('view2', 'view2', 'x_telefone', 'telefone', '`telefone`', '`telefone`', 200, 255, -1, FALSE, '`telefone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->telefone->Sortable = TRUE; // Allow sort
		$this->fields['telefone'] = &$this->telefone;

		// celular
		$this->celular = new DbField('view2', 'view2', 'x_celular', 'celular', '`celular`', '`celular`', 200, 255, -1, FALSE, '`celular`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->celular->Sortable = TRUE; // Allow sort
		$this->fields['celular'] = &$this->celular;

		// nome_empreasa
		$this->nome_empreasa = new DbField('view2', 'view2', 'x_nome_empreasa', 'nome_empreasa', '`nome_empreasa`', '`nome_empreasa`', 200, 255, -1, FALSE, '`nome_empreasa`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nome_empreasa->Nullable = FALSE; // NOT NULL field
		$this->nome_empreasa->Required = TRUE; // Required field
		$this->nome_empreasa->Sortable = TRUE; // Allow sort
		$this->fields['nome_empreasa'] = &$this->nome_empreasa;

		// nome_cargo
		$this->nome_cargo = new DbField('view2', 'view2', 'x_nome_cargo', 'nome_cargo', '`nome_cargo`', '`nome_cargo`', 200, 255, -1, FALSE, '`nome_cargo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nome_cargo->Nullable = FALSE; // NOT NULL field
		$this->nome_cargo->Required = TRUE; // Required field
		$this->nome_cargo->Sortable = TRUE; // Allow sort
		$this->fields['nome_cargo'] = &$this->nome_cargo;

		// responsabilidades
		$this->responsabilidades = new DbField('view2', 'view2', 'x_responsabilidades', 'responsabilidades', '`responsabilidades`', '`responsabilidades`', 200, 255, -1, FALSE, '`responsabilidades`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->responsabilidades->Sortable = TRUE; // Allow sort
		$this->fields['responsabilidades'] = &$this->responsabilidades;

		// obs
		$this->obs = new DbField('view2', 'view2', 'x_obs', 'obs', '`obs`', '`obs`', 200, 255, -1, FALSE, '`obs`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->obs->Sortable = TRUE; // Allow sort
		$this->fields['obs'] = &$this->obs;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`view2`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = Config("USER_ID_ALLOW");
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " (" . $names . ") VALUES (" . $values . ")";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->id->setDbValue($conn->insert_ID());
			$rs['id'] = $this->id->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id', $rs))
				AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->avatar->Upload->DbValue = $row['avatar'];
		$this->nome_completo->DbValue = $row['nome_completo'];
		$this->_email->DbValue = $row['email'];
		$this->telefone->DbValue = $row['telefone'];
		$this->celular->DbValue = $row['celular'];
		$this->nome_empreasa->DbValue = $row['nome_empreasa'];
		$this->nome_cargo->DbValue = $row['nome_cargo'];
		$this->responsabilidades->DbValue = $row['responsabilidades'];
		$this->obs->DbValue = $row['obs'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$oldFiles = EmptyValue($row['avatar']) ? [] : [$row['avatar']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->avatar->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->avatar->oldPhysicalUploadPath() . $oldFile);
		}
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id` = @id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id', $row) ? $row['id'] : NULL;
		else
			$val = $this->id->OldValue !== NULL ? $this->id->OldValue : $this->id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "view2list.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "view2view.php")
			return $Language->phrase("View");
		elseif ($pageName == "view2edit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "view2add.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "view2list.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("view2view.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("view2view.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "view2add.php?" . $this->getUrlParm($parm);
		else
			$url = "view2add.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("view2edit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("view2add.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("view2delete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->id->CurrentValue != NULL) {
			$url .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("id") !== NULL)
				$arKeys[] = Param("id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->id->CurrentValue = $key;
			else
				$this->id->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->id->setDbValue($rs->fields('id'));
		$this->avatar->Upload->DbValue = $rs->fields('avatar');
		$this->nome_completo->setDbValue($rs->fields('nome_completo'));
		$this->_email->setDbValue($rs->fields('email'));
		$this->telefone->setDbValue($rs->fields('telefone'));
		$this->celular->setDbValue($rs->fields('celular'));
		$this->nome_empreasa->setDbValue($rs->fields('nome_empreasa'));
		$this->nome_cargo->setDbValue($rs->fields('nome_cargo'));
		$this->responsabilidades->setDbValue($rs->fields('responsabilidades'));
		$this->obs->setDbValue($rs->fields('obs'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// avatar
		// nome_completo
		// email
		// telefone
		// celular
		// nome_empreasa
		// nome_cargo
		// responsabilidades
		// obs
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// avatar
		if (!EmptyValue($this->avatar->Upload->DbValue)) {
			$this->avatar->ViewValue = $this->avatar->Upload->DbValue;
		} else {
			$this->avatar->ViewValue = "";
		}
		$this->avatar->ViewCustomAttributes = "";

		// nome_completo
		$this->nome_completo->ViewValue = $this->nome_completo->CurrentValue;
		$this->nome_completo->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// telefone
		$this->telefone->ViewValue = $this->telefone->CurrentValue;
		$this->telefone->ViewCustomAttributes = "";

		// celular
		$this->celular->ViewValue = $this->celular->CurrentValue;
		$this->celular->ViewCustomAttributes = "";

		// nome_empreasa
		$this->nome_empreasa->ViewValue = $this->nome_empreasa->CurrentValue;
		$this->nome_empreasa->ViewCustomAttributes = "";

		// nome_cargo
		$this->nome_cargo->ViewValue = $this->nome_cargo->CurrentValue;
		$this->nome_cargo->ViewCustomAttributes = "";

		// responsabilidades
		$this->responsabilidades->ViewValue = $this->responsabilidades->CurrentValue;
		$this->responsabilidades->ViewCustomAttributes = "";

		// obs
		$this->obs->ViewValue = $this->obs->CurrentValue;
		$this->obs->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// avatar
		$this->avatar->LinkCustomAttributes = "";
		$this->avatar->HrefValue = "";
		$this->avatar->ExportHrefValue = $this->avatar->UploadPath . $this->avatar->Upload->DbValue;
		$this->avatar->TooltipValue = "";

		// nome_completo
		$this->nome_completo->LinkCustomAttributes = "";
		$this->nome_completo->HrefValue = "";
		$this->nome_completo->TooltipValue = "";

		// email
		$this->_email->LinkCustomAttributes = "";
		$this->_email->HrefValue = "";
		$this->_email->TooltipValue = "";

		// telefone
		$this->telefone->LinkCustomAttributes = "";
		$this->telefone->HrefValue = "";
		$this->telefone->TooltipValue = "";

		// celular
		$this->celular->LinkCustomAttributes = "";
		$this->celular->HrefValue = "";
		$this->celular->TooltipValue = "";

		// nome_empreasa
		$this->nome_empreasa->LinkCustomAttributes = "";
		$this->nome_empreasa->HrefValue = "";
		$this->nome_empreasa->TooltipValue = "";

		// nome_cargo
		$this->nome_cargo->LinkCustomAttributes = "";
		$this->nome_cargo->HrefValue = "";
		$this->nome_cargo->TooltipValue = "";

		// responsabilidades
		$this->responsabilidades->LinkCustomAttributes = "";
		$this->responsabilidades->HrefValue = "";
		$this->responsabilidades->TooltipValue = "";

		// obs
		$this->obs->LinkCustomAttributes = "";
		$this->obs->HrefValue = "";
		$this->obs->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// avatar
		$this->avatar->EditAttrs["class"] = "form-control";
		$this->avatar->EditCustomAttributes = "";
		if (!EmptyValue($this->avatar->Upload->DbValue)) {
			$this->avatar->EditValue = $this->avatar->Upload->DbValue;
		} else {
			$this->avatar->EditValue = "";
		}
		if (!EmptyValue($this->avatar->CurrentValue))
				$this->avatar->Upload->FileName = $this->avatar->CurrentValue;

		// nome_completo
		$this->nome_completo->EditAttrs["class"] = "form-control";
		$this->nome_completo->EditCustomAttributes = "";
		if (!$this->nome_completo->Raw)
			$this->nome_completo->CurrentValue = HtmlDecode($this->nome_completo->CurrentValue);
		$this->nome_completo->EditValue = $this->nome_completo->CurrentValue;
		$this->nome_completo->PlaceHolder = RemoveHtml($this->nome_completo->caption());

		// email
		$this->_email->EditAttrs["class"] = "form-control";
		$this->_email->EditCustomAttributes = "";
		if (!$this->_email->Raw)
			$this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
		$this->_email->EditValue = $this->_email->CurrentValue;
		$this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

		// telefone
		$this->telefone->EditAttrs["class"] = "form-control";
		$this->telefone->EditCustomAttributes = "";
		if (!$this->telefone->Raw)
			$this->telefone->CurrentValue = HtmlDecode($this->telefone->CurrentValue);
		$this->telefone->EditValue = $this->telefone->CurrentValue;
		$this->telefone->PlaceHolder = RemoveHtml($this->telefone->caption());

		// celular
		$this->celular->EditAttrs["class"] = "form-control";
		$this->celular->EditCustomAttributes = "";
		if (!$this->celular->Raw)
			$this->celular->CurrentValue = HtmlDecode($this->celular->CurrentValue);
		$this->celular->EditValue = $this->celular->CurrentValue;
		$this->celular->PlaceHolder = RemoveHtml($this->celular->caption());

		// nome_empreasa
		$this->nome_empreasa->EditAttrs["class"] = "form-control";
		$this->nome_empreasa->EditCustomAttributes = "";
		if (!$this->nome_empreasa->Raw)
			$this->nome_empreasa->CurrentValue = HtmlDecode($this->nome_empreasa->CurrentValue);
		$this->nome_empreasa->EditValue = $this->nome_empreasa->CurrentValue;
		$this->nome_empreasa->PlaceHolder = RemoveHtml($this->nome_empreasa->caption());

		// nome_cargo
		$this->nome_cargo->EditAttrs["class"] = "form-control";
		$this->nome_cargo->EditCustomAttributes = "";
		if (!$this->nome_cargo->Raw)
			$this->nome_cargo->CurrentValue = HtmlDecode($this->nome_cargo->CurrentValue);
		$this->nome_cargo->EditValue = $this->nome_cargo->CurrentValue;
		$this->nome_cargo->PlaceHolder = RemoveHtml($this->nome_cargo->caption());

		// responsabilidades
		$this->responsabilidades->EditAttrs["class"] = "form-control";
		$this->responsabilidades->EditCustomAttributes = "";
		if (!$this->responsabilidades->Raw)
			$this->responsabilidades->CurrentValue = HtmlDecode($this->responsabilidades->CurrentValue);
		$this->responsabilidades->EditValue = $this->responsabilidades->CurrentValue;
		$this->responsabilidades->PlaceHolder = RemoveHtml($this->responsabilidades->caption());

		// obs
		$this->obs->EditAttrs["class"] = "form-control";
		$this->obs->EditCustomAttributes = "";
		if (!$this->obs->Raw)
			$this->obs->CurrentValue = HtmlDecode($this->obs->CurrentValue);
		$this->obs->EditValue = $this->obs->CurrentValue;
		$this->obs->PlaceHolder = RemoveHtml($this->obs->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->avatar);
					$doc->exportCaption($this->nome_completo);
					$doc->exportCaption($this->_email);
					$doc->exportCaption($this->telefone);
					$doc->exportCaption($this->celular);
					$doc->exportCaption($this->nome_empreasa);
					$doc->exportCaption($this->nome_cargo);
					$doc->exportCaption($this->responsabilidades);
					$doc->exportCaption($this->obs);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->avatar);
					$doc->exportCaption($this->nome_completo);
					$doc->exportCaption($this->_email);
					$doc->exportCaption($this->telefone);
					$doc->exportCaption($this->celular);
					$doc->exportCaption($this->nome_empreasa);
					$doc->exportCaption($this->nome_cargo);
					$doc->exportCaption($this->responsabilidades);
					$doc->exportCaption($this->obs);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->id);
						$doc->exportField($this->avatar);
						$doc->exportField($this->nome_completo);
						$doc->exportField($this->_email);
						$doc->exportField($this->telefone);
						$doc->exportField($this->celular);
						$doc->exportField($this->nome_empreasa);
						$doc->exportField($this->nome_cargo);
						$doc->exportField($this->responsabilidades);
						$doc->exportField($this->obs);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->avatar);
						$doc->exportField($this->nome_completo);
						$doc->exportField($this->_email);
						$doc->exportField($this->telefone);
						$doc->exportField($this->celular);
						$doc->exportField($this->nome_empreasa);
						$doc->exportField($this->nome_cargo);
						$doc->exportField($this->responsabilidades);
						$doc->exportField($this->obs);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{
		$width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
		$height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

		// Set up field name / file name field / file type field
		$fldName = "";
		$fileNameFld = "";
		$fileTypeFld = "";
		if ($fldparm == 'avatar') {
			$fldName = "avatar";
			$fileNameFld = "avatar";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->id->CurrentValue = $ar[0];
		} else {
			return FALSE; // Incorrect key
		}

		// Set up filter (WHERE Clause)
		$filter = $this->getRecordFilter();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$dbtype = GetConnectionType($this->Dbid);
		if (($rs = $conn->execute($sql)) && !$rs->EOF) {
			$val = $rs->fields($fldName);
			if (!EmptyValue($val)) {
				$fld = $this->fields[$fldName];

				// Binary data
				if ($fld->DataType == DATATYPE_BLOB) {
					if ($dbtype != "MYSQL") {
						if (is_array($val) || is_object($val)) // Byte array
							$val = BytesToString($val);
					}
					if ($resize)
						ResizeBinary($val, $width, $height);

					// Write file type
					if ($fileTypeFld != "" && !EmptyValue($rs->fields($fileTypeFld))) {
						AddHeader("Content-type", $rs->fields($fileTypeFld));
					} else {
						AddHeader("Content-type", ContentType($val));
					}

					// Write file name
					$downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
					if ($fileNameFld != "" && !EmptyValue($rs->fields($fileNameFld))) {
						$fileName = $rs->fields($fileNameFld);
						$pathinfo = pathinfo($fileName);
						$ext = strtolower(@$pathinfo["extension"]);
						$isPdf = SameText($ext, "pdf");
						if ($downloadPdf || !$isPdf) // Skip header if not download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					} else {
						$ext = ContentExtension($val);
						$isPdf = SameText($ext, ".pdf");
						if ($isPdf && $downloadPdf) // Add header if download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					}

					// Write file data
					if (StartsString("PK", $val) && ContainsString($val, "[Content_Types].xml") &&
						ContainsString($val, "_rels") && ContainsString($val, "docProps")) { // Fix Office 2007 documents
						if (!EndsString("\0\0\0", $val)) // Not ends with 3 or 4 \0
							$val .= "\0\0\0\0";
					}

					// Clear any debug message
					if (ob_get_length())
						ob_end_clean();

					// Write binary data
					Write($val);

				// Upload to folder
				} else {
					if ($fld->UploadMultiple)
						$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
					else
						$files = [$val];
					$data = [];
					$ar = [];
					foreach ($files as $file) {
						if (!EmptyValue($file))
							$ar[$file] = FullUrl($fld->hrefPath() . $file);
					}
					$data[$fld->Param] = $ar;
					WriteJson($data);
				}
			}
			$rs->close();
			return TRUE;
		}
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>