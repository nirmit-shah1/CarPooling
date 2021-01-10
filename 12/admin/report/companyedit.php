<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "companyinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$company_edit = new ccompany_edit();
$Page =& $company_edit;

// Page init
$company_edit->Page_Init();

// Page main
$company_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var company_edit = new ew_Page("company_edit");

// page properties
company_edit.PageID = "edit"; // page ID
company_edit.FormID = "fcompanyedit"; // form ID
var EW_PAGE_ID = company_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
company_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_coid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($company->coid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_coid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($company->coid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_company_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($company->company_name->FldCaption()) ?>");

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
company_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
company_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
company_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $company_edit->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $company->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $company->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$company_edit->ShowMessage();
?>
<form name="fcompanyedit" id="fcompanyedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return company_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="company">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($company->coid->Visible) { // coid ?>
	<tr id="r_coid"<?php echo $company->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $company->coid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $company->coid->CellAttributes() ?>><span id="el_coid">
<input type="text" name="x_coid" id="x_coid" size="30" value="<?php echo $company->coid->EditValue ?>"<?php echo $company->coid->EditAttributes() ?>>
</span><?php echo $company->coid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($company->company_name->Visible) { // company_name ?>
	<tr id="r_company_name"<?php echo $company->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $company->company_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $company->company_name->CellAttributes() ?>><span id="el_company_name">
<div<?php echo $company->company_name->ViewAttributes() ?>><?php echo $company->company_name->EditValue ?></div>
<input type="hidden" name="x_company_name" id="x_company_name" value="<?php echo ew_HtmlEncode($company->company_name->CurrentValue) ?>">
</span><?php echo $company->company_name->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$company_edit->ShowPageFooter();
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
$company_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ccompany_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'company';

	// Page object name
	var $PageObjName = 'company_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $company;
		if ($company->UseTokenInUrl) $PageUrl .= "t=" . $company->TableVar . "&"; // Add page token
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
		global $objForm, $company;
		if ($company->UseTokenInUrl) {
			if ($objForm)
				return ($company->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($company->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccompany_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (company)
		if (!isset($GLOBALS["company"])) {
			$GLOBALS["company"] = new ccompany();
			$GLOBALS["Table"] =& $GLOBALS["company"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'company', TRUE);

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
		global $company;

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
		global $objForm, $Language, $gsFormError, $company;

		// Load key from QueryString
		if (@$_GET["company_name"] <> "")
			$company->company_name->setQueryStringValue($_GET["company_name"]);
		if (@$_POST["a_edit"] <> "") {
			$company->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$company->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$company->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$company->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($company->company_name->CurrentValue == "")
			$this->Page_Terminate("companylist.php"); // Invalid key, return to list
		switch ($company->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("companylist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$company->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $company->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$company->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$company->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$company->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $company;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $company;
		if (!$company->coid->FldIsDetailKey) {
			$company->coid->setFormValue($objForm->GetValue("x_coid"));
		}
		if (!$company->company_name->FldIsDetailKey) {
			$company->company_name->setFormValue($objForm->GetValue("x_company_name"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $company;
		$this->LoadRow();
		$company->coid->CurrentValue = $company->coid->FormValue;
		$company->company_name->CurrentValue = $company->company_name->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $company;
		$sFilter = $company->KeyFilter();

		// Call Row Selecting event
		$company->Row_Selecting($sFilter);

		// Load SQL based on filter
		$company->CurrentFilter = $sFilter;
		$sSql = $company->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$company->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $company;
		if (!$rs || $rs->EOF) return;
		$company->coid->setDbValue($rs->fields('coid'));
		$company->company_name->setDbValue($rs->fields('company_name'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $company;

		// Initialize URLs
		// Call Row_Rendering event

		$company->Row_Rendering();

		// Common render codes for all row types
		// coid
		// company_name

		if ($company->RowType == EW_ROWTYPE_VIEW) { // View row

			// coid
			$company->coid->ViewValue = $company->coid->CurrentValue;
			$company->coid->ViewCustomAttributes = "";

			// company_name
			$company->company_name->ViewValue = $company->company_name->CurrentValue;
			$company->company_name->ViewCustomAttributes = "";

			// coid
			$company->coid->LinkCustomAttributes = "";
			$company->coid->HrefValue = "";
			$company->coid->TooltipValue = "";

			// company_name
			$company->company_name->LinkCustomAttributes = "";
			$company->company_name->HrefValue = "";
			$company->company_name->TooltipValue = "";
		} elseif ($company->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// coid
			$company->coid->EditCustomAttributes = "";
			$company->coid->EditValue = ew_HtmlEncode($company->coid->CurrentValue);

			// company_name
			$company->company_name->EditCustomAttributes = "";
			$company->company_name->EditValue = $company->company_name->CurrentValue;
			$company->company_name->ViewCustomAttributes = "";

			// Edit refer script
			// coid

			$company->coid->HrefValue = "";

			// company_name
			$company->company_name->HrefValue = "";
		}
		if ($company->RowType == EW_ROWTYPE_ADD ||
			$company->RowType == EW_ROWTYPE_EDIT ||
			$company->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$company->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($company->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$company->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $company;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($company->coid->FormValue) && $company->coid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $company->coid->FldCaption());
		}
		if (!ew_CheckInteger($company->coid->FormValue)) {
			ew_AddMessage($gsFormError, $company->coid->FldErrMsg());
		}
		if (!is_null($company->company_name->FormValue) && $company->company_name->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $company->company_name->FldCaption());
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
		global $conn, $Security, $Language, $company;
		$sFilter = $company->KeyFilter();
		$company->CurrentFilter = $sFilter;
		$sSql = $company->SQL();
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

			// coid
			$company->coid->SetDbValueDef($rsnew, $company->coid->CurrentValue, 0, FALSE);

			// company_name
			// Call Row Updating event

			$bUpdateRow = $company->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($company->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($company->CancelMessage <> "") {
					$this->setFailureMessage($company->CancelMessage);
					$company->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$company->Row_Updated($rsold, $rsnew);
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
