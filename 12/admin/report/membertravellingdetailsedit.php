<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "membertravellingdetailsinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$membertravellingdetails_edit = new cmembertravellingdetails_edit();
$Page =& $membertravellingdetails_edit;

// Page init
$membertravellingdetails_edit->Page_Init();

// Page main
$membertravellingdetails_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var membertravellingdetails_edit = new ew_Page("membertravellingdetails_edit");

// page properties
membertravellingdetails_edit.PageID = "edit"; // page ID
membertravellingdetails_edit.FormID = "fmembertravellingdetailsedit"; // form ID
var EW_PAGE_ID = membertravellingdetails_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
membertravellingdetails_edit.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($membertravellingdetails->reg_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_reg_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($membertravellingdetails->reg_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_mid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($membertravellingdetails->mid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_mid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($membertravellingdetails->mid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_pricepertraveler"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($membertravellingdetails->pricepertraveler->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_pricepertraveler"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($membertravellingdetails->pricepertraveler->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_seatsavail"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($membertravellingdetails->seatsavail->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_seatsavail"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($membertravellingdetails->seatsavail->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_luggage"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($membertravellingdetails->luggage->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_leave"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($membertravellingdetails->leave->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_detour"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($membertravellingdetails->detour->FldCaption()) ?>");

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
membertravellingdetails_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
membertravellingdetails_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
membertravellingdetails_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $membertravellingdetails_edit->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $membertravellingdetails->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $membertravellingdetails->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$membertravellingdetails_edit->ShowMessage();
?>
<form name="fmembertravellingdetailsedit" id="fmembertravellingdetailsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return membertravellingdetails_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="membertravellingdetails">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($membertravellingdetails->reg_id->Visible) { // reg_id ?>
	<tr id="r_reg_id"<?php echo $membertravellingdetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $membertravellingdetails->reg_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $membertravellingdetails->reg_id->CellAttributes() ?>><span id="el_reg_id">
<input type="text" name="x_reg_id" id="x_reg_id" size="30" value="<?php echo $membertravellingdetails->reg_id->EditValue ?>"<?php echo $membertravellingdetails->reg_id->EditAttributes() ?>>
</span><?php echo $membertravellingdetails->reg_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($membertravellingdetails->mid->Visible) { // mid ?>
	<tr id="r_mid"<?php echo $membertravellingdetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $membertravellingdetails->mid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $membertravellingdetails->mid->CellAttributes() ?>><span id="el_mid">
<div<?php echo $membertravellingdetails->mid->ViewAttributes() ?>><?php echo $membertravellingdetails->mid->EditValue ?></div>
<input type="hidden" name="x_mid" id="x_mid" value="<?php echo ew_HtmlEncode($membertravellingdetails->mid->CurrentValue) ?>">
</span><?php echo $membertravellingdetails->mid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($membertravellingdetails->pricepertraveler->Visible) { // pricepertraveler ?>
	<tr id="r_pricepertraveler"<?php echo $membertravellingdetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $membertravellingdetails->pricepertraveler->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $membertravellingdetails->pricepertraveler->CellAttributes() ?>><span id="el_pricepertraveler">
<input type="text" name="x_pricepertraveler" id="x_pricepertraveler" size="30" value="<?php echo $membertravellingdetails->pricepertraveler->EditValue ?>"<?php echo $membertravellingdetails->pricepertraveler->EditAttributes() ?>>
</span><?php echo $membertravellingdetails->pricepertraveler->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($membertravellingdetails->seatsavail->Visible) { // seatsavail ?>
	<tr id="r_seatsavail"<?php echo $membertravellingdetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $membertravellingdetails->seatsavail->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $membertravellingdetails->seatsavail->CellAttributes() ?>><span id="el_seatsavail">
<input type="text" name="x_seatsavail" id="x_seatsavail" size="30" value="<?php echo $membertravellingdetails->seatsavail->EditValue ?>"<?php echo $membertravellingdetails->seatsavail->EditAttributes() ?>>
</span><?php echo $membertravellingdetails->seatsavail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($membertravellingdetails->luggage->Visible) { // luggage ?>
	<tr id="r_luggage"<?php echo $membertravellingdetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $membertravellingdetails->luggage->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $membertravellingdetails->luggage->CellAttributes() ?>><span id="el_luggage">
<input type="text" name="x_luggage" id="x_luggage" size="30" maxlength="8" value="<?php echo $membertravellingdetails->luggage->EditValue ?>"<?php echo $membertravellingdetails->luggage->EditAttributes() ?>>
</span><?php echo $membertravellingdetails->luggage->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($membertravellingdetails->leave->Visible) { // leave ?>
	<tr id="r_leave"<?php echo $membertravellingdetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $membertravellingdetails->leave->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $membertravellingdetails->leave->CellAttributes() ?>><span id="el_leave">
<input type="text" name="x_leave" id="x_leave" size="30" maxlength="25" value="<?php echo $membertravellingdetails->leave->EditValue ?>"<?php echo $membertravellingdetails->leave->EditAttributes() ?>>
</span><?php echo $membertravellingdetails->leave->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($membertravellingdetails->detour->Visible) { // detour ?>
	<tr id="r_detour"<?php echo $membertravellingdetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $membertravellingdetails->detour->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $membertravellingdetails->detour->CellAttributes() ?>><span id="el_detour">
<input type="text" name="x_detour" id="x_detour" size="30" maxlength="35" value="<?php echo $membertravellingdetails->detour->EditValue ?>"<?php echo $membertravellingdetails->detour->EditAttributes() ?>>
</span><?php echo $membertravellingdetails->detour->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$membertravellingdetails_edit->ShowPageFooter();
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
$membertravellingdetails_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cmembertravellingdetails_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'membertravellingdetails';

	// Page object name
	var $PageObjName = 'membertravellingdetails_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $membertravellingdetails;
		if ($membertravellingdetails->UseTokenInUrl) $PageUrl .= "t=" . $membertravellingdetails->TableVar . "&"; // Add page token
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
		global $objForm, $membertravellingdetails;
		if ($membertravellingdetails->UseTokenInUrl) {
			if ($objForm)
				return ($membertravellingdetails->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($membertravellingdetails->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmembertravellingdetails_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (membertravellingdetails)
		if (!isset($GLOBALS["membertravellingdetails"])) {
			$GLOBALS["membertravellingdetails"] = new cmembertravellingdetails();
			$GLOBALS["Table"] =& $GLOBALS["membertravellingdetails"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'membertravellingdetails', TRUE);

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
		global $membertravellingdetails;

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
		global $objForm, $Language, $gsFormError, $membertravellingdetails;

		// Load key from QueryString
		if (@$_GET["mid"] <> "")
			$membertravellingdetails->mid->setQueryStringValue($_GET["mid"]);
		if (@$_POST["a_edit"] <> "") {
			$membertravellingdetails->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$membertravellingdetails->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$membertravellingdetails->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$membertravellingdetails->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($membertravellingdetails->mid->CurrentValue == "")
			$this->Page_Terminate("membertravellingdetailslist.php"); // Invalid key, return to list
		switch ($membertravellingdetails->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("membertravellingdetailslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$membertravellingdetails->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $membertravellingdetails->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$membertravellingdetails->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$membertravellingdetails->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$membertravellingdetails->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $membertravellingdetails;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $membertravellingdetails;
		if (!$membertravellingdetails->reg_id->FldIsDetailKey) {
			$membertravellingdetails->reg_id->setFormValue($objForm->GetValue("x_reg_id"));
		}
		if (!$membertravellingdetails->mid->FldIsDetailKey) {
			$membertravellingdetails->mid->setFormValue($objForm->GetValue("x_mid"));
		}
		if (!$membertravellingdetails->pricepertraveler->FldIsDetailKey) {
			$membertravellingdetails->pricepertraveler->setFormValue($objForm->GetValue("x_pricepertraveler"));
		}
		if (!$membertravellingdetails->seatsavail->FldIsDetailKey) {
			$membertravellingdetails->seatsavail->setFormValue($objForm->GetValue("x_seatsavail"));
		}
		if (!$membertravellingdetails->luggage->FldIsDetailKey) {
			$membertravellingdetails->luggage->setFormValue($objForm->GetValue("x_luggage"));
		}
		if (!$membertravellingdetails->leave->FldIsDetailKey) {
			$membertravellingdetails->leave->setFormValue($objForm->GetValue("x_leave"));
		}
		if (!$membertravellingdetails->detour->FldIsDetailKey) {
			$membertravellingdetails->detour->setFormValue($objForm->GetValue("x_detour"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $membertravellingdetails;
		$this->LoadRow();
		$membertravellingdetails->reg_id->CurrentValue = $membertravellingdetails->reg_id->FormValue;
		$membertravellingdetails->mid->CurrentValue = $membertravellingdetails->mid->FormValue;
		$membertravellingdetails->pricepertraveler->CurrentValue = $membertravellingdetails->pricepertraveler->FormValue;
		$membertravellingdetails->seatsavail->CurrentValue = $membertravellingdetails->seatsavail->FormValue;
		$membertravellingdetails->luggage->CurrentValue = $membertravellingdetails->luggage->FormValue;
		$membertravellingdetails->leave->CurrentValue = $membertravellingdetails->leave->FormValue;
		$membertravellingdetails->detour->CurrentValue = $membertravellingdetails->detour->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $membertravellingdetails;
		$sFilter = $membertravellingdetails->KeyFilter();

		// Call Row Selecting event
		$membertravellingdetails->Row_Selecting($sFilter);

		// Load SQL based on filter
		$membertravellingdetails->CurrentFilter = $sFilter;
		$sSql = $membertravellingdetails->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$membertravellingdetails->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $membertravellingdetails;
		if (!$rs || $rs->EOF) return;
		$membertravellingdetails->reg_id->setDbValue($rs->fields('reg_id'));
		$membertravellingdetails->mid->setDbValue($rs->fields('mid'));
		$membertravellingdetails->pricepertraveler->setDbValue($rs->fields('pricepertraveler'));
		$membertravellingdetails->seatsavail->setDbValue($rs->fields('seatsavail'));
		$membertravellingdetails->luggage->setDbValue($rs->fields('luggage'));
		$membertravellingdetails->leave->setDbValue($rs->fields('leave'));
		$membertravellingdetails->detour->setDbValue($rs->fields('detour'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $membertravellingdetails;

		// Initialize URLs
		// Call Row_Rendering event

		$membertravellingdetails->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// mid
		// pricepertraveler
		// seatsavail
		// luggage
		// leave
		// detour

		if ($membertravellingdetails->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$membertravellingdetails->reg_id->ViewValue = $membertravellingdetails->reg_id->CurrentValue;
			$membertravellingdetails->reg_id->ViewCustomAttributes = "";

			// mid
			$membertravellingdetails->mid->ViewValue = $membertravellingdetails->mid->CurrentValue;
			$membertravellingdetails->mid->ViewCustomAttributes = "";

			// pricepertraveler
			$membertravellingdetails->pricepertraveler->ViewValue = $membertravellingdetails->pricepertraveler->CurrentValue;
			$membertravellingdetails->pricepertraveler->ViewCustomAttributes = "";

			// seatsavail
			$membertravellingdetails->seatsavail->ViewValue = $membertravellingdetails->seatsavail->CurrentValue;
			$membertravellingdetails->seatsavail->ViewCustomAttributes = "";

			// luggage
			$membertravellingdetails->luggage->ViewValue = $membertravellingdetails->luggage->CurrentValue;
			$membertravellingdetails->luggage->ViewCustomAttributes = "";

			// leave
			$membertravellingdetails->leave->ViewValue = $membertravellingdetails->leave->CurrentValue;
			$membertravellingdetails->leave->ViewCustomAttributes = "";

			// detour
			$membertravellingdetails->detour->ViewValue = $membertravellingdetails->detour->CurrentValue;
			$membertravellingdetails->detour->ViewCustomAttributes = "";

			// reg_id
			$membertravellingdetails->reg_id->LinkCustomAttributes = "";
			$membertravellingdetails->reg_id->HrefValue = "";
			$membertravellingdetails->reg_id->TooltipValue = "";

			// mid
			$membertravellingdetails->mid->LinkCustomAttributes = "";
			$membertravellingdetails->mid->HrefValue = "";
			$membertravellingdetails->mid->TooltipValue = "";

			// pricepertraveler
			$membertravellingdetails->pricepertraveler->LinkCustomAttributes = "";
			$membertravellingdetails->pricepertraveler->HrefValue = "";
			$membertravellingdetails->pricepertraveler->TooltipValue = "";

			// seatsavail
			$membertravellingdetails->seatsavail->LinkCustomAttributes = "";
			$membertravellingdetails->seatsavail->HrefValue = "";
			$membertravellingdetails->seatsavail->TooltipValue = "";

			// luggage
			$membertravellingdetails->luggage->LinkCustomAttributes = "";
			$membertravellingdetails->luggage->HrefValue = "";
			$membertravellingdetails->luggage->TooltipValue = "";

			// leave
			$membertravellingdetails->leave->LinkCustomAttributes = "";
			$membertravellingdetails->leave->HrefValue = "";
			$membertravellingdetails->leave->TooltipValue = "";

			// detour
			$membertravellingdetails->detour->LinkCustomAttributes = "";
			$membertravellingdetails->detour->HrefValue = "";
			$membertravellingdetails->detour->TooltipValue = "";
		} elseif ($membertravellingdetails->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// reg_id
			$membertravellingdetails->reg_id->EditCustomAttributes = "";
			$membertravellingdetails->reg_id->EditValue = ew_HtmlEncode($membertravellingdetails->reg_id->CurrentValue);

			// mid
			$membertravellingdetails->mid->EditCustomAttributes = "";
			$membertravellingdetails->mid->EditValue = $membertravellingdetails->mid->CurrentValue;
			$membertravellingdetails->mid->ViewCustomAttributes = "";

			// pricepertraveler
			$membertravellingdetails->pricepertraveler->EditCustomAttributes = "";
			$membertravellingdetails->pricepertraveler->EditValue = ew_HtmlEncode($membertravellingdetails->pricepertraveler->CurrentValue);

			// seatsavail
			$membertravellingdetails->seatsavail->EditCustomAttributes = "";
			$membertravellingdetails->seatsavail->EditValue = ew_HtmlEncode($membertravellingdetails->seatsavail->CurrentValue);

			// luggage
			$membertravellingdetails->luggage->EditCustomAttributes = "";
			$membertravellingdetails->luggage->EditValue = ew_HtmlEncode($membertravellingdetails->luggage->CurrentValue);

			// leave
			$membertravellingdetails->leave->EditCustomAttributes = "";
			$membertravellingdetails->leave->EditValue = ew_HtmlEncode($membertravellingdetails->leave->CurrentValue);

			// detour
			$membertravellingdetails->detour->EditCustomAttributes = "";
			$membertravellingdetails->detour->EditValue = ew_HtmlEncode($membertravellingdetails->detour->CurrentValue);

			// Edit refer script
			// reg_id

			$membertravellingdetails->reg_id->HrefValue = "";

			// mid
			$membertravellingdetails->mid->HrefValue = "";

			// pricepertraveler
			$membertravellingdetails->pricepertraveler->HrefValue = "";

			// seatsavail
			$membertravellingdetails->seatsavail->HrefValue = "";

			// luggage
			$membertravellingdetails->luggage->HrefValue = "";

			// leave
			$membertravellingdetails->leave->HrefValue = "";

			// detour
			$membertravellingdetails->detour->HrefValue = "";
		}
		if ($membertravellingdetails->RowType == EW_ROWTYPE_ADD ||
			$membertravellingdetails->RowType == EW_ROWTYPE_EDIT ||
			$membertravellingdetails->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$membertravellingdetails->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($membertravellingdetails->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$membertravellingdetails->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $membertravellingdetails;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($membertravellingdetails->reg_id->FormValue) && $membertravellingdetails->reg_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $membertravellingdetails->reg_id->FldCaption());
		}
		if (!ew_CheckInteger($membertravellingdetails->reg_id->FormValue)) {
			ew_AddMessage($gsFormError, $membertravellingdetails->reg_id->FldErrMsg());
		}
		if (!is_null($membertravellingdetails->mid->FormValue) && $membertravellingdetails->mid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $membertravellingdetails->mid->FldCaption());
		}
		if (!ew_CheckInteger($membertravellingdetails->mid->FormValue)) {
			ew_AddMessage($gsFormError, $membertravellingdetails->mid->FldErrMsg());
		}
		if (!is_null($membertravellingdetails->pricepertraveler->FormValue) && $membertravellingdetails->pricepertraveler->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $membertravellingdetails->pricepertraveler->FldCaption());
		}
		if (!ew_CheckInteger($membertravellingdetails->pricepertraveler->FormValue)) {
			ew_AddMessage($gsFormError, $membertravellingdetails->pricepertraveler->FldErrMsg());
		}
		if (!is_null($membertravellingdetails->seatsavail->FormValue) && $membertravellingdetails->seatsavail->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $membertravellingdetails->seatsavail->FldCaption());
		}
		if (!ew_CheckInteger($membertravellingdetails->seatsavail->FormValue)) {
			ew_AddMessage($gsFormError, $membertravellingdetails->seatsavail->FldErrMsg());
		}
		if (!is_null($membertravellingdetails->luggage->FormValue) && $membertravellingdetails->luggage->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $membertravellingdetails->luggage->FldCaption());
		}
		if (!is_null($membertravellingdetails->leave->FormValue) && $membertravellingdetails->leave->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $membertravellingdetails->leave->FldCaption());
		}
		if (!is_null($membertravellingdetails->detour->FormValue) && $membertravellingdetails->detour->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $membertravellingdetails->detour->FldCaption());
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
		global $conn, $Security, $Language, $membertravellingdetails;
		$sFilter = $membertravellingdetails->KeyFilter();
		$membertravellingdetails->CurrentFilter = $sFilter;
		$sSql = $membertravellingdetails->SQL();
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
			$membertravellingdetails->reg_id->SetDbValueDef($rsnew, $membertravellingdetails->reg_id->CurrentValue, 0, FALSE);

			// mid
			// pricepertraveler

			$membertravellingdetails->pricepertraveler->SetDbValueDef($rsnew, $membertravellingdetails->pricepertraveler->CurrentValue, 0, FALSE);

			// seatsavail
			$membertravellingdetails->seatsavail->SetDbValueDef($rsnew, $membertravellingdetails->seatsavail->CurrentValue, 0, FALSE);

			// luggage
			$membertravellingdetails->luggage->SetDbValueDef($rsnew, $membertravellingdetails->luggage->CurrentValue, "", FALSE);

			// leave
			$membertravellingdetails->leave->SetDbValueDef($rsnew, $membertravellingdetails->leave->CurrentValue, "", FALSE);

			// detour
			$membertravellingdetails->detour->SetDbValueDef($rsnew, $membertravellingdetails->detour->CurrentValue, "", FALSE);

			// Call Row Updating event
			$bUpdateRow = $membertravellingdetails->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($membertravellingdetails->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($membertravellingdetails->CancelMessage <> "") {
					$this->setFailureMessage($membertravellingdetails->CancelMessage);
					$membertravellingdetails->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$membertravellingdetails->Row_Updated($rsold, $rsnew);
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
