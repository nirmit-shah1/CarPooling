<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "postalinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$postal_add = new cpostal_add();
$Page =& $postal_add;

// Page init
$postal_add->Page_Init();

// Page main
$postal_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var postal_add = new ew_Page("postal_add");

// page properties
postal_add.PageID = "add"; // page ID
postal_add.FormID = "fpostaladd"; // form ID
var EW_PAGE_ID = postal_add.PageID; // for backward compatibility

// extend page with ValidateForm function
postal_add.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($postal->reg_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_reg_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($postal->reg_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_address1"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($postal->address1->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_address2"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($postal->address2->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_postalcode"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($postal->postalcode->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_postalcode"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($postal->postalcode->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_state"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($postal->state->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_city"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($postal->city->FldCaption()) ?>");

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
postal_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
postal_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
postal_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $postal_add->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $postal->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $postal->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$postal_add->ShowMessage();
?>
<form name="fpostaladd" id="fpostaladd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return postal_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="postal">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($postal->reg_id->Visible) { // reg_id ?>
	<tr id="r_reg_id"<?php echo $postal->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $postal->reg_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $postal->reg_id->CellAttributes() ?>><span id="el_reg_id">
<input type="text" name="x_reg_id" id="x_reg_id" size="30" value="<?php echo $postal->reg_id->EditValue ?>"<?php echo $postal->reg_id->EditAttributes() ?>>
</span><?php echo $postal->reg_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($postal->address1->Visible) { // address1 ?>
	<tr id="r_address1"<?php echo $postal->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $postal->address1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $postal->address1->CellAttributes() ?>><span id="el_address1">
<textarea name="x_address1" id="x_address1" cols="35" rows="4"<?php echo $postal->address1->EditAttributes() ?>><?php echo $postal->address1->EditValue ?></textarea>
</span><?php echo $postal->address1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($postal->address2->Visible) { // address2 ?>
	<tr id="r_address2"<?php echo $postal->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $postal->address2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $postal->address2->CellAttributes() ?>><span id="el_address2">
<textarea name="x_address2" id="x_address2" cols="35" rows="4"<?php echo $postal->address2->EditAttributes() ?>><?php echo $postal->address2->EditValue ?></textarea>
</span><?php echo $postal->address2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($postal->postalcode->Visible) { // postalcode ?>
	<tr id="r_postalcode"<?php echo $postal->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $postal->postalcode->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $postal->postalcode->CellAttributes() ?>><span id="el_postalcode">
<input type="text" name="x_postalcode" id="x_postalcode" size="30" value="<?php echo $postal->postalcode->EditValue ?>"<?php echo $postal->postalcode->EditAttributes() ?>>
</span><?php echo $postal->postalcode->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($postal->state->Visible) { // state ?>
	<tr id="r_state"<?php echo $postal->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $postal->state->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $postal->state->CellAttributes() ?>><span id="el_state">
<input type="text" name="x_state" id="x_state" size="30" maxlength="30" value="<?php echo $postal->state->EditValue ?>"<?php echo $postal->state->EditAttributes() ?>>
</span><?php echo $postal->state->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($postal->city->Visible) { // city ?>
	<tr id="r_city"<?php echo $postal->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $postal->city->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $postal->city->CellAttributes() ?>><span id="el_city">
<input type="text" name="x_city" id="x_city" size="30" maxlength="30" value="<?php echo $postal->city->EditValue ?>"<?php echo $postal->city->EditAttributes() ?>>
</span><?php echo $postal->city->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$postal_add->ShowPageFooter();
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
$postal_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cpostal_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'postal';

	// Page object name
	var $PageObjName = 'postal_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $postal;
		if ($postal->UseTokenInUrl) $PageUrl .= "t=" . $postal->TableVar . "&"; // Add page token
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
		global $objForm, $postal;
		if ($postal->UseTokenInUrl) {
			if ($objForm)
				return ($postal->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($postal->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpostal_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (postal)
		if (!isset($GLOBALS["postal"])) {
			$GLOBALS["postal"] = new cpostal();
			$GLOBALS["Table"] =& $GLOBALS["postal"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'postal', TRUE);

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
		global $postal;

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
		global $objForm, $Language, $gsFormError, $postal;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$postal->CurrentAction = $_POST["a_add"]; // Get form action
			$this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$postal->CurrentAction = "I"; // Form error, reset action
				$postal->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$bCopy = TRUE;
			if (@$_GET["reg_id"] != "") {
				$postal->reg_id->setQueryStringValue($_GET["reg_id"]);
				$postal->setKey("reg_id", $postal->reg_id->CurrentValue); // Set up key
			} else {
				$postal->setKey("reg_id", ""); // Clear key
				$bCopy = FALSE;
			}
			if ($bCopy) {
				$postal->CurrentAction = "C"; // Copy record
			} else {
				$postal->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($postal->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("postallist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$postal->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $postal->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "postalview.php")
						$sReturnUrl = $postal->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$postal->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$postal->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $postal;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $postal;
		$postal->reg_id->CurrentValue = NULL;
		$postal->reg_id->OldValue = $postal->reg_id->CurrentValue;
		$postal->address1->CurrentValue = NULL;
		$postal->address1->OldValue = $postal->address1->CurrentValue;
		$postal->address2->CurrentValue = NULL;
		$postal->address2->OldValue = $postal->address2->CurrentValue;
		$postal->postalcode->CurrentValue = NULL;
		$postal->postalcode->OldValue = $postal->postalcode->CurrentValue;
		$postal->state->CurrentValue = NULL;
		$postal->state->OldValue = $postal->state->CurrentValue;
		$postal->city->CurrentValue = NULL;
		$postal->city->OldValue = $postal->city->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $postal;
		if (!$postal->reg_id->FldIsDetailKey) {
			$postal->reg_id->setFormValue($objForm->GetValue("x_reg_id"));
		}
		if (!$postal->address1->FldIsDetailKey) {
			$postal->address1->setFormValue($objForm->GetValue("x_address1"));
		}
		if (!$postal->address2->FldIsDetailKey) {
			$postal->address2->setFormValue($objForm->GetValue("x_address2"));
		}
		if (!$postal->postalcode->FldIsDetailKey) {
			$postal->postalcode->setFormValue($objForm->GetValue("x_postalcode"));
		}
		if (!$postal->state->FldIsDetailKey) {
			$postal->state->setFormValue($objForm->GetValue("x_state"));
		}
		if (!$postal->city->FldIsDetailKey) {
			$postal->city->setFormValue($objForm->GetValue("x_city"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $postal;
		$this->LoadOldRecord();
		$postal->reg_id->CurrentValue = $postal->reg_id->FormValue;
		$postal->address1->CurrentValue = $postal->address1->FormValue;
		$postal->address2->CurrentValue = $postal->address2->FormValue;
		$postal->postalcode->CurrentValue = $postal->postalcode->FormValue;
		$postal->state->CurrentValue = $postal->state->FormValue;
		$postal->city->CurrentValue = $postal->city->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $postal;
		$sFilter = $postal->KeyFilter();

		// Call Row Selecting event
		$postal->Row_Selecting($sFilter);

		// Load SQL based on filter
		$postal->CurrentFilter = $sFilter;
		$sSql = $postal->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$postal->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $postal;
		if (!$rs || $rs->EOF) return;
		$postal->reg_id->setDbValue($rs->fields('reg_id'));
		$postal->address1->setDbValue($rs->fields('address1'));
		$postal->address2->setDbValue($rs->fields('address2'));
		$postal->postalcode->setDbValue($rs->fields('postalcode'));
		$postal->state->setDbValue($rs->fields('state'));
		$postal->city->setDbValue($rs->fields('city'));
	}

	// Load old record
	function LoadOldRecord() {
		global $postal;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($postal->getKey("reg_id")) <> "")
			$postal->reg_id->CurrentValue = $postal->getKey("reg_id"); // reg_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$postal->CurrentFilter = $postal->KeyFilter();
			$sSql = $postal->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $postal;

		// Initialize URLs
		// Call Row_Rendering event

		$postal->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// address1
		// address2
		// postalcode
		// state
		// city

		if ($postal->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$postal->reg_id->ViewValue = $postal->reg_id->CurrentValue;
			$postal->reg_id->ViewCustomAttributes = "";

			// address1
			$postal->address1->ViewValue = $postal->address1->CurrentValue;
			$postal->address1->ViewCustomAttributes = "";

			// address2
			$postal->address2->ViewValue = $postal->address2->CurrentValue;
			$postal->address2->ViewCustomAttributes = "";

			// postalcode
			$postal->postalcode->ViewValue = $postal->postalcode->CurrentValue;
			$postal->postalcode->ViewCustomAttributes = "";

			// state
			$postal->state->ViewValue = $postal->state->CurrentValue;
			$postal->state->ViewCustomAttributes = "";

			// city
			$postal->city->ViewValue = $postal->city->CurrentValue;
			$postal->city->ViewCustomAttributes = "";

			// reg_id
			$postal->reg_id->LinkCustomAttributes = "";
			$postal->reg_id->HrefValue = "";
			$postal->reg_id->TooltipValue = "";

			// address1
			$postal->address1->LinkCustomAttributes = "";
			$postal->address1->HrefValue = "";
			$postal->address1->TooltipValue = "";

			// address2
			$postal->address2->LinkCustomAttributes = "";
			$postal->address2->HrefValue = "";
			$postal->address2->TooltipValue = "";

			// postalcode
			$postal->postalcode->LinkCustomAttributes = "";
			$postal->postalcode->HrefValue = "";
			$postal->postalcode->TooltipValue = "";

			// state
			$postal->state->LinkCustomAttributes = "";
			$postal->state->HrefValue = "";
			$postal->state->TooltipValue = "";

			// city
			$postal->city->LinkCustomAttributes = "";
			$postal->city->HrefValue = "";
			$postal->city->TooltipValue = "";
		} elseif ($postal->RowType == EW_ROWTYPE_ADD) { // Add row

			// reg_id
			$postal->reg_id->EditCustomAttributes = "";
			$postal->reg_id->EditValue = ew_HtmlEncode($postal->reg_id->CurrentValue);

			// address1
			$postal->address1->EditCustomAttributes = "";
			$postal->address1->EditValue = ew_HtmlEncode($postal->address1->CurrentValue);

			// address2
			$postal->address2->EditCustomAttributes = "";
			$postal->address2->EditValue = ew_HtmlEncode($postal->address2->CurrentValue);

			// postalcode
			$postal->postalcode->EditCustomAttributes = "";
			$postal->postalcode->EditValue = ew_HtmlEncode($postal->postalcode->CurrentValue);

			// state
			$postal->state->EditCustomAttributes = "";
			$postal->state->EditValue = ew_HtmlEncode($postal->state->CurrentValue);

			// city
			$postal->city->EditCustomAttributes = "";
			$postal->city->EditValue = ew_HtmlEncode($postal->city->CurrentValue);

			// Edit refer script
			// reg_id

			$postal->reg_id->HrefValue = "";

			// address1
			$postal->address1->HrefValue = "";

			// address2
			$postal->address2->HrefValue = "";

			// postalcode
			$postal->postalcode->HrefValue = "";

			// state
			$postal->state->HrefValue = "";

			// city
			$postal->city->HrefValue = "";
		}
		if ($postal->RowType == EW_ROWTYPE_ADD ||
			$postal->RowType == EW_ROWTYPE_EDIT ||
			$postal->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$postal->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($postal->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$postal->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $postal;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($postal->reg_id->FormValue) && $postal->reg_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $postal->reg_id->FldCaption());
		}
		if (!ew_CheckInteger($postal->reg_id->FormValue)) {
			ew_AddMessage($gsFormError, $postal->reg_id->FldErrMsg());
		}
		if (!is_null($postal->address1->FormValue) && $postal->address1->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $postal->address1->FldCaption());
		}
		if (!is_null($postal->address2->FormValue) && $postal->address2->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $postal->address2->FldCaption());
		}
		if (!is_null($postal->postalcode->FormValue) && $postal->postalcode->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $postal->postalcode->FldCaption());
		}
		if (!ew_CheckInteger($postal->postalcode->FormValue)) {
			ew_AddMessage($gsFormError, $postal->postalcode->FldErrMsg());
		}
		if (!is_null($postal->state->FormValue) && $postal->state->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $postal->state->FldCaption());
		}
		if (!is_null($postal->city->FormValue) && $postal->city->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $postal->city->FldCaption());
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
		global $conn, $Language, $Security, $postal;

		// Check if key value entered
		if ($postal->reg_id->CurrentValue == "" && $postal->reg_id->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $postal->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $postal->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// reg_id
		$postal->reg_id->SetDbValueDef($rsnew, $postal->reg_id->CurrentValue, 0, FALSE);

		// address1
		$postal->address1->SetDbValueDef($rsnew, $postal->address1->CurrentValue, "", FALSE);

		// address2
		$postal->address2->SetDbValueDef($rsnew, $postal->address2->CurrentValue, "", FALSE);

		// postalcode
		$postal->postalcode->SetDbValueDef($rsnew, $postal->postalcode->CurrentValue, 0, FALSE);

		// state
		$postal->state->SetDbValueDef($rsnew, $postal->state->CurrentValue, "", FALSE);

		// city
		$postal->city->SetDbValueDef($rsnew, $postal->city->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $postal->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($postal->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($postal->CancelMessage <> "") {
				$this->setFailureMessage($postal->CancelMessage);
				$postal->CancelMessage = "";
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
			$postal->Row_Inserted($rs, $rsnew);
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
