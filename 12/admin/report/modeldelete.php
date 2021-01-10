<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "modelinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$model_delete = new cmodel_delete();
$Page =& $model_delete;

// Page init
$model_delete->Page_Init();

// Page main
$model_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var model_delete = new ew_Page("model_delete");

// page properties
model_delete.PageID = "delete"; // page ID
model_delete.FormID = "fmodeldelete"; // form ID
var EW_PAGE_ID = model_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
model_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
model_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
model_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $model_delete->ShowPageHeader(); ?>
<?php

// Load records for display
if ($model_delete->Recordset = $model_delete->LoadRecordset())
	$model_deleteTotalRecs = $model_delete->Recordset->RecordCount(); // Get record count
if ($model_deleteTotalRecs <= 0) { // No record found, exit
	if ($model_delete->Recordset)
		$model_delete->Recordset->Close();
	$model_delete->Page_Terminate("modellist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $model->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $model->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$model_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="model">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($model_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $model->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $model->coid->FldCaption() ?></td>
		<td valign="top"><?php echo $model->moid->FldCaption() ?></td>
		<td valign="top"><?php echo $model->model_name->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$model_delete->RecCnt = 0;
$i = 0;
while (!$model_delete->Recordset->EOF) {
	$model_delete->RecCnt++;

	// Set row properties
	$model->ResetAttrs();
	$model->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$model_delete->LoadRowValues($model_delete->Recordset);

	// Render row
	$model_delete->RenderRow();
?>
	<tr<?php echo $model->RowAttributes() ?>>
		<td<?php echo $model->coid->CellAttributes() ?>>
<div<?php echo $model->coid->ViewAttributes() ?>><?php echo $model->coid->ListViewValue() ?></div></td>
		<td<?php echo $model->moid->CellAttributes() ?>>
<div<?php echo $model->moid->ViewAttributes() ?>><?php echo $model->moid->ListViewValue() ?></div></td>
		<td<?php echo $model->model_name->CellAttributes() ?>>
<div<?php echo $model->model_name->ViewAttributes() ?>><?php echo $model->model_name->ListViewValue() ?></div></td>
	</tr>
<?php
	$model_delete->Recordset->MoveNext();
}
$model_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$model_delete->ShowPageFooter();
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
$model_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cmodel_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'model';

	// Page object name
	var $PageObjName = 'model_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $model;
		if ($model->UseTokenInUrl) $PageUrl .= "t=" . $model->TableVar . "&"; // Add page token
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
		global $objForm, $model;
		if ($model->UseTokenInUrl) {
			if ($objForm)
				return ($model->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($model->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmodel_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (model)
		if (!isset($GLOBALS["model"])) {
			$GLOBALS["model"] = new cmodel();
			$GLOBALS["Table"] =& $GLOBALS["model"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'model', TRUE);

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
		global $model;

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
		global $Language, $model;

		// Load key parameters
		$this->RecKeys = $model->GetRecordKeys(); // Load record keys
		$sFilter = $model->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("modellist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in model class, modelinfo.php

		$model->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$model->CurrentAction = $_POST["a_delete"];
		} else {
			$model->CurrentAction = "I"; // Display record
		}
		switch ($model->CurrentAction) {
			case "D": // Delete
				$model->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($model->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $model;

		// Call Recordset Selecting event
		$model->Recordset_Selecting($model->CurrentFilter);

		// Load List page SQL
		$sSql = $model->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$model->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $model;
		$sFilter = $model->KeyFilter();

		// Call Row Selecting event
		$model->Row_Selecting($sFilter);

		// Load SQL based on filter
		$model->CurrentFilter = $sFilter;
		$sSql = $model->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$model->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $model;
		if (!$rs || $rs->EOF) return;
		$model->coid->setDbValue($rs->fields('coid'));
		$model->moid->setDbValue($rs->fields('moid'));
		$model->model_name->setDbValue($rs->fields('model_name'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $model;

		// Initialize URLs
		// Call Row_Rendering event

		$model->Row_Rendering();

		// Common render codes for all row types
		// coid
		// moid
		// model_name

		if ($model->RowType == EW_ROWTYPE_VIEW) { // View row

			// coid
			$model->coid->ViewValue = $model->coid->CurrentValue;
			$model->coid->ViewCustomAttributes = "";

			// moid
			$model->moid->ViewValue = $model->moid->CurrentValue;
			$model->moid->ViewCustomAttributes = "";

			// model_name
			$model->model_name->ViewValue = $model->model_name->CurrentValue;
			$model->model_name->ViewCustomAttributes = "";

			// coid
			$model->coid->LinkCustomAttributes = "";
			$model->coid->HrefValue = "";
			$model->coid->TooltipValue = "";

			// moid
			$model->moid->LinkCustomAttributes = "";
			$model->moid->HrefValue = "";
			$model->moid->TooltipValue = "";

			// model_name
			$model->model_name->LinkCustomAttributes = "";
			$model->model_name->HrefValue = "";
			$model->model_name->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($model->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$model->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $model;
		$DeleteRows = TRUE;
		$sSql = $model->SQL();
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
				$DeleteRows = $model->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['model_name'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($model->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($model->CancelMessage <> "") {
				$this->setFailureMessage($model->CancelMessage);
				$model->CancelMessage = "";
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
				$model->Row_Deleted($row);
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
