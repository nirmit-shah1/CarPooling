<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "zlogininfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$zlogin_delete = new czlogin_delete();
$Page =& $zlogin_delete;

// Page init
$zlogin_delete->Page_Init();

// Page main
$zlogin_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var zlogin_delete = new ew_Page("zlogin_delete");

// page properties
zlogin_delete.PageID = "delete"; // page ID
zlogin_delete.FormID = "fzlogindelete"; // form ID
var EW_PAGE_ID = zlogin_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
zlogin_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
zlogin_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
zlogin_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $zlogin_delete->ShowPageHeader(); ?>
<?php

// Load records for display
if ($zlogin_delete->Recordset = $zlogin_delete->LoadRecordset())
	$zlogin_deleteTotalRecs = $zlogin_delete->Recordset->RecordCount(); // Get record count
if ($zlogin_deleteTotalRecs <= 0) { // No record found, exit
	if ($zlogin_delete->Recordset)
		$zlogin_delete->Recordset->Close();
	$zlogin_delete->Page_Terminate("zloginlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $zlogin->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $zlogin->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$zlogin_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="zlogin">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($zlogin_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $zlogin->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $zlogin->reg_id->FldCaption() ?></td>
		<td valign="top"><?php echo $zlogin->zemail->FldCaption() ?></td>
		<td valign="top"><?php echo $zlogin->password->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$zlogin_delete->RecCnt = 0;
$i = 0;
while (!$zlogin_delete->Recordset->EOF) {
	$zlogin_delete->RecCnt++;

	// Set row properties
	$zlogin->ResetAttrs();
	$zlogin->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$zlogin_delete->LoadRowValues($zlogin_delete->Recordset);

	// Render row
	$zlogin_delete->RenderRow();
?>
	<tr<?php echo $zlogin->RowAttributes() ?>>
		<td<?php echo $zlogin->reg_id->CellAttributes() ?>>
<div<?php echo $zlogin->reg_id->ViewAttributes() ?>><?php echo $zlogin->reg_id->ListViewValue() ?></div></td>
		<td<?php echo $zlogin->zemail->CellAttributes() ?>>
<div<?php echo $zlogin->zemail->ViewAttributes() ?>><?php echo $zlogin->zemail->ListViewValue() ?></div></td>
		<td<?php echo $zlogin->password->CellAttributes() ?>>
<div<?php echo $zlogin->password->ViewAttributes() ?>><?php echo $zlogin->password->ListViewValue() ?></div></td>
	</tr>
<?php
	$zlogin_delete->Recordset->MoveNext();
}
$zlogin_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$zlogin_delete->ShowPageFooter();
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
$zlogin_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class czlogin_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'login';

	// Page object name
	var $PageObjName = 'zlogin_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $zlogin;
		if ($zlogin->UseTokenInUrl) $PageUrl .= "t=" . $zlogin->TableVar . "&"; // Add page token
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
		global $objForm, $zlogin;
		if ($zlogin->UseTokenInUrl) {
			if ($objForm)
				return ($zlogin->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($zlogin->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function czlogin_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (zlogin)
		if (!isset($GLOBALS["zlogin"])) {
			$GLOBALS["zlogin"] = new czlogin();
			$GLOBALS["Table"] =& $GLOBALS["zlogin"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'login', TRUE);

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
		global $zlogin;

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
		global $Language, $zlogin;

		// Load key parameters
		$this->RecKeys = $zlogin->GetRecordKeys(); // Load record keys
		$sFilter = $zlogin->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("zloginlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in zlogin class, zlogininfo.php

		$zlogin->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$zlogin->CurrentAction = $_POST["a_delete"];
		} else {
			$zlogin->CurrentAction = "I"; // Display record
		}
		switch ($zlogin->CurrentAction) {
			case "D": // Delete
				$zlogin->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($zlogin->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $zlogin;

		// Call Recordset Selecting event
		$zlogin->Recordset_Selecting($zlogin->CurrentFilter);

		// Load List page SQL
		$sSql = $zlogin->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$zlogin->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $zlogin;
		$sFilter = $zlogin->KeyFilter();

		// Call Row Selecting event
		$zlogin->Row_Selecting($sFilter);

		// Load SQL based on filter
		$zlogin->CurrentFilter = $sFilter;
		$sSql = $zlogin->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$zlogin->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $zlogin;
		if (!$rs || $rs->EOF) return;
		$zlogin->reg_id->setDbValue($rs->fields('reg_id'));
		$zlogin->zemail->setDbValue($rs->fields('email'));
		$zlogin->password->setDbValue($rs->fields('password'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $zlogin;

		// Initialize URLs
		// Call Row_Rendering event

		$zlogin->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// email
		// password

		if ($zlogin->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$zlogin->reg_id->ViewValue = $zlogin->reg_id->CurrentValue;
			$zlogin->reg_id->ViewCustomAttributes = "";

			// email
			$zlogin->zemail->ViewValue = $zlogin->zemail->CurrentValue;
			$zlogin->zemail->ViewCustomAttributes = "";

			// password
			$zlogin->password->ViewValue = $zlogin->password->CurrentValue;
			$zlogin->password->ViewCustomAttributes = "";

			// reg_id
			$zlogin->reg_id->LinkCustomAttributes = "";
			$zlogin->reg_id->HrefValue = "";
			$zlogin->reg_id->TooltipValue = "";

			// email
			$zlogin->zemail->LinkCustomAttributes = "";
			$zlogin->zemail->HrefValue = "";
			$zlogin->zemail->TooltipValue = "";

			// password
			$zlogin->password->LinkCustomAttributes = "";
			$zlogin->password->HrefValue = "";
			$zlogin->password->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($zlogin->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$zlogin->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $zlogin;
		$DeleteRows = TRUE;
		$sSql = $zlogin->SQL();
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
				$DeleteRows = $zlogin->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['email'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($zlogin->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($zlogin->CancelMessage <> "") {
				$this->setFailureMessage($zlogin->CancelMessage);
				$zlogin->CancelMessage = "";
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
				$zlogin->Row_Deleted($row);
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
