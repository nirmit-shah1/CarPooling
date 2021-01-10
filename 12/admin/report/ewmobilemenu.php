<!-- Begin Main Menu -->
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(1, "mmi_area", $Language->MenuPhrase("1", "MenuText"), "arealist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(2, "mmi_city", $Language->MenuPhrase("2", "MenuText"), "citylist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(3, "mmi_company", $Language->MenuPhrase("3", "MenuText"), "companylist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(4, "mmi_companymodel", $Language->MenuPhrase("4", "MenuText"), "companymodellist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(5, "mmi_counter", $Language->MenuPhrase("5", "MenuText"), "counterlist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(6, "mmi_images", $Language->MenuPhrase("6", "MenuText"), "imageslist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(7, "mmi__login", $Language->MenuPhrase("7", "MenuText"), "_loginlist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(8, "mmi_logincount", $Language->MenuPhrase("8", "MenuText"), "logincountlist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(9, "mmi_member", $Language->MenuPhrase("9", "MenuText"), "memberlist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(10, "mmi_member_signup", $Language->MenuPhrase("10", "MenuText"), "member_signuplist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(11, "mmi_membertravellingdetails", $Language->MenuPhrase("11", "MenuText"), "membertravellingdetailslist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(12, "mmi_model", $Language->MenuPhrase("12", "MenuText"), "modellist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(13, "mmi_postal", $Language->MenuPhrase("13", "MenuText"), "postallist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(14, "mmi_privatemessage", $Language->MenuPhrase("14", "MenuText"), "privatemessagelist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(15, "mmi_routedetails", $Language->MenuPhrase("15", "MenuText"), "routedetailslist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(16, "mmi_signup_details", $Language->MenuPhrase("16", "MenuText"), "signup_detailslist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(17, "mmi_signuplogin", $Language->MenuPhrase("17", "MenuText"), "signuploginlist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(18, "mmi_staecityarera", $Language->MenuPhrase("18", "MenuText"), "staecityareralist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(19, "mmi_state", $Language->MenuPhrase("19", "MenuText"), "statelist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(20, "mmi_typeoftrip", $Language->MenuPhrase("20", "MenuText"), "typeoftriplist.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(21, "mmi_view1", $Language->MenuPhrase("21", "MenuText"), "view1list.php", -1, "", TRUE, FALSE);
$RootMenu->AddMenuItem(22, "mmi_view2", $Language->MenuPhrase("22", "MenuText"), "view2list.php", -1, "", TRUE, FALSE);
$RootMenu->Render();
?>
<!-- End Main Menu -->
