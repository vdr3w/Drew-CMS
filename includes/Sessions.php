<?php

session_start();

function ErrorMessage()
{
 if (isset($_SESSION["ErrorMessage"])) {
  $Output = "<div class=\"alert alert-danger\">"; // Corrigido aqui
  $Output .= htmlentities($_SESSION["ErrorMessage"]);
  $Output .= "</div>";
  $_SESSION["ErrorMessage"] = null; // Limpa a mensagem de erro após o uso
  return $Output;
 }
}

function SuccessMessage()
{
 if (isset($_SESSION["SuccessMessage"])) {
  $Output = "<div class=\"alert alert-success\">"; // Corrigido aqui
  $Output .= htmlentities($_SESSION["SuccessMessage"]);
  $Output .= "</div>";
  $_SESSION["SuccessMessage"] = null; // Limpa a mensagem de sucesso após o uso
  return $Output;
 }
}