<?php
namespace PHPMaker2020\PHPMAKER_Contatos;

/**
 * Page class
 */
class contatos_add extends contatos
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{EC5E5D8D-964F-4307-931C-849F6024B4A9}";

	// Table name
	public $TableName = 'contatos';

	// Page object name
	public $PageObjName = "contatos_add";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (contatos)
		if (!isset($GLOBALS["contatos"]) || get_class($GLOBALS["contatos"]) == PROJECT_NAMESPACE . "contatos") {
			$GLOBALS["contatos"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["contatos"];
		}

		// Table object (usuarios)
		if (!isset($GLOBALS['usuarios']))
			$GLOBALS['usuarios'] = new usuarios();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'contatos');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (usuarios)
		$UserTable = $UserTable ?: new usuarios();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $contatos;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($contatos);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "contatosview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->id->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!$this->setupApiRequest())
			return FALSE;

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API request
	public function setupApiRequest()
	{
		global $Security;

		// Check security for API request
		If (ValidApiRequest()) {
			if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
			if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
			$Security->UserID_Loading();
			$Security->loadUserID();
			$Security->UserID_Loaded();
			return TRUE;
		}
		return FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (!$this->setupApiRequest()) {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("contatoslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->avatar->setVisibility();
		$this->nome_completo->setVisibility();
		$this->_email->setVisibility();
		$this->telefone->setVisibility();
		$this->celular->setVisibility();
		$this->empresa->setVisibility();
		$this->cargo->setVisibility();
		$this->responsabilidades->setVisibility();
		$this->obs->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->empresa);
		$this->setupLookupOptions($this->cargo);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("contatoslist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("contatoslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "contatoslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "contatosview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
		$this->avatar->Upload->Index = $CurrentForm->Index;
		$this->avatar->Upload->uploadFile();
		$this->avatar->CurrentValue = $this->avatar->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->avatar->Upload->DbValue = NULL;
		$this->avatar->OldValue = $this->avatar->Upload->DbValue;
		$this->avatar->CurrentValue = NULL; // Clear file related field
		$this->nome_completo->CurrentValue = NULL;
		$this->nome_completo->OldValue = $this->nome_completo->CurrentValue;
		$this->_email->CurrentValue = NULL;
		$this->_email->OldValue = $this->_email->CurrentValue;
		$this->telefone->CurrentValue = NULL;
		$this->telefone->OldValue = $this->telefone->CurrentValue;
		$this->celular->CurrentValue = NULL;
		$this->celular->OldValue = $this->celular->CurrentValue;
		$this->empresa->CurrentValue = NULL;
		$this->empresa->OldValue = $this->empresa->CurrentValue;
		$this->cargo->CurrentValue = NULL;
		$this->cargo->OldValue = $this->cargo->CurrentValue;
		$this->responsabilidades->CurrentValue = NULL;
		$this->responsabilidades->OldValue = $this->responsabilidades->CurrentValue;
		$this->obs->CurrentValue = NULL;
		$this->obs->OldValue = $this->obs->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'nome_completo' first before field var 'x_nome_completo'
		$val = $CurrentForm->hasValue("nome_completo") ? $CurrentForm->getValue("nome_completo") : $CurrentForm->getValue("x_nome_completo");
		if (!$this->nome_completo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nome_completo->Visible = FALSE; // Disable update for API request
			else
				$this->nome_completo->setFormValue($val);
		}

		// Check field name 'email' first before field var 'x__email'
		$val = $CurrentForm->hasValue("email") ? $CurrentForm->getValue("email") : $CurrentForm->getValue("x__email");
		if (!$this->_email->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_email->Visible = FALSE; // Disable update for API request
			else
				$this->_email->setFormValue($val);
		}

		// Check field name 'telefone' first before field var 'x_telefone'
		$val = $CurrentForm->hasValue("telefone") ? $CurrentForm->getValue("telefone") : $CurrentForm->getValue("x_telefone");
		if (!$this->telefone->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->telefone->Visible = FALSE; // Disable update for API request
			else
				$this->telefone->setFormValue($val);
		}

		// Check field name 'celular' first before field var 'x_celular'
		$val = $CurrentForm->hasValue("celular") ? $CurrentForm->getValue("celular") : $CurrentForm->getValue("x_celular");
		if (!$this->celular->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->celular->Visible = FALSE; // Disable update for API request
			else
				$this->celular->setFormValue($val);
		}

		// Check field name 'empresa' first before field var 'x_empresa'
		$val = $CurrentForm->hasValue("empresa") ? $CurrentForm->getValue("empresa") : $CurrentForm->getValue("x_empresa");
		if (!$this->empresa->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->empresa->Visible = FALSE; // Disable update for API request
			else
				$this->empresa->setFormValue($val);
		}

		// Check field name 'cargo' first before field var 'x_cargo'
		$val = $CurrentForm->hasValue("cargo") ? $CurrentForm->getValue("cargo") : $CurrentForm->getValue("x_cargo");
		if (!$this->cargo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cargo->Visible = FALSE; // Disable update for API request
			else
				$this->cargo->setFormValue($val);
		}

		// Check field name 'responsabilidades' first before field var 'x_responsabilidades'
		$val = $CurrentForm->hasValue("responsabilidades") ? $CurrentForm->getValue("responsabilidades") : $CurrentForm->getValue("x_responsabilidades");
		if (!$this->responsabilidades->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->responsabilidades->Visible = FALSE; // Disable update for API request
			else
				$this->responsabilidades->setFormValue($val);
		}

		// Check field name 'obs' first before field var 'x_obs'
		$val = $CurrentForm->hasValue("obs") ? $CurrentForm->getValue("obs") : $CurrentForm->getValue("x_obs");
		if (!$this->obs->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->obs->Visible = FALSE; // Disable update for API request
			else
				$this->obs->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->nome_completo->CurrentValue = $this->nome_completo->FormValue;
		$this->_email->CurrentValue = $this->_email->FormValue;
		$this->telefone->CurrentValue = $this->telefone->FormValue;
		$this->celular->CurrentValue = $this->celular->FormValue;
		$this->empresa->CurrentValue = $this->empresa->FormValue;
		$this->cargo->CurrentValue = $this->cargo->FormValue;
		$this->responsabilidades->CurrentValue = $this->responsabilidades->FormValue;
		$this->obs->CurrentValue = $this->obs->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id->setDbValue($row['id']);
		$this->avatar->Upload->DbValue = $row['avatar'];
		$this->avatar->setDbValue($this->avatar->Upload->DbValue);
		$this->nome_completo->setDbValue($row['nome_completo']);
		$this->_email->setDbValue($row['email']);
		$this->telefone->setDbValue($row['telefone']);
		$this->celular->setDbValue($row['celular']);
		$this->empresa->setDbValue($row['empresa']);
		$this->cargo->setDbValue($row['cargo']);
		$this->responsabilidades->setDbValue($row['responsabilidades']);
		$this->obs->setDbValue($row['obs']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['avatar'] = $this->avatar->Upload->DbValue;
		$row['nome_completo'] = $this->nome_completo->CurrentValue;
		$row['email'] = $this->_email->CurrentValue;
		$row['telefone'] = $this->telefone->CurrentValue;
		$row['celular'] = $this->celular->CurrentValue;
		$row['empresa'] = $this->empresa->CurrentValue;
		$row['cargo'] = $this->cargo->CurrentValue;
		$row['responsabilidades'] = $this->responsabilidades->CurrentValue;
		$row['obs'] = $this->obs->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id")) != "")
			$this->id->OldValue = $this->getKey("id"); // id
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// avatar
		// nome_completo
		// email
		// telefone
		// celular
		// empresa
		// cargo
		// responsabilidades
		// obs

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// empresa
			$curVal = strval($this->empresa->CurrentValue);
			if ($curVal != "") {
				$this->empresa->ViewValue = $this->empresa->lookupCacheOption($curVal);
				if ($this->empresa->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->empresa->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->empresa->ViewValue = $this->empresa->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->empresa->ViewValue = $this->empresa->CurrentValue;
					}
				}
			} else {
				$this->empresa->ViewValue = NULL;
			}
			$this->empresa->ViewCustomAttributes = "";

			// cargo
			$curVal = strval($this->cargo->CurrentValue);
			if ($curVal != "") {
				$this->cargo->ViewValue = $this->cargo->lookupCacheOption($curVal);
				if ($this->cargo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->cargo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->cargo->ViewValue = $this->cargo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->cargo->ViewValue = $this->cargo->CurrentValue;
					}
				}
			} else {
				$this->cargo->ViewValue = NULL;
			}
			$this->cargo->ViewCustomAttributes = "";

			// responsabilidades
			$this->responsabilidades->ViewValue = $this->responsabilidades->CurrentValue;
			$this->responsabilidades->ViewCustomAttributes = "";

			// obs
			$this->obs->ViewValue = $this->obs->CurrentValue;
			$this->obs->ViewCustomAttributes = "";

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

			// empresa
			$this->empresa->LinkCustomAttributes = "";
			$this->empresa->HrefValue = "";
			$this->empresa->TooltipValue = "";

			// cargo
			$this->cargo->LinkCustomAttributes = "";
			$this->cargo->HrefValue = "";
			$this->cargo->TooltipValue = "";

			// responsabilidades
			$this->responsabilidades->LinkCustomAttributes = "";
			$this->responsabilidades->HrefValue = "";
			$this->responsabilidades->TooltipValue = "";

			// obs
			$this->obs->LinkCustomAttributes = "";
			$this->obs->HrefValue = "";
			$this->obs->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

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
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->avatar);

			// nome_completo
			$this->nome_completo->EditAttrs["class"] = "form-control";
			$this->nome_completo->EditCustomAttributes = "";
			if (!$this->nome_completo->Raw)
				$this->nome_completo->CurrentValue = HtmlDecode($this->nome_completo->CurrentValue);
			$this->nome_completo->EditValue = HtmlEncode($this->nome_completo->CurrentValue);
			$this->nome_completo->PlaceHolder = RemoveHtml($this->nome_completo->caption());

			// email
			$this->_email->EditAttrs["class"] = "form-control";
			$this->_email->EditCustomAttributes = "";
			if (!$this->_email->Raw)
				$this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
			$this->_email->EditValue = HtmlEncode($this->_email->CurrentValue);
			$this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

			// telefone
			$this->telefone->EditAttrs["class"] = "form-control";
			$this->telefone->EditCustomAttributes = "";
			if (!$this->telefone->Raw)
				$this->telefone->CurrentValue = HtmlDecode($this->telefone->CurrentValue);
			$this->telefone->EditValue = HtmlEncode($this->telefone->CurrentValue);
			$this->telefone->PlaceHolder = RemoveHtml($this->telefone->caption());

			// celular
			$this->celular->EditAttrs["class"] = "form-control";
			$this->celular->EditCustomAttributes = "";
			if (!$this->celular->Raw)
				$this->celular->CurrentValue = HtmlDecode($this->celular->CurrentValue);
			$this->celular->EditValue = HtmlEncode($this->celular->CurrentValue);
			$this->celular->PlaceHolder = RemoveHtml($this->celular->caption());

			// empresa
			$this->empresa->EditCustomAttributes = "";
			$curVal = trim(strval($this->empresa->CurrentValue));
			if ($curVal != "")
				$this->empresa->ViewValue = $this->empresa->lookupCacheOption($curVal);
			else
				$this->empresa->ViewValue = $this->empresa->Lookup !== NULL && is_array($this->empresa->Lookup->Options) ? $curVal : NULL;
			if ($this->empresa->ViewValue !== NULL) { // Load from cache
				$this->empresa->EditValue = array_values($this->empresa->Lookup->Options);
				if ($this->empresa->ViewValue == "")
					$this->empresa->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->empresa->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->empresa->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->empresa->ViewValue = $this->empresa->displayValue($arwrk);
				} else {
					$this->empresa->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->empresa->EditValue = $arwrk;
			}

			// cargo
			$this->cargo->EditCustomAttributes = "";
			$curVal = trim(strval($this->cargo->CurrentValue));
			if ($curVal != "")
				$this->cargo->ViewValue = $this->cargo->lookupCacheOption($curVal);
			else
				$this->cargo->ViewValue = $this->cargo->Lookup !== NULL && is_array($this->cargo->Lookup->Options) ? $curVal : NULL;
			if ($this->cargo->ViewValue !== NULL) { // Load from cache
				$this->cargo->EditValue = array_values($this->cargo->Lookup->Options);
				if ($this->cargo->ViewValue == "")
					$this->cargo->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->cargo->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->cargo->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->cargo->ViewValue = $this->cargo->displayValue($arwrk);
				} else {
					$this->cargo->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->cargo->EditValue = $arwrk;
			}

			// responsabilidades
			$this->responsabilidades->EditAttrs["class"] = "form-control";
			$this->responsabilidades->EditCustomAttributes = "";
			if (!$this->responsabilidades->Raw)
				$this->responsabilidades->CurrentValue = HtmlDecode($this->responsabilidades->CurrentValue);
			$this->responsabilidades->EditValue = HtmlEncode($this->responsabilidades->CurrentValue);
			$this->responsabilidades->PlaceHolder = RemoveHtml($this->responsabilidades->caption());

			// obs
			$this->obs->EditAttrs["class"] = "form-control";
			$this->obs->EditCustomAttributes = "";
			if (!$this->obs->Raw)
				$this->obs->CurrentValue = HtmlDecode($this->obs->CurrentValue);
			$this->obs->EditValue = HtmlEncode($this->obs->CurrentValue);
			$this->obs->PlaceHolder = RemoveHtml($this->obs->caption());

			// Add refer script
			// avatar

			$this->avatar->LinkCustomAttributes = "";
			$this->avatar->HrefValue = "";
			$this->avatar->ExportHrefValue = $this->avatar->UploadPath . $this->avatar->Upload->DbValue;

			// nome_completo
			$this->nome_completo->LinkCustomAttributes = "";
			$this->nome_completo->HrefValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";

			// telefone
			$this->telefone->LinkCustomAttributes = "";
			$this->telefone->HrefValue = "";

			// celular
			$this->celular->LinkCustomAttributes = "";
			$this->celular->HrefValue = "";

			// empresa
			$this->empresa->LinkCustomAttributes = "";
			$this->empresa->HrefValue = "";

			// cargo
			$this->cargo->LinkCustomAttributes = "";
			$this->cargo->HrefValue = "";

			// responsabilidades
			$this->responsabilidades->LinkCustomAttributes = "";
			$this->responsabilidades->HrefValue = "";

			// obs
			$this->obs->LinkCustomAttributes = "";
			$this->obs->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->avatar->Required) {
			if ($this->avatar->Upload->FileName == "" && !$this->avatar->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->avatar->caption(), $this->avatar->RequiredErrorMessage));
			}
		}
		if ($this->nome_completo->Required) {
			if (!$this->nome_completo->IsDetailKey && $this->nome_completo->FormValue != NULL && $this->nome_completo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nome_completo->caption(), $this->nome_completo->RequiredErrorMessage));
			}
		}
		if ($this->_email->Required) {
			if (!$this->_email->IsDetailKey && $this->_email->FormValue != NULL && $this->_email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_email->caption(), $this->_email->RequiredErrorMessage));
			}
		}
		if ($this->telefone->Required) {
			if (!$this->telefone->IsDetailKey && $this->telefone->FormValue != NULL && $this->telefone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->telefone->caption(), $this->telefone->RequiredErrorMessage));
			}
		}
		if ($this->celular->Required) {
			if (!$this->celular->IsDetailKey && $this->celular->FormValue != NULL && $this->celular->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->celular->caption(), $this->celular->RequiredErrorMessage));
			}
		}
		if ($this->empresa->Required) {
			if (!$this->empresa->IsDetailKey && $this->empresa->FormValue != NULL && $this->empresa->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->empresa->caption(), $this->empresa->RequiredErrorMessage));
			}
		}
		if ($this->cargo->Required) {
			if (!$this->cargo->IsDetailKey && $this->cargo->FormValue != NULL && $this->cargo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cargo->caption(), $this->cargo->RequiredErrorMessage));
			}
		}
		if ($this->responsabilidades->Required) {
			if (!$this->responsabilidades->IsDetailKey && $this->responsabilidades->FormValue != NULL && $this->responsabilidades->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->responsabilidades->caption(), $this->responsabilidades->RequiredErrorMessage));
			}
		}
		if ($this->obs->Required) {
			if (!$this->obs->IsDetailKey && $this->obs->FormValue != NULL && $this->obs->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->obs->caption(), $this->obs->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		if ($this->nome_completo->CurrentValue != "") { // Check field with unique index
			$filter = "(`nome_completo` = '" . AdjustSql($this->nome_completo->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->nome_completo->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->nome_completo->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// avatar
		if ($this->avatar->Visible && !$this->avatar->Upload->KeepFile) {
			$this->avatar->Upload->DbValue = ""; // No need to delete old file
			if ($this->avatar->Upload->FileName == "") {
				$rsnew['avatar'] = NULL;
			} else {
				$rsnew['avatar'] = $this->avatar->Upload->FileName;
			}
		}

		// nome_completo
		$this->nome_completo->setDbValueDef($rsnew, $this->nome_completo->CurrentValue, "", FALSE);

		// email
		$this->_email->setDbValueDef($rsnew, $this->_email->CurrentValue, NULL, FALSE);

		// telefone
		$this->telefone->setDbValueDef($rsnew, $this->telefone->CurrentValue, NULL, FALSE);

		// celular
		$this->celular->setDbValueDef($rsnew, $this->celular->CurrentValue, NULL, FALSE);

		// empresa
		$this->empresa->setDbValueDef($rsnew, $this->empresa->CurrentValue, NULL, FALSE);

		// cargo
		$this->cargo->setDbValueDef($rsnew, $this->cargo->CurrentValue, NULL, FALSE);

		// responsabilidades
		$this->responsabilidades->setDbValueDef($rsnew, $this->responsabilidades->CurrentValue, NULL, FALSE);

		// obs
		$this->obs->setDbValueDef($rsnew, $this->obs->CurrentValue, NULL, FALSE);
		if ($this->avatar->Visible && !$this->avatar->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->avatar->Upload->DbValue) ? [] : [$this->avatar->htmlDecode($this->avatar->Upload->DbValue)];
			if (!EmptyValue($this->avatar->Upload->FileName)) {
				$newFiles = [$this->avatar->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->avatar, $this->avatar->Upload->Index);
						if (file_exists($tempPath . $file)) {
							if (Config("DELETE_UPLOADED_FILES")) {
								$oldFileFound = FALSE;
								$oldFileCount = count($oldFiles);
								for ($j = 0; $j < $oldFileCount; $j++) {
									$oldFile = $oldFiles[$j];
									if ($oldFile == $file) { // Old file found, no need to delete anymore
										unset($oldFiles[$j]);
										$oldFileFound = TRUE;
										break;
									}
								}
								if ($oldFileFound) // No need to check if file exists further
									continue;
							}
							$file1 = UniqueFilename($this->avatar->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->avatar->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->avatar->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->avatar->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->avatar->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->avatar->setDbValueDef($rsnew, $this->avatar->Upload->FileName, NULL, FALSE);
			}
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
				if ($this->avatar->Visible && !$this->avatar->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->avatar->Upload->DbValue) ? [] : [$this->avatar->htmlDecode($this->avatar->Upload->DbValue)];
					if (!EmptyValue($this->avatar->Upload->FileName)) {
						$newFiles = [$this->avatar->Upload->FileName];
						$newFiles2 = [$this->avatar->htmlDecode($rsnew['avatar'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->avatar, $this->avatar->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->avatar->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$newFiles = [];
					}
					if (Config("DELETE_UPLOADED_FILES")) {
						foreach ($oldFiles as $oldFile) {
							if ($oldFile != "" && !in_array($oldFile, $newFiles))
								@unlink($this->avatar->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {

			// avatar
			if ($this->avatar->Upload->FileToken != "")
				CleanUploadTempPath($this->avatar->Upload->FileToken, $this->avatar->Upload->Index);
			else
				CleanUploadTempPath($this->avatar, $this->avatar->Upload->Index);
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("contatoslist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_empresa":
					break;
				case "x_cargo":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_empresa":
							break;
						case "x_cargo":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>