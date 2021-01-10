<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "logincountinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$logincount_delete = new clogincount_delete();
$Page =& $logincount_delete;

// Page init
$logincount_delete->Page_Init();

// Page main
$logincount_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var logincount_delete = new ew_Page("logincount_delete");

// page properties
logincount_delete.PageID = "delete"; // page ID
logincount_delete.FormID = "flogincountdelete"; // form ID
var EW_PAGE_ID = logincount_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
logincount_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
logincount_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logincount_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $logincount_delete->ShowPageHeader(); ?>
<?php

// Load records for display
if ($logincount_delete->Recordset = $logincount_delete->LoadRecordset())
	$logincount_deleteTotalRecs = $logincount_delete->Recordset->RecordCount(); // Get record count
if ($logincount_deleteTotalRecs <= 0) { // No record found, exit
	if ($logincount_delete->Recordset)
		$logincount_delete->Recordset->Close();
	$logincount_delete->Page_Terminate("logincountlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $logincount->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $logincount->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$logincount_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="logincount">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($logincount_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $logincount->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $logincount->dt_id->FldCaption() ?></td>
		<td valign="top"><?php echo $logincount->reg_id->FldCaption() ?></td>
		<td valign="top"><?php echo $logincount->logincounter->FldCaption() ?></td>
		<td valign="top"><?php echo $logincount->date->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$logincount_delete->RecCnt = 0;
$i = 0;
while (!$logincount_delete->Recordset->EOF) {
	$logincount_delete->RecCnt++;

	// Set row properties
	$logincount->ResetAttrs();
	$logincount->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$logincount_delete->LoadRowValues($logincount_delete->Recordset);

	// Render row
	$logincount_delete->RenderRow();
?>
	<tr<?php echo $logincount->RowAttributes() ?>>
		<td<?php echo $logincount->dt_id->CellAttributes() ?>>
<div<?php echo $logincount->dt_id->ViewAttributes() ?>><?php echo $logincount->dt_id->ListViewValue() ?></div></td>
		<td<?php echo $logincount->reg_id->CellAttributes() ?>>
<div<?php echo $logincount->reg_id->ViewAttributes() ?>><?php echo $logincount->reg_id->ListViewValue() ?></div></td>
		<td<?php echo $logincount->logincounter->CellAttributes() ?>>
<div<?php echo $logincount->logincounter->ViewAttributes() ?>><?php echo $logincount->logincounter->ListViewValue() ?></div></td>
		<td<?php echo $logincount->date->CellAttributes() ?>>
<div<?php echo $logincount->date->ViewAttributes() ?>><?php echo $logincount->date->ListViewValue() ?></div></td>
	</tr>
<?php
	$logincount_delete->Recordset->MoveNext();
}
$logincount_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$logincount_delete->ShowPageFooter();
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
$logincount_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class clogincount_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'logincount';

	// Page object name
	var $PageObjName = 'logincount_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $logincount;
		if ($logincount->UseTokenInUrl) $PageUrl .= "t=" . $logincount->TableVar . "&"; // Add page token
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
		global $objForm, $logincount;
		if ($logincount->UseTokenInUrl) {
			if ($objForm)
				return ($logincount->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($logincount->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function clogincount_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (logincount)
		if (!isset($GLOBALS["logincount"])) {
			$GLOBALS["logincount"] = new clogincount();
			$GLOBALS["Table"] =& $GLOBALS["logincount"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'logincount', TRUE);

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
		global $logincount;

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
		global $Language, $logincount;

		// Load key parameters
		$this->RecKeys = $logincount->GetRecordKeys(); // Load record keys
		$sFilter = $logincount->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("logincountlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in logincount class, logincountinfo.php

		$logincount->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$logincount->CurrentAction = $_POST["a_delete"];
		} else {
			$logincount->CurrentAction = "I"; // Display record
		}
		switch ($logincount->CurrentAction) {
			case "D": // Delete
				$logincount->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($logincount->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $logincount;

		// Call Recordset Selecting event
		$logincount->Recordset_Selecting($logincount->CurrentFilter);

		// Load List page SQL
		$sSql = $logincount->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$logincount->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $logincount;
		$sFilter = $logincount->KeyFilter();

		// Call Row Selecting event
		$logincount->Row_Selecting($sFilter);

		// Load SQL based on filter
		$logincount->CurrentFilter = $sFilter;
		$sSql = $logincount->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$logincount->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $logincount;
		if (!$rs || $rs->EOF) return;
		$logincount->dt_id->setDbValue($rs->fields('dt_id'));
		$logincount->reg_id->setDbValue($rs->fields('reg_id'));
		$logincount->logincounter->setDbValue($rs->fields('logincounter'));
		$logincount->date->setDbValue($rs->fields('date'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $logincount;

		// Initialize URLs
		// Call Row_Rendering event

		$logincount->Row_Rendering();

		// Common render codes for all row types
		// dt_id
		// reg_id
		// logincounter
		// date

		if ($logincount->RowType == EW_ROWTYPE_VIEW) { // View row

			// dt_id
			$logincount->dt_id->ViewValue = $logincount->dt_id->CurrentValue;
			$logincount->dt_id->ViewCustomAttributes = "";

			// reg_id
			$logincount->reg_id->ViewValue = $logincount->reg_id->CurrentValue;
			$logincount->reg_id->ViewCustomAttributes = "";

			// logincounter
			$logincount->logincounter->ViewValue = $logincount->logincounter->CurrentValue;
			$logincount->logincounter->ViewCustomAttributes = "";

			// date
			$logincount->date->ViewValue = $logincount->date->CurrentValue;
			$logincount->date->ViewCustomAttributes = "";

			// dt_id
			$logincount->dt_id->LinkCustomAttributes = "";
			$logincount->dt_id->HrefValue = "";
			$logincount->dt_id->TooltipValue = "";

			// reg_id
			$logincount->reg_id->LinkCustomAttributes = "";
			$logincount->reg_id->HrefValue = "";
			$logincount->reg_id->TooltipValue = "";

			// logincounter
			$logincount->logincounter->LinkCustomAttributes = "";
			$logincount->logincounter->HrefValue = "";
			$logincount->logincounter->TooltipValue = "";

			// date
			$logincount->date->LinkCustomAttributes = "";
			$logincount->date->HrefValue = "";
			$logincount->date->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($logincount->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$logincount->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $logincount;
		$DeleteRows = TRUE;
		$sSql = $logincount->SQL();
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
				$DeleteRows = $logincount->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['dt_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($logincount->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($logincount->CancelMessage <> "") {
				$this->setFailureMessage($logincount->CancelMessage);
				$logincount->CancelMessage = "";
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
				$logincount->Row_Deleted($row);
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
