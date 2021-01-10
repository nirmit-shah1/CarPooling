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
$model_add = new cmodel_add();
$Page =& $model_add;

// Page init
$model_add->Page_Init();

// Page main
$model_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var model_add = new ew_Page("model_add");

// page properties
model_add.PageID = "add"; // page ID
model_add.FormID = "fmodeladd"; // form ID
var EW_PAGE_ID = model_add.PageID; // for backward compatibility

// extend page with ValidateForm function
model_add.ValidateForm = function(fobj) {
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
model_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
model_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
model_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $model_add->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $model->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $model->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$model_add->ShowMessage();
?>
<form name="fmodeladd" id="fmodeladd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return model_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="model">
<input type="hidden" name="a_add" id="a_add" value="A">
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
<input type="text" name="x_model_name" id="x_model_name" size="30" maxlength="20" value="<?php echo $model->model_name->EditValue ?>"<?php echo $model->model_name->EditAttributes() ?>>
</span><?php echo $model->model_name->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$model_add->ShowPageFooter();
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
$model_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cmodel_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'model';

	// Page object name
	var $PageObjName = 'model_add';

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
	function cmodel_add() {
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
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $model;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$model->CurrentAction = $_POST["a_add"]; // Get form action
			$this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$model->CurrentAction = "I"; // Form error, reset action
				$model->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$bCopy = TRUE;
			if (@$_GET["model_name"] != "") {
				$model->model_name->setQueryStringValue($_GET["model_name"]);
				$model->setKey("model_name", $model->model_name->CurrentValue); // Set up key
			} else {
				$model->setKey("model_name", ""); // Clear key
				$bCopy = FALSE;
			}
			if ($bCopy) {
				$model->CurrentAction = "C"; // Copy record
			} else {
				$model->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($model->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("modellist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$model->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $model->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "modelview.php")
						$sReturnUrl = $model->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$model->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$model->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $model;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $model;
		$model->coid->CurrentValue = NULL;
		$model->coid->OldValue = $model->coid->CurrentValue;
		$model->moid->CurrentValue = NULL;
		$model->moid->OldValue = $model->moid->CurrentValue;
		$model->model_name->CurrentValue = NULL;
		$model->model_name->OldValue = $model->model_name->CurrentValue;
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
		$this->LoadOldRecord();
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

	// Load old record
	function LoadOldRecord() {
		global $model;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($model->getKey("model_name")) <> "")
			$model->model_name->CurrentValue = $model->getKey("model_name"); // model_name
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$model->CurrentFilter = $model->KeyFilter();
			$sSql = $model->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
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
		} elseif ($model->RowType == EW_ROWTYPE_ADD) { // Add row

			// coid
			$model->coid->EditCustomAttributes = "";
			$model->coid->EditValue = ew_HtmlEncode($model->coid->CurrentValue);

			// moid
			$model->moid->EditCustomAttributes = "";
			$model->moid->EditValue = ew_HtmlEncode($model->moid->CurrentValue);

			// model_name
			$model->model_name->EditCustomAttributes = "";
			$model->model_name->EditValue = ew_HtmlEncode($model->model_name->CurrentValue);

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

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $model;

		// Check if key value entered
		if ($model->model_name->CurrentValue == "" && $model->model_name->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $model->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $model->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// coid
		$model->coid->SetDbValueDef($rsnew, $model->coid->CurrentValue, 0, FALSE);

		// moid
		$model->moid->SetDbValueDef($rsnew, $model->moid->CurrentValue, 0, FALSE);

		// model_name
		$model->model_name->SetDbValueDef($rsnew, $model->model_name->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $model->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($model->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($model->CancelMessage <> "") {
				$this->setFailureMessage($model->CancelMessage);
				$model->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$model->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
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
