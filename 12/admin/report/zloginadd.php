<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "zlogininfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$zlogin_add = new czlogin_add();
$Page =& $zlogin_add;

// Page init
$zlogin_add->Page_Init();

// Page main
$zlogin_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var zlogin_add = new ew_Page("zlogin_add");

// page properties
zlogin_add.PageID = "add"; // page ID
zlogin_add.FormID = "fzloginadd"; // form ID
var EW_PAGE_ID = zlogin_add.PageID; // for backward compatibility

// extend page with ValidateForm function
zlogin_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_reg_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($zlogin->reg_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_reg_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($zlogin->reg_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_zemail"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($zlogin->zemail->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_password"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($zlogin->password->FldCaption()) ?>");

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
zlogin_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
zlogin_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
zlogin_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $zlogin_add->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $zlogin->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $zlogin->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$zlogin_add->ShowMessage();
?>
<form name="fzloginadd" id="fzloginadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return zlogin_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="zlogin">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($zlogin->reg_id->Visible) { // reg_id ?>
	<tr id="r_reg_id"<?php echo $zlogin->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $zlogin->reg_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $zlogin->reg_id->CellAttributes() ?>><span id="el_reg_id">
<input type="text" name="x_reg_id" id="x_reg_id" size="30" value="<?php echo $zlogin->reg_id->EditValue ?>"<?php echo $zlogin->reg_id->EditAttributes() ?>>
</span><?php echo $zlogin->reg_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($zlogin->zemail->Visible) { // email ?>
	<tr id="r_zemail"<?php echo $zlogin->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $zlogin->zemail->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $zlogin->zemail->CellAttributes() ?>><span id="el_zemail">
<input type="text" name="x_zemail" id="x_zemail" size="30" maxlength="55" value="<?php echo $zlogin->zemail->EditValue ?>"<?php echo $zlogin->zemail->EditAttributes() ?>>
</span><?php echo $zlogin->zemail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($zlogin->password->Visible) { // password ?>
	<tr id="r_password"<?php echo $zlogin->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $zlogin->password->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $zlogin->password->CellAttributes() ?>><span id="el_password">
<input type="text" name="x_password" id="x_password" size="30" maxlength="50" value="<?php echo $zlogin->password->EditValue ?>"<?php echo $zlogin->password->EditAttributes() ?>>
</span><?php echo $zlogin->password->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$zlogin_add->ShowPageFooter();
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
$zlogin_add->Page_Terminate();
?>
<?php

//
// Page class
//
class czlogin_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'login';

	// Page object name
	var $PageObjName = 'zlogin_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $zlogin;
		if ($zlogin->UseTokenInUrl) $PageUrl .= "t=" . $zlogin->TableVar . "&"; // Add page token
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
		global $objForm, $zlogin;
		if ($zlogin->UseTokenInUrl) {
			if ($objForm)
				return ($zlogin->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($zlogin->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function czlogin_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (zlogin)
		if (!isset($GLOBALS["zlogin"])) {
			$GLOBALS["zlogin"] = new czlogin();
			$GLOBALS["Table"] =& $GLOBALS["zlogin"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'login', TRUE);

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
		global $zlogin;

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
		global $objForm, $Language, $gsFormError, $zlogin;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$zlogin->CurrentAction = $_POST["a_add"]; // Get form action
			$this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$zlogin->CurrentAction = "I"; // Form error, reset action
				$zlogin->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$bCopy = TRUE;
			if (@$_GET["zemail"] != "") {
				$zlogin->zemail->setQueryStringValue($_GET["zemail"]);
				$zlogin->setKey("zemail", $zlogin->zemail->CurrentValue); // Set up key
			} else {
				$zlogin->setKey("zemail", ""); // Clear key
				$bCopy = FALSE;
			}
			if ($bCopy) {
				$zlogin->CurrentAction = "C"; // Copy record
			} else {
				$zlogin->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($zlogin->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("zloginlist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$zlogin->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $zlogin->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "zloginview.php")
						$sReturnUrl = $zlogin->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$zlogin->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$zlogin->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $zlogin;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $zlogin;
		$zlogin->reg_id->CurrentValue = NULL;
		$zlogin->reg_id->OldValue = $zlogin->reg_id->CurrentValue;
		$zlogin->zemail->CurrentValue = NULL;
		$zlogin->zemail->OldValue = $zlogin->zemail->CurrentValue;
		$zlogin->password->CurrentValue = NULL;
		$zlogin->password->OldValue = $zlogin->password->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $zlogin;
		if (!$zlogin->reg_id->FldIsDetailKey) {
			$zlogin->reg_id->setFormValue($objForm->GetValue("x_reg_id"));
		}
		if (!$zlogin->zemail->FldIsDetailKey) {
			$zlogin->zemail->setFormValue($objForm->GetValue("x_zemail"));
		}
		if (!$zlogin->password->FldIsDetailKey) {
			$zlogin->password->setFormValue($objForm->GetValue("x_password"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $zlogin;
		$this->LoadOldRecord();
		$zlogin->reg_id->CurrentValue = $zlogin->reg_id->FormValue;
		$zlogin->zemail->CurrentValue = $zlogin->zemail->FormValue;
		$zlogin->password->CurrentValue = $zlogin->password->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $zlogin;
		$sFilter = $zlogin->KeyFilter();

		// Call Row Selecting event
		$zlogin->Row_Selecting($sFilter);

		// Load SQL based on filter
		$zlogin->CurrentFilter = $sFilter;
		$sSql = $zlogin->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$zlogin->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $zlogin;
		if (!$rs || $rs->EOF) return;
		$zlogin->reg_id->setDbValue($rs->fields('reg_id'));
		$zlogin->zemail->setDbValue($rs->fields('email'));
		$zlogin->password->setDbValue($rs->fields('password'));
	}

	// Load old record
	function LoadOldRecord() {
		global $zlogin;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($zlogin->getKey("zemail")) <> "")
			$zlogin->zemail->CurrentValue = $zlogin->getKey("zemail"); // email
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$zlogin->CurrentFilter = $zlogin->KeyFilter();
			$sSql = $zlogin->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $zlogin;

		// Initialize URLs
		// Call Row_Rendering event

		$zlogin->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// email
		// password

		if ($zlogin->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$zlogin->reg_id->ViewValue = $zlogin->reg_id->CurrentValue;
			$zlogin->reg_id->ViewCustomAttributes = "";

			// email
			$zlogin->zemail->ViewValue = $zlogin->zemail->CurrentValue;
			$zlogin->zemail->ViewCustomAttributes = "";

			// password
			$zlogin->password->ViewValue = $zlogin->password->CurrentValue;
			$zlogin->password->ViewCustomAttributes = "";

			// reg_id
			$zlogin->reg_id->LinkCustomAttributes = "";
			$zlogin->reg_id->HrefValue = "";
			$zlogin->reg_id->TooltipValue = "";

			// email
			$zlogin->zemail->LinkCustomAttributes = "";
			$zlogin->zemail->HrefValue = "";
			$zlogin->zemail->TooltipValue = "";

			// password
			$zlogin->password->LinkCustomAttributes = "";
			$zlogin->password->HrefValue = "";
			$zlogin->password->TooltipValue = "";
		} elseif ($zlogin->RowType == EW_ROWTYPE_ADD) { // Add row

			// reg_id
			$zlogin->reg_id->EditCustomAttributes = "";
			$zlogin->reg_id->EditValue = ew_HtmlEncode($zlogin->reg_id->CurrentValue);

			// email
			$zlogin->zemail->EditCustomAttributes = "";
			$zlogin->zemail->EditValue = ew_HtmlEncode($zlogin->zemail->CurrentValue);

			// password
			$zlogin->password->EditCustomAttributes = "";
			$zlogin->password->EditValue = ew_HtmlEncode($zlogin->password->CurrentValue);

			// Edit refer script
			// reg_id

			$zlogin->reg_id->HrefValue = "";

			// email
			$zlogin->zemail->HrefValue = "";

			// password
			$zlogin->password->HrefValue = "";
		}
		if ($zlogin->RowType == EW_ROWTYPE_ADD ||
			$zlogin->RowType == EW_ROWTYPE_EDIT ||
			$zlogin->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$zlogin->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($zlogin->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$zlogin->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $zlogin;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($zlogin->reg_id->FormValue) && $zlogin->reg_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $zlogin->reg_id->FldCaption());
		}
		if (!ew_CheckInteger($zlogin->reg_id->FormValue)) {
			ew_AddMessage($gsFormError, $zlogin->reg_id->FldErrMsg());
		}
		if (!is_null($zlogin->zemail->FormValue) && $zlogin->zemail->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $zlogin->zemail->FldCaption());
		}
		if (!is_null($zlogin->password->FormValue) && $zlogin->password->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $zlogin->password->FldCaption());
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
		global $conn, $Language, $Security, $zlogin;

		// Check if key value entered
		if ($zlogin->zemail->CurrentValue == "" && $zlogin->zemail->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $zlogin->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $zlogin->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($zlogin->reg_id->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(reg_id = " . ew_AdjustSql($zlogin->reg_id->CurrentValue) . ")";
			$rsChk = $zlogin->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'reg_id', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $zlogin->reg_id->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// reg_id
		$zlogin->reg_id->SetDbValueDef($rsnew, $zlogin->reg_id->CurrentValue, 0, FALSE);

		// email
		$zlogin->zemail->SetDbValueDef($rsnew, $zlogin->zemail->CurrentValue, "", FALSE);

		// password
		$zlogin->password->SetDbValueDef($rsnew, $zlogin->password->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $zlogin->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($zlogin->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($zlogin->CancelMessage <> "") {
				$this->setFailureMessage($zlogin->CancelMessage);
				$zlogin->CancelMessage = "";
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
			$zlogin->Row_Inserted($rs, $rsnew);
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
