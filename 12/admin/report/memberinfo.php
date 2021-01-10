<?php

// Global variable for table object
$member = NULL;

//
// Table class for member
//
class cmember {
	var $TableVar = 'member';
	var $TableName = 'member';
	var $TableType = 'VIEW';
	var $firstname;
	var $lastname;
	var $source;
	var $destination;
	var $intermediatedestination1;
	var $intermediatedestination2;
	var $pricepertraveler;
	var $seatsavail;
	var $luggage;
	var $leave;
	var $detour;
	var $triptype;
	var $departuretime;
	var $departuredate;
	var $ac;
	var $product;
	var $category;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var $ExportAll = TRUE;
	var $ExportPageBreakCount = 0; // Page break per every n record (PDF only)
	var $SendEmail; // Send email
	var $TableCustomInnerHtml; // Custom inner HTML
	var $BasicSearchKeyword; // Basic search keyword
	var $BasicSearchType; // Basic search type
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	var $RowType; // Row type
	var $CssClass; // CSS class
	var $CssStyle; // CSS style
	var $RowAttrs = array(); // Row custom attributes

	// Reset attributes for table object
	function ResetAttrs() {
		$this->CssClass = "";
		$this->CssStyle = "";
    	$this->RowAttrs = array();
		foreach ($this->fields as $fld) {
			$fld->ResetAttrs();
		}
	}

	// Setup field titles
	function SetupFieldTitles() {
		foreach ($this->fields as &$fld) {
			if (strval($fld->FldTitle()) <> "") {
				$fld->EditAttrs["onmouseover"] = "ew_ShowTitle(this, '" . ew_JsEncode3($fld->FldTitle()) . "');";
				$fld->EditAttrs["onmouseout"] = "ew_HideTooltip();";
			}
		}
	}
	var $TableFilter = "";
	var $CurrentAction; // Current action
	var $LastAction; // Last action
	var $CurrentMode = ""; // Current mode
	var $UpdateConflict; // Update conflict
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message
	var $AllowAddDeleteRow = TRUE; // Allow add/delete row
	var $DetailAdd = FALSE; // Allow detail add
	var $DetailEdit = FALSE; // Allow detail edit
	var $GridAddRowCount = 5;

	// Check current action
	// - Add
	function IsAdd() {
		return $this->CurrentAction == "add";
	}

	// - Copy
	function IsCopy() {
		return $this->CurrentAction == "copy" || $this->CurrentAction == "C";
	}

	// - Edit
	function IsEdit() {
		return $this->CurrentAction == "edit";
	}

	// - Delete
	function IsDelete() {
		return $this->CurrentAction == "D";
	}

	// - Confirm
	function IsConfirm() {
		return $this->CurrentAction == "F";
	}

	// - Overwrite
	function IsOverwrite() {
		return $this->CurrentAction == "overwrite";
	}

	// - Cancel
	function IsCancel() {
		return $this->CurrentAction == "cancel";
	}

	// - Grid add
	function IsGridAdd() {
		return $this->CurrentAction == "gridadd";
	}

	// - Grid edit
	function IsGridEdit() {
		return $this->CurrentAction == "gridedit";
	}

	// - Insert
	function IsInsert() {
		return $this->CurrentAction == "insert" || $this->CurrentAction == "A";
	}

	// - Update
	function IsUpdate() {
		return $this->CurrentAction == "update" || $this->CurrentAction == "U";
	}

	// - Grid update
	function IsGridUpdate() {
		return $this->CurrentAction == "gridupdate";
	}

	// - Grid insert
	function IsGridInsert() {
		return $this->CurrentAction == "gridinsert";
	}

	// - Grid overwrite
	function IsGridOverwrite() {
		return $this->CurrentAction == "gridoverwrite";
	}

	// Check last action
	// - Cancelled
	function IsCanceled() {
		return $this->LastAction == "cancel" && $this->CurrentAction == "";
	}

	// - Inline inserted
	function IsInlineInserted() {
		return $this->LastAction == "insert" && $this->CurrentAction == "";
	}

	// - Inline updated
	function IsInlineUpdated() {
		return $this->LastAction == "update" && $this->CurrentAction == "";
	}

	// - Grid updated
	function IsGridUpdated() {
		return $this->LastAction == "gridupdate" && $this->CurrentAction == "";
	}

	// - Grid inserted
	function IsGridInserted() {
		return $this->LastAction == "gridinsert" && $this->CurrentAction == "";
	}

	//
	// Table class constructor
	//
	function cmember() {
		global $Language;
		$AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// firstname
		$this->firstname = new cField('member', 'member', 'x_firstname', 'firstname', '`firstname`', 200, -1, FALSE, '`firstname`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['firstname'] =& $this->firstname;

		// lastname
		$this->lastname = new cField('member', 'member', 'x_lastname', 'lastname', '`lastname`', 200, -1, FALSE, '`lastname`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['lastname'] =& $this->lastname;

		// source
		$this->source = new cField('member', 'member', 'x_source', 'source', '`source`', 201, -1, FALSE, '`source`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['source'] =& $this->source;

		// destination
		$this->destination = new cField('member', 'member', 'x_destination', 'destination', '`destination`', 201, -1, FALSE, '`destination`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['destination'] =& $this->destination;

		// intermediatedestination1
		$this->intermediatedestination1 = new cField('member', 'member', 'x_intermediatedestination1', 'intermediatedestination1', '`intermediatedestination1`', 201, -1, FALSE, '`intermediatedestination1`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['intermediatedestination1'] =& $this->intermediatedestination1;

		// intermediatedestination2
		$this->intermediatedestination2 = new cField('member', 'member', 'x_intermediatedestination2', 'intermediatedestination2', '`intermediatedestination2`', 201, -1, FALSE, '`intermediatedestination2`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['intermediatedestination2'] =& $this->intermediatedestination2;

		// pricepertraveler
		$this->pricepertraveler = new cField('member', 'member', 'x_pricepertraveler', 'pricepertraveler', '`pricepertraveler`', 3, -1, FALSE, '`pricepertraveler`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->pricepertraveler->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pricepertraveler'] =& $this->pricepertraveler;

		// seatsavail
		$this->seatsavail = new cField('member', 'member', 'x_seatsavail', 'seatsavail', '`seatsavail`', 3, -1, FALSE, '`seatsavail`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->seatsavail->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['seatsavail'] =& $this->seatsavail;

		// luggage
		$this->luggage = new cField('member', 'member', 'x_luggage', 'luggage', '`luggage`', 200, -1, FALSE, '`luggage`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['luggage'] =& $this->luggage;

		// leave
		$this->leave = new cField('member', 'member', 'x_leave', 'leave', '`leave`', 200, -1, FALSE, '`leave`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['leave'] =& $this->leave;

		// detour
		$this->detour = new cField('member', 'member', 'x_detour', 'detour', '`detour`', 200, -1, FALSE, '`detour`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['detour'] =& $this->detour;

		// triptype
		$this->triptype = new cField('member', 'member', 'x_triptype', 'triptype', '`triptype`', 200, -1, FALSE, '`triptype`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['triptype'] =& $this->triptype;

		// departuretime
		$this->departuretime = new cField('member', 'member', 'x_departuretime', 'departuretime', '`departuretime`', 200, -1, FALSE, '`departuretime`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['departuretime'] =& $this->departuretime;

		// departuredate
		$this->departuredate = new cField('member', 'member', 'x_departuredate', 'departuredate', '`departuredate`', 200, -1, FALSE, '`departuredate`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['departuredate'] =& $this->departuredate;

		// ac
		$this->ac = new cField('member', 'member', 'x_ac', 'ac', '`ac`', 200, -1, FALSE, '`ac`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['ac'] =& $this->ac;

		// product
		$this->product = new cField('member', 'member', 'x_product', 'product', '`product`', 200, -1, FALSE, '`product`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['product'] =& $this->product;

		// category
		$this->category = new cField('member', 'member', 'x_category', 'category', '`category`', 200, -1, FALSE, '`category`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['category'] =& $this->category;
	}

	// Get field values
	function GetFieldValues($propertyname) {
		$values = array();
		foreach ($this->fields as $fldname => $fld)
			$values[$fldname] =& $fld->$propertyname;
		return $values;
	}

	// Table caption
	function TableCaption() {
		global $Language;
		return $Language->TablePhrase($this->TableVar, "TblCaption");
	}

	// Page caption
	function PageCaption($Page) {
		global $Language;
		$Caption = $Language->TablePhrase($this->TableVar, "TblPageCaption" . $Page);
		if ($Caption == "") $Caption = "Page " . $Page;
		return $Caption;
	}

	// Export return page
	function ExportReturnUrl() {
		$url = @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL];
		return ($url <> "") ? $url : ew_CurrentPage();
	}

	function setExportReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL] = $v;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search highlight name
	function HighlightName() {
		return "member_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search keyword
	function getSessionBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setSessionBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic search type
	function getSessionBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setSessionBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search WHERE clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`member`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return ;
			case "edit":
			case "update":
				return ;
			case "delete":
				return ;
			case "view":
				return ;
			case "search":
				return ;
			default:
				return ;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `member` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `member` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `member` WHERE ";
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "memberlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "memberlist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("memberview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "memberadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		return $this->KeyUrl("memberedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		return $this->KeyUrl("memberadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("memberdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Add URL parameter
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=member" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET)) {

			//return $arKeys; // do not return yet, so the values will also be checked by the following code
		}

		// check keys
		$ar = array();
		foreach ($arKeys as $key) {
			$ar[] = $key;
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->firstname->setDbValue($rs->fields('firstname'));
		$this->lastname->setDbValue($rs->fields('lastname'));
		$this->source->setDbValue($rs->fields('source'));
		$this->destination->setDbValue($rs->fields('destination'));
		$this->intermediatedestination1->setDbValue($rs->fields('intermediatedestination1'));
		$this->intermediatedestination2->setDbValue($rs->fields('intermediatedestination2'));
		$this->pricepertraveler->setDbValue($rs->fields('pricepertraveler'));
		$this->seatsavail->setDbValue($rs->fields('seatsavail'));
		$this->luggage->setDbValue($rs->fields('luggage'));
		$this->leave->setDbValue($rs->fields('leave'));
		$this->detour->setDbValue($rs->fields('detour'));
		$this->triptype->setDbValue($rs->fields('triptype'));
		$this->departuretime->setDbValue($rs->fields('departuretime'));
		$this->departuredate->setDbValue($rs->fields('departuredate'));
		$this->ac->setDbValue($rs->fields('ac'));
		$this->product->setDbValue($rs->fields('product'));
		$this->category->setDbValue($rs->fields('category'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// firstname
		// lastname
		// source
		// destination
		// intermediatedestination1
		// intermediatedestination2
		// pricepertraveler
		// seatsavail
		// luggage
		// leave
		// detour
		// triptype
		// departuretime
		// departuredate
		// ac
		// product
		// category
		// firstname

		$this->firstname->ViewValue = $this->firstname->CurrentValue;
		$this->firstname->ViewCustomAttributes = "";

		// lastname
		$this->lastname->ViewValue = $this->lastname->CurrentValue;
		$this->lastname->ViewCustomAttributes = "";

		// source
		$this->source->ViewValue = $this->source->CurrentValue;
		$this->source->ViewCustomAttributes = "";

		// destination
		$this->destination->ViewValue = $this->destination->CurrentValue;
		$this->destination->ViewCustomAttributes = "";

		// intermediatedestination1
		$this->intermediatedestination1->ViewValue = $this->intermediatedestination1->CurrentValue;
		$this->intermediatedestination1->ViewCustomAttributes = "";

		// intermediatedestination2
		$this->intermediatedestination2->ViewValue = $this->intermediatedestination2->CurrentValue;
		$this->intermediatedestination2->ViewCustomAttributes = "";

		// pricepertraveler
		$this->pricepertraveler->ViewValue = $this->pricepertraveler->CurrentValue;
		$this->pricepertraveler->ViewCustomAttributes = "";

		// seatsavail
		$this->seatsavail->ViewValue = $this->seatsavail->CurrentValue;
		$this->seatsavail->ViewCustomAttributes = "";

		// luggage
		$this->luggage->ViewValue = $this->luggage->CurrentValue;
		$this->luggage->ViewCustomAttributes = "";

		// leave
		$this->leave->ViewValue = $this->leave->CurrentValue;
		$this->leave->ViewCustomAttributes = "";

		// detour
		$this->detour->ViewValue = $this->detour->CurrentValue;
		$this->detour->ViewCustomAttributes = "";

		// triptype
		$this->triptype->ViewValue = $this->triptype->CurrentValue;
		$this->triptype->ViewCustomAttributes = "";

		// departuretime
		$this->departuretime->ViewValue = $this->departuretime->CurrentValue;
		$this->departuretime->ViewCustomAttributes = "";

		// departuredate
		$this->departuredate->ViewValue = $this->departuredate->CurrentValue;
		$this->departuredate->ViewCustomAttributes = "";

		// ac
		$this->ac->ViewValue = $this->ac->CurrentValue;
		$this->ac->ViewCustomAttributes = "";

		// product
		$this->product->ViewValue = $this->product->CurrentValue;
		$this->product->ViewCustomAttributes = "";

		// category
		$this->category->ViewValue = $this->category->CurrentValue;
		$this->category->ViewCustomAttributes = "";

		// firstname
		$this->firstname->LinkCustomAttributes = "";
		$this->firstname->HrefValue = "";
		$this->firstname->TooltipValue = "";

		// lastname
		$this->lastname->LinkCustomAttributes = "";
		$this->lastname->HrefValue = "";
		$this->lastname->TooltipValue = "";

		// source
		$this->source->LinkCustomAttributes = "";
		$this->source->HrefValue = "";
		$this->source->TooltipValue = "";

		// destination
		$this->destination->LinkCustomAttributes = "";
		$this->destination->HrefValue = "";
		$this->destination->TooltipValue = "";

		// intermediatedestination1
		$this->intermediatedestination1->LinkCustomAttributes = "";
		$this->intermediatedestination1->HrefValue = "";
		$this->intermediatedestination1->TooltipValue = "";

		// intermediatedestination2
		$this->intermediatedestination2->LinkCustomAttributes = "";
		$this->intermediatedestination2->HrefValue = "";
		$this->intermediatedestination2->TooltipValue = "";

		// pricepertraveler
		$this->pricepertraveler->LinkCustomAttributes = "";
		$this->pricepertraveler->HrefValue = "";
		$this->pricepertraveler->TooltipValue = "";

		// seatsavail
		$this->seatsavail->LinkCustomAttributes = "";
		$this->seatsavail->HrefValue = "";
		$this->seatsavail->TooltipValue = "";

		// luggage
		$this->luggage->LinkCustomAttributes = "";
		$this->luggage->HrefValue = "";
		$this->luggage->TooltipValue = "";

		// leave
		$this->leave->LinkCustomAttributes = "";
		$this->leave->HrefValue = "";
		$this->leave->TooltipValue = "";

		// detour
		$this->detour->LinkCustomAttributes = "";
		$this->detour->HrefValue = "";
		$this->detour->TooltipValue = "";

		// triptype
		$this->triptype->LinkCustomAttributes = "";
		$this->triptype->HrefValue = "";
		$this->triptype->TooltipValue = "";

		// departuretime
		$this->departuretime->LinkCustomAttributes = "";
		$this->departuretime->HrefValue = "";
		$this->departuretime->TooltipValue = "";

		// departuredate
		$this->departuredate->LinkCustomAttributes = "";
		$this->departuredate->HrefValue = "";
		$this->departuredate->TooltipValue = "";

		// ac
		$this->ac->LinkCustomAttributes = "";
		$this->ac->HrefValue = "";
		$this->ac->TooltipValue = "";

		// product
		$this->product->LinkCustomAttributes = "";
		$this->product->HrefValue = "";
		$this->product->TooltipValue = "";

		// category
		$this->category->LinkCustomAttributes = "";
		$this->category->HrefValue = "";
		$this->category->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Export data in Xml Format
	function ExportXmlDocument(&$XmlDoc, $HasParent, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$XmlDoc)
			return;
		if (!$HasParent)
			$XmlDoc->AddRoot($this->TableVar);

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if ($HasParent)
					$XmlDoc->AddRow($this->TableVar);
				else
					$XmlDoc->AddRow();
				if ($ExportPageType == "view") {
					$XmlDoc->AddField('firstname', $this->firstname->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('lastname', $this->lastname->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('source', $this->source->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('destination', $this->destination->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('intermediatedestination1', $this->intermediatedestination1->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('intermediatedestination2', $this->intermediatedestination2->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('pricepertraveler', $this->pricepertraveler->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('seatsavail', $this->seatsavail->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('luggage', $this->luggage->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('leave', $this->leave->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('detour', $this->detour->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('triptype', $this->triptype->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('departuretime', $this->departuretime->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('departuredate', $this->departuredate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('ac', $this->ac->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('product', $this->product->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('category', $this->category->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
					$XmlDoc->AddField('firstname', $this->firstname->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('lastname', $this->lastname->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('pricepertraveler', $this->pricepertraveler->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('seatsavail', $this->seatsavail->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('luggage', $this->luggage->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('leave', $this->leave->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('detour', $this->detour->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('triptype', $this->triptype->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('departuretime', $this->departuretime->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('departuredate', $this->departuredate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('ac', $this->ac->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('product', $this->product->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('category', $this->category->ExportValue($this->Export, $this->ExportOriginalValue));
				}
			}
			$Recordset->MoveNext();
		}
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;

		// Write header
		$Doc->ExportTableHeader();
		if ($Doc->Horizontal) { // Horizontal format, write header
			if ($this->Export == "pdf") {
				$Doc->BeginExportRow(TRUE);
			} else {
				$Doc->BeginExportRow();
			}
			if ($ExportPageType == "view") {
				$Doc->ExportCaption($this->firstname);
				$Doc->ExportCaption($this->lastname);
				$Doc->ExportCaption($this->source);
				$Doc->ExportCaption($this->destination);
				$Doc->ExportCaption($this->intermediatedestination1);
				$Doc->ExportCaption($this->intermediatedestination2);
				$Doc->ExportCaption($this->pricepertraveler);
				$Doc->ExportCaption($this->seatsavail);
				$Doc->ExportCaption($this->luggage);
				$Doc->ExportCaption($this->leave);
				$Doc->ExportCaption($this->detour);
				$Doc->ExportCaption($this->triptype);
				$Doc->ExportCaption($this->departuretime);
				$Doc->ExportCaption($this->departuredate);
				$Doc->ExportCaption($this->ac);
				$Doc->ExportCaption($this->product);
				$Doc->ExportCaption($this->category);
			} else {
				$Doc->ExportCaption($this->firstname);
				$Doc->ExportCaption($this->lastname);
				$Doc->ExportCaption($this->pricepertraveler);
				$Doc->ExportCaption($this->seatsavail);
				$Doc->ExportCaption($this->luggage);
				$Doc->ExportCaption($this->leave);
				$Doc->ExportCaption($this->detour);
				$Doc->ExportCaption($this->triptype);
				$Doc->ExportCaption($this->departuretime);
				$Doc->ExportCaption($this->departuredate);
				$Doc->ExportCaption($this->ac);
				$Doc->ExportCaption($this->product);
				$Doc->ExportCaption($this->category);
			}
			if ($this->Export == "pdf") {
				$Doc->EndExportRow(TRUE);
			} else {
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break for PDF
				if ($this->Export == "pdf" && $this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				$Doc->BeginExportRow(TRUE, $RowCnt); // Allow CSS styles if enabled
				if ($ExportPageType == "view") {
					$Doc->ExportField($this->firstname);
					$Doc->ExportField($this->lastname);
					$Doc->ExportField($this->source);
					$Doc->ExportField($this->destination);
					$Doc->ExportField($this->intermediatedestination1);
					$Doc->ExportField($this->intermediatedestination2);
					$Doc->ExportField($this->pricepertraveler);
					$Doc->ExportField($this->seatsavail);
					$Doc->ExportField($this->luggage);
					$Doc->ExportField($this->leave);
					$Doc->ExportField($this->detour);
					$Doc->ExportField($this->triptype);
					$Doc->ExportField($this->departuretime);
					$Doc->ExportField($this->departuredate);
					$Doc->ExportField($this->ac);
					$Doc->ExportField($this->product);
					$Doc->ExportField($this->category);
				} else {
					$Doc->ExportField($this->firstname);
					$Doc->ExportField($this->lastname);
					$Doc->ExportField($this->pricepertraveler);
					$Doc->ExportField($this->seatsavail);
					$Doc->ExportField($this->luggage);
					$Doc->ExportField($this->leave);
					$Doc->ExportField($this->detour);
					$Doc->ExportField($this->triptype);
					$Doc->ExportField($this->departuretime);
					$Doc->ExportField($this->departuredate);
					$Doc->ExportField($this->ac);
					$Doc->ExportField($this->product);
					$Doc->ExportField($this->category);
				}
				$Doc->EndExportRow();
			}
			$Recordset->MoveNext();
		}
		$Doc->ExportTableFooter();
	}

	// Row styles
	function RowStyles() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->RowAttrs["style"] <> "")
			$sStyle .= " " . $this->RowAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->RowAttrs["class"] <> "")
			$sClass .= " " . $this->RowAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = $this->RowStyles();
		if ($this->Export == "") {
			foreach ($this->RowAttrs as $k => $v) {
				if ($k <> "class" && $k <> "style" && trim($v) <> "")
					$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
			}
		}
		return $sAtt;
	}

	// Field object by name
	function fields($fldname) {
		return $this->fields[$fldname];
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

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

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
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>
