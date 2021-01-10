<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "cityinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$city_delete = new ccity_delete();
$Page =& $city_delete;

// Page init
$city_delete->Page_Init();

// Page main
$city_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var city_delete = new ew_Page("city_delete");

// page properties
city_delete.PageID = "delete"; // page ID
city_delete.FormID = "fcitydelete"; // form ID
var EW_PAGE_ID = city_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
city_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
city_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
city_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $city_delete->ShowPageHeader(); ?>
<?php

// Load records for display
if ($city_delete->Recordset = $city_delete->LoadRecordset())
	$city_deleteTotalRecs = $city_delete->Recordset->RecordCount(); // Get record count
if ($city_deleteTotalRecs <= 0) { // No record found, exit
	if ($city_delete->Recordset)
		$city_delete->Recordset->Close();
	$city_delete->Page_Terminate("citylist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $city->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $city->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$city_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="city">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($city_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $city->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $city->cid->FldCaption() ?></td>
		<td valign="top"><?php echo $city->sid->FldCaption() ?></td>
		<td valign="top"><?php echo $city->city_name->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$city_delete->RecCnt = 0;
$i = 0;
while (!$city_delete->Recordset->EOF) {
	$city_delete->RecCnt++;

	// Set row properties
	$city->ResetAttrs();
	$city->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$city_delete->LoadRowValues($city_delete->Recordset);

	// Render row
	$city_delete->RenderRow();
?>
	<tr<?php echo $city->RowAttributes() ?>>
		<td<?php echo $city->cid->CellAttributes() ?>>
<div<?php echo $city->cid->ViewAttributes() ?>><?php echo $city->cid->ListViewValue() ?></div></td>
		<td<?php echo $city->sid->CellAttributes() ?>>
<div<?php echo $city->sid->ViewAttributes() ?>><?php echo $city->sid->ListViewValue() ?></div></td>
		<td<?php echo $city->city_name->CellAttributes() ?>>
<div<?php echo $city->city_name->ViewAttributes() ?>><?php echo $city->city_name->ListViewValue() ?></div></td>
	</tr>
<?php
	$city_delete->Recordset->MoveNext();
}
$city_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$city_delete->ShowPageFooter();
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
$city_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ccity_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'city';

	// Page object name
	var $PageObjName = 'city_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $city;
		if ($city->UseTokenInUrl) $PageUrl .= "t=" . $city->TableVar . "&"; // Add page token
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
		global $objForm, $city;
		if ($city->UseTokenInUrl) {
			if ($objForm)
				return ($city->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($city->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccity_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (city)
		if (!isset($GLOBALS["city"])) {
			$GLOBALS["city"] = new ccity();
			$GLOBALS["Table"] =& $GLOBALS["city"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'city', TRUE);

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
		global $city;

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
		global $Language, $city;

		// Load key parameters
		$this->RecKeys = $city->GetRecordKeys(); // Load record keys
		$sFilter = $city->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("citylist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in city class, cityinfo.php

		$city->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$city->CurrentAction = $_POST["a_delete"];
		} else {
			$city->CurrentAction = "I"; // Display record
		}
		switch ($city->CurrentAction) {
			case "D": // Delete
				$city->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($city->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $city;

		// Call Recordset Selecting event
		$city->Recordset_Selecting($city->CurrentFilter);

		// Load List page SQL
		$sSql = $city->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$city->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $city;
		$sFilter = $city->KeyFilter();

		// Call Row Selecting event
		$city->Row_Selecting($sFilter);

		// Load SQL based on filter
		$city->CurrentFilter = $sFilter;
		$sSql = $city->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$city->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $city;
		if (!$rs || $rs->EOF) return;
		$city->cid->setDbValue($rs->fields('cid'));
		$city->sid->setDbValue($rs->fields('sid'));
		$city->city_name->setDbValue($rs->fields('city_name'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $city;

		// Initialize URLs
		// Call Row_Rendering event

		$city->Row_Rendering();

		// Common render codes for all row types
		// cid
		// sid
		// city_name

		if ($city->RowType == EW_ROWTYPE_VIEW) { // View row

			// cid
			$city->cid->ViewValue = $city->cid->CurrentValue;
			$city->cid->ViewCustomAttributes = "";

			// sid
			$city->sid->ViewValue = $city->sid->CurrentValue;
			$city->sid->ViewCustomAttributes = "";

			// city_name
			$city->city_name->ViewValue = $city->city_name->CurrentValue;
			$city->city_name->ViewCustomAttributes = "";

			// cid
			$city->cid->LinkCustomAttributes = "";
			$city->cid->HrefValue = "";
			$city->cid->TooltipValue = "";

			// sid
			$city->sid->LinkCustomAttributes = "";
			$city->sid->HrefValue = "";
			$city->sid->TooltipValue = "";

			// city_name
			$city->city_name->LinkCustomAttributes = "";
			$city->city_name->HrefValue = "";
			$city->city_name->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($city->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$city->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $city;
		$DeleteRows = TRUE;
		$sSql = $city->SQL();
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
				$DeleteRows = $city->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['city_name'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($city->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($city->CancelMessage <> "") {
				$this->setFailureMessage($city->CancelMessage);
				$city->CancelMessage = "";
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
				$city->Row_Deleted($row);
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
