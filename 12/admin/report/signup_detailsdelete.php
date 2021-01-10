<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "signup_detailsinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$signup_details_delete = new csignup_details_delete();
$Page =& $signup_details_delete;

// Page init
$signup_details_delete->Page_Init();

// Page main
$signup_details_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var signup_details_delete = new ew_Page("signup_details_delete");

// page properties
signup_details_delete.PageID = "delete"; // page ID
signup_details_delete.FormID = "fsignup_detailsdelete"; // form ID
var EW_PAGE_ID = signup_details_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
signup_details_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
signup_details_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
signup_details_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $signup_details_delete->ShowPageHeader(); ?>
<?php

// Load records for display
if ($signup_details_delete->Recordset = $signup_details_delete->LoadRecordset())
	$signup_details_deleteTotalRecs = $signup_details_delete->Recordset->RecordCount(); // Get record count
if ($signup_details_deleteTotalRecs <= 0) { // No record found, exit
	if ($signup_details_delete->Recordset)
		$signup_details_delete->Recordset->Close();
	$signup_details_delete->Page_Terminate("signup_detailslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $signup_details->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $signup_details->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$signup_details_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="signup_details">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($signup_details_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $signup_details->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $signup_details->reg_id->FldCaption() ?></td>
		<td valign="top"><?php echo $signup_details->firstname->FldCaption() ?></td>
		<td valign="top"><?php echo $signup_details->lastname->FldCaption() ?></td>
		<td valign="top"><?php echo $signup_details->contactno->FldCaption() ?></td>
		<td valign="top"><?php echo $signup_details->gender->FldCaption() ?></td>
		<td valign="top"><?php echo $signup_details->bio->FldCaption() ?></td>
		<td valign="top"><?php echo $signup_details->date->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$signup_details_delete->RecCnt = 0;
$i = 0;
while (!$signup_details_delete->Recordset->EOF) {
	$signup_details_delete->RecCnt++;

	// Set row properties
	$signup_details->ResetAttrs();
	$signup_details->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$signup_details_delete->LoadRowValues($signup_details_delete->Recordset);

	// Render row
	$signup_details_delete->RenderRow();
?>
	<tr<?php echo $signup_details->RowAttributes() ?>>
		<td<?php echo $signup_details->reg_id->CellAttributes() ?>>
<div<?php echo $signup_details->reg_id->ViewAttributes() ?>><?php echo $signup_details->reg_id->ListViewValue() ?></div></td>
		<td<?php echo $signup_details->firstname->CellAttributes() ?>>
<div<?php echo $signup_details->firstname->ViewAttributes() ?>><?php echo $signup_details->firstname->ListViewValue() ?></div></td>
		<td<?php echo $signup_details->lastname->CellAttributes() ?>>
<div<?php echo $signup_details->lastname->ViewAttributes() ?>><?php echo $signup_details->lastname->ListViewValue() ?></div></td>
		<td<?php echo $signup_details->contactno->CellAttributes() ?>>
<div<?php echo $signup_details->contactno->ViewAttributes() ?>><?php echo $signup_details->contactno->ListViewValue() ?></div></td>
		<td<?php echo $signup_details->gender->CellAttributes() ?>>
<div<?php echo $signup_details->gender->ViewAttributes() ?>><?php echo $signup_details->gender->ListViewValue() ?></div></td>
		<td<?php echo $signup_details->bio->CellAttributes() ?>>
<div<?php echo $signup_details->bio->ViewAttributes() ?>><?php echo $signup_details->bio->ListViewValue() ?></div></td>
		<td<?php echo $signup_details->date->CellAttributes() ?>>
<div<?php echo $signup_details->date->ViewAttributes() ?>><?php echo $signup_details->date->ListViewValue() ?></div></td>
	</tr>
<?php
	$signup_details_delete->Recordset->MoveNext();
}
$signup_details_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$signup_details_delete->ShowPageFooter();
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
$signup_details_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class csignup_details_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'signup_details';

	// Page object name
	var $PageObjName = 'signup_details_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $signup_details;
		if ($signup_details->UseTokenInUrl) $PageUrl .= "t=" . $signup_details->TableVar . "&"; // Add page token
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
		global $objForm, $signup_details;
		if ($signup_details->UseTokenInUrl) {
			if ($objForm)
				return ($signup_details->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($signup_details->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csignup_details_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (signup_details)
		if (!isset($GLOBALS["signup_details"])) {
			$GLOBALS["signup_details"] = new csignup_details();
			$GLOBALS["Table"] =& $GLOBALS["signup_details"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'signup_details', TRUE);

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
		global $signup_details;

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
		global $Language, $signup_details;

		// Load key parameters
		$this->RecKeys = $signup_details->GetRecordKeys(); // Load record keys
		$sFilter = $signup_details->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("signup_detailslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in signup_details class, signup_detailsinfo.php

		$signup_details->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$signup_details->CurrentAction = $_POST["a_delete"];
		} else {
			$signup_details->CurrentAction = "I"; // Display record
		}
		switch ($signup_details->CurrentAction) {
			case "D": // Delete
				$signup_details->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($signup_details->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $signup_details;

		// Call Recordset Selecting event
		$signup_details->Recordset_Selecting($signup_details->CurrentFilter);

		// Load List page SQL
		$sSql = $signup_details->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$signup_details->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $signup_details;
		$sFilter = $signup_details->KeyFilter();

		// Call Row Selecting event
		$signup_details->Row_Selecting($sFilter);

		// Load SQL based on filter
		$signup_details->CurrentFilter = $sFilter;
		$sSql = $signup_details->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$signup_details->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $signup_details;
		if (!$rs || $rs->EOF) return;
		$signup_details->reg_id->setDbValue($rs->fields('reg_id'));
		$signup_details->firstname->setDbValue($rs->fields('firstname'));
		$signup_details->lastname->setDbValue($rs->fields('lastname'));
		$signup_details->contactno->setDbValue($rs->fields('contactno'));
		$signup_details->gender->setDbValue($rs->fields('gender'));
		$signup_details->bio->setDbValue($rs->fields('bio'));
		$signup_details->date->setDbValue($rs->fields('date'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $signup_details;

		// Initialize URLs
		// Call Row_Rendering event

		$signup_details->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// firstname
		// lastname
		// contactno
		// gender
		// bio
		// date

		if ($signup_details->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$signup_details->reg_id->ViewValue = $signup_details->reg_id->CurrentValue;
			$signup_details->reg_id->ViewCustomAttributes = "";

			// firstname
			$signup_details->firstname->ViewValue = $signup_details->firstname->CurrentValue;
			$signup_details->firstname->ViewCustomAttributes = "";

			// lastname
			$signup_details->lastname->ViewValue = $signup_details->lastname->CurrentValue;
			$signup_details->lastname->ViewCustomAttributes = "";

			// contactno
			$signup_details->contactno->ViewValue = $signup_details->contactno->CurrentValue;
			$signup_details->contactno->ViewCustomAttributes = "";

			// gender
			$signup_details->gender->ViewValue = $signup_details->gender->CurrentValue;
			$signup_details->gender->ViewCustomAttributes = "";

			// bio
			$signup_details->bio->ViewValue = $signup_details->bio->CurrentValue;
			$signup_details->bio->ViewCustomAttributes = "";

			// date
			$signup_details->date->ViewValue = $signup_details->date->CurrentValue;
			$signup_details->date->ViewCustomAttributes = "";

			// reg_id
			$signup_details->reg_id->LinkCustomAttributes = "";
			$signup_details->reg_id->HrefValue = "";
			$signup_details->reg_id->TooltipValue = "";

			// firstname
			$signup_details->firstname->LinkCustomAttributes = "";
			$signup_details->firstname->HrefValue = "";
			$signup_details->firstname->TooltipValue = "";

			// lastname
			$signup_details->lastname->LinkCustomAttributes = "";
			$signup_details->lastname->HrefValue = "";
			$signup_details->lastname->TooltipValue = "";

			// contactno
			$signup_details->contactno->LinkCustomAttributes = "";
			$signup_details->contactno->HrefValue = "";
			$signup_details->contactno->TooltipValue = "";

			// gender
			$signup_details->gender->LinkCustomAttributes = "";
			$signup_details->gender->HrefValue = "";
			$signup_details->gender->TooltipValue = "";

			// bio
			$signup_details->bio->LinkCustomAttributes = "";
			$signup_details->bio->HrefValue = "";
			$signup_details->bio->TooltipValue = "";

			// date
			$signup_details->date->LinkCustomAttributes = "";
			$signup_details->date->HrefValue = "";
			$signup_details->date->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($signup_details->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$signup_details->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $signup_details;
		$DeleteRows = TRUE;
		$sSql = $signup_details->SQL();
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
				$DeleteRows = $signup_details->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['contactno'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($signup_details->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($signup_details->CancelMessage <> "") {
				$this->setFailureMessage($signup_details->CancelMessage);
				$signup_details->CancelMessage = "";
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
				$signup_details->Row_Deleted($row);
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
