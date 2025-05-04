@echo off
:: sets the selected lab as the default landing of localhost
:: to revisit

set /p number=Choose the laboratory number: x = 
set "source=lab%number%"
set "destination=F:\xampp\htdocs\%source%"

if not exist "%source%\" (
  echo error: source directory "%source%" does not exist.
  exit /b 1
)

echo %source%
echo %destination%

if exist "%destination%" (
    rmdir /s /q "%destination%"
)

mkdir "%destination%"
xcopy /E /I /Y "%source%\*" "%destination%"

echo ^<?php> index.php
echo if (!empty($_SERVER['HTTPS']) ^&^& ('on' == $_SERVER['HTTPS'])) {>> index.php
echo     $uri = 'https://';>> index.php
echo } else {>> index.php
echo     $uri = 'http://';>> index.php
echo }>> index.php
echo $uri .= $_SERVER['HTTP_HOST'];>> index.php
echo header('Location: ' . $uri . '/%source%');>> index.php
echo exit;>> index.php

del "F:\xampp\htdocs\index.php"
move index.php "F:\xampp\htdocs\"
