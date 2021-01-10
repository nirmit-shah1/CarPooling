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
$logincount_edit = new clogincount_edit();
$Page =& $logincount_edit;

// Page init
$logincount_edit->Page_Init();

// Page main
$logincount_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var logincount_edit = new ew_Page("logincount_edit");

// page properties
logincount_edit.PageID = "edit"; // page ID
logincount_edit.FormID = "flogincountedit"; // form ID
var EW_PAGE_ID = logincount_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
logincount_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_dt_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($logincount->dt_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_dt_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($logincount->dt_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_reg_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($logincount->reg_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_reg_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($logincount->reg_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_logincounter"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($logincount->logincounter->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_logincounter"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($logincount->logincounter->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($logincount->date->FldCaption()) ?>");

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
logincount_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
logincount_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logincount_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $logincount_edit->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $logincount->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $logincount->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$logincount_edit->ShowMessage();
?>
<form name="flogincountedit" id="flogincountedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return logincount_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="logincount">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($logincount->dt_id->Visible) { // dt_id ?>
	<tr id="r_dt_id"<?php echo $logincount->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $logincount->dt_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $logincount->dt_id->CellAttributes() ?>><span id="el_dt_id">
<div<?php echo $logincount->dt_id->ViewAttributes() ?>><?php echo $logincount->dt_id->EditValue ?></div>
<input type="hidden" name="x_dt_id" id="x_dt_id" value="<?php echo ew_HtmlEncode($logincount->dt_id->CurrentValue) ?>">
</span><?php echo $logincount->dt_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($logincount->reg_id->Visible) { // reg_id ?>
	<tr id="r_reg_id"<?php echo $logincount->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $logincount->reg_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $logincount->reg_id->CellAttributes() ?>><span id="el_reg_id">
<input type="text" name="x_reg_id" id="x_reg_id" size="30" value="<?php echo $logincount->reg_id->EditValue ?>"<?php echo $logincount->reg_id->EditAttributes() ?>>
</span><?php echo $logincount->reg_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($logincount->logincounter->Visible) { // logincounter ?>
	<tr id="r_logincounter"<?php echo $logincount->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $logincount->logincounter->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $logincount->logincounter->CellAttributes() ?>><span id="el_logincounter">
<input type="text" name="x_logincounter" id="x_logincounter" size="30" value="<?php echo $logincount->logincounter->EditValue ?>"<?php echo $logincount->logincounter->EditAttributes() ?>>
</span><?php echo $logincount->logincounter->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($logincount->date->Visible) { // date ?>
	<tr id="r_date"<?php echo $logincount->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $logincount->date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $logincount->date->CellAttributes() ?>><span id="el_date">
<input type="text" name="x_date" id="x_date" size="30" maxlength="15" value="<?php echo $logincount->date->EditValue ?>"<?php echo $logincount->date->EditAttributes() ?>>
</span><?php echo $logincount->date->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$logincount_edit->ShowPageFooter();
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
$logincount_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class clogincount_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'logincount';

	// Page object name
	var $PageObjName = 'logincount_edit';

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
	function clogincount_edit() {
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
			define("EW_PAGE_ID", 'edit', TRUE);

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
		global $objForm, $Language, $gsFormError, $logincount;

		// Load key from QueryString
		if (@$_GET["dt_id"] <> "")
			$logincount->dt_id->setQueryStringValue($_GET["dt_id"]);
		if (@$_POST["a_edit"] <> "") {
			$logincount->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$logincount->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$logincount->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$logincount->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($logincount->dt_id->CurrentValue == "")
			$this->Page_Terminate("logincountlist.php"); // Invalid key, return to list
		switch ($logincount->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("logincountlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$logincount->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $logincount->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$logincount->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$logincount->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$logincount->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $logincount;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $logincount;
		if (!$logincount->dt_id->FldIsDetailKey) {
			$logincount->dt_id->setFormValue($objForm->GetValue("x_dt_id"));
		}
		if (!$logincount->reg_id->FldIsDetailKey) {
			$logincount->reg_id->setFormValue($objForm->GetValue("x_reg_id"));
		}
		if (!$logincount->logincounter->FldIsDetailKey) {
			$logincount->logincounter->setFormValue($objForm->GetValue("x_logincounter"));
		}
		if (!$logincount->date->FldIsDetailKey) {
			$logincount->date->setFormValue($objForm->GetValue("x_date"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $logincount;
		$this->LoadRow();
		$logincount->dt_id->CurrentValue = $logincount->dt_id->FormValue;
		$logincount->reg_id->CurrentValue = $logincount->reg_id->FormValue;
		$logincount->logincounter->CurrentValue = $logincount->logincounter->FormValue;
		$logincount->date->CurrentValue = $logincount->date->FormValue;
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
		} elseif ($logincount->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// dt_id
			$logincount->dt_id->EditCustomAttributes = "";
			$logincount->dt_id->EditValue = $logincount->dt_id->CurrentValue;
			$logincount->dt_id->ViewCustomAttributes = "";

			// reg_id
			$logincount->reg_id->EditCustomAttributes = "";
			$logincount->reg_id->EditValue = ew_HtmlEncode($logincount->reg_id->CurrentValue);

			// logincounter
			$logincount->logincounter->EditCustomAttributes = "";
			$logincount->logincounter->EditValue = ew_HtmlEncode($logincount->logincounter->CurrentValue);

			// date
			$logincount->date->EditCustomAttributes = "";
			$logincount->date->EditValue = ew_HtmlEncode($logincount->date->CurrentValue);

			// Edit refer script
			// dt_id

			$logincount->dt_id->HrefValue = "";

			// reg_id
			$logincount->reg_id->HrefValue = "";

			// logincounter
			$logincount->logincounter->HrefValue = "";

			// date
			$logincount->date->HrefValue = "";
		}
		if ($logincount->RowType == EW_ROWTYPE_ADD ||
			$logincount->RowType == EW_ROWTYPE_EDIT ||
			$logincount->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$logincount->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($logincount->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$logincount->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $logincount;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($logincount->dt_id->FormValue) && $logincount->dt_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $logincount->dt_id->FldCaption());
		}
		if (!ew_CheckInteger($logincount->dt_id->FormValue)) {
			ew_AddMessage($gsFormError, $logincount->dt_id->FldErrMsg());
		}
		if (!is_null($logincount->reg_id->FormValue) && $logincount->reg_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $logincount->reg_id->FldCaption());
		}
		if (!ew_CheckInteger($logincount->reg_id->FormValue)) {
			ew_AddMessage($gsFormError, $logincount->reg_id->FldErrMsg());
		}
		if (!is_null($logincount->logincounter->FormValue) && $logincount->logincounter->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $logincount->logincounter->FldCaption());
		}
		if (!ew_CheckInteger($logincount->logincounter->FormValue)) {
			ew_AddMessage($gsFormError, $logincount->logincounter->FldErrMsg());
		}
		if (!is_null($logincount->date->FormValue) && $logincount->date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $logincount->date->FldCaption());
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
		global $conn, $Security, $Language, $logincount;
		$sFilter = $logincount->KeyFilter();
		$logincount->CurrentFilter = $sFilter;
		$sSql = $logincount->SQL();
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

			// dt_id
			// reg_id

			$logincount->reg_id->SetDbValueDef($rsnew, $logincount->reg_id->CurrentValue, 0, FALSE);

			// logincounter
			$logincount->logincounter->SetDbValueDef($rsnew, $logincount->logincounter->CurrentValue, 0, FALSE);

			// date
			$logincount->date->SetDbValueDef($rsnew, $logincount->date->CurrentValue, "", FALSE);

			// Call Row Updating event
			$bUpdateRow = $logincount->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($logincount->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($logincount->CancelMessage <> "") {
					$this->setFailureMessage($logincount->CancelMessage);
					$logincount->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$logincount->Row_Updated($rsold, $rsnew);
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
