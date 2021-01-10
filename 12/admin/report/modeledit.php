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
$model_edit = new cmodel_edit();
$Page =& $model_edit;

// Page init
$model_edit->Page_Init();

// Page main
$model_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var model_edit = new ew_Page("model_edit");

// page properties
model_edit.PageID = "edit"; // page ID
model_edit.FormID = "fmodeledit"; // form ID
var EW_PAGE_ID = model_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
model_edit.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($model->coid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_coid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($model->coid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_moid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($model->moid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_moid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($model->moid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_model_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($model->model_name->FldCaption()) ?>");

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
model_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
model_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
model_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $model_edit->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $model->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $model->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$model_edit->ShowMessage();
?>
<form name="fmodeledit" id="fmodeledit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return model_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="model">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($model->coid->Visible) { // coid ?>
	<tr id="r_coid"<?php echo $model->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $model->coid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $model->coid->CellAttributes() ?>><span id="el_coid">
<input type="text" name="x_coid" id="x_coid" size="30" value="<?php echo $model->coid->EditValue ?>"<?php echo $model->coid->EditAttributes() ?>>
</span><?php echo $model->coid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($model->moid->Visible) { // moid ?>
	<tr id="r_moid"<?php echo $model->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $model->moid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $model->moid->CellAttributes() ?>><span id="el_moid">
<input type="text" name="x_moid" id="x_moid" size="30" value="<?php echo $model->moid->EditValue ?>"<?php echo $model->moid->EditAttributes() ?>>
</span><?php echo $model->moid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($model->model_name->Visible) { // model_name ?>
	<tr id="r_model_name"<?php echo $model->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $model->model_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $model->model_name->CellAttributes() ?>><span id="el_model_name">
<div<?php echo $model->model_name->ViewAttributes() ?>><?php echo $model->model_name->EditValue ?></div>
<input type="hidden" name="x_model_name" id="x_model_name" value="<?php echo ew_HtmlEncode($model->model_name->CurrentValue) ?>">
</span><?php echo $model->model_name->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$model_edit->ShowPageFooter();
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
$model_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cmodel_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'model';

	// Page object name
	var $PageObjName = 'model_edit';

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
	function cmodel_edit() {
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
			define("EW_PAGE_ID", 'edit', TRUE);

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
		global $objForm, $Language, $gsFormError, $model;

		// Load key from QueryString
		if (@$_GET["model_name"] <> "")
			$model->model_name->setQueryStringValue($_GET["model_name"]);
		if (@$_POST["a_edit"] <> "") {
			$model->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$model->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$model->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$model->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($model->model_name->CurrentValue == "")
			$this->Page_Terminate("modellist.php"); // Invalid key, return to list
		switch ($model->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("modellist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$model->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $model->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$model->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$model->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$model->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $model;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $model;
		if (!$model->coid->FldIsDetailKey) {
			$model->coid->setFormValue($objForm->GetValue("x_coid"));
		}
		if (!$model->moid->FldIsDetailKey) {
			$model->moid->setFormValue($objForm->GetValue("x_moid"));
		}
		if (!$model->model_name->FldIsDetailKey) {
			$model->model_name->setFormValue($objForm->GetValue("x_model_name"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $model;
		$this->LoadRow();
		$model->coid->CurrentValue = $model->coid->FormValue;
		$model->moid->CurrentValue = $model->moid->FormValue;
		$model->model_name->CurrentValue = $model->model_name->FormValue;
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
		} elseif ($model->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// coid
			$model->coid->EditCustomAttributes = "";
			$model->coid->EditValue = ew_HtmlEncode($model->coid->CurrentValue);

			// moid
			$model->moid->EditCustomAttributes = "";
			$model->moid->EditValue = ew_HtmlEncode($model->moid->CurrentValue);

			// model_name
			$model->model_name->EditCustomAttributes = "";
			$model->model_name->EditValue = $model->model_name->CurrentValue;
			$model->model_name->ViewCustomAttributes = "";

			// Edit refer script
			// coid

			$model->coid->HrefValue = "";

			// moid
			$model->moid->HrefValue = "";

			// model_name
			$model->model_name->HrefValue = "";
		}
		if ($model->RowType == EW_ROWTYPE_ADD ||
			$model->RowType == EW_ROWTYPE_EDIT ||
			$model->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$model->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($model->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$model->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $model;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($model->coid->FormValue) && $model->coid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $model->coid->FldCaption());
		}
		if (!ew_CheckInteger($model->coid->FormValue)) {
			ew_AddMessage($gsFormError, $model->coid->FldErrMsg());
		}
		if (!is_null($model->moid->FormValue) && $model->moid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $model->moid->FldCaption());
		}
		if (!ew_CheckInteger($model->moid->FormValue)) {
			ew_AddMessage($gsFormError, $model->moid->FldErrMsg());
		}
		if (!is_null($model->model_name->FormValue) && $model->model_name->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $model->model_name->FldCaption());
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
		global $conn, $Security, $Language, $model;
		$sFilter = $model->KeyFilter();
		$model->CurrentFilter = $sFilter;
		$sSql = $model->SQL();
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
			$model->coid->SetDbValueDef($rsnew, $model->coid->CurrentValue, 0, FALSE);

			// moid
			$model->moid->SetDbValueDef($rsnew, $model->moid->CurrentValue, 0, FALSE);

			// model_name
			// Call Row Updating event

			$bUpdateRow = $model->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($model->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($model->CancelMessage <> "") {
					$this->setFailureMessage($model->CancelMessage);
					$model->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$model->Row_Updated($rsold, $rsnew);
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
