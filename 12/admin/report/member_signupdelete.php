<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "member_signupinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$member_signup_delete = new cmember_signup_delete();
$Page =& $member_signup_delete;

// Page init
$member_signup_delete->Page_Init();

// Page main
$member_signup_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var member_signup_delete = new ew_Page("member_signup_delete");

// page properties
member_signup_delete.PageID = "delete"; // page ID
member_signup_delete.FormID = "fmember_signupdelete"; // form ID
var EW_PAGE_ID = member_signup_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
member_signup_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
member_signup_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
member_signup_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $member_signup_delete->ShowPageHeader(); ?>
<?php

// Load records for display
if ($member_signup_delete->Recordset = $member_signup_delete->LoadRecordset())
	$member_signup_deleteTotalRecs = $member_signup_delete->Recordset->RecordCount(); // Get record count
if ($member_signup_deleteTotalRecs <= 0) { // No record found, exit
	if ($member_signup_delete->Recordset)
		$member_signup_delete->Recordset->Close();
	$member_signup_delete->Page_Terminate("member_signuplist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $member_signup->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $member_signup->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$member_signup_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="member_signup">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($member_signup_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $member_signup->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $member_signup->reg_id->FldCaption() ?></td>
		<td valign="top"><?php echo $member_signup->category->FldCaption() ?></td>
		<td valign="top"><?php echo $member_signup->product->FldCaption() ?></td>
		<td valign="top"><?php echo $member_signup->seats->FldCaption() ?></td>
		<td valign="top"><?php echo $member_signup->ac->FldCaption() ?></td>
		<td valign="top"><?php echo $member_signup->colour->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$member_signup_delete->RecCnt = 0;
$i = 0;
while (!$member_signup_delete->Recordset->EOF) {
	$member_signup_delete->RecCnt++;

	// Set row properties
	$member_signup->ResetAttrs();
	$member_signup->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$member_signup_delete->LoadRowValues($member_signup_delete->Recordset);

	// Render row
	$member_signup_delete->RenderRow();
?>
	<tr<?php echo $member_signup->RowAttributes() ?>>
		<td<?php echo $member_signup->reg_id->CellAttributes() ?>>
<div<?php echo $member_signup->reg_id->ViewAttributes() ?>><?php echo $member_signup->reg_id->ListViewValue() ?></div></td>
		<td<?php echo $member_signup->category->CellAttributes() ?>>
<div<?php echo $member_signup->category->ViewAttributes() ?>><?php echo $member_signup->category->ListViewValue() ?></div></td>
		<td<?php echo $member_signup->product->CellAttributes() ?>>
<div<?php echo $member_signup->product->ViewAttributes() ?>><?php echo $member_signup->product->ListViewValue() ?></div></td>
		<td<?php echo $member_signup->seats->CellAttributes() ?>>
<div<?php echo $member_signup->seats->ViewAttributes() ?>><?php echo $member_signup->seats->ListViewValue() ?></div></td>
		<td<?php echo $member_signup->ac->CellAttributes() ?>>
<div<?php echo $member_signup->ac->ViewAttributes() ?>><?php echo $member_signup->ac->ListViewValue() ?></div></td>
		<td<?php echo $member_signup->colour->CellAttributes() ?>>
<div<?php echo $member_signup->colour->ViewAttributes() ?>><?php echo $member_signup->colour->ListViewValue() ?></div></td>
	</tr>
<?php
	$member_signup_delete->Recordset->MoveNext();
}
$member_signup_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$member_signup_delete->ShowPageFooter();
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
$member_signup_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cmember_signup_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'member_signup';

	// Page object name
	var $PageObjName = 'member_signup_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $member_signup;
		if ($member_signup->UseTokenInUrl) $PageUrl .= "t=" . $member_signup->TableVar . "&"; // Add page token
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
		global $objForm, $member_signup;
		if ($member_signup->UseTokenInUrl) {
			if ($objForm)
				return ($member_signup->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($member_signup->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmember_signup_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (member_signup)
		if (!isset($GLOBALS["member_signup"])) {
			$GLOBALS["member_signup"] = new cmember_signup();
			$GLOBALS["Table"] =& $GLOBALS["member_signup"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'member_signup', TRUE);

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
		global $member_signup;

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
		global $Language, $member_signup;

		// Load key parameters
		$this->RecKeys = $member_signup->GetRecordKeys(); // Load record keys
		$sFilter = $member_signup->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("member_signuplist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in member_signup class, member_signupinfo.php

		$member_signup->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$member_signup->CurrentAction = $_POST["a_delete"];
		} else {
			$member_signup->CurrentAction = "I"; // Display record
		}
		switch ($member_signup->CurrentAction) {
			case "D": // Delete
				$member_signup->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($member_signup->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $member_signup;

		// Call Recordset Selecting event
		$member_signup->Recordset_Selecting($member_signup->CurrentFilter);

		// Load List page SQL
		$sSql = $member_signup->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$member_signup->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $member_signup;
		$sFilter = $member_signup->KeyFilter();

		// Call Row Selecting event
		$member_signup->Row_Selecting($sFilter);

		// Load SQL based on filter
		$member_signup->CurrentFilter = $sFilter;
		$sSql = $member_signup->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$member_signup->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $member_signup;
		if (!$rs || $rs->EOF) return;
		$member_signup->reg_id->setDbValue($rs->fields('reg_id'));
		$member_signup->category->setDbValue($rs->fields('category'));
		$member_signup->product->setDbValue($rs->fields('product'));
		$member_signup->seats->setDbValue($rs->fields('seats'));
		$member_signup->ac->setDbValue($rs->fields('ac'));
		$member_signup->colour->setDbValue($rs->fields('colour'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $member_signup;

		// Initialize URLs
		// Call Row_Rendering event

		$member_signup->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// category
		// product
		// seats
		// ac
		// colour

		if ($member_signup->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$member_signup->reg_id->ViewValue = $member_signup->reg_id->CurrentValue;
			$member_signup->reg_id->ViewCustomAttributes = "";

			// category
			$member_signup->category->ViewValue = $member_signup->category->CurrentValue;
			$member_signup->category->ViewCustomAttributes = "";

			// product
			$member_signup->product->ViewValue = $member_signup->product->CurrentValue;
			$member_signup->product->ViewCustomAttributes = "";

			// seats
			$member_signup->seats->ViewValue = $member_signup->seats->CurrentValue;
			$member_signup->seats->ViewCustomAttributes = "";

			// ac
			$member_signup->ac->ViewValue = $member_signup->ac->CurrentValue;
			$member_signup->ac->ViewCustomAttributes = "";

			// colour
			$member_signup->colour->ViewValue = $member_signup->colour->CurrentValue;
			$member_signup->colour->ViewCustomAttributes = "";

			// reg_id
			$member_signup->reg_id->LinkCustomAttributes = "";
			$member_signup->reg_id->HrefValue = "";
			$member_signup->reg_id->TooltipValue = "";

			// category
			$member_signup->category->LinkCustomAttributes = "";
			$member_signup->category->HrefValue = "";
			$member_signup->category->TooltipValue = "";

			// product
			$member_signup->product->LinkCustomAttributes = "";
			$member_signup->product->HrefValue = "";
			$member_signup->product->TooltipValue = "";

			// seats
			$member_signup->seats->LinkCustomAttributes = "";
			$member_signup->seats->HrefValue = "";
			$member_signup->seats->TooltipValue = "";

			// ac
			$member_signup->ac->LinkCustomAttributes = "";
			$member_signup->ac->HrefValue = "";
			$member_signup->ac->TooltipValue = "";

			// colour
			$member_signup->colour->LinkCustomAttributes = "";
			$member_signup->colour->HrefValue = "";
			$member_signup->colour->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($member_signup->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$member_signup->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $member_signup;
		$DeleteRows = TRUE;
		$sSql = $member_signup->SQL();
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
				$DeleteRows = $member_signup->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($member_signup->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($member_signup->CancelMessage <> "") {
				$this->setFailureMessage($member_signup->CancelMessage);
				$member_signup->CancelMessage = "";
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
				$member_signup->Row_Deleted($row);
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
