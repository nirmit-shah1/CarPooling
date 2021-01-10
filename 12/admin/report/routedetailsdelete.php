<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "routedetailsinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$routedetails_delete = new croutedetails_delete();
$Page =& $routedetails_delete;

// Page init
$routedetails_delete->Page_Init();

// Page main
$routedetails_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var routedetails_delete = new ew_Page("routedetails_delete");

// page properties
routedetails_delete.PageID = "delete"; // page ID
routedetails_delete.FormID = "froutedetailsdelete"; // form ID
var EW_PAGE_ID = routedetails_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
routedetails_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
routedetails_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
routedetails_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $routedetails_delete->ShowPageHeader(); ?>
<?php

// Load records for display
if ($routedetails_delete->Recordset = $routedetails_delete->LoadRecordset())
	$routedetails_deleteTotalRecs = $routedetails_delete->Recordset->RecordCount(); // Get record count
if ($routedetails_deleteTotalRecs <= 0) { // No record found, exit
	if ($routedetails_delete->Recordset)
		$routedetails_delete->Recordset->Close();
	$routedetails_delete->Page_Terminate("routedetailslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $routedetails->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $routedetails->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$routedetails_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="routedetails">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($routedetails_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $routedetails->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $routedetails->reg_id->FldCaption() ?></td>
		<td valign="top"><?php echo $routedetails->mid->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$routedetails_delete->RecCnt = 0;
$i = 0;
while (!$routedetails_delete->Recordset->EOF) {
	$routedetails_delete->RecCnt++;

	// Set row properties
	$routedetails->ResetAttrs();
	$routedetails->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$routedetails_delete->LoadRowValues($routedetails_delete->Recordset);

	// Render row
	$routedetails_delete->RenderRow();
?>
	<tr<?php echo $routedetails->RowAttributes() ?>>
		<td<?php echo $routedetails->reg_id->CellAttributes() ?>>
<div<?php echo $routedetails->reg_id->ViewAttributes() ?>><?php echo $routedetails->reg_id->ListViewValue() ?></div></td>
		<td<?php echo $routedetails->mid->CellAttributes() ?>>
<div<?php echo $routedetails->mid->ViewAttributes() ?>><?php echo $routedetails->mid->ListViewValue() ?></div></td>
	</tr>
<?php
	$routedetails_delete->Recordset->MoveNext();
}
$routedetails_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$routedetails_delete->ShowPageFooter();
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
$routedetails_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class croutedetails_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'routedetails';

	// Page object name
	var $PageObjName = 'routedetails_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $routedetails;
		if ($routedetails->UseTokenInUrl) $PageUrl .= "t=" . $routedetails->TableVar . "&"; // Add page token
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
		global $objForm, $routedetails;
		if ($routedetails->UseTokenInUrl) {
			if ($objForm)
				return ($routedetails->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($routedetails->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function croutedetails_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (routedetails)
		if (!isset($GLOBALS["routedetails"])) {
			$GLOBALS["routedetails"] = new croutedetails();
			$GLOBALS["Table"] =& $GLOBALS["routedetails"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'routedetails', TRUE);

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
		global $routedetails;

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
		global $Language, $routedetails;

		// Load key parameters
		$this->RecKeys = $routedetails->GetRecordKeys(); // Load record keys
		$sFilter = $routedetails->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("routedetailslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in routedetails class, routedetailsinfo.php

		$routedetails->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$routedetails->CurrentAction = $_POST["a_delete"];
		} else {
			$routedetails->CurrentAction = "I"; // Display record
		}
		switch ($routedetails->CurrentAction) {
			case "D": // Delete
				$routedetails->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($routedetails->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $routedetails;

		// Call Recordset Selecting event
		$routedetails->Recordset_Selecting($routedetails->CurrentFilter);

		// Load List page SQL
		$sSql = $routedetails->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$routedetails->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $routedetails;
		$sFilter = $routedetails->KeyFilter();

		// Call Row Selecting event
		$routedetails->Row_Selecting($sFilter);

		// Load SQL based on filter
		$routedetails->CurrentFilter = $sFilter;
		$sSql = $routedetails->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$routedetails->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $routedetails;
		if (!$rs || $rs->EOF) return;
		$routedetails->reg_id->setDbValue($rs->fields('reg_id'));
		$routedetails->mid->setDbValue($rs->fields('mid'));
		$routedetails->source->setDbValue($rs->fields('source'));
		$routedetails->destination->setDbValue($rs->fields('destination'));
		$routedetails->intermediatedestination1->setDbValue($rs->fields('intermediatedestination1'));
		$routedetails->intermediatedestination2->setDbValue($rs->fields('intermediatedestination2'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $routedetails;

		// Initialize URLs
		// Call Row_Rendering event

		$routedetails->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// mid
		// source
		// destination
		// intermediatedestination1
		// intermediatedestination2

		if ($routedetails->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$routedetails->reg_id->ViewValue = $routedetails->reg_id->CurrentValue;
			$routedetails->reg_id->ViewCustomAttributes = "";

			// mid
			$routedetails->mid->ViewValue = $routedetails->mid->CurrentValue;
			$routedetails->mid->ViewCustomAttributes = "";

			// reg_id
			$routedetails->reg_id->LinkCustomAttributes = "";
			$routedetails->reg_id->HrefValue = "";
			$routedetails->reg_id->TooltipValue = "";

			// mid
			$routedetails->mid->LinkCustomAttributes = "";
			$routedetails->mid->HrefValue = "";
			$routedetails->mid->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($routedetails->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$routedetails->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $routedetails;
		$DeleteRows = TRUE;
		$sSql = $routedetails->SQL();
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
				$DeleteRows = $routedetails->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($routedetails->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($routedetails->CancelMessage <> "") {
				$this->setFailureMessage($routedetails->CancelMessage);
				$routedetails->CancelMessage = "";
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
				$routedetails->Row_Deleted($row);
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
