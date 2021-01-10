<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "areainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$area_delete = new carea_delete();
$Page =& $area_delete;

// Page init
$area_delete->Page_Init();

// Page main
$area_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var area_delete = new ew_Page("area_delete");

// page properties
area_delete.PageID = "delete"; // page ID
area_delete.FormID = "fareadelete"; // form ID
var EW_PAGE_ID = area_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
area_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
area_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
area_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $area_delete->ShowPageHeader(); ?>
<?php

// Load records for display
if ($area_delete->Recordset = $area_delete->LoadRecordset())
	$area_deleteTotalRecs = $area_delete->Recordset->RecordCount(); // Get record count
if ($area_deleteTotalRecs <= 0) { // No record found, exit
	if ($area_delete->Recordset)
		$area_delete->Recordset->Close();
	$area_delete->Page_Terminate("arealist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $area->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $area->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$area_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="area">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($area_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $area->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $area->aid->FldCaption() ?></td>
		<td valign="top"><?php echo $area->sid->FldCaption() ?></td>
		<td valign="top"><?php echo $area->cid->FldCaption() ?></td>
		<td valign="top"><?php echo $area->area_name->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$area_delete->RecCnt = 0;
$i = 0;
while (!$area_delete->Recordset->EOF) {
	$area_delete->RecCnt++;

	// Set row properties
	$area->ResetAttrs();
	$area->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$area_delete->LoadRowValues($area_delete->Recordset);

	// Render row
	$area_delete->RenderRow();
?>
	<tr<?php echo $area->RowAttributes() ?>>
		<td<?php echo $area->aid->CellAttributes() ?>>
<div<?php echo $area->aid->ViewAttributes() ?>><?php echo $area->aid->ListViewValue() ?></div></td>
		<td<?php echo $area->sid->CellAttributes() ?>>
<div<?php echo $area->sid->ViewAttributes() ?>><?php echo $area->sid->ListViewValue() ?></div></td>
		<td<?php echo $area->cid->CellAttributes() ?>>
<div<?php echo $area->cid->ViewAttributes() ?>><?php echo $area->cid->ListViewValue() ?></div></td>
		<td<?php echo $area->area_name->CellAttributes() ?>>
<div<?php echo $area->area_name->ViewAttributes() ?>><?php echo $area->area_name->ListViewValue() ?></div></td>
	</tr>
<?php
	$area_delete->Recordset->MoveNext();
}
$area_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$area_delete->ShowPageFooter();
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
$area_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class carea_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'area';

	// Page object name
	var $PageObjName = 'area_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $area;
		if ($area->UseTokenInUrl) $PageUrl .= "t=" . $area->TableVar . "&"; // Add page token
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
		global $objForm, $area;
		if ($area->UseTokenInUrl) {
			if ($objForm)
				return ($area->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($area->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function carea_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (area)
		if (!isset($GLOBALS["area"])) {
			$GLOBALS["area"] = new carea();
			$GLOBALS["Table"] =& $GLOBALS["area"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'area', TRUE);

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
		global $area;

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
		global $Language, $area;

		// Load key parameters
		$this->RecKeys = $area->GetRecordKeys(); // Load record keys
		$sFilter = $area->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("arealist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in area class, areainfo.php

		$area->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$area->CurrentAction = $_POST["a_delete"];
		} else {
			$area->CurrentAction = "I"; // Display record
		}
		switch ($area->CurrentAction) {
			case "D": // Delete
				$area->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($area->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $area;

		// Call Recordset Selecting event
		$area->Recordset_Selecting($area->CurrentFilter);

		// Load List page SQL
		$sSql = $area->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$area->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $area;
		$sFilter = $area->KeyFilter();

		// Call Row Selecting event
		$area->Row_Selecting($sFilter);

		// Load SQL based on filter
		$area->CurrentFilter = $sFilter;
		$sSql = $area->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$area->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $area;
		if (!$rs || $rs->EOF) return;
		$area->aid->setDbValue($rs->fields('aid'));
		$area->sid->setDbValue($rs->fields('sid'));
		$area->cid->setDbValue($rs->fields('cid'));
		$area->area_name->setDbValue($rs->fields('area_name'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $area;

		// Initialize URLs
		// Call Row_Rendering event

		$area->Row_Rendering();

		// Common render codes for all row types
		// aid
		// sid
		// cid
		// area_name

		if ($area->RowType == EW_ROWTYPE_VIEW) { // View row

			// aid
			$area->aid->ViewValue = $area->aid->CurrentValue;
			$area->aid->ViewCustomAttributes = "";

			// sid
			$area->sid->ViewValue = $area->sid->CurrentValue;
			$area->sid->ViewCustomAttributes = "";

			// cid
			$area->cid->ViewValue = $area->cid->CurrentValue;
			$area->cid->ViewCustomAttributes = "";

			// area_name
			$area->area_name->ViewValue = $area->area_name->CurrentValue;
			$area->area_name->ViewCustomAttributes = "";

			// aid
			$area->aid->LinkCustomAttributes = "";
			$area->aid->HrefValue = "";
			$area->aid->TooltipValue = "";

			// sid
			$area->sid->LinkCustomAttributes = "";
			$area->sid->HrefValue = "";
			$area->sid->TooltipValue = "";

			// cid
			$area->cid->LinkCustomAttributes = "";
			$area->cid->HrefValue = "";
			$area->cid->TooltipValue = "";

			// area_name
			$area->area_name->LinkCustomAttributes = "";
			$area->area_name->HrefValue = "";
			$area->area_name->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($area->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$area->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $area;
		$DeleteRows = TRUE;
		$sSql = $area->SQL();
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
				$DeleteRows = $area->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['area_name'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($area->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($area->CancelMessage <> "") {
				$this->setFailureMessage($area->CancelMessage);
				$area->CancelMessage = "";
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
				$area->Row_Deleted($row);
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
