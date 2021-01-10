<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "postalinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$postal_delete = new cpostal_delete();
$Page =& $postal_delete;

// Page init
$postal_delete->Page_Init();

// Page main
$postal_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var postal_delete = new ew_Page("postal_delete");

// page properties
postal_delete.PageID = "delete"; // page ID
postal_delete.FormID = "fpostaldelete"; // form ID
var EW_PAGE_ID = postal_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
postal_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
postal_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
postal_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $postal_delete->ShowPageHeader(); ?>
<?php

// Load records for display
if ($postal_delete->Recordset = $postal_delete->LoadRecordset())
	$postal_deleteTotalRecs = $postal_delete->Recordset->RecordCount(); // Get record count
if ($postal_deleteTotalRecs <= 0) { // No record found, exit
	if ($postal_delete->Recordset)
		$postal_delete->Recordset->Close();
	$postal_delete->Page_Terminate("postallist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $postal->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $postal->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$postal_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="postal">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($postal_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $postal->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $postal->reg_id->FldCaption() ?></td>
		<td valign="top"><?php echo $postal->postalcode->FldCaption() ?></td>
		<td valign="top"><?php echo $postal->state->FldCaption() ?></td>
		<td valign="top"><?php echo $postal->city->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$postal_delete->RecCnt = 0;
$i = 0;
while (!$postal_delete->Recordset->EOF) {
	$postal_delete->RecCnt++;

	// Set row properties
	$postal->ResetAttrs();
	$postal->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$postal_delete->LoadRowValues($postal_delete->Recordset);

	// Render row
	$postal_delete->RenderRow();
?>
	<tr<?php echo $postal->RowAttributes() ?>>
		<td<?php echo $postal->reg_id->CellAttributes() ?>>
<div<?php echo $postal->reg_id->ViewAttributes() ?>><?php echo $postal->reg_id->ListViewValue() ?></div></td>
		<td<?php echo $postal->postalcode->CellAttributes() ?>>
<div<?php echo $postal->postalcode->ViewAttributes() ?>><?php echo $postal->postalcode->ListViewValue() ?></div></td>
		<td<?php echo $postal->state->CellAttributes() ?>>
<div<?php echo $postal->state->ViewAttributes() ?>><?php echo $postal->state->ListViewValue() ?></div></td>
		<td<?php echo $postal->city->CellAttributes() ?>>
<div<?php echo $postal->city->ViewAttributes() ?>><?php echo $postal->city->ListViewValue() ?></div></td>
	</tr>
<?php
	$postal_delete->Recordset->MoveNext();
}
$postal_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$postal_delete->ShowPageFooter();
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
$postal_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cpostal_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'postal';

	// Page object name
	var $PageObjName = 'postal_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $postal;
		if ($postal->UseTokenInUrl) $PageUrl .= "t=" . $postal->TableVar . "&"; // Add page token
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
		global $objForm, $postal;
		if ($postal->UseTokenInUrl) {
			if ($objForm)
				return ($postal->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($postal->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpostal_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (postal)
		if (!isset($GLOBALS["postal"])) {
			$GLOBALS["postal"] = new cpostal();
			$GLOBALS["Table"] =& $GLOBALS["postal"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'postal', TRUE);

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
		global $postal;

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
		global $Language, $postal;

		// Load key parameters
		$this->RecKeys = $postal->GetRecordKeys(); // Load record keys
		$sFilter = $postal->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("postallist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in postal class, postalinfo.php

		$postal->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$postal->CurrentAction = $_POST["a_delete"];
		} else {
			$postal->CurrentAction = "I"; // Display record
		}
		switch ($postal->CurrentAction) {
			case "D": // Delete
				$postal->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($postal->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $postal;

		// Call Recordset Selecting event
		$postal->Recordset_Selecting($postal->CurrentFilter);

		// Load List page SQL
		$sSql = $postal->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$postal->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $postal;
		$sFilter = $postal->KeyFilter();

		// Call Row Selecting event
		$postal->Row_Selecting($sFilter);

		// Load SQL based on filter
		$postal->CurrentFilter = $sFilter;
		$sSql = $postal->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$postal->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $postal;
		if (!$rs || $rs->EOF) return;
		$postal->reg_id->setDbValue($rs->fields('reg_id'));
		$postal->address1->setDbValue($rs->fields('address1'));
		$postal->address2->setDbValue($rs->fields('address2'));
		$postal->postalcode->setDbValue($rs->fields('postalcode'));
		$postal->state->setDbValue($rs->fields('state'));
		$postal->city->setDbValue($rs->fields('city'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $postal;

		// Initialize URLs
		// Call Row_Rendering event

		$postal->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// address1
		// address2
		// postalcode
		// state
		// city

		if ($postal->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$postal->reg_id->ViewValue = $postal->reg_id->CurrentValue;
			$postal->reg_id->ViewCustomAttributes = "";

			// postalcode
			$postal->postalcode->ViewValue = $postal->postalcode->CurrentValue;
			$postal->postalcode->ViewCustomAttributes = "";

			// state
			$postal->state->ViewValue = $postal->state->CurrentValue;
			$postal->state->ViewCustomAttributes = "";

			// city
			$postal->city->ViewValue = $postal->city->CurrentValue;
			$postal->city->ViewCustomAttributes = "";

			// reg_id
			$postal->reg_id->LinkCustomAttributes = "";
			$postal->reg_id->HrefValue = "";
			$postal->reg_id->TooltipValue = "";

			// postalcode
			$postal->postalcode->LinkCustomAttributes = "";
			$postal->postalcode->HrefValue = "";
			$postal->postalcode->TooltipValue = "";

			// state
			$postal->state->LinkCustomAttributes = "";
			$postal->state->HrefValue = "";
			$postal->state->TooltipValue = "";

			// city
			$postal->city->LinkCustomAttributes = "";
			$postal->city->HrefValue = "";
			$postal->city->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($postal->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$postal->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $postal;
		$DeleteRows = TRUE;
		$sSql = $postal->SQL();
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
				$DeleteRows = $postal->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['reg_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($postal->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($postal->CancelMessage <> "") {
				$this->setFailureMessage($postal->CancelMessage);
				$postal->CancelMessage = "";
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
				$postal->Row_Deleted($row);
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
