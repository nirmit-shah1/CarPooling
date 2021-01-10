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
$area_edit = new carea_edit();
$Page =& $area_edit;

// Page init
$area_edit->Page_Init();

// Page main
$area_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var area_edit = new ew_Page("area_edit");

// page properties
area_edit.PageID = "edit"; // page ID
area_edit.FormID = "fareaedit"; // form ID
var EW_PAGE_ID = area_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
area_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_aid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($area->aid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_aid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($area->aid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_sid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($area->sid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_sid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($area->sid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_cid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($area->cid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_cid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($area->cid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_area_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($area->area_name->FldCaption()) ?>");

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
area_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
area_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
area_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $area_edit->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $area->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $area->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$area_edit->ShowMessage();
?>
<form name="fareaedit" id="fareaedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return area_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="area">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($area->aid->Visible) { // aid ?>
	<tr id="r_aid"<?php echo $area->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $area->aid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $area->aid->CellAttributes() ?>><span id="el_aid">
<input type="text" name="x_aid" id="x_aid" size="30" value="<?php echo $area->aid->EditValue ?>"<?php echo $area->aid->EditAttributes() ?>>
</span><?php echo $area->aid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($area->sid->Visible) { // sid ?>
	<tr id="r_sid"<?php echo $area->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $area->sid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $area->sid->CellAttributes() ?>><span id="el_sid">
<input type="text" name="x_sid" id="x_sid" size="30" value="<?php echo $area->sid->EditValue ?>"<?php echo $area->sid->EditAttributes() ?>>
</span><?php echo $area->sid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($area->cid->Visible) { // cid ?>
	<tr id="r_cid"<?php echo $area->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $area->cid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $area->cid->CellAttributes() ?>><span id="el_cid">
<input type="text" name="x_cid" id="x_cid" size="30" value="<?php echo $area->cid->EditValue ?>"<?php echo $area->cid->EditAttributes() ?>>
</span><?php echo $area->cid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($area->area_name->Visible) { // area_name ?>
	<tr id="r_area_name"<?php echo $area->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $area->area_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $area->area_name->CellAttributes() ?>><span id="el_area_name">
<div<?php echo $area->area_name->ViewAttributes() ?>><?php echo $area->area_name->EditValue ?></div>
<input type="hidden" name="x_area_name" id="x_area_name" value="<?php echo ew_HtmlEncode($area->area_name->CurrentValue) ?>">
</span><?php echo $area->area_name->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$area_edit->ShowPageFooter();
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
$area_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class carea_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'area';

	// Page object name
	var $PageObjName = 'area_edit';

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
	function carea_edit() {
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
			define("EW_PAGE_ID", 'edit', TRUE);

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
		global $objForm, $Language, $gsFormError, $area;

		// Load key from QueryString
		if (@$_GET["area_name"] <> "")
			$area->area_name->setQueryStringValue($_GET["area_name"]);
		if (@$_POST["a_edit"] <> "") {
			$area->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$area->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$area->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$area->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($area->area_name->CurrentValue == "")
			$this->Page_Terminate("arealist.php"); // Invalid key, return to list
		switch ($area->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("arealist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$area->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $area->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$area->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$area->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$area->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $area;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $area;
		if (!$area->aid->FldIsDetailKey) {
			$area->aid->setFormValue($objForm->GetValue("x_aid"));
		}
		if (!$area->sid->FldIsDetailKey) {
			$area->sid->setFormValue($objForm->GetValue("x_sid"));
		}
		if (!$area->cid->FldIsDetailKey) {
			$area->cid->setFormValue($objForm->GetValue("x_cid"));
		}
		if (!$area->area_name->FldIsDetailKey) {
			$area->area_name->setFormValue($objForm->GetValue("x_area_name"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $area;
		$this->LoadRow();
		$area->aid->CurrentValue = $area->aid->FormValue;
		$area->sid->CurrentValue = $area->sid->FormValue;
		$area->cid->CurrentValue = $area->cid->FormValue;
		$area->area_name->CurrentValue = $area->area_name->FormValue;
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
		} elseif ($area->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// aid
			$area->aid->EditCustomAttributes = "";
			$area->aid->EditValue = ew_HtmlEncode($area->aid->CurrentValue);

			// sid
			$area->sid->EditCustomAttributes = "";
			$area->sid->EditValue = ew_HtmlEncode($area->sid->CurrentValue);

			// cid
			$area->cid->EditCustomAttributes = "";
			$area->cid->EditValue = ew_HtmlEncode($area->cid->CurrentValue);

			// area_name
			$area->area_name->EditCustomAttributes = "";
			$area->area_name->EditValue = $area->area_name->CurrentValue;
			$area->area_name->ViewCustomAttributes = "";

			// Edit refer script
			// aid

			$area->aid->HrefValue = "";

			// sid
			$area->sid->HrefValue = "";

			// cid
			$area->cid->HrefValue = "";

			// area_name
			$area->area_name->HrefValue = "";
		}
		if ($area->RowType == EW_ROWTYPE_ADD ||
			$area->RowType == EW_ROWTYPE_EDIT ||
			$area->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$area->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($area->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$area->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $area;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($area->aid->FormValue) && $area->aid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $area->aid->FldCaption());
		}
		if (!ew_CheckInteger($area->aid->FormValue)) {
			ew_AddMessage($gsFormError, $area->aid->FldErrMsg());
		}
		if (!is_null($area->sid->FormValue) && $area->sid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $area->sid->FldCaption());
		}
		if (!ew_CheckInteger($area->sid->FormValue)) {
			ew_AddMessage($gsFormError, $area->sid->FldErrMsg());
		}
		if (!is_null($area->cid->FormValue) && $area->cid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $area->cid->FldCaption());
		}
		if (!ew_CheckInteger($area->cid->FormValue)) {
			ew_AddMessage($gsFormError, $area->cid->FldErrMsg());
		}
		if (!is_null($area->area_name->FormValue) && $area->area_name->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $area->area_name->FldCaption());
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
		global $conn, $Security, $Language, $area;
		$sFilter = $area->KeyFilter();
		$area->CurrentFilter = $sFilter;
		$sSql = $area->SQL();
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

			// aid
			$area->aid->SetDbValueDef($rsnew, $area->aid->CurrentValue, 0, FALSE);

			// sid
			$area->sid->SetDbValueDef($rsnew, $area->sid->CurrentValue, 0, FALSE);

			// cid
			$area->cid->SetDbValueDef($rsnew, $area->cid->CurrentValue, 0, FALSE);

			// area_name
			// Call Row Updating event

			$bUpdateRow = $area->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($area->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($area->CancelMessage <> "") {
					$this->setFailureMessage($area->CancelMessage);
					$area->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$area->Row_Updated($rsold, $rsnew);
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
