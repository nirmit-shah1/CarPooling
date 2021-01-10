<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "typeoftripinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$typeoftrip_delete = new ctypeoftrip_delete();
$Page =& $typeoftrip_delete;

// Page init
$typeoftrip_delete->Page_Init();

// Page main
$typeoftrip_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var typeoftrip_delete = new ew_Page("typeoftrip_delete");

// page properties
typeoftrip_delete.PageID = "delete"; // page ID
typeoftrip_delete.FormID = "ftypeoftripdelete"; // form ID
var EW_PAGE_ID = typeoftrip_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
typeoftrip_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
typeoftrip_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
typeoftrip_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $typeoftrip_delete->ShowPageHeader(); ?>
<?php

// Load records for display
if ($typeoftrip_delete->Recordset = $typeoftrip_delete->LoadRecordset())
	$typeoftrip_deleteTotalRecs = $typeoftrip_delete->Recordset->RecordCount(); // Get record count
if ($typeoftrip_deleteTotalRecs <= 0) { // No record found, exit
	if ($typeoftrip_delete->Recordset)
		$typeoftrip_delete->Recordset->Close();
	$typeoftrip_delete->Page_Terminate("typeoftriplist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $typeoftrip->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $typeoftrip->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$typeoftrip_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="typeoftrip">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($typeoftrip_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $typeoftrip->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $typeoftrip->reg_id->FldCaption() ?></td>
		<td valign="top"><?php echo $typeoftrip->mid->FldCaption() ?></td>
		<td valign="top"><?php echo $typeoftrip->triptype->FldCaption() ?></td>
		<td valign="top"><?php echo $typeoftrip->departuredate->FldCaption() ?></td>
		<td valign="top"><?php echo $typeoftrip->departuretime->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$typeoftrip_delete->RecCnt = 0;
$i = 0;
while (!$typeoftrip_delete->Recordset->EOF) {
	$typeoftrip_delete->RecCnt++;

	// Set row properties
	$typeoftrip->ResetAttrs();
	$typeoftrip->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$typeoftrip_delete->LoadRowValues($typeoftrip_delete->Recordset);

	// Render row
	$typeoftrip_delete->RenderRow();
?>
	<tr<?php echo $typeoftrip->RowAttributes() ?>>
		<td<?php echo $typeoftrip->reg_id->CellAttributes() ?>>
<div<?php echo $typeoftrip->reg_id->ViewAttributes() ?>><?php echo $typeoftrip->reg_id->ListViewValue() ?></div></td>
		<td<?php echo $typeoftrip->mid->CellAttributes() ?>>
<div<?php echo $typeoftrip->mid->ViewAttributes() ?>><?php echo $typeoftrip->mid->ListViewValue() ?></div></td>
		<td<?php echo $typeoftrip->triptype->CellAttributes() ?>>
<div<?php echo $typeoftrip->triptype->ViewAttributes() ?>><?php echo $typeoftrip->triptype->ListViewValue() ?></div></td>
		<td<?php echo $typeoftrip->departuredate->CellAttributes() ?>>
<div<?php echo $typeoftrip->departuredate->ViewAttributes() ?>><?php echo $typeoftrip->departuredate->ListViewValue() ?></div></td>
		<td<?php echo $typeoftrip->departuretime->CellAttributes() ?>>
<div<?php echo $typeoftrip->departuretime->ViewAttributes() ?>><?php echo $typeoftrip->departuretime->ListViewValue() ?></div></td>
	</tr>
<?php
	$typeoftrip_delete->Recordset->MoveNext();
}
$typeoftrip_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$typeoftrip_delete->ShowPageFooter();
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
$typeoftrip_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctypeoftrip_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'typeoftrip';

	// Page object name
	var $PageObjName = 'typeoftrip_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $typeoftrip;
		if ($typeoftrip->UseTokenInUrl) $PageUrl .= "t=" . $typeoftrip->TableVar . "&"; // Add page token
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
		global $objForm, $typeoftrip;
		if ($typeoftrip->UseTokenInUrl) {
			if ($objForm)
				return ($typeoftrip->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($typeoftrip->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctypeoftrip_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (typeoftrip)
		if (!isset($GLOBALS["typeoftrip"])) {
			$GLOBALS["typeoftrip"] = new ctypeoftrip();
			$GLOBALS["Table"] =& $GLOBALS["typeoftrip"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'typeoftrip', TRUE);

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
		global $typeoftrip;

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
		global $Language, $typeoftrip;

		// Load key parameters
		$this->RecKeys = $typeoftrip->GetRecordKeys(); // Load record keys
		$sFilter = $typeoftrip->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("typeoftriplist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in typeoftrip class, typeoftripinfo.php

		$typeoftrip->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$typeoftrip->CurrentAction = $_POST["a_delete"];
		} else {
			$typeoftrip->CurrentAction = "I"; // Display record
		}
		switch ($typeoftrip->CurrentAction) {
			case "D": // Delete
				$typeoftrip->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($typeoftrip->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $typeoftrip;

		// Call Recordset Selecting event
		$typeoftrip->Recordset_Selecting($typeoftrip->CurrentFilter);

		// Load List page SQL
		$sSql = $typeoftrip->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$typeoftrip->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $typeoftrip;
		$sFilter = $typeoftrip->KeyFilter();

		// Call Row Selecting event
		$typeoftrip->Row_Selecting($sFilter);

		// Load SQL based on filter
		$typeoftrip->CurrentFilter = $sFilter;
		$sSql = $typeoftrip->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$typeoftrip->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $typeoftrip;
		if (!$rs || $rs->EOF) return;
		$typeoftrip->reg_id->setDbValue($rs->fields('reg_id'));
		$typeoftrip->mid->setDbValue($rs->fields('mid'));
		$typeoftrip->triptype->setDbValue($rs->fields('triptype'));
		$typeoftrip->departuredate->setDbValue($rs->fields('departuredate'));
		$typeoftrip->departuretime->setDbValue($rs->fields('departuretime'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $typeoftrip;

		// Initialize URLs
		// Call Row_Rendering event

		$typeoftrip->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// mid
		// triptype
		// departuredate
		// departuretime

		if ($typeoftrip->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$typeoftrip->reg_id->ViewValue = $typeoftrip->reg_id->CurrentValue;
			$typeoftrip->reg_id->ViewCustomAttributes = "";

			// mid
			$typeoftrip->mid->ViewValue = $typeoftrip->mid->CurrentValue;
			$typeoftrip->mid->ViewCustomAttributes = "";

			// triptype
			$typeoftrip->triptype->ViewValue = $typeoftrip->triptype->CurrentValue;
			$typeoftrip->triptype->ViewCustomAttributes = "";

			// departuredate
			$typeoftrip->departuredate->ViewValue = $typeoftrip->departuredate->CurrentValue;
			$typeoftrip->departuredate->ViewCustomAttributes = "";

			// departuretime
			$typeoftrip->departuretime->ViewValue = $typeoftrip->departuretime->CurrentValue;
			$typeoftrip->departuretime->ViewCustomAttributes = "";

			// reg_id
			$typeoftrip->reg_id->LinkCustomAttributes = "";
			$typeoftrip->reg_id->HrefValue = "";
			$typeoftrip->reg_id->TooltipValue = "";

			// mid
			$typeoftrip->mid->LinkCustomAttributes = "";
			$typeoftrip->mid->HrefValue = "";
			$typeoftrip->mid->TooltipValue = "";

			// triptype
			$typeoftrip->triptype->LinkCustomAttributes = "";
			$typeoftrip->triptype->HrefValue = "";
			$typeoftrip->triptype->TooltipValue = "";

			// departuredate
			$typeoftrip->departuredate->LinkCustomAttributes = "";
			$typeoftrip->departuredate->HrefValue = "";
			$typeoftrip->departuredate->TooltipValue = "";

			// departuretime
			$typeoftrip->departuretime->LinkCustomAttributes = "";
			$typeoftrip->departuretime->HrefValue = "";
			$typeoftrip->departuretime->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($typeoftrip->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$typeoftrip->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $typeoftrip;
		$DeleteRows = TRUE;
		$sSql = $typeoftrip->SQL();
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
				$DeleteRows = $typeoftrip->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($typeoftrip->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($typeoftrip->CancelMessage <> "") {
				$this->setFailureMessage($typeoftrip->CancelMessage);
				$typeoftrip->CancelMessage = "";
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
				$typeoftrip->Row_Deleted($row);
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
