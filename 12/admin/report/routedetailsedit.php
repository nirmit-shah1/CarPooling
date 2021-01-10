<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "routedetailsinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$routedetails_edit = new croutedetails_edit();
$Page =& $routedetails_edit;

// Page init
$routedetails_edit->Page_Init();

// Page main
$routedetails_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var routedetails_edit = new ew_Page("routedetails_edit");

// page properties
routedetails_edit.PageID = "edit"; // page ID
routedetails_edit.FormID = "froutedetailsedit"; // form ID
var EW_PAGE_ID = routedetails_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
routedetails_edit.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($routedetails->reg_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_reg_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($routedetails->reg_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_mid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($routedetails->mid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_mid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($routedetails->mid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_source"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($routedetails->source->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_destination"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($routedetails->destination->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_intermediatedestination1"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($routedetails->intermediatedestination1->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_intermediatedestination2"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($routedetails->intermediatedestination2->FldCaption()) ?>");

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
routedetails_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
routedetails_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
routedetails_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $routedetails_edit->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $routedetails->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $routedetails->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$routedetails_edit->ShowMessage();
?>
<form name="froutedetailsedit" id="froutedetailsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return routedetails_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="routedetails">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($routedetails->reg_id->Visible) { // reg_id ?>
	<tr id="r_reg_id"<?php echo $routedetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $routedetails->reg_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $routedetails->reg_id->CellAttributes() ?>><span id="el_reg_id">
<input type="text" name="x_reg_id" id="x_reg_id" size="30" value="<?php echo $routedetails->reg_id->EditValue ?>"<?php echo $routedetails->reg_id->EditAttributes() ?>>
</span><?php echo $routedetails->reg_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($routedetails->mid->Visible) { // mid ?>
	<tr id="r_mid"<?php echo $routedetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $routedetails->mid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $routedetails->mid->CellAttributes() ?>><span id="el_mid">
<div<?php echo $routedetails->mid->ViewAttributes() ?>><?php echo $routedetails->mid->EditValue ?></div>
<input type="hidden" name="x_mid" id="x_mid" value="<?php echo ew_HtmlEncode($routedetails->mid->CurrentValue) ?>">
</span><?php echo $routedetails->mid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($routedetails->source->Visible) { // source ?>
	<tr id="r_source"<?php echo $routedetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $routedetails->source->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $routedetails->source->CellAttributes() ?>><span id="el_source">
<textarea name="x_source" id="x_source" cols="35" rows="4"<?php echo $routedetails->source->EditAttributes() ?>><?php echo $routedetails->source->EditValue ?></textarea>
</span><?php echo $routedetails->source->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($routedetails->destination->Visible) { // destination ?>
	<tr id="r_destination"<?php echo $routedetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $routedetails->destination->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $routedetails->destination->CellAttributes() ?>><span id="el_destination">
<textarea name="x_destination" id="x_destination" cols="35" rows="4"<?php echo $routedetails->destination->EditAttributes() ?>><?php echo $routedetails->destination->EditValue ?></textarea>
</span><?php echo $routedetails->destination->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($routedetails->intermediatedestination1->Visible) { // intermediatedestination1 ?>
	<tr id="r_intermediatedestination1"<?php echo $routedetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $routedetails->intermediatedestination1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $routedetails->intermediatedestination1->CellAttributes() ?>><span id="el_intermediatedestination1">
<textarea name="x_intermediatedestination1" id="x_intermediatedestination1" cols="35" rows="4"<?php echo $routedetails->intermediatedestination1->EditAttributes() ?>><?php echo $routedetails->intermediatedestination1->EditValue ?></textarea>
</span><?php echo $routedetails->intermediatedestination1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($routedetails->intermediatedestination2->Visible) { // intermediatedestination2 ?>
	<tr id="r_intermediatedestination2"<?php echo $routedetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $routedetails->intermediatedestination2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $routedetails->intermediatedestination2->CellAttributes() ?>><span id="el_intermediatedestination2">
<textarea name="x_intermediatedestination2" id="x_intermediatedestination2" cols="35" rows="4"<?php echo $routedetails->intermediatedestination2->EditAttributes() ?>><?php echo $routedetails->intermediatedestination2->EditValue ?></textarea>
</span><?php echo $routedetails->intermediatedestination2->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$routedetails_edit->ShowPageFooter();
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
$routedetails_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class croutedetails_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'routedetails';

	// Page object name
	var $PageObjName = 'routedetails_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $routedetails;
		if ($routedetails->UseTokenInUrl) $PageUrl .= "t=" . $routedetails->TableVar . "&"; // Add page token
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
		global $objForm, $routedetails;
		if ($routedetails->UseTokenInUrl) {
			if ($objForm)
				return ($routedetails->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($routedetails->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function croutedetails_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (routedetails)
		if (!isset($GLOBALS["routedetails"])) {
			$GLOBALS["routedetails"] = new croutedetails();
			$GLOBALS["Table"] =& $GLOBALS["routedetails"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'routedetails', TRUE);

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
		global $routedetails;

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
		global $objForm, $Language, $gsFormError, $routedetails;

		// Load key from QueryString
		if (@$_GET["mid"] <> "")
			$routedetails->mid->setQueryStringValue($_GET["mid"]);
		if (@$_POST["a_edit"] <> "") {
			$routedetails->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$routedetails->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$routedetails->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$routedetails->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($routedetails->mid->CurrentValue == "")
			$this->Page_Terminate("routedetailslist.php"); // Invalid key, return to list
		switch ($routedetails->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("routedetailslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$routedetails->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $routedetails->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$routedetails->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$routedetails->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$routedetails->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $routedetails;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $routedetails;
		if (!$routedetails->reg_id->FldIsDetailKey) {
			$routedetails->reg_id->setFormValue($objForm->GetValue("x_reg_id"));
		}
		if (!$routedetails->mid->FldIsDetailKey) {
			$routedetails->mid->setFormValue($objForm->GetValue("x_mid"));
		}
		if (!$routedetails->source->FldIsDetailKey) {
			$routedetails->source->setFormValue($objForm->GetValue("x_source"));
		}
		if (!$routedetails->destination->FldIsDetailKey) {
			$routedetails->destination->setFormValue($objForm->GetValue("x_destination"));
		}
		if (!$routedetails->intermediatedestination1->FldIsDetailKey) {
			$routedetails->intermediatedestination1->setFormValue($objForm->GetValue("x_intermediatedestination1"));
		}
		if (!$routedetails->intermediatedestination2->FldIsDetailKey) {
			$routedetails->intermediatedestination2->setFormValue($objForm->GetValue("x_intermediatedestination2"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $routedetails;
		$this->LoadRow();
		$routedetails->reg_id->CurrentValue = $routedetails->reg_id->FormValue;
		$routedetails->mid->CurrentValue = $routedetails->mid->FormValue;
		$routedetails->source->CurrentValue = $routedetails->source->FormValue;
		$routedetails->destination->CurrentValue = $routedetails->destination->FormValue;
		$routedetails->intermediatedestination1->CurrentValue = $routedetails->intermediatedestination1->FormValue;
		$routedetails->intermediatedestination2->CurrentValue = $routedetails->intermediatedestination2->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $routedetails;
		$sFilter = $routedetails->KeyFilter();

		// Call Row Selecting event
		$routedetails->Row_Selecting($sFilter);

		// Load SQL based on filter
		$routedetails->CurrentFilter = $sFilter;
		$sSql = $routedetails->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$routedetails->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $routedetails;
		if (!$rs || $rs->EOF) return;
		$routedetails->reg_id->setDbValue($rs->fields('reg_id'));
		$routedetails->mid->setDbValue($rs->fields('mid'));
		$routedetails->source->setDbValue($rs->fields('source'));
		$routedetails->destination->setDbValue($rs->fields('destination'));
		$routedetails->intermediatedestination1->setDbValue($rs->fields('intermediatedestination1'));
		$routedetails->intermediatedestination2->setDbValue($rs->fields('intermediatedestination2'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $routedetails;

		// Initialize URLs
		// Call Row_Rendering event

		$routedetails->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// mid
		// source
		// destination
		// intermediatedestination1
		// intermediatedestination2

		if ($routedetails->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$routedetails->reg_id->ViewValue = $routedetails->reg_id->CurrentValue;
			$routedetails->reg_id->ViewCustomAttributes = "";

			// mid
			$routedetails->mid->ViewValue = $routedetails->mid->CurrentValue;
			$routedetails->mid->ViewCustomAttributes = "";

			// source
			$routedetails->source->ViewValue = $routedetails->source->CurrentValue;
			$routedetails->source->ViewCustomAttributes = "";

			// destination
			$routedetails->destination->ViewValue = $routedetails->destination->CurrentValue;
			$routedetails->destination->ViewCustomAttributes = "";

			// intermediatedestination1
			$routedetails->intermediatedestination1->ViewValue = $routedetails->intermediatedestination1->CurrentValue;
			$routedetails->intermediatedestination1->ViewCustomAttributes = "";

			// intermediatedestination2
			$routedetails->intermediatedestination2->ViewValue = $routedetails->intermediatedestination2->CurrentValue;
			$routedetails->intermediatedestination2->ViewCustomAttributes = "";

			// reg_id
			$routedetails->reg_id->LinkCustomAttributes = "";
			$routedetails->reg_id->HrefValue = "";
			$routedetails->reg_id->TooltipValue = "";

			// mid
			$routedetails->mid->LinkCustomAttributes = "";
			$routedetails->mid->HrefValue = "";
			$routedetails->mid->TooltipValue = "";

			// source
			$routedetails->source->LinkCustomAttributes = "";
			$routedetails->source->HrefValue = "";
			$routedetails->source->TooltipValue = "";

			// destination
			$routedetails->destination->LinkCustomAttributes = "";
			$routedetails->destination->HrefValue = "";
			$routedetails->destination->TooltipValue = "";

			// intermediatedestination1
			$routedetails->intermediatedestination1->LinkCustomAttributes = "";
			$routedetails->intermediatedestination1->HrefValue = "";
			$routedetails->intermediatedestination1->TooltipValue = "";

			// intermediatedestination2
			$routedetails->intermediatedestination2->LinkCustomAttributes = "";
			$routedetails->intermediatedestination2->HrefValue = "";
			$routedetails->intermediatedestination2->TooltipValue = "";
		} elseif ($routedetails->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// reg_id
			$routedetails->reg_id->EditCustomAttributes = "";
			$routedetails->reg_id->EditValue = ew_HtmlEncode($routedetails->reg_id->CurrentValue);

			// mid
			$routedetails->mid->EditCustomAttributes = "";
			$routedetails->mid->EditValue = $routedetails->mid->CurrentValue;
			$routedetails->mid->ViewCustomAttributes = "";

			// source
			$routedetails->source->EditCustomAttributes = "";
			$routedetails->source->EditValue = ew_HtmlEncode($routedetails->source->CurrentValue);

			// destination
			$routedetails->destination->EditCustomAttributes = "";
			$routedetails->destination->EditValue = ew_HtmlEncode($routedetails->destination->CurrentValue);

			// intermediatedestination1
			$routedetails->intermediatedestination1->EditCustomAttributes = "";
			$routedetails->intermediatedestination1->EditValue = ew_HtmlEncode($routedetails->intermediatedestination1->CurrentValue);

			// intermediatedestination2
			$routedetails->intermediatedestination2->EditCustomAttributes = "";
			$routedetails->intermediatedestination2->EditValue = ew_HtmlEncode($routedetails->intermediatedestination2->CurrentValue);

			// Edit refer script
			// reg_id

			$routedetails->reg_id->HrefValue = "";

			// mid
			$routedetails->mid->HrefValue = "";

			// source
			$routedetails->source->HrefValue = "";

			// destination
			$routedetails->destination->HrefValue = "";

			// intermediatedestination1
			$routedetails->intermediatedestination1->HrefValue = "";

			// intermediatedestination2
			$routedetails->intermediatedestination2->HrefValue = "";
		}
		if ($routedetails->RowType == EW_ROWTYPE_ADD ||
			$routedetails->RowType == EW_ROWTYPE_EDIT ||
			$routedetails->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$routedetails->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($routedetails->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$routedetails->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $routedetails;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($routedetails->reg_id->FormValue) && $routedetails->reg_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $routedetails->reg_id->FldCaption());
		}
		if (!ew_CheckInteger($routedetails->reg_id->FormValue)) {
			ew_AddMessage($gsFormError, $routedetails->reg_id->FldErrMsg());
		}
		if (!is_null($routedetails->mid->FormValue) && $routedetails->mid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $routedetails->mid->FldCaption());
		}
		if (!ew_CheckInteger($routedetails->mid->FormValue)) {
			ew_AddMessage($gsFormError, $routedetails->mid->FldErrMsg());
		}
		if (!is_null($routedetails->source->FormValue) && $routedetails->source->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $routedetails->source->FldCaption());
		}
		if (!is_null($routedetails->destination->FormValue) && $routedetails->destination->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $routedetails->destination->FldCaption());
		}
		if (!is_null($routedetails->intermediatedestination1->FormValue) && $routedetails->intermediatedestination1->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $routedetails->intermediatedestination1->FldCaption());
		}
		if (!is_null($routedetails->intermediatedestination2->FormValue) && $routedetails->intermediatedestination2->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $routedetails->intermediatedestination2->FldCaption());
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
		global $conn, $Security, $Language, $routedetails;
		$sFilter = $routedetails->KeyFilter();
		$routedetails->CurrentFilter = $sFilter;
		$sSql = $routedetails->SQL();
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
			$routedetails->reg_id->SetDbValueDef($rsnew, $routedetails->reg_id->CurrentValue, 0, FALSE);

			// mid
			// source

			$routedetails->source->SetDbValueDef($rsnew, $routedetails->source->CurrentValue, "", FALSE);

			// destination
			$routedetails->destination->SetDbValueDef($rsnew, $routedetails->destination->CurrentValue, "", FALSE);

			// intermediatedestination1
			$routedetails->intermediatedestination1->SetDbValueDef($rsnew, $routedetails->intermediatedestination1->CurrentValue, "", FALSE);

			// intermediatedestination2
			$routedetails->intermediatedestination2->SetDbValueDef($rsnew, $routedetails->intermediatedestination2->CurrentValue, "", FALSE);

			// Call Row Updating event
			$bUpdateRow = $routedetails->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($routedetails->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($routedetails->CancelMessage <> "") {
					$this->setFailureMessage($routedetails->CancelMessage);
					$routedetails->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$routedetails->Row_Updated($rsold, $rsnew);
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
