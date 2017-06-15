<?php

/*
  enterprise hackingshield [tm] with riskacceptor[tm] plugin
*/

session_start();
if(isset($_SESSION["hacking"]))
{
  print "You have been banned by hackingshield[tm] :(";
  die;
}

// WAF Change Log:
// 15/06: Informed in a meeting that XOR was an sqli keyword.
$blockedstrings = array("SELECT * FROM","UNION SELECT","<script>","<img>","<img src>","/etc/passwd","/etc/groups","/var/log/httpd.log","alert(","XOR","cmd/c");
$blocked = false;

foreach($_REQUEST as $key => $value)
{
  foreach($blockedstrings as $bs)
  {
    // following feedback during lectures, this is now
    // case insensitive :)
    if(stripos($value,$bs) !== false)
    {
      $blocked = true;
    }
  }
}

// now with support for OWASP Top Ten 2017 RC1
$i_definitely_protected_my_applications_A7 = true;
$i_remembered_to_protect_my_apis_A10 = true;

if($blocked)
{
  $_SESSION["hacking"] = true;
  print "You have been banned by hackingshield[tm] :(";
  die;
}

$risk_accepted = true;

?>
