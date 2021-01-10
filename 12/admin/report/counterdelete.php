<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "counterinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$counter_delete = new ccounter_delete();
$Page =& $counter_delete;

// Page init
$counter_delete->Page_Init();

// Page main
$counter_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var counter_delete = new ew_Page("counter_delete");

// page properties
counter_delete.PageID = "delete"; // page ID
counter_delete.FormID = "fcounterdelete"; // form ID
var EW_PAGE_ID = counter_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
counter_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
counter_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
counter_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $counter_delete->ShowPageHeader(); ?>
<?php

// Load records for display
if ($counter_delete->Recordset = $counter_delete->LoadRecordset())
	$counter_deleteTotalRecs = $counter_delete->Recordset->RecordCount(); // Get record count
if ($counter_deleteTotalRecs <= 0) { // No record found, exit
	if ($counter_delete->Recordset)
		$counter_delete->Recordset->Close();
	$counter_delete->Page_Terminate("counterlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $counter->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $counter->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$counter_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="counter">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($counter_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $counter->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $counter->cnid->FldCaption() ?></td>
		<td valign="top"><?php echo $counter->reg_id->FldCaption() ?></td>
		<td valign="top"><?php echo $counter->counter_1->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$counter_delete->RecCnt = 0;
$i = 0;
while (!$counter_delete->Recordset->EOF) {
	$counter_delete->RecCnt++;

	// Set row properties
	$counter->ResetAttrs();
	$counter->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$counter_delete->LoadRowValues($counter_delete->Recordset);

	// Render row
	$counter_delete->RenderRow();
?>
	<tr<?php echo $counter->RowAttributes() ?>>
		<td<?php echo $counter->cnid->CellAttributes() ?>>
<div<?php echo $counter->cnid->ViewAttributes() ?>><?php echo $counter->cnid->ListViewValue() ?></div></td>
		<td<?php echo $counter->reg_id->CellAttributes() ?>>
<div<?php echo $counter->reg_id->ViewAttributes() ?>><?php echo $counter->reg_id->ListViewValue() ?></div></td>
		<td<?php echo $counter->counter_1->CellAttributes() ?>>
<div<?php echo $counter->counter_1->ViewAttributes() ?>><?php echo $counter->counter_1->ListViewValue() ?></div></td>
	</tr>
<?php
	$counter_delete->Recordset->MoveNext();
}
$counter_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$counter_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include_once "footer.php" ?>
<?php
$counter_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ccounter_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'counter';

	// Page object name
	var $PageObjName = 'counter_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $counter;
		if ($counter->UseTokenInUrl) $PageUrl .= "t=" . $counter->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p class=\"phpmaker\">" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p class=\"phpmaker\">" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $counter;
		if ($counter->UseTokenInUrl) {
			if ($objForm)
				return ($counter->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($counter->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccounter_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (counter)
		if (!isset($GLOBALS["counter"])) {
			$GLOBALS["counter"] = new ccounter();
			$GLOBALS["Table"] =& $GLOBALS["counter"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'counter', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $counter;

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $counter;

		// Load key parameters
		$this->RecKeys = $counter->GetRecordKeys(); // Load record keys
		$sFilter = $counter->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("counterlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in counter class, counterinfo.php

		$counter->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$counter->CurrentAction = $_POST["a_delete"];
		} else {
			$counter->CurrentAction = "I"; // Display record
		}
		switch ($counter->CurrentAction) {
			case "D": // Delete
				$counter->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($counter->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $counter;

		// Call Recordset Selecting event
		$counter->Recordset_Selecting($counter->CurrentFilter);

		// Load List page SQL
		$sSql = $counter->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$counter->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $counter;
		$sFilter = $counter->KeyFilter();

		// Call Row Selecting event
		$counter->Row_Selecting($sFilter);

		// Load SQL based on filter
		$counter->CurrentFilter = $sFilter;
		$sSql = $counter->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$counter->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $counter;
		if (!$rs || $rs->EOF) return;
		$counter->cnid->setDbValue($rs->fields('cnid'));
		$counter->reg_id->setDbValue($rs->fields('reg_id'));
		$counter->counter_1->setDbValue($rs->fields('counter'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $counter;

		// Initialize URLs
		// Call Row_Rendering event

		$counter->Row_Rendering();

		// Common render codes for all row types
		// cnid
		// reg_id
		// counter

		if ($counter->RowType == EW_ROWTYPE_VIEW) { // View row

			// cnid
			$counter->cnid->ViewValue = $counter->cnid->CurrentValue;
			$counter->cnid->ViewCustomAttributes = "";

			// reg_id
			$counter->reg_id->ViewValue = $counter->reg_id->CurrentValue;
			$counter->reg_id->ViewCustomAttributes = "";

			// counter
			$counter->counter_1->ViewValue = $counter->counter_1->CurrentValue;
			$counter->counter_1->ViewCustomAttributes = "";

			// cnid
			$counter->cnid->LinkCustomAttributes = "";
			$counter->cnid->HrefValue = "";
			$counter->cnid->TooltipValue = "";

			// reg_id
			$counter->reg_id->LinkCustomAttributes = "";
			$counter->reg_id->HrefValue = "";
			$counter->reg_id->TooltipValue = "";

			// counter
			$counter->counter_1->LinkCustomAttributes = "";
			$counter->counter_1->HrefValue = "";
			$counter->counter_1->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($counter->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$counter->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $counter;
		$DeleteRows = TRUE;
		$sSql = $counter->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $counter->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['cnid'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($counter->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($counter->CancelMessage <> "") {
				$this->setFailureMessage($counter->CancelMessage);
				$counter->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$counter->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

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
}
?>
