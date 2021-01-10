<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "membertravellingdetailsinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$membertravellingdetails_delete = new cmembertravellingdetails_delete();
$Page =& $membertravellingdetails_delete;

// Page init
$membertravellingdetails_delete->Page_Init();

// Page main
$membertravellingdetails_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var membertravellingdetails_delete = new ew_Page("membertravellingdetails_delete");

// page properties
membertravellingdetails_delete.PageID = "delete"; // page ID
membertravellingdetails_delete.FormID = "fmembertravellingdetailsdelete"; // form ID
var EW_PAGE_ID = membertravellingdetails_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
membertravellingdetails_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
membertravellingdetails_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
membertravellingdetails_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $membertravellingdetails_delete->ShowPageHeader(); ?>
<?php

// Load records for display
if ($membertravellingdetails_delete->Recordset = $membertravellingdetails_delete->LoadRecordset())
	$membertravellingdetails_deleteTotalRecs = $membertravellingdetails_delete->Recordset->RecordCount(); // Get record count
if ($membertravellingdetails_deleteTotalRecs <= 0) { // No record found, exit
	if ($membertravellingdetails_delete->Recordset)
		$membertravellingdetails_delete->Recordset->Close();
	$membertravellingdetails_delete->Page_Terminate("membertravellingdetailslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $membertravellingdetails->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $membertravellingdetails->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$membertravellingdetails_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="membertravellingdetails">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($membertravellingdetails_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $membertravellingdetails->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $membertravellingdetails->reg_id->FldCaption() ?></td>
		<td valign="top"><?php echo $membertravellingdetails->mid->FldCaption() ?></td>
		<td valign="top"><?php echo $membertravellingdetails->pricepertraveler->FldCaption() ?></td>
		<td valign="top"><?php echo $membertravellingdetails->seatsavail->FldCaption() ?></td>
		<td valign="top"><?php echo $membertravellingdetails->luggage->FldCaption() ?></td>
		<td valign="top"><?php echo $membertravellingdetails->leave->FldCaption() ?></td>
		<td valign="top"><?php echo $membertravellingdetails->detour->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$membertravellingdetails_delete->RecCnt = 0;
$i = 0;
while (!$membertravellingdetails_delete->Recordset->EOF) {
	$membertravellingdetails_delete->RecCnt++;

	// Set row properties
	$membertravellingdetails->ResetAttrs();
	$membertravellingdetails->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$membertravellingdetails_delete->LoadRowValues($membertravellingdetails_delete->Recordset);

	// Render row
	$membertravellingdetails_delete->RenderRow();
?>
	<tr<?php echo $membertravellingdetails->RowAttributes() ?>>
		<td<?php echo $membertravellingdetails->reg_id->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->reg_id->ViewAttributes() ?>><?php echo $membertravellingdetails->reg_id->ListViewValue() ?></div></td>
		<td<?php echo $membertravellingdetails->mid->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->mid->ViewAttributes() ?>><?php echo $membertravellingdetails->mid->ListViewValue() ?></div></td>
		<td<?php echo $membertravellingdetails->pricepertraveler->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->pricepertraveler->ViewAttributes() ?>><?php echo $membertravellingdetails->pricepertraveler->ListViewValue() ?></div></td>
		<td<?php echo $membertravellingdetails->seatsavail->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->seatsavail->ViewAttributes() ?>><?php echo $membertravellingdetails->seatsavail->ListViewValue() ?></div></td>
		<td<?php echo $membertravellingdetails->luggage->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->luggage->ViewAttributes() ?>><?php echo $membertravellingdetails->luggage->ListViewValue() ?></div></td>
		<td<?php echo $membertravellingdetails->leave->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->leave->ViewAttributes() ?>><?php echo $membertravellingdetails->leave->ListViewValue() ?></div></td>
		<td<?php echo $membertravellingdetails->detour->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->detour->ViewAttributes() ?>><?php echo $membertravellingdetails->detour->ListViewValue() ?></div></td>
	</tr>
<?php
	$membertravellingdetails_delete->Recordset->MoveNext();
}
$membertravellingdetails_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$membertravellingdetails_delete->ShowPageFooter();
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
$membertravellingdetails_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cmembertravellingdetails_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'membertravellingdetails';

	// Page object name
	var $PageObjName = 'membertravellingdetails_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $membertravellingdetails;
		if ($membertravellingdetails->UseTokenInUrl) $PageUrl .= "t=" . $membertravellingdetails->TableVar . "&"; // Add page token
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
		global $objForm, $membertravellingdetails;
		if ($membertravellingdetails->UseTokenInUrl) {
			if ($objForm)
				return ($membertravellingdetails->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($membertravellingdetails->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmembertravellingdetails_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (membertravellingdetails)
		if (!isset($GLOBALS["membertravellingdetails"])) {
			$GLOBALS["membertravellingdetails"] = new cmembertravellingdetails();
			$GLOBALS["Table"] =& $GLOBALS["membertravellingdetails"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'membertravellingdetails', TRUE);

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
		global $membertravellingdetails;

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
		global $Language, $membertravellingdetails;

		// Load key parameters
		$this->RecKeys = $membertravellingdetails->GetRecordKeys(); // Load record keys
		$sFilter = $membertravellingdetails->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("membertravellingdetailslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in membertravellingdetails class, membertravellingdetailsinfo.php

		$membertravellingdetails->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$membertravellingdetails->CurrentAction = $_POST["a_delete"];
		} else {
			$membertravellingdetails->CurrentAction = "I"; // Display record
		}
		switch ($membertravellingdetails->CurrentAction) {
			case "D": // Delete
				$membertravellingdetails->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($membertravellingdetails->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $membertravellingdetails;

		// Call Recordset Selecting event
		$membertravellingdetails->Recordset_Selecting($membertravellingdetails->CurrentFilter);

		// Load List page SQL
		$sSql = $membertravellingdetails->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$membertravellingdetails->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $membertravellingdetails;
		$sFilter = $membertravellingdetails->KeyFilter();

		// Call Row Selecting event
		$membertravellingdetails->Row_Selecting($sFilter);

		// Load SQL based on filter
		$membertravellingdetails->CurrentFilter = $sFilter;
		$sSql = $membertravellingdetails->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$membertravellingdetails->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $membertravellingdetails;
		if (!$rs || $rs->EOF) return;
		$membertravellingdetails->reg_id->setDbValue($rs->fields('reg_id'));
		$membertravellingdetails->mid->setDbValue($rs->fields('mid'));
		$membertravellingdetails->pricepertraveler->setDbValue($rs->fields('pricepertraveler'));
		$membertravellingdetails->seatsavail->setDbValue($rs->fields('seatsavail'));
		$membertravellingdetails->luggage->setDbValue($rs->fields('luggage'));
		$membertravellingdetails->leave->setDbValue($rs->fields('leave'));
		$membertravellingdetails->detour->setDbValue($rs->fields('detour'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $membertravellingdetails;

		// Initialize URLs
		// Call Row_Rendering event

		$membertravellingdetails->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// mid
		// pricepertraveler
		// seatsavail
		// luggage
		// leave
		// detour

		if ($membertravellingdetails->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$membertravellingdetails->reg_id->ViewValue = $membertravellingdetails->reg_id->CurrentValue;
			$membertravellingdetails->reg_id->ViewCustomAttributes = "";

			// mid
			$membertravellingdetails->mid->ViewValue = $membertravellingdetails->mid->CurrentValue;
			$membertravellingdetails->mid->ViewCustomAttributes = "";

			// pricepertraveler
			$membertravellingdetails->pricepertraveler->ViewValue = $membertravellingdetails->pricepertraveler->CurrentValue;
			$membertravellingdetails->pricepertraveler->ViewCustomAttributes = "";

			// seatsavail
			$membertravellingdetails->seatsavail->ViewValue = $membertravellingdetails->seatsavail->CurrentValue;
			$membertravellingdetails->seatsavail->ViewCustomAttributes = "";

			// luggage
			$membertravellingdetails->luggage->ViewValue = $membertravellingdetails->luggage->CurrentValue;
			$membertravellingdetails->luggage->ViewCustomAttributes = "";

			// leave
			$membertravellingdetails->leave->ViewValue = $membertravellingdetails->leave->CurrentValue;
			$membertravellingdetails->leave->ViewCustomAttributes = "";

			// detour
			$membertravellingdetails->detour->ViewValue = $membertravellingdetails->detour->CurrentValue;
			$membertravellingdetails->detour->ViewCustomAttributes = "";

			// reg_id
			$membertravellingdetails->reg_id->LinkCustomAttributes = "";
			$membertravellingdetails->reg_id->HrefValue = "";
			$membertravellingdetails->reg_id->TooltipValue = "";

			// mid
			$membertravellingdetails->mid->LinkCustomAttributes = "";
			$membertravellingdetails->mid->HrefValue = "";
			$membertravellingdetails->mid->TooltipValue = "";

			// pricepertraveler
			$membertravellingdetails->pricepertraveler->LinkCustomAttributes = "";
			$membertravellingdetails->pricepertraveler->HrefValue = "";
			$membertravellingdetails->pricepertraveler->TooltipValue = "";

			// seatsavail
			$membertravellingdetails->seatsavail->LinkCustomAttributes = "";
			$membertravellingdetails->seatsavail->HrefValue = "";
			$membertravellingdetails->seatsavail->TooltipValue = "";

			// luggage
			$membertravellingdetails->luggage->LinkCustomAttributes = "";
			$membertravellingdetails->luggage->HrefValue = "";
			$membertravellingdetails->luggage->TooltipValue = "";

			// leave
			$membertravellingdetails->leave->LinkCustomAttributes = "";
			$membertravellingdetails->leave->HrefValue = "";
			$membertravellingdetails->leave->TooltipValue = "";

			// detour
			$membertravellingdetails->detour->LinkCustomAttributes = "";
			$membertravellingdetails->detour->HrefValue = "";
			$membertravellingdetails->detour->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($membertravellingdetails->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$membertravellingdetails->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $membertravellingdetails;
		$DeleteRows = TRUE;
		$sSql = $membertravellingdetails->SQL();
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
				$DeleteRows = $membertravellingdetails->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['mid'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($membertravellingdetails->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($membertravellingdetails->CancelMessage <> "") {
				$this->setFailureMessage($membertravellingdetails->CancelMessage);
				$membertravellingdetails->CancelMessage = "";
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
				$membertravellingdetails->Row_Deleted($row);
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
