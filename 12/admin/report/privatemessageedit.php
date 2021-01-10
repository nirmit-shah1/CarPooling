<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "privatemessageinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$privatemessage_edit = new cprivatemessage_edit();
$Page =& $privatemessage_edit;

// Page init
$privatemessage_edit->Page_Init();

// Page main
$privatemessage_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var privatemessage_edit = new ew_Page("privatemessage_edit");

// page properties
privatemessage_edit.PageID = "edit"; // page ID
privatemessage_edit.FormID = "fprivatemessageedit"; // form ID
var EW_PAGE_ID = privatemessage_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
privatemessage_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_messageid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($privatemessage->messageid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_messageid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($privatemessage->messageid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_senderid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($privatemessage->senderid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_senderid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($privatemessage->senderid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_receiverid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($privatemessage->receiverid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_receiverid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($privatemessage->receiverid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_message"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($privatemessage->message->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_counter"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($privatemessage->counter->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_counter"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($privatemessage->counter->FldErrMsg()) ?>");

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
privatemessage_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
privatemessage_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
privatemessage_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $privatemessage_edit->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $privatemessage->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $privatemessage->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$privatemessage_edit->ShowMessage();
?>
<form name="fprivatemessageedit" id="fprivatemessageedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return privatemessage_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="privatemessage">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($privatemessage->messageid->Visible) { // messageid ?>
	<tr id="r_messageid"<?php echo $privatemessage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $privatemessage->messageid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $privatemessage->messageid->CellAttributes() ?>><span id="el_messageid">
<div<?php echo $privatemessage->messageid->ViewAttributes() ?>><?php echo $privatemessage->messageid->EditValue ?></div>
<input type="hidden" name="x_messageid" id="x_messageid" value="<?php echo ew_HtmlEncode($privatemessage->messageid->CurrentValue) ?>">
</span><?php echo $privatemessage->messageid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($privatemessage->senderid->Visible) { // senderid ?>
	<tr id="r_senderid"<?php echo $privatemessage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $privatemessage->senderid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $privatemessage->senderid->CellAttributes() ?>><span id="el_senderid">
<input type="text" name="x_senderid" id="x_senderid" size="30" value="<?php echo $privatemessage->senderid->EditValue ?>"<?php echo $privatemessage->senderid->EditAttributes() ?>>
</span><?php echo $privatemessage->senderid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($privatemessage->receiverid->Visible) { // receiverid ?>
	<tr id="r_receiverid"<?php echo $privatemessage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $privatemessage->receiverid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $privatemessage->receiverid->CellAttributes() ?>><span id="el_receiverid">
<input type="text" name="x_receiverid" id="x_receiverid" size="30" value="<?php echo $privatemessage->receiverid->EditValue ?>"<?php echo $privatemessage->receiverid->EditAttributes() ?>>
</span><?php echo $privatemessage->receiverid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($privatemessage->message->Visible) { // message ?>
	<tr id="r_message"<?php echo $privatemessage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $privatemessage->message->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $privatemessage->message->CellAttributes() ?>><span id="el_message">
<textarea name="x_message" id="x_message" cols="35" rows="4"<?php echo $privatemessage->message->EditAttributes() ?>><?php echo $privatemessage->message->EditValue ?></textarea>
</span><?php echo $privatemessage->message->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($privatemessage->counter->Visible) { // counter ?>
	<tr id="r_counter"<?php echo $privatemessage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $privatemessage->counter->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $privatemessage->counter->CellAttributes() ?>><span id="el_counter">
<input type="text" name="x_counter" id="x_counter" size="30" value="<?php echo $privatemessage->counter->EditValue ?>"<?php echo $privatemessage->counter->EditAttributes() ?>>
</span><?php echo $privatemessage->counter->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$privatemessage_edit->ShowPageFooter();
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
$privatemessage_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cprivatemessage_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'privatemessage';

	// Page object name
	var $PageObjName = 'privatemessage_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $privatemessage;
		if ($privatemessage->UseTokenInUrl) $PageUrl .= "t=" . $privatemessage->TableVar . "&"; // Add page token
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
		global $objForm, $privatemessage;
		if ($privatemessage->UseTokenInUrl) {
			if ($objForm)
				return ($privatemessage->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($privatemessage->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cprivatemessage_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (privatemessage)
		if (!isset($GLOBALS["privatemessage"])) {
			$GLOBALS["privatemessage"] = new cprivatemessage();
			$GLOBALS["Table"] =& $GLOBALS["privatemessage"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'privatemessage', TRUE);

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
		global $privatemessage;

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
		global $objForm, $Language, $gsFormError, $privatemessage;

		// Load key from QueryString
		if (@$_GET["messageid"] <> "")
			$privatemessage->messageid->setQueryStringValue($_GET["messageid"]);
		if (@$_POST["a_edit"] <> "") {
			$privatemessage->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$privatemessage->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$privatemessage->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$privatemessage->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($privatemessage->messageid->CurrentValue == "")
			$this->Page_Terminate("privatemessagelist.php"); // Invalid key, return to list
		switch ($privatemessage->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("privatemessagelist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$privatemessage->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $privatemessage->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$privatemessage->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$privatemessage->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$privatemessage->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $privatemessage;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $privatemessage;
		if (!$privatemessage->messageid->FldIsDetailKey) {
			$privatemessage->messageid->setFormValue($objForm->GetValue("x_messageid"));
		}
		if (!$privatemessage->senderid->FldIsDetailKey) {
			$privatemessage->senderid->setFormValue($objForm->GetValue("x_senderid"));
		}
		if (!$privatemessage->receiverid->FldIsDetailKey) {
			$privatemessage->receiverid->setFormValue($objForm->GetValue("x_receiverid"));
		}
		if (!$privatemessage->message->FldIsDetailKey) {
			$privatemessage->message->setFormValue($objForm->GetValue("x_message"));
		}
		if (!$privatemessage->counter->FldIsDetailKey) {
			$privatemessage->counter->setFormValue($objForm->GetValue("x_counter"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $privatemessage;
		$this->LoadRow();
		$privatemessage->messageid->CurrentValue = $privatemessage->messageid->FormValue;
		$privatemessage->senderid->CurrentValue = $privatemessage->senderid->FormValue;
		$privatemessage->receiverid->CurrentValue = $privatemessage->receiverid->FormValue;
		$privatemessage->message->CurrentValue = $privatemessage->message->FormValue;
		$privatemessage->counter->CurrentValue = $privatemessage->counter->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $privatemessage;
		$sFilter = $privatemessage->KeyFilter();

		// Call Row Selecting event
		$privatemessage->Row_Selecting($sFilter);

		// Load SQL based on filter
		$privatemessage->CurrentFilter = $sFilter;
		$sSql = $privatemessage->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$privatemessage->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $privatemessage;
		if (!$rs || $rs->EOF) return;
		$privatemessage->messageid->setDbValue($rs->fields('messageid'));
		$privatemessage->senderid->setDbValue($rs->fields('senderid'));
		$privatemessage->receiverid->setDbValue($rs->fields('receiverid'));
		$privatemessage->message->setDbValue($rs->fields('message'));
		$privatemessage->counter->setDbValue($rs->fields('counter'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $privatemessage;

		// Initialize URLs
		// Call Row_Rendering event

		$privatemessage->Row_Rendering();

		// Common render codes for all row types
		// messageid
		// senderid
		// receiverid
		// message
		// counter

		if ($privatemessage->RowType == EW_ROWTYPE_VIEW) { // View row

			// messageid
			$privatemessage->messageid->ViewValue = $privatemessage->messageid->CurrentValue;
			$privatemessage->messageid->ViewCustomAttributes = "";

			// senderid
			$privatemessage->senderid->ViewValue = $privatemessage->senderid->CurrentValue;
			$privatemessage->senderid->ViewCustomAttributes = "";

			// receiverid
			$privatemessage->receiverid->ViewValue = $privatemessage->receiverid->CurrentValue;
			$privatemessage->receiverid->ViewCustomAttributes = "";

			// message
			$privatemessage->message->ViewValue = $privatemessage->message->CurrentValue;
			$privatemessage->message->ViewCustomAttributes = "";

			// counter
			$privatemessage->counter->ViewValue = $privatemessage->counter->CurrentValue;
			$privatemessage->counter->ViewCustomAttributes = "";

			// messageid
			$privatemessage->messageid->LinkCustomAttributes = "";
			$privatemessage->messageid->HrefValue = "";
			$privatemessage->messageid->TooltipValue = "";

			// senderid
			$privatemessage->senderid->LinkCustomAttributes = "";
			$privatemessage->senderid->HrefValue = "";
			$privatemessage->senderid->TooltipValue = "";

			// receiverid
			$privatemessage->receiverid->LinkCustomAttributes = "";
			$privatemessage->receiverid->HrefValue = "";
			$privatemessage->receiverid->TooltipValue = "";

			// message
			$privatemessage->message->LinkCustomAttributes = "";
			$privatemessage->message->HrefValue = "";
			$privatemessage->message->TooltipValue = "";

			// counter
			$privatemessage->counter->LinkCustomAttributes = "";
			$privatemessage->counter->HrefValue = "";
			$privatemessage->counter->TooltipValue = "";
		} elseif ($privatemessage->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// messageid
			$privatemessage->messageid->EditCustomAttributes = "";
			$privatemessage->messageid->EditValue = $privatemessage->messageid->CurrentValue;
			$privatemessage->messageid->ViewCustomAttributes = "";

			// senderid
			$privatemessage->senderid->EditCustomAttributes = "";
			$privatemessage->senderid->EditValue = ew_HtmlEncode($privatemessage->senderid->CurrentValue);

			// receiverid
			$privatemessage->receiverid->EditCustomAttributes = "";
			$privatemessage->receiverid->EditValue = ew_HtmlEncode($privatemessage->receiverid->CurrentValue);

			// message
			$privatemessage->message->EditCustomAttributes = "";
			$privatemessage->message->EditValue = ew_HtmlEncode($privatemessage->message->CurrentValue);

			// counter
			$privatemessage->counter->EditCustomAttributes = "";
			$privatemessage->counter->EditValue = ew_HtmlEncode($privatemessage->counter->CurrentValue);

			// Edit refer script
			// messageid

			$privatemessage->messageid->HrefValue = "";

			// senderid
			$privatemessage->senderid->HrefValue = "";

			// receiverid
			$privatemessage->receiverid->HrefValue = "";

			// message
			$privatemessage->message->HrefValue = "";

			// counter
			$privatemessage->counter->HrefValue = "";
		}
		if ($privatemessage->RowType == EW_ROWTYPE_ADD ||
			$privatemessage->RowType == EW_ROWTYPE_EDIT ||
			$privatemessage->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$privatemessage->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($privatemessage->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$privatemessage->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $privatemessage;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($privatemessage->messageid->FormValue) && $privatemessage->messageid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $privatemessage->messageid->FldCaption());
		}
		if (!ew_CheckInteger($privatemessage->messageid->FormValue)) {
			ew_AddMessage($gsFormError, $privatemessage->messageid->FldErrMsg());
		}
		if (!is_null($privatemessage->senderid->FormValue) && $privatemessage->senderid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $privatemessage->senderid->FldCaption());
		}
		if (!ew_CheckInteger($privatemessage->senderid->FormValue)) {
			ew_AddMessage($gsFormError, $privatemessage->senderid->FldErrMsg());
		}
		if (!is_null($privatemessage->receiverid->FormValue) && $privatemessage->receiverid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $privatemessage->receiverid->FldCaption());
		}
		if (!ew_CheckInteger($privatemessage->receiverid->FormValue)) {
			ew_AddMessage($gsFormError, $privatemessage->receiverid->FldErrMsg());
		}
		if (!is_null($privatemessage->message->FormValue) && $privatemessage->message->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $privatemessage->message->FldCaption());
		}
		if (!is_null($privatemessage->counter->FormValue) && $privatemessage->counter->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $privatemessage->counter->FldCaption());
		}
		if (!ew_CheckInteger($privatemessage->counter->FormValue)) {
			ew_AddMessage($gsFormError, $privatemessage->counter->FldErrMsg());
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
		global $conn, $Security, $Language, $privatemessage;
		$sFilter = $privatemessage->KeyFilter();
		$privatemessage->CurrentFilter = $sFilter;
		$sSql = $privatemessage->SQL();
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

			// messageid
			// senderid

			$privatemessage->senderid->SetDbValueDef($rsnew, $privatemessage->senderid->CurrentValue, 0, FALSE);

			// receiverid
			$privatemessage->receiverid->SetDbValueDef($rsnew, $privatemessage->receiverid->CurrentValue, 0, FALSE);

			// message
			$privatemessage->message->SetDbValueDef($rsnew, $privatemessage->message->CurrentValue, "", FALSE);

			// counter
			$privatemessage->counter->SetDbValueDef($rsnew, $privatemessage->counter->CurrentValue, 0, FALSE);

			// Call Row Updating event
			$bUpdateRow = $privatemessage->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($privatemessage->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($privatemessage->CancelMessage <> "") {
					$this->setFailureMessage($privatemessage->CancelMessage);
					$privatemessage->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$privatemessage->Row_Updated($rsold, $rsnew);
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
