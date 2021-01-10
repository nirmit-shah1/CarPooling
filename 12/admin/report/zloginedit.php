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
$zlogin_edit = new czlogin_edit();
$Page =& $zlogin_edit;

// Page init
$zlogin_edit->Page_Init();

// Page main
$zlogin_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var zlogin_edit = new ew_Page("zlogin_edit");

// page properties
zlogin_edit.PageID = "edit"; // page ID
zlogin_edit.FormID = "fzloginedit"; // form ID
var EW_PAGE_ID = zlogin_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
zlogin_edit.ValidateForm = function(fobj) {
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
zlogin_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
zlogin_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
zlogin_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $zlogin_edit->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $zlogin->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $zlogin->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$zlogin_edit->ShowMessage();
?>
<form name="fzloginedit" id="fzloginedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return zlogin_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="zlogin">
<input type="hidden" name="a_edit" id="a_edit" value="U">
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
<div<?php echo $zlogin->zemail->ViewAttributes() ?>><?php echo $zlogin->zemail->EditValue ?></div>
<input type="hidden" name="x_zemail" id="x_zemail" value="<?php echo ew_HtmlEncode($zlogin->zemail->CurrentValue) ?>">
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
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$zlogin_edit->ShowPageFooter();
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
$zlogin_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class czlogin_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'login';

	// Page object name
	var $PageObjName = 'zlogin_edit';

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
	function czlogin_edit() {
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
			define("EW_PAGE_ID", 'edit', TRUE);

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
	var $DbMasterFilter;
	var $DbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $zlogin;

		// Load key from QueryString
		if (@$_GET["zemail"] <> "")
			$zlogin->zemail->setQueryStringValue($_GET["zemail"]);
		if (@$_POST["a_edit"] <> "") {
			$zlogin->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$zlogin->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$zlogin->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$zlogin->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($zlogin->zemail->CurrentValue == "")
			$this->Page_Terminate("zloginlist.php"); // Invalid key, return to list
		switch ($zlogin->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("zloginlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$zlogin->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $zlogin->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$zlogin->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$zlogin->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$zlogin->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $zlogin;

		// Get upload data
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
		$this->LoadRow();
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
		} elseif ($zlogin->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// reg_id
			$zlogin->reg_id->EditCustomAttributes = "";
			$zlogin->reg_id->EditValue = ew_HtmlEncode($zlogin->reg_id->CurrentValue);

			// email
			$zlogin->zemail->EditCustomAttributes = "";
			$zlogin->zemail->EditValue = $zlogin->zemail->CurrentValue;
			$zlogin->zemail->ViewCustomAttributes = "";

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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $zlogin;
		$sFilter = $zlogin->KeyFilter();
			if ($zlogin->reg_id->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`reg_id` = " . ew_AdjustSql($zlogin->reg_id->CurrentValue) . ")";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$zlogin->CurrentFilter = $sFilterChk;
			$sSqlChk = $zlogin->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'reg_id', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $zlogin->reg_id->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		$zlogin->CurrentFilter = $sFilter;
		$sSql = $zlogin->SQL();
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

			// reg_id
			$zlogin->reg_id->SetDbValueDef($rsnew, $zlogin->reg_id->CurrentValue, 0, FALSE);

			// email
			// password

			$zlogin->password->SetDbValueDef($rsnew, $zlogin->password->CurrentValue, "", FALSE);

			// Call Row Updating event
			$bUpdateRow = $zlogin->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($zlogin->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($zlogin->CancelMessage <> "") {
					$this->setFailureMessage($zlogin->CancelMessage);
					$zlogin->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$zlogin->Row_Updated($rsold, $rsnew);
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
