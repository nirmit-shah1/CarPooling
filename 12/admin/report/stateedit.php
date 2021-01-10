<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "stateinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$state_edit = new cstate_edit();
$Page =& $state_edit;

// Page init
$state_edit->Page_Init();

// Page main
$state_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var state_edit = new ew_Page("state_edit");

// page properties
state_edit.PageID = "edit"; // page ID
state_edit.FormID = "fstateedit"; // form ID
var EW_PAGE_ID = state_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
state_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_sid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($state->sid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_sid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($state->sid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_state_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($state->state_name->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}

	// Process detail page
	var detailpage = (fobj.detailpage) ? fobj.detailpage.value : "";
	if (detailpage != "") {
		return eval(detailpage+".ValidateForm(fobj)");
	}
	return true;
}

// extend page with Form_CustomValidate function
state_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
state_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
state_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $state_edit->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $state->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $state->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$state_edit->ShowMessage();
?>
<form name="fstateedit" id="fstateedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return state_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="state">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($state->sid->Visible) { // sid ?>
	<tr id="r_sid"<?php echo $state->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $state->sid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $state->sid->CellAttributes() ?>><span id="el_sid">
<input type="text" name="x_sid" id="x_sid" size="30" value="<?php echo $state->sid->EditValue ?>"<?php echo $state->sid->EditAttributes() ?>>
</span><?php echo $state->sid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($state->state_name->Visible) { // state_name ?>
	<tr id="r_state_name"<?php echo $state->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $state->state_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $state->state_name->CellAttributes() ?>><span id="el_state_name">
<div<?php echo $state->state_name->ViewAttributes() ?>><?php echo $state->state_name->EditValue ?></div>
<input type="hidden" name="x_state_name" id="x_state_name" value="<?php echo ew_HtmlEncode($state->state_name->CurrentValue) ?>">
</span><?php echo $state->state_name->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$state_edit->ShowPageFooter();
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
$state_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cstate_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'state';

	// Page object name
	var $PageObjName = 'state_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $state;
		if ($state->UseTokenInUrl) $PageUrl .= "t=" . $state->TableVar . "&"; // Add page token
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
		global $objForm, $state;
		if ($state->UseTokenInUrl) {
			if ($objForm)
				return ($state->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($state->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cstate_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (state)
		if (!isset($GLOBALS["state"])) {
			$GLOBALS["state"] = new cstate();
			$GLOBALS["Table"] =& $GLOBALS["state"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'state', TRUE);

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
		global $state;

		// Create form object
		$objForm = new cFormObj();

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
	var $DbMasterFilter;
	var $DbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $state;

		// Load key from QueryString
		if (@$_GET["state_name"] <> "")
			$state->state_name->setQueryStringValue($_GET["state_name"]);
		if (@$_POST["a_edit"] <> "") {
			$state->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$state->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$state->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$state->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($state->state_name->CurrentValue == "")
			$this->Page_Terminate("statelist.php"); // Invalid key, return to list
		switch ($state->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("statelist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$state->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $state->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$state->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$state->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$state->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $state;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $state;
		if (!$state->sid->FldIsDetailKey) {
			$state->sid->setFormValue($objForm->GetValue("x_sid"));
		}
		if (!$state->state_name->FldIsDetailKey) {
			$state->state_name->setFormValue($objForm->GetValue("x_state_name"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $state;
		$this->LoadRow();
		$state->sid->CurrentValue = $state->sid->FormValue;
		$state->state_name->CurrentValue = $state->state_name->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $state;
		$sFilter = $state->KeyFilter();

		// Call Row Selecting event
		$state->Row_Selecting($sFilter);

		// Load SQL based on filter
		$state->CurrentFilter = $sFilter;
		$sSql = $state->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$state->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $state;
		if (!$rs || $rs->EOF) return;
		$state->sid->setDbValue($rs->fields('sid'));
		$state->state_name->setDbValue($rs->fields('state_name'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $state;

		// Initialize URLs
		// Call Row_Rendering event

		$state->Row_Rendering();

		// Common render codes for all row types
		// sid
		// state_name

		if ($state->RowType == EW_ROWTYPE_VIEW) { // View row

			// sid
			$state->sid->ViewValue = $state->sid->CurrentValue;
			$state->sid->ViewCustomAttributes = "";

			// state_name
			$state->state_name->ViewValue = $state->state_name->CurrentValue;
			$state->state_name->ViewCustomAttributes = "";

			// sid
			$state->sid->LinkCustomAttributes = "";
			$state->sid->HrefValue = "";
			$state->sid->TooltipValue = "";

			// state_name
			$state->state_name->LinkCustomAttributes = "";
			$state->state_name->HrefValue = "";
			$state->state_name->TooltipValue = "";
		} elseif ($state->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// sid
			$state->sid->EditCustomAttributes = "";
			$state->sid->EditValue = ew_HtmlEncode($state->sid->CurrentValue);

			// state_name
			$state->state_name->EditCustomAttributes = "";
			$state->state_name->EditValue = $state->state_name->CurrentValue;
			$state->state_name->ViewCustomAttributes = "";

			// Edit refer script
			// sid

			$state->sid->HrefValue = "";

			// state_name
			$state->state_name->HrefValue = "";
		}
		if ($state->RowType == EW_ROWTYPE_ADD ||
			$state->RowType == EW_ROWTYPE_EDIT ||
			$state->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$state->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($state->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$state->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $state;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($state->sid->FormValue) && $state->sid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $state->sid->FldCaption());
		}
		if (!ew_CheckInteger($state->sid->FormValue)) {
			ew_AddMessage($gsFormError, $state->sid->FldErrMsg());
		}
		if (!is_null($state->state_name->FormValue) && $state->state_name->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $state->state_name->FldCaption());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $state;
		$sFilter = $state->KeyFilter();
		$state->CurrentFilter = $sFilter;
		$sSql = $state->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// sid
			$state->sid->SetDbValueDef($rsnew, $state->sid->CurrentValue, 0, FALSE);

			// state_name
			// Call Row Updating event

			$bUpdateRow = $state->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($state->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($state->CancelMessage <> "") {
					$this->setFailureMessage($state->CancelMessage);
					$state->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$state->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
