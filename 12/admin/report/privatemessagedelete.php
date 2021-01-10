<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "privatemessageinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$privatemessage_delete = new cprivatemessage_delete();
$Page =& $privatemessage_delete;

// Page init
$privatemessage_delete->Page_Init();

// Page main
$privatemessage_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var privatemessage_delete = new ew_Page("privatemessage_delete");

// page properties
privatemessage_delete.PageID = "delete"; // page ID
privatemessage_delete.FormID = "fprivatemessagedelete"; // form ID
var EW_PAGE_ID = privatemessage_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
privatemessage_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
privatemessage_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
privatemessage_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $privatemessage_delete->ShowPageHeader(); ?>
<?php

// Load records for display
if ($privatemessage_delete->Recordset = $privatemessage_delete->LoadRecordset())
	$privatemessage_deleteTotalRecs = $privatemessage_delete->Recordset->RecordCount(); // Get record count
if ($privatemessage_deleteTotalRecs <= 0) { // No record found, exit
	if ($privatemessage_delete->Recordset)
		$privatemessage_delete->Recordset->Close();
	$privatemessage_delete->Page_Terminate("privatemessagelist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $privatemessage->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $privatemessage->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$privatemessage_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="privatemessage">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($privatemessage_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $privatemessage->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $privatemessage->messageid->FldCaption() ?></td>
		<td valign="top"><?php echo $privatemessage->senderid->FldCaption() ?></td>
		<td valign="top"><?php echo $privatemessage->receiverid->FldCaption() ?></td>
		<td valign="top"><?php echo $privatemessage->counter->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$privatemessage_delete->RecCnt = 0;
$i = 0;
while (!$privatemessage_delete->Recordset->EOF) {
	$privatemessage_delete->RecCnt++;

	// Set row properties
	$privatemessage->ResetAttrs();
	$privatemessage->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$privatemessage_delete->LoadRowValues($privatemessage_delete->Recordset);

	// Render row
	$privatemessage_delete->RenderRow();
?>
	<tr<?php echo $privatemessage->RowAttributes() ?>>
		<td<?php echo $privatemessage->messageid->CellAttributes() ?>>
<div<?php echo $privatemessage->messageid->ViewAttributes() ?>><?php echo $privatemessage->messageid->ListViewValue() ?></div></td>
		<td<?php echo $privatemessage->senderid->CellAttributes() ?>>
<div<?php echo $privatemessage->senderid->ViewAttributes() ?>><?php echo $privatemessage->senderid->ListViewValue() ?></div></td>
		<td<?php echo $privatemessage->receiverid->CellAttributes() ?>>
<div<?php echo $privatemessage->receiverid->ViewAttributes() ?>><?php echo $privatemessage->receiverid->ListViewValue() ?></div></td>
		<td<?php echo $privatemessage->counter->CellAttributes() ?>>
<div<?php echo $privatemessage->counter->ViewAttributes() ?>><?php echo $privatemessage->counter->ListViewValue() ?></div></td>
	</tr>
<?php
	$privatemessage_delete->Recordset->MoveNext();
}
$privatemessage_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$privatemessage_delete->ShowPageFooter();
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
$privatemessage_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cprivatemessage_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'privatemessage';

	// Page object name
	var $PageObjName = 'privatemessage_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $privatemessage;
		if ($privatemessage->UseTokenInUrl) $PageUrl .= "t=" . $privatemessage->TableVar . "&"; // Add page token
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
		global $objForm, $privatemessage;
		if ($privatemessage->UseTokenInUrl) {
			if ($objForm)
				return ($privatemessage->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($privatemessage->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cprivatemessage_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (privatemessage)
		if (!isset($GLOBALS["privatemessage"])) {
			$GLOBALS["privatemessage"] = new cprivatemessage();
			$GLOBALS["Table"] =& $GLOBALS["privatemessage"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'privatemessage', TRUE);

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
		global $privatemessage;

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
		global $Language, $privatemessage;

		// Load key parameters
		$this->RecKeys = $privatemessage->GetRecordKeys(); // Load record keys
		$sFilter = $privatemessage->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("privatemessagelist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in privatemessage class, privatemessageinfo.php

		$privatemessage->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$privatemessage->CurrentAction = $_POST["a_delete"];
		} else {
			$privatemessage->CurrentAction = "I"; // Display record
		}
		switch ($privatemessage->CurrentAction) {
			case "D": // Delete
				$privatemessage->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($privatemessage->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $privatemessage;

		// Call Recordset Selecting event
		$privatemessage->Recordset_Selecting($privatemessage->CurrentFilter);

		// Load List page SQL
		$sSql = $privatemessage->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$privatemessage->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $privatemessage;
		$sFilter = $privatemessage->KeyFilter();

		// Call Row Selecting event
		$privatemessage->Row_Selecting($sFilter);

		// Load SQL based on filter
		$privatemessage->CurrentFilter = $sFilter;
		$sSql = $privatemessage->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$privatemessage->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $privatemessage;
		if (!$rs || $rs->EOF) return;
		$privatemessage->messageid->setDbValue($rs->fields('messageid'));
		$privatemessage->senderid->setDbValue($rs->fields('senderid'));
		$privatemessage->receiverid->setDbValue($rs->fields('receiverid'));
		$privatemessage->message->setDbValue($rs->fields('message'));
		$privatemessage->counter->setDbValue($rs->fields('counter'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $privatemessage;

		// Initialize URLs
		// Call Row_Rendering event

		$privatemessage->Row_Rendering();

		// Common render codes for all row types
		// messageid
		// senderid
		// receiverid
		// message
		// counter

		if ($privatemessage->RowType == EW_ROWTYPE_VIEW) { // View row

			// messageid
			$privatemessage->messageid->ViewValue = $privatemessage->messageid->CurrentValue;
			$privatemessage->messageid->ViewCustomAttributes = "";

			// senderid
			$privatemessage->senderid->ViewValue = $privatemessage->senderid->CurrentValue;
			$privatemessage->senderid->ViewCustomAttributes = "";

			// receiverid
			$privatemessage->receiverid->ViewValue = $privatemessage->receiverid->CurrentValue;
			$privatemessage->receiverid->ViewCustomAttributes = "";

			// counter
			$privatemessage->counter->ViewValue = $privatemessage->counter->CurrentValue;
			$privatemessage->counter->ViewCustomAttributes = "";

			// messageid
			$privatemessage->messageid->LinkCustomAttributes = "";
			$privatemessage->messageid->HrefValue = "";
			$privatemessage->messageid->TooltipValue = "";

			// senderid
			$privatemessage->senderid->LinkCustomAttributes = "";
			$privatemessage->senderid->HrefValue = "";
			$privatemessage->senderid->TooltipValue = "";

			// receiverid
			$privatemessage->receiverid->LinkCustomAttributes = "";
			$privatemessage->receiverid->HrefValue = "";
			$privatemessage->receiverid->TooltipValue = "";

			// counter
			$privatemessage->counter->LinkCustomAttributes = "";
			$privatemessage->counter->HrefValue = "";
			$privatemessage->counter->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($privatemessage->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$privatemessage->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $privatemessage;
		$DeleteRows = TRUE;
		$sSql = $privatemessage->SQL();
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
				$DeleteRows = $privatemessage->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['messageid'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($privatemessage->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($privatemessage->CancelMessage <> "") {
				$this->setFailureMessage($privatemessage->CancelMessage);
				$privatemessage->CancelMessage = "";
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
				$privatemessage->Row_Deleted($row);
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
