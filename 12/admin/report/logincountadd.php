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
$logincount_add = new clogincount_add();
$Page =& $logincount_add;

// Page init
$logincount_add->Page_Init();

// Page main
$logincount_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var logincount_add = new ew_Page("logincount_add");

// page properties
logincount_add.PageID = "add"; // page ID
logincount_add.FormID = "flogincountadd"; // form ID
var EW_PAGE_ID = logincount_add.PageID; // for backward compatibility

// extend page with ValidateForm function
logincount_add.ValidateForm = function(fobj) {
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
logincount_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
logincount_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logincount_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $logincount_add->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $logincount->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $logincount->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$logincount_add->ShowMessage();
?>
<form name="flogincountadd" id="flogincountadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return logincount_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="logincount">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($logincount->dt_id->Visible) { // dt_id ?>
	<tr id="r_dt_id"<?php echo $logincount->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $logincount->dt_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $logincount->dt_id->CellAttributes() ?>><span id="el_dt_id">
<input type="text" name="x_dt_id" id="x_dt_id" size="30" value="<?php echo $logincount->dt_id->EditValue ?>"<?php echo $logincount->dt_id->EditAttributes() ?>>
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
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$logincount_add->ShowPageFooter();
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
$logincount_add->Page_Terminate();
?>
<?php

//
// Page class
//
class clogincount_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'logincount';

	// Page object name
	var $PageObjName = 'logincount_add';

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
	function clogincount_add() {
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
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $logincount;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$logincount->CurrentAction = $_POST["a_add"]; // Get form action
			$this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$logincount->CurrentAction = "I"; // Form error, reset action
				$logincount->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$bCopy = TRUE;
			if (@$_GET["dt_id"] != "") {
				$logincount->dt_id->setQueryStringValue($_GET["dt_id"]);
				$logincount->setKey("dt_id", $logincount->dt_id->CurrentValue); // Set up key
			} else {
				$logincount->setKey("dt_id", ""); // Clear key
				$bCopy = FALSE;
			}
			if ($bCopy) {
				$logincount->CurrentAction = "C"; // Copy record
			} else {
				$logincount->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($logincount->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("logincountlist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$logincount->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $logincount->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "logincountview.php")
						$sReturnUrl = $logincount->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$logincount->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$logincount->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $logincount;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $logincount;
		$logincount->dt_id->CurrentValue = NULL;
		$logincount->dt_id->OldValue = $logincount->dt_id->CurrentValue;
		$logincount->reg_id->CurrentValue = NULL;
		$logincount->reg_id->OldValue = $logincount->reg_id->CurrentValue;
		$logincount->logincounter->CurrentValue = NULL;
		$logincount->logincounter->OldValue = $logincount->logincounter->CurrentValue;
		$logincount->date->CurrentValue = NULL;
		$logincount->date->OldValue = $logincount->date->CurrentValue;
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
		$this->LoadOldRecord();
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

	// Load old record
	function LoadOldRecord() {
		global $logincount;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($logincount->getKey("dt_id")) <> "")
			$logincount->dt_id->CurrentValue = $logincount->getKey("dt_id"); // dt_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$logincount->CurrentFilter = $logincount->KeyFilter();
			$sSql = $logincount->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
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
		} elseif ($logincount->RowType == EW_ROWTYPE_ADD) { // Add row

			// dt_id
			$logincount->dt_id->EditCustomAttributes = "";
			$logincount->dt_id->EditValue = ew_HtmlEncode($logincount->dt_id->CurrentValue);

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

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $logincount;

		// Check if key value entered
		if ($logincount->dt_id->CurrentValue == "" && $logincount->dt_id->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $logincount->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $logincount->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// dt_id
		$logincount->dt_id->SetDbValueDef($rsnew, $logincount->dt_id->CurrentValue, 0, FALSE);

		// reg_id
		$logincount->reg_id->SetDbValueDef($rsnew, $logincount->reg_id->CurrentValue, 0, FALSE);

		// logincounter
		$logincount->logincounter->SetDbValueDef($rsnew, $logincount->logincounter->CurrentValue, 0, FALSE);

		// date
		$logincount->date->SetDbValueDef($rsnew, $logincount->date->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $logincount->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($logincount->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($logincount->CancelMessage <> "") {
				$this->setFailureMessage($logincount->CancelMessage);
				$logincount->CancelMessage = "";
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
			$logincount->Row_Inserted($rs, $rsnew);
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
