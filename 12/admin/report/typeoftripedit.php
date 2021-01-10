<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "typeoftripinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$typeoftrip_edit = new ctypeoftrip_edit();
$Page =& $typeoftrip_edit;

// Page init
$typeoftrip_edit->Page_Init();

// Page main
$typeoftrip_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var typeoftrip_edit = new ew_Page("typeoftrip_edit");

// page properties
typeoftrip_edit.PageID = "edit"; // page ID
typeoftrip_edit.FormID = "ftypeoftripedit"; // form ID
var EW_PAGE_ID = typeoftrip_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
typeoftrip_edit.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($typeoftrip->reg_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_reg_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($typeoftrip->reg_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_mid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($typeoftrip->mid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_mid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($typeoftrip->mid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_triptype"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($typeoftrip->triptype->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_departuredate"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($typeoftrip->departuredate->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_departuretime"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($typeoftrip->departuretime->FldCaption()) ?>");

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
typeoftrip_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
typeoftrip_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
typeoftrip_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $typeoftrip_edit->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $typeoftrip->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $typeoftrip->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$typeoftrip_edit->ShowMessage();
?>
<form name="ftypeoftripedit" id="ftypeoftripedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return typeoftrip_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="typeoftrip">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($typeoftrip->reg_id->Visible) { // reg_id ?>
	<tr id="r_reg_id"<?php echo $typeoftrip->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $typeoftrip->reg_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $typeoftrip->reg_id->CellAttributes() ?>><span id="el_reg_id">
<input type="text" name="x_reg_id" id="x_reg_id" size="30" value="<?php echo $typeoftrip->reg_id->EditValue ?>"<?php echo $typeoftrip->reg_id->EditAttributes() ?>>
</span><?php echo $typeoftrip->reg_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($typeoftrip->mid->Visible) { // mid ?>
	<tr id="r_mid"<?php echo $typeoftrip->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $typeoftrip->mid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $typeoftrip->mid->CellAttributes() ?>><span id="el_mid">
<div<?php echo $typeoftrip->mid->ViewAttributes() ?>><?php echo $typeoftrip->mid->EditValue ?></div>
<input type="hidden" name="x_mid" id="x_mid" value="<?php echo ew_HtmlEncode($typeoftrip->mid->CurrentValue) ?>">
</span><?php echo $typeoftrip->mid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($typeoftrip->triptype->Visible) { // triptype ?>
	<tr id="r_triptype"<?php echo $typeoftrip->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $typeoftrip->triptype->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $typeoftrip->triptype->CellAttributes() ?>><span id="el_triptype">
<input type="text" name="x_triptype" id="x_triptype" size="30" maxlength="15" value="<?php echo $typeoftrip->triptype->EditValue ?>"<?php echo $typeoftrip->triptype->EditAttributes() ?>>
</span><?php echo $typeoftrip->triptype->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($typeoftrip->departuredate->Visible) { // departuredate ?>
	<tr id="r_departuredate"<?php echo $typeoftrip->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $typeoftrip->departuredate->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $typeoftrip->departuredate->CellAttributes() ?>><span id="el_departuredate">
<input type="text" name="x_departuredate" id="x_departuredate" size="30" maxlength="10" value="<?php echo $typeoftrip->departuredate->EditValue ?>"<?php echo $typeoftrip->departuredate->EditAttributes() ?>>
</span><?php echo $typeoftrip->departuredate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($typeoftrip->departuretime->Visible) { // departuretime ?>
	<tr id="r_departuretime"<?php echo $typeoftrip->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $typeoftrip->departuretime->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $typeoftrip->departuretime->CellAttributes() ?>><span id="el_departuretime">
<input type="text" name="x_departuretime" id="x_departuretime" size="30" maxlength="5" value="<?php echo $typeoftrip->departuretime->EditValue ?>"<?php echo $typeoftrip->departuretime->EditAttributes() ?>>
</span><?php echo $typeoftrip->departuretime->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$typeoftrip_edit->ShowPageFooter();
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
$typeoftrip_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ctypeoftrip_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'typeoftrip';

	// Page object name
	var $PageObjName = 'typeoftrip_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $typeoftrip;
		if ($typeoftrip->UseTokenInUrl) $PageUrl .= "t=" . $typeoftrip->TableVar . "&"; // Add page token
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
		global $objForm, $typeoftrip;
		if ($typeoftrip->UseTokenInUrl) {
			if ($objForm)
				return ($typeoftrip->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($typeoftrip->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctypeoftrip_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (typeoftrip)
		if (!isset($GLOBALS["typeoftrip"])) {
			$GLOBALS["typeoftrip"] = new ctypeoftrip();
			$GLOBALS["Table"] =& $GLOBALS["typeoftrip"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'typeoftrip', TRUE);

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
		global $typeoftrip;

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
		global $objForm, $Language, $gsFormError, $typeoftrip;

		// Load key from QueryString
		if (@$_GET["mid"] <> "")
			$typeoftrip->mid->setQueryStringValue($_GET["mid"]);
		if (@$_POST["a_edit"] <> "") {
			$typeoftrip->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$typeoftrip->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$typeoftrip->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$typeoftrip->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($typeoftrip->mid->CurrentValue == "")
			$this->Page_Terminate("typeoftriplist.php"); // Invalid key, return to list
		switch ($typeoftrip->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("typeoftriplist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$typeoftrip->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $typeoftrip->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$typeoftrip->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$typeoftrip->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$typeoftrip->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $typeoftrip;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $typeoftrip;
		if (!$typeoftrip->reg_id->FldIsDetailKey) {
			$typeoftrip->reg_id->setFormValue($objForm->GetValue("x_reg_id"));
		}
		if (!$typeoftrip->mid->FldIsDetailKey) {
			$typeoftrip->mid->setFormValue($objForm->GetValue("x_mid"));
		}
		if (!$typeoftrip->triptype->FldIsDetailKey) {
			$typeoftrip->triptype->setFormValue($objForm->GetValue("x_triptype"));
		}
		if (!$typeoftrip->departuredate->FldIsDetailKey) {
			$typeoftrip->departuredate->setFormValue($objForm->GetValue("x_departuredate"));
		}
		if (!$typeoftrip->departuretime->FldIsDetailKey) {
			$typeoftrip->departuretime->setFormValue($objForm->GetValue("x_departuretime"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $typeoftrip;
		$this->LoadRow();
		$typeoftrip->reg_id->CurrentValue = $typeoftrip->reg_id->FormValue;
		$typeoftrip->mid->CurrentValue = $typeoftrip->mid->FormValue;
		$typeoftrip->triptype->CurrentValue = $typeoftrip->triptype->FormValue;
		$typeoftrip->departuredate->CurrentValue = $typeoftrip->departuredate->FormValue;
		$typeoftrip->departuretime->CurrentValue = $typeoftrip->departuretime->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $typeoftrip;
		$sFilter = $typeoftrip->KeyFilter();

		// Call Row Selecting event
		$typeoftrip->Row_Selecting($sFilter);

		// Load SQL based on filter
		$typeoftrip->CurrentFilter = $sFilter;
		$sSql = $typeoftrip->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$typeoftrip->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $typeoftrip;
		if (!$rs || $rs->EOF) return;
		$typeoftrip->reg_id->setDbValue($rs->fields('reg_id'));
		$typeoftrip->mid->setDbValue($rs->fields('mid'));
		$typeoftrip->triptype->setDbValue($rs->fields('triptype'));
		$typeoftrip->departuredate->setDbValue($rs->fields('departuredate'));
		$typeoftrip->departuretime->setDbValue($rs->fields('departuretime'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $typeoftrip;

		// Initialize URLs
		// Call Row_Rendering event

		$typeoftrip->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// mid
		// triptype
		// departuredate
		// departuretime

		if ($typeoftrip->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$typeoftrip->reg_id->ViewValue = $typeoftrip->reg_id->CurrentValue;
			$typeoftrip->reg_id->ViewCustomAttributes = "";

			// mid
			$typeoftrip->mid->ViewValue = $typeoftrip->mid->CurrentValue;
			$typeoftrip->mid->ViewCustomAttributes = "";

			// triptype
			$typeoftrip->triptype->ViewValue = $typeoftrip->triptype->CurrentValue;
			$typeoftrip->triptype->ViewCustomAttributes = "";

			// departuredate
			$typeoftrip->departuredate->ViewValue = $typeoftrip->departuredate->CurrentValue;
			$typeoftrip->departuredate->ViewCustomAttributes = "";

			// departuretime
			$typeoftrip->departuretime->ViewValue = $typeoftrip->departuretime->CurrentValue;
			$typeoftrip->departuretime->ViewCustomAttributes = "";

			// reg_id
			$typeoftrip->reg_id->LinkCustomAttributes = "";
			$typeoftrip->reg_id->HrefValue = "";
			$typeoftrip->reg_id->TooltipValue = "";

			// mid
			$typeoftrip->mid->LinkCustomAttributes = "";
			$typeoftrip->mid->HrefValue = "";
			$typeoftrip->mid->TooltipValue = "";

			// triptype
			$typeoftrip->triptype->LinkCustomAttributes = "";
			$typeoftrip->triptype->HrefValue = "";
			$typeoftrip->triptype->TooltipValue = "";

			// departuredate
			$typeoftrip->departuredate->LinkCustomAttributes = "";
			$typeoftrip->departuredate->HrefValue = "";
			$typeoftrip->departuredate->TooltipValue = "";

			// departuretime
			$typeoftrip->departuretime->LinkCustomAttributes = "";
			$typeoftrip->departuretime->HrefValue = "";
			$typeoftrip->departuretime->TooltipValue = "";
		} elseif ($typeoftrip->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// reg_id
			$typeoftrip->reg_id->EditCustomAttributes = "";
			$typeoftrip->reg_id->EditValue = ew_HtmlEncode($typeoftrip->reg_id->CurrentValue);

			// mid
			$typeoftrip->mid->EditCustomAttributes = "";
			$typeoftrip->mid->EditValue = $typeoftrip->mid->CurrentValue;
			$typeoftrip->mid->ViewCustomAttributes = "";

			// triptype
			$typeoftrip->triptype->EditCustomAttributes = "";
			$typeoftrip->triptype->EditValue = ew_HtmlEncode($typeoftrip->triptype->CurrentValue);

			// departuredate
			$typeoftrip->departuredate->EditCustomAttributes = "";
			$typeoftrip->departuredate->EditValue = ew_HtmlEncode($typeoftrip->departuredate->CurrentValue);

			// departuretime
			$typeoftrip->departuretime->EditCustomAttributes = "";
			$typeoftrip->departuretime->EditValue = ew_HtmlEncode($typeoftrip->departuretime->CurrentValue);

			// Edit refer script
			// reg_id

			$typeoftrip->reg_id->HrefValue = "";

			// mid
			$typeoftrip->mid->HrefValue = "";

			// triptype
			$typeoftrip->triptype->HrefValue = "";

			// departuredate
			$typeoftrip->departuredate->HrefValue = "";

			// departuretime
			$typeoftrip->departuretime->HrefValue = "";
		}
		if ($typeoftrip->RowType == EW_ROWTYPE_ADD ||
			$typeoftrip->RowType == EW_ROWTYPE_EDIT ||
			$typeoftrip->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$typeoftrip->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($typeoftrip->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$typeoftrip->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $typeoftrip;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($typeoftrip->reg_id->FormValue) && $typeoftrip->reg_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $typeoftrip->reg_id->FldCaption());
		}
		if (!ew_CheckInteger($typeoftrip->reg_id->FormValue)) {
			ew_AddMessage($gsFormError, $typeoftrip->reg_id->FldErrMsg());
		}
		if (!is_null($typeoftrip->mid->FormValue) && $typeoftrip->mid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $typeoftrip->mid->FldCaption());
		}
		if (!ew_CheckInteger($typeoftrip->mid->FormValue)) {
			ew_AddMessage($gsFormError, $typeoftrip->mid->FldErrMsg());
		}
		if (!is_null($typeoftrip->triptype->FormValue) && $typeoftrip->triptype->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $typeoftrip->triptype->FldCaption());
		}
		if (!is_null($typeoftrip->departuredate->FormValue) && $typeoftrip->departuredate->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $typeoftrip->departuredate->FldCaption());
		}
		if (!is_null($typeoftrip->departuretime->FormValue) && $typeoftrip->departuretime->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $typeoftrip->departuretime->FldCaption());
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
		global $conn, $Security, $Language, $typeoftrip;
		$sFilter = $typeoftrip->KeyFilter();
		$typeoftrip->CurrentFilter = $sFilter;
		$sSql = $typeoftrip->SQL();
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
			$typeoftrip->reg_id->SetDbValueDef($rsnew, $typeoftrip->reg_id->CurrentValue, 0, FALSE);

			// mid
			// triptype

			$typeoftrip->triptype->SetDbValueDef($rsnew, $typeoftrip->triptype->CurrentValue, "", FALSE);

			// departuredate
			$typeoftrip->departuredate->SetDbValueDef($rsnew, $typeoftrip->departuredate->CurrentValue, "", FALSE);

			// departuretime
			$typeoftrip->departuretime->SetDbValueDef($rsnew, $typeoftrip->departuretime->CurrentValue, "", FALSE);

			// Call Row Updating event
			$bUpdateRow = $typeoftrip->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($typeoftrip->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($typeoftrip->CancelMessage <> "") {
					$this->setFailureMessage($typeoftrip->CancelMessage);
					$typeoftrip->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$typeoftrip->Row_Updated($rsold, $rsnew);
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
