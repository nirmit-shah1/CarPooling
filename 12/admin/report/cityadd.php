<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "cityinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$city_add = new ccity_add();
$Page =& $city_add;

// Page init
$city_add->Page_Init();

// Page main
$city_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var city_add = new ew_Page("city_add");

// page properties
city_add.PageID = "add"; // page ID
city_add.FormID = "fcityadd"; // form ID
var EW_PAGE_ID = city_add.PageID; // for backward compatibility

// extend page with ValidateForm function
city_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_cid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($city->cid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_cid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($city->cid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_sid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($city->sid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_sid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($city->sid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_city_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($city->city_name->FldCaption()) ?>");

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
city_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
city_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
city_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $city_add->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $city->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $city->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$city_add->ShowMessage();
?>
<form name="fcityadd" id="fcityadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return city_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="city">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($city->cid->Visible) { // cid ?>
	<tr id="r_cid"<?php echo $city->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $city->cid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $city->cid->CellAttributes() ?>><span id="el_cid">
<input type="text" name="x_cid" id="x_cid" size="30" value="<?php echo $city->cid->EditValue ?>"<?php echo $city->cid->EditAttributes() ?>>
</span><?php echo $city->cid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($city->sid->Visible) { // sid ?>
	<tr id="r_sid"<?php echo $city->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $city->sid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $city->sid->CellAttributes() ?>><span id="el_sid">
<input type="text" name="x_sid" id="x_sid" size="30" value="<?php echo $city->sid->EditValue ?>"<?php echo $city->sid->EditAttributes() ?>>
</span><?php echo $city->sid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($city->city_name->Visible) { // city_name ?>
	<tr id="r_city_name"<?php echo $city->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $city->city_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $city->city_name->CellAttributes() ?>><span id="el_city_name">
<input type="text" name="x_city_name" id="x_city_name" size="30" maxlength="20" value="<?php echo $city->city_name->EditValue ?>"<?php echo $city->city_name->EditAttributes() ?>>
</span><?php echo $city->city_name->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$city_add->ShowPageFooter();
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
$city_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ccity_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'city';

	// Page object name
	var $PageObjName = 'city_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $city;
		if ($city->UseTokenInUrl) $PageUrl .= "t=" . $city->TableVar . "&"; // Add page token
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
		global $objForm, $city;
		if ($city->UseTokenInUrl) {
			if ($objForm)
				return ($city->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($city->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccity_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (city)
		if (!isset($GLOBALS["city"])) {
			$GLOBALS["city"] = new ccity();
			$GLOBALS["Table"] =& $GLOBALS["city"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'city', TRUE);

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
		global $city;

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
		global $objForm, $Language, $gsFormError, $city;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$city->CurrentAction = $_POST["a_add"]; // Get form action
			$this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$city->CurrentAction = "I"; // Form error, reset action
				$city->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$bCopy = TRUE;
			if (@$_GET["city_name"] != "") {
				$city->city_name->setQueryStringValue($_GET["city_name"]);
				$city->setKey("city_name", $city->city_name->CurrentValue); // Set up key
			} else {
				$city->setKey("city_name", ""); // Clear key
				$bCopy = FALSE;
			}
			if ($bCopy) {
				$city->CurrentAction = "C"; // Copy record
			} else {
				$city->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($city->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("citylist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$city->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $city->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "cityview.php")
						$sReturnUrl = $city->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$city->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$city->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $city;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $city;
		$city->cid->CurrentValue = NULL;
		$city->cid->OldValue = $city->cid->CurrentValue;
		$city->sid->CurrentValue = NULL;
		$city->sid->OldValue = $city->sid->CurrentValue;
		$city->city_name->CurrentValue = NULL;
		$city->city_name->OldValue = $city->city_name->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $city;
		if (!$city->cid->FldIsDetailKey) {
			$city->cid->setFormValue($objForm->GetValue("x_cid"));
		}
		if (!$city->sid->FldIsDetailKey) {
			$city->sid->setFormValue($objForm->GetValue("x_sid"));
		}
		if (!$city->city_name->FldIsDetailKey) {
			$city->city_name->setFormValue($objForm->GetValue("x_city_name"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $city;
		$this->LoadOldRecord();
		$city->cid->CurrentValue = $city->cid->FormValue;
		$city->sid->CurrentValue = $city->sid->FormValue;
		$city->city_name->CurrentValue = $city->city_name->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $city;
		$sFilter = $city->KeyFilter();

		// Call Row Selecting event
		$city->Row_Selecting($sFilter);

		// Load SQL based on filter
		$city->CurrentFilter = $sFilter;
		$sSql = $city->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$city->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $city;
		if (!$rs || $rs->EOF) return;
		$city->cid->setDbValue($rs->fields('cid'));
		$city->sid->setDbValue($rs->fields('sid'));
		$city->city_name->setDbValue($rs->fields('city_name'));
	}

	// Load old record
	function LoadOldRecord() {
		global $city;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($city->getKey("city_name")) <> "")
			$city->city_name->CurrentValue = $city->getKey("city_name"); // city_name
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$city->CurrentFilter = $city->KeyFilter();
			$sSql = $city->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $city;

		// Initialize URLs
		// Call Row_Rendering event

		$city->Row_Rendering();

		// Common render codes for all row types
		// cid
		// sid
		// city_name

		if ($city->RowType == EW_ROWTYPE_VIEW) { // View row

			// cid
			$city->cid->ViewValue = $city->cid->CurrentValue;
			$city->cid->ViewCustomAttributes = "";

			// sid
			$city->sid->ViewValue = $city->sid->CurrentValue;
			$city->sid->ViewCustomAttributes = "";

			// city_name
			$city->city_name->ViewValue = $city->city_name->CurrentValue;
			$city->city_name->ViewCustomAttributes = "";

			// cid
			$city->cid->LinkCustomAttributes = "";
			$city->cid->HrefValue = "";
			$city->cid->TooltipValue = "";

			// sid
			$city->sid->LinkCustomAttributes = "";
			$city->sid->HrefValue = "";
			$city->sid->TooltipValue = "";

			// city_name
			$city->city_name->LinkCustomAttributes = "";
			$city->city_name->HrefValue = "";
			$city->city_name->TooltipValue = "";
		} elseif ($city->RowType == EW_ROWTYPE_ADD) { // Add row

			// cid
			$city->cid->EditCustomAttributes = "";
			$city->cid->EditValue = ew_HtmlEncode($city->cid->CurrentValue);

			// sid
			$city->sid->EditCustomAttributes = "";
			$city->sid->EditValue = ew_HtmlEncode($city->sid->CurrentValue);

			// city_name
			$city->city_name->EditCustomAttributes = "";
			$city->city_name->EditValue = ew_HtmlEncode($city->city_name->CurrentValue);

			// Edit refer script
			// cid

			$city->cid->HrefValue = "";

			// sid
			$city->sid->HrefValue = "";

			// city_name
			$city->city_name->HrefValue = "";
		}
		if ($city->RowType == EW_ROWTYPE_ADD ||
			$city->RowType == EW_ROWTYPE_EDIT ||
			$city->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$city->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($city->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$city->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $city;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($city->cid->FormValue) && $city->cid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $city->cid->FldCaption());
		}
		if (!ew_CheckInteger($city->cid->FormValue)) {
			ew_AddMessage($gsFormError, $city->cid->FldErrMsg());
		}
		if (!is_null($city->sid->FormValue) && $city->sid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $city->sid->FldCaption());
		}
		if (!ew_CheckInteger($city->sid->FormValue)) {
			ew_AddMessage($gsFormError, $city->sid->FldErrMsg());
		}
		if (!is_null($city->city_name->FormValue) && $city->city_name->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $city->city_name->FldCaption());
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
		global $conn, $Language, $Security, $city;

		// Check if key value entered
		if ($city->city_name->CurrentValue == "" && $city->city_name->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $city->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $city->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// cid
		$city->cid->SetDbValueDef($rsnew, $city->cid->CurrentValue, 0, FALSE);

		// sid
		$city->sid->SetDbValueDef($rsnew, $city->sid->CurrentValue, 0, FALSE);

		// city_name
		$city->city_name->SetDbValueDef($rsnew, $city->city_name->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $city->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($city->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($city->CancelMessage <> "") {
				$this->setFailureMessage($city->CancelMessage);
				$city->CancelMessage = "";
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
			$city->Row_Inserted($rs, $rsnew);
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
